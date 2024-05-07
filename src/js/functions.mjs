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

function addEmbedLoadControl(elmt) {
  if (elmt) {
    let fragment = document.createDocumentFragment();
    let frame = document.createElement('DIV');
    frame.classList.add('load-external-embed-ctl');

    let allowButton = document.createElement('A');
    allowButton.textContent = 'Inhalt Abspielen (Extern)';
    allowButton.setAttribute('href', '#');
    allowButton.classList.add('load-external-embed-btn');

    allowButton.addEventListener('click', e => {
      e.preventDefault();

      let realSource = elmt.getAttribute('data-ks-embed-orig-src');
      if (realSource.includes('?')) {
        realSource += '&autoplay=1';
      } else {
        realSource += '?autoplay=1'
      }
      elmt.setAttribute('src', realSource);
      frame.remove();
    });

    let allowAllButton = document.createElement('A');
    allowAllButton.textContent = 'Alle externen Inhalte erlauben';
    allowAllButton.setAttribute('href', '#');
    allowAllButton.classList.add('load-external-embed-btn');
    allowAllButton.addEventListener('click', e => {

      e.preventDefault();
      const d = new Date();
      d.setTime(d.getTime() + (365*24*60*60*1000));
      let expires = d.toUTCString();
      document.cookie = `allowembeds=Yes; expires=${expires}; path=/`;
      elmt.setAttribute('allow', 'autoplay');
      let realSource = elmt.getAttribute('data-ks-embed-orig-src');
      if (realSource.includes('?')) {
        realSource += '&autoplay=1';
      } else {
        realSource += '?autoplay=1'
      }
      elmt.setAttribute('src', realSource);
      frame.remove();
    });

    frame.appendChild(allowButton);
    frame.appendChild(allowAllButton);
    fragment.appendChild(frame);

    elmt.parentNode.appendChild(fragment);
  }
}

export function runEmbeds() {
  const embeds = document.querySelectorAll('iframe[data-ks-embed-orig-src]');
  const cookies = document.cookie.split(';');
  console.log(cookies);

  let allowEmbeds = false;

  for (const c of cookies) {
    let [ cName, cVal ] = c.split('=');
    if (cName.trim() === 'allowembeds' && cVal.trim() === 'Yes') {
      allowEmbeds = true;
      break;
    }
  }

  if (embeds) {
    embeds.forEach(iframe => {
      if (allowEmbeds) {
        iframe.setAttribute('src', iframe.getAttribute('data-ks-embed-orig-src'));
      } else {
        addEmbedLoadControl(iframe);
      }
    });
  }
}