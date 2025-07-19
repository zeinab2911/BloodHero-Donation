<?php
require_once 'config/database.php';
$page_title = 'About Us';
include 'includes/header.php';
?>

<section class="hero">
    <h1>About BloodHero</h1>
    <p class="subtitle">Connecting Lives Through Blood Donation</p>
</section>

<div class="card">
    <h2>Our Mission</h2>
    <p style="font-size: 1.1rem; line-height: 1.8;">
        BloodHero is dedicated to saving lives by creating an efficient network that connects blood donors with medical centers across Lebanon. We leverage technology to ensure that when blood is urgently needed, we can quickly identify and contact eligible donors in the right location, making the difference between life and death.
    </p>
</div>

<div class="card">
    <h2>How We Started</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div>
            <h3>🩸 The Problem</h3>
            <p>Lebanon faces critical blood shortages, especially during emergencies. Many potential donors are willing to help but don't know when or where their blood type is needed. Medical centers struggle to maintain adequate blood supplies and often face shortages during critical moments.</p>
        </div>
        <div>
            <h3>💡 Our Solution</h3>
            <p>BloodHero bridges this gap by creating a smart notification system that connects donors with medical centers in real-time. When a specific blood type is needed, we instantly notify eligible donors in the area, ensuring rapid response times.</p>
        </div>
        <div>
            <h3>🎯 The Impact</h3>
            <p>Since our launch, we've facilitated hundreds of life-saving donations and helped maintain stable blood supplies across our partner medical centers. Every notification sent could potentially save up to three lives.</p>
        </div>
    </div>
</div>

<div class="card">
    <h2 style="color: black;">Our Values</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div style="text-align: center; padding: 2rem; background: var(--primary-color); color: black; border-radius: var(--border-radius);">
            <h3 style="color: black;">🤝 Community First</h3>
            <p>We believe in the power of community to save lives. Every registered donor is a hero contributing to the wellbeing of their neighbors.</p>
        </div>
        <div style="text-align: center; padding: 2rem; background: var(--secondary-color); color: black; border-radius: var(--border-radius);">
            <h3 style="color: black;">⚡ Speed & Efficiency</h3>
            <p>In medical emergencies, every second counts. Our system is designed for rapid response and immediate donor notification.</p>
        </div>
        <div style="text-align: center; padding: 2rem; background: var(--accent-color); color: black; border-radius: var(--border-radius);">
            <h3 style="color: black;">🔒 Privacy & Trust</h3>
            <p>We protect donor information with the highest security standards and only contact donors when their blood type is truly needed.</p>
        </div>
        <div style="text-align: center; padding: 2rem; background: var(--primary-color); color: black; border-radius: var(--border-radius);">
            <h3 style="color: black;">🌟 Innovation</h3>
            <p>We continuously improve our platform with new technologies to make blood donation more accessible and efficient.</p>
        </div>
    </div>
</div>

<div class="card">
    <h2>How BloodHero Works</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem; margin-top: 2rem;">
        <div style="text-align: center;">
            <div style="background: var(--primary-color); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 2rem;">🩸</div>
            <h3>Blood Request</h3>
            <p>Medical centers contact us when they need specific blood types for surgeries, emergencies, or treatments. Our admin team verifies and processes these requests immediately.</p>
        </div>
        <div style="text-align: center;">
            <div style="background: var(--secondary-color); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 2rem;">📍</div>
            <h3>Smart Matching</h3>
            <p>Our system automatically identifies eligible donors based on blood type, location proximity to the medical center, and last donation date to ensure donor health.</p>
        </div>
        <div style="text-align: center;">
            <div style="background: var(--accent-color); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 2rem;">📱</div>
            <h3>Instant Notification</h3>
                            <p>Eligible donors receive SMS messages with donation details, including location and urgency level. Donors can respond immediately.</p>
        </div>
        <div style="text-align: center;">
            <div style="background: var(--primary-color); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 2rem;">❤️</div>
            <h3>Lives Saved</h3>
            <p>Donors visit the medical center and donate blood, directly contributing to saving lives. Each donation can help up to three patients in need.</p>
        </div>
    </div>
</div>

<div class="card">
    <h2>Our Network</h2>
    <p>BloodHero partners with trusted medical institutions across Lebanon:</p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin: 2rem 0;">
        <div style="text-align: center; padding: 2rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>🏥 Hospitals</h3>
            <p>Government and private hospitals that provide critical care and emergency services to the community.</p>
        </div>
        <div style="text-align: center; padding: 2rem; border: 2px solid var(--secondary-color); border-radius: var(--border-radius);">
            <h3>🚑 Red Cross</h3>
            <p>Lebanese Red Cross centers that respond to emergencies and provide humanitarian aid across the country.</p>
        </div>
        <div style="text-align: center; padding: 2rem; border: 2px solid var(--accent-color); border-radius: var(--border-radius);">
            <h3>🛡️ Civil Defense</h3>
            <p>Civil Defense units that handle emergency response and disaster relief operations.</p>
        </div>
        <div style="text-align: center; padding: 2rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>🩸 Blood Banks</h3>
            <p>Specialized blood storage and processing facilities that maintain regional blood supplies.</p>
        </div>
    </div>
</div>

<div class="card">
    <h2>Why Blood Donation Matters</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 2rem;">
        <div style="text-align: center;">
            <div style="font-size: 3rem; color: var(--accent-color); margin-bottom: 1rem;">3</div>
            <h4>Lives Saved</h4>
            <p>Per donation</p>
        </div>
        <div style="text-align: center;">
            <div style="font-size: 3rem; color: var(--accent-color); margin-bottom: 1rem;">4.5M</div>
            <h4>Lives Saved</h4>
            <p>Annually in the US</p>
        </div>
        <div style="text-align: center;">
            <div style="font-size: 3rem; color: var(--accent-color); margin-bottom: 1rem;">38%</div>
            <h4>Population Eligible</h4>
            <p>To donate blood</p>
        </div>
        <div style="text-align: center;">
            <div style="font-size: 3rem; color: var(--accent-color); margin-bottom: 1rem;">10%</div>
            <h4>Actually Donate</h4>
            <p>Of eligible population</p>
        </div>
    </div>
</div>

<div class="card">
    <h2>Join Our Mission</h2>
    <p style="text-align: center; font-size: 1.1rem; margin-bottom: 2rem;">
        Be part of a community that saves lives. Every registration, every donation, every shared message brings us closer to a world where no one dies from blood shortage.
    </p>
    
    <div style="text-align: center;">
        <a href="donate.php" class="btn" style="margin-right: 1rem; font-size: 1.1rem; padding: 1rem 2rem;">
            🩸 Become a Donor
        </a>
        <a href="contact.php" class="btn btn-secondary" style="font-size: 1.1rem; padding: 1rem 2rem;">
            📞 Contact Us
        </a>
    </div>
</div>



<?php include 'includes/footer.php'; ?> 