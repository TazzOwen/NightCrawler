-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2018 at 11:45 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nightcrawler`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `business_id` int(11) NOT NULL,
  `business_name` varchar(256) NOT NULL,
  `business_description` text NOT NULL,
  `business_address` varchar(256) NOT NULL,
  `business_type` varchar(256) NOT NULL,
  `business_latitude` varchar(10) DEFAULT NULL,
  `business_longitude` varchar(10) DEFAULT NULL,
  `business_rating` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`business_id`, `business_name`, `business_description`, `business_address`, `business_type`, `business_latitude`, `business_longitude`, `business_rating`) VALUES
(1, 'McDonalds Bourke St West VIC', 'Classic, long-running fast-food chain known for its burgers, fries & shakes. Late-night food. Breakfast. Casual.', '406 Bourke Street, Melbourne VIC 3000', 'Fast food', '37°48\'49\"S', '144°57\'5\"E', 0),
(2, 'Shanghai Street Dumpling & Mini Juicy Bun', 'Shanghai Style Buns and cooking', '342 Little Bourke St, Melbourne VIC 3000', 'Chinese Restaurant', '37°48\'48\"S', '144°57\'5\"E', 3.5),
(3, 'Rooftop Cinema', 'Seasonal screenings of films old and new, on a hip rooftop with deckchairs, cocktails and burgers.', '252 Swanston St, Melbourne VIC 3000', 'Cinema', '37°48\'43\"S', '144°57\'5\"E', 4),
(4, 'Izakaya Den', 'Hip basement venue for Japanese izakaya-style tapas and drinks, plus classic mains and group tables. Late-night food. Cosy. Casual.', '114 Russell St, Melbourne VIC 3000', 'Japanase bar', '37°48\'49\"S', '144°58\'8\"E', 3),
(5, 'Om Nom Kitchen', 'Om Nom Choc Cigars are the draw at this dessert bar set in modern surrounds in the Adelphi Hotel. Late-night food. Breakfast. Great cocktails.', '187 Flinders Ln, Melbourne VIC 3000', 'Restaurant', '37°48\'59\"S', '144°58\'7\"E', 5),
(6, 'Garden State Hotel', 'Outdoor seating. Great Cocktails. Casual.', '101 Flinders Ln, Melbourne VIC 3000', 'Cocktail Bar', '37°48\'56\"S', '144°58\'2\"E', 0),
(7, 'Flinders Street Station', 'Iconic, domed railway and metro hub, opened in 1909, with a yellow facade and an arched entrance.', 'Flinders St, Melbourne VIC 3000', 'Transport', '37°49\'4\"S', '144°58\'2\"E', 0);

-- --------------------------------------------------------

--
-- Table structure for table `businessreviews`
--

CREATE TABLE `businessreviews` (
  `businessReview_id` int(11) NOT NULL,
  `businessReview_uid` int(11) NOT NULL,
  `businessReview_bid` int(11) NOT NULL,
  `businessReview_rating` int(1) NOT NULL,
  `businessReview_review` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businessreviews`
--

INSERT INTO `businessreviews` (`businessReview_id`, `businessReview_uid`, `businessReview_bid`, `businessReview_rating`, `businessReview_review`) VALUES
(1, 2, 2, 4, 'Dumplings were great!'),
(2, 2, 3, 3, 'It was too noisy to hear the movie, but the drinks after the movie were alright'),
(3, 3, 3, 4, 'Great place to experience a movie, but a bit of a walk from the station.'),
(4, 4, 4, 3, 'The food was good, but it was a bit too crowded for me and the drinks were expensive.'),
(5, 5, 6, 5, 'A great place to have a drink. Good ambience. 5 stars!');

-- --------------------------------------------------------

--
-- Table structure for table `businesstags`
--

CREATE TABLE `businesstags` (
  `businessTag_id` int(11) NOT NULL,
  `businessTag_businessId` int(11) NOT NULL,
  `businessTag_TypeRestaurant` tinyint(1) NOT NULL DEFAULT '0',
  `businessTag_TypeMusic` tinyint(1) NOT NULL DEFAULT '0',
  `businessTag_TypeBar` tinyint(1) NOT NULL DEFAULT '0',
  `businessTag_TypeCafe` tinyint(1) NOT NULL DEFAULT '0',
  `businessTag_TypeEntertainment` tinyint(1) NOT NULL DEFAULT '0',
  `businessTag_Type` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businesstags`
--

INSERT INTO `businesstags` (`businessTag_id`, `businessTag_businessId`, `businessTag_TypeRestaurant`, `businessTag_TypeMusic`, `businessTag_TypeBar`, `businessTag_TypeCafe`, `businessTag_TypeEntertainment`, `businessTag_Type`) VALUES
(1, 1, 1, 0, 0, 0, 0, 'Fast food'),
(2, 2, 1, 0, 0, 0, 0, 'Chinese restaurant'),
(3, 3, 1, 0, 1, 0, 1, 'Cinema'),
(4, 4, 1, 1, 1, 0, 0, 'Japanese bar'),
(5, 5, 1, 0, 0, 1, 0, 'Restaurant'),
(6, 6, 0, 1, 1, 0, 1, 'Cocktail bar'),
(7, 7, 0, 0, 0, 0, 0, 'Transport');

-- --------------------------------------------------------

--
-- Table structure for table `routereviews`
--

CREATE TABLE `routereviews` (
  `routeReview_id` int(11) NOT NULL,
  `routeReview_uid` int(11) NOT NULL,
  `routeReview_rid` int(11) NOT NULL,
  `routeReview_rating` int(1) NOT NULL,
  `routeReview_review` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routereviews`
--

INSERT INTO `routereviews` (`routeReview_id`, `routeReview_uid`, `routeReview_rid`, `routeReview_rating`, `routeReview_review`) VALUES
(1, 3, 1, 5, 'A great night out! The dumplings were a great way to finish the night after a good movie'),
(2, 4, 1, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `route_uid` int(11) DEFAULT NULL,
  `route_name` varchar(256) DEFAULT NULL,
  `route_description` text NOT NULL,
  `route_stops` varchar(256) NOT NULL,
  `route_type` varchar(256) NOT NULL,
  `route_rating` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_uid`, `route_name`, `route_description`, `route_stops`, `route_type`, `route_rating`) VALUES
(1, 2, 'Rooftop Cinema and asian food', 'A trip to the rooftop cinema to see a movie and some nice light asian food on either side :)', '7,5,3,2', '', 4),
(2, 5, 'Japanese food, then drinks at the Garden State', 'Grab some japanese food and enjoy the ambience of the izakaya, then head to the Garden State Hotel for a few drinks before heading home', '7,4,6', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `routetags`
--

CREATE TABLE `routetags` (
  `routeTag_id` int(11) NOT NULL,
  `routeTag_routeId` int(11) NOT NULL,
  `routeTag_Type` varchar(256) DEFAULT NULL,
  `routeTag_TypeFood` tinyint(1) NOT NULL DEFAULT '0',
  `routeTag_TypeDrink` tinyint(1) NOT NULL DEFAULT '0',
  `routeTag_TypeEntertainment` tinyint(1) NOT NULL DEFAULT '0',
  `routeTag_TypeMovie` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routetags`
--

INSERT INTO `routetags` (`routeTag_id`, `routeTag_routeId`, `routeTag_Type`, `routeTag_TypeFood`, `routeTag_TypeDrink`, `routeTag_TypeEntertainment`, `routeTag_TypeMovie`) VALUES
(1, 1, 'Movie Night', 1, 1, 0, 1),
(2, 2, 'Dinner and drinks', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`) VALUES
(1, 'Nicholas', 'Farr', 'nfarr@example.com', 'Admin1', '$2y$10$y8VGDaWF95CVTnDX/JVUgurCLApvpCgWL9l4eq67n8HQ1F.D49PRC'),
(2, 'John', 'Citizen', 'johncitizen@example.com', 'JohnC', '$2y$10$sYZkq7BZPclKhs1MmhZyfOjV9XIUHh1HeCaw9a1X7Ga8Aj5/DC1IS'),
(3, 'Jane', 'Citizen', 'jcitizen@example.com', 'FoodFan2018', '$2y$10$3ABl/xM1QslU7swoaQLd/OU6Q5e5f/u2StIWou7nLs6UkiY3MkK/K'),
(4, 'Mike', 'Example', 'mikeexample@gmail.com', 'M_Example', '$2y$10$nMb5OIsIEuUHTdxQxSbBoe638ufMhPDmpqGDnsa5/FiFFIyExUkya'),
(5, 'George', 'Washington', 'georgewashington@whitehouse.gov', 'MuricanPrez', '$2y$10$.p.ti8J4CRT9kCkpXWQw2u.CZ6gvZvL2BZkjZj.3V9kfC544I1nCi'),
(6, 'John', 'Test', 'test@example.com', 'test2', '$2y$10$Uab7tx182SbKgqgQHxSH7eL3hUA9uVfL9YPJG2Ge/cO0ePsWjrDzG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `businessreviews`
--
ALTER TABLE `businessreviews`
  ADD PRIMARY KEY (`businessReview_id`);

--
-- Indexes for table `businesstags`
--
ALTER TABLE `businesstags`
  ADD PRIMARY KEY (`businessTag_id`);

--
-- Indexes for table `routereviews`
--
ALTER TABLE `routereviews`
  ADD PRIMARY KEY (`routeReview_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `routetags`
--
ALTER TABLE `routetags`
  ADD PRIMARY KEY (`routeTag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `businessreviews`
--
ALTER TABLE `businessreviews`
  MODIFY `businessReview_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `businesstags`
--
ALTER TABLE `businesstags`
  MODIFY `businessTag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `routereviews`
--
ALTER TABLE `routereviews`
  MODIFY `routeReview_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routetags`
--
ALTER TABLE `routetags`
  MODIFY `routeTag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
