@extends('admin.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                </span> Brand
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Brand <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manager Brand</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Brand ID </th>
                                        <th> Username </th>
                                        <th> Email </th>
                                        <th> Fullname </th>
                                        <th> Nickname </th>
                                        <th> Gender </th>
                                        <th> Industry </th>
                                        <th> Website </th>
                                        <th> DOB </th>
                                        <th> Brand name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $id = 0;
                                    @endphp
                                    @if ($brands->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No data has found!
                                        </td>
                                    </tr>
                                    @else
                                    @foreach ($brands as $brand)
                                    @php
                                    $id += 1;
                                    @endphp

                                    <tr>
                                        <td>{{ $id }}</td>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->username }}</td>
                                        <td>{{ $brand->email}}</td>
                                        <td>{{ $brand['credential']['fullname'] ?? "-" }}</td>
                                        <td>{{ $brand['credential']['nickname'] ?? "-" }}</td>
                                        <td>{{ $brand['credential']['gender'] ?? "-" }} </td>
                                        <td>{{ $brand['credential']['industry'] ?? "-" }} </td>
                                        <td>{{ $brand['credential']['website']}} ?? "-"</td>
                                        <td>{{ $brand['credential']['dob'] ?? "-"}}</td>
                                        <td>{{ $brand['credential']['brand_name'] ?? "-" }}</td>
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
    <a href="#" onclick="myFunction(this)">
        <i style="font-size:24px" class="mdi mdi-eye"></i>
    </a>
    </td>
    <script>
        const myFunction = (icon) => {
            icon.classList.toggle("mdi mdi-eyeUnactive");
        }
    </script>
    <!-- Order -->
    <!-- User -->

    <!-- main-panel ends -->
    @endsection