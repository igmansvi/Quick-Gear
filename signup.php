<?php
require_once './includes/init.php';
if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$error_message = '';
$success_message = '';

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
        $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $errors = [];

        if (empty($full_name) || strlen($full_name) < 3) {
            $errors[] = "Full name must be at least 3 characters";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address";
        }

        if (empty($phone) || !preg_match("/^[0-9]{10}$/", $phone)) {
            $errors[] = "Please enter a valid 10-digit phone number";
        }

        if (empty($password) || strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters";
        }

        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match";
        }

        if (empty($errors)) {
            $pdo = new PDO($dsn, $user, $pass, $options);

            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $error_message = "Email address is already registered. Please login instead.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, phone, role, created_at) VALUES (?, ?, ?, ?, 'user', NOW())");
                $stmt->execute([$full_name, $email, $hashed_password, $phone]);

                $success_message = "Registration successful! You can now login.";
            }
        } else {
            $error_message = implode("<br>", $errors);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $error_message = "An error occurred during registration. Please try again later.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Quick Gear</title>
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
                <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
                <p class="text-gray-600">Join Quick Gear for equipment rental services</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p><?php echo $error_message; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p><?php echo $success_message; ?></p>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="login.php"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition-colors duration-300">
                            Go to Login <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <form id="signupForm" action="signup.php" method="post" class="space-y-6">
                    <div>
                        <label for="full_name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="full_name" id="full_name" required
                                class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <p id="nameError" class="text-red-500 text-xs mt-1 hidden">Name must be at least 3 characters</p>
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" name="email" id="email" required
                                class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <p id="emailError" class="text-red-500 text-xs mt-1 hidden">Please enter a valid email address</p>
                    </div>

                    <div>
                        <label for="phone" class="block text-gray-700 font-medium mb-1">Phone Number</label>
                        <div class="relative">
                            <i class="fas fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="tel" name="phone" id="phone" required
                                class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <p id="phoneError" class="text-red-500 text-xs mt-1 hidden">Please enter a valid 10-digit phone
                            number</p>
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" name="password" id="password" required minlength="6"
                                class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <p id="passwordError" class="text-red-500 text-xs mt-1 hidden">Password must be at least 6
                            characters</p>
                    </div>

                    <div>
                        <label for="confirm_password" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" name="confirm_password" id="confirm_password" required
                                class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <p id="confirmError" class="text-red-500 text-xs mt-1 hidden">Passwords do not match</p>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors duration-300">
                            Sign Up <i class="fas fa-user-plus ml-2"></i>
                        </button>
                    </div>
                </form>
            <?php endif; ?>

            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Sign in</a></p>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('signupForm');
            if (!form) return;

            const fullName = document.getElementById('full_name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');

            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const phoneError = document.getElementById('phoneError');
            const passwordError = document.getElementById('passwordError');
            const confirmError = document.getElementById('confirmError');

            const validateName = () => {
                if (fullName.value.length < 3) {
                    nameError.classList.remove('hidden');
                    fullName.classList.add('border-red-500');
                    return false;
                } else {
                    nameError.classList.add('hidden');
                    fullName.classList.remove('border-red-500');
                    return true;
                }
            };

            const validateEmail = () => {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!re.test(email.value)) {
                    emailError.classList.remove('hidden');
                    email.classList.add('border-red-500');
                    return false;
                } else {
                    emailError.classList.add('hidden');
                    email.classList.remove('border-red-500');
                    return true;
                }
            };

            const validatePhone = () => {
                const re = /^[0-9]{10}$/;
                if (!re.test(phone.value)) {
                    phoneError.classList.remove('hidden');
                    phone.classList.add('border-red-500');
                    return false;
                } else {
                    phoneError.classList.add('hidden');
                    phone.classList.remove('border-red-500');
                    return true;
                }
            };

            const validatePassword = () => {
                if (password.value.length < 6) {
                    passwordError.classList.remove('hidden');
                    password.classList.add('border-red-500');
                    return false;
                } else {
                    passwordError.classList.add('hidden');
                    password.classList.remove('border-red-500');
                    return true;
                }
            };

            const validateConfirmPassword = () => {
                if (password.value !== confirmPassword.value) {
                    confirmError.classList.remove('hidden');
                    confirmPassword.classList.add('border-red-500');
                    return false;
                } else {
                    confirmError.classList.add('hidden');
                    confirmPassword.classList.remove('border-red-500');
                    return true;
                }
            };

            fullName.addEventListener('blur', validateName);
            email.addEventListener('blur', validateEmail);
            phone.addEventListener('blur', validatePhone);
            password.addEventListener('blur', validatePassword);
            confirmPassword.addEventListener('blur', validateConfirmPassword);

            form.addEventListener('submit', function (e) {
                const isNameValid = validateName();
                const isEmailValid = validateEmail();
                const isPhoneValid = validatePhone();
                const isPasswordValid = validatePassword();
                const isConfirmValid = validateConfirmPassword();

                if (!(isNameValid && isEmailValid && isPhoneValid && isPasswordValid && isConfirmValid)) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>