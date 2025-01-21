@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('Track My Order')}}
@endsection

@section('body')

    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 1%;">
                            <h2>{{translate('Order Tracking')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('Order Tracking')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Search Bar Section Start -->
        <section class="search-section">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-8 mx-auto">
                        <div class="title d-block text-center">
                            <h2>{{translate('Order Tracking')}}</h2>
                            <span class="title-leaf">
                        </span>
                        </div>

                        <div class="search-box">
                            <form id="orderForm" action="{{route('show.track-result')}}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="order_code" id="order-id" placeholder="xxxxx-xxxxx-xxxxx">
                                <button class="btn theme-bg-color text-white m-0" type="submit"
                                        id="button-addon1">{{translate('Tracking')}}</button>
                            </div>

                            <small id="error-message" style="color: red; display: none; margin-top: 2%; font-size: 88%;">{{translate('Order Code must be exactly 17 digits')}}.</small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Search Bar Section End -->
    </div>

    <script>
        const orderInput = document.getElementById('order-id');
        const form = document.getElementById('orderForm');
        const errorMessage = document.getElementById('error-message');

        orderInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters

            // Ensure the value doesn't exceed 17 numeric characters
            if (value.length > 17) {
                value = value.slice(0, 17);
            }

            // Insert hyphens after 6 and 12 numeric characters
            if (value.length > 6) {
                value = value.replace(/(\d{6})(\d{1,6})/, '$1-$2');
            }
            if (value.length > 12) {
                value = value.replace(/(\d{6})-(\d{6})(\d{1,5})/, '$1-$2-$3');
            }

            e.target.value = value;
        });

        // Form submission validation
        form.addEventListener('submit', function(e) {
            const inputVal = orderInput.value.replace(/\D/g, ''); // Get numeric value only

            // Check if numeric value is exactly 17 digits
            if (inputVal.length !== 17) {
                e.preventDefault(); // Prevent form submission
                errorMessage.style.display = 'block'; // Show error message
            } else {
                errorMessage.style.display = 'none'; // Hide error message if valid
            }
        });
    </script>

@endsection
