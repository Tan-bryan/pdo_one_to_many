CREATE TABLE car_manufacturers (
    Manufacturer_id INT AUTO_INCREMENT PRIMARY KEY,
    Manufacturer_name VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    date_added DATE DEFAULT CURRENT_DATE
);

-- Table for car parts
CREATE TABLE car_parts (
    car_id INT AUTO_INCREMENT PRIMARY KEY,
    car_model VARCHAR(50),
    manufacturer_id INT,
    price FLOAT,
    transmission_type VARCHAR(50),
    FOREIGN KEY (manufacturer_id) REFERENCES car_manufacturers(Manufacturer_id) ON DELETE CASCADE
);