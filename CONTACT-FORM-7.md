# Contact Form 7 - Reusable Templates

This document provides reusable Contact Form 7 HTML templates and setup instructions.

## Available Templates

### 1. Standard Contact Form
**File:** `resources/views/forms/contact-form-template.html`

Pre-configured for AgroImpex with all fields and styling.

**Fields:**
- Imię i nazwisko* (required text)
- Firma (optional text)
- Adres e-mail* (required email)
- Numer telefonu* (tel)
- Twoja wiadomość* (textarea)
- Privacy policy acceptance (optional)

### 2. Customizable Contact Form
**File:** `resources/views/forms/contact-form-simple.html`

Template with placeholders for easy customization.

**Placeholders to replace:**
- `{{FORM_TITLE}}` - Form heading (default: "Formularz kontaktowy")
- `{{COMPANY_NAME}}` - Company name in privacy policy text

## How to Use

### Step 1: Create New Contact Form in WordPress

1. Go to **Contact → Contact Forms** in WordPress admin
2. Click **Add New**
3. Give your form a name

### Step 2: Copy Template Code

1. Open one of the template files from `resources/views/forms/`
2. Copy the entire HTML content
3. Paste into the Contact Form 7 editor
4. If using customizable template, replace placeholders:
   ```html
   {{FORM_TITLE}} → Your Form Title
   {{COMPANY_NAME}} → Your Company Name
   ```

### Step 3: Configure Form Settings

**Mail Tab:**
```
To: your-email@example.com
From: [your-name] <[your-email]>
Subject: Nowa wiadomość z formularza kontaktowego
Additional Headers: Reply-To: [your-email]

Message Body:
Imię i nazwisko: [your-name]
Firma: [your-firma]
Email: [your-email]
Telefon: [your-phone]

Wiadomość:
[your-message]
```

**Messages Tab:**
Customize success/error messages as needed.

### Step 4: Add to Page

Use shortcode in your content or template:
```php
[contact-form-7 id="123" title="Contact form"]
```

Or in Blade template:
```blade
{!! do_shortcode('[contact-form-7 id="123"]') !!}
```

## Form Structure

### Grid System
```html
<div class="form__grid">
    <div class="form__grid-col form__grid-col--col-12">
        <!-- Form fields here -->
    </div>
</div>
```

### Field Pattern
```html
<label> <b>Label Text*</b>
    [field-type* field-name placeholder "Placeholder text"]
</label>
```

### Field Types

| Type | CF7 Syntax | Example |
|------|------------|---------|
| Text (required) | `[text* name]` | `[text* your-name]` |
| Text (optional) | `[text name]` | `[text your-firma]` |
| Email (required) | `[email* name]` | `[email* your-email]` |
| Phone | `[tel name]` | `[tel your-phone]` |
| Textarea | `[textarea name]` | `[textarea your-message]` |
| Acceptance | `[acceptance id]` | `[acceptance acceptance-201]` |

### Submit Button
```html
<button type="submit" class="svg-button-alt wpcf7-form-control wpcf7-submit">
    <span class="relative z-10 w-200 lg:w-592">Wyślij wiadomość</span>
</button>
```

## Styling Classes

### Form Container
- `form__grid` - Main form grid container
- `form__grid-col` - Column wrapper
- `form__grid-col--col-12` - Full width column

### Typography
- `text-center` - Center align text
- `text-h4` - H4 text size
- `text-polityka` - Privacy policy text style
- `text-zgody` - Consent text style

### Spacing
- `lg:py-50` - Desktop padding Y: 50
- `py-30` - Mobile padding Y: 30

### Components
- `heading` - Heading wrapper
- `acceptance-button` - Acceptance checkbox and button wrapper
- `check` - Custom checkbox styling
- `svg-button-alt` - Button styling
- `link-underline` - Underlined link

## Customization Examples

### Add New Field
```html
<label> <b>Your Label*</b>
    [text* your-field-name placeholder "Your placeholder"]
</label>
```

### Two Column Layout
```html
<div class="form__grid">
    <div class="form__grid-col form__grid-col--col-6">
        <label>Field 1</label>
    </div>
    <div class="form__grid-col form__grid-col--col-6">
        <label>Field 2</label>
    </div>
</div>
```

### Conditional Fields
Use Contact Form 7 Conditional Fields plugin:
```html
[checkbox your-checkbox "Show extra field"]

<div data-show="your-checkbox">
    [text conditional-field]
</div>
```

## ACF Integration Pattern

If you want to add contact form via ACF:

```php
// In app/Fields/YourPage.php
->addText('contact_form_shortcode', [
    'label' => 'Contact Form Shortcode',
    'instructions' => 'Enter CF7 shortcode (e.g., [contact-form-7 id="123"])',
])
```

```blade
{{-- In your blade template --}}
@if($contact_form = get_field('contact_form_shortcode'))
    <div class="contact-form-section">
        {!! do_shortcode($contact_form) !!}
    </div>
@endif
```

## Validation

Contact Form 7 automatically validates:
- Required fields (marked with `*`)
- Email format
- Phone number format
- Acceptance checkboxes

Custom validation can be added with filters in `app/helpers-partials/contact-form.php`.

## Common Issues

### Form Not Sending
1. Check SMTP configuration
2. Verify email addresses in Mail tab
3. Check server mail logs

### Styling Not Applied
1. Ensure CSS classes are defined in your stylesheets
2. Check if CF7 autop is disabled: `add_filter('wpcf7_autop_or_not', '__return_false');`
3. Clear cache

### Spam Protection
Add reCAPTCHA:
```html
[recaptcha]
```

Or use honeypot:
```html
[hidden honeypot]
```

## Files Location

```
resources/views/forms/
├── contact-form-template.html    # Standard template
└── contact-form-simple.html      # Customizable template
```

## Related Files

- `app/helpers.php` - Contains `add_filter('wpcf7_autop_or_not', '__return_false');`
- `app/helpers-partials/contact-form.php` - Custom CF7 functionality
