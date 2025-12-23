@php
/*
  Template Name: O nas
*/
@endphp

@extends('layouts.app')

@section('content')
  @php
    $flexible_content = get_field('flexible_content');
  @endphp
  @include('partials.page-header')
  @if($flexible_content)
    @foreach($flexible_content as $layout)
      @switch($layout['acf_fc_layout'])
        @case('info')
          @include('partials.onas.info', ['layout' => $layout])
          @break

        @case('text_image')
          @include('partials.onas.text-image', ['layout' => $layout])
          @break

        @case('video')
          @include('partials.onas.video', ['layout' => $layout])
          @break

        @case('how_it_works')
          @include('partials.onas.how-it-works', ['layout' => $layout])
          @break

        @case('cta')
          @include('partials.onas.cta', ['layout' => $layout])
          @break
      @endswitch
    @endforeach
  @endif
@endsection
