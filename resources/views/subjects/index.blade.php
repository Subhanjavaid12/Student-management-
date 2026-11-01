@extends('layouts.app', ['title' => 'Course Subjects'])

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

  /* Add Subject CTA */
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

  /* Student Pills with Unassign Button */
  .student-pill {
    background: #eef6f1;
    border: 1px solid #b7ddc8;
    color: #1a4d36;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 3px;
    margin-right: 3px;
    transition: 0.15s ease;
  }
  .student-pill:hover {
    background: #e1f2e8;
  }

  .btn-unassign-student {
    background: none;
    border: none;
    padding: 0;
    margin: 0;
    color: #709783;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border-radius: 50%;
    transition: color 0.15s;
  }
  .btn-unassign-student:hover {
    color: #dc2626;
  }

  /* Action Buttons */
  .btn-action-assign {
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
  .btn-action-assign:hover {
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

  .view-only-badge {
    background: #f3f4f6;
    color: #6b7280;
    border: 1px solid #e5e7eb;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
  }
</style>

<div class="portal-page-container">
  <!-- Top Banner / Header -->
  <div class="portal-header-card">
    <div>
      <div style="font-size: 11px; font-weight: 800; color: #2d6a4f; text-transform: uppercase; letter-spacing: 0.6px;">University • Curriculum</div>
      <h1>Course Subjects</h1>
      <p>Manage academic subjects, descriptions, and student course registrations.</p>
    </div>
    @if(auth()->user()->isAdmin())
      <a class="btn-portal-add" href="{{ route('subjects.create') }}">
        <i class="bi bi-plus-lg"></i>
        <span>Add Subject</span>
      </a>
    @endif
  </div>

  <!-- Subjects Data Table Card -->
  <div class="portal-table-card">
    <div class="table-responsive">
      <table class="portal-table">
        <thead>
          <tr>
            <th scope="col" style="width: 80px;">ID</th>
            <th scope="col" style="width: 22%;">Subject Name</th>
            <th scope="col">Description</th>
            <th scope="col" style="width: 34%;">Assigned Students</th>
            <th scope="col" class="text-end" style="width: 220px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($subjects as $subject)
            <tr>
              <!-- Subject ID -->
              <td>
                <span style="font-family: monospace; font-size: 12px; background: #eaf3ee; padding: 3px 8px; border-radius: 6px; color: #1b5337; font-weight: 700;">
                  #{{ $subject->id }}
                </span>
              </td>

              <!-- Subject Name -->
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div style="width: 32px; height: 32px; border-radius: 8px; background: #e3f2ea; color: #1e5a40; display: flex; align-items: center; justify-content: center; font-size: 15px;">
                    <i class="bi bi-journal-text"></i>
                  </div>
                  <div>
                    <span class="fw-bold text-dark">{{ $subject->name }}</span>
                  </div>
                </div>
              </td>

              <!-- Description -->
              <td>
                <span class="text-secondary" style="font-size: 13px;">
                  {{ $subject->description ?: '—' }}
                </span>
              </td>

              <!-- Assigned Students -->
              <td>
                <div class="d-flex flex-wrap gap-1 align-items-center">
                  @forelse($subject->students as $student)
                    <span class="student-pill">
                      <i class="bi bi-person-circle" style="font-size: 11px; opacity: 0.7;"></i>
                      <span>{{ $student->name }}</span>
                      @if(auth()->user()->isAdmin())
                        <form action="{{ route('subjects.unassign', ['subject' => $subject->id, 'student' => $student->id]) }}" 
                              method="POST" 
                              class="d-inline m-0 p-0">
                          @csrf
                          @method('DELETE')
                          <button type="submit" 
                                  class="btn-unassign-student" 
                                  title="Unassign {{ $student->name }}"
                                  onclick="return confirm('Are you sure you want to unassign {{ $student->name }} from {{ $subject->name }}?')">
                            <i class="bi bi-x-circle-fill"></i>
                          </button>
                        </form>
                      @endif
                    </span>
                  @empty
                    <span class="text-muted small fst-italic">
                      <i class="bi bi-info-circle me-1"></i> No students assigned
                    </span>
                  @endforelse
                </div>
              </td>

              <!-- Actions -->
              <td class="text-end">
                @if(auth()->user()->isAdmin())
                  <div class="d-inline-flex gap-1">
                    <a href="{{ route('subjects.assign', $subject) }}" 
                       class="btn-action-assign" 
                       title="Assign Students">
                      <i class="bi bi-person-plus-fill"></i>
                      <span>Assign</span>
                    </a>

                    <a href="{{ route('subjects.edit', $subject) }}" 
                       class="btn-action-edit" 
                       title="Edit Subject">
                      <i class="bi bi-pencil"></i>
                      <span>Edit</span>
                    </a>

                    <form action="{{ route('subjects.destroy', $subject) }}" 
                          method="POST" 
                          class="d-inline m-0"
                          onsubmit="return confirm('Are you sure you want to delete this subject: {{ $subject->name }}?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" 
                              class="btn-action-delete border-0" 
                              title="Delete Subject">
                        <i class="bi bi-trash3"></i>
                        <span>Delete</span>
                      </button>
                    </form>
                  </div>
                @else
                  <span class="view-only-badge">View only</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-5">
                <div style="color: #638c77;">
                  <i class="bi bi-journal-x fs-1 d-block mb-2 opacity-50"></i>
                  <h6 class="fw-bold mb-1">No subjects found</h6>
                  <p class="small text-muted mb-0">Get started by creating your first academic subject.</p>
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
