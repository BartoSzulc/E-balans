{{--
  Template Name: Home Page
--}}

@extends('layouts.app')

@section('content')
  {{-- Hero Section --}}
  @include('sections.home.hero')

  {{-- About Us Section --}}
  @include('sections.home.about-us')

  {{-- Rozwiązania Section --}}
  @include('sections.home.rozwiazania')

  {{-- Standardy Section --}}
  @include('sections.home.standardy')

  {{-- Zobacz Jak Section --}}
  @include('sections.home.zobacz-jak')

  {{-- Opinie Section --}}
  @include('sections.home.opinie')

  {{-- Contact Section --}}
  @include('sections.home.contact')

@endsection
