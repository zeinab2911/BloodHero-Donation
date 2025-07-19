<?php
require_once 'config/database.php';
$page_title = 'Blood Bank';
include 'includes/header.php';
?>

<div class="card">
    <h3>Filter by Blood Type</h3>
    <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin: 1rem 0;">
        <button onclick="filterBloodType('all')" class="btn btn-filter active" id="filter-all">All Types</button>
        <?php
        $blood_types = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        foreach ($blood_types as $type) {
            echo "<button onclick=\"filterBloodType('$type')\" class=\"btn btn-filter\" id=\"filter-$type\">$type</button>";
        }
        ?>
    </div>
</div>

<div class="card">
    <h2>🩸 Current Blood Inventory</h2>
    <p style="color: #666; margin-bottom: 1rem;">
        Real-time blood inventory from hospitals across our network. Each entry shows specific hospital details.
    </p>
    
    <div style="overflow-x: auto; margin: 2rem 0;">
        <table class="blood-table" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
            <thead>
                <tr style="background: #95e1d3;">
                    <th style="border: 1px solid #ddd; padding: 12px;">Blood Type</th>
                    <th style="border: 1px solid #ddd; padding: 12px;">Units Available</th>
                    <th style="border: 1px solid #ddd; padding: 12px;">Expiry Date</th>
                    <th style="border: 1px solid #ddd; padding: 12px;">Hospital</th>
                    <th style="border: 1px solid #ddd; padding: 12px;">Status</th>
                </tr>
            </thead>
            <tbody id="inventory-tbody">
                <?php
                try {
                    $stmt = $pdo->query("
                        SELECT 
                            bi.blood_type,
                            bi.units_available,
                            bi.expiry_date,
                            mc.name as hospital_name,
                            mc.type as hospital_type,
                            mc.location,
                            CASE 
                                WHEN bi.expiry_date <= CURDATE() THEN 'expired'
                                WHEN bi.expiry_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) THEN 'expiring'
                                WHEN bi.units_available < 5 THEN 'critical'
                                WHEN bi.units_available < 15 THEN 'low'
                                ELSE 'available'
                            END as status
                        FROM blood_inventory bi
                        INNER JOIN medical_centers mc ON bi.medical_center_id = mc.id
                        WHERE bi.units_available > 0 AND mc.status = 'Active'
                        ORDER BY bi.blood_type, bi.expiry_date ASC
                    ");
                    
                    $inventory_data = $stmt->fetchAll();
                    
                    if (count($inventory_data) > 0) {
                        foreach ($inventory_data as $item) {
                            $statusColor = 'green';
                            if ($item['status'] == 'expired') $statusColor = '#d32f2f';
                            elseif ($item['status'] == 'expiring') $statusColor = '#f57c00';
                            elseif ($item['status'] == 'critical') $statusColor = '#f44336';
                            elseif ($item['status'] == 'low') $statusColor = '#FF9800';
                            
                            echo '<tr>';
                            echo '<td style="border: 1px solid #ddd; padding: 12px;"><span class="blood-type">' . htmlspecialchars($item['blood_type']) . '</span></td>';
                            echo '<td style="border: 1px solid #ddd; padding: 12px;">' . $item['units_available'] . ' units</td>';
                            echo '<td style="border: 1px solid #ddd; padding: 12px;">' . date('M j, Y', strtotime($item['expiry_date'])) . '</td>';
                            echo '<td style="border: 1px solid #ddd; padding: 12px;">';
                            echo '<strong>' . htmlspecialchars($item['hospital_name']) . '</strong><br>';
                            echo '<small style="color: #666;">' . htmlspecialchars($item['hospital_type']) . ' - ' . htmlspecialchars($item['location']) . '</small>';
                            echo '</td>';
                            echo '<td style="border: 1px solid #ddd; padding: 12px; color: ' . $statusColor . '; font-weight: bold;">' . ucfirst($item['status']) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="5" style="border: 1px solid #ddd; padding: 20px; text-align: center; color: #666;">';
                        echo '<strong>No blood inventory data found</strong><br>';
                        echo 'Medical centers need to add their blood inventory first.<br>';
                        echo '<a href="medical-center-login.php" style="color: #6dd6c2;">Medical Center Login</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    
                } catch (Exception $e) {
                    echo '<tr>';
                    echo '<td colspan="5" style="border: 1px solid #ddd; padding: 20px; text-align: center; color: red;">';
                    echo '<strong>Database Error:</strong> ' . htmlspecialchars($e->getMessage());
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <div style="text-align: center; margin: 2rem 0;">
        <button onclick="window.location.reload()" class="btn btn-secondary">
            🔄 Refresh Data
        </button>
        <p style="margin-top: 1rem; color: #666; font-size: 0.9rem;">
            Each row shows individual hospital inventory. Filter by blood type to see specific availability.
        </p>
    </div>
</div>

<div class="card">
    <h3>🏥 For Medical Centers</h3>
    <p>To add or update blood inventory that will display above:</p>
    <ol>
        <li>Go to <a href="medical-center-login.php" style="color: var(--accent-color); font-weight: bold;">Medical Center Login</a></li>
        <li>Add or update blood inventory in the dashboard</li>
        <li>Return here to see your inventory listed with hospital details</li>
    </ol>
    <div style="text-align: center; margin: 1rem 0;">
        <button class="btn btn-primary" onclick="window.location.href='medical-center-login.php'">
            🔐 Login to Manage Inventory
        </button>
    </div>
</div>

<div class="card">
    <h3>Blood Type Compatibility Chart</h3>
    <p>Understanding blood type compatibility for donations and transfusions:</p>
    
    <div style="overflow-x: auto; margin: 2rem 0;">
        <table class="blood-table">
            <thead>
                <tr>
                    <th>Blood Type</th>
                    <th>Can Donate To</th>
                    <th>Can Receive From</th>
                    <th>Population %</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="blood-type">O-</span></td>
                    <td>Everyone (Universal Donor)</td>
                    <td>O-</td>
                    <td>6.6%</td>
                </tr>
                <tr>
                    <td><span class="blood-type">O+</span></td>
                    <td>O+, A+, B+, AB+</td>
                    <td>O+, O-</td>
                    <td>37.4%</td>
                </tr>
                <tr>
                    <td><span class="blood-type">A-</span></td>
                    <td>A-, A+, AB-, AB+</td>
                    <td>A-, O-</td>
                    <td>6.3%</td>
                </tr>
                <tr>
                    <td><span class="blood-type">A+</span></td>
                    <td>A+, AB+</td>
                    <td>A+, A-, O+, O-</td>
                    <td>35.7%</td>
                </tr>
                <tr>
                    <td><span class="blood-type">B-</span></td>
                    <td>B-, B+, AB-, AB+</td>
                    <td>B-, O-</td>
                    <td>1.5%</td>
                </tr>
                <tr>
                    <td><span class="blood-type">B+</span></td>
                    <td>B+, AB+</td>
                    <td>B+, B-, O+, O-</td>
                    <td>8.5%</td>
                </tr>
                <tr>
                    <td><span class="blood-type">AB-</span></td>
                    <td>AB-, AB+</td>
                    <td>Everyone (Universal Receiver for Plasma)</td>
                    <td>0.6%</td>
                </tr>
                <tr>
                    <td><span class="blood-type">AB+</span></td>
                    <td>AB+</td>
                    <td>Everyone (Universal Receiver)</td>
                    <td>3.4%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <h3>Blood Storage Information</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 1rem;">
        <div>
            <h4>🩸 Whole Blood</h4>
            <p><strong>Storage:</strong> 2-6°C</p>
            <p><strong>Shelf Life:</strong> 35-42 days</p>
            <p><strong>Use:</strong> Surgery, trauma, anemia</p>
        </div>
        <div>
            <h4>🔴 Red Blood Cells</h4>
            <p><strong>Storage:</strong> 1-6°C</p>
            <p><strong>Shelf Life:</strong> 42 days</p>
            <p><strong>Use:</strong> Anemia, blood loss</p>
        </div>
        <div>
            <h4>💛 Plasma</h4>
            <p><strong>Storage:</strong> -18°C or below</p>
            <p><strong>Shelf Life:</strong> 12 months</p>
            <p><strong>Use:</strong> Clotting disorders, burns</p>
        </div>
        <div>
            <h4>🟡 Platelets</h4>
            <p><strong>Storage:</strong> 20-24°C</p>
            <p><strong>Shelf Life:</strong> 5 days</p>
            <p><strong>Use:</strong> Cancer treatment, surgery</p>
        </div>
    </div>
</div>





<style>
.btn-filter {
    background: var(--secondary-color);
    color: var(--dark-primary);
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

.btn-filter.active {
    background: var(--accent-color);
    color: white;
}

.btn-filter:hover {
    background: var(--accent-color);
    color: white;
}

.btn-clear {
    background: transparent !important;
    color: white !important;
    border: 2px solid white !important;
    padding: 1rem 2rem;
    border-radius: var(--border-radius);
    text-decoration: none;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: none !important;
    margin-top: 1rem;
    display: inline-block;
}

.btn-clear:hover {
    background: white !important;
    color: var(--primary-color) !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2) !important;
}

.hidden {
    display: none !important;
}

.status-available {
    color: #4CAF50;
    font-weight: bold;
}

.status-low {
    color: #FF9800;
    font-weight: bold;
}

.status-critical {
    color: #f44336;
    font-weight: bold;
}

.status-expired {
    color: #d32f2f;
    font-weight: bold;
}

.status-expiring {
    color: #f57c00;
    font-weight: bold;
}

.status-warning {
    color: #FF5722;
    font-weight: bold;
}

.btn-sm {
    padding: 0.3rem 0.8rem;
    font-size: 0.85rem;
}
</style>

<script>
function filterBloodType(type) {
    const rows = document.querySelectorAll('#blood-inventory-table tbody tr');
    const buttons = document.querySelectorAll('.btn-filter');
    
    
    buttons.forEach(btn => btn.classList.remove('active'));
    document.getElementById('filter-' + type).classList.add('active');
    

    rows.forEach(row => {
        if (type === 'all') {
            row.classList.remove('hidden');
        } else {
            const bloodType = row.querySelector('.blood-type').textContent;
            if (bloodType === type) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        }
    });
}

function filterBloodType(type) {
    const rows = document.querySelectorAll('#inventory-tbody tr');
    const buttons = document.querySelectorAll('.btn-filter');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    document.getElementById('filter-' + type).classList.add('active');
    
    // Filter rows
    rows.forEach(row => {
        if (type === 'all') {
            row.style.display = '';
        } else {
            const bloodType = row.querySelector('.blood-type');
            if (bloodType && bloodType.textContent === type) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}
</script>

<?php include 'includes/footer.php'; ?> 