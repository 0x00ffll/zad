@extends('layouts.app')

@section('title', 'Dashboard - VENOM IPTV Admin')

@section('content')
<!--start page wrapper -->
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
    <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Users</p>
                        <h4 class="my-1 text-info">{{ number_format($stats['total_users']) }}</h4>
                        <p class="mb-0 font-13">+2.5% from last week</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-group'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Active Streams</p>
                        <h4 class="my-1 text-danger">{{ number_format($stats['active_streams']) }}</h4>
                        <p class="mb-0 font-13">Live streaming now</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bx-broadcast'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Channels</p>
                        <h4 class="my-1 text-success">{{ number_format($stats['total_channels']) }}</h4>
                        <p class="mb-0 font-13">Available content</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-quepal text-white ms-auto"><i class='bx bx-tv'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Server Load</p>
                        <h4 class="my-1 text-warning">{{ $stats['server_load'] }}%</h4>
                        <p class="mb-0 font-13">Current usage</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bx-server'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Welcome back, Admin!</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-2 mt-3">
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-secondary">Active Sessions</p>
                                        <h4 class="mb-0 text-primary">{{ number_format($stats['active_sessions']) }}</h4>
                                    </div>
                                    <div class="ms-auto widget-icon bg-primary text-white">
                                        <i class='bx bx-user-check'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-orange">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-secondary">Bandwidth Usage</p>
                                        <h4 class="mb-0 text-orange">{{ $stats['bandwidth_usage'] }} GB</h4>
                                    </div>
                                    <div class="ms-auto widget-icon bg-orange text-white">
                                        <i class='bx bx-transfer'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Quick Actions</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-grid">
                    <a href="#" class="btn btn-primary mb-3">Add New User</a>
                    <a href="#" class="btn btn-outline-secondary mb-3">Manage Channels</a>
                    <a href="#" class="btn btn-outline-info mb-3">View Reports</a>
                    <a href="#" class="btn btn-outline-warning">System Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Recent Activity</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">View All</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Export</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="timeline-wrapper">
                    <div class="timeline-item">
                        <div class="timeline-dot bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">New user registration</h6>
                            <p class="timeline-description">John Doe registered as a new user</p>
                            <span class="timeline-time">2 minutes ago</span>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">Server maintenance completed</h6>
                            <p class="timeline-description">Scheduled maintenance was completed successfully</p>
                            <span class="timeline-time">15 minutes ago</span>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">High bandwidth usage detected</h6>
                            <p class="timeline-description">Bandwidth usage exceeded 80% threshold</p>
                            <span class="timeline-time">1 hour ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->
<!--end page wrapper -->
@endsection