@extends('admin.master')
@section('title')
    Customer manage | {{env('APP_NAME')}}
@endsection

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Customer Manage</h4>
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
                        <tr style="font-size: 90%">
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Ordered Prodcut</th>
                            <th class="action" data-priority="1">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr style="font-size: 90%">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->orders ? count($customer->orders) : 'N/A'}}</td>
                                <td>
                                    <a href="{{route('customer.login-admin', ['id' => $customer->id])}}" style="background-color: #AE1C9A!important; border-color: #AE1C9A!important;" target="_blank" class="btn btn-success btn-sm" title="Login as a customer">
                                        <i class="fa fa-key"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="confirmDelete({{$customer->id}});" style="background-color: #fb160a!important; border-color: #fb160a!important;" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form action="{{route('dashboard.customer-delete', ['id' => $customer->id])}}" method="POST" id="customerDeleteForm{{$customer->id}}">
                                        @csrf
                                    </form>
                                    <script>
                                        function confirmDelete(customerId) {
                                            var confirmDelete = confirm('Are you sure you want to delete this?');
                                            if (confirmDelete) {
                                                document.getElementById('customerDeleteForm' + customerId).submit();
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

