/**
 * Weisdom Design Build - Off-Canvas Drawers & Forms Controller
 * Handles:
 * 1. Download Brochure Side Drawer
 * 2. Schedule Site Visit Side Drawer with DPDP Act 2023 Explicit Consent
 * 3. Two-Step Email OTP Verification for Site Visit
 * 4. Client-side Validation, LocalStorage Lead Ledger, and Instant PDF Trigger
 * 5. Integration with WeisdomMailer (Resend & Cloudflare Pages static architecture)
 */

(function () {
    'use strict';

    // ── Determine Base Prefix for Brochure PDF and Internal Links ──────────
    function getRootPrefix() {
        const path = window.location.pathname;
        if (path.includes('/ample-living/amenities/') || path.includes('/ample-living/family-life/')) {
            return '../../';
        } else if (path.includes('/ample-living/') || path.includes('/ampleton/') || path.includes('/connect/') || path.includes('/privacy-policy/') || path.includes('/rera-policy/') || path.includes('/admin/')) {
            return '../';
        }
        return './';
    }

    // ── Build HTML Template for Drawers ────────────────────────────────────
    function createDrawersHTML(rootPrefix) {
        return `
        <!-- Overlay Backdrop -->
        <div class="ws-drawer-overlay" id="wsDrawerOverlay"></div>

        <!-- 1. DOWNLOAD BROCHURE DRAWER -->
        <aside class="ws-drawer" id="wsDrawerBrochure" aria-hidden="true" role="dialog" aria-labelledby="wsBrochureTitle">
            <div class="ws-drawer-header">
                <div class="ws-drawer-title-group">
                    <span class="ws-drawer-tag">Weisdom Design Build</span>
                    <h3 class="ws-drawer-title" id="wsBrochureTitle">Download Brochure</h3>
                    <p class="ws-drawer-sub">Get instant access to complete architectural layouts & project specs.</p>
                </div>
                <button type="button" class="ws-drawer-close" aria-label="Close drawer" data-ws-close>
                    <svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                </button>
            </div>

            <div class="ws-drawer-body">
                <form id="wsBrochureForm" novalidate>
                    <div class="ws-form-group" id="group-b-name">
                        <label class="ws-label" for="ws-b-name">Full Name <span class="required">*</span></label>
                        <input type="text" id="ws-b-name" class="ws-input" placeholder="Enter your full name" required autocomplete="name">
                        <span class="ws-error-msg">Please enter your full name.</span>
                    </div>

                    <div class="ws-form-group" id="group-b-email">
                        <label class="ws-label" for="ws-b-email">Email Address <span class="required">*</span></label>
                        <input type="email" id="ws-b-email" class="ws-input" placeholder="name@domain.com" required autocomplete="email">
                        <span class="ws-error-msg">Please enter a valid email address.</span>
                    </div>

                    <div class="ws-form-group" id="group-b-phone">
                        <label class="ws-label" for="ws-b-phone">Mobile Number <span class="required">*</span></label>
                        <input type="tel" id="ws-b-phone" class="ws-input" placeholder="+91 98765 43210" required autocomplete="tel">
                        <span class="ws-error-msg">Please enter a valid 10-digit mobile number.</span>
                    </div>

                    <div class="ws-form-group" id="group-b-project">
                        <label class="ws-label" for="ws-b-project">Select Project <span class="required">*</span></label>
                        <select id="ws-b-project" class="ws-select" required>
                            <option value="Ample Living" selected>Ample Living — Kudasan, Gandhinagar (Active)</option>
                            <option value="Ampleton">Ampleton — Commercial & Living (Coming Soon)</option>
                        </select>
                    </div>

                    <!-- DPDP Act 2023 Explicit Consent (Unchecked by Default) -->
                    <div class="ws-checkbox-group" id="group-b-consent">
                        <div class="ws-checkbox-inner">
                            <input type="checkbox" id="ws-b-consent">
                            <label for="ws-b-consent">
                                I consent to Weisdom Design Build storing my contact details and sending brochure copy, architectural layouts &amp; construction updates via Email &amp; WhatsApp in accordance with the <strong>DPDP Act 2023</strong>. I agree to the <a href="${rootPrefix}privacy-policy/" target="_blank">Privacy Policy</a> &amp; <a href="${rootPrefix}rera-policy/" target="_blank">Terms</a>.
                            </label>
                        </div>
                        <span class="ws-error-msg">Consent is required under DPDP Act 2023 to download brochure.</span>
                    </div>

                    <button type="submit" class="ws-btn-submit" id="wsBrochureSubmit">
                        <span class="ws-spinner"></span>
                        <span>Get Instant Brochure</span>
                    </button>
                    <p class="ws-privacy-note">Your privacy is respected. No spam, ever.</p>
                </form>

                <!-- Success State -->
                <div class="ws-drawer-success" id="wsBrochureSuccess">
                    <div class="ws-success-ring">✓</div>
                    <h3 class="ws-success-title">Brochure Dispatched!</h3>
                    <p class="ws-success-desc" id="wsBrochureSuccessDesc">
                        Your download has started. A digital copy has also been sent to your email.
                    </p>
                    <button type="button" class="ws-btn-done" data-ws-close>Done</button>
                </div>
            </div>
        </aside>

        <!-- 2. SCHEDULE SITE VISIT DRAWER -->
        <aside class="ws-drawer" id="wsDrawerVisit" aria-hidden="true" role="dialog" aria-labelledby="wsVisitTitle">
            <div class="ws-drawer-header">
                <div class="ws-drawer-title-group">
                    <span class="ws-drawer-tag">Weisdom Design Build</span>
                    <h3 class="ws-drawer-title" id="wsVisitTitle">Schedule Site Visit</h3>
                    <p class="ws-drawer-sub">Experience our architecture, layout, and site progress firsthand.</p>
                </div>
                <button type="button" class="ws-drawer-close" aria-label="Close drawer" data-ws-close>
                    <svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                </button>
            </div>

            <div class="ws-drawer-body">
                <!-- Step 1: Initial Form -->
                <form id="wsVisitForm" novalidate>
                    <div class="ws-form-group" id="group-v-name">
                        <label class="ws-label" for="ws-v-name">Full Name <span class="required">*</span></label>
                        <input type="text" id="ws-v-name" class="ws-input" placeholder="Enter your full name" required autocomplete="name">
                        <span class="ws-error-msg">Please enter your full name.</span>
                    </div>

                    <div class="ws-form-row">
                        <div class="ws-form-group" id="group-v-email">
                            <label class="ws-label" for="ws-v-email">Email Address <span class="required">*</span></label>
                            <input type="email" id="ws-v-email" class="ws-input" placeholder="name@domain.com" required autocomplete="email">
                            <span class="ws-error-msg">Please enter a valid email address.</span>
                        </div>
                        <div class="ws-form-group" id="group-v-phone">
                            <label class="ws-label" for="ws-v-phone">Mobile Number <span class="required">*</span></label>
                            <input type="tel" id="ws-v-phone" class="ws-input" placeholder="+91 98765 43210" required autocomplete="tel">
                            <span class="ws-error-msg">Valid 10-digit phone required.</span>
                        </div>
                    </div>

                    <div class="ws-form-group" id="group-v-project">
                        <label class="ws-label" for="ws-v-project">Select Project <span class="required">*</span></label>
                        <select id="ws-v-project" class="ws-select" required>
                            <option value="Ample Living" selected>Ample Living — Kudasan Highway, Gandhinagar</option>
                            <option value="Ampleton">Ampleton — Commercial & Living (Upcoming)</option>
                        </select>
                    </div>

                    <div class="ws-form-row">
                        <div class="ws-form-group" id="group-v-date">
                            <label class="ws-label" for="ws-v-date">Preferred Date <span class="required">*</span></label>
                            <input type="date" id="ws-v-date" class="ws-input" required>
                            <span class="ws-error-msg">Select a visit date.</span>
                        </div>
                        <div class="ws-form-group" id="group-v-time">
                            <label class="ws-label" for="ws-v-time">Time Slot <span class="required">*</span></label>
                            <select id="ws-v-time" class="ws-select" required>
                                <option value="10:00 AM - 12:00 PM">Morning (10:00 AM – 12:00 PM)</option>
                                <option value="02:00 PM - 04:00 PM" selected>Afternoon (02:00 PM – 04:00 PM)</option>
                                <option value="04:00 PM - 06:00 PM">Evening (04:00 PM – 06:00 PM)</option>
                            </select>
                        </div>
                    </div>

                    <div class="ws-form-group">
                        <label class="ws-label" for="ws-v-notes">Questions or Requirements (Optional)</label>
                        <textarea id="ws-v-notes" class="ws-textarea" placeholder="E.g. Interested in 3BHK or 4BHK units, floor preferences, etc."></textarea>
                    </div>

                    <!-- DPDP Act 2023 Explicit Consent (Unchecked by Default) -->
                    <div class="ws-checkbox-group" id="group-v-consent">
                        <div class="ws-checkbox-inner">
                            <input type="checkbox" id="ws-v-consent">
                            <label for="ws-v-consent">
                                I authorize Weisdom Design Build to contact me via Email, Call &amp; WhatsApp regarding my site visit appointment in compliance with the <strong>DPDP Act 2023</strong>. I agree to the <a href="${rootPrefix}privacy-policy/" target="_blank">Privacy Policy</a> &amp; <a href="${rootPrefix}rera-policy/" target="_blank">Terms</a>.
                            </label>
                        </div>
                        <span class="ws-error-msg">Consent is mandatory under DPDP Act 2023 before scheduling.</span>
                    </div>

                    <button type="submit" class="ws-btn-submit" id="wsVisitSubmit">
                        <span class="ws-spinner"></span>
                        <span>Schedule Visit &amp; Verify Email</span>
                    </button>
                    <p class="ws-privacy-note">Site Address: Ample Living, Kudasan-Koba Highway, Gandhinagar.</p>
                </form>

                <!-- Step 2: Email OTP Verification Screen -->
                <div class="ws-otp-screen" id="wsVisitOtpStep">
                    <div class="ws-otp-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                    </div>
                    <h3 class="ws-otp-title">Verify Your Email</h3>
                    <p class="ws-otp-desc">
                        We have sent a 6-digit verification code to<br>
                        <strong id="wsOtpEmailDisplay">name@example.com</strong>
                    </p>

                    <div class="ws-otp-box">
                        <input type="text" id="ws-v-otp" class="ws-otp-input" maxlength="6" inputmode="numeric" pattern="[0-9]*" placeholder="······" autocomplete="one-time-code">
                        <div class="ws-otp-error" id="wsOtpError">Invalid code. Please enter the 6-digit OTP sent to your email.</div>
                    </div>

                    <button type="button" class="ws-btn-submit" id="wsVisitOtpSubmit">
                        <span class="ws-spinner"></span>
                        <span>Confirm &amp; Book Appointment</span>
                    </button>

                    <div class="ws-otp-meta">
                        <span id="wsOtpTimerText">Resend code in <strong id="wsOtpCountdown">30s</strong></span>
                        <button type="button" class="ws-otp-resend" id="wsOtpResendBtn" style="display:none;">Resend OTP Code</button>
                    </div>

                    <div>
                        <button type="button" class="ws-back-link" id="wsOtpBackBtn">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                            <span>Edit Contact Details</span>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Success State -->
                <div class="ws-drawer-success" id="wsVisitSuccess">
                    <div class="ws-success-ring">✓</div>
                    <h3 class="ws-success-title">Site Visit Confirmed!</h3>
                    <p class="ws-success-desc" id="wsVisitSuccessDesc">
                        Thank you. Your site visit appointment has been verified and confirmed. A confirmation with site directions has been sent to your email.
                    </p>
                    <button type="button" class="ws-btn-done" data-ws-close>Done</button>
                </div>
            </div>
        </aside>
        `;
    }

    // ── State Variables ────────────────────────────────────────────────────
    let overlay, drawerBrochure, drawerVisit;
    let activeDrawer = null;

    // Site Visit Pending State for OTP Step
    let pendingVisitData = null;
    let activeOtpCode = null;
    let otpTimerInterval = null;
    let otpCountdownSeconds = 30;

    // ── Open / Close Functions ─────────────────────────────────────────────
    function openDrawer(drawerId, preselectedProject) {
        if (!overlay) return;
        const targetDrawer = document.getElementById(drawerId);
        if (!targetDrawer) return;

        // If another drawer is active, close it first
        if (activeDrawer && activeDrawer !== targetDrawer) {
            activeDrawer.classList.remove('active');
            activeDrawer.setAttribute('aria-hidden', 'true');
        }

        // Preselect project if passed
        if (preselectedProject) {
            if (drawerId === 'wsDrawerBrochure') {
                const sel = document.getElementById('ws-b-project');
                if (sel) sel.value = preselectedProject;
            } else if (drawerId === 'wsDrawerVisit') {
                const sel = document.getElementById('ws-v-project');
                if (sel) sel.value = preselectedProject;
            }
        }

        activeDrawer = targetDrawer;
        overlay.classList.add('active');
        targetDrawer.classList.add('active');
        targetDrawer.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Focus first input
        setTimeout(() => {
            const firstInput = targetDrawer.querySelector('input:not([type="hidden"]):not([type="checkbox"]), select');
            if (firstInput) firstInput.focus();
        }, 150);
    }

    function closeAllDrawers() {
        if (overlay) overlay.classList.remove('active');
        if (activeDrawer) {
            activeDrawer.classList.remove('active');
            activeDrawer.setAttribute('aria-hidden', 'true');
            activeDrawer = null;
        }
        document.body.style.overflow = '';
    }

    // ── Validation Helpers ─────────────────────────────────────────────────
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function isValidPhone(phone) {
        const clean = phone.replace(/[^0-9]/g, '');
        return clean.length >= 10 && clean.length <= 13;
    }

    function setFieldError(groupId, hasErr) {
        const el = document.getElementById(groupId);
        if (el) el.classList.toggle('has-error', hasErr);
    }

    // ── Save Lead to LocalStorage Ledger (Static Store for Admin) ──────────
    function saveLeadToLedger(lead) {
        try {
            const list = JSON.parse(localStorage.getItem('weisdom_leads') || '[]');
            lead.id = lead.id || 'lead_' + Date.now();
            lead.created_at = new Date().toISOString();
            list.unshift(lead);
            localStorage.setItem('weisdom_leads', JSON.stringify(list));
        } catch (e) {
            console.error('LocalStorage error:', e);
        }
    }

    // ── OTP Timer Helpers ──────────────────────────────────────────────────
    function startOtpCountdown() {
        clearInterval(otpTimerInterval);
        otpCountdownSeconds = 30;

        const countdownEl = document.getElementById('wsOtpCountdown');
        const timerTextEl = document.getElementById('wsOtpTimerText');
        const resendBtn = document.getElementById('wsOtpResendBtn');

        if (timerTextEl) timerTextEl.style.display = 'inline';
        if (resendBtn) resendBtn.style.display = 'none';
        if (countdownEl) countdownEl.textContent = `${otpCountdownSeconds}s`;

        otpTimerInterval = setInterval(() => {
            otpCountdownSeconds--;
            if (countdownEl) countdownEl.textContent = `${otpCountdownSeconds}s`;

            if (otpCountdownSeconds <= 0) {
                clearInterval(otpTimerInterval);
                if (timerTextEl) timerTextEl.style.display = 'none';
                if (resendBtn) {
                    resendBtn.style.display = 'inline';
                    resendBtn.disabled = false;
                }
            }
        }, 1000);
    }

    function generate6DigitOtp() {
        return Math.floor(100000 + Math.random() * 900000).toString();
    }

    // ── Initialize ─────────────────────────────────────────────────────────
    function init() {
        const rootPrefix = getRootPrefix();

        // Inject drawer HTML once into body
        const container = document.createElement('div');
        container.id = 'ws-drawers-container';
        container.innerHTML = createDrawersHTML(rootPrefix);
        document.body.appendChild(container);

        overlay = document.getElementById('wsDrawerOverlay');
        drawerBrochure = document.getElementById('wsDrawerBrochure');
        drawerVisit = document.getElementById('wsDrawerVisit');

        // Set minimum date to today for Site Visit
        const dateInput = document.getElementById('ws-v-date');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.min = today;
            dateInput.value = today;
        }

        // Close triggers
        overlay.addEventListener('click', closeAllDrawers);
        document.querySelectorAll('[data-ws-close]').forEach(btn => {
            btn.addEventListener('click', closeAllDrawers);
        });

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && activeDrawer) {
                closeAllDrawers();
            }
        });

        // Live Consent Checkbox Error Reset
        const brochureConsent = document.getElementById('ws-b-consent');
        if (brochureConsent) {
            brochureConsent.addEventListener('change', () => {
                if (brochureConsent.checked) setFieldError('group-b-consent', false);
            });
        }

        const visitConsent = document.getElementById('ws-v-consent');
        if (visitConsent) {
            visitConsent.addEventListener('change', () => {
                if (visitConsent.checked) setFieldError('group-v-consent', false);
            });
        }

        // Delegate Click Listeners for Trigger Buttons
        document.addEventListener('click', (e) => {
            const brochureTrigger = e.target.closest('.open-brochure-drawer, [data-open-brochure]');
            if (brochureTrigger) {
                e.preventDefault();
                const project = brochureTrigger.getAttribute('data-project') || 'Ample Living';
                openDrawer('wsDrawerBrochure', project);
                return;
            }

            const visitTrigger = e.target.closest('.open-visit-drawer, [data-open-visit]');
            if (visitTrigger) {
                e.preventDefault();
                const project = visitTrigger.getAttribute('data-project') || 'Ample Living';
                openDrawer('wsDrawerVisit', project);
                return;
            }
        });

        // ── Handle Brochure Form Submit ────────────────────────────────────
        const brochureForm = document.getElementById('wsBrochureForm');
        if (brochureForm) {
            brochureForm.addEventListener('submit', async function (e) {
                e.preventDefault();

                const name = document.getElementById('ws-b-name').value.trim();
                const email = document.getElementById('ws-b-email').value.trim();
                const phone = document.getElementById('ws-b-phone').value.trim();
                const project = document.getElementById('ws-b-project').value;
                const consentChecked = document.getElementById('ws-b-consent').checked;

                let hasError = false;
                if (!name || name.length < 2) { setFieldError('group-b-name', true); hasError = true; } else { setFieldError('group-b-name', false); }
                if (!isValidEmail(email)) { setFieldError('group-b-email', true); hasError = true; } else { setFieldError('group-b-email', false); }
                if (!isValidPhone(phone)) { setFieldError('group-b-phone', true); hasError = true; } else { setFieldError('group-b-phone', false); }
                if (!consentChecked) { setFieldError('group-b-consent', true); hasError = true; } else { setFieldError('group-b-consent', false); }

                if (hasError) return;

                const submitBtn = document.getElementById('wsBrochureSubmit');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                const pdfUrl = rootPrefix + 'ample-living/ample-living.pdf';
                const absoluteBrochureUrl = new URL(pdfUrl, window.location.href).href;

                const leadPayload = {
                    type: 'brochure_download',
                    name,
                    email,
                    phone,
                    project,
                    dpdp_consent: true,
                    dpdp_timestamp: new Date().toISOString(),
                    source: window.location.pathname
                };

                // Save locally for admin ledger
                saveLeadToLedger(leadPayload);

                // Dispatch global event
                window.dispatchEvent(new CustomEvent('weisdom:lead_submitted', { detail: leadPayload }));

                // Dispatch emails via WeisdomMailer if available
                if (window.WeisdomMailer) {
                    window.WeisdomMailer.sendBrochureDownload(leadPayload, absoluteBrochureUrl);
                }

                // Instant download of brochure PDF in visitor's browser
                const tempLink = document.createElement('a');
                tempLink.href = pdfUrl;
                tempLink.download = 'Weisdom-Ample-Living-Brochure.pdf';
                tempLink.target = '_blank';
                document.body.appendChild(tempLink);
                tempLink.click();
                document.body.removeChild(tempLink);

                // Complete state transition to success screen
                setTimeout(() => {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    brochureForm.style.display = 'none';
                    const success = document.getElementById('wsBrochureSuccess');
                    const desc = document.getElementById('wsBrochureSuccessDesc');
                    if (desc) {
                        desc.innerHTML = `Thank you <strong>${name}</strong>. Your brochure download has started. A digital copy has also been sent to <strong>${email}</strong>.`;
                    }
                    if (success) success.style.display = 'block';
                }, 400);
            });
        }

        // ── Handle Site Visit Form Submit (Step 1: Validate & Trigger OTP) ──
        const visitForm = document.getElementById('wsVisitForm');
        if (visitForm) {
            visitForm.addEventListener('submit', async function (e) {
                e.preventDefault();

                const name = document.getElementById('ws-v-name').value.trim();
                const email = document.getElementById('ws-v-email').value.trim();
                const phone = document.getElementById('ws-v-phone').value.trim();
                const project = document.getElementById('ws-v-project').value;
                const date = document.getElementById('ws-v-date').value;
                const time = document.getElementById('ws-v-time').value;
                const notes = document.getElementById('ws-v-notes').value.trim();
                const consentChecked = document.getElementById('ws-v-consent').checked;

                let hasError = false;
                if (!name || name.length < 2) { setFieldError('group-v-name', true); hasError = true; } else { setFieldError('group-v-name', false); }
                if (!isValidEmail(email)) { setFieldError('group-v-email', true); hasError = true; } else { setFieldError('group-v-email', false); }
                if (!isValidPhone(phone)) { setFieldError('group-v-phone', true); hasError = true; } else { setFieldError('group-v-phone', false); }
                if (!date) { setFieldError('group-v-date', true); hasError = true; } else { setFieldError('group-v-date', false); }
                if (!consentChecked) { setFieldError('group-v-consent', true); hasError = true; } else { setFieldError('group-v-consent', false); }

                if (hasError) return;

                const submitBtn = document.getElementById('wsVisitSubmit');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                // Cache pending lead data
                pendingVisitData = {
                    type: 'site_visit',
                    name,
                    email,
                    phone,
                    project,
                    visit_date: date,
                    visit_time: time,
                    notes,
                    dpdp_consent: true,
                    dpdp_timestamp: new Date().toISOString(),
                    source: window.location.pathname
                };

                // Generate 6-digit OTP
                activeOtpCode = generate6DigitOtp();

                // Dispatch OTP via WeisdomMailer
                if (window.WeisdomMailer) {
                    await window.WeisdomMailer.sendOtp(email, name, activeOtpCode);
                } else {
                    console.info('[Weisdom OTP Demo Code]:', activeOtpCode);
                }

                // Switch View to Step 2: OTP Screen
                setTimeout(() => {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;

                    visitForm.style.display = 'none';
                    const otpScreen = document.getElementById('wsVisitOtpStep');
                    const emailDisplay = document.getElementById('wsOtpEmailDisplay');
                    const otpInput = document.getElementById('ws-v-otp');
                    const otpError = document.getElementById('wsOtpError');

                    if (emailDisplay) emailDisplay.textContent = email;
                    if (otpInput) {
                        otpInput.value = '';
                        otpInput.classList.remove('has-error');
                    }
                    if (otpError) otpError.style.display = 'none';
                    if (otpScreen) otpScreen.style.display = 'block';

                    startOtpCountdown();

                    if (otpInput) {
                        setTimeout(() => otpInput.focus(), 150);
                    }
                }, 350);
            });
        }

        // ── Handle OTP Input & Formatting ──────────────────────────────────
        const otpInput = document.getElementById('ws-v-otp');
        if (otpInput) {
            otpInput.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
                const otpError = document.getElementById('wsOtpError');
                if (otpError) otpError.style.display = 'none';

                // Auto-submit when 6 digits entered
                if (this.value.length === 6) {
                    document.getElementById('wsVisitOtpSubmit').click();
                }
            });
        }

        // ── Handle OTP Verification (Step 2: Confirm Appointment) ──────────
        const otpSubmitBtn = document.getElementById('wsVisitOtpSubmit');
        if (otpSubmitBtn) {
            otpSubmitBtn.addEventListener('click', async function () {
                const otpVal = (document.getElementById('ws-v-otp').value || '').trim();
                const otpError = document.getElementById('wsOtpError');

                if (!otpVal || otpVal.length !== 6 || otpVal !== activeOtpCode) {
                    if (otpError) {
                        otpError.textContent = 'Invalid verification code. Please check your email or request a new code.';
                        otpError.style.display = 'block';
                    }
                    if (otpInput) {
                        otpInput.focus();
                        otpInput.select();
                    }
                    return;
                }

                // Code is VALID! Proceed to confirmation
                otpSubmitBtn.classList.add('loading');
                otpSubmitBtn.disabled = true;

                const confirmedLead = Object.assign({}, pendingVisitData, {
                    otp_verified: true,
                    verified_at: new Date().toISOString()
                });

                // Save verified lead to ledger
                saveLeadToLedger(confirmedLead);

                // Dispatch global lead event
                window.dispatchEvent(new CustomEvent('weisdom:lead_submitted', { detail: confirmedLead }));

                // Dispatch confirmation emails via WeisdomMailer
                if (window.WeisdomMailer) {
                    await window.WeisdomMailer.sendSiteVisitConfirmation(confirmedLead);
                }

                clearInterval(otpTimerInterval);

                setTimeout(() => {
                    otpSubmitBtn.classList.remove('loading');
                    otpSubmitBtn.disabled = false;

                    document.getElementById('wsVisitOtpStep').style.display = 'none';
                    const success = document.getElementById('wsVisitSuccess');
                    const desc = document.getElementById('wsVisitSuccessDesc');
                    if (desc) {
                        desc.innerHTML = `Thank you <strong>${confirmedLead.name}</strong>. Your visit to <strong>${confirmedLead.project}</strong> has been verified and confirmed for <strong>${confirmedLead.visit_date}</strong> (${confirmedLead.visit_time}). An appointment confirmation and site directions have been sent to <strong>${confirmedLead.email}</strong>.`;
                    }
                    if (success) success.style.display = 'block';
                }, 400);
            });
        }

        // ── Handle Resend OTP Code ─────────────────────────────────────────
        const resendBtn = document.getElementById('wsOtpResendBtn');
        if (resendBtn) {
            resendBtn.addEventListener('click', async function () {
                if (!pendingVisitData) return;

                resendBtn.disabled = true;
                activeOtpCode = generate6DigitOtp();

                if (window.WeisdomMailer) {
                    await window.WeisdomMailer.sendOtp(pendingVisitData.email, pendingVisitData.name, activeOtpCode);
                } else {
                    console.info('[Weisdom Resent OTP Code]:', activeOtpCode);
                }

                startOtpCountdown();

                const otpError = document.getElementById('wsOtpError');
                if (otpError) otpError.style.display = 'none';

                if (otpInput) {
                    otpInput.value = '';
                    otpInput.focus();
                }
            });
        }

        // ── Handle Back Link (Edit Details) ────────────────────────────────
        const backBtn = document.getElementById('wsOtpBackBtn');
        if (backBtn) {
            backBtn.addEventListener('click', function () {
                clearInterval(otpTimerInterval);
                document.getElementById('wsVisitOtpStep').style.display = 'none';
                document.getElementById('wsVisitForm').style.display = 'block';
            });
        }
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Expose Global Helper
    window.WeisdomDrawers = {
        openBrochure: (project) => openDrawer('wsDrawerBrochure', project),
        openSiteVisit: (project) => openDrawer('wsDrawerVisit', project),
        close: closeAllDrawers
    };

})();
