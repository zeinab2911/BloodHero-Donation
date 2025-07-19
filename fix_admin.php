<?php
/**
 * BloodHero Admin Fix Script
 * This script will fix admin login issues by resetting the admin account
 */

require_once 'config/database.php';

echo "<h1>🔧 BloodHero - Admin Fix Tool</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; max-width: 900px; margin: 50px auto; padding: 20px; }
    .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0; }
    .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 10px 0; }
    .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 5px; margin: 10px 0; }
    .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px; margin: 10px 0; }
    form { background: #f8f9fa; padding: 20px; border-radius: 5px; margin: 20px 0; }
    input, button { padding: 10px; margin: 5px 0; width: 100%; box-sizing: border-box; }
    button { background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer; }
    button:hover { background: #c82333; }
    .create-btn { background: #28a745; }
    .create-btn:hover { background: #218838; }
    table { width: 100%; border-collapse: collapse; margin: 15px 0; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background: #f8f9fa; }
    code { background: #f8f9fa; padding: 2px 5px; border-radius: 3px; }
</style>";

try {
    echo "<div class='info'>✅ Database connection established</div>";
    
    // Check if admins table exists
    $tables = $pdo->query("SHOW TABLES LIKE 'admins'")->fetchAll();
    if (empty($tables)) {
        echo "<div class='error'>❌ 'admins' table does not exist!</div>";
        echo "<div class='warning'>Creating admins table...</div>";
        
        $create_table = "CREATE TABLE admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($create_table);
        echo "<div class='success'>✅ Created admins table</div>";
    }
    
    // Show current admin accounts
    echo "<h2>📊 Current Admin Accounts</h2>";
    $admins = $pdo->query("SELECT * FROM admins")->fetchAll();
    
    if (empty($admins)) {
        echo "<div class='warning'>⚠️ No admin accounts found in database</div>";
    } else {
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Password Hash</th><th>Created</th></tr>";
        foreach ($admins as $admin) {
            echo "<tr>";
            echo "<td>" . $admin['id'] . "</td>";
            echo "<td><strong>" . htmlspecialchars($admin['username']) . "</strong></td>";
            echo "<td>" . htmlspecialchars($admin['email']) . "</td>";
            echo "<td><code>" . substr($admin['password'], 0, 30) . "...</code></td>";
            echo "<td>" . $admin['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete_all'])) {
            $pdo->exec("DELETE FROM admins");
            echo "<div class='success'>✅ All admin accounts deleted</div>";
            header("Refresh:0");
        }
        
        if (isset($_POST['create_default'])) {
            // Delete existing admin first
            $pdo->exec("DELETE FROM admins WHERE username = 'admin'");
            
            // Create new admin with known password
            $username = 'admin';
            $password = 'bloodhero123';
            $email = 'admin@bloodhero.com';
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
            $result = $stmt->execute([$username, $hashed_password, $email]);
            
            if ($result) {
                echo "<div class='success'>
                    ✅ Default admin account created successfully!<br>
                    <strong>Username:</strong> admin<br>
                    <strong>Password:</strong> bloodhero123<br>
                    <strong>Email:</strong> admin@bloodhero.com
                </div>";
                
                // Test the password immediately
                $verify_stmt = $pdo->prepare("SELECT password FROM admins WHERE username = ?");
                $verify_stmt->execute(['admin']);
                $stored_hash = $verify_stmt->fetchColumn();
                
                $verify_result = password_verify($password, $stored_hash);
                echo "<div class='info'>🔍 Password verification test: " . ($verify_result ? "✅ SUCCESS" : "❌ FAILED") . "</div>";
                
            } else {
                echo "<div class='error'>❌ Failed to create admin account</div>";
            }
            header("Refresh:2");
        }
        
        if (isset($_POST['create_custom'])) {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $email = trim($_POST['email']);
            
            if (empty($username) || empty($password) || empty($email)) {
                echo "<div class='error'>❌ Please fill all fields</div>";
            } else {
                // Delete existing admin with same username
                $delete_stmt = $pdo->prepare("DELETE FROM admins WHERE username = ?");
                $delete_stmt->execute([$username]);
                
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
                $result = $stmt->execute([$username, $hashed_password, $email]);
                
                if ($result) {
                    echo "<div class='success'>
                        ✅ Custom admin account created!<br>
                        <strong>Username:</strong> $username<br>
                        <strong>Password:</strong> $password<br>
                        <strong>Email:</strong> $email
                    </div>";
                } else {
                    echo "<div class='error'>❌ Failed to create custom admin account</div>";
                }
                header("Refresh:2");
            }
        }
        
        if (isset($_POST['test_login'])) {
            $test_username = trim($_POST['test_username']);
            $test_password = $_POST['test_password'];
            
            $stmt = $pdo->prepare("SELECT id, username, password FROM admins WHERE username = ?");
            $stmt->execute([$test_username]);
            $admin = $stmt->fetch();
            
            if ($admin && password_verify($test_password, $admin['password'])) {
                echo "<div class='success'>
                    ✅ Login test SUCCESSFUL!<br>
                    Username '$test_username' with provided password works correctly.
                </div>";
            } else {
                echo "<div class='error'>
                    ❌ Login test FAILED!<br>
                    Username '$test_username' with provided password does not work.
                </div>";
            }
        }
    }
    
    // Show action forms
    echo "<h2>🔧 Fix Actions</h2>";
    
    // Quick fix button
    echo "<form method='POST' style='margin-bottom: 10px;'>
        <h3>🚀 Quick Fix (Recommended)</h3>
        <p>Create a default admin account with known credentials:</p>
        <button type='submit' name='create_default' class='create-btn'>
            Create Default Admin (username: admin, password: bloodhero123)
        </button>
    </form>";
    
    // Custom admin form
    echo "<form method='POST'>
        <h3>🎯 Create Custom Admin</h3>
        <input type='text' name='username' placeholder='Username' value='admin' required>
        <input type='email' name='email' placeholder='Email' value='admin@bloodhero.com' required>
        <input type='password' name='password' placeholder='Password' value='mypassword123' required>
        <button type='submit' name='create_custom' class='create-btn'>Create Custom Admin</button>
    </form>";
    
    // Test login form
    if (!empty($admins)) {
        echo "<form method='POST'>
            <h3>🔍 Test Login</h3>
            <input type='text' name='test_username' placeholder='Username to test' value='admin' required>
            <input type='password' name='test_password' placeholder='Password to test' required>
            <button type='submit' name='test_login' style='background: #007bff;'>Test Login</button>
        </form>";
    }
    
    // Delete all (emergency)
    if (!empty($admins)) {
        echo "<form method='POST' onsubmit='return confirm(\"Are you sure you want to delete ALL admin accounts?\")'>
            <h3>⚠️ Emergency Reset</h3>
            <p>This will delete ALL admin accounts:</p>
            <button type='submit' name='delete_all'>Delete All Admin Accounts</button>
        </form>";
    }
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Database Error: " . htmlspecialchars($e->getMessage()) . "</div>";
}

echo "<br><hr>";
echo "<div class='info'>
    <h3>📚 Next Steps:</h3>
    <p>After creating an admin account, try logging in at: <a href='admin/login.php'>admin/login.php</a></p>
    <p><a href='index.php'>← Back to Website</a></p>
</div>";
?> 