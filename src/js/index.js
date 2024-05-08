import { justTesting, addScrollEffect, fadeInImages, runEmbeds, runPrivacyControl } from './functions.mjs';

// Open & Close Mobile Navigation when click on Navigation Button:
const mainNavigationBtn = document.getElementById('main-navigation-btn');
if (mainNavigationBtn) {
  window.addEventListener('click', function(e) {
    if (mainNavigationBtn.contains(e.target)) {
      e.preventDefault();
      document.body.classList.toggle('navigation-is-open');
    } else {
      if (document.body.classList.contains('navigation-is-open')) {
        document.body.classList.remove('navigation-is-open');
      }
    }
  });
}

// Close Navigation on resize:
window.addEventListener('resize', () => {
  document.body.classList.remove('navigation-is-open');
}, true);

// Fade in header:
const mainheader = document.getElementById('main-header');

if (mainheader) {
  setTimeout(() => {
    mainheader.classList.add('loaded');
  }, 300);
}

/**
 * Find and load images with data-sk-src attribute:
 * 
 */
const unloadedImages = document.querySelectorAll('[data-sk-src]');

if (unloadedImages) {
  unloadedImages.forEach(img => {
    img.classList.add('fade-in-effect');
    img.setAttribute('loading', 'lazy');
    img.removeAttribute('fetchpriority');

    img.setAttribute('src', img.getAttribute('data-sk-src'));

    if (img.hasAttribute('data-sk-srcset')) {
      img.setAttribute('srcset', img.getAttribute('data-sk-srcset'));
    }
  });
}

/**
 * Start other code:
 */
addScrollEffect();
fadeInImages();
runEmbeds();
runPrivacyControl();