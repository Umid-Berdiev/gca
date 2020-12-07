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
                    @foreach($table as $value)
                        <div class="item_documents">
                            <div class="item_documents_left">
                                <span class="date_ban">@lang('blog.register_date'): {{$value->r_date}} | @lang('blog.number'): {{$value->r_number}} </span>
                                <a href="{{URL(App::getLocale().'/doc/'.$value->doc_category_id.'/'.$value->group)}}">{{$value->title}}</a>
                                <p>@lang('blog.register_date'): {{$value->r_date}} | @lang('blog.number'): {{$value->r_number}}</p>
                            </div>
                            <div class="item_documents_right">
                                @if($value->file_type == 'docx' ||  $value->file_type == 'doc')
                                <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$value->id)}}">
                                    <img src="{{asset('project_gca/images/word.svg')}}" alt="">
                                </a>
                                @elseif($value->file_type == 'pdf')
                                    <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$value->id)}}">
                                        <img src="{{asset('project_gca/images/pdf.svg')}}" alt="">
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                        {{ $table->links() }}

                        <div class="text_center">
                            {{ $table->links() }}
                        </div>
                </div>
                <div class="bar_inner_right">
                    <div class="bar_inner_events event_bord">
                        <h3>@lang('blog.docs')</h3>
                        @foreach($newscat as $value)

                            <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}" class="news_item">
                                {{--                                    <img src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}" alt="">--}}
                                <div>
                                    {{--                                        <span>{{ \Carbon\Carbon::parse($value->created_at)->format('d.m.Y')  }}</span>--}}
                                    <p>{{$value->category_name}}</p>
                                </div>
                            </a>
                        @endforeach
                        <hr>
                        <h3>@lang('blog.events')</h3>
                        @foreach($events as $value)
                            <a href="{{URL(App::getLocale().'/event/'.$value->event_category_id.'/'.$value->group)}}" class="news_item">
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