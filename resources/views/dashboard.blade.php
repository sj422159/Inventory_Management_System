@extends('layouts.admin_master')

@section('content')
@php
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Daily Sales Data
$invoiceData = DB::table('invoices')
    ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(payment) as total'))
    ->groupBy(DB::raw('DATE(created_at)'))
    ->orderBy('date', 'asc')
    ->get();

$dayLabels = $invoiceData->pluck('date')->map(function ($date) {
    return Carbon::parse($date)->format('M d');
});
$dayTotals = $invoiceData->pluck('total');

// Monthly Sales Data
$monthlyData = DB::table('invoices')
    ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(payment) as total'))
    ->groupBy('month')
    ->orderBy('month', 'asc')
    ->get();

$monthLabels = $monthlyData->pluck('month')->map(function ($month) {
    return Carbon::parse($month)->format('M Y'); // Ex: "Jan 2024"
});
$monthTotals = $monthlyData->pluck('total');
@endphp

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 fw-bold">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><i class="fas fa-tachometer-alt"></i> Dashboard Overview</li>
        </ol>

        <!-- Cards Row -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Stock</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Product::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <a href="{{ route('all.product') }}" class="text-decoration-none text-primary">View Details</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sold Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Invoice::sum('quantity') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <a href="{{ route('sold.products') }}" class="text-decoration-none text-warning">View Details</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Available Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Product::where('stock','>', 0)->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <a href="{{ route('available.products') }}" class="text-decoration-none text-success">View Details</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pending Orders</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Order::where('order_status', 0)->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-spinner fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <a href="{{ route('pending.orders') }}" class="text-decoration-none text-danger">View Details</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
            <div class="col-xl-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-line"></i> Daily Sales Overview</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="dayChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-chart-bar"></i> Monthly Sales Overview</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyBarChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js "></script>

<!-- Chart Initialization Script -->
<script>
const dayLabels = {!! json_encode($dayLabels) !!};
const dayTotals = {!! json_encode($dayTotals) !!};

const monthLabels = {!! json_encode($monthLabels) !!};
const monthTotals = {!! json_encode($monthTotals) !!};

// Line Chart - Daily Sales
const dayChart = new Chart(document.getElementById("dayChart").getContext("2d"), {
    type: 'line',
    data: {
        labels: dayLabels,
        datasets: [{
            label: 'Daily Revenue',
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
            pointRadius: 4,
            tension: 0.4,
            data: dayTotals
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: {
                grid: { display: false }
            },
            y: {
                beginAtZero: true,
                grid: { color: '#e9ecef' }
            }
        }
    }
});

// Bar Chart - Monthly Sales
const monthlyBarChart = new Chart(document.getElementById("monthlyBarChart").getContext("2d"), {
    type: 'bar',
    data: {
        labels: monthLabels,
        datasets: [{
            label: 'Monthly Revenue',
            backgroundColor: '#4e73df',
            hoverBackgroundColor: '#2e59d9',
            borderColor: "#4e73df",
            data: monthTotals
        }]
    },
    options: {
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: {
                grid: { display: false }
            },
            y: {
                beginAtZero: true,
                grid: { color: '#e9ecef' }
            }
        }
    }
});
</script>
@endsection