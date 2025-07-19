<?php
/**
 * BloodHero Admin Setup Script
 * This script helps set up the first admin account and diagnose database issues
 */

require_once 'config/database.php';

echo "<h1>🩸 BloodHero - Admin Setup & Diagnostics</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
    .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0; }
    .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 10px 0; }
    .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 5px; margin: 10px 0; }
    .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px; margin: 10px 0; }
    form { background: #f8f9fa; padding: 20px; border-radius: 5px; margin: 20px 0; }
    input, button { padding: 10px; margin: 5px 0; width: 100%; box-sizing: border-box; }
    button { background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; }
    button:hover { background: #0056b3; }
</style>";

try {
    // Test database connection
    echo "<div class='info'>✅ Database connection: SUCCESS</div>";
    
    // Check if tables exist
    $tables_check = $pdo->query("SHOW TABLES LIKE 'admins'");
    if ($tables_check->rowCount() == 0) {
        echo "<div class='error'>❌ PROBLEM: 'admins' table doesn't exist!</div>";
        echo "<div class='warning'>
            <h3>📋 Solution:</h3>
            <p>You need to import the database structure. Please run this in your MySQL:</p>
            <p><strong>1.</strong> Open phpMyAdmin or MySQL command line</p>
            <p><strong>2.</strong> Import the file: <code>database/bloodhero.sql</code></p>
            <p><strong>3.</strong> Then refresh this page</p>
        </div>";
        exit;
    }
    
    echo "<div class='success'>✅ Database tables: EXIST</div>";
    
    // Check current admin count
    $admin_count = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
    echo "<div class='info'>📊 Current admin accounts: <strong>$admin_count</strong></div>";
    
    if ($admin_count == 0) {
        echo "<div class='warning'>⚠️ No admin accounts found. You can create the first admin below.</div>";
        $can_create = true;
    } else {
        // Show existing admins
        echo "<div class='success'>✅ Admin accounts found:</div>";
        $admins = $pdo->query("SELECT id, username, email, created_at FROM admins")->fetchAll();
        echo "<ul>";
        foreach ($admins as $admin) {
            echo "<li><strong>" . htmlspecialchars($admin['username']) . "</strong> (" . htmlspecialchars($admin['email']) . ") - Created: " . $admin['created_at'] . "</li>";
        }
        echo "</ul>";
        
        $can_create = false;
        echo "<div class='info'>
            <h3>🔑 Try logging in with existing credentials:</h3>
            <p><strong>Login URL:</strong> <a href='admin/login.php'>admin/login.php</a></p>
            <p><strong>Default credentials (if using original setup):</strong></p>
            <p>Username: <code>admin</code></p>
            <p>Password: <code>password123</code></p>
        </div>";
    }
    
    // Handle form submission for creating new admin
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_admin']) && $can_create) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        
        if (empty($username) || empty($email) || empty($password)) {
            echo "<div class='error'>❌ Please fill in all fields</div>";
        } elseif (strlen($password) < 8) {
            echo "<div class='error'>❌ Password must be at least 8 characters long</div>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$username, $hashed_password, $email])) {
                echo "<div class='success'>✅ Admin account '$username' created successfully!</div>";
                echo "<div class='info'>
                    <h3>🎉 Success! You can now login:</h3>
                    <p><strong>Login URL:</strong> <a href='admin/login.php'>admin/login.php</a></p>
                    <p><strong>Username:</strong> $username</p>
                    <p><strong>Password:</strong> (the one you just entered)</p>
                </div>";
                $can_create = false;
            } else {
                echo "<div class='error'>❌ Failed to create admin account</div>";
            }
        }
    }
    
    // Show create form if no admins exist
    if ($can_create) {
        echo "<h2>🔧 Create First Admin Account</h2>";
        echo "<form method='POST'>
            <h3>Create Admin Account</h3>
            <input type='text' name='username' placeholder='Username (e.g., admin)' required>
            <input type='email' name='email' placeholder='Email address' required>
            <input type='password' name='password' placeholder='Password (min 8 characters)' required minlength='8'>
            <button type='submit' name='create_admin'>Create Admin Account</button>
        </form>";
    }
    
    // Test password verification with existing hash
    if ($admin_count > 0) {
        echo "<h2>🔍 Password Verification Test</h2>";
        $admin = $pdo->query("SELECT username, password FROM admins LIMIT 1")->fetch();
        if ($admin) {
            $test_passwords = ['password123', 'admin', 'password', 'bloodhero123'];
            echo "<div class='info'>Testing common passwords for user '<strong>" . htmlspecialchars($admin['username']) . "</strong>':</div>";
            
            foreach ($test_passwords as $test_pass) {
                $is_valid = password_verify($test_pass, $admin['password']);
                $status = $is_valid ? "✅ MATCH" : "❌ No match";
                echo "<div class='" . ($is_valid ? "success" : "error") . "'>Password '$test_pass': $status</div>";
                
                if ($is_valid) {
                    echo "<div class='success'>
                        <h3>🎉 Found working password!</h3>
                        <p><strong>Username:</strong> " . htmlspecialchars($admin['username']) . "</p>
                        <p><strong>Password:</strong> $test_pass</p>
                        <p><a href='admin/login.php'>Go to Admin Login</a></p>
                    </div>";
                    break;
                }
            }
        }
    }
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Database Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    echo "<div class='warning'>
        <h3>🔧 Troubleshooting Steps:</h3>
        <ol>
            <li>Make sure XAMPP MySQL is running</li>
            <li>Check if database 'bloodhero' exists</li>
            <li>Import database/bloodhero.sql file</li>
            <li>Verify database credentials in config/database.php</li>
        </ol>
    </div>";
}

echo "<br><hr>";
echo "<div class='info'>
    <h3>📚 Quick Links:</h3>
    <p><a href='admin/login.php'>Admin Login</a> | <a href='admin/create_admin.php'>Admin Management</a> | <a href='index.php'>Back to Website</a></p>
</div>";
?> 