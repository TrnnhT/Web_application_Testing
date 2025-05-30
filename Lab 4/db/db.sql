CREATE DATABASE IF NOT EXISTS users_db; 
GRANT ALL PRIVILEGES ON users_db.* TO 'user'@'%';

USE users_db;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` VARBINARY(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `grad_year` varchar(4),
  `birth_year` varchar(4),
  `favorite_color` varchar(100),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);


INSERT INTO `users` (`id`, `username`, `password`, `grad_year`, `birth_year`, `favorite_color`) VALUES
(1, 'admin', 'admin', '2020', '1990', 'red'),
(2, 'test', 'test', '0', '2000', 'blue'),
(3, 'random', '123', '2018', '1985', 'green');


DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO `status` (content, image_path) VALUES 
('What a beautiful day!', 'uploads/beautifullDay.jpg'),
('Just finished a big project', 'uploads/download.jpg'),
('Check out this cool pic!', 'uploads/images.jpg'),
('I am so tired', 'uploads/3.jpg');
