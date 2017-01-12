CREATE TABLE IF NOT EXISTS `contact_tb` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `customer_note_tb` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `note` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
