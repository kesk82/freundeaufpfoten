import { justTesting, addScrollEffect, fadeInImages, runEmbeds, runPrivacyControl } from './functions.mjs';

const toggleMobileNavigation = document.getElementById('navPanelToggle');
const navPanel = document.getElementById('navPanel');
const mainContent = document.getElementById('main');

if (navPanel) {
  navPanel.style.display = 'block';

  navPanel.addEventListener('touchmove', function(e) {
    e.preventDefault();
    if (document.body.classList.contains('navPanel-visible')) {
      document.body.classList.remove('navPanel-visible');
    }
  });
}

if (toggleMobileNavigation) {
  window.addEventListener('click', function(e) {
    if (toggleMobileNavigation.contains(e.target)) {
      e.preventDefault();
      document.body.classList.toggle('navPanel-visible');
    } else {
      if (document.body.classList.contains('navPanel-visible')) {
        document.body.classList.remove('navPanel-visible');
      }
    }
  });
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