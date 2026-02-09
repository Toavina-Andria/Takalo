-- ============================================
-- Données de test - Système d'Échange Takalo
-- ============================================

USE takalo;

-- ============================================
-- UTILISATEURS DE TEST
-- ============================================

INSERT INTO users (username, email, password) VALUES
('alice_durand', 'alice@takalo.local', '$2y$10$9h5K4zJ8mL2p1xQ7nR4vK.wH8e6F3gD9cJ5bV2xY1sZ8aL7m4oU9K'),
('bob_martin', 'bob@takalo.local', '$2y$10$9h5K4zJ8mL2p1xQ7nR4vK.wH8e6F3gD9cJ5bV2xY1sZ8aL7m4oU9K'),
('carlos_lopez', 'carlos@takalo.local', '$2y$10$9h5K4zJ8mL2p1xQ7nR4vK.wH8e6F3gD9cJ5bV2xY1sZ8aL7m4oU9K'),
('diana_cohen', 'diana@takalo.local', '$2y$10$9h5K4zJ8mL2p1xQ7nR4vK.wH8e6F3gD9cJ5bV2xY1sZ8aL7m4oU9K'),
('emma_wilson', 'emma@takalo.local', '$2y$10$9h5K4zJ8mL2p1xQ7nR4vK.wH8e6F3gD9cJ5bV2xY1sZ8aL7m4oU9K'),
('frank_meyer', 'frank@takalo.local', '$2y$10$9h5K4zJ8mL2p1xQ7nR4vK.wH8e6F3gD9cJ5bV2xY1sZ8aL7m4oU9K');

-- ============================================
-- CATÉGORIES D'OBJETS
-- ============================================

INSERT INTO category (name) VALUES
('Électronique'),
('Livres'),
('Vêtements'),
('Meubles'),
('Sports'),
('Jeux de société'),
('Musique'),
('Art et Craft'),
('Cuisine'),
('Jardin');

-- ============================================
-- OBJETS À ÉCHANGER
-- ============================================

INSERT INTO object (name, description, category_id, price, image_url, owner_id) VALUES
-- Alice (id=1)
('Laptop Dell XPS 13', 'Excellent état, batterie neuve, Windows 11', 1, 600.00, '/images/laptop.jpg', 1),
('Ensemble de livres Harry Potter', 'Collection complète édition française', 2, 45.00, '/images/books.jpg', 1),
('Vélo VTT Decathlon', 'Bien entretenu, jamais tombé', 5, 150.00, '/images/bike.jpg', 1),

-- Bob (id=2)
('Caméra Nikon D3500', 'Avec objectif 18-55mm, accessoires inclus', 1, 500.00, '/images/camera.jpg', 2),
('Placard IKEA PAX', 'Blanc, 2m de large, à assembler', 4, 80.00, '/images/closet.jpg', 2),
('Catan - Jeu de société', 'Boîte complète, peu joué', 6, 25.00, '/images/catan.jpg', 2),

-- Carlos (id=3)
('Guitare acoustique Yamaha', 'Parfait pour débutants et intermédiaires', 7, 180.00, '/images/guitar.jpg', 3),
('Coffret cuisine 24 pièces', 'Couteaux, ustensiles inox premium', 9, 120.00, '/images/cooking.jpg', 3),
('Costumes d\'homme', '3 complets taille L, occasion légère', 3, 90.00, '/images/suits.jpg', 3),

-- Diana (id=4)
('iPad Air 2', 'Tablette gris sidéral, bon état, 64GB', 1, 250.00, '/images/ipad.jpg', 4),
('Tableaux à l\'huile', 'Série de 3 peintures abstraites', 8, 200.00, '/images/paintings.jpg', 4),
('Ensemble de yoga', 'Tapis, blocs, sangle, jamais utilisé', 5, 35.00, '/images/yoga.jpg', 4),

-- Emma (id=5)
('Sèche-cheveux Dyson', 'Technologie dernière génération, comme neuf', 1, 250.00, '/images/dryer.jpg', 5),
('Robe de soirée rouge', 'Taille M, jamais portée, avec étiquette', 3, 65.00, '/images/dress.jpg', 5),
('Ensemble outils jardinage', 'Complet avec bêche, pelle, houe', 10, 55.00, '/images/garden_tools.jpg', 5),

-- Frank (id=6)
('Console Nintendo Switch OLED', 'Blanc, accessoires inclus', 1, 320.00, '/images/switch.jpg', 6),
('Microscope éducatif', 'Grossissement 40-2000x, accessoires complets', 1, 75.00, '/images/microscope.jpg', 6),
('Puzzle 5000 pièces', 'Neuf sous emballage', 6, 40.00, '/images/puzzle.jpg', 6);

-- ============================================
-- IMAGES DES OBJETS
-- ============================================

INSERT INTO image (object_id, url) VALUES
(1, '/images/laptop_1.jpg'),
(1, '/images/laptop_2.jpg'),
(2, '/images/harry_potter_1.jpg'),
(2, '/images/harry_potter_2.jpg'),
(3, '/images/bike_1.jpg'),
(4, '/images/camera_1.jpg'),
(4, '/images/camera_2.jpg'),
(5, '/images/closet_1.jpg'),
(6, '/images/catan_1.jpg'),
(7, '/images/guitar_1.jpg'),
(7, '/images/guitar_2.jpg'),
(8, '/images/cooking_1.jpg'),
(9, '/images/suits_1.jpg'),
(10, '/images/ipad_1.jpg'),
(11, '/images/painting_1.jpg'),
(11, '/images/painting_2.jpg'),
(12, '/images/yoga_1.jpg'),
(13, '/images/dryer_1.jpg'),
(14, '/images/dress_1.jpg'),
(15, '/images/garden_1.jpg'),
(16, '/images/switch_1.jpg'),
(17, '/images/microscope_1.jpg'),
(18, '/images/puzzle_1.jpg');

-- ============================================
-- DEMANDES D'ÉCHANGE
-- ============================================

INSERT INTO exchange (object1_id, object2_id, user1_id, user2_id, status) VALUES
-- Alice veut échanger son laptop contre l'iPad de Diana
(1, 10, 1, 4, 'pending'),

-- Bob propose d'échanger sa caméra contre le vélo d'Alice
(4, 3, 2, 1, 'pending'),

-- Carlos propose d'échanger sa guitare contre les livres Harry Potter d'Alice
(7, 2, 3, 1, 'accepted'),

-- Diana propose d'échanger ses tableaux contre les costumes de Carlos
(11, 9, 4, 3, 'rejected'),

-- Emma veut échanger sa robe contre l'ensemble yoga de Diana
(14, 12, 5, 4, 'pending'),

-- Frank veut échanger sa Nintendo Switch contre la caméra de Bob
(16, 4, 6, 2, 'accepted'),

-- Alice et Bob font un échange double (laptop + livres contre caméra + Catan)
(1, 4, 1, 2, 'pending'),

-- Carlos et Emma échangent (guitare contre sèche-cheveux)
(7, 13, 3, 5, 'pending');

-- ============================================
-- STATISTIQUES
-- ============================================

SELECT COUNT(*) as total_users FROM users;
SELECT COUNT(*) as total_categories FROM category;
SELECT COUNT(*) as total_objects FROM object;
SELECT COUNT(*) as total_exchanges FROM exchange;
SELECT COUNT(*) as total_images FROM image;

-- Échanges en attente
SELECT COUNT(*) as pending_exchanges FROM exchange WHERE status = 'pending';

-- Échanges acceptés
SELECT COUNT(*) as accepted_exchanges FROM exchange WHERE status = 'accepted';

-- Échanges rejetés
SELECT COUNT(*) as rejected_exchanges FROM exchange WHERE status = 'rejected';
