@extends('baru.layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="row align-items-center my-4">
                        <div class="col">
                            <h2 class="h3 mb-0 page-title">Create New Member</h2>
                        </div>
                    </div>
                    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <hr class="my-4">
                        <h5 class="mb-2 mt-4">Member Information</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-4">
                        <h5 class="mb-2 mt-4">Personal Data</h5>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="firstname">Full Name</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    name="full_name" value="{{ old('full_name') }}">
                                @error('full_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastname">Profile Picture</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Gender</label>
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
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPhone">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    name="status" value="{{ old('status') }}">
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Residential Address</label>
                                <input type="text"
                                    class="form-control @error('residential_address') is-invalid @enderror"
                                    name="residential_address" value="{{ old('residential_address') }}">
                                @error('residential_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Student Identity Number (Optional)</label>
                                <input type="text"
                                    class="form-control @error('student_identity_number') is-invalid @enderror"
                                    name="student_identity_number" value="{{ old('student_identity_number') }}">
                                @error('student_identity_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPhone">Country of Origin</label>
                                <input type="text" class="form-control @error('country_of_origin') is-invalid @enderror"
                                    name="country_of_origin" value="{{ old('country_of_origin') }}">
                                @error('country_of_origin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-4">
                        <h5 class="mb-2 mt-4">Company</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname">University Name</label>
                                <input type="text" class="form-control @error('university_name') is-invalid @enderror"
                                    name="university_name" value="{{ old('university_name') }}">
                                @error('university_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Affiliate/Department</label>
                                <input type="text" class="form-control @error('affiliate') is-invalid @enderror"
                                    name="affiliate" value="{{ old('affiliate') }}">
                                @error('affiliate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname">University Address</label>
                                <input type="text"
                                    class="form-control @error('university_address') is-invalid @enderror"
                                    name="university_address" value="{{ old('university_address') }}">
                                @error('university_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Country of Origin</label>
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
                        <hr class="my-4">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="">Pastikan Semua Form Sudah Di Isi Dengan Benar</label>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main>
@endsection
