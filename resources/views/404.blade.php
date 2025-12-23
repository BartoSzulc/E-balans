@extends('layouts.app')

@section('content')
<section class="relative py-50 lg:py-120 " >

        <div class="container relative z-10 h-full">
            <div class="relative z-10 flex flex-col items-center justify-center gap-32 pt-40 text-center lg:gap-48 ">
                <div class="font-semibold text-300 text-color-2 text-h2 z-1">
                    <div data-aos="fade-up">
                        <span>404</span>
                    </div>
                </div>
                <div class="z-10 text-h3 lg:text-h1" data-aos="fade-up" data-aos-delay="100">
                    <h1>Nie znaleziono strony, której szukasz</h1>
                </div>
                <div class="inline-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ home_url('/') }}" class="btn btn--primary !min-w-200">Strona główna</a>
                </div>
            </div>
        </div>
    </section>
@endsection
