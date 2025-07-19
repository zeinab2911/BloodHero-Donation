<?php
require_once 'config/database.php';

echo "<h1>🩸 Adding Blood Inventory Data</h1>";

// First, let's add some additional medical centers if they don't exist
$medical_centers = [
    [
        'name' => 'Beirut Government Hospital',
        'type' => 'Hospital',
        'phone' => '+961-1-234567',
        'location' => 'Beirut',
        'email' => 'admin@beiruthospital.com',
        'username' => 'beirut_hospital',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ],
    [
        'name' => 'Tyre Medical Center',
        'type' => 'Hospital',
        'phone' => '+961-7-456789',
        'location' => 'Tyre',
        'email' => 'admin@tyremedical.com',
        'username' => 'tyre_medical',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ],
    [
        'name' => 'Tripoli Central Hospital',
        'type' => 'Hospital',
        'phone' => '+961-6-123456',
        'location' => 'Tripoli',
        'email' => 'admin@tripolihospital.com',
        'username' => 'tripoli_hospital',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ],
    [
        'name' => 'Lebanese Red Cross - Beirut',
        'type' => 'Red Cross',
        'phone' => '+961-1-345678',
        'location' => 'Beirut',
        'email' => 'beirut@redcross.org.lb',
        'username' => 'redcross_beirut',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ],
    [
        'name' => 'Civil Defense - Beirut',
        'type' => 'Civil Defense',
        'phone' => '+961-1-567890',
        'location' => 'Beirut',
        'email' => 'beirut@civildefense.gov.lb',
        'username' => 'civildefense_beirut',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ],
    [
        'name' => 'Beirut Blood Bank',
        'type' => 'Blood Bank',
        'phone' => '+961-1-678901',
        'location' => 'Beirut',
        'email' => 'info@beirutbloodbank.com',
        'username' => 'beirut_bloodbank',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ]
];

echo "<h2>🏥 Adding Medical Centers</h2>";

foreach ($medical_centers as $center) {
    try {
        // Check if medical center already exists
        $stmt = $pdo->prepare("SELECT id FROM medical_centers WHERE username = ?");
        $stmt->execute([$center['username']]);
        
        if (!$stmt->fetch()) {
            $stmt = $pdo->prepare("
                INSERT INTO medical_centers (name, type, phone, location, email, username, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $center['name'],
                $center['type'],
                $center['phone'],
                $center['location'],
                $center['email'],
                $center['username'],
                $center['password']
            ]);
            echo "✅ Added: " . $center['name'] . "<br>";
        } else {
            echo "⏭️ Already exists: " . $center['name'] . "<br>";
        }
    } catch (Exception $e) {
        echo "❌ Error adding " . $center['name'] . ": " . $e->getMessage() . "<br>";
    }
}

// Now let's add fresh blood inventory data
echo "<h2>🩸 Adding Blood Inventory Data</h2>";

// Clear existing inventory data first
try {
    $pdo->exec("DELETE FROM blood_inventory");
    echo "🗑️ Cleared existing inventory data<br>";
} catch (Exception $e) {
    echo "⚠️ Could not clear existing data: " . $e->getMessage() . "<br>";
}

// Get all medical center IDs
$stmt = $pdo->query("SELECT id, name FROM medical_centers WHERE status = 'Active'");
$centers = $stmt->fetchAll();

$blood_types = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
$storage_types = ['Whole Blood', 'Red Blood Cells', 'Plasma', 'Platelets'];

// Generate realistic inventory data
$inventory_data = [];

foreach ($centers as $center) {
    // Each center will have 3-6 blood types in stock
    $num_types = rand(3, 6);
    $selected_types = array_rand(array_flip($blood_types), $num_types);
    
    foreach ($selected_types as $blood_type) {
        // Generate realistic quantities based on blood type rarity
        $base_quantity = 0;
        switch ($blood_type) {
            case 'O+':
                $base_quantity = rand(20, 50); // Most common
                break;
            case 'A+':
                $base_quantity = rand(15, 40);
                break;
            case 'B+':
                $base_quantity = rand(8, 25);
                break;
            case 'O-':
                $base_quantity = rand(5, 20);
                break;
            case 'A-':
                $base_quantity = rand(5, 15);
                break;
            case 'AB+':
                $base_quantity = rand(3, 12);
                break;
            case 'B-':
                $base_quantity = rand(2, 10);
                break;
            case 'AB-':
                $base_quantity = rand(1, 8); // Rarest
                break;
        }
        
        // Add some variation
        $quantity = $base_quantity + rand(-3, 5);
        if ($quantity < 1) $quantity = 1;
        
        // Generate expiry date (between 7 and 42 days from now)
        $expiry_days = rand(7, 42);
        $expiry_date = date('Y-m-d', strtotime("+$expiry_days days"));
        
        // Random storage type
        $storage_type = $storage_types[array_rand($storage_types)];
        
        $inventory_data[] = [
            'medical_center_id' => $center['id'],
            'blood_type' => $blood_type,
            'units_available' => $quantity,
            'expiry_date' => $expiry_date,
            'storage_type' => $storage_type
        ];
    }
}

// Insert the inventory data
$inserted_count = 0;
foreach ($inventory_data as $item) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO blood_inventory (medical_center_id, blood_type, units_available, expiry_date, storage_type) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $item['medical_center_id'],
            $item['blood_type'],
            $item['units_available'],
            $item['expiry_date'],
            $item['storage_type']
        ]);
        $inserted_count++;
    } catch (Exception $e) {
        echo "❌ Error inserting inventory item: " . $e->getMessage() . "<br>";
    }
}

echo "✅ Successfully added $inserted_count inventory entries<br>";

// Show summary
echo "<h2>📊 Inventory Summary</h2>";

try {
    $stmt = $pdo->query("
        SELECT 
            bi.blood_type,
            SUM(bi.units_available) as total_units,
            COUNT(DISTINCT bi.medical_center_id) as centers_with_type
        FROM blood_inventory bi
        GROUP BY bi.blood_type
        ORDER BY total_units DESC
    ");
    
    $summary = $stmt->fetchAll();
    
    echo "<table style='border-collapse: collapse; width: 100%; margin: 1rem 0;'>";
    echo "<tr style='background: #f0f0f0;'>";
    echo "<th style='border: 1px solid #ddd; padding: 8px;'>Blood Type</th>";
    echo "<th style='border: 1px solid #ddd; padding: 8px;'>Total Units</th>";
    echo "<th style='border: 1px solid #ddd; padding: 8px;'>Centers</th>";
    echo "</tr>";
    
    foreach ($summary as $row) {
        echo "<tr>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'><strong>" . $row['blood_type'] . "</strong></td>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $row['total_units'] . " units</td>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $row['centers_with_type'] . " centers</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch (Exception $e) {
    echo "❌ Error generating summary: " . $e->getMessage() . "<br>";
}

echo "<h2>🎯 Next Steps</h2>";
echo "<ul>";
echo "<li>✅ Blood inventory data has been added successfully</li>";
echo "<li>🏥 Visit <a href='blood-bank.php'>Blood Bank Page</a> to see the inventory</li>";
echo "<li>🔐 Medical centers can login to manage their inventory</li>";
echo "<li>📱 Test the SMS system with the diagnostic tool</li>";
echo "</ul>";

echo "<p><a href='blood-bank.php' style='background: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🩸 View Blood Inventory</a></p>";
?> 