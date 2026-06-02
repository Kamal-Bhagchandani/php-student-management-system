CREATE DATABASE IF NOT EXISTS student_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_management;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    course VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (username, password)
VALUES ('admin', '$2y$10$BzzeMrP6ryzqPhWxQGBq0eTlSt.ILj7Y1vkr6zprGh0nqBbH2rZgu')
ON DUPLICATE KEY UPDATE password = VALUES(password);

INSERT INTO students (student_id, name, email, phone, course, year, address) VALUES
('101', 'Kamal Bhagchandani', 'kamal@gmail.com', '9876543210', 'Information Technology', 3, 'Pune'),
('102', 'Rahul Sharma', 'rahul.sharma@example.com', '9876543211', 'Computer Science', 2, 'Mumbai'),
('103', 'Priya Gupta', 'priya.gupta@example.com', '9876543212', 'Business Administration', 1, 'Delhi'),
('104', 'Aman Singh', 'aman.singh@example.com', '9876543213', 'Mechanical Engineering', 4, 'Jaipur')
ON DUPLICATE KEY UPDATE name = VALUES(name), email = VALUES(email), phone = VALUES(phone), course = VALUES(course), year = VALUES(year), address = VALUES(address);
