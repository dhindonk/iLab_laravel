@extends('baru.layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">Project</h2>
                    <p class="card-text">Kelola semua proyek dan lihat progressnya.                    </p>
                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Nama Proyek</th>
                                                <th>Ketua Proyek</th>
                                                <th>Progress (%)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projects as $project)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $project->name }}</td>
                                                <td>{{ $project->creator->full_name }}</td>
                                                <td>                                                    @php
                                                    $totalJobs = count(json_decode($project->list_job));
                                                    $completedJobs = $project->progress
                                                        ->where('is_completed', true)
                                                        ->count();
                                                    $progress =
                                                        $totalJobs > 0 ? ($completedJobs / $totalJobs) * 100 : 0;
                                                @endphp
                                                {{ number_format($progress, 2) }}%</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('view.project', $project->id) }}' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-eye"></i>
                                                        </a>
                                                        <form action="{{ route('del_project', $project->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-dark btn-icon" type="submit">
                                                                <i class="fe fe-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- simple table -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main>
@endsection
