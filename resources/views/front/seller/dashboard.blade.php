@extends('front.seller.master.master')

@section('seller.title')
    Seller Dashboard | {{$generalSettingView->site_name}}
@endsection

@section('seller.body')
    <div class="dashboard-home">
            <div class="total-box">
                <div class="row g-sm-4 g-3">
                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Total Products</h5>
                                <h3>25</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Total Sales</h5>
                                <h3>12550</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Order Pending</h5>
                                <h3>36</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Total Products</h5>
                                <h3>25</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Total Sales</h5>
                                <h3>12550</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Order Pending</h5>
                                <h3>36</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 h-100">
                <div class="col-xxl-6 col-md-6">
                    <div class="dashboard-bg-box">
                        <div id="chart"></div>
                    </div>
                </div>

                <div class="col-xxl-6 col-md-6 h-100">
                    <div class="dashboard-bg-box">
                        <div id="sale"></div>
                    </div>
                </div>
            </div>
        </div>
@endsection
