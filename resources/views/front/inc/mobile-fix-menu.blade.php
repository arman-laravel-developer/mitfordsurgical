<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class=" @if(Route::is('home')) active @endif">
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
        <li class=" @if(Route::is('search.result')) active @endif">
            <a href="{{route('search.result')}}" class="notifi-wishlist">
                <i data-feather="search" style="color: white"></i>
                <span>{{translate('Search')}}</span>
            </a>
        </li>

        <li class=" @if(Route::is('products.all')) active @endif">
            <a href="{{route('products.all')}}" class="search-box">
                <i data-feather="shopping-bag" style="color: white"></i>
                <span>{{translate('Products')}}</span>
            </a>
        </li>

        <li style="position: relative;" class="mobile-cart">
            <a href="javascript:void(0)" onclick="openCart()" style="position: relative;">
                <i data-feather="shopping-cart" style="color: white;"></i>
                <span>{{translate('Cart')}}</span>
                <!-- Badge -->
                <span class="badge rounded-pill bg-danger position-absolute top-0 translate-middle cart-mobile" style="left: 90%!important;">
                    {{count(\Cart::getContent())}}
                </span>
            </a>
        </li>
    </ul>
</div>
