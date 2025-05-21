@extends('site.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
@endsection

@section('css')
<link href="/site/css/breadcrumb_style.scss.css?1745416765608" rel="stylesheet" type="text/css" media="all" />
<link href="/site/css/style_page.scss.css?1745416765608" rel="stylesheet" type="text/css" media="all" />
@endsection

@section('content')
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
    <section class="page">
        <div class="container">
            <div class="pg_page padding-top-15">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title category-title">
                            <h1 class="title-head"><a href="#">{{ $title }}</a></h1>
                        </div>
                        <div class="content-page rte">
                            {!! $content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
