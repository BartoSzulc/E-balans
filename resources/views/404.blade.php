@extends('layouts.app')

@section('content')
<section class="relative py-80 lg:py-160 bg-color-3" >
    <div class="absolute bottom-0 left-0 bg-white pointer-events-none size-full rounded-b-20 lg:rounded-b-80 border-b-1 border-color-4">

    </div>
        <div class="container relative z-10 h-full">
            <div class="relative z-10 flex flex-col items-center justify-center gap-32 pt-40 text-center lg:gap-48 ">
                <div class="font-semibold opacity-30 text-300 text-color-2 z-1">
                    <div data-aos="fade-up">
                        <span>404</span>
                    </div>
                </div>
                <div class="z-10 text-h3 lg:text-h1" data-aos="fade-up" data-aos-delay="100">
                    <h1>Nie znaleziono strony, której szukasz</h1>
                </div>
                <div class="inline-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ home_url('/') }}" class="btn btn-primary !min-w-200"><span>Strona główna</span></a>
                </div>
            </div>
        </div>
    </section>
@endsection
