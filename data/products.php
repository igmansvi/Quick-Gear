<?php
$products = [
    [
        'id' => 1,
        'name' => 'DSLR Camera',
        'category' => 'tech',
        'description' => 'Professional Canon 5D Mark IV with lens kit',
        'price' => 999,
        'price_type' => 'day',
        'deposit' => 25000,
        'status' => 'available',
        'image' => 'https://placehold.co/400x300/4361ee/ffffff?text=DSLR+Camera',
        'features' => ['4K Video', '30.4MP', 'Dual Pixel AF']
    ],
    [
        'id' => 2,
        'name' => 'PlayStation 5',
        'category' => 'tech',
        'description' => 'Gaming console with 2 controllers and 3 games',
        'price' => 499,
        'price_type' => 'day',
        'deposit' => 15000,
        'status' => 'coming_soon',
        'image' => 'https://placehold.co/400x300/4361ee/ffffff?text=PlayStation+5',
        'features' => ['4K Gaming', '2 Controllers', '3 Games Included']
    ],
    [
        'id' => 3,
        'name' => 'Professional DJ Setup',
        'category' => 'events',
        'description' => 'Complete DJ system with speakers and lights',
        'price' => 2500,
        'price_type' => 'day',
        'deposit' => 35000,
        'status' => 'available',
        'image' => 'https://placehold.co/400x300/ff6b6b/ffffff?text=DJ+Setup',
        'features' => ['2000W Speakers', 'DMX Lights', 'Pioneer Controller']
    ],
    [
        'id' => 4,
        'name' => 'Drone with 4K Camera',
        'category' => 'tech',
        'description' => 'DJI Mavic Air 2 with extra batteries',
        'price' => 1500,
        'price_type' => 'day',
        'deposit' => 20000,
        'status' => 'available',
        'image' => 'https://placehold.co/400x300/4361ee/ffffff?text=Drone',
        'features' => ['4K 60fps', '48MP Photos', '34min Flight Time']
    ],
    [
        'id' => 5,
        'name' => 'Power Generator',
        'category' => 'tools',
        'description' => '5500W Portable Generator',
        'price' => 800,
        'price_type' => 'day',
        'deposit' => 10000,
        'status' => 'available',
        'image' => 'https://placehold.co/400x300/2b2d42/ffffff?text=Generator',
        'features' => ['5500W Output', 'Low Noise', 'Fuel Efficient']
    ],
    [
        'id' => 6,
        'name' => 'Professional Lighting Kit',
        'category' => 'events',
        'description' => 'Studio lighting setup with softboxes',
        'price' => 1200,
        'price_type' => 'day',
        'deposit' => 15000,
        'status' => 'available',
        'image' => 'https://placehold.co/400x300/ff6b6b/ffffff?text=Lighting+Kit',
        'features' => ['3-Point Setup', 'LED Panels', 'Wireless Control']
    ],
    [
        'id' => 7,
        'name' => 'Heavy Duty Lawn Mower',
        'category' => 'tools',
        'description' => 'Professional grade gas-powered mower',
        'price' => 600,
        'price_type' => 'day',
        'deposit' => 8000,
        'status' => 'available',
        'image' => 'https://placehold.co/400x300/2b2d42/ffffff?text=Lawn+Mower',
        'features' => ['Self-Propelled', '21-inch Deck', 'Mulching Capable']
    ],
    // Add more items here...
];

$categories = [
    'tech' => ['name' => 'Electronics', 'icon' => 'fas fa-laptop'],
    'tools' => ['name' => 'Tools', 'icon' => 'fas fa-tools'],
    'events' => ['name' => 'Event Equipment', 'icon' => 'fas fa-music'],
    'home' => ['name' => 'Home Appliances', 'icon' => 'fas fa-home']
];
?>