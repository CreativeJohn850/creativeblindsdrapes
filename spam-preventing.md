 Client-side (assets/js/script.js, form includes)

  1. Honeypot field — every form carries a hidden text input middleName (includes/contact-form.php:53,
  includes/compact-ctform.php:47, and the newsletter form). Before submitting, the JS reads it (script.js:259, :375,
  :437). If it's filled, the script shows a fake success message and returns without ever calling send-email.php — the
  bot thinks it succeeded.

  2. reCAPTCHA v3 Enterprise — grecaptcha.enterprise.execute(..., {action:'submit'}) runs on submit (script.js:179-192)
  and the token rides along in the JSON payload. Note: if grecaptcha isn't loaded, the JS sends an empty token rather
  than blocking.

  3. Submission logging — every attempt is POSTed to data/config/hpc.php (contact/compact) or npc.php (newsletter)
  before the real send. That logs timestamp, IP, referrer, HONEYPOT/NORMAL flag, and User-Agent to form-log.txt. It's
  forensic only, not enforcement.

  4. HTML validation — required on all fields plus type="email", and a <select> for project type.

  Server-side (data/config/send-email.php)

  5a. reCAPTCHA verification (:290-312) — hard gate. Missing token → 400; failed verification or score below 0.5 → 403
  and exit. (The comment says "disabled - was 0.4" but 0.5 is what's actually enforced.)

  5b. Soft rejections — these set $svt = false, which silently skips the LTS API post and the Brevo email, but the user
  still gets redirected to /m/pages/thank-you so the sender can't tell:

  - ZIP geo-fence (:247-257) — must be 5 digits in the Illinois range 60001–60900. Handles ZIP+4 from autocomplete by
  extracting the valid 5-digit part.