@extends('layouts.main')

@section('title', 'Projects')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Mitra</h2>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <p class="card-text">You can manage all mitra, such as editing, deleting, and more.                        </p>
                    <a href="{{ route('mitras.create') }}" class="btn btn-primary">Add Ner Banner</a>
                </div>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>Nama Project</th>
                                                <th>Project Manager</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Jumlah Job</th>
                                                <th>Jumlah Member</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($projects as $project)
                                                <tr>
                                                    <td>{{ $project->name }}</td>
                                                    <td>{{ $project->creator->email }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}</td>
                                                    <td>{{ count(json_decode($project->list_job)) }}</td>
                                                    <td>{{ $project->members->count() }}</td>
                                                    <td>
                                                        <a href="{{ route('project.show', $project->id) }}"
                                                           class="btn btn-info btn-sm">
                                                            Detail
                                                        </a>
                                                        @if(auth()->user()->id === $project->user_id)
                                                            <form action="{{ route('project.destroy', $project->id) }}"
                                                                  method="POST"
                                                                  class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- simple table -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
