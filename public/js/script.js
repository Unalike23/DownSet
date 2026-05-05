document.querySelectorAll('.cover-wrapper').forEach(wrapper => {
    wrapper.addEventListener('mousemove', (e) => {
        const rect = wrapper.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((y - centerY) / centerY) * 25;
        const rotateY = ((x - centerX) / centerX) * 25;

        wrapper.style.transform = `rotateX(${-rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
        wrapper.style.boxShadow = `${-rotateY * 1.5}px ${rotateX * 1.5}px 30px rgba(0,0,0,0.6)`;
    });

    wrapper.addEventListener('mouseleave', () => {
        wrapper.style.transform = `rotateX(0deg) rotateY(0deg) scale(1)`;
        wrapper.style.boxShadow = `0 4px 15px rgba(0,0,0,0.6)`;
    });
});

document.addEventListener("DOMContentLoaded", () => {
  // Login
const loginForm = document.querySelector("#loginForm");
if (loginForm) {
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);
        formData.append("action", "login");
        const res = await fetch("index.php?page=login", { method: "POST", body: formData });
        const data = await res.json();
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    });
}


  // Register
  const registerForm = document.querySelector("#registerForm");
  if (registerForm) {
    registerForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const formData = new FormData(registerForm);
      formData.append("action", "register");
      const res = await fetch("index.php?page=register", { method: "POST", body: formData });
      const data = await res.json();
      if (data.success) {
        location.reload();
      } else {
        alert(data.message);
      }
    });
  }
});

// Déconnexion
document.addEventListener('DOMContentLoaded', () => {
  const logoutBtn = document.getElementById('logoutBtn');
  if (logoutBtn) {
    logoutBtn.addEventListener('click', async () => {
      if (!confirm("Voulez-vous vraiment vous déconnecter ?")) return;

      const res = await fetch('index.php?page=logout');
      const json = await res.json();
      if (json.success) {
        location.reload();
      } else {
        alert("Erreur lors de la déconnexion.");
      }
    });
  }
});



async function updatePanierCount() {
    const btn = document.getElementById("btn-panier");
    if (!btn) return;

    const resp = await fetch("index.php?page=panier&action=compter");
    const data = await resp.json();

    if (data.success) {
        btn.textContent = `Panier (${data.total})`;
    }
}

document.addEventListener("DOMContentLoaded", updatePanierCount);

document.addEventListener("panierChange", updatePanierCount);

document.dispatchEvent(new Event("panierChange"));

$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Rechercher...",
        width: '100%',
        minimumResultsForSearch: 0
    });
});





function createImagePreview(input, container, type) {
    input.addEventListener("change", function() {
        container.innerHTML = ""; // reset previews

        [...input.files].forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                let img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("img-fluid", "rounded", "shadow");

                if (type === "artiste") {
                    img.style.maxWidth = "200px";
                }
                if (type === "produit") {
                    img.style.maxWidth = "120px";
                    img.style.marginRight = "10px";
                }

                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
}


(function(){
  const coverInput = document.getElementById('img_produit_input');
  const discInput  = document.getElementById('img_disk_input');
  const preview    = document.getElementById('preview-produit');
  let currentURLs = [];

  function clearPreview(){
    // supprime nodes et révoque objectURL
    preview.innerHTML = '';
    currentURLs.forEach(u => { try { URL.revokeObjectURL(u); } catch(e){} });
    currentURLs = [];
  }

  function makeImg(src, cls, alt='') {
    const img = document.createElement('img');
    img.src = src;
    img.className = cls;
    img.alt = alt;
    return img;
  }

  function renderPreview(){
    clearPreview();

    const coverFile = coverInput && coverInput.files && coverInput.files[0] ? coverInput.files[0] : null;
    const discFile  = discInput  && discInput.files  && discInput.files[0]  ? discInput.files[0]  : null;

    if (!coverFile && !discFile) {
      const p = document.createElement('div');
      p.className = 'preview-placeholder';
      p.innerText = 'Aperçu : sélectionnez une cover et/ou une image disque';
      preview.appendChild(p);
      return;
    }

    const wrapper = document.createElement('div');
    wrapper.className = 'preview-card';

    // DISQUE (derrière)
    if (discFile) {
      const discURL = URL.createObjectURL(discFile);
      currentURLs.push(discURL);
      const discImg = makeImg(discURL, 'disc', 'Disque preview');
      wrapper.appendChild(discImg);
    } else {
      // si pas de disque, on peut afficher un fond circulaire neutre pour repère
      const bg = document.createElement('div');
      bg.style.width = '120px';
      bg.style.height = '120px';
      bg.style.borderRadius = '50%';
      bg.style.background = 'linear-gradient(135deg,#3a3a3a,#1f1f1f)';
      bg.style.position = 'absolute';
      bg.style.left = '0';
      bg.style.top = '20px';
      bg.style.zIndex = '1';
      wrapper.appendChild(bg);
    }

    // COVER (au dessus)
    if (coverFile) {
      const coverURL = URL.createObjectURL(coverFile);
      currentURLs.push(coverURL);
      const coverImg = makeImg(coverURL, 'cover', 'Cover preview');
      wrapper.appendChild(coverImg);
    }

    preview.appendChild(wrapper);
  }

  if (coverInput) coverInput.addEventListener('change', renderPreview);
  if (discInput)  discInput.addEventListener('change', renderPreview);

  // initial render si chargement avec fichiers (rare)
  document.addEventListener('DOMContentLoaded', renderPreview);
})();

(function(){
  const inputMini  = document.getElementById('img_artiste_input');       // card cover
  const inputPage  = document.getElementById('img_artiste_page_input');  // background
  const inputTitle = document.getElementById('img_artiste_title_input'); // logo / titre
  const preview    = document.getElementById('preview-artiste');
  let currentURLs  = [];

  function clearPreview(){
    preview.innerHTML = '';
    currentURLs.forEach(u => { try { URL.revokeObjectURL(u); } catch(e){} });
    currentURLs = [];
  }

  function renderPreview(){
    clearPreview();

    const miniFile  = inputMini?.files?.[0]  || null;
    const pageFile  = inputPage?.files?.[0]  || null;
    const titleFile = inputTitle?.files?.[0] || null;

    if (!miniFile && !pageFile && !titleFile) {
      const p = document.createElement('div');
      p.className = 'text-muted';
      p.innerText = 'Aperçu : sélectionnez des images pour voir le rendu';
      preview.appendChild(p);
      return;
    }

    // CARD artiste (fond = img_page si dispo, sinon img_artiste)
    if (miniFile) {
      const card = document.createElement('div');
      card.className = 'preview-artist-card';
      const bgFile = miniFile;
      const bgURL  = URL.createObjectURL(bgFile);
      currentURLs.push(bgURL);
      card.style.backgroundImage = `url('${bgURL}')`;

      const overlay = document.createElement('div');
      overlay.className = 'overlay';
      overlay.innerText = 'Nom Artiste';
      card.appendChild(overlay);

      preview.appendChild(card);
    }

    // Image title (logo)
    if (titleFile) {
      const url = URL.createObjectURL(titleFile);
      currentURLs.push(url);
      const img = document.createElement('img');
      img.src = url;
      img.alt = "Image titre";
      img.className = 'preview-artist-img';
      preview.appendChild(img);
    }

    // Image page (grande)
    if (pageFile) {
      const url = URL.createObjectURL(pageFile);
      currentURLs.push(url);
      const img = document.createElement('img');
      img.src = url;
      img.alt = "Image page";
      img.className = 'preview-artist-img';
      preview.appendChild(img);
    }
  }

  [inputMini, inputPage, inputTitle].forEach(inp => {
    if (inp) inp.addEventListener('change', renderPreview);
  });

})();
