@extends('layouts.app', ['title' => 'Sign in'])

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
    position: sticky;
    top: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 32px;
    background: linear-gradient(110deg, rgba(23, 38, 31, .97), rgba(38, 58, 46, .96) 58%, rgba(58, 41, 36, .97));
    border-bottom: 1px solid rgba(189, 150, 84, .48);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
  }
  .login-campus-nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 6px;
  }
  .login-campus-nav a {
    padding: 8px 10px;
    border: 1px solid rgba(189, 150, 84, .35);
    border-radius: 8px;
    color: #f3e6c7 !important;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    transition: color .2s ease, background-color .2s ease, border-color .2s ease;
  }
  .login-campus-nav a:hover {
    color: #ffffff !important;
    background: rgba(189, 150, 84, .16);
    border-color: rgba(189, 150, 84, .75);
  }
  .login-campus-nav a:focus-visible {
    outline: 2px solid #dfc184;
    outline-offset: 2px;
  }
  .brand-badge {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .seal-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #7b1f2b;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(30, 90, 64, 0.25);
    overflow: hidden;
  }
  .seal-icon img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .portal-title-sub {
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.5px;
    color: #f3e6c7 !important;
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
    margin-bottom: 24px;
  }
  .hero-headline h1 {
    font-size: 32px;
    font-weight: 800;
    color: #1f543b;
    margin: 0;
  }
  .hero-headline h2 {
    font-size: 24px;
    font-weight: 600;
    font-style: italic;
    color: #2b7050;
    margin: 4px 0 0 0;
  }

  /* Center Grid layout */
  .portal-main-area {
    display: grid;
    grid-template-columns: 1fr 440px 1fr;
    align-items: center;
    gap: 24px;
    padding: 0 24px;
    max-width: 1440px;
    margin: 0 auto;
    width: 100%;
    position: relative;
    z-index: 4;
  }

  /* Login Card */
  .auth-portal-card {
    background: rgba(255, 255, 255, 0.82);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.9);
    padding: 32px 30px;
    box-shadow: 0 16px 36px -8px rgba(28, 70, 48, 0.16), 0 0 0 1px rgba(255, 255, 255, 0.6);
  }
  .auth-portal-card h3 {
    font-size: 24px;
    font-weight: 800;
    color: #1a3d2e;
    margin-bottom: 18px;
  }
  .portal-label {
    font-size: 12px;
    font-weight: 700;
    color: #23503b;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: block;
  }
  .portal-input {
    width: 100%;
    height: 46px;
    padding: 10px 14px;
    font-size: 14px;
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

  /* Captcha Box */
  .captcha-row {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .captcha-display {
    width: 90px;
    height: 46px;
    border-radius: 10px;
    background: #f7f3ff;
    border: 1.5px solid #dcd2f3;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 800;
    letter-spacing: 6px;
    color: #4338ca;
    user-select: none;
    transform: skewX(-5deg);
  }
  .captcha-refresh-btn {
    width: 44px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e6f4ec;
    border: 1.5px solid #9dc7af;
    border-radius: 10px;
    cursor: pointer;
    color: #246a48;
    transition: 0.2s;
  }
  .captcha-refresh-btn:hover {
    background: #d4ebd9;
  }
  .captcha-input {
    flex: 1;
    text-transform: uppercase;
  }
  .captcha-error {
    display: none;
    color: #dc2626;
    font-size: 11px;
    font-weight: 600;
    margin-top: 4px;
  }
  .captcha-error.is-visible {
    display: block;
  }

  /* Submit Button */
  .portal-submit-btn {
    width: 100%;
    height: 48px;
    margin-top: 20px;
    background: #2b7447;
    border: none;
    border-radius: 10px;
    color: #ffffff;
    font-size: 15px;
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

  /* Responsive Stacking */
  @media (max-width: 1024px) {
    .portal-main-area {
      grid-template-columns: 1fr;
      justify-items: center;
      margin-bottom: 30px;
    }
    .side-artwork {
      display: none;
    }
  }

  .portal-wrapper {
    justify-content: flex-start;
    min-height: 100vh;
    background:
      radial-gradient(ellipse at 15% 22%, rgba(189, 150, 84, .15), transparent 34rem),
      linear-gradient(135deg, #17261f 0%, #263a2e 54%, #3a2924 100%) !important;
    color: #f7efde;
    font-family: 'Lora', Georgia, serif;
  }
  .portal-header {
    max-width: 1320px;
    width: 100%;
    margin: 0 auto;
    padding: 22px 38px;
    border-bottom: 1px solid rgba(189, 150, 84, .38);
  }
  .seal-icon {
    background: linear-gradient(145deg, #7b2938, #4a1925) !important;
    border: 1px solid rgba(215, 183, 119, .75);
    box-shadow: 0 5px 18px rgba(0, 0, 0, .28);
    border-radius: 12px !important;
  }
  .portal-title-sub {
    color: #f3e6c7 !important;
    font-family: 'Cinzel', Georgia, serif;
  }
  .portal-header .brand-badge > div:last-child > div:last-child {
    color: #d1bd91 !important;
    letter-spacing: 1.5px;
  }
  .hero-headline {
    margin: 38px 20px 26px;
  }
  .hero-headline h1 {
    color: #f4e8cb !important;
    font-family: 'Cinzel', Georgia, serif;
    font-size: clamp(24px, 3vw, 36px);
    letter-spacing: .035em;
  }
  .hero-headline h2 {
    color: #d6bd87 !important;
    font-family: 'Lora', Georgia, serif;
    font-size: 18px;
  }
  .portal-main-area {
    grid-template-columns: minmax(0, 1fr) minmax(360px, 440px);
    align-items: stretch;
    gap: clamp(28px, 5vw, 72px);
    max-width: 1160px;
    margin: 0 auto 36px;
    padding: 0 32px;
  }
  .academy-photo {
    position: relative;
    height: 100%;
    min-height: 420px;
    margin: 0;
    overflow: hidden;
    border: 1px solid rgba(211, 181, 119, .55);
    border-radius: 18px;
    background: #263a2e;
    box-shadow: 0 22px 55px rgba(0, 0, 0, .3);
  }
  .academy-photo::after {
    position: absolute;
    inset: 0;
    content: "";
    background: linear-gradient(180deg, rgba(16, 25, 19, .02) 25%, rgba(16, 25, 19, .82) 100%);
    pointer-events: none;
  }
  .academy-photo img {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 420px;
    object-fit: cover;
    object-position: center;
    filter: saturate(.78) sepia(.12);
  }
  .academy-photo-detail {
    position: absolute;
    z-index: 2;
    top: 18px;
    right: 18px;
    width: 142px;
    overflow: hidden;
    border: 2px solid rgba(248, 241, 223, .9);
    border-radius: 10px;
    background: #18251f;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .35);
    transform: rotate(2deg);
  }
  .academy-photo-detail img {
    display: block;
    width: 100%;
    height: 82px;
    min-height: 0;
    object-fit: cover;
    filter: saturate(.78) sepia(.12);
  }
  .academy-photo-detail span {
    display: block;
    padding: 6px 8px;
    color: #f4e8cb;
    font-family: 'Cinzel', Georgia, serif;
    font-size: 9px;
    letter-spacing: .06em;
    text-align: center;
    text-transform: uppercase;
  }
  .academy-photo-caption {
    position: absolute;
    z-index: 1;
    right: 28px;
    bottom: 28px;
    left: 28px;
    color: #fff4dc;
  }
  .academy-photo-caption strong {
    display: block;
    margin-bottom: 7px;
    color: #e3c987;
    font-family: 'Cinzel', Georgia, serif;
    font-size: 12px;
    letter-spacing: .16em;
    text-transform: uppercase;
  }
  .academy-photo-caption span {
    display: block;
    max-width: 440px;
    font-size: clamp(20px, 2.5vw, 30px);
    line-height: 1.28;
  }
  .academy-photo-credit {
    display: inline-block;
    margin-top: 12px;
    color: #e8d9b9 !important;
    font-size: 11px;
    text-decoration: underline;
    text-underline-offset: 3px;
  }
  .auth-portal-card {
    align-self: center;
    background: linear-gradient(145deg, #fbf6e9, #f0e5cf) !important;
    border: 1px solid #c6ab74 !important;
    border-radius: 16px;
    box-shadow: 0 22px 55px rgba(0, 0, 0, .32), inset 0 1px rgba(255, 255, 255, .9);
  }
  .auth-portal-card h3 {
    color: #263a2e !important;
    font-family: 'Cinzel', Georgia, serif;
    font-size: 26px;
  }
  .portal-label {
    color: #4a382a !important;
    font-family: 'Cinzel', Georgia, serif;
    letter-spacing: .08em;
  }
  .portal-input {
    background: #fffaf0 !important;
    border-color: #cdbd9d !important;
    color: #342b21 !important;
    font-family: 'Lora', Georgia, serif;
  }
  .portal-input:focus {
    border-color: #315b46 !important;
    box-shadow: 0 0 0 3px rgba(49, 91, 70, .18) !important;
  }
  .pw-toggle-btn {
    color: #756957 !important;
  }
  .captcha-display {
    background: #eee3cd !important;
    border-color: #d5c29d !important;
    color: #7b2938 !important;
  }
  .captcha-refresh-btn {
    background: #e8efe5 !important;
    border-color: #b9c9ae !important;
    color: #315b46 !important;
  }
  .portal-submit-btn {
    background: linear-gradient(135deg, #315b46, #234333) !important;
    border: 1px solid #bd9654;
    color: #fff8e8;
    font-family: 'Cinzel', Georgia, serif;
    letter-spacing: .05em;
  }
  .portal-submit-btn:hover {
    background: linear-gradient(135deg, #3d6a53, #294a38) !important;
  }
  .auth-portal-card a {
    color: #7b2938 !important;
  }
  .auth-portal-card p {
    color: #756957 !important;
  }

  @media (max-width: 1024px) {
    .portal-main-area {
      grid-template-columns: minmax(0, 1fr) minmax(340px, 440px);
      max-width: 960px;
    }
    .side-artwork {
      display: block !important;
    }
    .academy-photo,
    .academy-photo img {
      min-height: 390px;
    }
  }
  @media (max-width: 760px) {
    .portal-header {
      align-items: flex-start;
      flex-direction: column;
      gap: 14px;
      padding: 16px 20px;
    }
    .login-campus-nav { justify-content: flex-start; }
    .hero-headline {
      margin: 28px 16px 20px;
    }
    .portal-main-area {
      grid-template-columns: 1fr;
      max-width: 540px;
      gap: 18px;
      padding: 0 18px;
    }
    .academy-photo,
    .academy-photo img {
      min-height: 190px;
      height: 190px;
    }
    .academy-photo-caption {
      right: 18px;
      bottom: 16px;
      left: 18px;
    }
    .academy-photo-caption span {
      font-size: 21px;
    }
    .auth-portal-card {
      padding: 26px 22px;
    }
  }
</style>

<div class="portal-wrapper">
  <header class="portal-header">
    <div class="brand-badge">
      <div class="seal-icon">
        <img src="{{ asset('images/hagwards-logo.svg') }}" alt="Hagwards logo" aria-label="Hagwards logo">
      </div>
      <div>
        <div class="portal-title-sub">HAGWARDS</div>
        <div style="font-size: 11px; color: #d1bd91; font-weight: 600;">STUDENT MANAGEMENT SYSTEM</div>
      </div>
    </div>

    <nav class="login-campus-nav" aria-label="Campus pages">
      <a href="{{ route('portal.pages.show', 'library') }}">Library</a>
      <a href="{{ route('portal.pages.show', 'academic-records') }}">Academic Records</a>
      <a href="{{ route('portal.pages.show', 'community') }}">Student Community</a>
      <a href="{{ route('portal.pages.show', 'discovery') }}">Knowledge and Discovery</a>
      <a href="{{ route('portal.pages.show', 'help-desk') }}">Help Desk</a>
    </nav>
  </header>

  <!-- Main section -->
  <main>
    <div class="hero-headline">
      <h1> University Student Portal</h1>
      <h2>Curiosity opens every door</h2>
    </div>

    <div class="portal-main-area">
      <div class="side-artwork">
        <figure class="academy-photo">
          <img src="{{ asset('images/academy-castle.jpg') }}" alt="A stone castle with pointed towers emerging through the mist" fetchpriority="high">
          
          <figcaption class="academy-photo-caption">
            <strong>A tradition of learning</strong>
            <span>Step into a place where knowledge shapes the future.</span>
          </figcaption>
        </figure>
      </div>

      <!-- Center: Login Card -->
      <div class="auth-portal-card">
        <h3>Login</h3>

        @if (session('status'))
          <div class="alert alert-success py-2 mb-3" style="font-size: 13px;">{{ session('status') }}</div>
        @endif

        @if($errors->has('email') || $errors->has('password'))
          <div class="alert alert-danger py-2 mb-3" style="font-size: 13px;">{{ $errors->first('email') ?: $errors->first('password') }}</div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" id="loginForm">
          @csrf

          <!-- Student Email / ID -->
          <div style="margin-bottom: 16px;">
            <label class="portal-label" for="email"> Email</label>
            <input 
              class="portal-input" 
              id="email" 
              name="email" 
              type="email" 
              placeholder="e.g. name@gmail.com" 
              value="{{ old('email') }}" 
              autocomplete="email" 
              required 
              autofocus
            >
          </div>

          <!-- Password -->
          <div style="margin-bottom: 16px;">
            <label class="portal-label" for="password">Password</label>
            <div class="input-with-toggle">
              <input 
                class="portal-input" 
                id="password" 
                name="password" 
                type="password" 
                placeholder="Enter password" 
                autocomplete="current-password" 
                required
                style="padding-right: 40px;"
              >
              <button type="button" class="pw-toggle-btn" id="togglePasswordBtn" aria-label="Toggle password visibility">
                <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>

          <!-- Captcha Row -->
          <div style="margin-bottom: 12px;">
            <label class="portal-label" for="captchaInput">Captcha</label>
            <div class="captcha-row">
              <div class="captcha-display" id="captchaBox" aria-label="Captcha challenge">{{ implode(' ', str_split(session('login_captcha', ''))) }}</div>
              <button type="button" class="captcha-refresh-btn" id="refreshCaptchaBtn" data-refresh-url="{{ route('login.captcha') }}" title="Refresh Captcha" aria-label="Refresh captcha">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.19"/>
                </svg>
              </button>
              <input 
                type="text" 
                id="captchaInput" 
                name="captcha" 
                class="portal-input captcha-input" 
                placeholder="Enter Captcha" 
                maxlength="3" 
                required
                aria-describedby="captchaError"
              >
            </div>
            <div id="captchaError" class="captcha-error {{ $errors->has('captcha') ? 'is-visible' : '' }}" role="alert">{{ $errors->first('captcha') ?: 'Incorrect captcha. Please re-enter.' }}</div>
          </div>

          <div style="display: flex; justify-content: flex-end; margin-top: 8px;">
            <a href="{{ route('password.request') }}" style="font-size: 12px; font-weight: 600; color: #246a48; text-decoration: none;">Forgot Password?</a>
          </div>

          <button class="portal-submit-btn" type="submit">
            <span>Login</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="m12 5 7 7-7 7"></path>
            </svg>
          </button>
        </form>

        <p style="text-align: center; font-size: 13px; color: #4b6a5a; margin-top: 20px; margin-bottom: 0;">
          Need an account? 
          <a href="{{ route('register') }}" style="color: #1b5337; font-weight: 700; text-decoration: underline;">Register</a>
        </p>
      </div>

    </div>
  </main>

  @include('partials.portal-footer-ticker', ['tickerItems' => ['University Library', 'Academic Records', 'Student Community', 'Knowledge and Discovery', 'A Tradition of Learning', 'University Help Desk']])
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // 1. Password Visibility Toggle
    const pwInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const eyeIcon = document.getElementById('eyeIcon');

    toggleBtn?.addEventListener('click', () => {
      const isPassword = pwInput.type === 'password';
      pwInput.type = isPassword ? 'text' : 'password';
      eyeIcon.innerHTML = isPassword
        ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
    });

    // 2. Refresh the server-generated captcha
    const captchaBox = document.getElementById('captchaBox');
    const refreshBtn = document.getElementById('refreshCaptchaBtn');
    const captchaInput = document.getElementById('captchaInput');
    const captchaError = document.getElementById('captchaError');

    refreshBtn?.addEventListener('click', async () => {
      refreshBtn.disabled = true;

      try {
        const response = await fetch(refreshBtn.dataset.refreshUrl, {
          headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
          credentials: 'same-origin',
        });
        if (!response.ok) throw new Error('Unable to refresh captcha');

        const data = await response.json();
        if (captchaBox) captchaBox.textContent = data.captcha.split('').join(' ');
        if (captchaInput) captchaInput.value = '';
        if (captchaError) captchaError.style.display = 'none';
      } catch (error) {
        if (captchaError) {
          captchaError.textContent = 'Could not refresh captcha. Please reload the page.';
          captchaError.style.display = 'block';
        }
      } finally {
        refreshBtn.disabled = false;
      }
    });

    captchaInput?.addEventListener('input', () => {
      // Auto uppercase as user types
      captchaInput.value = captchaInput.value.toUpperCase();
      if (captchaError) captchaError.style.display = 'none';
    });
  });
</script>
@endsection
