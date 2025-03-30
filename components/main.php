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
            <button class="filter-btn" data-category="electric">Home Appliances</button>
            <button class="filter-btn" data-category="tools">Event Equipment</button>
        </div>

        <div class="product-grid">
            <!-- Electronics Category -->
            <div class="product-item" data-category="tech">
                <div class="product-image">
                    <img src="https://placehold.co/400x300/4361ee/ffffff?text=DSLR+Camera" alt="DSLR Camera">
                    <span class="badge new">New</span>
                </div>
                <div class="product-details">
                    <h3>DSLR Camera</h3>
                    <p>Professional Canon 5D Mark IV with lens kit</p>
                    <div class="product-meta">
                        <span class="price">₹999/day</span>
                        <a href="browse.php?id=1" class="details-link">View Details</a>
                    </div>
                </div>
            </div>

            <div class="product-item" data-category="tech">
                <div class="product-image">
                    <img src="https://placehold.co/400x300/4361ee/ffffff?text=PlayStation+5" alt="PlayStation 5">
                </div>
                <div class="product-details">
                    <h3>PlayStation 5</h3>
                    <p>Gaming console with 2 controllers and 3 games</p>
                    <div class="product-meta">
                        <span class="price">₹499/day</span>
                        <a href="browse.php?id=2" class="details-link">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Home Appliances Category -->
            <div class="product-item" data-category="electric">
                <div class="product-image">
                    <img src="https://placehold.co/400x300/ff6b6b/ffffff?text=Air+Conditioner" alt="Air Conditioner">
                    <span class="badge sale">Popular</span>
                </div>
                <div class="product-details">
                    <h3>Air Conditioner</h3>
                    <p>1.5 Ton Split AC with installation support</p>
                    <div class="product-meta">
                        <span class="price"><span class="original">₹1200/month</span> ₹999/month</span>
                        <a href="browse.php?id=3" class="details-link">View Details</a>
                    </div>
                </div>
            </div>

            <div class="product-item" data-category="electric">
                <div class="product-image">
                    <img src="https://placehold.co/400x300/ff6b6b/ffffff?text=Refrigerator" alt="Refrigerator">
                </div>
                <div class="product-details">
                    <h3>Double Door Refrigerator</h3>
                    <p>250L capacity with energy saving technology</p>
                    <div class="product-meta">
                        <span class="price">₹1500/month</span>
                        <a href="browse.php?id=4" class="details-link">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Event Equipment Category -->
            <div class="product-item" data-category="tools">
                <div class="product-image">
                    <img src="https://placehold.co/400x300/2b2d42/ffffff?text=Sound+System" alt="Sound System">
                </div>
                <div class="product-details">
                    <h3>DJ Sound System</h3>
                    <p>Professional audio setup for events and parties</p>
                    <div class="product-meta">
                        <span class="price">₹3500/day</span>
                        <a href="browse.php?id=5" class="details-link">View Details</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="view-all">
            <a href="rentals.php" class="view-all-btn">View All Rentals</a>
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