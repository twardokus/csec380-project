--
-- Database: `csecfinal`
--
CREATE DATABASE IF NOT EXISTS `csecfinal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `csecfinal`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin@rit.edu', md5('password'), 'Jon', 'Doe'),
(2, 'nonadmin@rit.edu', md5('password'), 'neil', 'zimmerman'),
(3, 'userone@rit.edu', md5('password'), 'Grant', 'Batchlor');
-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `titlehash` varchar(255) NOT NULL,
  `timestamp` varchar(25) NOT NULL,
  `ownerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERT INTO `videos` (`video_id`, `title`, `titlehash`, `timestamp`, `ownerid`) VALUES
-- (1, 'admin@rit.edu', md5('password'), 'Jon', 'Doe'),
-- (2, 'nonadmin@rit.edu', md5('password'), 'neil', 'zimmerman'),
-- (3, 'userone@rit.edu', md5('password'), 'Grant', 'Batchlor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `owner_id_fk` (`ownerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `owner_id_fk` FOREIGN KEY (`ownerid`) REFERENCES `users` (`user_id`);
COMMIT;
