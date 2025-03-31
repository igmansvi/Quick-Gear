-- Run this SQL script to create the database and tables for the Quick Gear rental system.
-- This script includes the creation of the database, tables, and insertion of demo data.
-- Make sure to run this script in a MySQL environment.
-- Database: quick-gear-db
-- Create database
CREATE DATABASE IF NOT EXISTS `quick-gear-db`;
USE `quick-gear-db`;

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
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
INSERT INTO products (name, category, description, price, price_type, deposit, status, image, features) VALUES
('DSLR Camera', 'tech', 'Professional Canon 5D Mark IV with lens kit', 999.00, 'day', 25000.00, 'available', 'https://placehold.co/400x300/4361ee/ffffff?text=DSLR+Camera', '4K Video, 30.4MP, Dual Pixel AF'),
('PlayStation 5', 'tech', 'Gaming console with 2 controllers and 3 games', 499.00, 'day', 15000.00, 'coming_soon', 'https://placehold.co/400x300/4361ee/ffffff?text=PlayStation+5', '2 Controllers, 3 Games Included, 4K Gaming'),
('Professional DJ Setup', 'events', 'Complete DJ system with speakers and lights', 2500.00, 'day', 35000.00, 'available', 'https://placehold.co/400x300/ff6b6b/ffffff?text=DJ+Setup', '2000W Speakers, DMX Lights, Pioneer Controller'),
('Drone with 4K Camera', 'tech', 'DJI Mavic Air 2 with extra batteries', 1500.00, 'day', 20000.00, 'available', 'https://placehold.co/400x300/4361ee/ffffff?text=Drone', '4K 60fps, 48MP Photos, 34min Flight Time'),
('Power Generator', 'tools', '5500W Portable Generator', 800.00, 'day', 10000.00, 'available', 'https://placehold.co/400x300/2b2d42/ffffff?text=Generator', '5500W Output, Low Noise, Fuel Efficient'),
('Professional Lighting Kit', 'events', 'Studio lighting setup with softboxes', 1200.00, 'day', 15000.00, 'available', 'https://placehold.co/400x300/ff6b6b/ffffff?text=Lighting+Kit', '3-Point Setup, LED Panels, Wireless Control'),
('Heavy Duty Lawn Mower', 'tools', 'Professional grade gas-powered mower', 600.00, 'day', 8000.00, 'available', 'https://placehold.co/400x300/2b2d42/ffffff?text=Lawn+Mower', 'Self-Propelled, 21-inch Deck, Mulching Capable');

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    role VARCHAR(50) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert demo admin user
INSERT INTO users (full_name, email, password, phone, role) VALUES
('mansvi', 'itsmansvi@gmail.com', 'm4vi01', '9661720207', 'admin');

-- Insert demo users - remove explicit IDs
INSERT INTO users (full_name, email, password, phone, role) VALUES
('priyanshu', 'priyanshu@example.in', 'pass123', '9876543211', 'user'),
('kiran', 'kiran@example.in', 'pass123', '9876543212', 'user'),
('varun', 'varun@example.in', 'pass123', '9876543213', 'user');

-- Create bookings table with all necessary fields
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL DEFAULT 0,
    product_id INT NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    message TEXT,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pending'
);

-- Use a temporary way to get the IDs by using email addresses to reference users
-- Since this is just demo data, you can update the user_id manually after inserting

-- Insert demo data for bookings with multiple entries per user - use email instead of explicit IDs
INSERT INTO bookings (user_id, product_id, full_name, email, phone, start_date, end_date, message, status) VALUES
-- Admin bookings (use 1 as a placeholder - you'll need to update this with the actual ID after insertion)
(1, 1, 'mansvi', 'itsmansvi@gmail.com', '9661720207', '2023-09-05', '2023-09-10', 'Testing the camera for a company event', 'completed'),
(1, 3, 'mansvi', 'itsmansvi@gmail.com', '9661720207', '2023-09-15', '2023-09-17', 'Need DJ setup for staff party', 'completed'),
(1, 5, 'mansvi', 'itsmansvi@gmail.com', '9661720207', '2023-10-01', '2023-10-02', 'Generator needed for outdoor shooting', 'completed'),
(1, 7, 'mansvi', 'itsmansvi@gmail.com', '9661720207', '2023-12-15', '2023-12-16', 'Office lawn maintenance', 'confirmed'),

-- User bookings (use 2, 3, 4 as placeholders - update these after insertion)
(2, 2, 'priyanshu', 'priyanshu@example.in', '9876543211', '2023-10-10', '2023-10-15', 'Weekend gaming session with friends', 'confirmed'),
(2, 4, 'priyanshu', 'priyanshu@example.in', '9876543211', '2023-11-05', '2023-11-10', 'Need drone for sister\'s wedding shoot', 'pending'),
(2, 6, 'priyanshu', 'priyanshu@example.in', '9876543211', '2023-12-20', '2023-12-25', 'Christmas decoration lighting setup', 'pending'),

-- User 2 (kiran) bookings
(3, 1, 'kiran', 'kiran@example.in', '9876543212', '2023-10-20', '2023-10-25', 'Photography project for college assignment', 'completed'),
(3, 3, 'kiran', 'kiran@example.in', '9876543212', '2023-11-15', '2023-11-18', 'Birthday party DJ setup', 'confirmed'),
(3, 5, 'kiran', 'kiran@example.in', '9876543212', '2023-12-05', '2023-12-06', 'Power backup for home event', 'pending'),
(3, 7, 'kiran', 'kiran@example.in', '9876543212', '2024-01-10', '2024-01-11', 'Garden maintenance at new house', 'pending'),

-- User 3 (varun) bookings
(4, 2, 'varun', 'varun@example.in', '9876543213', '2023-09-25', '2023-09-30', 'Gaming night with colleagues', 'completed'),
(4, 4, 'varun', 'varun@example.in', '9876543213', '2023-10-30', '2023-11-05', 'Drone footage for travel vlog', 'completed'),
(4, 6, 'varun', 'varun@example.in', '9876543213', '2023-11-25', '2023-11-30', 'Product photography lighting', 'confirmed'),
(4, 1, 'varun', 'varun@example.in', '9876543213', '2023-12-10', '2023-12-15', 'Wildlife photography trip', 'pending');

-- Add foreign key constraint for bookings table
ALTER TABLE bookings
ADD CONSTRAINT fk_bookings_product
FOREIGN KEY (product_id) REFERENCES products(id);

-- Fix the syntax error in the foreign key constraint
ALTER TABLE bookings
ADD CONSTRAINT fk_bookings_user
FOREIGN KEY (user_id) REFERENCES users(id);