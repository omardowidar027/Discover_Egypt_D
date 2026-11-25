CREATE DATABASE IF NOT EXISTS discover_egypt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE discover_egypt;

DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    content TEXT NOT NULL,
    location VARCHAR(150) NOT NULL,
    category_id INT NOT NULL,
    status ENUM('published','draft') NOT NULL DEFAULT 'published',
    visual_class VARCHAR(50) NOT NULL DEFAULT 'visual-pyramid',
    icon VARCHAR(60) NOT NULL DEFAULT 'bi-bank',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_posts_category FOREIGN KEY (category_id) REFERENCES categories(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO categories (name) VALUES
('Ancient Egypt'), ('Beaches'), ('Deserts'), ('Culture');

INSERT INTO posts (title, content, location, category_id, status, visual_class, icon) VALUES
('The Great Pyramids', 'The Pyramids of Giza are among the most recognizable monuments in the world. Their scale, engineering and connection to ancient Egyptian civilization make the Giza plateau a must-see destination.', 'Giza, Egypt', 1, 'published', 'visual-pyramid', 'bi-bank'),
('Luxor Temple', 'Luxor is a remarkable open-air museum. Luxor Temple, standing on the east bank of the Nile, offers visitors a close look at monumental architecture and the history of ancient Thebes.', 'Luxor, Egypt', 1, 'published', 'visual-temple', 'bi-building'),
('Hurghada Red Sea', 'Hurghada is famous for its warm Red Sea waters, beaches and marine life. It is a popular destination for people who want relaxation, water activities and beautiful coastal scenery.', 'Red Sea, Egypt', 2, 'published', 'visual-sea', 'bi-water'),
('Siwa Oasis', 'Siwa Oasis combines desert landscapes, palm groves, natural springs and a distinctive local culture. It is an ideal destination for travelers looking for a quieter side of Egypt.', 'Matrouh, Egypt', 3, 'published', 'visual-desert', 'bi-brightness-high'),
('Aswan', 'Aswan sits beside the Nile in southern Egypt and is known for its river views, islands and Nubian heritage. The city offers a peaceful cultural experience with a strong sense of place.', 'Aswan, Egypt', 4, 'published', 'visual-sea', 'bi-compass'),
('Karnak Temple', 'The Karnak Temple complex is one of the largest religious sites of ancient Egypt. Its columns, courtyards and monuments reveal the ambition and artistry of the ancient Egyptian world.', 'Luxor, Egypt', 1, 'published', 'visual-temple', 'bi-columns-gap');
