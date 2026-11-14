/**
 * Weisdom Design Build - Off-Canvas Drawers & Forms Controller
 * Handles:
 * 1. Download Brochure Side Drawer
 * 2. Schedule Site Visit Side Drawer
 * 3. Client-side Validation, Local Storage Lead Ledger, and Instant PDF Trigger
 */

(function () {
    'use strict';

    // ── Determine Base Prefix for Brochure PDF Asset ───────────────────────
    function getRootPrefix() {
        const path = window.location.pathname;
        if (path.includes('/ample-living/amenities/') || path.includes('/ample-living/family-life/')) {
            return '../../';
        } else if (path.includes('/ample-living/') || path.includes('/ampleton/') || path.includes('/connect/') || path.includes('/privacy-policy/') || path.includes('/rera-policy/')) {
            return '../';
        }
        return './';
    }

    // ── Build HTML Template for Drawers ────────────────────────────────────
    function createDrawersHTML() {
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

                    <div class="ws-checkbox-group">
                        <input type="checkbox" id="ws-b-consent" checked>
                        <label for="ws-b-consent">Send brochure copy & project construction updates directly to my email/WhatsApp.</label>
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
                            <span class="ws-error-msg">Please enter a valid email.</span>
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

                    <button type="submit" class="ws-btn-submit" id="wsVisitSubmit">
                        <span class="ws-spinner"></span>
                        <span>Confirm Site Visit Request</span>
                    </button>
                    <p class="ws-privacy-note">Site Address: Ample Living, Kudasan-Koba Highway, Gandhinagar.</p>
                </form>

                <!-- Success State -->
                <div class="ws-drawer-success" id="wsVisitSuccess">
                    <div class="ws-success-ring">✓</div>
                    <h3 class="ws-success-title">Site Visit Scheduled!</h3>
                    <p class="ws-success-desc" id="wsVisitSuccessDesc">
                        Thank you. Your appointment has been booked. A confirmation with site directions has been sent to your email.
                    </p>
                    <button type="button" class="ws-btn-done" data-ws-close>Done</button>
                </div>
            </div>
        </aside>
        `;
    }

    // ── State & Elements ───────────────────────────────────────────────────
    let overlay, drawerBrochure, drawerVisit;
    let activeDrawer = null;

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
            const firstInput = targetDrawer.querySelector('input:not([type="hidden"]), select');
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
            lead.id = 'lead_' + Date.now();
            lead.timestamp = new Date().toISOString();
            list.unshift(lead);
            localStorage.setItem('weisdom_leads', JSON.stringify(list));
        } catch (e) {
            console.error('LocalStorage error:', e);
        }
    }

    // ── Initialize ─────────────────────────────────────────────────────────
    function init() {
        // Inject drawer HTML once into body
        const container = document.createElement('div');
        container.id = 'ws-drawers-container';
        container.innerHTML = createDrawersHTML();
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
            brochureForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const name = document.getElementById('ws-b-name').value.trim();
                const email = document.getElementById('ws-b-email').value.trim();
                const phone = document.getElementById('ws-b-phone').value.trim();
                const project = document.getElementById('ws-b-project').value;
                const consent = document.getElementById('ws-b-consent').checked;

                let hasError = false;
                if (!name || name.length < 2) { setFieldError('group-b-name', true); hasError = true; } else { setFieldError('group-b-name', false); }
                if (!isValidEmail(email)) { setFieldError('group-b-email', true); hasError = true; } else { setFieldError('group-b-email', false); }
                if (!isValidPhone(phone)) { setFieldError('group-b-phone', true); hasError = true; } else { setFieldError('group-b-phone', false); }

                if (hasError) return;

                const submitBtn = document.getElementById('wsBrochureSubmit');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                const leadPayload = {
                    type: 'brochure_download',
                    name,
                    email,
                    phone,
                    project,
                    consent,
                    source: window.location.pathname
                };

                // Save locally for admin ledger
                saveLeadToLedger(leadPayload);

                // Dispatch event for Step 2 Resend Mailer Hook
                window.dispatchEvent(new CustomEvent('weisdom:lead_submitted', { detail: leadPayload }));

                // Instant download of brochure PDF
                const rootPrefix = getRootPrefix();
                const pdfUrl = rootPrefix + 'ample-living/ample-living.pdf';
                const tempLink = document.createElement('a');
                tempLink.href = pdfUrl;
                tempLink.download = 'Weisdom-Ample-Living-Brochure.pdf';
                tempLink.target = '_blank';
                document.body.appendChild(tempLink);
                tempLink.click();
                document.body.removeChild(tempLink);

                // Simulate/Complete state transition
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

        // ── Handle Site Visit Form Submit ──────────────────────────────────
        const visitForm = document.getElementById('wsVisitForm');
        if (visitForm) {
            visitForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const name = document.getElementById('ws-v-name').value.trim();
                const email = document.getElementById('ws-v-email').value.trim();
                const phone = document.getElementById('ws-v-phone').value.trim();
                const project = document.getElementById('ws-v-project').value;
                const date = document.getElementById('ws-v-date').value;
                const time = document.getElementById('ws-v-time').value;
                const notes = document.getElementById('ws-v-notes').value.trim();

                let hasError = false;
                if (!name || name.length < 2) { setFieldError('group-v-name', true); hasError = true; } else { setFieldError('group-v-name', false); }
                if (!isValidEmail(email)) { setFieldError('group-v-email', true); hasError = true; } else { setFieldError('group-v-email', false); }
                if (!isValidPhone(phone)) { setFieldError('group-v-phone', true); hasError = true; } else { setFieldError('group-v-phone', false); }
                if (!date) { setFieldError('group-v-date', true); hasError = true; } else { setFieldError('group-v-date', false); }

                if (hasError) return;

                const submitBtn = document.getElementById('wsVisitSubmit');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                const leadPayload = {
                    type: 'site_visit',
                    name,
                    email,
                    phone,
                    project,
                    visit_date: date,
                    visit_time: time,
                    notes,
                    source: window.location.pathname
                };

                // Save locally for admin ledger
                saveLeadToLedger(leadPayload);

                // Dispatch event for Step 2 Resend Mailer Hook
                window.dispatchEvent(new CustomEvent('weisdom:lead_submitted', { detail: leadPayload }));

                // Complete state transition
                setTimeout(() => {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    visitForm.style.display = 'none';
                    const success = document.getElementById('wsVisitSuccess');
                    const desc = document.getElementById('wsVisitSuccessDesc');
                    if (desc) {
                        desc.innerHTML = `Thank you <strong>${name}</strong>. Your visit to <strong>${project}</strong> is scheduled for <strong>${date}</strong> (${time}). An appointment confirmation has been sent to <strong>${email}</strong>.`;
                    }
                    if (success) success.style.display = 'block';
                }, 400);
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
