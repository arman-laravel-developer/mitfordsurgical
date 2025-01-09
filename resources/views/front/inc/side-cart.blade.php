<style>
    .shopping-summary {
        position: fixed;
        top: 50%; /* Position in the middle vertically */
        right: 0; /* Align to the right edge */
        transform: translateY(-50%); /* Center alignment */
        width: 6%; /* Set width */
        background-color: #f9f9f9; /* Light background */
        border: 1px solid #ccc; /* Optional border */
        border-radius: 8px; /* Rounded corners */
        z-index: 1000; /* Ensure it's on top */
        overflow: hidden; /* Prevent content overflow */
    }

    .shopping-icon {
        background-color: #6c757d; /* Background for the top section */
        width: 100%;
    }

    .shopping-items {
        width: 100%;
        font-family: Arial, sans-serif;
    }

    /* Cart Icon Summary */
    .cart-summary {
        position: fixed;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        background: #f9f9f9;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px 0 0 8px;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    /* Slide-in Cart Container */
    .cart-container {
        position: fixed;
        top: 0;
        right: -400px; /* Hidden initially */
        height: 100%;
        width: 400px;
        background-color: #fff;
        transition: right 0.3s ease-in-out;
        z-index: 1050;
        overflow: hidden; /* Hide overflow initially */
        box-shadow: -2px 0 4px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column; /* Stack header, body, and footer vertically */
    }

    @media(max-width: 991px) {
        /* Slide-in Cart Container */
        .cart-container {
            width: 90%;
        }
    }

    .cart-container.open {
        right: 0; /* Slide-in */
    }

    /* Cart Header */
    .cart-header {
        position: sticky;
        top: 0; /* Stick to the top */
        z-index: 1020; /* Ensure it's above the body */
        background: #f9f9f9;
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Cart Body */
    .cart-body {
        flex: 1; /* Allow body to take available space */
        max-height: calc(100vh - 150px); /* Subtract header and footer height to make the body scrollable */
        overflow-y: auto; /* Enable vertical scrolling */
        padding: 10px;
        box-sizing: border-box;
    }

    /* Cart Footer */
    .cart-footer {
        background: #fff;
        padding: 10px 15px;
        border-top: 1px solid #ddd;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Cart Footer */
    .cart-footer button {
        background: red;
        color: white;
    }

    /* Cart Item */
    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        position: relative;
        width: 100%;
    }

    /* Item Info */
    .item-info {
        display: flex;
        flex-direction: column;
        width: 60%; /* Fixed width for item name and price */
        overflow: hidden; /* Prevent overflowing text */
    }

    /* Item Name */
    .item-info p {
        margin: 0;
        font-weight: bold;
        white-space: normal; /* Allow text to wrap */
        overflow: hidden;
        text-overflow: ellipsis; /* Truncate with ellipsis if needed */
    }

    .item-info span {
        font-size: 0.9em;
        color: #6c757d;
    }

    /* Quantity Controls */
    .qty-controls {
        display: flex;
        align-items: center;
        width: 20%; /* Fixed width for quantity controls */
        justify-content: center;
        margin-right: 14%;
    }

    /* Quantity Buttons */
    .qty-btn {
        background: #f1f1f1;
        border: 1px solid #ccc;
        padding: 5px 10px;
        cursor: pointer;
        margin: 0 5px;
    }

    /* Remove Item Button */
    .remove-item {
        position: absolute;
        right: 0; /* Align to the right edge */
        background: transparent;
        border: none;
        color: red;
        cursor: pointer;
        font-size: 18px;
    }
</style>

<!-- Shopping Bag Section Start -->
<div class="shopping-summary d-none d-md-flex flex-column align-items-center shadow-sm" onclick="openCart()">
    <div class="shopping-icon bg-secondary p-3 rounded-top d-flex justify-content-center">
        <i data-feather="shopping-bag" class="text-warning" style="width: 37%; height: 16%;"></i>
    </div>
    <div class="shopping-items bg-light text-center px-3 py-2">
        <span class="d-block fw-bold text-warning" style="font-size: 85%;"><span id="itemQty">{{count(\Cart::getContent())}}</span> {{translate('ITEMS')}}</span>
        <span class="d-block fw-bold text-secondary" style="font-size: 83%;">৳ <span id="ItemValue">{{number_format(\Cart::getTotal())}}</span></span>
    </div>
</div>
<!-- Shopping Bag Section End -->

<!-- Hidden Slide-in Cart -->
<div id="cart-container" class="cart-container shadow">
    <div class="cart-header d-flex justify-content-between align-items-center p-3 bg-light">
        <h5 class="fw-bold mb-0"><span id="itemQtyIncart">{{count(\Cart::getContent())}}</span> {{translate('ITEMS')}}</h5>
        <button class="btn btn-close" onclick="closeCart()">{{translate('Close')}}</button>
    </div>

    <div class="cart-body p-3">
        <!-- Cart Item -->
        @foreach($cartContents as $cartContent)
            @php
                $variant = \App\Models\Variant::find($cartContent->attributes->variant_id);
            @endphp
            <div class="cart-item" id="item-{{$cartContent->id}}">
                <div class="item-info">
                    <p>{{$cartContent->name}} @if($variant)({{$variant->variant}})@endif</p>
                    <span class="text-muted">৳ {{$cartContent->price}}</span>
                </div>
                <div class="qty-controls">
                    <button class="qty-btn" onclick="changeQty('item-{{$cartContent->id}}', -1)">-</button>
                    <span id="qty-item-{{$cartContent->id}}" class="fw-bold">{{$cartContent->quantity}}</span>
                    <button class="qty-btn" onclick="changeQty('item-{{$cartContent->id}}', 1)">+</button>
                </div>
                <button class="remove-item" onclick="removeItem('{{$cartContent->id}}')">&times;</button>
                <form id="removeItemForm-{{$cartContent->id}}" method="POST" action="{{ route('cart.remove') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="itemId" value="{{$cartContent->id}}">
                </form>

            </div>
        @endforeach
    </div>

    <div class="cart-footer p-3 border-top">
        <a href="{{route('checkout')}}" class="btn bg-danger text-white w-100 fw-bold">{{translate('Place Order')}}&nbsp;<span>৳ <span class="itemValueIncart" id="itemValueIncart">{{number_format(\Cart::getTotal())}}</span></span></a>
    </div>
</div>
