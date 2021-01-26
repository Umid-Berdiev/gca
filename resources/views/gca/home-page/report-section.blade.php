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
          <div class="report_main_item_img">
            <img src="{{ asset('storage/statistics/' . $item->photo_url) }}" alt="stat image">
          </div>
          <p>{{ $item->name }}</p>
        </a>
      </div>
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>