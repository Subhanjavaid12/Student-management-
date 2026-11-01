@extends('layouts.app', ['title' => 'Students Directory'])

@section('content')
<style>
  /* Base page container */
  .portal-page-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px 24px 60px;
  }

  /* Header Section */
  .portal-header-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    padding: 24px 30px;
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

  /* Add Student CTA */
  .btn-portal-add {
    background: #2b7447;
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 700;
    padding: 10px 20px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none !important;
    box-shadow: 0 4px 14px rgba(43, 116, 71, 0.28);
    transition: all 0.2s ease;
  }
  .btn-portal-add:hover {
    background: #235e3a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(43, 116, 71, 0.35);
  }

  /* Search & Filter Bar */
  .portal-search-card {
    background: rgba(255, 255, 255, 0.82);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.9);
    padding: 18px 24px;
    box-shadow: 0 6px 20px -4px rgba(26, 61, 46, 0.06);
    margin-bottom: 24px;
  }
  .portal-search-input {
    height: 44px;
    border-radius: 10px;
    border: 1.5px solid #a8cbb8;
    padding: 8px 16px 8px 40px;
    font-size: 13.5px;
    background: #ffffff;
    color: #1a3d2e;
    transition: all 0.2s ease;
  }
  .portal-search-input:focus {
    border-color: #2f855a;
    box-shadow: 0 0 0 3px rgba(47, 133, 90, 0.18);
    outline: none;
  }
  .search-input-wrapper {
    position: relative;
  }
  .search-icon-inside {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #5d7e6f;
    font-size: 16px;
  }

  .btn-search-go {
    height: 44px;
    background: #1e5a40;
    color: #ffffff;
    font-weight: 700;
    font-size: 13.5px;
    border-radius: 10px;
    padding: 0 24px;
    border: none;
    transition: 0.2s;
  }
  .btn-search-go:hover {
    background: #174531;
    color: #ffffff;
  }
  .btn-search-clear {
    height: 44px;
    border-radius: 10px;
    border: 1.5px solid #c2dcd0;
    background: #f4faf6;
    color: #3b6b55;
    font-weight: 600;
    font-size: 13.5px;
    padding: 0 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: 0.2s;
  }
  .btn-search-clear:hover {
    background: #e4f2eb;
    color: #1a4d36;
  }

  /* Table Card */
  .portal-table-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 18px;
    border: 1px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 12px 32px -8px rgba(26, 61, 46, 0.1);
    overflow: hidden;
  }

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
    padding: 16px 20px;
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
    padding: 16px 20px;
    vertical-align: middle;
    font-size: 13.5px;
    color: #214333;
    border: none;
  }

  /* Avatar button */
  .avatar-thumb-btn {
    border: none;
    background: none;
    padding: 0;
    cursor: pointer;
    border-radius: 50%;
    outline: none;
    transition: transform 0.2s ease;
  }
  .avatar-thumb-btn:hover {
    transform: scale(1.08);
  }
  .avatar-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #84cca6;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
  .avatar-placeholder {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #e3f2ea;
    color: #2e6b4e;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    border: 1.5px dashed #a3d3ba;
  }

  /* Subjects count badge */
  .subject-pill-badge {
    background: #e8f5ee;
    color: #1e5a40;
    font-weight: 700;
    font-size: 12px;
    padding: 4px 12px;
    border-radius: 999px;
    border: 1px solid #b8dfca;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  /* Document badge */
  .btn-doc-download {
    font-size: 12px;
    font-weight: 600;
    color: #1e5a40;
    background: #ffffff;
    border: 1px solid #b5d8c6;
    border-radius: 8px;
    padding: 4px 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: 0.2s;
  }
  .btn-doc-download:hover {
    background: #eaf5ee;
    color: #123e2b;
    border-color: #8ac0a2;
  }

  /* Action buttons */
  .btn-action-view {
    color: #1b5337;
    background: #eaf5ef;
    border: 1px solid #b7dec9;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.2s;
  }
  .btn-action-view:hover {
    background: #d8eee0;
    color: #14422b;
  }
  .btn-action-edit {
    color: #0f4c81;
    background: #edf5fc;
    border: 1px solid #bfdbfe;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.2s;
  }
  .btn-action-edit:hover {
    background: #dbeafe;
    color: #1e3a8a;
  }
  .btn-action-delete {
    color: #b91c1c;
    background: #fef2f2;
    border: 1px solid #fecaca;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 8px;
    transition: 0.2s;
  }
  .btn-action-delete:hover {
    background: #fee2e2;
    color: #991b1b;
  }
</style>

<div class="portal-page-container">
  <!-- Top Banner / Header -->
  <div class="portal-header-card">
    <div>
      <h1>Students Directory</h1>
      <p>Search, inspect, and manage University student profiles and course enrollments.</p>
    </div>
    @if(auth()->user()->isAdmin())
      <a class="btn-portal-add" href="{{ route('students.create') }}">
        <i class="bi bi-person-plus-fill"></i>
        <span>Add Student</span>
      </a>
    @endif
  </div>

  <!-- Search & Filter Card -->
  <div class="portal-search-card">
    <form action="{{ route('students.index') }}" method="GET" class="row g-2 align-items-center">
      <div class="col-md">
        <div class="search-input-wrapper">
          <i class="bi bi-search search-icon-inside"></i>
          <input 
            class="form-control portal-search-input" 
            name="search" 
            value="{{ $search ?? '' }}" 
            placeholder="Search by student name, CNIC number, or contact phone..."
          >
        </div>
      </div>
      <div class="col-md-auto">
        <button class="btn btn-search-go w-100 d-flex align-items-center gap-2" type="submit">
          <i class="bi bi-funnel-fill"></i>
          <span>Search</span>
        </button>
      </div>
      <div class="col-md-auto">
        <a class="btn btn-search-clear w-100" href="{{ route('students.index') }}">Clear</a>
      </div>
    </form>
  </div>

  <!-- Students Data Table Card -->
  <div class="portal-table-card">
    <div class="table-responsive">
      <table class="portal-table">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Age</th>
            <th>CNIC</th>
            <th>Contact</th>
            <th>Department</th>
            <th>Subjects</th>
            <th>Document</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($students as $student)
            <tr>
              <!-- Profile Photo -->
              <td>
                @if($student->profile_picture)
                  <button 
                    class="avatar-thumb-btn profile-picture-button" 
                    type="button" 
                    data-image-url="{{ route('students.profile-picture', $student) }}" 
                    data-download-url="{{ route('students.profile-picture.download', $student) }}" 
                    data-student-name="{{ $student->name }}" 
                    aria-label="Actions for {{ $student->name }}'s profile picture"
                  >
                    <img 
                      class="avatar-circle profile-picture" 
                      src="{{ route('students.profile-picture', $student) }}" 
                      alt="{{ $student->name }}'s profile picture"
                    >
                  </button>
                @else
                  <div class="avatar-placeholder" title="No photo uploaded">
                    <i class="bi bi-person-fill"></i>
                  </div>
                @endif
              </td>

              <!-- Name -->
              <td>
                <div class="fw-bold text-dark">{{ $student->name }}</div>
                <small class="text-muted" style="font-size: 11px;">ID: #ST-{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}</small>
              </td>

              <!-- Age -->
              <td>
                <span class="fw-semibold">{{ $student->age }}</span> <small class="text-muted">yrs</small>
              </td>

              <!-- CNIC -->
              <td>
                <span style="font-family: monospace; font-size: 12.5px; background: #eaf3ee; padding: 3px 8px; border-radius: 6px; color: #1b5337;">
                  {{ $student->cnic }}
                </span>
              </td>

              <!-- Contact -->
              <td>
                <div class="d-flex align-items-center gap-1">
                  <i class="bi bi-envelope text-muted" style="font-size: 12px;"></i>
                  <span>{{ $student->email ?: '—' }}</span>
                </div>
                <div class="d-flex align-items-center gap-1 mt-1 text-muted" style="font-size: 11.5px;">
                  <i class="bi bi-telephone text-muted"></i>
                  <span>{{ $student->phone }}</span>
                </div>
              </td>

              <!-- Department -->
              <td>
                @if($student->department)
                  <div class="fw-bold" style="color: #1f573d;">{{ $student->department->name }}</div>
                  <span class="badge" style="background: #e2f1e8; color: #1a4d36; font-size: 10px; font-weight: 700;">
                    {{ $student->department->code }}
                  </span>
                @else
                  <span class="text-secondary small fst-italic">Not assigned</span>
                @endif
              </td>

              <!-- Subjects -->
              <td>
                <span class="subject-pill-badge subject-count">
                  <i class="bi bi-book-half"></i>
                  <span>{{ $student->subjects->count() }} enrolled</span>
                </span>
              </td>

              <!-- Document -->
              <td>
                @if($student->pdf_file)
                  <a class="btn-doc-download" href="{{ route('students.document', $student) }}">
                    <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                    <span>PDF</span>
                  </a>
                @else
                  <span class="text-muted small">None</span>
                @endif
              </td>

              <!-- Actions -->
              <td class="text-end">
                <div class="d-inline-flex gap-1">
                  <a class="btn-action-view" href="{{ route('students.show', $student) }}" title="View Profile">
                    <i class="bi bi-eye"></i>
                  </a>

                  @if(auth()->user()->isAdmin())
                    <a class="btn-action-edit" href="{{ route('students.edit', $student) }}" title="Edit Details">
                      <i class="bi bi-pencil"></i>
                      <span>Edit</span>
                    </a>

                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline m-0">
                      @csrf 
                      @method('DELETE')
                      <button 
                        class="btn-action-delete border-0" 
                        type="submit" 
                        onclick="return confirm('Are you sure you want to delete student: {{ $student->name }}?')" 
                        title="Delete Student"
                      >
                        <i class="bi bi-trash3"></i>
                        <span>Delete</span>
                      </button>
                    </form>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center py-5">
                <div style="color: #638c77;">
                  <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                  <h6 class="fw-bold mb-1">No students found</h6>
                  <p class="small text-muted mb-0">Try changing your search keywords or clear the filter.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination links -->
  <div class="mt-4 d-flex justify-content-center">
    {{ $students->links() }}
  </div>
</div>

@include('students.partials.image-options-modal')
@endsection
