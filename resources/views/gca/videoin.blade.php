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
        <div class="row for_med">
            @foreach($table as $values)
                <div class="col-sm-3 col-4">
                    <video height="250" width="100%" controls>
                        <source src="{{URL(App::getLocale().'/downloads?type=videoin&id='.$values->id)}}" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                </div>
            @endforeach

        </div>
        <div class="text_center">
            {{ $table->links() }}
        </div>
    </div>
</section>
@endsection