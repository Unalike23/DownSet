<title>Recherche</title>

<main class="recherche-page parallax">
    <h1><img src="images/Recherche.png" style="max-height: 8vh; max-width: 50%;"></h1>

    <div class="row">
        <!-- Barre de recherche -->
        <form method="get" action="index.php" class="search-bar">
            <input type="hidden" name="page" value="recherche">
            <input type="text" name="q" value="<?= htmlspecialchars($q) ?>"
                placeholder="Rechercher un album, artiste, genre...">
            <?php
            $hiddenParams = ['genres', 'categories', 'prix_max', 'sort', 'sortType', 'view'];
            foreach ($hiddenParams as $param) {
                if (isset($_GET[$param])) {
                    if (is_array($_GET[$param])) {
                        foreach ($_GET[$param] as $value) {
                            echo '<input type="hidden" name="' . htmlspecialchars($param) . '[]" value="' . htmlspecialchars($value) . '">';
                        }
                    } else {
                        echo '<input type="hidden" name="' . htmlspecialchars($param) . '" value="' . htmlspecialchars($_GET[$param]) . '">';
                    }
                }
            }
            ?>
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <div class="row">

        <div class="mb-3 text-start gap-2 recherche-options">
            <!-- Bouton filtres -->
            <button class="btn filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtersOffcanvas">
                <img src="images/filters.png" style="max-height: 2.1vh;"> Filtres
            </button>
            I
            <!-- Choix Produits / Artistes -->
            <div class="btn filter">
                <a href="index.php?<?= http_build_query(array_merge($_GET, ['page' => 'recherche', 'view' => 'produits'])) ?>"
                    class="no-bold">Produits</a>
            </div>
            I
            <div class="btn filter">
                <a href="index.php?<?= http_build_query(array_merge($_GET, ['page' => 'recherche', 'view' => 'artistes'])) ?>"
                    class="no-bold">Artistes</a>
            </div>
            I
            <!-- Trier du plus Nouveau/Vendu etc... -->
            <form method="get" action="index.php" class="d-inline ms-3">
                <input type="hidden" name="page" value="recherche">
                <input type="hidden" name="q" value="<?= htmlspecialchars($q) ?>">
                <input type="hidden" name="view" value="<?= htmlspecialchars($view) ?>">
                <?php
                $hiddenParams = ['genres', 'categories', 'prix_max', 'sort'];
                foreach ($hiddenParams as $param) {
                    if (isset($_GET[$param])) {
                        if (is_array($_GET[$param])) {
                            foreach ($_GET[$param] as $value) {
                                echo '<input type="hidden" name="' . htmlspecialchars($param) . '[]" value="' . htmlspecialchars($value) . '">';
                            }
                        } else {
                            echo '<input type="hidden" name="' . htmlspecialchars($param) . '" value="' . htmlspecialchars($_GET[$param]) . '">';
                        }
                    }
                }
                ?>
                <select name="sortType" class="custom-dropdown form-select d-inline-block"
                    style="width:auto; display:inline-block;" onchange="this.form.submit()">
                    <option class="dropdown-options" value="">Trier par...</option>
                    <option class="dropdown-options" value="plus_vendus" <?= $sortType === 'plus_vendus' ? 'selected' : '' ?>>Les plus vendus</option>
                    <option class="dropdown-options" value="moins_vendus" <?= $sortType === 'moins_vendus' ? 'selected' : '' ?>>Les moins vendus</option>
                    <option class="dropdown-options" value="nouveaux" <?= $sortType === 'nouveaux' ? 'selected' : '' ?>>Les
                        nouveaux</option>
                    <option class="dropdown-options" value="anciens" <?= $sortType === 'anciens' ? 'selected' : '' ?>>Les
                        plus anciens</option>
                </select>
            </form>
        </div>

        <!-- Offcanvas des filtres -->
        <div class="offcanvas offcanvas-start text-light offcanvasFiltre" tabindex="-1" id="filtersOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Filtres</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <form method="get" action="index.php">
                    <input type="hidden" name="page" value="recherche">
                    <input type="hidden" name="q" value="<?= htmlspecialchars($q) ?>">
                    <?php
                    $hiddenParams = ['view', 'sort', 'sortType'];
                    foreach ($hiddenParams as $param) {
                        if (isset($_GET[$param])) {
                            if (is_array($_GET[$param])) {
                                foreach ($_GET[$param] as $value) {
                                    echo '<input type="hidden" name="' . htmlspecialchars($param) . '[]" value="' . htmlspecialchars($value) . '">';
                                }
                            } else {
                                echo '<input type="hidden" name="' . htmlspecialchars($param) . '" value="' . htmlspecialchars($_GET[$param]) . '">';
                            }
                        }
                    }
                    ?>
                    <!-- Genres -->
                    <div class="filter-group genres">
                        <h3>Genres</h3>
                        <?php foreach ($genresList as $g): ?>
                            <label class="checkbox">
                                <input type="checkbox" name="genres[]" value="<?= $g->getId() ?>"
                                    <?= in_array($g->getId(), (array) $genres) ? 'checked' : '' ?>>
                                <?= htmlspecialchars($g->getNom()) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- Catégories -->
                    <div class="filter-group mb-3">
                        <h3>Catégories</h3>
                        <?php foreach ($categoriesList as $c): ?>
                            <label class="checkbox d-block">
                                <input type="checkbox" name="categories[]" value="<?= $c->getId() ?>"
                                    <?= in_array($c->getId(), (array) $categories) ? 'checked' : '' ?>>
                                <?= htmlspecialchars($c->getNom()) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- Prix -->
                    <div class="filter-group mb-3">
                        <h3>Prix max</h3>
                        <input type="range" name="prix_max" id="prix_max" min="0" max="200" value="<?= $prix_max ?>"
                            step="1" oninput="document.getElementById('prix-value').innerText=this.value">
                        <span id="prix-value"><?= $prix_max ?></span> €
                    </div>

                    <!-- Tri par prix -->
                    <div class="filter-group mb-3">
                        <h3>Trier par prix</h3>
                        <select name="sort" id="sort" class="form-select">
                            <option value="asc" <?= $sort === 'asc' ? 'selected' : '' ?>>Croissant</option>
                            <option value="desc" <?= $sort === 'desc' ? 'selected' : '' ?>>Décroissant</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 apply-btn">Appliquer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Résultats -->

        <section class="produits">
            <div class="cards">
                <?php if ($view === 'produits'): ?>
                    <?php if (!empty($resultats)): ?>
                        <?php foreach ($resultats as $produit): ?>
                            <div class="card produit-card">
                                <div class="cover-wrapper">
                                    <?php if ($produit->getDiscUrl()): ?>
                                        <img class="disc" src="<?= $produit->getDiscUrl() ?>" alt="Disque">
                                    <?php endif; ?>
                                    <img class="cover" src="<?= $produit->getCoverUrl() ?>" alt="Pochette album">
                                </div>

                                <div class="card-info">
                                    <h3><a
                                            href="index.php?page=produit&id=<?= $produit->getId() ?>"><?= htmlspecialchars($produit->getNom()) ?></a>
                                    </h3>
                                    <p><?= htmlspecialchars($produit->getArtistesNoms()) ?></p>
                                    <p><?= htmlspecialchars($produit->getCategorieNom()) ?> -
                                        <span class="price"><?= number_format($produit->getPrix(), 2) ?> €</span>
                                    </p>
                                </div>

                                <!-- Ajouter au panier -->
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
                        <p>Aucun produit trouvé.</p>
                    <?php endif; ?>
                <?php elseif ($view === 'artistes'): ?>
                    <?php if (!empty($artistesResultats)): ?>
                        <?php foreach ($artistesResultats as $artiste): ?>
                            <div class="artiste-card-wrapper">
                                <a href="index.php?page=artiste&id=<?= $artiste->getId() ?>" class="artiste-card-link">
                                    <div class="artiste-card" style="background-image: url('<?= !empty($artiste->getImagePath())
                                        ? getRacine() . htmlspecialchars($artiste->getImagePath())
                                        : getRacine() . 'images/default.jpg' ?>');">
                                        <div class="artiste-name-overlay">
                                            <h3><?= htmlspecialchars($artiste->getNom()) ?></h3>
                                        </div>
                                        <?php if (!empty($artiste->getImageTitlePath())): ?>
                                            <div class="artiste-title-overlay">
                                                <img src="<?= getRacine() . htmlspecialchars($artiste->getImageTitlePath()) ?>" alt="Artist title">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>


            </div>

        </section>
        <?php if ($view === 'produits' && $totalPages > 1): ?>
            <nav class="pagination justify-content-center mt-4">
                <ul class="pagination">
                    <?php
                    // Construit correctement l’URL de base pour les liens
                    $queryParams = $_GET;
                    unset($queryParams['p']); // On enlève l’ancien numéro de page s’il existe
                    $baseUrl = 'index.php?' . http_build_query($queryParams);
                    ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="<?= htmlspecialchars($baseUrl . '&p=' . $i) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>


</main>