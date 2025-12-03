create database warung_madura;
use warung_madura;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  fullname VARCHAR(100) NOT NULL,
  city VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO users (username, password, fullname, city)
VALUES
('wisnuy', 'igwa', 'Wisnu adi', 'Denpasar');
CREATE TABLE products (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	category VARCHAR(50) NOT NULL,
	price DECIMAL(10, 2) NOT NULL,
	stock INT DEFAULT 0,
	image_path VARCHAR(255),
	status ENUM('active', 'inactive') default 'active',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


    