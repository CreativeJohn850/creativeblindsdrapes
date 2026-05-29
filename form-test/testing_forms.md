# Automated Form Testing with Test Email Routing

## Overview
Create a Selenium Python script to automatically test form submissions on 4 pages daily at 2am via Windows Task Scheduler, with test emails routed to a separate inbox and clearly marked in logs.

## Test Email Routing Solution

### Strategy: HTTP Header-Based Detection
Use custom HTTP header `X-Test-Mode: automation` to identify test submissions, enabling clean separation without changing form structure or business logic.

### Implementation Approach
1. **Test detection**: Check for `X-Test-Mode` header in send-email.php
2. **Email routing**: Use configuration file to route test emails to separate inbox
3. **Logging**: Mark all test submissions with `[TEST-AUTO]` prefix in logs
4. **reCAPTCHA**: Lower score threshold for test submissions to ensure automated tests pass

## Critical Files to Modify

### 1. `C:\wamp64\www\m\data\config\test-config.php` (NEW FILE)
Configuration file for test mode settings:
```php
<?php
return [
    'test_mode' => [
        'enabled' => true,
        'detection_methods' => [
            'header' => 'X-Test-Mode',
            'header_value' => 'automation'
        ]
    ],
    'email_routing' => [
        'production' => 'creativefloors.ads@gmail.com',
        'test' => 'test.automation@creativefloors.co'  // YOUR TEST INBOX
    ],
    'logging' => [
        'test_prefix' => '[TEST-AUTO]'
    ]
];
```

### 2. `C:\wamp64\www\m\data\config\send-email.php`
**Changes:**
- **Line 8-18**: Update `logDebug()` function to detect test mode and add `[TEST-AUTO]` prefix
- **After line 18**: Add new `isTestMode()` function to check for HTTP header
- **Line 20-22**: Add test mode logging when request starts
- **Line 107-132**: Lower reCAPTCHA threshold from 0.4 to 0.1 for test submissions
- **Line 150-154**: Replace hardcoded recipient email with configuration-based routing

**Key functions to add:**
```php
function isTestMode() {
    return isset($_SERVER['HTTP_X_TEST_MODE']) &&
           $_SERVER['HTTP_X_TEST_MODE'] === 'automation';
}
```

### 3. `C:\wamp64\www\m\data\config\hpc.php`
**Changes:**
- Update log entry to include `[TEST-AUTO]` prefix when test header detected

## Selenium Python Script

### File Structure
Create new directory and files:
```
C:\wamp64\www\m\tests\
├── form_tester.py          # Main script
├── test_data.json          # Test data for forms
├── config.ini              # Configuration
├── requirements.txt        # Python dependencies
├── setup.bat               # Setup script
├── run_form_tests.bat      # Execution batch file
├── logs\                   # Log directory
├── screenshots\            # Error screenshots
└── reports\                # HTML reports
```

### Test Data (test_data.json)
```json
{
  "base_url": "http://localhost/m",
  "forms": {
    "compact": {
      "fullName": "Selenium Test User",
      "contactemail": "selenium.test@creativefloors.co",
      "phone": "630-555-0123",
      "project": "Hardwood Installation - Automated Test",
      "consent": true
    },
    "contact": {
      "firstName": "Selenium",
      "lastName": "Tester",
      "contactemail": "selenium.test@creativefloors.co",
      "phone": "630-555-0456",
      "location": "Aurora",
      "zip": "60502",
      "project": "Carpet Installation - Automated Test",
      "sqft": "500"
    }
  }
}
```

### Script Features
1. **Chrome WebDriver** with headless mode (using webdriver-manager for auto-updates)
2. **Custom HTTP header injection** via Chrome DevTools Protocol: `X-Test-Mode: automation`
3. **Form filling logic** for compact form (home/city pages) and contact form
4. **reCAPTCHA handling** via user-agent bypass (server detects `SeleniumTest/1.0` and lowers threshold)
5. **Wait strategies** for AJAX submissions and redirect to thank-you page
6. **Retry logic** with 3 attempts and 5-second delays
7. **Screenshot capture** on failures for debugging
8. **Comprehensive logging** to both console and rotating log files
9. **HTML report generation** with test summary

### Pages to Test
1. `/index.php` (home page - compact form)
2. `/flooring-aurora.php` (city page - compact form)
3. `/flooring-naperville.php` (city page - compact form)
4. `/pages/contact.php` (contact page - full form)

### Key Form Elements
**Compact Form (compactCtForm):**
- Fields: `#fullName`, `#contactemail`, `#phone`, `#project`, `#consent`
- Honeypot: `#middle` (must leave empty)
- Submit: `#submit-h`
- ZIP: Hardcoded to 60002 by JavaScript

**Contact Form (contactForm):**
- Fields: `#firstName`, `#lastName`, `#contactemail`, `#phone`, `#location`, `#zip`, `#project`, `#sqft`
- Optional: `#comments`, `#subscribe`
- Honeypot: `#middle` (must leave empty)
- Submit: `#submit-c`
- ZIP: User-provided, must be 60001-60900

## Windows Task Scheduler Setup

### Batch File (run_form_tests.bat)
```batch
@echo off
cd /d C:\wamp64\www\m\tests
python form_tester.py

if %ERRORLEVEL% EQU 0 (
    echo Test completed successfully at %date% %time% >> execution_log.txt
) else (
    echo Test FAILED at %date% %time% >> execution_log.txt
)
```

### Task Configuration
- **Name**: Creative Floors Form Testing
- **Trigger**: Daily at 2:00 AM
- **Action**: Run `C:\wamp64\www\m\tests\run_form_tests.bat`
- **Settings**: Run with highest privileges, wake computer if needed

## Python Dependencies
```
selenium==4.17.2
webdriver-manager==4.0.1
python-dotenv==1.0.1
```

## Implementation Steps

### Step 1: Create Test Configuration
1. Create `data/config/test-config.php` with email routing settings
2. Update `test.automation@creativefloors.co` to your actual test inbox

### Step 2: Modify PHP Email Handler
1. Update `data/config/send-email.php`:
   - Add `isTestMode()` function
   - Update `logDebug()` to mark test logs
   - Add configuration loading
   - Update recipient selection logic
   - Lower reCAPTCHA threshold for tests
2. Update `data/config/hpc.php` to mark test logs

### Step 3: Create Python Test Script
1. Create directory `C:\wamp64\www\m\tests\`
2. Create `form_tester.py` with:
   - FormTester class with setup_driver(), test_compact_form(), test_contact_form()
   - Chrome WebDriver with CDP header injection
   - Form filling and submission logic
   - Wait for redirect to thank-you page
   - Screenshot capture on failure
   - Comprehensive logging
3. Create `test_data.json` with form field values
4. Create `requirements.txt` with dependencies

### Step 4: Setup Python Environment
1. Create `setup.bat` to install dependencies
2. Run setup to create virtual environment
3. Test script manually: `python form_tester.py`

### Step 5: Configure Task Scheduler
1. Create `run_form_tests.bat` batch file
2. Test batch file manually
3. Create scheduled task for 2am daily execution
4. Verify task runs successfully

## Verification

### After Implementation
1. **Test manually**: Run `python form_tester.py` and verify:
   - Forms submit successfully
   - Logs show `[TEST-AUTO]` prefix
   - Email arrives at test inbox (not production)
   - Thank-you page redirects work

2. **Check logs**: Review `data/config/log.txt`:
   - Look for `[TEST-AUTO]` markers
   - Verify email routing to test address
   - Confirm reCAPTCHA passing

3. **Test scheduler**: Run task manually from Task Scheduler
   - Verify execution_log.txt updates
   - Check test results in logs directory

### Daily Monitoring
- Review `C:\wamp64\www\m\tests\logs\form_test_<date>.log` for errors
- Check test inbox for 4 emails received
- Monitor execution_log.txt for task completion

## Trade-offs and Decisions

### Header-Based Detection (Chosen)
**Pros**: Clean, no form changes, easy to toggle
**Cons**: Requires CDP in Selenium
**Alternative**: Email suffix pattern (e.g., test+automation@...) - rejected as less flexible

### Single Log with Markers (Chosen)
**Pros**: Maintains chronology, easy filtering with `grep -v '\[TEST-AUTO\]'`
**Cons**: Slightly larger log file
**Alternative**: Separate test log - rejected as fragments logging

### reCAPTCHA Threshold Lowering (Chosen)
**Pros**: Simple, reliable, works for 2am automation
**Cons**: Less realistic test (but acceptable for smoke testing)
**Alternative**: 2captcha API - rejected due to cost ($1-3 per 1000 solves)

## Key Insights from Exploration

### Form Submission Flow
1. User fills form → JavaScript validates
2. Honeypot check (middleName field must be empty)
3. reCAPTCHA Enterprise token generated via `grecaptcha.enterprise.execute()`
4. POST to `/m/data/config/send-email.php` with JSON payload
5. Server validates ZIP (60001-60900), email blocklist, reCAPTCHA score
6. Session stores svt flag (success/failure)
7. Sends via Brevo API to recipient email
8. Redirects to `/m/pages/thank-you.php`

### Critical Form Details
- **Honeypot**: `middleName` hidden field - bots fill it, real users don't
- **ZIP validation**: Must be 5 digits in range 60001-60900 (IL only)
- **Compact form ZIP**: Hardcoded to 60002 in JavaScript (line 315 of script.js)
- **reCAPTCHA**: Enterprise v3 with sitekey `6LcqVmAsAAAAADFkLtrax3a15oLlkcIigcpgRBmO`
- **Success indicator**: Redirect to `/m/pages/thank-you.php` with session svt=true

## Files Referenced
- `C:\wamp64\www\m\includes\compact-ctform.php` - Compact form structure
- `C:\wamp64\www\m\includes\contact-form.php` - Full contact form structure
- `C:\wamp64\www\m\assets\js\script.js` - Form submission JavaScript (lines 58-356)
- `C:\wamp64\www\m\data\config\send-email.php` - Email processing backend
- `C:\wamp64\www\m\data\config\hpc.php` - Form submission logging
- `C:\wamp64\www\m\pages\thank-you.php` - Success page with svt check
