@extends('admin.master')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                </span> Feedback
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Feedback <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Feedback </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Feeback ID </th>
                                        <th> Booking ID </th>
                                        <th> From account ID </th>
                                        <th> To Account ID </th>
                                        <th> Username </th>
                                        <th> Role </th>
                                        <th> Content </th>
                                        <th> Date </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $id = 0;
                                    @endphp
                                    @if ($feedbacks->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            No data has found!
                                        </td>
                                    </tr>
                                    @else
                                    @foreach ($feedbacks as $feedback)
                                    @php
                                    $id += 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $id }}</td>
                                        <td>{{ $feedback->id }}</td>
                                        <td>{{ $feedback->booking_id }}</td>
                                        <td>{{ $feedback->from_account_id}}</td>
                                        <td>{{ $feedback['to_account_id']}}</td>
                                        <td>{{ $feedback['account']['username']}}</td>
                                        <td>{{ $feedback['account']['role']['name'] }}</td>
                                        <td>{{ $feedback->content}}</td>
                                        <td>{{ $feedback->created_at}}</td>
                                        <td>
                                            <a href="/admin/feedback/delete/{{ $feedback->id }}" onclick="return confirm('Do you want to delete this feedback!')"><i class="mdi mdi-delete"></i></a>
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