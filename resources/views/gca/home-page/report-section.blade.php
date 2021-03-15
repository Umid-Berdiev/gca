<section class="report">
  <div class="container">
    <span class="template_span">@lang('blog.statistica')</span>
    <h2 class="title">@lang('blog.gca')</h2>
  </div>
  <div class="swiper-container swiper_docs">
    <div class="swiper-wrapper">
      @foreach($statisticas as $item)
      <div class="swiper-slide" data-fancybox=":gallery"
        data-src="{{ asset('storage/statistics/' . $item->photo_url) }}">
        <a href="#" class="report_main_item">
          <div class="">
            <img src="{{URL('\storage/statistics/'.$item->photo_url)}}" alt="stat1 image {{  $item->photo_url}}"
             width="400" height="400">
          </div>
          <p style="width:400px;">{{ $item->name }}</p>
        </a>
      </div>
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>