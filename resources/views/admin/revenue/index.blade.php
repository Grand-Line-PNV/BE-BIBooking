@extends('admin.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                </span> Revenue
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Revenue <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Revenues </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Payment ID </th>
                                        <th> Booking ID </th>
                                        <th> Bank Name </th>
                                        <th> Date </th>
                                        <th> Money </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @if ($payments->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No data has found!
                                        </td>
                                    </tr>
                                    @else
                                    @foreach ($payments as $payment)
                                    @php
                                    $total = $total + $payment->number;
                                    @endphp
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment ->id }}</td>
                                        <td>{{ $payment->booking_id }}</td>
                                        <td>{{ $payment->bank_name }}</td>
                                        <td>{{ $payment ->date }}</td>
                                        <td>{{ $payment->number }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>{{$total}}</th>
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