@extends('layouts.app', ['title' => 'Edit Student - ' . $student->name])

@section('content')
<style>
  .portal-page-container {
    max-width: 1000px;
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

  /* Container wrapper for the included partial form */
  .portal-form-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 22px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 14px 34px -8px rgba(26, 61, 46, 0.1);
    padding: 32px 30px;
  }

  /* Shared field styling so included form controls inherit the theme */
  .portal-form-card .form-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #23503b;
    margin-bottom: 6px;
  }

  .portal-form-card .form-control,
  .portal-form-card .form-select {
    height: 44px;
    border-radius: 10px;
    border: 1.5px solid #a8cbb8;
    font-size: 13.5px;
    color: #1a3d2e;
    background-color: #ffffff;
    transition: all 0.2s ease;
  }

  .portal-form-card textarea.form-control {
    height: auto;
    min-height: 90px;
  }

  .portal-form-card .form-control:focus,
  .portal-form-card .form-select:focus {
    border-color: #2f855a;
    box-shadow: 0 0 0 3px rgba(47, 133, 90, 0.18);
    outline: none;
  }

  .portal-form-card .btn-primary {
    background: #2b7447;
    border-color: #2b7447;
    color: #ffffff;
    font-weight: 700;
    font-size: 14px;
    border-radius: 10px;
    padding: 10px 24px;
    box-shadow: 0 4px 14px rgba(43, 116, 71, 0.28);
    transition: all 0.2s ease;
  }

  .portal-form-card .btn-primary:hover {
    background: #235e3a;
    border-color: #235e3a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(43, 116, 71, 0.35);
  }

  .portal-form-card .btn-secondary,
  .portal-form-card .btn-outline-secondary {
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    color: #2e6047;
    font-weight: 600;
    font-size: 14px;
    border-radius: 10px;
    padding: 10px 20px;
    transition: all 0.2s ease;
  }

  .portal-form-card .btn-secondary:hover,
  .portal-form-card .btn-outline-secondary:hover {
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
        University • Student Records
      </div>
      <h1>Edit Student</h1>
      <p>Updating profile and enrollment details for <strong>{{ $student->name }}</strong>.</p>
    </div>

    <a class="btn-portal-back" href="{{ route('students.show', $student) }}">
      <i class="bi bi-arrow-left"></i>
      <span>Back to Profile</span>
    </a>
  </div>

  <!-- Form Content Area -->
  <div class="portal-form-card">
    @include('students.partials.form', [
        'action' => route('students.update', $student),
        'student' => $student,
        'submitLabel' => 'Save changes'
    ])
  </div>
</div>
@endsection