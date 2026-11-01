@extends('layouts.app', ['title' => 'Edit User - ' . $user->name])

@section('content')
<style>
  .portal-page-container {
    max-width: 760px;
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

  /* User Info Preview Banner */
  .user-badge-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f4faf6;
    border: 1.5px solid #d5ece0;
    border-radius: 16px;
    padding: 16px 20px;
    margin-bottom: 26px;
  }
  .user-avatar-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #e3f2ea;
    color: #1e5a40;
    font-size: 20px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #a3d3ba;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    flex-shrink: 0;
  }

  /* Form Controls & Inputs */
  .portal-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #23503b;
    margin-bottom: 6px;
    display: block;
  }

  .input-icon-group {
    position: relative;
  }
  .input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #5d7e6f;
    font-size: 16px;
  }

  .portal-input {
    width: 100%;
    height: 46px;
    padding: 8px 14px 8px 40px;
    font-size: 13.5px;
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    border-radius: 10px;
    color: #1a3d2e;
    transition: all 0.2s ease;
  }
  .portal-input:focus {
    outline: none;
    border-color: #2f855a;
    box-shadow: 0 0 0 3px rgba(47, 133, 90, 0.18);
  }
  .portal-input:disabled {
    background-color: #f1f6f3;
    border-color: #d1e2d7;
    color: #6a887b;
    cursor: not-allowed;
  }

  /* Interactive Role Selector Cards */
  .role-picker-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-top: 8px;
  }
  .role-select-card {
    border: 1.5px solid #cde5d7;
    background: #ffffff;
    border-radius: 12px;
    padding: 14px 16px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }
  .role-select-card:hover {
    border-color: #2f855a;
    background: #f8fcf9;
  }
  .role-select-card:has(input[type="radio"]:checked) {
    border-color: #2b7447;
    background: #eef7f2;
    box-shadow: 0 0 0 1.5px #2b7447;
  }
  .role-card-radio {
    margin-top: 3px;
    accent-color: #2b7447;
    width: 16px;
    height: 16px;
  }

  /* Form Helpers */
  .form-help-box {
    background: #fbfdfc;
    border: 1px solid #e1efe7;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    color: #496f5c;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
  }

  /* Buttons */
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
    cursor: pointer;
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
        University • Access Control
      </div>
      <h1>Edit User</h1>
      <p>Update credentials, account details, and permissions for <strong>{{ $user->name }}</strong>.</p>
    </div>

    <a class="btn-portal-back" href="{{ route('admin.users.index') }}">
      <i class="bi bi-arrow-left"></i>
      <span>Back to Users</span>
    </a>
  </div>

  <!-- Form Card -->
  <div class="portal-form-card">
    <!-- Active Account Banner -->
    <div class="user-badge-header">
      <div class="d-flex align-items-center gap-3">
        <div class="user-avatar-circle">
          {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
          <div class="fw-bold text-dark fs-6">{{ $user->name }}</div>
          <div class="text-muted" style="font-size: 12px;">ID: #USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</div>
        </div>
      </div>
      <div>
        <span class="badge" style="background: #2b7447; color: #ffffff; font-size: 11px; padding: 6px 12px; border-radius: 999px;">
          Current: {{ ucfirst($user->role ?? 'User') }}
        </span>
      </div>
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

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
      @csrf
      @method('PUT')

      <!-- Name -->
      <div class="mb-3">
        <label class="portal-label" for="name">Full Name</label>
        <div class="input-icon-group">
          <i class="bi bi-person input-icon"></i>
          <input 
            class="portal-input" 
            id="name" 
            name="name" 
            type="text" 
            value="{{ old('name', $user->name) }}" 
            required 
            autofocus
          >
        </div>
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label class="portal-label" for="email">Email Address</label>
        <div class="input-icon-group">
          <i class="bi bi-envelope input-icon"></i>
          <input 
            class="portal-input" 
            id="email" 
            name="email" 
            type="email" 
            value="{{ old('email', $user->email) }}" 
            required
          >
        </div>
      </div>

      <!-- Role Selection Section -->
      @if((int) auth()->id() === (int) $user->id)
        <div class="mb-4">
          <label class="portal-label">System Role</label>
          <div class="input-icon-group">
            <i class="bi bi-shield-lock input-icon"></i>
            <input 
              class="portal-input" 
              value="{{ ucfirst($user->role) }}" 
              disabled
            >
          </div>
          <div class="form-help-box">
            <i class="bi bi-info-circle-fill text-muted"></i>
            <span>Your own account role is locked to prevent administrative lockout.</span>
          </div>
        </div>
      @else
        <div class="mb-4">
          <label class="portal-label">System Role Assignment</label>
          <div class="role-picker-grid">
            <!-- Standard User Option -->
            <label class="role-select-card" for="role_user">
              <input 
                type="radio" 
                id="role_user" 
                name="role" 
                value="user" 
                class="role-card-radio" 
                @checked(old('role', $user->role) === 'user')
              >
              <div>
                <div class="fw-bold text-dark d-flex align-items-center gap-1" style="font-size: 13.5px;">
                  <i class="bi bi-person text-secondary"></i>
                  <span>Standard User</span>
                </div>
                <div class="text-muted small" style="font-size: 11.5px; margin-top: 2px;">
                  Standard view permissions
                </div>
              </div>
            </label>

            <!-- Admin Option -->
            <label class="role-select-card" for="role_admin">
              <input 
                type="radio" 
                id="role_admin" 
                name="role" 
                value="admin" 
                class="role-card-radio" 
                @checked(old('role', $user->role) === 'admin')
              >
              <div>
                <div class="fw-bold text-dark d-flex align-items-center gap-1" style="font-size: 13.5px;">
                  <i class="bi bi-shield-check text-success"></i>
                  <span>Administrator</span>
                </div>
                <div class="text-muted small" style="font-size: 11.5px; margin-top: 2px;">
                  Full management access
                </div>
              </div>
            </label>
          </div>

          <div class="form-help-box">
            <i class="bi bi-shield-exclamation text-success"></i>
            <span>A maximum of three active administrators is permitted across the portal.</span>
          </div>
        </div>
      @endif

      <!-- Actions -->
      <div class="d-flex align-items-center gap-2 pt-3 border-top" style="border-color: #e3eee7 !important;">
        <button class="btn-portal-submit" type="submit">
          <i class="bi bi-check2-circle fs-5"></i>
          <span>Save Changes</span>
        </button>
        <a class="btn-portal-cancel" href="{{ route('admin.users.index') }}">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection