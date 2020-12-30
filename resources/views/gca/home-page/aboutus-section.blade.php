<section class="about_us">
  <div class="container">
    <div class="about_us_main">
      <div class="about_us_main_left">
        <div class="mini_img">
          <img src="{{ asset('project_gca/images/mountain.jpg') }}" alt="">
        </div>
        <div class="big_img">
          <img src="{{ asset('project_gca/images/mountain2.jpg') }}" alt="">
        </div>
      </div>
      <div class="about_us_main_right">
        <span class="template_span">@lang('blog.about_us')</span>
        <h2 class="title">@lang('blog.activity_head')</h2>
        <p class="title">@lang('blog.activity')</p>

        <a href="{{ url(app()->getLocale().'/page/15/80') }}" class="link_template">@lang('blog.discover_more')</a>
      </div>
    </div>
  </div>
</section>