@extends('site.layouts.master')
@section('title')
    {{ $blog_title }}
@endsection
@section('description')
    {{ strip_tags($blog->intro) }}
@endsection
@section('image')
    {{ $blog->image ? $blog->image->path : '' }}
@endsection

@section('css')
    <link href="/site/css/breadcrumb_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/blog_article_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/sidebar_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
@endsection

@section('content')
    <section class="bread-crumb">
        <div class="container">
            <ul class="breadcrumb">
                <li class="home">
                    <a href="{{ route('front.home-page') }}"><span>Trang chủ</span></a>
                    <span class="mr_lr">&nbsp;/&nbsp;</span>
                </li>
                <li>
                    <a
                        href="{{ route('front.list-blog', $blog->category->slug) }}"><span>{{ $blog->category->name }}</span></a>
                    <span class="mr_lr">&nbsp;/&nbsp;</span>
                </li>
                <li><span>{{ $blog->name }}</span></li>
            </ul>
            <div class="title_full">
                {{ $blog->name }}
            </div>
        </div>
    </section>
    <section class="blogpage">
        <div class="container layout-article" itemscope itemtype="https://schema.org/Article">
            <div class="bg_blog">
                <article class="article-main">
                    <div class="row">
                        <div class="right-content col-lg-9 col-12">
                            <div class="article-details clearfix">
                                <h1 class="article-title">{{ $blog->name }}</h1>
                                <div class="posts">
                                    <div class="time-post f">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14"
                                            viewBox="0 0 13 14" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.19926 4.25024C6.49268 4.25024 6.73054 4.48811 6.73054 4.78153V8.051C6.73054 8.34442 6.49268 8.58228 6.19926 8.58228C5.90583 8.58228 5.66797 8.34442 5.66797 8.051V4.78153C5.66797 4.48811 5.90583 4.25024 6.19926 4.25024Z"
                                                fill="#7B7B7B" />
                                            <path
                                                d="M7.26187 8.32356C7.26187 8.91041 6.78614 9.38614 6.19929 9.38614C5.61245 9.38614 5.13672 8.91041 5.13672 8.32356C5.13672 7.73672 5.61245 7.26099 6.19929 7.26099C6.78614 7.26099 7.26187 7.73672 7.26187 8.32356Z"
                                                fill="#7B7B7B" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M4.20142 1.75332C5.44136 1.05586 6.95535 1.05586 8.19529 1.75332L10.3204 2.94872C11.603 3.67016 12.3967 5.02729 12.3967 6.49883V8.73132C12.3967 10.2029 11.603 11.56 10.3204 12.2814L8.19529 13.4768C6.95535 14.1743 5.44136 14.1743 4.20142 13.4768L2.07627 12.2814C0.793712 11.56 0 10.2029 0 8.73132V6.49883C0 5.02729 0.793712 3.67016 2.07627 2.94872L4.20142 1.75332ZM7.67435 2.67944C6.75788 2.16392 5.63884 2.16392 4.72236 2.67944L2.59721 3.87484C1.64923 4.40807 1.06258 5.41117 1.06258 6.49883V8.73132C1.06258 9.81898 1.64923 10.8221 2.59721 11.3553L4.72236 12.5507C5.63884 13.0662 6.75788 13.0662 7.67435 12.5507L9.7995 11.3553C10.7475 10.8221 11.3341 9.81898 11.3341 8.73132V6.49883C11.3341 5.41117 10.7475 4.40807 9.79951 3.87484L7.67435 2.67944Z"
                                                fill="#7B7B7B" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M4.51457 0.236639C4.67733 0.480781 4.61136 0.810641 4.36722 0.973403L2.24207 2.39017C1.99792 2.55293 1.66806 2.48696 1.5053 2.24282C1.34254 1.99868 1.40851 1.66881 1.65265 1.50605L3.77781 0.0892861C4.02195 -0.0734752 4.35181 -0.00750317 4.51457 0.236639Z"
                                                fill="#7B7B7B" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.88225 0.236639C8.04502 -0.00750317 8.37488 -0.0734752 8.61902 0.0892861L10.7442 1.50605C10.9883 1.66881 11.0543 1.99868 10.8915 2.24282C10.7288 2.48696 10.3989 2.55293 10.1548 2.39017L8.02961 0.973403C7.78547 0.810641 7.71949 0.480781 7.88225 0.236639Z"
                                                fill="#7B7B7B" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($blog->created_at)->locale('vi')->translatedFormat('l, d/m/Y') }}
                                    </div>
                                    <div class="time-post">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="13"
                                            viewBox="0 0 11 13" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.49918 1.06452C4.61731 1.06452 3.90241 1.77942 3.90241 2.66129C3.90241 3.54316 4.61731 4.25806 5.49918 4.25806C6.38106 4.25806 7.09596 3.54316 7.09596 2.66129C7.09596 1.77942 6.38106 1.06452 5.49918 1.06452ZM2.83789 2.66129C2.83789 1.1915 4.02939 0 5.49918 0C6.96897 0 8.16047 1.1915 8.16047 2.66129C8.16047 4.13108 6.96897 5.32258 5.49918 5.32258C4.02939 5.32258 2.83789 4.13108 2.83789 2.66129Z"
                                                fill="#7B7B7B" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.4958 7.45146C4.07636 7.44025 2.82529 7.85563 1.87218 8.21234C1.38538 8.39454 1.06452 8.8791 1.06452 9.4449V11.887C1.06452 12.1809 0.826216 12.4192 0.532258 12.4192C0.2383 12.4192 0 12.1809 0 11.887V9.4449C0 8.48202 0.554151 7.56901 1.49905 7.21537C2.47721 6.84927 3.88055 6.37415 5.5042 6.38697C6.9418 6.39832 8.08405 6.78769 9.0795 7.12702C9.18426 7.16273 9.28739 7.19788 9.38906 7.23199C10.3852 7.56609 11 8.50832 11 9.5239V11.887C11 12.1809 10.7617 12.4192 10.4677 12.4192C10.1738 12.4192 9.93548 12.1809 9.93548 11.887V9.5239C9.93548 8.9302 9.58017 8.41888 9.05056 8.24125C8.94767 8.20674 8.84527 8.17196 8.74304 8.13723C7.73957 7.79637 6.75338 7.46138 5.4958 7.45146Z"
                                                fill="#7B7B7B" />
                                        </svg>
                                        <span>By Admin</span>
                                    </div>
                                </div>
                                <div class="content-mucluc auto_get">
                                    <div class="article-content-wrap">
                                        {!! $blog->body !!}
                                    </div>
                                </div>
                            </div>
                            <div class="social-sharing">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="21"
                                        viewBox="0 0 19 21" fill="none">
                                        <path
                                            d="M15.3927 7.23665C14.2334 7.23665 13.1998 6.68182 12.5385 5.82448L7.00168 8.93028C7.13148 9.30431 7.2027 9.70774 7.2027 10.1239C7.2027 10.544 7.13148 10.9434 6.99765 11.3215L12.5304 14.423C13.1875 13.5616 14.2253 13.0025 15.3887 13.0025C17.3725 13.0025 18.9919 14.6246 18.9919 16.6207C18.9919 18.6171 17.3766 20.2393 15.3884 20.2393C13.4006 20.2393 11.7852 18.6171 11.7852 16.621C11.7852 16.2008 11.8564 15.7974 11.9903 15.4234L6.46179 12.3216C5.80473 13.1873 4.76686 13.7421 3.6035 13.7421C1.61968 13.7421 0 12.12 0 10.1239C0 8.12772 1.61968 6.5056 3.60753 6.5056C4.77089 6.5056 5.80876 7.06448 6.47012 7.93018L12.0029 4.82465C11.8691 4.44631 11.7935 4.03882 11.7935 3.61838C11.7935 1.62628 13.4089 0.000110626 15.3968 0.000110626C17.3846 0.000110626 19 1.62223 19 3.61838C19.0003 5.61453 17.3806 7.23665 15.3927 7.23665ZM15.3927 19.1005C16.7571 19.1005 17.8662 17.9867 17.8662 16.6167C17.8662 15.2466 16.7571 14.1329 15.3927 14.1329C14.0284 14.1329 12.9193 15.2466 12.9193 16.6167C12.9193 17.9867 14.0327 19.1005 15.3927 19.1005ZM3.60753 7.64009C2.24315 7.64009 1.13407 8.75379 1.13407 10.1239C1.13407 11.4939 2.24315 12.6076 3.60753 12.6076C4.97191 12.6076 6.08099 11.4939 6.08099 10.1239C6.08099 8.75379 4.96761 7.64009 3.60753 7.64009ZM15.3927 1.13865C14.0284 1.13865 12.9193 2.25235 12.9193 3.62243C12.9193 4.9925 14.0284 6.10621 15.3927 6.10621C16.7571 6.10621 17.8662 4.9925 17.8662 3.62243C17.8662 2.25235 16.7571 1.13865 15.3927 1.13865Z"
                                            fill="#494949" />
                                    </svg>
                                    Chia sẻ bài viết:
                                </span>
                                <ul class="social-media" role="list">
                                    <li class="social-media__item social-media__item--facebook">
                                        <a title="Chia sẻ lên Facebook"
                                            href="https://www.facebook.com/sharer.php?u={{ route('front.detail-blog', $blog->slug) }}"
                                            target="_blank" rel="noopener" aria-label="Chia sẻ lên Facebook">
                                            <svg focusable="false" class="icon icon--facebook" viewBox="0 0 30 30">
                                                <path
                                                    d="M15 30C6.71572875 30 0 23.2842712 0 15 0 6.71572875 6.71572875 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15zm3.2142857-17.1429611h-2.1428678v-2.1425646c0-.5852979.8203285-1.07160109 1.0714928-1.07160109h1.071375v-2.1428925h-2.1428678c-2.3564786 0-3.2142536 1.98610393-3.2142536 3.21449359v2.1425646h-1.0714822l.0032143 2.1528011 1.0682679-.0099086v7.499969h3.2142536v-7.499969h2.1428678v-2.1428925z"
                                                    fill="currentColor" fill-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="social-media__item social-media__item--pinterest">
                                        <a title="Chia sẻ lên Pinterest"
                                            href="https://pinterest.com/pin/create/button/?url={{ route('front.detail-blog', $blog->slug) }}"
                                            target="_blank" rel="noopener" aria-label="Pinterest">
                                            <svg focusable="false" class="icon icon--pinterest" role="presentation"
                                                viewBox="0 0 30 30">
                                                <path
                                                    d="M15 30C6.71572875 30 0 23.2842712 0 15 0 6.71572875 6.71572875 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15zm-.4492946-22.49876954c-.3287968.04238918-.6577148.08477836-.9865116.12714793-.619603.15784625-1.2950238.30765013-1.7959124.60980792-1.3367356.80672832-2.26284291 1.74754848-2.88355361 3.27881599-.1001431.247352-.10374313.4870343-.17702448.7625149-.47574032 1.7840923.36779138 3.6310327 1.39120339 4.2696951.1968419.1231267.6448551.3405257.8093833.0511377.0909873-.1603963.0706852-.3734014.1265202-.5593764.036883-.1231267.1532436-.3547666.1263818-.508219-.0455542-.260514-.316041-.4256572-.4299438-.635367-.230748-.4253041-.2421365-.8027267-.3541701-1.3723228.0084116-.0763633.0168405-.1527266.0253733-.2290899.0340445-.6372108.1384107-1.0968422.3287968-1.5502554.5593198-1.3317775 1.4578212-2.07273488 2.9088231-2.5163011.324591-.09899963 1.2400541-.25867013 1.7200175-.1523539.2867042.05078464.5734084.10156927.8600087.1523539 1.0390064.33760307 1.7953931.9602003 2.2007079 1.9316992.252902.6061594.3275507 1.7651044.1517724 2.5415071-.0833199.3679287-.0705641.6832289-.1770418 1.0168107-.3936666 1.2334841-.9709174 2.3763639-2.2765854 2.6942337-.8613761.2093567-1.5070793-.3321303-1.7200175-.8896824-.0589159-.1545509-.1598205-.4285603-.1011297-.6865243.2277711-1.0010987.5562045-1.8969797.8093661-2.8969995.24115-.9528838-.2166421-1.7048063-.9358863-1.8809146-.8949186-.2192233-1.585328.6350139-1.8211644 1.1943903-.1872881.4442919-.3005678 1.2641823-.1517724 1.8557085.0471811.1874265.2666617.689447.2276672.8640842-.1728187.7731269-.3685356 1.6039823-.5818373 2.3635745-.2219729.7906632-.3415527 1.5999416-.5564641 2.3639276-.098793.3507651-.0955738.7263439-.1770244 1.092821v.5337977c-.0739045.3379758-.0194367.9375444.0505042 1.2703809.0449484.2137505-.0261175.4786388.0758948.6357396.0020943.1140055.0159752.1388388.0506254.2031582.3168026-.0095136.7526829-.8673992.9106342-1.118027.3008274-.477913.5797431-.990879.8093833-1.5506281.2069844-.5042174.2391769-1.0621226.4046917-1.60104.1195798-.3894861.2889369-.843272.328918-1.2707535h.0252521c.065614.2342095.3033024.403727.4805692.5334446.5563429.4077482 1.5137774.7873678 2.5547742.5337977 1.1769151-.2868184 2.1141687-.8571599 2.7317812-1.702982.4549537-.6225776.7983583-1.3445472 1.0624066-2.1600633.1297394-.4011574.156982-.8454494.2529193-1.2711066.2405269-1.0661438-.0797199-2.3511383-.3794396-3.0497261-.9078995-2.11694836-2.8374975-3.32410832-5.918897-3.27881604z"
                                                    fill="currentColor" fill-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="social-media__item social-media__item--twitter">
                                        <a title="Chia sẻ lên Twitter"
                                            href="https://twitter.com/share?url={{ route('front.detail-blog', $blog->slug) }}"
                                            target="_blank" rel="noopener" aria-label="Tweet on Twitter">
                                            <svg focusable="false" class="icon icon--twitter" role="presentation"
                                                viewBox="0 0 30 30">
                                                <path
                                                    d="M15 30C6.71572875 30 0 23.2842712 0 15 0 6.71572875 6.71572875 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15zm3.4314771-20.35648929c-.134011.01468929-.2681239.02905715-.4022367.043425-.2602865.05139643-.5083383.11526429-.7319208.20275715-.9352275.36657324-1.5727317 1.05116784-1.86618 2.00016964-.1167278.3774214-.1643635 1.0083696-.0160821 1.3982464-.5276368-.0006268-1.0383364-.0756643-1.4800457-.1737-1.7415129-.3873214-2.8258768-.9100285-4.02996109-1.7609946-.35342035-.2497018-.70016357-.5329286-.981255-.8477679-.09067071-.1012178-.23357785-.1903178-.29762142-.3113357-.00537429-.0025553-.01072822-.0047893-.0161025-.0073446-.13989429.2340643-.27121822.4879125-.35394965.7752857-.32626393 1.1332446.18958607 2.0844643.73998215 2.7026518.16682678.187441.43731214.3036696.60328392.4783178h.01608215c-.12466715.041834-.34181679-.0159589-.45040179-.0360803-.25715143-.0482143-.476235-.0919607-.69177643-.1740215-.11255464-.0482142-.22521107-.09675-.3378675-.1449642-.00525214 1.251691.69448393 2.0653071 1.55247643 2.5503267.27968679.158384.67097143.3713625 1.07780893.391484-.2176789.1657285-1.14873321.0897268-1.47198429.0581143.40392643.9397285 1.02481929 1.5652607 2.09147249 1.9056375.2750861.0874928.6108975.1650857.981255.1593482-.1965482.2107446-.6162514.3825321-.8928439.528766-.57057.3017572-1.2328489.4971697-1.97873466.6450108-.2991075.0590785-.61700464.0469446-.94113107.0941946-.35834678.0520554-.73320321-.02745-1.0537875-.0364018.09657429.053325.19312822.1063286.28958036.1596536.2939775.1615821.60135.3033482.93309.4345875.59738036.2359768 1.23392786.4144661 1.93859037.5725286 1.4209286.3186642 3.4251707.175291 4.6653278-.1740215 3.4539354-.9723053 5.6357529-3.2426035 6.459179-6.586425.1416246-.5754053.162226-1.2283875.1527803-1.9126768.1716718-.1232517.3432215-.2465035.5148729-.3697553.4251996-.3074947.8236703-.7363286 1.118055-1.1591036v-.00765c-.5604729.1583679-1.1506672.4499036-1.8661597.4566054v-.0070232c.1397925-.0495.250515-.1545429.3619908-.2321358.5021089-.3493285.8288003-.8100964 1.0697678-1.39826246-.1366982.06769286-.2734778.13506429-.4101761.20275716-.4218407.1938214-1.1381067.4719375-1.689256.5144143-.6491893-.5345357-1.3289754-.95506074-2.6061215-.93461789z"
                                                    fill="currentColor" fill-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog_left_base col-lg-3 col-12">
                            @include('site.blogs.nav-blog', ['newBlogs' => $newBlogs, 'services' => $services])
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="clearfix blog_lienquan">
            <div class="container">
                <h2 class="block-title">
                    <a href="javascript:void(0)" title="Tin liên quan">Tin liên quan</a>
                </h2>
                <div class="clearfix">
                    <div class="blog-relate-swiper swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($other_blogs as $item)
                                <div class="swiper-slide">
                                    @include('site.blogs.item', ['post' => $item])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            var swiperwish = new Swiper('.blog-relate-swiper', {
                slidesPerView: 4,
                loop: false,
                grabCursor: true,
                spaceBetween: 20,
                roundLengths: true,
                slideToClickedSlide: false,
                navigation: {
                    nextEl: '.blog-relate-swiper .swiper-button-next',
                    prevEl: '.blog-relate-swiper .swiper-button-prev',
                },
                pagination: {
                    el: '.blog-relate-swiper .swiper-pagination',
                    clickable: true,
                },
                autoplay: false,
                breakpoints: {
                    300: {
                        slidesPerView: 1,
                        spaceBetween: 0
                    },
                    500: {
                        slidesPerView: 1,
                        spaceBetween: 0
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    991: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            });
        });
    </script>
@endsection

@push('script')
@endpush
