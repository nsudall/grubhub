CREATE DATABASE grubhub;

USE grubhub;

CREATE TABLE restaurants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price VARCHAR(100),   
    stars VARCHAR(100),
    image VARCHAR(100),
    link VARCHAR(100)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rest_id INT NOT NULL,
    total FLOAT CHECK (total >= 0),
    fees FLOAT CHECK (fees >= 0),
    profit FLOAT DEFAULT 0,  -- Added: For admin to track profit per order
    status VARCHAR(20) DEFAULT 'pending',  -- Added: pending, completed, cancelled
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Added: When order was placed
    FOREIGN KEY (rest_id) REFERENCES restaurants(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

INSERT INTO restaurants (name, description, price, stars, image, link)
VALUES ('Pizza Palace', 'Italian Pizza', '$$$', '★★★★☆', 'pizza.jpeg', 'goToPizzaMenu');
INSERT INTO restaurants (name, description, price, stars, image, link)
VALUES ('Burger Joint', 'American Burgers', '$', '★★★☆☆', 'burger.jpeg', 'goToBurgerMenu');
INSERT INTO restaurants (name, description, price, stars, image, link)
VALUES ('Sawasdee Thai Kitchen', 'Asian Thai', '$$', '★★★★★', 'thai.webp', 'goToThaiMenu');
INSERT INTO restaurants (name, description, price, stars, image, link)
VALUES ('Casa del Taco', 'Mexican Tacos', '$$', '★★★★☆', 'taco.jpeg', 'goToTacoMenu');
INSERT INTO restaurants (name, description, price, stars, image, link)
VALUES ('The Curry Leaf', 'Indian Curry', '$$$', '★★★★☆', 'curry.jpeg', 'goToCurryMenu');
INSERT INTO restaurants (name, description, price, stars, image, link)
VALUES ('Pasta Paradiso', 'Italian Pasta', '$$$$', '★★★★★', 'pasta.jpeg', 'goToPastaMenu');
