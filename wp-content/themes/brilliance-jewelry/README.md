# Brilliance Jewelry — WordPress Theme

A modern, elegant WordPress theme for fine jewelry and lab-grown diamond e-commerce stores. Inspired by leading jewelry retailers, the theme is fully WooCommerce-compatible and ships with everything you need to launch a real online store: homepage hero, product catalog, single product page, cart, checkout, customer account, wishlist, diamond search, newsletter, contact form, and a responsive mobile design.

## Features

- **Homepage** with hero banner, value props (free shipping, returns, certificates, warranty), shop-by-category grid, best sellers, new arrivals, split CTAs, testimonials, and journal posts.
- **Header** with sticky navigation, search overlay, account, wishlist count, and live cart count (auto-updates via Woo fragments).
- **Footer** with newsletter signup (AJAX), social links, payment badges, and three menu columns.
- **WooCommerce templates**: archive, single product, cart, checkout, my account dashboard, content-product card.
- **Wishlist** (cookie-backed, no plugin needed): toggle from product cards or the single product page.
- **Diamond search** with shape, carat, color, clarity, cut, and price filters via `[brilliance_diamond_search]` shortcode.
- **AJAX endpoints**: newsletter subscription, contact form, wishlist toggle, quick view.
- **Customizer panels**: top bar, hero, footer, social URLs, accent color.
- **Demo content importer** under **Tools → Brilliance Demo** creates 6 categories, 10 sample products, 6 pages and a primary menu in one click.
- **Translation-ready** with the `brilliance-jewelry` text domain.
- **Responsive** down to 360px.

## Requirements

- WordPress 6.0+
- PHP 7.4+
- WooCommerce 8.0+ (for shop functionality)

Recommended additional plugins (optional):

- **Yoast SEO** or **Rank Math** — SEO
- **Mailchimp for WordPress** or **Klaviyo** — connect the newsletter form via the `brilliance_newsletter_subscribe` action hook
- **Stripe / PayPal payment gateway** — Woo handles checkout, just add a gateway plugin

## Installation

### 1. Install WordPress

If you do not have WordPress yet:

```bash
# Download the latest WordPress
curl -O https://wordpress.org/latest.zip
unzip latest.zip
# Move the wordpress/ folder to your web root
```

Then create a database and run the installer at `http://your-site.local/wp-admin/install.php`.

### 2. Install the theme

This repository contains the theme inside `wp-content/themes/brilliance-jewelry/`. Copy that folder into your WordPress install:

```bash
cp -r wp-content/themes/brilliance-jewelry /path/to/your-wordpress/wp-content/themes/
```

Or zip it and upload via **Appearance → Themes → Add New → Upload**:

```bash
cd wp-content/themes
zip -r brilliance-jewelry.zip brilliance-jewelry
```

Then activate it under **Appearance → Themes**.

### 3. Install WooCommerce

In the WP admin, go to **Plugins → Add New**, search for **WooCommerce**, install and activate. Run through the WooCommerce setup wizard (currency, location, payments, shipping).

### 4. Import demo content (optional)

Once the theme is active, go to **Tools → Brilliance Demo** and click **Import demo content**. This creates:

- 6 product categories: engagement rings, wedding bands, necklaces, earrings, bracelets, loose diamonds
- 10 sample products with prices, SKUs and descriptions
- 6 supporting pages (About, Contact, Diamond Education, Shipping, Warranty, FAQ)
- A primary navigation menu wired to the categories
- A wishlist page with the `[brilliance_wishlist]` shortcode
- A diamond search page with the `[brilliance_diamond_search]` shortcode

You can run the importer multiple times — items that already exist are skipped.

### 5. Configure the homepage

Go to **Settings → Reading** and set:

- **Your homepage displays**: A static page
- **Homepage**: create a new page named "Home" and select it
- **Posts page**: create a page named "Journal"

The homepage uses `front-page.php` automatically once a static page is selected.

### 6. Customize

Visit **Appearance → Customize** to set:

- Top bar announcement text
- Hero image, title, subtitle, button labels & URLs
- Newsletter heading, social URLs
- Accent color
- Logo (Site Identity)

### 7. Set up menus

Go to **Appearance → Menus**. The theme registers six menu locations:

| Location | Purpose |
|---|---|
| Primary Menu | Main desktop nav |
| Mobile Menu | Mobile drawer |
| Top Bar Menu | Above the header |
| Footer Column 1 | Shop links |
| Footer Column 2 | Help links |
| Footer Column 3 | About links |

If you ran the demo importer, the Primary menu is already populated.

### 8. Set up shop pages

WooCommerce creates Shop, Cart, Checkout, and My Account pages automatically. The theme styles them all. You can also set:

- **Settings → Reading**: confirm Shop page
- **WooCommerce → Settings → Advanced**: confirm cart/checkout/account pages

### 9. Add real products

Go to **Products → Add New**. The theme supports:

- Simple, variable, grouped, and external products
- Product galleries with zoom, lightbox, slider
- Variable products (rings sizes, metal types, stone shapes)
- SKUs, stock, sale prices
- Cross-sells, up-sells, related products

For loose diamonds, use the `loose-diamonds` category and add custom fields:

- `_carat` — carat weight (e.g. `1.20`)
- Attributes: `pa_shape`, `pa_color`, `pa_clarity`, `pa_cut`

## Pages with shortcodes

| Page slug | Shortcode | Created by demo importer? |
|---|---|---|
| `/wishlist/` | `[brilliance_wishlist]` | Yes (auto on theme activation) |
| `/diamond-search/` | `[brilliance_diamond_search]` | Yes (auto on theme activation) |

## Hooks and filters

Connect the newsletter to your ESP:

```php
add_action( 'brilliance_newsletter_subscribe', function( $email ) {
    // Push to Mailchimp, Klaviyo, etc.
} );
```

## File structure

```
brilliance-jewelry/
├── 404.php
├── archive.php
├── footer.php
├── front-page.php           # Homepage
├── functions.php
├── header.php
├── index.php
├── page.php
├── page-about.php           # Template: About
├── page-contact.php         # Template: Contact
├── page-education.php       # Template: 4 Cs education
├── search.php
├── searchform.php
├── sidebar.php
├── single.php
├── style.css                # Theme metadata
├── woocommerce.php          # WC wrapper
├── assets/
│   ├── css/
│   │   ├── main.css
│   │   └── woocommerce.css
│   └── js/
│       └── main.js
├── inc/
│   ├── ajax.php             # Newsletter, contact, quick view
│   ├── customizer.php
│   ├── demo-content.php     # Tools → Brilliance Demo
│   ├── diamond-search.php   # [brilliance_diamond_search]
│   ├── template-functions.php
│   ├── wishlist.php         # Cookie-backed wishlist
│   └── woocommerce.php      # WC tweaks & hooks
├── template-parts/
│   └── content-none.php
└── woocommerce/             # Template overrides
    ├── archive-product.php
    ├── content-product.php
    ├── content-single-product.php
    ├── single-product.php
    ├── cart/cart.php
    ├── checkout/form-checkout.php
    └── myaccount/dashboard.php
```

## Local development

To run locally, the fastest path is:

```bash
# With Local by Flywheel, Lando, or DDEV
ddev config --project-type=wordpress
ddev start
ddev wp core download
ddev wp config create --dbname=db --dbuser=db --dbpass=db --dbhost=db
ddev wp core install --url=https://brilliance.ddev.site --title=Brilliance --admin_user=admin --admin_email=admin@example.com --admin_password=admin
ddev wp plugin install woocommerce --activate
ddev wp theme activate brilliance-jewelry
```

Then visit **Tools → Brilliance Demo** and click *Import demo content*.

## License

GPL v2 or later — same as WordPress.
