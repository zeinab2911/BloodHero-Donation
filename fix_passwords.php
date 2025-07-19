<?php
require_once 'config/database.php';

$correct_password = "password123";
$correct_hash = password_hash($correct_password, PASSWORD_DEFAULT);

echo "Updating all medical center passwords...\n";
echo "New password: " . $correct_password . "\n";
echo "New hash: " . $correct_hash . "\n\n";

try {
    
    $stmt = $pdo->prepare("UPDATE medical_centers SET password = ? WHERE username IS NOT NULL");
    $result = $stmt->execute([$correct_hash]);
    
    if ($result) {
        $affected_rows = $stmt->rowCount();
        echo "Successfully updated " . $affected_rows . " medical center passwords.\n\n";
        
        
        $verify_stmt = $pdo->prepare("SELECT username, password FROM medical_centers WHERE username = ?");
        $verify_stmt->execute(['saida_hospital']);
        $test_center = $verify_stmt->fetch();
        
        if ($test_center) {
            echo "Testing verification for saida_hospital:\n";
            $is_valid = password_verify($correct_password, $test_center['password']);
            echo "Password verification: " . ($is_valid ? "SUCCESS ✓" : "FAILED ✗") . "\n";
        }
        
        
        echo "\nAvailable medical center usernames:\n";
        $all_stmt = $pdo->query("SELECT username, name FROM medical_centers WHERE username IS NOT NULL ORDER BY username");
        $centers = $all_stmt->fetchAll();
        
        foreach ($centers as $center) {
            echo "- " . $center['username'] . " (" . $center['name'] . ")\n";
        }
        
    } else {
        echo "Failed to update passwords.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 