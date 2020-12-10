@extends('gca.layout')
@section('content')
@section('main_top_layout')
<section class="main_top_layout" style="background-image: url({{asset('gca/images/main.jpg')}});">
  <div class="container">
    <h2>
      <span>@lang('blog.video')</span>
    </h2>
  </div>
</section>
@endsection

<section class="news_inner media_section">
  <div class="container">
    <div class="card-deck">
      @foreach($table as $item)
      <div class="card">
        <iframe height="315" src="https://www.youtube.com/embed/{{ $item->youtube_link}}" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
      </div>
      @endforeach

    </div>
    <div class="text_center">
      {{ $table->links() }}
    </div>
  </div>
</section>
@endsection