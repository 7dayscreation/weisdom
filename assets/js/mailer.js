/**
 * Weisdom Design Build - Mailer & CRM Integration Engine
 * Connects forms with Resend API and CRM Webhooks
 * 100% Static - GitHub & Cloudflare Pages ready (zero database required)
 */

(function (window) {
    'use strict';

    const STORAGE_KEY = 'weisdom_mailer_config';

    const DEFAULT_CONFIG = {
        resend_api_key: '',
        sender_email: 'Weisdom Design Build <onboarding@resend.dev>',
        admin_email: 'info@weisdom.in',
        worker_url: '',
        crm_webhook_url: ''
    };

    function getConfig() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            return raw ? Object.assign({}, DEFAULT_CONFIG, JSON.parse(raw)) : Object.assign({}, DEFAULT_CONFIG);
        } catch (e) {
            return Object.assign({}, DEFAULT_CONFIG);
        }
    }

    function saveConfig(cfg) {
        try {
            const current = getConfig();
            const updated = Object.assign({}, current, cfg);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(updated));
            return true;
        } catch (e) {
            console.error('WeisdomMailer: Error saving config', e);
            return false;
        }
    }

    // ── Toast Helper for In-Page Notifications ─────────────────────────────
    function showToast(message, durationMs) {
        let toast = document.getElementById('wsToastNotice');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'wsToastNotice';
            toast.className = 'ws-toast';
            document.body.appendChild(toast);
        }
        toast.innerHTML = message;
        toast.classList.add('active');
        clearTimeout(toast._timer);
        toast._timer = setTimeout(() => {
            toast.classList.remove('active');
        }, durationMs || 6000);
    }

    // ── Email HTML Templates ───────────────────────────────────────────────
    function renderOtpEmail(otp, name) {
        return `
        <!DOCTYPE html>
        <html>
        <head><meta charset="utf-8"></head>
        <body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f7f7f8; margin: 0; padding: 30px 15px; color: #2a2a30;">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 560px; background: #ffffff; border: 1px solid #e6e6e9; border-radius: 4px; overflow: hidden;">
            <tr>
              <td style="padding: 28px 32px; background: #111115; color: #ffffff;">
                <span style="font-size: 11px; letter-spacing: 0.2em; text-transform: uppercase; color: #a4a4ac; display: block; margin-bottom: 4px;">WEISDOM DESIGN BUILD</span>
                <h2 style="margin: 0; font-size: 20px; font-weight: 400; letter-spacing: 0.03em;">Site Visit Verification Code</h2>
              </td>
            </tr>
            <tr>
              <td style="padding: 32px;">
                <p style="font-size: 15px; margin: 0 0 16px 0; line-height: 1.5;">Hello <strong>${name || 'Valued Visitor'}</strong>,</p>
                <p style="font-size: 14px; margin: 0 0 24px 0; line-height: 1.6; color: #55555f;">
                  Thank you for scheduling a site visit to Weisdom Design Build. To verify your request in accordance with our security and privacy verification standards, please use the following 6-digit One-Time Password (OTP):
                </p>
                <div style="background: #fbfbfc; border: 1.5px dashed #111115; border-radius: 4px; padding: 20px 0; text-align: center; margin-bottom: 24px;">
                  <span style="font-family: 'DM Mono', Consolas, 'Courier New', monospace; font-size: 34px; font-weight: 700; letter-spacing: 0.28em; color: #111115;">${otp}</span>
                </div>
                <p style="font-size: 12.5px; color: #777782; margin: 0 0 10px 0; line-height: 1.4;">
                  This code expires in 10 minutes. If you did not initiate this visit request, please disregard this email.
                </p>
                <hr style="border: none; border-top: 1px solid #eeeeee; margin: 26px 0;">
                <p style="font-size: 12px; color: #888894; margin: 0; line-height: 1.5;">
                  <strong>Weisdom Design Build</strong> — Architecture & Development<br>
                  Project: Ample Living, Kudasan-Koba Highway, Gandhinagar, Gujarat 382421
                </p>
              </td>
            </tr>
          </table>
        </body>
        </html>`;
    }

    function renderBrochureVisitorEmail(lead, brochureUrl) {
        return `
        <!DOCTYPE html>
        <html>
        <head><meta charset="utf-8"></head>
        <body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f7f7f8; margin: 0; padding: 30px 15px; color: #2a2a30;">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 580px; background: #ffffff; border: 1px solid #e6e6e9; border-radius: 4px; overflow: hidden;">
            <tr>
              <td style="padding: 28px 32px; background: #111115; color: #ffffff;">
                <span style="font-size: 11px; letter-spacing: 0.2em; text-transform: uppercase; color: #a4a4ac; display: block; margin-bottom: 4px;">WEISDOM DESIGN BUILD</span>
                <h2 style="margin: 0; font-size: 21px; font-weight: 400; letter-spacing: 0.03em;">${lead.project} — Architectural Brochure</h2>
              </td>
            </tr>
            <tr>
              <td style="padding: 32px;">
                <p style="font-size: 15px; margin: 0 0 14px 0; line-height: 1.5;">Hello <strong>${lead.name}</strong>,</p>
                <p style="font-size: 14px; margin: 0 0 22px 0; line-height: 1.6; color: #55555f;">
                  Thank you for requesting the digital brochure for <strong>${lead.project}</strong>. Your copy includes complete master layouts, unit floor plans, elevation views, and amenity specifications.
                </p>
                <div style="text-align: center; margin: 28px 0;">
                  <a href="${brochureUrl}" target="_blank" style="display: inline-block; background: #111115; color: #ffffff; text-decoration: none; padding: 14px 28px; font-size: 13px; letter-spacing: 0.12em; text-transform: uppercase; border-radius: 2px; font-weight: 500;">
                    Download PDF Brochure
                  </a>
                </div>
                <div style="background: #fbfbfc; border: 1px solid #e9e9ee; border-radius: 4px; padding: 16px 20px; margin-bottom: 24px;">
                  <p style="font-size: 13px; font-weight: 600; color: #111115; margin: 0 0 6px 0;">Project Quick Facts:</p>
                  <ul style="font-size: 13px; color: #555562; margin: 0; padding-left: 18px; line-height: 1.7;">
                    <li>Location: Kudasan-Koba Highway, Gandhinagar</li>
                    <li>Architecture: Weisdom Design Build</li>
                    <li>Typology: 3 BHK & 4 BHK Living & Amenities</li>
                    <li>RERA Approved: PR/GJ/GANDHINAGAR/GANDHINAGAR/Others/RAA09068/200921</li>
                  </ul>
                </div>
                <p style="font-size: 12.5px; color: #777782; margin: 0 0 8px 0; line-height: 1.5;">
                  Our architecture advisors are available to answer queries or arrange a personalized walkthrough.
                </p>
                <hr style="border: none; border-top: 1px solid #eeeeee; margin: 24px 0;">
                <p style="font-size: 11.5px; color: #888894; margin: 0; line-height: 1.5;">
                  You received this email because you requested the brochure at weisdom.in in compliance with India's DPDP Act 2023.
                </p>
              </td>
            </tr>
          </table>
        </body>
        </html>`;
    }

    function renderBrochureAdminEmail(lead) {
        return `
        <!DOCTYPE html>
        <html>
        <body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f7f7f8; margin: 0; padding: 25px; color: #222;">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 560px; background: #ffffff; border: 1px solid #ddd; border-radius: 4px; padding: 24px;">
            <tr><td>
              <h2 style="color: #111; margin-top: 0; font-size: 18px; border-bottom: 2px solid #111; padding-bottom: 8px;">[New Brochure Lead] ${lead.project}</h2>
              <table width="100%" cellpadding="6" cellspacing="0" style="font-size: 13px; line-height: 1.6;">
                <tr><td width="130" style="color: #777;"><strong>Full Name:</strong></td><td>${lead.name}</td></tr>
                <tr><td style="color: #777;"><strong>Email Address:</strong></td><td><a href="mailto:${lead.email}">${lead.email}</a></td></tr>
                <tr><td style="color: #777;"><strong>Mobile Phone:</strong></td><td><a href="tel:${lead.phone}">${lead.phone}</a></td></tr>
                <tr><td style="color: #777;"><strong>Project:</strong></td><td>${lead.project}</td></tr>
                <tr><td style="color: #777;"><strong>DPDP Consent:</strong></td><td style="color: #2e8d53;">✓ Explicitly Granted (${lead.dpdp_timestamp || new Date().toISOString()})</td></tr>
                <tr><td style="color: #777;"><strong>Lead Source:</strong></td><td>${lead.source || 'Website'}</td></tr>
              </table>
            </td></tr>
          </table>
        </body>
        </html>`;
    }

    function renderVisitConfirmationEmail(lead) {
        return `
        <!DOCTYPE html>
        <html>
        <head><meta charset="utf-8"></head>
        <body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f7f7f8; margin: 0; padding: 30px 15px; color: #2a2a30;">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 580px; background: #ffffff; border: 1px solid #e6e6e9; border-radius: 4px; overflow: hidden;">
            <tr>
              <td style="padding: 28px 32px; background: #111115; color: #ffffff;">
                <span style="font-size: 11px; letter-spacing: 0.2em; text-transform: uppercase; color: #a4a4ac; display: block; margin-bottom: 4px;">WEISDOM DESIGN BUILD</span>
                <h2 style="margin: 0; font-size: 21px; font-weight: 400; letter-spacing: 0.03em;">Site Visit Appointment Confirmed</h2>
              </td>
            </tr>
            <tr>
              <td style="padding: 32px;">
                <p style="font-size: 15px; margin: 0 0 14px 0; line-height: 1.5;">Hello <strong>${lead.name}</strong>,</p>
                <p style="font-size: 14px; margin: 0 0 24px 0; line-height: 1.6; color: #55555f;">
                  Your site visit request has been verified and confirmed. Our architecture team looks forward to welcoming you to the site.
                </p>
                <table width="100%" cellpadding="10" cellspacing="0" style="background: #fbfbfc; border: 1px solid #e5e5eb; border-radius: 4px; font-size: 13.5px; margin-bottom: 24px;">
                  <tr><td width="130" style="color: #777785; border-bottom: 1px solid #f0f0f3;">Project:</td><td style="font-weight: 600; border-bottom: 1px solid #f0f0f3;">${lead.project}</td></tr>
                  <tr><td style="color: #777785; border-bottom: 1px solid #f0f0f3;">Visit Date:</td><td style="font-weight: 600; border-bottom: 1px solid #f0f0f3;">${lead.visit_date}</td></tr>
                  <tr><td style="color: #777785; border-bottom: 1px solid #f0f0f3;">Time Slot:</td><td style="font-weight: 600; border-bottom: 1px solid #f0f0f3;">${lead.visit_time}</td></tr>
                  <tr><td style="color: #777785; border-bottom: 1px solid #f0f0f3;">Email OTP:</td><td style="color: #2e8d53; font-weight: 600; border-bottom: 1px solid #f0f0f3;">✓ Verified</td></tr>
                  <tr><td style="color: #777785;">Site Address:</td><td style="line-height: 1.5;">Kudasan-Koba Highway, Kudasan, Gandhinagar, Gujarat 382421</td></tr>
                </table>
                <div style="text-align: center; margin: 26px 0;">
                  <a href="https://maps.google.com/?q=Ample+Living+Kudasan+Gandhinagar" target="_blank" style="display: inline-block; background: #111115; color: #ffffff; text-decoration: none; padding: 13px 26px; font-size: 12.5px; letter-spacing: 0.12em; text-transform: uppercase; border-radius: 2px; font-weight: 500;">
                    Open Site in Google Maps
                  </a>
                </div>
                <hr style="border: none; border-top: 1px solid #eeeeee; margin: 24px 0;">
                <p style="font-size: 12px; color: #888894; margin: 0; line-height: 1.5;">
                  <strong>Weisdom Design Build</strong> — Architecture & Development<br>
                  Questions? Call our concierge at +91 98765 43210 or reply to this email.
                </p>
              </td>
            </tr>
          </table>
        </body>
        </html>`;
    }

    function renderVisitAdminEmail(lead) {
        return `
        <!DOCTYPE html>
        <html>
        <body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f7f7f8; margin: 0; padding: 25px; color: #222;">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 580px; background: #ffffff; border: 1px solid #ddd; border-radius: 4px; padding: 24px;">
            <tr><td>
              <h2 style="color: #111; margin-top: 0; font-size: 18px; border-bottom: 2px solid #111; padding-bottom: 8px;">[Confirmed Site Visit] ${lead.name} — ${lead.project}</h2>
              <table width="100%" cellpadding="6" cellspacing="0" style="font-size: 13px; line-height: 1.6;">
                <tr><td width="130" style="color: #777;"><strong>Full Name:</strong></td><td>${lead.name}</td></tr>
                <tr><td style="color: #777;"><strong>Email Address:</strong></td><td><a href="mailto:${lead.email}">${lead.email}</a></td></tr>
                <tr><td style="color: #777;"><strong>Mobile Phone:</strong></td><td><a href="tel:${lead.phone}">${lead.phone}</a></td></tr>
                <tr><td style="color: #777;"><strong>Project:</strong></td><td>${lead.project}</td></tr>
                <tr><td style="color: #777;"><strong>Date & Time:</strong></td><td><strong>${lead.visit_date}</strong> (${lead.visit_time})</td></tr>
                <tr><td style="color: #777;"><strong>OTP Status:</strong></td><td style="color: #2e8d53; font-weight: bold;">✓ VERIFIED via Email OTP</td></tr>
                <tr><td style="color: #777;"><strong>DPDP Consent:</strong></td><td style="color: #2e8d53;">✓ Explicitly Accepted (${lead.dpdp_timestamp})</td></tr>
                ${lead.notes ? `<tr><td style="color: #777;"><strong>Visitor Notes:</strong></td><td>${lead.notes}</td></tr>` : ''}
                <tr><td style="color: #777;"><strong>Source URL:</strong></td><td>${lead.source}</td></tr>
              </table>
            </td></tr>
          </table>
        </body>
        </html>`;
    }

    // ── Dispatch via Cloudflare Worker or Direct Resend API ───────────────
    async function dispatchEmail(to, subject, html) {
        const cfg = getConfig();
        const toList = Array.isArray(to) ? to : [to];

        // 1. Try Cloudflare Worker mailer if configured
        if (cfg.worker_url) {
            try {
                const res = await fetch(cfg.worker_url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        to: toList,
                        subject: subject,
                        html: html,
                        from: cfg.sender_email,
                        apiKey: cfg.resend_api_key
                    })
                });
                return { success: res.ok, status: res.status };
            } catch (err) {
                console.warn('Worker dispatch failed, falling back to direct API', err);
            }
        }

        // 2. Direct Resend API call if API key configured
        if (cfg.resend_api_key) {
            try {
                const res = await fetch('https://api.resend.com/emails', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${cfg.resend_api_key}`
                    },
                    body: JSON.stringify({
                        from: cfg.sender_email,
                        to: toList,
                        subject: subject,
                        html: html
                    })
                });
                const data = await res.json().catch(() => ({}));
                return { success: res.ok, data };
            } catch (err) {
                console.error('Direct Resend API call error', err);
                return { success: false, error: err };
            }
        }

        // 3. Fallback / Dev Simulator (When no key is configured yet)
        console.info(`%c[WeisdomMailer DEV]%c Simulated Email Dispatched\nTo: ${toList.join(', ')}\nSubject: ${subject}`, 'background:#111115;color:#f0c36d;font-weight:bold;padding:2px 6px;', 'color:#333;');
        return { success: true, simulated: true };
    }

    // ── CRM Webhook Forwarder ──────────────────────────────────────────────
    async function forwardToCrm(lead) {
        const cfg = getConfig();
        if (!cfg.crm_webhook_url) return { skipped: true };

        try {
            await fetch(cfg.crm_webhook_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    lead_id: lead.id,
                    type: lead.type,
                    name: lead.name,
                    email: lead.email,
                    phone: lead.phone,
                    project: lead.project,
                    visit_date: lead.visit_date || null,
                    visit_time: lead.visit_time || null,
                    notes: lead.notes || '',
                    otp_verified: !!lead.otp_verified,
                    dpdp_consent: lead.dpdp_consent,
                    dpdp_timestamp: lead.dpdp_timestamp,
                    source: lead.source,
                    created_at: lead.created_at
                }),
                mode: 'no-cors'
            });
            return { success: true };
        } catch (e) {
            console.error('WeisdomMailer: CRM forward error', e);
            return { success: false, error: e };
        }
    }

    // ── Public Engine Methods ──────────────────────────────────────────────
    window.WeisdomMailer = {
        getConfig,
        saveConfig,
        showToast,

        // 1. Send OTP to Visitor for Site Visit
        async sendOtp(email, name, otp) {
            const subject = `Your Weisdom Site Visit Verification Code: ${otp}`;
            const html = renderOtpEmail(otp, name);
            const res = await dispatchEmail(email, subject, html);
            if (res.simulated) {
                showToast(`<strong>TEST MODE OTP:</strong> Your verification code is <strong>${otp}</strong> (Enter to verify).`, 9000);
            } else {
                showToast(`Verification code dispatched to <strong>${email}</strong>. Check your inbox.`, 5000);
            }
            return res;
        },

        // 2. Handle Brochure Download Submission
        async sendBrochureDownload(lead, brochureUrl) {
            const cfg = getConfig();
            // Send to visitor
            const visitorHtml = renderBrochureVisitorEmail(lead, brochureUrl);
            const p1 = dispatchEmail(lead.email, `Your Weisdom ${lead.project} Brochure & Architectural Layouts`, visitorHtml);
            
            // Send to admin
            const adminHtml = renderBrochureAdminEmail(lead);
            const p2 = dispatchEmail(cfg.admin_email, `[New Brochure Download] ${lead.name} — ${lead.project}`, adminHtml);

            // Forward to CRM
            forwardToCrm(lead);

            return Promise.all([p1, p2]);
        },

        // 3. Handle Confirmed Site Visit Submission
        async sendSiteVisitConfirmation(lead) {
            const cfg = getConfig();
            // Send to visitor
            const visitorHtml = renderVisitConfirmationEmail(lead);
            const p1 = dispatchEmail(lead.email, `Site Visit Confirmed: ${lead.project} on ${lead.visit_date}`, visitorHtml);

            // Send to admin
            const adminHtml = renderVisitAdminEmail(lead);
            const p2 = dispatchEmail(cfg.admin_email, `[Confirmed Site Visit] ${lead.name} — ${lead.visit_date} (${lead.visit_time})`, adminHtml);

            // Forward to CRM
            forwardToCrm(lead);

            return Promise.all([p1, p2]);
        },

        // 4. Test Resend Connection from Admin Panel
        async testConnection(testEmail) {
            const subject = 'Weisdom Design Build — Mailer Integration Test';
            const html = `
            <div style="font-family:sans-serif;padding:20px;color:#111;">
              <h2>Weisdom Mailer Test Successful!</h2>
              <p>Your Resend API connection and sender settings are working perfectly.</p>
              <p>Timestamp: ${new Date().toLocaleString()}</p>
            </div>`;
            return dispatchEmail(testEmail, subject, html);
        }
    };

})(window);
