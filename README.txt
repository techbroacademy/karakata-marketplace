KARAKATA PHP MARKETPLACE - SETUP GUIDE

REQUIREMENTS
- PHP 8.1 or newer
- MySQL 5.7+ or MariaDB
- Apache web server (XAMPP, WAMP, Laragon, cPanel hosting)
- PHP extensions: PDO, pdo_mysql, fileinfo

WINDOWS LOCAL SETUP WITH XAMPP
1. Download and install XAMPP: https://www.apachefriends.org/
2. Open XAMPP Control Panel. Start Apache and MySQL.
3. Extract the karakata-php.zip file.
4. Copy the extracted "KARAKATA-PHP" folder into:
   C:\xampp\htdocs\
5. Open http://localhost/phpmyadmin
6. Click "New", create a database named: karakata
7. Select the karakata database, click Import, choose database.sql from the project folder, then click Import/Go.
8. Open config.php and confirm:
   DB_HOST = localhost
   DB_NAME = karakata
   DB_USER = root
   DB_PASS = '' (blank by default on a fresh XAMPP install)
9. Open the website:
   http://localhost/KARAKATA-PHP/

USING A HOSTING ACCOUNT
1. Create a MySQL database and database user in your hosting control panel.
2. Import database.sql using phpMyAdmin.
3. Upload the project files into public_html (or a subfolder).
4. Edit config.php with your hosting database host, database name, username and password.
5. Ensure uploads/ is writable by PHP (usually permissions 755; follow your host's guidance).
6. Visit your domain.

FEATURES
- Account registration, login and logout
- Product listings with photo, price, description, location, category and condition
- Search and category/condition filters
- Buyer/seller conversations with message history
- Price offers sent as chat messages
- Seller can mark an item as sold
- Responsive desktop and mobile layout

IMPORTANT
- This package is a starter marketplace, not a payment platform. It does not process payments, provide escrow, delivery tracking or dispute resolution.
- Chat refreshes when the conversation page is refreshed; this PHP version does not use a persistent websocket server.
- Before public launch, enable HTTPS, use a strong non-default database password, configure secure session cookies, add rate limiting and CSRF protection to every state-changing form, verify uploaded images by decoding/re-encoding them, add moderation/reporting and backups, and review local privacy and consumer-protection requirements.
- For production, keep database.sql and config.php outside the public web root where possible, or enforce server-level access restrictions.
