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
        @php
            $product = \App\Models\Product::find($cartContent->attributes->product_id);
            $variant = \App\Models\Variant::find($cartContent->attributes->variant_id);
            if ($product->is_variant == 1) {
                $max_stock = $variant->qty;
                $min = $variant->product->minimum_purchase_qty;
            } else {
                 $max_stock = $product->stock;
                $min = $product->minimum_purchase_qty;
            }
        @endphp

        <div class="qty-controls"
             data-max-stock="{{ $max_stock }}"
             data-min-qty="{{ $min }}"
             id="controls-item-{{$cartContent->id}}">
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
