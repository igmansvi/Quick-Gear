<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once './data/products_data.php';

    if (!isset($pdo) || !($pdo instanceof PDO)) {
        error_log('PDO connection issue: PDO instance not found.');
        echo 'error';
        exit();
    }

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $user_id = 0;
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $message = $_POST['message'] ?? '';

    // Ensure the bookings table has all required fields
    try {
        // Check if the bookings table has the necessary columns
        $stmt = $pdo->query("SHOW COLUMNS FROM bookings LIKE 'full_name'");
        $hasFullName = $stmt->rowCount() > 0;

        if (!$hasFullName) {
            // Add the missing columns to the bookings table
            $pdo->exec("ALTER TABLE bookings 
                ADD COLUMN full_name VARCHAR(255) NOT NULL AFTER product_id,
                ADD COLUMN email VARCHAR(255) NOT NULL AFTER full_name,
                ADD COLUMN phone VARCHAR(50) NOT NULL AFTER email,
                ADD COLUMN message TEXT AFTER end_date");
        }

        // Insert directly into bookings table with all fields
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, product_id, full_name, email, phone, start_date, end_date, message, status) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([$user_id, $product_id, $full_name, $email, $phone, $start_date, $end_date, $message]);
        echo 'success';
    } catch (PDOException $e) {
        error_log("Insert error: " . $e->getMessage());
        echo 'error';
    }
    exit();
}

require_once './data/products_data.php';
include './includes/header.php';

$user_id = 0;
$user_data = [
    'full_name' => '',
    'email' => '',
    'phone' => ''
];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $user_data = [
            'full_name' => $user['full_name'] ?? '',
            'email' => $user['email'] ?? '',
            'phone' => $user['phone'] ?? ''
        ];
    }
} catch (PDOException $e) {
    error_log("Error retrieving user data: " . $e->getMessage());
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
    <main class="container mx-auto py-8">
        <p class="text-center text-red-500">Product not found.</p>
    </main>
<?php else: ?>
    <main class="container mx-auto py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 transition transform hover:scale-105">
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
                    <input type="hidden" name="user_id" value="0">

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
</script>

<?php include './includes/footer.php'; ?>