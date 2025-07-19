<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['medical_center_id'])) {
    header('Location: medical-center-login.php');
    exit;
}

$medical_center_id = $_SESSION['medical_center_id'];
$medical_center_name = $_SESSION['medical_center_name'] ?? 'Medical Center';
$medical_center_type = $_SESSION['medical_center_type'] ?? 'Hospital';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add_inventory') {
            $blood_type = $_POST['blood_type'];
            $units = (int)$_POST['units'];
            $expiry_date = $_POST['expiry_date'];
            $storage_type = $_POST['storage_type'] ?? 'Whole Blood';
            
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO blood_inventory (medical_center_id, blood_type, units_available, expiry_date, storage_type) 
                    VALUES (?, ?, ?, ?, ?)
                ");
                $stmt->execute([$medical_center_id, $blood_type, $units, $expiry_date, $storage_type]);
                $success_message = "✅ Blood inventory added successfully! This inventory is now visible on the public Blood Bank page and available for emergency requests.";
            } catch (Exception $e) {
                $error_message = "Error adding inventory: " . $e->getMessage();
            }
        } elseif ($_POST['action'] === 'update_inventory') {
            $inventory_id = (int)$_POST['inventory_id'];
            $units = (int)$_POST['units'];
            
            try {
                $stmt = $pdo->prepare("
                    UPDATE blood_inventory 
                    SET units_available = ?, updated_at = CURRENT_TIMESTAMP 
                    WHERE id = ? AND medical_center_id = ?
                ");
                $stmt->execute([$units, $inventory_id, $medical_center_id]);
                $success_message = "Inventory updated successfully!";
            } catch (Exception $e) {
                $error_message = "Error updating inventory: " . $e->getMessage();
            }
        } elseif ($_POST['action'] === 'delete_inventory') {
            $inventory_id = (int)$_POST['inventory_id'];
            
            try {
                $stmt = $pdo->prepare("DELETE FROM blood_inventory WHERE id = ? AND medical_center_id = ?");
                $stmt->execute([$inventory_id, $medical_center_id]);
                $success_message = "Inventory deleted successfully!";
            } catch (Exception $e) {
                $error_message = "Error deleting inventory: " . $e->getMessage();
            }
        }
    }
}

$current_inventory = [];
$stats = ['total_units' => 0, 'blood_types' => 0, 'expiring_soon' => 0];

try {
    $stmt = $pdo->prepare("
        SELECT *, 
        CASE 
            WHEN expiry_date <= CURDATE() THEN 'expired'
            WHEN expiry_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) THEN 'expiring'
            ELSE 'available'
        END as status_type
        FROM blood_inventory 
        WHERE medical_center_id = ? 
        ORDER BY blood_type, expiry_date
    ");
    $stmt->execute([$medical_center_id]);
    $current_inventory = $stmt->fetchAll();
    
    $stats_stmt = $pdo->prepare("
        SELECT 
            SUM(units_available) as total_units,
            COUNT(DISTINCT blood_type) as blood_types,
            SUM(CASE WHEN expiry_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) THEN 1 ELSE 0 END) as expiring_soon
        FROM blood_inventory 
        WHERE medical_center_id = ?
    ");
    $stats_stmt->execute([$medical_center_id]);
    $stats = $stats_stmt->fetch() ?: $stats;
} catch (Exception $e) {
    $error_message = "Error loading inventory: " . $e->getMessage();
}

$page_title = 'Medical Center Dashboard';
include 'includes/header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1>🏥 <?php echo htmlspecialchars($medical_center_name); ?></h1>
            <p style="color: var(--accent-color); font-weight: bold;"><?php echo htmlspecialchars($medical_center_type); ?> - Blood Inventory Management</p>
        </div>
        <div style="display: flex; gap: 1rem;">
            <a href="blood-bank.php" class="btn btn-secondary">🩸 View Public Blood Bank</a>
            <a href="medical-center-logout.php" class="btn btn-danger">🚪 Logout</a>
        </div>
    </div>
    
    <?php if ($success_message): ?>
        <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: var(--border-radius); margin: 1rem 0; border: 1px solid #c3e6cb;">
            <strong>✅ Success:</strong> <?php echo htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>
    
    <?php if ($error_message): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: var(--border-radius); margin: 1rem 0; border: 1px solid #f5c6cb;">
            <strong>❌ Error:</strong> <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>
</div>

<div class="card">
    <h2>📊 Inventory Statistics</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div style="text-align: center; padding: 2rem; background: var(--primary-color); border-radius: var(--border-radius);">
            <h3 style="color: #000000; font-weight: bold; margin: 0 0 0.5rem 0;"><?php echo $stats['total_units'] ?: 0; ?></h3>
            <p style="color: #000000; font-weight: 500; margin: 0;">Total Units Available</p>
        </div>
        <div style="text-align: center; padding: 2rem; background: var(--secondary-color); border-radius: var(--border-radius);">
            <h3 style="color: #000000; font-weight: bold; margin: 0 0 0.5rem 0;"><?php echo $stats['blood_types'] ?: 0; ?></h3>
            <p style="color: #000000; font-weight: 500; margin: 0;">Different Blood Types</p>
        </div>
        <div style="text-align: center; padding: 2rem; background: var(--accent-color); border-radius: var(--border-radius);">
            <h3 style="color: #ffffff; font-weight: bold; margin: 0 0 0.5rem 0;"><?php echo $stats['expiring_soon'] ?: 0; ?></h3>
            <p style="color: #ffffff; font-weight: 500; margin: 0;">Expiring Within 7 Days</p>
        </div>
    </div>
    
    <div style="text-align: center; margin: 2rem 0;">
        <a href="blood-bank.php" target="_blank" class="btn" style="background: #4CAF50; color: white; text-decoration: none; display: inline-block;">
            🌐 View Public Blood Bank Page
        </a>
        <p style="margin-top: 0.5rem; color: #666; font-size: 0.9rem;">See how your inventory appears to the public and other hospitals</p>
    </div>
</div>

<div class="card">
    <h2>➕ Add Blood Inventory</h2>
    <form method="POST" class="form-container">
        <input type="hidden" name="action" value="add_inventory">
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; align-items: end;">
            <div class="form-group">
                <label>Blood Type:</label>
                <select name="blood_type" required>
                    <option value="">Select Blood Type</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Storage Type:</label>
                <select name="storage_type" required>
                    <option value="Whole Blood">Whole Blood</option>
                    <option value="Red Blood Cells">Red Blood Cells</option>
                    <option value="Plasma">Plasma</option>
                    <option value="Platelets">Platelets</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Units Available:</label>
                <input type="number" name="units" min="1" max="1000" required placeholder="Number of units">
            </div>
            
            <div class="form-group">
                <label>Expiry Date:</label>
                <input type="date" name="expiry_date" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
            </div>
            
            <div>
                <button type="submit" class="btn" style="width: 100%; padding: 0.75rem;">
                    ➕ Add to Inventory
                </button>
            </div>
        </div>
    </form>
</div>

<div class="card">
    <h2>📋 Current Blood Inventory</h2>
    
    <?php if (empty($current_inventory)): ?>
        <p style="text-align: center; color: var(--accent-color); font-style: italic; margin: 2rem 0;">
            No blood inventory found. Add inventory entries above to get started.
        </p>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table class="blood-table">
                <thead>
                    <tr>
                        <th>Blood Type</th>
                        <th>Storage Type</th>
                        <th>Units Available</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($current_inventory as $item): ?>
                        <tr class="<?php echo $item['status_type']; ?>">
                            <td><span class="blood-type"><?php echo htmlspecialchars($item['blood_type']); ?></span></td>
                            <td><?php echo htmlspecialchars($item['storage_type']); ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="update_inventory">
                                    <input type="hidden" name="inventory_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="units" value="<?php echo $item['units_available']; ?>" 
                                           min="0" max="1000" style="width: 80px; padding: 0.3rem; border: 1px solid var(--secondary-color); border-radius: 4px;">
                                    <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Update</button>
                                </form>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($item['expiry_date'])); ?></td>
                            <td>
                                <?php
                                switch ($item['status_type']) {
                                    case 'expired':
                                        echo '<span class="status-critical">❌ Expired</span>';
                                        break;
                                    case 'expiring':
                                        echo '<span class="status-low">⏰ Expiring Soon</span>';
                                        break;
                                    default:
                                        echo '<span class="status-available">✅ Available</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this inventory entry?')">
                                    <input type="hidden" name="action" value="delete_inventory">
                                    <input type="hidden" name="inventory_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<div class="card">
    <h2>📞 Emergency Contact Information</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
        <div style="padding: 1.5rem; background: var(--primary-color); border-radius: var(--border-radius);">
            <h4>🚨 Blood Emergency Hotline</h4>
            <p><strong>Phone:</strong> +961-70-843830</p>
            <p><strong>Available:</strong> 24/7</p>
            <p>For urgent blood requests and coordination</p>
        </div>
        <div style="padding: 1.5rem; background: var(--secondary-color); border-radius: var(--border-radius);">
            <h4>🩸 BloodHero Support</h4>
            <p><strong>Email:</strong> bloodherodonation@gmail.com</p>
            <p><strong>Phone:</strong> +961-70-843830</p>
            <p>For technical support and assistance</p>
        </div>
    </div>
</div>

<style>
.expired {
    background: #ffebee !important;
}
.expired .blood-type {
    color: #d32f2f;
}
.expiring {
    background: #fff3e0 !important;
}
.expiring .blood-type {
    color: #f57c00;
}
.available {
    background: #e8f5e8 !important;
}
</style>

<?php include 'includes/footer.php'; ?> 