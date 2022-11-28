CREATE TABLE IF NOT EXISTS `mahasiswa` (
`idkey` int( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY , 
 
`nama_lengkap` varchar (50) NOT NULL,
`alamat` text  NOT NULL,
`jenis_kelamin` enum('L','P')  NOT NULL,
`photo` varchar (50) NOT NULL 
  
 )  ENGINE=MyISAM; 
 