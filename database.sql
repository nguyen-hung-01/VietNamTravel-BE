create database vietnam_travel;
use vietnam_travel;

CREATE TABLE users ( 
	user_id INT AUTO_INCREMENT PRIMARY KEY, 
	full_name VARCHAR(100) NOT NULL, 
	pass_word VARCHAR(100) NOT NULL, 
	phone_number VARCHAR(15) NOT NULL, 
	email VARCHAR(100) NOT NULL 
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
);

CREATE TABLE destinations (
    destination_id INT AUTO_INCREMENT PRIMARY KEY,
    destination_name VARCHAR(100) NOT NULL,
    rating DECIMAL(2, 1) DEFAULT 0.0,
    price DECIMAL(10, 2),
    description TEXT,
    address VARCHAR(255),
    image_url VARCHAR(255),
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    destination_id INT,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pending', 'Confirmed', 'Cancelled', 'Completed') DEFAULT 'Pending',
    total_price DECIMAL(10, 2),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    destination_id INT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id)
);

CREATE TABLE booking_details (
    detail_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    tour_date DATE,
    number_of_people INT,
    additional_notes TEXT,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id)
);



