@extends('layouts.app')

@section('content') 
  {{-- Hero Section --}}
  @include('sections.home.hero')

  {{-- Aktualności Section --}}
  @include('sections.home.aktualnosci')

  {{-- O nas Section --}}
  @include('sections.home.o-nas')

  {{-- Testimonials Section --}}
  @include('sections.home.testimonials')

  {{-- MSIT Section --}}
  @include('sections.home.msit')

  {{-- Our Materiały Section --}}
  @include('sections.home.our-materialy')

  {{-- How It Works Section --}}
  @include('sections.home.how-it-works')

  {{-- Partnerzy Section --}}
  @include('partials.partnerzy')

@endsection
