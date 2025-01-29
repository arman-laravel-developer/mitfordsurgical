@extends('admin.master')

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
                <h4 class="page-title">All User Information</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">{{Session::get('message')}}</p>
                    <table class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>User Name</th>
                            <th>Role Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    @foreach($user->roles as $user_role)
                                    <span>{{$user_role->id.' , '}}</span>
                                    @endforeach
                                </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->mobile}}</td>
                                <td>
                                    <a href="{{route('user.edit', ['id' => $user->id])}}" style="background-color: #5e30c1!important;border-color: #5e30c1!important;" class="btn btn-success btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('user.delete', ['id' => $user->id])}}" style="background-color: #ff0000!important;border-color: #ff0000!important;" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Ary you sure to delete this..');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
@endsection
