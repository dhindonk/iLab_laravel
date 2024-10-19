@extends('baru.layouts.main')
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
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Verified</th>
                                                <th>Verified</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mitras as $mitra)

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $mitra->image }}</td>
                                                <td> <img src="{{ asset('images/mitras/'. $mitra->image) }}" alt="{{ $mitra->name }}" width="100"></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('mitras.edit', $mitra->id) }}' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <form action="{{ route('mitras.destroy', $mitra->id) }}" method="POST" class="d-inline" id="delete-form-{{ $mitra->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-dark btn-icon" type="button" onclick="confirmDelete({{ $mitra->id }})">
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
                        </div> <!-- simple table -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main>
    @push('script')
    <script>
        function confirmDelete(mitraId) {
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
                    // Submit the form if the user confirms
                    document.getElementById('delete-form-' + mitraId).submit();
                }
            });
        }
    </script>
    @endpush
@endsection
