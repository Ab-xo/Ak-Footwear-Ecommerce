 CREATE TABLE IF NOT EXISTS `admins`(
`admin_id` int(11) NOT NULL AUTO_INCREMENT,
 `admin_name` varchar(250) NOT NULL,
 `admin_email` varchar(100) NOT NULL,
 `admin_username` varchar(100) NOT NULL,
 `admin_password` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `UX_Constraint` (`user_email`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `newsletter_subscribers`(
`id` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(255) NOT NULL,
 `token` varchar(255) NOT NULL,
 `is_verified` tinyint(1) NOT NULL,
 `created_at`  CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY ( `id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `orders`(
`order_id` int(11) NOT NULL AUTO_INCREMENT,
 `order_cost` decimal(6,2) NOT NULL,
 `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
 `user_id` int(11) NOT NULL,
 `user_phone` int(20) NOT NULL,
 `user_country` varchar(255) NOT NULL,
 `user_city` varchar(255) NOT NULL,
 `user_address` varchar(255) NOT NULL,
 `order_date` DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ( `order_id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

 CREATE TABLE IF NOT EXISTS `orders_items`(
`item_id` int(11) NOT NULL AUTO_INCREMENT,
 `order_id` int(11) NOT NULL,
 `product_id` varchar(255) NOT NULL,
 `product_name` varchar(255) NOT NULL,
 `product_image` varchar(255) NOT NULL,
 `product_price` decimal(6,2) NOT NULL,
 `product_quantity` int(11) NOT NULL,
 `user_id` int(11) NOT NULL,
 `order_date` DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ( `item_id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `payments`(
`payment_id` int(11) NOT NULL AUTO_INCREMENT,
 `order_id` int(11) NOT NULL,
 `user_id` int(11) NOT NULL,
 `transaction_id` varchar(250) NOT NULL,
 `payment_date` DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ( `payment_id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `products`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_identity` int(11) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_single_image1` varchar(255) NOT NULL,
  `product_single_image2` varchar(255) NOT NULL,
  `product_single_image3` varchar(255) NOT NULL,
  `product_single_image4` varchar(255) NOT NULL,
  `product_single_description` LONGTEXT NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  PRIMARY KEY ( `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 CREATE TABLE IF NOT EXISTS `users`(
`user_id` int(11) NOT NULL AUTO_INCREMENT,
 `user_name` varchar(100) NOT NULL,
 `user_email` varchar(100) NOT NULL,
 `user_password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UX_Constraint` (`user_email`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;



