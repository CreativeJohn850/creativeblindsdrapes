// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.querySelector('.nav-menu');
    const body = document.body;
    
    // Create overlay element
    const overlay = document.createElement('div');
    overlay.className = 'nav-overlay';
    body.appendChild(overlay);
    
    // Toggle menu function
    function toggleMenu() {
        mobileToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
        overlay.classList.toggle('active');
        
        // Prevent body scroll when menu is open
        if (navMenu.classList.contains('active')) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = '';
        }
    }
    
    // Toggle on button click
    if (mobileToggle) {
        mobileToggle.addEventListener('click', toggleMenu);
    }
    
    // Close menu when overlay is clicked
    overlay.addEventListener('click', toggleMenu);
    
    // Close menu when a nav link is clicked
    const navLinks = navMenu.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                toggleMenu();
            }
        });
    });
    
    // Close menu on window resize if switching to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && navMenu.classList.contains('active')) {
            toggleMenu();
        }
    });
});

// Compact Quote Panel
document.addEventListener('DOMContentLoaded', function () {
    const trigger = document.getElementById('cqTrigger');
    const panel   = document.getElementById('cqPanel');
    const form    = document.getElementById('compactQuoteForm');
    const submitBtn = document.getElementById('cqSubmitBtn');
    const msgEl   = document.getElementById('cqMsg');

    if (!trigger || !panel) return;

    const RECAPTCHA_SITE_KEY = '6LdOMk0sAAAAAMnWfjTV2JtpuimpVL5N8Qql_qc4';

    function setPanelTop() {
        var siteHeader = document.querySelector('.site-header');
        if (!siteHeader) return;
        var headerBottom = Math.round(siteHeader.getBoundingClientRect().bottom);
        panel.style.top = headerBottom + 'px';
        // Limit height to available viewport so form is never cut off on short screens
        panel.style.maxHeight = Math.min(560, window.innerHeight - headerBottom - 8) + 'px';
    }

    function openPanel() {
        setPanelTop();
        panel.classList.add('open');
        panel.setAttribute('aria-hidden', 'false');
        trigger.setAttribute('aria-expanded', 'true');
    }

    function closePanel() {
        // Clear the inline max-height so the CSS max-height:0 transition fires correctly
        panel.style.maxHeight = '';
        panel.classList.remove('open');
        panel.setAttribute('aria-hidden', 'true');
        trigger.setAttribute('aria-expanded', 'false');
    }

    // Keep panel anchored on scroll/resize while open
    window.addEventListener('scroll', function () {
        if (panel.classList.contains('open')) setPanelTop();
    }, { passive: true });
    window.addEventListener('resize', function () {
        if (panel.classList.contains('open')) setPanelTop();
    });

    trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        if (panel.classList.contains('open')) {
            closePanel();
        } else {
            // Close mobile nav before opening panel
            var navMenu = document.querySelector('.nav-menu');
            if (navMenu && navMenu.classList.contains('active')) {
                var mobileToggle = document.getElementById('mobileToggle');
                if (mobileToggle) mobileToggle.click();
            }
            openPanel();
        }
    });

    document.addEventListener('click', function (e) {
        if (panel.classList.contains('open') &&
            !panel.contains(e.target) &&
            e.target !== trigger &&
            !trigger.contains(e.target)) {
            closePanel();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closePanel();
    });

    if (!form) return;

    // Live ZIP hint — mirrors the server-side range check in process-contact.php
    var zipInput = document.getElementById('cqZip');
    var zipHint  = document.getElementById('cqZipHint');

    function parseZip(raw) {
        var val = raw.trim();
        // Handle ZIP+4 (e.g. 60504-1234) — extract the 5-digit base
        if (/^\d{5}-\d{4}$/.test(val)) val = val.slice(0, 5);
        return val;
    }

    function validateZip(raw) {
        var zip = parseZip(raw);
        if (!/^\d{5}$/.test(zip)) return 'invalid';
        var n = parseInt(zip, 10);
        if (n < 60001 || n > 60900) return 'outofrange';
        return 'ok';
    }

    if (zipInput) zipInput.addEventListener('blur', function () {
        var result = validateZip(zipInput.value);
        if (zipInput.value === '') {
            zipHint.textContent = '';
            zipHint.className = 'cq-zip-hint';
        } else if (result === 'invalid') {
            zipHint.textContent = 'Please enter a valid 5-digit ZIP code.';
            zipHint.className = 'cq-zip-hint cq-zip-hint--error';
        } else if (result === 'outofrange') {
            zipHint.textContent = 'We serve the Aurora area (60001–60900). Call us for availability.';
            zipHint.className = 'cq-zip-hint cq-zip-hint--warn';
        } else {
            zipHint.textContent = '';
            zipHint.className = 'cq-zip-hint';
        }
    });

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Honeypot — silent fake success if bot filled the hidden field
        if (document.getElementById('cqHoneypot').value) {
            window.location.href = 'thank-you.php';
            return; // no params — bots don't deserve a personalized page
        }

        // Client-side ZIP validation before hitting the server
        var zipResult = validateZip(zipInput.value);
        if (zipResult === 'invalid') {
            showMsg('error', 'Please enter a valid 5-digit ZIP code.');
            zipInput.focus();
            return;
        }
        if (zipResult === 'outofrange') {
            showMsg('error', 'We serve the Aurora area (60001–60900). Please call us for availability.');
            zipInput.focus();
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending…';
        msgEl.className = 'cq-msg';
        msgEl.textContent = '';

        try {
            const token = await new Promise(function (resolve, reject) {
                grecaptcha.ready(function () {
                    grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: 'compact_quote' })
                        .then(resolve).catch(reject);
                });
            });
            document.getElementById('cqRecaptchaToken').value = token;

            const res  = await fetch('data/config/process-contact.php', {
                method: 'POST',
                body: new FormData(form)
            });
            const data = await res.json();

            if (data.success) {
                const name  = encodeURIComponent(document.getElementById('cqName').value.trim());
                const email = encodeURIComponent(document.getElementById('cqEmail').value.trim());
                window.location.href = 'thank-you.php?name=' + name + '&email=' + email;
            } else {
                showMsg('error', data.message || 'Something went wrong. Please try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Get Quote';
            }
        } catch (_) {
            showMsg('error', 'Connection error. Please call us directly.');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Get Quote';
        }
    });

    function showMsg(type, text) {
        msgEl.className = 'cq-msg ' + type;
        msgEl.textContent = text;
    }
});

// Hero Slider (if exists on page)
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    
    if (slides.length === 0) return; // Exit if no slider on page
    
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds
    
    function showSlide(index) {
        // Remove active from all
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Add active to current
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }
    
    // Auto advance slides
    let slideTimer = setInterval(nextSlide, slideInterval);
    
    // Manual navigation with dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            currentSlide = index;
            showSlide(currentSlide);
            
            // Reset timer
            clearInterval(slideTimer);
            slideTimer = setInterval(nextSlide, slideInterval);
        });
    });
});