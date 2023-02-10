@extends('admin.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Dashboard <i
                            class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" data-group="month" class="btn btn-sm btn-danger">Month</button>
            <button type="button" data-group="year" class="btn btn-sm btn-primary">Year</button>
        </div>
        <div class="row">
            <div class="container col-lg-10 grid-margin stretch-card"
                style="background-color: white;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="btn-group btn-group-user" role="group" aria-label="Basic example">
            <button type="button" data-group="monthUser"
                class="btn btn-user btn-sm btn-danger">Month</button>
            <button type="button" data-group="yearUser"
                class="btn btn-user btn-sm btn-primary">Year</button>
        </div>
        <div class="row">
            <div class="container col-lg-10 grid-margin stretch-card"
                style="background-color: white;">
                <canvas id="myChartUser"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Order -->
    <!-- User -->

    <!-- main-panel ends -->
    @endsection