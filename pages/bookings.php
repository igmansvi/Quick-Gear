<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - QuickGear</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body class="bg-gray-100 text-gray-800">
    <header>
        <?php include './components/header.php'; ?>
    </header>
    <!-- Main Container -->
    <div class="container mx-auto mt-6 px-4 flex flex-col md:flex-row gap-6">
        <!-- Refine Listings -->
        <aside class="w-full md:w-1/4 bg-white p-6 shadow-lg rounded-lg">
            <h2 class="text-xl font-bold mb-4">Refine Listings</h2>

            <!-- Categories -->
            <div class="mb-4">
                <label class="block font-bold">By Categories</label>
                <select class="w-full border p-2 rounded-lg">
                    <option>Please Select</option>
                    <option>Tech</option>
                    <option>Electric</option>
                    <option>Plumbing</option>
                    <option>General</option>
                </select>
            </div>

            <!-- Select Zone -->
            <div class="mb-4">
                <label class="block font-bold">Select Zone</label>
                <select class="w-full border p-2 rounded-lg">
                    <option>Please Select</option>
                    <option>North</option>
                    <option>South</option>
                    <option>East</option>
                    <option>West</option>
                </select>
            </div>

            <!-- Equipment Type -->
            <div class="mb-4">
                <label class="block font-bold">Equipment Type</label>
                <select class="w-full border p-2 rounded-lg">
                    <option>Please Select</option>
                    <option>Excavator</option>
                    <option>Tractor</option>
                    <option>Compactor</option>
                </select>
            </div>

            <!-- Usage (Hours) -->
            <div class="mb-4">
                <label class="block font-bold">Usage (Hours)</label>
                <input type="text" class="w-full border p-2 rounded-lg" placeholder="Enter Usage Hours">
                <button class="w-full bg-orange-500 text-white py-2 mt-2 rounded-lg">Go</button>
            </div>

            <!-- Search by Name -->
            <div class="mb-4">
                <label class="block font-bold">Enter Equipment Name</label>
                <input type="text" class="w-full border p-2 rounded-lg" placeholder="Enter Equipment Name">
                <button class="w-full bg-orange-500 text-white py-2 mt-2 rounded-lg">Search</button>
            </div>
        </aside>

        <!-- Equipment Listings -->
        <section class="w-full md:w-3/4">
            <h2 class="text-2xl font-bold mb-4">Browse Equipment List</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Equipment Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300" alt="Equipment" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="text-red-500 text-sm font-bold">🔥 Hot Deal</span>
                        <h3 class="text-lg font-bold">Mahindra Grader</h3>
                        <p class="text-sm">ID: ERI-210320252601</p>
                        <p class="text-sm">Excellent condition G90 Grader available for sale</p>
                        <p class="text-sm text-gray-500">By Equipment-Rentals-India | 21 Mar 2025</p>
                        <div class="mt-3 flex justify-between">
                            <button class="bg-gray-200 px-4 py-2 rounded-lg">Add to Watchlist</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Equipment Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300" alt="Equipment" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="text-red-500 text-sm font-bold">🔥 Hot Deal</span>
                        <h3 class="text-lg font-bold">HAMM Soil Compactor</h3>
                        <p class="text-sm">ID: ERI-210320252599</p>
                        <p class="text-sm">Very Good condition HAMM Soil Compactor</p>
                        <p class="text-sm text-gray-500">By Equipment-Rentals-India | 21 Mar 2025</p>
                        <div class="mt-3 flex justify-between">
                            <button class="bg-gray-200 px-4 py-2 rounded-lg">Add to Watchlist</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Equipment Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300" alt="Equipment" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="text-red-500 text-sm font-bold">🔥 Hot Deal</span>
                        <h3 class="text-lg font-bold">Caterpillar Excavator</h3>
                        <p class="text-sm">ID: ERI-210320252603</p>
                        <p class="text-sm">Well-maintained excavator, ready for use</p>
                        <p class="text-sm text-gray-500">By Equipment-Rentals-India | 21 Mar 2025</p>
                        <div class="mt-3 flex justify-between">
                            <button class="bg-gray-200 px-4 py-2 rounded-lg">Add to Watchlist</button>
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <?php include './components/footer.php'; ?>
    </footer>
</body>

</html>