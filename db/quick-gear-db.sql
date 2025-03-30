-- Create database
CREATE DATABASE IF NOT EXISTS `quick-gear-db`;
USE `quick-gear-db`;

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    price_type VARCHAR(20) NOT NULL,
    deposit DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL,
    image TEXT NOT NULL,
    features TEXT NOT NULL
);

-- Insert demo data from products.php
INSERT INTO products (id, name, category, description, price, price_type, deposit, status, image, features) VALUES
(1, 'DSLR Camera', 'tech', 'Professional Canon 5D Mark IV with lens kit', 999.00, 'day', 25000.00, 'available', 'https://placehold.co/400x300/4361ee/ffffff?text=DSLR+Camera', '4K Video, 30.4MP, Dual Pixel AF'),
(2, 'PlayStation 5', 'tech', 'Gaming console with 2 controllers and 3 games', 499.00, 'day', 15000.00, 'coming_soon', 'https://placehold.co/400x300/4361ee/ffffff?text=PlayStation+5', '2 Controllers, 3 Games Included, 4K Gaming'),
(3, 'Professional DJ Setup', 'events', 'Complete DJ system with speakers and lights', 2500.00, 'day', 35000.00, 'available', 'https://placehold.co/400x300/ff6b6b/ffffff?text=DJ+Setup', '2000W Speakers, DMX Lights, Pioneer Controller'),
(4, 'Drone with 4K Camera', 'tech', 'DJI Mavic Air 2 with extra batteries', 1500.00, 'day', 20000.00, 'available', 'https://placehold.co/400x300/4361ee/ffffff?text=Drone', '4K 60fps, 48MP Photos, 34min Flight Time'),
(5, 'Power Generator', 'tools', '5500W Portable Generator', 800.00, 'day', 10000.00, 'available', 'https://placehold.co/400x300/2b2d42/ffffff?text=Generator', '5500W Output, Low Noise, Fuel Efficient'),
(6, 'Professional Lighting Kit', 'events', 'Studio lighting setup with softboxes', 1200.00, 'day', 15000.00, 'available', 'https://placehold.co/400x300/ff6b6b/ffffff?text=Lighting+Kit', '3-Point Setup, LED Panels, Wireless Control'),
(7, 'Heavy Duty Lawn Mower', 'tools', 'Professional grade gas-powered mower', 600.00, 'day', 8000.00, 'available', 'https://placehold.co/400x300/2b2d42/ffffff?text=Lawn+Mower', 'Self-Propelled, 21-inch Deck, Mulching Capable');

-- Create bookings table
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL DEFAULT 0,
    product_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pending'
);
-- Insert demo data from bookings.php
-- Note: user_id is set to 0 for demo purposes. In a real application, this would be the ID of the logged-in user.
INSERT INTO bookings (user_id, product_id, start_date, end_date, status) VALUES
(0, 2, '2023-10-10', '2023-10-15', 'confirmed'),
(0, 3, '2023-10-05', '2023-10-07', 'pending'),
(0, 4, '2023-10-20', '2023-10-27', 'confirmed');

-- Create rent_item table to store rental requests from rent.php
CREATE TABLE IF NOT EXISTS rent_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pending'
);

-- Create list_item table to store listing items from list_item.php
CREATE TABLE IF NOT EXISTS list_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    price_type VARCHAR(20) NOT NULL,
    deposit DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL,
    image TEXT NOT NULL,
    features TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);