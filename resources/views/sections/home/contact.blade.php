@php
    $contact = get_field('contact');
@endphp

{{-- Contact Section --}}
{{-- Field: title - {!! $contact['title'] ?? 'not set' !!} --}}
{{-- Field: description - {!! $contact['description'] ?? 'not set' !!} --}}
{{-- Field: contact_person_image - {{ $contact['contact_person_image'] ?? 'not set' }} --}}
{{-- Field: text_before_phone - {{ $contact['text_before_phone'] ?? 'not set' }} --}}
{{-- Field: phone_number - {{ $contact['phone_number'] ?? 'not set' }} --}}
{{-- Field: cf7_shortcode - {{ $contact['cf7_shortcode'] ?? 'not set' }} --}}

@if($contact)
<section class="contactHome">
    <div class="container">
        @if($contact['title'])
            <div class="contact-title">
                {!! $contact['title'] !!}
            </div>
        @endif

        @if($contact['description'])
            <div class="contact-description">
                {!! $contact['description'] !!}
            </div>
        @endif

        <div class="contact-content">
            @if($contact['contact_person_image'])
                <div class="contact-person">
                    {!! wp_get_attachment_image($contact['contact_person_image'], 'full', false, [
                        'class' => 'contact-person__image'
                    ]) !!}
                </div>
            @endif

            @if($contact['text_before_phone'] || $contact['phone_number'])
                <div class="contact-phone">
                    @if($contact['text_before_phone'])
                        <span class="contact-phone__text">{{ $contact['text_before_phone'] }}</span>
                    @endif
                    @if($contact['phone_number'])
                        <a href="tel:{{ str_replace(' ', '', $contact['phone_number']) }}" class="contact-phone__number">
                            {{ $contact['phone_number'] }}
                        </a>
                    @endif
                </div>
            @endif

            @if($contact['cf7_shortcode'])
                <div class="contact-form">
                    {!! do_shortcode($contact['cf7_shortcode']) !!}
                </div>
            @endif
        </div>
    </div>
</section>
@endif
