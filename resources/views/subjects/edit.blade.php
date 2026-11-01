@extends('layouts.app', ['title' => 'Edit Subject - ' . $subject->name])

@section('content')
<style>
  .portal-page-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 32px 20px 60px;
  }

  /* Header Card */
  .portal-header-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    padding: 22px 28px;
    box-shadow: 0 10px 28px -6px rgba(26, 61, 46, 0.08);
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
  }
  .portal-header-card h1 {
    font-size: 24px;
    font-weight: 800;
    color: #1a4d36;
    margin: 0 0 4px;
  }
  .portal-header-card p {
    font-size: 13.5px;
    color: #4b6a5a;
    margin: 0;
  }

  /* Back Button */
  .btn-portal-back {
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    color: #1e5a40;
    font-size: 13.5px;
    font-weight: 700;
    padding: 8px 18px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .btn-portal-back:hover {
    background: #e9f5ee;
    color: #14442f;
    border-color: #2f855a;
  }

  /* Form Container */
  .portal-form-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 22px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 14px 34px -8px rgba(26, 61, 46, 0.1);
    padding: 32px 30px;
  }

  /* Form Labels & Controls */
  .portal-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #23503b;
    margin-bottom: 6px;
    display: block;
  }

  .portal-input {
    width: 100%;
    height: 44px;
    padding: 8px 14px;
    font-size: 13.5px;
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    border-radius: 10px;
    color: #1a3d2e;
    transition: all 0.2s ease;
  }

  .portal-textarea {
    width: 100%;
    padding: 10px 14px;
    font-size: 13.5px;
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    border-radius: 10px;
    color: #1a3d2e;
    transition: all 0.2s ease;
    resize: vertical;
  }

  .portal-input:focus,
  .portal-textarea:focus {
    outline: none;
    border-color: #2f855a;
    box-shadow: 0 0 0 3px rgba(47, 133, 90, 0.18);
  }

  .portal-input.is-invalid,
  .portal-textarea.is-invalid {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
  }

  .subject-id-badge {
    background: #eaf3ee;
    color: #1b5337;
    font-size: 11.5px;
    font-weight: 700;
    font-family: monospace;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #cce5d7;
  }

  /* Buttons */
  .btn-portal-submit {
    height: 46px;
    padding: 0 24px;
    background: #2b7447;
    color: #ffffff !important;
    font-size: 14px;
    font-weight: 700;
    border-radius: 10px;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(43, 116, 71, 0.28);
    transition: all 0.2s ease;
    cursor: pointer;
  }
  .btn-portal-submit:hover {
    background: #235e3a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(43, 116, 71, 0.35);
  }

  .btn-portal-cancel {
    height: 46px;
    padding: 0 20px;
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    color: #23583f;
    font-size: 14px;
    font-weight: 600;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .btn-portal-cancel:hover {
    background: #eaf5ee;
    border-color: #2f855a;
    color: #14442f;
  }
</style>

<div class="portal-page-container">
  <!-- Top Navigation Header -->
  <div class="portal-header-card">
    <div>
      <div style="font-size: 11px; font-weight: 800; color: #2d6a4f; text-transform: uppercase; letter-spacing: 0.6px;">
        University • Curriculum Management
      </div>
      <h1>Edit Subject</h1>
      <p>Update course details and curriculum description.</p>
    </div>

    <div class="d-flex align-items-center gap-2">
      <span class="subject-id-badge">ID: #{{ $subject->id }}</span>
      <a class="btn-portal-back" href="{{ route('subjects.index') }}">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Subjects</span>
      </a>
    </div>
  </div>

  <!-- Form Container -->
  <div class="portal-form-card">
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-size: 13.5px;">
        <ul class="mb-0 ps-3">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="{{ route('subjects.update', $subject) }}" method="POST">
      @csrf
      @method('PUT')

      <!-- Subject Name -->
      <div class="mb-3">
        <label for="name" class="portal-label">
          Subject Name <span class="text-danger">*</span>
        </label>
        <input
          type="text"
          name="name"
          id="name"
          class="portal-input @error('name') is-invalid @enderror"
          value="{{ old('name', $subject->name) }}"
          placeholder="e.g., Mathematics 101"
          required
        >
        @error('name')
          <div class="text-danger small mt-1 font-weight-bold">{{ $message }}</div>
        @enderror
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label for="description" class="portal-label">
          Description <span class="text-muted fw-normal text-lowercase">(optional)</span>
        </label>
        <textarea
          name="description"
          id="description"
          class="portal-textarea @error('description') is-invalid @enderror"
          rows="4"
          placeholder="Provide a short overview of the subject curriculum..."
        >{{ old('description', $subject->description) }}</textarea>
        @error('description')
          <div class="text-danger small mt-1 font-weight-bold">{{ $message }}</div>
        @enderror
      </div>

      <!-- Action Footer -->
      <div class="d-flex align-items-center gap-2 pt-2 border-top" style="border-color: #e3eee7 !important;">
        <button type="submit" class="btn-portal-submit">
          <i class="bi bi-check2-circle fs-5"></i>
          <span>Save Changes</span>
        </button>
        <a href="{{ route('subjects.index') }}" class="btn-portal-cancel">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection