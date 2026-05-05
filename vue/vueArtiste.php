<title>Artiste : <?= htmlspecialchars($artiste->getNom() ?? 'Inconnu') ?></title>
<main class="artiste-page">
    <?php if (empty($artiste)): ?>
        <p>Artiste introuvable</p>
    <?php else: ?>
        <div class="row">
            <div class="col-md-8">
                <div class="text-center mb-4">
                    <?php if (!empty($artiste->getImageTitlePath())): ?>
                        <img class="img-fluid" style="max-height:20vh;"
                            src="<?= getRacine() . htmlspecialchars($artiste->getImageTitlePath()) ?>"
                            alt="<?= htmlspecialchars($artiste->getNom()) ?>">
                    <?php else: ?>
                        <img class="img-fluid" src="<?= getRacine() . 'images/ArtistePage/default.png' ?>"
                            alt="Image artiste">
                    <?php endif; ?>
                </div>

                <section class="mb-4">
                    <h3 class="NomArtiste"><?= htmlspecialchars($artiste->getNom()) ?></h3>
                    <p class="ArtisteText"><?= nl2br(htmlspecialchars($artiste->getDescription() ?? 'Aucune description')) ?>
                    </p>
                </section>

                <section>
                    <h3 class="NomArtiste">Albums :</h3>
                    <div class="cards">
                        <?php if (!empty($albums)): ?>
                            <?php foreach ($albums as $produit): ?>
                                <div class="card produit-card">
                                    <div class="cover-wrapper">
                                        <?php if ($produit->getDiscUrl()): ?>
                                            <img class="disc" src="<?= $produit->getDiscUrl() ?>" alt="">
                                        <?php endif; ?>
                                        <img class="cover" src="<?= $produit->getCoverUrl() ?>" alt="Pochette album">
                                    </div>

                                    <div class="card-info">
                                        <h3><a
                                                href="index.php?page=produit&id=<?= $produit->getId() ?>"><?= htmlspecialchars($produit->getNom()) ?></a>
                                        </h3>
                                        <p><?= htmlspecialchars($produit->getArtistesNoms()) ?></p>
                                        <p><?= htmlspecialchars($produit->getCategorieNom()) ?> - <span
                                                class="price"><?= number_format($produit->getPrix(), 2) ?> €</span></p>
                                    </div>

                                    <form method="post" action="recherche.php" class="ajout-panier-form">
                                        <input type="hidden" name="action" value="ajouter">
                                        <input type="hidden" name="id_produit" value="<?= $produit->getId() ?>">
                                        <button type="button" class="btn btn-danger w-100 ajouter-panier-btn mt-2"
                                            data-id="<?= $produit->getId() ?>">
                                            Ajouter au panier
                                        </button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aucun album trouvé.</p>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
            <div class="d-none d-md-block">
                <?php if (!empty($artiste->getImagePagePath())): ?>
                    <img class="img-fluid artiste-bg-img"
                        src="<?= getRacine() . htmlspecialchars($artiste->getImagePagePath()) ?>"
                        alt="<?= htmlspecialchars($artiste->getNom()) ?>">
                <?php endif; ?>
            </div>
            <div class="d-md-none .d-lg-block">
                <?php if (!empty($artiste->getImagePagePath())): ?>
                    <img class="artiste-bg-img-2"
                        src="<?= getRacine() . htmlspecialchars($artiste->getImagePagePath()) ?>"
                        alt="<?= htmlspecialchars($artiste->getNom()) ?>">
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</main>