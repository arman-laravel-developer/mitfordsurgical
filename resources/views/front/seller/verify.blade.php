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
                    @if(\App\Models\Seller::find(Session::get('seller_id'))->is_verified == 3)
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12">
                            <h2 class="text-center text-success">Your shop verification request has been submitted successfully. Please wait for a moment.</h2>
                        </div>
                        <table class="table table-striped table-bordered mt-3" cellspacing="0" width="100%">
                            <tbody>
                            @php
                                $seller = \App\Models\Seller::find(Session::get('seller_id'));
                                $verificationInfo = $seller ? json_decode($seller->verification_info) : [];
                            @endphp

                            @if (!empty($verificationInfo))
                                @foreach ($verificationInfo as $info)
                                    <tr>
                                        <th class="text-muted">{{ $info->label }}</th>
                                        @if (isset($info->type) && ($info->type == 'text' || $info->type == 'select' || $info->type == 'radio'))
                                            <td>{{ $info->value }}</td>
                                        @elseif (isset($info->type) && $info->type == 'multi_select')
                                            <td>
                                                {{ is_array(json_decode($info->value)) ? implode(', ', json_decode($info->value)) : $info->value }}
                                            </td>
                                        @elseif (isset($info->type) && $info->type == 'file')
                                            <td>
                                                <a href="{{ asset($info->value) }}" target="_blank" class="btn btn-info">{{ translate('Click here') }}</a>
                                            </td>
                                        @else
                                            <td>{{ $info->value }}</td> <!-- Fallback for undefined types -->
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    @else
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-8 mx-auto">
                            <div class="log-in-box">
                                <div class="log-in-title">
                                    <h3>Welcome To {{$generalSettingView->site_name}}</h3>
                                    <h4>Verify your shop</h4>
                                </div>
                                <div class="input-box">
                                    <form class="row g-4" action="{{ route('verify.form.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Full Name -->
                                        <div class="col-12">
                                            <div class="form-floating theme-form-floating">
                                                <input type="text" class="form-control" name="name" id="fullname" placeholder="Full Name" required>
                                                <label for="fullname">Full Name <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <!-- Shop Name -->
                                        <div class="col-12">
                                            <div class="form-floating theme-form-floating">
                                                <input type="text" class="form-control" name="shop_name" id="shopname" placeholder="Shop Name" required>
                                                <label for="shopname">Shop Name <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-12">
                                            <div class="form-floating theme-form-floating">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <!-- License Number -->
                                        <div class="col-12">
                                            <div class="form-floating theme-form-floating">
                                                <input type="text" class="form-control" id="licenseNo" name="trade_license_no" placeholder="Trade License No" required>
                                                <label for="licenseNo">Trade License No <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <!-- Full Address -->
                                        <div class="col-12">
                                            <div class="form-floating theme-form-floating">
                                                <textarea class="form-control" id="fullAddress" name="address" placeholder="Full Address" style="height: 100px;" required></textarea>
                                                <label for="fullAddress">Full Address <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <!-- Phone Number -->
                                        <div class="col-12">
                                            <div class="form-floating theme-form-floating">
                                                <input type="tel" class="form-control" id="phoneNumber" name="phone" placeholder="Phone Number" required>
                                                <label for="phoneNumber">Phone Number <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <!-- Tax Papers Upload -->
                                        <div class="col-12">
                                            <label for="taxPapers" class="form-label">Tax Papers</label>
                                            <input type="file" class="form-control" id="taxPapers" name="tax_papers">
                                        </div>
                                        <!-- Submit Button -->
                                        <div class="col-12">
                                            <button class="btn btn-animation w-100" type="submit">Verify</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- log in section end -->
    </div>
@endsection
