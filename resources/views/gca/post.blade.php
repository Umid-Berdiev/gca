@extends('gca.layout')
@section('content')
{{--@section('main_top_layout')--}}
{{--    <section class="main_top_layout" style="background-image: url({{asset('gca/images/main.jpg')}});">--}}
{{--        <div class="container">--}}
{{--            <h2>--}}
{{--                <span>News & Articles</span>--}}
{{--            </h2>--}}
{{--        </div>--}}
{{--    </section--}}
{{--@endsection--}}

<section class="inner_all">
    <div class="container">
        <div class="bar_inner">
            <div class="bar_inner_left">
                <div class="text_layout">
                    <span class="date_ban">{{ \Carbon\Carbon::parse($news->datetime)->format('d.m.Y') }}</span>
                    <h1>{{$news->title}}</h1>
                    <img src="{{ URL(App::getLocale().'/downloads?type=post&id='.$news->group) }}" alt="{{$news->title}}">
                    {!! $news->content !!}
                    </div>
            </div>
            <div class="bar_inner_right">
                <div class="bar_inner_events event_bord">
                    <h3>@lang('blog.news')</h3>
                    @foreach($news_in as $value)

                        <a  href="{{ URL(App::getLocale().'/posts/'.$value->category_group_id .'/'.$value->group)  }}" class="news_item {{ $value->group == $news->group ? 'active' : ''}}">
                            {{--                                    <img src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}" alt="">--}}
                            <div>
                                {{--                                        <span>{{ \Carbon\Carbon::parse($value->created_at)->format('d.m.Y')  }}</span>--}}
                                <p>{{$value->title}}</p>
                            </div>
                        </a>
                    @endforeach
                    <hr>
                    <h3>@lang('blog.events')</h3>
                    @foreach($events as $value)
                    <a href="{{URL(App::getLocale().'/event/'.$value->event_category_id).'/'.$value->group}}" class="news_item">
                        <img src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}" alt="">
                        <div>
                            <span>{{ \Carbon\Carbon::parse($value->created_at)->format('d.m.Y')  }}</span>
                            <p>{{$value->title}}</p>
                        </div>
                    </a>
                        @endforeach

                </div>

            </div>
        </div>
    </div>
</section>
@endsection