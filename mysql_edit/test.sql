-- Database: `test`


--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employeeNumber` int(5) NOT NULL AUTO_INCREMENT,
  `active` enum('yes','no') CHARACTER SET utf8 NOT NULL,
  `firstName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `job` int(3) NOT NULL,
  PRIMARY KEY (`employeeNumber`)
);

--
-- Data for table `employees`
--

INSERT INTO `employees` (`employeeNumber`, `active`, `firstName`, `lastName`, `email`, `job`) VALUES
(1, 'yes', 'Diane', 'Murphy', 'dmurphy@example.com', 1),
(2, 'no', 'Mary', 'Patterson', 'mpatterso@example.com', 2),
(3, 'yes', 'Jeff', 'Firrelli', 'jfirrelli@example.com', 3),
(4, 'no', 'Williám', 'Patterson', 'wpatterson@example.com', 4),
(5, 'no', 'Gerard', 'Bondur', 'athompson@example.com', 4),
(6, 'no', 'Anthony', 'Bow', 'bhoward@example.com', 4),
(7, 'yes', 'Leslie', 'Jennings', 'ljennings@example.com', 5),
(8, 'yes', 'Leslie', 'Thompson', 'lthompson@example.com', 5),
(9, 'no', 'Julie', 'Firrelli', 'jfirrelli@example.com', 5),
(10, 'no', 'Steve', 'Patterson', 'spatterso@example.com', 5),
(11, 'yes', 'Foon Yue', 'Tseng', 'ftseng@example.com', 5),
(12, 'no', 'George', 'Vanauf', 'gvanauf@example.com', 5),
(13, 'yes', 'Loui', 'Bondur', 'lbondur@example.com', 5),
(14, 'no', 'Gerard', 'Hernandez', 'ghernande@example.com', 5),
(15, 'yes', 'Pamela', 'Castillo', 'pcastillo@example.com', 5),
(16, 'yes', 'Larry', 'Bott', 'lbott@example.com', 5),
(17, 'no', 'Barry', 'Jones', 'bjones@example.com', 5),
(18, 'yes', 'Andy', 'Fixter', 'afixter@example.com', 5),
(19, 'no', 'Peter', 'Marsh', 'pmarsh@example.com', 5),
(20, 'yes', 'Tom', 'King', 'tking@example.com', 5),
(21, 'no', 'Mami', 'Nishi', 'mnishi@example.com', 5),
(22, 'yes', 'Yoshimi', 'Kato', 'ekato@example.com', 5),
(23, 'no', 'Martin', 'Gerard', 'gmartin@example.com', 2);


--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Data for table `jobs`
--

INSERT INTO `jobs` VALUES(1, 'President');
INSERT INTO `jobs` VALUES(2, 'VP Sales');
INSERT INTO `jobs` VALUES(3, 'VP Marketing');
INSERT INTO `jobs` VALUES(4, 'Sales Manager');
INSERT INTO `jobs` VALUES(5, 'Sales Rep');

