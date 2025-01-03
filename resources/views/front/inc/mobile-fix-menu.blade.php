<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class="active">
            <a href="{{route('home')}}">
                <i data-feather="home" style="color: white"></i>
                <span>{{translate('Home')}}</span>
            </a>
        </li>


        <li class="mobile-category">
            <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                <span class=" navbar-toggler-icon-2">
                <i data-feather="list" style="color: white"></i>
                <span>{{translate('Category')}}</span>
            </span>
            </a>
        </li>

        <li>
            <a href="search.html" class="search-box">
                <i data-feather="search" style="color: white"></i>
                <span>{{translate('Search')}}</span>
            </a>
        </li>

        <li>
            <a href="wishlist.html" class="notifi-wishlist">
                <i data-feather="heart" style="color: white"></i>
                <span>{{translate('My Wish')}}</span>
            </a>
        </li>

        <li style="position: relative;" class="mobile-cart">
            <a href="javascript:void(0)" onclick="openCart()" style="position: relative;">
                <i data-feather="shopping-cart" style="color: white;"></i>
                <span>{{translate('Cart')}}</span>
                <!-- Badge -->
                <span class="badge rounded-pill bg-danger position-absolute top-0 translate-middle" style="left: 90%!important;">
            5
        </span>
            </a>
        </li>
    </ul>
</div>
