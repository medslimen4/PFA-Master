@extends('layouts.admin')

@section('content')
    @can('user_management_access')
    <div class="container-fluid">
        <div class="row">
            <!-- Total Users -->
            <div class="col-md-3">
                <div class="card spur-card user-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="spur-card-title">Total Users</div>
                    </div>
                    <div class="card-body">
                        <div class="stats-number"><h6>{{ $totalUsers }}</h6></div>
                    </div>
                </div>
            </div>

            <!-- Total Events -->
            <div class="col-md-3">
                <div class="card spur-card event-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="spur-card-title">Total Events</div>
                    </div>
                    <div class="card-body">
                        <div class="stats-number"><h6>{{ $totalEvents }}</h6></div>
                    </div>
                </div>
            </div>

            <!-- Events Approved -->
            <div class="col-md-3">
                <div class="card spur-card approved-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="spur-card-title">Events Approved</div>
                    </div>
                    <div class="card-body">
                        <div class="stats-number"><h6>{{ $totalApprovedEvents }}</h6></div>
                    </div>
                </div>
            </div>

            <!-- Events Refused -->
            <div class="col-md-3">
                <div class="card spur-card refused-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="spur-card-title">Events Refused</div>
                    </div>
                    <div class="card-body">
                        <div class="stats-number"><h6>{{ $totalRefusedEvents }}</h6></div>
                    </div>
                </div>
            </div>

            <!-- Events In Progress -->
            <div class="col-md-3">
                <div class="card spur-card progress-card">
                    <div class="card-header">
                        <div class="spur-card-icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="spur-card-title">Events In Progress</div>
                    </div>
                    <div class="card-body">
                        <div class="stats-number"><h6>{{ $totalInProgressEvents }}</h6></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection
