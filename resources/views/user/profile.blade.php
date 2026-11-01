@extends('layouts.app', ['title' => 'My Profile'])

@section('content')
<style>
  .portal-profile-container {
    max-width: 1050px;
    margin: 0 auto;
    padding: 32px 20px 60px;
  }

  /* Header Card */
  .profile-header-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    padding: 20px 28px;
    box-shadow: 0 10px 28px -6px rgba(26, 61, 46, 0.08);
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
  }

  .btn-portal-edit {
    background: #2b7447;
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 700;
    padding: 9px 20px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(43, 116, 71, 0.28);
    transition: all 0.2s ease;
  }
  .btn-portal-edit:hover {
    background: #235e3a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(43, 116, 71, 0.35);
  }

  /* Main Card */
  .profile-main-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    padding: 36px 32px;
    box-shadow: 0 16px 36px -8px rgba(26, 61, 46, 0.12);
  }

  /* Avatar & Header Section */
  .avatar-hero-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding-bottom: 26px;
    border-bottom: 1px solid #e3eee7;
    margin-bottom: 28px;
  }

  .profile-avatar-img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3.5px solid #40916c;
    box-shadow: 0 8px 22px rgba(27, 83, 55, 0.2);
  }

  .student-title-badge h2 {
    font-size: 24px;
    font-weight: 800;
    color: #1a3d2e;
    margin: 14px 0 4px 0;
  }

  .student-subtitle {
    font-size: 13.5px;
    color: #4b6a5a;
    font-weight: 600;
  }

  .btn-download-photo {
    font-size: 12px;
    font-weight: 700;
    color: #1e5a40;
    background: #eef7f2;
    border: 1.5px solid #a8cbb8;
    border-radius: 8px;
    padding: 5px 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 10px;
    transition: 0.2s ease;
  }
  .btn-download-photo:hover {
    background: #e1f2e8;
    color: #14442f;
    border-color: #2f855a;
  }

  /* Document Management Box */
  .doc-manager-box {
    background: #f7fbf9;
    border: 1.5px solid #c9e4d5;
    border-radius: 16px;
    padding: 20px 24px;
    margin-bottom: 30px;
  }

  .doc-manager-title {
    font-size: 15px;
    font-weight: 800;
    color: #1b5337;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .portal-file-input {
    height: 42px;
    border-radius: 10px;
    border: 1.5px solid #a8cbb8;
    font-size: 13px;
    background-color: #ffffff;
    color: #1a3d2e;
  }
  .portal-file-input:focus {
    border-color: #2f855a;
    box-shadow: 0 0 0 3px rgba(47, 133, 90, 0.18);
  }

  .btn-doc-download {
    font-size: 12px;
    font-weight: 700;
    color: #1e5a40;
    background: #ffffff;
    border: 1px solid #a8cbb8;
    border-radius: 8px;
    padding: 6px 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: 0.2s ease;
  }
  .btn-doc-download:hover {
    background: #eaf5ee;
    color: #123e2b;
  }

  .btn-doc-remove {
    font-size: 12px;
    font-weight: 700;
    color: #b91c1c;
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 6px 14px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: 0.2s ease;
  }
  .btn-doc-remove:hover {
    background: #fee2e2;
    color: #991b1b;
  }

  .btn-portal-upload {
    height: 42px;
    background: #2b7447;
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 700;
    border-radius: 10px;
    border: none;
    padding: 0 20px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 12px rgba(43, 116, 71, 0.25);
    transition: all 0.2s ease;
  }
  .btn-portal-upload:hover {
    background: #235e3a;
  }

  /* Details Grid */
  .detail-box {
    background: #ffffff;
    border: 1px solid #d2e7dc;
    border-radius: 14px;
    padding: 16px 20px;
    height: 100%;
    transition: transform 0.15s ease, border-color 0.15s ease;
  }
  .detail-box:hover {
    border-color: #74c69d;
    box-shadow: 0 4px 12px rgba(45, 106, 79, 0.05);
  }

  .detail-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #2d6a4f;
    margin-bottom: 6px;
  }

  .detail-content {
    font-size: 15px;
    font-weight: 700;
    color: #1a3d2e;
    word-break: break-word;
  }

  /* Assigned Subjects Box */
  .subjects-section-card {
    background: #f4faf6;
    border: 1.5px solid #d6ece0;
    border-radius: 16px;
    padding: 22px 24px;
    margin-top: 26px;
  }

  .subject-pill-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    color: #1e5a40;
    font-size: 13px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 999px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    margin-right: 8px;
    margin-bottom: 8px;
  }
</style>

<div class="portal-profile-container">
  <!-- Top Navigation Header -->
  <div class="profile-header-card">
    <div>
      <div style="font-size: 11px; font-weight: 800; color: #2d6a4f; text-transform: uppercase; letter-spacing: 0.6px;">
        University • Student Portal
      </div>
      <h1 style="font-size: 24px; font-weight: 800; color: #1a4d36; margin: 2px 0 0 0;">My Profile</h1>
      <p style="font-size: 13.5px; color: #4b6a5a; margin: 0;">Your personal student record and academic information.</p>
    </div>

    <a class="btn-portal-edit" href="{{ route('profile.edit') }}">
      <i class="bi bi-pencil-square"></i>
      <span>Edit My Profile</span>
    </a>
  </div>

  <!-- Profile Card -->
  <div class="profile-main-card">
    <!-- Avatar & Student Identity -->
    <div class="avatar-hero-section">
      <img 
        class="profile-avatar-img profile-picture profile-picture--large" 
        src="{{ $student->profile_picture ? route('profile.picture') : asset('images/default-avatar.svg') }}" 
        alt="{{ $student->profile_picture ? 'Your profile picture' : 'Default profile avatar' }}"
      >

      @if($student->profile_picture)
        <a class="btn-download-photo" href="{{ route('profile.picture.download') }}">
          <i class="bi bi-cloud-arrow-down-fill"></i>
          <span>Download profile picture</span>
        </a>
      @endif

      <div class="student-title-badge">
        <h2>{{ $student->name }}</h2>
        <div class="student-subtitle">
          Student ID: <span style="font-family: monospace; background: #e0f2e8; padding: 2px 8px; border-radius: 6px; color: #164631; font-weight: 700;">#ST-{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}</span>
          @if($student->department)
            • <span class="badge" style="background: #2b7447; color: #ffffff;">{{ $student->department->code }}</span>
          @endif
        </div>
      </div>
    </div>

    <!-- PDF Document Management Box -->
    <div class="doc-manager-box">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
          <div class="doc-manager-title">
            <i class="bi bi-file-earmark-pdf-fill text-danger fs-5"></i>
            <span>My PDF Document</span>
          </div>
          <p class="text-secondary small mb-0 mt-1">
            {{ $student->pdf_file ? 'Your document is verified and available to download or replace.' : 'No PDF document uploaded yet.' }}
          </p>
        </div>

        @if($student->pdf_file)
          <div class="d-flex align-items-center gap-2">
            <a class="btn-doc-download" href="{{ route('profile.document') }}">
              <i class="bi bi-download"></i>
              <span>Download PDF</span>
            </a>
            <form method="POST" action="{{ route('profile.document.destroy') }}" onsubmit="return confirm('Are you sure you want to remove your PDF document?')">
              @csrf 
              @method('DELETE')
              <button class="btn-doc-remove" type="submit">
                <i class="bi bi-trash3"></i>
                <span>Remove</span>
              </button>
            </form>
          </div>
        @endif
      </div>

      <!-- PDF Upload / Replace Form -->
      <form class="row g-2 align-items-end pt-2 border-top" style="border-color: #d6e8de !important;" method="POST" action="{{ route('profile.document.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md">
          <label class="form-label small fw-bold text-dark mb-1" for="pdf_file">
            {{ $student->pdf_file ? 'Upload a replacement document' : 'Upload your document' }}
          </label>
          <input class="form-control portal-file-input" id="pdf_file" name="pdf_file" type="file" accept=".pdf" required>
          @error('pdf_file')
            <div class="text-danger small mt-1 font-weight-bold">{{ $message }}</div>
          @enderror
          <div class="text-muted small mt-1" style="font-size: 11px;">PDF only, maximum file size 5 MB.</div>
        </div>
        <div class="col-md-auto">
          <button class="btn-portal-upload" type="submit">
            <i class="bi bi-cloud-arrow-up-fill"></i>
            <span>{{ $student->pdf_file ? 'Replace PDF' : 'Upload PDF' }}</span>
          </button>
        </div>
      </form>
    </div>

    <!-- Student Details Grid -->
    <div class="row g-3">
      <!-- Name -->
      <div class="col-md-6 col-lg-4">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-person-fill"></i>
            <span>Full Name</span>
          </div>
          <div class="detail-content">{{ $student->name }}</div>
        </div>
      </div>

      <!-- Age -->
      <div class="col-md-6 col-lg-4">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-calendar-event"></i>
            <span>Age</span>
          </div>
          <div class="detail-content">{{ $student->age }} Years Old</div>
        </div>
      </div>

      <!-- CNIC -->
      <div class="col-md-6 col-lg-4">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-card-text"></i>
            <span>CNIC Number</span>
          </div>
          <div class="detail-content" style="font-family: monospace; color: #1e5a40;">
            {{ $student->cnic }}
          </div>
        </div>
      </div>

      <!-- Email -->
      <div class="col-md-6">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-envelope-fill"></i>
            <span>Approved Email</span>
          </div>
          <div class="detail-content">{{ $student->email }}</div>
        </div>
      </div>

      <!-- Phone -->
      <div class="col-md-6">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-telephone-fill"></i>
            <span>Phone Contact</span>
          </div>
          <div class="detail-content">{{ $student->phone }}</div>
        </div>
      </div>

      <!-- Department -->
      <div class="col-md-6">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-mortarboard-fill"></i>
            <span>Department</span>
          </div>
          <div class="detail-content">
            @if($student->department)
              {{ $student->department->name }} ({{ $student->department->code }})
            @else
              <span class="text-muted fw-normal fst-italic">Not assigned yet</span>
            @endif
          </div>
        </div>
      </div>

      <!-- Address -->
      <div class="col-md-6">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-geo-alt-fill"></i>
            <span>Residential Address</span>
          </div>
          <div class="detail-content" style="font-weight: 500; font-size: 14px;">
            {{ $student->address ?: 'Not provided' }}
          </div>
        </div>
      </div>
    </div>

    <!-- Assigned Subjects Section -->
    <div class="subjects-section-card">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center gap-2" style="font-size: 13px; font-weight: 800; color: #1e5a40; text-transform: uppercase; letter-spacing: 0.5px;">
          <i class="bi bi-journals fs-5"></i>
          <span>Enrolled Subjects</span>
        </div>
        <span class="badge" style="background: #2b7447; color: #ffffff; font-size: 11px;">
          {{ $student->subjects->count() }} Total
        </span>
      </div>

      <div>
        @forelse($student->subjects as $subject)
          <span class="subject-pill-tag subjects">
            <i class="bi bi-book text-muted"></i>
            <span>{{ $subject->name }}</span>
          </span>
        @empty
          <p class="text-muted small mb-0 fst-italic">
            <i class="bi bi-info-circle me-1"></i> No academic subjects assigned yet.
          </p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
