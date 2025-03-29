<header>
    <?php include './components/header.php'; ?>
</header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Your Equipment</title>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto my-10 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">List Your Equipment</h2>

        <form>
            <!-- Personal Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 mb-1">Full Name</label>
                    <input type="text" class="w-full p-2 border rounded" placeholder="Enter your full name">
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Email Address</label>
                    <input type="email" class="w-full p-2 border rounded" placeholder="Enter your email">
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Phone Number</label>
                    <input type="tel" class="w-full p-2 border rounded" placeholder="Enter phone number">
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Location</label>
                    <input type="text" class="w-full p-2 border rounded" placeholder="Enter location">
                </div>
            </div>

            <!-- Equipment Details -->
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-700">Equipment Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                    <div>
                        <label class="block text-gray-600 mb-1">Equipment Name</label>
                        <input type="text" class="w-full p-2 border rounded" placeholder="Enter equipment name">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Equipment Type</label>
                        <select class="w-full p-2 border rounded">
                            <option>Select Type</option>
                            <option>Tech</option>
                            <option>Electrical</option>
                            <option>Plumbing</option>
                            <option>General</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Brand</label>
                        <input type="text" class="w-full p-2 border rounded" placeholder="Enter brand name">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Model Number</label>
                        <input type="text" class="w-full p-2 border rounded" placeholder="Enter model number">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Manufacturing Year</label>
                        <input type="number" class="w-full p-2 border rounded" placeholder="Enter year">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Condition</label>
                        <select class="w-full p-2 border rounded">
                            <option>Select Condition</option>
                            <option>New</option>
                            <option>Used</option>
                            <option>Refurbished</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Usage (Hours)</label>
                        <input type="number" class="w-full p-2 border rounded" placeholder="Enter usage hours">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Price (INR)</label>
                        <input type="number" class="w-full p-2 border rounded" placeholder="Enter price">
                    </div>
                </div>
            </div>

            <!-- Upload Images -->
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-700">Upload Equipment Images</h3>
                <input type="file" class="w-full p-2 border rounded mt-3" multiple>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-center">
                <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit Listing</button>
            </div>
        </form>
    </div>

</body>

<footer>
    <?php include './components/footer.php'; ?>
</footer>

</html>