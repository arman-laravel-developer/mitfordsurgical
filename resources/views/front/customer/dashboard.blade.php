@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('My Account')}}
@endsection

@section('body')
    <style>
        .pending-order-bg {
            background: #f0!important;ad4e!important; /* Example: Orange */
            color: white!important;
            padding: 5px!important;
            border-radius: 4px!important;
        }

        .confirmed-order-bg {
            background: #5bc0de!important; /* Example: Light Blue */
            color: white!important;
            padding: 5px!important;
            border-radius: 4px!important;
        }

        .processing-order-bg {
            background: #0275d8!important; /* Example: Dark Blue */
            color: white!important;
            padding: 5px!important;
            border-radius: 4px!important;
        }

        .shipped-order-bg {
            background: #5cb85c!important; /* Example: Green */
            color: white!important;
            padding: 5px!important;
            border-radius: 4px!important;
        }

        .success-order-bg {
            background: #28a745!important; /* Example: Success Green */
            color: white!important;
            padding: 5px!important;
            border-radius: 4px!important;
        }

        .returned-order-bg {
            background: #ffc107!important; /* Example: Yellow */
            color: white!important;
            padding: 5px!important;
            border-radius: 4px!important;
        }

        .cancel-order-bg {
            background: #d9534f!important; /* Example: Red */
            color: white!important;
            padding: 5px!important;
            border-radius: 4px!important;
        }
    </style>
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>{{translate('User Dashboard')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('User Dashboard')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- User Dashboard Section Start -->
        <section class="user-dashboard-section" style="padding-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-3 col-lg-4">
                        <div class="dashboard-left-sidebar">
                            <div class="close-button d-flex d-lg-none">
                                <button class="close-sidebar">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div class="profile-box">
                                <div class="cover-image">
                                    <img src="{{asset('/')}}front/assets/images/inner-page/cover-img.jpg" class="img-fluid blur-up lazyload"
                                         alt="">
                                </div>

                                <div class="profile-contain">
                                    <div class="profile-image">
                                        <div class="position-relative">
                                            @if($customer->profile_img)
                                                <img src="{{ asset($customer->profile_img) }}" class="blur-up lazyload update_img" alt="">
                                            @else
                                                <img src="{{ asset('/') }}front/assets/images/profile.jpg" class="blur-up lazyload update_img" alt="">
                                            @endif

                                            <form action="{{ route('profile.image-update') }}" method="POST" id="profileForm" enctype="multipart/form-data">
                                                @csrf
                                                <div class="cover-icon">
                                                    <i class="fa-solid fa-pen">
                                                        <input type="file" name="profile_img" onchange="readURL(this, 0); document.getElementById('profileForm').submit();">
                                                    </i>
                                                </div>

                                                <!-- Display Validation Error Message for profile_img -->
                                                @error('profile_img')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </form>
                                        </div>
                                    </div>

                                    <div class="profile-name">
                                        <h3>{{$customer->name}}</h3>
                                        <h6 class="text-content">{{$customer->mobile}}</h6>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('active_tab', '#pills-dashboard') == '#pills-dashboard' ? 'active' : '' }}" id="pills-dashboard-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-dashboard" type="button"><i data-feather="home"></i>
                                        {{translate('DashBoard')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('active_tab') == '#pills-order' ? 'active' : '' }}" id="pills-order-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-order" type="button"><i
                                            data-feather="shopping-bag"></i>{{translate('Order')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('active_tab') == '#pills-profile' ? 'active' : '' }}" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"><i data-feather="user"></i>
                                        {{translate('Profile')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" onclick="document.getElementById('logoutForm').submit();">
                                        <i data-feather="log-out"></i>{{translate('Logout')}}</button>
                                    <form action="{{route('customer.logout')}}" method="POST" id="logoutForm">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xxl-9 col-lg-8">
                        <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">{{translate('Show Menu')}}</button>
                        <div class="dashboard-right-sidebar">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show {{ session('active_tab', '#pills-dashboard') == '#pills-dashboard' ? 'active' : '' }}" id="pills-dashboard" role="tabpanel">
                                    <div class="dashboard-home">
                                        <div class="title">
                                            <h2>{{translate('My Dashboard')}}</h2>
                                            <span class="title-leaf">
                                        </span>
                                        </div>

                                        <div class="dashboard-user-name">
                                            <h6 class="text-content">Hello, <b class="text-title">{{$customer->name}}</b></h6>
                                        </div>

                                        <div class="total-box">
                                            <div class="row g-sm-4 g-3">
                                                <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                    <div class="total-contain">
                                                        <img src="{{ asset('/') }}front/assets/svg/pending.svg"
                                                             class="img-1 blur-up lazyload" alt="">
                                                        <img src="{{ asset('/') }}front/assets/svg/pending.svg" class="blur-up lazyload"
                                                             alt="">
                                                        <div class="total-detail">
                                                            <h5>{{translate('Total Order')}}</h5>
                                                            <h3>{{count($customer->orders)}}</h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                    <div class="total-contain">
                                                        <img src="{{ asset('/') }}front/assets/svg/order.svg"
                                                             class="img-1 blur-up lazyload" alt="">
                                                        <img src="{{ asset('/') }}front/assets/svg/order.svg" class="blur-up lazyload"
                                                             alt="">
                                                        <div class="total-detail">
                                                            <h5>{{translate('Total Pending Order')}}</h5>
                                                            <h3>{{count($pendingOrders)}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-order" role="tabpanel">
                                    <div class="dashboard-order">
                                        <div class="title">
                                            <h2>{{translate('My Orders History')}}</h2>
                                            <span class="title-leaf title-leaf-gray">
                                        </span>
                                        </div>

                                        <div class="order-contain">
                                            @foreach($customer->orders as $order)
                                            <div class="order-box dashboard-bg-box">
                                                <div class="order-container">
                                                    <div class="order-icon">
                                                        <i data-feather="box"></i>
                                                    </div>

                                                    <div class="order-detail">
                                                        <?php
                                                        $bgClass = '';
                                                        switch ($order->order_status) {
                                                            case 'pending':
                                                                $bgClass = 'pending-order-bg';
                                                                break;
                                                            case 'confirmed':
                                                                $bgClass = 'confirmed-order-bg';
                                                                break;
                                                            case 'proccessing':
                                                                $bgClass = 'processing-order-bg';
                                                                break;
                                                            case 'shipped':
                                                                $bgClass = 'shipped-order-bg';
                                                                break;
                                                            case 'delivered':
                                                                $bgClass = 'success-order-bg';
                                                                break;
                                                            case 'returned':
                                                                $bgClass = 'returned-order-bg';
                                                                break;
                                                            case 'cancel':
                                                                $bgClass = 'cancel-order-bg';
                                                                break;
                                                        }
                                                        ?>
                                                        <h4>{{ ucfirst($order->order_code) }} <span class="{{ $bgClass }}">{{ ucfirst($order->order_status) }}</span></h4>
                                                    </div>
                                                </div>

                                                <div class="product-order-detail">
                                                    <div class="order-wrap">
                                                        <ul class="product-size">
                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Order Code : </h6>
                                                                    <h5>{{$order->order_code}}</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Sub Total : </h6>
                                                                    <h5>&#2547; {{number_format($order->grand_total, 2)}}</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Quantity : </h6>
                                                                    <h5>{{$order->total_qty}}</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Shipping Cost : </h6>
                                                                    <h5>&#2547; {{number_format($order->shipping_cost,2)}}</h5>
                                                                </div>
                                                            </li>
                                                            @if($order->coupon_code != null)
                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Coupon Discount : </h6>
                                                                    <h5>&#2547; {{number_format($order->coupon_discount)}}</h5>
                                                                </div>
                                                            </li>
                                                            @endif
                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Order Total : </h6>
                                                                    <h5>&#2547; {{number_format($order->grand_total+$order->shipping_cost-$order->coupon_discount, 2)}}</h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <a href="javascript:void(0)" class="order-image" onclick="event.preventDefault(); document.getElementById('invoiceDownload').submit();">
                                                        <img src="{{asset('/')}}front/assets/images/9205302.png" alt=""
                                                             class="blur-up lazyload" style="width: 39%; float: inline-end;" title="Invoice Download">
                                                    </a>
                                                    <form action="{{route('invoice.download', ['id' => $order->id])}}" method="POST" id="invoiceDownload">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                                    <div class="dashboard-profile">
                                        <div class="title">
                                            <h2>{{translate('My Profile')}}</h2>
                                            <span class="title-leaf">
                                        </span>
                                        </div>
                                        <div class="profile-about dashboard-bg-box">
                                            <div class="row">
                                                <div class="col-xxl-7">
                                                    <div class="row">
                                                        <div class="col-8 col-md-10 col-xl-10">
                                                            <div class="dashboard-title mb-3">
                                                                <h3>{{translate('Profile Details')}}</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 col-md-2 col-xl-2">
                                                            <button type="button" class="btn btn-sm bg-danger text-white" id="editButton" >{{translate('Edit')}}</button>
                                                        </div>
                                                    </div>

                                                    <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data" id="profileForm">
                                                        @csrf
                                                        <div class="form-group mb-3">
                                                            <label for="name">{{translate('Name')}}</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="name"
                                                                name="name"
                                                                value="{{$customer->name}}"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="email">{{translate('Email')}}</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="email"
                                                                name="email"
                                                                value="{{$customer->email}}"
                                                                @if($customer->email != null)
                                                                readonly
                                                                @endif
                                                            >
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="mobile">{{translate('Phone Number')}}</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="mobile"
                                                                name="mobile"
                                                                value="{{$customer->mobile}}"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="address">{{translate('Address')}}</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="address"
                                                                name="address"
                                                                value="{{$customer->address}}"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group text-end mb-3">
                                                            <!-- Submit Button (hidden by default) -->
                                                            <button type="submit" class="btn btn-primary bg-primary text-white" id="submitButton" style="display: none;">
                                                                {{translate('Update')}}
                                                            </button>
                                                        </div>
                                                    </form>

                                                    <script>
                                                        document.getElementById('editButton').addEventListener('click', function () {
                                                            const editButton = this;
                                                            const submitButton = document.getElementById('submitButton');
                                                            const inputs = document.querySelectorAll('form input:not([id="email"]):not([id="mobile"])'); // Exclude email and mobile
                                                            const form = document.getElementById('profileForm');

                                                            if (editButton.textContent === 'Edit') {
                                                                // Enable editable inputs and change "Edit" to "Discard"
                                                                inputs.forEach(input => input.removeAttribute('readonly'));
                                                                submitButton.style.display = 'inline-block';
                                                                editButton.textContent = 'Discard';
                                                            } else {
                                                                // Reset form, make inputs readonly, and change "Discard" to "Edit"
                                                                form.reset(); // Reset form values to initial values
                                                                inputs.forEach(input => input.setAttribute('readonly', 'readonly'));
                                                                submitButton.style.display = 'none';
                                                                editButton.textContent = 'Edit';
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-about dashboard-bg-box">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="dashboard-title mb-3">
                                                        <h3>{{translate('Change Password')}}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{route('password.update')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row g-2">
                                                    <div class="col-12">
                                                        <div class="payment-method">
                                                            <div
                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                                                       id="password" name="old_password"
                                                                       placeholder="{{translate('Enter Current Password')}}">
                                                                <label for="password">{{translate('Current Password')}}</label>
                                                                @error('old_password')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-4">
                                                        <div
                                                            class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                                   id="new_password" name="password" placeholder="{{translate('Enter New Password')}}">
                                                            <label for="new_password">{{translate('New Password')}}</label>
                                                            @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-4">
                                                        <div
                                                            class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                   id="password_confirmation" name="password_confirmation" placeholder="{{translate('Enter Password Confirmation')}}">
                                                            <label for="password_confirmation">{{translate('Password Confirmation')}}</label>
                                                            @error('password_confirmation')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="button-group mt-0">
                                                        <ul>
                                                            <li>
                                                                <button class="btn btn-animation" type="submit">{{translate('Update')}}</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- User Dashboard Section End -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set the active tab from session or default to dashboard if none
            var activeTab = '{{ session('active_tab', '#pills-dashboard') }}'; // Default to dashboard tab
            $('.nav-link[href="' + activeTab + '"]').addClass('active');
            $('.tab-pane' + activeTab).addClass('show active');

            // Listen for tab click event and save it to session
            $('.nav-link').on('click', function () {
                var tabId = $(this).attr('data-bs-target');
                $.ajax({
                    url: "{{ route('store.active.tab') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        active_tab: tabId
                    },
                    success: function (response) {
                        console.log('Active tab saved to session.');
                    }
                });
            });
        });
    </script>
@endsection
