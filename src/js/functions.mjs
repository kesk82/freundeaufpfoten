const mainHeader = document.getElementById('main-header');

function onPageScroll() {
  if (window.scrollY > 0) {
    if (! document.body.classList.contains('fixed-header')) {
      document.body.classList.add('fixed-header');
    }
  } else {
    if (document.body.classList.contains('fixed-header')) {
      document.body.classList.remove('fixed-header');
    }
  }
}

export function addScrollEffect() {
  document.addEventListener('scroll', onPageScroll);

  onPageScroll();
}

export function fadeInImages() {
  const images = document.querySelectorAll('img.fade-in-effect');

  images.forEach(img => {
    if (img.complete) {
      img.classList.add("img-loaded");
    } else {
      img.addEventListener('load', (e) => {
        img.classList.add("img-loaded");
      });
    }
  });
}