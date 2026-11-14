# Weisdom Design Build - Static Website

A high-performance, SEO-optimized static website for **Weisdom Design Build**, ready for deployment to **GitHub** and **Cloudflare Pages**.

## Site Structure & Routes

| Route | Source File | Description |
| :--- | :--- | :--- |
| `/` | `index.html` | Homepage & brand overview |
| `/ample-living/` | `ample-living/index.html` | Ample Living project showcase |
| `/ample-living/amenities/` | `ample-living/amenities/index.html` | Ample Living club & amenities |
| `/ample-living/family-life/` | `ample-living/family-life/index.html` | Ample Living family living spaces |
| `/ampleton/` | `ampleton/index.html` | Ampleton commercial development |
| `/connect/` | `connect/index.html` | Contact, site office & interactive map |
| `/privacy-policy/` | `privacy-policy/index.html` | Privacy & data policy |
| `/rera-policy/` | `rera-policy/index.html` | RERA compliance & disclosures |

## Cloudflare Pages Configuration

- **Framework preset**: None
- **Build command**: *(leave blank)*
- **Build output directory**: `/` *(root)*
- **Security Headers**: Managed automatically via `_headers`
- **Redirects**: Managed via `_redirects`

## PHP Backup & Static Regeneration

All original PHP source files are safely backed up in `_php_backup/` (ignored by Git for a clean static deployment).

If you ever wish to make modifications to the PHP templates and regenerate the static HTML pages:

```bash
cd _php_backup
php generate_static.php
```

