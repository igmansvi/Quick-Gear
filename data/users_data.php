<?php
$host = 'localhost';
$dbname = 'quick-gear-db';
$user = 'root';
$pass = '';

$users = [];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all users (for admin purposes, not exposed to regular users)
    $stmt = $pdo->query("SELECT id, full_name, email, phone, created_at FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    try {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        error_log("Attempting login with email: " . $email);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        $authenticated = false;

        if ($userData) {
            error_log("User found with ID: " . $userData['id']);

            if (isset($userData['password']) && !empty($userData['password'])) {
                if (password_verify($password, $userData['password'])) {
                    $authenticated = true;
                    error_log("Hashed password match successful");
                } else if ($password === $userData['password']) {
                    $authenticated = true;
                    error_log("Plain text password match - security risk");
                } else {
                    error_log("Password verification failed for " . $email);
                }
            } else {
                error_log("User has no password set in database");
            }
        } else {
            error_log("No user found with email: " . $email);
        }

        if ($authenticated) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_name'] = $userData['full_name'] ?? '';
            $_SESSION['user_email'] = $userData['email'];
            $_SESSION['user_role'] = $userData['role'] ?? 'user';

            try {
                $columnCheckStmt = $pdo->prepare("SHOW COLUMNS FROM users LIKE 'last_login'");
                $columnCheckStmt->execute();

                if ($columnCheckStmt->rowCount() > 0) {
                    $updateStmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                    $updateStmt->execute([$userData['id']]);
                }
            } catch (PDOException $e) {
                error_log("Could not update last_login: " . $e->getMessage());
            }
            header("Location: " . (($_SESSION['user_role'] === 'admin') ? "admin.php" : "index.php"));
            exit();
        } else {
            $error_message = "Invalid email or password. Please try again.";
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        $error_message = "An error occurred during login. Please try again later.";
    }
}

function getUserById($userId)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT id, full_name, email, phone FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching user: " . $e->getMessage());
        return false;
    }
}
?>