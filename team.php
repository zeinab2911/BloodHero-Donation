<?php
require_once 'config/database.php';
$page_title = 'Our Network';
include 'includes/header.php';
?>

<section class="hero">
    <h1>Our Medical Network</h1>
    <p class="subtitle">Partner hospitals, medical centers, and blood banks across Lebanon</p>
</section>

<div class="card">
    <h2>🚨 Lebanese Red Cross</h2>
    <div style="background: var(--accent-color); color: white; padding: 2rem; border-radius: var(--border-radius); margin: 2rem 0;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div>
                <h3>📍 Main Headquarters</h3>
                <p><strong>Address:</strong> Spears Street, Beirut</p>
                <p><strong>📞 Emergency:</strong> 140</p>
                <p><strong>📞 Blood Bank:</strong> +961-1-373140</p>
                <p><strong>📞 Main Office:</strong> +961-1-366464</p>
            </div>
            <div>
                <h3>🩸 Blood Services</h3>
                <p><strong>Blood Donation Center:</strong> +961-1-371547</p>
                <p><strong>Laboratory:</strong> +961-1-371548</p>
                <p><strong>Emergency Requests:</strong> +961-1-373140</p>
                <p><strong>Website:</strong> www.redcross.org.lb</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h2>🏥 Major Hospitals - Beirut & Mount Lebanon</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: 2rem;">
        
        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>American University of Beirut Medical Center (AUBMC)</h3>
            <p><strong>📍 Location:</strong> Hamra, Beirut</p>
            <p><strong>📞 Main:</strong> +961-1-350000</p>
            <p><strong>📞 Emergency:</strong> +961-1-374374</p>
            <p><strong>🩸 Blood Bank:</strong> +961-1-350000 ext. 5410</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Trauma, Cardiac Surgery, Oncology, Emergency Medicine
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Hotel Dieu de France Hospital</h3>
            <p><strong>📍 Location:</strong> Achrafieh, Beirut</p>
            <p><strong>📞 Main:</strong> +961-1-615300</p>
            <p><strong>📞 Emergency:</strong> +961-1-615400</p>
            <p><strong>🩸 Blood Bank:</strong> +961-1-615350</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Cardiovascular, Neurosurgery, Pediatrics, ICU
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Saint George Hospital University Medical Center</h3>
            <p><strong>📍 Location:</strong> Achrafieh, Beirut</p>
            <p><strong>📞 Main:</strong> +961-1-575700</p>
            <p><strong>📞 Emergency:</strong> +961-1-585100</p>
            <p><strong>🩸 Blood Bank:</strong> +961-1-575750</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Heart Center, Cancer Institute, Emergency
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Makassed General Hospital</h3>
            <p><strong>📍 Location:</strong> Tarik El Jadideh, Beirut</p>
            <p><strong>📞 Main:</strong> +961-1-636700</p>
            <p><strong>📞 Emergency:</strong> +961-1-636800</p>
            <p><strong>🩸 Blood Bank:</strong> +961-1-636750</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> General Medicine, Surgery, Maternity, Pediatrics
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Clemenceau Medical Center</h3>
            <p><strong>📍 Location:</strong> Clemenceau, Beirut</p>
            <p><strong>📞 Main:</strong> +961-1-372888</p>
            <p><strong>📞 Emergency:</strong> +961-1-366166</p>
            <p><strong>🩸 Blood Bank:</strong> +961-1-372900</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Multi-specialty, Emergency Care, Surgery
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Mount Lebanon Hospital</h3>
            <p><strong>📍 Location:</strong> Hazmieh</p>
            <p><strong>📞 Main:</strong> +961-5-471800</p>
            <p><strong>📞 Emergency:</strong> +961-5-471900</p>
            <p><strong>🩸 Blood Bank:</strong> +961-5-471850</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Cardiac Center, Neuroscience, Oncology
            </div>
        </div>

    </div>
</div>

<div class="card">
    <h2>🏥 North Lebanon Hospitals</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: 2rem;">
        
        <div style="padding: 1.5rem; border: 2px solid var(--accent-color); border-radius: var(--border-radius);">
            <h3>Islamic Hospital - Tripoli</h3>
            <p><strong>📍 Location:</strong> Tripoli</p>
            <p><strong>📞 Main:</strong> +961-6-438000</p>
            <p><strong>📞 Emergency:</strong> +961-6-438100</p>
            <p><strong>🩸 Blood Bank:</strong> +961-6-438050</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> General Medicine, Emergency, Surgery
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--accent-color); border-radius: var(--border-radius);">
            <h3>Monla Hospital</h3>
            <p><strong>📍 Location:</strong> Tripoli</p>
            <p><strong>📞 Main:</strong> +961-6-442288</p>
            <p><strong>📞 Emergency:</strong> +961-6-442300</p>
            <p><strong>🩸 Blood Bank:</strong> +961-6-442320</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Multi-specialty, Maternity, Pediatrics
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--accent-color); border-radius: var(--border-radius);">
            <h3>Mazloum Hospital</h3>
            <p><strong>📍 Location:</strong> Tripoli</p>
            <p><strong>📞 Main:</strong> +961-6-425777</p>
            <p><strong>📞 Emergency:</strong> +961-6-425800</p>
            <p><strong>🩸 Blood Bank:</strong> +961-6-425820</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> General Surgery, Internal Medicine
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--accent-color); border-radius: var(--border-radius);">
            <h3>Hospital of Koura</h3>
            <p><strong>📍 Location:</strong> Amioun, Koura</p>
            <p><strong>📞 Main:</strong> +961-6-950500</p>
            <p><strong>📞 Emergency:</strong> +961-6-950600</p>
            <p><strong>🩸 Blood Bank:</strong> +961-6-950550</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Regional Healthcare, Emergency Services
            </div>
        </div>

    </div>
</div>

<div class="card">
    <h2>🏥 South Lebanon Hospitals</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: 2rem;">
        
        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Jabal Amel Hospital</h3>
            <p><strong>📍 Location:</strong> Tyre (Sour)</p>
            <p><strong>📞 Main:</strong> +961-7-741888</p>
            <p><strong>📞 Emergency:</strong> +961-7-741900</p>
            <p><strong>🩸 Blood Bank:</strong> +961-7-741920</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Emergency Medicine, General Surgery, ICU
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Labib Medical Center</h3>
            <p><strong>📍 Location:</strong> Saida</p>
            <p><strong>📞 Main:</strong> +961-7-722888</p>
            <p><strong>📞 Emergency:</strong> +961-7-722900</p>
            <p><strong>🩸 Blood Bank:</strong> +961-7-722920</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Cardiovascular, Neurology, Dialysis
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Hammoud Hospital University Medical Center</h3>
            <p><strong>📍 Location:</strong> Saida</p>
            <p><strong>📞 Main:</strong> +961-7-710000</p>
            <p><strong>📞 Emergency:</strong> +961-7-710100</p>
            <p><strong>🩸 Blood Bank:</strong> +961-7-710150</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> University Hospital, Multi-specialty Care
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Najjar Hospital</h3>
            <p><strong>📍 Location:</strong> Saida</p>
            <p><strong>📞 Main:</strong> +961-7-720000</p>
            <p><strong>📞 Emergency:</strong> +961-7-720100</p>
            <p><strong>🩸 Blood Bank:</strong> +961-7-720120</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> General Medicine, Surgery, Maternity
            </div>
        </div>

    </div>
</div>

<div class="card">
    <h2>🏥 Bekaa Valley Hospitals</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: 2rem;">
        
        <div style="padding: 1.5rem; border: 2px solid var(--accent-color); border-radius: var(--border-radius);">
            <h3>Elias Hrawi Government Hospital</h3>
            <p><strong>📍 Location:</strong> Zahle</p>
            <p><strong>📞 Main:</strong> +961-8-800400</p>
            <p><strong>📞 Emergency:</strong> +961-8-800500</p>
            <p><strong>🩸 Blood Bank:</strong> +961-8-800450</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Regional Government Hospital, Emergency Care
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--accent-color); border-radius: var(--border-radius);">
            <h3>Tel Chiha Hospital</h3>
            <p><strong>📍 Location:</strong> Zahle</p>
            <p><strong>📞 Main:</strong> +961-8-815000</p>
            <p><strong>📞 Emergency:</strong> +961-8-815100</p>
            <p><strong>🩸 Blood Bank:</strong> +961-8-815120</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> General Medicine, Surgery, Pediatrics
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--accent-color); border-radius: var(--border-radius);">
            <h3>Rayak Hospital</h3>
            <p><strong>📍 Location:</strong> Rayak, Bekaa</p>
            <p><strong>📞 Main:</strong> +961-8-540777</p>
            <p><strong>📞 Emergency:</strong> +961-8-540800</p>
            <p><strong>🩸 Blood Bank:</strong> +961-8-540820</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Rural Healthcare, Emergency Services
            </div>
        </div>

    </div>
</div>

<div class="card">
    <h2>🏥 Specialized Medical Centers</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: 2rem;">
        
        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Children's Cancer Center of Lebanon (CCCL)</h3>
            <p><strong>📍 Location:</strong> Beirut</p>
            <p><strong>📞 Main:</strong> +961-1-349292</p>
            <p><strong>📞 Emergency:</strong> +961-1-349300</p>
            <p><strong>🩸 Blood Bank:</strong> +961-1-349310</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Pediatric Oncology, Hematology
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Lebanese National Blood Transfusion Center</h3>
            <p><strong>📍 Location:</strong> Beirut</p>
            <p><strong>📞 Main:</strong> +961-1-615300</p>
            <p><strong>📞 Blood Services:</strong> +961-1-615400</p>
            <p><strong>🩸 Emergency Blood:</strong> +961-1-615450</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Blood Banking, Transfusion Medicine
            </div>
        </div>

        <div style="padding: 1.5rem; border: 2px solid var(--primary-color); border-radius: var(--border-radius);">
            <h3>Middle East Institute of Health</h3>
            <p><strong>📍 Location:</strong> Bsalim</p>
            <p><strong>📞 Main:</strong> +961-4-853000</p>
            <p><strong>📞 Emergency:</strong> +961-4-853100</p>
            <p><strong>🩸 Blood Bank:</strong> +961-4-853120</p>
            <div style="background: var(--secondary-color); padding: 0.5rem; border-radius: 5px; margin-top: 1rem;">
                <strong>Specialties:</strong> Cardiac Surgery, Orthopedics, Neurosurgery
            </div>
        </div>

    </div>
</div>

<div class="card">
    <h2>📋 Emergency Contact Protocol</h2>
    <div style="background: var(--accent-color); color: white; padding: 2rem; border-radius: var(--border-radius); margin: 2rem 0;">
        <h3>🚨 For Emergency Blood Requests:</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 1rem;">
            <div>
                <h4>1. Primary Emergency Line</h4>
                <p><strong>📞 BloodHero Emergency:</strong> +961-7-BLOOD (25663)</p>
                <p>Available 24/7 for urgent blood requests</p>
            </div>
            <div>
                <h4>2. Lebanese Red Cross</h4>
                <p><strong>📞 Emergency:</strong> 140</p>
                <p><strong>📞 Blood Bank:</strong> +961-1-373140</p>
                <p>National emergency services</p>
            </div>
            <div>
                <h4>3. Civil Defense</h4>
                <p><strong>📞 Emergency:</strong> 125</p>
                <p>For ambulance and emergency transport</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h2>🩸 Blood Bank Network Status</h2>
    <p>Our network partners maintain blood banks across Lebanon. Contact any of the above hospitals directly for immediate blood availability, or use our emergency hotline for coordinated response.</p>
    
    <div style="text-align: center; margin: 2rem 0;">
        <a href="blood-bank.php" class="btn" style="margin-right: 1rem;">Check Blood Availability</a>
        <a href="contact.php" class="btn btn-secondary">Report Emergency Need</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 