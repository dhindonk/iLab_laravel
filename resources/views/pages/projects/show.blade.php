@extends('layouts.main')

@section('title', 'Detail Project')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Detail Project: {{ $project->name }}</h2>
                <div class="row my-4">
                    <div class="col-md-12">
                        <!-- Informasi Project -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow mb-4">
                                    <div class="card-header">
                                        <strong class="card-title">Informasi Project</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center mb-4">
                                            <div class="col-md-3 text-center">
                                                <span class="circle circle-lg bg-primary">
                                                    <i class="fe fe-briefcase fe-24 text-white"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <p class="mb-0 text-muted"><strong>{{ $project->name }}</strong></p>
                                                <small class="mb-0 text-muted">{{ $project->description }}</small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-0 text-muted">Project Manager</p>
                                                <strong>{{ $project->creator->email ?? 'Tidak ada' }}</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-0 text-muted">Total Members</p>
                                                <strong>{{ $project->members->count() }} Members</strong>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <p class="mb-0 text-muted">Tanggal Mulai</p>
                                                <strong>{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</strong>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <p class="mb-0 text-muted">Tanggal Selesai</p>
                                                <strong>{{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col text-center">
                                                <span class="circle circle-sm bg-primary">
                                                    <i class="fe fe-trending-up fe-24 text-white"></i>
                                                </span>
                                                <h3 class="mt-3 mb-1">{{ number_format($projectProgress, 1) }}%</h3>
                                                <p class="text-muted mb-2">Progress Keseluruhan</p>
                                                <div class="progress mt-2" style="height: 15px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: {{ $projectProgress }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Job dan Assignment -->
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Daftar Pekerjaan dan Assignment</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach(json_decode($project->list_job) ?? [] as $index => $job)
                                        @php
                                            $progress = $project->progress->where('job_index', $index)->first();
                                            $assignedMember = $progress ? $project->members->where('id', $progress->user_id)->first() : null;
                                        @endphp
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card shadow-sm mb-4">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <span class="badge badge-pill badge-primary mb-2">Job #{{ $index + 1 }}</span>
                                                            <h4 class="mb-1">{{ $job->job_name ?? 'Tidak ada nama' }}</h4>
                                                            @if($assignedMember)
                                                                <p class="text-muted mb-2">
                                                                    <i class="fe fe-user fe-12 mr-2"></i>
                                                                    {{ $assignedMember->email }}
                                                                </p>
                                                            @else
                                                                <p class="text-warning mb-2">
                                                                    <i class="fe fe-alert-circle fe-12 mr-2"></i>
                                                                    Belum ditugaskan
                                                                </p>
                                                            @endif
                                                            <div class="progress mb-2" style="height: 8px;">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: {{ $progress && $progress->is_completed ? '100' : '0' }}%">
                                                                </div>
                                                            </div>
                                                            @if($progress && $progress->is_completed)
                                                                <span class="badge badge-success">Selesai</span>
                                                            @elseif($progress)
                                                                <span class="badge badge-warning">Dalam Pengerjaan</span>
                                                            @else
                                                                <span class="badge badge-danger">Belum Dimulai</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Progress Per Member -->
                        @if($project->members && $project->members->count() > 0)
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Progress Per Member</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($project->members as $member)
                                        @if(isset($memberProgress[$member->id]))
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card shadow mb-4">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-3 text-center">
                                                            <span class="circle circle-sm bg-primary">
                                                                <i class="fe fe-user text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col">
                                                            <p class="small text-muted mb-1">{{ $member->email }}</p>
                                                            <span class="h3 mb-0">{{ number_format($memberProgress[$member->id]['percentage'], 1) }}%</span>
                                                            <div class="progress mt-2" style="height: 10px;">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: {{ $memberProgress[$member->id]['percentage'] }}%">
                                                                </div>
                                                            </div>
                                                            <small class="text-muted">
                                                                {{ $memberProgress[$member->id]['completed'] }} /
                                                                {{ $memberProgress[$member->id]['total'] }} jobs completed
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
<div class="card shadow mb-4">
                    <div class="card-header">
                        <strong>Recent Activities</strong>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush my-n3">
                            @foreach($project->progress()->orderBy('updated_at', 'desc')->take(5)->get() as $activity)
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="circle circle-sm {{ $activity->is_completed ? 'bg-success' : 'bg-warning' }}">
                                                <i class="fe fe-activity fe-16 text-white"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <small class="text-muted">{{ $activity->updated_at->diffForHumans() }}</small>
                                            <p class="mb-0">
                                                <strong>{{ $activity->user->email }}</strong>
                                                {{ $activity->is_completed ? 'completed' : 'started' }}
                                                job #{{ $activity->job_index + 1 }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                    </div>
                </div>

                <div class="text-left mb-4">
                    <a href="{{ route('project') }}" class="btn btn-secondary">
                        <i class="fe fe-arrow-left fe-16 mr-2"></i>
                        Kembali ke Daftar Proyek
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection



