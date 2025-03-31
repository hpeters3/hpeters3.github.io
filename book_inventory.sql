-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 05:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parallel_lines`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_inventory`
--

CREATE TABLE `book_inventory` (
  `id` int(4) NOT NULL,
  `title` varchar(75) NOT NULL,
  `author` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `genre` varchar(25) NOT NULL,
  `stock` int(3) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `image_alt` varchar(150) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_inventory`
--

INSERT INTO `book_inventory` (`id`, `title`, `author`, `description`, `genre`, `stock`, `price`, `image_alt`, `image`) VALUES
(4, 'The Battle for Parallel', 'Denzell Winters &amp; Conroy Madden', 'Denzell Winters goes through the best battles from Parallel&#039;s past, analyzing them and critiquing them with the help of expert Conroy Madden, currently leader of the Edmonton base.', 'Historical Nonfiction', 21, 26.99, 'A teal hardcover book with a gold symbol in the center with an &#039;A&#039;.', 0x75706c6f6164732f54686520426174746c6520666f7220506172616c6c656c2e6a7067),
(5, 'Magic In The Air', 'Denzell Winters &amp; Andrea Ricard', 'The fascinating tale about Andrea&#039;s coming into herself and her capabilities, and how others can follower her footsteps.', 'Biography Nonfiction', 24, 19.76, 'A red hardcover book with a gold symbol in the center with an &#039;A&#039;.', 0x75706c6f6164732f4d6167696320496e20546865204169722e6a7067),
(6, 'Before Hoverboards', 'Denzell Winters &amp; Jarvis Ives', 'Explore the world before technology, how it worked and how battle strategies have improved since then. Follow the story of the most infamous tech master there is, Jarvis Ives.', 'Historical Nonfiction', 19, 31.68, 'A purple hardcover book with a gold symbol in the center with an &#039;A&#039;.', 0x75706c6f6164732f4265666f726520486f766572626f617264732e6a7067),
(7, 'The Iron Principle', 'Elizabeth Garcia', 'A provocative guide that explores techniques and strategies to subtly influence and control human behavior in various settings.', 'Science Nonfiction', 15, 26.87, 'A red hardcover book with the words &#039;El Principe de Hierro&#039;, with a large image of a prince underneath.', 0x75706c6f6164732f5468652049726f6e205072696e6369706c652e6a7067),
(8, 'Talking To The World', 'Andrea Ricard', 'A comprehensive guide that reveals effective methods for understanding and mastering animal behavior, enabling you to train and influence animals with confidence and compassion.', 'Science Nonfiction', 24, 31.66, 'A black hardcover book with the outline of a silver butterfly.', 0x75706c6f6164732f54616c6b696e6720546f2054686520576f726c642e6a7067),
(9, 'The Power of a Seed', 'Andrea Ricard', 'An insightful guide that combines practical tips, expert techniques, and natural methods to help you cultivate and master the art of growing and controlling plants in any environment.', 'Science Nonfiction', 32, 18.45, 'A green hardcover book with golden circle containing a golden tree inside.', 0x75706c6f6164732f54686520506f776572206f66206120536565642e6a7067),
(10, 'The Absence of Nothing', 'Elizabeth Garcia', 'A captivating exploration of solid matter, unraveling its fundamental properties, behaviors, and role in shaping the structure of our universe.', 'Science Nonfiction', 29, 24.66, 'A red hardcover book.', 0x75706c6f6164732f54686520416273656e6365206f66204e6f7468696e672e6a7067),
(11, 'The War Against Rain', 'Lucian Rivera', 'A thought-provoking guide that delves into the essential role of liquids in our world, offering practical insights on how to harness their properties for everyday use and innovation.', 'Science Nonfiction', 23, 29.23, 'A red hardcover book a silver circle containing a silver wave of water.', 0x75706c6f6164732f5468652057617220416761696e7374205261696e2e6a7067),
(12, 'The Second Stage', 'Chiara Leclair', 'A fascinating journey into the world of gases, uncovering their mysterious behavior, how they shape our environment, and the ways we can control and harness them for various applications.', 'Science Nonfiction', 14, 16.39, 'A black hardcover book with a blue star in the middle containing the number two.', 0x75706c6f6164732f546865205365636f6e642053746167652e6a7067),
(13, 'The Fourth State', 'Lucian Rivera &amp; Raya Ives', 'An exciting exploration of plasma, highlighting its incredible properties, its role in the universe, and the innovative ways we can control and utilize this powerful state of matter.', 'Science Nonfiction', 6, 35.43, 'A blue hardcover book with a golden fire symbol in the center.', 0x75706c6f6164732f54686520466f757274682053746174652e6a7067),
(14, 'A Dangerous Wish', 'Jade Miller', 'Follow Jade as she explores the world of recessive genes, displaying how they can be a blessing and a curse.', 'Science Nonfiction', 10, 38.59, 'Recessive Genes Textbook', 0x75706c6f6164732f412044616e6765726f757320576973682e6a7067),
(15, 'The Mad Lovers', 'Chimand Alizo', 'Follow the story of two lovers as they aim to make the world a better place, instead destroying it in the process.', 'Historical Fiction', 12, 38.96, 'A red hardcover book with intricate patterns on the front, with the title &#039;The Mad Lovers&#039; overtop of a slice of orange, all done in silver.', 0x75706c6f6164732f546865204d6164204c6f766572732e6a7067);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_inventory`
--
ALTER TABLE `book_inventory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_inventory`
--
ALTER TABLE `book_inventory`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
