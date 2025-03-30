<?php
require_once './data/products_data.php'; // now provides $pdo and $products
include './includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $price_type = trim($_POST['price_type'] ?? '');
    $deposit = floatval($_POST['deposit'] ?? 0);
    $status = trim($_POST['status'] ?? '');
    $image = trim($_POST['image'] ?? '');
    $features = array_map('trim', explode(',', $_POST['features'] ?? ''));

    try {
        $stmt = $pdo->prepare(
            "INSERT INTO list_item (name, category, description, price, price_type, deposit, status, image, features) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $name,
            $category,
            $description,
            $price,
            $price_type,
            $deposit,
            $status,
            $image,
            implode(', ', $features)
        ]);
        $success = true;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $error_message = "Unable to add listing. Please try again later.";
    }
}
?>
<main class="container mx-auto py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">List Your Product for Rental</h2>
        <p class="text-center text-gray-600 mb-6">Please fill in the details below to list your product for rental.</p>
        <?php if (isset($success) && $success): ?>
            <!-- The success message is now handled via popup -->
        <?php endif; ?>
        <form action="list_item.php" method="post" class="space-y-6">
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="name">Product Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter product name"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="category">Category</label>
                <select name="category" id="category" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Select Category</option>
                    <?php foreach ($categories as $key => $cat): ?>
                        <option value="<?php echo $key; ?>"><?php echo $cat['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="description">Description</label>
                <textarea name="description" id="description" rows="4" required
                    placeholder="Provide a detailed description"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="price">Rental Price</label>
                    <input type="number" name="price" id="price" required placeholder="0.00"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="price_type">Price Type</label>
                    <select name="price_type" id="price_type" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="day">Per Day</option>
                        <option value="week">Per Week</option>
                        <option value="month">Per Month</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="deposit">Deposit</label>
                    <input type="number" name="deposit" id="deposit" required placeholder="0.00"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="status">Status</label>
                    <select name="status" id="status" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="available">Available</option>
                        <option value="coming_soon">Coming Soon</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="image">Image URL</label>
                    <input type="url" name="image" id="image" required placeholder="http://example.com/image.jpg"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="features">Features (comma separated)</label>
                <input type="text" name="features" id="features" required placeholder="e.g., 4K Video, Dual Pixel AF"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-300">
                    Submit Listing
                </button>
            </div>
        </form>
    </div>

    <!-- Popup Modal for Successful Listing -->
    <div id="popup"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden opacity-0 transition-opacity duration-300">
        <div
            class="bg-white p-8 rounded-xl shadow-xl text-center max-w-sm w-full transform transition-all duration-300 scale-95">
            <h2 class="text-2xl font-bold mb-4 text-green-600">Listing Submitted!</h2>
            <p class="text-gray-700 mb-6">Your product has been successfully submitted for listing.</p>
            <button id="closePopup"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition-colors duration-300">
                Close
            </button>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check for server-side success flag
        <?php if (isset($success) && $success): ?>
            const popup = document.getElementById('popup');
            popup.classList.remove('hidden');
            // Ensure transitions are triggered after class removal 
            setTimeout(() => {
                popup.classList.remove('opacity-0');
                popup.firstElementChild.classList.remove('scale-95');
            }, 50);
        <?php endif; ?>

        document.getElementById('closePopup').addEventListener('click', function () {
            const popup = document.getElementById('popup');
            popup.classList.add('opacity-0');
            popup.firstElementChild.classList.add('scale-95');
            setTimeout(() => {
                popup.classList.add('hidden');
            }, 300);
        });
    });
</script>
<?php include './includes/footer.php'; ?>