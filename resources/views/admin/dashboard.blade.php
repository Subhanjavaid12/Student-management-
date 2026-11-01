@extends('layouts.app', ['title' => 'Admin dashboard'])

@section('content')
<style>
  /* Root layout styling matching portal theme */
  .dashboard-wrapper {
    position: relative;
    min-height: 100vh;
    width: 100%;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: radial-gradient(circle at 50% 15%, #eef8f2 0%, #d7eee2 45%, #b9e0cc 100%);
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
  }

  /* Decorative Leaf Accents */
  .foliage-left {
    position: absolute;
    top: 0;
    left: 0;
    width: 180px;
    pointer-events: none;
    z-index: 1;
    opacity: 0.8;
  }
  .foliage-right {
    position: absolute;
    top: 0;
    right: 0;
    width: 180px;
    pointer-events: none;
    z-index: 1;
    opacity: 0.8;
    transform: scaleX(-1);
  }

  /* Top Navigation & Status Bar */
  .portal-nav-bar {
    position: relative;
    z-index: 5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 36px;
    background: rgba(255, 255, 255, 0.45);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.6);
  }
  .brand-badge {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .seal-icon {
    width: 42px;
    height: 42px;
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
  .admin-status-pill {
    background: rgba(255, 255, 255, 0.9);
    border: 1.5px solid rgba(46, 125, 89, 0.3);
    padding: 6px 18px;
    border-radius: 999px;
    font-size: 12.5px;
    font-weight: 700;
    color: #1b5337;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }
  .status-indicator {
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
  }

  /* Main Container */
  .dashboard-content-area {
    position: relative;
    z-index: 4;
    max-width: 1240px;
    margin: 0 auto;
    padding: 36px 24px 48px;
    width: 100%;
  }

  /* Hero Welcome Card */
  .hero-welcome-banner {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.9);
    padding: 24px 32px;
    box-shadow: 0 10px 30px -6px rgba(28, 70, 48, 0.12);
    margin-bottom: 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
  }
  .hero-welcome-banner h1 {
    font-size: 26px;
    font-weight: 800;
    color: #1a4d36;
    margin: 0 0 4px;
  }
  .hero-welcome-banner p {
    font-size: 14px;
    color: #4b6a5a;
    margin: 0;
  }

  /* Management Grid */
  .cards-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }

  /* Modern Frosted Cards */
  .dashboard-tile-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-radius: 20px;
    border: 1.5px solid rgba(255, 255, 255, 0.95);
    padding: 28px;
    box-shadow: 0 12px 30px -6px rgba(28, 70, 48, 0.12);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .dashboard-tile-card:hover {
    transform: translateY(-4px);
    background: rgba(255, 255, 255, 0.96);
    box-shadow: 0 18px 40px -8px rgba(28, 70, 48, 0.2);
    border-color: #a8cbb8;
  }

  .tile-header {
    display: flex;
    align-items: flex-start;
    gap: 18px;
    margin-bottom: 20px;
  }
  .tile-icon-box {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: #e6f4ec;
    border: 1.5px solid #a8cbb8;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1b5337;
    flex-shrink: 0;
  }
  .tile-title {
    font-size: 19px;
    font-weight: 800;
    color: #1a3d2e;
    margin: 0 0 6px;
  }
  .tile-desc {
    font-size: 13.5px;
    color: #557767;
    line-height: 1.45;
    margin: 0;
  }

  /* Action Buttons */
  .tile-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 44px;
    padding: 0 20px;
    background: #2b7447;
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 700;
    border-radius: 10px;
    text-decoration: none !important;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(43, 116, 71, 0.25);
    width: fit-content;
  }
  .tile-action-btn:hover {
    background: #235e3a;
    transform: translateX(2px);
    box-shadow: 0 6px 16px rgba(43, 116, 71, 0.35);
  }

  /* Bottom animated links ticker */


  @media (max-width: 820px) {
    .cards-grid {
      grid-template-columns: 1fr;
    }
    .portal-nav-bar {
      padding: 14px 20px;
    }
    .hero-welcome-banner {
      padding: 20px;
    }
  }
</style>

<div class="dashboard-wrapper">
  <!-- Top decorative foliage[cite: 1, 2] -->
  <svg class="foliage-left" viewBox="0 0 160 160" fill="none">
    <path d="M-20 -20 Q40 40 10 110 Q80 80 120 20 Z" fill="#2d6a4f" opacity="0.65"/>
    <path d="M0 0 Q60 50 40 130 Q110 90 140 10 Z" fill="#40916c" opacity="0.75"/>
    <path d="M20 -10 Q90 60 70 150 Q130 90 160 0 Z" fill="#74c69d" opacity="0.85"/>
  </svg>
  <svg class="foliage-right" viewBox="0 0 160 160" fill="none">
    <path d="M-20 -20 Q40 40 10 110 Q80 80 120 20 Z" fill="#2d6a4f" opacity="0.65"/>
    <path d="M0 0 Q60 50 40 130 Q110 90 140 10 Z" fill="#40916c" opacity="0.75"/>
  </svg>
   <!-- Main Dashboard Content -->
  <main class="dashboard-content-area">
    <!-- Welcome Banner[cite: 1, 2] -->
    <div class="hero-welcome-banner">
      <div>
        <h1>Admin Dashboard</h1>
        <p>Welcome back, <strong>{{ auth()->user()->name }}</strong>. Select an academic module below to configure records.</p>
      </div>
      
    </div>

    <!-- Management Modules 2x2 Grid -->
    <div class="cards-grid">
      <!-- 1. Students Card -->
      <div class="dashboard-tile-card">
        <div class="tile-header">
          <div class="tile-icon-box">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
          </div>
          <div>
            <h2 class="tile-title">Students</h2>
            <p class="tile-desc">View, search, register, and update active student academic records and profiles.</p>
          </div>
        </div>
        <div>
          <a class="tile-action-btn" href="{{ route('students.index') }}">
            <span>Manage students</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="m12 5 7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>

      <!-- 2. Registered Users Card -->
      <div class="dashboard-tile-card">
        <div class="tile-header">
          <div class="tile-icon-box">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <line x1="19" y1="8" x2="19" y2="14"></line>
              <line x1="22" y1="11" x2="16" y2="11"></line>
            </svg>
          </div>
          <div>
            <h2 class="tile-title">Registered Users</h2>
            <p class="tile-desc">Manage system roles, account permissions, access controls, and security credentials.</p>
          </div>
        </div>
        <div>
          <a class="tile-action-btn" href="{{ route('admin.users.index') }}">
            <span>Manage users</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="m12 5 7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>

      <!-- 3. Departments Card -->
      <div class="dashboard-tile-card">
        <div class="tile-header">
          <div class="tile-icon-box">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 21h18"></path>
              <path d="M5 21V7l8-4v18"></path>
              <path d="M19 21V11l-6-4"></path>
              <path d="M9 9h1"></path>
              <path d="M9 13h1"></path>
              <path d="M9 17h1"></path>
            </svg>
          </div>
          <div>
            <h2 class="tile-title">Departments</h2>
            <p class="tile-desc">Create faculties, manage academic programs, and organize department hierarchies.</p>
          </div>
        </div>
        <div>
          <a class="tile-action-btn" href="{{ route('admin.departments.index') }}">
            <span>Manage departments</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="m12 5 7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>

      <!-- 4. Subjects Card -->
      <div class="dashboard-tile-card">
        <div class="tile-header">
          <div class="tile-icon-box">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
              <path d="M6 6h10"></path>
              <path d="M6 10h10"></path>
              <path d="M6 14h6"></path>
            </svg>
          </div>
          <div>
            <h2 class="tile-title">Subjects</h2>
            <p class="tile-desc">Configure course catalogs, syllabus modules, credit hours, and student enrollment.</p>
          </div>
        </div>
        <div>
          <a class="tile-action-btn" href="{{ route('admin.subjects.index') }}">
            <span>Manage subjects</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="m12 5 7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </main>

  <!-- Bottom animated links ticker[cite: 1, 2] -->
  @include('partials.portal-footer-ticker', ['tickerItems' => ['University System', 'Admin Control Center', 'Department Directory', 'Academic Curriculum', 'Support Helpline']])
</div>
@endsection