@extends('layouts.app', ['title' => 'Enroll Students - ' . $department->name])

@section('content')
<style>
  .portal-page-container {
    max-width: 1100px;
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

  /* Department Badge Box */
  .dept-info-badge {
    background: #eaf3ee;
    color: #1b5337;
    font-size: 12px;
    font-weight: 700;
    font-family: monospace;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #cce5d7;
  }

  /* Frosted Content Cards */
  .portal-content-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 12px 32px -8px rgba(26, 61, 46, 0.1);
    padding: 26px 28px;
    margin-bottom: 24px;
  }

  .portal-card-title {
    font-size: 17px;
    font-weight: 800;
    color: #1a3d2e;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
  }

  .portal-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #23503b;
    margin-bottom: 6px;
    display: block;
  }

  .portal-select {
    height: 46px;
    border-radius: 10px;
    border: 1.5px solid #a8cbb8;
    padding: 8px 14px;
    font-size: 13.5px;
    background-color: #ffffff;
    color: #1a3d2e;
    transition: all 0.2s ease;
  }
  .portal-select:focus {
    border-color: #2f855a;
    box-shadow: 0 0 0 3px rgba(47, 133, 90, 0.18);
    outline: none;
  }

  .btn-portal-enroll {
    height: 46px;
    background: #2b7447;
    color: #ffffff !important;
    font-size: 14px;
    font-weight: 700;
    border-radius: 10px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(43, 116, 71, 0.28);
    transition: all 0.2s ease;
  }
  .btn-portal-enroll:hover:not(:disabled) {
    background: #235e3a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(43, 116, 71, 0.35);
  }
  .btn-portal-enroll:disabled {
    background: #a3c4b0;
    cursor: not-allowed;
    box-shadow: none;
  }

  /* Table Styles */
  .portal-table {
    margin-bottom: 0;
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
  }
  .portal-table thead tr {
    background: #eef7f2;
    border-bottom: 1.5px solid #d4e8dd;
  }
  .portal-table thead th {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #23583f;
    padding: 14px 18px;
    border: none;
  }
  .portal-table tbody tr {
    border-bottom: 1px solid #eaf3ed;
    transition: background 0.15s ease;
  }
  .portal-table tbody tr:hover {
    background: #f7fcf9;
  }
  .portal-table td {
    padding: 14px 18px;
    vertical-align: middle;
    font-size: 13.5px;
    color: #214333;
    border: none;
  }

  .btn-action-unenroll {
    color: #b91c1c;
    background: #fef2f2;
    border: 1px solid #fecaca;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: 0.2s;
  }
  .btn-action-unenroll:hover {
    background: #fee2e2;
    color: #991b1b;
  }

  .enrolled-count-badge {
    background: #e8f5ee;
    color: #1e5a40;
    font-weight: 700;
    font-size: 12px;
    padding: 4px 12px;
    border-radius: 999px;
    border: 1px solid #b8dfca;
  }
</style>

<div class="portal-page-container">
  <!-- Top Navigation Header -->
  <div class="portal-header-card">
    <div>
      <div style="font-size: 11px; font-weight: 800; color: #2d6a4f; text-transform: uppercase; letter-spacing: 0.6px;">
        University • Academic Allocation
      </div>
      <div class="d-flex align-items-center gap-2 mt-1">
        <h1>Enroll Students: {{ $department->name }}</h1>
        <span class="dept-info-badge">{{ $department->code }}</span>
      </div>
      <p>Assign available unallocated students to this academic department.</p>
    </div>

    <a class="btn-portal-back" href="{{ route('admin.departments.index') }}">
      <i class="bi bi-arrow-left"></i>
      <span>Back to Departments</span>
    </a>
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

  <!-- Section 1: Enroll Form Card -->
  <div class="portal-content-card">
    <div class="portal-card-title">
      <i class="bi bi-person-plus-fill text-success"></i>
      <span>Enroll a Student</span>
    </div>

    <form action="{{ route('admin.departments.enroll.store', $department) }}" method="POST" class="row g-3 align-items-end">
      @csrf
      <div class="col-md-8">
        <label for="student_id" class="portal-label">Available Unallocated Students</label>
        <select id="student_id" name="student_id" class="form-select portal-select" required>
          <option value="" disabled selected>Select an unassigned student...</option>
          @forelse($availableStudents as $student)
            <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
              {{ $student->name }} &mdash; {{ $student->email ?: 'No email' }}
            </option>
          @empty
            <option value="" disabled>No unallocated students available</option>
          @endforelse
        </select>
      </div>

      <div class="col-md-4">
        <button type="submit" class="btn-portal-enroll w-100" {{ $availableStudents->isEmpty() ? 'disabled' : '' }}>
          <i class="bi bi-check2-circle fs-5"></i>
          <span>Enroll Student</span>
        </button>
      </div>
    </form>
  </div>

  <!-- Section 2: Currently Enrolled Students Table Card -->
  <div class="portal-content-card p-0 overflow-hidden">
    <div class="p-4 pb-3 d-flex justify-content-between align-items-center">
      <div class="portal-card-title mb-0">
        <i class="bi bi-people-fill" style="color: #1e5a40;"></i>
        <span>Currently Enrolled Students</span>
      </div>
      <span class="enrolled-count-badge">
        {{ $department->students->count() }} Total
      </span>
    </div>

    <div class="table-responsive">
      <table class="portal-table">
        <thead>
          <tr>
            <th scope="col" style="width: 35%;">Student Name</th>
            <th scope="col">Email Address</th>
            <th scope="col" class="text-end" style="width: 140px;">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($department->students as $student)
            <tr>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div style="width: 32px; height: 32px; border-radius: 8px; background: #e3f2ea; color: #1e5a40; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                    <i class="bi bi-person-fill"></i>
                  </div>
                  <span class="fw-bold text-dark">{{ $student->name }}</span>
                </div>
              </td>
              <td>
                <span class="text-secondary">{{ $student->email ?: '—' }}</span>
              </td>
              <td class="text-end">
                <form action="{{ route('admin.departments.unenroll', [$department, $student]) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Unenroll {{ $student->name }} from this department?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-action-unenroll border-0" title="Unenroll Student">
                    <i class="bi bi-person-x-fill"></i>
                    <span>Unenroll</span>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center py-5">
                <div style="color: #638c77;">
                  <i class="bi bi-person-slash fs-1 d-block mb-2 opacity-50"></i>
                  <h6 class="fw-bold mb-1">No students enrolled yet</h6>
                  <p class="small text-muted mb-0">Select an unallocated student above to assign them to this department.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
