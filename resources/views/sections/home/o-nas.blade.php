@php
    $o_nas = get_field('o_nas');
@endphp

@if ($o_nas)
    <section class="o-nas-section mt-50 lg:mt-120">
        <div class="container mx-auto">
            <div class="grid grid-cols-12 gap-16 gap-y-24">
                <div class="col-span-full lg:col-span-5">
                    @if ($o_nas['images'])
                        <div class="relative images-gallery lg:h-540 w-469" data-aos="fade-right" data-aos-delay="100">
                            
                            <div class="absolute top-132 -right-102 -z-1">
                                <svg class="w-102 h-173" viewBox="0 0 102 173" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.5476 172.311C17.5476 172.311 85.5937 -33.8301 99.5363 19.3192C113.479 72.4686 0.535401 0.844557 0.535401 0.844557"
                                        stroke="#EDB903" stroke-width="2" stroke-dasharray="5 2" />
                                </svg>

                            </div>
                            <div class="absolute -z-1 bottom-28 left-50">
                                <svg class="w-289 h-143" viewBox="0 0 289 143" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0.999268 0.0380859C0.999268 0.0380859 7.99926 184.038 119.499 130.038C230.999 76.0381 287.499 142.038 287.499 142.038"
                                        stroke="#EDB903" stroke-width="2" stroke-dasharray="5 2" />
                                </svg>
                            </div>
                            @foreach ($o_nas['images'] as $index => $image_item)
                                @if ($image_item['image'])
                                    <div
                                        class="gallery-item shadow-special rounded-32 {{ $index === 0 ? 'h-280 lg:h-420 relative' : '-z-1 lg:absolute h-280 bottom-0 -right-123' }}">
                                        {!! wp_get_attachment_image($image_item['image'], 'full', false, [
                                            'class' => 'shadow-special rounded-32 object-cover object-center size-full',
                                        ]) !!}
                                    </div>
                                    <div class="absolute z-10 pointer-events-none bottom-81 right-131">
                                                <img src="@asset('resources/images/ebalans-sygnet.png')" alt="" class="size-104">
                                            </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-span-full lg:col-span-6 lg:col-start-7">
                    <div class="flex flex-col gap-24 o-nas-content">
                        @if ($o_nas['title'])
                            <div class="section-title text-h2 text-color-3" data-aos="fade-up" data-aos-delay="100">
                                {!! $o_nas['title'] !!}
                            </div>
                        @endif

                        @if ($o_nas['description'])
                            <div class="section-description text-body" data-aos="fade-up" data-aos-delay="200">
                                {!! $o_nas['description'] !!}
                            </div>
                        @endif

                        @if ($o_nas['button'])
                            <div class="section-button" data-aos="fade-up" data-aos-delay="300">
                                @php
                                    acf_link($o_nas['button'], 'btn btn--primary');
                                @endphp
                            </div>
                        @endif
                        @if ($o_nas['add_services'])
                            <div class="flex flex-wrap justify-between lg:mt-16 services-grid gap-y-16">
                                @foreach ($o_nas['add_services'] as $service)
                                    <div
                                        class="flex items-center gap-16 py-8 pl-6 pr-32 bg-white rounded-full min-w-320 service-item shadow-special" data-aos="fade-up" data-aos-delay="{{ 400 + ($loop->index * 100) }}">
                                        @if ($service['image'])
                                            <div
                                                class="flex items-center justify-center rounded-full service-icon bg-color-2 size-56">
                                                {!! wp_get_attachment_image($service['image'], 'full', false, ['class' => 'size-32']) !!}
                                            </div>
                                        @endif
                                        @if ($service['text'])
                                            <div class="service-text text-h5 text-color-3">
                                                {!! $service['text'] !!}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
