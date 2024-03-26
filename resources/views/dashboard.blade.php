@extends('admin.layout')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Admin {{ auth()->user()->email }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="salesDropdown('Today', {{ $orderModelToday->count() }})">Today</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="salesDropdown('This Month', {{ $orderModelThisMonth->count() }})">This
                                                Month</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="salesDropdown('This Year', {{ $orderModelThisYear->count() }})">This
                                                Year</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Sales <span>| <span id="selectedFilterSales">Today</span></span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="salesCount">{{ $orderModelToday->count() }}</h6>
                                            <span class="text-success small pt-1 fw-bold">12%</span>
                                            <span class="text-muted small pt-2 ps-1">increase</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="salesAmountDropdown('Today', {{ $totalRevenueToday }})">Today</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="salesAmountDropdown('This Month', {{ $totalRevenueThisMonth }})">This
                                                Month</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="salesAmountDropdown('This Year', {{ $totalRevenueThisYear }})">This
                                                Year</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span>| <span
                                                id="selectedFilterSalesAmount">Today</span></span></h5>


                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="salesAmountCount">{{ $totalRevenueToday }}</h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="customersDropdown('Today', {{ $customerModelToday->count() }})">Today</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="customersDropdown('This Month', {{ $customerModelThisMonth->count() }})">This
                                                Month</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="customersDropdown('This Year', {{ $customerModelThisYear->count() }})">This
                                                Year</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Customers <span>| <span
                                                id="selectedFilterCustomers">Today</span></span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="customersCount">{{ $customerModelToday->count() }}</h6>
                                            <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">decrease</span>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- End Customers Card -->

                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="reportsChart"></div>
                                </div>

                            </div>
                        </div>

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Recent Order's</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderModel as $item)
                                                <tr>
                                                    <th scope="row"><a href="#">#{{ $item->id }}</a></th>
                                                    <td>{{ $item->firstName . ' '. $item->lastName}} 
                                                        <br>{{ $item->phone}} 
                                                        <br>{{ $item->email}}</td>
                                                    <td>{{ $item->created_at->format('d-M-y H:m') }}</td>
                                                    <td>${{ $item->order_total}}</td>
                                                    <td>
                                                        @php
                                                            $status = '';
                                                            $color = '';
                                                            switch ($item->order_status) {
                                                                case 0:
                                                                    $status = 'Pending';
                                                                    $color = 'bg-secondary';
                                                                    break;
                                                                case 1:
                                                                    $status = 'Accepted';
                                                                    $color = 'bg-primary';
                                                                    break;
                                                                case 2:
                                                                    $status = 'Delivered';
                                                                    $color = 'bg-success';
                                                                    break;
                                                                case 3:
                                                                    $status = 'Confirmed';
                                                                    $color = 'bg-info';
                                                                    break;
                                                                case 4:
                                                                    $status = 'Cancelled';
                                                                    $color = 'bg-danger';
                                                                    break;
                                                                default:
                                                                    $status = 'Unknown';
                                                                    $color = 'bg-light';
                                                            }
                                                        @endphp
                                                        <span class="badge {{ $color }}">{{ $status }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="card-body pb-0">
                                    <h5 class="card-title">Top Selling <span id="selectedFilterTopSales">| Product</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Sold QTY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topSellingProducts as $product)
                                            @php
                                                $qty  = $product['product_qty'];
                                                $price  = $product['product_price'];
                                            @endphp
                                            <tr>
                                                <th scope="row"><a href="#">#{{$product['product_id']}}</a></th>
                                                <td><a href="#" class="text-primary fw-bold">{{$product['product_name']}}</a></td>
                                                <td>${{$price}}</td> 
                                                <td class="fw-bold">{{$qty}}</td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- End Top Selling -->
                    </div>
                </div>
                <!-- End Left side columns -->
                

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activity <span>| Sales</span></h5>
                            <div class="activity">
                                @php
                                  $thisTime = $today;
                                @endphp
                                @foreach ($salesActivity as $item)
                                    @php
                                        $createTime = $item->created_at;
                                        $time=$createTime->diffForHumans($thisTime);
                                    @endphp

                                    <div class="activity-item d-flex">
                                        <div class="activite-label">{{$time}}</div>
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                        <div class="activity-content">
                                            @foreach (json_decode($item->product_arr, true) as $key => $product)
                                                <li class="list-group-item">{{ strlen($product['product_name']) > 15 ? substr($product['product_name'], 0, 15) . '...' : $product['product_name'] }}</li>
                                            @endforeach
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                    </div><!-- End Recent Activity -->

                    <!-- Budget Report -->
                    <div class="card">
                        <div class="card-body pb-0">
                            <div id="budgetChart" style="min-height: 400px;"></div>
                        </div>
                    </div><!-- End Budget Report -->

                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Order By Status </h5>

                            <div id="pieChart" style="min-height: 400px;"></div>
                        </div>
                    </div><!-- End Website Traffic -->

                    <!-- News & Updates Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">News &amp; Updates</h5>

                            <div class="news">
                                @foreach ($blogModel as $item)
                                <div class="post-item clearfix">
                                    <img src="{{ $item['banner'] }}" alt="">
                                    <h4><a href="{{ route('front.blogsDetails', ['slug' => $item['slug']])}}">{{$item->title}}</a></h4>
                                    <p>{{$item->slug}}</p>
                                </div>
                                @endforeach

                            </div><!-- End sidebar recent posts-->

                        </div>

                    </div><!-- End News & Updates -->

                </div><!-- End Right side columns -->

            </div>
        </section>

    </main>

    
@endsection
@push('script')
<script>
    function salesDropdown(filter, count) {
        document.getElementById('selectedFilterSales').innerText = filter;
        document.getElementById('salesCount').innerText = count;
    }

    function salesAmountDropdown(filter, count) {
        document.getElementById('selectedFilterSalesAmount').innerText = filter;
        document.getElementById('salesAmountCount').innerText = count;
    }
    
    function customersDropdown(filter, count) {
        document.getElementById('selectedFilterCustomers').innerText = filter;
        document.getElementById('customersCount').innerText = count;
    }

    function topSalesDropdown(filter, count) {
        document.getElementById('selectedFilterTopSales').innerText = filter;
    }
</script>
<script>
    Highcharts.chart('reportsChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Order by date'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Sales Amount'
            }
        },
        series: [{
            name: 'Sales',
            data: <?php echo json_encode($chartData); ?>,
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}',
                y: 10,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
</script>

<script>
    Highcharts.chart('budgetChart', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Monthly Sales'
        },
        xAxis: {
            categories: <?php echo json_encode($months); ?>,
            title: {
                text: 'Months'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Sales Amount'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' USD'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Sales',
            data: <?php echo json_encode($salesData); ?>
        }]
    });
</script>

<script>
    Highcharts.chart('pieChart', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Completed vs Pending Orders'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Orders',
            colorByPoint: true,
            data: <?php echo json_encode($pieChartData); ?>
        }]
    });
</script>

    @if(Session::has('toastr_message'))
        <script>
            toastr.{{ Session::get('toastr_message')['type'] }}('{{ Session::get('toastr_message')['message'] }}');
        </script>
    @endif
@endpush