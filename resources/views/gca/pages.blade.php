@extends('gca.layout')
@section('content')
@section('main_top_layout')
<section class="main_top_layout" style="background-image: url({{asset('gca/images/main.jpg')}});">
  <div class="container">
    <h2>
      <span>{!! $page->title !!}</span>
      {!! $page->description !!}
    </h2>
  </div>
</section>
@endsection

<section class="about_inner">
  <div class="container">
    <div class="text_layout">
      {!! $page->content !!}
    </div>
  </div>
</section>
@endsection