# IndexNow for creativeblindsdrapes.com

Small toolkit to notify search engines (Bing, Yandex, Seznam, and — as a soft
hint — Google) when pages are added or changed, via the
[IndexNow](https://www.indexnow.org/) protocol.

These are **CLI scripts**: they run on the **production server over SSH**, not in a
browser and not on local WAMP (local can't reach the live domain or the public
key file). Edit locally, upload with FileZilla, then run them through PuTTY.

---

## Files

| File | Purpose |
|------|---------|
| `indexnow_lib.php` | Shared config (host, key, key URL, endpoint) + the `indexnow_submit()` function. **Edit config here only.** |
| `indexnow_test.php` | One-shot check: verifies the public key file is reachable and submits one URL. Run this first. |
| `indexnow_sync.php` | Main script. Reads the sitemap, submits only new/changed URLs. Also does targeted `--urls` submissions. |
| `urls_2_submit.txt` | Hand-picked URL list for targeted submits (one URL per line; `#` = comment). |
| `.indexnow_state_creativeblindsdrapes.json` | Auto-created baseline of sitemap URLs + lastmod. Not committed; lives outside the web root when `$HOME` is set. |

Key facts (already configured in `indexnow_lib.php`):

- **Host:** `creativeblindsdrapes.com` (non-www, canonical)
- **Key file:** `https://creativeblindsdrapes.com/d15d73ba54749e8e5456b89b99a90eb2.txt`
- **Key scope:** the key sits at the **site root**, so it can vouch for the
  entire site — any URL under `https://creativeblindsdrapes.com/`.
- **Sitemap:** `https://creativeblindsdrapes.com/sitemap.xml` (deployed to the domain root).

---

## 1. Connect to the host with PuTTY

1. Open **PuTTY**.
2. **Host Name (or IP address):** your server's SSH host (e.g. `creativeblindsdrapes.com`
   or the SSH hostname your host gave you).
3. **Port:** `22` &nbsp; **Connection type:** `SSH`.
4. (Optional) Save it: type a name under *Saved Sessions* → **Save**.
5. Click **Open**. Accept the host-key fingerprint on first connect.
6. Log in with your SSH username and password (or key, if configured).

> If you use an SSH key, point PuTTY to your `.ppk` under
> *Connection → SSH → Auth → Credentials* before clicking Open.

Once you have a shell prompt, go to the script folder. The path depends on where
the site is deployed on the server, e.g.:

```bash
cd ~/public_html/data/config/index
# or, depending on the host's layout:
cd /home/USER/creativeblindsdrapes.com/data/config/index
```

Confirm you're in the right place:

```bash
ls -la
# you should see indexnow_lib.php, indexnow_test.php, indexnow_sync.php, urls_2_submit.txt
```

Check PHP is available on the shell:

```bash
php -v
```

---

## 2. Test the key (run once, first)

```bash
php indexnow_test.php
```

Expected: a `SUCCESS` line at the end. It confirms the public key file returns
exactly the key and that a single submission is accepted (HTTP 200/202).

If it fails:
- **Key match: FAIL / 403** → the `.txt` file isn't reachable or its contents
  aren't exactly the key. Open the key URL in a browser to check.
- **422** → www vs non-www mismatch, or a URL outside the key scope.

---

## 3. Run the sitemap sync

```bash
# Preview what would be submitted — sends nothing, writes nothing
php indexnow_sync.php --dry-run

# Normal run: submit only new/changed URLs, then update the baseline
php indexnow_sync.php

# Force-submit ALL sitemap URLs once (rarely needed)
php indexnow_sync.php --seed
```

**First ever run** detects no baseline file, saves the current sitemap as the
baseline, and submits **nothing**. That's expected — the *next* run is the one
that submits changes. Change detection relies on the sitemap's `<lastmod>`
values updating when a page changes.

---

## 4. Targeted submit (nudge specific pages)

Use this to push a hand-picked list — e.g. GSC *"Discovered – currently not
indexed"* pages. It's independent of the sitemap and **does not touch the
baseline state**.

Edit `urls_2_submit.txt` (one URL per line, `#` for comments, all under
`https://creativeblindsdrapes.com/`), then:

```bash
# Preview the list
php indexnow_sync.php --urls --dry-run

# Submit the list (default file: urls_2_submit.txt)
php indexnow_sync.php --urls

# Submit a different file
php indexnow_sync.php --urls=/path/to/other_list.txt
```

Expected: `IndexNow response: HTTP 200` (or `202`) and
`Submitted. Baseline state left unchanged.`

> Only add pages that benefit from a crawl nudge (Discovered / not yet crawled).
> Don't add *"Crawled – currently not indexed"* or *"Duplicate"* pages —
> IndexNow won't change Google's decision on those.

---

## 5. Deploy workflow (FileZilla)

1. Edit the `.php` / `.txt` files locally under
   `C:\wamp64\www\creativeblindsdrapes\data\config\index\`.
2. Upload the changed files via FileZilla to the matching path on the server.
3. SSH in with PuTTY (section 1) and run the command you need.

The scripts are server-side only — uploading them exposes nothing sensitive.
The `.txt` key file at the site root is meant to be public.

---

## 6. (Optional) Automate with cron

Once a manual run works, schedule a daily sitemap sync on the server:

```bash
# crontab -e   — adjust the absolute path to the script
0 6 * * * php /home/USER/public_html/data/config/index/indexnow_sync.php >> /home/USER/indexnow.log 2>&1
```

Make sure `$HOME` is set in the cron environment so the state file lands above
the web root (otherwise it falls back to this folder).

---

## Troubleshooting

| Symptom | Likely cause / fix |
|---------|--------------------|
| `Could not fetch sitemap` | Sitemap URL wrong or unreachable. Open `https://creativeblindsdrapes.com/sitemap.xml` in a browser. |
| `Sitemap is not a valid <urlset>` | The URL returned an error page (e.g. 404) instead of the sitemap. |
| `403` on submit | Key file contents/location wrong — re-check the `.txt` file. |
| `422` on submit | Host mismatch (www vs non-www) or URL outside the key scope. |
| `Skipped (outside key scope ...)` | Listed URLs aren't under `https://creativeblindsdrapes.com/` — they can't be submitted with this key. |
| Submits nothing every run | Sitemap `<lastmod>` isn't changing on edits, so nothing looks "changed." |
| `php: command not found` | PHP CLI not on PATH for the SSH user — ask the host for the correct `php` path (e.g. `/usr/local/bin/php`). |
</content>
</invoke>
