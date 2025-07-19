<?php
/**
 * Debug SMS Service Error
 * This file will help identify what error is occurring
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 SMS Service Debug</h1>\n";

try {
    echo "<h2>Step 1: Checking if SMS service file exists</h2>\n";
    $sms_file = 'includes/sms_service.php';
    if (file_exists($sms_file)) {
        echo "✅ SMS service file exists<br>\n";
    } else {
        echo "❌ SMS service file not found<br>\n";
        exit;
    }
    
    echo "<h2>Step 2: Including SMS service file</h2>\n";
    require_once $sms_file;
    echo "✅ SMS service file included successfully<br>\n";
    
    echo "<h2>Step 3: Creating SMS service instance</h2>\n";
    $sms = new SMSService();
    echo "✅ SMS service instance created<br>\n";
    
    echo "<h2>Step 4: Checking configuration status</h2>\n";
    $status = $sms->getConfigStatus();
    echo "<pre>";
    print_r($status);
    echo "</pre>";
    
    echo "<h2>Step 5: Getting detailed status</h2>\n";
    $detailed_status = $sms->getDetailedConfigStatus();
    echo "<pre>";
    print_r($detailed_status);
    echo "</pre>";
    
    echo "<h2>Step 6: Testing SMS functionality</h2>\n";
    if ($status['fully_configured']) {
        echo "✅ SMS service is fully configured<br>\n";
        echo "You can now use SMS functionality<br>\n";
    } else {
        echo "⚠️ SMS service is not fully configured<br>\n";
        if (isset($detailed_status['errors'])) {
            echo "<h3>Issues found:</h3>\n";
            echo "<ul>\n";
            foreach ($detailed_status['errors'] as $error) {
                echo "<li>❌ $error</li>\n";
            }
            echo "</ul>\n";
        }
    }
    
} catch (Exception $e) {
    echo "<h2>❌ Error Occurred</h2>\n";
    echo "<p><strong>Error Type:</strong> " . get_class($e) . "</p>\n";
    echo "<p><strong>Error Message:</strong> " . $e->getMessage() . "</p>\n";
    echo "<p><strong>File:</strong> " . $e->getFile() . "</p>\n";
    echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>\n";
    echo "<p><strong>Stack Trace:</strong></p>\n";
    echo "<pre>" . $e->getTraceAsString() . "</pre>\n";
} catch (Error $e) {
    echo "<h2>❌ Fatal Error Occurred</h2>\n";
    echo "<p><strong>Error Type:</strong> " . get_class($e) . "</p>\n";
    echo "<p><strong>Error Message:</strong> " . $e->getMessage() . "</p>\n";
    echo "<p><strong>File:</strong> " . $e->getFile() . "</p>\n";
    echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>\n";
    echo "<p><strong>Stack Trace:</strong></p>\n";
    echo "<pre>" . $e->getTraceAsString() . "</pre>\n";
}

echo "<h2>✅ Debug Complete</h2>\n";
echo "<p>If you're still seeing errors, please share the output above.</p>\n";
?> 