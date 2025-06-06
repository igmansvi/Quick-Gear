<?php
require_once './includes/init.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once './data/products_data.php';

    if (!isset($pdo) || !($pdo instanceof PDO)) {
        error_log('PDO connection issue: PDO instance not found.');
        echo 'error';
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $message = $_POST['message'] ?? '';

    $stmt = $pdo->query("SELECT IFNULL(MAX(id), 0) + 1 AS next_id FROM bookings");
    $nextId = $stmt->fetchColumn();
    $pdo->exec("ALTER TABLE bookings AUTO_INCREMENT = $nextId");

    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, product_id, full_name, email, phone, start_date, end_date, message, status) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->execute([$user_id, $product_id, $full_name, $email, $phone, $start_date, $end_date, $message]);
    echo 'success';
    exit();
}

require_once './data/products_data.php';
include './includes/header.php';

$user_id = $_SESSION['user_id'];
$user_data = [];

try {
    require_once './data/users_data.php';
    $user_data = getUserById($user_id);
    if (!$user_data) {
        $user_data = [
            'full_name' => '',
            'email' => '',
            'phone' => ''
        ];
    }
} catch (Exception $e) {
    error_log("Error loading user data: " . $e->getMessage());
    $user_data = [
        'full_name' => '',
        'email' => '',
        'phone' => ''
    ];
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;
foreach ($products as $p) {
    if ($p['id'] === $id) {
        $product = $p;
        break;
    }
}

if (!$product):
    error_log("Product with ID $id not found.");
    ?>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Item - Quick Gear</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <main class="container mx-auto py-8">
        <p class="text-center text-red-500">Product not found.</p>
    </main>
<?php else: ?>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Item - Quick Gear</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <main class="container mx-auto py-8">
        <div
            class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 transition duration-300 hover:shadow-2xl hover:shadow-blue-300">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-center justify-center">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"
                        class="w-full h-auto rounded-xl border border-gray-200 shadow-md transition-transform duration-300 hover:scale-105">
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-4xl font-extrabold text-gray-800 mb-4"><?php echo htmlspecialchars($product['name']); ?>
                    </h2>
                    <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($product['description']); ?></p>
                    <div class="mb-4 space-y-2">
                        <p class="text-lg"><span class="font-bold text-gray-800">Rental Price:</span> <span
                                class="text-blue-600">₹<?php echo number_format($product['price']); ?></span> per
                            <?php echo $product['price_type']; ?>
                        </p>
                        <p class="text-lg"><span class="font-bold text-gray-800">Deposit:</span> <span
                                class="text-blue-600">₹<?php echo number_format($product['deposit']); ?></span></p>
                        <p class="text-lg"><span class="font-bold text-gray-800">Features:</span> <span
                                class="text-gray-600">
                                <?php echo is_array($product['features']) ? implode(', ', $product['features']) : $product['features']; ?>
                            </span></p>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-gray-50 p-4 rounded-xl shadow-inner">
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Rental Request</h3>
                <form action="#" id="rentalForm" method="post" class="space-y-4">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Full Name</label>
                        <input type="text" name="full_name" value="<?php echo htmlspecialchars($user_data['full_name']); ?>"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg <?php echo !empty($user_data['full_name']) ? 'bg-gray-100' : ''; ?>"
                            <?php echo !empty($user_data['full_name']) ? 'readonly' : ''; ?>>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg <?php echo !empty($user_data['email']) ? 'bg-gray-100' : ''; ?>"
                            <?php echo !empty($user_data['email']) ? 'readonly' : ''; ?>>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Phone</label>
                        <input type="tel" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg <?php echo !empty($user_data['phone']) ? 'bg-gray-100' : ''; ?>"
                            <?php echo !empty($user_data['phone']) ? 'readonly' : ''; ?>>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-1">Start Date</label>
                            <input type="date" name="start_date" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-1">End Date</label>
                            <input type="date" name="end_date" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Additional Message</label>
                        <textarea name="message" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition"
                            placeholder="Any special requirements?"></textarea>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 rounded-lg transition-colors duration-300">Submit
                            Request</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php endif; ?>

<div id="popup"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden opacity-0 transition-opacity duration-300">
    <div
        class="bg-white p-8 rounded-xl shadow-xl text-center max-w-sm w-full transform transition-all duration-300 scale-95">
        <h2 class="text-2xl font-bold mb-4 text-green-600">Request Received</h2>
        <p class="text-gray-700 mb-6">Thank you! Your rental request has been received.</p>
        <button id="closePopup"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition-colors duration-300">Close</button>
    </div>
</div>

<script>
    document.getElementById('rentalForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(result => {
                if (result.trim() === 'success') {
                    const popup = document.getElementById('popup');
                    popup.classList.remove('hidden');
                    setTimeout(() => {
                        popup.classList.remove('opacity-0');
                        popup.firstElementChild.classList.remove('scale-95');
                    }, 50);
                } else {
                    alert('There was an error submitting your request.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error submitting your request.');
            });
    });

    document.getElementById('closePopup').addEventListener('click', function () {
        const popup = document.getElementById('popup');
        popup.classList.add('opacity-0');
        popup.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
            popup.classList.add('hidden');
            window.location.href = 'bookings.php';
        }, 300);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.querySelector('input[name="start_date"]');
        const endDateInput = document.querySelector('input[name="end_date"]');
        
        const today = new Date();
        const todayFormatted = today.toISOString().split('T')[0];
        
        const maxDate = new Date();
        maxDate.setDate(today.getDate() + 31);
        const maxDateFormatted = maxDate.toISOString().split('T')[0];
        
        startDateInput.setAttribute('min', todayFormatted);
        startDateInput.setAttribute('max', maxDateFormatted);
        
        startDateInput.addEventListener('change', function() {
            endDateInput.setAttribute('min', this.value);
            endDateInput.setAttribute('max', maxDateFormatted);
        });
        
        document.getElementById('rentalForm').addEventListener('submit', function(e) {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            
            if (startDate < today) {
                e.preventDefault();
                alert('Start date cannot be in the past');
                return false;
            }
            
            if (startDate > maxDate) {
                e.preventDefault();
                alert('Dates must be within the next 7 days');
                return false;
            }
            
            if (endDate < startDate) {
                e.preventDefault();
                alert('End date cannot be before start date');
                return false;
            }
        });
    });
</script>

<?php include './includes/footer.php'; ?>