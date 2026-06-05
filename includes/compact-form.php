<div class="cq-panel" id="cqPanel" aria-hidden="true">
    <div class="cq-panel-inner">
        <p class="cq-title">Request a Free Estimate</p>
        <form id="compactQuoteForm" novalidate>
            <div class="cq-row">
                <div class="cq-field">
                    <input type="text" name="name" id="cqName"
                           placeholder="Full Name *" required autocomplete="name">
                </div>
                <div class="cq-field">
                    <input type="email" name="email" id="cqEmail"
                           placeholder="Email *" required autocomplete="email">
                </div>
            </div>
            <div class="cq-row">
                <div class="cq-field">
                    <input type="tel" name="phone" id="cqPhone"
                           placeholder="Phone *" required autocomplete="tel">
                </div>
                <div class="cq-field cq-field--zip">
                    <input type="text" name="zip" id="cqZip"
                           placeholder="ZIP Code *" required maxlength="10" autocomplete="postal-code">
                    <span class="cq-zip-hint" id="cqZipHint"></span>
                </div>
                <div class="cq-field">
                    <select name="service" id="cqService" required>
                        <option value="" disabled selected>Interested In *</option>
                        <option value="Shutters">Shutters</option>
                        <option value="Blinds">Blinds</option>
                        <option value="Shades">Shades</option>
                        <option value="Drapes &amp; Curtains">Drapes &amp; Curtains</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <!-- Honeypot — invisible to humans, bots fill it -->
            <input type="text" name="middleName" id="cqHoneypot"
                   style="display:none" tabindex="-1" autocomplete="off">
            <input type="hidden" name="recaptcha_token" id="cqRecaptchaToken">
            <div class="cq-row cq-bottom-row">
                <label class="cq-consent">
                    <input type="checkbox" name="consent" id="cqConsent" required>
                    I consent to being contacted for a quote.
                </label>
                <button type="submit" class="btn btn-primary cq-submit" id="cqSubmitBtn">Get Quote</button>
            </div>
            <div class="cq-msg" id="cqMsg" aria-live="polite"></div>
        </form>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render=6LdOMk0sAAAAAMnWfjTV2JtpuimpVL5N8Qql_qc4" async defer></script>
