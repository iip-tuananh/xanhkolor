@extends('site.layouts.master')
@section('title')
    Liên hệ
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection
@section('css')
    <link href="/site/css/breadcrumb_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/style_page.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
    <link href="/site/css/contact_style.scss.css?1740037266911" rel="stylesheet" type="text/css" media="all" />
@endsection

@section('content')
    <section class="bread-crumb">
        <div class="container">
            <ul class="breadcrumb">
                <li class="home">
                    <a href="{{ route('front.home-page') }}"><span>Trang chủ</span></a>
                    <span class="mr_lr">&nbsp;/&nbsp;</span>
                </li>
                <li><span>Liên hệ</span></li>
            </ul>
            <div class="title_full">
                Liên hệ
            </div>
        </div>
    </section>
    <div class="layout-contact" ng-controller="ContactUsController">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="contact">
                        <h4>
                            Nơi giải đáp toàn bộ mọi thắc mắc của bạn?
                        </h4>
                        <div class="des_foo">
                            {{ $config->web_des }}
                        </div>
                        <div class="time_work">
                            <div class="item">
                                <b>Địa chỉ:</b>
                                {{ $config->address_company }}
                            </div>
                            <div class="item">
                                <b>Hotline:</b> <a class="fone" href="tel:{{ str_replace(' ', '', $config->hotline) }}"
                                    title="{{ $config->hotline }}">{{ $config->hotline }}</a>
                            </div>
                            <div class="item">
                                <b>Email:</b> <a href="mailto:{{ $config->email }}"
                                    title="{{ $config->email }}">{{ $config->email }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-contact">
                        <h4>
                            Liên hệ với chúng tôi
                        </h4>
                        <div id="pagelogin">
                            <form id="contact" accept-charset="UTF-8">
                                <div class="group_contact">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group" style="margin-bottom: 15px">
                                                <input placeholder="Họ và tên" type="text"
                                                    class="form-control  form-control-lg" required value=""
                                                    name="your_name" style="margin-bottom: 0">
                                                <div class="invalid-feedback d-block error" role="alert">
                                                    <span ng-if="errors && errors.your_name">
                                                        <% errors.your_name[0] %>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group" style="margin-bottom: 15px">
                                                <input placeholder="Email" type="email"
                                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required
                                                    id="email1" class="form-control form-control-lg" value=""
                                                    name="your_email" style="margin-bottom: 0">
                                                <div class="invalid-feedback d-block error" role="alert">
                                                    <span ng-if="errors && errors.your_email">
                                                        <% errors.your_email[0] %>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group" style="margin-bottom: 15px">
                                                <input type="number" placeholder="Điện thoại" name="your_phone"
                                                    style="margin-bottom: 0" class="form-control form-control-lg" required>
                                                <div class="invalid-feedback d-block error" role="alert">
                                                    <span ng-if="errors && errors.your_phone">
                                                        <% errors.your_phone[0] %>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <textarea placeholder="Nội dung" name="your_message" id="comment" class="form-control content-area form-control-lg"
                                                rows="5" Required></textarea>
                                            <button type="submit" class="btn-lienhe" ng-disabled="loading"
                                                ng-click="submitContact()">Gửi thông tin</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div id="contact_map" class="map">
                        {!! $config->location !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        app.controller('ContactUsController', function($scope, $http) {
            $scope.loading = false;
            $scope.errors = {};
            console.log($scope.errors);
            $scope.submitContact = function() {
                $scope.loading = true;
                let data = {
                    your_name: $scope.your_name,
                    your_email: $scope.your_email,
                    your_phone: $scope.your_phone,
                    your_message: $scope.your_message
                };
                jQuery.ajax({
                    url: '{{ route('front.post-contact') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Thao tác thành công !')
                        } else {
                            $scope.errors = response.errors;
                            toastr.error('Thao tác thất bại !')
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                        $scope.loading = false;
                    }
                });
            };
        });
    </script>
@endpush
