CREATE DATABASE IF NOT EXISTS blood_donation_db;
USE blood_donation_db;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    gender VARCHAR(20) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    city VARCHAR(100),
    last_donation_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS blood_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(100) NOT NULL,
    hospital VARCHAR(150) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    units INT NOT NULL,
    contact VARCHAR(20) NOT NULL,
    city VARCHAR(100),
    required_date DATE,
    status ENUM('Pending','Fulfilled','Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins(username,password)
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa6JpY9m5f0lQXj3oQhJrQ8r9qG')
ON DUPLICATE KEY UPDATE username=username;

INSERT INTO donors(name,age,gender,blood_group,phone,email,city,last_donation_date)
VALUES
('Rahul Patil',25,'Male','O+','9876543210','rahul@example.com','Solapur','2026-06-10'),
('Priya Jadhav',23,'Female','A+','9876501234','priya@example.com','Pune','2026-07-15'),
('Amit Shinde',29,'Male','B+','9822001122','amit@example.com','Latur',NULL);

INSERT INTO blood_requests(patient_name,hospital,blood_group,units,contact,city,required_date)
VALUES
('Neha Kulkarni','City Care Hospital','O+',2,'9898989898','Solapur','2026-10-10'),
('Rohan More','LifeLine Hospital','B+',1,'9765432109','Pune','2026-10-12');
