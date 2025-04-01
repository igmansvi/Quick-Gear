<?php
require_once './includes/init.php';
requireLogin();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
require_once './data/products_data.php';
require_once './data/users_data.php';
$host = "localhost";
$dbname = "quick-gear-db";
$user = "root";
$pass = "";
$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Get dashboard statistics with proper amount calculation
    $statsQuery = "SELECT 
        (SELECT COUNT(*) FROM products) as total_products,
        (SELECT COUNT(*) FROM bookings) as total_bookings,
        (SELECT COUNT(*) FROM users WHERE role != 'admin') as total_users,
        (SELECT COUNT(*) FROM bookings WHERE status = 'pending') as pending_bookings,
        COALESCE((SELECT SUM(p.price * DATEDIFF(b.end_date, b.start_date)) 
        FROM bookings b 
        JOIN products p ON b.product_id = p.id 
        WHERE b.status != 'cancelled'), 0) as total_revenue";
    $statsStmt = $pdo->query($statsQuery);
    $stats = $statsStmt->fetch();

    // Add helper function after fetching $stats
    function renderCard($title, $value, $icon, $borderClass, $bgClass, $iconColor)
    {
        ?>
        <div class="bg-white rounded-xl shadow p-6 border-t-4 <?php echo $borderClass; ?>">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700"><?php echo $title; ?></h3>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $value; ?></p>
                </div>
                <div class="<?php echo $bgClass; ?> p-3 rounded-full">
                    <i class="<?php echo $icon; ?> <?php echo $iconColor; ?> text-xl"></i>
                </div>
            </div>
        </div>
        <?php
    }

    // Handle booking status updates if form submitted
    if (isset($_POST['update_booking']) && isset($_POST['booking_id']) && isset($_POST['new_status'])) {
        $booking_id = $_POST['booking_id'];
        $new_status = $_POST['new_status'];

        $updateStmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $updateStmt->execute([$new_status, $booking_id]);

        // Redirect to prevent form resubmission
        header("Location: admin.php?status_updated=1");
        exit();
    }

    // Handle product updates
    if (isset($_POST['update_product']) && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['product_name'];
        $category = $_POST['product_category'];
        $price = $_POST['product_price'];
        $status = $_POST['product_status'];

        $updateProductStmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, price = ?, status = ? WHERE id = ?");
        $updateProductStmt->execute([$name, $category, $price, $status, $product_id]);

        // Redirect to prevent form resubmission
        header("Location: admin.php?product_updated=1");
        exit();
    }

    // Get bookings with optional date filter
    $dateFilter = "";
    $params = [];
    if (isset($_GET['date_from']) && isset($_GET['date_to'])) {
        $dateFilter = " WHERE b.start_date BETWEEN ? AND ?";
        $params = [$_GET['date_from'], $_GET['date_to']];
    }

    // Update bookings query to include rental duration and total amount
    $query = "SELECT b.*, 
              p.name AS product_name, 
              p.price AS product_price,
              u.full_name AS user_name,
              u.email AS user_email,
              DATEDIFF(b.end_date, b.start_date) as rental_days,
              (p.price * DATEDIFF(b.end_date, b.start_date)) as total_amount
              FROM bookings b 
              JOIN products p ON b.product_id = p.id 
              JOIN users u ON b.user_id = u.id
              ORDER BY b.booking_date DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $allBookings = $stmt->fetchAll();

} catch (PDOException $e) {
    error_log($e->getMessage());
    $allBookings = [];
    $stats = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Quick Gear</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="font-sans m-0 p-0 bg-gray-50">
    <?php include './includes/admin_header.php'; ?>

    <!-- Improved Navigation Tabs -->
    <nav class="bg-white shadow-sm mb-6">
        <div class="container mx-auto">
            <div class="flex gap-4 p-4">
                <button onclick="switchTab('tab-dashboard')" class="tab-btn active">Dashboard</button>
                <button onclick="switchTab('tab-products')" class="tab-btn">Products</button>
                <button onclick="switchTab('tab-bookings')" class="tab-btn">Bookings</button>
                <button onclick="switchTab('tab-users')" class="tab-btn">Users</button>
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-8 px-4">
        <!-- Dashboard Overview Section -->
        <div id="tab-dashboard" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <?php
                renderCard("Revenue", "₹" . number_format($stats['total_revenue'] ?? 0), "fas fa-indian-rupee-sign", "border-blue-500", "bg-blue-100", "text-blue-500");
                renderCard("Total Products", count($products), "fas fa-box", "border-blue-500", "bg-blue-100", "text-blue-500");
                renderCard("Total Bookings", count($allBookings), "fas fa-calendar-check", "border-green-500", "bg-green-100", "text-green-500");
                renderCard("Total Users", count($users), "fas fa-users", "border-purple-500", "bg-purple-100", "text-purple-500");
                ?>
            </div>
            <!-- Analytics Charts -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-semibold mb-4">Booking Trends</h3>
                    <canvas id="bookingTrends"></canvas>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-semibold mb-4">Revenue Overview</h3>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Enhanced Products Section -->
        <div id="tab-products" class="tab-content hidden">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Admin Dashboard</h2>
            </div>

            <!-- Dashboard Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <?php
                renderCard("Total Products", count($products), "fas fa-box", "border-blue-500", "bg-blue-100", "text-blue-500");
                renderCard("Total Bookings", count($allBookings), "fas fa-calendar-check", "border-green-500", "bg-green-100", "text-green-500");
                renderCard("Total Users", count($users), "fas fa-users", "border-purple-500", "bg-purple-100", "text-purple-500");
                ?>
            </div>

            <!-- Products Section -->
            <section class="mb-8 bg-white rounded-xl shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-bold text-gray-800">Products</h3>
                    <a href="list_item.php"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i> Add New Product
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border">ID</th>
                                <th class="py-2 px-4 border">Name</th>
                                <th class="py-2 px-4 border">Category</th>
                                <th class="py-2 px-4 border">Price</th>
                                <th class="py-2 px-4 border">Status</th>
                                <th class="py-2 px-4 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr class="text-center hover:bg-gray-50">
                                    <td class="py-1 px-2 border"><?php echo $product['id']; ?></td>
                                    <td class="py-1 px-2 border"><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td class="py-1 px-2 border"><?php echo htmlspecialchars($product['category']); ?></td>
                                    <td class="py-1 px-2 border">₹<?php echo number_format($product['price']); ?></td>
                                    <td class="py-1 px-2 border">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold <?php echo $product['status'] === 'available' ? 'bg-green-100 text-green-800': ($product['status'] === 'rented' ? 'bg-red-100 text-red-800 ' : 'bg-yellow-100 text-yellow-800'); ?>">
                                            <?php echo htmlspecialchars($product['status']); ?>
                                        </span>
                                    </td>
                                    <td class="py-1 px-2 border">
                                        <button class="text-blue-600 hover:text-blue-800 mx-1 edit-product-btn"
                                            data-product-id="<?php echo $product['id']; ?>"
                                            data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                            data-category="<?php echo htmlspecialchars($product['category']); ?>"
                                            data-price="<?php echo $product['price']; ?>"
                                            data-status="<?php echo htmlspecialchars($product['status']); ?>">
                                            <i class="fas fa-edit"></i> Update
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Product Edit Modal -->
            <div id="productEditModal"
                class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-xl p-6 w-96">
                    <h3 class="text-xl font-bold mb-4">Edit Product</h3>
                    <form action="admin.php" method="post" id="editProductForm">
                        <input type="hidden" name="product_id" id="edit-product-id">
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Name:</label>
                            <input type="text" name="product_name" id="edit-product-name"
                                class="w-full border rounded-lg px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Category:</label>
                            <input type="text" name="product_category" id="edit-product-category"
                                class="w-full border rounded-lg px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Price:</label>
                            <input type="number" name="product_price" id="edit-product-price"
                                class="w-full border rounded-lg px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Status:</label>
                            <select name="product_status" id="edit-product-status"
                                class="w-full border rounded-lg px-3 py-2">
                                <option value="available">Available</option>
                                <option value="rented">Rented</option>
                                <option value="coming_soon">Coming Soon</option>
                            </select>
                        </div>
                        <div class="flex justify-end gap-3">
                            <button type="button" id="closeProductModal"
                                class="px-4 py-2 border rounded-lg hover:bg-gray-100">Cancel</button>
                            <button type="submit" name="update_product"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- JavaScript for Product Edit Modal -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const productModal = document.getElementById('productEditModal');
                const editButtons = document.querySelectorAll('.edit-product-btn');
                const closeProductModalBtn = document.getElementById('closeProductModal');

                editButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const productId = this.getAttribute('data-product-id');
                        const name = this.getAttribute('data-name');
                        const category = this.getAttribute('data-category');
                        const price = this.getAttribute('data-price');
                        const status = this.getAttribute('data-status');

                        document.getElementById('edit-product-id').value = productId;
                        document.getElementById('edit-product-name').value = name;
                        document.getElementById('edit-product-category').value = category;
                        document.getElementById('edit-product-price').value = price;
                        document.getElementById('edit-product-status').value = status;

                        productModal.classList.remove('hidden');
                    });
                });

                closeProductModalBtn.addEventListener('click', function () {
                    productModal.classList.add('hidden');
                });
            });
        </script>

        <!-- Enhanced Bookings Section -->
        <div id="tab-bookings" class="tab-content hidden">
            <?php if (isset($_GET['status_updated'])): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>Booking status has been updated successfully.</p>
                </div>
            <?php endif; ?>
            <div class="bg-white rounded-xl shadow p-6">
                <!-- Advanced Filtering -->
                <div class="flex flex-wrap gap-4 mb-6">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" id="booking-search" placeholder="Search by product or user..."
                            class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <select id="status-filter" class="border rounded-lg px-3 py-2">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <input type="date" id="date-from" class="border rounded-lg px-3 py-2" placeholder="From Date">
                        <input type="date" id="date-to" class="border rounded-lg px-3 py-2" placeholder="To Date">
                        <button id="apply-filters"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Apply Filters
                        </button>
                        <button id="reset-filters"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                            Reset
                        </button>
                    </div>
                </div>

                <!-- Add summary stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <p class="text-sm text-blue-600">Total Bookings</p>
                        <p class="text-xl font-bold" id="total-bookings">0</p>
                    </div>
                    <div class="bg-yellow-50 p-3 rounded-lg">
                        <p class="text-sm text-yellow-600">Pending</p>
                        <p class="text-xl font-bold" id="pending-bookings">0</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <p class="text-sm text-green-600">Completed</p>
                        <p class="text-xl font-bold" id="completed-bookings">0</p>
                    </div>
                    <div class="bg-red-50 p-3 rounded-lg">
                        <p class="text-sm text-red-600">Cancelled</p>
                        <p class="text-xl font-bold" id="cancelled-bookings">0</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border">ID</th>
                                <th class="py-2 px-4 border">Product</th>
                                <th class="py-2 px-4 border">User</th>
                                <th class="py-2 px-4 border">Rental Period</th>
                                <th class="py-2 px-4 border">Status</th>
                                <th class="py-2 px-4 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allBookings as $booking): ?>
                                <tr class="text-center hover:bg-gray-50 booking-row"
                                    data-status="<?php echo htmlspecialchars($booking['status']); ?>"
                                    data-booking-date="<?php echo htmlspecialchars($booking['start_date']); ?>">
                                    <td class="py-1 px-2 border"><?php echo $booking['id']; ?></td>
                                    <td class="py-1 px-2 border">
                                        <?php echo htmlspecialchars($booking['product_name']); ?>
                                        <br>
                                        <span
                                            class="text-xs text-gray-500">₹<?php echo number_format($booking['product_price']); ?>/day</span>
                                    </td>
                                    <td class="py-1 px-2 border">
                                        <?php echo htmlspecialchars($booking['user_name']); ?><br>
                                        <span
                                            class="text-xs text-gray-500"><?php echo htmlspecialchars($booking['user_email']); ?></span>
                                    </td>
                                    <td class="py-1 px-2 border">
                                        <?php echo htmlspecialchars($booking['start_date']); ?> to
                                        <?php echo htmlspecialchars($booking['end_date']); ?>
                                        <br>
                                        <span class="text-xs text-gray-500"><?php echo $booking['rental_days']; ?>
                                            days</span>
                                    </td>
                                    <td class="py-1 px-2 border">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold <?php
                                        switch ($booking['status']) {
                                            case 'pending':
                                                echo 'bg-yellow-100 text-yellow-800';
                                                break;
                                            case 'confirmed':
                                                echo 'bg-blue-100 text-blue-800';
                                                break;
                                            case 'completed':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'cancelled':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                            <?php echo htmlspecialchars($booking['status']); ?>
                                        </span>
                                        <br>
                                        <span class="text-xs font-semibold text-gray-700">
                                            ₹<?php echo number_format($booking['total_amount']); ?>
                                        </span>
                                    </td>
                                    <td class="py-1 px-2 border">
                                        <button class="text-blue-600 hover:text-blue-800 mx-1 update-status-btn"
                                            data-booking-id="<?php echo $booking['id']; ?>"
                                            data-status="<?php echo htmlspecialchars($booking['status']); ?>">
                                            <i class="fas fa-edit"></i> Update
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const bookingSearch = document.getElementById('booking-search');
                        const statusFilter = document.getElementById('status-filter');
                        const dateFrom = document.getElementById('date-from');
                        const dateTo = document.getElementById('date-to');
                        const applyFilters = document.getElementById('apply-filters');
                        const resetFilters = document.getElementById('reset-filters');
                        const bookingRows = document.querySelectorAll('.booking-row');

                        function updateStats() {
                            let total = 0;
                            let pending = 0;
                            let completed = 0;
                            let cancelled = 0;

                            bookingRows.forEach(row => {
                                if (row.style.display !== 'none') {
                                    total++;
                                    const status = row.getAttribute('data-status');
                                    if (status === 'pending') pending++;
                                    if (status === 'completed') completed++;
                                    if (status === 'cancelled') cancelled++;
                                }
                            });

                            document.getElementById('total-bookings').textContent = total;
                            document.getElementById('pending-bookings').textContent = pending;
                            document.getElementById('completed-bookings').textContent = completed;
                            document.getElementById('cancelled-bookings').textContent = cancelled;
                        }

                        function applyAllFilters() {
                            const searchTerm = bookingSearch.value.toLowerCase();
                            const selectedStatus = statusFilter.value;
                            const startDate = dateFrom.value;
                            const endDate = dateTo.value;

                            bookingRows.forEach(row => {
                                const rowText = row.textContent.toLowerCase();
                                const rowStatus = row.getAttribute('data-status');
                                const bookingDate = row.querySelector('[data-booking-date]')?.getAttribute('data-booking-date');

                                const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
                                const matchesStatus = selectedStatus === '' || rowStatus === selectedStatus;
                                const matchesDate = (!startDate || !endDate ||
                                    (bookingDate && bookingDate >= startDate && bookingDate <= endDate));

                                row.style.display = (matchesSearch && matchesStatus && matchesDate) ? '' : 'none';
                            });

                            updateStats();
                        }

                        // Event listeners
                        applyFilters.addEventListener('click', applyAllFilters);
                        resetFilters.addEventListener('click', function () {
                            bookingSearch.value = '';
                            statusFilter.value = '';
                            dateFrom.value = '';
                            dateTo.value = '';
                            bookingRows.forEach(row => row.style.display = '');
                            updateStats();
                        });

                        // Initialize stats
                        updateStats();
                    });
                </script>
            </div>
        </div>

        <!-- Users Section with Userwise Data Showcase -->
        <div id="tab-users" class="tab-content hidden">
            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-800">Users</h3>
                <div>
                    <input type="text" id="user-filter" placeholder="Filter by name"
                        class="border rounded-lg px-3 py-1">
                    <button id="user-filter-btn" class="bg-blue-600 text-white px-4 py-1 rounded-lg hover:bg-blue-700">
                        Filter
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="user-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border">ID</th>
                            <th class="py-2 px-4 border">Name</th>
                            <th class="py-2 px-4 border">Email</th>
                            <th class="py-2 px-4 border">Phone</th>
                            <th class="py-2 px-4 border">Role</th>
                            <th class="py-2 px-4 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <?php if (isset($user['role']) && $user['role'] === 'admin')
                                continue; // Remove admin data ?>
                            <tr class="text-center hover:bg-gray-50">
                                <td class="py-1 px-2 border"><?php echo $user['id']; ?></td>
                                <td class="py-1 px-2 border"><?php echo htmlspecialchars($user['full_name']); ?></td>
                                <td class="py-1 px-2 border"><?php echo htmlspecialchars($user['email']); ?></td>
                                <td class="py-1 px-2 border"><?php echo htmlspecialchars($user['phone']); ?></td>
                                <td class="py-1 px-2 border">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        <?php echo htmlspecialchars($user['role'] ?? 'user'); ?>
                                    </span>
                                </td>
                                <td class="py-1 px-2 border">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 mx-1" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Status Update Modal -->
    <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-96">
            <h3 class="text-xl font-bold mb-4">Update Booking Status</h3>
            <form action="admin.php" method="post">
                <input type="hidden" name="booking_id" id="modal-booking-id">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Current Status:</label>
                    <span id="current-status" class="px-3 py-1 rounded-full text-sm font-semibold"></span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">New Status:</label>
                    <select name="new_status" id="new-status" class="w-full border rounded-lg px-3 py-2">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" id="closeModal" class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                        Cancel
                    </button>
                    <button type="submit" name="update_booking"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Enhanced tab switching with active state
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabId).classList.remove('hidden');
            event.target.classList.add('active');
        }

        // Initialize charts
        const bookingTrends = new Chart(
            document.getElementById('bookingTrends'),
            {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Bookings',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: 'rgb(59, 130, 246)',
                    }]
                }
            }
        );

        // Initialize flatpickr for date inputs
        flatpickr("#date-from", {});
        flatpickr("#date-to", {});

        // User Filter functionality
        document.getElementById('user-filter-btn').addEventListener('click', function () {
            const filterValue = document.getElementById('user-filter').value.toLowerCase();
            const rows = document.querySelectorAll('#user-table tbody tr');
            rows.forEach(row => {
                const nameCell = row.cells[1].textContent.toLowerCase();
                row.style.display = nameCell.includes(filterValue) ? '' : 'none';
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Status update modal
            const modal = document.getElementById('statusModal');
            const updateButtons = document.querySelectorAll('.update-status-btn');
            const closeModalBtn = document.getElementById('closeModal');

            updateButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bookingId = this.getAttribute('data-booking-id');
                    const status = this.getAttribute('data-status');

                    document.getElementById('modal-booking-id').value = bookingId;
                    const currentStatusSpan = document.getElementById('current-status');
                    currentStatusSpan.textContent = status;

                    // Apply appropriate styling to current status badge
                    currentStatusSpan.className = 'px-3 py-1 rounded-full text-sm font-semibold';
                    switch (status) {
                        case 'pending':
                            currentStatusSpan.classList.add('bg-yellow-100', 'text-yellow-800');
                            break;
                        case 'confirmed':
                            currentStatusSpan.classList.add('bg-blue-100', 'text-blue-800');
                            break;
                        case 'completed':
                            currentStatusSpan.classList.add('bg-green-100', 'text-green-800');
                            break;
                        case 'cancelled':
                            currentStatusSpan.classList.add('bg-red-100', 'text-red-800');
                            break;
                        default:
                            currentStatusSpan.classList.add('bg-gray-100', 'text-gray-800');
                    }

                    document.getElementById('new-status').value = status;
                    modal.classList.remove('hidden');
                });
            });

            closeModalBtn.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            // Filtering bookings
            const filterButton = document.getElementById('filter-button');
            const statusFilter = document.getElementById('status-filter');
            const bookingRows = document.querySelectorAll('.booking-row');

            filterButton.addEventListener('click', function () {
                const selectedStatus = statusFilter.value;
                bookingRows.forEach(row => {
                    const rowStatus = row.getAttribute('data-status');
                    if (!selectedStatus || rowStatus === selectedStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <style>
        .tab-btn {
            @apply px-4 py-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition;
        }

        .tab-btn.active {
            @apply bg-blue-500 text-white hover:bg-blue-600 hover:text-white;
        }
    </style>
</body>

</html>