(()=>{"use strict";function e(){window.scrollY>0?document.body.classList.contains("fixed-header")||document.body.classList.add("fixed-header"):document.body.classList.contains("fixed-header")&&document.body.classList.remove("fixed-header")}document.getElementById("main-header");const t=document.querySelectorAll("#page_privacy_settings a.sk_on_off_item");function s(e){if("embed-media"===e){const e=new Date;e.setTime(e.getTime());let t=e.toUTCString();document.cookie=`allowembeds=No; expires=${t}; path=/`}}function i(e){if("embed-media"===e){const e=new Date;e.setTime(e.getTime()+31536e6);let t=e.toUTCString();document.cookie=`allowembeds=Yes; expires=${t}; path=/`}}const a=document.getElementById("main-navigation-btn");a&&window.addEventListener("click",(function(e){a.contains(e.target)?(e.preventDefault(),document.body.classList.toggle("navigation-is-open")):document.body.classList.contains("navigation-is-open")&&document.body.classList.remove("navigation-is-open")})),window.addEventListener("resize",(()=>{document.body.classList.remove("navigation-is-open")}),!0);const n=document.getElementById("main-header");n&&setTimeout((()=>{n.classList.add("loaded")}),300);const d=document.querySelectorAll("[data-sk-src]");d&&d.forEach((e=>{e.classList.add("fade-in-effect"),e.setAttribute("loading","lazy"),e.removeAttribute("fetchpriority"),e.setAttribute("src",e.getAttribute("data-sk-src")),e.hasAttribute("data-sk-srcset")&&e.setAttribute("srcset",e.getAttribute("data-sk-srcset"))})),document.addEventListener("scroll",e),e(),document.querySelectorAll("img.fade-in-effect").forEach((e=>{e.complete?e.classList.add("img-loaded"):e.addEventListener("load",(t=>{e.classList.add("img-loaded")}))})),function(){const e=document.querySelectorAll("iframe[data-ks-embed-orig-src]"),t=document.cookie.split(";");let s=!1;for(const e of t){let[t,i]=e.split("=");if("allowembeds"===t.trim()&&"Yes"===i.trim()){s=!0;break}}e&&e.forEach((e=>{s?e.setAttribute("src",e.getAttribute("data-ks-embed-orig-src")):function(e){if(e){let t=document.createDocumentFragment(),s=document.createElement("DIV");s.classList.add("load-external-embed-ctl");let i=document.createElement("A");i.setAttribute("href","#"),i.classList.add("external-embed-container"),i.addEventListener("click",(t=>{t.preventDefault();const i=new Date;i.setTime(i.getTime()+31536e6);let a=i.toUTCString();document.cookie=`allowembeds=Yes; expires=${a}; path=/`,e.setAttribute("allow","autoplay");let n=e.getAttribute("data-ks-embed-orig-src");n.includes("?")?n+="&autoplay=1":n+="?autoplay=1",e.setAttribute("src",n),s.remove()}));let a=document.createElement("DIV");a.classList.add("external-embed-yt-lgo"),a.innerHTML='<div class="media_iframe_bg"><svg><use xlink:href="#svg-symbol-yt"></use></svg></div>';let n=document.createElement("DIV");n.innerHTML='<svg><use xlink:href="#svg-symbol-toggle-off"></use></svg><div>Externe Inhalte von YouTube erlauben und Video abspielen</div>',n.classList.add("embed-info-message"),i.appendChild(a),i.appendChild(n),s.appendChild(i),t.appendChild(s),e.parentNode.appendChild(t)}}(e)}))}(),function(){const e=document.cookie.split(";");let a=!1;for(const t of e){let[e,s]=t.split("=");"allowembeds"===e.trim()&&"Yes"===s.trim()&&(a=!0)}if(t)for(const e of t){const t=e.dataset.skPrivacyItem;let n=!1;"embed-media"===t&&(n=a),n?e.classList.add("enabled"):e.classList.remove("enabled"),e.addEventListener("click",(a=>{a.preventDefault(),n?(n=!1,e.classList.remove("enabled"),s(t)):(n=!0,e.classList.add("enabled"),i(t))}))}}()})();