#!/bin/bash

# Create main pages
echo "Creating main pages..."

wp post create \
  --post_type=page \
  --post_title='Strona główna' \
  --post_status=publish \
  --post_name='strona-glowna'

wp post create \
  --post_type=page \
  --post_title='O nas' \
  --post_status=publish \
  --post_name='o-nas'

wp post create \
  --post_type=page \
  --post_title='Aktualności' \
  --post_status=publish \
  --post_name='aktualnosci'

wp post create \
  --post_type=page \
  --post_title='Press Room' \
  --post_status=publish \
  --post_name='press-room'

wp post create \
  --post_type=page \
  --post_title='Nasi partnerzy' \
  --post_status=publish \
  --post_name='nasi-partnerzy'

# Create Materiały parent page and get its ID
echo "Creating Materiały parent page..."
MATERIALY_ID=$(wp post create \
  --post_type=page \
  --post_title='Materiały' \
  --post_status=publish \
  --post_name='materialy' \
  --porcelain)

echo "Materiały page created with ID: $MATERIALY_ID"

wp post create \
  --post_type=page \
  --post_title='Kontakt' \
  --post_status=publish \
  --post_name='kontakt'

# Create child pages of Materiały
echo "Creating child pages of Materiały..."

wp post create \
  --post_type=page \
  --post_title='Dla rodziców' \
  --post_status=publish \
  --post_name='dla-rodzicow' \
  --post_parent=$MATERIALY_ID

wp post create \
  --post_type=page \
  --post_title='Dla instytucji' \
  --post_status=publish \
  --post_name='dla-instytucji' \
  --post_parent=$MATERIALY_ID

wp post create \
  --post_type=page \
  --post_title='Dla dzieci' \
  --post_status=publish \
  --post_name='dla-dzieci' \
  --post_parent=$MATERIALY_ID

echo "All pages created successfully!"
