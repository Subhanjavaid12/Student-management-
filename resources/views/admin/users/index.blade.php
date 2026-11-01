@extends('layouts.app', ['title' => 'Registered Users'])

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

  /* Back to Dashboard Button */
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

  /* User Avatar */
  .user-avatar-badge {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #e3f2ea;
    color: #1e5a40;
    font-weight: 800;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid #a3d3ba;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    flex-shrink: 0;
  }

  /* Role Badges */
  .role-badge-admin {
    background: #e8f5ee;
    color: #1e5a40;
    font-weight: 700;
    font-size: 11.5px;
    padding: 4px 12px;
    border-radius: 999px;
    border: 1px solid #b8dfca;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .role-badge-user {
    background: #f3f4f6;
    color: #4b5563;
    font-weight: 600;
    font-size: 11.5px;
    padding: 4px 12px;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  /* "You" Pill */
  .current-user-tag {
    background: #1e5a40;
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 2px 7px;
    border-radius: 6px;
    margin-left: 6px;
  }

  /* Action Buttons */
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

  .protected-user-badge {
    background: #f9fafb;
    color: #6b7280;
    border: 1px solid #e5e7eb;
    font-size: 11px;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
</style>

<div class="portal-page-container">
  <!-- Top Banner / Header -->
  <div class="portal-header-card">
    <div>
      <div style="font-size: 11px; font-weight: 800; color: #2d6a4f; text-transform: uppercase; letter-spacing: 0.6px;">
        University • Access Control
      </div>
      <h1>Registered Users</h1>
      <p>Manage user accounts, administrative privileges, and system roles.</p>
    </div>

    <a class="btn-portal-back" href="{{ route('admin.dashboard') }}">
      <i class="bi bi-arrow-left"></i>
      <span>Back to Dashboard</span>
    </a>
  </div>

  <!-- Users Table Card -->
  <div class="portal-table-card">
    <div class="table-responsive">
      <table class="portal-table">
        <thead>
          <tr>
            <th scope="col" style="width: 28%;">User</th>
            <th scope="col" style="width: 28%;">Email Address</th>
            <th scope="col" style="width: 16%;">Role</th>
            <th scope="col" style="width: 14%;">Registered</th>
            <th scope="col" class="text-end" style="width: 14%;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
            <tr>
              <!-- Name & Initial Avatar -->
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div class="user-avatar-badge">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                  </div>
                  <div>
                    <div class="d-flex align-items-center">
                      <span class="fw-bold text-dark">{{ $user->name }}</span>
                      @if((int) auth()->id() === (int) $user->id)
                        <span class="current-user-tag">You</span>
                      @endif
                    </div>
                    <small class="text-muted" style="font-size: 11px;">ID: #USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</small>
                  </div>
                </div>
              </td>

              <!-- Email -->
              <td>
                <div class="d-flex align-items-center gap-1">
                  <i class="bi bi-envelope text-muted" style="font-size: 12px;"></i>
                  <span class="text-secondary">{{ $user->email }}</span>
                </div>
              </td>

              <!-- Role -->
              <td>
                @if($user->role === 'admin')
                  <span class="role-badge-admin">
                    <i class="bi bi-shield-check"></i>
                    <span>Admin</span>
                  </span>
                @else
                  <span class="role-badge-user">
                    <i class="bi bi-person"></i>
                    <span>{{ ucfirst($user->role ?? 'User') }}</span>
                  </span>
                @endif
              </td>

              <!-- Registered Date -->
              <td>
                <span class="text-secondary" style="font-size: 12.5px;">
                  {{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}
                </span>
              </td>

              <!-- Actions -->
              <td class="text-end">
                <div class="d-inline-flex align-items-center gap-1">
                  <a href="{{ route('admin.users.edit', $user) }}" 
                     class="btn-action-edit" 
                     title="Edit User">
                    <i class="bi bi-pencil"></i>
                    <span>Edit</span>
                  </a>

                  @if((int) auth()->id() !== (int) $user->id)
                    <form action="{{ route('admin.users.destroy', $user) }}" 
                          method="POST" 
                          class="d-inline m-0 p-0"
                          onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}? This action cannot be undone.')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" 
                              class="btn-action-delete border-0" 
                              title="Delete User">
                        <i class="bi bi-trash3"></i>
                        <span>Delete</span>
                      </button>
                    </form>
                  @else
                    <span class="protected-user-badge" title="Active session account">
                      <i class="bi bi-lock-fill"></i>
                      <span>Current</span>
                    </span>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-5">
                <div style="color: #638c77;">
                  <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                  <h6 class="fw-bold mb-1">No registered users found</h6>
                  <p class="small text-muted mb-0">System user accounts will appear here.</p>
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
