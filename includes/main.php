<?php require_once './data/products_data.php'; ?>
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Renting Made Easy</h1>
        <p class="hero-subtitle">Premium Equipment Rentals. Doorstep Delivery.</p>
        <a href="#products" class="cta-button">Rent Now</a>
    </div>
    <div class="hero-gradient">
        <i class="fa fa-camera doodle"></i>
        <i class="fa fa-tools doodle"></i>
        <i class="fa fa-laptop doodle"></i>
        <i class="fa fa-headphones doodle"></i>
        <i class="fa fa-microphone doodle"></i>
        <i class="fa fa-video doodle"></i>
    </div>
</div>

<div class="product-showcase" id="products">
    <div class="container px-48">
        <div class="section-header">
            <h2>Rental Collection</h2>
            <p>Quality equipment for rent at affordable prices across major Indian cities</p>
        </div>

        <div class="category-filter">
            <button class="filter-btn active" data-category="all">All</button>
            <button class="filter-btn" data-category="tech">Electronics</button>
            <button class="filter-btn" data-category="tools">Tools</button>
            <button class="filter-btn" data-category="events">Event Equipment</button>
        </div>

        <div class="product-grid">
            <?php foreach (array_slice($products, 0, 6) as $product): ?>
                <div class="product-item" data-category="<?php echo htmlspecialchars($product['category']); ?>">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <?php if ($product['status'] === 'available'): ?>
                            <span class="badge new">Available</span>
                        <?php elseif ($product['status'] === 'coming_soon'): ?>
                            <span class="badge sale">Coming Soon</span>
                        <?php elseif ($product['status'] === 'rented'): ?>
                            <span class="badge over">Rented</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-details">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="product-meta">
                            <span
                                class="price">₹<?php echo number_format($product['price']); ?>/<?php echo htmlspecialchars($product['price_type']); ?></span>
                            <a href="browse.php?id=<?php echo $product['id']; ?>" class="details-link">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="view-all">
            <a href="browse.php" class="view-all-btn">View All Rentals</a>
        </div>
    </div>
</div>

<div class="testimonials-section bg-gray-100 py-12">
    <div class="container mx-auto px-12">
        <div class="section-header text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">What Our Customers Say</h2>
            <p class="text-gray-600">Hear from our happy customers</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="testimonial bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600 italic">"Quick Gear made my event planning so much easier. The equipment was
                    top-notch and delivered on time!"</p>
                <h4 class="mt-4 font-bold text-gray-800">- Priya Sharma</h4>
            </div>
            <div class="testimonial bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600 italic">"I rented a DSLR camera for my vacation. The process was seamless, and
                    the camera worked perfectly."</p>
                <h4 class="mt-4 font-bold text-gray-800">- Kiran</h4>
            </div>
            <div class="testimonial bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600 italic">"Affordable prices and excellent customer service. Highly recommend
                    Quick Gear for any rental needs."</p>
                <h4 class="mt-4 font-bold text-gray-800">- Varun Jamwal</h4>
            </div>
        </div>
    </div>
</div>

<div id="how-it-works" class="how-it-works-section py-12">
    <div class="container mx-auto px-12">
        <div class="section-header text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">How It Works</h2>
            <p class="text-gray-600">Renting made simple in just three steps</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="step">
                <div
                    class="icon bg-blue-600 text-white w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-search text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800">Browse</h4>
                <p class="text-gray-600">Explore our collection of premium equipment.</p>
            </div>
            <div class="step">
                <div
                    class="icon bg-blue-600 text-white w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800">Book</h4>
                <p class="text-gray-600">Select your dates and confirm your booking.</p>
            </div>
            <div class="step">
                <div
                    class="icon bg-blue-600 text-white w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-truck text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-800">Receive</h4>
                <p class="text-gray-600">Get your equipment delivered to your doorstep.</p>
            </div>
        </div>
    </div>
</div>

<div id="faqs" class="faqs-section bg-gray-100 py-12">
    <div class="container mx-auto px-12">
        <div class="section-header text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Frequently Asked Questions</h2>
            <p class="text-gray-600">Find answers to common questions</p>
        </div>
        <div class="faq-list">
            <div class="faq-item mb-6">
                <h4 class="font-bold text-gray-800">What is the rental process?</h4>
                <p class="text-gray-600">Browse our collection, book your desired equipment, and get it delivered to
                    your location.</p>
            </div>
            <div class="faq-item mb-6">
                <h4 class="font-bold text-gray-800">What are the payment options?</h4>
                <p class="text-gray-600">We accept all major credit/debit cards, UPI, and net banking.</p>
            </div>
            <div class="faq-item mb-6">
                <h4 class="font-bold text-gray-800">Is there a security deposit?</h4>
                <p class="text-gray-600">Yes, a refundable security deposit is required for most rentals.</p>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const heroSection = document.querySelector('.hero-section');
        const heroContent = document.querySelector('.hero-content');
        const heroGradient = document.querySelector('.hero-gradient');

        heroSection.addEventListener('mousemove', (e) => {
            const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
            heroGradient.style.transform = `translateX(${moveX}px)`;

            const heroTitle = document.querySelector('.hero-title');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            heroTitle.style.textShadow = `${(x - 0.5) * 5}px ${(y - 0.5) * 5}px 10px rgba(0,0,0,0.03)`;
        });

        heroSection.addEventListener('mouseleave', () => {
            heroGradient.style.transform = 'translateX(0)';
            const heroTitle = document.querySelector('.hero-title');
            heroTitle.style.textShadow = '0px 2px 10px rgba(0,0,0,0.05)';
        });

        const filterBtns = document.querySelectorAll('.filter-btn');
        const productItems = document.querySelectorAll('.product-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const category = btn.getAttribute('data-category');

                productItems.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = 1;
                            item.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        item.style.opacity = 0;
                        item.style.transform = 'translateY(10px)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        productItems.forEach(item => {
            item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        productItems.forEach(item => {
            item.style.opacity = 0;
            item.style.transform = 'translateY(20px)';
            observer.observe(item);
        });

        const citySelector = document.getElementById('city-selector');
        if (citySelector) {
            citySelector.addEventListener('change', function () {
                const selectedCity = this.value;
                console.log(`Selected city: ${selectedCity}`);
            });
        }

        const doodles = document.querySelectorAll('.doodle');
        doodles.forEach(doodle => {
            doodle.addEventListener('animationiteration', () => {
                const randomX = Math.random() * 20 - 10;
                const randomRotate = Math.random() * 20 - 10;
                doodle.style.transform = `translateX(${randomX}px) rotate(${randomRotate}deg)`;
            });
        });
    });
</script>