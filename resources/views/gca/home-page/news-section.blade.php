<section class="recent_programms">
  <div class="container">
    <h2 class="title">{{ __('blog.news') }}</h2>
    <div class="row">
      @foreach($posts_for as $item)
      <div class="col-lg-3 col-sm-6">
        <a href="{{ url(app()->getLocale().'/posts/'.$item->category_group_id .'/'.$item->group)  }}" class="card">
          <div class="card-img">
            <img src="{{ asset('storage/posts/' . $item->cover) }}" alt="News image">
          </div>
          <div class="card-body">
            <span class="card_time">{{ \Carbon\Carbon::parse($item->datetime)->format('d.m.Y') }}</span>
            <h5 class="card-title">{{ $item->title}}</h5>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>