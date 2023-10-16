

users jadvalini hosil qilish

CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  login VARCHAR(50) NOT NULL,
  name VARCHAR(32) NOT NULL,
  password VARCHAR(255) NOT NULL,
  registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


products jadvalini hosil qilish

CREATE TABLE products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  product_name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) DEFAULT '0.00',
  image LONGBLOB,
  added_at DATETIME NOT NULL
);
