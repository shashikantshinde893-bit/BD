BLOOD DONATION MANAGEMENT SYSTEM
Technology: PHP, MySQL, HTML, CSS
Recommended server: XAMPP

INSTALLATION STEPS
1. Install XAMPP.
2. Start Apache and MySQL from XAMPP Control Panel.
3. Copy the folder "Blood_Donation_Management_System" into:
   C:\xampp\htdocs\
4. Open browser:
   http://localhost/phpmyadmin
5. Click Import.
6. Select:
   Blood_Donation_Management_System/database/blood_donation_db.sql
7. Click Go.
8. Open:
   http://localhost/Blood_Donation_Management_System/

MAIN PAGES
Home:
http://localhost/Blood_Donation_Management_System/

Donor registration:
http://localhost/Blood_Donation_Management_System/donor_register.php

Blood request:
http://localhost/Blood_Donation_Management_System/request_blood.php

Admin login:
http://localhost/Blood_Donation_Management_System/login.php

ADMIN LOGIN
Username: admin
Password: password

FEATURES
- Home page
- Donor registration
- Donor list
- Blood request form
- Blood request list
- Admin login
- Admin dashboard
- MySQL database
- Responsive CSS

IF MYSQL PASSWORD IS SET
Edit config/db.php and change:
$pass = "";
to your MySQL password.

TROUBLESHOOTING
- If "Object not found" appears, check that the project folder is inside C:\xampp\htdocs\
- If database connection fails, make sure MySQL is running and check config/db.php.
- If Apache does not start, check whether port 80 is already used.
