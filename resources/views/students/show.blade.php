    @extends('layouts.app', ['title' => $student->name])

@section('content')
<style>
  .portal-profile-container {
    max-width: 1100px;
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

  /* Main Profile Card */
  .profile-main-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    padding: 36px 32px;
    box-shadow: 0 16px 36px -8px rgba(26, 61, 46, 0.12);
  }

  /* Avatar & Identity Hero */
  .avatar-hero-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding-bottom: 28px;
    border-bottom: 1px solid #e3eee7;
    margin-bottom: 28px;
  }

  .profile-avatar-btn {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    border-radius: 50%;
    outline: none;
    transition: transform 0.2s ease;
    position: relative;
  }
  .profile-avatar-btn:hover {
    transform: scale(1.04);
  }

  .profile-avatar-img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3.5px solid #40916c;
    box-shadow: 0 8px 22px rgba(27, 83, 55, 0.22);
  }

  .profile-avatar-placeholder {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: #e2f2e9;
    border: 3px dashed #74c69d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    color: #2d6a4f;
  }

  .student-title-badge {
    margin-top: 14px;
  }
  .student-title-badge h2 {
    font-size: 24px;
    font-weight: 800;
    color: #1a3d2e;
    margin: 0;
  }
  .student-subtitle {
    font-size: 13.5px;
    color: #4b6a5a;
    font-weight: 600;
    margin-top: 4px;
  }

  /* Field Detail Boxes */
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

  /* Subjects Section */
  .subjects-section-card {
    background: #f4faf6;
    border: 1.5px solid #d6ece0;
    border-radius: 16px;
    padding: 22px 24px;
    margin-top: 24px;
    margin-bottom: 28px;
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

  /* Action Buttons */
  .btn-doc-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 44px;
    padding: 0 20px;
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    color: #1e5a40;
    font-size: 13.5px;
    font-weight: 700;
    border-radius: 10px;
    text-decoration: none;
    transition: 0.2s ease;
  }
  .btn-doc-action:hover {
    background: #eaf5ee;
    color: #14442f;
    border-color: #2f855a;
  }

  .btn-edit-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 44px;
    padding: 0 22px;
    background: #2b7447;
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 700;
    border-radius: 10px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(43, 116, 71, 0.28);
    transition: 0.2s ease;
  }
  .btn-edit-action:hover {
    background: #235e3a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(43, 116, 71, 0.35);
  }
</style>

<div class="portal-profile-container">
  <!-- Top Navigation Header -->
  <div class="profile-header-card">
    <div>
      <div style="font-size: 11px; font-weight: 800; color: #2d6a4f; text-transform: uppercase; letter-spacing: 0.6px;">University Portal</div>
      <h1 style="font-size: 24px; font-weight: 800; color: #1a4d36; margin: 2px 0 0 0;">Student Record</h1>
    </div>
    <a class="btn-portal-back" href="{{ route('students.index') }}">
      <i class="bi bi-arrow-left"></i>
      <span>Back to Students</span>
    </a>
  </div>

  <!-- Profile Card -->
  <div class="profile-main-card">
    <!-- Avatar & Student Identity Header -->
    <div class="avatar-hero-section">
      @if($student->profile_picture)
        <button 
          class="profile-avatar-btn profile-picture-button student-avatar" 
          type="button" 
          data-image-url="{{ route('students.profile-picture', $student) }}" 
          data-download-url="{{ route('students.profile-picture.download', $student) }}" 
          data-student-name="{{ $student->name }}"
          title="Click to view or download photo"
        >
          <img 
            class="profile-avatar-img profile-picture profile-picture--large" 
            src="{{ route('students.profile-picture', $student) }}" 
            alt="{{ $student->name }}'s profile picture"
          >
        </button>
        <span class="small text-muted mt-2 d-flex align-items-center gap-1" style="font-size: 11.5px;">
          <i class="bi bi-zoom-in"></i> Click photo for viewing options
        </span>
      @else
        <div class="profile-avatar-placeholder">
          <i class="bi bi-person-fill"></i>
        </div>
        <span class="small text-muted mt-2" style="font-size: 11.5px;">No profile photo provided</span>
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

    <!-- Student Details Grid -->
    <div class="row g-3">
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

      <!-- Phone -->
      <div class="col-md-6 col-lg-4">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-telephone-fill"></i>
            <span>Phone Contact</span>
          </div>
          <div class="detail-content">{{ $student->phone }}</div>
        </div>
      </div>

      <!-- Email -->
      <div class="col-md-6">
        <div class="detail-box">
          <div class="detail-header">
            <i class="bi bi-envelope-fill"></i>
            <span>Email Address</span>
          </div>
          <div class="detail-content">
            {{ $student->email ?: 'Not provided' }}
          </div>
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
              <span class="text-muted fw-normal fst-italic">Not assigned</span>
            @endif
          </div>
        </div>
      </div>

      <!-- Address -->
      <div class="col-12">
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

    <!-- Assigned Subjects Card -->
    <div class="subjects-section-card">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center gap-2" style="font-size: 13px; font-weight: 800; color: #1e5a40; text-transform: uppercase; letter-spacing: 0.5px;">
          <i class="bi bi-journals fs-5"></i>
          <span>Assigned Academic Subjects</span>
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
            <i class="bi bi-info-circle me-1"></i> No subjects have been assigned to this student yet.
          </p>
        @endforelse
      </div>
    </div>

    <!-- Bottom Actions Toolbar -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 border-top" style="border-color: #e3eee7 !important;">
      <div>
        @if($student->pdf_file)
          <a class="btn-doc-action" href="{{ route('students.document', $student) }}">
            <i class="bi bi-file-earmark-pdf-fill text-danger fs-5"></i>
            <span>Download Attached PDF</span>
          </a>
        @endif
      </div>

      <div class="d-flex align-items-center gap-2">
        @if(auth()->user()->isAdmin())
          <a class="btn-edit-action" href="{{ route('students.edit', $student) }}">
            <i class="bi bi-pencil-square"></i>
            <span>Edit Student Profile</span>
          </a>
        @endif
      </div>
    </div>
  </div>
</div>

@include('students.partials.image-options-modal')
@endsection 