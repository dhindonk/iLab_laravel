@extends('layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">Banner</h2>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="card-text">You can manage all banners, such as editing, deleting, and more.</p>
                        <a href="{{ route('banners.create') }}" class="btn btn-primary">Add New Banner</a>
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
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($banners as $banner)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $banner->name }}</td>
                                                    <td><img src="{{ asset('images/banners/' . $banner->image) }}"
                                                            alt="{{ $banner->name }}" width="100"></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href='{{ route('banners.edit', $banner->id) }}'
                                                                class="btn btn-sm btn-dark btn-icon mr-1">
                                                                <i class="fe fe-edit"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $banner->id }}"
                                                                action="{{ route('banners.destroy', $banner->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-sm btn-dark btn-icon"
                                                                    onclick="confirmDelete({{ $banner->id }})">
                                                                    <i class="fe fe-trash-2"></i>
                                                                </button>
                                                            </form>
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
                        targets: [2, 3]
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

        function confirmDelete(bannerId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + bannerId).submit();
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
