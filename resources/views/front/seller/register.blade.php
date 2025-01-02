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
                            <h2>{{translate('Seller Register')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('Seller Register')}}</li>
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
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3>{{translate('Welcome To')}} {{$generalSettingView->site_name}}</h3>
                                <h4>{{translate('Create New Shop')}}</h4>
                            </div>

                            <div class="input-box">
                                <form class="row g-4" action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="card">
                                        <div class="card-header">
                                            <h4><b>Seller Info</b></h4>
                                        </div>
                                        <div class="card-body">
                                            @if(Session::get('customer_id'))
                                                <div class="col-12 mb-3">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="fullname" name="name" placeholder="{{translate('Full Name')}}" value="{{$customer->name}}" readonly>
                                                        <label for="fullname">{{translate('Full Name')}}<sup class="text-danger">*</sup></label>
                                                        @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="mobile" name="email" placeholder="{{translate('Enter Email Address')}}" value="{{$customer->email}}" readonly>
                                                        <label for="mobile">{{translate('Email')}}<sup class="text-danger">*</sup></label>
                                                        @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="{{translate('Mobile Number')}}" value="{{$customer->mobile}}" readonly>
                                                        <label for="mobile">{{translate('Mobile Number')}}<sup class="text-danger">*</sup></label>
                                                        @error('mobile')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-12 mb-3">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="fullname" name="name" placeholder="{{translate('Full Name')}}" value="{{ old('name') }}" required>
                                                        <label for="fullname">{{translate('Full Name')}}<sup class="text-danger">*</sup></label>
                                                        @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="mobile" name="email" placeholder="{{translate('Enter Email Address')}}" value="{{ old('email') }}" required>
                                                        <label for="mobile">{{translate('Email')}}<sup class="text-danger">*</sup></label>
                                                        @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="{{translate('Mobile Number')}}" value="{{ old('mobile') }}" required>
                                                        <label for="mobile">{{translate('Mobile Number')}}<sup class="text-danger">*</sup></label>
                                                        @error('mobile')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{translate('Password')}}" required>
                                                        <label for="password">{{translate('Password')}}<sup class="text-danger">*</sup></label>
                                                        @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div class="form-floating theme-form-floating">
                                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="{{translate('Password Confirmation')}}" required>
                                                        <label for="password_confirmation">{{translate('Password Confirmation')}}<sup class="text-danger">*</sup></label>
                                                        @error('password_confirmation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4><b>Shop Info</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12 mb-3">
                                                <div class="form-floating theme-form-floating">
                                                    <input type="text" class="form-control @error('shop_name') is-invalid @enderror" id="shop_name" name="shop_name" placeholder="{{translate('Shop Name')}}" value="{{ old('shop_name') }}" required>
                                                    <label for="shop_name">{{translate('Shop Name')}}<sup class="text-danger">*</sup></label>
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="form-floating theme-form-floating">
                                                    <input type="text" class="form-control @error('shop_address') is-invalid @enderror" id="shop_address" name="shop_address" placeholder="{{translate('Shop Address')}}" value="{{ old('shop_address') }}" required>
                                                    <label for="shop_address">{{translate('Shop Address')}}<sup class="text-danger">*</sup></label>
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100" type="submit">{{translate('Create Shop')}}</button>
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
