@extends('admin.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                </span> Report
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Report <i
                            class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Reports </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Customer </th>
                                        <th> Start booking </th>
                                        <th> End booking </th>
                                        <th> Booking on </th>
                                        <th> Type </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>name</td>
                                        <td>date start</td>
                                        <td>End booking </td>
                                        <td>Booking on</td>
                                        <td>Type </td>
                                        <td>
                                            <button
                                                class="badge badge-gradient-danger">status</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Order -->
    <!-- User -->

    <!-- main-panel ends -->
    @endsection