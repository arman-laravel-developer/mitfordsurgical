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
        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.new-show')}}">
                <div class="card widget-flat text-bg-secondary">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-btc widget-icon text-bg-secondary rounded-circle"></i>
                        </div>
                        <h5 class=" mt-0" title="Revenue">New Order</h5>
                        <h3 class="mt-3 mb-3">{{count($newOrders)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.pending')}}">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-pulse widget-icon text-bg-secondary"></i>
                        </div>
                        <h5 class="mt-0" title="Pending Order">Pending Order</h5>
                        <h3 class="mt-3 mb-3">{{number_format($pendingOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.returned')}}">
                <div class="card widget-flat text-bg-warning">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                        </div>
                        <h5 class="mt-0" title="Return Order">Return Order</h5>
                        <h3 class="mt-3 mb-3">{{number_format($returnedOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.canceled')}}">
                <div class="card widget-flat text-bg-danger">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-primary"></i>
                        </div>
                        <h5 class="fw-normal mt-0" title="Revenue">Cancel Order</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($cancelOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.shipped')}}">
                <div class="card widget-flat text-bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-primary"></i>
                        </div>
                        <h5 class="fw-normal mt-0" title="Revenue">Ready To Ship</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($shippedOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.delivered')}}">
                <div class="card widget-flat text-bg-success">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-primary"></i>
                        </div>
                        <h5 class="fw-normal mt-0" title="Revenue">Shipment Order</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($deliveredOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.proccessing')}}">
                <div class="card widget-flat" style="background-color: #0a6aa1">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-primary"></i>
                        </div>
                        <h5 class="fw-normal mt-0 text-white" title="Revenue">Proccessing Order</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($proccessingOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.manage')}}">
                <div class="card widget-flat" style="background-color: #5e30c1">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="mdi mdi-currency-usd widget-icon bg-light-lighten rounded-circle text-primary"></i>
                        </div>
                        <h5 class="fw-normal mt-0 text-white" title="Revenue">All Order</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($allOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->
    </div>
    <!-- end row-->

@endsection
