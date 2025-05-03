-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 10:26 PM
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
  `description` varchar(1000) NOT NULL,
  `genre` varchar(25) NOT NULL,
  `stock` int(3) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `image_alt` varchar(300) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_inventory`
--

INSERT INTO `book_inventory` (`id`, `title`, `author`, `description`, `genre`, `stock`, `price`, `image_alt`, `image`) VALUES
(4, 'Victory in the Shadows', 'Denzell Winters', 'In &quot;Victory in the Shadows&quot;, Denzell Winters and Conroy Madden join forces to deliver a comprehensive education on military strategy and battlefield acumen. This book goes beyond basic tactics, delving into the core elements necessary for victory. Readers will learn how to bolster troop morale, acquire crucial intelligence, and adapt to the unpredictable nature of warfare. Furthermore, Winters and Madden address the challenges of unconventional conflicts, offering insights on navigating unexpected setbacks and managing situations where opponents possess superior or even otherworldly weaponry and techniques. &quot;Victory in the Shadows&quot; is an essential resource for anyone seeking a deep understanding of the principles and practices that lead to triumph in the face of adversity.', 'Military Nonfiction', 300, 38.75, 'A teal hardcover book with a gold symbol in the center with an &#039;A&#039;.', 0x75706c6f6164732f566963746f72792d696e2d7468652d536861646f77732e6a7067),
(5, 'Magic In The Air', 'Denzell Winters', '&quot;Magic In The Air&quot; delves into the provocative question of magic&#039;s potential existence, challenging conventional scientific boundaries. Denzell Winters, aided by the knowledgeable Selene Cromwell, embarks on a quest to redefine magic, exploring its possible scientific basis, manifestations, and potential wielders. By re-examining dismissed possibilities, the book dares to imagine a world where the extraordinary could be explained, and magic becomes a tangible force.', 'Speculative Nonfiction', 300, 79.75, 'A red hardcover book with a gold symbol in the center with an &#039;A&#039;.', 0x75706c6f6164732f4d616769632d496e2d5468652d4169722e6a7067),
(6, 'Breakpoint', 'Denzell Winters', 'Jarvis Ives, raised in suffocating isolation by his controlling family, finally breaks free after enduring years of loneliness and abuse. Unprepared for the modern world, he&#039;s thrust into a society saturated with technology he&#039;s never experienced. Driven by a thirst for knowledge and a desire to escape his past, Jarvis quickly masters coding. His newfound skills lead him down a dangerous path when he accepts a job to steal information from a powerful tech giant. But the mission quickly spirals out of control, plunging him back into a familiar state of fear and helplessness. Now, Jarvis must leverage his newfound tech abilities to navigate the treacherous landscape he&#039;s entered and find a way to reclaim his freedom while forging his own identity. Will he succeed in escaping the shadow of his past and mastering his future?', 'Science Fiction', 200, 88.25, 'A purple hardcover book with a gold symbol in the center with an &#039;A&#039;.', 0x75706c6f6164732f427265616b706f696e742e6a7067),
(7, 'The Iron Prince', 'Opal Varynce', 'For centuries, the Iron Prince has observed Spain, an immortal observer meticulously studying the human condition. He believed he had deciphered the intricate tapestry of human behavior, predicting choices, understanding motivations, and ultimately, conquering boredom. But his ageless existence is thrown into thrilling chaos when he encounters a woman he cannot comprehend. Intrigued and challenged, he initially sees her as a complex puzzle, a game designed for his amusement. However, as their lives become increasingly intertwined, a chilling realization dawns: this woman isn&#039;t just a challenge; she&#039;s a critical test. If he fails to understand her, the consequences could shatter his immortal existence and the delicate balance he has quietly maintained for centuries. The Iron Prince must now unravel the mystery of this woman, or risk losing everything he thought he knew.', 'Fantasy Fiction', 200, 86.50, 'A red hardcover book with the words &#039;El Principe de Hierro&#039;, with a large image of a prince underneath.', 0x75706c6f6164732f5468652d49726f6e2d5072696e63652e6a7067),
(8, 'Secrets of the Whisperers', 'Andrea Ricard', 'Prepare to unlock the secrets of the animal kingdom! This isn&#039;t just another book about pet training; it&#039;s a fascinating journey into the minds of creatures great and small. Imagine having the ability to truly understand and communicate with animals, from your playful pup to the majestic wildlife you see on nature documentaries. This book unveils time-tested techniques for gaining an animal&#039;s trust and cooperation, offering practical advice anyone can use to build a deeper connection with their furry, feathered, or scaled companions. But that&#039;s not all! Venture beyond the ordinary and discover the rare and enigmatic methods wielded by true &quot;animal whisperers&quot; &ndash; techniques that tap into a deeper level of understanding, reserved for those with a special connection. Get ready to transform your relationship with animals and unlock a world of communication you never thought possible!', 'Animal Nonfiction', 500, 36.75, 'A black hardcover book with the outline of a silver butterfly.', 0x75706c6f6164732f54616c6b696e672d546f2d5468652d576f726c642e6a7067),
(9, 'The Verdant Code', 'Azalea Richard', '&quot;The Verdant Code&quot; is the definitive resource for anyone looking to master the world of plants. This comprehensive guide covers everything from basic planting techniques to advanced horticultural practices. But it goes beyond the typical gardening book, delving into the fascinating, and perhaps unbelievable, realm of plant connection and control. Discover how to nurture your green thumb not just for cultivation, but for a deeper understanding and even influence over the botanical world around you. Prepare to unlock the secrets to planting, growing, caring for, and ultimately, commanding the power of plants.', 'Gardening Nonfiction', 500, 41.50, 'A green hardcover book with golden circle containing a golden tree inside.', 0x75706c6f6164732f5468652d56657264616e742d436f64652e6a7067),
(10, 'Absence of Nothing', 'Elizabeth Garcia', 'Elizabeth Garcia&#039;s book embarks on a fascinating journey exploring the very essence of our universe&#039;s solid matter. It delves into fundamental questions about our connection to the world, probing the nature of reality and the extent of human control over the matter that constitutes our universe. Garcia challenges readers to reconsider their perceptions, inviting them to ponder mind-bending concepts and ultimately rethink their understanding of the world around them. In essence, it&#039;s a philosophical and scientific exploration of the building blocks of existence and humanity&#039;s relationship with them.', 'Speculative Nonfiction', 200, 98.25, 'A red hardcover book.', 0x75706c6f6164732f416273656e63652d6f662d4e6f7468696e672e6a7067),
(11, 'Waves of Chaos', 'Lucian Rivera', 'In Lucian Rivera&#039;s thought-provoking book, we are plunged into a future where the predictable patterns of weather have shattered, and the oceans, once contained, have burst free. Rivera masterfully explores the terrifying consequences of a world where its essential liquids&ndash;water, the lifeblood of the planet&ndash;spiral out of control. He delves into the underlying causes of these liquid disruptions, examining the factors that lead to ecological and societal collapse. More importantly, the book offers a glimmer of hope, dissecting the methods and strategies required to restore balance, regain control, and navigate the overwhelming chaos threatening to consume humanity. This is not just a cautionary tale, but a vital exploration of resilience.', 'Environmental Nonfiction', 600, 55.00, 'A red hardcover book a silver circle containing a silver wave of water.', 0x75706c6f6164732f57617665732d6f662d4368616f732e6a7067),
(12, 'Step Two: The Alchemy of Breath', 'Chiara Leclair', 'This book delves into the powerful role of meditation in achieving self-mastery and control. It explores not only traditional meditative practices but also introduces unique and innovative techniques. Furthermore, the book examines the influence of specific gases, like nitrogen, oxygen, and argon, suggesting unconventional connections between these elements and the meditative process. This book uses mental techniques to unlock a deeper state of control. This edition also has diagrams to help further your journey towards control.', 'Self-Help Nonfiction', 900, 45.20, 'A black hardcover book with a blue star in the middle containing the number two.', 0x75706c6f6164732f537465702d54776f3b2d5468652d416c6368656d792d6f662d4272656174682e6a7067),
(13, 'Creation of the Stars', 'Raya Ives', '&quot;Creation of the Stars&quot; compiles five ancient creation narratives, meticulously transcribed and woven together by Raya Ives. These stories, passed down through generations, explore profound themes: the genesis of stars, the stars&#039; weaving of the cosmos, the unique gifts bestowed upon humanity, the discovery of earth, and the establishment of order. Linking these diverse tales is the fundamental element of plasma. The book posits that plasma, in its transformative power, served as the catalyst for all creation, from the universe&#039;s inception to the present day. Ives&#039; work presents a compelling exploration of interconnectedness, suggesting that the forces shaping the cosmos are inherently linked to the human experience. This book contains many pieces of stunning artwork and diagrams created by Emily Thatcher, adding another layer of depth to this already meaningful book.', 'Oral Literature', 300, 105.50, 'A blue hardcover book with a golden fire symbol in the center.', 0x75706c6f6164732f4372656174696f6e2d6f662d7468652d53746172732e6a7067),
(14, 'A Dangerous Wish', 'Jade Miller', 'Emilla Jerd was born different, thanks to her father&#039;s experiments on her genetics. She&rsquo;s hidden her powers all her life&mdash;until one moment of fear shatters her secrecy, unleashing a force she can&rsquo;t control. Cast out from the only home she&rsquo;s ever known, Emilla wanders through the wilderness, stalked by the memory of what she&rsquo;s done&hellip; and what she might do again. When she stumbles upon others like her, hope returns in the form of Elzandwean, a secret haven for the genetically altered. Yet peace is fleeting. As Emilla&rsquo;s abilities grow, so does a shadow within her: a hidden flaw in her genetics. What gives her power may also be unravelling her from the inside&mdash;slowly poisoning her and endangering everyone around her. Now, faced with a devastating truth, Emilla must make an impossible choice: embrace her abilities and risk dooming the sanctuary that saved her&hellip; or vanish into exile once more.', 'Fantasy Fiction', 500, 90.75, 'A black hardcover book with a intricate green frame around the words &#039;A WISH GRANTED IS A VERY SEDUCTIVE THING&#039; and an outline of an apple below it with green substance covering half of it and dripping down.', 0x75706c6f6164732f412d44616e6765726f75732d576973682e6a7067),
(15, 'The Mad Lovers', 'Chimand Alizo', 'In a world brimming with injustice and shrouded in mystery, Ethan Frish, a relentless fighter for what&#039;s right, collides with Rose D., a young woman desperately seeking her lost family and a place to call home. Their paths unexpectedly intertwine, forging a bond fueled by shared purpose and a fragile hope. Ethan vows to aid Rose in her quest, embarking on a journey that unravels a web of dangerous truths, challenging their ideals and forcing them to confront the unsettling reality that the world&#039;s problems may be too deeply ingrained for simple solutions. Ultimately, they are left to grapple with a daunting conclusion: perhaps the only way forward is to dismantle the existing society and forge a new one from the ashes. This is their story of discovery, danger, and the difficult path towards a radical new vision.', 'Fantasy Fiction', 300, 75.25, 'A red hardcover book with intricate patterns on the front, with the title &#039;The Mad Lovers&#039; overtop of a slice of orange, all done in silver.', 0x75706c6f6164732f5468652d4d61642d4c6f766572732e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(4) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `public` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(65) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(5, 'DancingBooks', '$2y$10$4PVCdRd7XiIJ7yiN2Fmmvu2Xs6adLf25.JgLj/wFxJtOIIT/c48BW', 'hpeters3@academic.rrc.ca');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_inventory`
--
ALTER TABLE `book_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_idfk` (`user_id`),
  ADD KEY `book_idfk` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_inventory`
--
ALTER TABLE `book_inventory`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `book_idfk` FOREIGN KEY (`book_id`) REFERENCES `book_inventory` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_idfk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
