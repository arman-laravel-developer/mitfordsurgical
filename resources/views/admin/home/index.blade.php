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
                    <div class="card-body" style="padding-bottom: 0!important;">
                        <h5 class="mt-0" title="Revenue">New Order</h5>
                        <h3 class="mt-3 mb-3">{{count($newOrders)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.pending')}}">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body" style="padding-bottom: 0!important;">
                        <h5 class="mt-0" title="Pending Order">Pending Order</h5>
                        <h3 class="mt-3 mb-3">{{number_format($pendingOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.returned')}}">
                <div class="card widget-flat text-bg-warning">
                    <div class="card-body" style="padding-bottom: 0!important;">
                        <h5 class="mt-0" title="Return Order">Return Order</h5>
                        <h3 class="mt-3 mb-3">{{number_format($returnedOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.canceled')}}">
                <div class="card widget-flat text-bg-danger">
                    <div class="card-body" style="padding-bottom: 0!important;">
                        <h5 class="mt-0" title="Revenue">Cancel Order</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($cancelOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.shipped')}}">
                <div class="card widget-flat text-bg-primary">
                    <div class="card-body" style="padding-bottom: 0!important;">
                        <h5 class="mt-0" title="Revenue">Ready To Ship</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($shippedOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.delivered')}}">
                <div class="card widget-flat text-bg-success">
                    <div class="card-body" style="padding-bottom: 0!important;">
                        <h5 class="mt-0" title="Revenue">Shipment Order</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($deliveredOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.proccessing')}}">
                <div class="card widget-flat" style="background-color: #0a6aa1">
                    <div class="card-body" style="padding-bottom: 0!important;">
                        <h5 class="mt-0 text-white" title="Revenue">Proccessing Order</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($proccessingOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-3 col-sm-3">
            <a href="{{route('order.manage')}}">
                <div class="card widget-flat" style="background-color: #5e30c1">
                    <div class="card-body" style="padding-bottom: 0!important;">
                        <h5 class="mt-0 text-white" title="Revenue">All Order</h5>
                        <h3 class="mt-3 mb-3 text-white">{{number_format($allOrder)}}</h3>
                    </div>
                </div>
            </a>
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    <div class="row d-flex">
        <div class="col-md-6 d-flex">
            <div class="card flex-grow-1">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0">Accounts</h4>
                    <div>
                        <select id="period-select" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="today" selected>Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last_week">Last Week</option>
                            <option value="last_month">Last Month</option>
                        </select>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Payment Gateway</th>
                                <th scope="col" class="text-end">Amount</th>
                            </tr>
                            </thead>
                            <tbody id="totals-table-body">
                            <!-- Data will be injected here via AJAX -->
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col" class="text-success"><b>Total</b></th>
                                <th scope="col" class="text-end text-success" id="totals-grand-total">
                                    <b>&#2547; 0.00</b>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="card flex-grow-1">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0 pt-1">Users</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 justify-content-between">
                            <thead>
                            <tr>
                                <th scope="col">User Type</th>
                                <th scope="col" class="text-end">Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="{{$totalSeller > 0 ? 'text-success' : 'text-danger'}}">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            Total Seller
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="{{$totalSeller > 0 ? 'text-success' : 'text-danger'}} fw-semibold">{{$totalSeller}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="{{$totalCustomer > 0 ? 'text-success' : 'text-danger'}}">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            Total Customer
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="{{$totalCustomer > 0 ? 'text-success' : 'text-danger'}} fw-semibold">{{$totalCustomer}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            Total Subscriber
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="text-danger fw-semibold">0</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('period-select').addEventListener('change', function () {
            const selectedPeriod = this.value;

            // Use the named route to fetch data dynamically
            const url = "{{ route('credit.data') }}?period=" + selectedPeriod;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let tableBody = '';
                    let grandTotal = 0;

                    // Generate table rows dynamically
                    for (const [method, total] of Object.entries(data)) {
                        grandTotal += total;
                        const methodName = method === 'cod' ? 'In Cash' : method.charAt(0).toUpperCase() + method.slice(1);
                        const amountClass = total > 0 ? 'text-success' : 'text-danger';
                        tableBody += `
                        <tr>
                            <td class="${amountClass}">${methodName}</td>
                            <td class="text-end">
                                <span class="${amountClass} fw-semibold">
                                    &#2547;${total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
                                </span>
                            </td>
                        </tr>
                    `;
                    }

                    // Update the table body and total
                    document.getElementById('totals-table-body').innerHTML = tableBody;
                    document.getElementById('totals-grand-total').innerHTML = `<b>&#2547; ${grandTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</b>`;
                })
                .catch(error => console.error('Error fetching credit data:', error));
        });

        // Trigger change event on page load to fetch "Today" data by default
        document.getElementById('period-select').dispatchEvent(new Event('change'));
    </script>

@endsection
