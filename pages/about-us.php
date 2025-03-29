<header>
    <?php include './components/header.php'; ?>
</header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../src/css/styles.css">
    <style>
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Hero Section with Parallax -->
    <section class="relative h-[500px] parallax"
        style="background-image: url('https://images.unsplash.com/photo-1504307651254-35b1a8b464c9');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center text-white max-w-3xl px-4">
                <h1 class="text-5xl font-bold mb-6">About QuickGear</h1>
                <p class="text-xl leading-relaxed">Revolutionizing equipment rental services with cutting-edge
                    technology and unmatched reliability.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-yellow-500 mb-2">500+</div>
                <div class="text-gray-600">Equipment Listed</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-yellow-500 mb-2">1000+</div>
                <div class="text-gray-600">Happy Customers</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-yellow-500 mb-2">24/7</div>
                <div class="text-gray-600">Customer Support</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-yellow-500 mb-2">5+</div>
                <div class="text-gray-600">Years Experience</div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto py-16 px-4">
        <div class="space-y-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Story</h2>
                <div class="w-20 h-1 bg-yellow-500 mx-auto"></div>
            </div>
            <p class="mb-4">
                QuickGear is a leading platform in the construction equipment rental industry, dedicated to bridging the
                gap between equipment owners and those in need of reliable machinery. Our journey began in 2023, with a
                vision to revolutionize the equipment rental space by leveraging cutting-edge digital technologies.
            </p>

            <p class="mb-4">
                Founded by industry experts with extensive experience in construction equipment, financing, and business
                operations, QuickGear aims to bring efficiency, transparency, and accessibility to the market. Our
                platform
                serves as a one-stop solution for renting and selling used construction equipment, ensuring optimal
                utilization of assets and reducing downtime for businesses.
            </p>

            <p class="mb-4">
                With the construction industry facing challenges in equipment availability and deployment, we strive to
                simplify the process by providing a seamless, hassle-free experience for both equipment owners and
                renters.
                Whether it's heavy machinery lying idle or companies in urgent need of equipment, our platform ensures
                quick
                and efficient connections.
            </p>
            <p class="mb-4">
                We currently have a presence in Phagwara, Punjab and continue to expand to serve the growing needs of
                the
                industry. For inquiries, collaborations, or investment opportunities, feel free to reach out to us at
                info@quickgears.com.
            </p>
        </div>
    </main>

    <!-- Team Section -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Leadership Team</h2>
                <div class="w-20 h-1 bg-yellow-500 mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x300" alt="Team Member" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">John Doe</h3>
                        <p class="text-gray-600">CEO & Founder</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x300" alt="Team Member" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Jane Smith</h3>
                        <p class="text-gray-600">Operations Director</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x300" alt="Team Member" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Mike Johnson</h3>
                        <p class="text-gray-600">Technical Lead</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipment Categories Section -->
    <section class="bg-gray-800 text-white py-16">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-700 p-8 rounded-lg transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold border-b border-yellow-500 pb-4 mb-6">Equipment Categories</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-600 rounded hover:bg-yellow-500 transition-colors duration-300">
                        <a href="#" class="block text-center">TECH</a>
                    </div>
                    <div class="p-4 bg-gray-600 rounded hover:bg-yellow-500 transition-colors duration-300">
                        <a href="#" class="block text-center">ELECTRIC</a>
                    </div>
                    <div class="p-4 bg-gray-600 rounded hover:bg-yellow-500 transition-colors duration-300">
                        <a href="#" class="block text-center">PLUMBING</a>
                    </div>
                    <div class="p-4 bg-gray-600 rounded hover:bg-yellow-500 transition-colors duration-300">
                        <a href="#" class="block text-center">GENERAL</a>
                    </div>
                </div>
            </div>

            <div class="bg-gray-700 p-8 rounded-lg transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold mb-4">Starting a New Project?</h2>
                <p class="text-gray-300 mb-6">Upload your equipment requirement here</p>
                <div class="flex flex-col items-center">
                    <img src="https://www.equipmentrentalsindia.com/public/img/post-requirement.png"
                        alt="Post Requirement" class="w-40 mb-6">
                    <button
                        class="w-full bg-yellow-500 text-gray-900 px-8 py-3 font-bold rounded-lg hover:bg-yellow-600 transition-colors duration-300">
                        Upload Equipment Requirement
                    </button>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <?php include './components/footer.php'; ?>
    </footer>
</body>

</html>