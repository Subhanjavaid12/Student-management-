@extends('layouts.app', ['title' => 'Assign Subject - ' . ($subject->name ?? 'Course')])

@section('content')
<style>
  .portal-page-container {
    max-width: 900px;
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

  /* Subject Highlight Pill */
  .subject-highlight-box {
    background: #eef7f2;
    border: 1.5px solid #bce1ce;
    border-radius: 14px;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
  }
  .subject-title-badge {
    font-size: 15px;
    font-weight: 800;
    color: #1b5337;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* Scrollable Student Selection Container */
  .student-selection-container {
    max-height: 340px;
    overflow-y: auto;
    border: 1.5px solid #cce5d7;
    border-radius: 14px;
    background: #f7fbf9;
    padding: 12px;
    scrollbar-width: thin;
    scrollbar-color: #a8cbb8 #f7fbf9;
  }

  /* Student Row Tiles */
  .student-select-tile {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
    border: 1.5px solid #d5e8de;
    border-radius: 12px;
    padding: 10px 16px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .student-select-tile:hover {
    border-color: #2f855a;
    background: #f1f8f4;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(47, 133, 90, 0.08);
  }

  /* Checked Active State */
  .student-select-tile:has(.portal-checkbox:checked) {
    background: #e8f5ee;
    border-color: #2b7447;
    box-shadow: 0 0 0 1.5px #2b7447;
  }

  .portal-checkbox {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #2b7447;
  }

  .student-id-pill {
    background: #eaf3ee;
    color: #1b5337;
    font-size: 11.5px;
    font-weight: 700;
    font-family: monospace;
    padding: 3px 9px;
    border-radius: 6px;
    border: 1px solid #cce5d7;
  }

  /* Action Buttons */
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
        University • Course Enrollment
      </div>
      <h1>Assign Students</h1>
      <p>Enroll active students into this course subject.</p>
    </div>

    <a class="btn-portal-back" href="{{ route('subjects.index') }}">
      <i class="bi bi-arrow-left"></i>
      <span>Back to Subjects</span>
    </a>
  </div>

  <!-- Form Card -->
  <div class="portal-form-card">
    <!-- Active Subject Banner -->
    <div class="subject-highlight-box">
      <div>
        <div style="font-size: 11.5px; font-weight: 700; color: #43785e; text-transform: uppercase; letter-spacing: 0.5px;">Target Course</div>
        <div class="subject-title-badge">
          <i class="bi bi-journal-check fs-5"></i>
          <span>{{ $subject->name ?? $subject->number_format }}</span>
        </div>
      </div>
      <span class="student-id-pill">Subject ID: #{{ $subject->id }}</span>
    </div>

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

    <form action="{{ route('subjects.storeAssignment', $subject) }}" method="POST">
      @csrf

      <div class="d-flex align-items-center justify-content-between mb-2">
        <label class="form-label mb-0" style="font-size: 12.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #1e5a40;">
          Select Eligible Students
        </label>
        <span class="text-muted small" style="font-size: 12px;">Check all students to enroll</span>
      </div>

      <!-- Scrollable Student Tile List -->
      <div class="student-selection-container mb-4">
        @forelse($students as $student)
          <label class="student-select-tile" for="student{{ $student->id }}">
            <div class="d-flex align-items-center gap-3">
              <input 
                type="checkbox" 
                name="students[]" 
                value="{{ $student->id }}" 
                class="form-check-input portal-checkbox mt-0" 
                id="student{{ $student->id }}"
              >
              <div>
                <span class="fw-bold text-dark d-block" style="font-size: 13.5px;">{{ $student->name }}</span>
                @if($student->email)
                  <small class="text-muted" style="font-size: 11.5px;">{{ $student->email }}</small>
                @endif
              </div>
            </div>

            <span class="student-id-pill">
              ID: #{{ $student->id }}
            </span>
          </label>
        @empty
          <div class="text-center py-4 text-muted">
            <i class="bi bi-people fs-2 d-block mb-1 text-secondary opacity-50"></i>
            <span class="fw-semibold">No students available to assign.</span>
          </div>
        @endforelse
      </div>

      <!-- Action Footer -->
      <div class="d-flex align-items-center gap-2 pt-2 border-top" style="border-color: #e3eee7 !important;">
        <button type="submit" class="btn-portal-submit">
          <i class="bi bi-check2-circle fs-5"></i>
          <span>Assign Subject</span>
        </button>
        <a href="{{ route('subjects.index') }}" class="btn-portal-cancel">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection