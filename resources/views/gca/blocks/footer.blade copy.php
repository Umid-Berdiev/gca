<?php $menus = DB::table("menumakers")
    ->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())
    ->where("parent_id", "=", 0)
    ->orderBy('orders', 'ASC')
    ->get(); ?>

<footer>
    <div class="ftr_top">
        <div class="container">
            <div class="ftr_top_main">
                <div class="ft1">
                    <a href="index.html" class="logo">
                        <img src="{{asset('project_gca/images/logo.png')}}" alt="">
                    </a>
                    <p>@lang('blog.address_placeholder')</p>
                    <div class="abouts">
                        <a href="tel:+998 71 241 40 48">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.38433 4.61486C4.17608 5.40595 5.09337 6.16304 5.45599 5.8005C5.97465 5.28194 6.29475 4.82989 7.43911 5.74949C8.58298 6.6686 7.7042 7.28167 7.20154 7.78372C6.62136 8.36379 4.45867 7.81473 2.321 5.67798C0.183822 3.54074 -0.363852 1.37849 0.216832 0.798424C0.719491 0.295367 1.32968 -0.582733 2.24897 0.560897C3.16876 1.70453 2.71712 2.02456 2.19746 2.54362C1.83634 2.90617 2.59308 3.82327 3.38433 4.61486Z"
                                      fill="#2DA37D"/>
                            </svg>
                            +998 71 241 40 48
                        </a>
                        <a href="mailto:info@giz.de">
                            <svg width="10" height="8" viewBox="0 0 10 8" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 0H1C0.45 0 0.005 0.45 0.005 1L0 7C0 7.55 0.45 8 1 8H9C9.55 8 10 7.55 10 7V1C10 0.45 9.55 0 9 0ZM9 2L5 4.5L1 2V1L5 3.5L9 1V2Z"
                                      fill="#2DA37D"/>
                            </svg>
                            info@giz.de
                        </a>
                        <a href="" onclick="return false;">
                            <svg width="7" height="10" viewBox="0 0 7 10" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z"
                                      fill="#2DA37D"/>
                            </svg>
                            @lang('blog.address')</a>
                    </div>
                </div>
                <div class="ft2">
                    <h5>@lang('blog.map')</h5>

{{--                    <ul>--}}
{{--                        <li><a href="#">About us</a></li>--}}
{{--                        <li><a href="#">Partners</a></li>--}}
{{--                        <li><a href="#">Documents</a></li>--}}
{{--                        <li><a href="#">Publications</a></li>--}}
{{--                        <li><a href="#">News</a></li>--}}
{{--                        <li><a href="#">Media</a></li>--}}
{{--                    </ul>--}}
                    <ul>
                        @foreach($menus as $value)
                            <?php $modelsx = DB::table("menumakers")
                                ->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())
                                ->where("parent_id", "=", $value->group)
                                ->orderBy('orders', 'ASC')
                                ->get(); ?>
                            @if(count($modelsx) >0)
                                <li >
                                    @foreach($modelsx as $valuex)
{{--                                        @php dd($valuex) @endphp--}}
                                    @if($valuex->group == 1603288573)
                                    <a href="{{ URL(App::getLocale()."/photo/1603197076") }}">
                                        {{ $value->menu_name }}
                                    </a>
                                    @elseif($valuex->group == 1603217598)
                                        <a href="{{ URL(App::getLocale()."/doc/1546094482") }}">
                                            {{ $value->menu_name }}
                                        </a>
                                    @endif
                                    @endforeach
                                    <ul>
                                        @foreach($modelsx as $valuex)
                                            <?php $modelsxs = DB::table("menumakers")
                                                ->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())
                                                ->where("parent_id", "=", $valuex->group)
                                                ->orderBy('orders', 'ASC')
                                                ->get(); ?>
                                            @if(count($modelsxs) >0)
                                                <li class="sub_menu">
                                                    <a href="#">
                                                        {{ $valuex->menu_name }}
                                                    </a>

                                                    <ul class="sub_menu">
                                                        @foreach($modelsxs as $valuexx)

                                                            <li><a href="@if($valuexx->type =="1")
                                                                @if(strpos($valuexx->link, "http") ===true)
                                                                {{ $valuexx->link }}
                                                                @else       {{ URL(App::getLocale().$valuexx->link) }}     @endif
                                                                @elseif($valuexx->type =="2")
                                                                {{ URL(App::getLocale()."/posts/".$valuexx->alias_category_id) }}
                                                                @elseif($valuexx->type =="3")
                                                                <?php   $pages = DB::table("pages")
                                                                    ->where("language_id", "=", \App\Http\Controllers\NewsController::getlangid())
                                                                    ->where("page_group_id", "=", $valuexx->alias_category_id)
                                                                    ->first(); ?>
                                                                {{ URL(App::getLocale()."/page/".$pages->page_category_group_id."/".$pages->page_group_id) }}
                                                                @elseif($valuexx->type =="4")
                                                                {{ URL(App::getLocale()."/doc/"/1603263016) }}
                                                                @elseif($valuexx->type =="5")
                                                                {{ URL(App::getLocale()."/event/".$valuexx->alias_category_id) }}
                                                                @elseif($valuexx->type =="6")
                                                                {{ URL(App::getLocale()."/tender/".$valuexx->alias_category_id) }}
                                                                @elseif($valuexx->type =="7")
                                                                @elseif($valuexx->type =="8")
                                                                @endif">{{ $valuexx->menu_name }}</a></li>
{{--                                                            <li role="separator" class="divider"></li>--}}
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                @endif

                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="@if($value->type =="1")
                                    @if(strpos($valuex->link, "http") === true)
                                    {{ $value->link }}
                                    @else       {{ URL(App::getLocale().$value->link) }}     @endif
                                    @elseif($value->type =="2")
                                    {{ URL(App::getLocale()."/posts/".$value->alias_category_id) }}
                                    @elseif($value->type =="3")
                                    <?php   $pages= DB::table("pages")
                                        ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                        ->where("page_group_id","=",$value->alias_category_id)
                                        ->first();?>
                                    {{ URL(App::getLocale()."/page/".$pages->page_category_group_id."/$pages->page_group_id") }}
                                    @elseif($value->type =="4")
                                    {{ URL(App::getLocale()."/doc/".$value->alias_category_id) }}
                                    @elseif($value->type =="5")
                                    {{ URL(App::getLocale()."/event/".$value->alias_category_id) }}
                                    @elseif($value->type =="6")
                                    {{ URL(App::getLocale()."/tender/".$value->alias_category_id) }}
                                    @elseif($value->type =="7")
                                    {{ URL(App::getLocale()."/video/".$value->alias_category_id) }}
                                    @elseif($value->type =="8")
                                    {{ URL(App::getLocale()."/photo/".$value->alias_category_id) }}
                                    @endif">
                                        {{ $value->menu_name }}</a></li>
                                <li role="separator" class="divider"></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="ft3">
{{--                    <h5>Events</h5>--}}
{{--                    <a href="#" class="news_item">--}}
{{--                        <img src="{{asset('project_gca/images/ne.jpg')}}" alt="">--}}
{{--                        <div>--}}
{{--                            <span>02 Aug 2020</span>--}}
{{--                            <p>There are many variations of passages.</p>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="news_item">--}}
{{--                        <img src="{{asset('project_gca/images/ne.jpg')}}" alt="">--}}
{{--                        <div>--}}
{{--                            <span>02 Aug 2020</span>--}}
{{--                            <p>There are many variations of passages.</p>--}}
{{--                        </div>--}}
{{--                    </a>--}}
                </div>
                <div class="ft4">
                    <h5>@lang('blog.additional_message')</h5>
                    <p>@lang('blog.additional_message_placeholder')</p>
                    <form action="#" class="form_template">
                        <div class="form-group">
                            <input type="email" placeholder="Email Address">
                            <button type="submit">GO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="ftr_bottom">
        <div class="container">
            <div class="ftr_bottom_main">
                <p>© Copyright 2020 by Green Central Asia</p>
                <div class="socials">
                    <a href="https://twitter.com/GreenCentralAs1">
                        <svg width="15" height="13" viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.4589 3.03633C13.4689 3.16991 13.4689 3.30272 13.4689 3.43553C13.4689 7.5 10.3753 12.1835 4.72166 12.1835C2.97985 12.1835 1.36169 11.679 0 10.8027C0.247303 10.831 0.485447 10.8409 0.742673 10.8409C2.1265 10.8442 3.47113 10.3815 4.55984 9.52727C3.91824 9.51566 3.29629 9.30398 2.78081 8.92179C2.26534 8.5396 1.88209 8.00598 1.68456 7.39543C1.87462 7.42367 2.06544 7.44275 2.26542 7.44275C2.54096 7.44275 2.81803 7.40459 3.07526 7.33818C2.37896 7.1976 1.75285 6.82018 1.30339 6.27011C0.853931 5.72004 0.608864 5.03128 0.609862 4.32093V4.28277C1.01974 4.51099 1.49527 4.65372 1.99903 4.67281C1.57701 4.39237 1.23096 4.01182 0.991761 3.56513C0.752564 3.11843 0.627656 2.61947 0.62818 2.11276C0.62818 1.54183 0.780073 1.01822 1.04646 0.561775C1.819 1.51208 2.78254 2.28951 3.87467 2.84372C4.9668 3.39794 6.16316 3.71658 7.38627 3.77901C7.33895 3.55002 7.30994 3.31264 7.30994 3.0745C7.30974 2.67069 7.38913 2.27081 7.54357 1.8977C7.698 1.52459 7.92446 1.18559 8.20999 0.900052C8.49553 0.614519 8.83454 0.388061 9.20764 0.233624C9.58075 0.0791871 9.98063 -0.000200269 10.3844 3.79399e-07C11.2698 3.79399e-07 12.069 0.370955 12.6308 0.970894C13.3191 0.837791 13.9791 0.586522 14.5817 0.228221C14.3523 0.938695 13.8717 1.54114 13.23 1.92271C13.8404 1.85308 14.437 1.69254 15 1.44642C14.5795 2.05941 14.0585 2.59695 13.4589 3.03633Z"/>
                        </svg>
                    </a>
                    {{--                    <a href="#">--}}
                    {{--                        <svg width="15" height="11" viewBox="0 0 15 11" xmlns="http://www.w3.org/2000/svg">--}}
                    {{--                            <path d="M14.6949 1.65109C14.6095 1.33436 14.4427 1.04552 14.211 0.813306C13.9793 0.581093 13.6908 0.413608 13.3743 0.327524C12.2006 0.00525183 7.50519 5.69335e-06 7.50519 5.69335e-06C7.50519 5.69335e-06 2.81051 -0.00524075 1.63609 0.302791C1.31976 0.392837 1.03189 0.56269 0.800109 0.796043C0.568331 1.0294 0.400432 1.31841 0.31253 1.63535C0.00299911 2.80902 1.09808e-06 5.2433 1.09808e-06 5.2433C1.09808e-06 5.2433 -0.00299677 7.68957 0.304286 8.85124C0.476664 9.49354 0.982556 10.0009 1.6256 10.1741C2.81126 10.4963 7.49395 10.5016 7.49395 10.5016C7.49395 10.5016 12.1894 10.5068 13.363 10.1995C13.6797 10.1136 13.9684 9.94651 14.2007 9.71477C14.433 9.48303 14.6007 9.19468 14.6874 8.87823C14.9976 7.70531 14.9999 5.27178 14.9999 5.27178C14.9999 5.27178 15.0149 2.82476 14.6949 1.65109ZM6.00325 7.49845L6.007 3.00163L9.90949 5.25379L6.00325 7.49845Z"/>--}}
                    {{--                        </svg>--}}
                    {{--                    </a>--}}
                    <a href="https://www.facebook.com/GreenCentralAsia/">
                        <svg width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.723125 0H12.285C12.6831 0 13 0.316875 13 0.715V12.285C13 12.675 12.6831 13 12.285 13H8.97V7.9625H10.66L10.9119 6.00438H8.97V4.75312C8.97 4.18437 9.1325 3.79437 9.945 3.79437H10.985V2.03938C10.8063 2.015 10.1888 1.96625 9.47375 1.96625C7.97062 1.96625 6.94688 2.87625 6.94688 4.55813V6.00438H5.24875V7.9625H6.94688V13H0.723125C0.53274 13 0.350031 12.9249 0.21465 12.7911C0.0792686 12.6572 0.00213916 12.4754 0 12.285V0.715C0 0.316875 0.325 0 0.723125 0Z"/>
                        </svg>
                    </a>
                    {{--                    <a href="#">--}}
                    {{--                        <svg width="16" height="13" viewBox="0 0 16 13" xmlns="http://www.w3.org/2000/svg">--}}
                    {{--                            <path d="M14.4545 0.085478L0.723792 5.38029C-0.213274 5.75666 -0.207853 6.27941 0.551867 6.51251L4.07709 7.61221L12.2334 2.46609C12.6191 2.23144 12.9715 2.35767 12.6818 2.61478L6.07359 8.5787H6.07204L6.07359 8.57948L5.83041 12.2131C6.18665 12.2131 6.34386 12.0497 6.54367 11.8569L8.25594 10.1919L11.8176 12.8226C12.4743 13.1843 12.9459 12.9984 13.1093 12.2147L15.4473 1.19602C15.6866 0.236493 15.081 -0.197965 14.4545 0.085478Z"/>--}}
                    {{--                        </svg>--}}
                    {{--                    </a>--}}
                    {{--                    <a href="#">--}}
                    {{--                        <svg width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">--}}
                    {{--                            <path d="M8.69375 6.5C8.69375 5.28125 7.71875 4.30625 6.5 4.30625C5.28125 4.30625 4.30625 5.28125 4.30625 6.5C4.30625 7.71875 5.28125 8.69375 6.5 8.69375C7.71875 8.69375 8.69375 7.71875 8.69375 6.5ZM9.83125 6.5C9.83125 8.36875 8.36875 9.83125 6.5 9.83125C4.63125 9.83125 3.16875 8.36875 3.16875 6.5C3.16875 4.63125 4.63125 3.16875 6.5 3.16875C8.36875 3.16875 9.83125 4.63125 9.83125 6.5ZM10.725 3.00625C10.725 3.49375 10.4 3.81875 9.9125 3.81875C9.425 3.81875 9.1 3.49375 9.1 3.00625C9.1 2.51875 9.425 2.19375 9.9125 2.19375C10.4 2.19375 10.725 2.6 10.725 3.00625ZM6.5 1.1375C5.525 1.1375 3.49375 1.05625 2.68125 1.38125C2.1125 1.625 1.625 2.1125 1.4625 2.68125C1.1375 3.49375 1.21875 5.525 1.21875 6.5C1.21875 7.475 1.1375 9.50625 1.4625 10.3187C1.625 10.8875 2.1125 11.375 2.68125 11.5375C3.49375 11.8625 5.60625 11.7812 6.5 11.7812C7.39375 11.7812 9.50625 11.8625 10.3187 11.5375C10.8875 11.2938 11.2938 10.8875 11.5375 10.3187C11.8625 9.425 11.7812 7.39375 11.7812 6.5C11.7812 5.60625 11.8625 3.49375 11.5375 2.68125C11.375 2.1125 10.8875 1.625 10.3187 1.4625C9.50625 1.05625 7.475 1.1375 6.5 1.1375ZM13 6.5V9.18125C13 10.1562 12.675 11.1313 11.9438 11.9438C11.2125 12.675 10.2375 13 9.18125 13H3.81875C2.84375 13 1.86875 12.675 1.05625 11.9438C0.40625 11.2125 0 10.2375 0 9.18125V6.5V3.81875C0 2.7625 0.40625 1.7875 1.05625 1.05625C1.86875 0.40625 2.84375 0 3.81875 0H9.18125C10.1562 0 11.1313 0.325 11.9438 1.05625C12.5938 1.7875 13 2.7625 13 3.81875V6.5Z"/>--}}
                    {{--                        </svg>--}}
                    {{--                    </a>--}}
                </div>
            </div>
        </div>
    </div>
    <div id="menu">
        <a href="header" class="template_bord">
            <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.129118 4.42349C0.129118 4.26408 0.18491 4.13656 0.296493 4.04091L4.17003 0.167375C4.28162 0.0557915 4.40914 -2.00673e-07 4.5526 -1.94402e-07C4.69607 -1.88131e-07 4.83156 0.0557915 4.95909 0.167375L8.83262 4.04091C8.94421 4.1525 9 4.28799 9 4.4474C9 4.6068 8.94421 4.73432 8.83262 4.82997C8.72104 4.92561 8.59352 4.9814 8.45005 4.99734C8.30659 5.01328 8.17109 4.95749 8.04357 4.82997L4.5526 1.339L1.06164 4.82997C0.950053 4.94155 0.82253 4.99734 0.679065 4.99734C0.5356 4.99734 0.408076 4.94155 0.296493 4.82997C0.18491 4.71838 0.129118 4.58289 0.129118 4.42349Z"
                      fill="white"></path>
            </svg>
        </a>
    </div>
</footer>