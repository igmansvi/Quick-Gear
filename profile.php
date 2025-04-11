<?php
require_once './includes/init.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$success_message = '';
$error_message = '';

// Database connection
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
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Update user profile
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
        $full_name = trim($_POST['full_name']);
        $phone = trim($_POST['phone']);
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Validate inputs
        if (empty($full_name) || strlen($full_name) < 3) {
            $error_message = "Full name must be at least 3 characters";
        } elseif (empty($phone) || !preg_match("/^[0-9]{10}$/", $phone)) {
            $error_message = "Please enter a valid 10-digit phone number";
        } else {
            // Check if password change is requested
            if (!empty($current_password)) {
                // Verify current password
                $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                $user = $stmt->fetch();

                if (!$user || $user['password'] !== $current_password) {
                    $error_message = "Current password is incorrect";
                } elseif (empty($new_password) || strlen($new_password) < 6) {
                    $error_message = "New password must be at least 6 characters";
                } elseif ($new_password !== $confirm_password) {
                    $error_message = "New passwords do not match";
                } else {
                    // Update user with new password
                    $stmt = $pdo->prepare("UPDATE users SET full_name = ?, phone = ?, password = ? WHERE id = ?");
                    $stmt->execute([$full_name, $phone, $new_password, $user_id]);
                    $success_message = "Profile updated successfully";
                    $_SESSION['user_name'] = $full_name;
                }
            } else {
                // Update user without changing password
                $stmt = $pdo->prepare("UPDATE users SET full_name = ?, phone = ? WHERE id = ?");
                $stmt->execute([$full_name, $phone, $user_id]);
                $success_message = "Profile updated successfully";
                $_SESSION['user_name'] = $full_name;
            }
        }
    }

    // Cancel booking
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_booking'])) {
        $booking_id = $_POST['booking_id'];

        $stmt = $pdo->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = ? AND user_id = ? AND status = 'pending'");
        $stmt->execute([$booking_id, $user_id]);

        if ($stmt->rowCount() > 0) {
            $success_message = "Booking cancelled successfully";
        } else {
            $error_message = "Unable to cancel this booking. It may already be confirmed or completed.";
        }
    }

    // Submit review
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
        $booking_id = $_POST['booking_id'];
        $product_id = $_POST['product_id'];
        $rating = $_POST['rating'];
        $review_text = $_POST['review_text'];

        if ($rating < 1 || $rating > 5) {
            $error_message = "Please provide a rating between 1 and 5";
        } elseif (empty($review_text)) {
            $error_message = "Please provide review text";
        } else {
            // Check if review already exists
            $checkStmt = $pdo->prepare("SELECT id FROM reviews WHERE booking_id = ? AND user_id = ?");
            $checkStmt->execute([$booking_id, $user_id]);

            if ($checkStmt->rowCount() > 0) {
                $error_message = "You have already submitted a review for this booking";
            } else {
                $stmt = $pdo->prepare("INSERT INTO reviews (booking_id, user_id, product_id, rating, review_text) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$booking_id, $user_id, $product_id, $rating, $review_text]);
                $success_message = "Review submitted successfully";
            }
        }
    }

    // Get user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user_data = $stmt->fetch();

    // Get user bookings with product info
    $stmt = $pdo->prepare("
        SELECT b.*, p.name AS product_name, p.image AS product_image, p.price AS product_price, 
               (SELECT COUNT(*) FROM reviews r WHERE r.booking_id = b.id) AS has_review
        FROM bookings b
        JOIN products p ON b.product_id = p.id
        WHERE b.user_id = ?
        ORDER BY b.booking_date DESC
    ");
    $stmt->execute([$user_id]);
    $bookings = $stmt->fetchAll();

} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
    $user_data = [];
    $bookings = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Quick Gear</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans m-0 p-0 box-border bg-gray-50">
    <?php include './includes/header.php'; ?>

    <main class="container mx-auto px-4 py-8 max-w-7xl">

        <?php if (!empty($success_message)): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg animated fadeIn">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <p><?php echo $success_message; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg animated fadeIn">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    <p><?php echo $error_message; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Profile Information -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 transition duration-300 hover:shadow-xl">
                    <div class="text-center mb-6">
                        <div
                            class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-3 bg-blue-100 border-4 border-white shadow-lg flex items-center justify-center">
                            <i class="fas fa-user text-blue-500 text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">
                            <?php echo htmlspecialchars($user_data['full_name'] ?? 'User'); ?>
                        </h3>
                        <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($user_data['email'] ?? ''); ?></p>
                    </div>

                    <h2 class="text-xl font-bold mb-4 pb-2 border-b border-gray-200 flex items-center">
                        <i class="fas fa-user-circle text-blue-600 mr-2"></i>
                        Personal Information
                    </h2>

                    <form method="post" action="" class="space-y-5" id="profile-form">
                        <div class="relative">
                            <label for="full_name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="full_name" name="full_name"
                                    value="<?php echo htmlspecialchars($user_data['full_name'] ?? ''); ?>"
                                    class="w-full px-10 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <p id="nameError" class="text-red-500 text-xs mt-1 hidden">Name must be at least 3
                                characters</p>
                        </div>

                        <div class="relative">
                            <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="email" id="email" name="email" readonly
                                    value="<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>"
                                    class="w-full px-10 py-2 border rounded-lg bg-gray-100">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                        </div>

                        <div class="relative">
                            <label for="phone" class="block text-gray-700 font-medium mb-1">Phone Number</label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="tel" id="phone" name="phone"
                                    value="<?php echo htmlspecialchars($user_data['phone'] ?? ''); ?>"
                                    class="w-full px-10 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <p id="phoneError" class="text-red-500 text-xs mt-1 hidden">Please enter a valid 10-digit
                                phone number</p>
                        </div>

                        <div class="border-t pt-5 mt-5">
                            <h3 class="font-medium mb-3 flex items-center">
                                <i class="fas fa-key text-blue-500 mr-2"></i>
                                Change Password (Optional)
                            </h3>

                            <div class="relative">
                                <label for="current_password" class="block text-gray-700 font-medium mb-1">Current
                                    Password</label>
                                <div class="relative">
                                    <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full px-10 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div class="relative mt-3">
                                <label for="new_password" class="block text-gray-700 font-medium mb-1">New
                                    Password</label>
                                <div class="relative">
                                    <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" id="new_password" name="new_password"
                                        class="w-full px-10 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <p id="passwordError" class="text-red-500 text-xs mt-1 hidden">Password must be at least
                                    6 characters</p>
                            </div>

                            <div class="relative mt-3">
                                <label for="confirm_password" class="block text-gray-700 font-medium mb-1">Confirm New
                                    Password</label>
                                <div class="relative">
                                    <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        class="w-full px-10 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <p id="confirmError" class="text-red-500 text-xs mt-1 hidden">Passwords do not match</p>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" name="update_profile"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bookings Section -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6 transition duration-300 hover:shadow-xl h-full">
                    <h2 class="text-xl font-bold mb-6 pb-2 border-b border-gray-200 flex items-center">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                        My Bookings
                    </h2>

                    <?php if (empty($bookings)): ?>
                        <div class="text-center py-16">
                            <div class="animate-bounce mb-4">
                                <i class="fas fa-calendar-times text-gray-400 text-5xl mb-3"></i>
                            </div>
                            <p class="text-gray-600 mb-4">You don't have any bookings yet.</p>
                            <a href="browse.php"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-search mr-2"></i> Browse Equipment
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-6">
                            <?php foreach ($bookings as $booking): ?>
                                <?php
                                $statusColor = ($booking['status'] === 'completed') ? 'bg-green-100 text-green-800 border-green-300' :
                                    (($booking['status'] === 'pending') ? 'bg-yellow-100 text-yellow-800 border-yellow-300' :
                                        (($booking['status'] === 'confirmed') ? 'bg-blue-100 text-blue-800 border-blue-300' : 'bg-red-100 text-red-800 border-red-300'));

                                $statusIcon = ($booking['status'] === 'completed') ? 'check-circle' :
                                    (($booking['status'] === 'pending') ? 'clock' :
                                        (($booking['status'] === 'confirmed') ? 'thumbs-up' : 'times-circle'));
                                ?>
                                <div
                                    class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300 group">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:w-1/4 h-40 md:h-auto overflow-hidden">
                                            <img src="<?php echo htmlspecialchars($booking['product_image']); ?>"
                                                alt="<?php echo htmlspecialchars($booking['product_name']); ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        </div>
                                        <div class="w-full md:w-3/4 p-4">
                                            <div class="flex justify-between items-start mb-2">
                                                <h3 class="text-lg font-bold text-gray-800">
                                                    <?php echo htmlspecialchars($booking['product_name']); ?>
                                                </h3>
                                                <span
                                                    class="flex items-center px-3 py-1 rounded-full text-xs font-semibold border <?php echo $statusColor; ?>">
                                                    <i class="fas fa-<?php echo $statusIcon; ?> mr-1"></i>
                                                    <?php echo ucfirst(htmlspecialchars($booking['status'])); ?>
                                                </span>
                                            </div>

                                            <div class="grid grid-cols-2 gap-2 mb-3">
                                                <div>
                                                    <p class="text-sm text-gray-600">
                                                        <i class="fas fa-hashtag text-blue-500 mr-1"></i>
                                                        Booking ID: #<?php echo $booking['id']; ?>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">
                                                        <i class="fas fa-tag text-blue-500 mr-1"></i>
                                                        Price: ₹<?php echo number_format($booking['product_price']); ?>/day
                                                    </p>
                                                </div>
                                                <div class="col-span-2">
                                                    <p class="text-sm text-gray-600">
                                                        <i class="fas fa-calendar-day text-blue-500 mr-1"></i>
                                                        <?php echo htmlspecialchars($booking['start_date']); ?>
                                                        <i class="fas fa-arrow-right mx-1 text-gray-400"></i>
                                                        <?php echo htmlspecialchars($booking['end_date']); ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex flex-wrap gap-2 mt-3">
                                                <?php if ($booking['status'] === 'pending'): ?>
                                                    <button type="button"
                                                        onclick="openCancelModal(<?php echo $booking['id']; ?>, '<?php echo htmlspecialchars($booking['product_name']); ?>')"
                                                        class="bg-red-600 hover:bg-red-700 text-white font-medium py-1.5 px-3 text-xs rounded transition-colors duration-300 flex items-center shadow-sm hover:shadow">
                                                        <i class="fas fa-ban mr-1"></i> Cancel Booking
                                                    </button>
                                                <?php elseif ($booking['status'] === 'completed' && !$booking['has_review']): ?>
                                                    <button
                                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-1.5 px-3 text-xs rounded transition-colors duration-300 flex items-center shadow-sm hover:shadow"
                                                        onclick="openReviewModal(<?php echo $booking['id']; ?>, <?php echo $booking['product_id']; ?>, '<?php echo htmlspecialchars($booking['product_name']); ?>')">
                                                        <i class="fas fa-star mr-1"></i> Leave Review
                                                    </button>
                                                <?php elseif ($booking['status'] === 'completed' && $booking['has_review']): ?>
                                                    <span
                                                        class="bg-green-100 text-green-800 border border-green-300 font-medium py-1.5 px-3 text-xs rounded flex items-center">
                                                        <i class="fas fa-check-circle mr-1"></i> Review Submitted
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Cancel Booking Modal -->
    <div id="cancelModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div
            class="bg-white p-8 rounded-xl shadow-xl max-w-md w-full transform transition-all duration-300 animate-fadeIn">
            <div class="text-center mb-6">
                <div class="mx-auto rounded-full bg-red-100 w-16 h-16 flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold mb-2">Cancel Booking</h2>
                <p class="text-gray-600" id="cancelProductName"></p>
            </div>

            <p class="text-gray-700 mb-6 text-center">
                Are you sure you want to cancel this booking? This action cannot be undone.
            </p>

            <form id="cancelForm" method="post" action="" class="flex justify-center gap-3">
                <input type="hidden" id="cancelBookingId" name="booking_id">

                <button type="button" id="closeCancelModal"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors duration-300 flex-1">
                    Keep Booking
                </button>

                <button type="submit" name="cancel_booking"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300 flex-1">
                    Cancel Booking
                </button>
            </form>
        </div>
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div
            class="bg-white p-8 rounded-xl shadow-xl max-w-md w-full transform transition-all duration-300 animate-fadeIn">
            <div class="text-center mb-6">
                <div class="mx-auto rounded-full bg-yellow-100 w-16 h-16 flex items-center justify-center mb-4">
                    <i class="fas fa-star text-yellow-500 text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold mb-2">Leave a Review</h2>
                <p class="text-gray-600" id="reviewProductName"></p>
            </div>

            <form id="reviewForm" method="post" action="" class="space-y-4 text-left">
                <input type="hidden" id="reviewBookingId" name="booking_id">
                <input type="hidden" id="reviewProductId" name="product_id">

                <div>
                    <label for="rating" class="block text-gray-700 font-medium mb-1">Rating</label>
                    <div class="flex items-center space-x-2">
                        <div class="rating flex space-x-1">
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400 transition-colors duration-200"
                                data-rating="1"></i>
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400 transition-colors duration-200"
                                data-rating="2"></i>
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400 transition-colors duration-200"
                                data-rating="3"></i>
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400 transition-colors duration-200"
                                data-rating="4"></i>
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400 transition-colors duration-200"
                                data-rating="5"></i>
                        </div>
                        <span id="selectedRating" class="ml-2 font-medium">0/5</span>
                        <input type="hidden" id="rating" name="rating" value="0">
                    </div>
                </div>

                <div>
                    <label for="review_text" class="block text-gray-700 font-medium mb-1">Your Review</label>
                    <textarea name="review_text" id="review_text" rows="4" required
                        placeholder="Tell us about your experience"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" id="closeReviewModal"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                        Cancel
                    </button>
                    <button type="submit" name="submit_review" id="submitReview"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300"
                        disabled>
                        <i class="fas fa-paper-plane mr-2"></i> Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include './includes/footer.php'; ?>

    <style>
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <script>
        // Profile form validation
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('profile-form');
            if (!form) return;

            const fullName = document.getElementById('full_name');
            const phone = document.getElementById('phone');
            const currentPassword = document.getElementById('current_password');
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('confirm_password');

            const nameError = document.getElementById('nameError');
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
                if (currentPassword.value && newPassword.value.length < 6) {
                    passwordError.classList.remove('hidden');
                    newPassword.classList.add('border-red-500');
                    return false;
                } else {
                    passwordError.classList.add('hidden');
                    newPassword.classList.remove('border-red-500');
                    return true;
                }
            };

            const validateConfirmPassword = () => {
                if (currentPassword.value && newPassword.value !== confirmPassword.value) {
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
            phone.addEventListener('blur', validatePhone);
            newPassword.addEventListener('blur', validatePassword);
            confirmPassword.addEventListener('blur', validateConfirmPassword);

            form.addEventListener('submit', function (e) {
                const isNameValid = validateName();
                const isPhoneValid = validatePhone();
                let isPasswordValid = true;
                let isConfirmValid = true;

                if (currentPassword.value) {
                    isPasswordValid = validatePassword();
                    isConfirmValid = validateConfirmPassword();
                }

                if (!(isNameValid && isPhoneValid && isPasswordValid && isConfirmValid)) {
                    e.preventDefault();
                }
            });
        });

        // Cancel modal functionality
        function openCancelModal(bookingId, productName) {
            document.getElementById('cancelBookingId').value = bookingId;
            document.getElementById('cancelProductName').innerText = productName;
            document.getElementById('cancelModal').classList.remove('hidden');
        }

        document.getElementById('closeCancelModal').addEventListener('click', function () {
            document.getElementById('cancelModal').classList.add('hidden');
        });

        // Review modal functionality
        function openReviewModal(bookingId, productId, productName) {
            document.getElementById('reviewBookingId').value = bookingId;
            document.getElementById('reviewProductId').value = productId;
            document.getElementById('reviewProductName').innerText = productName;
            document.getElementById('reviewModal').classList.remove('hidden');
        }

        document.getElementById('closeReviewModal').addEventListener('click', function () {
            document.getElementById('reviewModal').classList.add('hidden');
        });

        // Star rating functionality
        const stars = document.querySelectorAll('.rating i');
        const ratingInput = document.getElementById('rating');
        const selectedRating = document.getElementById('selectedRating');
        const submitReviewBtn = document.getElementById('submitReview');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = parseInt(this.dataset.rating);
                ratingInput.value = rating;
                selectedRating.innerText = `${rating}/5`;

                // Update star colors
                stars.forEach(s => {
                    const starRating = parseInt(s.dataset.rating);
                    if (starRating <= rating) {
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                    }
                });

                // Enable submit button if rating is selected
                if (rating > 0) {
                    submitReviewBtn.disabled = false;
                }
            });
        });
    </script>
</body>

</html>