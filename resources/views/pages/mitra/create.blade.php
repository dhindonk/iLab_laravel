@extends('layouts.app')

@section('title', 'Create Mitra')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Mitra</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('mitras.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Mitra Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter mitra name" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Mitra Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Mitra</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
