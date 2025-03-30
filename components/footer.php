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
        <div class="container mx-auto px-6">
            <!-- Updated grid layout: 4 columns on lg -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                <!-- About Site -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-4 text-accent border-b border-gray-700 pb-1">Quick Gear</h3>
                    <div class="flex items-center mb-3">
                        <i class="fas fa-tools text-2xl text-accent mr-2"></i>
                        <span class="text-lg font-bold">Tool Rental</span>
                    </div>
                    <p class="text-gray-300 text-xs leading-relaxed">
                        Providing quality tools and equipment for every project with competitive pricing and reliable
                        service.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-4 text-accent border-b border-gray-700 pb-1">Quick Links</h3>
                    <ul class="space-y-2 text-xs">
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                                Browse Equipment
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                                My Bookings
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                                How It Works
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-accent transition-all flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-primary mr-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                                FAQs
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Us / Newsletter -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-4 text-accent border-b border-gray-700 pb-1">Contact Us</h3>
                    <ul class="space-y-2 text-xs">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-primary mr-2 mt-1"></i>
                            <span class="text-gray-300">123 Tool Street, Equipment City, EC 12345</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt text-primary mr-2"></i>
                            <span class="text-gray-300">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-primary mr-2"></i>
                            <span class="text-gray-300">info@quickgear.com</span>
                        </li>
                    </ul>
                    <div class="mt-4">
                        <input type="email" placeholder="Your email"
                            class="w-full p-2 text-xs rounded-lg text-gray-900" />
                        <button
                            class="w-full mt-2 bg-accent text-gray-900 text-xs p-2 rounded-lg hover:bg-secondary transition-all">Subscribe</button>
                    </div>
                </div>

                <!-- Connect With Us (Social Media) -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-4 text-accent border-b border-gray-700 pb-1">Follow Us</h3>
                    <div class="grid grid-cols-4 gap-3 mb-2">
                        <a href="#"
                            class="bg-blue-800 hover:bg-blue-700 p-3 rounded-lg text-center transition-all duration-300"
                            title="Facebook">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </a>
                        <a href="#"
                            class="bg-sky-500 hover:bg-sky-400 p-3 rounded-lg text-center transition-all duration-300"
                            title="Twitter">
                            <i class="fab fa-twitter text-lg"></i>
                        </a>
                        <a href="#"
                            class="bg-pink-600 hover:bg-pink-500 p-3 rounded-lg text-center transition-all duration-300"
                            title="Instagram">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        <a href="#"
                            class="bg-blue-600 hover:bg-blue-500 p-3 rounded-lg text-center transition-all duration-300"
                            title="LinkedIn">
                            <i class="fab fa-linkedin-in text-lg"></i>
                        </a>
                    </div>
                    <p class="text-gray-300 text-xs">Stay connected</p>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="mt-12 pt-6 border-t border-gray-800">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0 text-xs">
                    <p class="text-gray-400">© 2023 Quick Gear. All rights reserved.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-accent transition-colors">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-accent transition-colors">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-accent transition-colors">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>