@extends('admin.master')
@section('title')
    Add New Coupon | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                                    <i class="mdi mdi-calendar-range font-13"></i>
                                                </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Add New Coupon</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="basic-form-preview">
                            <form action="{{route('coupon.new')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-md-3 col-form-label">Coupon Type</label>
                                    <div class="col-md-9">
                                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                            <option selected disabled>Select One</option>
                                            <option value="product_base">For products</option>
                                            <option value="cart_base">For total orders</option>
                                        </select>
                                        @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="product_base" style="display: none">
                                    <div class="card-header mb-3" style="padding: 0!important;">
                                        <h3 id="typeText">Add Your Product Base Coupon</h3>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="code" class="col-md-3 col-form-label">Coupon Code</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="p_code" id="code" placeholder="Coupon Code"/>
                                            @error('code')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="product_ids" class="col-md-3 col-form-label">Products</label>
                                        <div class="col-md-9">
                                            <select name="product_ids[]" id="product_ids" data-selected-text-format="count" data-live-search="true" class="selectpicker form-control @error('product_ids') is-invalid @enderror select-enabled" required multiple>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('product_ids')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label">Discount ranage date</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control date" name="p_discount_date_range" id="singledaterange" data-toggle="date-picker" data-cancel-class="btn-warning" required>
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label">Discount</label>
                                        <div class="col-md-7">
                                            <input type="number" name="p_discount" value="0" class="form-control @error('discount') is-invalid @enderror" placeholder="Discount"/>
                                            @error('discount')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <select name="p_discount_type" id="" class="form-control">
                                                <option value="1">Flat</option>
                                                <option value="2">Percent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-md-3 col-form-label">Status</label>
                                        <div class="col-md-9">
                                            <input type="checkbox" id="switch1" value="1" class="form-control" name="p_status" data-switch="bool"/>
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="cart_base" style="display: none">
                                    <div class="card-header mb-3" style="padding: 0!important;">
                                        <h3 id="typeText">Add Your Cart Base Coupon</h3>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="code" class="col-md-3 col-form-label">Coupon Code</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="c_code" id="code" placeholder="Coupon Code"/>
                                            @error('code')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="minimum_buy" class="col-md-3 col-form-label">Minimum Order Total</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('minimum_buy') is-invalid @enderror" name="minimum_buy" id="minimum_buy" placeholder="Minimum order total" oninput="validateInput(this)"/>
                                            @error('minimum_buy')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="maximum_discount" class="col-md-3 col-form-label">Maximum Discount Amount</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('maximum_discount') is-invalid @enderror" name="maximum_discount" id="maximum_discount" placeholder="Maximum discount amount" oninput="validateInput(this)"/>
                                            @error('maximum_discount')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label">Discount ranage date</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control date" name="c_discount_date_range" id="singledaterange" data-toggle="date-picker" data-cancel-class="btn-warning" required>
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-3 col-form-label">Discount</label>
                                        <div class="col-md-7">
                                            <input type="number" name="c_discount" value="0" class="form-control @error('discount') is-invalid @enderror" placeholder="Discount"/>
                                            @error('discount')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <select name="c_discount_type" id="" class="form-control">
                                                <option value="1">Flat</option>
                                                <option value="2">Percent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-md-3 col-form-label">Status</label>
                                        <div class="col-md-9">
                                            <input type="checkbox" id="switch2" value="1" class="form-control" name="c_status" data-switch="bool"/>
                                            <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 float-end">
                                    <label for="inputEmail3" class="col-md-2 col-form-label"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 300
        });
    </script>
    <!-- end row -->

    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker({
                noneSelectedText: 'Select Products'
            });
        });
    </script>

    <script>
        document.getElementById('type').addEventListener('change', function () {
            var selectedValue = this.value;

            // Reset all required attributes before changing
            resetRequiredFields();

            if (selectedValue === 'product_base') {
                document.getElementById('product_base').style.display = 'block';
                document.getElementById('cart_base').style.display = 'none';

                // Set required attributes for product_base
                setRequiredForProductBase();
            } else if (selectedValue === 'cart_base') {
                document.getElementById('cart_base').style.display = 'block';
                document.getElementById('product_base').style.display = 'none';

                // Set required attributes for cart_base
                setRequiredForCartBase();
            }
        });

        function setRequiredForProductBase() {
            document.querySelector('[name="p_code"]').required = true;
            document.querySelector('[name="product_ids[]"]').required = true;
            document.querySelector('[name="p_discount_date_range"]').required = true;
            document.querySelector('[name="p_discount"]').required = true;
        }

        function setRequiredForCartBase() {
            document.querySelector('[name="c_code"]').required = true;
            document.querySelector('[name="minimum_buy"]').required = true;
            document.querySelector('[name="maximum_discount"]').required = true;
            document.querySelector('[name="c_discount_date_range"]').required = true;
            document.querySelector('[name="c_discount"]').required = true;
        }

        function resetRequiredFields() {
            // Reset all required attributes for both types
            document.querySelector('[name="p_code"]').required = false;
            document.querySelector('[name="c_code"]').required = false;
            document.querySelector('[name="product_ids[]"]').required = false;
            document.querySelector('[name="minimum_buy"]').required = false;
            document.querySelector('[name="maximum_discount"]').required = false;
            document.querySelector('[name="p_discount_date_range"]').required = false;
            document.querySelector('[name="c_discount_date_range"]').required = false;
            document.querySelector('[name="p_discount"]').required = false;
            document.querySelector('[name="c_discount"]').required = false;
        }
    </script>
    <script>
        function validateInput(input) {
            // Remove any non-numeric characters
            input.value = input.value.replace(/[^0-9]/g, '');

            // Ensure the value is at least 1
            if (input.value < 1) {
                input.value = '';
            }
        }
    </script>
@endsection



