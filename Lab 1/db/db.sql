CREATE DATABASE IF NOT EXISTS users_db; 
GRANT ALL PRIVILEGES ON users_db.* TO 'user'@'%';

USE users_db;

-- Drop and create users table with new columns for security questions
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `grad_year` varchar(4),
  `birth_year` varchar(4),
  `favorite_color` varchar(50),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);

-- Insert users with MD5 password hashes (security questions can be empty or sample values)
INSERT INTO `users` (`id`, `username`, `password`, `grad_year`, `birth_year`, `favorite_color`) VALUES
(1, 'admin', MD5('admin'), '2020', '1990', 'red'),
(2, 'test', MD5('test'), '0', '2000', 'blue'),
(3, 'random', MD5('123'), '2018', '1985', 'green');

-- Drop and create status posts table
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add fake status posts
INSERT INTO `status` (content, image_path) VALUES 
('What a beautiful day!', 'uploads/beautifullDay.jpg'),
('Just finished a big project', 'uploads/download.jpg'),
('Check out this cool pic!', 'uploads/images.jpg'),
('I am so tired', 'uploads/3.jpg');
