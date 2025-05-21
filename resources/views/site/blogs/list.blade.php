@extends('site.layouts.master')
@section('title')
    {{ $cate_title }}
@endsection
@section('description')
    {{ $cate_des ?? '' }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image->path) }}
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
                <li><span>{{ $cate_title }}</span></li>
            </ul>
            <div class="title_full">
                {{ $cate_title }}
            </div>
        </div>
    </section>
    <div class="blog_wrapper layout-blog" itemscope itemtype="https://schema.org/Blog">
        <meta itemprop="name" content="Tin tức">
        <meta itemprop="description" content="">
        <div class="container">
            <div class="row">
                <div class="right-content col-lg-9 col-12">
                    <h1 class="title-page d-none">{{ $cate_title }}</h1>
                    <div class="list-blogs">
                        <div class="row">
                            @foreach ($blogs as $blog)
                                <div class="col-md-6 col-12">
                                    @include('site.blogs.item', ['post' => $blog])
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
                <div class="blog_left_base col-lg-3 col-12">
                    @include('site.blogs.nav-blog', ['newBlogs' => $newBlogs, 'services' => $services])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
