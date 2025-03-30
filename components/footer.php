<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#ff8c00',
                    secondary: '#ff6300',
                    accent: '#ffdd00',
                }
            }
        }
    }
</script>

<body>
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <!-- Main Footer Content -->
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                <!-- About Site -->
                <div class="mb-8 lg:mb-0">
                    <h3 class="text-2xl font-bold mb-6 text-accent border-b border-gray-700 pb-2">Quick Gear</h3>
                    <div class="flex items-center mb-5">
                        <i class="fas fa-tools text-3xl text-accent mr-3"></i>
                        <span class="text-xl font-bold">Tool Rental</span>
                    </div>
                    <p class="text-gray-300 leading-relaxed">
                        Your one-stop solution for renting high-quality tools and equipment.
                        We provide professional gear for all your project needs at affordable rates.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="mb-8 lg:mb-0">
                    <h3 class="text-2xl font-bold mb-6 text-accent border-b border-gray-700 pb-2">Quick Links</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-3 text-xs group-hover:translate-x-1 transition-transform"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-3 text-xs group-hover:translate-x-1 transition-transform"></i>
                                Browse Equipment
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-3 text-xs group-hover:translate-x-1 transition-transform"></i>
                                My Bookings
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-3 text-xs group-hover:translate-x-1 transition-transform"></i>
                                How It Works
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-3 text-xs group-hover:translate-x-1 transition-transform"></i>
                                FAQs
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact/Location -->
                <div class="mb-8 lg:mb-0">
                    <h3 class="text-2xl font-bold mb-6 text-accent border-b border-gray-700 pb-2">Contact Us</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-primary"></i>
                            <span class="text-gray-300">123 Tool Street, Equipment City, EC 12345</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-primary"></i>
                            <span class="text-gray-300">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-primary"></i>
                            <span class="text-gray-300">info@quickgear.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-3 text-primary"></i>
                            <span class="text-gray-300">Mon-Sat: 9:00 AM - 6:00 PM</span>
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-2xl font-bold mb-6 text-accent border-b border-gray-700 pb-2">Connect With Us</h3>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <a href="#"
                            class="bg-blue-800 hover:bg-blue-700 p-3 rounded-lg text-center transition-all duration-300 flex items-center justify-center">
                            <i class="fab fa-facebook-f text-xl mr-2"></i> Facebook
                        </a>
                        <a href="#"
                            class="bg-sky-500 hover:bg-sky-400 p-3 rounded-lg text-center transition-all duration-300 flex items-center justify-center">
                            <i class="fab fa-twitter text-xl mr-2"></i> Twitter
                        </a>
                        <a href="#"
                            class="bg-pink-600 hover:bg-pink-500 p-3 rounded-lg text-center transition-all duration-300 flex items-center justify-center">
                            <i class="fab fa-instagram text-xl mr-2"></i> Instagram
                        </a>
                        <a href="#"
                            class="bg-blue-600 hover:bg-blue-500 p-3 rounded-lg text-center transition-all duration-300 flex items-center justify-center">
                            <i class="fab fa-linkedin-in text-xl mr-2"></i> LinkedIn
                        </a>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Subscribe to our newsletter for special offers and updates.
                    </p>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="mt-12 pt-6 border-t border-gray-800">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-sm text-gray-400">
                        © 2023 Quick Gear. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-sm text-gray-400 hover:text-accent transition-colors">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-accent transition-colors">Terms of
                            Service</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-accent transition-colors">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>