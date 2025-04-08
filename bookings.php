<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include './includes/header.php';
include './data/bookings_data.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Quick Gear</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<main class="container mx-auto py-10 bg-gray-50 px-24">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">My Bookings</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($bookings as $booking): ?>
            <?php
            $statusColor = ($booking['status'] === 'completed') ? '#2ecc71' :
                (($booking['status'] === 'pending') ? '#f1c40f' :
                    (($booking['status'] === 'confirmed') ? '#3498db' : '#e74c3c'));
            ?>
            <div class="relative bg-white p-6 rounded-xl shadow-lg transition transform hover:scale-105 hover:shadow-2xl">
                <div class="absolute inset-y-0 left-0 w-1 rounded-r-xl"
                    style="background-color: <?= htmlspecialchars($statusColor) ?>;"></div>
                <div class="ml-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($booking['item_name']) ?></h3>
                    <p class="text-gray-600 mb-1">Rental Period: <?= htmlspecialchars($booking['start_date']) ?> to
                        <?= htmlspecialchars($booking['end_date']) ?>
                    </p>
                    <p class="text-gray-600">Status:
                        <span class="font-semibold" style="color: <?= htmlspecialchars($statusColor) ?>">
                            <?= htmlspecialchars($booking['status']) ?>
                        </span>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include './includes/footer.php'; ?>