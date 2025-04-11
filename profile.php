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

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">My Profile</h1>

        <?php if (!empty($success_message)): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p><?php echo $success_message; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <p><?php echo $error_message; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Information -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold mb-4 pb-2 border-b">Personal Information</h2>
                    <form method="post" action="" class="space-y-4" id="profile-form">
                        <div>
                            <label for="full_name" class="block text-gray-700 font-medium mb-1">Full Name</label>
                            <input type="text" id="full_name" name="full_name"
                                value="<?php echo htmlspecialchars($user_data['full_name'] ?? ''); ?>"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                            <p id="nameError" class="text-red-500 text-xs mt-1 hidden">Name must be at least 3
                                characters</p>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-1">Email Address</label>
                            <input type="email" id="email" name="email" readonly
                                value="<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>"
                                class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                            <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                        </div>

                        <div>
                            <label for="phone" class="block text-gray-700 font-medium mb-1">Phone Number</label>
                            <input type="tel" id="phone" name="phone"
                                value="<?php echo htmlspecialchars($user_data['phone'] ?? ''); ?>"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                            <p id="phoneError" class="text-red-500 text-xs mt-1 hidden">Please enter a valid 10-digit
                                phone number</p>
                        </div>

                        <div class="border-t pt-4 mt-4">
                            <h3 class="font-medium mb-2">Change Password (Optional)</h3>

                            <div>
                                <label for="current_password" class="block text-gray-700 font-medium mb-1">Current
                                    Password</label>
                                <input type="password" id="current_password" name="current_password"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="new_password" class="block text-gray-700 font-medium mb-1">New
                                    Password</label>
                                <input type="password" id="new_password" name="new_password"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                <p id="passwordError" class="text-red-500 text-xs mt-1 hidden">Password must be at least
                                    6 characters</p>
                            </div>

                            <div>
                                <label for="confirm_password" class="block text-gray-700 font-medium mb-1">Confirm New
                                    Password</label>
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                <p id="confirmError" class="text-red-500 text-xs mt-1 hidden">Passwords do not match</p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" name="update_profile"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bookings Section -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold mb-4 pb-2 border-b">My Bookings</h2>

                    <?php if (empty($bookings)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-gray-400 text-4xl mb-3"></i>
                            <p class="text-gray-500">You don't have any bookings yet.</p>
                            <a href="browse.php"
                                class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                                Browse Equipment
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-6">
                            <?php foreach ($bookings as $booking): ?>
                                <?php
                                $statusColor = ($booking['status'] === 'completed') ? 'bg-green-100 text-green-800' :
                                    (($booking['status'] === 'pending') ? 'bg-yellow-100 text-yellow-800' :
                                        (($booking['status'] === 'confirmed') ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800'));
                                ?>
                                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow duration-300">
                                    <div class="flex flex-col md:flex-row gap-4">
                                        <div class="w-full md:w-1/4">
                                            <img src="<?php echo htmlspecialchars($booking['product_image']); ?>"
                                                alt="<?php echo htmlspecialchars($booking['product_name']); ?>"
                                                class="w-full h-32 object-cover rounded-lg">
                                        </div>
                                        <div class="w-full md:w-3/4">
                                            <div class="flex justify-between items-start mb-2">
                                                <h3 class="text-lg font-bold">
                                                    <?php echo htmlspecialchars($booking['product_name']); ?></h3>
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold <?php echo $statusColor; ?>">
                                                    <?php echo ucfirst(htmlspecialchars($booking['status'])); ?>
                                                </span>
                                            </div>

                                            <p class="text-sm text-gray-600">Booking ID: #<?php echo $booking['id']; ?></p>
                                            <p class="text-sm text-gray-600">
                                                From <?php echo htmlspecialchars($booking['start_date']); ?>
                                                to <?php echo htmlspecialchars($booking['end_date']); ?>
                                            </p>
                                            <p class="text-sm text-gray-600 mb-3">
                                                Price: ₹<?php echo number_format($booking['product_price']); ?>/day
                                            </p>

                                            <div class="flex flex-wrap gap-2 mt-2">
                                                <?php if ($booking['status'] === 'pending'): ?>
                                                    <form method="post" action=""
                                                        onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                        <input type="hidden" name="booking_id"
                                                            value="<?php echo $booking['id']; ?>">
                                                        <button type="submit" name="cancel_booking"
                                                            class="bg-red-600 hover:bg-red-700 text-white font-medium py-1 px-3 text-xs rounded transition-colors duration-300">
                                                            Cancel Booking
                                                        </button>
                                                    </form>
                                                <?php elseif ($booking['status'] === 'completed' && !$booking['has_review']): ?>
                                                    <button
                                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-1 px-3 text-xs rounded transition-colors duration-300"
                                                        onclick="openReviewModal(<?php echo $booking['id']; ?>, <?php echo $booking['product_id']; ?>, '<?php echo htmlspecialchars($booking['product_name']); ?>')">
                                                        Leave Review
                                                    </button>
                                                <?php elseif ($booking['status'] === 'completed' && $booking['has_review']): ?>
                                                    <span class="bg-green-100 text-green-800 font-medium py-1 px-3 text-xs rounded">
                                                        Review Submitted
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

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div
            class="bg-white p-8 rounded-xl shadow-xl text-center max-w-md w-full transform transition-all duration-300">
            <h2 class="text-2xl font-bold mb-4">Leave a Review</h2>
            <p class="text-gray-600 mb-4" id="reviewProductName"></p>

            <form id="reviewForm" method="post" action="" class="space-y-4 text-left">
                <input type="hidden" id="reviewBookingId" name="booking_id">
                <input type="hidden" id="reviewProductId" name="product_id">

                <div>
                    <label for="rating" class="block text-gray-700 font-medium mb-1">Rating</label>
                    <div class="flex items-center space-x-2">
                        <div class="rating flex">
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400" data-rating="1"></i>
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400" data-rating="2"></i>
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400" data-rating="3"></i>
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400" data-rating="4"></i>
                            <i class="fas fa-star text-2xl cursor-pointer hover:text-yellow-400" data-rating="5"></i>
                        </div>
                        <span id="selectedRating" class="ml-2">0/5</span>
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
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include './includes/footer.php'; ?>

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