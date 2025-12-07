# WP-CLI Setup Commands

## Create Pages and Menu

### Option 1: Run Complete Script

```bash
#!/bin/bash

# Create pages and capture their IDs
STRONA_GLOWNA_ID=$(wp post create --post_type=page --post_title="Strona Główna" --post_status=publish --porcelain)
PRODUKTY_ID=$(wp post create --post_type=page --post_title="Produkty" --post_status=publish --porcelain)
O_NAS_ID=$(wp post create --post_type=page --post_title="O nas" --post_status=publish --porcelain)
AKTUALNOSCI_ID=$(wp post create --post_type=page --post_title="Aktualności" --post_status=publish --porcelain)
KONTAKT_ID=$(wp post create --post_type=page --post_title="Kontakt" --post_status=publish --porcelain)

echo "Created pages:"
echo "Strona Główna: $STRONA_GLOWNA_ID"
echo "Produkty: $PRODUKTY_ID"
echo "O nas: $O_NAS_ID"
echo "Aktualności: $AKTUALNOSCI_ID"
echo "Kontakt: $KONTAKT_ID"

# Create menu
wp menu create "Menu"

# Add pages to menu
wp menu item add-post menu $STRONA_GLOWNA_ID --title="Strona Główna"
wp menu item add-post menu $PRODUKTY_ID --title="Produkty"
wp menu item add-post menu $O_NAS_ID --title="O nas"
wp menu item add-post menu $AKTUALNOSCI_ID --title="Aktualności"
wp menu item add-post menu $KONTAKT_ID --title="Kontakt"

echo "Menu created and pages added successfully!"

# Optional: Set Strona Główna as front page
wp option update show_on_front page
wp option update page_on_front $STRONA_GLOWNA_ID

echo "Front page set to: Strona Główna"
```

### Option 2: Individual Commands

#### Step 1: Create Pages

```bash
wp post create --post_type=page --post_title="Branża pakowa i transportowa" --post_status=publish
wp post create --post_type=page --post_title="Branża przemysłowa" --post_status=publish
wp post create --post_type=page --post_title="Branża spożywcza" --post_status=publish
wp post create --post_type=page --post_title="Pozostałe" --post_status=publish
wp post create --post_type=page --post_title="Kontakt" --post_status=publish
```

#### Step 2: Create Menu

```bash
wp menu create "Menu"
```

#### Step 3: Get Page IDs

```bash
wp post list --post_type=page --format=table
```

#### Step 4: Add Pages to Menu

Replace `<PAGE_ID>` with actual page IDs from step 3:

```bash
wp menu item add-post menu 9 --title="Strona Główna"
wp menu item add-post menu 15 --title="Produkty"
wp menu item add-post menu 16 --title="O nas"
wp menu item add-post menu 17 --title="Aktualności"
wp menu item add-post menu 18 --title="Kontakt"
```

#### Step 5 (Optional): Set Front Page

```bash
wp option update show_on_front page
wp option update page_on_front <STRONA_GLOWNA_ID>
```

### Additional Useful Commands

#### Assign Menu to Theme Location

```bash
# List available menu locations
wp menu location list

# Assign menu to primary location (adjust location name as needed)
wp menu location assign menu primary
```

#### Delete Menu (if needed)

```bash
wp menu delete menu
```

#### Delete Pages (if needed)

```bash
wp post delete <PAGE_ID> --force
```

#### List All Menus

```bash
wp menu list
```

#### View Menu Items

```bash
wp menu item list menu
```
