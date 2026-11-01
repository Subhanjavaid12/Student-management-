@extends('layouts.app', ['title' => 'Reset Password'])

@section('content')
<style>
  .portal-wrapper {
    position: relative;
    min-height: 100vh;
    width: 100%;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: radial-gradient(circle at 50% 35%, #ebf8f0 0%, #d3ede0 50%, #b2dcc5 100%);
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
  }

  .foliage-left {
    position: absolute;
    top: 0;
    left: 0;
    width: 180px;
    pointer-events: none;
    z-index: 1;
    opacity: 0.85;
  }
  .foliage-right {
    position: absolute;
    top: 0;
    right: 0;
    width: 180px;
    pointer-events: none;
    z-index: 1;
    opacity: 0.85;
    transform: scaleX(-1);
  }

  .portal-header {
    position: relative;
    z-index: 5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 32px;
  }
  .brand-badge {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .seal-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #1e5a40;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(30, 90, 64, 0.25);
  }
  .portal-title-sub {
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.5px;
    color: #1a4d36;
    line-height: 1.2;
    text-transform: uppercase;
  }
  .phase-pill {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(46, 125, 89, 0.25);
    padding: 4px 18px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    color: #1e5a40;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
  }

  .hero-headline {
    text-align: center;
    margin-bottom: 24px;
  }
  .hero-headline h1 {
    font-size: 30px;
    font-weight: 800;
    color: #1f543b;
    margin: 0;
  }
  .hero-headline h2 {
    font-size: 20px;
    font-weight: 600;
    font-style: italic;
    color: #2b7050;
    margin: 4px 0 0 0;
  }

  .portal-main-area {
    display: grid;
    grid-template-columns: 1fr 500px 1fr;
    align-items: center;
    gap: 24px;
    padding: 0 24px 30px;
    max-width: 1440px;
    margin: 0 auto;
    width: 100%;
    position: relative;
    z-index: 4;
  }

  .auth-portal-card {
    background: rgba(255, 255, 255, 0.88);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 24px;
    border: 1.5px solid rgba(255, 255, 255, 0.95);
    padding: 34px 30px;
    box-shadow: 0 16px 36px -8px rgba(28, 70, 48, 0.16), 0 0 0 1px rgba(255, 255, 255, 0.6);
  }

  .auth-card-icon {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: #e4f5eb;
    border: 2px solid #a3d9bc;
    color: #1e5a40;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin: 0 auto 16px;
    box-shadow: 0 4px 14px rgba(30, 90, 64, 0.12);
  }

  .auth-portal-card h3 {
    font-size: 22px;
    font-weight: 800;
    color: #1a3d2e;
    text-align: center;
    margin-bottom: 6px;
  }

  .auth-portal-card p.auth-subtext {
    font-size: 13.5px;
    color: #4b6a5a;
    text-align: center;
    margin-bottom: 22px;
    line-height: 1.45;
  }

  .portal-label {
    font-size: 11.5px;
    font-weight: 700;
    color: #23503b;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    box-shadow: 0 0 0 3px rgba(47, 133, 90, 0.2);
  }

  .portal-submit-btn {
    width: 100%;
    height: 46px;
    background: #2b7447;
    border: none;
    border-radius: 10px;
    color: #ffffff !important;
    font-size: 14px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(43, 116, 71, 0.35);
    transition: all 0.2s ease;
  }
  .portal-submit-btn:hover {
    background: #235e3a;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(43, 116, 71, 0.4);
  }

  .back-login-link {
    color: #1e5a40;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: color 0.15s ease;
  }
  .back-login-link:hover {
    color: #143d2c;
    text-decoration: underline;
  }


  @media (max-width: 1024px) {
    .portal-main-area {
      grid-template-columns: 1fr;
      justify-items: center;
      margin-bottom: 24px;
    }
    .side-artwork {
      display: none;
    }
  }
</style>

<div class="portal-wrapper">
  <!-- Top decorative leaves -->
  <svg class="foliage-left" viewBox="0 0 160 160" fill="none">
    <path d="M-20 -20 Q40 40 10 110 Q80 80 120 20 Z" fill="#2d6a4f" opacity="0.65"/>
    <path d="M0 0 Q60 50 40 130 Q110 90 140 10 Z" fill="#40916c" opacity="0.75"/>
    <path d="M20 -10 Q90 60 70 150 Q130 90 160 0 Z" fill="#74c69d" opacity="0.85"/>
  </svg>
  <svg class="foliage-right" viewBox="0 0 160 160" fill="none">
    <path d="M-20 -20 Q40 40 10 110 Q80 80 120 20 Z" fill="#2d6a4f" opacity="0.65"/>
    <path d="M0 0 Q60 50 40 130 Q110 90 140 10 Z" fill="#40916c" opacity="0.75"/>
  </svg>

  <!-- Top bar -->
  <header class="portal-header">
    <div class="brand-badge">
      <div class="seal-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
          <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
        </svg>
      </div>
      <div>
        <div class="portal-title-sub">University</div>
        <div style="font-size: 11px; color: #2e6047; font-weight: 600;">IDENTITY ACCESS & SECURITY</div>
      </div>
    </div>
  </header>

  <!-- Main section -->
  <main>
    <div class="hero-headline">
      <h1>University Student Portal</h1>
      <h2>Create New Password</h2>
    </div>

    <div class="portal-main-area">
      <!-- Left side illustration: Security Shield & Key -->
      <div class="side-artwork" style="text-align: center;">
        <svg width="320" height="300" viewBox="0 0 340 320" fill="none" style="filter: drop-shadow(0 12px 24px rgba(26,61,46,0.15));">
          <rect x="20" y="20" width="300" height="280" rx="16" fill="#e2f1ea"/>
          <path d="M170 65 L245 95 V165 C245 215 170 255 170 255 C170 255 95 215 95 165 V95 Z" fill="#2b7447" opacity="0.9"/>
          <path d="M170 80 L230 105 V162 C230 202 170 238 170 238 C170 238 110 202 110 162 V105 Z" fill="#38a169"/>
          <circle cx="170" cy="145" r="18" fill="#ffffff"/>
          <path d="M165 155 L160 190 H180 L175 155 Z" fill="#ffffff"/>
          <circle cx="170" cy="145" r="6" fill="#1b5337"/>
        </svg>
      </div>

      <!-- Center: Reset Password Card -->
      <div class="auth-portal-card">
        <div class="auth-card-icon">
          <i class="bi bi-key-fill"></i>
        </div>

        <h3>Reset Your Password</h3>
        <p class="auth-subtext">Choose a secure, complex password for your portal account.</p>

        @if ($errors->any())
          <div class="alert alert-danger py-2 mb-3" style="border-radius: 10px; font-size: 12.5px;">
            <ul class="mb-0 ps-3">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <!-- Email -->
          <div style="margin-bottom: 16px;">
            <label class="portal-label" for="email">Email Address</label>
            <div class="input-icon-group">
              <i class="bi bi-envelope input-icon"></i>
              <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email', $email) }}" 
                class="portal-input" 
                autocomplete="email" 
                required
              >
            </div>
          </div>

          <!-- New Password -->
          <div style="margin-bottom: 16px;">
            <label class="portal-label" for="password">New Password</label>
            <div class="input-icon-group">
              <i class="bi bi-lock input-icon"></i>
              <input 
                id="password" 
                type="password" 
                name="password" 
                class="portal-input" 
                placeholder="Minimum 8 characters"
                autocomplete="new-password" 
                required 
                autofocus
              >
            </div>
          </div>

          <!-- Confirm Password -->
          <div style="margin-bottom: 22px;">
            <label class="portal-label" for="password_confirmation">Confirm New Password</label>
            <div class="input-icon-group">
              <i class="bi bi-shield-check input-icon"></i>
              <input 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                class="portal-input" 
                placeholder="Re-enter password"
                autocomplete="new-password" 
                required
              >
            </div>
          </div>

          <button type="submit" class="portal-submit-btn">
            <span>Reset Password</span>
            <i class="bi bi-arrow-right fs-6"></i>
          </button>
        </form>

        <div class="text-center mt-4 pt-2 border-top" style="border-color: #d6e8de !important;">
          <a class="back-login-link" href="{{ route('login') }}">
            <i class="bi bi-arrow-left"></i>
            <span>Back to login portal</span>
          </a>
        </div>
      </div>

      <!-- Right side illustration: Key & Identity Access -->
      <div class="side-artwork" style="text-align: center;">
        <svg width="320" height="300" viewBox="0 0 340 320" fill="none" style="filter: drop-shadow(0 12px 24px rgba(26,61,46,0.15));">
          <circle cx="170" cy="160" r="120" fill="#e2f1ea"/>
          <path d="M100 160 C100 121.34 131.34 90 170 90 C208.66 90 240 121.34 240 160" stroke="#74c69d" stroke-width="4" stroke-dasharray="6 6"/>
          <rect x="135" y="110" width="70" height="90" rx="14" fill="#ffffff" filter="drop-shadow(0 8px 18px rgba(0,0,0,0.08))"/>
          <path d="M150 110 V95 C150 83.95 158.95 75 170 75 C181.05 75 190 83.95 190 95 V110" stroke="#2d6a4f" stroke-width="6" fill="none"/>
          <circle cx="170" cy="145" r="8" fill="#2d6a4f"/>
          <path d="M170 153 V168" stroke="#2d6a4f" stroke-width="4" stroke-linecap="round"/>
          <g transform="translate(60, 190)">
            <rect width="110" height="55" rx="8" fill="#ffffff" filter="drop-shadow(0 4px 10px rgba(0,0,0,0.08))"/>
            <circle cx="24" cy="27" r="10" fill="#10b981"/>
            <path d="M21 27 L23 29 L27 25" stroke="#ffffff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            <text x="42" y="24" font-size="10" font-weight="700" fill="#1b4d3e">Security</text>
            <text x="42" y="38" font-size="11" font-weight="800" fill="#047857">Protection</text>
          </g>
        </svg>
      </div>
    </div>
  </main>

  <!-- Bottom ticker -->
  @include('partials.portal-footer-ticker', ['tickerItems' => ['University System', 'Account Self-Service', 'Secure Authentication', 'IT Help Desk', 'Student Data Protection']])
</div>
@endsection