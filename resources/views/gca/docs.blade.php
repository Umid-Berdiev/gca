@extends('gca.layout')
@section('content')
<section class="inner_all">
    <div class="container">
        <div class="bar_inner">
            <div class="bar_inner_left">
                @forelse($table as $value)
                <div class="item_documents">
                    <div class="item_documents_left">
<<<<<<< HEAD
                         <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$value->id)}}">
                            <img src="{{URL('\storage/images/'.$value->cover_image)}}"  width="200" height="250" alt="cover_image">
                        </a>
                    </div>
                    <div class="item_documents_right">
                        <a
                            href="{{URL(App::getLocale().'/doc/'.$value->doc_category_id.'/'.$value->group)}}">{{$value->title}}</a>
                            <span class="date_ban">
                                @lang('blog.register_date'): {{$value->r_date}} | @lang('blog.number'):{{$value->r_number}} 
                            </span>
                            <p>
                                {!!$value->description!!}
                            </p>
                     
=======
                        <a
                            href="{{URL(App::getLocale().'/doc/'.$value->doc_category_id.'/'.$value->group)}}">{{$value->title}}</a>
                        <span class="date_ban">@lang('blog.register_date'): {{$value->r_date}} | @lang('blog.number'):
                            {{$value->r_number}} </span>
                    </div>
                    <div class="item_documents_right">
                        @if($value->file_type == 'docx' || $value->file_type == 'doc')
                        <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$value->id)}}">
                            <img src="{{asset('project_gca/images/word.svg')}}" alt="">
                        </a>
                        @else{{-- if($value->file_type == 'pdf') --}}
                        <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$value->id)}}">
                            <img src="{{asset('project_gca/images/pdf.svg')}}" alt="">
                        </a>
                        
                        @endif
>>>>>>> b7d852de5b88bf72818bf9416e2159dbaaa142af
                    </div>
                </div>
                @empty
                <h3>@lang('blog.no_content')</h3>
                @endforelse
                <div class="text_center">
                    {{ $table->links() }}
                </div>
            </div>
            <div class="bar_inner_right">
                <div class="bar_inner_events event_bord">
                    <h3>@lang('blog.docs')</h3>
                    @foreach($newscat as $value)

                    <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}" class="news_item">
                        {{--                                    <img src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}"
                        alt="">--}}
                        <div>
                            {{--                                        <span>{{ \Carbon\Carbon::parse($value->created_at)->format('d.m.Y')  }}</span>--}}
                            <p>{{$value->category_name}}</p>
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>
@endsection