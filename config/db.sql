CREATE DATABASE `foodie_fresh_db`;

CREATE TABLE `foodie_fresh_db`.`meal` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `meal_image` VARCHAR(255) NOT NULL , 
  `meal_name` VARCHAR(255) NOT NULL , 
  `meal_price` VARCHAR(20) NOT NULL , 
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  PRIMARY KEY (`id`)) ENGINE = InnoDB;