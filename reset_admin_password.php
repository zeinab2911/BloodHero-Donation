<?php
/**
 * Direct Admin Password Reset Script
 * This script will reset the admin password and verify it works
 */

require_once 'config/database.php';

echo "🔧 BloodHero - Direct Admin Password Reset\n";
echo "==========================================\n\n";

try {
    // First, let's see what's currently in the database
    echo "📊 Current admin account:\n";
    $admin = $pdo->query("SELECT id, username, email, password FROM admins WHERE username = 'admin'")->fetch();
    
    if ($admin) {
        echo "   ID: " . $admin['id'] . "\n";
        echo "   Username: " . $admin['username'] . "\n";
        echo "   Email: " . $admin['email'] . "\n";
        echo "   Password Hash: " . substr($admin['password'], 0, 30) . "...\n\n";
    } else {
        echo "   ❌ No admin account found!\n\n";
    }
    
    // Test the current password against common passwords
    if ($admin) {
        echo "🔍 Testing current password against common passwords:\n";
        $test_passwords = ['password123', 'password', 'admin', 'bloodhero', 'bloodhero123'];
        
        foreach ($test_passwords as $test_pass) {
            $is_valid = password_verify($test_pass, $admin['password']);
            echo "   Testing '$test_pass': " . ($is_valid ? "✅ WORKS" : "❌ No") . "\n";
            
            if ($is_valid) {
                echo "\n✅ FOUND WORKING PASSWORD: '$test_pass'\n";
                echo "You can login with:\n";
                echo "   Username: admin\n";
                echo "   Password: $test_pass\n";
                echo "   URL: http://localhost:8000/admin/login.php\n\n";
                echo "Exiting - no need to reset password.\n";
                exit(0);
            }
        }
        echo "\n❌ None of the common passwords work.\n\n";
    }
    
    // Create/Reset the admin account with a known password
    echo "🔧 Resetting admin password...\n";
    
    // Delete existing admin
    $pdo->exec("DELETE FROM admins WHERE username = 'admin'");
    echo "   ✅ Deleted existing admin account\n";
    
    // Create new admin
    $username = 'admin';
    $password = 'bloodhero2025';
    $email = 'admin@bloodhero.com';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
    $result = $stmt->execute([$username, $hashed_password, $email]);
    
    if ($result) {
        echo "   ✅ Created new admin account\n";
        echo "   New password hash: " . substr($hashed_password, 0, 30) . "...\n\n";
        
        // Immediate verification test
        echo "🔍 Testing new password...\n";
        $verify_stmt = $pdo->prepare("SELECT password FROM admins WHERE username = ?");
        $verify_stmt->execute(['admin']);
        $stored_hash = $verify_stmt->fetchColumn();
        
        $verify_result = password_verify($password, $stored_hash);
        echo "   Password verification: " . ($verify_result ? "✅ SUCCESS" : "❌ FAILED") . "\n\n";
        
        if ($verify_result) {
            echo "🎉 SUCCESS! Admin account reset complete.\n";
            echo "==========================================\n";
            echo "Login Credentials:\n";
            echo "   URL: http://localhost:8000/admin/login.php\n";
            echo "   Username: admin\n";
            echo "   Password: bloodhero2025\n";
            echo "==========================================\n";
        } else {
            echo "❌ ERROR: Password verification failed after creation!\n";
        }
        
    } else {
        echo "   ❌ Failed to create admin account\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
    echo "\n🔧 Troubleshooting:\n";
    echo "1. Make sure XAMPP MySQL is running\n";
    echo "2. Check if database 'bloodhero' exists\n";
    echo "3. Import database/bloodhero.sql if needed\n";
}
?> 