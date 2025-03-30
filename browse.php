<?php require_once './data/products.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Equipment - Quick Gear</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans m-0 p-0 box-border">
    <?php include './components/header.php'; ?>

    <main class="container mx-auto px-4 py-8">
        <!-- Enhanced Search and Filter Section with smoother transitions and shadow improvements -->
        <div
            class="mb-8 bg-white rounded-2xl shadow-lg p-6 border border-gray-100 transition-all duration-500 hover:shadow-2xl">
            <div class="flex flex-col gap-6">
                <!-- Title and Search Bar -->
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Browse Equipment</h2>
                    <div class="w-full md:w-1/3 relative">
                        <input type="text" id="search" placeholder="Search equipment..." class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl 
                                   focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   pl-12 text-gray-600 placeholder-gray-400">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Enhanced Filters -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select id="category-filter" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl
                                   appearance-none cursor-pointer hover:bg-gray-100 transition-colors">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $key => $category): ?>
                                <option value="<?php echo $key; ?>">
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-4 top-[calc(50%+0.5rem)] text-gray-400 pointer-events-none"></i>
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Availability</label>
                        <select id="availability-filter" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl
                                   appearance-none cursor-pointer hover:bg-gray-100 transition-colors">
                            <option value="">All Status</option>
                            <option value="available">Available Now</option>
                            <option value="coming_soon">Coming Soon</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-4 top-[calc(50%+0.5rem)] text-gray-400 pointer-events-none"></i>
                    </div>

                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                        <select id="price-filter" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl
                                   appearance-none cursor-pointer hover:bg-gray-100 transition-colors">
                            <option value="">Any Price</option>
                            <option value="0-500">Under ₹500/day</option>
                            <option value="501-2000">₹501 - ₹2000/day</option>
                            <option value="2001+">Above ₹2000/day</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-4 top-[calc(50%+0.5rem)] text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Active Filters -->
                <div class="flex flex-wrap gap-2 min-h-[2rem]" id="active-filters"></div>
            </div>
        </div>

        <!-- Replace the static product grid with a container for dynamic rendering -->
        <div id="product-grid" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Dynamic products will render here -->
        </div>

        <!-- Improved Pagination -->
        <div class="mt-8 flex justify-center">
            <nav class="inline-flex rounded-lg shadow-sm bg-white">
                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">Previous</button>
                <button class="px-4 py-2 border rounded-lg bg-blue-600 text-white">1</button>
                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">2</button>
                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">3</button>
                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">Next</button>
            </nav>
        </div>
    </main>

    <?php include './components/footer.php'; ?>

    <script>
        // Export products data from PHP into a JS variable
        const productsData = <?php echo json_encode($products); ?>;

        // Render products with each card wrapped with an id for direct linking.
        function renderProducts(filteredProducts) {
            const container = document.getElementById('product-grid');
            if (filteredProducts.length === 0) {
                container.innerHTML = '<div class="col-span-full text-center text-gray-600">No items found.</div>';
                return;
            }
            container.innerHTML = filteredProducts.map(product => `
                <div id="product-${product.id}" class="bg-white rounded-lg shadow-sm overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group"
                     data-category="${product.category}" data-status="${product.status}" data-price="${product.price}">
                    <div class="relative overflow-hidden">
                        <img src="${product.image}" class="w-full h-48 object-cover transform transition-transform duration-300 group-hover:scale-105">
                        <span class="absolute top-2 right-2 ${product.status === 'available' ? 'bg-green-500' : 'bg-yellow-500'} text-white px-3 py-1 rounded-full text-sm font-medium transition-colors duration-300">
                            ${product.status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold">${product.name}</h3>
                            <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                ${product.category.charAt(0).toUpperCase() + product.category.slice(1)}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm">${product.description}</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            ${product.features.map(feature => `<span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">${feature}</span>`).join('')}
                        </div>
                        <div class="mt-4 flex justify-between items-end">
                            <div>
                                <span class="text-lg font-bold">₹${product.price.toLocaleString()}</span>
                                <span class="text-gray-500">per ${product.price_type}</span>
                                <p class="text-sm text-gray-500">Deposit: ₹${product.deposit.toLocaleString()}</p>
                            </div>
                            <button onclick="location.href='browse.php?id=${product.id}'" class="bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-300 hover:bg-blue-700">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Filtering
        function filterItems() {
            const searchText = document.getElementById('search').value.toLowerCase().trim();
            const categoryValue = document.getElementById('category-filter').value.toLowerCase();
            const availabilityValue = document.getElementById('availability-filter').value.toLowerCase();
            const priceValue = document.getElementById('price-filter').value;

            const filtered = productsData.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(searchText);
                const matchesCategory = !categoryValue || product.category.toLowerCase() === categoryValue;
                const matchesStatus = !availabilityValue || product.status.toLowerCase() === availabilityValue;
                const matchesPrice = checkPriceRange(product.price, priceValue);
                return matchesSearch && matchesCategory && matchesStatus && matchesPrice;
            });

            renderProducts(filtered);
            updateResultsCount(filtered.length, productsData.length);
            updateActiveFilters();
        }

        function checkPriceRange(price, range) {
            if (!range) return true;
            if (range === '2001+') return price >= 2001;
            const [minStr, maxStr] = range.split('-');
            const min = parseInt(minStr, 10);
            const max = parseInt(maxStr, 10);
            return price >= min && price <= max;
        }

        function updateResultsCount(visible, total) {
            let resultsCount = document.getElementById('results-count');
            if (!resultsCount) {
                resultsCount = document.createElement('div');
                resultsCount.id = 'results-count';
                resultsCount.className = 'text-gray-600 mt-4 mb-6 text-center';
                document.querySelector('#product-grid').insertAdjacentElement('beforebegin', resultsCount);
            }
            resultsCount.textContent = `Showing ${visible} of ${total} items`;
        }

        function updateActiveFilters() {
            const activeFilters = document.getElementById('active-filters');
            activeFilters.innerHTML = '';
            [
                { el: document.getElementById('search'), label: 'Search' },
                { el: document.getElementById('category-filter'), label: 'Category' },
                { el: document.getElementById('availability-filter'), label: 'Status' },
                { el: document.getElementById('price-filter'), label: 'Price' }
            ].forEach(({ el, label }) => {
                if (el.value) {
                    const text = el.tagName === 'SELECT'
                        ? el.options[el.selectedIndex].text
                        : el.value;
                    const pill = document.createElement('span');
                    pill.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800';
                    pill.innerHTML = `
                        ${label}: ${text}
                        <button class="ml-2 hover:text-blue-600" onclick="clearFilter('${el.id}')">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    activeFilters.appendChild(pill);
                }
            });
        }

        window.clearFilter = (filterId) => {
            document.getElementById(filterId).value = '';
            filterItems();
        };

        // Attach event listeners for filtering
        document.getElementById('search').addEventListener('input', filterItems);
        document.getElementById('category-filter').addEventListener('change', filterItems);
        document.getElementById('availability-filter').addEventListener('change', filterItems);
        document.getElementById('price-filter').addEventListener('change', filterItems);

        // Trigger initial render once DOM is loaded
        filterItems();

        // After rendering, check for id query parameter and scroll into view.
        window.addEventListener('load', () => {
            const params = new URLSearchParams(window.location.search);
            const prodId = params.get('id');
            if (prodId) {
                const elem = document.getElementById(`product-${prodId}`);
                if (elem) {
                    // Slight delay to ensure element rendering
                    setTimeout(() => { elem.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 300);
                }
            }
        });
    </script>
</body>

</html>