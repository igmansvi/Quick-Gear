<?php require_once './data/products.php'; ?>
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Renting Made Easy</h1>
        <p class="hero-subtitle">Premium Equipment Rentals. Doorstep Delivery.</p>
        <a href="#products" class="cta-button">Rent Now</a>
    </div>
    <div class="hero-gradient"></div>
</div>

<div class="product-showcase" id="products">
    <div class="container">
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

<!-- Testimonials Section -->
<div class="testimonials-section bg-gray-100 py-12">
    <div class="container mx-auto px-6">
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
                <h4 class="mt-4 font-bold text-gray-800">- Rahul Verma</h4>
            </div>
            <div class="testimonial bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600 italic">"Affordable prices and excellent customer service. Highly recommend
                    Quick Gear for any rental needs."</p>
                <h4 class="mt-4 font-bold text-gray-800">- Anjali Mehta</h4>
            </div>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div id="how-it-works" class="how-it-works-section py-12">
    <div class="container mx-auto px-6">
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

<!-- FAQs Section -->
<div id="faqs" class="faqs-section bg-gray-100 py-12">
    <div class="container mx-auto px-6">
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

<style>
    .hero-section {
        position: relative;
        height: 70vh;
        display: flex;
        align-items: center;
        background: #f8f9fa;
        color: #212529;
        overflow: hidden;
        padding: 0 5%;
    }

    .hero-gradient {
        position: absolute;
        top: 0;
        right: 0;
        width: 60%;
        height: 100%;
        background: linear-gradient(to left, rgba(67, 97, 238, 0.15), rgba(255, 255, 255, 0));
        z-index: 1;
        clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);
    }

    .hero-content {
        position: relative;
        text-align: left;
        max-width: 500px;
        z-index: 2;
        animation: fadeIn 1.2s ease-out;
        margin-right: auto;
    }

    .hero-title {
        font-size: 3.2rem;
        font-weight: 500;
        letter-spacing: 1px;
        margin-bottom: 0.8rem;
        background: linear-gradient(90deg, #2b2d42, #4361ee);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 0px 2px 10px rgba(0, 0, 0, 0.05);
    }

    .hero-subtitle {
        font-size: 1.1rem;
        margin-bottom: 2rem;
        opacity: 0.8;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    .cta-button {
        display: inline-block;
        padding: 10px 28px;
        font-size: 0.9rem;
        font-weight: 400;
        color: #fff;
        background: linear-gradient(135deg, #3a86ff 0%, #4361ee 100%);
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 3px 12px rgba(67, 97, 238, 0.3);
    }

    .cta-button:hover {
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        transform: translateY(-2px);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.8rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .hero-gradient {
            width: 50%;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2.2rem;
        }

        .hero-gradient {
            width: 40%;
            opacity: 0.7;
        }

        .hero-section {
            padding: 0 7%;
        }
    }

    /* Redesigned Product Showcase Section */
    .product-showcase {
        padding: 5rem 0;
        background-color: #fafafa;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header h2 {
        font-size: 2rem;
        font-weight: 600;
        color: #2b2d42;
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
    }

    .section-header h2:after {
        content: "";
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, #4361ee, #3a86ff);
        border-radius: 2px;
    }

    .section-header p {
        color: #6c757d;
        font-size: 1.1rem;
        font-weight: 300;
        max-width: 600px;
        margin: 1rem auto 0;
    }

    /* Category Filter */
    .category-filter {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 2.5rem;
    }

    .filter-btn {
        padding: 8px 18px;
        border: none;
        background: #f1f3f5;
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        border-radius: 30px;
        transition: all 0.25s ease;
    }

    .filter-btn:hover {
        color: #4361ee;
        background-color: #e9ecef;
    }

    .filter-btn.active {
        background: linear-gradient(135deg, #3a86ff 0%, #4361ee 100%);
        color: #fff;
        box-shadow: 0 3px 8px rgba(67, 97, 238, 0.25);
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 3rem;
    }

    /* Product Item */
    .product-item {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .product-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .product-item:hover .product-image img {
        transform: scale(1.05);
    }

    .badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        background: #4361ee;
    }

    .badge.new {
        background: #4361ee;
    }

    .badge.sale {
        background: #ff6b6b;
    }

    .product-details {
        padding: 1.2rem;
    }

    .product-details h3 {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 8px 0;
        color: #2b2d42;
    }

    .product-details p {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #f1f3f5;
        padding-top: 12px;
    }

    .price {
        font-weight: 600;
        color: #2b2d42;
        font-size: 1.05rem;
    }

    .price .original {
        text-decoration: line-through;
        color: #adb5bd;
        font-weight: 400;
        margin-right: 8px;
        font-size: 0.9rem;
    }

    .details-link {
        color: #4361ee;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
        position: relative;
    }

    .details-link:after {
        content: "→";
        display: inline-block;
        margin-left: 4px;
        transition: transform 0.2s;
    }

    .details-link:hover {
        color: #3a86ff;
    }

    .details-link:hover:after {
        transform: translateX(3px);
    }

    /* View All Button */
    .view-all {
        text-align: center;
        margin-top: 1rem;
    }

    .view-all-btn {
        display: inline-block;
        padding: 12px 28px;
        background-color: transparent;
        color: #2b2d42;
        border: 2px solid #e9ecef;
        border-radius: 30px;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .view-all-btn:hover {
        background-color: #2b2d42;
        color: white;
        border-color: #2b2d42;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
    }

    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: 1fr;
        }

        .category-filter {
            flex-direction: row;
            overflow-x: auto;
            padding-bottom: 10px;
            justify-content: flex-start;
        }

        .filter-btn {
            flex: 0 0 auto;
        }

        .section-header h2 {
            font-size: 1.8rem;
        }
    }

    .testimonials-section .testimonial {
        text-align: center;
    }

    .how-it-works-section .step .icon {
        font-size: 1.5rem;
    }

    .faqs-section .faq-item h4 {
        margin-bottom: 0.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const heroSection = document.querySelector('.hero-section');
        const heroContent = document.querySelector('.hero-content');
        const heroGradient = document.querySelector('.hero-gradient');

        // Parallax effect for gradient
        heroSection.addEventListener('mousemove', (e) => {
            const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
            heroGradient.style.transform = `translateX(${moveX}px)`;

            // Subtle shadow effect on title
            const heroTitle = document.querySelector('.hero-title');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            heroTitle.style.textShadow = `${(x - 0.5) * 5}px ${(y - 0.5) * 5}px 10px rgba(0,0,0,0.03)`;
        });

        // Restore default state when mouse leaves
        heroSection.addEventListener('mouseleave', () => {
            heroGradient.style.transform = 'translateX(0)';
            const heroTitle = document.querySelector('.hero-title');
            heroTitle.style.textShadow = '0px 2px 10px rgba(0,0,0,0.05)';
        });

        // Category filter functionality - simplified
        const filterBtns = document.querySelectorAll('.filter-btn');
        const productItems = document.querySelectorAll('.product-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active button
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                // Filter products with smooth transitions
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

        // Initial setup
        productItems.forEach(item => {
            item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        });

        // Intersection Observer for fade-in effect
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        // Set initial state and observe each product
        productItems.forEach(item => {
            item.style.opacity = 0;
            item.style.transform = 'translateY(20px)';
            observer.observe(item);
        });

        // Add city selection dropdown functionality
        const citySelector = document.getElementById('city-selector');
        if (citySelector) {
            citySelector.addEventListener('change', function () {
                // Here you would typically filter products by city availability
                const selectedCity = this.value;
                console.log(`Selected city: ${selectedCity}`);
                // Additional city filtering logic would go here
            });
        }
    });
</script>