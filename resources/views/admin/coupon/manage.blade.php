@extends('admin.master')
@section('title')
    Coupon manage | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right" style="display: block!important;">
                    <a href="{{route('coupon.add')}}" class="btn btn-primary ms-1">
                        Add New Coupon
                    </a>
                </div>
                <h4 class="page-title">Coupon Manage</h4>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $coupon)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>{{$coupon->type == 'cart_base' ? 'Cart Base' : 'Product Base'}}</td>
                            <td>{{$coupon->start_date}}</td>
                            <td>{{$coupon->end_date}}</td>
                            <td>
                                @if($coupon->is_active == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">In Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('coupon.edit', ['id' => $coupon->id])}}" class="btn btn-success btn-sm" title="Edit">
                                    <i class="ri-edit-box-fill"></i>
                                </a>
                                <button type="button" onclick="confirmDelete({{$coupon->id}});" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="ri-chat-delete-fill"></i>
                                </button>

                                <form action="{{route('coupon.delete', ['id' => $coupon->id])}}" method="POST" id="couponDeleteForm{{$coupon->id}}">
                                    @csrf
                                </form>
                                <script>
                                    function confirmDelete(couponId) {
                                        var confirmDelete = confirm('Are you sure you want to delete this?');
                                        if (confirmDelete) {
                                            document.getElementById('couponDeleteForm' + couponId).submit();
                                        } else {
                                            return false;
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection



