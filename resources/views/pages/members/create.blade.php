@extends('layouts.app')

@section('title', 'Update Member')

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
                <h1>Update Member</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Members</a></div>
                    <div class="breadcrumb-item">Update</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Update Member & Profile</h2>
                <div class="card">
                    <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-header mb-0 mt-0 pb-0 pt-0">
                            <h4>Member Information</h4>
                        </div>

                        <div class="card-body mb-0 mt-0 pb-0 pt-0">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $member->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password (leave blank to keep current password)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-header mb-0 mt-0 pb-0 pt-0">
                            <h4>Personal Data</h4>
                        </div>

                        <div class="card-body mb-0 mt-0 pb-0 pt-0">
                            <div class="form-group">
                                <label>Profile Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                                @if ($member->profile->image)
                                    <img src="{{ asset('storage/foto_profile/' . $member->profile->image) }}"
                                        alt="Profile Image" class="mt-2" width="150">
                                @endif
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    name="full_name" value="{{ old('full_name', $member->profile->full_name) }}">
                                @error('full_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option value="male"
                                        {{ old('gender', $member->profile->gender) == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female"
                                        {{ old('gender', $member->profile->gender) == 'female' ? 'selected' : '' }}>Female
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
                                    name="phone" value="{{ old('phone', $member->profile->phone) }}">
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
                                    name="residential_address"
                                    value="{{ old('residential_address', $member->profile->residential_address) }}">
                                @error('residential_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    name="status" value="{{ old('status', $member->profile->status) }}">
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
                                    name="student_identity_number"
                                    value="{{ old('student_identity_number', $member->profile->student_identity_number) }}">
                                @error('student_identity_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Country of Origin</label>
                                <input type="text" class="form-control @error('country_of_origin') is-invalid @enderror"
                                    name="country_of_origin"
                                    value="{{ old('country_of_origin', $member->profile->country_of_origin) }}">
                                @error('country_of_origin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-header mb-0 mt-0 pb-0 pt-0">
                            <h4>University Information</h4>
                        </div>

                        <div class="card-body mb-0 mt-0 pb-0 pt-0">
                            <div class="form-group">
                                <label>University Name</label>
                                <input type="text" class="form-control @error('university_name') is-invalid @enderror"
                                    name="university_name"
                                    value="{{ old('university_name', $member->profile->university_name) }}">
                                @error('university_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Affiliate/Department</label>
                                <input type="text" class="form-control @error('affiliate') is-invalid @enderror"
                                    name="affiliate" value="{{ old('affiliate', $member->profile->affiliate) }}">
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
                                    name="university_address"
                                    value="{{ old('university_address', $member->profile->university_address) }}">
                                @error('university_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>University Country</label>
                                <input type="text"
                                    class="form-control @error('university_country') is-invalid @enderror"
                                    name="university_country"
                                    value="{{ old('university_country', $member->profile->university_country) }}">
                                @error('university_country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

