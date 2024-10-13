@extends('layouts.app')

@section('title', 'Detail Proyek')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Proyek: {{ $project->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('project') }}">Proyek</a></div>
                    <div class="breadcrumb-item">{{ $project->name }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $project->name }}</h2>
                <p class="section-lead">Lihat detail proyek beserta progressnya.</p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Ketua Proyek: {{ $project->creator->profile->full_name ?? $project->creator->email }}</h4>
                                <h5>Progress: {{ number_format($progressPercentage, 2) }}%</h5>

                                <h5>Daftar Pekerjaan:</h5>
                                <ul>
                                    @foreach (json_decode($project->list_job) as $index => $job)
                                        <li>
                                            {{ $job }} -
                                            @php
                                                $isCompleted = $project->progress->where('job_index', $index)->where('is_completed', true)->first();
                                            @endphp
                                            <strong>{{ $isCompleted ? 'Selesai' : 'Belum Selesai' }}</strong>
                                        </li>
                                    @endforeach
                                </ul>

                                <h5>Anggota Proyek:</h5>
                                <ul>
                                    @foreach ($project->members as $member)
                                        <li>{{ $member->profile->full_name ?? $member->email }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('project') }}" class="btn btn-secondary">Kembali ke Daftar Proyek</a>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
