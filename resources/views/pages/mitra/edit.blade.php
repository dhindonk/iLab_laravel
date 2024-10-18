@extends('baru.layouts.main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Mitra</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('mitras.update', $mitra->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Mitra Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $mitra->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Mitra Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <small>Leave blank if you don't want to change the image</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Mitra</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
