@extends('layouts.main')

@section('title', 'Projects')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">Projects</h2>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="card-text">Manage and monitor all ongoing projects</p>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Project Manager</th>
                                                <th>Duration</th>
                                                <th>Progress</th>
                                                <th>Team</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projects as $project)
                                                @php
                                                    $startDate = \Carbon\Carbon::parse($project->start_date);
                                                    $endDate = \Carbon\Carbon::parse($project->end_date);
                                                    $now = \Carbon\Carbon::now();
                                                    $statusClass =
                                                        $project->status === 'Pending'
                                                            ? 'warning'
                                                            : ($project->status === 'Completed'
                                                                ? 'success'
                                                                : 'info');
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <p class="mb-0 font-weight-bold">{{ $project->name }}</p>
                                                        <small
                                                            class="text-muted">{{ Str::limit($project->description, 50) }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($project->creator->profile)
                                                                <img src="{{ asset('images/foto_profile/' . $project->creator->profile->image) }}"
                                                                    class="avatar-sm rounded-circle mr-2" alt="PM Photo">
                                                            @else
                                                                <img src="{{ asset('images/foto_profile/male.png') }}"
                                                                    class="avatar-sm rounded-circle mr-2" alt="PM Photo">
                                                            @endif
                                                            <div>
                                                                <p class="mb-0">
                                                                    {{ $project->creator->profile->full_name ?? $project->creator->email }}
                                                                </p>
                                                                <small class="text-muted">Project Manager</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">{{ $startDate->format('d M Y') }}</p>
                                                        <small class="text-muted">to {{ $endDate->format('d M Y') }}</small>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $totalJobs = count(json_decode($project->list_job));
                                                            $completedJobs = $project
                                                                ->progress()
                                                                ->where('is_completed', true)
                                                                ->count();
                                                            $progressPercentage =
                                                                $totalJobs > 0
                                                                    ? ($completedJobs / $totalJobs) * 100
                                                                    : 0;
                                                        @endphp
                                                        <div class="progress" style="height: 6px;">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: {{ $progressPercentage }}%"
                                                                aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                        <small
                                                            class="text-muted">{{ number_format($progressPercentage, 0) }}%
                                                            Complete</small>
                                                    </td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            @foreach ($project->members->take(3) as $member)
                                                                <img src="{{ asset('images/foto_profile/' . ($member->profile->image ?? 'male.png')) }}"
                                                                    class="avatar-sm rounded-circle" data-toggle="tooltip"
                                                                    title="{{ $member->profile->full_name ?? $member->email }}">
                                                            @endforeach
                                                            @if ($project->members->count() > 3)
                                                                <span
                                                                    class="avatar-sm rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                                    data-toggle="tooltip"
                                                                    title="{{ $project->members->count() - 3 }} more members">
                                                                    +{{ $project->members->count() - 3 }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $statusClass }}">{{ $project->status }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm dropdown-toggle more-vertical"
                                                                type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('project.show', $project->id) }}">
                                                                    <i class="fe fe-eye fe-16 mr-2"></i> View Details
                                                                </a>
                                                                <form action="{{ route('project.destroy', $project->id) }}"
                                                                    method="POST" id="delete-form-{{ $project->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="dropdown-item text-danger"
                                                                        onclick="confirmDelete({{ $project->id }})">
                                                                        <i class="fe fe-trash-2 fe-16 mr-2"></i> Delete
                                                                        Project
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
            width: 32px;
            height: 32px;
            object-fit: cover;
        }

        .avatar-group {
            display: flex;
            align-items: center;
        }

        .avatar-group .avatar-sm {
            margin-left: -8px;
            border: 2px solid #fff;
        }

        .avatar-group .avatar-sm:first-child {
            margin-left: 0;
        }

        .more-vertical {
            padding: 0.25rem 0.5rem;
        }

        .more-vertical:after {
            content: '\2807';
            font-size: 1.2rem;
        }

        .progress {
            background-color: #edf2f9;
        }

        .dropdown-menu {
            font-size: 0.875rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Initialize DataTable
            if ($.fn.DataTable.isDataTable('#dataTable-1')) {
                $('#dataTable-1').DataTable().destroy();
            }

            $('#dataTable-1').DataTable({
                processing: true,
                serverSide: false,
                paging: true,
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [4, 6]
                }],
                language: {
                    paginate: {
                        previous: "<i class='fe fe-arrow-left'></i>",
                        next: "<i class='fe fe-arrow-right'></i>"
                    }
                },
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-separated');
                }
            });
        });

        function confirmDelete(projectId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the project and all associated data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + projectId).submit();
                }
            });
        }
    </script>
@endpush
