@extends('layouts.app', ['title' => 'Create Subject'])

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow-sm rounded-3">
                <!-- Card Header -->
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h4 class="card-title mb-1 fw-bold text-dark">Add Subject</h4>
                    <p class="text-secondary small mb-0">Create a new course subject for student enrollment.</p>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <ul class="mb-0 ps-3 small">
                                
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('subjects.store') }}" method="POST">
                        @csrf

                        <!-- Subject Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-dark small">
                                Subject Name <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="e.g., Mathematics"
                                value="{{ old('name') }}"
                                required
                                autofocus
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark small">
                                Description <span class="text-muted fw-normal">(Optional)</span>
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="4"
                                placeholder="Provide a short overview of the subject curriculum..."
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="d-flex align-items-center gap-2 pt-2 border-top">
                            <button type="submit" class="btn btn-primary px-4">
                                Create Subject
                            </button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary px-3">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection