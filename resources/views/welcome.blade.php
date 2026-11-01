@extends('layouts.app', ['title' => 'Student Portal'])

@section('content')
    <div class="card app-card text-center mx-auto" style="max-width: 700px"><div class="card-body p-5">
        <h1 class="display-6 fw-bold">Student Portal</h1>
        <p class="lead text-secondary my-4">A simple, secure place to manage and view student records.</p>
        @auth
            <a class="btn btn-primary" href="{{ route('dashboard') }}">Go to dashboard</a>
        @else
            <a class="btn btn-primary me-2" href="{{ route('login') }}">Sign in</a>
            <a class="btn btn-outline-primary" href="{{ route('register') }}">Create account</a>
        @endauth
    </div></div>
@endsection
