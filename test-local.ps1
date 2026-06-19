<#
.SYNOPSIS
    Smoke-tests the Creative Blinds & Drapes site after the nested-URL migration.

.DESCRIPTION
    Checks that every page loads (200), every legacy flat URL redirects (301),
    canonical/asset/SITE_BASE references are correct, the thank-you page is noindex,
    and the contact-form endpoint is reachable.

    Works against the local WAMP install (site under a subfolder) or production
    (site at the domain root) - pass -BaseUrl accordingly.

.PARAMETER BaseUrl
    Root of the site, no trailing slash. Defaults to the local WAMP URL.

.EXAMPLE
    .\test-local.ps1
    .\test-local.ps1 -BaseUrl https://creativeblindsdrapes.com
#>
[CmdletBinding()]
param(
    [string]$BaseUrl = "http://localhost/creativeblindsdrapes"
)

$ErrorActionPreference = "Stop"
$BaseUrl = $BaseUrl.TrimEnd("/")

# URL-path prefix of the install ("/creativeblindsdrapes" locally, "" in production).
$basePath = ([uri]$BaseUrl).AbsolutePath.TrimEnd("/")

$script:pass = 0
$script:fail = 0

function Result([bool]$ok, [string]$label, [string]$detail = "") {
    if ($ok) {
        $script:pass++
        Write-Host ("  [PASS] " + $label) -ForegroundColor Green
    } else {
        $script:fail++
        Write-Host ("  [FAIL] " + $label) -ForegroundColor Red
        if ($detail) { Write-Host ("         " + $detail) -ForegroundColor DarkYellow }
    }
}

function Section([string]$title) {
    Write-Host ""
    Write-Host ("=== " + $title + " ===") -ForegroundColor Cyan
}

# Returns @{ Status = <int>; Location = <string>; Body = <string> } for any response.
# Uses HttpWebRequest so 3xx is returned (not thrown) when -NoFollow is set - more reliable
# than Invoke-WebRequest -MaximumRedirection 0 under Windows PowerShell 5.1.
function Get-Http([string]$url, [switch]$NoFollow) {
    $req = [System.Net.HttpWebRequest]::Create($url)
    $req.AllowAutoRedirect = -not $NoFollow
    $req.Method = "GET"
    $req.Timeout = 20000
    $req.UserAgent = "test-local.ps1"
    $resp = $null
    try {
        $resp = $req.GetResponse()
    } catch [System.Net.WebException] {
        $resp = $_.Exception.Response
        if (-not $resp) { return @{ Status = -1; Location = $null; Body = $_.Exception.Message } }
    }
    $status = [int]$resp.StatusCode
    $loc = $resp.Headers["Location"]
    $body = ""
    try {
        $sr = New-Object System.IO.StreamReader($resp.GetResponseStream())
        $body = $sr.ReadToEnd()
        $sr.Close()
    } catch {}
    $resp.Close()
    return @{ Status = $status; Location = $loc; Body = $body }
}

Write-Host ""
Write-Host ("Testing: " + $BaseUrl) -ForegroundColor White
Write-Host ("Base path prefix: '" + $basePath + "'") -ForegroundColor DarkGray

# ---------------------------------------------------------------------------
Section "Pages load (expect 200)"
$pages = @(
    "/",
    "/window-treatments/",
    "/window-treatments/window-blinds/",
    "/window-treatments/window-shutters/",
    "/window-treatments/shades/",
    "/window-treatments/curtains-and-drapes/",
    "/about-us/",
    "/contact/",
    "/thank-you/",
    "/curtain-hardware.php"
)
foreach ($p in $pages) {
    $r = Get-Http "$BaseUrl$p" -NoFollow
    Result ($r.Status -eq 200) ("{0,-44} {1}" -f $p, $r.Status) $r.Body
}

# ---------------------------------------------------------------------------
Section "Legacy URLs redirect (expect 301)"
Write-Host "  (Local note: Location resolves to the domain root, not the subfolder - that is expected.)" -ForegroundColor DarkGray
$old = @(
    "/blinds.php",   "/shutters.php", "/shades.php", "/curtains.php",
    "/about.php",    "/contact.php",  "/thank-you.php",
    "/sheer-curtains.php", "/drapes-curtains.php", "/products/adeko-window-treatments"
)
foreach ($p in $old) {
    $r = Get-Http "$BaseUrl$p" -NoFollow
    Result ($r.Status -eq 301) ("{0,-34} {1} -> {2}" -f $p, $r.Status, $r.Location)
}

# ---------------------------------------------------------------------------
Section "Canonical tags (production domain, no base prefix, no query)"
$canonExpect = @{
    "/"                                        = "https://creativeblindsdrapes.com/"
    "/window-treatments/window-blinds/"        = "https://creativeblindsdrapes.com/window-treatments/window-blinds/"
    "/window-treatments/curtains-and-drapes/"  = "https://creativeblindsdrapes.com/window-treatments/curtains-and-drapes/"
    "/about-us/"                               = "https://creativeblindsdrapes.com/about-us/"
    "/contact/"                                = "https://creativeblindsdrapes.com/contact/"
}
foreach ($p in $canonExpect.Keys) {
    $r = Get-Http "$BaseUrl$p" -NoFollow
    $m = [regex]::Match($r.Body, '<link rel="canonical" href="([^"]+)"')
    $got = if ($m.Success) { $m.Groups[1].Value } else { "(none)" }
    Result ($got -eq $canonExpect[$p]) ("{0,-44} {1}" -f $p, $got) ("expected " + $canonExpect[$p])
}

# ---------------------------------------------------------------------------
Section "Asset paths + SITE_BASE carry the install base path"
$r = Get-Http "$BaseUrl/window-treatments/window-blinds/" -NoFollow
Result ($r.Body -match [regex]::Escape('href="' + $basePath + '/css/style.css"')) "style.css uses base path"
Result ($r.Body -match [regex]::Escape('src="' + $basePath + '/assets/js/script.js"')) "script.js uses base path"
Result ($r.Body -match ("window.SITE_BASE = '" + [regex]::Escape($basePath) + "'")) "SITE_BASE = '$basePath'"
Result ($r.Body -match [regex]::Escape('href="' + $basePath + '/contact/#quote-form"')) "quote CTA -> /contact/#quote-form"
Result ($r.Body -match [regex]::Escape('src="' + $basePath + '/assets/products/')) "product thumbnails use base path"

# ---------------------------------------------------------------------------
Section "Active nav state"
$navChecks = @{
    "/window-treatments/window-shutters/"     = "Shutters"
    "/window-treatments/window-blinds/"       = "Blinds"
    "/window-treatments/shades/"              = "Shades"
    "/window-treatments/curtains-and-drapes/" = "Curtains"
    "/contact/"                               = "Contact"
}
foreach ($p in $navChecks.Keys) {
    $r = Get-Http "$BaseUrl$p" -NoFollow
    $label = $navChecks[$p]
    $ok = $r.Body -match ('class="active"[^>]*>' + [regex]::Escape($label) + '</a>')
    Result $ok ("{0,-44} active: {1}" -f $p, $label)
}

# ---------------------------------------------------------------------------
Section "Misc"
$r = Get-Http "$BaseUrl/thank-you/" -NoFollow
Result ($r.Body -match 'name="robots" content="noindex, nofollow"') "thank-you is noindex"

$r = Get-Http "$BaseUrl/data/config/process-contact.php" -NoFollow
Result ($r.Status -eq 200) ("contact-form endpoint reachable ({0})" -f $r.Status)

# ---------------------------------------------------------------------------
Write-Host ""
Write-Host "------------------------------------------------------------" -ForegroundColor DarkGray
$total = $script:pass + $script:fail
if ($script:fail -eq 0) {
    Write-Host ("ALL PASSED  ({0}/{1})" -f $script:pass, $total) -ForegroundColor Green
    exit 0
} else {
    Write-Host ("{0} PASSED, {1} FAILED  (of {2})" -f $script:pass, $script:fail, $total) -ForegroundColor Red
    exit 1
}
