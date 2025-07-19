<?php
/**
 * Twilio SMS Test File
 * Use this to test your Twilio integration
 */

// Include the SMS service
require_once 'includes/sms_service.php';

// Start output buffering for better display
ob_start();

echo "<h1>🧪 BloodHero Twilio SMS Test</h1>\n";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .success { color: green; }
    .error { color: red; }
    .info { color: blue; }
    .test-section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
    pre { background: #f5f5f5; padding: 10px; border-radius: 3px; }
</style>\n";

// Initialize SMS service
try {
    $sms = new SMSService();
    echo "<div class='test-section'>\n";
    echo "<h2>📋 Configuration Status</h2>\n";
    
    $status = $sms->getConfigStatus();
    
    echo "<ul>\n";
    foreach ($status as $key => $value) {
        $class = $value ? 'success' : 'error';
        $icon = $value ? '✅' : '❌';
        echo "<li class='$class'>$icon $key: " . ($value ? 'Configured' : 'Not Configured') . "</li>\n";
    }
    echo "</ul>\n";
    echo "</div>\n";
    
    // Test configuration
    if ($status['fully_configured']) {
        echo "<div class='test-section'>\n";
        echo "<h2>🎯 SMS Test</h2>\n";
        echo "<p class='info'>Enter a phone number to test SMS functionality:</p>\n";
        
        if ($_POST && isset($_POST['test_number'])) {
            $test_number = $_POST['test_number'];
            echo "<p><strong>Testing SMS to: $test_number</strong></p>\n";
            
            $result = $sms->testSMS($test_number);
            
            if ($result['success']) {
                echo "<p class='success'>✅ SMS sent successfully!</p>\n";
                echo "<p><strong>Message SID:</strong> " . $result['sid'] . "</p>\n";
            } else {
                echo "<p class='error'>❌ SMS failed: " . $result['message'] . "</p>\n";
            }
        }
        
        echo "<form method='POST'>\n";
        echo "<label for='test_number'>Phone Number (with country code):</label><br>\n";
        echo "<input type='tel' name='test_number' id='test_number' placeholder='+96170123456' required style='padding: 8px; margin: 10px 0; width: 200px;'>\n";
        echo "<br><button type='submit' style='padding: 10px 20px; background: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer;'>Send Test SMS</button>\n";
        echo "</form>\n";
        echo "</div>\n";
        
        // Test different SMS types
        echo "<div class='test-section'>\n";
        echo "<h2>📱 SMS Type Examples</h2>\n";
        echo "<p class='info'>Here are examples of different SMS types you can send:</p>\n";
        
        echo "<h3>1. Emergency Blood Request</h3>\n";
        echo "<pre>";
        echo htmlspecialchars('$sms->sendEmergencyBloodRequest(
    "+96170123456",
    "A+",
    "Beirut Medical Center", 
    "+96170123456",
    "Critical"
);');
        echo "</pre>\n";
        
        echo "<h3>2. Donation Reminder</h3>\n";
        echo "<pre>";
        echo htmlspecialchars('$sms->sendDonationReminder(
    "+96170123456",
    "John Doe",
    "O+"
);');
        echo "</pre>\n";
        
        echo "<h3>3. Blood Drive Campaign</h3>\n";
        echo "<pre>";
        echo htmlspecialchars('$sms->sendBloodDriveCampaign(
    "+96170123456",
    "Beirut City Center",
    "2024-01-15",
    "10:00 AM"
);');
        echo "</pre>\n";
        
        echo "</div>\n";
        
    } else {
        echo "<div class='test-section'>\n";
        echo "<h2>⚠️ Configuration Required</h2>\n";
        echo "<p class='error'>Twilio is not properly configured. Please follow these steps:</p>\n";
        echo "<ol>\n";
        echo "<li>Sign up for a Twilio account at <a href='https://www.twilio.com/' target='_blank'>twilio.com</a></li>\n";
        echo "<li>Get your Account SID and Auth Token from the Twilio Console</li>\n";
        echo "<li>Purchase a Twilio phone number</li>\n";
        echo "<li>Update the credentials in <code>config/twilio_config.php</code></li>\n";
        echo "<li>Run <code>composer install</code> to install dependencies</li>\n";
        echo "</ol>\n";
        echo "<p><strong>Configuration file location:</strong> <code>config/twilio_config.php</code></p>\n";
        echo "</div>\n";
    }
    
} catch (Exception $e) {
    echo "<div class='test-section'>\n";
    echo "<h2>❌ Error</h2>\n";
    echo "<p class='error'>Error initializing SMS service: " . $e->getMessage() . "</p>\n";
    echo "<p>Make sure you have:</p>\n";
    echo "<ul>\n";
    echo "<li>Installed Composer dependencies: <code>composer install</code></li>\n";
    echo "<li>Created the configuration file: <code>config/twilio_config.php</code></li>\n";
    echo "<li>Set up your Twilio credentials</li>\n";
    echo "</ul>\n";
    echo "</div>\n";
}

// Display the output
$output = ob_get_clean();
echo $output;
?> 