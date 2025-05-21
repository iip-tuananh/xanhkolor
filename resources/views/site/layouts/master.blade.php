<!DOCTYPE html>
<html lang="vi">

<head>
    @include('site.partials.head')
    <link rel="preload" as="script" href="/site/js/jquery.js?1745416765608" />
    <script src="/site/js/jquery.js?1745416765608" type="text/javascript"></script>
    <!-- <link rel="preload" as="script" href="//bizweb.dktcdn.net/100/483/185/themes/937690/assets/cookie.js?1745416765608" />
      <script src="//bizweb.dktcdn.net/100/483/185/themes/937690/assets/cookie.js?1745416765608" type="text/javascript">
      </script> -->
    <link rel="preload" as="script" href="/site/js/swiper.js?1745416765608" />
    <script src="/site/js/swiper.js?1745416765608" type="text/javascript"></script>
    <link rel="preload" as="script" href="/site/js/lazy.js?1745416765608" />
    <script src="/site/js/lazy.js?1745416765608" type="text/javascript"></script>
    <link rel="preload" as='style' type="text/css" href="/site/css/font.scss.css?1745416765608">
    <link rel="preload" as='style' type="text/css" href="/site/css/main.scss.css?1745416765608">
    <link rel="preload" as='style' type="text/css" href="/site/css/header.scss.css?1745416765608">
    <link rel="preload" as='style' type="text/css" href="/site/css/index.scss.css?1745416765608">
    <link rel="preload" as='style' type="text/css" href="/site/css/bootstrap-4-3-min.css?1745416765608">
    <style>
        :root {
            --maincolor: #2dbfbe;
            --hover: #fecb1a;
            --pricecolor: #2dbfbe;
        }
    </style>
    <link rel="stylesheet" href="/site/css/bootstrap-4-3-min.css?1745416765608">
    <link href="/site/css/font.scss.css?1745416765608" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/main.scss.css?1745416765608" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/header.scss.css?1745416765608" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/index.scss.css?1745416765608" rel="stylesheet" type="text/css" media="all" />
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @yield('css')

    <script>
        (function() {
            function asyncLoad() {
                var urls = [];
                for (var i = 0; i < urls.length; i++) {
                    var s = document.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = urls[i];
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                }
            };
            window.attachEvent ? window.attachEvent('onload', asyncLoad) : window.addEventListener('load', asyncLoad,
                false);
        })();
    </script>
    <script>
        $(document).ready(function($) {
            awe_lazyloadImage();
        });

        function awe_lazyloadImage() {
            var ll = new LazyLoad({
                elements_selector: ".lazyload",
                load_delay: 100,
                threshold: 0
            });
        }
        window.awe_lazyloadImage = awe_lazyloadImage;
    </script>

    <!-- Angular Js -->
    <script src="{{ asset('libs/angularjs/angular.js?v=222222') }}"></script>
    <script src="{{ asset('libs/angularjs/angular-resource.js') }}"></script>
    <script src="{{ asset('libs/angularjs/sortable.js') }}"></script>
    <script src="{{ asset('libs/dnd/dnd.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular-sanitize.js"></script>
    <script src="{{ asset('libs/angularjs/select.js') }}"></script>
    <script src="{{ asset('js/angular.js') }}?version={{ env('APP_VERSION', '1') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    @stack('script')
    <script>
        app.controller('AppController', function($rootScope, $scope, cartItemSync, $interval, $compile, notiProduct) {
            $scope.currentUser = @json(Auth::guard('client')->user());
            $scope.isAdminClient = @json(Auth::guard('client')->check());

            // Biên dịch lại nội dung bên trong container
            var container = angular.element(document.getElementsByClassName('item_product_main'));
            $compile(container.contents())($scope);

            var popup = angular.element(document.getElementById('popup-cart-mobile'));
            $compile(popup.contents())($scope);

            var quickView = angular.element(document.getElementById('quick-view-product'));
            $compile(quickView.contents())($scope);

            // Đặt mua hàng
            $scope.hasItemInCart = false;
            $scope.cart = cartItemSync;
            $scope.noti_product = notiProduct;
            $scope.item_qty = 1;
            $scope.quantity_quickview = 1;

            $scope.addToCart = function(productId, quantity = 1) {
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', productId);
                let item_qty = quantity;

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(item_qty)
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
                            // toastr.success('Thao tác thành công !')
                            $scope.noti_product = response.noti_product;
                            $scope.$applyAsync();
                            console.log($scope.noti_product);

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
                // if ($scope.isAdminClient) {
                // } else {
                //     window.location.href = "{{ route('front.login-client') }}";
                // }
            }

            $scope.changeQty = function(qty, product_id) {
                updateCart(qty, product_id)
            }

            $scope.incrementQuantity = function(product) {
                product.quantity = Math.min(product.quantity + 1, 9999);
            };

            $scope.decrementQuantity = function(product) {
                product.quantity = Math.max(product.quantity - 1, 0);
            };

            function updateCart(qty, product_id) {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{ route('cart.update.item') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        product_id: product_id,
                        qty: qty
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;
                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.$applyAsync();
                        }
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // xóa item trong giỏ
            $scope.removeItem = function(product_id) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{ route('cart.remove.item') }}",
                    data: {
                        product_id: product_id
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.cart.items = response.items;
                            $scope.cart.count = Object.keys($scope.cart.items).length;
                            $scope.cart.totalCost = response.total;

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            if ($scope.cart.count == 0) {
                                $scope.hasItemInCart = false;
                            }
                            $scope.$applyAsync();
                        }
                    },
                    error: function(e) {
                        jQuery.toast.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // Xem nhanh
            $scope.quickViewProduct = {};
            $scope.showQuickView = function(productId) {
                $.ajax({
                    url: "{{ route('front.get-product-quick-view') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        $('#quick-view-product .quick-view-product').html(response.html);
                        var quickView = angular.element(document.getElementById(
                            'quick-view-product'));
                        $compile(quickView.contents())($scope);
                        $scope.$applyAsync();
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // Search product
            jQuery('#live-search').keyup(function() {
                var keyword = jQuery(this).val();
                jQuery.ajax({
                    type: 'post',
                    url: '{{ route('front.auto-search-complete') }}',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        jQuery('.live-search-results').html(data.html);
                    }
                })
            });
        })

        app.factory('cartItemSync', function($interval) {
            var cart = {
                items: null,
                total: null
            };

            cart.items = @json($cartItems);
            cart.count = {{ $cartItems->sum('quantity') }};
            cart.total = {{ $totalPriceCart }};

            return cart;
        });

        app.factory('notiProduct', function($interval) {
            var noti = {
                product_id: null,
                product_name: null,
                product_image: null,
                product_price: null,
                product_qty: null
            };

            return noti;
        });

        @if (Session::has('token'))
            localStorage.setItem('{{ env('prefix') }}-token', "{{ Session::get('token') }}")
        @endif
        @if (Session::has('logout'))
            localStorage.removeItem('{{ env('prefix') }}-token');
        @endif
        var CSRF_TOKEN = "{{ csrf_token() }}";
        @if (Auth::guard('client')->check())
            const DEFAULT_CLIENT_USER = {
                id: "{{ Auth::guard('client')->user()->id }}",
                fullname: "{{ Auth::guard('client')->user()->name }}"
            };
        @else
            const DEFAULT_CLIENT_USER = null;
        @endif
    </script>
</head>

<body ng-app="App" ng-controller="AppController" ng-cloak>
    @include('site.partials.header')
    <div class="bodywrap">
        @yield('content')
        @include('site.partials.footer')
    </div>
    <link rel="preload" as="style" href="/site/css/ajaxcart.scss.css?1745416765608" type="text/css">
    <link href="/site/css/ajaxcart.scss.css?1745416765608" rel="stylesheet" type="text/css" media="all" />
    <div class="backdrop__body-backdrop___1rvky"></div>
    <script type="text/javascript">
        $('.img_hover_cart').click(function() {
            $('.cart-sidebar, .backdrop__body-backdrop___1rvky').addClass('active');
        });

        $(document).on('click', '.backdrop__body-backdrop___1rvky, .cart_btn-close', function() {
            $('.backdrop__body-backdrop___1rvky, .cart-sidebar, #popup-cart-desktop, .popup-cart-mobile')
                .removeClass('active');
            return false;
        })
    </script>
    <link rel="preload" as="script" href="/site/js/index.js?1745416765608" />
    <script src="/site/js/index.js?1745416765608" type="text/javascript"></script>
    <link rel="preload" as="script" href="/site/js/main.js?1745416765608" />
    <script src="/site/js/main.js?1745416765608" type="text/javascript"></script>
    <link rel="preload" as="script" href="/site/js/picbox.js?1745416765608" />
    <link rel="preload" as='style' type="text/css" href="/site/css/picbox.scss.css?1745416765608">
    <link href="/site/css/picbox.scss.css?1745416765608" rel="stylesheet" type="text/css" media="all" />
    <script src="/site/js/picbox.js?1745416765608" type="text/javascript"></script>

    <div id="popup-cart-mobile" class="popup-cart-mobile" ng-cloak>
        <div class="header-popcart">
            <div class="top-cart-header">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="682.66669pt" viewBox="-21 -21 682.66669 682.66669"
                        width="682.66669pt">
                        <path
                            d="m322.820312 387.933594 279.949219-307.273438 36.957031 33.671875-314.339843 345.023438-171.363281-162.902344 34.453124-36.238281zm297.492188-178.867188-38.988281 42.929688c5.660156 21.734375 8.675781 44.523437 8.675781 68.003906 0 148.875-121.125 270-270 270s-270-121.125-270-270 121.125-270 270-270c68.96875 0 131.96875 26.007812 179.746094 68.710938l33.707031-37.113282c-58.761719-52.738281-133.886719-81.597656-213.453125-81.597656-85.472656 0-165.835938 33.285156-226.273438 93.726562-60.441406 60.4375-93.726562 140.800782-93.726562 226.273438s33.285156 165.835938 93.726562 226.273438c60.4375 60.441406 140.800782 93.726562 226.273438 93.726562s165.835938-33.285156 226.273438-93.726562c60.441406-60.4375 93.726562-140.800782 93.726562-226.273438 0-38.46875-6.761719-75.890625-19.6875-110.933594zm0 0" />
                    </svg>
                    Thêm sản phẩm vào giỏ hàng thành công
                </span>
            </div>
            <div class="media-content bodycart-mobile">
                <div class="thumb-1x1">
                    <img src="<% noti_product.product_image %>" alt="<% noti_product.product_name %>">
                </div>
                <div class="body_content">
                    <h4 class="product-title"><% noti_product.product_name %></h4>
                    <div class="product-new-price"><b><% noti_product.product_price | number %>₫</b><span></span></div>
                </div>
            </div>
            <a class="noti-cart-count" href="{{ route('cart.index') }}" title="Giỏ hàng"> Giỏ hàng của bạn hiện có
                <span class="count_item_pr"><% cart.count || 0 %></span> sản phẩm </a>
            <a title="Đóng" class="cart_btn-close iconclose">
                <img width="50" height="50" src="/site/images/icon-filter-close-bg.png?1740037266911"
                    alt="Đóng" />
            </a>
            <div class="bottom-action">
                <div class="cart_btn-close tocontinued" onclick="location.href='{{ route('cart.checkout') }}'">
                    Xem giỏ hàng
                </div>
                <a href="{{ route('cart.checkout') }}" class="checkout" title="Thanh toán ngay">
                    Thanh toán ngay
                </a>
            </div>
        </div>
    </div>
    <div id="popupCartModal" class="modal fade" role="dialog">
    </div>
    <div class="addThis_listSharing addThis_listing">
        <div class="addThis_item">
            <a class="addThis_item-icon" href="tel:{{ str_replace(' ', '', $config->hotline) }}" rel="nofollow"
                aria-label="phone" title="Gọi ngay cho chúng tôi ">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="22" cy="22" r="22" fill="url(#paint2_linear)" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M14.0087 9.35552C14.1581 9.40663 14.3885 9.52591 14.5208 9.61114C15.3315 10.148 17.5888 13.0324 18.3271 14.4726C18.7495 15.2949 18.8903 15.9041 18.758 16.3558C18.6214 16.8415 18.3953 17.0971 17.384 17.9109C16.9786 18.239 16.5988 18.5756 16.5391 18.6651C16.3855 18.8866 16.2617 19.3212 16.2617 19.628C16.266 20.3395 16.7269 21.6305 17.3328 22.6232C17.8021 23.3944 18.6428 24.3828 19.4749 25.1413C20.452 26.0361 21.314 26.6453 22.2869 27.1268C23.5372 27.7488 24.301 27.9064 24.86 27.6466C25.0008 27.5826 25.1501 27.4974 25.1971 27.4591C25.2397 27.4208 25.5683 27.0202 25.9268 26.5772C26.618 25.7079 26.7759 25.5674 27.2496 25.4055C27.8513 25.201 28.4657 25.2563 29.0844 25.5716C29.5538 25.8145 30.5779 26.4493 31.2393 26.9095C32.1098 27.5187 33.9703 29.0355 34.2221 29.3381C34.6658 29.8834 34.7427 30.5821 34.4439 31.3534C34.1281 32.1671 32.8992 33.6925 32.0415 34.3444C31.2649 34.9323 30.7145 35.1581 29.9891 35.1922C29.3917 35.222 29.1442 35.1709 28.3804 34.8556C22.3893 32.3887 17.6059 28.7075 13.8081 23.65C11.8239 21.0084 10.3134 18.2688 9.28067 15.427C8.67905 13.7696 8.64921 13.0495 9.14413 12.2017C9.35753 11.8438 10.2664 10.9575 10.9278 10.4633C12.0288 9.64524 12.5365 9.34273 12.9419 9.25754C13.2193 9.19787 13.7014 9.24473 14.0087 9.35552Z"
                        fill="white" />
                    <defs>
                        <linearGradient id="paint2_linear" x1="22" y1="-7.26346e-09" x2="22.1219"
                            y2="40.5458" gradientUnits="userSpaceOnUse">
                            <stop offset="50%" stop-color="#e8434c" />
                            <stop offset="100%" stop-color="#d61114" />
                        </linearGradient>
                    </defs>
                </svg>
                <span class="tooltip-text">Gọi ngay cho chúng tôi </span>
            </a>
        </div>
        <div class="addThis_item">
            <a class="addThis_item-icon" href="https://zalo.me/{{ $config->zalo }} " target="_blank"
                rel="nofollow noreferrer" aria-label="zalo" title="Chat với chúng tôi qua Zalo ">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="22" cy="22" r="22" fill="url(#paint4_linear)" />
                    <g clip-path="url(#clip0)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.274 34.0907C15.7773 34.0856 16.2805 34.0804 16.783 34.0804C16.7806 34.0636 16.7769 34.0479 16.7722 34.0333C16.777 34.0477 16.7808 34.0632 16.7832 34.0798C16.8978 34.0798 17.0124 34.0854 17.127 34.0965H25.4058C26.0934 34.0965 26.7809 34.0977 27.4684 34.0989C28.8434 34.1014 30.2185 34.1039 31.5935 34.0965H31.6222C33.5357 34.0798 35.0712 32.5722 35.0597 30.7209V27.4784C35.0597 27.4582 35.0612 27.4333 35.0628 27.4071C35.0676 27.3257 35.0731 27.2325 35.0368 27.2345C34.9337 27.2401 34.7711 27.2757 34.7138 27.3311C34.2744 27.6145 33.8483 27.924 33.4222 28.2335C32.57 28.8525 31.7179 29.4715 30.7592 29.8817C27.0284 31.0993 23.7287 31.157 20.2265 30.3385C20.0349 30.271 19.9436 30.2786 19.7816 30.292C19.6773 30.3007 19.5436 30.3118 19.3347 30.3068C19.3093 30.3077 19.2829 30.3085 19.2554 30.3093C18.9099 30.3197 18.4083 30.3348 17.8088 30.6877C16.4051 31.1034 14.5013 31.157 13.5175 31.0147C13.522 31.0245 13.5247 31.0329 13.5269 31.0407C13.5236 31.0341 13.5204 31.0275 13.5173 31.0208C13.5036 31.0059 13.4864 30.9927 13.4696 30.98C13.4163 30.9393 13.3684 30.9028 13.46 30.8268C13.4867 30.8102 13.5135 30.7929 13.5402 30.7757C13.5937 30.7412 13.6472 30.7067 13.7006 30.6771C14.4512 30.206 15.1559 29.6905 15.6199 28.9311C16.2508 28.1911 15.9584 27.9025 15.4009 27.3524L15.3799 27.3317C12.6639 24.6504 11.8647 21.8054 12.148 17.9785C12.486 15.8778 13.4829 14.0708 14.921 12.4967C15.7918 11.5433 16.8288 10.7729 17.9632 10.1299C17.9796 10.1198 17.9987 10.1116 18.0182 10.1032C18.0736 10.0793 18.1324 10.0541 18.1408 9.98023C18.1475 9.92191 18.0507 9.90264 18.0163 9.90264C17.3698 9.90264 16.7316 9.89705 16.0964 9.89148C14.8346 9.88043 13.5845 9.86947 12.3041 9.90265C10.465 9.95254 8.78889 11.1779 8.81925 13.3614C8.82689 17.2194 8.82435 21.0749 8.8218 24.9296C8.82053 26.8567 8.81925 28.7835 8.81925 30.7104C8.81925 32.5007 10.2344 34.0028 12.085 34.0749C13.1465 34.1125 14.2107 34.1016 15.274 34.0907ZM13.5888 31.1403C13.5935 31.1467 13.5983 31.153 13.6032 31.1594C13.7036 31.2455 13.8031 31.3325 13.9021 31.4202C13.8063 31.3312 13.7072 31.2423 13.6035 31.1533C13.5982 31.1487 13.5933 31.1444 13.5888 31.1403ZM16.5336 33.8108C16.4979 33.7885 16.4634 33.7649 16.4337 33.7362C16.4311 33.7358 16.4283 33.7352 16.4254 33.7345C16.4281 33.7371 16.4308 33.7397 16.4335 33.7423C16.4632 33.7683 16.4978 33.79 16.5336 33.8108Z"
                            fill="white" />
                        <path
                            d="M17.6768 21.6754C18.5419 21.6754 19.3555 21.6698 20.1633 21.6754C20.6159 21.6809 20.8623 21.8638 20.9081 22.213C20.9597 22.6509 20.6961 22.9447 20.2034 22.9502C19.2753 22.9613 18.3528 22.9558 17.4247 22.9558C17.1554 22.9558 16.8919 22.9669 16.6226 22.9502C16.2903 22.9336 15.9637 22.8671 15.8033 22.5345C15.6429 22.2019 15.7575 21.9026 15.9752 21.631C16.8575 20.5447 17.7455 19.4527 18.6336 18.3663C18.6851 18.2998 18.7367 18.2333 18.7883 18.1723C18.731 18.0781 18.6508 18.1224 18.582 18.1169C17.9633 18.1114 17.3388 18.1169 16.72 18.1114C16.5768 18.1114 16.4335 18.0947 16.296 18.067C15.9695 17.995 15.7689 17.679 15.8434 17.3686C15.895 17.158 16.0669 16.9862 16.2846 16.9363C16.4221 16.903 16.5653 16.8864 16.7085 16.8864C17.7284 16.8809 18.7539 16.8809 19.7737 16.8864C19.9571 16.8809 20.1347 16.903 20.3123 16.9474C20.7019 17.0749 20.868 17.4241 20.7133 17.7899C20.5758 18.1058 20.3581 18.3774 20.1404 18.649C19.3899 19.5747 18.6393 20.4948 17.8888 21.4093C17.8258 21.4814 17.7685 21.5534 17.6768 21.6754Z"
                            fill="white" />
                        <path
                            d="M24.3229 18.7604C24.4604 18.5886 24.6036 18.4279 24.8385 18.3835C25.2911 18.2948 25.7151 18.5775 25.7208 19.021C25.738 20.1295 25.7323 21.2381 25.7208 22.3467C25.7208 22.6349 25.526 22.8899 25.2453 22.973C24.9588 23.0783 24.6322 22.9952 24.4432 22.7568C24.3458 22.6404 24.3057 22.6183 24.1682 22.7236C23.6468 23.1338 23.0567 23.2058 22.4207 23.0063C21.4009 22.6848 20.9827 21.9143 20.8681 20.9776C20.7478 19.9632 21.0973 19.0986 22.0369 18.5664C22.816 18.1175 23.6067 18.1563 24.3229 18.7604ZM22.2947 20.7836C22.3061 21.0275 22.3863 21.2603 22.5353 21.4543C22.8447 21.8534 23.4348 21.9365 23.8531 21.6372C23.9218 21.5873 23.9848 21.5263 24.0421 21.4543C24.363 21.033 24.363 20.3402 24.0421 19.9189C23.8817 19.7027 23.6296 19.5752 23.3603 19.5697C22.7301 19.5309 22.289 20.002 22.2947 20.7836ZM28.2933 20.8168C28.2474 19.3923 29.2157 18.3281 30.5907 18.2893C32.0517 18.245 33.1174 19.1928 33.1632 20.5785C33.209 21.9808 32.321 22.973 30.9517 23.106C29.4563 23.2502 28.2704 22.2026 28.2933 20.8168ZM29.7313 20.6838C29.7199 20.961 29.8058 21.2326 29.9777 21.4598C30.2928 21.8589 30.8829 21.9365 31.2955 21.6261C31.3585 21.5818 31.41 21.5263 31.4616 21.4709C31.7939 21.0496 31.7939 20.3402 31.4673 19.9189C31.3069 19.7083 31.0548 19.5752 30.7855 19.5697C30.1668 19.5364 29.7313 19.991 29.7313 20.6838ZM27.7891 19.7138C27.7891 20.573 27.7948 21.4321 27.7891 22.2912C27.7948 22.6848 27.474 23.0118 27.0672 23.0229C26.9985 23.0229 26.924 23.0174 26.8552 23.0007C26.5688 22.9287 26.351 22.6349 26.351 22.2857V17.8791C26.351 17.6186 26.3453 17.3636 26.351 17.1031C26.3568 16.6763 26.6375 16.3992 27.0615 16.3992C27.4969 16.3936 27.7891 16.6708 27.7891 17.1142C27.7948 17.9789 27.7891 18.8491 27.7891 19.7138Z"
                            fill="white" />
                        <path
                            d="M22.2947 20.7828C22.289 20.0013 22.7302 19.5302 23.3547 19.5634C23.6239 19.5745 23.876 19.702 24.0364 19.9181C24.3573 20.3339 24.3573 21.0322 24.0364 21.4535C23.7271 21.8526 23.1369 21.9357 22.7187 21.6364C22.65 21.5865 22.5869 21.5255 22.5296 21.4535C22.3864 21.2595 22.3062 21.0267 22.2947 20.7828ZM29.7314 20.683C29.7314 19.9957 30.1668 19.5357 30.7856 19.569C31.0549 19.5745 31.307 19.7075 31.4674 19.9181C31.794 20.3394 31.794 21.0544 31.4617 21.4701C31.1408 21.8636 30.545 21.9302 30.1382 21.6198C30.0752 21.5754 30.0236 21.52 29.9778 21.459C29.8059 21.2318 29.7257 20.9602 29.7314 20.683Z"
                            fill="#0068FF" />
                    </g>
                    <defs>
                        <linearGradient id="paint4_linear" x1="22" y1="0" x2="22"
                            y2="44" gradientUnits="userSpaceOnUse">
                            <stop offset="50%" stop-color="#3180f6" />
                            <stop offset="100%" stop-color="#096de8" />
                        </linearGradient>
                        <clipPath id="clip0">
                            <rect width="26.3641" height="24.2" fill="white"
                                transform="translate(8.78906 9.90234)" />
                        </clipPath>
                    </defs>
                </svg>
                <span class="tooltip-text">Chat với chúng tôi qua Zalo </span>
            </a>
        </div>
        <div class="addThis_item">
            <a class="addThis_item-icon" href="mailto:{{ $config->email }}" aria-label="email"
                title="Gửi email cho chúng tôi ">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="22" cy="22" r="22" fill="url(#paint1_linear)" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.4589 11.6667H32.5414C33.1621 11.6667 33.6993 11.8861 34.153 12.3245C34.6062 12.7634 34.8332 13.2904 34.8332 13.9064C34.8332 14.6435 34.599 15.3481 34.1319 16.0197C33.6639 16.6914 33.0816 17.2655 32.3846 17.7413C30.0672 19.3131 28.3185 20.4998 27.1311 21.3061C26.4785 21.7489 25.9931 22.0787 25.6817 22.2905C25.6355 22.3222 25.5634 22.3723 25.4675 22.4396C25.3643 22.5117 25.2337 22.6037 25.0729 22.7174C24.7625 22.9368 24.5048 23.114 24.2994 23.2495C24.0938 23.3846 23.8457 23.5363 23.5545 23.7043C23.2631 23.8724 22.9887 23.9983 22.7309 24.0823C22.4731 24.1661 22.2344 24.2082 22.0148 24.2082H22.0006H21.9863C21.7667 24.2082 21.5281 24.1661 21.2702 24.0823C21.0125 23.9983 20.7378 23.8721 20.4466 23.7043C20.1552 23.5363 19.9068 23.385 19.7017 23.2495C19.4964 23.114 19.2386 22.9368 18.9284 22.7174C18.7672 22.6037 18.6366 22.5118 18.5334 22.4393L18.5233 22.4323C18.4325 22.3688 18.3638 22.3208 18.3195 22.2905C17.9197 22.0157 17.4354 21.6846 16.8739 21.3022C16.2152 20.8532 15.4486 20.3329 14.5671 19.7359C12.9342 18.6303 11.9554 17.9654 11.6308 17.7413C11.0388 17.3494 10.4802 16.8107 9.95513 16.1248C9.43011 15.4387 9.16748 14.8018 9.16748 14.214C9.16748 13.4864 9.36539 12.8796 9.76184 12.3944C10.158 11.9095 10.7234 11.6667 11.4589 11.6667ZM33.4002 19.2392C31.4494 20.5296 29.7913 21.6405 28.4258 22.5725L34.8324 28.8337V18.0213C34.4217 18.4695 33.9443 18.8752 33.4002 19.2392ZM9.1665 18.0214C9.58659 18.4788 10.0691 18.8848 10.6132 19.2393C12.6414 20.5863 14.2935 21.6952 15.5757 22.5701L9.1665 28.8335V18.0214ZM34.0421 30.8208C33.6172 31.1883 33.1173 31.3745 32.5403 31.3745H11.4578C10.8809 31.3745 10.3807 31.1883 9.95575 30.8208L17.2287 23.7122C17.4107 23.8399 17.5789 23.9592 17.7306 24.0679C18.2751 24.4597 18.7165 24.7654 19.0556 24.9845C19.3944 25.2041 19.8455 25.4279 20.4091 25.6564C20.9726 25.8853 21.4976 25.9993 21.9847 25.9993H21.9989H22.0132C22.5002 25.9993 23.0253 25.8852 23.5888 25.6564C24.152 25.4279 24.6032 25.2041 24.9423 24.9845C25.2814 24.7654 25.7231 24.4597 26.2672 24.0679C26.427 23.955 26.5961 23.8362 26.7705 23.7141L34.0421 30.8208Z"
                        fill="white" />
                    <defs>
                        <linearGradient id="paint1_linear" x1="22" y1="0" x2="22"
                            y2="44" gradientUnits="userSpaceOnUse">
                            <stop offset="50%" stop-color="#22e7f9" />
                            <stop offset="100%" stop-color="#03d2e4" />
                        </linearGradient>
                    </defs>
                </svg>
                <span class="tooltip-text">Gửi email cho chúng tôi </span>
            </a>
        </div>
        <div class="addThis_item">
            <a target="_blank" class="addThis_item-icon" href="{{ $config->facebook }}" aria-label="Liên hệ"
                title="Chat với chúng tôi qua Messenger">
                <svg xmlns="http://www.w3.org/2000/svg" width="44px" height="44px" viewBox="96 93 322 324"
                    id="messenger">
                    <path fill="#0084ff"
                        d="M257 93c-88.918 0-161 67.157-161 150 0 47.205 23.412 89.311 60 116.807V417l54.819-30.273C225.449 390.801 240.948 393 257 393c88.918 0 161-67.157 161-150S345.918 93 257 93zm16 202l-41-44-80 44 88-94 42 44 79-44-88 94z">
                    </path>
                </svg>
                <span class="tooltip-text">Chat với chúng tôi qua Messenger</span>
            </a>
        </div>
    </div>
    <div style="visibility:hidden; position: absolute; z-index: -1; bottom: 0; left: 0;">
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="icon-share">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20"
                    fill="none">
                    <path
                        d="M5.857 12.07C5.233 12.642 4.41 13 3.5 13C1.57 13 0 11.43 0 9.5C0 7.57 1.57 6 3.5 6C4.729 6 5.808 6.64 6.433 7.602L12.117 4.353C12.048 4.078 12 3.796 12 3.5C12 1.57 13.57 0 15.5 0C17.43 0 19 1.57 19 3.5C19 5.43 17.43 7 15.5 7C14.59 7 13.767 6.642 13.142 6.07L6.991 9.585C6.986 9.851 6.946 10.106 6.883 10.353L13.143 13.93C13.767 13.358 14.59 13 15.5 13C17.43 13 19 14.57 19 16.5C19 18.43 17.43 20 15.5 20C13.57 20 12 18.43 12 16.5C12 16.204 12.048 15.922 12.117 15.647L5.857 12.07Z"
                        fill="#fff" />
                </svg>
            </symbol>
            <symbol id="icon-user">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M12 2C9.243 2 7 4.243 7 7C7 9.757 9.243 12 12 12C14.757 12 17 9.757 17 7C17 4.243 14.757 2 12 2ZM12 10C10.346 10 9 8.654 9 7C9 5.346 10.346 4 12 4C13.654 4 15 5.346 15 7C15 8.654 13.654 10 12 10ZM21 21V20C21 16.141 17.859 13 14 13H10C6.14 13 3 16.141 3 20V21H5V20C5 17.243 7.243 15 10 15H14C16.757 15 19 17.243 19 20V21H21Z"
                        fill="#fff" />
                </svg>
            </symbol>
            <symbol id="search">
                <svg enable-background="new 0 0 612.01 612.01" version="1.1" viewBox="0 0 612.01 612.01"
                    xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m606.21 578.71-158.01-155.49c41.378-44.956 66.802-104.41 66.802-169.84-0.02-139.95-115.3-253.39-257.51-253.39s-257.49 113.44-257.49 253.39 115.28 253.39 257.49 253.39c61.445 0 117.8-21.253 162.07-56.586l158.62 156.1c7.729 7.614 20.277 7.614 28.006 0 7.747-7.613 7.747-19.971 0.018-27.585zm-348.72-110.91c-120.33 0-217.87-95.993-217.87-214.41s97.543-214.41 217.87-214.41c120.33 0 217.87 95.993 217.87 214.41s-97.542 214.41-217.87 214.41z">
                    </path>
                </svg>
            </symbol>
            <symbol id="icon-quickview">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                    fill="none">
                    <path
                        d="M7.66667 1C3.98477 1 1 3.98477 1 7.66667C1 11.3486 3.98477 14.3333 7.66667 14.3333C11.3486 14.3333 14.3333 11.3486 14.3333 7.66667C14.3333 5.63913 13.4282 3.823 12 2.60028"
                        stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M16.9991 17.0001L15.2214 15.2223L14.3325 14.3334L12.5547 12.5557"
                        stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M11.666 13.4445C12.9922 13.3918 13.4422 13.0743 13.4438 11.6667" stroke="var(--maincolor)"
                        stroke-width="1.5" stroke-linecap="round" />
                    <path d="M5.44531 7.66675H9.88976" stroke="var(--maincolor)" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M7.66602 9.88892V5.44447" stroke="var(--maincolor)" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </symbol>
            <symbol id="icon-facebook">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M12.001 2.00195C6.47901 2.00195 2.00201 6.47895 2.00201 12.001C2.00201 16.991 5.65801 21.127 10.439 21.88V14.892H7.89901V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z"
                        fill="#fff" />
                </svg>
            </symbol>
            <symbol id="icon-facebook2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M12.001 2.00195C6.47901 2.00195 2.00201 6.47895 2.00201 12.001C2.00201 16.991 5.65801 21.127 10.439 21.88V14.892H7.89901V12.001H10.439V9.79795C10.439 7.28995 11.932 5.90695 14.215 5.90695C15.309 5.90695 16.455 6.10195 16.455 6.10195V8.56095H15.191C13.951 8.56095 13.563 9.33295 13.563 10.124V11.999H16.334L15.891 14.89H13.563V21.878C18.344 21.129 22 16.992 22 12.001C22 6.47895 17.523 2.00195 12.001 2.00195Z"
                        fill="#2E3A59" />
                </svg>
            </symbol>
            <symbol id="icon-instagram">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M11.999 7.377C9.44501 7.377 7.37601 9.447 7.37601 12C7.37601 14.554 9.44501 16.624 11.999 16.624C14.551 16.624 16.622 14.554 16.622 12C16.622 9.447 14.551 7.377 11.999 7.377ZM11.999 15.004C10.34 15.004 8.99501 13.659 8.99501 12.001C8.99501 10.342 10.34 8.998 11.999 8.998C13.658 8.998 15.001 10.342 15.001 12.001C15.001 13.659 13.658 15.004 11.999 15.004Z"
                        fill="#fff" />
                    <path
                        d="M16.806 8.285C17.4014 8.285 17.884 7.80237 17.884 7.207C17.884 6.61164 17.4014 6.129 16.806 6.129C16.2107 6.129 15.728 6.61164 15.728 7.207C15.728 7.80237 16.2107 8.285 16.806 8.285Z"
                        fill="#fff" />
                    <path
                        d="M20.533 6.111C20.064 4.902 19.109 3.946 17.9 3.479C17.201 3.216 16.462 3.075 15.714 3.059C14.751 3.017 14.446 3.005 12.004 3.005C9.56201 3.005 9.24901 3.005 8.29401 3.059C7.54801 3.074 6.80901 3.215 6.11001 3.479C4.90001 3.946 3.94501 4.902 3.47701 6.111C3.21401 6.811 3.07301 7.549 3.05801 8.297C3.01501 9.259 3.00201 9.564 3.00201 12.007C3.00201 14.449 3.00201 14.76 3.05801 15.717C3.07301 16.465 3.21401 17.203 3.47701 17.904C3.94601 19.112 4.90101 20.068 6.11101 20.536C6.80701 20.808 7.54601 20.962 8.29601 20.986C9.25901 21.028 9.56401 21.041 12.006 21.041C14.448 21.041 14.761 21.041 15.716 20.986C16.463 20.971 17.202 20.829 17.902 20.567C19.111 20.098 20.066 19.143 20.535 17.934C20.798 17.234 20.939 16.496 20.954 15.748C20.997 14.786 21.01 14.481 21.01 12.038C21.01 9.59501 21.01 9.285 20.954 8.328C20.941 7.57 20.801 6.819 20.533 6.111ZM19.315 15.643C19.308 16.219 19.204 16.79 19.004 17.331C18.699 18.118 18.078 18.74 17.292 19.042C16.757 19.241 16.193 19.345 15.622 19.353C14.672 19.397 14.404 19.408 11.968 19.408C9.53001 19.408 9.28101 19.408 8.31301 19.353C7.74401 19.346 7.17801 19.241 6.64401 19.042C5.85501 18.741 5.23001 18.119 4.92501 17.331C4.72901 16.797 4.62301 16.232 4.61401 15.662C4.57101 14.712 4.56101 14.444 4.56101 12.008C4.56101 9.571 4.56101 9.322 4.61401 8.353C4.62101 7.777 4.72501 7.207 4.92501 6.666C5.23001 5.877 5.85501 5.256 6.64401 4.954C7.17801 4.756 7.74401 4.651 8.31301 4.643C9.26401 4.6 9.53101 4.588 11.968 4.588C14.405 4.588 14.655 4.588 15.622 4.643C16.193 4.65 16.757 4.755 17.292 4.954C18.078 5.257 18.699 5.879 19.004 6.666C19.2 7.2 19.306 7.765 19.315 8.335C19.358 9.28601 19.369 9.553 19.369 11.99C19.369 14.426 19.369 14.688 19.326 15.644H19.315V15.643Z"
                        fill="#fff" />
                </svg>
            </symbol>
            <symbol id="icon-instagram2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M11.999 7.377C9.44501 7.377 7.37601 9.447 7.37601 12C7.37601 14.554 9.44501 16.624 11.999 16.624C14.551 16.624 16.622 14.554 16.622 12C16.622 9.447 14.551 7.377 11.999 7.377ZM11.999 15.004C10.34 15.004 8.99501 13.659 8.99501 12.001C8.99501 10.342 10.34 8.998 11.999 8.998C13.658 8.998 15.001 10.342 15.001 12.001C15.001 13.659 13.658 15.004 11.999 15.004Z"
                        fill="#2E3A59" />
                    <path
                        d="M16.806 8.285C17.4014 8.285 17.884 7.80237 17.884 7.207C17.884 6.61164 17.4014 6.129 16.806 6.129C16.2107 6.129 15.728 6.61164 15.728 7.207C15.728 7.80237 16.2107 8.285 16.806 8.285Z"
                        fill="#000" />
                    <path
                        d="M20.533 6.111C20.064 4.902 19.109 3.946 17.9 3.479C17.201 3.216 16.462 3.075 15.714 3.059C14.751 3.017 14.446 3.005 12.004 3.005C9.56201 3.005 9.24901 3.005 8.29401 3.059C7.54801 3.074 6.80901 3.215 6.11001 3.479C4.90001 3.946 3.94501 4.902 3.47701 6.111C3.21401 6.811 3.07301 7.549 3.05801 8.297C3.01501 9.259 3.00201 9.564 3.00201 12.007C3.00201 14.449 3.00201 14.76 3.05801 15.717C3.07301 16.465 3.21401 17.203 3.47701 17.904C3.94601 19.112 4.90101 20.068 6.11101 20.536C6.80701 20.808 7.54601 20.962 8.29601 20.986C9.25901 21.028 9.56401 21.041 12.006 21.041C14.448 21.041 14.761 21.041 15.716 20.986C16.463 20.971 17.202 20.829 17.902 20.567C19.111 20.098 20.066 19.143 20.535 17.934C20.798 17.234 20.939 16.496 20.954 15.748C20.997 14.786 21.01 14.481 21.01 12.038C21.01 9.59501 21.01 9.285 20.954 8.328C20.941 7.57 20.801 6.819 20.533 6.111ZM19.315 15.643C19.308 16.219 19.204 16.79 19.004 17.331C18.699 18.118 18.078 18.74 17.292 19.042C16.757 19.241 16.193 19.345 15.622 19.353C14.672 19.397 14.404 19.408 11.968 19.408C9.53001 19.408 9.28101 19.408 8.31301 19.353C7.74401 19.346 7.17801 19.241 6.64401 19.042C5.85501 18.741 5.23001 18.119 4.92501 17.331C4.72901 16.797 4.62301 16.232 4.61401 15.662C4.57101 14.712 4.56101 14.444 4.56101 12.008C4.56101 9.571 4.56101 9.322 4.61401 8.353C4.62101 7.777 4.72501 7.207 4.92501 6.666C5.23001 5.877 5.85501 5.256 6.64401 4.954C7.17801 4.756 7.74401 4.651 8.31301 4.643C9.26401 4.6 9.53101 4.588 11.968 4.588C14.405 4.588 14.655 4.588 15.622 4.643C16.193 4.65 16.757 4.755 17.292 4.954C18.078 5.257 18.699 5.879 19.004 6.666C19.2 7.2 19.306 7.765 19.315 8.335C19.358 9.28601 19.369 9.553 19.369 11.99C19.369 14.426 19.369 14.688 19.326 15.644H19.315V15.643Z"
                        fill="#2E3A59" />
                </svg>
            </symbol>
            <symbol id="icon-youtube">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21.593 7.20301C21.363 6.34501 20.688 5.66801 19.831 5.43701C18.265 5.00701 12 5.00001 12 5.00001C12 5.00001 5.73599 4.99301 4.16899 5.40401C3.32899 5.63301 2.63499 6.32501 2.40299 7.18201C1.98999 8.74801 1.98599 11.996 1.98599 11.996C1.98599 11.996 1.98199 15.26 2.39199 16.81C2.62199 17.667 3.29699 18.344 4.15499 18.575C5.73699 19.005 11.985 19.012 11.985 19.012C11.985 19.012 18.25 19.019 19.816 18.609C20.672 18.379 21.35 17.703 21.583 16.846C21.997 15.281 22 12.034 22 12.034C22 12.034 22.02 8.76901 21.593 7.20301ZM9.99599 15.005L10.001 9.00501L15.208 12.01L9.99599 15.005Z"
                        fill="#fff" />
                </svg>
            </symbol>
            <symbol id="icon-youtube2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M21.593 7.20301C21.363 6.34501 20.688 5.66801 19.831 5.43701C18.265 5.00701 12 5.00001 12 5.00001C12 5.00001 5.73599 4.99301 4.16899 5.40401C3.32899 5.63301 2.63499 6.32501 2.40299 7.18201C1.98999 8.74801 1.98599 11.996 1.98599 11.996C1.98599 11.996 1.98199 15.26 2.39199 16.81C2.62199 17.667 3.29699 18.344 4.15499 18.575C5.73699 19.005 11.985 19.012 11.985 19.012C11.985 19.012 18.25 19.019 19.816 18.609C20.672 18.379 21.35 17.703 21.583 16.846C21.997 15.281 22 12.034 22 12.034C22 12.034 22.02 8.76901 21.593 7.20301ZM9.99599 15.005L10.001 9.00501L15.208 12.01L9.99599 15.005Z"
                        fill="#2E3A59" />
                </svg>
            </symbol>
            <symbol id="icon-twitter">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M22.4592 6.01238C21.6896 6.35373 20.8624 6.58442 19.9944 6.68815C20.8803 6.15701 21.5609 5.31598 21.8813 4.31378C21.052 4.80564 20.1336 5.16278 19.156 5.3552C18.3732 4.52112 17.2579 4 16.0235 4C13.6534 4 11.7317 5.92147 11.7317 8.29155C11.7317 8.6279 11.7697 8.95546 11.8429 9.2696C8.27609 9.0906 5.11375 7.38203 2.99709 4.78551C2.62765 5.41935 2.41601 6.15656 2.41601 6.94309C2.41601 8.43204 3.17364 9.74563 4.32523 10.5153C3.62179 10.4929 2.95996 10.2999 2.38139 9.97846C2.38098 9.99639 2.38098 10.0143 2.38098 10.0324C2.38098 12.1118 3.86033 13.8463 5.82359 14.2406C5.46349 14.3387 5.08434 14.3912 4.69294 14.3912C4.4164 14.3912 4.14755 14.3642 3.88546 14.3142C4.43161 16.0191 6.01653 17.26 7.89454 17.2945C6.42576 18.4457 4.57527 19.1318 2.56453 19.1318C2.21812 19.1318 1.87651 19.1114 1.54077 19.0717C3.44003 20.2894 5.69591 21 8.1195 21C16.0134 21 20.3302 14.4605 20.3302 8.78918C20.3302 8.60314 20.326 8.41805 20.3177 8.23395C21.1563 7.62886 21.8839 6.87302 22.4592 6.01238Z"
                        fill="#fff" />
                </svg>
            </symbol>
            <symbol id="icon-google">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M20.283 10.356H11.956V13.807H16.748C16.302 16 14.435 17.26 11.956 17.26C9.033 17.26 6.677 14.904 6.677 11.98C6.677 9.057 9.033 6.701 11.956 6.701C13.215 6.701 14.353 7.148 15.246 7.879L17.846 5.28C16.262 3.899 14.231 3.047 11.956 3.047C7.002 3.047 3.022 7.026 3.022 11.981C3.022 16.936 7.001 20.915 11.956 20.915C16.423 20.915 20.485 17.666 20.485 11.981C20.485 11.453 20.404 10.884 20.283 10.356Z"
                        fill="#fff" />
                </svg>
            </symbol>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="icon-wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 20 18"
                    fill="none">
                    <path
                        d="M1.39174 9.25109C0.246485 6.09414 1.67809 2.07624 4.82753 1.21525C6.54541 0.64126 8.83588 1.21522 9.98114 2.9372C11.1264 1.21522 13.4169 0.64126 15.1347 1.21525C18.5705 2.36323 19.7158 6.09414 18.5705 9.25109C17.139 14.13 11.4127 17 9.98114 17C8.54957 16.713 3.10962 14.417 1.39174 9.25109Z"
                        stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </symbol>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="icon-compare">
                <svg x="0" y="0" viewBox="0 0 459 459.648" style="enable-background:new 0 0 512 512">
                    <path xmlns="http://www.w3.org/2000/svg"
                        d="m416.324219 293.824219c0 26.507812-21.492188 48-48 48h-313.375l63.199219-63.199219-22.625-22.625-90.511719 90.511719c-6.246094 6.25-6.246094 16.375 0 22.625l90.511719 90.511719 22.625-22.625-63.199219-63.199219h313.375c44.160156-.054688 79.945312-35.839844 80-80v-64h-32zm0 0"
                        fill="#7B7B7B" data-original="#000000" style=""></path>
                    <path xmlns="http://www.w3.org/2000/svg"
                        d="m32.324219 165.824219c0-26.511719 21.488281-48 48-48h313.375l-63.199219 63.199219 22.625 22.625 90.511719-90.511719c6.246093-6.25 6.246093-16.375 0-22.625l-90.511719-90.511719-22.625 22.625 63.199219 63.199219h-313.375c-44.160157.050781-79.949219 35.839843-80 80v64h32zm0 0"
                        fill="#7B7B7B" data-original="#000000" style=""></path>
                </svg>
            </symbol>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="icon-viewmore">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 11" fill="none">
                    <path
                        d="M12.9764 9.08131C12.7355 9.31672 12.7355 9.70421 12.9764 9.93962C13.2096 10.1675 13.5821 10.1675 13.8153 9.93962L17.8089 6.03635C18.1099 5.74213 18.1099 5.25784 17.8089 4.96362L13.8153 1.06038C13.5821 0.832464 13.2096 0.832464 12.9764 1.06038C12.7355 1.29579 12.7355 1.68328 12.9764 1.91869L15.592 4.47507C15.7522 4.63172 15.6413 4.90386 15.4172 4.90386L1.34615 4.90385C1.01691 4.90385 0.75 5.17076 0.75 5.50001C0.75 5.82925 1.01691 6.09616 1.34615 6.09616L15.4172 6.09617C15.6413 6.09617 15.7522 6.36831 15.5919 6.52496L12.9764 9.08131Z"
                        fill="url(#paint0_linear_158_2937)" stroke="url(#paint1_linear_158_2937)"
                        stroke-width="0.5" />
                    <defs>
                        <linearGradient id="paint0_linear_158_2937" x1="9.5" y1="10" x2="9.5"
                            y2="0.999999" gradientUnits="userSpaceOnUse">
                            <stop offset="0.786458" stop-color="#3A529B" />
                        </linearGradient>
                    </defs>
                </svg>
            </symbol>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="icon-cart">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.50001 1.75C6.98123 1.75 5.75001 2.98121 5.75001 4.5L5.75 8.83231C5.75 9.24652 5.41421 9.58231 5 9.58231C4.58579 9.58231 4.25 9.24652 4.25 8.8323L4.25001 4.49999C4.25001 2.15279 6.1528 0.25 8.50001 0.25H9.5C11.8472 0.25 13.75 2.15279 13.75 4.5V9C13.75 9.41421 13.4142 9.75 13 9.75C12.5858 9.75 12.25 9.41421 12.25 9V4.5C12.25 2.98122 11.0188 1.75 9.5 1.75H8.50001Z"
                        fill="var(--maincolor)" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.365475 9.71565C-0.271948 7.07673 2.13363 4.83729 4.68971 5.25515C7.6749 5.74315 10.2539 5.75778 13.3285 5.25915C15.8862 4.84435 18.3012 7.08619 17.6626 9.7297L15.8987 17.0323C15.5134 18.6275 14.0839 19.75 12.4423 19.75H5.58922C3.94759 19.75 2.5181 18.6275 2.13279 17.0323L0.365475 9.71565ZM4.44771 6.7355C2.82223 6.46977 1.46793 7.89121 1.82354 9.36346L3.59085 16.6801C3.81308 17.6001 4.63848 18.25 5.58922 18.25H12.4423C13.393 18.25 14.2184 17.6001 14.4407 16.6801L16.2046 9.37751C16.5607 7.90333 15.2 6.47523 13.5686 6.73981C10.3323 7.26466 7.59048 7.24926 4.44771 6.7355Z"
                        fill="var(--maincolor)" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.35724 12.9114C6.36263 12.4972 6.70276 12.1658 7.11694 12.1712L11.0098 12.2219C11.424 12.2273 11.7553 12.5674 11.7499 12.9816C11.7446 13.3958 11.4044 13.7271 10.9902 13.7217L7.09742 13.6711C6.68324 13.6657 6.35185 13.3256 6.35724 12.9114Z"
                        fill="var(--maincolor)" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.08863 10.2501C9.5028 10.2555 9.83419 10.5956 9.8288 11.0098L9.77812 14.9026C9.77273 15.3168 9.4326 15.6482 9.01843 15.6428C8.60425 15.6374 8.27286 15.2972 8.27825 14.8831L8.32893 10.9902C8.33432 10.5761 8.67445 10.2447 9.08863 10.2501Z"
                        fill="var(--maincolor)" />
                </svg>
            </symbol>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="icon-outsock">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20"
                    fill="none">
                    <path
                        d="M5 8.83231L5.00001 4.49999C5.00001 2.567 6.56701 1 8.50001 1H9.5C11.433 1 13 2.567 13 4.5V5.66667V9"
                        stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round" />
                    <path
                        d="M15.1693 16.8563C14.8656 18.1139 13.7381 19.0001 12.4419 19.0001H5.58885C4.29267 19.0001 3.16522 18.1139 2.86145 16.8563L1.09414 9.53967C0.59762 7.48409 2.47756 5.65365 4.56834 5.99544C7.63232 6.49632 10.2927 6.51134 13.4482 5.99959C15.5427 5.65991 17.4306 7.49487 16.9332 9.55372L16.0513 13.205"
                        stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M11.0003 12.9718L7.10742 12.9211" stroke="var(--maincolor)" stroke-width="1.5"
                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </symbol>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="icon-settings">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 20 18"
                    fill="none">
                    <path d="M1 3H4" stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M1 15H4" stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M12 3L19 3" stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M12 15L19 15" stroke="var(--maincolor)" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M1 9H2.5H3.25M13 9H7" stroke="var(--maincolor)" stroke-width="1.5"
                        stroke-linecap="round" />
                    <rect x="6" y="1" width="4" height="4" rx="1.5" stroke="var(--maincolor)"
                        stroke-width="1.5" />
                    <rect x="6" y="13" width="4" height="4" rx="1.5" stroke="var(--maincolor)"
                        stroke-width="1.5" />
                    <rect x="15" y="7" width="4" height="4" rx="1.5" stroke="var(--maincolor)"
                        stroke-width="1.5" />
                </svg>
            </symbol>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg">
            <symbol id="icon-detail">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 22 14"
                    fill="none">
                    <path
                        d="M2.01893 6.83862C4.49682 3.78685 7.34662 1.7 11 1.7V0.3C6.73344 0.3 3.52547 2.76213 0.932078 5.95615L2.01893 6.83862ZM11 1.7C14.6534 1.7 17.5032 3.78685 19.9811 6.83862L21.0679 5.95615C18.4745 2.76213 15.2666 0.3 11 0.3V1.7ZM19.9811 7.16138C17.5032 10.2131 14.6534 12.3 11 12.3V13.7C15.2666 13.7 18.4745 11.2379 21.0679 8.04385L19.9811 7.16138ZM11 12.3C7.34662 12.3 4.49682 10.2131 2.01893 7.16138L0.932078 8.04385C3.52547 11.2379 6.73344 13.7 11 13.7V12.3ZM19.9811 6.83862C20.0577 6.93295 20.0577 7.06705 19.9811 7.16138L21.0679 8.04385C21.562 7.43529 21.562 6.56471 21.0679 5.95615L19.9811 6.83862ZM0.932078 5.95615C0.437953 6.56471 0.437952 7.43529 0.932078 8.04385L2.01893 7.16138C1.94234 7.06705 1.94234 6.93295 2.01893 6.83862L0.932078 5.95615Z"
                        fill="var(--maincolor)" />
                    <path
                        d="M12.8 7C12.8 7.99411 11.9942 8.8 11 8.8V10.2C12.7674 10.2 14.2 8.76731 14.2 7H12.8ZM11 8.8C10.0059 8.8 9.20005 7.99411 9.20005 7H7.80005C7.80005 8.76731 9.23273 10.2 11 10.2V8.8ZM9.20005 7C9.20005 6.00589 10.0059 5.2 11 5.2V3.8C9.23273 3.8 7.80005 5.23269 7.80005 7H9.20005ZM11 5.2C11.9942 5.2 12.8 6.00589 12.8 7H14.2C14.2 5.23269 12.7674 3.8 11 3.8V5.2Z"
                        fill="var(--maincolor)" />
                </svg>
            </symbol>
        </svg>
    </div>

    <script>
        $(window).on('load scroll', function(){
            if($(window).scrollTop() > $('.section_blog .item-blog').offset().top - $(window).height() && $(window).scrollTop() > 0){
                $('.section_blog .item-blog').addClass('animate__fadeInLeft animate__delay-1s');
            }
            if($(window).scrollTop() > $('.section_policy .inner').offset().top - $(window).height() && $(window).scrollTop() > 0){
                $('.section_policy .inner').addClass('animate__fadeInLeft animate__delay-1s');
            }
            if($(window).scrollTop() > $('.section_view_product .category-banner').offset().top - $(window).height() && $(window).scrollTop() > 0){
                $('.section_view_product .category-banner').addClass('animate__fadeInRight animate__delay-1s');
            }
            if($(window).scrollTop() > $('.section_blog .category-banner').offset().top - $(window).height() && $(window).scrollTop() > 0){
                $('.section_blog .category-banner').addClass('animate__fadeInRight animate__delay-1s');
            }
        })
    </script>
</body>

</html>
