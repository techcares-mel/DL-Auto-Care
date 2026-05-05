(function () {
  'use strict';

  // ── Holiday Banner ──────────────────────────────────────────────
  var banner = document.getElementById('dl-banner');
  if (banner) {
    var bannerId = banner.dataset.id;

    // If this banner was previously dismissed, hide it immediately
    if (bannerId && localStorage.getItem('dl_banner_' + bannerId) === 'dismissed') {
      banner.style.display = 'none';
      banner = null;
    }
  }

  // Adjust nav and body padding to sit below the banner
  function adjustForBanner() {
    var nav = document.getElementById('nav');
    if (!banner || banner.style.display === 'none') return;
    var bh = banner.offsetHeight;
    if (nav) nav.style.top = bh + 'px';
    document.body.style.paddingTop = bh + 'px';
  }

  // Exposed globally so the inline dismiss button can call it
  window.dlDismissBanner = function (id) {
    localStorage.setItem('dl_banner_' + id, 'dismissed');
    var el = document.getElementById('dl-banner');
    if (!el) return;
    el.style.transition = 'opacity 0.3s ease';
    el.style.opacity = '0';
    setTimeout(function () {
      el.remove();
      banner = null;
      var nav = document.getElementById('nav');
      if (nav) nav.style.top = '';
      document.body.style.paddingTop = '';
    }, 300);
  };

  adjustForBanner();
  window.addEventListener('resize', adjustForBanner);

  // ── Nav scroll class ────────────────────────────────────────────
  var nav = document.getElementById('nav');
  if (nav) {
    window.addEventListener('scroll', function () {
      nav.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  // ── Hamburger menu ──────────────────────────────────────────────
  var burger = document.getElementById('burger');
  var mobNav = document.getElementById('mobNav');

  function toggleMenu(open) {
    if (!burger || !mobNav) return;
    burger.classList.toggle('open', open);
    mobNav.classList.toggle('open', open);
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    document.body.style.overflow = open ? 'hidden' : '';
  }

  if (burger) {
    burger.addEventListener('click', function () {
      toggleMenu(!mobNav.classList.contains('open'));
    });
  }

  document.querySelectorAll('.mob-link').forEach(function (link) {
    link.addEventListener('click', function () { toggleMenu(false); });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') toggleMenu(false);
  });

  // ── Scroll animations (IntersectionObserver) ────────────────────
  var obs = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        obs.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.animate, .animate-left, .animate-right, .animate-fade')
    .forEach(function (el) { obs.observe(el); });

}());
