@extends('layouts.app', ['title' => 'Student Dashboard'])

@section('content')
<style>
  .portal-dashboard-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 40px 20px 70px;
  }

  /* Frosted Glass Hero Card */
  .student-hero-card {
    background: rgba(255, 255, 255, 0.88);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 24px;
    border: 1.5px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 16px 36px -8px rgba(26, 61, 46, 0.12), 0 0 0 1px rgba(255, 255, 255, 0.6);
    padding: 44px 36px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  /* Decorative Ambient Watermark */
  .hero-watermark-icon {
    position: absolute;
    top: -24px;
    right: -24px;
    font-size: 150px;
    color: rgba(43, 116, 71, 0.05);
    pointer-events: none;
    line-height: 1;
  }

  /* Student Avatar */
  .student-avatar-wrap {
    width: 86px;
    height: 86px;
    border-radius: 50%;
    background: #e3f2ea;
    border: 3px solid #74c69d;
    box-shadow: 0 8px 22px rgba(27, 83, 55, 0.18);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    color: #1e5a40;
    font-size: 34px;
    font-weight: 800;
  }

  /* Typography */
  .student-hero-title {
    font-size: 28px;
    font-weight: 800;
    color: #1a4d36;
    margin: 0 0 8px;
    letter-spacing: -0.3px;
  }

  .student-hero-subtitle {
    font-size: 14px;
    color: #4b6a5a;
    max-width: 480px;
    margin: 0 auto 28px;
    line-height: 1.5;
  }

  /* Department Status Card */
  .department-status-box {
    background: #ffffff;
    border: 1.5px solid #c2e2d1;
    border-radius: 16px;
    padding: 18px 22px;
    max-width: 540px;
    margin: 0 auto 32px;
    display: flex;
    align-items: center;
    gap: 16px;
    text-align: left;
    box-shadow: 0 4px 14px rgba(45, 106, 79, 0.06);
  }

  .department-icon-circle {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: #e6f4ec;
    border: 1.5px solid #a8cbb8;
    color: #1b5337;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }

  .department-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #43785e;
    margin-bottom: 2px;
  }

  .department-val {
    font-size: 15px;
    font-weight: 800;
    color: #1a3d2e;
    margin: 0;
  }

  /* Warning Box */
  .portal-warning-box {
    background: #fffbeb;
    border: 1.5px solid #fef3c7;
    color: #92400e;
    border-radius: 14px;
    padding: 16px 20px;
    max-width: 540px;
    margin: 0 auto;
    font-size: 13.5px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
    text-align: left;
  }

  /* Action Buttons */
  .btn-portal-primary {
    height: 46px;
    padding: 0 24px;
    background: #2b7447;
    color: #ffffff !important;
    font-size: 14px;
    font-weight: 700;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(43, 116, 71, 0.28);
    transition: all 0.2s ease;
  }
  .btn-portal-primary:hover {
    background: #235e3a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(43, 116, 71, 0.35);
  }

  .btn-portal-outline {
    height: 46px;
    padding: 0 22px;
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    color: #1e5a40 !important;
    font-size: 14px;
    font-weight: 700;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .btn-portal-outline:hover {
    background: #eaf5ee;
    border-color: #2f855a;
    color: #14442f !important;
  }
</style>

<div class="portal-dashboard-container">
  <div class="student-hero-card">
    <i class="bi bi-mortarboard-fill hero-watermark-icon"></i>

    <!-- Initial or Avatar -->
    <div class="student-avatar-wrap">
      {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
    </div>

    <!-- Student Welcome -->
    <h1 class="student-hero-title">Welcome, {{ auth()->user()->name }}</h1>
    <p class="student-hero-subtitle">
      Welcome to your University student portal. Here you can inspect your academic profile, enrolled courses, and personal student record.
    </p>

    @if($student)
      <!-- Department Status Tile -->
      <div class="department-status-box">
        <div class="department-icon-circle">
          <i class="bi bi-buildings-fill"></i>
        </div>
        <div>
          <div class="department-label">My Academic Department</div>
          <div class="department-val">
            @if($student->department)
              {{ $student->department->name }} 
              <span class="badge" style="background: #2b7447; color: #ffffff; font-size: 11px; margin-left: 4px;">
                {{ $student->department->code }}
              </span>
            @else
              <span class="text-secondary fw-normal fst-italic">Not assigned yet</span>
            @endif
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="d-flex flex-wrap justify-content-center align-items-center gap-3">
        <a class="btn-portal-primary" href="{{ route('profile.show') }}">
          <i class="bi bi-person-badge-fill fs-5"></i>
          <span>View My Profile</span>
        </a>
        <a class="btn-portal-outline" href="{{ route('profile.edit') }}">
          <i class="bi bi-pencil-square fs-5"></i>
          <span>Edit My Profile</span>
        </a>
      </div>
    @else
      <!-- Warning when no student record is linked -->
      <div class="portal-warning-box">
        <i class="bi bi-exclamation-triangle-fill fs-4" style="flex-shrink: 0;"></i>
        <div>
          <strong>No linked profile:</strong> Your account does not have an active student record associated with it yet. Please contact the admissions or portal administrator.
        </div>
      </div>
    @endif
  </div>
</div>
@endsection