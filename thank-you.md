# Form Submission Flow: Compact Quote Form and Contact Form

Technical reference for what actually happens between a visitor pressing submit and landing on
`/thank-you/`. Both forms share one backend endpoint and one destination page, but they differ in
markup, client-side script, field set, and reCAPTCHA action name.

## Files involved

| Role | File |
|---|---|
| Compact form markup | `includes/compact-form.php` |
| Compact form script | `assets/js/script.js` (lines 65-162) |
| Full contact form markup + script | `contact/index.php` |
| Backend endpoint (shared) | `data/config/process-contact.php` |
| Destination page (shared) | `thank-you/index.php` |
| Base URL, session bootstrap, business constants | `includes/config.php` |
| `window.SITE_BASE` for the JS | `includes/footer.php` line 82 |
| Submission log | `data/config/logs/form_submissions.log` (public access denied by `data/config/logs/.htaccess`) |

## Side-by-side comparison

| | Compact quote form | Full contact form |
|---|---|---|
| Where it renders | Included on nearly every public page directly below the hero (`include ROOT_PATH . '/includes/compact-form.php'`) | Only on `/contact/` |
| Form id | `compactQuoteForm` | `contactForm` |
| Handler location | `assets/js/script.js` (global, exits early if `#compactQuoteForm` is absent) | Inline `<script>` at the bottom of `contact/index.php` |
| Fields posted | `name`, `email`, `phone`, `zip`, `service`, `consent`, `middleName` (honeypot), `recaptcha_token` | The same, plus `address`, `rooms`, `message` |
| Honeypot input id | `cqHoneypot` | `ctHoneypot` (same field name `middleName`) |
| Native browser validation | Off: the `<form>` carries `novalidate`, so `required` is enforced server-side only | On: no `novalidate`, so `required` and the ZIP `pattern="\d{5}(-\d{4})?"` are enforced before the submit handler runs |
| Client-side ZIP check | Format only (5 digits, ZIP+4 trimmed to its base), plus a blur hint in `#cqZipHint`. The service-area range is deliberately not checked or hinted here | None beyond the `pattern` attribute |
| reCAPTCHA action | `compact_quote` | `submit` |
| reCAPTCHA script tag | At the end of `includes/compact-form.php` (`async defer`) | At the end of `contact/index.php` (blocking) |
| Error display target | `#cqMsg` inside the form | `#formMessage` above the form, plus `scrollIntoView` |
| Endpoint URL built from | `window.SITE_BASE` (JS global) | `<?php echo BASE_URL; ?>` (rendered server-side) |

Everything after the POST is identical for the two forms.

## Client-side sequence (both forms)

1. `submit` event is intercepted with `preventDefault()`.
2. **Honeypot check.** If the hidden `middleName` input has any value, the browser is redirected
   straight to `/thank-you/` and the handler returns. No request is sent to the server, so nothing
   is logged and no session flash is set: the thank-you page renders in its generic form.
3. Compact form only: ZIP format validation. An invalid format shows an inline error and aborts.
   An out-of-area ZIP is allowed through on purpose so the response a refused sender sees is
   identical to a successful one.
4. Submit button is disabled and relabeled ("Sending...").
5. `grecaptcha.ready()` then `grecaptcha.execute(SITE_KEY, { action: ... })` returns a v3 token,
   which is written into the hidden `recaptcha_token` input.
6. `fetch(BASE + '/data/config/process-contact.php', { method: 'POST', body: new FormData(form) })`.
7. The JSON response is parsed:
   - `success: true` sets `window.location.href = BASE + '/thank-you/'`, with no query string.
   - `success: false` prints `result.message` in the form's message element and re-enables the button.
   - A thrown error (network failure, non-JSON body) prints a generic connection error and
     re-enables the button.

No query parameters are ever appended to the redirect. The thank-you page is tracked by GTM
(container `GTM-W9J8WXQX`, loaded in `includes/header.php`), so a name or email in the URL would
push PII into Analytics. The visitor's details travel through the PHP session instead.

## Server-side sequence: `data/config/process-contact.php`

Executed in this exact order. The ordering is intentional: every visible rejection happens before
any silent one, so a sender who fails the reCAPTCHA gate learns nothing except that the token was
bad.

1. `Content-Type: application/json`, `require_once '../../includes/config.php'`, `cbd_session_start()`.
   The session cookie is issued only here and on `/thank-you/`, never on ordinary page views.
2. Reject anything that is not a `POST`.
3. Read and `trim()` all fields. `address`, `rooms`, and `message` arrive empty from the compact form.
4. Log `request_received` with name, email, phone, zip, service. Every request is logged from this
   point on, whatever the outcome.
5. **Required fields** (`name`, `email`, `phone`, `service`): visible error, exit.
6. **Consent checkbox**: visible error, exit.
7. **Email syntax** (`FILTER_VALIDATE_EMAIL`): visible error, exit.
8. **reCAPTCHA hard gate.** An empty token is refused outright (logged as `recaptcha_missing`) with
   a message that includes the phone number. Failing closed here costs no real lead, because a
   visitor whose reCAPTCHA script failed to load can reload or call.
9. **reCAPTCHA siteverify.** POST to `https://www.google.com/recaptcha/api/siteverify` via
   `file_get_contents` with a 10 second timeout. A non-JSON or unreachable response is logged as
   `recaptcha_api_error` and refused (fail closed, visible message).
10. **Score check.** `success` false or `score < RECAPTCHA_MIN_SCORE` (currently `0.7`) is logged as
    `recaptcha_rejected` with the score and error codes, and shown as a visible failure. The score
    is logged on accepted paths too, so the threshold can be retuned from real traffic.
11. **Token context check.** `hostname` must be in `RECAPTCHA_ALLOWED_HOSTS`
    (`creativeblindsdrapes.com`, `www.creativeblindsdrapes.com`, `localhost`, `127.0.0.1`) and
    `action` must be in `RECAPTCHA_ALLOWED_ACTIONS` (`compact_quote`, `submit`). This is what ties
    a token to one of our two forms: without it, a token harvested from another site using the same
    site key would pass. A mismatch is a **soft reject** (`recaptcha_context_mismatch`).
12. **Server-side honeypot.** Checked again here because a direct POST skips the JS entirely.
    Non-empty `middleName` is a **soft reject** (`honeypot_tripped`).
13. **ZIP normalization and checks.** A ZIP+4 like `60540-6398` is reduced to its 5-digit base,
    whatever the range, so the range check below is what decides in-area vs out-of-area.
    A non-5-digit value is a **soft reject** (`zip_invalid`); since both forms enforce the
    format before the POST and both submit via `fetch`, reaching it means the client was
    bypassed, so it is treated as a bot. A value outside `60001-60900` (the service area) is a
    **soft reject** (`zip_out_of_range`) by a real person.
14. **Sanitize** every field with `htmlspecialchars()`.
15. **Build and send the email.** HTML body, `To: BUSINESS_EMAIL` (`creativeblindsdrapes@gmail.com`),
    `From: noreply@creativeblindsdrapes.com`, `Reply-To:` the visitor's address, subject
    `New Quote Request from {name}`. Optional blocks for address, rooms, and message appear only
    when populated, which is how a full contact form submission reads differently from a compact one.
16. `mail()` result: on success log `mail_sent`, call `store_lead_flash()`, return
    `{"success": true, ...}`. On failure log `mail_failed`, write to `error_log`, and return a
    visible failure carrying the phone number.

### Soft reject semantics

`soft_reject()` logs the real reason and then returns the exact same success JSON a genuine lead
receives, without ever sending mail. The sender sees a normal thank-you page and gets no signal to
tune against. Only the log knows the difference.

Two variants exist:

- **Suspected bot** (`recaptcha_context_mismatch`, `honeypot_tripped`, `zip_invalid`): called
  without a status, so no session flash is stored and the thank-you page renders fully generic.
- **Real person, out of area** (`zip_out_of_range`): called with status `out_of_area` and the
  name, so the thank-you page keeps the name greeting. No email is stored and none is rendered,
  because no mail was sent.

### The qualified-lead invariant

`#leadEmail` on the thank-you page exists if and only if `mail()` succeeded and `mail_sent` was
logged. GTM reads its presence on DOM Ready as a boolean qualified-lead signal; the email string
itself never enters the dataLayer. Two things enforce this:

1. `store_lead_flash($status, $name, $email = null)` persists the email only when `$status` is
   `'qualified'`, so no call site can leak it by passing the wrong arguments.
2. `thank-you/index.php` prints `$visitor_email` only when the flash status is `'qualified'`,
   and the `id="leadEmail"` sits inside that conditional, so the element is absent rather than
   empty on every other path.

The `mail_sent` path passes `$rawName`/`$rawEmail`, captured before the `htmlspecialchars()`
block, because the thank-you page escapes on output. Passing the sanitized values would
double-escape and render the email as entity text.

Consequence worth knowing: this makes the page a ZIP-range oracle for anyone who can pass
reCAPTCHA with a valid token context, since "email rendered or not" answers whether a ZIP is in
the service area. Accepted deliberately: `/service-areas/` already lists the towns, so the range
is not secret, and the reliability of the GTM signal is worth more.

### Outcome table

| Event logged | Mail sent | Response to browser | Thank-you page |
|---|---|---|---|
| `request_received` | n/a | n/a (always logged first) | n/a |
| missing required field / no consent / bad email | no | visible error | not reached |
| `recaptcha_missing` | no | visible error with phone | not reached |
| `recaptcha_api_error` | no | visible error with phone | not reached |
| `recaptcha_rejected` | no | visible "verification failed" | not reached |
| `recaptcha_context_mismatch` | no | fake success | generic |
| `honeypot_tripped` (server) | no | fake success | generic |
| `zip_invalid` | no | fake success | generic |
| `zip_out_of_range` | no | fake success | name only, no `#leadEmail` |
| `mail_sent` | yes | success | name + `#leadEmail` |
| `mail_failed` | attempted | visible error with phone | not reached |
| honeypot tripped in JS | no | no request at all | generic |

### Log format

One JSON object per line appended to `data/config/logs/form_submissions.log` with `LOCK_EX`:
`time`, `event`, `ip` (first of `HTTP_CF_CONNECTING_IP`, `HTTP_X_FORWARDED_FOR`, `REMOTE_ADDR`),
`user_agent`, `referrer`, and an event-specific `payload`.

## The redirect and the thank-you page

Yes, there is a redirect, and it is the same for both forms: a client-side
`window.location.href = BASE + '/thank-you/'` fired only after the endpoint answers
`success: true` (which includes every soft-rejected submission). The endpoint itself never issues
an HTTP redirect; it only returns JSON.

`thank-you/index.php` then:

1. Loads `includes/config.php` and calls `cbd_session_start()` before any output.
2. Sends `Cache-Control: no-store, private`.
3. Reads `$_SESSION['cbd_lead']` and immediately `unset()`s it. The flash is one-shot: a refresh or
   a direct visit to `/thank-you/` shows the generic version of the page.
4. Escapes the name and email with `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')` and uses them to
   personalize the greeting and step 1 of the "What Happens Next?" block. The name prints
   whenever non-empty; the email prints only when the flash status is `qualified`, inside
   `<strong id="leadEmail">`.
5. Sets `$noindex = true`, which makes `includes/header.php` emit
   `<meta name="robots" content="noindex, nofollow">`.
6. Puts `data-lead-status` (`qualified` or `out_of_area`) on the wrapping `<section>` when a
   flash was present. Unlike the email this is not PII, so GTM may read it into the dataLayer
   for out-of-area demand reporting.

`store_lead_flash()` in the endpoint is what populates that session value; it is called on the
`mail_sent` path and on `zip_out_of_range`.

Legacy URL support: `.htaccess` line 12 issues a 301 from `thank-you.php` to `/thank-you/`, and
line 11 does the same for `contact.php` to `/contact/`.

## Notes and gotchas

- The reCAPTCHA site key is duplicated in three places: `includes/compact-form.php` (script tag),
  `assets/js/script.js` (`RECAPTCHA_SITE_KEY`), and `contact/index.php` (script tag and
  `grecaptcha.execute` call). The secret key is hardcoded at `data/config/process-contact.php`
  line 10.
- The compact form's `novalidate` means an empty required field produces a server round trip and a
  JSON error rather than a browser tooltip. The contact form catches it in the browser first.
- Adding a third form means adding its action name to `RECAPTCHA_ALLOWED_ACTIONS`, otherwise every
  submission is silently soft-rejected as a context mismatch and no mail is ever sent.
- `window.SITE_BASE` is set by an inline script in `includes/footer.php` (line 82) immediately
  before `script.js` is loaded (line 84), so the `(window.SITE_BASE || '')` fallback resolves to
  the real base path on localhost installs served from a subdirectory. A page that omits the
  footer would silently post to `/data/config/process-contact.php` at the document root.
