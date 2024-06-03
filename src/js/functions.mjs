const toggleMobileNavigation = document.getElementById('navPanelToggle');
const navPanel = document.getElementById('navPanel');
const mainContent = document.getElementById('main');
const introContainer = document.getElementById('intro');

/**
 * Change header when scrolling down:
 * 
 */
function onPageScroll() {
  if (toggleMobileNavigation && mainContent) {
    if (window.scrollY > ( mainContent.offsetTop - toggleMobileNavigation.offsetTop - toggleMobileNavigation.offsetHeight )) {
      toggleMobileNavigation.classList.add('alt');
    } else {
      toggleMobileNavigation.classList.remove('alt');
    }
  }

  if (introContainer) {
    if (window.scrollY > 50) {
      introContainer.classList.add('hidden');
    } else {
      introContainer.classList.remove('hidden');
    }
  }
}

export function addScrollEffect() {
  document.addEventListener('scroll', onPageScroll);

  onPageScroll();
}

/**
 * Add class img-loaded to transparent images that where loaded so we can fade them in:
 * 
 */
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

/**
 * HTML code for widget that asks for permision to load embeded content:
 */
function addEmbedLoadControl(elmt) {
  if (elmt) {
    let fragment = document.createDocumentFragment();
    let frame = document.createElement('DIV');
    frame.classList.add('load-external-embed-ctl');

    let enableExternalMediaLink = document.createElement('A');
    enableExternalMediaLink.setAttribute('href', '#');
    enableExternalMediaLink.classList.add("external-embed-container");
    enableExternalMediaLink.addEventListener('click', e => {

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

    let embedYTLogo = document.createElement('DIV');
    embedYTLogo.classList.add('external-embed-yt-lgo');
    embedYTLogo.innerHTML = '<div class="media_iframe_bg"><svg><use xlink:href="#svg-symbol-yt"></use></svg></div>';

    let embedInfoMessage = document.createElement('DIV');
    embedInfoMessage.innerHTML = '<svg><use xlink:href="#svg-symbol-toggle-off"></use></svg><div>Externe Inhalte von YouTube erlauben und Video abspielen</div>';
    embedInfoMessage.classList.add('embed-info-message');

    enableExternalMediaLink.appendChild(embedYTLogo);
    enableExternalMediaLink.appendChild(embedInfoMessage);
    frame.appendChild(enableExternalMediaLink);
    fragment.appendChild(frame);

    elmt.parentNode.appendChild(fragment);
  }
}

/**
 * Load embeded Content if allowed or ask for permision:
 */
export function runEmbeds() {
  const embeds = document.querySelectorAll('iframe[data-ks-embed-orig-src]');
  const cookies = document.cookie.split(';');

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
      iframe.setAttribute('loading', 'lazy');
      
      if (allowEmbeds) {
        iframe.setAttribute('src', iframe.getAttribute('data-ks-embed-orig-src'));
      } else {
        addEmbedLoadControl(iframe);
      }
    });
  }
}

/**
 * Privacy Settings Control:
 * 
 */
const privacySettingsItems = document.querySelectorAll('#page_privacy_settings a.sk_on_off_item');

export function runPrivacyControl() {
  const cookies = document.cookie.split(';');

  let allowEmbeds = false;

  for (const c of cookies) {
    let [ cName, cVal ] = c.split('=');

    if (cName.trim() === 'allowembeds' && cVal.trim() === 'Yes') {
      allowEmbeds = true;
    }
  }

  if (privacySettingsItems) {
    for (const privacyItem of privacySettingsItems) {
      const itemName = privacyItem.dataset.skPrivacyItem;
      let enabled = false;

      if (itemName === "embed-media") {
        enabled = allowEmbeds;
      }

      if (enabled) {
        privacyItem.classList.add('enabled');
      }
      else {
        privacyItem.classList.remove('enabled');
      }

      privacyItem.addEventListener('click', e => {
        e.preventDefault();
        if (enabled) {
          enabled = false;
          privacyItem.classList.remove('enabled');
          turPrivacyItemOff(itemName);
        }
        else {
          enabled = true;
          privacyItem.classList.add('enabled');
          turPrivacyItemOn(itemName);
        }
      });
    }
  }
}

function turPrivacyItemOff(item) {
  if (item === "embed-media") {
    const d = new Date();
    d.setTime(d.getTime());
    let expires = d.toUTCString();
    document.cookie = `allowembeds=No; expires=${expires}; path=/`;
  }
}

function turPrivacyItemOn(item) {
  if (item === "embed-media") {
    const d = new Date();
    d.setTime(d.getTime() + (365*24*60*60*1000));
    let expires = d.toUTCString();
    document.cookie = `allowembeds=Yes; expires=${expires}; path=/`;
  }
}