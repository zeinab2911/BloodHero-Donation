<?php
require_once 'config/database.php';
$page_title = 'Contact Us';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);
    
    $errors = [];
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (empty($message)) $errors[] = "Message is required";
    
    if (empty($errors)) {
    
        $_SESSION['success'] = "Thank you for your message! We'll get back to you within 24 hours.";
        header('Location: contact.php');
        exit;
    } else {
        $_SESSION['error'] = implode('<br>', $errors);
    }
}
?>

<section class="hero">
    <h1>Contact BloodHero</h1>
    <p class="subtitle">We're here to help 24/7. Reach out to us anytime!</p>
</section>



<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
    <div class="card">
        <h2>Get in Touch</h2>
        <form method="POST" style="margin-top: 0;">
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="70123456" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" rows="5" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn" style="width: 100%;">Send Message</button>
        </form>
    </div>

    <div class="card">
        <h2>Contact Information</h2>
        
        <div style="margin: 2rem 0;">
            <h3>📧 Email Addresses</h3>
            <p><strong>General Inquiries:</strong><br>
            <a href="mailto:info@bloodhero.com">bloodherodonation@gmail.com</a></p>
            
        
        <div style="margin: 2rem 0;">
            <h3>📞 Phone Numbers</h3>
            <a href="tel:+96170843830">70843830</a><br>
            <small>For inquiries about site</small></p>
            
        <div style="margin: 2rem 0;">
            <h3>📱 SMS Support</h3>
            <p><strong>Text Messaging:</strong><br>
            <a href="sms:+96170843830">70843830</a><br>
        </div>
    </div>
</div>

<div class="card">
    <h2>❓ Frequently Asked Questions</h2>
    <p style="color: var(--dark-secondary); margin-bottom: 2rem;">Click on any question to see the answer</p>
    
    <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <h3>🩸 How do I register as a donor?</h3>
                <span class="faq-arrow">▼</span>
            </div>
            <div class="faq-answer">
                <p>Visit our <a href="donate.php" style="color: var(--accent-color); font-weight: bold;">donation page</a> and fill out the registration form. You'll receive a unique donor ID instantly that you can use to update your information anytime.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <h3>📞 How often will I be contacted?</h3>
                <span class="faq-arrow">▼</span>
            </div>
            <div class="faq-answer">
                <p>We only contact you when your specific blood type is urgently needed and you're eligible to donate (not within 8 weeks of your last donation). We respect your time and privacy.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <h3>✏️ Can I update my information?</h3>
                <span class="faq-arrow">▼</span>
            </div>
            <div class="faq-answer">
                <p>Yes! Use your donor ID on the <a href="donate.php" style="color: var(--accent-color); font-weight: bold;">donation page</a> to search and update your information anytime. You can change your contact details, address, or last donation date.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <h3>🔒 Is my information secure?</h3>
                <span class="faq-arrow">▼</span>
            </div>
            <div class="faq-answer">
                <p>Absolutely. We use industry-standard encryption and only share your information with verified medical centers when there's an urgent need for your blood type. Your privacy is our priority.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <h3>🏥 How do medical centers request blood?</h3>
                <span class="faq-arrow">▼</span>
            </div>
            <div class="faq-answer">
                <p>Medical centers can email us with their specific blood type requirements and location. We then contact eligible donors in their area who match the needed blood type.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <h3>🗺️ Do you operate outside Saida?</h3>
                <span class="faq-arrow">▼</span>
            </div>
            <div class="faq-answer">
                <p>Currently, we focus on Saida and surrounding areas, but we're expanding to other regions in Lebanon. We connect donors with medical centers based on location proximity.</p>
            </div>
        </div>
    </div>
</div>

<style>
.faq-container {
    margin-top: 2rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
}

.faq-item {
    border: 2px solid var(--secondary-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: var(--transition);
    height: fit-content;
}

.faq-item:hover {
    border-color: var(--accent-color);
}

.faq-question {
    padding: 1.5rem;
    background: var(--secondary-color);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: var(--transition);
    user-select: none;
}

.faq-question:hover {
    background: var(--primary-color);
}

.faq-question.active {
    background: var(--accent-color);
    color: white;
}

.faq-question h3 {
    margin: 0;
    color: var(--dark-primary);
    font-size: 1.1rem;
}

.faq-question.active h3 {
    color: white;
}

.faq-arrow {
    font-size: 1.2rem;
    font-weight: bold;
    color: var(--dark-primary);
    transition: var(--transition);
}

.faq-question.active .faq-arrow {
    color: white;
    transform: rotate(180deg);
}

.faq-answer {
    padding: 0 1.5rem;
    background: white;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-answer.active {
    padding: 1.5rem;
    max-height: 200px;
}

.faq-answer p {
    margin: 0;
    color: var(--dark-primary);
    line-height: 1.6;
}
</style>

<script>
function toggleFAQ(element) {
    const faqItem = element.parentElement;
    const faqAnswer = faqItem.querySelector('.faq-answer');
    const isActive = element.classList.contains('active');
    
    // Close all other FAQ items
    document.querySelectorAll('.faq-question').forEach(q => {
        q.classList.remove('active');
        q.parentElement.querySelector('.faq-answer').classList.remove('active');
    });
    
    // Toggle current item
    if (!isActive) {
        element.classList.add('active');
        faqAnswer.classList.add('active');
    }
}
</script>





<?php include 'includes/footer.php'; ?> 