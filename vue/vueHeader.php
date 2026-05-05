<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="images/DownSetLogo.png">
    <link rel="stylesheet" href="public/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/script.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="public/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md px-3">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="index.php"><img class="logo img-fluid"
                        src="images/DownSetRecordsHeader.png"></a>

                <!-- Bouton burger -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
                    aria-controls="offcanvasMenu">
                    <img class="menu-nav" src="images/menu.png">
                </button>

                <!-- Menu PC -->
                <div class="collapse navbar-collapse d-none d-md-block">
                    <ul class="navbar-nav ms-auto navtext">
                        <li class="nav-item"><a class="nav-link text-light" href="index.php?page=accueil">Accueil</a>
                        </li>
                        <li class="nav-link text-light">I</li>
                        <li class="nav-item"><a class="nav-link text-light"
                                href="index.php?page=recherche">Recherche</a></li>
                        <li class="nav-link text-light">I</li>
                        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1): ?>
                            <li class="nav-item"><a class="nav-link text-light" href="index.php?page=admin">Admin</a></li>
                            <li class="nav-link text-light">I</li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item"><a class="nav-link text-light" href="index.php?page=profil">Profil</a></li>
                            <?php if (!empty($_SESSION['user'])): ?>
                                <li class="nav-item-btn">
                                    <button class="btn btn-outline-light ms-2 logoutBtn">
                                        Déconnexion
                                    </button>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#authModal">Se
                                        connecter</button>
                                </li>
                            <?php endif; ?>

                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#authModal">
                                    Se connecter
                                </button>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <!-- Bouton Panier -->
                            <button class="btn btn-outline-light ms-2 panierBtn" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#panierOffcanvas">
                                Panier
                            </button>

                        </li>
                    </ul>

                </div>
            </div>
        </nav>




    </header>

    <main>
        <!-- Auth modal -->
        <div class="modal fade" id="authModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content card-modal text-light">
                    <div class="modal-header">
                        <h5 class="modal-title">Authentification</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <!-- Onglets -->
                        <ul class="nav nav-tabs" id="authTabs" role="tablist">
                            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#loginTab">Connexion</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#registerTab">Créer un compte</button></li>
                        </ul>

                        <div class="tab-content pt-3">
                            <!-- Connexion -->
                            <div class="tab-pane fade show active" id="loginTab">
                                <form id="loginForm">
                                    <input type="hidden" name="action" value="login">
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Mot de passe</label>
                                        <input type="password" name="mdp" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-danger w-100">Se connecter</button>
                                </form>
                            </div>

                            <!-- Inscription -->
                            <div class="tab-pane fade" id="registerTab">
                                <form id="registerForm">
                                    <input type="hidden" name="action" value="register">
                                    <div class="mb-3"><label>Nom</label><input type="text" name="nom"
                                            class="form-control" required></div>
                                    <div class="mb-3"><label>Prénom</label><input type="text" name="prenom"
                                            class="form-control" required></div>
                                    <div class="mb-3"><label>Email</label><input type="email" name="email"
                                            class="form-control" required></div>
                                    <div class="mb-3"><label>Téléphone</label><input type="text" name="telephone"
                                            class="form-control"></div>
                                    <div class="mb-3"><label>Mot de passe</label><input type="password" name="mdp"
                                            class="form-control" required></div>
                                    <button type="submit" class="btn btn-danger w-100">Créer un compte</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas offcanvas-end text-light offcanvasmenu" tabindex="-1" id="offcanvasMenu">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5></br>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button><br>
            </div>
            <h6></h6>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-light" href="index.php?page=accueil">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="index.php?page=recherche">Recherche</a>
                    </li>
                    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1): ?>
                        <li class="nav-item"><a class="nav-link text-light" href="index.php?page=admin">Admin</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item"><a class="nav-link text-light" href="index.php?page=profil">Profil</a></li>
                        <br><br>
                        <?php if (!empty($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <?= htmlspecialchars($_SESSION['user']['nom']) ?>
                                <?= htmlspecialchars($_SESSION['user']['prenom']) ?> :
                            </li>
                            <br>
                            <li class="nav-item-2">
                                <!-- Bouton Panier -->
                                <button class="panierBtn btn btn-outline-light ms-2" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#panierOffcanvas">
                                    Panier
                                </button>
                            </li><br>
                            <li class="nav-item-2">
                                <button class="logoutBtn2 btn btn-outline-light ms-2">
                                    Déconnexion
                                </button>
                            </li>
                        <?php endif; ?>
                        </li>

                    <?php else: ?>
                        <br><br>
                        <li class="nav-item-2">
                            <button class="logoutBtn btn btn-danger" data-bs-toggle="modal" data-bs-target="#authModal">
                                Se connecter
                            </button>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- OFFCANVAS PANIER -->
        <div class="offcanvas offcanvas-end text-light" tabindex="-1" id="panierOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Votre Panier</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">

                <div id="panier-content" class="flex-grow-1"></div>

                <div class="border-top pt-3 mt-3">
                    <h5>Total : <span id="panier-total"></span></h5>
                    <a href="index.php?page=commande" class="btn btn-danger w-100 mt-2">Commander</a>
                </div>
            </div>
        </div>
        <div id="notifications"></div>




</script>
        <script>
            function togglePassword(id) {
                const input = document.getElementById(id);
                input.type = (input.type === "password") ? "text" : "password";
            }

            document.addEventListener("DOMContentLoaded", () => {
                const loginForm = document.querySelector("#loginForm");
                if (loginForm) {
                    loginForm.addEventListener("submit", async (e) => {
                        e.preventDefault();

                        const formData = new FormData(loginForm);

                        try {
                            const res = await fetch("index.php?page=login", { method: "POST", body: formData });


                            const data = await res.json();
                            console.log("Réponse serveur:", data);

                            if (data.success) {
                                location.reload(); // rafraîchit la page → navbar mise à jour
                            } else {
                                alert(data.message || "Email ou mot de passe incorrect !");
                            }
                        } catch (err) {
                            console.error("Erreur AJAX:", err);
                            alert("Impossible de contacter le serveur !");
                        }
                    });
                }



                // Inscription
                const registerForm = document.querySelector("#registerForm");
                if (registerForm) {
                    registerForm.addEventListener("submit", async (e) => {
                        e.preventDefault();
                        const formData = new FormData(registerForm);
                        const res = await fetch("index.php?page=register", { method: "POST", body: formData });
                        const data = await res.json();
                        if (data.success) {
                            location.reload(); // Auto-connecté
                        } else {
                            alert(data.message);
                        }
                    });
                }

                // Déconnexion
                document.querySelectorAll(".logoutBtn, .logoutBtn2").forEach(btn => {
                    btn.addEventListener("click", async (e) => {
                        e.preventDefault();
                        if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
                            const res = await fetch("index.php?page=logout", { method: "POST" });
                            const data = await res.json();
                            if (data.success) {
                                location.reload();
                            }
                        }
                    });
                });
            });

            // Function to show notification
            function showNotification(produit) {
                const RACINE = "<?= getRacine() ?>";
                const container = document.getElementById("notifications");
                
                let img = produit.img_path
                    ? RACINE + produit.img_path
                    : RACINE + "images/default.jpg";
                
                const notif = document.createElement("div");
                notif.className = "notification-toast";
                notif.innerHTML = `
                    <img src="${img}" alt="${produit.nom_produit}">
                    <div class="notification-content">
                        <h4>${produit.nom_produit}</h4>
                        <p>${produit.nom_artiste || "Artiste inconnu"}</p>
                        <p class="text-danger">ajouté au panier</p>
                    </div>
                    <button class="notification-close">&times;</button>
                `;
                
                container.appendChild(notif);
                
                // Close button
                notif.querySelector(".notification-close").addEventListener("click", () => {
                    notif.classList.add("removing");
                    setTimeout(() => notif.remove(), 300);
                });
                
                // Auto-remove after 5 seconds
                setTimeout(() => {
                    if (notif.parentNode) {
                        notif.classList.add("removing");
                        setTimeout(() => notif.remove(), 300);
                    }
                }, 5000);
            }

            document.addEventListener("DOMContentLoaded", () => {
                // Ajouter au panier
                document.querySelectorAll(".ajouter-panier-btn").forEach(btn => {
                    btn.addEventListener("click", async () => {
                        const id = btn.dataset.id;
                        const fd = new FormData();
                        fd.append("action", "ajouter");
                        fd.append("id_produit", id);

                        const res = await fetch("index.php?page=panier", { method: "POST", body: fd });
                        const data = await res.json();
                        if (data.success) {
                            await majPanier();
                            if (data.produit) {
                                showNotification(data.produit);
                            }
                        } else {
                            alert(data.message || "Erreur lors de l'ajout au panier");
                        }
                    });
                });

                // Fonction affichage du panier
                const RACINE = "<?= getRacine() ?>"

                async function majPanier() {
                    const res = await fetch("index.php?page=panier&action=afficher");
                    const data = await res.json();

                    const panierContent = document.getElementById("panier-content");
                    const panierTotal = document.getElementById("panier-total");
                    panierContent.innerHTML = "";

                    if (data.success && data.items.length > 0) {
                        let total = 0;
                        data.items.forEach(item => {
                            total += item.prix_unitaire * item.quantite;

                            // ✅ Image par défaut si pas de cover
                            let img = item.img_path
                                ? RACINE + item.img_path
                                : RACINE + "images/default.jpg";

                            panierContent.innerHTML += `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center">
                        <img src="${img}" alt="cover" width="50" height="50" class="me-2 rounded">
                        <div>
                            <strong>${item.nom_produit}</strong><br>
                            <small>${item.nom_artiste} - ${item.nom_categorie}</small><br>
                            <span class="text-danger">${item.prix_unitaire} € × ${item.quantite}</span>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-outline-light supprimer-panier-btn" data-id="${item.id_produit}">
                        Supprimer
                    </button>
                </div>`;
                        });
                        panierTotal.textContent = total.toFixed(2) + " €";
                    } else {
                        panierContent.innerHTML = `<p class="text-center text-light">Votre panier est vide.</p>`;
                        panierTotal.textContent = "0 €";
                    }

                    // Boutons "supprimer"
                    document.querySelectorAll(".supprimer-panier-btn").forEach(btn => {
                        btn.addEventListener("click", async () => {
                            const id = btn.dataset.id;
                            const fd = new FormData();
                            fd.append("action", "supprimer");
                            fd.append("id_produit", id);
                            const res = await fetch("index.php?page=panier", { method: "POST", body: fd });
                            const data = await res.json();
                            if (data.success) {
                                await majPanier();
                            }
                        });
                    });
                }

                // Charger le panier au démarrage
                majPanier();

                // Rafraîchir le panier à l'ouverture de l'offcanvas
                const panierOffcanvas = document.getElementById("panierOffcanvas");
                if (panierOffcanvas) {
                    panierOffcanvas.addEventListener("show.bs.offcanvas", majPanier);
                }
            });

        </script>
