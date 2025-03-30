<?php
$host = 'localhost';
$db = 'quick-gear-db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('Database connection error');
}

try {
    $stmt = $pdo->query('SELECT * FROM products');
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $products = [];
}

// New code block to load newly listed items from list_item table
try {
    $stmt = $pdo->query('SELECT * FROM list_item');
    $listItems = $stmt->fetchAll();
    // Merge list items with products
    $products = array_merge($products, $listItems);
} catch (PDOException $e) {
    error_log($e->getMessage());
    // If query fails, simply continue with products from products table
}

$categories = [
    'tech' => ['name' => 'Electronics', 'icon' => 'fas fa-laptop'],
    'tools' => ['name' => 'Tools', 'icon' => 'fas fa-tools'],
    'events' => ['name' => 'Event Equipment', 'icon' => 'fas fa-music'],
    'home' => ['name' => 'Home Appliances', 'icon' => 'fas fa-home']
];
?>