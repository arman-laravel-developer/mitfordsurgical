<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$generalSettingView->site_name}}">
    <meta name="keywords" content="{{$generalSettingView->site_name}}">
    <meta name="author" content="{{$generalSettingView->site_name}}">
    <link rel="icon" href="{{asset($generalSettingView->favicon)}}" type="image/x-icon">
    <title>@yield('seller.title')</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{asset('/')}}front/assets/css/vendors/bootstrap.css">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}front/assets/css/bulk-style.css">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{asset('/')}}front/assets/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .rotate-icon {
            transition: transform 0.2s ease-in-out;
        }
        .collapsed .rotate-icon {
            transform: rotate(0deg); /* Arrow pointing right */
        }
        .nav-link:not(.collapsed) .rotate-icon {
            transform: rotate(90deg); /* Arrow pointing down */
        }
        .user-dashboard-section .dashboard-left-sidebar .user-nav-pills .nav-item .nav-link {
            padding: 2%!important;
        }
        .libottom {
            padding: 0 !important;
            font-size: 16px !important;
            margin-left: 2% !important;
            margin-bottom: -5%;
        }
    </style>
    <style>
        .dashboard-right-sidebar {
            margin-top: 18%; /* Default margin for larger screens */
            padding: 0!important;
            padding-top: calc(20px + 20*(100vw - 320px)/1600)!important;
        }
        /* For mobile and smaller screens */
        @media (min-width: 768px) {
            .dashboard-left-sidebar {
                position: static !important;
                top: 0!important;
                overflow: visible!important;
            }
            .cover-image {
                width: 1130px!important;
                overflow: visible!important;
            }
            .cover-image img {
                height: 200px!important;
                object-fit: fill!important;
            }
        }
        /* For mobile and smaller screens */
        @media (max-width: 768px) {
            .dashboard-right-sidebar {
                margin-top: 10%; /* Adjust the margin-top for smaller screens */
            }
        }

        /* Optional: You can add more breakpoints if needed */
        @media (max-width: 480px) {
            .dashboard-right-sidebar {
                margin-top: 5%; /* Further adjust for very small screens like phones */
            }
        }
    </style>

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{asset('/')}}admin/assets/vendor/daterangepicker/daterangepicker.css">

    <!-- Vector Map css -->
    <link rel="stylesheet" href="{{asset('/')}}admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

    <!-- Theme Config Js -->
    <script src="{{asset('/')}}admin/assets/js/hyper-config.js"></script>
    <!-- Datatables css -->
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{asset('/')}}admin/assets/js/hyper-config.js"></script>
    <!-- App css -->
    <link href="{{asset('/')}}admin/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <!-- SimpleMDE css -->
    <link href="{{asset('/')}}admin/assets/vendor/simplemde/simplemde.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons css -->
    <link href="{{asset('/')}}admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Select2 css -->
    <link href="{{asset('/')}}admin/assets/vendor/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


    <!-- Bootstrap-Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">


    <!-- Bootstrap-Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

</head>

<body>

@php
    $seller = \App\Models\Seller::find(Session::get('seller_id'));
@endphp

<!-- User Dashboard Section Start -->
<section class="user-dashboard-section" style="padding-top: calc(3px + 20*(100vw - 320px)/1600)">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-2 col-lg-3">
                <div class="dashboard-left-sidebar">
                    <div class="profile-box">
                        <div class="cover-image">
                            @if(!empty($seller->shop->banner))
                            <img src="{{$seller->shop->banner}}" class="img-fluid blur-up lazyload"
                                 alt="">
                            @else
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/006/989/259/small/beautiful-sunrise-on-doi-kart-phee-the-remote-highland-mountains-area-in-chiang-rai-province-of-thailand-free-photo.jpg" class="img-fluid blur-up lazyload"
                                 alt="">
                            @endif
                        </div>

                        <div class="profile-contain">
                            <div class="profile-image">
                                <div class="position-relative">
                                    @if(!empty($seller->shop->logo))
                                    <img src="{{asset($seller->shop->logo)}}"
                                         class="blur-up lazyload update_img" alt="">
                                    @else
                                    <img src="https://oldweb.brur.ac.bd/wp-content/uploads/2019/03/male.jpg"
                                         class="blur-up lazyload update_img" alt="">
                                    @endif
                                </div>
                            </div>

                            <div class="profile-name">
                                <h3>{{$seller->name}}</h3>
                                <h6 class="text-content">{{$seller->email}}</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 text-start">
                                    <a href="" class="btn btn-danger">Visit Shop</a>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('home')}}" target="_blank" class="btn btn-success">Visit Website</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-pills user-nav-pills">
                        <li class="nav-item">
                            <a href="{{route('seller.dashboard')}}" class="nav-link @if(Route::is('seller.dashboard')) active @endif">
                                <i data-feather="home"></i> Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link @if(Route::is(['seller.product-add', 'seller.product-manage'])) active @endif d-flex justify-content-between align-items-center @if(Route::is(['seller.product-add', 'seller.product-manage']))  @else collapsed @endif"
                                    data-bs-toggle="collapse" data-bs-target="#product-submenu" aria-expanded="@if(Route::is(['seller.product-add', 'seller.product-manage'])) true @else false @endif"
                                    aria-controls="product-submenu" type="button" role="tab">
                                <span><i data-feather="shopping-bag"></i>Products</span>
                                <i class="fa fa-chevron-right rotate-icon"></i>
                            </button>
                            <div class="collapse @if(Route::is(['seller.product-add','seller.product-manage'])) show @endif" id="product-submenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="libottom">
                                        <a href="{{route('seller.product-add')}}" class="nav-link @if(Route::is('seller.product-add')) active @endif libottom">Add New Products</a>
                                    </li>
                                    <li class="libottom">
                                        <a href="{{route('seller.product-manage')}}" class="nav-link @if(Route::is('seller.product-manage')) active @endif libottom">Manage Products</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link d-flex justify-content-between align-items-center collapsed" id="pills-order-tab"
                                    data-bs-toggle="collapse" data-bs-target="#order-submenu" aria-expanded="false"
                                    aria-controls="order-submenu" type="button" role="tab">
                                <span><i data-feather="shopping-bag"></i>Sales</span>
                                <i class="fa fa-chevron-right rotate-icon"></i>
                            </button>
                            <div class="collapse" id="order-submenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="libottom"><a href="#order1" class="nav-link libottom">Pending Orders</a></li>
                                    <li class="libottom"><a href="#order2" class="nav-link libottom">All Orders</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link d-flex justify-content-between align-items-center collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#report-submenu" aria-expanded="false"
                                    aria-controls="report-submenu">
                                <span><i data-feather="calendar"></i>Reports</span>
                                <i class="fa fa-chevron-right rotate-icon"></i>
                            </button>
                            <div class="collapse" id="report-submenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="libottom"><a href="#order1" class="nav-link libottom">Order 1</a></li>
                                    <li class="libottom"><a href="#order2" class="nav-link libottom">Order 2</a></li>
                                </ul>
                            </div>
                        </li>

                        {{--                        <li class="nav-item" role="presentation">--}}
                        {{--                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"--}}
                        {{--                                    data-bs-target="#pills-profile" type="button" role="tab">--}}
                        {{--                                <i data-feather="user"></i> Profile--}}
                        {{--                            </button>--}}
                        {{--                        </li>--}}

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i data-feather="user"></i> Chat
                            </a>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" type="button">
                                <i data-feather="settings"></i> Manage Shop
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" type="button" onclick="document.getElementById('logoutFormSeller').submit();">
                                <i data-feather="log-out"></i> Log Out
                            </button>
                        </li>
                        <form action="{{route('seller.logout')}}" method="POST" id="logoutFormSeller">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>

            <div class="col-xxl-10 col-lg-9">
                <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                    Menu</button>
                <div class="dashboard-right-sidebar">
                    @yield('seller.body')
                </div>
            </div>
        </div>
    </div>
</section>
<!-- User Dashboard Section End -->


<!-- latest jquery-->
<script src="{{asset('/')}}front/assets/js/jquery-3.6.0.min.js"></script>

<!-- jquery ui-->
<script src="{{asset('/')}}front/assets/js/jquery-ui.min.js"></script>

<!-- Bootstrap js-->
<script src="{{asset('/')}}front/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}front/assets/js/bootstrap/bootstrap-notify.min.js"></script>
<script src="{{asset('/')}}front/assets/js/bootstrap/popper.min.js"></script>

<!-- feather icon js-->
<script src="{{asset('/')}}front/assets/js/feather/feather.min.js"></script>
<script src="{{asset('/')}}front/assets/js/feather/feather-icon.js"></script>
<script>
    // Initialize Feather icons
    feather.replace();
</script>
<!-- Lazyload Js -->
<script src="{{asset('/')}}front/assets/js/lazysizes.min.js"></script>

<!-- Slick js-->
<script src="{{asset('/')}}front/assets/js/slick/slick.js"></script>
<script src="{{asset('/')}}front/assets/js/slick/custom_slick.js"></script>

<!-- Apexcharts Js -->
<script src="{{asset('/')}}front/assets/js/apexchart.js"></script>
<script src="{{asset('/')}}front/assets/js/custom-chart.js"></script>


<!-- script js -->
<script src="{{asset('/')}}front/assets/js/script.js"></script>

<!-- theme setting js -->
<script src="{{asset('/')}}front/assets/js/theme-setting.js"></script>

<!--from admin -->


<!-- Daterangepicker js -->
<script src="{{asset('/')}}admin/assets/vendor/daterangepicker/moment.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/daterangepicker/daterangepicker.js"></script>

<!-- Datatables js -->
<script src="{{asset('/')}}admin/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{asset('/')}}admin/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Datatable Demo Aapp js -->
<script src="{{asset('/')}}admin/assets/js/pages/demo.datatable-init.js"></script>



<!-- SimpleMDE js -->
<script src="{{asset('/')}}admin/assets/vendor/simplemde/simplemde.min.js"></script>
<!-- Page init js -->
<script src="{{asset('/')}}admin/assets/js/pages/demo.inbox.js"></script>


<script src="{{asset('/')}}admin/assets/vendor/daterangepicker/moment.min.js"></script>

<!-- Include Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



<script>
    // Toastr configuration options
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    // Display toastr based on session messages
    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @elseif(session('error'))
    toastr.error("{{ session('error') }}");
    @elseif(session('info'))
    toastr.info("{{ session('info') }}");
    @elseif(session('warning'))
    toastr.warning("{{ session('warning') }}");
    @endif
</script>

</body>
</html>


