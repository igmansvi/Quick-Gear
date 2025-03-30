<?php include './components/header.php'; ?>

<main class="container mx-auto py-10 bg-gray-50 px-24">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">My Bookings</h2>
    <!-- Changed container to responsive grid layout -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Booking Card 1 -->
        <div class="relative bg-white p-6 rounded-xl shadow-lg transition transform hover:scale-105 hover:shadow-2xl">
            <!-- Accent border based on status -->
            <div class="absolute inset-y-0 left-0 w-1 rounded-r-xl bg-yellow-500"></div>
            <div class="ml-4">
                <h3 class="text-xl font-bold text-gray-800 mb-2">DSLR Camera</h3>
                <p class="text-gray-600 mb-1">Rental Period: 2023-10-01 to 2023-10-07</p>
                <p class="text-gray-600">Status: <span class="font-semibold text-yellow-500">Pending</span></p>
            </div>
        </div>

        <!-- Booking Card 2 -->
        <div class="relative bg-white p-6 rounded-xl shadow-lg transition transform hover:scale-105 hover:shadow-2xl">
            <div class="absolute inset-y-0 left-0 w-1 rounded-r-xl bg-green-500"></div>
            <div class="ml-4">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Power Drill</h3>
                <p class="text-gray-600 mb-1">Rental Period: 2023-09-20 to 2023-09-25</p>
                <p class="text-gray-600">Status: <span class="font-semibold text-green-500">Completed</span></p>
            </div>
        </div>

        <!-- Booking Card 3 -->
        <div class="relative bg-white p-6 rounded-xl shadow-lg transition transform hover:scale-105 hover:shadow-2xl">
            <div class="absolute inset-y-0 left-0 w-1 rounded-r-xl bg-blue-500"></div>
            <div class="ml-4">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Projector</h3>
                <p class="text-gray-600 mb-1">Rental Period: 2023-10-05 to 2023-10-10</p>
                <p class="text-gray-600">Status: <span class="font-semibold text-blue-500">Ongoing</span></p>
            </div>
        </div>
    </div>
</main>

<?php include './components/footer.php'; ?>