@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('Register')}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section" style="padding-top: 0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding-top: 0">
                            <h2>{{translate('Register')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('Register')}}</li>
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
{{--                            <img src="{{asset('/')}}front/assets/images/inner-page/sign-up.png" class="img-fluid" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3>{{translate('Welcome To')}} {{$generalSettingView->site_name}}</h3>
                                <h4>{{translate('Create New Account')}}</h4>
                            </div>

                            <div class="input-box">
                                <form class="row g-4" action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="fullname" name="name" placeholder="{{translate('Full Name')}}" value="{{ old('name') }}">
                                            <label for="fullname">{{translate('Full Name')}}</label>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating">
                                            <input type="tel" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="{{translate('Mobile Number')}}" value="{{ old('mobile') }}">
                                            <label for="mobile">{{translate('Mobile Number')}}</label>
                                            @error('mobile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                        <div class="form-floating theme-form-floating position-relative">
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="{{translate('Password Confirmation')}}">
                                            <label for="password_confirmation">{{translate('Password Confirmation')}}</label>
                                            <button type="button" id="togglePasswordConfirmation" class="btn btn-outline-secondary position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="forgot-box">
                                            <div class="form-check ps-0 m-0 remember-box">
                                                <input class="checkbox_animated check-box @error('policy') is-invalid @enderror" name="policy" value="1" type="checkbox" id="flexCheckDefault" {{ old('policy') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">I agree with
                                                    <span><a href="{{ route('condition.page') }}">Terms</a></span> and <span><a href="{{ route('privacy.page') }}">Privacy</a></span></label>
                                                @error('policy')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100" type="submit">{{translate('Sign Up')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="other-log-in">
                                <h6></h6>
                            </div>

                            <div class="sign-up-box">
                                <h4>{{translate('Already have an account')}}?</h4>
                                <a href="{{route('customer.login')}}">{{translate('Log In')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- log in section end -->
    </div>
@endsection
