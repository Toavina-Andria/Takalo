CREATE DATABASE IF NOT EXISTS takalo;
USE takalo;

CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS object (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    category_id INT,
    price DOUBLE,
    image_url VARCHAR(255),
    owner_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES category(id),
    FOREIGN KEY (owner_id) REFERENCES users(id)
);


CREATE TABLE IF NOT EXISTS exchange (
    id INT AUTO_INCREMENT PRIMARY KEY,
    object1_id INT,
    object2_id INT,
    user1_id INT,
    user2_id INT,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (object1_id) REFERENCES object(id),
    FOREIGN KEY (object2_id) REFERENCES object(id),
    FOREIGN KEY (user1_id) REFERENCES users(id),
    FOREIGN KEY (user2_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS image(
    id INT AUTO_INCREMENT PRIMARY KEY,
    object_id INT,
    url VARCHAR(255) NOT NULL,
    FOREIGN KEY (object_id) REFERENCES object(id)
);



