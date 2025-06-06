<?php
require_once './includes/init.php';
if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}
$error_message = '';
$timeout_message = '';
if (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
    $timeout_message = "Your session has expired. Please login again.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $dbname = 'quick-gear-db';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Please enter a valid email address";
        } elseif (empty($password)) {
            $error_message = "Please enter your password";
        } else {
            $pdo = new PDO($dsn, $user, $pass, $options);

            $stmt = $pdo->prepare("SELECT id, email, password, full_name, role FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if (!$user) {
                $error_message = "Email not found. <a href='signup.php?email=" . urlencode($email) . "' class='font-medium underline'>Sign up</a> to create a new account.";
            } elseif ($user['password'] !== $password) {
                $error_message = "Invalid password. Please try again.";
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            }
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $error_message = "An error occurred during login. Please try again later.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Quick Gear</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff8c00',
                        secondary: '#ff6300',
                        accent: '#ffdd00',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans m-0 p-0 box-border bg-gray-100 min-h-screen flex items-center justify-center">

    <main class="container mx-auto py-16 px-4">
        <div
            class="max-w-md mx-auto bg-white rounded-xl shadow-lg p-8 transition duration-300 hover:shadow-2xl hover:shadow-blue-300">
            <div class="text-center mb-8">
                <i class="fas fa-tools text-4xl text-blue-600 mb-4"></i>
                <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
                <p class="text-gray-600">Login to access your Quick Gear account</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p><?php echo $error_message; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($timeout_message)): ?>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <p><?php echo htmlspecialchars($timeout_message); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post" class="space-y-6">
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" id="email" required
                            value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>"
                            class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" name="password" id="password" required
                            class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors duration-300">
                        Sign In <i class="fas fa-sign-in-alt ml-2"></i>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Don't have an account? <a href="signup.php" class="text-blue-600 hover:underline">Sign up now</a></p>
            </div>
        </div>
    </main>
</body>

</html>