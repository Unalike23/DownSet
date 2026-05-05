<title>DownSet Record</title>

<main class="hero">
    <div class="row ">
        <!-- Hero section -->
        <section class="hero accueil">
            <div class="hero-content">
                <img class="img-fluid" src="images/DownSetRecords.png">
                <p>Découvrez notre sélection exclusive de vinyles, CD et cassettes pour les passionnés de musique.</p>

                <!-- recherche -->
                <form action="index.php" method="get" class="hero-search">
                    <input type="hidden" name="page" value="recherche">
                    <input type="text" name="q" placeholder="Rechercher un album, artiste, genre..." required>
                    <button type="submit">🔍</button>
                </form>
            </div>
        </section>
    </div>

    <!-- Sections Arrivages et Hots -->
    <div class="row">
        <!-- Derniers Arrivages -->
        <div class="col-12 col-lg-6">
            <section class="produits">
                <div class="row">
                    <div class="col-12 slider-wrapper">
                        <div class="slider-container">
                            <button class="slide-btn prev">&#10094;</button>
                            <div class="slider">
                                <?php foreach ($arrivages as $produit): ?>
                                    <?php
                                    $artistImg = !empty($produit->getArtistes()) ? BASE_URL . htmlspecialchars($produit->getArtistes()[0]->getImagePagePath()) : BASE_URL . 'images/default.jpg';
                                    ?>
                                    <div class="slide">
                                        <div class="slide-bg" style="background-image: url('<?= $produit->getCoverUrl() ?>')"></div>
                                        <div class="slide-info-2">
                                            <span>📢 New</span>
                                        </div>
                                        <div class="cards slide-left">
                                            <div class="accueil-cover">
                                                <?php if ($produit->getDiscUrl()): ?>
                                                    <img class="disc" src="<?= $produit->getDiscUrl() ?>" alt="Disque">
                                                <?php endif; ?>
                                                <img class="cover" src="<?= $produit->getCoverUrl() ?>" alt="Pochette album">
                                            </div>
                                        </div>
                                        <div class="slide-right">
                                            <img class="artist d-none d-md-block" src="<?= $artistImg ?>" alt="Artiste">
                                            <span class="price"><?= number_format($produit->getPrix(), 2) ?> €</span>
                                        </div>
                                        <div class="slide-info">
                                            <h3><a
                                                    href="index.php?page=produit&id=<?= $produit->getId() ?>"><?= htmlspecialchars($produit->getNom()) ?></a>
                                            </h3>
                                            <p><?= htmlspecialchars($produit->getArtistesNoms()) ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slide-btn next">&#10095;</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Produits Hots -->
        <div class="col-12 col-lg-6">
            <section class="produits">
                <div class="row">
                    <div class="col-12 slider-wrapper">
                        <div class="slider-container">
                            <button class="slide-btn prev">&#10094;</button>
                            <div class="slider">
                                <?php foreach ($hots as $produit): ?>
                                    <?php
                                    $artistImg = !empty($produit->getArtistes()) ? BASE_URL . htmlspecialchars($produit->getArtistes()[0]->getImagePagePath()) : BASE_URL . 'images/default.jpg';
                                    ?>
                                    <div class="slide">
                                        <div class="slide-info-2">
                                            <span>🔥 Hot</span>
                                        </div>
                                        <div class="slide-bg" style="background-image: url('<?= $produit->getCoverUrl() ?>')"></div>
                                        <div class="cards slide-left">
                                            <div class="accueil-cover">
                                                <?php if ($produit->getDiscUrl()): ?>
                                                    <img class="disc" src="<?= $produit->getDiscUrl() ?>" alt="Disque">
                                                <?php endif; ?>
                                                <img class="cover" src="<?= $produit->getCoverUrl() ?>" alt="Pochette album">
                                            </div>
                                        </div>
                                        <div class="slide-right">
                                            <img class="artist d-none d-md-block" src="<?= $artistImg ?>" alt="Artiste">
                                            <span class="price"><?= number_format($produit->getPrix(), 2) ?> €</span>
                                        </div>
                                        <div class="slide-info">
                                            <h3><a
                                                    href="index.php?page=produit&id=<?= $produit->getId() ?>"><?= htmlspecialchars($produit->getNom()) ?></a>
                                            </h3>
                                            <p><?= htmlspecialchars($produit->getArtistesNoms()) ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slide-btn next">&#10095;</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Notifications
        let notifContainer = document.getElementById('notifications');
        if (!notifContainer) {
            notifContainer = document.createElement('div');
            notifContainer.id = 'notifications';
            document.body.appendChild(notifContainer);
        }



        // Gestion multi-sliders
        document.querySelectorAll('.slider-container').forEach(container => {
            const slider = container.querySelector('.slider');
            const slides = container.querySelectorAll('.slide');
            const prevBtn = container.querySelector('.slide-btn.prev');
            const nextBtn = container.querySelector('.slide-btn.next');
            let index = 0;

            function showSlide(i) {
                if (i < 0) index = slides.length - 1;
                else if (i >= slides.length) index = 0;
                else index = i;
                slider.style.transform = `translateX(-${index * 100}%)`;
            }

            prevBtn.addEventListener('click', () => showSlide(index - 1));
            nextBtn.addEventListener('click', () => showSlide(index + 1));

            // Slide automatique toutes les 10 secondes (par slider)
            setInterval(() => showSlide(index + 1), 10000);
        });
    });
</script>