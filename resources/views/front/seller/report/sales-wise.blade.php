@extends('front.seller.master.master')

@section('seller.title')
    Sales Report Analysis | {{$generalSettingView->site_name}}
@endsection

@section('seller.body')
    <div class="title">
        <h2>Sales Report Analysis</h2>
        <span class="title-leaf title-leaf-gray"></span>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            <form action="{{ route('seller.report.sales-wise') }}" method="GET" id="filterForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="order_status" id="order_status" class="form-control" onchange="this.form.submit()">
                                            <option value="" >Select order status</option>
                                            <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ request('order_status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ request('order_status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ request('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancel" {{ request('order_status') == 'cancel' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                    </div>
                                    @php
                                        if (!empty($selectedDate) && str_contains($selectedDate, ' - ')) {
                                            $dates = explode(' - ', $selectedDate);
                                            $startDate = \Carbon\Carbon::parse($dates[0]);
                                            $endDate = \Carbon\Carbon::parse($dates[1]);
                                        } else {
                                            $startDate = null;
                                            $endDate = null;
                                        }
                                    @endphp
                                    <div class="col-md-3">
                                        <input type="text" class="form-control"
                                               id="date_range" name="date_range"
                                               value="{{ $startDate && $endDate ? $startDate . ' - ' . $endDate : '' }}"
                                               placeholder="Select date range" autocomplete="off" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3">
                            <div class="text-sm-end">
                                <button type="button" onclick="event.preventDefault(); document.getElementById('filterForm').submit();" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-filter"></i>
                                </button>
                                <a href="{{route('seller.report.sales')}}" class="btn btn-danger mb-2">reset</a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light dropdown-toggle mb-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Export
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <!-- Export as PDF -->
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="exportReport('pdf')">
                                                Export as PDF
                                            </a>
                                        </li>
                                        <!-- Export as Excel -->
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="exportReport('excel')">
                                                Export as Excel
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Hidden Form for Exporting -->
                                <form action="{{ route('seller.report.filtered-sales-export') }}" method="GET" id="exportForm">
                                    @csrf
                                    <input type="hidden" name="type" id="exportType" value=""> <!-- PDF or Excel -->
                                    <input type="hidden" name="order_status" value="{{ $order_status }}">
                                    <input type="hidden" name="date_range" value="{{ $selectedDate }}">
                                </form>

                                <script>
                                    /**
                                     * Set the export type (PDF or Excel) and submit the form.
                                     */
                                    function exportReport(type) {
                                        event.preventDefault();
                                        document.getElementById('exportType').value = type;
                                        document.getElementById('exportForm').submit();
                                    }
                                </script>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" >
                            <thead class="table-light">
                            <tr>
                                {{--                                <th class="all" style="width: 20px;">--}}
                                {{--                                    <div class="form-check">--}}
                                {{--                                        <input type="checkbox" class="form-check-input" id="customCheck1">--}}
                                {{--                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>--}}
                                {{--                                    </div>--}}
                                {{--                                </th>--}}
                                <th class="all">Order Code</th>
                                <th>Qty</th>
                                <th>Order Total</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    {{--                                    <td>--}}
                                    {{--                                        <div class="form-check">--}}
                                    {{--                                            <input type="checkbox" class="form-check-input" id="customCheck2">--}}
                                    {{--                                            <label class="form-check-label" for="customCheck2">&nbsp;</label>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </td>--}}
                                    <td>
                                        {{$order->order_code}}
                                    </td>
                                    <td>
                                        {{$order->total_qty}}
                                    </td>
                                    <td>
                                        &#2547; {{number_format($order->grand_total+$order->shipping_cost-$order->coupon_discount)}}
                                    </td>
                                    <td>
                                        {{$order->created_at->format('d/m/Y')}}
                                    </td>
                                    <td>
                                        @if($order->order_status == 'delivered')
                                            <span class="badge bg-success">Deliveried</span>
                                        @elseif($order->order_status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($order->order_status == 'proccessing')
                                            <span class="badge bg-black">Proccessing</span>
                                        @elseif($order->order_status == 'shipped')
                                            <span class="badge bg-primary">Shipped</span>
                                        @else
                                            <span class="badge bg-danger">Canceled</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$order->payment_method == 'cod' ? 'Cash On Delivery' : ucfirst($order->payment_method)}}
                                    </td>
                                    <td>
                                        @if($order->payment_status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($order->payment_status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-danger">Unpaid</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <p class="badge bg-success" style="font-size: 1.5em;">Total Sell: &#2547; {{number_format($grandTotal)}}</p>
                    </div>
                </div> <!-- end card-body-->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#date_range').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                autoUpdateInput: false,
            });

            // Update the form input with the selected date range
            $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                // Submit form if needed
                $('#filterForm').submit();
            });

            // Clear the date picker input on cancel
            $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
