<?php
require_once 'config/database.php';
$page_title = 'Home';
include 'includes/header.php';
?>

<section class="hero">
    <h1>Save Lives with BloodHero</h1>
    <p class="subtitle">Connecting blood donors with medical centers across Lebanon</p>
    <img src="assets/images/hero-image.jpg" alt="Blood Donation" class="hero-img">
    <div style="margin-top: 2rem;">
        <a href="donate.php" class="btn" style="margin-right: 1rem;">Become a Donor</a>
        <a href="blood-bank.php" class="btn btn-secondary">Check Blood Availability</a>
    </div>
</section>

<div class="card">
    <h2>Why Donate Blood?</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div style="text-align: center; padding: 1.5rem;">
            <h3>🩸 Save Lives</h3>
            <p>One blood donation can save up to three lives. Your donation could be the difference between life and death for someone in need.</p>
        </div>
        <div style="text-align: center; padding: 1.5rem;">
            <h3>⚡ Quick Process</h3>
            <p>Registration takes just minutes, and we'll connect you with nearby medical centers when your blood type is needed.</p>
        </div>
        <div style="text-align: center; padding: 1.5rem;">
            <h3>🏥 Support Hospitals</h3>
            <p>Help hospitals, Red Cross, and emergency services maintain adequate blood supplies for emergencies and surgeries.</p>
        </div>
    </div>
</div>

<div class="card">
    <h2>How BloodHero Works</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div style="text-align: center;">
            <div style="background: var(--primary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; font-weight: bold;">1</div>
            <h3>Register as Donor</h3>
            <p>Fill out our simple registration form with your basic information and blood type. Get your unique donor ID instantly.</p>
        </div>
        <div style="text-align: center;">
            <div style="background: var(--primary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; font-weight: bold;">2</div>
            <h3>Wait for Notification</h3>
                            <p>When your blood type is needed, we'll send you a message via SMS if you're eligible to donate.</p>
        </div>
        <div style="text-align: center;">
            <div style="background: var(--primary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; font-weight: bold;">3</div>
            <h3>Donate & Save Lives</h3>
            <p>Visit the nearest medical center and donate blood. Your contribution helps save lives in your community.</p>
        </div>
    </div>
</div>

<div class="card">
    <h2>Blood Types We Need</h2>
    <p>All blood types are valuable, but some are more urgently needed than others:</p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1rem; margin: 2rem 0;">
        <div style="text-align: center; padding: 1rem; background: var(--secondary-color); border-radius: var(--border-radius);">
            <div class="blood-type" style="font-size: 2rem;">O-</div>
            <p style="font-size: 0.9rem; margin-top: 0.5rem;">Universal Donor</p>
        </div>
        <div style="text-align: center; padding: 1rem; background: var(--secondary-color); border-radius: var(--border-radius);">
            <div class="blood-type" style="font-size: 2rem;">O+</div>
            <p style="font-size: 0.9rem; margin-top: 0.5rem;">Most Common</p>
        </div>
        <div style="text-align: center; padding: 1rem; background: var(--secondary-color); border-radius: var(--border-radius);">
            <div class="blood-type" style="font-size: 2rem;">A-</div>
            <p style="font-size: 0.9rem; margin-top: 0.5rem;">High Demand</p>
        </div>
        <div style="text-align: center; padding: 1rem; background: var(--secondary-color); border-radius: var(--border-radius);">
            <div class="blood-type" style="font-size: 2rem;">B-</div>
            <p style="font-size: 0.9rem; margin-top: 0.5rem;">Rare Type</p>
        </div>
        <div style="text-align: center; padding: 1rem; background: var(--secondary-color); border-radius: var(--border-radius);">
            <div class="blood-type" style="font-size: 2rem;">AB-</div>
            <p style="font-size: 0.9rem; margin-top: 0.5rem;">Rarest Type</p>
        </div>
        <div style="text-align: center; padding: 1rem; background: var(--secondary-color); border-radius: var(--border-radius);">
            <div class="blood-type" style="font-size: 2rem;">AB+</div>
            <p style="font-size: 0.9rem; margin-top: 0.5rem;">Universal Receiver</p>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 2rem;">
        <a href="donate.php" class="btn">Register to Donate Now</a>
    </div>
</div>





<?php include 'includes/footer.php'; ?> 