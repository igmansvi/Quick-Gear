<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Categories - QuickGear</title>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body class="bg-gray-100">
    <header>
        <?php include './components/header.php'; ?>
    </header>

    <!-- Hero Section -->
    <section class="bg-gray-800 text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Equipment Categories</h1>
            <p class="text-xl text-gray-300">Browse our wide range of equipment available for rent</p>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Tech Equipment Category -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97" alt="Tech Equipment"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-xl font-bold">Tech Equipment</h3>
                        <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">24 Items</span>
                    </div>
                    <p class="text-gray-600 mb-4">Laptops, Projectors, Printers, and more</p>
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Popular Items:</h4>
                        <ul class="text-gray-600 text-sm">
                            <li>• MacBook Pro</li>
                            <li>• HP LaserJet Printers</li>
                            <li>• Epson Projectors</li>
                        </ul>
                    </div>
                    <a href="make-booking.php?category=tech"
                        class="block text-center bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition duration-300">
                        Rent Now
                    </a>
                </div>
            </div>

            <!-- Electric & Plumbing Equipment Category -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4"
                    alt="Electric & Plumbing Equipment" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-xl font-bold">Electric & Plumbing</h3>
                        <span class="bg-purple-100 text-purple-800 text-sm px-3 py-1 rounded-full">44 Items</span>
                    </div>
                    <p class="text-gray-600 mb-4">Power Tools, Pipe Tools, Testing Equipment</p>
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Popular Items:</h4>
                        <ul class="text-gray-600 text-sm">
                            <li>• Professional Combo Kit</li>
                            <li>• Power Tool Set</li>
                            <li>• Pipe Installation Tools</li>
                            <li>• Testing Equipment</li>
                            <li>• Pressure & Voltage Tools</li>
                        </ul>
                    </div>
                    <a href="make-booking.php?category=electric-plumbing"
                        class="block text-center bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition duration-300">
                        Rent Now
                    </a>
                </div>
            </div>

            <!-- General Equipment Category -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1530124566582-a618bc2615dc" alt="General Equipment"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-xl font-bold">General</h3>
                        <span class="bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full">42 Items</span>
                    </div>
                    <p class="text-gray-600 mb-4">Hand Tools, Ladders, Safety Equipment</p>
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Popular Items:</h4>
                        <ul class="text-gray-600 text-sm">
                            <li>• Tool Sets</li>
                            <li>• Extension Ladders</li>
                            <li>• Safety Harnesses</li>
                        </ul>
                    </div>
                    <a href="make-booking.php?category=general"
                        class="block text-center bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition duration-300">
                        Rent Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Help Section -->
    <section class="bg-gray-800 text-white py-12 mt-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Need Help Choosing Equipment?</h2>
            <p class="mb-8">Our equipment experts are here to help you find the right tools for your project</p>
            <a href="contact.php"
                class="bg-orange-500 text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition duration-300">
                Contact Us
            </a>
        </div>
    </section>

    <footer>
        <?php include './components/footer.php'; ?>
    </footer>
</body>

</html>