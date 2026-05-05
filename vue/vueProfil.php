<title>Profil - <?= htmlspecialchars($user?->getNom() ?? '') ?> <?= htmlspecialchars($user?->getPrenom() ?? '') ?></title>

<div class="container my-4 text-light">
    <div class="row g-4">
        <!-- Left column: infos + adresses -->
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="profil-titre">
                    <strong>Informations du compte</strong>
                </div>
                <div class="card-body text-white">
                    <p><strong>Nom :</strong> <?= htmlspecialchars($user?->getNom() ?? '') ?></p>
                    <p><strong>Prénom :</strong> <?= htmlspecialchars($user?->getPrenom() ?? '') ?></p>
                    <p><strong>Email :</strong> <?= htmlspecialchars($user?->getEmail() ?? '') ?></p>
                    <p><strong>Téléphone :</strong> <?= htmlspecialchars($user?->getTelephone() ?? '') ?></p>
                </div>
            </div>

            <div class="card">
                <div class="profil-titre d-flex justify-content-between align-items-center">
                    <strong>Adresses</strong>
                    <?php if (count($adresses) < 4): ?>
                        <button class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#formAddAddress">➕
                            Ajouter</button>
                    <?php endif; ?>
                </div>
                <div class="card-body text-white">
                    <?php if (!empty($adresses)): ?>
                        <div class="list-group mb-3">
                            <?php foreach ($adresses as $a): ?>
                                <div
                                    class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
                                    <div>
                                         <?= htmlspecialchars($a->getFullAddress()) ?>
                                     </div>
                                     <form method="post" class="mb-0">
                                         <input type="hidden" name="action" value="supprimer_adresse">
                                         <input type="hidden" name="id_adresse" value="<?= (int) $a->getId() ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-white">Aucune adresse enregistrée.</p>
                    <?php endif; ?>

                    <!-- Form add address -->
                    <div class="collapse" id="formAddAddress">
                        <form method="post" class="mt-3">
                            <input type="hidden" name="action" value="ajout_adresse">
                            <div class="row g-2">
                                <div class="col-4">
                                    <input class="form-control form-control-sm" name="numero_rue" placeholder="N°"
                                        required>
                                </div>
                                <div class="col-8">
                                    <input class="form-control form-control-sm" name="type_numero"
                                        placeholder="bis/ter (facultatif)">
                                </div>
                            </div>
                            <div class="mt-2">
                                <input class="form-control form-control-sm" name="rue" placeholder="Rue" required>
                            </div>
                            <div class="row g-2 mt-2">
                                <div class="col-6">
                                    <input class="form-control form-control-sm" name="ville" placeholder="Ville"
                                        required>
                                </div>
                                <div class="col-6">
                                    <input class="form-control form-control-sm" name="code_postal"
                                        placeholder="Code postal" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger btn-sm mt-3">Ajouter l'adresse</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
    <div class="profil-titre">
        <strong>Options du profil</strong>
    </div>
    <div class="card-body text-white">
        <!-- Modifier email -->
        <form method="post" class="mb-2" onsubmit="return confirm('Êtes-vous sûr de vouloir changer votre adresse mail ?');">
            <input type="hidden" name="action" value="modifier_email">
            <div class="input-group">
                <input type="email" name="nouvel_email" class="form-control" placeholder="Nouveau email" required>
                <button type="submit" class="btn btn-outline-light">Modifier</button>
            </div>
        </form>

        <!-- Modifier téléphone -->
        <form method="post" class="mb-2" onsubmit="return confirm('Êtes-vous sûr de vouloir changer votre numéro ?');">
            <input type="hidden" name="action" value="modifier_telephone">
            <div class="input-group">
                <input type="text" name="nouveau_tel" class="form-control" placeholder="Nouveau téléphone" required>
                <button type="submit" class="btn btn-outline-light">Modifier</button>
            </div>
        </form>

        <!-- Se déconnecter -->
        <form method="post" class="mb-2">
            <input type="hidden" name="action" value="logout">
            <button type="submit" class="btn btn-danger w-100">Se déconnecter</button>
        </form>

        <!-- Supprimer compte -->
        <form method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
            <input type="hidden" name="action" value="supprimer_compte">
            <button type="submit" class="btn btn-danger w-100">Supprimer mon compte</button>
        </form>
    </div>
</div>

        </div>

        <!-- Right column: panier + commandes -->
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="profil-titre"><strong>Mon panier</strong></div>
                <div class="card-body text-white">
                    <?php if (!empty($panier)): ?>
                         <ul class="list-unstyled">
                             <?php foreach ($panier as $article): ?>
                                 <?php
                                     $produit = $article['produit'];
                                     $quantite = $article['quantite'];
                                 ?>
                                 <li class="d-flex align-items-center mb-2">
                                     <img src="<?= $produit->getCoverUrl() ?>" alt="" width="56" height="56" class="me-2 rounded">
                                     <div class="flex-fill">
                                         <strong><?= htmlspecialchars($produit->getNom()) ?></strong><br>
                                         <small><?= (int) $quantite ?> ×
                                             <?= number_format($produit->getPrix(), 2) ?> €</small>
                                     </div>
                                     <div class="text-end">
                                         <?= number_format($produit->getPrix() * $quantite, 2) ?>
                                         €
                                     </div>
                                 </li>
                             <?php endforeach; ?>
                         </ul>
                        <hr class="border-secondary">
                        <p class="h6">Total : <strong class="text-danger"><?= number_format($total_panier, 2) ?> €</strong>
                        </p>
                        <a href="index.php?page=commande"><button class="btn btn-success w-100">Commander</button></a>
                    <?php else: ?>
                        <p class="text-white">Votre panier est vide.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
    <div class="profil-titre">
        <strong>Mes commandes</strong>
    </div>
    <div class="card-body">
        <?php if (!empty($commandes)): ?>
            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $c): ?>
                        <?php
                        $currentStatus = $c->getDeliveryStatus();
                        $statusColor = $currentStatus === 'Reçu' ? 'success' : ($currentStatus === 'En chemin' ? 'warning' : 'info');
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($c->getDateCommande()) ?></td>
                            <td>
                                <span class="badge bg-<?= $statusColor ?>">
                                    <?= htmlspecialchars($currentStatus) ?>
                                </span>
                            </td>
                            <td><strong><?= number_format($c->getTotal(), 2) ?> €</strong></td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#commande<?= $c->getId() ?>">
                                    Voir détails
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-white">Vous n’avez pas encore passé de commande.</p>
        <?php endif; ?>
    </div>
</div>

<?php if (!empty($commandes)): ?>
    <?php foreach ($commandes as $c): ?>
        <?php
        $currentStatus = $c->getDeliveryStatus();
        ?>
        <div class="modal fade" id="commande<?= $c->getId() ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-header">
                        <h5 class="modal-title">Commande du <?= htmlspecialchars($c->getDateCommande()) ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Statut :</strong> <?= htmlspecialchars($currentStatus) ?></p>
                        <p><strong>Date expédition prévue :</strong>
                            <?= htmlspecialchars($c->getDateExpedition()) ?>
                        </p>
                        <p><strong>Date d’arrivée prévue :</strong>
                            <?= htmlspecialchars($c->getDateArrivee()) ?>
                        </p>
                        <hr>
                        <ul class="list-unstyled">
                            <?php foreach ($c->getLignes() as $ligne): ?>
                                 <?php
                                     $produit = $ligne->getProduit();
                                 ?>
                                 <li class="d-flex align-items-center mb-2">
                                     <img src="<?= $produit->getCoverUrl() ?>" alt="" width="50" class="me-2 rounded">
                                     <div>
                                         <strong><?= htmlspecialchars($produit->getNom()) ?></strong><br>
                                         Quantité : <?= (int) $ligne->getQuantite() ?><br>
                                         Prix : <?= number_format($ligne->getPrixUnitaire(), 2) ?> € / unité
                                     </div>
                                     <div class="ms-auto">
                                         <strong><?= number_format($ligne->getTotal(), 2) ?> €</strong>
                                     </div>
                                 </li>
                             <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php include_once __DIR__ . '/vueFooter.php'; ?>