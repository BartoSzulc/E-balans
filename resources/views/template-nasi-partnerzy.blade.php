@php
/*
  Template Name: Nasi partnerzy
*/
@endphp

@extends('layouts.app')

@section('content')
  {{-- Hero Section with Breadcrumbs, Title and Partner Logos --}}
  @include('sections.nasi-partnerzy.hero')

  {{-- Mowią o nas Section --}}
  @include('sections.home.testimonials')

  {{-- Full Width Image Section --}}
  @include('sections.nasi-partnerzy.full-width-image')

  {{-- Referencje Section --}}
  @include('sections.nasi-partnerzy.referencje')

  {{-- Form Section --}}
  @include('partials.form-section')
@endsection
