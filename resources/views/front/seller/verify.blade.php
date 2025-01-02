@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('Seller Register')}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section" style="padding-top: 0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>{{translate('Seller Verify')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('Seller Verify')}}</li>
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

                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-8 mx-auto">
                        <p>Please Wait For Verify</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- log in section end -->
    </div>
@endsection
