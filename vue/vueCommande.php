<title>Commander</title>

<div class="container my-5 text-light">

    <h2 class="mb-4 text-danger">Votre commande</h2><div class="d-none d-md-block"></div>

    <!-- Panier -->
    <div class="card text-light mb-4">
        <div class="card-header">Produits dans votre panier</div>
        <ul class="list-group list-group-flush">
            <?php if ($panier->isEmpty()): ?>
                <li class="list-group-item text-white">Votre panier est vide.</li>
            <?php else: ?>
                <?php foreach ($panier->getArticles() as $article): ?>
                    <?php $produit = $article['produit']; $quantite = $article['quantite']; ?>
                    <li class="text-white list-group-item bg-dark d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="<?= $produit->getCoverUrl() ?>" alt="" width="56" height="56" class="me-2 rounded">
                            <div class="commande">
                                <strong><?= htmlspecialchars($produit->getNom()) ?></strong><br>
                                <small><?= htmlspecialchars($produit->getArtistesNoms()) ?> -
                                    <?= htmlspecialchars($produit->getCategorieNom()) ?></small><br>
                                <span class="text-danger"><?= number_format($produit->getPrix(), 2) ?> € ×
                                    <?= $quantite ?></span>
                            </div>
                        </div>
                        <span class="fw-bold"><?= number_format($produit->getPrix() * $quantite, 2) ?> €</span>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <div class="card-footer text-end">
            <h5>Total : <span class="text-success"><?= number_format($total, 2) ?> €</span></h5>
        </div>
    </div>

    <!-- Choix adresse -->
    <div class="card bg-dark text-light mb-4">
        <div class="card-header">Choisir une adresse</div>
        <div class="card-body">
            <?php if (empty($adresses)): ?>
                <p class="text-light">Aucune adresse enregistrée. <a href="index.php?page=profil" class="text-danger">Ajoutez-en une
                        ici</a>.</p>
            <?php else: ?>
                <form id="addressForm">
                    <?php foreach ($adresses as $a): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="adresse" value="<?= (int)$a->getId() ?>">
                            <label class="form-check-label">
                                <?= htmlspecialchars($a->getNumeroRue() ?? '') ?>         <?= htmlspecialchars($a->getRue()) ?>,
                                <?= htmlspecialchars($a->getVille()) ?> (<?= htmlspecialchars($a->getCodePostal()) ?>)
                            </label>
                        </div>
                    <?php endforeach; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Paiement -->
    <div class="card bg-dark text-light mb-4">
        <div class="card-header">💳 Paiement sécurisé</div>
        <div class="card-body">
            <form id="paiementForm">
                <div class="mb-3">
                    <label for="nom_carte">Titulaire de la carte</label>
                    <input type="text" id="nom_carte" class="form-control" placeholder="Jean Dupont" required>
                </div>

                <div class="mb-3">
                    <label for="cb">Numéro de carte</label>
                    <input type="text" id="cb" class="form-control" maxlength="19" placeholder="1111 2222 3333 4444"
                        required>
                    <small class="text-light">Visa, Mastercard, Amex acceptées</small>
                </div>

                <div class="mb-3 d-flex gap-3">
                    <div>
                        <label>Expiration</label>
                        <div class="d-flex gap-2">
                            <select class="form-select" id="exp_mois" required>
                                <option value="">MM</option>
                                <?php for ($m = 1; $m <= 12; $m++): ?>
                                    <option value="<?= sprintf('%02d', $m) ?>"><?= sprintf('%02d', $m) ?></option>
                                <?php endfor; ?>
                            </select>
                            <select class="form-select" id="exp_annee" required>
                                <option value="">AA</option>
                                <?php $y = date("y");
                                for ($i = 0; $i < 10; $i++): ?>
                                    <option value="<?= $y + $i ?>"><?= $y + $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label>CVC</label>
                        <input type="password" id="cvc" class="form-control" maxlength="4" placeholder="123" required>
                    </div>
                </div>

                <hr>
                <h5>Total à payer : <span class="text-success"><?= number_format($total, 2) ?> €</span></h5>

                <button type="submit" class="btn btn-danger w-100 mt-3">
                    Payer <?= number_format($total, 2) ?> €
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("paiementForm")?.addEventListener("submit", async function(e){
    e.preventDefault();

    // Récupère l'adresse choisie (si présente)
    const form = this;
    let selectedAdresse = null;
    const radios = document.querySelectorAll('input[name="adresse"]');
    let addressRequired = radios.length > 0;
    
    radios.forEach(r => {
        if (r.checked) selectedAdresse = r.value;
    });

    // Validate address if required
    if (addressRequired && !selectedAdresse) {
        alert("Veuillez sélectionner une adresse de livraison.");
        return;
    }

    // Simuler validation CB (très basique)
    const cb = document.getElementById('cb').value.replace(/\s/g,'');
    const nom_carte = document.getElementById('nom_carte')?.value || '';
    const cvc = document.getElementById('cvc')?.value || '';
    const mois = document.getElementById('exp_mois')?.value || '';
    const annee = document.getElementById('exp_annee')?.value || '';

    if (!nom_carte || cb.length < 12 || cvc.length < 3 || !mois || !annee) {
        alert("Veuillez vérifier les informations de paiement.");
        return;
    }

    const btn = form.querySelector("button");
    btn.disabled = true;
    btn.innerHTML = "⏳ Traitement...";

    try {
         const fd = new FormData();
         if (selectedAdresse) fd.append('id_adresse', parseInt(selectedAdresse));

         const res = await fetch('index.php?page=commande&action=place', {
            method: 'POST',
            body: fd
        });

        let data;
        try {
            data = await res.json();
        } catch {
            // If response is not JSON, check HTTP status
            if (res.ok) {
                // Success response but not JSON (possibly redirected or empty)
                alert("✅ Paiement accepté — votre commande a été créée.");
                window.location.href = "index.php?page=profil";
                return;
            }
            throw new Error('Invalid response format');
        }

        if (data.success) {
            // OK : redirection vers profil/mes commandes
            alert("✅ Paiement accepté — commande créée (#" + data.id_commande + ")");
            window.location.href = "index.php?page=profil";
        } else {
            alert("Erreur : " + (data.message || "Impossible de traiter la commande"));
            btn.disabled = false;
            btn.innerHTML = "🔒 Payer";
        }
    } catch (err) {
        console.error('Order error:', err);
        alert("Erreur réseau lors de la commande.");
        btn.disabled = false;
        btn.innerHTML = "🔒 Payer";
    }
});
</script>

<?php include_once __DIR__ . "/vueFooter.php"; ?>