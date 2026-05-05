<?php
if (!isset($data) || !is_array($data)) {
    $data = [];
}
extract($data);

if (session_status() === PHP_SESSION_NONE)
    session_start();
$messages = $_SESSION['messages'] ?? [];
unset($_SESSION['messages']);

$isAdmin = isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin'] == 1;

if (!$isAdmin) {
    ?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Accès refusé</title>
    </head>

    <body>
        <div class="text-center">
            <h1 class="display-4">⛔ Non autorisé</h1>
            <p>Vous n'avez pas les droits pour accéder à cette page.</p>
            <a href="index.php" class="btn btn-danger mt-3">Retour à l'accueil</a>
        </div>
    </body>

    </html>
    <?php
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="public/css/admin.css">
<title>Admin Panel</title>

<main class="admin-page">
    <div class="container-fluid py-4">
        <!-- Messages d'alerte -->
        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Titre -->
        <div class="admin-header mb-5">
            <h1 class="admin-title">Administration</h1>
            <p class="admin-subtitle">Gérez vos genres, artistes et produits</p>
        </div>

        <!-- Tab Navigation -->
        <div class="admin-tabs mb-5">
            <div class="tabs-header">
                <button class="tab-btn active" data-tab="genre-section">📚 Ajouter Genre</button>
                <button class="tab-btn" data-tab="artist-section">🎤 Ajouter Artiste</button>
                <button class="tab-btn" data-tab="product-section">💿 Ajouter Produit</button>
                <button class="tab-btn" data-tab="products-list-section">📋 Produits Existants</button>
            </div>
        </div>

        <!-- Sections Ajout -->
        <div class="row g-4 mb-5">
            <!-- Ajout Genre -->
            <div class="col-12 col-lg-6">
                <div class="admin-card">
                    <div class="admin-card-body" id="genre-section" style="display: block;">
                        <form method="post">
                            <div class="form-group mb-3">
                                <label class="form-label">Nom du genre</label>
                                <input type="text" name="nom_genre" class="form-control" placeholder="Ex: Rock, Jazz..."
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="desc_genre" class="form-control" placeholder="Décrivez le genre..."
                                    rows="3"></textarea>
                            </div>
                            <button type="submit" name="ajout_genre" class="btn btn-primary w-100">
                                ✏️ Ajouter Genre
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Ajout Artiste -->
            <div class="col-12">
                <div class="admin-card">
                    <div class="admin-card-body" id="artist-section" style="display: none;">
                        <div class="row g-4 align-items-start">
                            <!-- Form - Left (2/3 width) -->
                            <div class="col-12 col-lg-8">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nom de l'artiste</label>
                                        <input type="text" name="nom_artiste" id="artiste_nom_input" class="form-control" placeholder="Nom de l'artiste"
                                            required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="desc_artiste" class="form-control" placeholder="Bio de l'artiste..."
                                            rows="3"></textarea>
                                    </div>

                                    <!-- Image Page Artiste (16:9) -->
                                    <div class="form-group mb-3">
                                        <label class="form-label">Image page artiste</label>
                                        <input type="file" name="img_artiste_page" id="img_artiste_page_input" accept="image/*"
                                            class="form-control">
                                        <small class="text-muted">Image principale de l'artiste</small>
                                    </div>

                                    <!-- Image Titre -->
                                    <div class="form-group mb-3">
                                        <label class="form-label">Image titre (logo)</label>
                                        <input type="file" name="img_artiste_title" id="img_artiste_title_input" accept="image/*"
                                            class="form-control">
                                        <small class="text-muted">Logo ou titre de l'artiste</small>
                                    </div>

                                    <!-- Image Artiste Background -->
                                    <div class="form-group mb-0">
                                        <label class="form-label">Image card</label>
                                        <input type="file" name="img_artiste" id="img_artiste_input" accept="image/*"
                                            class="form-control">
                                        <small class="text-muted">Image de la card de l'artiste</small>
                                    </div>

                                    <button type="submit" name="ajout_artiste" class="btn btn-primary w-100 mt-4">
                                        ✏️ Ajouter Artiste
                                    </button>
                                </form>
                            </div>

                            <!-- Preview - Right (1/3 width) -->
                            <div class="col-12 col-lg-4">
                                <div id="artist-preview-container" style="display: none;">
                                    <label class="form-label d-block mb-3">Aperçu de l'artiste</label>
                                    
                                    <!-- Page Preview Box (16:9) -->
                                    <div class="artist-preview-box mb-4">
                                        <div class="artist-preview-content">
                                            <img id="preview-artiste-page-img" src="" alt="Artist Page" class="artist-page-img">
                                            <img id="preview-artiste-title-img" src="" alt="Artist Title" class="artist-title-img">
                                        </div>
                                    </div>

                                    <!-- Title Preview Box -->
                                    <div class="artist-title-preview-box mb-4">
                                        <label class="form-label d-block mb-2" style="font-size: 0.9rem;">Titre</label>
                                        <img id="preview-artiste-title-display" src="" alt="Title" class="artist-title-display" style="max-height: 60px; display: none;">
                                    </div>

                                    <!-- Card Preview Box -->
                                    <div class="artist-card-preview-box">
                                        <label class="form-label d-block mb-2" style="font-size: 0.9rem;">Aperçu de la carte</label>
                                        <div id="preview-artiste-card" class="artiste-card-preview" style="background-image: url('images/default.jpg');">
                                            <div class="artiste-name-overlay">
                                                <h3 id="preview-artiste-card-name">Nom de l'artiste</h3>
                                            </div>
                                            <div class="artiste-title-overlay" id="preview-artiste-card-title" style="display: none;">
                                                <img id="preview-artiste-card-title-img" src="" alt="Artist title">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ajout Produit -->
            <div class="col-12">
                <div class="admin-card">
                    <div class="admin-card-body" id="product-section" style="display: none;">
                        <div class="row g-4 align-items-start">
                            <!-- Form - Left and Center (2/3 width) -->
                            <div class="col-12 col-lg-8">
                                <form method="post" enctype="multipart/form-data">
                                    <!-- Top Row: Nom et Description -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label class="form-label">Nom du produit</label>
                                            <input type="text" name="nom_produit" class="form-control" placeholder="Nom du produit"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <textarea name="desc_produit" class="form-control" placeholder="Description du produit..."
                                                rows="2"></textarea>
                                        </div>
                                    </div>

                                    <!-- Left Column: Artistes et Genres | Right Column: Prix, Stock, Catégorie -->
                                    <div class="row g-3 mb-3">
                                        <!-- Left Column -->
                                        <div class="col-12 col-md-6">
                                            <!-- Artistes -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">Artistes</label>
                                                <select name="id_artistes[]" class="form-control select2" multiple>
                                                    <?php foreach ($artistes as $a): ?>
                                                        <option value="<?= $a->getId() ?>"><?= htmlspecialchars($a->getNom()) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <!-- Genres -->
                                            <div class="form-group mb-0">
                                                <label class="form-label">Genres</label>
                                                <select name="id_genres[]" class="form-control select2" multiple>
                                                    <?php foreach ($genres as $g): ?>
                                                        <option value="<?= $g->getId() ?>"><?= htmlspecialchars($g->getNom()) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-12 col-md-6">
                                            <!-- Prix & Stock -->
                                            <div class="row g-2 mb-3">
                                                <div class="col-6">
                                                    <label class="form-label">Prix (€)</label>
                                                    <input type="number" step="0.01" name="prix_unitaire" class="form-control"
                                                        placeholder="0.00" required>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Stock</label>
                                                    <input type="number" name="stock" class="form-control" placeholder="0" required>
                                                </div>
                                            </div>

                                            <!-- Catégorie -->
                                            <div class="form-group mb-0">
                                                <label class="form-label">Catégorie</label>
                                                <select name="id_categorie" id="id_categorie" class="form-control">
                                                    <option value="">-- Choisir --</option>
                                                    <?php foreach ($categories as $c): ?>
                                                        <option value="<?= $c->getId() ?>" data-category="<?= htmlspecialchars($c->getNom()) ?>">
                                                            <?= htmlspecialchars($c->getNom()) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Images Row -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Image cover</label>
                                            <input type="file" name="img_produit" id="img_produit_input" accept="image/*"
                                                class="form-control" data-field="cover">
                                            <small class="text-muted">Affiche de l'album/produit</small>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Image disque</label>
                                            <input type="file" name="img_disk" id="img_disk_input" accept="image/*"
                                                class="form-control" data-field="disk">
                                            <small class="text-muted">Vinyle, CD, ou cassette</small>
                                        </div>
                                    </div>

                                    <button type="submit" name="ajout_produit" class="btn btn-primary w-100">
                                        ✏️ Ajouter Produit
                                    </button>
                                </form>
                            </div>

                            <!-- Preview - Right (1/3 width) -->
                            <div class="col-12 col-lg-4">
                                <div id="product-preview-container" style="display: none;">
                                    <label class="form-label d-block mb-3">Aperçu du produit</label>
                                    <div class="card produit-card product-preview-card">
                                        <div class="cover-wrapper" id="preview-cover-wrapper">
                                            <img class="disc" id="preview-disc-img" src="" alt="Disc" style="display: none;">
                                            <img class="cover" id="preview-cover-img" src="images/default.jpg" alt="Cover">
                                        </div>
                                        <div class="card-info">
                                            <h3>
                                                <a href="javascript:void(0)" style="color: #ffffff; text-decoration: none;" id="preview-title">Nom du produit</a>
                                            </h3>
                                            <p class="artist-name" id="preview-artist">Sélectionner des artistes</p>
                                            <p class="category-name" id="preview-category">Sélectionner une catégorie</p>
                                            <div class="card-footer">
                                                <span class="price" id="preview-price">0.00 €</span>
                                            </div>
                                        </div>
                                        <button class="ajouter-panier-btn" disabled>Aperçu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste Produits -->
        <div class="admin-card mt-5">
            <div class="admin-card-body" id="products-list-section" style="display: none;">
                <!-- Barre de recherche -->
                <div class="mb-4">
                    <input type="text" id="product-search-input" class="form-control" placeholder="🔍 Rechercher un produit..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    <small class="text-muted mt-2 d-block">Recherche en temps réel</small>
                </div>

                <!-- Table Responsif -->
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Artistes</th>
                                <th>Genres</th>
                                <th>Catégories</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="products-tbody">
                            <?php if (!empty($produits)): ?>
                                <?php foreach ($produits as $p): ?>
                                    <tr class="product-row" data-nom="<?= strtolower($p->getNom() ?? '') ?>" 
                                        data-artistes="<?= strtolower($p->getArtistesNoms() ?? '') ?>"
                                        data-genres="<?= strtolower($p->getGenresNoms() ?? '') ?>"
                                        data-categories="<?= strtolower($p->getCategorieNom() ?? '') ?>">
                                        <td><strong><?= htmlspecialchars($p->getNom()) ?></strong></td>
                                        <td><?= htmlspecialchars($p->getArtistesNoms()) ?></td>
                                        <td><?= htmlspecialchars($p->getGenresNoms()) ?></td>
                                        <td><?= htmlspecialchars($p->getCategorieNom()) ?></td>
                                        <td><span class="badge bg-success"><?= number_format($p->getPrix(), 2) ?> €</span></td>
                                        <td>
                                            <span class="badge <?= $p->getStock() > 0 ? 'bg-info' : 'bg-danger' ?>">
                                                <?= $p->getStock() ?> unités
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <!-- Modifier Prix -->
                                                <form method="post" class="action-form" style="display:inline;">
                                                    <input type="hidden" name="id_produit" value="<?= $p->getId() ?>">
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" step="0.01" name="nouveau_prix" 
                                                            placeholder="€" class="form-control" required>
                                                        <button type="submit" name="modifier_prix"
                                                            class="btn btn-warning btn-sm" title="Modifier le prix">
                                                            💰
                                                        </button>
                                                    </div>
                                                </form>

                                                <!-- Supprimer -->
                                                <form method="post" style="display:inline;"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                                    <input type="hidden" name="id_produit" value="<?= $p->getId() ?>">
                                                    <button type="submit" name="supprimer_produit"
                                                        class="btn btn-sm btn-danger" title="Supprimer le produit">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <em>Aucun produit trouvé</em>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Tab system
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Hide all sections
            document.querySelectorAll('[id$="-section"]').forEach(section => {
                section.style.display = 'none';
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active');
            });
            
            // Show selected section
            const selectedSection = document.getElementById(tabId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
            
            // Add active class to clicked button
            this.classList.add('active');
        });
    });

    // Initialiser Select2
    $('.select2').select2({
        placeholder: 'Choisir...',
        allowClear: true,
        theme: 'classic',
        width: '100%'
    });

    // Artist Preview
    const artisteNomInput = document.getElementById('artiste_nom_input');
    const imgArtistPageInput = document.getElementById('img_artiste_page_input');
    const imgArtistTitleInput = document.getElementById('img_artiste_title_input');
    const imgArtistInput = document.getElementById('img_artiste_input');
    const artistPreviewContainer = document.getElementById('artist-preview-container');
    const previewArtistPageImg = document.getElementById('preview-artiste-page-img');
    const previewArtistTitleImg = document.getElementById('preview-artiste-title-img');
    const previewArtistTitleDisplay = document.getElementById('preview-artiste-title-display');
    const previewArtistCard = document.getElementById('preview-artiste-card');
    const previewArtistCardName = document.getElementById('preview-artiste-card-name');
    const previewArtistCardTitle = document.getElementById('preview-artiste-card-title');
    const previewArtistCardTitleImg = document.getElementById('preview-artiste-card-title-img');

    function updateArtistPreview() {
        const hasPageImg = imgArtistPageInput.files.length > 0;
        const hasTitleImg = imgArtistTitleInput.files.length > 0;
        const hasCardImg = imgArtistInput.files.length > 0;
        
        if (hasPageImg || hasTitleImg || hasCardImg) {
            artistPreviewContainer.style.display = 'block';
        } else {
            artistPreviewContainer.style.display = 'none';
            return;
        }

        // Update card name
        previewArtistCardName.textContent = artisteNomInput.value || 'Nom de l\'artiste';

        // Update page image
        if (hasPageImg) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewArtistPageImg.src = e.target.result;
            };
            reader.readAsDataURL(imgArtistPageInput.files[0]);
        }

        // Update title image
        if (hasTitleImg) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewArtistTitleImg.src = e.target.result;
                previewArtistTitleDisplay.src = e.target.result;
                previewArtistTitleDisplay.style.display = 'block';
                previewArtistCardTitle.style.display = 'block';
                previewArtistCardTitleImg.src = e.target.result;
            };
            reader.readAsDataURL(imgArtistTitleInput.files[0]);
        } else {
            previewArtistTitleDisplay.style.display = 'none';
            previewArtistCardTitle.style.display = 'none';
        }

        // Update card background image
        if (hasCardImg) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewArtistCard.style.backgroundImage = `url('${e.target.result}')`;
            };
            reader.readAsDataURL(imgArtistInput.files[0]);
        }
    }

    // Event listeners for artist preview
    artisteNomInput.addEventListener('input', updateArtistPreview);
    imgArtistPageInput.addEventListener('change', updateArtistPreview);
    imgArtistTitleInput.addEventListener('change', updateArtistPreview);
    imgArtistInput.addEventListener('change', updateArtistPreview);

    // Product Preview
    const coverInput = document.getElementById('img_produit_input');
    const diskInput = document.getElementById('img_disk_input');
    const nomInput = document.querySelector('input[name="nom_produit"]');
    const prixInput = document.querySelector('input[name="prix_unitaire"]');
    const categorieSelect = document.getElementById('id_categorie');
    const artisteSelect = document.querySelector('select[name="id_artistes[]"]');
    const previewContainer = document.getElementById('product-preview-container');
    const previewTitle = document.getElementById('preview-title');
    const previewPrice = document.getElementById('preview-price');
    const previewCoverImg = document.getElementById('preview-cover-img');
    const previewDiskImg = document.getElementById('preview-disc-img');
    const previewArtist = document.getElementById('preview-artist');
    const previewCategory = document.getElementById('preview-category');

    function getDefaultDiskImage(categoryName) {
        if (!categoryName) return null;
        const cat = categoryName.toLowerCase();
        if (cat.includes('vinyle')) return 'images/vinyl.png';
        if (cat.includes('cd')) return 'images/cd.png';
        if (cat.includes('cassette')) return 'images/cassette.png';
        return null;
    }

    function updatePreview() {
        const hasCover = coverInput.files.length > 0;
        const hasDisk = diskInput.files.length > 0;
        
        if (hasCover) {
            previewContainer.style.display = 'block';
        } else {
            previewContainer.style.display = 'none';
            return;
        }

        // Update title and price
        previewTitle.textContent = nomInput.value || 'Nom du produit';
        previewPrice.textContent = (parseFloat(prixInput.value) || 0).toFixed(2) + ' €';

        // Update category and get selected option text
        const selectedOption = categorieSelect.options[categorieSelect.selectedIndex];
        const categoryText = selectedOption.textContent || 'Sélectionner une catégorie';
        previewCategory.textContent = categoryText;

        // Update artist names
        const selectedArtists = Array.from(artisteSelect.selectedOptions).map(opt => opt.textContent).join(', ');
        previewArtist.textContent = selectedArtists || 'Sélectionner des artistes';

        // Update cover image
        if (hasCover) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewCoverImg.src = e.target.result;
            };
            reader.readAsDataURL(coverInput.files[0]);
        }

        // Update disk image - prioritize uploaded disk, then use default based on category
        if (hasDisk) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewDiskImg.src = e.target.result;
                previewDiskImg.style.display = 'block';
            };
            reader.readAsDataURL(diskInput.files[0]);
        } else {
            // Use default disk image based on category
            const categoryText = selectedOption.textContent || '';
            const defaultDisk = getDefaultDiskImage(categoryText);
            if (defaultDisk) {
                previewDiskImg.src = defaultDisk;
                previewDiskImg.style.display = 'block';
            } else {
                previewDiskImg.style.display = 'none';
            }
        }
    }

    // Event listeners for product preview
    coverInput.addEventListener('change', updatePreview);
    diskInput.addEventListener('change', updatePreview);
    nomInput.addEventListener('input', updatePreview);
    prixInput.addEventListener('input', updatePreview);
    categorieSelect.addEventListener('change', updatePreview);
    artisteSelect.addEventListener('change', updatePreview);

    // Real-time product search
    const searchInput = document.getElementById('product-search-input');
    const productRows = document.querySelectorAll('.product-row');

    // Hide all products on page load
    productRows.forEach(row => {
        row.style.display = 'none';
    });

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;

        // If search is empty, hide all products
        if (searchTerm === '') {
            productRows.forEach(row => {
                row.style.display = 'none';
            });
            
            const tbody = document.getElementById('products-tbody');
            let noResultsRow = tbody.querySelector('.no-results-row');
            if (noResultsRow) noResultsRow.remove();
            return;
        }

        productRows.forEach(row => {
            const nom = row.dataset.nom || '';
            const artistes = row.dataset.artistes || '';
            const genres = row.dataset.genres || '';
            const categories = row.dataset.categories || '';

            const matches = nom.includes(searchTerm) || 
                           artistes.includes(searchTerm) || 
                           genres.includes(searchTerm) || 
                           categories.includes(searchTerm);

            row.style.display = matches ? '' : 'none';
            if (matches) visibleCount++;
        });

        // Show "no results" message if needed
        const tbody = document.getElementById('products-tbody');
        let noResultsRow = tbody.querySelector('.no-results-row');
        
        if (visibleCount === 0) {
            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.className = 'no-results-row';
                noResultsRow.innerHTML = '<td colspan="7" class="text-center py-4"><em>Aucun produit trouvé</em></td>';
                tbody.appendChild(noResultsRow);
            }
            noResultsRow.style.display = '';
        } else if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    });
</script>