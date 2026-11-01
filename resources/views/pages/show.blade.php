<style>
  .campus-page {
    max-width: 1100px;
    margin: 0 auto;
    padding: clamp(28px, 6vw, 72px) 22px;
    animation: campus-page-enter .65s ease both;
  }
  .campus-hero {
    display: grid;
    grid-template-columns: minmax(0, 1.1fr) minmax(300px, .9fr);
    min-height: 360px;
    overflow: hidden;
    border: 1px solid rgba(189, 150, 84, .45);
    border-radius: 18px;
    color: #f7efde;
    background: #1b2c23;
    box-shadow: 0 18px 42px rgba(23, 33, 25, .18);
  }
  .campus-hero-copy {
    align-self: center;
    padding: clamp(28px, 5vw, 56px);
  }
  .campus-hero-image {
    position: relative;
    min-height: 320px;
    overflow: hidden;
    background: #315b46;
  }
  .campus-hero-image::after {
    position: absolute;
    inset: 0;
    content: '';
    background: linear-gradient(90deg, rgba(27, 44, 35, .4), transparent 48%), linear-gradient(0deg, rgba(27, 44, 35, .15), transparent 50%);
  }
  .campus-hero-image img {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 360px;
    object-fit: cover;
    object-position: center;
    transition: transform .7s ease;
  }
  .campus-hero:hover .campus-hero-image img { transform: scale(1.035); }
  .campus-eyebrow {
    color: #dfc184;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
  }
  .campus-hero h1 {
    margin: 12px 0;
    color: #f4e8cb;
    font-family: 'Cinzel', Georgia, serif;
    font-size: clamp(30px, 5vw, 48px);
  }
  .campus-hero p {
    max-width: 680px;
    margin: 0;
    color: #e8dcc3;
    font-size: 17px;
    line-height: 1.7;
  }
  .campus-sections {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 18px;
    margin-top: 22px;
  }
  .campus-card {
    padding: 24px;
    border: 1px solid rgba(49, 91, 70, .12);
    border-radius: 16px;
    background: rgba(255, 255, 255, .78);
    box-shadow: 0 8px 24px rgba(23, 33, 25, .07);
    transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    animation: campus-card-enter .55s ease both;
  }
  .campus-card:nth-child(2) { animation-delay: .08s; }
  .campus-card:nth-child(3) { animation-delay: .16s; }
  .campus-card:hover {
    transform: translateY(-4px);
    border-color: rgba(189, 150, 84, .65);
    box-shadow: 0 14px 30px rgba(23, 33, 25, .12);
  }
  .campus-card h2 {
    color: #315b46;
    font-family: 'Cinzel', Georgia, serif;
    font-size: 19px;
  }
  .campus-card p {
    margin: 0;
    color: #554b3d;
    line-height: 1.7;
  }
  .campus-actions { margin-top: 24px; }
  .campus-actions a {
    display: inline-block;
    padding: 11px 18px;
    border: 1px solid #bd9654;
    border-radius: 9px;
    color: #fff8e8 !important;
    background: #315b46;
    font-weight: 700;
    text-decoration: none;
  }
  .campus-actions a { transition: transform .2s ease, background-color .2s ease, box-shadow .2s ease; }
  .campus-actions a:hover { color: #ffffff !important; background: #234333; transform: translateY(-2px); box-shadow: 0 7px 18px rgba(23, 33, 25, .18); }
  @keyframes campus-page-enter {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes campus-card-enter {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @media (max-width: 720px) {
    .campus-page { padding: 22px 16px 44px; }
    .campus-hero { grid-template-columns: 1fr; }
    .campus-hero-copy { order: 1; }
    .campus-hero-image { order: 0; min-height: 220px; }
    .campus-hero-image img { min-height: 220px; max-height: 260px; }
  }
  @media (prefers-reduced-motion: reduce) {
    .campus-page, .campus-card { animation: none; }
    .campus-card, .campus-actions a, .campus-hero-image img { transition: none; }
  }
</style>

<section class="campus-page">
  @guest
    <nav class="d-flex flex-wrap justify-content-center gap-2 mb-4" aria-label="Campus pages">
      <a class="btn btn-sm btn-outline-success" href="{{ route('portal.pages.show', 'library') }}">Library</a>
      <a class="btn btn-sm btn-outline-success" href="{{ route('portal.pages.show', 'academic-records') }}">Academic Records</a>
      <a class="btn btn-sm btn-outline-success" href="{{ route('portal.pages.show', 'community') }}">Student Community</a>
      <a class="btn btn-sm btn-outline-success" href="{{ route('portal.pages.show', 'discovery') }}">Knowledge and Discovery</a>
      <a class="btn btn-sm btn-outline-success" href="{{ route('portal.pages.show', 'help-desk') }}">Help Desk</a>
    </nav>
  @endguest

  <div class="campus-hero">
    <div class="campus-hero-copy">
      <div class="campus-eyebrow">{{ $page['eyebrow'] }}</div>
      <h1>{{ $page['title'] }}</h1>
      <p>{{ $page['intro'] }}</p>
    </div>
    <div class="campus-hero-image">
      <img src="{{ $page['image'] }}" alt="{{ $page['image_alt'] }}" loading="eager" onerror="this.onerror=null;this.src='{{ asset('images/academy-architecture.jpg') }}'">
    </div>
  </div>

  <div class="campus-sections">
    @foreach ($page['sections'] as $section)
      <article class="campus-card">
        <h2>{{ $section['title'] }}</h2>
        <p>{{ $section['body'] }}</p>
      </article>
    @endforeach
  </div>

  <div class="campus-actions">
    @auth
      <a href="{{ route('profile.show') }}">View my academic records</a>
    @else
      <a href="{{ route('login') }}">Sign in to the student portal</a>
    @endauth
  </div>
</section>
