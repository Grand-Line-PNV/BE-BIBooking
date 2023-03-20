@extends('admin.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-chart-pie menu-icon"></i>
                </span> Dasboard
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Dasboard <i
                            class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" data-group="month" class="btn btn-sm btn-danger">Month</button>
            <button type="button" data-group="year" class="btn btn-sm btn-primary">Year</button>
        </div> -->
        <div class="row">
            <div class="container col-lg-10 grid-margin stretch-card"
                style="background-color: white;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <!-- <div class="btn-group btn-group-user" role="group" aria-label="Basic example">
            <button type="button" data-group="monthUser"
                class="btn btn-user btn-sm btn-danger">Month</button>
            <button type="button" data-group="yearUser"
                class="btn btn-user btn-sm btn-primary">Year</button>
        </div> -->
        <div class="row">
            <div class="container col-lg-10 grid-margin stretch-card"
                style="background-color: white;">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Order -->
    <script>
    let myChart2 = document.getElementById('myChart2').getContext('2d');
    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart2 = new Chart(myChart2, {
        type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data: {
            labels: ['1 - 5 days', '5 - 10 days', '10 - 15 days', '15 - 20 days', '20 - 25 days', ' > 25 days'],
            datasets: [{
                label: 'Number',
                data: [
                    617594,
                    181045,
                    153060,
                    106519,
                    105162,
                    95072
                ],
                //backgroundColor:'green',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderWidth: 1,
                borderColor: '#777',
                hoverBorderWidth: 3,
                hoverBorderColor: '#000'
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Average time that each influencer need to receive a job',
                fontSize: 25
            },
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: '#000'
                }
            },
            layout: {
                padding: {
                    left: 50,
                    right: 0,
                    bottom: 0,
                    top: 0
                }
            },
            tooltips: {
                enabled: true
            }
        }
    });
    </script>
    <!-- User -->
    <script>
    let myChart = document.getElementById('myChart').getContext('2d');
    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
        type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data: {
            labels: ['1 - 2', '3 - 4', '4 - 5', '5 - 6', '6 - 7', '7 - 8'],
            datasets: [{
                label: 'Jobs',
                data: [
                    50,
                    70,
                    30,
                    100,
                    0, 100,
                ],
                //backgroundColor:'green',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderWidth: 1,
                borderColor: '#777',
                hoverBorderWidth: 3,
                hoverBorderColor: '#000'
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Avarage jobs each influencer get per month',
                fontSize: 25
            },
            legend: {
                display: true,
                position: 'right',
                labels: {
                    fontColor: '#000'
                }
            },
            layout: {
                padding: {
                    left: 50,
                    right: 0,
                    bottom: 0,
                    top: 0
                }
            },
            tooltips: {
                enabled: true
            }
        }
    });
    </script>

    <!-- main-panel ends -->
    @endsection