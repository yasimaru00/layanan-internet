@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>

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
</section>

@push('customScript')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const token = '{{ session('api_token') }}';
    if (!token) {
    console.error("API token is missing");
    return;
}
    fetch('{{ url('/api/sales/monthly-customer-count') }}', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        const datasets = [];
        const salesData = {};

        Object.keys(data).forEach(salesId => {
            data[salesId].forEach(record => {
                const monthYear = `${record.year}-${record.month.toString().padStart(2, '0')}`;
                if (!salesData[salesId]) {
                    salesData[salesId] = { label: record.sales.nama, data: [] };
                }
                salesData[salesId].data.push({ x: monthYear, y: record.total });
            });
        });

        Object.keys(salesData).forEach(salesId => {
            const sales = salesData[salesId];
            datasets.push({
                label: sales.label,
                data: sales.data,
                borderColor: getRandomColor(),
                backgroundColor: getRandomColor(0.2),
                fill: false,
            });
        });

        const ctx = document.getElementById('customerChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                datasets: datasets,
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

    function getRandomColor(alpha = 1) {
        return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${alpha})`;
    }
});

</script>
@endpush
@endsection
