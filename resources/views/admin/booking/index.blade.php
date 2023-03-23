@extends('admin.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                </span> Booking
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Booking <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bookings</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Booking Id </th>
                                        <th> Influencer ID </th>
                                        <th> Fullname</th>
                                        <th> Campaign ID </th>
                                        <th> Campaign Name</th>
                                        <th> Status </th>
                                        <th> Started Date </th>
                                        <th> Ended Date </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $id = 0;
                                    @endphp
                                    @if ($bookings->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No data has found!
                                        </td>
                                    </tr>
                                    @else
                                    @foreach ($bookings as $booking)
                                    @php
                                    $id += 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $id }}</td>
                                        <td>{{ $booking->id}}</td>
                                        <td>{{ $booking->influencer_id}}</td>
                                        <td>{{ $booking['influencer']['credential']['fullname'] ?? "null"}}</td>
                                        <td>{{ $booking->campaign_id }}</td>
                                        <td>{{ $booking['campaign']['name'] ?? "null"}}</td>
                                        <td>{{ $booking->status}}</td>
                                        <td>{{ $booking->started_date}}</td>
                                        <td>{{ $booking->ended_date}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
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