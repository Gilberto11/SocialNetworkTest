
CREATE database snake;

CREATE TABLE `users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50)NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `signup_date` DATE,
  `profile_pic` VARCHAR(255) NOT NULL,
  `num_posts` INT,
  `num_likes` INT,
  `user_closed` VARCHAR(3),
  `friend_array` TEXT,
  PRIMARY KEY (`user_id`)
) ENGINE=INNODB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;