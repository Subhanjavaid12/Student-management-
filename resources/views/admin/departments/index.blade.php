@extends('layouts.app', ['title' => 'Departments'])

@section('content')
<style>
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

  /* Add Department CTA */
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
    flex: 1;
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

  /* Search Results Card */
  .portal-results-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 18px;
    border: 1.5px solid #b7ddc8;
    box-shadow: 0 12px 30px -6px rgba(26, 61, 46, 0.12);
    margin-bottom: 24px;
    overflow: hidden;
  }
  .portal-results-header {
    background: #1e5a40;
    color: #ffffff;
    padding: 14px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    font-weight: 700;
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

  /* Code badge */
  .dept-code-badge {
    background: #eaf3ee;
    color: #1b5337;
    font-size: 12px;
    font-weight: 700;
    font-family: monospace;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #cce5d7;
    display: inline-block;
  }

  /* Count badge */
  .students-count-pill {
    background: #e8f5ee;
    color: #1e5a40;
    font-weight: 700;
    font-size: 12.5px;
    padding: 4px 12px;
    border-radius: 999px;
    border: 1px solid #b8dfca;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  /* Action Buttons */
  .btn-action-enroll {
    color: #166534;
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: 0.2s;
  }
  .btn-action-enroll:hover {
    background: #bbf7d0;
    color: #14532d;
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
    display: inline-flex;
    align-items: center;
    gap: 4px;
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
    display: inline-flex;
    align-items: center;
    gap: 4px;
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
      <div style="font-size: 11px; font-weight: 800; color: #2d6a4f; text-transform: uppercase; letter-spacing: 0.6px;">
        University • Academic Structure
      </div>
      <h1>Departments</h1>
      <p>Create and manage academic departments and student allocations.</p>
    </div>
    <a class="btn-portal-add" href="{{ route('admin.departments.create') }}">
      <i class="bi bi-plus-lg"></i>
      <span>Add Department</span>
    </a>
  </div>

  <!-- Search Bar Card -->
  <div class="portal-search-card">
    <form method="GET" action="{{ route('admin.departments.index') }}" class="d-flex flex-wrap gap-2 align-items-center">
      <div class="search-input-wrapper">
        <i class="bi bi-search search-icon-inside"></i>
        <input 
          type="text" 
          name="search" 
          class="form-control portal-search-input" 
          placeholder="Search department name or code (e.g. CS, Pharmacy)..." 
          value="{{ request('search') }}"
        >
      </div>
      <button type="submit" class="btn btn-search-go d-flex align-items-center gap-2">
        <i class="bi bi-funnel-fill"></i>
        <span>Search</span>
      </button>
      @if(request('search'))
        <a href="{{ route('admin.departments.index') }}" class="btn btn-search-clear">Reset</a>
      @endif
    </form>
  </div>

  <!-- Search Results Display -->
  @if(request()->filled('search'))
    <div class="portal-results-card">
      <div class="portal-results-header">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-search"></i>
          <span>Search Results for: "{{ request('search') }}"</span>
        </div>
        <a href="{{ route('admin.departments.index') }}" class="text-white text-decoration-underline small">Clear Results</a>
      </div>
      <div class="p-4">
        @if(!$searchedDepartment)
          <div class="alert alert-warning mb-0 d-flex align-items-center gap-2" style="border-radius: 12px; font-size: 13.5px;">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <div>No department found matching "<strong>{{ request('search') }}</strong>".</div>
          </div>
        @elseif($searchedDepartment->students->isEmpty())
          <div class="alert alert-info mb-0 d-flex align-items-center gap-2" style="border-radius: 12px; font-size: 13.5px; background: #eaf5ee; border-color: #b7ddc8; color: #164631;">
            <i class="bi bi-info-circle-fill fs-5"></i>
            <div>No students are currently enrolled in <strong>{{ $searchedDepartment->name }} ({{ $searchedDepartment->code }})</strong>.</div>
          </div>
        @else
          <h5 class="fw-bold mb-3" style="color: #1a4d36; font-size: 16px;">
            <i class="bi bi-people-fill me-1"></i> Students Enrolled in {{ $searchedDepartment->name }} ({{ $searchedDepartment->code }})
          </h5>
          <div class="table-responsive">
            <table class="portal-table" style="border: 1px solid #d5e8de; border-radius: 12px; overflow: hidden;">
              <thead>
                <tr>
                  <th style="width: 70px;">#</th>
                  <th>Student Name</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                @foreach($searchedDepartment->students as $index => $student)
                  <tr>
                    <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                    <td class="fw-semibold text-dark">{{ $student->name }}</td>
                    <td class="text-secondary">{{ $student->email ?: '—' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  @endif

  <!-- All Departments Table Card -->
  <div class="portal-table-card">
    <div class="table-responsive">
      <table class="portal-table">
        <thead>
          <tr>
            <th scope="col" style="width: 140px;">Code</th>
            <th scope="col">Department Name</th>
            <th scope="col" style="width: 220px;">Enrolled Students</th>
            <th scope="col" class="text-end" style="width: 250px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($departments as $department)
            <tr>
              <!-- Code -->
              <td>
                <span class="dept-code-badge">{{ $department->code }}</span>
              </td>

              <!-- Name -->
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div style="width: 34px; height: 34px; border-radius: 8px; background: #e3f2ea; color: #1e5a40; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="bi bi-buildings-fill"></i>
                  </div>
                  <span class="fw-bold text-dark">{{ $department->name }}</span>
                </div>
              </td>

              <!-- Enrolled Students -->
              <td>
                <span class="students-count-pill">
                  <i class="bi bi-person-badge"></i>
                  <span>{{ $department->students_count }} Enrolled</span>
                </span>
              </td>

              <!-- Actions -->
              <td class="text-end text-nowrap">
                <div class="d-inline-flex gap-1">
                  <a class="btn-action-enroll" href="{{ route('admin.departments.enroll', $department) }}" title="Enroll Students">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Enroll</span>
                  </a>

                  <a class="btn-action-edit" href="{{ route('admin.departments.edit', $department) }}" title="Edit Department">
                    <i class="bi bi-pencil"></i>
                    <span>Edit</span>
                  </a>

                  <form action="{{ route('admin.departments.destroy', $department) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Delete this department? Students assigned to it will be left without a department.');">
                    @csrf
                    @method('DELETE')
                    <button class="btn-action-delete border-0" type="submit" title="Delete Department">
                      <i class="bi bi-trash3"></i>
                      <span>Delete</span>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center py-5">
                <div style="color: #638c77;">
                  <i class="bi bi-buildings fs-1 d-block mb-2 opacity-50"></i>
                  <h6 class="fw-bold mb-1">No departments found</h6>
                  <p class="small text-muted mb-0">Add your first academic department to get started.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination Links -->
  <div class="mt-4 d-flex justify-content-center">
    {{ $departments->links() }}
  </div>
</div>
@endsection
