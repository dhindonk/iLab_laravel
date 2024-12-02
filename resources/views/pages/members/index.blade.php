@extends('layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Members</h2>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="card-text">You can manage all Members, such as editing, deleting and more.</p>
                        <a href="{{ route('members.create') }}" class="btn btn-primary">Add New</a>
                    </div>

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
                                                <th>Foto Profile</th>
                                                <th>Fullname</th>
                                                <th>Email</th>
                                                <th>University Name</th>
                                                <th>Verified</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($members as $user)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        @if ($user->profile && $user->profile->image)
                                                            <img src="{{ asset('images/foto_profile/' . $user->profile->image) }}"
                                                                alt="Profile Image" width="50">
                                                        @else
                                                            <img src="{{ asset('images/foto_profile/female.png') }}"
                                                                alt="Default Profile Image" width="50">
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->profile->full_name ?? 'Profile Not Set' }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->profile->university_name ?? 'Not Set' }}</td>
                                                    <td>
                                                        @if ($user->verify)
                                                            <span class="badge badge-success">✓ Verified</span>
                                                        @else
                                                            <span class="badge badge-danger">✗ Not Verified</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            @if ($user->profile)
                                                                <a href="{{ route('members.edit', $user->id) }}"
                                                                    class="btn btn-sm btn-info btn-icon">
                                                                    <i class="fe fe-edit"></i>
                                                                </a>
                                                            @endif

                                                            @if ($user->role != 'admin')
                                                                <form action="{{ route('members.verify', $user->id) }}"
                                                                    method="POST" class="ml-2" id="verify-form-{{ $user->id }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="button"
                                                                        class="btn btn-sm {{ $user->verify ? 'btn-warning' : 'btn-success' }} btn-icon"
                                                                        onclick="confirmVerify({{ $user->id }})">
                                                                        <i
                                                                            class="fe {{ $user->verify ? 'fe-x' : 'fe-check' }}"></i>
                                                                    </button>
                                                                </form>

                                                                <form action="{{ route('members.destroy', $user->id) }}"
                                                                    method="POST" class="ml-2"
                                                                    id="delete-form-{{ $user->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-sm btn-danger btn-icon"
                                                                        type="button"
                                                                        onclick="confirmDelete({{ $user->id }})">
                                                                        <i class="fe fe-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
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

@push('script')
    <script>
        $(document).ready(function() {
            // Destroy existing DataTable instance if it exists
            if ($.fn.DataTable.isDataTable('#dataTable-1')) {
                $('#dataTable-1').DataTable().destroy();
            }

            // Initialize new DataTable
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
                        targets: [1, 6]
                    } // Disable sorting for image and action columns
                ],
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

        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }

        function confirmVerify(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change the verification status!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('verify-form-' + userId).submit();
                }
            });
        }
    </script>
@endpush

@push('style')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em 1em;
            margin: 0;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #6D0077;
            color: white !important;
            border: 1px solid #6D0077;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f8f9fa;
            color: #6D0077 !important;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0.5em;
            padding: 0.375rem 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
    </style>
@endpush
