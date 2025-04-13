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
                $error_message = "Email address is already registered. <a href='login.php?email=" . urlencode($email) . "' class='font-medium underline'>Login here</a> instead.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, phone, role, created_at) VALUES (?, ?, ?, ?, 'user', NOW())");
                $stmt->execute([$full_name, $email, $password, $phone]);

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
                        blue: {
                            DEFAULT: '#3a86ff',
                        }
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans m-0 p-0 box-border bg-gray-50 min-h-screen">
    <div class="flex flex-col lg:flex-row min-h-screen">
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-blue-400 p-8 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-20 h-20 border-4 border-white rounded-full"></div>
                <div class="absolute bottom-20 right-20 w-32 h-32 border-4 border-white rounded-full"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 border-4 border-white transform rotate-45"></div>
                <div class="absolute top-1/4 right-1/3 w-10 h-10 border-4 border-white transform rotate-12"></div>
            </div>

            <div class="w-full h-full flex flex-col items-center justify-center z-10 text-white">
                <div class="w-full max-w-md mx-auto">
                    <div class="flex items-center justify-center mb-8">
                        <i class="fas fa-tools text-6xl text-white mb-4 animate-float"></i>
                    </div>

                    <h1 class="text-4xl font-bold mb-6 text-center">Welcome to Quick Gear</h1>

                    <div class="space-y-8">
                        <div class="flex items-start space-x-4">
                            <div class="bg-white rounded-full p-2 flex items-center justify-center h-10 w-10 shadow-lg">
                                <i class="fas fa-search text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">Find Equipment</h3>
                                <p class="text-blue-100">Browse our extensive collection of high-quality rental
                                    equipment</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-white rounded-full p-2 flex items-center justify-center h-10 w-10 shadow-lg">
                                <i class="fas fa-calendar-check text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">Book Online</h3>
                                <p class="text-blue-100">Simple and secure booking process with instant confirmation</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-white rounded-full p-2 flex items-center justify-center h-10 w-10 shadow-lg">
                                <i class="fas fa-truck text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">Quick Delivery</h3>
                                <p class="text-blue-100">Get equipment delivered right to your doorstep on time</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 text-center">
                        <p class="text-blue-100">Already have an account?</p>
                        <a href="login.php"
                            class="mt-2 inline-block bg-white text-blue-600 font-semibold py-2 px-6 rounded-lg hover:bg-blue-50 transition-colors duration-300 shadow-lg">
                            Sign In <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1/4 bg-gradient-to-t from-blue-700 to-transparent opacity-30"></div>
            <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-blue-300 rounded-full opacity-30"></div>
            <div class="absolute -top-16 -left-16 w-64 h-64 bg-blue-300 rounded-full opacity-30"></div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 md:p-8">
            <div
                class="w-full max-w-md bg-white rounded-xl shadow-xl p-6 md:p-8 transition-all duration-300 hover:shadow-2xl">
                <div class="text-center mb-8">
                    <div class="lg:hidden flex items-center justify-center">
                        <i class="fas fa-tools text-4xl text-blue-600 mb-4"></i>
                    </div>
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
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg animate-pulse">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <p><?php echo $success_message; ?></p>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="login.php"
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                Go to Login <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <form id="signupForm" action="signup.php" method="post" class="space-y-5">
                        <div>
                            <label for="full_name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="full_name" id="full_name" required
                                    class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <p id="nameError" class="text-red-500 text-xs mt-1 hidden">Name must be at least 3 characters
                            </p>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="email" name="email" id="email" required
                                    value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>"
                                    class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <p id="emailError" class="text-red-500 text-xs mt-1 hidden">Please enter a valid email address
                            </p>
                        </div>

                        <div>
                            <label for="phone" class="block text-gray-700 font-medium mb-1">Phone Number</label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="tel" name="phone" id="phone" required
                                    class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <p id="phoneError" class="text-red-500 text-xs mt-1 hidden">Please enter a valid 10-digit phone
                                number</p>
                        </div>

                        <div>
                            <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" name="password" id="password" required minlength="6"
                                    class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <p id="passwordError" class="text-red-500 text-xs mt-1 hidden">Password must be at least 6
                                characters</p>
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-gray-700 font-medium mb-1">Confirm
                                Password</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" name="confirm_password" id="confirm_password" required
                                    class="w-full bg-gray-50 border border-gray-300 pl-10 pr-3 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                            <p id="confirmError" class="text-red-500 text-xs mt-1 hidden">Passwords do not match</p>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                Sign Up <i class="fas fa-user-plus ml-2"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>

                <div class="mt-6 text-center text-sm text-gray-500 lg:hidden">
                    <p>Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

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