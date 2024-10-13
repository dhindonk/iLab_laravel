@extends('layouts.app')

@section('title', 'Create New Member')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create New Member</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Members</a></div>
                    <div class="breadcrumb-item">Create</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create Member & Profile</h2>

                <div class="card">
                    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Member Information</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-header">
                            <h4>Personal Data</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>Profile Picture</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    name="full_name" value="{{ old('full_name') }}">
                                @error('full_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Residential Address</label>
                                <input type="text"
                                    class="form-control @error('residential_address') is-invalid @enderror"
                                    name="residential_address" value="{{ old('residential_address') }}">
                                @error('residential_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    name="status" value="{{ old('status') }}">
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Student Identity Number (Optional)</label>
                                <input type="text"
                                    class="form-control @error('student_identity_number') is-invalid @enderror"
                                    name="student_identity_number" value="{{ old('student_identity_number') }}">
                                @error('student_identity_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Country of Origin</label>
                                <input type="text" class="form-control @error('country_of_origin') is-invalid @enderror"
                                    name="country_of_origin" value="{{ old('country_of_origin') }}">
                                @error('country_of_origin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-header">
                            <h4>University Information</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>University Name</label>
                                <input type="text" class="form-control @error('university_name') is-invalid @enderror"
                                    name="university_name" value="{{ old('university_name') }}">
                                @error('university_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Affiliate/Department</label>
                                <input type="text" class="form-control @error('affiliate') is-invalid @enderror"
                                    name="affiliate" value="{{ old('affiliate') }}">
                                @error('affiliate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>University Address</label>
                                <input type="text"
                                    class="form-control @error('university_address') is-invalid @enderror"
                                    name="university_address" value="{{ old('university_address') }}">
                                @error('university_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Country of Origin</label>
                                <input type="text"
                                    class="form-control @error('university_country') is-invalid @enderror"
                                    name="university_country" value="{{ old('university_country') }}">
                                @error('university_country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
