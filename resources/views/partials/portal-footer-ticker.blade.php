@php($tickerItems = $tickerItems ?? ['University Library', 'Academic Records', 'Student Community', 'Knowledge and Discovery', 'University Help Desk'])

<style>
  .portal-footer-ticker {
    width: 100%;
    margin-top: auto;
    padding: 12px 0;
    overflow: hidden;
    position: relative;
    z-index: 5;
    white-space: nowrap;
    color: #efe4cc !important;
    background: linear-gradient(110deg, #17261f 0%, #263a2e 58%, #3a2924 100%) !important;
    border-top: 1px solid rgba(189, 150, 84, .48) !important;
  }
  .portal-footer-ticker .ticker-track {
    display: inline-flex;
    width: max-content;
    animation: marqueeScroll 28s linear infinite;
  }
  .portal-footer-ticker .ticker-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-right: 48px;
    color: #efe4cc !important;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
  }
  .portal-footer-ticker .ticker-dot {
    display: inline-block;
    flex: 0 0 6px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #bd9654 !important;
  }
  @keyframes marqueeScroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }
  @media (prefers-reduced-motion: reduce) {
    .portal-footer-ticker .ticker-track { animation: none; }
  }
</style>

<footer class="portal-footer-ticker" aria-label="University services">
  <div class="ticker-track">
    @foreach (array_merge($tickerItems, $tickerItems) as $item)
      <span class="ticker-item"><span class="ticker-dot"></span> {{ $item }}</span>
    @endforeach
  </div>
</footer>
  
