@extends('front.master')

@section('title')
    {{$generalSettingView->site_name}} - {{translate('Forgot Password')}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 0;">
                            <h2>{{translate('Forgot Password')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('Forgot Password')}}</li>
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
                                <h3>{{translate('Welcome To')}} {{$generalSettingView->site_name}}</h3>
                                <h4>{{translate('Forgot your password')}}</h4>
                            </div>

                            <div class="input-box">
                                <form class="row g-4" action="{{route('forget.password-send-code')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="tel" class="form-control" name="mobile" id="mobile"
                                                   placeholder="{{translate('Mobile Number')}}">
                                            <label for="mobile">{{translate('Mobile Number')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100" type="submit">{{translate('Forgot Password')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- log in section end -->
    </div>
@endsection
