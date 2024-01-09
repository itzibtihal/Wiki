--Create DATABASE wiki
CREATE DATABASE IF NOT EXISTS wiki;

-- Create table Roles

CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
);

-- Create table users 
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    profile VARCHAR(255) NULL,
    password VARCHAR(255) NOT NULL,
    linkedinProfile TEXT NULL,
    instagramProfile TEXT NULL,
    xProfile TEXT NULL,
    description TEXT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);


-- Create table Categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    picture VARCHAR(255) NOT NULL
);

-- Create table Tags
CREATE TABLE IF NOT EXISTS tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(255) NOT NULL
    
);

-- Create table Wikis (add here deleted at and archive)
CREATE TABLE IF NOT EXISTS wikis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    picture VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    read_min INT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_deleted TIMESTAMP NULL DEFAULT NULL,
    status TEXT DEFAULT 'verified',
    user_id INT,
    category_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);


-- Table Wikis et Tags (relation M to M)
CREATE TABLE IF NOT EXISTS wikis_tags (
    id_wiki INT,
    id_tag INT,
    PRIMARY KEY (id_wiki, id_tag),
    FOREIGN KEY (id_wiki) REFERENCES wikis(id),
    FOREIGN KEY (id_tag) REFERENCES tags(id)
);

-- Archives (Wikis archived by admin)
CREATE TABLE IF NOT EXISTS archives (
    id_archive INT AUTO_INCREMENT PRIMARY KEY,
    id_wiki INT,
    raison_archivage TEXT,
    FOREIGN KEY (id_wiki) REFERENCES wikis(id)
);