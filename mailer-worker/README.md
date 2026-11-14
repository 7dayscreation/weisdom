# Weisdom Mailer — Cloudflare Worker (Resend Proxy)

This lightweight Cloudflare Worker acts as a serverless proxy to securely forward emails from the Weisdom website to the **Resend API** (`https://api.resend.com/emails`).

## Quick Deployment (Zero Cost on Cloudflare Free Tier):

1. **Install Wrangler CLI (if not already installed):**
   ```bash
   npm install -g wrangler
   ```

2. **Login to Cloudflare:**
   ```bash
   wrangler login
   ```

3. **Set your Resend API Key Secret:**
   ```bash
   wrangler secret put RESEND_API_KEY
   ```
   *(Paste your `re_xxxx...` key from resend.com)*

4. **Deploy:**
   ```bash
   wrangler deploy
   ```

5. **Connect to Admin Panel:**
   Copy your worker URL (e.g. `https://weisdom-mailer.<your-subdomain>.workers.dev`) and paste it into the **Optional Cloudflare Worker Proxy URL** field in your Weisdom Admin Panel (`/admin/`).
