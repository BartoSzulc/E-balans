# Create main pages
Write-Host "Creating main pages..." -ForegroundColor Green

wp post create `
  --post_type=page `
  --post_title="Strona główna" `
  --post_status=publish `
  --post_name="strona-glowna"

wp post create `
  --post_type=page `
  --post_title="O nas" `
  --post_status=publish `
  --post_name="o-nas"

wp post create `
  --post_type=page `
  --post_title="Aktualności" `
  --post_status=publish `
  --post_name="aktualnosci"

wp post create `
  --post_type=page `
  --post_title="Press Room" `
  --post_status=publish `
  --post_name="press-room"

wp post create `
  --post_type=page `
  --post_title="Nasi partnerzy" `
  --post_status=publish `
  --post_name="nasi-partnerzy"

# Create Materiały parent page and get its ID
Write-Host "Creating Materiały parent page..." -ForegroundColor Green
$MATERIALY_ID = wp post create `
  --post_type=page `
  --post_title="Materiały" `
  --post_status=publish `
  --post_name="materialy" `
  --porcelain

Write-Host "Materiały page created with ID: $MATERIALY_ID" -ForegroundColor Yellow

wp post create `
  --post_type=page `
  --post_title="Kontakt" `
  --post_status=publish `
  --post_name="kontakt"

# Create child pages of Materiały
Write-Host "Creating child pages of Materiały..." -ForegroundColor Green

wp post create `
  --post_type=page `
  --post_title="Dla rodziców" `
  --post_status=publish `
  --post_name="dla-rodzicow" `
  --post_parent=$MATERIALY_ID

wp post create `
  --post_type=page `
  --post_title="Dla instytucji" `
  --post_status=publish `
  --post_name="dla-instytucji" `
  --post_parent=$MATERIALY_ID

wp post create `
  --post_type=page `
  --post_title="Dla dzieci" `
  --post_status=publish `
  --post_name="dla-dzieci" `
  --post_parent=$MATERIALY_ID

Write-Host "All pages created successfully!" -ForegroundColor Green
