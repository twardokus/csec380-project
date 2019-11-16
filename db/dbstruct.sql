CREATE DATABASE IF NOT EXISTS csecfinal;
USE csecfinal; 

--
-- Database: `csecfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin@rit.edu', md5('password'), 'Jon', 'Doe'),
(2, 'nonadmin@rit.edu', md5('password'), 'neil', 'zimmerman'),
(3, 'userone@rit.edu', md5('password'), 'Grant', 'Batchlor');

CREATE TABLE IF NOT EXISTS 'videos' (
	'video_id' int(11) NOT NULL AUTO_INCREMENT,
	'title' varchar(64) NOT NULL,
	'titlehash' varchar(255) NOT NULL,
	'timestamp' varchar(25) NOT NULL,
	'ownerid' int(11) NOT NULL,
	PRIMARY KEY ('video_id')
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

