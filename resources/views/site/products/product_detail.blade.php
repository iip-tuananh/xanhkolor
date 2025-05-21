@extends('site.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('description')
    {!! strip_tags($product->intro) !!}
@endsection
@section('image')
    {{ $product->image ? $product->image->path : $product->galleries[0]->image->path }}
@endsection

@section('css')
    <link href="/site/css/breadcrumb_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/product_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
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
                    <a class="changeurl"
                        href="{{ route('front.show-product-category', $product->category->slug) }}"><span>{{ $product->category->name }}</span></a>
                    <span class="mr_lr">&nbsp;/&nbsp;</span>
                </li>
                <li><span>{{ $product->name }}</span>
                <li>
            </ul>
            <div class="title_full">
                {{ $product->name }}
            </div>
        </div>
    </section>
    <section class="product layout-product" ng-controller="ProductDetailController">
        <div class="container">
            <div class="details-product">
                <div class="bg margin-bottom-20">
                    <div class="row margin-am-10">
                        <div class="product-detail-left product-images col-12 col-md-12 col-lg-6 col-left">
                            <div class="product-image-block relative">
                                <div class="swiper-image">
                                    <div class="swiper-container gallery-top">
                                        <div class="swiper-wrapper" id="lightgallery">
                                            @foreach ($product->galleries as $key => $item)
                                                <a class="swiper-slide" data-hash="{{ $key + 1 }}"
                                                    href="{{ $item->image->path }}" title="Click để xem">
                                                    <img height="540" width="540" src="{{ $item->image->path }}"
                                                        alt="{{ $product->name }}" data-image="{{ $item->image->path }}"
                                                        class="img-responsive mx-auto d-block swiper-lazy" />
                                                </a>
                                            @endforeach
                                            <a class="swiper-slide" data-hash="0" href="{{ $product->image->path }}"
                                                title="Click để xem">
                                                <img height="540" width="540" src="{{ $product->image->path }}"
                                                    alt="{{ $product->name }}" data-image="{{ $product->image->path }}"
                                                    class="img-responsive mx-auto d-block swiper-lazy" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-container gallery-thumbs">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide" data-hash="0">
                                                <div class="p-100">
                                                    <img height="80" width="80" src="{{ $product->image->path }}"
                                                        alt="{{ $product->name }}"
                                                        data-image="{{ $product->image->path }}" class="swiper-lazy" />
                                                </div>
                                            </div>
                                            @foreach ($product->galleries as $key => $item)
                                                <div class="swiper-slide" data-hash="{{ $key + 1 }}">
                                                    <div class="p-100">
                                                        <img height="80" width="80" src="{{ $item->image->path }}"
                                                            alt="{{ $product->name }}"
                                                            data-image="{{ $item->image->path }}" class="swiper-lazy" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-6 col-center">
                            <div class="product-sticky">
                                <div class="details-pro">
                                    <h1 class="title-product">{{ $product->name }}</h1>
                                    <form enctype="multipart/form-data" data-cart-form id="add-to-cart-form"
                                        class="form-inline">
                                        <div class="price-box clearfix">
                                            <div class="special-price">
                                                <span
                                                    class="price product-price">{{ formatCurrency($product->price) }}₫</span>
                                                <meta itemprop="price" content="{{ $product->price }}">
                                                <meta itemprop="priceCurrency" content="VND">
                                            </div>
                                            <!-- Giá -->
                                        </div>
                                        <div class="form-product">
                                            <div class="box-variant clearfix ">
                                                <input type="hidden" id="one_variant" name="variantId"
                                                    value="{{ $product->id }}" />
                                            </div>
                                            <div class="var_tag_pr">
                                                <div class="items">
                                                    @if (isset($product->attributes) && count($product->attributes) > 0)
                                                        @foreach ($product->attributes as $index => $attribute)
                                                            <div class="product-attributes-title">
                                                                {{ $attribute['name'] }}
                                                            </div>
                                                            @foreach ($attribute['values'] as $value)
                                                                <div class="item active" data-value="{{ $value }}"
                                                                    data-name="{{ $attribute['name'] }}"
                                                                    data-index="{{ $index }}">
                                                                    <a href="javascript:void(0)" title="">
                                                                        <p class="tit_pr">
                                                                            {{ $value }}
                                                                        </p>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="clearfix form-group ">
                                                <div class="flex-quantity">
                                                    <div class="custom custom-btn-number show">
                                                        <label class="sl section">Số lượng:</label>
                                                        <div class="input_number_product form-control">
                                                            <button class="btn_num num_1 button button_qty"
                                                                onClick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro ) &amp;&amp; qtypro &gt; 1 ) result.value--;return false;"
                                                                type="button">-</button>
                                                            <input type="text" id="qtym" name="quantity"
                                                                value="1" maxlength="3"
                                                                class="form-control prd_quantity"
                                                                onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"
                                                                onchange="if(this.value == 0)this.value=1;">
                                                            <button class="btn_num num_2 button button_qty"
                                                                onClick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;return false;"
                                                                type="button">+</button>
                                                        </div>
                                                    </div>
                                                    <div class="btn-mua button_actions clearfix">
                                                        <button type="submit" ng-click="addToCartCheckoutFromProductDetail()"
                                                            class="btn btn_base normal_button btn_add_cart add_to_cart btn-cart">
                                                            <span>Mua ngay</span>
                                                            Giao hàng tận nơi hoặc nhận tại cửa hàng
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="social-media" role="list">
                                        <li>Chia sẻ ngay: </li>
                                        <li class="social-media__item social-media__item--facebook">
                                            <a title="Chia sẻ lên Facebook"
                                                href="https://www.facebook.com/sharer.php?u={{ route('front.show-product-detail', $product->slug) }}"
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
                                                href="https://pinterest.com/pin/create/button/?url={{ route('front.show-product-detail', $product->slug) }}"
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
                                                href="https://twitter.com/share?url={{ route('front.show-product-detail', $product->slug) }}"
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
                                    <div class="product-summary">
                                        <div class="rte">
                                            {!! $product->intro !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-mobile"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg">
                    <div class="row">
                        <div class="col-lg-9 col-12">
                            <div class="product-tab e-tabs not-dqtab">
                                <ul class="tabs tabs-title clearfix">
                                    <li class="tab-link active" data-tab="#tab-1">
                                        <h3>Thông tin sản phẩm</h3>
                                    </li>
                                </ul>
                                <div class="tab-float">
                                    <div id="tab-1" class="tab-content active content_extab">
                                        <div class="rte product_getcontent">
                                            <div id="content">
                                                {!! $product->body !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="blog-bar">
                                <div class="title"><a href="javascript:void(0)" title="Tin nổi bật">Tin nổi bật</a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="blog-bar-default">
                                    @foreach ($newBlogs as $blog)
                                        <div class="c-new">
                                            <a href="{{ route('front.list-blog', $blog->slug) }}"
                                                title="{{ $blog->name }}" class="c-new__img">
                                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                                                    data-src="{{ $blog->image->path }}" alt="{{ $blog->name }}"
                                                    class="lazyload img-responsive mx-auto d-block" />
                                            </a>
                                            <div class="c-new__info">
                                                <a href="{{ route('front.list-blog', $blog->slug) }}"
                                                    title="{{ $blog->name }}">{{ $blog->name }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-reviews">
                </div>
            </div>
        </div>
        <div class="productRelate">
            <div class="container">
                <div class="bg">
                    <div class="block-title">
                        <h2>
                            <a href="javascript:void(0)" title="Sản phẩm cùng loại">Sản phẩm cùng loại</a>
                        </h2>
                    </div>
                    <div class="margin-am">
                        <div class="product-relate-swiper swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($productsRelated as $product)
                                    <div class="swiper-slide">
                                        <div class=" item_product_main">
                                            @include('site.products.product_item', ['product' => $product])
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var variantsize = false;
        var ww = $(window).width();

        function validate(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        jQuery(function($) {

            // Add label if only one product option and it isn't 'Title'. Could be 'Size'.

            // Hide selectors if we only have 1 variant and its title contains 'Default'.

            $('.selector-wrapper').hide();

            $('.selector-wrapper').css({
                'text-align': 'left',
                'margin-bottom': '15px'
            });
        });

        jQuery('.swatch :radio').change(function() {
            var optionIndex = jQuery(this).closest('.swatch').attr('data-option-index');
            var optionValue = jQuery(this).val();
            jQuery(this)
                .closest('form')
                .find('.single-option-selector')
                .eq(optionIndex)
                .val(optionValue)
                .trigger('change');
        })

        $('.slider-big-video .slider-for a').each(function() {
            $(this).attr('rel', 'lightbox-demo');
        });
    </script>
    <script>
        $(document).ready(function() {
            function activeTab(obj) {
                $('.product-tab ul li').removeClass('active');
                $(obj).addClass('active');
                var id = $(obj).attr('data-tab');
                $('.tab-content').removeClass('active');
                $(id).addClass('active');
            }


            $('.product-tab ul li').click(function() {
                activeTab(this);
                return false;
            });


            var galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 5,
                slidesPerView: 10,
                lazy: false,
                hashNavigation: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                loop: false,
                loopAdditionalSlides: 0,
                breakpoints: {
                    300: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                        direction: 'horizontal',
                    },
                    500: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                        direction: 'horizontal',
                    },
                    640: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                        direction: 'horizontal',
                    },
                    768: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                    1199: {
                        slidesPerView: 5,
                        spaceBetween: 10,
                    }
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
            var galleryTop = new Swiper('.gallery-top', {
                spaceBetween: 0,
                lazy: true,
                hashNavigation: true,
                navigation: {
                    nextEl: '.swiper-prenext .swiper-button-next',
                    prevEl: '.swiper-prenext .swiper-button-prev',
                },
                thumbs: {
                    swiper: galleryThumbs
                }
            });
            var swiper = new Swiper('.product-relate-swiper', {
                slidesPerView: 4,
                loop: false,
                grabCursor: true,
                spaceBetween: 30,
                roundLengths: true,
                slideToClickedSlide: false,
                navigation: {
                    nextEl: '.product-relate-swiper .swiper-button-next',
                    prevEl: '.product-relate-swiper .swiper-button-prev',
                },
                autoplay: false,
                breakpoints: {
                    300: {
                        slidesPerView: 2,
                        spaceBetween: 15
                    },
                    500: {
                        slidesPerView: 2,
                        spaceBetween: 15
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 15
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    991: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    },
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    }
                }
            });
            $(document).ready(function() {
                $("#lightgallery").lightGallery({
                    thumbnail: false
                });
                $("#playvideo").lightGallery();
            });


            if ($(window).width() < 991) {
                var appendHtml = $('.append-product-tab-mobile').html();
                $('.product-tab-mobile').append(appendHtml);
                $('.append-product-tab-mobile').remove();

            }
        })
    </script>
    <link href="//bizweb.dktcdn.net/100/483/185/themes/937690/assets/bpr-products-module.css?1745416765608"
        rel="stylesheet" type="text/css" media="all" />
    <div class="sapo-product-reviews-module"></div>
@endsection

@push('script')
    <script>
        // Plus number quantiy product detail
        var plusQuantity = function() {
            if (jQuery('input[name="quantity"]').val() != undefined) {
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                if (!isNaN(currentVal)) {
                    jQuery('input[name="quantity"]').val(currentVal + 1);
                } else {
                    jQuery('input[name="quantity"]').val(1);
                }
            } else {
                console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());
            }
        }
        // Minus number quantiy product detail
        var minusQuantity = function() {
            if (jQuery('input[name="quantity"]').val() != undefined) {
                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    jQuery('input[name="quantity"]').val(currentVal - 1);
                }
            } else {
                console.log('error: Not see elemnt ' + jQuery('input[name="quantity"]').val());
            }
        }
        app.controller('ProductDetailController', function($scope, $http, $interval, cartItemSync, $rootScope, $compile,
            notiProduct) {
            $scope.product = @json($product);
            $scope.form = {
                quantity: 1
            };

            $scope.selectedAttributes = [];
            jQuery('.product-attribute-values .badge').click(function() {
                if (!jQuery(this).hasClass('active')) {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).addClass('active');
                    if ($scope.selectedAttributes.length > 0 && $scope.selectedAttributes.find(item => item
                            .index == jQuery(this).data('index'))) {
                        $scope.selectedAttributes.find(item => item.index == jQuery(this).data('index'))
                            .value = jQuery(this).data('value');
                    } else {
                        let index = jQuery(this).data('index');
                        $scope.selectedAttributes.push({
                            index: index,
                            name: jQuery(this).data('name'),
                            value: jQuery(this).data('value'),
                        });
                    }
                } else {
                    jQuery(this).parent().find('.badge').removeClass('active');
                    jQuery(this).removeClass('active');
                    $scope.selectedAttributes = $scope.selectedAttributes.filter(item => item.index !=
                        jQuery(this).data('index'));
                }
                $scope.$apply();
            });

            $scope.addToCartFromProductDetail = function() {
                let quantity = $('.details-product input[name="quantity"]').val();

                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                                notiProduct.product_id = response.noti_product.product_id;
                                notiProduct.product_name = response.noti_product
                                    .product_name;
                                notiProduct.product_image = response.noti_product
                                    .product_image;
                                notiProduct.product_price = response.noti_product
                                    .product_price;
                                notiProduct.product_qty = response.noti_product.product_qty;
                            }, 1000);
                            // toastr.success('Thao tác thành công !')
                            $scope.$applyAsync();

                            $('#popup-cart-mobile').addClass('active');
                            $('.backdrop__body-backdrop___1rvky').addClass('active');
                            $('#quick-view-product.quickview-product').hide();
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            $scope.addToCartCheckoutFromProductDetail = function() {
                let quantity = $('.details-product input[name="quantity"]').val();
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', $scope.product.id);

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(quantity),
                        'attributes': $scope.selectedAttributes
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            toastr.success('Thao tác thành công !')
                            window.location.href = "{{ route('cart.checkout') }}";
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }
        });
    </script>
@endpush
