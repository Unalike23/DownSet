-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 05 mai 2026 à 19:02
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `downsetrecordmvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int NOT NULL AUTO_INCREMENT,
  `rue` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `code_postal` int DEFAULT NULL,
  `numero_rue` int DEFAULT NULL,
  `type_numero_rue` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `rue`, `ville`, `code_postal`, `numero_rue`, `type_numero_rue`) VALUES
(12, 'Tung Tung Tung Sahur', 'Heaven', 69420, 67, ''),
(3, 'Avenue Francis Planté PORTE 22', 'Dax', 40100, 2, ''),
(5, 'Avenue Holy Mantle', 'Above', 67420, 5, ''),
(6, 'Rue Foenem Grave', 'Bayonne', 64100, 67, '');

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

DROP TABLE IF EXISTS `artiste`;
CREATE TABLE IF NOT EXISTS `artiste` (
  `id_artiste` int NOT NULL AUTO_INCREMENT,
  `nom_artiste` varchar(50) DEFAULT NULL,
  `desc_artiste` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `img_type` varchar(50) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `img_page_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `img_title_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_artiste`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `artiste`
--

INSERT INTO `artiste` (`id_artiste`, `nom_artiste`, `desc_artiste`, `img_type`, `img_path`, `img_page_path`, `img_title_path`) VALUES
(12, 'Linkin Park', 'Linkin Park est un groupe américain formé en 1996 en Californie. Pionnier du nu metal et du rock alternatif, le groupe s’est rapidement imposé grâce à son style unique, mélangeant guitares puissantes, rap incisif et refrains mélodiques. Leur succès planétaire a commencé avec Hybrid Theory, suivi par des albums innovants comme Meteora, Minutes to Midnight ou A Thousand Suns. Reconnu pour ses concerts énergiques et ses expérimentations sonores, Linkin Park a marqué la musique moderne et continue d’influencer de nombreux artistes, malgré la perte tragique de son chanteur Chester Bennington en 2017.', 'image/jpg', 'images/uploads/LinkinPark.jpg', 'images/ArtistePage/LinkinParkPage.png', 'images/ArtistePage/LinkinParkTitle.png'),
(13, 'System of a Down', 'System of a Down est un groupe de metal alternatif fondé en 1994 à Los Angeles par des musiciens d’origine arménienne. Leur style unique mélange riffs puissants, rythmes imprévisibles et influences orientales, avec des paroles engagées sur la politique, la société et la guerre, mais aussi teintées d’humour et d’absurde. Leur album culte Toxicity (2001) a marqué les années 2000 grâce à des titres emblématiques comme Chop Suey!, Toxicity ou Aerials. Véritable pilier du metal moderne, l’album allie énergie brute et mélodies marquantes, abordant des thèmes tels que l’addiction, l’environnement et les dérives de la société. Avec plus de 12 millions d’exemplaires vendus, Toxicity a propulsé System of a Down au rang de référence mondiale.', 'images/jpg', 'images/uploads/SOADArtiste.jpg', 'images/ArtistePage/SOADPage.png', 'images/ArtistePage/SOADTitle.png'),
(14, 'The Garden', 'The Garden est un duo californien formé par les frères jumeaux Wyatt et Fletcher Shears. Actifs depuis 2011, ils sont connus pour leur style unique qu’ils définissent comme du « Vada Vada », une approche libre et expérimentale de la musique. Leur univers mélange punk, rock, hip-hop, électro et sons expérimentaux, créant une esthétique brute, décalée et imprévisible. Avec une forte identité visuelle et des performances scéniques énergiques, The Garden s’est imposé comme un groupe culte de la scène alternative moderne, apprécié pour son audace et sa créativité sans limites.', 'image/jpg', 'images/uploads/TheGarden.jpg', 'images/ArtistePage/TheGardenPage.png', 'images/ArtistePage/TheGardenTitle.png'),
(16, 'Joey Valence & Brae', 'Joey Valence & Brae est un duo américain formé en 2021. Inspirés par le hip-hop old school des années 90, ils mélangent flow rapide, beats puissants et une touche moderne, créant une musique à la fois rétro et fraîche. Leur style énergique et fun leur a rapidement permis de se démarquer sur la scène rap alternative et électro-rap.', 'image/jpg', 'images/uploads/JVB.jpg', 'images/ArtistePage/JVBPage.png', 'images/ArtistePage/JVBTitle.png'),
(17, 'Deftones', 'Deftones est un groupe de metal alternatif américain formé en 1988 à Sacramento. Connus pour leur mélange unique de nu metal, shoegaze, rock expérimental et atmosphères planantes, ils allient riffs lourds, voix intenses et ambiances mélodiques. Souvent décrits comme un groupe novateur, les Deftones ont marqué la scène des années 90 et 2000 avec un son à la fois puissant et émotionnel.', NULL, 'images/uploads/DeftonesGroup.jpg', 'images/ArtistePage/DeftonesPage.png', 'images/ArtistePage/DeftonesTitle.png'),
(18, 'Machine Girl', 'Machine Girl est un projet musical américain fondé par Matt Stephenson en 2012. Le style du groupe mélange breakcore, digital hardcore, noise, punk et électro expérimentale, offrant une musique explosive, intense et sans compromis. Machine Girl est reconnu pour ses sons frénétiques, ses beats cassés et ses performances live survoltées, où énergie et chaos vont de pair.', NULL, 'images/uploads/MachineGirl.JPG', 'images/ArtistePage/MGPage.png', 'images/ArtistePage/MGTitle.png'),
(19, 'Zola', 'Zola est un rappeur français originaire d’Évry, révélé à la fin des années 2010. Avec son style énergique et ses flows percutants, il s’impose rapidement comme l’une des figures montantes du rap français. Sa musique mêle trap moderne, mélodies sombres et textes directs, souvent ancrés dans la réalité de la rue et l’ascension sociale.', NULL, 'images/uploads/Zola.JPG', 'images/ArtistePage/ZolaPage.png', 'images/ArtistePage/ZolaTitle.png'),
(20, 'Tame Impala', 'Tame Impala est le projet musical de l’Australien Kevin Parker, actif depuis la fin des années 2000. Son style mêle rock psychédélique, pop et électro, avec des productions riches en textures sonores et des atmosphères rêveuses. Tame Impala s’est imposé comme une référence mondiale de la scène psych-rock moderne, reconnu pour ses albums novateurs et ses concerts immersifs.', NULL, 'images/uploads/TameImpala.jpg', 'images/ArtistePage/TameImpalaPage.png', 'images/ArtistePage/TameImpalaTitle.png'),
(21, 'Tyler The Creator', 'Tyler, The Creator est un rappeur, producteur et designer américain, fondateur du collectif Odd Future. Connu pour son univers créatif et ses expérimentations sonores, il mélange rap, jazz, soul, R&B et musiques électroniques. Toujours en évolution, Tyler s’est imposé comme l’une des figures majeures du rap moderne et de la culture alternative.', NULL, 'images/uploads/TylerTheCreator.JPG', 'images/ArtistePage/TylerPage.png', 'images/ArtistePage/TylerTitle.png'),
(22, 'Björk', 'Björk est une chanteuse, compositrice et productrice islandaise, reconnue pour sa voix unique et ses expérimentations musicales audacieuses. Mélangeant pop, électronique, trip-hop, ambient et avant-garde, elle a marqué les années 90 et 2000 avec des albums novateurs qui repoussent sans cesse les frontières de la musique.', NULL, 'images/uploads/Bjork.jpg', 'images/ArtistePage/BjorkPage.png', 'images/ArtistePage/BjorkTitle.png'),
(23, 'Magdalena Bay', 'Magdalena Bay est un duo américain formé par Mica Tenenbaum et Matthew Lewin. Leur musique mélange pop électronique, synthpop et influences rétro-futuristes, créant un univers à la fois coloré, rêveur et dansant. Avec leurs visuels soignés et leur approche créative, ils s’imposent comme l’une des révélations de la scène pop alternative moderne.', NULL, 'images/uploads/MagdalenaBay.jpg', 'images/ArtistePage/MagdalenaPage.png', 'images/ArtistePage/MagdalenaTitle.png'),
(24, 'Kendrick Lamar', 'Kendrick Lamar est un rappeur, auteur et producteur américain originaire de Compton. Reconnu pour ses textes puissants et son approche novatrice, il mêle hip-hop, jazz, funk, soul et musiques expérimentales. Ses albums, salués par la critique et le public, en font l’une des figures majeures du rap contemporain.', NULL, 'images/uploads/KendrickLamar.jpg', 'images/ArtistePage/KendrickPage.png', 'images/ArtistePage/KendrickTitle.png'),
(25, 'MF DOOM', 'MF DOOM (Daniel Dumile) était un rappeur et producteur britannique-américain, reconnu pour son masque iconique et son style unique. Maître du rap underground, il se distingue par ses rimes complexes, ses productions lo-fi et son univers mystérieux. Son influence reste immense dans la scène hip-hop alternative.', NULL, 'images/uploads/MfDoom.jpg', 'images/ArtistePage/MFDOOMPage.png', 'images/ArtistePage/MFDOOMTitle.png'),
(26, 'Playboi Carti', 'Playboi Carti est un rappeur américain originaire d’Atlanta, connu pour son style minimaliste, ses flows répétitifs et son énergie unique. Avec son approche expérimentale du trap et son esthétique influente, il est devenu une figure centrale de la scène rap moderne.', NULL, 'images/uploads/PlayboiCarti.jpg', 'images/ArtistePage/CartiPage.png', 'images/ArtistePage/CartiTitle.png'),
(27, 'Nirvana', 'Nirvana est un groupe américain formé en 1987 à Seattle par Kurt Cobain et Krist Novoselic. Figure emblématique du grunge, leur musique mélange punk, rock alternatif et une énergie brute qui a marqué toute une génération. Avec des textes introspectifs et une intensité unique, ils restent une référence incontournable du rock des années 90.', NULL, 'images/uploads/Nirvana.jpg', 'images/ArtistePage/NirvanaPage.png', 'images/ArtistePage/NirvanaTitle.png'),
(28, 'Cynthoni', 'Cynthoni est un artiste (connu sous le nom de Sewerslvt (2020-2022)) breakcore, jungle, dnb... ', NULL, 'images/uploads/Cynthoni.jpg', 'images/ArtistePage/CynthoniPage.png', 'images/ArtistePage/CynthoniTitle.png'),
(29, 'Evangelion', 'Neon Genesis Evangelion suit Shinji Ikari, adolescent pilote d’un Evangelion, pour défendre l’humanité contre des créatures mystérieuses, les Anges. Entre combats épiques et drames psychologiques, la série explore peurs et relations humaines. Sa bande originale emblématique, mêlant orchestration intense et atmosphères mélancoliques, est un incontournable pour tout collectionneur de vinyles et fan d’animé.', NULL, 'images/uploads/Evangelion.png', 'images/ArtistePage/EvangelionPage.png', 'images/ArtistePage/EvangelionTitle.png'),
(31, 'Jamiroquai', 'Jamiroquai est un groupe britannique fondé en 1992 par le chanteur Jay Kay. Figure emblématique de l’acid jazz et du funk moderne, le groupe a su mélanger groove, disco, soul et électro pour créer un son unique et immédiatement reconnaissable. Avec leurs mélodies entraînantes et leurs performances énergiques, ils sont devenus une référence incontournable des années 90 et 2000.', NULL, 'images/uploads/Jamiroquai.jpg', 'images/ArtistePage/artiste_1758638510_JamiroquaiPage.png', 'images/ArtistePage/artiste_title_1758638510_JamiroquaiTitle.png'),
(34, 'Hamza', 'Hamza, figure emblématique du rap belge, mélange habilement mélodies envoûtantes et textes percutants. Toujours à la pointe de l’innovation, il transforme chaque morceau en expérience unique, captivant un public fidèle et passionné.', NULL, 'images/uploads/Hamza.jpg', 'images/ArtistePage/HamzaPage.png', 'images/ArtistePage/HamzaTitle.png'),
(38, 'Favé', 'Favé, artiste à l’énergie débordante, mélange textes incisifs et mélodies entraînantes. Ses morceaux reflètent authenticité et audace, créant un univers unique où émotions brutes et rythmes percutants captivent l’auditeur à chaque écoute.', NULL, 'images/uploads/Fave.jpg', 'images/ArtistePage/artiste_1758743881_FavePage.png', 'images/ArtistePage/artiste_title_1758743881_FaveTitle.png'),
(37, 'PLK', 'PLK, l’une des voix les plus dynamiques du rap français, mélange punchlines aiguisées et mélodies entraînantes. Ses textes reflètent à la fois la rue et l’ambition, offrant à chaque album une énergie unique qui captive et fait vibrer ses fans à travers toute la scène urbaine.', NULL, 'images/uploads/PLK.jpg', 'images/ArtistePage/artiste_1758743066_PLKPage.png', 'images/ArtistePage/artiste_title_1758743066_PLKTitle.png'),
(39, 'Metallica', 'Metallica est une légende du metal, pionnier du thrash et référence mondiale depuis les années 80. Avec une énergie brute, des riffs puissants et des textes intemporels, le groupe a marqué l’histoire du rock et continue de fédérer des millions de fans à travers le monde.', NULL, 'images/uploads/Metallica.jpg', 'images/ArtistePage/artiste_1758748606_MetallicaPage.png', 'images/ArtistePage/artiste_title_1758748606_MetallicaTitle.png'),
(40, 'Femtanyl', 'Femtanyl est un projet radical et abrasif, mêlant breakcore, sons industriels et expérimentations bruitistes. Entre chaos sonore et intensité extrême, sa musique bouscule les codes et plonge l’auditeur dans une expérience brute, violente et sans compromis, taillée pour les amateurs d’underground.', NULL, 'images/uploads/Femtanyl.jpg', 'images/ArtistePage/artiste_1758831567_FemtanylPage.png', 'images/ArtistePage/artiste_title_1758831567_FemtanylTitle.png'),
(41, 'JPEGMAFIA', 'JPEGMAFIA est un artiste innovant du rap alternatif, reconnu pour ses productions audacieuses, ses beats glitchés et son flow incisif. Entre énergie brute, expérimentation sonore et textes provocateurs, sa musique offre une expérience unique pour les amateurs de vinyles et de hip-hop avant-gardiste.', NULL, 'images/uploads/JPEGMAFIA.jpg', 'images/ArtistePage/artiste_1758838344_JPEGMAFIAPage.png', 'images/ArtistePage/artiste_title_1758838344_JPEGMAFIATitle.png'),
(42, 'Danny Brown', 'Danny Brown est un rappeur américain reconnu pour son flow unique, ses productions avant-gardistes et son style audacieux. Ses albums mêlent énergie brute, expérimentation sonore et textes provocateurs, offrant une expérience intense et incontournable pour les amateurs de vinyles et de rap alternatif.', NULL, 'images/uploads/DannyBrown.PNG', 'images/ArtistePage/artiste_1758838547_DannyBrownPage.png', 'images/ArtistePage/artiste_title_1758838547_DannyBrownTitle.png'),
(43, 'Volbeat', 'Volbeat est un groupe danois formé en 2001, connu pour son mélange unique de heavy metal, rockabilly et hard rock. Leur son se distingue par des riffs puissants, une énergie entraînante et des refrains mélodiques. Avec leur style hybride, ils ont su séduire aussi bien les amateurs de metal que de rock plus accessible, devenant une référence sur la scène internationale.', NULL, 'images/uploads/Volbeat.jpg', 'images/ArtistePage/artiste_1758914406_VolbeatPage.png', 'images/ArtistePage/artiste_title_1758914406_VolbeatTitle.png'),
(44, 'Werenoi', 'Werenoi est un rappeur français originaire de Montreuil, qui s’impose comme l’une des figures montantes du rap hexagonal. Reconnu pour son mélange de mélodies planantes, d’écriture introspective et de flows percutants, il réussit à toucher un large public en naviguant entre sons mélancoliques et morceaux plus énergiques. Avec des projets marquants comme Carré ou Pyramide, il confirme son statut d’artiste incontournable de la nouvelle génération.', NULL, 'images/uploads/Werenoi.jpg', 'images/ArtistePage/artiste_1758915736_WerenoiPage.png', 'images/ArtistePage/artiste_title_1758915736_WerenoiTitle.png'),
(45, 'Damso', 'Damso, figure majeure du rap francophone, s’est imposé grâce à son écriture puissante et introspective. Entre récits personnels, réflexions sociales et poésie brute, il crée un univers sombre et profond où authenticité et innovation musicale se rencontrent. Ses albums, acclamés par la critique, font de lui un artiste incontournable.', NULL, 'images/uploads/Damso.jpg', 'images/ArtistePage/artiste_1758916494_DamsoPage.png', 'images/ArtistePage/artiste_title_1758916494_DamsoTitle.png'),
(47, 'Jane Remover', 'Jane Remover est une artiste avant-gardiste de la scène hyperpop et alternative. Entre sons électroniques chaotiques, émotions brutes et expérimentations audacieuses, elle brouille les frontières entre genres et propose une musique profondément personnelle, intense et novatrice', NULL, 'images/uploads/artiste_68da8fe7c083e_JaneRemover.jpg', 'images/ArtistePage/artistepage_68da8fe7c0fb7_JaneRemoverPage.png', 'images/ArtistePage/artistetitle_68da8fe7c15c7_JaneRemoverTitle.png'),
(48, 'Puzzle', 'Puzzle, projet solo de Fletcher Shears (The Garden), explore un univers indie et lo-fi singulier. Entre mélodies planantes, expérimentations sonores et introspections poétiques, il propose une musique intime et créative, oscillant entre douceur mélancolique et énergie brute.', NULL, 'images/uploads/artiste_68da976c977bb_Puzzle.jpg', 'images/ArtistePage/artistepage_68da976c97f15_PuzzlePage.png', 'images/ArtistePage/artistetitle_68da976c98356_PuzzleTitle.png'),
(49, 'PinkPantheress', 'PinkPantheress s’est imposée comme l’une des voix les plus originales de la pop moderne. Mélangeant mélodies douces, influences drum & bass et sonorités hyperpop, elle propose une musique intime et addictive, qui a rapidement conquis une génération grâce à son style unique et novateur.', NULL, 'images/uploads/artiste_68da9e160f421_PinkPantheress.jpg', 'images/ArtistePage/artistepage_68da9e160fdd0_PinkPantheressPage.png', 'images/ArtistePage/artistetitle_68da9e16105b9_PinkPantheressTitle.png'),
(51, 'Ptite Soeur', 'Ptite Sœur s’impose avec un style audacieux, mélangeant rap incisif, sonorités trap et touches indie. Ses textes percutants et sa voix singulière créent un univers authentique et brut, où énergie et sincérité se conjuguent pour captiver une nouvelle génération d’auditeurs.', NULL, 'images/uploads/artiste_68dbecb0563f7_PtiteSoeur.jpg', 'images/ArtistePage/artistepage_68dbecb056ca5_PtiteSoeurPage.png', 'images/ArtistePage/artistetitle_68dbecb057363_PtiteSoeurTitle.png'),
(52, 'Gemroz', 'Gemroz incarne une nouvelle voix du rap alternatif. Avec un flow singulier, des textes bruts et une esthétique sombre, il construit un univers authentique où intensité et émotion se rencontrent. Sa musique se distingue par son audace et sa capacité à repousser les frontières du genre.', NULL, 'images/uploads/artiste_68dbed4adf391_Gemroz.jpg', 'images/ArtistePage/artistepage_68dbed4adfbfe_GemrozPage.png', 'images/ArtistePage/artistetitle_68dbed4ae0133_GemrozTitle.png'),
(53, 'Kanye West', 'Kanye West est l’une des figures les plus influentes du rap et de la musique moderne. Visionnaire et provocateur, il mélange hip-hop, gospel, électro et rock pour créer des albums novateurs. Son génie artistique et sa capacité à redéfinir les codes font de lui un artiste incontournable.', NULL, 'images/uploads/artiste_68dbf4770ce53_KanyeWest.jpg', 'images/ArtistePage/artistepage_68dbf4770d8bb_KanyeWestPage.png', 'images/ArtistePage/artistetitle_68dbf4770de5b_KanyeWestTitle.png');

-- --------------------------------------------------------

--
-- Structure de la table `categorieproduit`
--

DROP TABLE IF EXISTS `categorieproduit`;
CREATE TABLE IF NOT EXISTS `categorieproduit` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorieproduit`
--

INSERT INTO `categorieproduit` (`id_categorie`, `nom_categorie`, `description`) VALUES
(1, 'Vinyle 33\"', 'Disque vinyle 33 tours'),
(2, 'Vinyle 45\"', 'Disque vinyle 45 tours'),
(4, 'CD', 'Disque CD'),
(5, 'Cassette', 'Cassette');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `date_commande` date DEFAULT NULL,
  `date_expedition` date DEFAULT NULL,
  `date_arrivee_prevue` date DEFAULT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `mode_paiement` varchar(10) DEFAULT NULL,
  `id_panier` int DEFAULT NULL,
  `id_user` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_adresse` int DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_panier` (`id_panier`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `date_commande`, `date_expedition`, `date_arrivee_prevue`, `statut`, `mode_paiement`, `id_panier`, `id_user`, `total`, `id_adresse`) VALUES
(7, '2025-09-29', NULL, NULL, 'Payée', 'CB', NULL, 7, 10.99, 3),
(8, '2025-09-29', NULL, NULL, 'Payée', 'CB', NULL, 7, 36.48, 3),
(13, '2025-10-01', NULL, NULL, 'Payée', 'CB', NULL, 8, 103.97, 6),
(12, '2025-09-30', NULL, NULL, 'Payée', 'CB', NULL, 7, 212.50, 4),
(11, '2025-09-29', NULL, NULL, 'Payée', 'CB', NULL, 7, 390.90, 4),
(14, '2025-10-01', NULL, NULL, 'Payée', 'CB', NULL, 8, 155.46, 6),
(15, '2025-10-01', NULL, NULL, 'Payée', 'CB', NULL, 7, 261.43, 4),
(16, '2025-10-03', NULL, NULL, 'Payée', 'CB', NULL, 7, 32.99, 4),
(17, '2025-10-03', NULL, NULL, 'Payée', 'CB', NULL, 7, 32.99, 4),
(18, '2025-10-03', NULL, NULL, 'Payée', 'CB', NULL, 7, 28.99, 4),
(19, '2025-10-03', NULL, NULL, 'Payée', 'CB', NULL, 7, 28.99, 3),
(20, '2025-10-07', NULL, NULL, 'Payée', 'CB', NULL, 7, 25.50, 3),
(21, '2025-11-10', NULL, NULL, 'Payée', 'CB', NULL, 7, 24.99, 3),
(22, '2025-11-10', NULL, NULL, 'Payée', 'CB', NULL, 7, 14.99, 4),
(23, '2025-11-10', '2025-11-12', '2025-11-15', 'Préparation', 'CB', NULL, 7, 10.99, 3),
(24, '2025-12-15', '2025-12-17', '2025-12-20', 'Préparation', 'CB', NULL, 7, 100.47, 3),
(25, '2026-05-03', '2026-05-05', '2026-05-08', 'Préparation', 'CB', NULL, 7, 63.47, 3);

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `id_commande` int NOT NULL,
  `id_produit` int NOT NULL,
  `quantite` int NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_commande`,`id_produit`),
  KEY `id_produit` (`id_produit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande_produit`
--

INSERT INTO `commande_produit` (`id_commande`, `id_produit`, `quantite`, `prix_unitaire`) VALUES
(7, 19, 1, 10.99),
(8, 19, 1, 10.99),
(8, 58, 1, 11.99),
(8, 69, 1, 13.50),
(14, 18, 1, 26.99),
(13, 76, 1, 37.99),
(13, 67, 1, 29.99),
(13, 33, 1, 35.99),
(12, 108, 1, 200.00),
(12, 102, 1, 12.50),
(11, 4, 1, 30.99),
(11, 12, 1, 29.99),
(11, 47, 1, 28.99),
(11, 52, 1, 35.99),
(11, 54, 1, 13.50),
(11, 64, 1, 34.99),
(11, 71, 1, 38.99),
(11, 73, 1, 65.50),
(11, 81, 1, 28.99),
(11, 91, 1, 24.99),
(11, 92, 1, 24.99),
(11, 94, 1, 32.99),
(14, 50, 1, 34.99),
(14, 70, 1, 34.50),
(14, 80, 1, 28.99),
(14, 82, 1, 29.99),
(15, 16, 1, 28.99),
(15, 20, 1, 39.99),
(15, 46, 1, 33.99),
(15, 47, 1, 28.99),
(15, 64, 1, 34.99),
(15, 66, 1, 29.99),
(15, 70, 1, 34.50),
(15, 90, 1, 29.99),
(16, 94, 1, 32.99),
(17, 94, 1, 32.99),
(18, 16, 1, 28.99),
(19, 47, 1, 28.99),
(20, 106, 1, 25.50),
(21, 28, 1, 24.99),
(22, 45, 1, 14.99),
(23, 19, 1, 10.99),
(24, 16, 1, 28.99),
(24, 55, 1, 11.50),
(24, 66, 2, 29.99),
(25, 19, 1, 10.99),
(25, 23, 1, 10.99),
(25, 55, 1, 11.50),
(25, 66, 1, 29.99);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(20) DEFAULT NULL,
  `desc_genre` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `nom_genre`, `desc_genre`) VALUES
(1, 'Rock', 'Rockkkkkkk'),
(2, 'DnB', 'Drum And Bass'),
(4, 'Reggae', ''),
(5, 'Folk', ''),
(6, 'Jazz', ''),
(7, 'Funk', ''),
(8, 'Classique', ''),
(9, 'Electro', ''),
(10, 'Dubstep', ''),
(11, 'House', ''),
(12, 'Hip-hop', ''),
(13, 'R&B', ''),
(14, 'Punk', ''),
(15, 'Metal', ''),
(16, 'Breakcore', ''),
(17, 'Alternative', ''),
(18, 'Experimental', ''),
(19, 'Hyperpop', ''),
(20, 'Jungle', ''),
(21, 'Rap', ''),
(22, 'Pop', ''),
(24, 'Trap', ''),
(25, 'Undergound', ''),
(26, 'Anime', ''),
(27, 'Film', ''),
(28, 'Grunge', ''),
(29, 'J-pop', ''),
(31, 'Soul', ''),
(32, 'Disco', ''),
(33, 'Breakbeat', ''),
(34, 'Old-school', ''),
(35, 'Hardcore', ''),
(36, 'Noise', ''),
(37, 'Hard rock', ''),
(38, 'Heavy Metal', ''),
(60, 'Lo-fi', ''),
(61, 'Ambient', ''),
(62, 'Indie', '');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int NOT NULL AUTO_INCREMENT,
  `date_creation` date DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `date_creation`, `id_user`) VALUES
(6, NULL, 7),
(7, NULL, 8),
(9, '2025-09-30', 10);

-- --------------------------------------------------------

--
-- Structure de la table `panier_produit`
--

DROP TABLE IF EXISTS `panier_produit`;
CREATE TABLE IF NOT EXISTS `panier_produit` (
  `id_panier` int NOT NULL,
  `id_produit` int NOT NULL,
  `quantite` int DEFAULT NULL,
  PRIMARY KEY (`id_panier`,`id_produit`),
  KEY `id_produit` (`id_produit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `prix_unitaire` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `img_disk_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nb_ventes` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `description`, `prix_unitaire`, `stock`, `img_path`, `img_disk_path`, `nb_ventes`) VALUES
(4, 'Hybrid Theory', 'Hybrid Theory est le premier album studio de Linkin Park, sorti en 2000, et considéré comme l’un des disques les plus marquants de la scène nu metal. Mélange explosif de rap, de rock alternatif et de sonorités électroniques, l’album a marqué toute une génération grâce à des titres devenus cultes comme In the End, Crawling ou encore Papercut. Avec son énergie brute et ses textes introspectifs traitant de la colère, de la peur et de l’isolement, Hybrid Theory s’est imposé comme un classique intemporel, vendant plus de 30 millions d’exemplaires dans le monde.', 30.99, 64, 'images/uploads/prod_68cb2436b44d4.jpg', 'images/uploads/HybridTheoryYellowDisk.png', 0),
(5, 'Toxicity', 'Test', 20.00, 87, 'images/uploads/Toxicity.jpg', '', 0),
(6, 'Kiss My Super Bowl Ring', 'Sorti en 2020, Kiss My Super Bowl Ring est le quatrième album du duo californien The Garden. Fidèles à leur univers Vada Vada, Wyatt et Fletcher Shears y mélangent punk abrasif, hip-hop, sons électroniques et expérimentations décalées. L’album est marqué par son énergie brute, ses ruptures imprévisibles et son humour provocateur. Avec des titres comme Clench to Stay Awake ou A Struggle, The Garden confirme son identité unique : un son à la fois chaotique, créatif et résolument alternatif.', 28.00, 14, 'images/uploads/KMSBR.jpg', 'images/uploads/KMSBRVinyl.png', 0),
(16, 'WLFGRL', 'Premier album marquant de Machine Girl, WLFGRL est une œuvre culte de la scène breakcore moderne. L’album regorge de rythmes frénétiques, de glitchs électroniques et d’une intensité brute qui brouille les frontières entre musique de club et punk électronique. Avec son style abrasif et radical, WLFGRL s’est imposé comme une référence underground incontournable.', 28.99, 43, 'images/uploads/WlfGrl.jpg', 'images/uploads/WLFGRLVinyl.png', 3),
(11, 'NO HANDS', 'Avec No Hands, Joey Valence & Brae confirment leur identité : un hip-hop survitaminé, rempli de beats dansants et de refrains accrocheurs. L’album mélange influences boom bap, électro et rap festif, parfait pour les amateurs de sons énergiques et décalés.', 15.00, 62, 'images/uploads/NOHANDS.jpg', '', 0),
(12, 'NO HANDS', 'Avec No Hands, Joey Valence & Brae confirment leur identité : un hip-hop survitaminé, rempli de beats dansants et de refrains accrocheurs. L’album mélange influences boom bap, électro et rap festif, parfait pour les amateurs de sons énergiques et décalés.', 29.99, 51, 'images/uploads/NOHANDS.jpg', 'images/uploads/NoHandsVinyl.png', 0),
(13, 'Around the Fur', 'Deuxième album du groupe, Around the Fur propulse Deftones sur le devant de la scène metal. Plus lourd et agressif que leur premier disque, il combine riffs puissants et ambiances sombres, tout en affirmant l’identité du groupe. Des titres comme My Own Summer (Shove It) et Be Quiet and Drive (Far Away) en font un classique incontournable du nu metal.', 31.90, 74, 'images/uploads/AroundTheFur.jpg', '', 0),
(14, 'Around the Fur', 'Deuxième album du groupe, Around the Fur propulse Deftones sur le devant de la scène metal. Plus lourd et agressif que leur premier disque, il combine riffs puissants et ambiances sombres, tout en affirmant l’identité du groupe. Des titres comme My Own Summer (Shove It) et Be Quiet and Drive (Far Away) en font un classique incontournable du nu metal.', 14.99, 23, 'images/uploads/AroundTheFur.jpg', '', 0),
(15, 'White Pony', 'Considéré comme leur chef-d’œuvre, White Pony élargit les horizons de Deftones avec des sonorités expérimentales, atmosphériques et mélancoliques. Plus varié que leurs albums précédents, il mêle lourdeur et douceur, avec des morceaux emblématiques comme Change (In the House of Flies) ou Digital Bath. Cet album a redéfini le metal alternatif et marqué toute une génération.', 15.99, 31, 'images/uploads/WhitePony.jpg', '', 0),
(17, 'WLFGRL', 'Premier album marquant de Machine Girl, WLFGRL est une œuvre culte de la scène breakcore moderne. L’album regorge de rythmes frénétiques, de glitchs électroniques et d’une intensité brute qui brouille les frontières entre musique de club et punk électronique. Avec son style abrasif et radical, WLFGRL s’est imposé comme une référence underground incontournable.', 13.00, 28, 'images/uploads/WlfGrl.jpg', '', 0),
(18, 'Diamant du Bled', 'Diamant du Bled est l’un des projets marquants de Zola. L’album reflète son identité artistique : une trap incisive, des instrumentales puissantes et des refrains accrocheurs. On y retrouve autant des morceaux introspectifs que des bangers taillés pour marquer la scène rap française contemporaine.', 26.99, 47, 'images/uploads/DiamantDuBled.jpg', 'images/uploads/DiamantDuBledVinyl.png', 0),
(19, 'Survie', 'Sorti en 2020, Survie est le deuxième album de Zola. Plus sombre et introspectif que son premier projet, l’album explore les thèmes de la réussite, de la rue et des épreuves personnelles. Avec ses sons trap percutants, ses refrains marquants et une écriture directe, Survie confirme Zola comme l’une des voix majeures du rap français moderne.', 10.99, 67, 'images/uploads/Survie.jpg', '', 2),
(20, 'Currents', 'Troisième album de Tame Impala, Currents marque un tournant artistique avec un son plus électronique et synthétique. Kevin Parker y explore les thèmes du changement et de la transformation, tout en gardant son esthétique psychédélique. Des titres comme Let It Happen ou The Less I Know the Better en ont fait un disque culte, salué par la critique et adoré par les fans.', 39.99, 102, 'images/uploads/Currents.jpg', '', 1),
(21, 'Currents', 'Troisième album de Tame Impala, Currents marque un tournant artistique avec un son plus électronique et synthétique. Kevin Parker y explore les thèmes du changement et de la transformation, tout en gardant son esthétique psychédélique. Des titres comme Let It Happen ou The Less I Know the Better en ont fait un disque culte, salué par la critique et adoré par les fans.', 15.99, 79, 'images/uploads/Currents.jpg', '', 0),
(22, 'haha', 'Deuxième album du duo californien The Garden, Haha illustre parfaitement leur approche musicale baptisée Vada Vada, mélange libre de punk, électro, hip-hop et sons expérimentaux. L’album est marqué par son côté brut, imprévisible et plein d’humour décalé, fidèle à l’identité singulière des jumeaux Shears.', 21.99, 13, 'images/uploads/haha.jpg', '', 0),
(23, 'haha', 'Deuxième album du duo californien The Garden, Haha illustre parfaitement leur approche musicale baptisée Vada Vada, mélange libre de punk, électro, hip-hop et sons expérimentaux. L’album est marqué par son côté brut, imprévisible et plein d’humour décalé, fidèle à l’identité singulière des jumeaux Shears.', 10.99, 16, 'images/uploads/haha.jpg', '', 1),
(24, 'Flower Boy', 'Avec Flower Boy, Tyler dévoile une facette plus intime et mélodique. L’album mélange rap, soul et jazz, et aborde des thèmes comme l’amour, l’identité et la solitude. Acclamé par la critique, il marque une étape clé dans sa carrière artistique.', 29.99, 125, 'images/uploads/FlowerBoy.jpg', 'images/uploads/FlowerBoyVinyl.png', 0),
(25, 'Flower Boy', 'Avec Flower Boy, Tyler dévoile une facette plus intime et mélodique. L’album mélange rap, soul et jazz, et aborde des thèmes comme l’amour, l’identité et la solitude. Acclamé par la critique, il marque une étape clé dans sa carrière artistique.', 15.00, 32, 'images/uploads/FlowerBoy.jpg', '', 0),
(26, 'Call Me If You Get Lost', 'Avec Call Me If You Get Lost, Tyler revient à un rap plus affirmé tout en gardant ses influences variées. Entre morceaux introspectifs et bangers explosifs, l’album montre toute l’étendue de son talent de rappeur et producteur.', 29.99, 87, 'images/uploads/Call-Me-If-You-Get-Lost.jpg', '', 0),
(27, 'Call Me If You Get Lost', 'Avec Call Me If You Get Lost, Tyler revient à un rap plus affirmé tout en gardant ses influences variées. Entre morceaux introspectifs et bangers explosifs, l’album montre toute l’étendue de son talent de rappeur et producteur.', 12.00, 35, 'images/uploads/Call-Me-If-You-Get-Lost.jpg', 'images/uploads/CMIYGLDisk.png', 0),
(28, 'IGOR', 'Projet audacieux, IGOR brouille les frontières entre rap, R&B et électro. Construit comme une histoire d’amour moderne, l’album se distingue par ses productions riches en synthés et ses émotions brutes. Récompensé par un Grammy Award, c’est l’un de ses albums les plus emblématiques.', 24.99, 45, 'images/uploads/IGOR.jpg', '', 1),
(29, 'Debut', 'Premier album solo international de Björk, Debut propose un mélange innovant de pop, house, jazz et électronique. Porté par des titres comme Human Behaviour et Venus as a Boy, l’album révèle une artiste singulière, déjà tournée vers l’expérimentation et les émotions intenses.', 17.00, 86, 'images/uploads/Debut.jpg', '', 0),
(30, 'Post', 'Avec Post, Björk affirme encore plus sa créativité. L’album explore des univers variés, du trip-hop à l’industriel en passant par l’électro-pop. Des morceaux comme Army of Me ou Hyperballad illustrent son approche novatrice et avant-gardiste, faisant de Post un classique des années 90.', 29.99, 34, 'images/uploads/Post.jpg', '', 0),
(31, 'Post', 'Avec Post, Björk affirme encore plus sa créativité. L’album explore des univers variés, du trip-hop à l’industriel en passant par l’électro-pop. Des morceaux comme Army of Me ou Hyperballad illustrent son approche novatrice et avant-gardiste, faisant de Post un classique des années 90.', 12.99, 39, 'images/uploads/Post.jpg', 'images/uploads/PostCD.png', 0),
(32, 'Imaginal Disk', 'Avec Imaginal Disk, le duo américain Magdalena Bay poursuit son exploration de la pop futuriste et électronique. L’album combine mélodies accrocheuses, synthés rétro-futuristes et expérimentations sonores qui plongent l’auditeur dans un univers à la fois onirique et dansant. Fidèles à leur esthétique visuelle et conceptuelle unique, Mica Tenenbaum et Matthew Lewin livrent un projet ambitieux qui confirme leur place dans la nouvelle scène pop alternative.', 16.99, 83, 'images/uploads/ImaginalDisk.jpg', '', 0),
(33, 'Good Kid, M.A.A.D City', 'Considéré comme son premier grand succès, GKMC est un album concept retraçant l’adolescence de Kendrick à Compton. Entre récits personnels et critique sociale, il mêle productions modernes et storytelling marquant. Des titres comme Swimming Pools (Drank) ou Bitch, Don’t Kill My Vibe en font un classique.', 35.99, 56, 'images/uploads/GKMC.jpg', '', 0),
(34, 'Good Kid, M.A.A.D City', 'Considéré comme son premier grand succès, GKMC est un album concept retraçant l’adolescence de Kendrick à Compton. Entre récits personnels et critique sociale, il mêle productions modernes et storytelling marquant. Des titres comme Swimming Pools (Drank) ou Bitch, Don’t Kill My Vibe en font un classique.', 15.99, 45, 'images/uploads/GKMC.jpg', '', 0),
(35, 'To Pimp a Butterfly', 'Chef-d’œuvre engagé, To Pimp a Butterfly mélange hip-hop, jazz, funk et soul. Kendrick y aborde le racisme, l’identité noire et la politique américaine à travers un projet dense et ambitieux. L’album est considéré comme l’un des plus importants du rap moderne.', 30.00, 31, 'images/uploads/TPAB.jpg', '', 0),
(36, 'DAMN', 'Avec DAMN., Kendrick propose un album plus direct et accessible, mais toujours riche en thèmes profonds : foi, violence, société et introspection. Porté par des hits comme HUMBLE. et DNA., il lui vaut le prix Pulitzer de la musique, une première dans l’histoire du rap.', 28.99, 118, 'images/uploads/DAMN.jpg', '', 0),
(37, 'MM..FOOD', 'Album solo conceptuel autour de la nourriture, MM..FOOD illustre l’inventivité de DOOM. Avec des beats originaux, des samples inattendus et un humour décalé, il livre un projet culte où l’expérimental rencontre le pur plaisir du rap.', 30.00, 47, 'images/uploads/MMFood.jpg', 'images/uploads/MMFoodDisk.png', 0),
(38, 'MM..FOOD', 'Album solo conceptuel autour de la nourriture, MM..FOOD illustre l’inventivité de DOOM. Avec des beats originaux, des samples inattendus et un humour décalé, il livre un projet culte où l’expérimental rencontre le pur plaisir du rap.', 15.00, 42, 'images/uploads/MMFood.jpg', '', 0),
(39, 'Madvillainy', 'Fruit de sa collaboration avec le producteur Madlib sous le nom de Madvillain, cet album est considéré comme un pilier du rap alternatif. Madvillainy propose des instrumentaux avant-gardistes et des flows ciselés, devenant une œuvre de référence dans l’histoire du hip-hop.', 22.00, 26, 'images/uploads/Madvillain.jpg', '', 0),
(40, 'Die Lit', 'Premier album studio de Playboi Carti, Die Lit est marqué par son énergie brute et ses productions aériennes signées notamment par Pi’erre Bourne. Avec des morceaux comme Shoota ou R.I.P., il a défini une nouvelle esthétique du trap, hypnotique et avant-gardiste.', 17.00, 31, 'images/uploads/DieLit.jpg', '', 0),
(41, 'Nevermind', 'Deuxième album de Nirvana, Nevermind est l’œuvre qui a propulsé le grunge sur la scène mondiale. Porté par le tube Smells Like Teen Spirit, l’album mélange riffs puissants, mélodies accrocheuses et une énergie rageuse. Véritable icône des années 90, il a marqué l’histoire du rock.', 20.00, 89, 'images/uploads/Nevermind.jpg', '', 0),
(42, 'Nevermind', 'Deuxième album de Nirvana, Nevermind est l’œuvre qui a propulsé le grunge sur la scène mondiale. Porté par le tube Smells Like Teen Spirit, l’album mélange riffs puissants, mélodies accrocheuses et une énergie rageuse. Véritable icône des années 90, il a marqué l’histoire du rock.', 12.00, 47, 'images/uploads/Nevermind.jpg', '', 0),
(43, 'In Utero', 'Dernier album studio du groupe, In Utero est plus brut et sombre que son prédécesseur. Produit par Steve Albini, il explore des thèmes douloureux avec une intensité crue, à travers des morceaux comme Heart-Shaped Box ou All Apologies. Un disque culte et testamentaire.', 34.99, 34, 'images/uploads/IN UTERO.jpg', '', 0),
(44, 'In Utero', 'Dernier album studio du groupe, In Utero est plus brut et sombre que son prédécesseur. Produit par Steve Albini, il explore des thèmes douloureux avec une intensité crue, à travers des morceaux comme Heart-Shaped Box ou All Apologies. Un disque culte et testamentaire.', 14.99, 24, 'images/uploads/IN UTERO.jpg', '', 0),
(45, 'Cynthoni Part 1', 'Premier projet de l’artiste, Cynthoni Part 1 pose les bases de son univers. Mélange de sons électroniques, de flows incisifs et de productions atmosphériques, il dévoile une identité forte et en pleine construction.', 14.99, 21, 'images/uploads/CynthoniPart1.jpg', '', 1),
(46, 'Cynthoni Part 1 + 2', 'Premier projet de l’artiste, Cynthoni Part 1 pose les bases de son univers. Mélange de sons électroniques, de flows incisifs et de productions atmosphériques, il dévoile une identité forte et en pleine construction.\r\nAvec Cynthoni Part 2, l’artiste poursuit son exploration musicale en poussant plus loin les expérimentations électroniques et les ambiances sombres.', 33.99, 18, 'images/uploads/CynthoniVinyl.jpg', 'images/uploads/CynthoniDisk1.png', 1),
(47, 'Evangelion Finally', 'Evangelion: Finally est une compilation regroupant les chansons les plus emblématiques liées à la saga. On y retrouve des interprétations de Megumi Hayashibara (voix de Rei Ayanami), des versions alternatives de morceaux cultes et des titres rares. Une sélection incontournable pour les amateurs de l’univers Evangelion.', 28.99, 21, 'images/uploads/TheEndOfEvangelion.jpeg', 'images/uploads/EvangelionPinkDisk.png', 2),
(49, 'Take Me To Your Leader', 'Sous l’alias King Geedorah, inspiré du monstre de l’univers Godzilla, MF DOOM livre un album concept unique. Take Me To Your Leader mêle samples cinématographiques, beats sombres et invités variés pour créer une atmosphère quasi cinématographique. Moins centré sur son propre flow, DOOM met en avant son rôle de producteur, offrant un projet culte et avant-gardiste dans l’underground rap.', 32.99, 17, 'images/uploads/TakeMeToYourLeader.jpg', 'images/uploads/disk_1758636456_TMTYLVinyl.png', 0),
(50, 'One Last Kiss', 'One Last Kiss est un EP de la chanteuse japonaise Hikaru Utada, sorti à l’occasion du film Evangelion: 3.0+1.0 Thrice Upon a Time. Il rassemble des titres marquants de la saga Rebuild of Evangelion, dont la chanson éponyme et les précédents thèmes (Beautiful World, Sakura Nagashi). Entre J-pop, électro-pop et ballades émouvantes, c’est un disque intimement lié à l’univers Evangelion et à ses fans.', 34.99, 45, 'images/uploads/OneLastKiss.jpg', 'images/uploads/disk_1758637643_OneLastKissVinyl.png', 0),
(52, 'High Times', '', 35.99, 31, 'images/uploads/HighTimes.jpg', 'images/uploads/disk_1758638664_HighTimesVinyl.png', 0),
(54, 'Sincèrement', 'Sincèrement, c’est l’expression pure de l’âme et des émotions humaines. Chaque texte, chaque note, dévoile une vérité intime et authentique, créant un lien profond avec l’auditeur. Une invitation à ressentir, réfléchir et partager des sentiments universels avec intensité et finesse.', 13.50, 52, 'images/uploads/Sincerement.jpg', NULL, 0),
(55, 'Paradise', 'Paradise, c’est un univers musical où l’évasion rencontre la puissance des sensations. Entre rythmes captivants et atmosphères hypnotiques, chaque morceau transporte l’auditeur dans un voyage intense et vibrant, un monde où émotion et énergie s’entrelacent pour créer une expérience inoubliable.', 11.50, 31, 'images/uploads/Paradise.jpg', NULL, 2),
(56, 'Platinum', 'Platinum, c’est un univers musical où l’émotion et la sensualité se rencontrent. Entre rythmes suaves et refrains accrocheurs, chaque morceau devient un voyage immersif, explorant amour, désir et rêves avec authenticité et sophistication.', 24.50, 38, 'images/uploads/Platinum.jpg', NULL, 0),
(57, 'Chambre 140', 'Chambre 140, c’est la rencontre entre créativité et introspection. Ses morceaux, mêlant beats puissants et ambiances planantes, transportent l’auditeur dans un monde intime et captivant, où chaque note raconte une histoire et chaque texte laisse une empreinte profonde.', 29.50, 35, 'images/uploads/Chambre140.jpg', NULL, 0),
(58, '2069', '2069, projet audacieux et futuriste, repousse les limites du son urbain. Entre rythmes électro, trap et mélodies avant-gardistes, chaque titre plonge l’auditeur dans un univers novateur et immersif, où énergie et innovation se conjuguent pour créer une expérience unique.', 15.00, 52, 'images/uploads/2069.jpg', NULL, 0),
(59, 'Il Le Fallait', 'Il Le Fallait explore les émotions avec sincérité et sensibilité. Entre rythmes doux et refrains accrocheurs, chaque morceau dévoile des sentiments intimes et universels, offrant une expérience musicale à la fois émotive, authentique et inoubliable.', 16.99, 47, 'images/uploads/IlLeFallait.jpg', NULL, 0),
(60, 'The Black Album', 'Sorti en 1991, The Black Album propulse Metallica au rang de phénomène mondial. Avec des titres cultes comme “Enter Sandman” et un son plus accessible, l’album incarne la puissance du metal grand public, devenant l’un des disques les plus vendus de l’histoire du genre.', 37.99, 87, 'images/uploads/BlackAlbum.jpg', 'images/uploads/disk_1758748830_TheBlackAlbumVinyl.png', 0),
(61, 'The Black Album', 'Sorti en 1991, The Black Album propulse Metallica au rang de phénomène mondial. Avec des titres cultes comme “Enter Sandman” et un son plus accessible, l’album incarne la puissance du metal grand public, devenant l’un des disques les plus vendus de l’histoire du genre.', 13.99, 42, 'images/uploads/BlackAlbum.jpg', NULL, 0),
(62, 'Kill \'Em All', 'Premier album de Metallica sorti en 1983, Kill ’Em All pose les bases du thrash metal. Brut, rapide et sans concession, il révolutionne la scène métal de l’époque avec ses riffs tranchants et son énergie explosive, ouvrant la voie à une nouvelle génération de groupes.', 32.00, 42, 'images/uploads/KillEmAll.jpg', 'images/uploads/disk_1758749159_KillEmAllVinyl.png', 0),
(63, 'Master of Puppets', '', 29.99, 57, 'images/uploads/MasterOfPuppets.jpg', 'images/uploads/disk_1758749459_MOPVinyl.png', 0),
(64, 'Chaser', 'Chaser s’impose comme une voix montante du rap moderne, fusionnant flows incisifs et instrumentales sombres. Ses morceaux oscillent entre énergie percutante et introspection, créant un univers authentique et puissant qui captive autant par la force de ses textes que par son identité sonore unique.', 34.99, 83, 'images/uploads/Chaser.jpg', 'images/uploads/disk_1758831696_ChaserVinyl.png', 1),
(65, 'Chaser', 'Chaser s’impose comme une voix montante du rap moderne, fusionnant flows incisifs et instrumentales sombres. Ses morceaux oscillent entre énergie percutante et introspection, créant un univers authentique et puissant qui captive autant par la force de ses textes que par son identité sonore unique.', 15.50, 43, 'images/uploads/Chaser2.PNG', 'images/uploads/disk_1758832078_ChaserCD.png', 0),
(66, 'Survie', 'Sorti en 2020, Survie est le deuxième album de Zola. Plus sombre et introspectif que son premier projet, l’album explore les thèmes de la réussite, de la rue et des épreuves personnelles. Avec ses sons trap percutants, ses refrains marquants et une écriture directe, Survie confirme Zola comme l’une des voix majeures du rap français moderne.', 29.99, 41, 'images/uploads/Survie.jpg', 'images/uploads/disk_1758836664_SurvieVinyl.png', 4),
(67, 'Cicatrices', '“Cicatrice” propose un univers sonore captivant avec des productions travaillées et un flow percutant. Chaque morceau combine émotion et rythme, offrant une expérience immersive pour les fans de rap français et les passionnés de vinyles à la recherche d’albums marquants.', 29.99, 31, 'images/uploads/Cicatrices.jpg', 'images/uploads/disk_1758836867_CicatricesVinyl.png', 0),
(68, 'Meteora', 'Meteora de Linkin Park allie riffs puissants, beats électrisants et mélodies mémorables. Chaque morceau mêle énergie brute et émotions intenses, offrant une expérience sonore unique qui a fait de cet album un classique incontournable pour les amateurs de vinyles et de rock moderne.', 28.99, 37, 'images/uploads/Meteora.jpg', 'images/uploads/disk_1758837430_MeteoraVinyl.png', 0),
(69, 'Meteora', 'Meteora de Linkin Park allie riffs puissants, beats électrisants et mélodies mémorables. Chaque morceau mêle énergie brute et émotions intenses, offrant une expérience sonore unique qui a fait de cet album un classique incontournable pour les amateurs de vinyles et de rock moderne.', 13.50, 31, 'images/uploads/Meteora.jpg', NULL, 0),
(70, 'I LAY DOWN MY LIFE FOR YOU', 'Cet album de JPEGMAFIA mêle beats glitchés, samples surprenants et flow incisif. Chaque morceau explore l’audace sonore et la créativité du rap alternatif, offrant une expérience intense et unique pour les amateurs de vinyles et de musique avant-gardiste.', 34.50, 25, 'images/uploads/ILDMLFY.jpg', 'images/uploads/disk_1758838805_ILDMLFYVinyl.png', 1),
(71, 'SCARING THE HOES', '“Scaring the Hoes” de JPEGMAFIA propose un univers sonore audacieux et percutant. Entre beats déstructurés, samples surprenants et flow incisif, chaque morceau repousse les limites du rap alternatif et offre une expérience sonore imprévisible et captivante.', 38.99, 31, 'images/uploads/ScaringTheHoes.jpg', 'images/uploads/disk_1758839131_ScaringTheHoesVinyl.png', 0),
(72, 'OFFLINE!', 'Avec “OFFLINE!”, JPEGMAFIA mélange énergie brute et expérimentation sonore. Les productions explosives et les textes incisifs créent un album intense, original et provocateur, incarnant parfaitement l’avant-garde du hip-hop contemporain.', 31.00, 12, 'images/uploads/OFFLINE.jpg', 'images/uploads/disk_1758839294_OFFLINEVinyl.png', 0),
(73, 'Atrocity Exhibition', '\"Atrocity Exhibition” de Danny Brown est un album audacieux et expérimental, mêlant beats déstructurés, samples innovants et flow unique. Chaque morceau explore des thèmes sombres et provocateurs, offrant une expérience sonore intense et avant-gardiste qui redéfinit les limites du rap contemporain.', 65.50, 8, 'images/uploads/AtrocityExhibition.jpg', 'images/uploads/disk_1758839658_AtrocityExhibitionVinyl.png', 0),
(74, 'Hyperyouth', 'Avec Hyperyouth, le duo Joey Valence & Brae poursuit son mélange explosif de rap old-school, électro et breakbeat. L’album déborde d’énergie, rappelant l’âge d’or du hip-hop des années 90 tout en y ajoutant une touche moderne et humoristique. Chaque morceau est conçu pour faire bouger, avec des flows rapides et des productions percutantes.', 29.99, 32, 'images/uploads/Hyperyouth.png', NULL, 0),
(75, 'Hyperyouth', 'Avec Hyperyouth, le duo Joey Valence & Brae poursuit son mélange explosif de rap old-school, électro et breakbeat. L’album déborde d’énergie, rappelant l’âge d’or du hip-hop des années 90 tout en y ajoutant une touche moderne et humoristique. Chaque morceau est conçu pour faire bouger, avec des flows rapides et des productions percutantes.', 15.50, 41, 'images/uploads/Hyperyouth.png', NULL, 0),
(76, 'I AM MUSIC', 'Projet plus récent, I AM MUSIC poursuit l’évolution sonore de Carti. Entre sons futuristes, trap agressif et influences électroniques, l’album confirme son statut d’innovateur dans la scène rap, brouillant encore les frontières entre rap et expérimental.', 37.99, 64, 'images/uploads/IAMMUSIC.jpg', 'images/uploads/disk_1758877781_IAMMUSICVinyl.png', 0),
(77, 'I AM MUSIC', 'Projet plus récent, I AM MUSIC poursuit l’évolution sonore de Carti. Entre sons futuristes, trap agressif et influences électroniques, l’album confirme son statut d’innovateur dans la scène rap, brouillant encore les frontières entre rap et expérimental.', 16.50, 67, 'images/uploads/IAMMUSIC.jpg', NULL, 0),
(78, 'Whole Lotta Red', 'Deuxième album studio, Whole Lotta Red divise par son approche radicale : sons bruts, énergie punk et atmosphère chaotique. Avec des morceaux comme Stop Breathing et Sky, il s’impose comme un projet culte auprès des fans.', 28.99, 42, 'images/uploads/WholeLottaRed.jpg', NULL, 0),
(79, 'Playboi Carti (Mixtape)', 'Première mixtape officielle de Carti, elle contient des hits comme Magnolia et wokeuplikethis qui l’ont propulsé sur le devant de la scène. Mélange de beats hypnotiques et d’un flow minimaliste, elle définit l’identité sonore de l’artiste.', 32.99, 21, 'images/uploads/Playboi Carti.jpg', NULL, 0),
(80, 'MG Ultra', 'Avec MG Ultra, Machine Girl repousse encore les limites de son univers sonore radical. L’album fusionne breakcore, digital hardcore, noise et rap hurlé dans un déferlement d’énergie brutale. C’est une expérience sonore chaotique, à la fois violente, libératrice et intensément cathartique, qui confirme la place du projet comme l’un des plus extrêmes et novateurs de la scène électronique underground.', 28.99, 38, 'images/uploads/MGUltra.jpg', 'images/uploads/disk_1758879009_MGUltraPurpleVinyl.png', 0),
(81, 'MG Ultra', 'Avec MG Ultra, Machine Girl repousse encore les limites de son univers sonore radical. L’album fusionne breakcore, digital hardcore, noise et rap hurlé dans un déferlement d’énergie brutale. C’est une expérience sonore chaotique, à la fois violente, libératrice et intensément cathartique, qui confirme la place du projet comme l’un des plus extrêmes et novateurs de la scène électronique underground.', 28.99, 22, 'images/uploads/MGUltra.jpg', 'images/uploads/disk_1758879071_MGUltraGreenVinyl.png', 0),
(82, 'God of Angels Trust', 'Neuvième album de Volbeat, God of Angels Trust (2025) marque un retour plus brut et spontané du groupe danois. Porté par des riffs puissants, des refrains accrocheurs et une ambiance plus sombre, le disque illustre leur mélange unique de hard rock et heavy metal.', 29.99, 31, 'images/uploads/GodOfAngelsTrust.jpg', 'images/uploads/disk_1758914959_GodOfAngelsTrustVinyl.png', 0),
(83, 'Servant of the Mind', 'Servant of the Mind est le huitième album studio de Volbeat, sorti en 2021. Plus sombre et massif que ses prédécesseurs, l’album mêle heavy metal, rock’n’roll et atmosphères presque doom. On y retrouve des titres comme Shotgun Blues, Wait a Minute My Girl et Temple of Ekur, qui illustrent la capacité du groupe à combiner riffs puissants et refrains accrocheurs.', 32.99, 58, 'images/uploads/ServantMind.jpg', NULL, 0),
(84, 'Seal the Deal & Let\'s Boogie', 'Sixième album studio de Volbeat, Seal the Deal & Let’s Boogie (2016) confirme leur mélange unique de heavy metal, rockabilly et hard rock. Avec des hymnes comme The Devil’s Bleeding Crown ou Seal the Deal, l’album combine riffs énergiques, refrains accrocheurs et une énergie taillée pour le live.', 27.99, 63, 'images/uploads/SealTheDeal.jpg', NULL, 0),
(85, 'Diamant Noir', 'Premier projet de Werenoi, Diamant Noir dévoile un univers sombre et mélodique. Entre trap aérienne, refrains marquants et textes introspectifs, l’album pose les bases de son style et l’impose comme une nouvelle voix du rap français.', 27.99, 27, 'images/uploads/DiamantNoir.jpg', NULL, 0),
(86, 'Diamant Noir', 'Premier projet de Werenoi, Diamant Noir dévoile un univers sombre et mélodique. Entre trap aérienne, refrains marquants et textes introspectifs, l’album pose les bases de son style et l’impose comme une nouvelle voix du rap français.', 13.99, 56, 'images/uploads/DiamantNoir.jpg', NULL, 0),
(87, 'Carré', 'Avec Carré, Werenoi franchit un cap et affirme son identité artistique. L’album mélange mélodies planantes, rythmiques trap et storytelling personnel, consolidant sa place parmi les rappeurs les plus prometteurs de sa génération.', 9.99, 56, 'images/uploads/Carre.jpg', NULL, 0),
(89, 'Revengeseekerz', 'Revengeseekerz incarne l’énergie brute de l’underground. Avec un mélange de breakcore frénétique, de rythmes drum & bass et de textures abrasives, ses morceaux transportent dans un univers chaotique et explosif, où intensité et liberté artistique dominent.', 34.99, 74, 'images/uploads/prod_68da90d039750_Revengeseekerz.jpg', NULL, 0),
(90, 'Census Designated', 'Census Designated se distingue par un son indie mélancolique, oscillant entre rock alternatif et touches emo. Le projet explore les émotions profondes avec des textes intimes et des ambiances immersives, offrant une expérience musicale sincère, vibrante et pleine de sensibilité.', 29.99, 41, 'images/uploads/prod_68da91b0f0586_CensusDesignated.jpg', 'images/uploads/disk_68da91b0f0dd6_CensusDesignatedVinyl.png', 1),
(91, 'Tighten the Reins', 'Avec Tighten the Reins, Puzzle affirme sa singularité. L’album mêle rock alternatif et expérimentations sonores, tissant des ambiances à la fois étranges et captivantes. Chaque morceau traduit un univers personnel où liberté créative et intensité émotionnelle s’entrecroisent.', 24.99, 37, 'images/uploads/prod_68da99d156094_TightenTheReins.jpg', 'images/uploads/disk_68da99d15719b_TightenTheReinsVinyl.png', 0),
(92, 'X Hail', 'X Hail plonge dans une atmosphère planante et hypnotique. Puzzle y déploie des sonorités lo-fi et psychédéliques, explorant la fragilité des émotions et la beauté du minimalisme. Un projet intime et expérimental qui révèle une facette profondément artistique de Fletcher Shears.', 24.99, 42, 'images/uploads/prod_68da9adb062c0_XHail.jpg', 'images/uploads/disk_68da9adb06a19_XHailVinyl.png', 0),
(93, 'Laying in the Sand', 'Laying in the Sand invite à une évasion rêveuse. Entre textures ambient, accents dream pop et poésie sonore, Puzzle y construit un espace flottant, presque méditatif, où la simplicité et l’expérimentation s’allient pour offrir une expérience musicale apaisante et immersive.', 24.99, 21, 'images/uploads/prod_68da9b90b4493_LayingInTheSand.jpg', NULL, 0),
(94, 'Fancy That', 'Avec Fancy That, PinkPantheress explore un univers encore plus expérimental. Entre textures électroniques subtiles, rythmes surprenants et voix éthérée, ce projet illustre son audace artistique et son talent à créer des atmosphères fraîches, émotionnelles et résolument modernes.', 32.99, 31, 'images/uploads/prod_68da9f056e30e_FancyThat.png', 'images/uploads/disk_68da9f056ebe7_FancyThatVinyl.png', 2),
(95, 'To Hell With It', 'Premier projet marquant de PinkPantheress, To Hell With It dévoile son identité musicale singulière. Entre mélodies courtes et percutantes, influences 2000s et production minimaliste, l’album a su séduire un large public et confirmer son statut de révélation incontournable.', 28.50, 39, 'images/uploads/prod_68da9f8ecd8d8_ToHellWithIt.jpg', NULL, 0),
(96, 'To Hell With It', 'Premier projet marquant de PinkPantheress, To Hell With It dévoile son identité musicale singulière. Entre mélodies courtes et percutantes, influences 2000s et production minimaliste, l’album a su séduire un large public et confirmer son statut de révélation incontournable.', 13.99, 28, 'images/uploads/prod_68da9fb733cbf_ToHellWithIt.jpg', NULL, 0),
(97, 'Heaven Knows', 'Avec Heaven Knows, PinkPantheress franchit une nouvelle étape dans sa carrière. Le projet mêle pop moderne, UK garage et expérimentations sonores pour offrir une œuvre à la fois intime et ambitieuse, qui révèle toute la profondeur et la maturité de son univers artistique.', 14.50, 26, 'images/uploads/prod_68daa065b9f3e_HeavenKnows.jpg', NULL, 0),
(98, 'Heaven Knows', 'Avec Heaven Knows, PinkPantheress franchit une nouvelle étape dans sa carrière. Le projet mêle pop moderne, UK garage et expérimentations sonores pour offrir une œuvre à la fois intime et ambitieuse, qui révèle toute la profondeur et la maturité de son univers artistique.', 32.00, 63, 'images/uploads/prod_68daa144dc388_HeavenKnows.jpg', 'images/uploads/disk_68daa144dca5e_HeavenKnowsVinyl.png', 0),
(99, 'Nouvelle Economie', 'Avec Nouvelle Économie, l’artiste délivre une critique lucide de la société moderne. Entre beats électroniques futuristes, flows incisifs et ambiances sombres, ce projet propose un regard acéré sur le monde contemporain, tout en repoussant les codes traditionnels du rap.', 12.50, 19, 'images/uploads/prod_68dbece366d6b_NouvelleEconomie.jpg', NULL, 0),
(100, 'CUT4ZALGO', 'Cut4Zalgo incarne l’excès et le chaos sonore. À travers un mélange brutal de breakcore, de digital hardcore et de textures abrasives, ce projet pousse l’auditeur dans une immersion violente et libératrice, où l’énergie extrême devient un véritable manifeste artistique underground.', 11.99, 25, 'images/uploads/prod_68dbed1f63331_Cut4Zalgo.jpg', NULL, 0),
(101, 'Kayfabe Chimera', 'Kayfabe Chimera explore les limites du son avec une approche radicale. Entre rap alternatif, expérimentations bruitistes et atmosphères sombres, le projet brouille les frontières musicales et propose une expérience intense, dérangeante et profondément novatrice.', 14.99, 31, 'images/uploads/prod_68dbed7e62fad_KayfabeChimera.jpg', NULL, 0),
(102, 'Canal Fantome', 'Canal Fantôme propose une plongée dans un univers sonore immersif et mystérieux. Entre textures ambient, rythmes électroniques et atmosphères cinématographiques, le projet crée une expérience sensorielle unique, à la fois hypnotique et introspective, qui transporte l’auditeur hors du temps.', 12.50, 53, 'images/uploads/prod_68dbedb3ccec0_CanalFantome.png', NULL, 0),
(103, 'The Life of Pablo', 'Sorti en 2016, The Life of Pablo illustre l’éclectisme de Kanye West. Entre gospel envoûtant, rap incisif et productions expérimentales, l’album reflète ses contradictions artistiques et personnelles, offrant une œuvre chaotique et visionnaire, marquée par son audace créative.', 84.50, 61, 'images/uploads/prod_68dbf4c98338a_TLOP.jpg', 'images/uploads/disk_68dbf4c983b14_TLOPVinyl.png', 0),
(104, 'My Beautiful Dark Twisted Fantasy', 'Avec MBDTF (2010), Kanye signe un chef-d’œuvre unanimement salué. Mélangeant rap, orchestrations grandioses et textes introspectifs, l’album explore ses excès, ses doutes et son génie. Une œuvre monumentale, considérée comme l’un des meilleurs albums de l’histoire du rap', 45.00, 89, 'images/uploads/prod_68dbf519ec0c9_MBDTF.jpg', NULL, 0),
(105, 'Yeezus', 'Radical et abrasif, Yeezus (2013) choque par sa brutalité sonore. Kanye y fusionne rap, musique industrielle et électronique pour un résultat brut et minimaliste. Un projet avant-gardiste qui divise, mais qui marque l’histoire par son audace et sa volonté de repousser les limites.', 20.00, 56, 'images/uploads/prod_68dbf579c7480_Yeezus.jpg', NULL, 0),
(106, 'Bully', 'Avec Bully, Kanye West explore un univers sombre et agressif. Entre beats trap percutants, flows bruts et expérimentations sonores, ce projet met en avant une facette plus violente et sans concession de son art, confirmant son statut d’innovateur imprévisible.', 25.50, 23, 'images/uploads/prod_68dbf748af1f9_Bully.jpg', 'images/uploads/disk_68dbf748af8e9_BullyVinyl.png', 1),
(107, 'Graduation', 'Avec Graduation (2007), Kanye West signe un album visionnaire qui propulse le rap vers des sonorités plus électroniques et pop. Porté par des titres emblématiques comme “Stronger”, le projet incarne sa volonté de repousser les frontières du hip-hop et de séduire un public mondial. Une œuvre moderne et marquante de sa carrière.', 40.00, 71, 'images/uploads/prod_68dbf878d5264_Graduation.jpg', 'images/uploads/disk_68dbf878d5e55_GraduationVinyl.png', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit_artiste`
--

DROP TABLE IF EXISTS `produit_artiste`;
CREATE TABLE IF NOT EXISTS `produit_artiste` (
  `id_produit` int NOT NULL,
  `id_artiste` int NOT NULL,
  PRIMARY KEY (`id_produit`,`id_artiste`),
  KEY `id_artiste` (`id_artiste`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit_artiste`
--

INSERT INTO `produit_artiste` (`id_produit`, `id_artiste`) VALUES
(4, 12),
(5, 13),
(6, 14),
(7, 12),
(8, 13),
(9, 16),
(10, 16),
(11, 16),
(12, 16),
(13, 17),
(14, 17),
(15, 17),
(16, 18),
(17, 18),
(18, 19),
(19, 19),
(20, 20),
(21, 20),
(22, 14),
(23, 14),
(24, 21),
(25, 21),
(26, 21),
(27, 21),
(28, 21),
(29, 22),
(30, 22),
(31, 22),
(32, 23),
(33, 24),
(34, 24),
(35, 24),
(36, 24),
(37, 25),
(38, 25),
(39, 25),
(40, 26),
(41, 27),
(42, 27),
(43, 27),
(44, 27),
(45, 28),
(46, 28),
(47, 29),
(48, 22),
(49, 25),
(50, 29),
(51, 17),
(51, 22),
(51, 28),
(51, 29),
(52, 31),
(53, 22),
(53, 28),
(54, 34),
(55, 34),
(56, 37),
(57, 37),
(58, 37),
(59, 38),
(60, 39),
(61, 39),
(62, 39),
(63, 39),
(64, 40),
(65, 40),
(66, 19),
(67, 19),
(68, 12),
(69, 12),
(70, 41),
(71, 41),
(71, 42),
(72, 41),
(73, 42),
(74, 16),
(75, 16),
(76, 26),
(77, 26),
(78, 26),
(79, 26),
(80, 18),
(81, 18),
(82, 43),
(83, 43),
(84, 43),
(85, 44),
(86, 44),
(87, 44),
(88, 17),
(88, 24),
(88, 28),
(88, 37),
(88, 42),
(89, 47),
(90, 47),
(91, 48),
(92, 48),
(93, 48),
(94, 49),
(95, 49),
(96, 49),
(97, 49),
(98, 49),
(99, 51),
(100, 51),
(101, 51),
(101, 52),
(102, 52),
(103, 53),
(104, 53),
(105, 53),
(106, 53),
(107, 53),
(108, 54),
(109, 38),
(110, 59),
(111, 22),
(112, 14),
(113, 12),
(113, 18);

-- --------------------------------------------------------

--
-- Structure de la table `produit_categorie`
--

DROP TABLE IF EXISTS `produit_categorie`;
CREATE TABLE IF NOT EXISTS `produit_categorie` (
  `id_produit` int NOT NULL,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id_produit`,`id_categorie`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit_categorie`
--

INSERT INTO `produit_categorie` (`id_produit`, `id_categorie`) VALUES
(2, 1),
(3, 4),
(4, 1),
(5, 1),
(6, 1),
(7, 5),
(8, 5),
(9, 4),
(10, 4),
(11, 4),
(12, 1),
(13, 1),
(14, 5),
(15, 4),
(16, 1),
(17, 5),
(18, 1),
(19, 4),
(20, 1),
(21, 4),
(22, 1),
(23, 5),
(24, 1),
(25, 4),
(26, 1),
(27, 4),
(28, 1),
(29, 4),
(30, 1),
(31, 4),
(32, 4),
(33, 1),
(34, 4),
(35, 1),
(36, 1),
(37, 1),
(38, 4),
(39, 4),
(40, 4),
(41, 1),
(42, 4),
(43, 1),
(44, 5),
(45, 4),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 4),
(55, 4),
(56, 1),
(57, 1),
(58, 4),
(59, 4),
(60, 1),
(61, 4),
(62, 1),
(63, 1),
(64, 1),
(65, 4),
(66, 1),
(67, 1),
(68, 1),
(69, 4),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 4),
(76, 1),
(77, 4),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 4),
(87, 4),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 4),
(97, 4),
(98, 1),
(99, 4),
(100, 4),
(101, 4),
(102, 4),
(103, 1),
(104, 1),
(105, 4),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit_genre`
--

DROP TABLE IF EXISTS `produit_genre`;
CREATE TABLE IF NOT EXISTS `produit_genre` (
  `id_produit` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_produit`,`id_genre`),
  KEY `id_genre` (`id_genre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit_genre`
--

INSERT INTO `produit_genre` (`id_produit`, `id_genre`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 15),
(6, 1),
(6, 14),
(6, 17),
(8, 2),
(9, 9),
(9, 12),
(9, 21),
(10, 9),
(10, 12),
(10, 21),
(11, 9),
(11, 12),
(11, 21),
(12, 9),
(12, 12),
(12, 21),
(13, 1),
(13, 17),
(14, 1),
(14, 17),
(15, 1),
(15, 17),
(16, 2),
(16, 9),
(16, 20),
(17, 2),
(17, 9),
(17, 20),
(18, 21),
(19, 21),
(20, 9),
(21, 9),
(22, 1),
(22, 9),
(22, 14),
(22, 17),
(22, 18),
(23, 1),
(23, 9),
(23, 14),
(23, 17),
(23, 18),
(24, 12),
(24, 21),
(25, 12),
(25, 21),
(26, 12),
(26, 17),
(26, 21),
(27, 12),
(27, 17),
(27, 21),
(28, 7),
(28, 13),
(28, 17),
(28, 18),
(28, 21),
(29, 6),
(29, 11),
(29, 22),
(30, 9),
(30, 18),
(30, 22),
(31, 9),
(31, 18),
(31, 22),
(32, 9),
(32, 22),
(33, 12),
(33, 21),
(34, 12),
(34, 21),
(35, 6),
(35, 7),
(35, 18),
(35, 21),
(36, 12),
(36, 21),
(36, 24),
(37, 12),
(37, 17),
(37, 21),
(37, 25),
(38, 12),
(38, 17),
(38, 21),
(38, 25),
(39, 12),
(39, 17),
(39, 21),
(40, 12),
(40, 24),
(41, 1),
(41, 17),
(41, 28),
(42, 1),
(42, 17),
(42, 28),
(43, 1),
(43, 17),
(43, 28),
(44, 1),
(44, 17),
(44, 28),
(45, 2),
(45, 16),
(45, 20),
(46, 2),
(46, 16),
(46, 20),
(47, 26),
(47, 29),
(48, 17),
(49, 12),
(49, 18),
(49, 21),
(49, 25),
(50, 9),
(50, 22),
(50, 26),
(50, 29),
(51, 5),
(51, 13),
(51, 16),
(51, 17),
(51, 24),
(51, 25),
(51, 29),
(52, 7),
(52, 13),
(52, 31),
(52, 32),
(53, 19),
(53, 23),
(53, 26),
(54, 13),
(54, 21),
(54, 22),
(54, 31),
(55, 12),
(55, 21),
(55, 24),
(56, 13),
(56, 21),
(56, 22),
(57, 12),
(57, 18),
(57, 21),
(57, 24),
(58, 9),
(58, 21),
(59, 13),
(59, 22),
(59, 31),
(60, 1),
(60, 15),
(61, 1),
(61, 15),
(62, 1),
(62, 15),
(63, 1),
(63, 15),
(64, 12),
(64, 16),
(64, 17),
(64, 18),
(64, 21),
(65, 12),
(65, 16),
(65, 17),
(65, 18),
(65, 21),
(66, 21),
(67, 12),
(67, 21),
(67, 24),
(68, 1),
(68, 15),
(68, 17),
(69, 1),
(69, 15),
(70, 12),
(70, 17),
(70, 18),
(70, 21),
(71, 12),
(71, 17),
(71, 18),
(71, 21),
(72, 12),
(72, 17),
(72, 18),
(72, 21),
(73, 12),
(73, 17),
(73, 18),
(73, 21),
(74, 12),
(74, 17),
(74, 21),
(74, 33),
(74, 34),
(75, 12),
(75, 17),
(75, 21),
(75, 33),
(75, 34),
(76, 12),
(76, 18),
(76, 21),
(76, 24),
(77, 12),
(77, 18),
(77, 21),
(77, 24),
(78, 12),
(78, 14),
(78, 17),
(78, 21),
(78, 24),
(79, 12),
(79, 17),
(79, 21),
(79, 24),
(80, 16),
(80, 18),
(80, 21),
(80, 35),
(80, 36),
(81, 16),
(81, 18),
(81, 21),
(81, 35),
(81, 36),
(82, 1),
(82, 15),
(83, 1),
(83, 15),
(83, 37),
(83, 38),
(84, 1),
(84, 15),
(84, 37),
(84, 38),
(85, 12),
(85, 21),
(85, 24),
(86, 12),
(86, 21),
(86, 24),
(87, 12),
(87, 21),
(87, 24),
(88, 26),
(89, 2),
(89, 19),
(89, 25),
(90, 1),
(90, 17),
(91, 1),
(91, 18),
(92, 17),
(92, 60),
(93, 22),
(93, 61),
(94, 18),
(94, 19),
(94, 22),
(95, 2),
(95, 13),
(95, 22),
(96, 2),
(96, 13),
(96, 22),
(97, 18),
(97, 22),
(98, 18),
(98, 22),
(99, 9),
(99, 17),
(99, 21),
(100, 16),
(100, 17),
(100, 21),
(100, 35),
(101, 17),
(101, 18),
(101, 21),
(101, 36),
(102, 9),
(102, 18),
(102, 61),
(103, 12),
(103, 18),
(103, 21),
(104, 12),
(104, 21),
(105, 9),
(105, 21),
(106, 18),
(106, 21),
(106, 24),
(107, 12),
(107, 21),
(107, 22),
(108, 16),
(108, 21),
(108, 22),
(109, 8),
(109, 16),
(109, 25),
(110, 17),
(111, 61),
(112, 16),
(112, 26),
(112, 33),
(113, 13),
(113, 34),
(113, 36);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `email`, `telephone`, `mdp`, `is_admin`) VALUES
(7, 'Bureau', 'Evan', 'evantronic23@gmail.com', '0761734326', '$2y$10$kyg09ZCCPUd4a40I2vRNxeDxdz9rOqWe48GR9VKfUUf3LSk/4URWG', 1),
(8, 'Hachi', 'Una', 'evanbureau23@gmail.com', '0635313961', '$2y$10$lxphz0.T9DHD09nofE7Fkej7hUx0l./K4GM3xo.P7YzVzp8dk5pY.', 0),
(10, 'Floyd', 'Gooning', 'IcantBreath69@niggasoft.com', '06696741', '$2y$10$8NEMx/LTzNtXhdIv98noTO93th//t6v/HD42rB0S/xddYf16pTtfG', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_adresse`
--

DROP TABLE IF EXISTS `utilisateur_adresse`;
CREATE TABLE IF NOT EXISTS `utilisateur_adresse` (
  `id_user` int NOT NULL,
  `id_adresse` int NOT NULL,
  PRIMARY KEY (`id_user`,`id_adresse`),
  KEY `id_adresse` (`id_adresse`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur_adresse`
--

INSERT INTO `utilisateur_adresse` (`id_user`, `id_adresse`) VALUES
(7, 3),
(7, 12),
(8, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
