@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('Login')}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section" style="padding-top: 0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 0;">
                            <h2>{{translate('Login')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('Login')}}</li>
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
                                <h4>{{translate('Log In Your Account')}}</h4>
                            </div>

                            <div class="input-box">
                                <form class="row g-4" action="{{route('customer.login-check')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="{{translate('Mobile Number')}}">
                                            <label for="mobile">{{translate('Mobile Number')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating position-relative">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{translate('Password')}}">
                                            <label for="password">{{translate('Password')}}</label>
                                            <button type="button" id="togglePassword" class="btn btn-outline-secondary position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="forgot-box">
                                            <div class="form-check ps-0 m-0 remember-box">
                                                <input class="checkbox_animated check-box" type="checkbox"
                                                       id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">{{translate('Remember me')}}</label>
                                            </div>
                                            <a href="{{route('forget.password')}}" class="forgot-password">{{translate('Forgot Password')}}?</a>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100 justify-content-center" type="submit">
                                            {{translate('Log In')}}</button>
                                    </div>
                                </form>
                            </div>

                            <div class="other-log-in">
                                <h6></h6>
                            </div>

                            <div class="sign-up-box">
                                <h4>{{translate("Don't have an account")}}?</h4>
                                <a href="{{route('customer.register')}}">{{translate('Sign Up')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- log in section end -->
    </div>
@endsection
