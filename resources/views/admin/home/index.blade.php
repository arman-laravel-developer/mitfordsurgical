@extends('admin.master')

@section('title')
Dashboard | {{env('APP_NAME')}}
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
                        <a href="{{route('dashboard')}}" class="btn btn-primary ms-2" title="Reload">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
                <p>{{Session::get('message')}}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <h1>Dashboard</h1>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection
