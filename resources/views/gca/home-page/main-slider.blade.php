<section class="main-slider swiper-container">
  <div class="swiper-wrapper">
    @foreach($posts as $item)
    <div class="swiper-slide" style="background-image: url({{ asset('storage/posts/' . $item->cover) }});">
      <div class="p-3 mt-auto" style="background-color: rgba(0,0,0,0.5);">
        <p>{{ \Carbon\Carbon::parse($item->datetime)->format('d.m.Y') }}</p>
        <h3 class="text-white">{{ $item->title}}</h3>
        <br>
        <a href="{{ url(app()->getLocale().'/posts/'.$item->category_group_id .'/'.$item->group) }}"
          class="link_template">@lang('blog.discover_more')</a>
      </div>
    </div>
    @endforeach
  </div>
  <div class="swiper-button-prev">
    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M6.98113 14C6.72956 14 6.5283 13.912 6.37736 13.7359L0.26415 7.62265C0.088049 7.44655 -1.26681e-06 7.24529 -1.22722e-06 7.01887C-1.18763e-06 6.79246 0.0880492 6.57862 0.26415 6.37736L6.37736 0.264158C6.55346 0.0880572 6.76729 6.90528e-06 7.01887 6.94926e-06C7.27044 6.99325e-06 7.4717 0.0880573 7.62264 0.264158C7.77358 0.440259 7.86163 0.641517 7.88679 0.867932C7.91195 1.09435 7.8239 1.30818 7.62264 1.50944L2.11321 7.01887L7.62264 12.5283C7.79874 12.7044 7.88679 12.9057 7.88679 13.1321C7.88679 13.3585 7.79874 13.5598 7.62264 13.7359C7.44654 13.912 7.2327 14 6.98113 14Z"
        fill="#7B7A7E" />
    </svg>
  </div>
  <div class="swiper-button-next">
    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M1.47346 6.1031e-07C1.72503 5.88317e-07 1.92629 0.0880505 2.07723 0.264151L8.19044 6.37736C8.36654 6.55346 8.45459 6.75472 8.45459 6.98113C8.45459 7.20755 8.36654 7.42138 8.19044 7.62264L2.07723 13.7358C1.90113 13.912 1.68729 14 1.43572 14C1.18415 14 0.982893 13.912 0.831949 13.7358C0.681005 13.5597 0.592955 13.3585 0.567798 13.1321C0.542641 12.9057 0.630691 12.6918 0.831949 12.4906L6.34138 6.98113L0.831948 1.4717C0.655847 1.2956 0.567797 1.09434 0.567797 0.867925C0.567797 0.64151 0.655847 0.440252 0.831948 0.264151C1.00805 0.0880505 1.22188 6.32303e-07 1.47346 6.1031e-07Z"
        fill="#7B7A7E" />
    </svg>
  </div>
</section>

@push('scripts')
<script type="text/javascript">
  let mySwiper = new Swiper('.main-slider', {
    autoplay: {
      delay: 5000,
    },
    effect: 'fade',
    loop: true
  });
</script>
@endpush