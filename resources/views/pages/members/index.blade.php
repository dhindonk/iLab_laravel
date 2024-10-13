@extends('layouts.app')

@section('title', 'Members')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Members</h1>
                <div class="section-header-button">
                    <a href="{{ route('members.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Members</a></div>
                    <div class="breadcrumb-item">All Members</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Members</h2>
                <p class="section-lead">
                    You can manage all Members, such as editing, deleting and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-left">
                                    <form method="GET" action="">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search by Email" name="email">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Foto Profile</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            {{-- <th>Phone</th> --}}
                                            <th>University Name</th>
                                            <th>Verified</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($members as $user)
                                            <tr>
                                                <td>
                                                    @if ($user->profile->image)
                                                        <img src="{{ asset('images/foto_profile/' . $user->profile->image) }}"
                                                            alt="Profile Image" width="50">
                                                    @else
                                                        <img src="https://www.shutterstock.com/image-vector/vector-flat-illustration-grayscale-avatar-600nw-2264922221.jpg"
                                                            alt="Default Profile Image" width="50">
                                                    @endif
                                                </td>
                                                <td>{{ $user->profile->full_name ?? 'Tidak ada nama lengkap' }}</td>
                                                <td>{{ $user->email }}</td>
                                                {{-- <td>{{ $user->profile->phone ?? 'Tidak ada nomor telepon' }}</td> --}}
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
                                                            <i class="fas fa-edit"></i>
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
                                                                        class="fas {{ $user->verify ? 'fa-times' : 'fa-check' }}"></i>
                                                                    {{ $user->verify ? '' : '' }}
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('members.destroy', $user->id) }}"
                                                                method="POST" class="ml-2"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon"
                                                                    type="submit">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $members->withQueryString()->links() }}
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
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
