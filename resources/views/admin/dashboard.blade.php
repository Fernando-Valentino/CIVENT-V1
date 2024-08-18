@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-12 mb-4">
                <h1>Dashboard</h1>
                <p>Welcome, {{ Auth::user()->name }}!</p>
            </div>

            <!-- Statistics Section -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center">
                        <!-- Add an icon for Total Events -->
                        <i class="bi bi-calendar-event-fill" style="font-size: 2rem; color: #ffcd56;"></i>
                        <h5 class="card-title mt-3">Total Events</h5>
                        <h2>{{ $totalEvents }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center">
                        <!-- Add an icon for Total Participants -->
                        <i class="bi bi-people-fill" style="font-size: 2rem; color: #ff6384;"></i>
                        <h5 class="card-title mt-3">Total Participants</h5>
                        <h2>{{ $totalParticipants }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center">
                        <!-- Add an icon for Active Events -->
                        <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #4bc0c0;"></i>
                        <h5 class="card-title mt-3">Active Events</h5>
                        <h2>{{ $activeEvents }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Data Graph Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Event Registrations</h5>
                        <canvas id="eventsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('eventsChart').getContext('2d');
        var eventsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!}, // Months array from controller
                datasets: [{
                    label: 'Registrations',
                    data: {!! json_encode($monthlyRegistrations) !!}, // Data array from controller
                    backgroundColor: 'rgba(255, 99, 132, 1)', // Ubah warna background bar
                    borderColor: 'rgba(255, 99, 132, 1)', // Ubah warna border bar
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: '#ffff', // Ubah warna teks label sumbu X
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#fff', // Ubah warna teks label sumbu Y
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#ffff', // Ubah warna teks label legenda
                        }
                    },
                    tooltip: {
                        bodyColor: '#ffffff', // Ubah warna teks tooltip
                        backgroundColor: '#333333', // Ubah warna latar belakang tooltip
                        titleColor: '#ffcd56' // Ubah warna teks judul tooltip
                    }
                }
            }
        });
    </script>

@endsection
