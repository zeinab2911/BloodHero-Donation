# BloodHero - Blood Donation Management System

A comprehensive web-based blood donation management system designed for blood banks and medical centers in Lebanon.

## 🩸 About BloodHero

BloodHero is a PHP-based web application that helps blood banks and medical centers manage donors, track blood inventory, and facilitate the blood donation process. The system provides a user-friendly interface for administrators and medical staff to efficiently manage blood donation operations.

## ✨ Features

### For Administrators
- **Donor Management**: Complete donor profiles with contact information and donation history
- **Blood Inventory Tracking**: Real-time blood type availability and stock management
- **Eligibility Checking**: Automated donor eligibility based on donation intervals
- **Advanced Filtering**: Filter donors by location, blood type, and eligibility status
- **Bulk Operations**: Send messages to multiple donors simultaneously
- **Statistics Dashboard**: Comprehensive analytics and reporting

### For Medical Centers
- **Secure Login**: Role-based access control for medical center staff
- **Blood Request Management**: Submit and track blood requests
- **Inventory Updates**: Real-time blood inventory management
- **Donor Communication**: Direct messaging system for donor coordination

## 🚀 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependency management)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/BloodHero.git
   cd BloodHero
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure database**
   - Create a MySQL database
   - Import the database schema from `database/bloodhero.sql`
   - Update database credentials in `config/database.php`

4. **Configure Twilio (Optional)**
   - Copy `config/twilio_config.php.example` to `config/twilio_config.php`
   - Add your Twilio credentials for SMS functionality

5. **Set up web server**
   - Point your web server to the BloodHero directory
   - Ensure PHP has write permissions for session and log files

6. **Create admin account**
   - Visit `setup_admin.php` to create the initial administrator account
   - Remove `setup_admin.php` after creating the admin account

## 📁 Project Structure

```
BloodHero/
├── admin/                 # Admin panel files
│   ├── donor-management.php
│   ├── login.php
│   └── logout.php
├── api/                   # API endpoints
├── assets/                # Static assets (CSS, JS, images)
├── config/                # Configuration files
├── database/              # Database schema and migrations
├── includes/              # PHP includes and services
├── index.php              # Main entry point
└── README.md              # This file
```

## 🔧 Configuration

### Database Configuration
Edit `config/database.php` with your database credentials:
```php
$host = 'localhost';
$dbname = 'bloodhero';
$username = 'your_username';
$password = 'your_password';
```

### SMS Configuration (Optional)
Edit `config/twilio_config.php` with your Twilio credentials:
```php
'account_sid' => 'YOUR_ACCOUNT_SID',
'auth_token' => 'YOUR_AUTH_TOKEN',
'twilio_number' => 'YOUR_TWILIO_PHONE_NUMBER',
```

## 🛡️ Security Features

- **Password Hashing**: All passwords are securely hashed using PHP's password_hash()
- **Session Management**: Secure session handling with proper authentication
- **SQL Injection Protection**: Prepared statements for all database queries
- **XSS Protection**: Input sanitization and output escaping
- **CSRF Protection**: Cross-site request forgery protection
- **Role-based Access**: Different access levels for administrators and medical staff

## 📱 SMS Integration

BloodHero includes optional SMS functionality using Twilio:
- Emergency blood requests
- Donation reminders
- Blood drive notifications
- Bulk messaging capabilities

## 🧪 Testing

Run the test files to verify functionality:
- `test-twilio.php` - Test SMS integration
- `debug-sms-error.php` - Debug SMS service issues

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

If you encounter any issues or have questions:
1. Check the documentation in the project files
2. Review the error logs
3. Create an issue on GitHub with detailed information

## 🙏 Acknowledgments

- Built with PHP, MySQL, and modern web technologies
- Designed for the Lebanese healthcare system
- Inspired by the need for efficient blood donation management

---

**BloodHero** - Making blood donation management efficient and life-saving! 🩸❤️ 