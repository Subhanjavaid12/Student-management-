@extends('layouts.app', ['title' => 'Edit My Profile'])

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
    padding: 36px 32px;
  }

  /* Form Labels & Controls */
  .portal-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #23503b;
    margin-bottom: 6px;
    display: block;
  }

  .portal-input,
  .portal-textarea {
    width: 100%;
    padding: 9px 14px;
    font-size: 13.5px;
    background: #ffffff;
    border: 1.5px solid #a8cbb8;
    border-radius: 10px;
    color: #1a3d2e;
    transition: all 0.2s ease;
  }
  .portal-input {
    height: 44px;
  }
  .portal-input:focus,
  .portal-textarea:focus {
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

  /* Upload Preview Tiles */
  .upload-box-tile {
    background: #f7fbf9;
    border: 1.5px dashed #b2d7c4;
    border-radius: 14px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 18px;
    transition: all 0.2s ease;
  }
  .upload-box-tile:hover {
    border-color: #2b7447;
    background: #f1f9f4;
  }

  .avatar-preview-ring {
    width: 76px;
    height: 76px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #38a169;
    box-shadow: 0 4px 12px rgba(27, 83, 55, 0.15);
    flex-shrink: 0;
  }

  .file-download-link {
    font-size: 12.5px;
    font-weight: 700;
    color: #1e5a40;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #e4f3eb;
    padding: 6px 12px;
    border-radius: 8px;
    border: 1px solid #b7ddc8;
    transition: all 0.2s ease;
  }
  .file-download-link:hover {
    background: #d3ebd9;
    color: #123e2b;
  }

  /* Form Helper Note */
  .form-note {
    font-size: 11.5px;
    color: #557767;
    margin-top: 4px;
  }

  /* Buttons */
  .btn-portal-submit {
    height: 46px;
    padding: 0 26px;
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
        University • Student Account
      </div>
      <h1>Edit My Profile</h1>
      <p>Update your personal information, contact credentials, and uploaded documents.</p>
    </div>

    <a class="btn-portal-back" href="{{ route('profile.show') }}">
      <i class="bi bi-arrow-left"></i>
      <span>Back to Profile</span>
    </a>
  </div>

  <!-- Form Card -->
  <div class="portal-form-card">
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

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row g-3">
        <!-- Full Name -->
        <div class="col-md-8">
          <label class="portal-label" for="name">
            Full Name <span class="text-danger">*</span>
          </label>
          <input 
            class="portal-input" 
            id="name" 
            name="name" 
            type="text" 
            value="{{ old('name', $student->name) }}" 
            required
          >
        </div>

        <!-- Age -->
        <div class="col-md-4">
          <label class="portal-label" for="age">
            Age <span class="text-danger">*</span>
          </label>
          <input 
            class="portal-input" 
            id="age" 
            name="age" 
            type="number" 
            min="3" 
            max="100" 
            value="{{ old('age', $student->age) }}" 
            required
          >
        </div>

        <!-- CNIC -->
        <div class="col-md-6">
          <label class="portal-label" for="cnic">
            CNIC Number <span class="text-danger">*</span>
          </label>
          <input 
            class="portal-input" 
            id="cnic" 
            name="cnic" 
            inputmode="numeric" 
            pattern="[0-9]{13}" 
            maxlength="13" 
            placeholder="13 digits without hyphens" 
            value="{{ old('cnic', $student->cnic) }}" 
            required
          >
          <div class="form-note">13-digit format (e.g. 3520112345671)</div>
        </div>

        <!-- Phone -->
        <div class="col-md-6">
          <label class="portal-label" for="phone">
            Phone Number <span class="text-danger">*</span>
          </label>
          <input 
            class="portal-input" 
            id="phone" 
            name="phone" 
            inputmode="numeric" 
            pattern="[0-9]{11}" 
            maxlength="11" 
            placeholder="11 digits (e.g. 03001234567)" 
            value="{{ old('phone', $student->phone) }}" 
            required
          >
          <div class="form-note">11-digit mobile number</div>
        </div>

        <!-- Approved Login Email (Disabled) -->
        <div class="col-12">
          <label class="portal-label">Approved Login Email</label>
          <input 
            class="portal-input" 
            value="{{ $student->email }}" 
            disabled
          >
          <div class="form-note">
            <i class="bi bi-info-circle me-1"></i> Contact your department administrator to modify your registered university email.
          </div>
        </div>

        <!-- Residential Address -->
        <div class="col-12">
          <label class="portal-label" for="address">Residential Address</label>
          <textarea 
            class="portal-textarea" 
            id="address" 
            name="address" 
            rows="3" 
            placeholder="Permanent or postal address..."
          >{{ old('address', $student->address) }}</textarea>
        </div>

        <!-- Profile Picture Upload -->
        <div class="col-12">
          <label class="portal-label" for="profile_picture">Profile Picture</label>
          <div class="upload-box-tile">
            <img 
              class="avatar-preview-ring" 
              src="{{ $student->profile_picture ? route('profile.picture') : asset('images/default-avatar.svg') }}" 
              alt="Current profile picture"
            >
            <div style="flex: 1;">
              <input 
                class="form-control portal-input mb-1" 
                id="profile_picture" 
                name="profile_picture" 
                type="file" 
                accept=".jpg,.jpeg,.png"
                style="height: auto; padding: 6px 12px;"
              >
              <div class="form-note">
                Upload a JPG or PNG file (Max 2 MB) to update your current avatar.
              </div>
            </div>
          </div>
        </div>

        <!-- PDF Document Upload -->
        <div class="col-12">
          <label class="portal-label" for="pdf_file">Academic PDF Document</label>
          <div class="upload-box-tile d-block">
            <input 
              class="form-control portal-input mb-2" 
              id="pdf_file" 
              name="pdf_file" 
              type="file" 
              accept=".pdf"
              style="height: auto; padding: 6px 12px;"
            >
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
              <div class="form-note m-0">
                Upload your latest transcript, CNIC copy, or enrollment form (Max 5 MB).
              </div>
              @if($student->pdf_file)
                <a class="file-download-link" href="{{ route('profile.document') }}">
                  <i class="bi bi-file-earmark-pdf-fill text-danger fs-6"></i>
                  <span>Download Current PDF</span>
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="d-flex align-items-center gap-2 pt-4 mt-4 border-top" style="border-color: #e3eee7 !important;">
        <button class="btn-portal-submit" type="submit">
          <i class="bi bi-check2-circle fs-5"></i>
          <span>Save Changes</span>
        </button>
        <a class="btn-portal-cancel" href="{{ route('profile.show') }}">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
