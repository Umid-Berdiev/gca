<?php $__env->startSection('content'); ?>
<?php $__env->startSection('main_top_layout'); ?>

<?php $__env->stopSection(); ?>

<section class="main-slider swiper-container">
    <div class="swiper-wrapper">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide"
                 style="background-image: url(<?php echo e(URL(App::getLocale().'/downloads?type=post&id='.$item->group)); ?>);">
                <div class="p-3 mt-auto" style="background-color: rgba(0,0,0,0.5);">
                    <p><?php echo e(\Carbon\Carbon::parse($item->datetime)->format('d.m.Y')); ?></p>
                    <h3 class="text-white"><?php echo e($item->title); ?></h3>
                    <br>
                    <a href="<?php echo e(URL(App::getLocale().'/posts/'.$item->category_group_id .'/'.$item->group)); ?>"
                       class="link_template"><?php echo app('translator')->getFromJson('blog.discover_more'); ?></a>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="swiper-button-prev">
        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.98113 14C6.72956 14 6.5283 13.912 6.37736 13.7359L0.26415 7.62265C0.088049 7.44655 -1.26681e-06 7.24529 -1.22722e-06 7.01887C-1.18763e-06 6.79246 0.0880492 6.57862 0.26415 6.37736L6.37736 0.264158C6.55346 0.0880572 6.76729 6.90528e-06 7.01887 6.94926e-06C7.27044 6.99325e-06 7.4717 0.0880573 7.62264 0.264158C7.77358 0.440259 7.86163 0.641517 7.88679 0.867932C7.91195 1.09435 7.8239 1.30818 7.62264 1.50944L2.11321 7.01887L7.62264 12.5283C7.79874 12.7044 7.88679 12.9057 7.88679 13.1321C7.88679 13.3585 7.79874 13.5598 7.62264 13.7359C7.44654 13.912 7.2327 14 6.98113 14Z"
                  fill="#7B7A7E"/>
        </svg>
    </div>
    <div class="swiper-button-next">
        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.47346 6.1031e-07C1.72503 5.88317e-07 1.92629 0.0880505 2.07723 0.264151L8.19044 6.37736C8.36654 6.55346 8.45459 6.75472 8.45459 6.98113C8.45459 7.20755 8.36654 7.42138 8.19044 7.62264L2.07723 13.7358C1.90113 13.912 1.68729 14 1.43572 14C1.18415 14 0.982893 13.912 0.831949 13.7358C0.681005 13.5597 0.592955 13.3585 0.567798 13.1321C0.542641 12.9057 0.630691 12.6918 0.831949 12.4906L6.34138 6.98113L0.831948 1.4717C0.655847 1.2956 0.567797 1.09434 0.567797 0.867925C0.567797 0.64151 0.655847 0.440252 0.831948 0.264151C1.00805 0.0880505 1.22188 6.32303e-07 1.47346 6.1031e-07Z"
                  fill="#7B7A7E"/>
        </svg>
    </div>
</section>
<section class="logotypes">
    <div class="container">
        <div class="logotypes_main row justify-content-between no-gutters py-5">
            <div class="col-2">
                <a target="blank" href="https://www.auswaertiges-amt.de/en">
                    <img src="<?php echo e(asset('GCAlogos/Federal-Foreign-Office.png')); ?>" alt="logo">
                </a>
            </div>
            <div class="col-2">
                <a target="blank" href="#">
                    <img src="<?php echo e(asset('GCAlogos/German-cooperation-logo.jpg')); ?>" alt="logo">
                </a>
            </div>
            <div class="col-2">
                <a target="blank" href="https://www.giz.de">
                    <img src="<?php echo e(asset('GCAlogos/GIZ-implemented-Logo-Square.jpg')); ?>" alt="logo">
                </a>
            </div>
            <div class="col-2">
                <a target="blank" href="https://www.dku.kz" target="blank">
                    <img src="<?php echo e(asset('GCAlogos/DKU.jpg')); ?>" alt="logo">
                </a>
            </div>
            <div class="col-2">
                <a target="blank"
                   href="https://www.gfz-potsdam.de/ueber-uns/organisation/vorstand-gremien-verwaltung/vorstand/">
                    <img src="<?php echo e(asset('GCAlogos/GFZ-potsdam.jpg')); ?>" alt="logo">
                </a>
            </div>
            <div class="col-2">
                <a target="blank" href="https://www.pik-potsdam.de/en/institute?set_language=en">
                    <img src="<?php echo e(asset('GCAlogos/PIK.jpg')); ?>" alt="logo">
                </a>
            </div>
        </div>
    </div>
</section>
<section class="about_us">
    <div class="container">
        <div class="about_us_main">
            <div class="about_us_main_left">
                <div class="mini_img">
                    <img src="<?php echo e(asset('project_gca/images/mountain.jpg')); ?>" alt="">
                </div>
                <div class="big_img">
                    <img src="<?php echo e(asset('project_gca/images/mountain2.jpg')); ?>" alt="">
                </div>
            </div>
            <div class="about_us_main_right">
                <span class="template_span"><?php echo app('translator')->getFromJson('blog.about_us'); ?></span>
                <h2 class="title"><?php echo app('translator')->getFromJson('blog.activity_head'); ?></h2>
                <p class="title"><?php echo app('translator')->getFromJson('blog.activity'); ?></p>

                <a href="<?php echo e(URL(App::getLocale().'/page/15/80')); ?>" class="link_template"><?php echo app('translator')->getFromJson('blog.discover_more'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="recent_programms">
    <div class="container">
        
        <h2 class="title"><?php echo app('translator')->getFromJson('blog.news'); ?></h2>
        <div class="row">
            <?php $__currentLoopData = $posts_for; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo e(URL(App::getLocale().'/posts/'.$item->category_group_id .'/'.$item->group)); ?>Read Our Publications
"
                       class="card">
                        <div class="card-img"><img
                                    src="<?php echo e(URL(App::getLocale().'/downloads?type=post&id='.$item->group)); ?>"
                                    alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <span class="card_time"><?php echo e(\Carbon\Carbon::parse($item->datetime)->format('d.m.Y')); ?></span>
                            <h5 class="card-title"><?php echo e($item->title); ?></h5>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<section class="wish" style="background-image: url(<?php echo e(asset('project_gca/images/wish.jpg)')); ?>);">
    <div class="container">
        <h2 class="title"><?php echo app('translator')->getFromJson('blog.you_must'); ?></h2>
        <a href="<?php echo e(URL(App::getLocale().'/posts/1603259067')); ?>" class="link_template"><?php echo app('translator')->getFromJson('blog.discover_more'); ?></a>
    </div>
</section>
<section class="report">
    <div class="container">
        <span class="template_span"><?php echo app('translator')->getFromJson('blog.statistica'); ?></span>
        <h2 class="title"><?php echo app('translator')->getFromJson('blog.gca'); ?></h2>
    </div>
    <div class="swiper-container swiper_docs">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $statisticas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide" data-fancybox=":gallery"
                     data-src="<?php echo e(URL(App::getLocale().'/downloads?type=statistica&id='.$item->id)); ?>">
                    <a href="#" class="report_main_item">
                        <div class="report_main_item_img">
                            <img src="<?php echo e(URL(App::getLocale().'/downloads?type=statistica&id='.$item->id)); ?>" alt="">
                        </div>
                        <p><?php echo e($item->name); ?></p>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="swiper-pagination"></div>
        <!--  <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div> -->
    </div>
</section>
<section class="map_section">
    <div class="container">
        <div class="row" id="apps" v-cloak>
            
            
            
            
            
            
            


            <div class="col-md-6" v-if="gca">
                <span class="template_span">{{ gca.title }}</span>
                <p style="line-height: 12px;">{{ gca.bilateral }} Bilateral projects</p>
                <p style="line-height: 12px;">{{ gca.transnational }} Transnational projects</p>
                <span class="template_span">Contacts</span>
                <p style="line-height: 12px;">
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.38433 4.61486C4.17608 5.40595 5.09337 6.16304 5.45599 5.8005C5.97465 5.28194 6.29475 4.82989 7.43911 5.74949C8.58298 6.6686 7.7042 7.28167 7.20154 7.78372C6.62136 8.36379 4.45867 7.81473 2.321 5.67798C0.183822 3.54074 -0.363852 1.37849 0.216832 0.798424C0.719491 0.295367 1.32968 -0.582733 2.24897 0.560897C3.16876 1.70453 2.71712 2.02456 2.19746 2.54362C1.83634 2.90617 2.59308 3.82327 3.38433 4.61486Z"
                              fill="#2DA37D"/>
                    </svg>
                    {{ gca.phone }}
                </p>
                <p style="line-height: 12px;">
                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 0H1C0.45 0 0.005 0.45 0.005 1L0 7C0 7.55 0.45 8 1 8H9C9.55 8 10 7.55 10 7V1C10 0.45 9.55 0 9 0ZM9 2L5 4.5L1 2V1L5 3.5L9 1V2Z"
                              fill="#2DA37D"/>
                    </svg>
                    {{ gca.email }}
                </p>
                <p style="line-height: 12px;">
                    <svg width="7" height="10" viewBox="0 0 7 10" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z"
                              fill="#2DA37D"/>
                    </svg>
                    {{ gca.address }}
                </p>
                <p style="line-height: 12px;">
                    <svg width="7" height="10" viewBox="0 0 7 10" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z"
                              fill="#2DA37D"/>
                    </svg>
                    {{ gca.wep }}
                </p>
                <span v-if="news.length > 0" class="template_span">News and Events</span>



                <div style="padding-le: 15px 30px!important;margin-bottom:0 " class="new_event" v-for="item in news">


                    <img :src="'en/downloads?type=post&id=' + item.group" alt="">
                    <div class="new_event_date">
                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C4.4122 11 3.34884 10.6774 2.44437 10.0731C1.5399 9.46874 0.834947 8.60975 0.418665 7.60476C0.00238306 6.59977 -0.106535 5.4939 0.105683 4.42701C0.317902 3.36011 0.841726 2.3801 1.61091 1.61091C2.3801 0.841726 3.36011 0.317902 4.42701 0.105683C5.4939 -0.106535 6.59977 0.00238306 7.60476 0.418665C8.60975 0.834947 9.46874 1.5399 10.0731 2.44437C10.6774 3.34884 11 4.4122 11 5.5C11 6.95869 10.4205 8.35764 9.38909 9.38909C8.35764 10.4205 6.95869 11 5.5 11ZM5.5 0.785717C4.5676 0.785717 3.65615 1.0622 2.88089 1.58022C2.10563 2.09823 1.50138 2.8345 1.14457 3.69592C0.787757 4.55735 0.694399 5.50523 0.8763 6.41971C1.0582 7.33419 1.50719 8.1742 2.1665 8.8335C2.8258 9.49281 3.66581 9.9418 4.58029 10.1237C5.49477 10.3056 6.44266 10.2122 7.30408 9.85543C8.1655 9.49862 8.90177 8.89438 9.41979 8.11912C9.9378 7.34386 10.2143 6.4324 10.2143 5.5C10.2143 4.2497 9.7176 3.0506 8.8335 2.1665C7.9494 1.2824 6.75031 0.785717 5.5 0.785717Z"
                                  fill="#2DA37D"/>
                            <path d="M7.30322 7.85721L5.10715 5.66114V1.96436H5.89286V5.33507L7.85715 7.30328L7.30322 7.85721Z"
                                  fill="#2DA37D"/>
                        </svg>
                        {{ item.created_at }}
                    </div>
                    <div class="new_event_adr">
                        <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.43965 0C1.53959 0 0 1.5334 0 3.43277C0 6.71695 3.43965 11 3.43965 11C3.43965 11 6.8793 6.71626 6.8793 3.43277C6.8793 1.53408 5.33971 0 3.43965 0ZM3.43965 5.33215C2.94703 5.33215 2.47459 5.13645 2.12626 4.78812C1.77793 4.43979 1.58224 3.96735 1.58224 3.47473C1.58224 2.98212 1.77793 2.50968 2.12626 2.16135C2.47459 1.81301 2.94703 1.61732 3.43965 1.61732C3.93227 1.61732 4.40471 1.81301 4.75304 2.16135C5.10137 2.50968 5.29706 2.98212 5.29706 3.47473C5.29706 3.96735 5.10137 4.43979 4.75304 4.78812C4.40471 5.13645 3.93227 5.33215 3.43965 5.33215Z"
                                  fill="#2DA37D"/>
                        </svg>
                        News
                    </div>
                    <a :href="'/en/posts/1603259067/' + item.group">{{ item.title }}</a>
                </div>
            </div>


            <div class="col-md-6">
                <div id="chartdiv" style="height: 100%"></div>
            </div>
        </div>
    </div>
</section>







































<section class="calendars" style="background: url(<?php echo e(asset('project_gca/images/card2.jpg')); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-4 left_cal">
                <span class="template_span"><?php echo app('translator')->getFromJson('blog.coming_events'); ?></span>
                <div class="bts_cal">
                    <div id="datepicker"></div>
                    <input type="hidden" id="my_hidden_input">
                    <img src="<?php echo e(asset('project_gca/images/t.png')); ?>" alt="">
                </div>
                <div class="events_bottom">
                    <a href="<?php echo e(URL(App::getLocale().'/event/1603263686')); ?>"
                       class="link_template"><?php echo app('translator')->getFromJson('blog.all_events'); ?></a>
                    <a href="#" class="joines"><?php echo app('translator')->getFromJson('blog.join'); ?></a>
                </div>
            </div>
            <div class="col-lg-6 col-sm-8 right_cal">
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="new_event"
                         onclick="window.location.href='<?php echo e(URL(App::getLocale().'/event/'.$value->event_category_id)); ?>'">


                        <div class="new_event_date">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 11C4.4122 11 3.34884 10.6774 2.44437 10.0731C1.5399 9.46874 0.834947 8.60975 0.418665 7.60476C0.00238306 6.59977 -0.106535 5.4939 0.105683 4.42701C0.317902 3.36011 0.841726 2.3801 1.61091 1.61091C2.3801 0.841726 3.36011 0.317902 4.42701 0.105683C5.4939 -0.106535 6.59977 0.00238306 7.60476 0.418665C8.60975 0.834947 9.46874 1.5399 10.0731 2.44437C10.6774 3.34884 11 4.4122 11 5.5C11 6.95869 10.4205 8.35764 9.38909 9.38909C8.35764 10.4205 6.95869 11 5.5 11ZM5.5 0.785717C4.5676 0.785717 3.65615 1.0622 2.88089 1.58022C2.10563 2.09823 1.50138 2.8345 1.14457 3.69592C0.787757 4.55735 0.694399 5.50523 0.8763 6.41971C1.0582 7.33419 1.50719 8.1742 2.1665 8.8335C2.8258 9.49281 3.66581 9.9418 4.58029 10.1237C5.49477 10.3056 6.44266 10.2122 7.30408 9.85543C8.1655 9.49862 8.90177 8.89438 9.41979 8.11912C9.9378 7.34386 10.2143 6.4324 10.2143 5.5C10.2143 4.2497 9.7176 3.0506 8.8335 2.1665C7.9494 1.2824 6.75031 0.785717 5.5 0.785717Z"
                                      fill="#2DA37D"/>
                                <path d="M7.30322 7.85721L5.10715 5.66114V1.96436H5.89286V5.33507L7.85715 7.30328L7.30322 7.85721Z"
                                      fill="#2DA37D"/>
                            </svg>
                            <?php echo e(\Carbon\Carbon::parse($value->datestart)->format('d.m.Y')); ?>

                            -<?php echo e(\Carbon\Carbon::parse($value->dateend)->format('d.m.Y')); ?>

                        </div>
                        <div class="new_event_adr">
                            <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.43965 0C1.53959 0 0 1.5334 0 3.43277C0 6.71695 3.43965 11 3.43965 11C3.43965 11 6.8793 6.71626 6.8793 3.43277C6.8793 1.53408 5.33971 0 3.43965 0ZM3.43965 5.33215C2.94703 5.33215 2.47459 5.13645 2.12626 4.78812C1.77793 4.43979 1.58224 3.96735 1.58224 3.47473C1.58224 2.98212 1.77793 2.50968 2.12626 2.16135C2.47459 1.81301 2.94703 1.61732 3.43965 1.61732C3.93227 1.61732 4.40471 1.81301 4.75304 2.16135C5.10137 2.50968 5.29706 2.98212 5.29706 3.47473C5.29706 3.96735 5.10137 4.43979 4.75304 4.78812C4.40471 5.13645 3.93227 5.33215 3.43965 5.33215Z"
                                      fill="#2DA37D"/>
                            </svg>
                            <?php echo e($value->organization); ?>

                        </div>
                        <a href="<?php echo e(URL(App::getLocale().'/event/'.$value->event_category_id.'/'.$value->group)); ?>"><?php echo e($value->title); ?></a>
                        <img src="<?php echo e(URL(App::getLocale().'/downloads?type=event&id='.$value->group)); ?>" alt="">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<section class="media_section">
    <div class="swiper-container swiper_media for_med">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <div class="over" data-fancybox=":gallery"
                         data-src="<?php echo e(URL(App::getLocale().'/downloads?type=photoin&id='.$item->id)); ?>">
                        <img src="<?php echo e(URL(App::getLocale().'/downloads?type=photoin&id='.$item->id)); ?>">
                        <svg width="40" height="36" viewBox="0 0 40 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.24 4L27.9 8H36V32H4V8H12.1L15.76 4H24.24ZM26 0H14L10.34 4H4C1.8 4 0 5.8 0 8V32C0 34.2 1.8 36 4 36H36C38.2 36 40 34.2 40 32V8C40 5.8 38.2 4 36 4H29.66L26 0ZM20 14C23.3 14 26 16.7 26 20C26 23.3 23.3 26 20 26C16.7 26 14 23.3 14 20C14 16.7 16.7 14 20 14ZM20 10C14.48 10 10 14.48 10 20C10 25.52 14.48 30 20 30C25.52 30 30 25.52 30 20C30 14.48 25.52 10 20 10Z"
                                  fill="white"/>
                        </svg>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<section class="news_section">
    <div class="container">
        <span class="template_span"><?php echo app('translator')->getFromJson('blog.docs'); ?></span>
        <h2 class="title"><?php echo app('translator')->getFromJson('blog.new_docs'); ?></h2>
        <div class="row">
            <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-4">
                    <div class="cart_item_news"
                         style="background-image: url(<?php echo e(URL(App::getLocale().'/downloads?type=docs&id='.$item->group)); ?>">
                        <div class="info_item_news">
                                          <span>
                                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                              <path d="M5.5 11C4.4122 11 3.34884 10.6774 2.44437 10.0731C1.5399 9.46874 0.834947 8.60975 0.418665 7.60476C0.00238306 6.59977 -0.106535 5.4939 0.105683 4.42701C0.317902 3.36011 0.841726 2.3801 1.61091 1.61091C2.3801 0.841726 3.36011 0.317902 4.42701 0.105683C5.4939 -0.106535 6.59977 0.00238306 7.60476 0.418665C8.60975 0.834947 9.46874 1.5399 10.0731 2.44437C10.6774 3.34884 11 4.4122 11 5.5C11 6.95869 10.4205 8.35764 9.38909 9.38909C8.35764 10.4205 6.95869 11 5.5 11ZM5.5 0.785717C4.5676 0.785717 3.65615 1.0622 2.88089 1.58022C2.10563 2.09823 1.50138 2.8345 1.14457 3.69592C0.787757 4.55735 0.694399 5.50523 0.8763 6.41971C1.0582 7.33419 1.50719 8.1742 2.1665 8.8335C2.8258 9.49281 3.66581 9.9418 4.58029 10.1237C5.49477 10.3056 6.44266 10.2122 7.30408 9.85543C8.1655 9.49862 8.90177 8.89438 9.41979 8.11912C9.9378 7.34386 10.2143 6.4324 10.2143 5.5C10.2143 4.2497 9.7176 3.0506 8.8335 2.1665C7.9494 1.2824 6.75031 0.785717 5.5 0.785717Z"
                                                    fill="white"/>
                                              <path d="M7.30319 7.85721L5.10712 5.66114V1.96436H5.89283V5.33507L7.85712 7.30328L7.30319 7.85721Z"
                                                    fill="white"/>
                                            </svg>
                                          </span>
                            <span>

                                
                                
                                
                                
                                
                                <?php echo e(\Carbon\Carbon::parse($item->r_date)->format('d.m.Y')); ?>

              </span>
                        </div>
                        <a href="<?php echo e(URL(App::getLocale().'/doc/1603263016/'.$item->group)); ?>">
                            <h3><?php echo e($item->title); ?></h3>
                        </a>
                        <a href="<?php echo e(URL(App::getLocale().'/doc/1603263016/'.$item->group)); ?>" class="template_bord">
                            <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.129118 4.42349C0.129118 4.26408 0.18491 4.13656 0.296493 4.04091L4.17003 0.167375C4.28162 0.0557915 4.40914 -2.00673e-07 4.5526 -1.94402e-07C4.69607 -1.88131e-07 4.83156 0.0557915 4.95909 0.167375L8.83262 4.04091C8.94421 4.1525 9 4.28799 9 4.4474C9 4.6068 8.94421 4.73432 8.83262 4.82997C8.72104 4.92561 8.59352 4.9814 8.45005 4.99734C8.30659 5.01328 8.17109 4.95749 8.04357 4.82997L4.5526 1.339L1.06164 4.82997C0.950053 4.94155 0.82253 4.99734 0.679065 4.99734C0.5356 4.99734 0.408076 4.94155 0.296493 4.82997C0.18491 4.71838 0.129118 4.58289 0.129118 4.42349Z"
                                      fill="white"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>

<?php $__env->startSection('scripts'); ?>

    <script>
        let app = new Vue({
            el: "#apps",
            data: {
                gca: '',
                news: '',

            },
            methods: {
                init: function () {
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create map instance
                    var chart = am4core.create("chartdiv", am4maps.MapChart);

                    // Set map definition
                    chart.geodata = am4geodata_worldLow;

                    // Set projection
                    chart.projection = new am4maps.projections.Miller();

                    // Series for World map
                    var worldSeries = chart.series.push(new am4maps.MapPolygonSeries());
                    worldSeries.include = ["UZ", "KZ", "TM", "AF", "KG", "TJ"];

                    worldSeries.useGeodata = true;

                    var polygonTemplate = worldSeries.mapPolygons.template;
                    polygonTemplate.tooltipText = "{name}";
                    polygonTemplate.fill = chart.colors.getIndex(0);
                    polygonTemplate.nonScalingStroke = true;

                    polygonTemplate.events.on("hit", function (ev) {
                        if (ev.target.dataItem.dataContext.name == 'Turkmenistan')
                            app.getGcaInfo('TM')
                        else if (ev.target.dataItem.dataContext.name == 'Uzbekistan')
                            app.getGcaInfo('UZ')
                        else if (ev.target.dataItem.dataContext.name == 'Kazakhstan')
                            app.getGcaInfo('KZ')
                        else if (ev.target.dataItem.dataContext.name == 'Kyrgyzstan')
                            app.getGcaInfo('KG')
                        else if (ev.target.dataItem.dataContext.name == 'Afghanistan')
                            app.getGcaInfo('AF')
                        else if (ev.target.dataItem.dataContext.name == 'Tajikistan')
                            app.getGcaInfo('TJ')
                    });
                    // Hover state
                    var hs = polygonTemplate.states.create("hover");
                    hs.properties.fill = am4core.color("#367B25");

                    // Series for United States map
                    var usaSeries = chart.series.push(new am4maps.MapPolygonSeries());
                    // usaSeries.geodata = am4geodata_usaLow;

                    var usPolygonTemplate = usaSeries.mapPolygons.template;
                    usPolygonTemplate.tooltipText = "{name}";
                    usPolygonTemplate.fill = chart.colors.getIndex(1);
                    usPolygonTemplate.nonScalingStroke = true;

                    // Hover state
                    var hs = usPolygonTemplate.states.create("hover");
                    hs.properties.fill = am4core.color("#367B25");

                },
                getGcaInfo: function (prefix) {
                    axios.get('<?php echo e(route('gca.info.get')); ?>', {
                        params: {
                            prefix: prefix
                        }
                    })
                        .then(function (response) {
                            app.gca = response.data;
                            app.news = response.data.news;
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });


                }

            },
            mounted() {
                this.init();
                this.getGcaInfo("UZ");
            }
        })
    </script>
    <script type="text/javascript">
        let mySwiper = new Swiper('.main-slider', {
            autoplay: {
                delay: 5000,
            },
            effect: 'fade',
            loop: true
        });
    </script>
    <script !src="">
        /**
         * ---------------------------------------
         * This demo was created using amCharts 4.
         *
         * For more information visit:
         * https://www.amcharts.com/
         *
         * Documentation is available at:
         * https://www.amcharts.com/docs/v4/
         * ---------------------------------------
         */


    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('gca.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\gca\index.blade.php ENDPATH**/ ?>