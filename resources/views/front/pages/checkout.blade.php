@extends('front.master')

@section('title')
{{translate('Checkout')}} | {{$generalSettingView->site_name}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain p-0">
                            <h2>{{translate('Checkout')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('Checkout')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Checkout section Start -->
        <section class="checkout-section-2 section-b-space">
            <div class="container">
                <div class="row g-sm-4 g-3">
                    <div class="col-lg-8">
                        <form action="">
                            <div class="left-sidebar-checkout">
                                <div class="checkout-detail-box">
                                    <ul>
                                        <li>
                                            <div class="checkout-icon">
                                                <i class="fas fa-map-marker-alt fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>{{translate('Delivery Address')}}</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="row g-4">
                                                        <div class="col-xxl-12 col-lg-12 col-md-12">
                                                            <div class="delivery-address-box">
                                                                <div class="row">
                                                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                                        <div class="mb-md-4 mb-3 custom-form">
                                                                            <label for="exampleFormControlInput" class="form-label">{{translate('Full Name')}}<sup class="text-danger">*</sup></label>
                                                                            <div class="custom-input">
                                                                                <input type="text" class="form-control" id="exampleFormControlInput"
                                                                                       placeholder="{{translate('Enter Full Name')}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                                        <div class="mb-md-4 mb-3 custom-form">
                                                                            <label for="exampleFormControlInput3" class="form-label">{{translate('Phone Number')}}<sup class="text-danger">*</sup></label>
                                                                            <div class="custom-input">
                                                                                <input type="tel" class="form-control" id="exampleFormControlInput3"
                                                                                       placeholder="{{translate('Enter Your Phone Number')}}"
                                                                                       maxlength="11"
                                                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                                        <div class="mb-md-4 mb-3 custom-form">
                                                                            <label for="exampleFormControlInput1" class="form-label">{{translate('Details Address')}}<sup class="text-danger">*</sup> </label>
                                                                            <div class="custom-input">
                                                                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                                                                       placeholder="{{translate('Enter Details Address')}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="checkout-icon">
                                                <i class="fas fa-truck fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>{{translate('Delivery Option')}}</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="row g-4">
                                                        <div class="col-xxl-6">
                                                            <label class="delivery-option" for="standard" style="display: block; cursor: pointer;">
                                                                <div class="delivery-category">
                                                                    <div class="shipment-detail">
                                                                        <div class="form-check custom-form-check">
                                                                            <input class="form-check-input" type="radio" name="standard" id="standard" checked>
                                                                            <span class="form-check-label">Inside Dhaka (80 taka)</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="col-xxl-6">
                                                            <label class="delivery-option" for="future" style="display: block; cursor: pointer;">
                                                                <div class="delivery-category">
                                                                    <div class="shipment-detail">
                                                                        <div class="form-check mb-0 custom-form-check">
                                                                            <input class="form-check-input" type="radio"
                                                                                   name="standard" id="future">
                                                                            <span class="form-check-label" >Outside Dhaka (120 taka)</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="checkout-icon">
                                                <i class="fas fa-money-bill fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>{{translate('Payment Option')}}</h4>
                                                </div>

                                                <style>
                                                    /* Remove default down arrow for accordion buttons */
                                                    .accordion-button::before {
                                                        display: none; /* Hides the default down arrow */
                                                    }
                                                </style>

                                                <div class="checkout-detail">
                                                    <div class="accordion accordion-flush custom-accordion"
                                                         id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingFour">
                                                                <div class="accordion-button collapsed">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label" for="cash"><input
                                                                                class="form-check-input mt-0" type="radio"
                                                                                name="flexRadioDefault" id="cash" checked> Cash
                                                                            On Delivery</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingOne">
                                                                <div class="accordion-button collapsed">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label" for="bkash"><input
                                                                                class="form-check-input mt-0" type="radio"
                                                                                name="flexRadioDefault" id="bkash">
                                                                            Bkash</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkout-icon">
                                                <i class="fas fa-pen-alt fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>{{translate('Delivery Note')}}</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="row g-4">
                                                        <div class="col-xxl-12 col-lg-12 col-md-12">
                                                            <div class="delivery-address-box">
                                                                <div class="row">
                                                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                                        <div class="custom-form">
                                                                            <div class="custom-input">
                                                                                <input type="text" class="form-control" placeholder="{{translate('Enter Delivery Note')}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row g-4 mt-4">
                                    <div class="col-xxl-12 col-lg-12 col-md-12">
                                        <div class="delivery-address-box d-flex align-items-center">
                                            <input type="checkbox" id="agree_policy" name="agree_policy" class="form-check-input me-2">
                                            <label for="agree_policy" class="form-check-label mb-0">
                                                {{translate('I have read and agree to the')}} <a href="#" class="text-primary">{{translate('terms and conditions')}}</a>.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4">
                        <div class="right-side-summery-box">
                            <div class="summery-box-2">
                                <div class="summery-header">
                                    <h3>{{translate('Order Summery')}}</h3>
                                </div>

                                <ul class="summery-contain">
                                    <li>
                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/1.png"
                                             class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>Bell pepper <span>X 1</span></h4>
                                        <h4 class="price">$32.34</h4>
                                    </li>

                                    <li>
                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/2.png"
                                             class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>Eggplant <span>X 3</span></h4>
                                        <h4 class="price">$12.23</h4>
                                    </li>

                                    <li>
                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/3.png"
                                             class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>Onion <span>X 2</span></h4>
                                        <h4 class="price">$18.27</h4>
                                    </li>

                                    <li>
                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/4.png"
                                             class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>Potato <span>X 1</span></h4>
                                        <h4 class="price">$26.90</h4>
                                    </li>

                                    <li>
                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/5.png"
                                             class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>Baby Chili <span>X 1</span></h4>
                                        <h4 class="price">$19.28</h4>
                                    </li>

                                    <li>
                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/6.png"
                                             class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>Broccoli <span>X 2</span></h4>
                                        <h4 class="price">$29.69</h4>
                                    </li>
                                </ul>

                                <ul class="summery-total">
                                    <li>
                                        <h4>{{translate('Subtotal')}}</h4>
                                        <h4 class="price">$111.81</h4>
                                    </li>

                                    <li>
                                        <h4>{{translate('Shipping')}}</h4>
                                        <h4 class="price">$8.90</h4>
                                    </li>

                                    <li>
                                        <h4>{{translate('Tax')}}</h4>
                                        <h4 class="price">$29.498</h4>
                                    </li>

                                    <li>
                                        <h4>{{translate('Coupon/Code')}}</h4>
                                        <h4 class="price">$-23.10</h4>
                                    </li>

                                    <li class="list-total">
                                        <h4>{{translate('Total (BDT)')}}</h4>
                                        <h4 class="price">$19.28</h4>
                                    </li>
                                </ul>
                            </div>

                            <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">{{translate('Place Order')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Checkout section End -->
    </div>
@endsection
