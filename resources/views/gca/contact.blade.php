@extends('gca.layout')
@section('content')
@section('main_top_layout')
<section class="main_top_layout" style="background-image: url({{asset('gca/images/main.jpg')}});">
    <div class="container">
        <h2>
            <span>@lang('blog.callback')</span>
        </h2>
    </div>
</section>
@endsection

<section class="contact_inner">
    <div class="container">
        <h2 class="title">@lang('blog.map_point')</h2>
        <div id="map"><iframe
                src="https://yandex.ru/map-widget/v1/?um=constructor%3A458036ea9a31a6999429075e1efd9d7f6ebd5b2b42325b43324932b42c5889b5&amp;source=constructor"
                width="1105" height="500" frameborder="0"></iframe></div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success">
            <p>{{ session()->get('message') }}</p>
        </div>
        @endif
        <form action="{{URL('/contact_post')}}" method="post">
            {{csrf_field()}}
            <h3>@lang('blog.callback')</h3>
            {{--            <p>Don’t hesitate to contact us</p>--}}
            <div class="contact_socials">
                <div class="">
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.38433 4.61486C4.17608 5.40595 5.09337 6.16304 5.45599 5.8005C5.97465 5.28194 6.29475 4.82989 7.43911 5.74949C8.58298 6.6686 7.7042 7.28167 7.20154 7.78372C6.62136 8.36379 4.45867 7.81473 2.321 5.67798C0.183822 3.54074 -0.363852 1.37849 0.216832 0.798424C0.719491 0.295367 1.32968 -0.582733 2.24897 0.560897C3.16876 1.70453 2.71712 2.02456 2.19746 2.54362C1.83634 2.90617 2.59308 3.82327 3.38433 4.61486Z"
                            fill="#2DA37D"></path>
                    </svg>
                    <span>@lang('blog.phone'): </span>
                    <a href="tel:+998 93 501 07 40">
                        +998 93 501 07 40
                    </a>
                </div>
                <div class="">
                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 0H1C0.45 0 0.005 0.45 0.005 1L0 7C0 7.55 0.45 8 1 8H9C9.55 8 10 7.55 10 7V1C10 0.45 9.55 0 9 0ZM9 2L5 4.5L1 2V1L5 3.5L9 1V2Z"
                            fill="#2DA37D"></path>
                    </svg>
                    <span>@lang('blog.email'): </span>
                    <a href="mailto:mukabbat.kamalova@giz.de">
                        mukabbat.kamalova@giz.de
                    </a>
                </div>
                <div class="">
                    <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z"
                            fill="#2DA37D"></path>
                    </svg>
                    <span>@lang('blog.address'):</span>
                    <a href="" onclick="return false;">
                        @lang('blog.address')
                    </a>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputName">@lang('blog.full_name')</label>
                <input class="form-control" name="fio" type="text" id="exampleInputName">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">@lang('blog.email')</label>
                <input class="form-control" name="email" type="email" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputTel">@lang('blog.phone_number')</label>
                <input class="form-control" name="phone" type="tel" id="exampleInputTel">
            </div>
            <div class="form-group">
                <label for="exampleInputTel">@lang('blog.message_text')</label>
                <textarea class="form-control" name="comment"></textarea>
            </div>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6Lc8vZYaAAAAAA-AXC2hKjGHcQqgkCPfJVF5Jz29" data-callback="enable"></div>
                @if($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback " style="display:block">
                <strong class="text-danger">{{$errors->first('g-recaptcha-response')}}</strong>
                @endif
            </span>

              </div>
            <button type="submit" class="btn link_template btn-danger" disabled id="btn">@lang('blog.form_btn_send')</button>
        </form>
    </div>
</section>
{{--<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A458036ea9a31a6999429075e1efd9d7f6ebd5b2b42325b43324932b42c5889b5&amp;width=600&amp;height=450&amp;lang=ru_RU&amp;scroll=true"></script>--}}{{--<script src="https://api-maps.yandex.ru/2.1/?apikey=318a59ea-1b14-4af4-b521-d9e6f0fecf2f&lang=ru_RU" type="text/javascript"></script>--}}
{{--<script type="text/javascript">--}}
{{--    // Функция ymaps.ready() будет вызвана, когда--}}
{{--    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.--}}
{{--    ymaps.ready(init);--}}
{{--    function init(){--}}
{{--        // Создание карты.--}}
{{--        var myMap = new ymaps.Map("map", {--}}
{{--            // Координаты центра карты.--}}
{{--            // Порядок по умолчанию: «широта, долгота».--}}
{{--            // Чтобы не определять координаты центра карты вручную,--}}
{{--            // воспользуйтесь инструментом Определение координат.--}}
{{--            center: [55.76, 37.64],--}}
{{--            // Уровень масштабирования. Допустимые значения:--}}
{{--            // от 0 (весь мир) до 19.--}}
{{--            zoom: 12--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
@endsection
@push('scripts')
    <script>
        function enable()
        {
            var btn=document.getElementById('btn')

            btn.disabled=false;
        }
    </script>
@endpush