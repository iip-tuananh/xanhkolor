@extends('site.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $short_des }}
@endsection
@section('css')
    <link href="/site/css/breadcrumb_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/sidebar_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/collection_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
@endsection

@section('content')
    <div class="layout-collection">
        <section class="bread-crumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="home">
                        <a href="{{ route('front.home-page') }}"><span>Trang chủ</span></a>
                        <span class="mr_lr">&nbsp;/&nbsp;</span>
                    </li>
                    <li><span>{{ $title }}</span></li>
                </ul>
                <div class="title_full">
                    {{ $title }}
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row margin-10-">
                <aside class="dqdt-sidebar sidebar col-lg-3 col-12 padding-10">
                    <div class="aside-content aside-cate">
                        <div class="title-head">
                            Danh mục sản phẩm
                        </div>
                        <nav class="nav-category">
                            <ul class="nav navbar-pills">
                                @foreach ($categories as $cate)
                                    <li class="nav-item {{ $category->slug == $cate->slug ? 'active' : '' }} relative">
                                        <a title="{{ $cate->name }}" class="nav-link"
                                            href="{{ route('front.show-product-category', $cate->slug) }}">{{ $cate->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <script>
                        $(".open_mnu").click(function() {
                            $(this).toggleClass('cls_mn').next().slideToggle();
                        });
                    </script>
                    <div class="aside-filter clearfix">
                        <div class="aside-hidden-mobile">
                            <div class="filter-container">
                                <div class="filter-containers">
                                    <div class="filter-container__selected-filter" style="display: none;">
                                        <div class="filter-container__selected-filter-header clearfix">
                                            <span class="filter-container__selected-filter-header-title">Bạn chọn</span>
                                            <a href="javascript:void(0)"
                                                class="filter-container__clear-all" title="Bỏ hết">Bỏ hết</a>
                                        </div>
                                        <div class="filter-container__selected-filter-list clearfix">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <aside class="aside-item filter-price">
                                    <div class="aside-title">Chọn mức giá
                                        <span class="nd-svg collapsible-plus">
                                        </span>
                                    </div>
                                    <div class="aside-content filter-group">
                                        <ul>
                                            <li class="filter-item filter-item--check-box filter-item--green">
                                                <span>
                                                    <label for="filter-duoi-100-000d">
                                                        <input type="checkbox" id="filter-duoi-100-000d"
                                                            onchange="toggleFilter(this);" data-group="Khoảng giá"
                                                            data-field="price_min" data-text="Dưới 100.000đ"
                                                            value="(<100000)" data-operator="OR">
                                                        <i class="fa"></i>
                                                        Giá dưới 100.000đ
                                                    </label>
                                                </span>
                                            </li>
                                            <li class="filter-item filter-item--check-box filter-item--green">
                                                <span>
                                                    <label for="filter-100-000d-200-000d">
                                                        <input type="checkbox" id="filter-100-000d-200-000d"
                                                            onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                            data-field="price_min" data-text="100.000đ - 200.000đ"
                                                            value="(>100000 AND <200000)" data-operator="OR">
                                                        <i class="fa"></i>
                                                        100.000đ - 200.000đ
                                                    </label>
                                                </span>
                                            </li>
                                            <li class="filter-item filter-item--check-box filter-item--green">
                                                <span>
                                                    <label for="filter-200-000d-400-000d">
                                                        <input type="checkbox" id="filter-200-000d-400-000d"
                                                            onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                            data-field="price_min" data-text="200.000đ - 400.000đ"
                                                            value="(>200000 AND <400000)" data-operator="OR">
                                                        <i class="fa"></i>
                                                        200.000đ - 400.000đ
                                                    </label>
                                                </span>
                                            </li>
                                            <li class="filter-item filter-item--check-box filter-item--green">
                                                <span>
                                                    <label for="filter-400-000d-700-000d">
                                                        <input type="checkbox" id="filter-400-000d-700-000d"
                                                            onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                            data-field="price_min" data-text="400.000đ - 700.000đ"
                                                            value="(>400000 AND <700000)" data-operator="OR">
                                                        <i class="fa"></i>
                                                        400.000đ - 700.000đ
                                                    </label>
                                                </span>
                                            </li>
                                            <li class="filter-item filter-item--check-box filter-item--green">
                                                <span>
                                                    <label for="filter-tren700-000d">
                                                        <input type="checkbox" id="filter-tren700-000d"
                                                            onchange="toggleFilter(this)" data-group="Khoảng giá"
                                                            data-field="price_min" data-text="Trên 700.000đ"
                                                            value="(>700000)" data-operator="OR">
                                                        <i class="fa"></i>
                                                        Giá trên 700.000đ
                                                    </label>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="block-collection col-lg-9 col-12 padding-10">
                    <h1 class="title-page d-none">{{ $title }}</h1>
                    <div class="category-products">
                        <div class="sortPagiBar clearfix">
                            <div class="sort-cate clearfix">
                                <div id="sort-by">
                                    <label class="left">Sắp xếp theo</label>
                                    <ul class="ul_col">
                                        <li>
                                            <span>
                                                Mặc định
                                            </span>
                                            <ul class="content_ul">
                                                <li><a href="javascript:;" onclick="sortby('default')">Mặc định</a></li>
                                                <li><a href="javascript:;" onclick="sortby('alpha-asc')">A &rarr; Z</a>
                                                </li>
                                                <li><a href="javascript:;" onclick="sortby('alpha-desc')">Z &rarr; A</a>
                                                </li>
                                                <li><a href="javascript:;" onclick="sortby('price-asc')">Giá tăng dần</a>
                                                </li>
                                                <li><a href="javascript:;" onclick="sortby('price-desc')">Giá giảm dần</a>
                                                </li>
                                                <li><a href="javascript:;" onclick="sortby('created-desc')">Hàng mới
                                                        nhất</a></li>
                                                <li><a href="javascript:;" onclick="sortby('created-asc')">Hàng cũ
                                                        nhất</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="products-view products-view-grid list_hover_pro">
                            <div class="row margin">
                                @foreach ($products as $product)
                                <div class="col-6 col-xl-4 col-lg-4 col-md-4 padding">
                                    <div class="item_product_main">
                                        @include('site.products.product_item', ['product' => $product])
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="pagenav"> --}}
                            {{ $products->links() }}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
            <div id="open-filters" class="open-filters d-lg-none d-xl-none">
                <i class="fa fa-filter"></i>
                <span>Lọc</span>
            </div>
        </div>
    </div>
    <div class="opacity_sidebar"></div>
@endsection

@push('script')
@endpush
