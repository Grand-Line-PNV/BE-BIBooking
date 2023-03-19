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
                                        <th> Action </th>
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
                                        <td>
                                            <svg onclick="myFunction(this)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                            <!-- <i style="width:50px;height:24px;" class="mdi mdi-eye "></i> -->
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24 height="24" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                            </svg> -->
                                        </td>
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