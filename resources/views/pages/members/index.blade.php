@extends('baru.layouts.main')
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
                                                <td>@if ($user->profile->image)
                                                    <img src="{{ asset('images/foto_profile/' . $user->profile->image) }}"
                                                        alt="Profile Image" width="50">
                                                @else
                                                    <img src="https://www.shutterstock.com/image-vector/vector-flat-illustration-grayscale-avatar-600nw-2264922221.jpg"
                                                        alt="Default Profile Image" width="50">
                                                @endif</td>
                                                <td>{{ $user->profile->full_name ?? 'Tidak ada nama lengkap' }}</td>
                                                <td> {{ $user->email }}</td>
                                                <td>{{ $user->profile->university_name ?? 'Tidak ada universitas' }}</td>
                                                <td>
                                                    @if ($user->verify)
                                                        <span class="badge badge-success">✓ Verified</span>
                                                    @else
                                                        <span class="badge badge-danger">✗ Not Verified</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('members.edit', $user->id) }}"
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        @if ($user->role == 'admin')
                                                        @else
                                                            <form action="{{ route('members.verify', $user->id) }}"
                                                                method="POST" class="ml-2"
                                                                onsubmit="return confirm('Izinkan verify??');">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    class="btn btn-sm {{ $user->verify ? 'btn-warning' : 'btn-success' }} btn-icon">
                                                                    <i
                                                                        class="fe {{ $user->verify ? 'fe-x' : 'fe-check' }}"></i>
                                                                    {{ $user->verify ? '' : '' }}
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('members.destroy', $user->id) }}" method="POST" class="ml-2" id="delete-form-{{ $user->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon" type="button" onclick="confirmDelete({{ $user->id }})">
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
                        </div> <!-- simple table -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main>
@push('script')
<script>
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
                // Submit the form if the user confirms
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>

@endpush
@endsection
