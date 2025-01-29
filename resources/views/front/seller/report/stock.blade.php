@extends('front.seller.master.master')

@section('seller.title')
    Stock Report Analysis | {{$generalSettingView->site_name}}
@endsection

@section('seller.body')
    <div class="title">
        <h2>Stock Report Analysis</h2>
        <span class="title-leaf title-leaf-gray"></span>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{route('seller.report.category-wise-stock')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <select name="category_id" id="" class="form-control @error('category_id') is-invalid @enderror" onchange="this.form.submit()" required>
                                        @php echo $categories_dropdown @endphp
                                    </select>
                                    @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info">Filter</button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Export
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('seller.export.products',['type' => 'pdf']) }}">
                                                    Export as PDF
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('seller.export.products', ['type' => 'excel']) }}">
                                                    Export as Excel
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-bordered table-hover mt-3">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Num Of Sale</th>
                            <th>Total Stock</th>
                            <th>Unit Price</th>
                            <th>Total Stock Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->num_of_sale}}</td>
                                <td>{{$product->stock}}</td>
                                <td>&#2547; {{number_format($product->sell_price)}}</td>
                                <td>&#2547; {{number_format($product->stock * $product->sell_price)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
