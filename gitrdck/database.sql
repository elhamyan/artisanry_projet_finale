
CREATE DATABASE artisanr;
USE artisanr;

CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL
);

INSERT INTO produits (nom, description, prix, image) VALUES
('Tapis Marocain', 'Tapis artisanal traditionnel marocain', 450.00, 'images/tapis.jpg'),
('Poterie', 'Belle poterie faite à la main', 120.00, 'images/poterie.jpg');
