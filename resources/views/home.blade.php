@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div>
        </div>

        @if(Auth::user()->hasRole('admin'))
            <!-- If the user is an admin, show data for all sales -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customer Count per Sales per Month</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="customerChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->hasRole('sales'))
            <!-- If the user is a sales person, show data only for this sales person -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customer Count per Month</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="customerChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- If the user does not have a recognized role, show a message -->
            <div class="alert alert-warning">
                You do not have permission to view this page.
            </div>
        @endif
    </section>

    @push('customScript')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const chartData = @json($chartData);

                const ctx = document.getElementById('customerChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        datasets: chartData,
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'month',
                                    tooltipFormat: 'MMM YYYY',
                                },
                                title: {
                                    display: true,
                                    text: 'Month',
                                },
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Customer Count',
                                },
                            },
                        },
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                        },
                    }
                });
            });
        </script>
    @endpush
@endsection
