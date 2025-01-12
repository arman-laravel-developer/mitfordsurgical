@extends('front.master')

@section('title')
{{translate('Checkout')}} | {{$generalSettingView->site_name}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section" style="padding-top: 0!important;">
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
                    <div class="col-lg-7">
                        <form action="{{route('order.store')}}" id="submitOrderForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="left-sidebar-checkout">
                                <div class="checkout-detail-box">
                                    <ul>
                                        <!-- Delivery Address Section -->
                                        <li>
                                            <div class="checkout-icon">
                                                <i class="fas fa-map-marker-alt fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>{{translate('Delivery Address')}}</h4>
                                                    @if(Session::get('customer_id'))
                                                        <button type="button" class="btn btn-sm bg-primary text-white btn-toggle">Autofill</button>
                                                    @endif
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
                                                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput" name="name" placeholder="{{translate('Enter Full Name')}}" required>
                                                                                @error('name')
                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                                        <div class="mb-md-4 mb-3 custom-form">
                                                                            <label for="exampleFormControlInput3" class="form-label">{{translate('Phone Number')}}<sup class="text-danger">*</sup></label>
                                                                            <div class="custom-input">
                                                                                <input type="tel" class="form-control @error('mobile') is-invalid @enderror" id="exampleFormControlInput3" name="mobile" placeholder="{{translate('Enter Your Phone Number')}}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" required>
                                                                                @error('mobile')
                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                                        <div class="mb-md-4 mb-3 custom-form">
                                                                            <label for="exampleFormControlInput1" class="form-label">{{translate('Details Address')}}<sup class="text-danger">*</sup></label>
                                                                            <div class="custom-input">
                                                                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="exampleFormControlInput1" placeholder="{{translate('Enter Details Address')}}" required>
                                                                                @error('address')
                                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                                @enderror
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

                                        <!-- Delivery Option Section -->
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
                                                        @foreach($shippingCosts as $shippingCost)
                                                            <div class="col-xxl-6">
                                                                <label class="delivery-option" for="standard{{$shippingCost->id}}" style="display: block; cursor: pointer;">
                                                                    <div class="delivery-category">
                                                                        <div class="shipment-detail">
                                                                            <div class="form-check custom-form-check">
                                                                                <input class="form-check-input shipping-option @error('shipping_cost') is-invalid @enderror" type="radio" value="{{$shippingCost->shipping_cost}}" name="shipping_cost" id="standard{{$shippingCost->id}}" required>
                                                                                <span class="form-check-label">{{$shippingCost->address_name}} ({{$shippingCost->shipping_cost}} taka)</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                                @error('shipping_cost')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- Payment Option Section -->
                                        <li>
                                            <div class="checkout-icon">
                                                <i class="fas fa-money-bill fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>{{translate('Payment Option')}}</h4>
                                                </div>
                                                <div class="checkout-detail">
                                                    <div class="accordion accordion-flush custom-accordion" id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingFour">
                                                                <div class="accordion-button collapsed">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label" for="cash">
                                                                            <input class="form-check-input mt-0" type="radio" name="payment_method" value="cod" id="cash" checked required> Cash On Delivery</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- Delivery Note Section -->
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
                                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                            <div class="custom-form">
                                                                <div class="custom-input">
                                                                    <input type="text" class="form-control" name="delivery_note" placeholder="{{translate('Enter Delivery Note')}}">
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
                                            <input type="checkbox" id="agree_policy" name="agree_policy" class="form-check-input me-2 @error('agree_policy') is-invalid @enderror" required>
                                            <label for="agree_policy" class="form-check-label mb-0">{{translate('I have read and agree to the')}} <a href="#" class="text-primary">{{translate('terms and conditions')}}</a>.</label>
                                        </div>
                                        @error('agree_policy')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="col-lg-5">
                        <div class="right-side-summery-box">
                            <div class="summery-box-2">
                                <div class="summery-header">
                                    <h3>{{translate('Order Summery')}}</h3>
                                </div>
                                <ul class="summery-contain">
                                    @foreach($cartProducts as $cartProduct)
                                        @php($variant = \App\Models\Variant::find($cartProduct->attributes->variant_id))
                                        <li>
                                            <img src="{{asset($cartProduct->attributes->thumbnail_image)}}"
                                                 class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                            <h4>{{$cartProduct->name}} <span style="font-size: 80%;">(&#2547;{{number_format($cartProduct->price)}} X {{$cartProduct->quantity}})</span> <br>
                                                @if($variant)Variant: {{$variant->variant}} @endif
                                            </h4>
                                            <h4 class="price">&#2547;{{number_format($cartProduct->price * $cartProduct->quantity, 2)}}</h4>
                                        </li>
                                    @endforeach
                                </ul>

                                <ul class="summery-total">
                                    <li>
                                        <h4>{{translate('Subtotal')}}</h4>
                                        <h4 class="price">&#2547;{{number_format($cartTotal, 2)}}</h4>
                                    </li>

                                    <li>
                                        <h4>{{translate('Shipping')}}</h4>
                                        <h4 class="price" id="shipping">&#2547;0.00</h4>
                                    </li>

                                    <li class="list-total">
                                        <h4>{{translate('Grand Total (BDT)')}}</h4>
                                        <h4 class="price" id="grand-total">&#2547;{{number_format($cartTotal, 2)}}</h4>
                                    </li>
                                </ul>
                            </div>

                            <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" onclick="event.preventDefault();document.getElementById('submitOrderForm').submit();">{{translate('Place Order')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Checkout section End -->
    </div>

    <style>
        .is-invalid {
            border-color: #e74c3c;
        }
        .invalid-feedback {
            color: #e74c3c;
            font-size: 0.875rem;
        }
    </style>
    <script>
        document.getElementById('submitOrderForm').addEventListener('submit', function(event) {
            let formValid = true;

            // Check for required fields
            const requiredFields = document.querySelectorAll('[required]');
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    formValid = false;
                    field.classList.add('is-invalid');
                    // Optionally, you can highlight the invalid field with an error message.
                    if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorMessage = document.createElement('div');
                        errorMessage.classList.add('invalid-feedback');
                        errorMessage.textContent = "This field is required.";
                        field.parentNode.appendChild(errorMessage);
                    }
                } else {
                    field.classList.remove('is-invalid');
                    if (field.nextElementSibling && field.nextElementSibling.classList.contains('invalid-feedback')) {
                        field.nextElementSibling.remove();
                    }
                }
            });

            // If any field is invalid, prevent form submission
            if (!formValid) {
                event.preventDefault();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const shippingOptions = document.querySelectorAll('.shipping-option');
            const subtotalElement = document.getElementById('subtotal');
            const shippingElement = document.getElementById('shipping');
            const grandTotalElement = document.getElementById('grand-total');

            let cartTotal = parseFloat("{{ $cartTotal }}");

            shippingOptions.forEach(option => {
                option.addEventListener('change', function () {
                    let selectedShippingCost = parseFloat(this.value);
                    shippingElement.innerText = `৳${selectedShippingCost.toFixed(2)}`;
                    let grandTotal = cartTotal + selectedShippingCost;
                    grandTotalElement.innerText = `৳${grandTotal.toFixed(2)}`;
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.btn-toggle').click(function() {
                if ($(this).text() === 'Autofill') {
                    // Perform autofill
                    $.ajax({
                        url: '{{route('get.customer-data')}}',
                        method: 'GET',
                        success: function(response) {
                            if (response.success) {
                                $('#exampleFormControlInput').val(response.data.name);
                                $('#exampleFormControlInput3').val(response.data.mobile);
                                $('#exampleFormControlInput1').val(response.data.address);
                                // Change button text to "Clear"
                                $('.btn-toggle').text('Clear').removeClass('bg-primary').addClass('bg-danger');
                            } else {
                                alert('Unable to fetch customer data');
                            }
                        },
                        error: function() {
                            alert('Error fetching data');
                        }
                    });
                } else {
                    // Clear all inputs
                    $('#exampleFormControlInput').val('');
                    $('#exampleFormControlInput3').val('');
                    $('#exampleFormControlInput1').val('');
                    // Change button text to "Autofill"
                    $('.btn-toggle').text('Autofill').removeClass('bg-danger').addClass('bg-primary');
                }
            });
        });
    </script>
@endsection
