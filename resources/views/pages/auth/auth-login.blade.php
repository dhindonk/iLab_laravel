@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}" class="text-center">
    @csrf
    <h1 class="h3 mb-3">Sign in</h1>
    
    <div class="form-group">
        <label for="email" class="sr-only">Email address</label>
        <input type="email" id="email" name="email" 
               class="form-control form-control-lg @error('email') is-invalid @enderror" 
               placeholder="Email address" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" 
               class="form-control form-control-lg @error('password') is-invalid @enderror" 
               placeholder="Password" required>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Let me in</button>
</form>
@endsection
