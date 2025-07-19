<?php
require_once 'config/database.php';
$page_title = 'Privacy Policy';
include 'includes/header.php';
?>

<div class="card">
    <h1>Privacy Policy</h1>
    <p><strong>Effective Date:</strong> <?php echo date('F j, Y'); ?></p>
    <p><strong>Last Updated:</strong> <?php echo date('F j, Y'); ?></p>
    
    <p>At BloodHero, we are committed to protecting your privacy and ensuring the security of your personal and medical information. This Privacy Policy explains how we collect, use, protect, and share your information when you use our blood donation platform.</p>
</div>

<div class="card">
    <h2>🩸 Information We Collect</h2>
    
    <h3>Personal Information</h3>
    <ul>
        <li><strong>Contact Details:</strong> Name, email address, phone number, home address</li>
        <li><strong>Identification:</strong> Date of birth, government ID information (for verification)</li>
        <li><strong>Emergency Contact:</strong> Name and phone number of emergency contact person</li>
    </ul>
    
    <h3>Medical Information</h3>
    <ul>
        <li><strong>Blood Type:</strong> ABO blood group and Rh factor</li>
        <li><strong>Health Status:</strong> Basic health questionnaire responses</li>
        <li><strong>Donation History:</strong> Dates and locations of previous donations</li>
        <li><strong>Eligibility Status:</strong> Current eligibility to donate blood</li>
    </ul>
    
    <h3>Usage Information</h3>
    <ul>
        <li><strong>Website Usage:</strong> Pages visited, time spent on site, browser information</li>
                        <li><strong>Communication Preferences:</strong> How you prefer to be contacted (SMS, email)</li>
    </ul>
</div>

<div class="card">
    <h2>📋 How We Use Your Information</h2>
    
    <h3>Primary Purposes</h3>
    <ul>
        <li><strong>Donor Registration:</strong> Creating and managing your donor profile</li>
        <li><strong>Blood Matching:</strong> Matching your blood type with urgent medical needs</li>
        <li><strong>Donation Coordination:</strong> Notifying you when your blood type is needed</li>
        <li><strong>Health & Safety:</strong> Ensuring donation safety and tracking donation intervals</li>
    </ul>
    
    <h3>Communication</h3>
    <ul>
        <li>Emergency blood request notifications</li>
        <li>Appointment confirmations and reminders</li>
        <li>Health and eligibility updates</li>
        <li>Important platform announcements</li>
    </ul>
    
    <h3>Service Improvement</h3>
    <ul>
        <li>Analyzing donation patterns to improve blood bank efficiency</li>
        <li>Enhancing user experience on our platform</li>
        <li>Generating anonymous statistics for public health research</li>
    </ul>
</div>

<div class="card">
    <h2>🏥 Information Sharing</h2>
    
    <h3>Medical Centers & Hospitals</h3>
    <p>We share necessary donor information with verified medical facilities when:</p>
    <ul>
        <li>Your blood type matches an urgent medical need</li>
        <li>You consent to donate at a specific facility</li>
        <li>Emergency situations require immediate blood supply</li>
    </ul>
    
    <h3>Lebanese Red Cross</h3>
    <p>We may share anonymous donation statistics with the Lebanese Red Cross and Ministry of Health for:</p>
    <ul>
        <li>National blood supply planning</li>
        <li>Public health research and policy</li>
        <li>Emergency response coordination</li>
    </ul>
    
    <h3>Third-Party Services</h3>
    <p>We use trusted third-party services for:</p>
    <ul>
                        <li><strong>SMS Services:</strong> For sending donation notifications (we only share phone numbers)</li>
        <li><strong>Email Services:</strong> For sending important communications (we only share email addresses)</li>
        <li><strong>Security Services:</strong> For protecting our platform and your data</li>
    </ul>
    
    <div style="background: var(--secondary-color); padding: 1rem; border-radius: var(--border-radius); margin: 1rem 0;">
        <strong>⚠️ Important:</strong> We NEVER sell your personal information to third parties or use it for commercial marketing purposes.
    </div>
</div>

<div class="card">
    <h2>🔒 Data Security</h2>
    
    <h3>Security Measures</h3>
    <ul>
        <li><strong>Encryption:</strong> All sensitive data is encrypted in transit and at rest</li>
        <li><strong>Access Control:</strong> Strict access controls limit who can view your information</li>
        <li><strong>Secure Servers:</strong> Our servers are protected with industry-standard security</li>
        <li><strong>Regular Audits:</strong> We conduct regular security assessments and updates</li>
    </ul>
    
    <h3>Data Retention</h3>
    <ul>
        <li><strong>Active Donors:</strong> We retain your information while you're an active donor</li>
        <li><strong>Inactive Donors:</strong> Information is archived after 2 years of inactivity</li>
        <li><strong>Medical Records:</strong> Donation history may be retained longer for medical safety</li>
        <li><strong>Deletion Requests:</strong> You can request deletion of your data at any time</li>
    </ul>
</div>

<div class="card">
    <h2>👤 Your Rights</h2>
    
    <h3>Access & Control</h3>
    <p>You have the right to:</p>
    <ul>
        <li><strong>Access:</strong> View all personal information we have about you</li>
        <li><strong>Update:</strong> Correct or update your personal and contact information</li>
        <li><strong>Delete:</strong> Request deletion of your account and personal data</li>
        <li><strong>Opt-out:</strong> Unsubscribe from non-essential communications</li>
        <li><strong>Data Portability:</strong> Request a copy of your data in a portable format</li>
    </ul>
    
    <h3>Communication Preferences</h3>
    <ul>
                        <li>Choose how you want to be contacted (SMS, email)</li>
        <li>Set preferences for urgent vs. non-urgent notifications</li>
        <li>Update your availability status for donations</li>
    </ul>
    
    <div style="background: var(--accent-color); color: white; padding: 1rem; border-radius: var(--border-radius); margin: 1rem 0;">
        <strong>📞 Exercise Your Rights:</strong> Contact us at privacy@bloodhero.com or +961-7-123456 to exercise any of these rights.
    </div>
</div>

<div class="card">
    <h2>🏥 Medical Data Protection</h2>
    
    <p>As a healthcare-related platform, we follow strict medical data protection standards:</p>
    
    <h3>HIPAA-Style Protections</h3>
    <ul>
        <li>Medical information is only shared for treatment, payment, or healthcare operations</li>
        <li>Access to medical data is logged and monitored</li>
        <li>Staff undergo privacy and security training</li>
    </ul>
    
    <h3>Lebanese Privacy Laws</h3>
    <ul>
        <li>We comply with Lebanese data protection regulations</li>
        <li>We follow Ministry of Health guidelines for medical data</li>
        <li>We respect patient confidentiality principles</li>
    </ul>
</div>

<div class="card">
    <h2>🍪 Cookies & Tracking</h2>
    
    <h3>Essential Cookies</h3>
    <p>We use essential cookies for:</p>
    <ul>
        <li>Keeping you logged in during your session</li>
        <li>Remembering your language and display preferences</li>
        <li>Ensuring website security and preventing fraud</li>
    </ul>
    
    <h3>Analytics</h3>
    <p>We may use analytics tools to understand how our website is used, but:</p>
    <ul>
        <li>No personal information is shared with analytics providers</li>
        <li>Data is anonymized and aggregated</li>
        <li>You can opt-out of analytics tracking</li>
    </ul>
</div>

<div class="card">
    <h2>🔄 Policy Updates</h2>
    
    <p>We may update this Privacy Policy to reflect changes in our practices or legal requirements. When we do:</p>
    <ul>
        <li>We'll update the "Last Updated" date at the top of this page</li>
        <li>We'll notify active donors of significant changes via email</li>
        <li>We'll post updates on our website homepage</li>
        <li>Continued use of our services means you accept the updated policy</li>
    </ul>
</div>

<div class="card">
    <h2>📞 Contact Us</h2>
    
    <p>If you have questions about this Privacy Policy or how we handle your information:</p>
    
    <div style="background: var(--secondary-color); padding: 1.5rem; border-radius: var(--border-radius); margin: 1rem 0;">
        <h3>Privacy Officer</h3>
        <p><strong>📧 Email:</strong> privacy@bloodhero.com</p>
        <p><strong>📞 Phone:</strong> +961-7-123456</p>
        <p><strong>📍 Address:</strong> BloodHero Privacy Office<br>Saida, Lebanon</p>
        <p><strong>⏰ Response Time:</strong> We'll respond to privacy requests within 72 hours</p>
    </div>
    
    <div style="background: var(--primary-color); color: white; padding: 1rem; border-radius: var(--border-radius); margin: 1rem 0;">
        <strong>🚨 Emergency Data Requests:</strong> For urgent medical situations requiring immediate access to donor information, contact our emergency line: +961-7-BLOOD (25663)
    </div>
</div>

<div class="card">
    <h2>🤝 Your Trust</h2>
    
    <p>Your trust is essential to our mission of saving lives through blood donation. We are committed to:</p>
    <ul>
        <li>Being transparent about how we use your information</li>
        <li>Protecting your privacy while enabling life-saving donations</li>
        <li>Continuously improving our security and privacy practices</li>
        <li>Putting donor welfare and privacy first in all our decisions</li>
    </ul>
    
    <p><strong>Thank you for trusting BloodHero with your information and for your life-saving commitment to blood donation.</strong></p>
</div>

<?php include 'includes/footer.php'; ?> 