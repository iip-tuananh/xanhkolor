<header class="header" ng-cloak>
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 d-md-block d-none col-left">
                    <ul>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="50px" height="50px"
                                viewBox="0 0 24 24">
                                <path
                                    d="M21.384,17.752a2.108,2.108,0,0,1-.522,3.359,7.543,7.543,0,0,1-5.476.642C10.5,20.523,3.477,13.5,2.247,8.614a7.543,7.543,0,0,1,.642-5.476,2.108,2.108,0,0,1,3.359-.522L8.333,4.7a2.094,2.094,0,0,1,.445,2.328A3.877,3.877,0,0,1,8,8.2c-2.384,2.384,5.417,10.185,7.8,7.8a3.877,3.877,0,0,1,1.173-.781,2.092,2.092,0,0,1,2.328.445Z" />
                            </svg>
                            <a href="tel:{{ str_replace(' ', '', $config->hotline) }}">{{ $config->hotline }}</a>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="50px" height="50px" viewBox="0 0 32 32" version="1.1">
                                <g id="icomoon-ignore"></g>
                                <path
                                    d="M28.244 7.47h-25.572v17.060h26.656v-17.060h-1.084zM27.177 8.536l-10.298 10.298c-0.47 0.47-1.289 0.47-1.759 0l-10.3-10.298h22.356zM3.738 8.961l6.923 6.922-6.923 6.923v-13.846zM4.589 23.464l6.827-6.826 2.951 2.95c0.436 0.436 1.016 0.677 1.633 0.677s1.197-0.241 1.633-0.677l2.951-2.951 6.826 6.826h-22.822zM28.262 22.807l-6.923-6.924 6.923-6.924v13.848z"
                                    fill="#000000">
                                </path>
                            </svg>
                            <a href="mailto:{{ $config->email }}">{{ $config->email }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-right">
                    <div class="social">
                        <a href="{{ $config->facebook }}" class="social-button" title="Facebook" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use>
                            </svg>
                        </a>
                        <a href="{{ $config->youtube }}" class="social-button" title="Youtube" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-youtube"></use>
                            </svg>
                        </a>
                        <a href="{{ $config->shopee }}" class="social-button" title="Shopee" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use>
                            </svg>
                        </a>
                        <a href="{{ $config->instagram }}" class="social-button" title="Instagram" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-instagram">
                                </use>
                            </svg>
                        </a>
                        <a href="{{ $config->google }}" class="social-button" title="Google" target="_blank"
                            rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-google"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="account d-md-inline-block d-none">
                        <a href="javascript:void(0);" title="Tài khoản của bạn" rel="nofollow">
                            <svg class="icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-user"></use>
                            </svg>
                            <span class="info">
                                Tài khoản
                            </span>
                        </a>
                        <div class="drop-account">
                            <a href="javascript:void(0);">Đăng nhập</a>
                            <a href="javascript:void(0);">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-3 col-md-12 col-left">
                    <a href="{{ route('front.home-page') }}" class="logo">
                        <img height="75" width="174" src="{{ $config->image->path ?? '' }}"
                            alt="{{ $config->web_title }}" loading="lazy">
                    </a>
                </div>
                <div class="col-xl-9 col-lg-9 col-right header-menu">
                    <div class="opacity_menu"></div>
                    <div class="row  align-items-center">
                        <div class="col-xl-9 col-lg-9">
                            <div class="header-menu-scroll">
                                <nav class="header-nav">
                                    <ul class="item_big item_big_index">
                                        <li class="nav-item active ">
                                            <a class="a-img" href="{{ route('front.home-page') }}" title="Trang chủ">
                                                Trang chủ
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="a-img" href="{{ route('front.about-us') }}" title="Giới thiệu">
                                                Giới thiệu
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="a-img caret-down" href="" title="Dịch vụ">
                                                Dịch vụ
                                            </a>
                                            <i class="fa fa-caret-down"></i>
                                            <ul class="item_small">
                                                @foreach ($services as $service)
                                                    <li>
                                                        <a class="" href="{{ route('front.service-detail', $service->slug) }}"
                                                            title="{{ $service->name }}">
                                                            {{ $service->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="a-img caret-down" href="javascript:void(0);" title="Sản phẩm">
                                                Sản phẩm
                                            </a>
                                            <i class="fa fa-caret-down"></i>
                                            <ul class="item_small">
                                                @foreach ($productCategories as $category)
                                                    <li>
                                                        <a class=""
                                                            href="{{ route('front.show-product-category', $category->slug) }}"
                                                            title="{{ $category->name }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @foreach ($postCategories as $category)
                                            <li class="nav-item ">
                                                <a class="a-img"
                                                    href="{{ route('front.list-blog', $category->slug) }}"
                                                    title="{{ $category->name }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                        <li class="nav-item ">
                                            <a class="a-img" href="{{ route('front.contact-us') }}"
                                                title="Liên hệ">
                                                Liên hệ
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="control-menu">
                                    <a href="#" id="prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                            <path fill="#fff"
                                                d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                                        </svg>
                                    </a>
                                    <a href="#" id="next">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                            <path fill="#fff"
                                                d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 block-menu-bar">
                            <div class="menu-bar d-lg-none d-block">
                                <a href="javascript:;" title="Tài khoản của bạn" rel="nofollow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16"
                                        viewBox="0 0 20 16" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.958984 1C0.958984 0.516751 1.35074 0.125 1.83398 0.125H12.334C12.8172 0.125 13.209 0.516751 13.209 1C13.209 1.48325 12.8172 1.875 12.334 1.875H1.83398C1.35074 1.875 0.958984 1.48325 0.958984 1Z"
                                            fill="white"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.958984 15C0.958984 14.5168 1.35074 14.125 1.83398 14.125H8.83399C9.31723 14.125 9.70899 14.5168 9.70899 15C9.70899 15.4832 9.31723 15.875 8.83399 15.875H1.83398C1.35074 15.875 0.958984 15.4832 0.958984 15Z"
                                            fill="white"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.958984 8C0.958984 7.51675 1.35074 7.125 1.83398 7.125H18.1673C18.6506 7.125 19.0423 7.51675 19.0423 8C19.0423 8.48325 18.6506 8.875 18.1673 8.875H1.83398C1.35074 8.875 0.958984 8.48325 0.958984 8Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="group-col-right">
                                <div class="account d-md-none">
                                    <a href="javascript:void(0);" title="Tài khoản của bạn" rel="nofollow">
                                        <svg class="icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-user">
                                            </use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="theme-search-smart">
                                    <div class="icon">
                                        <svg class="icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search">
                                            </use>
                                        </svg>
                                    </div>
                                    <div class="header_search theme-searchs">
                                        <form action="{{ route('front.search') }}"
                                            class="input-group search-bar theme-header-search-form ultimate-search"
                                            role="search">
                                            <input type="text" aria-label="Tìm sản phẩm" name="query"
                                                value="" autocomplete="off" placeholder="Tìm kiếm sản phẩm..."
                                                class="search-auto input-group-field auto-search" required="">
                                            <input type="hidden" name="type" value="product">
                                            <span class="input-group-btn">
                                                <button class="btn icon-fallback-text" aria-label="Justify">
                                                    <svg class="icon">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            xlink:href="#search"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                                <a class="cart-head" href="{{ route('cart.checkout') }}" title="Giỏ hàng">
                                    <span class="text">Giỏ hàng</span>
                                    <span class="count_item count_item_pr"><% cart.count || 0 %></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
