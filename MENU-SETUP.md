# 🗂️ Menu Setup Guide

This guide shows you how to set up the WordPress menus for the LogoTape theme.

---

## Menu Locations

The theme registers the following menu locations:

| Location | Description | Used In |
|----------|-------------|---------|
| `primary_navigation` | Primary Navigation | Header |
| `footer_menu_1` | Footer - Menu | Footer Column 1 |
| `footer_menu_2` | Footer - Branże produktowe | Footer Column 2 |
| `footer_menu_3` | Footer - Produkty | Footer Column 3 |

---

## WP-CLI Setup Commands

### Option 1: Run the Shell Script

```bash
# Make the script executable
chmod +x /tmp/create-menus.sh

# Run the script
/tmp/create-menus.sh
```

### Option 2: Manual Commands

```bash
# Create the menus
wp menu create "Menu Główne"
wp menu create "Menu"
wp menu create "Branże produktowe"
wp menu create "Produkty"

# List all menus to get IDs
wp menu list

# Assign menus to locations (replace MENU_ID with actual ID from list)
wp menu location assign MENU_ID_1 primary_navigation
wp menu location assign MENU_ID_2 footer_menu_1
wp menu location assign MENU_ID_3 footer_menu_2
wp menu location assign MENU_ID_4 footer_menu_3
```

---

## WordPress Admin Setup

### Step 1: Create Menus

1. Go to **Appearance → Menus**
2. Click **create a new menu**
3. Create these 4 menus:
   - Menu Główne
   - Menu
   - Branże produktowe
   - Produkty

### Step 2: Add Menu Items

For each menu, add pages/links:

1. Select the menu from the dropdown
2. Add pages, custom links, or categories
3. Drag to reorder items
4. Click **Save Menu**

### Step 3: Assign to Locations

1. In the menu edit screen, find **Menu Settings** at the bottom
2. Check the appropriate **Display location**:
   - **Menu Główne** → Primary Navigation
   - **Menu** → Footer - Menu
   - **Branże produktowe** → Footer - Branże produktowe
   - **Produkty** → Footer - Produkty
3. Click **Save Menu**

---

## Footer Layout

The footer is displayed in a **6-column grid**:

```
┌─────────────┬──────────────────┬──────────┬────────┬────────┬────────┐
│   Menu      │ Branże produktowe│ Produkty │ Blank  │ Blank  │ Blank  │
│  Column 1   │   Column 2       │ Column 3 │ Col 4  │ Col 5  │ Col 6  │
└─────────────┴──────────────────┴──────────┴────────┴────────┴────────┘
```

**Responsive Behavior:**
- **Desktop (lg+):** 6 columns
- **Tablet (md):** 2 columns
- **Mobile:** 1 column (stacked)

---

## Styling

**Footer Main:**
- Background: `bg-color-1` (Dark Navy #002234)
- Text: `text-white`
- Padding: `lg:pt-120 pt-50 lg:pb-60 pb-30`
- Background Pattern: `wzorek-tlo.png` with opacity

**Footer Copyright:**
- Background: `bg-color-1`
- Padding: `lg:py-37 lg:px-30 p-20`
- Typography: `text-menu-stopka` (18px Gantari 700)

**Menu Styling:**
- Heading: `text-h5 font-bold` (22px Gantari 600)
- Links: `text-menu-stopka` with hover effect
- Hover color: `hover:text-color-2` (Teal)
- Transition: `transition-colors duration-300`

---

## Example Menu Items

### Menu Główne (Header)
- Home
- O nas
- Produkty
- Branże
- Kontakt

### Footer - Menu
- O firmie
- Nasza historia
- Zespół
- Kariera
- Blog

### Footer - Branże produktowe
- Kosmetyki
- Chemia gospodarcza
- Medycyna
- Spożywcze
- Suplementy

### Footer - Produkty
- Saszetki
- Sticki
- Torebki
- Opakowania custom
- Wszystkie produkty

---

## Adding Content to Blank Columns

The footer has 3 blank columns (4, 5, 6) for additional content.

**To add content:**

Edit `resources/views/sections/footer.blade.php`:

```blade
{{-- Column 4: Logo or Social Links --}}
<div class="col-span-1">
    <a href="{{ home_url('/') }}">
        <img src="{{ asset('images/logo-white.svg') }}" alt="Logo">
    </a>

    {{-- Social Icons --}}
    <div class="flex gap-12 mt-20">
        <a href="#" class="hover:opacity-80">
            <svg><!-- Facebook icon --></svg>
        </a>
        <a href="#" class="hover:opacity-80">
            <svg><!-- LinkedIn icon --></svg>
        </a>
    </div>
</div>

{{-- Column 5: Contact Info --}}
<div class="col-span-1">
    <h3 class="mb-20 font-bold text-h5">Kontakt</h3>
    <div class="space-y-10 text-menu-stopka">
        <p>ul. Przykładowa 123</p>
        <p>00-000 Warszawa</p>
        <p>tel: +48 123 456 789</p>
        <p>email@example.com</p>
    </div>
</div>

{{-- Column 6: Newsletter --}}
<div class="col-span-1">
    <h3 class="mb-20 font-bold text-h5">Newsletter</h3>
    <form class="space-y-12">
        <input type="email"
               placeholder="Twój email"
               class="w-full px-16 py-12 text-color-1 rounded-8">
        <button class="w-full px-20 py-12 bg-color-2 text-color-1 rounded-8 hover:bg-color-3">
            Zapisz się
        </button>
    </form>
</div>
```

---

## Troubleshooting

### Menus not showing
1. Check that menus are assigned to locations
2. Clear WordPress cache
3. Verify theme is activated
4. Check `app/setup.php` for menu registrations

### Styling issues
1. Run `npm run build` to compile Tailwind classes
2. Clear browser cache
3. Check for typos in class names

### WP-CLI not working
1. Verify WP-CLI is installed: `wp --version`
2. Run commands from WordPress root directory
3. Check file permissions

---

## Quick Reference

```bash
# List all menus
wp menu list

# List menu locations
wp menu location list

# Add item to menu
wp menu item add MENU_ID PAGE_ID --title="Page Title"

# Delete menu
wp menu delete MENU_ID
```

---

**Related Documentation:**
- [BOILERPLATE-README.md](./BOILERPLATE-README.md)
- [DESIGN-TOKENS.md](./DESIGN-TOKENS.md)
- [QUICK-REFERENCE.md](./QUICK-REFERENCE.md)
