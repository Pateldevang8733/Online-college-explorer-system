-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 04:49 PM
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
-- Database: `collegearea`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_email`, `admin_name`, `admin_pass`, `type`) VALUES
(23, 'admin2@gmail.com', 'admin2', 'admin2', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `audit_table`
--

CREATE TABLE `audit_table` (
  `login_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_table`
--

INSERT INTO `audit_table` (`login_id`, `u_id`, `login_time`, `type`, `logout_time`) VALUES
(179, 49, '2024-12-10 00:17:54', 'user', '2024-12-10 00:17:59'),
(180, 49, '2024-12-10 00:18:08', 'user', '2024-12-10 00:18:12'),
(181, 23, '2024-12-10 00:18:22', 'admin', '2024-12-10 00:18:27'),
(184, 23, '2024-12-10 00:20:19', 'admin', '2024-12-10 00:20:24'),
(187, 49, '2024-12-10 21:03:36', 'user', '2024-12-10 21:04:05'),
(188, 49, '2024-12-10 21:04:16', 'user', '2024-12-10 21:04:23'),
(189, 49, '2024-12-10 21:04:32', 'user', '2024-12-10 21:04:35'),
(193, 49, '2024-12-10 21:05:11', 'user', '2024-12-10 21:05:13'),
(194, 49, '2024-12-10 21:05:19', 'user', '2024-12-10 21:05:22'),
(195, 49, '2024-12-10 21:05:27', 'user', '2024-12-10 21:05:30'),
(196, 49, '2024-12-10 21:05:35', 'user', '2024-12-10 21:06:39'),
(198, 49, '2024-12-10 21:07:14', 'user', '2024-12-10 21:07:17'),
(200, 49, '2024-12-10 21:07:28', 'user', '2024-12-10 21:07:31'),
(202, 49, '2024-12-10 21:07:44', 'user', '2024-12-10 21:07:49'),
(203, 49, '2024-12-10 21:08:12', 'user', '2024-12-10 21:08:14'),
(204, 49, '2024-12-10 21:08:21', 'user', '2024-12-10 21:08:23'),
(205, 49, '2024-12-10 21:08:32', 'user', '2024-12-10 21:08:38'),
(206, 49, '2024-12-10 21:08:59', 'user', '2024-12-10 21:09:02'),
(208, 49, '2024-12-10 21:09:21', 'user', '2024-12-10 21:09:34'),
(209, 49, '2024-12-10 21:09:55', 'user', '2024-12-10 21:09:58'),
(210, 49, '2024-12-10 21:10:20', 'user', '2024-12-10 21:10:30'),
(211, 49, '2024-12-10 21:10:38', 'user', '2024-12-10 21:10:45'),
(212, 49, '2024-12-10 21:11:26', 'user', '2024-12-10 21:11:33'),
(214, 49, '2024-12-10 21:13:28', 'user', '2024-12-10 21:13:30'),
(217, 50, '2024-12-10 21:16:32', 'user', NULL),
(218, 50, '2024-12-10 21:16:41', 'user', '2024-12-10 21:17:18'),
(219, 50, '2024-12-10 21:17:29', 'user', '2024-12-10 21:17:36'),
(220, 50, '2024-12-10 21:17:44', 'user', '2024-12-10 21:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `college_img` varchar(50) DEFAULT NULL,
  `college_rating` decimal(3,2) DEFAULT NULL,
  `college_place` varchar(50) NOT NULL,
  `college_type` varchar(25) NOT NULL,
  `college_url` varchar(50) DEFAULT NULL,
  `college_description` text DEFAULT NULL,
  `college_category` enum('private','government','semi-government') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`, `college_img`, `college_rating`, `college_place`, `college_type`, `college_url`, `college_description`, `college_category`) VALUES
(135, 'B A COLLEGE OF AGRICULTURE', 'image/B A COLLEGE.png', 8.50, 'anand', 'agriculture', 'https://www.aau.in/college-menu/178', 'Bansilal Amrutlal College of Agriculture established in 1947 with the tireless efforts by Sardar Vallabhbhai Patel-the Ironman of India, learned Shree Kanaiyalal Maneklal Munshi and Agricultural scientist Dr. M. D. Patel since its inception, has been significantly contributing to agricultural development and research as well in the state of Gujarat and nation at large. A huge workforce of trained teachers and scientists has been working for the tremendous activities in education, research and extension education. Every year approximately, 140 students at undergraduate and 120 at postgraduate level enroll in agricultural studies from different parts of India and abroad. After constitution of Anand Agricultural University (2004) around 2500 graduates and post graduates and since establishment of the institute (1947) around 8500 graduates and post graduates students have earned their degree from this institute and most of them have been working in the various fields of agriculture with reputed agencies of India and abroad. Since years, higher efficiency, expertise in the subject and leadership guts-these three have become the core identity of the students of the institute. Use of latest technology in education, research and extension has always been encouraged here. Due to this, students from the institute really have sound knowledge along with the latest updates in the field of agriculture. There are 18 departments working on crop-breeding, crop-production, crop-protection and Social Sciences and thereby carrying out various activities of education, research and extension education.', 'private'),
(136, 'COLLEGE OF HORTICULTURE ', 'image/HORTI.png', 7.00, 'anand', 'agriculture', 'https://www.aau.in/college-menu/4844', '    Horticulture education until 1970 was taught as a part of agriculture curriculum. Realizing the importance of horticulture in promoting livelihood security, economic empowerment and nutritional security, horticulture emerged as a separate discipline. Separate colleges of Horticulture were established with the first college of Horticulture coming in Kerala in 1972. Since then 12 more colleges of Horticulture have been established in the country. Among them only one college of Horticulture & Forestry is at NAU, Navsari but now a days in other 3 SAU\'s Horticulture colleges started at Anand, Sardar krushinagar and Junagadh.', 'private'),
(141, 'INTERNATIONAL  AGRIBUSINESS MANAGEMENT INSTITUTE ', 'image/IABMA.png', 7.50, 'anand baroda', 'agriculture', 'https://www.aau.in/college-menu/705', 'International Agribusiness Management Institute was established in August 2008. The institute offers two years Master of Business Administration (Agribusiness Management) as well as three years Ph.D.(Agribusiness Management) programmes with a core focus on agribusiness and international trade. This post graduate programme is aimed to craft professional business leaders, entrepreneurs and academicians in the food and agri-business sectors. The institute maintains a rigorous intellectual teaching process to mould the students to the standards of international level. With the concrete weightage to the industrial needs in the course curriculum, various outside scholars not only from academics, but also from various well known organizations are invited for their input to the students.', 'private'),
(142, 'COLLEGE OF AGRICULTURE,JABUGAM', 'image/JABUGAM.png', 6.90, 'jabugam', 'agriculture', 'https://www.aau.in/college-menu/4845', '    State government has been incessantly planning and working for the focused develioment of the areas dominated by tribes. Chhotaudepur is one such tribal region of the state and with the consideration of agricultural development of the region, the Govt. of Gujarat sanctioned the College of Agriculture at Jabugam, Ta: Bodeli, Dist: Chhotaudepur in the year 2012-13 and it has started catering the needs of agricultural education in the region thereafter. ', 'private'),
(143, 'COLLEGE OF CAET', 'image/godhara.png', 6.80, 'godhara', 'engineering', 'https://www.aau.in/college-menu/707/1194', 'Government of Gujarat had given permission to establish a new Agricultural Engineering college in tribal belt of Middle Gujarat. Keeping-in-view, the demo graphical and geographical scenario and the probable prospects and contribution of Agricultural Engineering to the state of Gujarat, it was the vibrant vision of Hon’ble Shri Narendra Modi, Ex. Chief Minister of Gujarat  to establish an Agricultural Engineering College at Godhra under aegis of Van Bandhu Kalyan Yojna for providing quality technical education in  Agricultural Engineering for educational, societal and an overall upliftment of tribal youth as well tribal areas. The college was established at Dholakuva, Dahod road, Godhra under the jurisdiction of Anand Agricultural University, Anand.To conduct research, testing of farm machineries and demonstration of modern farm machineries an instructional farm was required to establish. To develop a research an instructional farm above 20.40 hectares area near Kankanpur village was allotted to the College. The detail of the land allotted was given in the map. The area was full of undulated profiles and totally wastes land not suitable for agricultural purposes. After acquiring the land, the entire area of the farm was leveled and made plots to facilitate a batter irrigation and drainage facilities.', 'government'),
(144, 'COLLEGE OF AGRICULTURE , VASO', 'image/vaso.png', 4.00, 'vaso', 'agriculture', 'https://www.aau.in/college-menu/1736', 'In this hi-tech era, agriculture enterprise is much more than merely crop production or livestock farming or allied activities. Farmers need to pre-empt environmental impact of climate change and this is where modern technologies (such as Precision Agriculture, Intensive Agriculture, Low-cost input farming, GIS, and Remote Sensing, Genetic Engineering, Biotechnology etc.) come to the rescue. There is no doubt that technology is empowering India’s farming future, and in order to empower this technology, agricultural universities need agriculture bachelors skilled manpower with knowhow of such future ready technologies and imparting the same in reshaping the traditional agricultural sector.', 'government'),
(145, 'SMC COLLEGE OF DAIRY SCIENCE', 'image/SMC-4.jpg', 9.50, 'anand', 'Dairy Science', 'https://www.kamdhenuuni.edu.in/', 'Faculty of Dairy Science, Anand, is a pioneer national center for Dairy Technology education established in 1960.The faculty represented by SMC College of Dairy Science has been recognized as \"Center of Excellence\" which produce qualified dairy professionals. These professionals, by their pursuit for excellence, depth of knowledge and honesty of purpose have brought laurels for themselves and repute to their alma mater.', 'private'),
(146, 'COLLEGE OF VETERINARY SCIENCE AND ANIMAL HUSBANDRY', 'image/vati.jfif', 9.80, 'anand', 'science', 'https://www.kamdhenuuni.edu.in/covs-anand', 'The college was established by the Government of Gujarat in August, 1964 and was formerly affiliated to Sardar Patel University. It became constituent college of Gujarat Agricultural University in 1972. Later on, from May 2004, it was under Anand Agricultural University. Presently, since April 2021, it is a constituent college of Kamdhenu University. Excellent faculty, advanced infrastructure facilities for academics, advanced research and well-equipped Library are salient features of this institute of repute, making it adjudged as a front runner by the Veterinary Council of India, attracting savvy, versatile candidates from far and wide.', 'government'),
(149, 'MJ PATEL COLLEGE OF COMMERCE', 'image/2.JPG', 5.00, 'anand', 'commerce', 'https://www.kamdhenuuni.edu.in/covs-anand', 'this is the besr', 'private'),
(150, 'CVM COLLGE OF ARTS ', 'image/th.jfif', 5.00, 'anand', 'arts', 'https://www.bing.com/search?pglt=297&q=arts+colleg', 'CVM College of Fine Arts part of Charutar Vidya Mandal. It is aimed to provide creative learning environment for various branches of fine arts.', 'private'),
(151, 'SHANTA BAA MEDICAL COLLEGE AND HOSPITAL', 'image/A-03-1280x500.jpg', 7.50, 'amreli', 'medical', 'https://www.nmc.org.in/', 'To train competent, compassionate and caring physicians through excellence in teaching, patient care and medical research. To build an Educational Centre of Excellence in Teaching as well as Training, to render treatment at an affordable cost and to maintain standards, ethics and morale at a level the area may be proud of.', 'private'),
(157, 'J & J COLLEGE OF SCIENCE', 'image/qq.jfif', 4.00, 'nadiad', 'science', 'https://paruluniversity.ac.in/', 'Serving the society by Enlightening the rural area of Kheda District with Science education at doorstep and enable youth to enhance the dignity and progress of the Nation.', 'semi-government'),
(158, 'N D DESAI MEDICAL COLLEGE', 'image/nav-img.jpg', 8.50, 'nadiad', 'medical', 'https://medical.ddu.ac.in/', 'Medical Faculty of DDU: Dr. N. D. Desai Faculty of Medical Science and Research is the fifth Faculty to be started by the Dharmsinh Desai University of Nadiad (DDU) after Faculty of Technology, Faculty of Pharmacy, Faculty of Dental Science and Faculty of Management and Information Science.\r\nMedical College: Medical Council of India has granted permission to start this new Medical College with annual intake capacity of 150 MBBS students from the academic year 2019-20.\r\nSituated on sprawling 20 acre campus fulfilling all the statutory requirements of the Medical Council of India, the Institute aims to be a leading institute providing state-of-the-art medical education to the aspiring young doctors.\r\nHospital: The Medical College is associated with Dr. N. D. Desai Hospital, a 737 bedded multispecialty hospital that is providing FREE health care to the people not just of Kheda District but also of the surrounding under-served areas.', 'private'),
(159, 'GROW MORE COLLEGE OF MEDICAL SCIENCE', 'image/download.jfif', 5.50, 'himmatnagar', 'medical', 'https://growmore.ac.in/', 'BZ Global Education Campus is on a mission to revolutionize education in Gujarat. We offer innovative and globally-relevant programs designed to empower students for success and fulfillment. Our curriculum goes beyond traditional academics. We foster well-rounded individuals by integrating spiritual awareness, progressive thinking, and a rich appreciation for diverse cultures. Guided by a prestigious advisory board of renowned academics, literary figures, and international athletes, BZ Global is committed to setting new standards in education and helping students reach their full potential.', 'private'),
(160, 'COLLEGE OF CAIT', 'image/ait.jpg.crdownload', 9.99, 'anand', 'engineering', 'https://www.aau.in/ait-introduction', 'College of Agricultural Information Technology was established in the year 2009 under the aegis of Anand Agricultural University. The CAIT offers 4-yrs B.Tech. (AIT) program. The college aims to cater to the upcoming demands of the Agrarian Economy by generation of a young workforce skilled with knowhow of future ready Information and Communication Technology and imparting the same in Agricultural sector. The college has trained teaching faculty with a balanced blend of well-experienced seniors and energetic youth focused towards Teaching and Research. The College building is surrounded by lush green natural environment with enough resources such as well-ventilated lecture halls with audio visual facility, computer labs, scientific equipments, Wi-Fi Internet access, library, NCC/NSS, sports, project and placement cell etc.', 'private'),
(162, 'INDIAN INSTITUTE OF MANAGEMENT ', 'image/download.jpg', 9.99, 'amedabad', 'engineering', 'https://www.iima.ac.in/', 'Rank amongst Business Schools in India by the NIRF (Management Category) since 2020', 'government');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_duration` varchar(25) NOT NULL,
  `course_fees` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `college_id`, `course_name`, `course_duration`, `course_fees`) VALUES
(83, 135, 'B.Sc agriculture', '4 yeras', 60000.00),
(84, 135, 'M.Sc Agriculture', '5 years', 50000.00),
(85, 136, 'B.Sc Horticulture', '4 years', 60000.00),
(87, 141, 'Master of Business Administration (Agribusiness Ma', '2 years', 100000.00),
(88, 141, 'Ph.D.(Agribusiness Management)', '3 years', 150000.00),
(89, 142, 'B.Sc agriculture', '4 yeras', 60000.00),
(90, 143, 'B.Tech Agri Engineering', '4 yeras', 60000.00),
(91, 144, 'B.Sc agriculture', '4 yeras', 60000.00),
(92, 145, 'B.Tech Dairy Science', '4 yeras', 60000.00),
(93, 145, 'M.Tech Dairy Science', '2 years', 50000.00),
(94, 146, 'B.V.Sc & A.H. (Under graduation)', '5 years', 85000.00),
(95, 146, 'Ph.D. (Doctorate)', '2 years', 50000.00),
(96, 149, 'Ph.D. (Doctorate)', '2 years', 50000.00),
(97, 149, 'it', '2 years', 50000.00),
(98, 150, 'B.A', '3 years', 20000.00),
(99, 151, 'MBBS', '5 years', 100000.00),
(100, 158, 'M.B.B.S. (Bachelor of Medicine, Bachelor of Surger', '5 years', 500000.00),
(101, 160, 'B.Tech AIT', '4 year\'s ', 60000.00),
(102, 162, 'MBA', '2 years', 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `resets`
--

CREATE TABLE `resets` (
  `id` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `Email`, `Username`, `Password`, `type`) VALUES
(49, 'patel@gmail.com', 'Patel', 'patel', 'user'),
(50, 'kp@gmail.com', 'kunj', '1234', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `audit_table`
--
ALTER TABLE `audit_table`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `resets`
--
ALTER TABLE `resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Code` (`Code`),
  ADD KEY `Email` (`Email`),
  ADD KEY `Expire` (`Expire`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `audit_table`
--
ALTER TABLE `audit_table`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `resets`
--
ALTER TABLE `resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resets`
--
ALTER TABLE `resets`
  ADD CONSTRAINT `fk_members_email` FOREIGN KEY (`Email`) REFERENCES `userlogin` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
