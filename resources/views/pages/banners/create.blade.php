@extends('baru.layouts.main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Banner</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Banner Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter banner name" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Banner Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Banner</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
