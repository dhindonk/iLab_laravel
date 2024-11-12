@extends('layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">Banner</h2>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="card-text">You can manage all banners, such as editing, deleting, and more.
                        </p>
                        <a href="{{ route('banners.create') }}" class="btn btn-primary" >Add Ner Banner</a>
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
                                            @foreach ($banners as $banner )
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $banner->name }}</td>
                                                <td><img src="{{ asset('images/banners/'. $banner->image) }}" alt="{{ $banner->name }}" width="100"></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('banners.edit', $banner->id) }}' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $banner->id }}" action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-dark btn-icon" onclick="confirmDelete({{ $banner->id }})">
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
        <div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="varyModalLabel">New message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Banner Name:</label>
                      <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Upload Banner Image:</label>
                      <input type="file" class="form-control" id="recipient-name">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn mb-2 btn-primary">Create Banner</button>
                </div>
              </div>
            </div>
          </div>
    </main>

    @push('script')
    <script>
        function confirmDelete(bannerId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + bannerId).submit(); // Kirim form secara manual
                }
            })
        }
    </script>

    @endpush
@endsection
