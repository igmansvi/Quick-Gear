<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://via.placeholder.com/1920x500');
        background-size: cover;
        background-position: center;
    }

    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .tab-button.active {
        background-color: #FF6B35;
        color: white;
    }

    .slider-container {
        position: relative;
        overflow: hidden;
    }

    .slider {
        display: flex;
        transition: transform 0.5s ease;
    }

    .slider-item {
        width: 33.33%;
        flex-shrink: 0;
        padding: 0.5rem;
    }

    .slider-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: #4B5563;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }
</style>

<!-- Hero Section -->
<section class="hero relative h-[500px] flex items-center justify-start">
    <div class="container mx-auto px-4">
        <div class="bg-black bg-opacity-50 p-8 rounded-lg max-w-md">
            <h1 class="text-white text-4xl font-bold mb-4">Your Equipment Rental Solution</h1>
            <p class="text-white mb-6">Rent high-quality equipment for tech, electrical, plumbing and general use.
                Easy booking, affordable rates, and reliable service.</p>
            <a href="#"
                class="bg-orange text-white px-6 py-2 rounded-lg hover:bg-dark-orange transition duration-300">Learn
                More</a>
        </div>
    </div>
</section>

<!-- Category Tabs Section -->
<section class="container mx-auto my-16 px-4">
    <h2 class="text-3xl font-bold text-center text-dark-gray mb-8">Explore Equipment Categories</h2>
    <div class="flex justify-center space-x-4 mb-8">
        <button class="tab-button bg-dark-blue text-black px-6 py-2 rounded-lg hover:bg-orange transition duration-300"
            data-tab="tech">Tech</button>
        <button class="tab-button bg-dark-blue text-black px-6 py-2 rounded-lg hover:bg-orange transition duration-300"
            data-tab="electric-plumbing">Electric & Plumbing</button>
        <button class="tab-button bg-dark-blue text-black px-6 py-2 rounded-lg hover:bg-orange transition duration-300"
            data-tab="general">General</button>
    </div>
    <div class="tab-content">
        <!-- Tech Tab -->
        <div id="tech" class="tab-pane">
            <div class="max-w-6xl mx-auto mt-10 relative slider-container">
                <!-- Slider Container -->
                <div class="slider" id="tech-slider">
                    <!-- Equipment Items -->
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzcz3PEiGbMs7JxYpdI0EjqRgEp9d--sxFAg&s"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">Laptops & Computers</h3>
                                <p class="text-gray-600 text-sm">High-performance laptops and desktops for rent.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="https://i1.adis.ws/i/canon/imageprograf_pro-1000-side-paper-colour_800x500?w=700&qlt=70"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">Printers & Scanners</h3>
                                <p class="text-gray-600 text-sm">High-quality printers and scanners for your office
                                    needs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCk9isY83BlDZJa9pSNYJwVxECfhmRdTBRlA&usqp=CAU"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">Projectors</h3>
                                <p class="text-gray-600 text-sm">HD projectors for presentations and events.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtGtMi0gI1J6O63EhWEr5wZtM8jXcMvzryjw&usqp=CAU"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">Cameras & Accessories</h3>
                                <p class="text-gray-600 text-sm">Professional DSLR and mirrorless cameras for rent.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTj_VR1_EE1sAFH5tfhPbEDNR9MH9bIMD6zzg&usqp=CAU"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">Tablets & iPads</h3>
                                <p class="text-gray-600 text-sm">Latest iPads and Android tablets for work or
                                    entertainment.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxAXdY1JXKJXwnVxOxM9ncEv7kgOW5zgTvHA&usqp=CAU"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">Gaming Consoles</h3>
                                <p class="text-gray-600 text-sm">PlayStation, Xbox, and Nintendo consoles available
                                    for rent.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="https://via.placeholder.com/400x250" alt="Network Equipment"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">Network Equipment</h3>
                                <p class="text-gray-600 text-sm">Routers, switches, and networking tools.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button class="slider-nav-btn prev-btn" data-slider="tech-slider">◀</button>
                <button class="slider-nav-btn next-btn" data-slider="tech-slider">▶</button>
            </div>
        </div>

        <!-- Electric & Plumbing Tab -->
        <div id="electric-plumbing" class="tab-pane hidden">
            <div class="max-w-6xl mx-auto mt-10 relative slider-container">
                <div class="slider" id="electric-plumbing-slider">
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover">
                            <img src="https://via.placeholder.com/400x250" alt="Electric & Plumbing Kit"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-dark-gray">Professional Combo Kit</h3>
                                <p class="text-dark-gray mb-4">Complete set of electrical and plumbing tools.</p>
                                <button
                                    class="bg-orange-500 text-black px-4 py-2 rounded-lg hover:bg-dark-orange transition duration-300">
                                    Rent Now</button>
                            </div>
                        </div>
                    </div>
                    <!-- Add 5-7 combined items -->
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover">
                            <img src="https://via.placeholder.com/400x250" alt="Power Tools"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-dark-gray">Power Tool Set</h3>
                                <p class="text-dark-gray mb-4">Electric drills, saws, and pipe wrenches.</p>
                                <button
                                    class="bg-orange-500 text-black px-4 py-2 rounded-lg hover:bg-dark-orange transition duration-300">
                                    Rent Now</button>
                            </div>
                        </div>
                    </div>
                    <!-- Add remaining items... -->
                </div>
                <button class="slider-nav-btn prev-btn" data-slider="electric-plumbing-slider">◀</button>
                <button class="slider-nav-btn next-btn" data-slider="electric-plumbing-slider">▶</button>
            </div>
        </div>

        <!-- General Tab -->
        <div id="general" class="tab-pane hidden">
            <div class="max-w-6xl mx-auto mt-10 relative slider-container">
                <div class="slider" id="general-slider">
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover">
                            <img src="https://via.placeholder.com/400x250" alt="Hand Tools"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-dark-gray">Hand Tools</h3>
                                <p class="text-dark-gray mb-4">Essential tools like hammers, screwdrivers, and
                                    pliers.</p>
                                <button
                                    class="bg-orange-500 text-black px-4 py-2 rounded-lg hover:bg-dark-orange transition duration-300">
                                    Rent Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover">
                            <img src="https://via.placeholder.com/400x250" alt="Ladders"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-dark-gray">Ladders</h3>
                                <p class="text-dark-gray mb-4">Sturdy ladders for home and industrial use.</p>
                                <button
                                    class="bg-orange-500 text-black px-4 py-2 rounded-lg hover:bg-dark-orange transition duration-300">
                                    Rent Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover">
                            <img src="https://via.placeholder.com/400x250" alt="Toolboxes"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-dark-gray">Toolboxes</h3>
                                <p class="text-dark-gray mb-4">Portable toolboxes to keep your tools organized.</p>
                                <button
                                    class="bg-orange-500 text-black px-4 py-2 rounded-lg hover:bg-dark-orange transition duration-300">
                                    Rent Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover">
                            <img src="https://via.placeholder.com/400x250" alt="Safety Equipment"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-dark-gray">Safety Equipment</h3>
                                <p class="text-dark-gray mb-4">Full range of safety equipment for all your needs.
                                </p>
                                <button
                                    class="bg-orange-500 text-black px-4 py-2 rounded-lg hover:bg-dark-orange transition duration-300">
                                    Rent Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover">
                            <img src="https://via.placeholder.com/400x250" alt="Storage Solutions"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-dark-gray">Storage Solutions</h3>
                                <p class="text-dark-gray mb-4">Temporary storage containers and units.</p>
                                <button
                                    class="bg-orange-500 text-black px-4 py-2 rounded-lg hover:bg-dark-orange transition duration-300">Rent
                                    Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden card-hover">
                            <img src="https://via.placeholder.com/400x250" alt="Cleaning Equipment"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold mb-2 text-dark-gray">Cleaning Equipment</h3>
                                <p class="text-dark-gray mb-4">Industrial cleaning tools and machines.</p>
                                <button
                                    class="bg-orange-500 text-black px-4 py-2 rounded-lg hover:bg-dark-orange transition duration-300">Rent
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="slider-nav-btn prev-btn" data-slider="general-slider">◀</button>
                <button class="slider-nav-btn next-btn" data-slider="general-slider">▶</button>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-dark-gray mb-12">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="bg-orange-500 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-2xl font-bold">1</span>
                </div>
                <h3 class="text-xl font-bold mb-3 text-dark-gray">Browse & Book</h3>
                <p class="text-dark-gray">Browse our extensive catalog of equipment and select what you need. Choose
                    your rental period and book online.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="bg-orange-500 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-2xl font-bold">2</span>
                </div>
                <h3 class="text-xl font-bold mb-3 text-dark-gray">Receive & Use</h3>
                <p class="text-dark-gray">Pick up your equipment or choose our delivery option. We'll provide
                    instructions and safety guidelines.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="bg-orange-500 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-2xl font-bold">3</span>
                </div>
                <h3 class="text-xl font-bold mb-3 text-dark-gray">Return</h3>
                <p class="text-dark-gray">Simply return the equipment when your rental period ends. Report any
                    issues through our online system.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-dark-gray mb-12">What Our Customers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <img src="https://via.placeholder.com/60x60" alt="Customer" class="rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-dark-gray">John Smith</h3>
                        <span class="text-gray-500">Construction Manager</span>
                    </div>
                </div>
                <p class="text-dark-gray">"The equipment quality is outstanding, and the booking process is simple
                    and efficient. I've been renting construction equipment for years, and RentalPro is by far the
                    best service I've used."</p>
                <div class="flex mt-3">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <img src="https://via.placeholder.com/60x60" alt="Customer" class="rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-dark-gray">Sarah Johnson</h3>
                        <span class="text-gray-500">Event Planner</span>
                    </div>
                </div>
                <p class="text-dark-gray">"I've used RentalPro for multiple events, and the tech equipment is always
                    in perfect condition. The team is responsive and accommodating, making last-minute changes
                    hassle-free."</p>
                <div class="flex mt-3">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <img src="https://via.placeholder.com/60x60" alt="Customer" class="rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-dark-gray">Michael Brown</h3>
                        <span class="text-gray-500">DIY Enthusiast</span>
                    </div>
                </div>
                <p class="text-dark-gray">"As a homeowner tackling various projects, RentalPro has been a lifesaver.
                    I don't need to buy expensive tools I'll rarely use, and their guidance has been invaluable for
                    my DIY projects."</p>
                <div class="flex mt-3">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-orange-500 py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Ready to Rent Equipment?</h2>
        <p class="text-white mb-8 max-w-2xl mx-auto">Whether you're a professional or a DIY enthusiast, we have the
            right equipment for your project. Start browsing our inventory today.</p>
        <a href="#"
            class="bg-white text-orange-500 font-bold px-8 py-3 rounded-lg hover:bg-gray-100 transition duration-300">Get
            Started</a>
    </div>
</section>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-pane');

        // Set default tab (Tech)
        document.getElementById('tech').classList.remove('hidden');
        tabButtons[0].classList.add('active');

        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                const tabId = this.getAttribute('data-tab');

                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Remove active class from all buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('active');
                });

                // Show the selected tab content
                document.getElementById(tabId).classList.remove('hidden');

                // Add active class to clicked button
                this.classList.add('active');
            });
        });

        // Slider functionality
        const sliders = document.querySelectorAll('.slider');
        const prevButtons = document.querySelectorAll('.prev-btn');
        const nextButtons = document.querySelectorAll('.next-btn');

        // Initialize sliders
        sliders.forEach(slider => {
            const items = slider.querySelectorAll('.slider-item');
            const itemWidth = items[0].offsetWidth;
            let position = 0;
            const maxPosition = items.length - 3;

            // Set initial position
            slider.style.transform = `translateX(0)`;
        });

        // Previous button click handler
        prevButtons.forEach(button => {
            button.addEventListener('click', function () {
                const sliderId = this.getAttribute('data-slider');
                const slider = document.getElementById(sliderId);
                const items = slider.querySelectorAll('.slider-item');
                const itemWidth = items[0].offsetWidth;

                // Get current position
                const transform = slider.style.transform;
                let position = transform ? parseInt(transform.match(/-?\d+/)[0]) / -itemWidth : 0;

                // Move slider
                if (position > 0) {
                    position--;
                    slider.style.transform = `translateX(${-position * itemWidth}px)`;
                }
            });
        });

        // Next button click handler
        nextButtons.forEach(button => {
            button.addEventListener('click', function () {
                const sliderId = this.getAttribute('data-slider');
                const slider = document.getElementById(sliderId);
                const items = slider.querySelectorAll('.slider-item');
                const itemWidth = items[0].offsetWidth;

                // Get current position
                const transform = slider.style.transform;
                let position = transform ? parseInt(transform.match(/-?\d+/)[0]) / -itemWidth : 0;

                // Move slider
                if (position < items.length - 3) {
                    position++;
                    slider.style.transform = `translateX(${-position * itemWidth}px)`;
                }
            });
        });
    });
</script>