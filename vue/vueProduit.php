<title><?= htmlspecialchars($produit->getNom() ?? 'Produit') ?></title>

<main class="container py-5 text-light">
    <?php if (empty($produit)): ?>
        <div class="alert alert-warning">Produit introuvable</div>
    <?php else: ?>

        <div class="row g-4 align-items-start product-detail">
            <!-- Partie gauche -->
            <div class="col-lg-5">
                <div class="mb-3 position-relative text-center">
                    <!-- Petit disque -->
                    <?php if ($produit->getDiscUrl()): ?>
                        <img src="<?= $produit->getDiscUrl() ?>" alt="Disque"
                            class="position-absolute d-none d-block" style="left:10px; top:10px; width:110px; z-index:1; pointer-events:none;">
                    <?php endif; ?>

                    <img src="<?= $produit->getCoverUrl() ?>"
                        alt="Pochette" class="img-fluid rounded shadow" style="max-width:320px;">
                </div>

                <!-- Au cas ou pour plus d'images -->
                <div class="d-flex gap-2 justify-content-center">
                    <?php if ($produit->getDiscUrl()): ?>
                        <img src="<?= $produit->getDiscUrl() ?>"
                            alt="Disque" class="img-fluid rounded shadow" style="max-width:320px;">
                    <?php endif; ?>
                </div>
            </div>

            <!-- infos -->
            <div class="col-lg-7">
                <h1 class="mb-2"><?= htmlspecialchars($produit->getNom()) ?></h1>
                <h4 class="text-white mb-3">
                    <?php if (!empty($produit->getArtistes())): ?>
                        <?php
                        $artistes = $produit->getArtistes();
                        foreach ($artistes as $i => $artiste):
                            ?>
                            <a href="index.php?page=artiste&id=<?= (int) $artiste->getId() ?>">
                                <?= htmlspecialchars($artiste->getNom()) ?>
                            </a><?= $i < count($artistes) - 1 ? ', ' : '' ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="text-muted">Artiste inconnu</span>
                    <?php endif; ?>
                </h4>

                <p class="mb-1"><strong>Genres :</strong> <?= htmlspecialchars($produit->getGenresNoms() ?? '—') ?></p>
                <p class="mb-3"><strong>Catégorie :</strong> <?= htmlspecialchars($produit->getCategorieNom() ?? '—') ?></p>

                <div class="mb-3">
                    <h3 class="text-danger d-inline"><?= number_format($produit->getPrix(), 2) ?> €</h3>
                </div>

                <!-- Variantes categ -->
                <?php if (!empty($variantes)): ?>
                    <section class="mb-4">
                        <h3>Versions :</h3>
                        <div class="d-flex gap-2">
                            <?php foreach ($variantes as $v): ?>
                                <a href="index.php?page=produit&id=<?= $v->getId() ?>" class="btn btn-outline-primary">
                                    <?= htmlspecialchars($v->getCategorieNom() ?? 'Version') ?> -
                                    <?= number_format($v->getPrix(), 2) ?> €
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Ajouter au panier -->
                <form method="post" action="panier.php" class="d-flex gap-2 mb-4 align-items-center">
                    <input type="hidden" name="action" value="ajouter">
                    <input type="hidden" name="id_produit" value="<?= $produit->getId() ?>">
                    <div class="flex-grow-1">
                        <button type="button" class="btn btn-danger w-100 ajouter-panier-btn mt-2"
                            data-id="<?= $produit->getId() ?>">
                            Ajouter au panier
                        </button>
                    </div>
                </form>

                <!-- Description -->
                <div class="mt-4">
                    <h5>Description</h5>
                    <p><?= nl2br(htmlspecialchars($produit->getDescription() ?? 'Aucune description fournie.')) ?></p>
                </div>

                <div class="mt-3">
                    <a href="index.php?page=recherche" class="btn btn-outline-light">← Retour à la boutique</a>
                </div>
            </div>
        </div>

    <?php endif; ?>
</main>