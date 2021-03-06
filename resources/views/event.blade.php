@extends('layout.defualt')
@section('left_sidebar_menu')
@endsection
@section('content_div')
<div class="container-fluid" id="page_content" style="background-color: #F5F5F5">
    <div class="container">
        @endsection
        <div class="row">
            @section('nowosti')
            <div class="page-content">
                <div>
                    <ol class="breadcrumb h6">
                        <li><a href="{{URL(App::getLocale().'/')}}" title="@lang('blog.bosh')">@lang('blog.bosh')</a>
                        </li>
                        <li>{{ $curcat->category_name }}</li>
                    </ol>
                </div>
            </div>

            <div class="page-header row">
                <div class="col-md-9">
                    <h4><b>{{ $curcat->category_name }}</b></h4>
                </div>
                <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                    <a class="page-print-link" target="_self"><span class="glyphicon glyphicon-print"></span> Чоп этиш
                    </a>
                    <a class="rss-link pull-right"
                        href="{{URL(\Illuminate\Support\Facadesapp()->getLocale().'/rss/event')}}"><img
                            src="{{URL('/images/Feed-icon.svg.png')}}" alt="" width="20" height="20"> RSS</a>
                </div>
            </div>
            <br>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="tenders-filter">
                <form action="{{URL(App::getLocale().'/events/filter')}}" method="get" name="tenders_archive_filter">
                    <input type="hidden" name="cutcat" value="{{$curcat->group}}">
                    <table width="100%" class="text-center">
                        <tbody>
                            <tr>
                                <td> Муддат: </td>
                                <td>
                                    <input type="date" id="" name="start"
                                        value="@if(Request::has('start') && !empty(Request::get('start')) ){{ date("Y-m-d",strtotime(Request::get('start')))}}@endif"
                                        class="input-text form-control" autocomplete="off"><img src="#" alt="" class=""
                                        onclick="#" onmouseover="" onmouseout="" border="0"></td>
                                <td> дан </td>
                                <td>
                                    <input type="date" id="" name="finish"
                                        value="@if(Request::has('finish') && !empty(Request::get('finish'))){{date("Y-m-d",strtotime(Request::get('finish')))}}@endif"
                                        class="input-text form-control" autocomplete="off"><img src="" alt=""
                                        class="calendar-icon" onclick="" onmouseover="" onmouseout="" border="0"></td>
                                <td> гача </td>
                                <td><input type="submit" class="btn btn-warning" value="Чиқариш"></td>
                                <td><a href="{{URL(App::getLocale().'/event/'.$curcat->group)}}" name="clear"
                                        class="btn btn-warning">Тозалаш</a></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <br>
            <div id="print_all">
                @foreach($table as $value)
                <div class="item page-header">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <a href="{{ URL(App::getLocale().'/event/'.$curcat->group.'/'.$value->group) }}"><img
                                    class="img-responsive"
                                    src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}"></a>

                        </div>
                        <div class="col-md-9 col-sm-8 section-to-print">
                            <?php $date=date_create($value->created_at) ?>
                            <?php $date_start=date_create($value->datestart) ?>
                            <?php $date_finish=date_create($value->dateend) ?>
                            <h4><a
                                    href="{{ URL(App::getLocale().'/event/'.$curcat->group.'/'.$value->group) }}">{{ $value->title }}</a>
                            </h4>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="small">Ташкилотчи: <span
                                            class="text-primary">{{ $value->organization }}</span></p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="small">Бошланиш санаси: <span
                                            class="text-primary">{{date_format($date_start,"d.m.Y")}}</span></p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="small">Тугаш санаси: <span
                                            class="text-primary">{{date_format($date_finish,"d.m.Y")}}</span></p>
                                </div>
                            </div>
                            <p style="text-align: justify;">{{ $value->description }}</p>
                        </div>
                    </div><br><!-- .row -->
                </div><!-- .item -->
                @endforeach
            </div>


            {{ $table->appends(['cutcat'=>Request::get('cutcat'),'start'=>Request::get('start'),'finish'=>Request::get('finish')])->links() }}

            @endsection

            @section('statistika')
            @endsection
        </div>
        @section('nav_page')
        <div class="col-md-3" style="padding-top: 50px;">
            <div class="col menu-item-structure">
                <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                    <h4>{{ $curcat->category_name }}</h4>
                </div>
                <div class="list-group">
                    @foreach($newscat as $value)
                    @if ($value->id == $curcat->id)
                    <a href="{{ URL(App::getLocale().'/event/'.$value->group) }}"
                        class="list-group-item active">{{$value->category_name}}</a>
                    @else
                    <a href="{{ URL(App::getLocale().'/event/'.$value->group) }}"
                        class="list-group-item">{{$value->category_name}}</a>
                    @endif
                    @endforeach





                </div>
            </div>
        </div>
        @endsection
    </div>
</div>
@section('tender')

@foreach($tenders as $key=>$tender)
<div class="row">
    <div class="col-xs-4" style="padding-top: 10px">
        <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}"><img
                class="img-responsive center-block"
                src="{{URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)}}" alt=""></a>
    </div>
    <div class="col-xs-8">
        <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}">
            <h6>{{$tender->title}}</h6>
        </a>
    </div>
</div>
@endforeach

@endsection
@section('regional_uprav')
@endsection
@section('poleznaya-info')
@endsection
@section('video_foto_baner')
@endsection
</div>