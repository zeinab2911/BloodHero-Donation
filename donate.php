<?php
// Start session first
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/database.php';

// Process form submission BEFORE including header
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $blood_type = $_POST['blood_type'];
    $residence = trim($_POST['residence']);
    $last_donation_date = $_POST['last_donation_date'] ?: null;
    
    
    $errors = [];
    if (empty($name)) $errors[] = "Name is required";
    if (empty($phone)) $errors[] = "Phone number is required";
    if ($age < 18 || $age > 60) $errors[] = "Age must be between 18 and 60";
    if (empty($gender)) $errors[] = "Gender is required";
    if (empty($blood_type)) $errors[] = "Blood type is required";
    if (empty($residence)) $errors[] = "Place of residence is required";
    
    
    $stmt = $pdo->prepare("SELECT id FROM donors WHERE phone = ?");
    $stmt->execute([$phone]);
    if ($stmt->fetch()) {
        $errors[] = "This phone number is already registered";
    }
    
    if (empty($errors)) {
        try {
            $donor_id = generateDonorIdWithCurrentFormat();
            
    
            do {
                $stmt = $pdo->prepare("SELECT id FROM donors WHERE donor_id = ?");
                $stmt->execute([$donor_id]);
                if ($stmt->fetch()) {
                    $donor_id = generateDonorIdWithCurrentFormat();
                } else {
                    break;
                }
            } while (true);
            
            $stmt = $pdo->prepare("
                INSERT INTO donors (donor_id, name, phone, age, gender, blood_type, residence, last_donation_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            $stmt->execute([$donor_id, $name, $phone, $age, $gender, $blood_type, $residence, $last_donation_date]);
            
            // Send SMS confirmation (optional - only if SMS is configured)
            try {
                if (file_exists('includes/sms_service.php')) {
                require_once 'includes/sms_service.php';
                $sms = new SMSService();
                    $result = $sms->sendDonationConfirmation($phone, $donor_id, $name);
                    
                    if (!$result['success']) {
                        error_log("SMS confirmation failed for donor $donor_id: " . $result['message']);
                    }
                }
            } catch (Exception $e) {
                // SMS failed, but registration was successful - log error but don't fail
                error_log("SMS confirmation failed for donor $donor_id: " . $e->getMessage());
            }
            
            $_SESSION['success'] = "Registration successful! Your donor ID is: <strong>$donor_id</strong>. Please save this ID for future reference.";
            header('Location: donate.php');
            exit;
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Registration failed. Please try again.";
        }
    } else {
        $_SESSION['error'] = implode('<br>', $errors);
    }
}

// Now include header after processing
$page_title = 'Become a Donor';
include 'includes/header.php';
?>

<div class="card">
    <h2>🩸 Become a Blood Hero</h2>
    <p>Register as a blood donor and help save lives in your community. Your information will be kept confidential and used only for blood donation coordination.</p>
</div>

<div class="card">
    <h3>🔍 Already a donor? Update your information</h3>
    <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 2rem;">
        <input type="text" id="search-donor-id" placeholder="Enter your Donor ID (e.g., BH123456)" style="flex: 1; padding: 0.8rem; border: 2px solid var(--secondary-color); border-radius: var(--border-radius);">
        <button onclick="searchDonor(document.getElementById('search-donor-id').value)" class="btn">Search</button>
    </div>
</div>

<div class="form-container" style="margin-bottom: 4rem;">
    <h3>Donor Registration Form</h3>
    
    <form id="donor-form" method="POST">
        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required placeholder="70123456" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label for="age">Age *</label>
                <input type="number" id="age" name="age" min="18" max="60" required value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="gender">Gender *</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="blood_type">Blood Type *</label>
            <select id="blood_type" name="blood_type" required>
                <option value="">Select Blood Type</option>
                <?php
                $blood_types = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                foreach ($blood_types as $type) {
                    $selected = (isset($_POST['blood_type']) && $_POST['blood_type'] === $type) ? 'selected' : '';
                    echo "<option value=\"$type\" $selected>$type</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="residence">Place of Residence *</label>
            <input type="text" id="residence" name="residence" required placeholder="e.g., Saida, Beirut, Tyre" value="<?php echo isset($_POST['residence']) ? htmlspecialchars($_POST['residence']) : ''; ?>">
            <small style="color: var(--dark-secondary); font-size: 0.9rem;">This helps us match you with nearby medical centers</small>
        </div>
        
        <div class="form-group">
            <label for="last_donation_date">Last Donation Date (if any)</label>
            <input type="date" id="last_donation_date" name="last_donation_date" value="<?php echo isset($_POST['last_donation_date']) ? $_POST['last_donation_date'] : ''; ?>">
            <small style="color: var(--dark-secondary); font-size: 0.9rem;">Leave empty if you've never donated before</small>
        </div>
        
        <div style="background: var(--secondary-color); padding: 1.5rem; border-radius: var(--border-radius); margin: 1.5rem 0;">
            <h4>🛡️ Privacy & Security</h4>
            <ul style="margin: 0.5rem 0; padding-left: 1.5rem;">
                <li>Your information is encrypted and secure</li>
                <li>We only contact you when your blood type is needed</li>
                <li>You can update or delete your information anytime</li>
                <li>No spam or marketing messages</li>
            </ul>
        </div>
        
        <div style="background: var(--primary-color); padding: 1.5rem; border-radius: var(--border-radius); margin: 1.5rem 0;">
            <h4>📋 Donation Eligibility</h4>
            <ul style="margin: 0.5rem 0; padding-left: 1.5rem;">
                <li>Must be between 18-60 years old</li>
                <li>Weigh at least 50kg (110 lbs)</li>
                <li>Be in good health</li>
                <li>Wait at least 8 weeks between donations</li>
            </ul>
        </div>
        
        <button type="submit" class="btn" style="width: 100%; font-size: 1.1rem; padding: 1rem;">
            Register as Blood Donor
        </button>
    </form>
</div>

<div class="card" style="margin-bottom: 3rem;">
    <h3>What Happens After Registration?</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 1rem;">
        <div>
            <h4>📧 Instant Confirmation</h4>
            <p>You'll receive your unique donor ID immediately. Save this ID for future updates to your information.</p>
        </div>
        <div>
            <h4>📱 Smart Notifications</h4>
            <p>We'll contact you via SMS only when your blood type is urgently needed and you're eligible to donate.</p>
        </div>
        <div>
            <h4>🗺️ Location Matching</h4>
            <p>Based on your residence, we'll connect you with the nearest medical centers when blood is needed.</p>
        </div>
    </div>
</div>



<script>

document.getElementById('donor-form').addEventListener('submit', function(e) {
    if (this.querySelector('button[type="submit"]').textContent === 'Update Information') {

        return;
    }
    
    
});
</script>

<?php include 'includes/footer.php'; ?> 