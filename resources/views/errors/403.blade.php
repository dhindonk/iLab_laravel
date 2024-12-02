@extends('layouts.auth')

@section('title', '403 Unauthorized')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Access Denied</h4>
    </div>

    <div class="card-body">
        <div class="alert alert-danger">
            Sorry, you don't have permission to access this page. This area is restricted to admin users only.
        </div>
        {{-- form logout --}}
        <div class="text-center mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Back to Login</button>
            </form>
        </div>
    </div>
</div>
@endsection 