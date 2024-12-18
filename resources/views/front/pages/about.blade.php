@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - About Us
@endsection

@section('body')
    <div class="page-header text-center" style="background-image: url('{{asset('/')}}front/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">About us</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="about-text text-center mt-3">
                        <h2 class="title text-center mb-2">Who We Are</h2><!-- End .title text-center mb-2 -->
                        <p>{!! $about->who_we_are !!}</p>
{{--                        <img src="{{asset('/')}}front/assets/images/about/about-2/signature.png" alt="signature" class="mx-auto mb-5">--}}

                        <img src="{{asset($about->image)}}" alt="image" class="mx-auto mb-6 mt-3">
                    </div><!-- End .about-text -->
                </div><!-- End .col-lg-10 offset-1 -->
            </div><!-- End .row -->
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-lg-4 col-sm-6">--}}
{{--                    <div class="icon-box icon-box-sm text-center">--}}
{{--                                <span class="icon-box-icon">--}}
{{--                                    <i class="icon-puzzle-piece"></i>--}}
{{--                                </span>--}}
{{--                        <div class="icon-box-content">--}}
{{--                            <h3 class="icon-box-title">Design Quality</h3><!-- End .icon-box-title -->--}}
{{--                            <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero <br>eu augue.</p>--}}
{{--                        </div><!-- End .icon-box-content -->--}}
{{--                    </div><!-- End .icon-box -->--}}
{{--                </div><!-- End .col-lg-4 col-sm-6 -->--}}

{{--                <div class="col-lg-4 col-sm-6">--}}
{{--                    <div class="icon-box icon-box-sm text-center">--}}
{{--                                <span class="icon-box-icon">--}}
{{--                                    <i class="icon-life-ring"></i>--}}
{{--                                </span>--}}
{{--                        <div class="icon-box-content">--}}
{{--                            <h3 class="icon-box-title">Professional Support</h3><!-- End .icon-box-title -->--}}
{{--                            <p>Praesent dapibus, neque id cursus faucibus, <br>tortor neque egestas augue, eu vulputate <br>magna eros eu erat. </p>--}}
{{--                        </div><!-- End .icon-box-content -->--}}
{{--                    </div><!-- End .icon-box -->--}}
{{--                </div><!-- End .col-lg-4 col-sm-6 -->--}}

{{--                <div class="col-lg-4 col-sm-6">--}}
{{--                    <div class="icon-box icon-box-sm text-center">--}}
{{--                                <span class="icon-box-icon">--}}
{{--                                    <i class="icon-heart-o"></i>--}}
{{--                                </span>--}}
{{--                        <div class="icon-box-content">--}}
{{--                            <h3 class="icon-box-title">Made With Love</h3><!-- End .icon-box-title -->--}}
{{--                            <p>Pellentesque a diam sit amet mi ullamcorper <br>vehicula. Nullam quis massa sit amet <br>nibh viverra malesuada.</p>--}}
{{--                        </div><!-- End .icon-box-content -->--}}
{{--                    </div><!-- End .icon-box -->--}}
{{--                </div><!-- End .col-lg-4 col-sm-6 -->--}}
{{--            </div><!-- End .row -->--}}
        </div><!-- End .container -->

        <div class="mb-2"></div><!-- End .mb-2 -->

{{--        <div class="bg-image pt-7 pb-5 pt-md-12 pb-md-9" style="background-image: url({{asset('/')}}front/assets/images/backgrounds/bg-4.jpg)">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-6 col-md-3">--}}
{{--                        <div class="count-container text-center">--}}
{{--                            <div class="count-wrapper text-white">--}}
{{--                                <span class="count" data-from="0" data-to="40" data-speed="3000" data-refresh-interval="50">0</span>k+--}}
{{--                            </div><!-- End .count-wrapper -->--}}
{{--                            <h3 class="count-title text-white">Happy Customer</h3><!-- End .count-title -->--}}
{{--                        </div><!-- End .count-container -->--}}
{{--                    </div><!-- End .col-6 col-md-3 -->--}}

{{--                    <div class="col-6 col-md-3">--}}
{{--                        <div class="count-container text-center">--}}
{{--                            <div class="count-wrapper text-white">--}}
{{--                                <span class="count" data-from="0" data-to="20" data-speed="3000" data-refresh-interval="50">0</span>+--}}
{{--                            </div><!-- End .count-wrapper -->--}}
{{--                            <h3 class="count-title text-white">Years in Business</h3><!-- End .count-title -->--}}
{{--                        </div><!-- End .count-container -->--}}
{{--                    </div><!-- End .col-6 col-md-3 -->--}}

{{--                    <div class="col-6 col-md-3">--}}
{{--                        <div class="count-container text-center">--}}
{{--                            <div class="count-wrapper text-white">--}}
{{--                                <span class="count" data-from="0" data-to="95" data-speed="3000" data-refresh-interval="50">0</span>%--}}
{{--                            </div><!-- End .count-wrapper -->--}}
{{--                            <h3 class="count-title text-white">Return Clients</h3><!-- End .count-title -->--}}
{{--                        </div><!-- End .count-container -->--}}
{{--                    </div><!-- End .col-6 col-md-3 -->--}}

{{--                    <div class="col-6 col-md-3">--}}
{{--                        <div class="count-container text-center">--}}
{{--                            <div class="count-wrapper text-white">--}}
{{--                                <span class="count" data-from="0" data-to="15" data-speed="3000" data-refresh-interval="50">0</span>--}}
{{--                            </div><!-- End .count-wrapper -->--}}
{{--                            <h3 class="count-title text-white">Awards Won</h3><!-- End .count-title -->--}}
{{--                        </div><!-- End .count-container -->--}}
{{--                    </div><!-- End .col-6 col-md-3 -->--}}
{{--                </div><!-- End .row -->--}}
{{--            </div><!-- End .container -->--}}
{{--        </div><!-- End .bg-image pt-8 pb-8 -->--}}

    </div><!-- End .page-content -->
@endsection
