# iquest-project

Acest repository conține o **temă WordPress completă** — `brilliance-jewelry` — care reproduce funcționalitățile unui magazin online de bijuterii de tip *bestbrilliance.com* (lab-grown diamonds și fine jewelry).

## Conținut

- `wp-content/themes/brilliance-jewelry/` — tema WordPress (PHP, CSS, JS)
- `Razvan proiect.html` — proiectul HTML inițial
- `wp-content/themes/brilliance-jewelry/README.md` — documentație detaliată a temei

## Funcționalități incluse

- Homepage cu hero, beneficii (free shipping / returns / certificate / warranty), grid de categorii, best sellers, new arrivals, testimoniale, journal
- Header sticky cu meniu, căutare, cont, wishlist, coș cu actualizare în timp real
- Footer cu newsletter (AJAX), social, plăți acceptate, meniuri pe coloane
- Catalog produse (arhivă) cu sidebar de filtre
- Pagina single product cu galerie, variații, add to cart, wishlist, breadcrumb, tabs, related products
- Coș și checkout (template-uri WooCommerce override-uite și stilizate)
- Cont client (dashboard, orders, addresses, edit account)
- Wishlist persistat în cookie (fără plugin)
- Diamond search cu filtre: shape, carat, color, clarity, cut, price (`[brilliance_diamond_search]`)
- Pagini About, Contact (cu AJAX), Education (cele 4 Cs), Shipping, Warranty, FAQ
- Pagini auto-create la activarea temei: `/wishlist/`, `/diamond-search/`
- Customizer pentru hero, top bar, social URLs, accent color
- **Demo content importer** sub `Tools → Brilliance Demo`: creează 6 categorii, 10 produse, 6 pagini, meniu principal — totul cu un click
- Design responsive (desktop / tablet / mobile)
- Gata de tradus (text domain `brilliance-jewelry`)

## Instalare rapidă

1. Instalează WordPress (https://wordpress.org/download/)
2. Copiază folderul `wp-content/themes/brilliance-jewelry/` în `wp-content/themes/` din instalarea ta WP
3. Activează tema din **Appearance → Themes**
4. Instalează și activează plugin-ul **WooCommerce**
5. Mergi la **Tools → Brilliance Demo** și apasă *Import demo content*
6. Setează homepage static la **Settings → Reading**
7. Personalizează la **Appearance → Customize**

Instrucțiuni complete: vezi [`wp-content/themes/brilliance-jewelry/README.md`](wp-content/themes/brilliance-jewelry/README.md).

## Cerințe

- WordPress 6.0+
- PHP 7.4+
- WooCommerce 8.0+

## Licență

GPL v2 or later
