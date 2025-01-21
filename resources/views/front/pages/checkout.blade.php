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

        <style>
            /* CSS for the wizard navigation bar */
            .checkout-steps {
                display: flex;
                justify-content: space-around;
                margin-bottom: 20px;
                background-color: #f8f9fa;
                padding: 15px 0;
            }

            .step {
                text-align: center;
                cursor: pointer;
            }

            .step-number {
                display: block;
                font-size: 18px;
                font-weight: bold;
                color: #999;
            }

            .step-title {
                display: block;
                font-size: 14px;
                color: #999;
            }

            .step.active .step-number, .step.active .step-title {
                color: #0baf9a;
            }

            .step.completed .step-number, .step.completed .step-title {
                color: #0baf9a;
            }

            .step.completed .step-number::before {
                content: '✔';
                display: block;
                font-size: 18px;
                color: #0baf9a;
            }

            /* CSS for the wizard content sections */
            .checkout-step {
                display: none;
            }

            .checkout-step.active-step {
                display: block;
            }

            .checkout-detail {
                display: block;
                border: 2px solid #0baf9a;
                background-color: #0baf9a;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                text-align: center;
                cursor: pointer;
                transition: background-color 0.3s, border-color 0.3s;
                margin-bottom: 10px;
            }
            .checkout-detail .form-check-input {
                display: none;
            }
            .delivery-option {
                display: block;
                border: 2px solid #ccc;
                padding: 10px;
                border-radius: 5px;
                text-align: center;
                cursor: pointer;
                transition: background-color 0.3s, border-color 0.3s;
                margin-bottom: 10px;
            }

            .delivery-option:hover {
                background-color: #f0f0f0;
            }

            .delivery-option .form-check-input {
                display: none;
            }

            .delivery-option .form-check-label {
                display: block;
                color: #333;
                font-weight: bold;
            }

            /* Change the background color of the parent .delivery-option when the input is checked */
            .delivery-option input:checked + .form-check-label {
                background-color: #0baf9a; /* Change the background color of the entire box */
                color: white; /* Change the text color to white */
                border-color: #0baf9a; /* Change the border color to match the background */
            }
        </style>

        <style>
            .is-invalid {
                border-color: #e74c3c;
            }
            .invalid-feedback {
                color: #e74c3c;
                font-size: 0.875rem;
            }
        </style>
        <style>
            .error {
                color: red;
            }
        </style>

        <!-- Checkout section Start -->
        <section class="checkout-section-2 section-b-space" style="padding-top: 1%;">
            <div class="container">
                <div class="row g-sm-4 g-3">
                    <!-- Wizard Content Sections -->
                    <div class="col-lg-7">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                        @php
                        $customer = \App\Models\Customer::find(Session::get('customer_id'));
                        @endphp
                    <!-- Wizard Navigation -->
                        <form action="{{route('order.store')}}" id="submitOrderForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" readonly value="{{$cartTotal}}" id="cartTotalV" name="cartTotal">
                            <input type="text" readonly value="" id="couponDiscount" name="couponDiscount">
                            <input type="text" readonly value="" id="couponCodeShow" name="couponCodeShow">
                            <div class="checkout-steps">
                                <div class="step" id="step1">
                                    <span class="step-number">
                                        <div class="checkout-icon">
                                            <i class="fas fa-map-marker-alt fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                        </div>
                                    </span>
                                    <span class="step-title">{{translate('Delivery Address')}}</span>
                                </div>
                                <div class="step" id="step2">
                                    <span class="step-number">
                                        <div class="checkout-icon">
                                            <i class="fas fa-truck fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                        </div>
                                    </span>
                                    <span class="step-title">{{translate('Delivery Option')}}</span>
                                </div>
                                <div class="step" id="step3">
                                    <span class="step-number">
                                        <div class="checkout-icon">
                                            <i class="fas fa-money-bill fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                        </div>
                                    </span>
                                    <span class="step-title">{{translate('Payment Option')}}</span>
                                </div>
                                <div class="step" id="step4">
                                    <span class="step-number">
                                        <div class="checkout-icon">
                                            <i class="fas fa-check-circle fa-2x text-center" style="color: #0baf9a; margin-left: 20%;"></i>
                                        </div>
                                    </span>
                                    <span class="step-title">{{translate('Confirmation')}}</span>
                                </div>
                            </div>

                            <!-- Step 1: Delivery Address -->
                            <div class="checkout-step active-step" id="step-1">
                                <div class="row">
                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                        <div class="mb-3 custom-form row">
                                            <label for="exampleFormControlInput" class="col-2 form-label">{{translate('Name')}}<sup class="text-danger">*</sup></label>
                                            <div class="custom-input col-10">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" @if($customer) value="{{$customer->name}}" @else value="{{old('name')}}" @endif id="exampleFormControlInput" name="name" placeholder="{{translate('Enter Full Name')}}" required>
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                        <div class="mb-3 custom-form row">
                                            <label for="exampleFormControlInput3" class="col-2 form-label">{{translate('Mobile')}}<sup class="text-danger">*</sup></label>
                                            <div class="custom-input col-10">
                                                <input type="tel" class="form-control @error('mobile') is-invalid @enderror" @if($customer) value="{{$customer->mobile}}" @else value="{{old('mobile')}}" @endif id="exampleFormControlInput3" name="mobile" placeholder="{{translate('Enter Your Mobile Number')}}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" required>
                                                @error('mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-lg-12 col-sm-6">
                                        <div class="mb-3 custom-form row">
                                            <label for="exampleFormControlInput1" class="col-2 form-label">{{translate('Address')}}<sup class="text-danger">*</sup></label>
                                            <div class="custom-input col-10">
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" @if($customer) value="{{$customer->address}}" @else value="{{old('address')}}" @endif name="address" id="exampleFormControlInput1" placeholder="{{translate('Enter Details Address')}}" required>
                                                @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                    </div>
                                    <div class="col-6">
                                        <button id="nextStep1" class="btn theme-bg-color text-white btn-md mt-2 fw-bold" type="button" onclick="showStep(2)" style="float: inline-end;" disabled>{{translate('Next')}}</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Delivery Option -->
                            <div class="checkout-step" id="step-2">
                                <div class="row g-4">
                                    @foreach($shippingCosts as $shippingCost)
                                        <div class="col-6 h-100">
                                            <label class="delivery-option">
                                                <div class="form-check custom-form-check">
                                                    <input class="form-check-input shipping-option @error('shipping_cost') is-invalid @enderror" type="radio" value="{{$shippingCost->shipping_cost}}" name="shipping_cost" id="standard{{$shippingCost->id}}" required>
                                                    <span class="form-check-label" style="margin-left: -11%">{{$shippingCost->address_name}} ({{$shippingCost->shipping_cost}} taka)</span>
                                                </div>
                                            </label>
                                            @error('shipping_cost')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a id="previousStep2" class="btn bg-primary text-white btn-md w-100 mt-4 fw-bold" onclick="showStep(1)">{{translate('Previous')}}</a>
                                    </div>
                                    <div class="col-6">
                                        <a id="nextStep2" class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" onclick="showStep(3)" disabled>{{translate('Next')}}</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Payment Option -->
                            <div class="checkout-step" id="step-3">
                                <div class="checkout-detail">
                                    <div class="form-check custom-form-check">
                                        <label class="form-check-label" for="cash" style="margin-left: -11%">
                                            <input class="form-check-input mt-0" type="radio" name="payment_method" value="cod" id="cash" checked required> {{translate('Cash On Delivery')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a id="previousStep3" class="btn bg-primary text-white btn-md w-100 mt-4 fw-bold" onclick="showStep(2)">{{translate('Previous')}}</a>
                                    </div>
                                    <div class="col-6">
                                        <a id="nextStep3" class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" onclick="showStep(4)" disabled>{{translate('Next')}}</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Confirmation -->
                            <div class="checkout-step" id="step-4">
                                <div class="custom-form mb-3">
                                    <div class="custom-input">
                                        <input type="text" class="form-control" name="order_note" placeholder="{{translate('Enter Delivery Note')}}">
                                    </div>
                                </div>
                                <div class="delivery-address-box d-flex align-items-center">
                                    <input type="checkbox" id="agree_policy" name="agree_policy" class="form-check-input me-2 @error('agree_policy') is-invalid @enderror" required>
                                    <label for="agree_policy" class="form-check-label mb-0">{{translate('I have read and agree to the')}} <a href="#" class="text-primary">{{translate('terms and conditions')}}</a>.</label>
                                </div>
                                @error('agree_policy')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="row">
                                    <div class="col-6">
                                        <a id="previousStep4" class="btn bg-primary text-white btn-md w-100 mt-4 fw-bold" onclick="showStep(3)">{{translate('Previous')}}</a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" type="submit">{{translate('Place Order')}}</button>
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
                                <div class="summery-contain">
                                    <div class="coupon-cart" style="display: none">
                                        <h6 class="text-content mb-2">{{translate('Coupon Apply')}}</h6>
                                        <div class="mb-3 coupon-box input-group">
                                            <input type="text" class="form-control" id="couponCode" placeholder="{{translate('Enter Coupon Code Here')}}...">
                                            <button class="btn-apply" id="applyCouponBtn">{{translate('Apply')}}</button>
                                        </div>
                                        <div id="couponMessage"></div>
                                    </div>
                                    <ul>
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
                                </div>

                                <ul class="summery-total">
                                    <li>
                                        <h4>{{translate('Subtotal')}}</h4>
                                        <h4 class="price">&#2547;{{number_format($cartTotal, 2)}}</h4>
                                    </li>
                                    <li>
                                        <h4>{{translate('Coupon Discount')}}(-)</h4>
                                        <h4 class="price" id="couponDiscountView">&#2547;0.00</h4>
                                    </li>
                                    <li>
                                        <h4>{{translate('Shipping')}}(+)</h4>
                                        <h4 class="price" id="shipping">&#2547;0.00</h4>
                                    </li>
                                    <li>
                                        <h4>{{translate('Vat/Tax')}}</h4>
                                        <h4 class="price" id="vat">&#2547;0.00</h4>
                                    </li>
                                    <li class="list-total">
                                        <h4>{{translate('Grand Total (BDT)')}}</h4>
                                        <h4 class="price" id="grand-total">&#2547;{{number_format($cartTotal, 2)}}</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Checkout section End -->
    </div>

    <!-- JavaScript for the wizard functionality -->
    <script>
        function showStep(stepNumber) {
            // Update the active step
            document.querySelectorAll('.step').forEach((step, index) => {
                step.classList.remove('active');
                if (index < stepNumber) {
                    step.classList.add('completed');
                }
                if (index === stepNumber - 1) {
                    step.classList.add('active');
                }
            });

            // Show the corresponding step content
            document.querySelectorAll('.checkout-step').forEach(stepContent => stepContent.classList.remove('active-step'));
            document.getElementById(`step-${stepNumber}`).classList.add('active-step');

            // Show the coupon cart only on step 4
            const couponCart = document.querySelector('.coupon-cart');
            if (stepNumber === 4) {
                couponCart.style.display = 'block'; // Show coupon cart
            } else {
                couponCart.style.display = 'none'; // Hide coupon cart on other steps
            }

            // Validate the current step to enable/disable "Next" button
            validateStep(stepNumber);
        }

        function validateStep(stepNumber) {
            let allFieldsFilled = true;

            // Get all required inputs for the specific step
            const stepInputs = document.querySelectorAll(`#step-${stepNumber} input[required]`);

            // Loop through the inputs and check if any of them is empty
            stepInputs.forEach(input => {
                if (!input.value.trim()) {
                    allFieldsFilled = false;
                }
            });

            // Enable/Disable the next button based on whether all required fields are filled
            const nextButton = document.getElementById(`nextStep${stepNumber}`);
            if (nextButton) {
                nextButton.disabled = !allFieldsFilled;
            }
        }

        // Attach event listeners to inputs for validation
        document.querySelectorAll('input[required]').forEach(input => {
            input.addEventListener('input', function () {
                const currentStep = this.closest('.checkout-step').id.replace('step-', '');
                validateStep(currentStep);
            });
        });

        // Initial validation check for step 1
        validateStep(1);
    </script>
    <script>
        document.querySelectorAll('.form-check-input').forEach(input => {
            input.addEventListener('change', function() {
                // Remove the background color from all delivery options
                document.querySelectorAll('.delivery-option').forEach(option => {
                    option.style.backgroundColor = '';  // Reset the background color
                    option.style.borderColor = '';      // Reset the border color
                });

                // Apply the background color to the checked option
                if (this.checked) {
                    this.closest('.delivery-option').style.backgroundColor = '#0baf9a';
                    this.closest('.delivery-option').style.borderColor = '#0baf9a';
                }
            });
        });
    </script>

    <meta name="apply-coupon-url" content="{{ route('coupon.apply') }}">
    <meta name="remove-coupon-url" content="{{ route('coupon.remove') }}">

    <script>
        document.getElementById('applyCouponBtn').addEventListener('click', function() {
            const couponCode = document.getElementById('couponCode').value;
            const applyBtn = this;
            const applyCouponUrl = document.querySelector('meta[name="apply-coupon-url"]').content;
            const removeCouponUrl = document.querySelector('meta[name="remove-coupon-url"]').content;

            if (applyBtn.textContent === 'Apply') {
                // Apply Coupon Code
                fetch(applyCouponUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ coupon: couponCode })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data);
                            toastr.success("{{translate('Coupon Applied Successfully')}}!");
                            // document.getElementById('couponMessage').textContent = 'Coupon Applied Successfully!';
                            applyBtn.textContent = 'Remove';
                            // Update total prices dynamically if needed
                            document.getElementById('grand-total').textContent = `৳${data.newTotal.toFixed(2)}`;
                            document.getElementById('cartTotalV').value = data.newTotal; // Updated this to 'value' instead of 'val'
                            document.getElementById('couponDiscount').value = data.couponDiscountNumber;
                            document.getElementById('couponDiscountView').textContent = data.couponDiscount;
                            document.getElementById('couponCodeShow').value = data.couponCodeShow;
                            document.getElementById('couponCode').readOnly = true;
                        } else {
                            document.getElementById('couponMessage').textContent = data.message;
                        }
                    });
            } else {
                // Remove Coupon Code
                fetch(removeCouponUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success("{{translate('Coupon Removed Successfully')}}!");
                            // document.getElementById('couponMessage').textContent = 'Coupon Removed Successfully!';
                            applyBtn.textContent = 'Apply';
                            document.getElementById('couponCode').value = '';
                            // Update total prices dynamically if needed
                            document.getElementById('grand-total').textContent = `৳${data.cartTotalRemove.toFixed(2)}`;
                            document.getElementById('cartTotalV').value = data.cartTotalRemove; // Updated this to 'value' instead of 'val'
                            document.getElementById('couponDiscount').value = '';
                            document.getElementById('couponDiscountView').textContent = data.couponDiscount;
                            document.getElementById('couponCodeShow').value = '';
                            document.getElementById('couponCode').readOnly = false;
                        }
                    });
            }
        });
    </script>
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
            const cartTotalInput = document.getElementById('cartTotalV');

            // Fetch the initial cart total from the input value
            let cartTotal = parseFloat("{{ $cartTotal }}");

            // Add event listeners to shipping options
            shippingOptions.forEach(option => {
                option.addEventListener('change', function () {
                    let selectedShippingCost = parseFloat(this.value);
                    shippingElement.innerText = `৳${selectedShippingCost.toFixed(2)}`;
                    let grandTotal = cartTotal + selectedShippingCost;
                    grandTotalElement.innerText = `৳${grandTotal.toFixed(2)}`;


                    const applyBtn = document.getElementById('applyCouponBtn');
                    const removeCouponUrl = document.querySelector('meta[name="remove-coupon-url"]').content;

                    fetch(removeCouponUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({})
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                applyBtn.textContent = 'Apply';
                                document.getElementById('couponCode').value = '';
                                document.getElementById('grand-total').textContent = `৳${grandTotal.toFixed(2)}`;
                                document.getElementById('cartTotalV').value = grandTotal;
                                document.getElementById('couponDiscount').value = '';
                                document.getElementById('couponDiscountView').textContent = data.couponDiscount;
                                document.getElementById('couponCodeShow').value = '';
                                document.getElementById('couponCode').readOnly = false;
                            }
                        })
                        .catch(error => console.error('Error removing coupon:', error));

                    // Send the selected shipping cost to the backend to store in session
                    fetch("{{ route('shipping.cost') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ shippingCost: selectedShippingCost })
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.message); // Optional: log success message
                        })
                        .catch(error => console.error('Error updating shipping cost:', error));
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
