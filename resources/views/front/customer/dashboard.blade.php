@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('My Account')}}
@endsection

@section('body')
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
                                    <button class="nav-link {{ session('active_tab') == '#pills-wishlist' ? 'active' : '' }}" id="pills-wishlist-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-wishlist" type="button"><i data-feather="heart"></i>
                                        {{translate('Wishlist')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('active_tab') == '#pills-profile' ? 'active' : '' }}" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"><i data-feather="user"></i>
                                        {{translate('Profile')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ session('active_tab') == '#pills-download' ? 'active' : '' }}" id="pills-download-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-download" type="button" role="tab"><i
                                            data-feather="download"></i>{{translate('Download')}}</button>
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
                                                            <h3>3658</h3>
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
                                                            <h3>254</h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                    <div class="total-contain">
                                                        <img src="{{ asset('/') }}front/assets/svg/wishlist.svg"
                                                             class="img-1 blur-up lazyload" alt="">
                                                        <img src="{{ asset('/') }}front/assets/svg/wishlist.svg"
                                                             class="blur-up lazyload" alt="">
                                                        <div class="total-detail">
                                                            <h5>{{translate('Total Wishlist')}}</h5>
                                                            <h3>32158</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-wishlist" role="tabpanel">
                                    <div class="dashboard-wishlist">
                                        <div class="title">
                                            <h2>{{translate('My Wishlist History')}}</h2>
                                            <span class="title-leaf title-leaf-gray">
                                        </span>
                                        </div>
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                                <div class="product-box-3 theme-bg-white h-100">
                                                    <div class="product-header">
                                                        <div class="product-image">
                                                            <a href="product-left-thumbnail.html">
                                                                <img src="{{asset('/')}}front/assets/images/cake/product/2.png"
                                                                     class="img-fluid blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="product-header-top">
                                                                <button class="btn wishlist-button close_button">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-footer">
                                                        <div class="product-detail">
                                                            <span class="span-name">Vegetable</span>
                                                            <a href="product-left-thumbnail.html">
                                                                <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                                            </a>
                                                            <p class="text-content mt-1 mb-2 product-content">Cheesy feet
                                                                cheesy grin brie. Mascarpone cheese and wine hard cheese the
                                                                big cheese everyone loves smelly cheese macaroni cheese
                                                                croque monsieur.</p>
                                                            <h6 class="unit mt-1">250 ml</h6>
                                                            <h5 class="price">
                                                                <span class="theme-color">$08.02</span>
                                                                <del>$15.15</del>
                                                            </h5>
                                                            <div class="add-to-cart-box mt-2">
                                                                <button class="btn btn-add-cart addcart-button"
                                                                        tabindex="0">Add
                                                                    <span class="add-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </span>
                                                                </button>
                                                                <div class="cart_qty qty-box">
                                                                    <div class="input-group">
                                                                        <button type="button" class="qty-left-minus"
                                                                                data-type="minus" data-field="">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                        <input class="form-control input-number qty-input"
                                                                               type="text" name="quantity" value="0">
                                                                        <button type="button" class="qty-right-plus"
                                                                                data-type="plus" data-field="">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                                <div class="product-box-3 theme-bg-white h-100">
                                                    <div class="product-header">
                                                        <div class="product-image">
                                                            <a href="product-left-thumbnail.html">
                                                                <img src="{{asset('/')}}front/assets/images/cake/product/3.png"
                                                                     class="img-fluid blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="product-header-top">
                                                                <button class="btn wishlist-button close_button">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-footer">
                                                        <div class="product-detail">
                                                            <span class="span-name">Vegetable</span>
                                                            <a href="product-left-thumbnail.html">
                                                                <h5 class="name">Peanut Butter Bite Premium Butter Cookies
                                                                    600 g</h5>
                                                            </a>
                                                            <p class="text-content mt-1 mb-2 product-content">Feta taleggio
                                                                croque monsieur swiss manchego cheesecake dolcelatte
                                                                jarlsberg. Hard cheese danish fontina boursin melted cheese
                                                                fondue.</p>
                                                            <h6 class="unit mt-1">350 G</h6>
                                                            <h5 class="price">
                                                                <span class="theme-color">$04.33</span>
                                                                <del>$10.36</del>
                                                            </h5>
                                                            <div class="add-to-cart-box mt-2">
                                                                <button class="btn btn-add-cart addcart-button"
                                                                        tabindex="0">Add
                                                                    <span class="add-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </span>
                                                                </button>
                                                                <div class="cart_qty qty-box">
                                                                    <div class="input-group">
                                                                        <button type="button" class="qty-left-minus"
                                                                                data-type="minus" data-field="">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                        <input class="form-control input-number qty-input"
                                                                               type="text" name="quantity" value="0">
                                                                        <button type="button" class="qty-right-plus"
                                                                                data-type="plus" data-field="">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                                <div class="product-box-3 theme-bg-white h-100">
                                                    <div class="product-header">
                                                        <div class="product-image">
                                                            <a href="product-left-thumbnail.html">
                                                                <img src="{{asset('/')}}front/assets/images/cake/product/4.png"
                                                                     class="img-fluid blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="product-header-top">
                                                                <button class="btn wishlist-button close_button">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-footer">
                                                        <div class="product-detail">
                                                            <span class="span-name">Snacks</span>
                                                            <a href="product-left-thumbnail.html">
                                                                <h5 class="name">SnackAmor Combo Pack of Jowar Stick and
                                                                    Jowar Chips</h5>
                                                            </a>
                                                            <p class="text-content mt-1 mb-2 product-content">Lancashire
                                                                hard cheese parmesan. Danish fontina mozzarella cream cheese
                                                                smelly cheese cheese and wine cheesecake dolcelatte stilton.
                                                                Cream cheese parmesan who moved my cheese when the cheese
                                                                comes out everybody's happy cream cheese red leicester
                                                                ricotta edam.</p>
                                                            <h6 class="unit mt-1">570 G</h6>
                                                            <h5 class="price">
                                                                <span class="theme-color">$12.52</span>
                                                                <del>$13.62</del>
                                                            </h5>
                                                            <div class="add-to-cart-box mt-2">
                                                                <button class="btn btn-add-cart addcart-button"
                                                                        tabindex="0">Add
                                                                    <span class="add-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </span>
                                                                </button>
                                                                <div class="cart_qty qty-box">
                                                                    <div class="input-group">
                                                                        <button type="button" class="qty-left-minus"
                                                                                data-type="minus" data-field="">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                        <input class="form-control input-number qty-input"
                                                                               type="text" name="quantity" value="0">
                                                                        <button type="button" class="qty-right-plus"
                                                                                data-type="plus" data-field="">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                                <div class="product-box-3 theme-bg-white h-100">
                                                    <div class="product-header">
                                                        <div class="product-image">
                                                            <a href="product-left-thumbnail.html">
                                                                <img src="{{asset('/')}}front/assets/images/cake/product/5.png"
                                                                     class="img-fluid blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="product-header-top">
                                                                <button class="btn wishlist-button close_button">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-footer">
                                                        <div class="product-detail">
                                                            <span class="span-name">Snacks</span>
                                                            <a href="product-left-thumbnail.html">
                                                                <h5 class="name">Yumitos Chilli Sprinkled Potato Chips 100 g
                                                                </h5>
                                                            </a>
                                                            <p class="text-content mt-1 mb-2 product-content">Cheddar
                                                                cheddar pecorino hard cheese hard cheese cheese and biscuits
                                                                bocconcini babybel. Cow goat paneer cream cheese fromage
                                                                cottage cheese cauliflower cheese jarlsberg.</p>
                                                            <h6 class="unit mt-1">100 G</h6>
                                                            <h5 class="price">
                                                                <span class="theme-color">$10.25</span>
                                                                <del>$12.36</del>
                                                            </h5>
                                                            <div class="add-to-cart-box mt-2">
                                                                <button class="btn btn-add-cart addcart-button"
                                                                        tabindex="0">Add
                                                                    <span class="add-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </span>
                                                                </button>
                                                                <div class="cart_qty qty-box">
                                                                    <div class="input-group">
                                                                        <button type="button" class="qty-left-minus"
                                                                                data-type="minus" data-field="">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                        <input class="form-control input-number qty-input"
                                                                               type="text" name="quantity" value="0">
                                                                        <button type="button" class="qty-right-plus"
                                                                                data-type="plus" data-field="">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                                <div class="product-box-3 theme-bg-white h-100">
                                                    <div class="product-header">
                                                        <div class="product-image">
                                                            <a href="product-left-thumbnail.html">
                                                                <img src="{{asset('/')}}front/assets/images/cake/product/6.png"
                                                                     class="img-fluid blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="product-header-top">
                                                                <button class="btn wishlist-button close_button">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-footer">
                                                        <div class="product-detail">
                                                            <span class="span-name">Vegetable</span>
                                                            <a href="product-left-thumbnail.html">
                                                                <h5 class="name">Fantasy Crunchy Choco Chip Cookies</h5>
                                                            </a>
                                                            <p class="text-content mt-1 mb-2 product-content">Bavarian
                                                                bergkase smelly cheese swiss cut the cheese lancashire who
                                                                moved my cheese manchego melted cheese. Red leicester paneer
                                                                cow when the cheese comes out everybody's happy croque
                                                                monsieur goat melted cheese port-salut.</p>
                                                            <h6 class="unit mt-1">550 G</h6>
                                                            <h5 class="price">
                                                                <span class="theme-color">$14.25</span>
                                                                <del>$16.57</del>
                                                            </h5>
                                                            <div class="add-to-cart-box mt-2">
                                                                <button class="btn btn-add-cart addcart-button"
                                                                        tabindex="0">Add
                                                                    <span class="add-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </span>
                                                                </button>
                                                                <div class="cart_qty qty-box">
                                                                    <div class="input-group">
                                                                        <button type="button" class="qty-left-minus"
                                                                                data-type="minus" data-field="">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                        <input class="form-control input-number qty-input"
                                                                               type="text" name="quantity" value="0">
                                                                        <button type="button" class="qty-right-plus"
                                                                                data-type="plus" data-field="">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                                <div class="product-box-3 theme-bg-white h-100">
                                                    <div class="product-header">
                                                        <div class="product-image">
                                                            <a href="product-left-thumbnail.html">
                                                                <img src="{{asset('/')}}front/assets/images/cake/product/7.png"
                                                                     class="img-fluid blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="product-header-top">
                                                                <button class="btn wishlist-button close_button">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-footer">
                                                        <div class="product-detail">
                                                            <span class="span-name">Vegetable</span>
                                                            <a href="product-left-thumbnail.html">
                                                                <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                                            </a>
                                                            <p class="text-content mt-1 mb-2 product-content">Melted cheese
                                                                babybel chalk and cheese. Port-salut port-salut cream cheese
                                                                when the cheese comes out everybody's happy cream cheese
                                                                hard cheese cream cheese red leicester.</p>
                                                            <h6 class="unit mt-1">1 Kg</h6>
                                                            <h5 class="price">
                                                                <span class="theme-color">$12.68</span>
                                                                <del>$14.69</del>
                                                            </h5>
                                                            <div class="add-to-cart-box mt-2">
                                                                <button class="btn btn-add-cart addcart-button"
                                                                        tabindex="0">Add
                                                                    <span class="add-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </span>
                                                                </button>
                                                                <div class="cart_qty qty-box">
                                                                    <div class="input-group">
                                                                        <button type="button" class="qty-left-minus"
                                                                                data-type="minus" data-field="">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                        <input class="form-control input-number qty-input"
                                                                               type="text" name="quantity" value="0">
                                                                        <button type="button" class="qty-right-plus"
                                                                                data-type="plus" data-field="">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-6 col-md-4 col-sm-6">
                                                <div class="product-box-3 theme-bg-white h-100">
                                                    <div class="product-header">
                                                        <div class="product-image">
                                                            <a href="product-left-thumbnail.html">
                                                                <img src="{{asset('/')}}front/assets/images/cake/product/2.png"
                                                                     class="img-fluid blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="product-header-top">
                                                                <button class="btn wishlist-button close_button">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-footer">
                                                        <div class="product-detail">
                                                            <span class="span-name">Vegetable</span>
                                                            <a href="product-left-thumbnail.html">
                                                                <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                                            </a>
                                                            <p class="text-content mt-1 mb-2 product-content">Squirty cheese
                                                                cottage cheese cheese strings. Red leicester paneer danish
                                                                fontina queso lancashire when the cheese comes out
                                                                everybody's happy cottage cheese paneer.</p>
                                                            <h6 class="unit mt-1">250 ml</h6>
                                                            <h5 class="price">
                                                                <span class="theme-color">$08.02</span>
                                                                <del>$15.15</del>
                                                            </h5>
                                                            <div class="add-to-cart-box mt-2">
                                                                <button class="btn btn-add-cart addcart-button"
                                                                        tabindex="0">Add
                                                                    <span class="add-icon">
                                                                    <i class="fa-solid fa-plus"></i>
                                                                </span>
                                                                </button>
                                                                <div class="cart_qty qty-box">
                                                                    <div class="input-group">
                                                                        <button type="button" class="qty-left-minus"
                                                                                data-type="minus" data-field="">
                                                                            <i class="fa fa-minus"></i>
                                                                        </button>
                                                                        <input class="form-control input-number qty-input"
                                                                               type="text" name="quantity" value="0">
                                                                        <button type="button" class="qty-right-plus"
                                                                                data-type="plus" data-field="">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                            <div class="order-box dashboard-bg-box">
                                                <div class="order-container">
                                                    <div class="order-icon">
                                                        <i data-feather="box"></i>
                                                    </div>

                                                    <div class="order-detail">
                                                        <h4>Delivers <span>Pending</span></h4>
                                                        <h6 class="text-content">Gouda parmesan caerphilly mozzarella
                                                            cottage cheese cauliflower cheese taleggio gouda.</h6>
                                                    </div>
                                                </div>

                                                <div class="product-order-detail">
                                                    <a href="product-left-thumbnail.html" class="order-image">
                                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/1.png"
                                                             class="blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="order-wrap">
                                                        <a href="product-left-thumbnail.html">
                                                            <h3>Fantasy Crunchy Choco Chip Cookies</h3>
                                                        </a>
                                                        <p class="text-content">Cheddar dolcelatte gouda. Macaroni cheese
                                                            cheese strings feta halloumi cottage cheese jarlsberg cheese
                                                            triangles say cheese.</p>
                                                        <ul class="product-size">
                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Price : </h6>
                                                                    <h5>$20.68</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Rate : </h6>
                                                                    <div class="product-rating ms-2">
                                                                        <ul class="rating">
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star"></i>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Sold By : </h6>
                                                                    <h5>Fresho</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Quantity : </h6>
                                                                    <h5>250 G</h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="order-box dashboard-bg-box">
                                                <div class="order-container">
                                                    <div class="order-icon">
                                                        <i data-feather="box"></i>
                                                    </div>

                                                    <div class="order-detail">
                                                        <h4>Delivered <span class="success-bg">Success</span></h4>
                                                        <h6 class="text-content">Cheese on toast cheesy grin cheesy grin
                                                            cottage cheese caerphilly everyone loves cottage cheese the big
                                                            cheese.</h6>
                                                    </div>
                                                </div>

                                                <div class="product-order-detail">
                                                    <a href="product-left-thumbnail.html" class="order-image">
                                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/2.png" alt=""
                                                             class="blur-up lazyload">
                                                    </a>

                                                    <div class="order-wrap">
                                                        <a href="product-left-thumbnail.html">
                                                            <h3>Cold Brew Coffee Instant Coffee 50 g</h3>
                                                        </a>
                                                        <p class="text-content">Pecorino paneer port-salut when the cheese
                                                            comes out everybody's happy red leicester mascarpone blue
                                                            castello cauliflower cheese.</p>
                                                        <ul class="product-size">
                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Price : </h6>
                                                                    <h5>$20.68</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Rate : </h6>
                                                                    <div class="product-rating ms-2">
                                                                        <ul class="rating">
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star"></i>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Sold By : </h6>
                                                                    <h5>Fresho</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Quantity : </h6>
                                                                    <h5>250 G</h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="order-box dashboard-bg-box">
                                                <div class="order-container">
                                                    <div class="order-icon">
                                                        <i data-feather="box"></i>
                                                    </div>

                                                    <div class="order-detail">
                                                        <h4>Delivere <span>Pending</span></h4>
                                                        <h6 class="text-content">Cheesy grin boursin cheesy grin cheesecake
                                                            blue castello cream cheese lancashire melted cheese.</h6>
                                                    </div>
                                                </div>

                                                <div class="product-order-detail">
                                                    <a href="product-left-thumbnail.html" class="order-image">
                                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/3.png" alt=""
                                                             class="blur-up lazyload">
                                                    </a>

                                                    <div class="order-wrap">
                                                        <a href="product-left-thumbnail.html">
                                                            <h3>Peanut Butter Bite Premium Butter Cookies 600 g</h3>
                                                        </a>
                                                        <p class="text-content">Cow bavarian bergkase mascarpone paneer
                                                            squirty cheese fromage frais cheese slices when the cheese comes
                                                            out everybody's happy.</p>
                                                        <ul class="product-size">
                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Price : </h6>
                                                                    <h5>$20.68</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Rate : </h6>
                                                                    <div class="product-rating ms-2">
                                                                        <ul class="rating">
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star"></i>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Sold By : </h6>
                                                                    <h5>Fresho</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Quantity : </h6>
                                                                    <h5>250 G</h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="order-box dashboard-bg-box">
                                                <div class="order-container">
                                                    <div class="order-icon">
                                                        <i data-feather="box"></i>
                                                    </div>

                                                    <div class="order-detail">
                                                        <h4>Delivered <span class="success-bg">Success</span></h4>
                                                        <h6 class="text-content">Caerphilly port-salut parmesan pecorino
                                                            croque monsieur dolcelatte melted cheese cheese and wine.</h6>
                                                    </div>
                                                </div>

                                                <div class="product-order-detail">
                                                    <a href="product-left-thumbnail.html" class="order-image">
                                                        <img src="{{asset('/')}}front/assets/images/vegetable/product/4.png"
                                                             class="blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="order-wrap">
                                                        <a href="product-left-thumbnail.html">
                                                            <h3>SnackAmor Combo Pack of Jowar Stick and Jowar Chips</h3>
                                                        </a>
                                                        <p class="text-content">The big cheese cream cheese pepper jack
                                                            cheese slices danish fontina everyone loves cheese on toast
                                                            bavarian bergkase.</p>
                                                        <ul class="product-size">
                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Price : </h6>
                                                                    <h5>$20.68</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Rate : </h6>
                                                                    <div class="product-rating ms-2">
                                                                        <ul class="rating">
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star" class="fill"></i>
                                                                            </li>
                                                                            <li>
                                                                                <i data-feather="star"></i>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Sold By : </h6>
                                                                    <h5>Fresho</h5>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="size-box">
                                                                    <h6 class="text-content">Quantity : </h6>
                                                                    <h5>250 G</h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
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

                                <div class="tab-pane fade" id="pills-download" role="tabpanel">
                                    <div class="dashboard-download">
                                        <div class="title">
                                            <h2>{{translate('My Download')}}</h2>
                                            <span class="title-leaf">
                                        </span>
                                        </div>

                                        <div class="download-detail dashboard-bg-box">

                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-data" role="tabpanel">
                                                    <div class="download-table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/1.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Sheltos - Real Estate Angular 17 Template</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/2.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Oslo - Multipurpose Shopify Theme. Fast, Clean,
                                                                        and
                                                                        Flexible. OS 2.0</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/3.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Boho - React JS Admin Dashboard Template</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-title">
                                                    <div class="download-table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/1.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Sheltos - Real Estate Angular 17 Template</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/2.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Oslo - Multipurpose Shopify Theme. Fast, Clean,
                                                                        and
                                                                        Flexible. OS 2.0</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/3.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Boho - React JS Admin Dashboard Template</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-rating">
                                                    <div class="download-table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/1.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Sheltos - Real Estate Angular 17 Template</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/2.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Oslo - Multipurpose Shopify Theme. Fast, Clean,
                                                                        and
                                                                        Flexible. OS 2.0</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/3.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Boho - React JS Admin Dashboard Template</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-recent">
                                                    <div class="download-table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/1.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Sheltos - Real Estate Angular 17 Template</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/2.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Oslo - Multipurpose Shopify Theme. Fast, Clean,
                                                                        and
                                                                        Flexible. OS 2.0</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>
                                                                        <img src="{{asset('/')}}front/assets/images/theme-icon/3.png"
                                                                             class="img-fluid" alt="">
                                                                    </td>
                                                                    <td>Boho - React JS Admin Dashboard Template</td>
                                                                    <td>
                                                                        <div class="dropdown download-dropdown">
                                                                            <button class="btn dropdown-toggle"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown">Download</button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">All files
                                                                                        & documentation</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (PDF)</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item"
                                                                                       href="#">License
                                                                                        certificate & purchase code
                                                                                        (text)</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
