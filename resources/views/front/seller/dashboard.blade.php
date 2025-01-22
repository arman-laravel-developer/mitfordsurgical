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
                                <h5>Total Published Products</h5>
                                <h3>{{count($sellerPublishedProducts)}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Total Pending Products</h5>
                                <h3>{{count($sellerPendingProducts)}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Total Orders</h5>
                                <h3>{{$totalOrders}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Total Sales</h5>
                                <h3>{{count($totalSales)}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Order Pending</h5>
                                <h3>{{count($pendingOrders)}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="total-contain">
                            <div class="total-detail">
                                <h5>Order Delivered</h5>
                                <h3>&#2547; {{number_format($deliveredOrders,2)}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 h-100">
                <div class="col-xxl-6 col-md-6">
                    <div class="dashboard-bg-box">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>

                <div class="col-xxl-6 col-md-6">
                    <div class="dashboard-bg-box">
                        <div id="saleDashboard"></div>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const sellerId = {{ Session::get('seller_id') }}; // Get seller ID from session
        const apiUrl = "{{ route('seller.orders.bySeller', ['sellerId' => Session::get('seller_id')]) }}";

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                // Process the data and render the chart
                const labels = data.map(order => {
                    const date = new Date(order.created_at);
                    const options = { month: 'short', day: 'numeric' }; // Format options for short month and numeric day
                    return date.toLocaleDateString(undefined, options); // Format as "Jan 22"
                });

                const orderAmounts = data.map(order => order.grand_total);

                const ctx = document.getElementById('orderChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Delivered Order Amounts',
                            data: orderAmounts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching order data:', error));
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var recentOrders = <?php echo json_encode($recentOrdersCount); ?>;
        var completeOrders = <?php echo json_encode($completeOrdersCount); ?>;
        var totalOrders = <?php echo json_encode($totalOrders); ?>;

        var options = {
            series: [recentOrders, completeOrders, totalOrders],
            chart: {
                type: 'donut',
                height: 320,
            },
            dataLabels: {
                enabled: false
            },
            title: {
                text: 'Overall Sales',
                align: 'left'
            },
            labels: ['Recent Order', 'Complete Order', 'Total Orders'],
            colors: ['#4a5568', '#0da487', '#bade17'],
            responsive: [{
                breakpoint: 1430,
                options: {
                    chart: {
                        width: 280,
                        height: 285
                    },
                    legend: {
                        position: 'bottom'
                    }
                },
                breakpoint: 1199,
                options: {
                    chart: {
                        width: 250,
                        height: 290
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#saleDashboard"), options);
        chart.render();
    </script>
@endsection
