@extends('front.master')

@section('title')
    {{$generalSettingView->site_name}} - Forgot Password
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 0;">
                            <h2>Forgot Password</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Forgot Password</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- log in section start -->
        <section class="log-in-section background-image-2" style="padding-top: 0">
            <div class="container w-100">
                <div class="row justify-content-center">
                    {{--                    <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">--}}
                    {{--                        <div class="image-contain">--}}
                    {{--                            <img src="{{asset('/')}}front/assets/images/inner-page/log-in.png" class="img-fluid" alt="">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3 class="text-title">Please enter the one time password to verify your account</h3>
                                <h5 class="text-content">{{Session::get('message')}}</h5>
                            </div>

                            <div id="otp" class="inputs d-flex flex-row justify-content-center">
                                <input class="text-center form-control rounded" type="text" id="first" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="second" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="third" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="fourth" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="fifth" maxlength="1"
                                       placeholder="0">
                                <input class="text-center form-control rounded" type="text" id="sixth" maxlength="1"
                                       placeholder="0">
                            </div>

                            <div class="send-box pt-4">
                                <h5>Didn't get the code? <a href="javascript:void(0)" class="theme-color fw-bold">Resend
                                        It</a></h5>
                            </div>

                            <button onclick="location.href = '{{route('home')}}';" class="btn btn-animation w-100 mt-3"
                                    type="submit">Validate</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- log in section end -->
    </div>
@endsection
