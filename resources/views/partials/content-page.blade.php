
<section class="relative py-40 lg:py-80 bg-color-3" >
    <div class="absolute bottom-0 left-0 bg-white pointer-events-none size-full rounded-b-20 lg:rounded-b-80 border-b-1 border-color-4">

    </div>
    <div class="container relative z-10 wysiwyg">
        <div class="grid grid-cols-12 gap-x-24">
            <div class="lg:col-start-2 lg:col-span-10 col-span-full">
                <div class="mb-40 font-bold text-h3 lg:text-h1 lg:mb-80 text-color-1" data-aos="fade-up" data-aos-delay="100">
                    <h1>@title</h1>
                </div>
            </div>
            <div class="col-span-full lg:col-start-2 lg:col-span-10 e-content">
                @php(the_content())
            </div>
        </div>
    </div>
</section>
