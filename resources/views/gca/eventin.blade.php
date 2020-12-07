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
                        <span class="date_ban">{{ \Carbon\Carbon::parse($table->datestart)->format('d.m.Y') }} - {{ \Carbon\Carbon::parse($table->dateend)->format('d.m.Y') }} </span>
                        <h1>{{ $table->title }}</h1>
                        <img src="{{URL(App::getLocale().'/downloads?type=event&id='.$table->group)}}" alt="{{$table->title}}">
                        {!! $table->description !!}
                        {!! $table->content !!}
                    </div>
                </div>
                <div class="bar_inner_right">
                    <div class="bar_inner_events event_bord">
                        <h3>@lang('blog.events')</h3>
                        @foreach($events as $value)
                            <a href="{{URL(App::getLocale().'/event/'.$value->event_category_id.'/'.$value->group)}}" class="news_item">
                                <img src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}" alt="">
                                <div>
                                    <span>{{ \Carbon\Carbon::parse($table->datestart)->format('d.m.Y') }} - {{ \Carbon\Carbon::parse($table->dateend)->format('d.m.Y') }}</span>
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