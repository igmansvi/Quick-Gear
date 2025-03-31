<?php
require_once __DIR__ . '/../includes/init.php';
requireLogin();

$host = "localhost";
$dbname = "quick-gear-db";
$user = "root";
$pass = "";

$userId = $_SESSION['user_id'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT bookings.*, products.name AS item_name 
              FROM bookings 
              JOIN products ON bookings.product_id = products.id 
              WHERE bookings.user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log($e->getMessage());
    $bookings = [];
}
?>