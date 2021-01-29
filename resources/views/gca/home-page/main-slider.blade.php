<section class="main-slider swiper-container">
  <div class="swiper-wrapper">
    @foreach($posts as $item)
    @if ($item->cover != 'null')
    <div class="swiper-slide" style="background-image: url({{ asset('storage/posts/' . $item->cover) }});">
      <div class="p-3 mt-auto" style="background-color: rgba(0,0,0,0.5);">
        <p>{{ \Carbon\Carbon::parse($item->datetime)->format('d.m.Y') }}</p>
        <h3 class="text-white">{{ $item->title}}</h3>
        <br>
        <a href="{{ url(app()->getLocale() . '/posts/' . $item->category_group_id . '/' . $item->group) }}"
          class="link_template">{{ __('blog.discover_more') }}</a>
      </div>
    </div>
    @endif
    @endforeach
  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</section>

@push('scripts')
<script>
  const swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>
@endpush