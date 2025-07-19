<?php
require_once 'config/database.php';
session_start();

if (isset($_SESSION['medical_center_id'])) {
    header('Location: medical-center-dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM medical_centers WHERE username = ? AND status = 'Active'");
            $stmt->execute([$username]);
            $medical_center = $stmt->fetch();
            
            if ($medical_center && password_verify($password, $medical_center['password'])) {
                $_SESSION['medical_center_id'] = $medical_center['id'];
                $_SESSION['medical_center_name'] = $medical_center['name'];
                $_SESSION['medical_center_type'] = $medical_center['type'];
                $_SESSION['medical_center_location'] = $medical_center['location'];
                
                $update_login = $pdo->prepare("UPDATE medical_centers SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
                $update_login->execute([$medical_center['id']]);
                
                header('Location: medical-center-dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        } catch (Exception $e) {
            $error = 'Login error occurred. Please try again.';
        }
    }
}

$page_title = 'Medical Center Login';
include 'includes/header.php';
?>

<div class="card" style="max-width: 500px; margin: 2rem auto;">
    <h1>🏥 Medical Center Login</h1>
    <p>Access your blood inventory management system</p>
    
    <?php if ($error): ?>
        <div style="background: #ff6b6b; color: white; padding: 1rem; border-radius: var(--border-radius); margin: 1rem 0;">
            <strong>⚠️ Error:</strong> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" style="margin-top: 2rem;">
        <div style="margin-bottom: 1.5rem;">
            <label for="username" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Medical Center Username:</label>
            <input type="text" id="username" name="username" required 
                   style="width: 100%; padding: 0.75rem; border: 2px solid var(--secondary-color); border-radius: var(--border-radius); font-size: 1rem;"
                   placeholder="Enter your medical center username"
                   value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
        </div>
        
        <div style="margin-bottom: 1.5rem;">
            <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Password:</label>
            <input type="password" id="password" name="password" required 
                   style="width: 100%; padding: 0.75rem; border: 2px solid var(--secondary-color); border-radius: var(--border-radius); font-size: 1rem;"
                   placeholder="Enter your password">
        </div>
        
        <button type="submit" class="btn" style="width: 100%; font-size: 1.1rem; padding: 1rem;">
            🔐 Login to Inventory Management
        </button>
    </form>
</div>

<?php include 'includes/footer.php'; ?> 