@extends('layouts.app', ['title' => 'Create account'])

@section('content')
<style>
  /* Root layout overrides */
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

  /* Foliage Accents */
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

  /* Header styles */
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

  /* Hero Title */
  .hero-headline {
    text-align: center;
    margin-bottom: 20px;
  }
  .hero-headline h1 {
    font-size: 30px;
    font-weight: 800;
    color: #1f543b;
    margin: 0;
  }
  .hero-headline h2 {
    font-size: 22px;
    font-weight: 600;
    font-style: italic;
    color: #2b7050;
    margin: 4px 0 0 0;
  }

  /* Center Grid layout */
  .portal-main-area {
    display: grid;
    grid-template-columns: 1fr 480px 1fr;
    align-items: center;
    gap: 24px;
    padding: 0 24px 24px 24px;
    max-width: 1440px;
    margin: 0 auto;
    width: 100%;
    position: relative;
    z-index: 4;
  }

  /* Register Card */
  .auth-portal-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.9);
    padding: 30px 28px;
    box-shadow: 0 16px 36px -8px rgba(28, 70, 48, 0.16), 0 0 0 1px rgba(255, 255, 255, 0.6);
  }
  .auth-portal-card h3 {
    font-size: 22px;
    font-weight: 800;
    color: #1a3d2e;
    margin-bottom: 4px;
  }
  .auth-portal-card .card-subtitle {
    font-size: 13px;
    color: #4b6a5a;
    margin-bottom: 18px;
  }

  .portal-label {
    font-size: 11.5px;
    font-weight: 700;
    color: #23503b;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: block;
  }
  .portal-input {
    width: 100%;
    height: 44px;
    padding: 8px 14px;
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
  .input-with-toggle {
    position: relative;
  }
  .pw-toggle-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    color: #5d7e6f;
  }

  .form-help-text {
    font-size: 11px;
    color: #4b6a5a;
    margin-top: 4px;
  }

  /* Submit Button */
  .portal-submit-btn {
    width: 100%;
    height: 46px;
    margin-top: 18px;
    background: #2b7447;
    border: none;
    border-radius: 10px;
    color: #ffffff;
    font-size: 14.5px;
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
    box-shadow: 0 6px 16px rgba(43, 116, 71, 0.4);
  }

  /* Bottom Marquee */


  /* Responsive Stacking */
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
  <!-- Top decorative leaves[cite: 1, 2] -->
  <svg class="foliage-left" viewBox="0 0 160 160" fill="none">
    <path d="M-20 -20 Q40 40 10 110 Q80 80 120 20 Z" fill="#2d6a4f" opacity="0.65"/>
    <path d="M0 0 Q60 50 40 130 Q110 90 140 10 Z" fill="#40916c" opacity="0.75"/>
    <path d="M20 -10 Q90 60 70 150 Q130 90 160 0 Z" fill="#74c69d" opacity="0.85"/>
  </svg>
  <svg class="foliage-right" viewBox="0 0 160 160" fill="none">
    <path d="M-20 -20 Q40 40 10 110 Q80 80 120 20 Z" fill="#2d6a4f" opacity="0.65"/>
    <path d="M0 0 Q60 50 40 130 Q110 90 140 10 Z" fill="#40916c" opacity="0.75"/>
  </svg>

  <!-- Top bar[cite: 1, 2] -->
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
        <div style="font-size: 11px; color: #2e6047; font-weight: 600;">STUDENT ENROLLMENT PORTAL</div>
      </div>
    </div>
  </header>

  <!-- Main section[cite: 1, 2] -->
  <main>
    <div class="hero-headline">
      <h1>University Student Portal</h1>
      <h2>Create Your Account</h2>
    </div>

    <div class="portal-main-area">
      <!-- Left side illustration: Modern campus tower badge[cite: 2] -->
      <div class="side-artwork" style="text-align: center;">
        <svg width="340" height="320" viewBox="0 0 340 320" fill="none" style="filter: drop-shadow(0 12px 24px rgba(26,61,46,0.15));">
          <rect x="20" y="20" width="300" height="280" rx="16" fill="#e2f1ea"/>
          <!-- Campus building silhouettes -->
          <path d="M50 250 L50 140 L70 120 L90 140 L90 250 Z" fill="#a45a4b"/>
          <path d="M90 250 L90 110 L130 90 L170 110 L170 250 Z" fill="#b96856"/>
          <path d="M170 250 L170 130 L200 115 L230 130 L230 250 Z" fill="#8f4d3f"/>
          <!-- Central Clock Tower -->
          <path d="M110 90 Q130 50 150 90 Z" fill="#2d6a4f"/>
          <circle cx="130" cy="115" r="9" fill="#fefae0" stroke="#8f4d3f" stroke-width="2"/>
          <rect x="105" y="145" width="14" height="24" rx="7" fill="#fdf0ed"/>
          <rect x="140" y="145" width="14" height="24" rx="7" fill="#fdf0ed"/>
          <rect x="115" y="195" width="30" height="55" rx="15" fill="#582a20"/>
          <!-- Student Registration Card -->
          
        </svg>
      </div>

      <!-- Center: Register Card[cite: 1, 2] -->
      <div class="auth-portal-card">
        <h3>Create your account</h3>
        <p class="card-subtitle">Get started with the University student portal.</p>

        @if($errors->any())
          <div class="alert alert-danger py-2 mb-3" style="font-size: 13px;">
            <ul class="mb-0 ps-3">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
          @csrf

          <!-- Full Name -->
          <div style="margin-bottom: 14px;">
            <label class="portal-label" for="name">Full Name</label>
            <input 
              class="portal-input" 
              id="name" 
              name="name" 
              type="text" 
              placeholder="e.g. Muhammad Ali" 
              value="{{ old('name') }}" 
              autocomplete="name" 
              required 
              autofocus
            >
          </div>

          <!-- Email Address -->
          <div style="margin-bottom: 14px;">
            <label class="portal-label" for="email">Email Address</label>
            <input 
              class="portal-input" 
              id="email" 
              name="email" 
              type="email" 
              placeholder="e.g. name@gmail.com" 
              value="{{ old('email') }}" 
              autocomplete="email" 
              required
            >
          </div>

          <!-- Password -->
          <div style="margin-bottom: 14px;">
            <label class="portal-label" for="password">Password</label>
            <div class="input-with-toggle">
              <input 
                class="portal-input" 
                id="password" 
                name="password" 
                type="password" 
                placeholder="Create password" 
                autocomplete="new-password" 
                required
                style="padding-right: 40px;"
              >
              <button type="button" class="pw-toggle-btn" id="togglePasswordBtn" aria-label="Toggle password visibility">
                <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
            <div class="form-help-text">At least 8 characters, with uppercase, lowercase, and a number.</div>
          </div>

          <!-- Confirm Password -->
          <div style="margin-bottom: 16px;">
            <label class="portal-label" for="password_confirmation">Confirm Password</label>
            <div class="input-with-toggle">
              <input 
                class="portal-input" 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                placeholder="Repeat password" 
                autocomplete="new-password" 
                required
                style="padding-right: 40px;"
              >
              <button type="button" class="pw-toggle-btn" id="toggleConfirmBtn" aria-label="Toggle confirm password visibility">
                <svg id="eyeIconConfirm" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>

          <!-- Submit Button -->
          <button class="portal-submit-btn" type="submit">
            <span>Create account</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="m12 5 7 7-7 7"></path>
            </svg>
          </button>
        </form>

        <p style="text-align: center; font-size: 13px; color: #4b6a5a; margin-top: 18px; margin-bottom: 0;">
          Already registered? 
          <a href="{{ route('login') }}" style="color: #1b5337; font-weight: 700; text-decoration: underline;">Sign in</a>
        </p>
      </div>

      <!-- Right side illustration: Isometric Education & Analytics[cite: 2] -->
      <div class="side-artwork" style="text-align: center;">
        <svg width="340" height="320" viewBox="0 0 340 320" fill="none" style="filter: drop-shadow(0 12px 24px rgba(26,61,46,0.15));">
          <!-- Isometric Book Base -->
          <path d="M50 200 L170 240 L290 200 L170 160 Z" fill="#93c5fd" opacity="0.4"/>
          <path d="M50 200 L170 240 L170 255 L50 215 Z" fill="#3b82f6" opacity="0.7"/>
          <path d="M290 200 L170 240 L170 255 L290 215 Z" fill="#1d4ed8" opacity="0.8"/>

          <!-- Open Book Pages -->
          <path d="M60 190 Q115 170 170 195 Q225 170 280 190 L280 205 Q225 185 170 210 Q115 185 60 205 Z" fill="#ffffff"/>

          <!-- Network Connection Nodes -->
          <circle cx="170" cy="110" r="18" fill="#3b82f6"/>
          <path d="M162 110 L170 102 L178 110 L170 118 Z" fill="#ffffff"/>
          <circle cx="110" cy="140" r="9" fill="#60a5fa"/>
          <circle cx="230" cy="130" r="11" fill="#2563eb"/>
          <circle cx="260" cy="90" r="8" fill="#93c5fd"/>

          <path d="M170 110 L110 140 M170 110 L230 130 M230 130 L260 90" stroke="#60a5fa" stroke-width="2.5" stroke-dasharray="3 3"/>

          <!-- Floating Dashboard Widget -->
          <g transform="translate(190, 160)">
            <rect width="100" height="60" rx="8" fill="#ffffff" filter="drop-shadow(0 4px 10px rgba(0,0,0,0.1))"/>
            <rect x="12" y="32" width="10" height="18" rx="2" fill="#3b82f6"/>
            <rect x="28" y="22" width="10" height="28" rx="2" fill="#10b981"/>
            <rect x="44" y="14" width="10" height="36" rx="2" fill="#6366f1"/>
            <line x1="12" y1="52" x2="88" y2="52" stroke="#e5e7eb" stroke-width="2"/>
          </g>
        </svg>
      </div>
    </div>
  </main>

  <!-- Bottom animated ticker[cite: 1, 2] -->
  @include('partials.portal-footer-ticker', ['tickerItems' => ['Superior Admissions', 'Degree Programs', 'Campus Maps', 'Fee Structure', 'Student Portal Support', 'University Helpline']])
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Password Toggle Helper
    function setupPasswordToggle(inputId, buttonId, iconId) {
      const input = document.getElementById(inputId);
      const button = document.getElementById(buttonId);
      const icon = document.getElementById(iconId);

      button?.addEventListener('click', () => {
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        icon.innerHTML = isPassword
          ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>'
          : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
      });
    }

    setupPasswordToggle('password', 'togglePasswordBtn', 'eyeIcon');
    setupPasswordToggle('password_confirmation', 'toggleConfirmBtn', 'eyeIconConfirm');
  });
</script>
@endsection