@extends('layouts.app')

@section('title', 'Daftar Proyek')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Proyek</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Proyek</a></div>
                    <div class="breadcrumb-item">Semua Proyek</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Proyek</h2>
                <p class="section-lead">Kelola semua proyek dan lihat progressnya.</p>

                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Nama Proyek</th>
                                            <th>Ketua Proyek</th>
                                            <th>Progress (%)</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($projects as $project)
                                            <tr>
                                                <td>{{ $project->name }}</td>
                                                <td>{{ $project->creator->full_name }}</td>
                                                <td>
                                                    @php
                                                        $totalJobs = count(json_decode($project->list_job));
                                                        $completedJobs = $project->progress
                                                            ->where('is_completed', true)
                                                            ->count();
                                                        $progress =
                                                            $totalJobs > 0 ? ($completedJobs / $totalJobs) * 100 : 0;
                                                    @endphp
                                                    {{ number_format($progress, 2) }}%
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <a href="{{ route('view.project', $project->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('del_project', $project->id) }}"
                                                            method="POST" class="ml-2"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon" type="submit">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
