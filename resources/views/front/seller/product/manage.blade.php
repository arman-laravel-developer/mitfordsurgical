@extends('front.seller.master.master')

@section('seller.title')
    Seller Product Manage | {{$generalSettingView->site_name}}
@endsection

@section('seller.body')
    <div class="product-tab mt-2">
        <div class="title">
            <h2>Manage Product</h2>
            <span class="title-leaf"></span>
        </div>

        <div class="table-responsive dashboard-bg-box">
            <table class="table product-table">
                <thead>
                <tr>
                    <th scope="col">Images</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Sales</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit / Delete</th>
                </tr>
                </thead>
                <tbody>
                @if(count($products) > 0)
                @foreach($products as $product)
                    <tr>
                        <td class="product-image">
                            <img src="{{ asset($product->thumbnail_img) }}"
                                 class="img-fluid" alt="">
                        </td>
                        <td>
                            <h6>{{$product->name}}</h6>
                        </td>
                        <td>
                            <h6 class="theme-color fw-bold">&#2547; {{number_format($product->sell_price)}}</h6>
                        </td>
                        <td>
                            <h6>{{$product->stock}}</h6>
                        </td>
                        <td>
                            <h6>{{$product->num_of_sale}}</h6>
                        </td>
                        <td>
                    <span class="badge {{$product->status == 1 ? 'text-bg-success' : 'text-bg-danger'}}">
                        {{$product->status == 1 ? 'Published' : 'Un Published'}}
                    </span>
                        </td>
                        <td class="edit-delete">
                            <a href="{{route('seller-product.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')])}}"><i data-feather="edit" class="edit"></i></a>
                            <a href="javascript:void(0)" onclick="confirmDelete({{$product->id}});"><i data-feather="trash-2" class="delete"></i></a>
                            <form action="{{route('seller-product.delete', ['id' => $product->id])}}" method="POST" id="productDeleteForm{{$product->id}}">
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="6" class="opacity-75 text-center text-secondary" style="margin-top: 5%">No products found!</td>
                    </tr>
                @endif
                </tbody>
            </table>

            {{ $products->links('vendor.pagination.seller-pagination') }}
        </div>
    </div>

    <script>
        function confirmDelete(productId) {
            var confirmDelete = confirm('Are you sure you want to delete this?');
            if (confirmDelete) {
                document.getElementById('productDeleteForm' + productId).submit();
            } else {
                return false;
            }
        }
    </script>
@endsection
