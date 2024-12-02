@extends('layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row align-items-center mb-4">
                        <div class="col">
                            <h2 class="h5 page-title">Welcome!</h2>
                            <p class="text-muted">Dashboard overview and statistics</p>
                        </div>
                    </div>

                    <!-- Widgets Stats -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-primary">
                                                <i class="fe fe-16 fe-users text-white"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="small text-muted mb-0">Members</p>
                                            <span class="h3 mb-0">{{ \App\Models\User::count() }}</span>
                                            <span class="small text-success">Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-primary">
                                                <i class="fe fe-16 fe-briefcase text-white"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="small text-muted mb-0">Projects</p>
                                            <span class="h3 mb-0">{{ \App\Models\Project::count() }}</span>
                                            <span class="small text-success">Running</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-primary">
                                                <i class="fe fe-16 fe-image text-white"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="small text-muted mb-0">Banners</p>
                                            <span class="h3 mb-0">{{ \App\Models\Banners::count() }}</span>
                                            <span class="small text-success">Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-sm bg-primary">
                                                <i class="fe fe-16 fe-thumbs-up text-white"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="small text-muted mb-0">Partners</p>
                                            <span class="h3 mb-0">{{ \App\Models\Mitra::count() }}</span>
                                            <span class="small text-success">Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="row">
                        <!-- Recent Projects -->
                        <div class="col-md-7">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="h6 mb-0">Recent Projects</h3>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('project') }}" class="btn btn-sm btn-primary">View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group list-group-flush my-n3">
                                        @foreach(\App\Models\Project::with(['creator', 'creator.profile', 'members'])->latest()->take(5)->get() as $project)
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h4 class="h6 mb-1">{{ $project->name }}</h4>
                                                        <p class="small text-muted mb-0">
                                                            Created by: {{ $project->creator->profile->full_name ?? $project->creator->email }}
                                                        </p>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span class="badge badge-pill badge-primary">{{ $project->members->count() }} members</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Members -->
                        <div class="col-md-5">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="h6 mb-0">Recent Members</h3>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('members.index') }}" class="btn btn-sm btn-primary">View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group list-group-flush my-n3">
                                        @foreach(\App\Models\User::with('profile')->latest()->take(5)->get() as $member)
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        @if($member->profile)
                                                            <img src="{{ asset('images/foto_profile/' . ($member->profile->image ?? 'default.png')) }}" 
                                                                 class="avatar-sm rounded-circle">
                                                        @else
                                                            <img src="{{ asset('images/foto_profile/male.png') }}" 
                                                                 class="avatar-sm rounded-circle">
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        <p class="mb-0">
                                                            <strong>{{ $member->profile->full_name ?? 'Profile Not Set' }}</strong>
                                                        </p>
                                                        <small class="text-muted">{{ $member->email }}</small>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span class="dot dot-md {{ $member->verify ? 'bg-success' : 'bg-warning' }}"
                                                              data-toggle="tooltip" 
                                                              title="{{ $member->verify ? 'Verified' : 'Not Verified' }}">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('style')
<style>
    .avatar-sm {
        width: 36px;
        height: 36px;
        object-fit: cover;
    }

    .list-group-item {
        padding: 1rem 1.5rem;
    }

    .card {
        border: none;
        margin-bottom: 24px;
        box-shadow: 0 0 0.875rem 0 rgba(33,37,41,.05);
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: 1rem 1.5rem;
    }

    .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .badge-pill {
        padding-right: .875em;
        padding-left: .875em;
        border-radius: 50rem;
    }

    .small {
        font-size: 85%;
    }
</style>
@endpush

@push('script')
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
