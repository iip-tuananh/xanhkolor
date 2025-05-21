@extends('site.layouts.master')
@section('title')
    {{ $config->meta_title ?? $config->web_title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{-- {{ url('' . $banners[0]->image->path) }} --}}
@endsection
@section('css')
    <style>
        .gradient-icon {
            display: inline-block;
            width: 24px;
            height: 24px;
            font-size: 24px;
            border-radius: 6px;
            background: linear-gradient(270deg, #d53c00 0%, #dd6333 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .limit-5-line {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
@section('content')
    <div class="bg-index">
        {{-- Slider --}}
        <section class="section_slider">
            <div class="home-slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                        <div class="swiper-slide">
                            <a href="{{ $banner->link }}" class="clearfix" title="Banner">
                                <picture>
                                    <source media="(min-width: 1200px)" srcset="{{ $banner->image->path }}">
                                    <source media="(min-width: 992px)" srcset="{{ $banner->image->path }}">
                                    <source media="(min-width: 569px)" srcset="{{ $banner->image->path }}">
                                    <source media="(max-width: 567px)" srcset="{{ $banner->image->path }}">
                                    <img width="1920" height="695" src="{{ $banner->image->path }}" alt="Banner"
                                        class="img-responsive lazyload" loading="lazy" />
                                </picture>
                            </a>
                        </div>
                    @endforeach
                </div>
                @if ($banners->count() > 1)
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                @endif
            </div>
        </section>
        <style>
            .home-slider .swiper-slide img {
                transition: transform 8s ease;
                transform: scale(1);
            }

            .home-slider .swiper-slide-active img {
                transform: scale(1.125);
            }

            .home-slider .swiper-slide {
                overflow: hidden;
            }
        </style>
        <script>
            $(document).ready(function() {
                var swiper = new Swiper('.home-slider', {
                    autoplay: {
                        delay: 8000,
                        disableOnInteraction: false,
                    },
                    loop: true,
                    pagination: {
                        el: '.home-slider .swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.home-slider .swiper-button-next',
                        prevEl: '.home-slider .swiper-button-prev',
                    },
                });
            });
        </script>

        {{-- Chính sách --}}
        <div class="section_policy">
            <div class="container">
                <div class="row content">
                    <div class="col-lg-3 col-md-6 item">
                        <div class="inner animate__animated">
                            <div class="img-title">
                                <div class="image">
                                    <img width="100" height="100" class="lazyload"
                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA="
                                        data-src="/site/images/thuonghieu.png" alt="Thương hiệu" />
                                </div>
                                <h4>
                                    Thương hiệu
                                </h4>
                            </div>
                            <div class="contentsv">
                                <p>
                                    Công ty chúng tôi với nhiều năm kinh nghiệm trong lĩnh vực sơn, tự tin khẳng định đây là
                                    sản phẩm thương hiệu Việt Nam, được hợp chuẩn về pháp lý. Quý khách hãy yên tâm khi sử
                                    dụng sản phẩm này.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="inner animate__animated">
                            <div class="img-title">
                                <div class="image">
                                    <img width="100" height="100" class="lazyload"
                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA="
                                        data-src="/site/images/congnghe.png" alt="Công nghệ tiên tiến" />
                                </div>
                                <h4>
                                    Công nghệ tiên tiến
                                </h4>
                            </div>
                            <div class="contentsv">
                                <p>
                                    Với công nghệ hàng đầu thế giới cùng hệ thống trang thiết bị máy móc hiện đại. Thực hiện
                                    theo quy trình của nhà máy sản xuất sơn chuẩn quốc tế. Sơn Xanh Color đem lại vẻ đẹp bền
                                    màu cho ngôi nhà bạn.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="inner animate__animated">
                            <div class="img-title">
                                <div class="image">
                                    <img width="100" height="100" class="lazyload"
                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA="
                                        data-src="/site/images/dasacmau.png" alt="Đa sắc màu" />
                                </div>
                                <h4>
                                    Đa sắc màu
                                </h4>
                            </div>
                            <div class="contentsv">
                                <p>
                                    Chúng tôi sử dụng máy phối màu với công nghệ tiên tiến để cho ra đời màu sơn chuẩn nhất,
                                    đa dạng về màu sắc. Ngoài ra Sơn Xanh Color luôn cập nhật xu hướng màu sơn mới nhất để
                                    khách hàng có thêm nhiều lựa chọn.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 item">
                        <div class="inner animate__animated">
                            <div class="img-title">
                                <div class="image">
                                    <img width="100" height="100" class="lazyload"
                                        src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA="
                                        data-src="/site/images/doingunhanvien.png" alt="Đội ngũ nhân viên tận tâm" />
                                </div>
                                <h4>
                                    Đội ngũ nhân viên
                                </h4>
                            </div>
                            <div class="contentsv">
                                <p>
                                    Sở hữu nguồn nhân lực tài năng sáng tạo, có tay nghề cao đưa ra công thức sơn Xanh Color
                                    đạt tiêu chuẩn, được nhà nước công nhận. Cùng đội ngũ nhân viên tư vấn nhiệt tình 24/7,
                                    giải đáp mọi thắc mắc của quý khách.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Về chúng tôi --}}
        <div class="section-about">
            {{-- <div class="container"> --}}
                {{-- <div class="row align-items-center"> --}}
                    {{-- <div class="col-lg-6 col-md-6 col-12 block-title animate__animated">
                        <div class="about-text-1">
                            Về chúng tôi
                        </div>
                        <h2>
                            {{ $config->short_name_company }}
                        </h2>
                        <div class="about-text-2">
                            Chất lượng – An toàn – Hiệu quả – Chuyên nghiệp
                        </div>
                        <div class="about-des">
                            {!! $config->introduction !!}
                        </div>
                        <div class="about-contact-us">
                            <div class="btn-box">
                                <a href="{{ route('front.about-us') }}" title="Xem thêm">Xem thêm</a>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-12 col-md-12 col-12 block-image animate__animated" style="padding-right: 0; padding-left: 0;"> --}}
                        <a class="thumb d-block" href="{{ route('front.about-us') }}" title="{{ $config->short_name_company }}">
                            <img width="100%" height="auto" alt="{{ $config->short_name_company }}"
                                src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA="
                                data-src="{{ $config->introduction_image ? $config->introduction_image->path : '' }}"
                                class="lazyload" />
                        </a>
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        </div>

        {{-- Sản phẩm bán chạy --}}
        @foreach ($categorySpecial as $category)
            <div class="section_view_product">
                <div class="container">
                    <h2>
                        <a href="{{ route('front.show-product-category', $category->slug) }}"
                            title="{{ $category->name }}">{{ $category->name }}</a>
                    </h2>
                    <div class="block-product">
                        <div class="product-swiper swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($category->products as $product)
                                    <div class="swiper-slide">
                                        @include('site.products.product_item', ['product' => $product])
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                    @if ($category->image)
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="category-banner animate__animated">
                                    <a href="{{ route('front.show-product-category', $category->slug) }}"
                                        title="Xem thêm" style="display: block; width: 100%;">
                                        <img src="{{ $category->image ? $category->image->path : '' }}"
                                            alt="{{ $category->name }}" style="width: 100%;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        <script>
            $(document).ready(function() {
                var swiperTourGood = new Swiper('.product-swiper', {
                    slidesPerView: 4,
                    loop: true,
                    grabCursor: true,
                    // slidesPerColumn: 2,
                    // slidesPerColumnFill: 'row',
                    spaceBetween: 20,
                    roundLengths: true,
                    slideToClickedSlide: false,
                    navigation: {
                        nextEl: '.product-swiper .swiper-button-next',
                        prevEl: '.product-swiper .swiper-button-prev',
                    },
                    pagination: {
                        el: '.product-swiper .swiper-pagination',
                        clickable: true,
                    },
                    autoplay: {
                        delay: 8000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        300: {
                            slidesPerView: 2,
                            spaceBetween: 10
                        },
                        500: {
                            slidesPerView: 2,
                            spaceBetween: 10
                        },
                        640: {
                            slidesPerView: 3,
                            spaceBetween: 10
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
            });
        </script>

        {{-- Tin tức & cập nhật --}}
        @foreach ($categorySpecialPost as $category)
            <div class="section_blog">
                <div class="container">
                    <div class="block-title">
                        <p>
                            Tin tức & cập nhật
                        </p>
                        <h2>
                            <a href="javascript:void(0)" title="{{ $category->name }}">
                                {{ $category->name }}
                            </a>
                        </h2>
                    </div>
                    <div class="block-content">
                        <div class="margin-am">
                            <div class="swiper-container swiper-blog">
                                <div class="row">
                                    @foreach ($category->posts as $post)
                                        <div class="col-lg-4 col-md-4 col-12 item">
                                            @include('site.blogs.item', ['post' => $post])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($category->image)
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="category-banner animate__animated">
                                    <a href="{{ route('front.show-product-category', $category->slug) }}"
                                        title="Xem thêm" style="display: block; width: 100%;">
                                        <img src="{{ $category->image ? $category->image->path : '' }}"
                                            alt="{{ $category->name }}" style="width: 100%;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
@push('script')
@endpush
