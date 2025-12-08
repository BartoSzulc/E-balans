# Reusable Templates & Partials Guide

## Overview

This guide explains the pattern for creating reusable, DRY (Don't Repeat Yourself) template components that work seamlessly with both **flexible content** (via `$data` parameter) and **standard ACF fields** (via `get_field()`).

---

## 🎯 Core Principles

### 1. **Single Source of Truth**
- Create ONE partial file for each reusable component
- Use `@include('partials.component')` to reference it everywhere
- Never duplicate template code across files

### 2. **Dual Data Pattern**
Partials must support two data access patterns:

**Pattern A: Flexible Content** (when used inside flexible content layouts)
```php
@php
    // Data is passed from parent via $data parameter
    $section_data = $data['section_name'] ?? [];
@endphp
```

**Pattern B: Standard Fields** (when used as standalone section)
```php
@php
    // Data is fetched directly via get_field()
    $section_data = get_field('section_name') ?? [];
@endphp
```

### 3. **Flexible Data Source**
Use the null coalescing operator to support both patterns:
```php
@php
    // Try $data first (flexible content), fallback to get_field (standard)
    $how_it_works = $data ?? get_field('how_it_works') ?? [];
@endphp
```

---

## 📁 File Structure

```
resources/views/
├── partials/
│   ├── how-it-works.blade.php      ← Reusable partial (single source)
│   ├── hero.blade.php
│   ├── cta.blade.php
│   └── onas/                        ← Layout-specific partials
│       ├── info.blade.php
│       ├── text-image.blade.php
│       ├── video.blade.php
│       └── cta.blade.php
│
├── sections/
│   └── home/
│       ├── hero.blade.php           ← Just @include('partials.hero')
│       └── how-it-works.blade.php   ← Just @include('partials.how-it-works')
│
└── templates/
    ├── template-onas.blade.php
    └── front-page.blade.php
```

---

## 🛠️ Implementation Patterns

### Pattern 1: Reusable Partial (Dual Mode Support)

**File:** `resources/views/partials/how-it-works.blade.php`

```php
@php
  // Support both flexible content ($data) and standard fields (get_field)
  $how_it_works = $data ?? get_field('how_it_works') ?? [];
@endphp

@if($how_it_works)
  <section class="how-it-works-section">
    <div class="container mx-auto">
      @if(!empty($how_it_works['title']))
        <h2 class="section-title text-h2">
          {!! $how_it_works['title'] !!}
        </h2>
      @endif

      @if(!empty($how_it_works['add_how_it_works']))
        <div class="steps-grid">
          @foreach($how_it_works['add_how_it_works'] as $index => $step)
            <div class="step-item">
              <div class="step-number">{{ $index + 1 }}</div>

              @if(!empty($step['image']))
                {!! wp_get_attachment_image($step['image'], 'medium') !!}
              @endif

              @if(!empty($step['title']))
                <h3>{{ $step['title'] }}</h3>
              @endif

              @if(!empty($step['description']))
                <div>{!! $step['description'] !!}</div>
              @endif
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>
@endif
```

### Pattern 2: Using Partial in Standard Template

**File:** `resources/views/sections/home/how-it-works.blade.php`

```php
{{-- No logic here - just include the partial --}}
@include('partials.how-it-works')
```

The partial will use `get_field('how_it_works')` automatically.

### Pattern 3: Using Partial in Flexible Content

**File:** `resources/views/partials/onas/how-it-works.blade.php`

```php
{{-- Pass the layout data from flexible content --}}
@include('partials.how-it-works', ['data' => $layout])
```

**File:** `resources/views/template-onas.blade.php`

```php
@php
  $flexible_content = get_field('flexible_content');
@endphp

@if($flexible_content)
  @foreach($flexible_content as $layout)
    @switch($layout['acf_fc_layout'])
      @case('how_it_works')
        {{-- Pass $layout as $data to the partial --}}
        @include('partials.onas.how-it-works', ['layout' => $layout])
        @break
    @endswitch
  @endforeach
@endif
```

---

## 🔧 ACF Field Structure

### For Partials (app/Fields/Partials/)

**File:** `app/Fields/Partials/HowItWorks.php`

```php
<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Partial;

class HowItWorks extends Partial
{
    public function fields(): Builder
    {
        $fields = Builder::make('how_it_works');

        $fields
            ->addWysiwyg('title', [
                'label' => 'Title',
                'toolbar' => 'full',
                'media_upload' => 0,
            ])
            ->addRepeater('add_how_it_works', [
                'label' => 'Steps',
                'button_label' => 'Add Step',
            ])
                ->addImage('image', [
                    'label' => 'Image',
                    'return_format' => 'id',
                ])
                ->addText('title', ['label' => 'Title'])
                ->addWysiwyg('description', ['label' => 'Description'])
            ->endRepeater();

        return $fields;
    }
}
```

### Using Partial in Standard Template Fields

**File:** `app/Fields/Home.php`

```php
$builder
    ->addTab('how_it_works', ['label' => 'How It Works'])
    ->addGroup('how_it_works', ['label' => 'How It Works Section'])
        ->addPartial(new \App\Fields\Partials\HowItWorks())
    ->endGroup();
```

### Using Partial in Flexible Content

**File:** `app/Fields/Onas.php`

```php
$fields
    ->addFlexibleContent('flexible_content', [
        'label' => 'Content Sections',
        'button_label' => 'Add Section',
    ])
        ->addLayout('how_it_works', ['label' => 'How It Works Section'])
            ->addPartial(new \App\Fields\Partials\HowItWorks())
    ->endFlexibleContent();
```

---

## ✅ Benefits

1. **DRY (Don't Repeat Yourself)**
   - Write once, use everywhere
   - Single file to update for styling or structure changes

2. **Consistency**
   - Same markup across all usages
   - Easier to maintain design system

3. **Flexibility**
   - Works with standard fields
   - Works with flexible content
   - Easy to add new usage locations

4. **Performance**
   - Smaller codebase
   - Less code to load and parse

5. **Maintainability**
   - Update once, changes reflect everywhere
   - Easy to test and debug

---

## 🚨 Common Pitfalls to Avoid

### ❌ DON'T: Duplicate Template Code

```php
// ❌ Bad - Duplicate code in sections/home/how-it-works.blade.php
@php
  $how_it_works = get_field('how_it_works');
@endphp

@if($how_it_works)
  <section class="how-it-works-section">
    <!-- ... full template code ... -->
  </section>
@endif

// ❌ Bad - Same code duplicated in partials/onas/how-it-works.blade.php
@php
  $how_it_works = $layout;
@endphp

@if($how_it_works)
  <section class="how-it-works-section">
    <!-- ... exact same template code ... -->
  </section>
@endif
```

### ✅ DO: Use Single Partial with @include

```php
// ✅ Good - sections/home/how-it-works.blade.php
@include('partials.how-it-works')

// ✅ Good - partials/onas/how-it-works.blade.php
@include('partials.how-it-works', ['data' => $layout])

// ✅ Good - partials/how-it-works.blade.php (the single source)
@php
  $how_it_works = $data ?? get_field('how_it_works') ?? [];
@endphp

@if($how_it_works)
  <section class="how-it-works-section">
    <!-- ... template code (only once!) ... -->
  </section>
@endif
```

---

## 📝 Checklist for Creating Reusable Partials

- [ ] Create partial in `resources/views/partials/` (NOT in sections/)
- [ ] Support both `$data` and `get_field()` patterns
- [ ] Use `!empty()` checks for all data access
- [ ] Create ACF Partial class in `app/Fields/Partials/`
- [ ] Replace all section files with `@include('partials.name')`
- [ ] Update flexible content layouts to pass `['data' => $layout]`
- [ ] Test both usage scenarios (standard fields + flexible content)
- [ ] Document any special data structure requirements

---

## 🎨 Example: Full Implementation

### 1. Create ACF Partial Field

`app/Fields/Partials/CTA.php`
```php
<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Partial;

class CTA extends Partial
{
    public function fields(): Builder
    {
        $fields = Builder::make('cta');

        $fields
            ->addWysiwyg('title', ['label' => 'Title'])
            ->addWysiwyg('description', ['label' => 'Description'])
            ->addLink('link', ['label' => 'Button'])
            ->addImage('image', ['label' => 'Image', 'return_format' => 'id']);

        return $fields;
    }
}
```

### 2. Create Reusable Blade Partial

`resources/views/partials/cta.blade.php`
```php
@php
  // Support both flexible content and standard fields
  $cta = $data ?? get_field('cta') ?? [];
@endphp

@if($cta)
  <section class="cta-section">
    <div class="container mx-auto">
      <div class="cta-wrapper">
        @if(!empty($cta['title']))
          <h2>{!! $cta['title'] !!}</h2>
        @endif

        @if(!empty($cta['description']))
          <div>{!! $cta['description'] !!}</div>
        @endif

        @if(!empty($cta['link']))
          <a href="{{ $cta['link']['url'] }}" class="button">
            {{ $cta['link']['title'] }}
          </a>
        @endif

        @if(!empty($cta['image']))
          {!! wp_get_attachment_image($cta['image'], 'large') !!}
        @endif
      </div>
    </div>
  </section>
@endif
```

### 3. Use in Home Template (Standard Fields)

`app/Fields/Home.php`
```php
->addTab('cta', ['label' => 'CTA'])
->addGroup('cta', ['label' => 'CTA Section'])
    ->addPartial(new \App\Fields\Partials\CTA())
->endGroup()
```

`resources/views/sections/home/cta.blade.php`
```php
@include('partials.cta')
```

### 4. Use in Flexible Content

`app/Fields/Onas.php`
```php
->addFlexibleContent('flexible_content')
    ->addLayout('cta', ['label' => 'Call to Action'])
        ->addPartial(new \App\Fields\Partials\CTA())
->endFlexibleContent()
```

`resources/views/partials/onas/cta.blade.php`
```php
@include('partials.cta', ['data' => $layout])
```

`resources/views/template-onas.blade.php`
```php
@foreach($flexible_content as $layout)
  @switch($layout['acf_fc_layout'])
    @case('cta')
      @include('partials.onas.cta', ['layout' => $layout])
      @break
  @endswitch
@endforeach
```

---

## 📚 Additional Resources

- **ACF Composer Docs**: https://github.com/Log1x/acf-composer
- **Blade Templates**: https://laravel.com/docs/blade
- **ACF Flexible Content**: https://www.advancedcustomfields.com/resources/flexible-content/

---

## 🤝 Contributing

When creating new reusable components:
1. Follow the dual data pattern (`$data ?? get_field()`)
2. Create ACF Partial in `app/Fields/Partials/`
3. Create blade partial in `resources/views/partials/`
4. Update this documentation with examples
5. Test both usage scenarios

---

**Last Updated:** 2025-12-08
