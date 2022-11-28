CREATE TABLE IF NOT EXISTS `login` (
`id_login` int( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY , 
 
`email` varchar (50) NOT NULL,
`password` varchar (50) NOT NULL,
`level` enum('Admin','User')  NOT NULL 
  
 )  ENGINE=MyISAM; 
 