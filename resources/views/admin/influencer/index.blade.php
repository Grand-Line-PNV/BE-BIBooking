@extends('admin.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                </span> Influencer
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Influencer <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Influencers</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Influencer ID </th>
                                        <th> Username </th>
                                        <th> Email </th>
                                        <th> Fullname </th>
                                        <th> Nickname </th>
                                        <th> Gender </th>
                                        <th> Job </th>
                                        <th> Booking price </th>
                                        <th> DOB </th>
                                        <th> Year experiences </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $id = 0;
                                    @endphp
                                    @if ($influencers->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No data has found!
                                        </td>
                                    </tr>
                                    @else
                                    @foreach ($influencers as $influencer)
                                    @php
                                    $id += 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $id }}</td>
                                        <td>{{ $influencer->id }}</td>
                                        <td>{{ $influencer->username }}</td>
                                        <td>{{ $influencer->email }}</td>
                                        <td>{{ $influencer['credential']['fullname'] }}</td>
                                        <td>{{ $influencer['credential']['nickname']}}</td>
                                        <td>{{ $influencer['credential']['gender']}}</td>
                                        <td>{{ $influencer['credential']['job']}}</td>
                                        <td>{{ $influencer['credential']['booking_price']}}</td>
                                        <td>{{ $influencer['credential']['dob']}}</td>
                                        <td>{{ $influencer['credential']['experiences']}}</td>
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