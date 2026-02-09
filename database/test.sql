INSERT INTO category (name) VALUES 
('Électronique'),
('Vêtements'),
('Livres & Médias');

INSERT INTO object (name, description, category_id, price, image_url, owner_id) VALUES
('iPhone 13', 'Smartphone Apple en excellent état, 128 Go', 1, 450.00, 'iphone13.jpg', 1),
('MacBook Air M1', 'Ordinateur portable Apple, 8 Go RAM, 256 Go SSD', 1, 750.00, 'macbook.jpg', 2),
('Casque Audio Sony', 'Casque sans fil noise cancelling, modèle WH-1000XM4', 1, 200.00, 'sony_headphones.jpg', 1),
('Console PS5', 'PlayStation 5 avec 2 manettes', 1, 400.00, 'ps5.jpg', 2),
('Smartwatch Samsung', 'Montre connectée Galaxy Watch 5', 1, 150.00, 'smartwatch.jpg', 1);

INSERT INTO object (name, description, category_id, price, image_url, owner_id) VALUES
('Manteau d''hiver', 'Manteau chaud pour l''hiver, taille M, couleur noire', 2, 45.00, 'winter_coat.jpg', 2),
('Chaussures de sport', 'Chaussures Nike running, taille 42', 2, 35.00, 'running_shoes.jpg', 1),
('Robe d''été', 'Robe légère en coton, taille S, motif floral', 2, 25.00, 'summer_dress.jpg', 2),
('Jeans slim', 'Jeans bleu délavé, taille 40', 2, 20.00, 'jeans.jpg', 1),
('Pull en laine', 'Pull chaud en laine mérinos, taille L', 2, 30.00, 'wool_sweater.jpg', 2);

INSERT INTO object (name, description, category_id, price, image_url, owner_id) VALUES
('Le Petit Prince', 'Livre d''Antoine de Saint-Exupéry, édition illustrée', 3, 8.50, 'petit_prince.jpg', 2),
('1984 - George Orwell', 'Roman dystopique, édition poche', 3, 6.00, '1984.jpg', 1),
('Harry Potter à l''école des sorciers', 'Tome 1 de la série Harry Potter', 3, 12.00, 'harry_potter.jpg', 2),
('Guitare acoustique', 'Guitare classique Yamaha C40', 3, 120.00, 'guitar.jpg', 1),
('Vinyle - The Dark Side of the Moon', 'Album de Pink Floyd, édition originale', 3, 45.00, 'pink_floyd.jpg', 2);