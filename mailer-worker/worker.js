/**
 * Weisdom Design Build — Cloudflare Worker Mailer Proxy
 * Deployable on Cloudflare Workers (Zero Cost / Free Tier)
 * Relays email dispatch requests to the Resend API (https://api.resend.com/emails)
 */

export default {
    async fetch(request, env) {
        // Handle CORS Preflight
        if (request.method === "OPTIONS") {
            return new Response(null, {
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Access-Control-Allow-Methods": "POST, OPTIONS",
                    "Access-Control-Allow-Headers": "Content-Type, Authorization"
                }
            });
        }

        if (request.method !== "POST") {
            return new Response(JSON.stringify({ error: "Method not allowed" }), {
                status: 405,
                headers: { "Content-Type": "application/json", "Access-Control-Allow-Origin": "*" }
            });
        }

        try {
            const data = await request.json();
            const apiKey = data.apiKey || env.RESEND_API_KEY;

            if (!apiKey) {
                return new Response(JSON.stringify({ error: "Missing RESEND_API_KEY" }), {
                    status: 400,
                    headers: { "Content-Type": "application/json", "Access-Control-Allow-Origin": "*" }
                });
            }

            const to = Array.isArray(data.to) ? data.to : [data.to];
            const from = data.from || "Weisdom Design Build <onboarding@resend.dev>";

            const resendResponse = await fetch("https://api.resend.com/emails", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${apiKey}`
                },
                body: JSON.stringify({
                    from: from,
                    to: to,
                    subject: data.subject,
                    html: data.html
                })
            });

            const result = await resendResponse.json();

            return new Response(JSON.stringify(result), {
                status: resendResponse.status,
                headers: {
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Origin": "*"
                }
            });
        } catch (err) {
            return new Response(JSON.stringify({ error: err.message }), {
                status: 500,
                headers: {
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Origin": "*"
                }
            });
        }
    }
};
