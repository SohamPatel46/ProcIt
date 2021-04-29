-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 11:41 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ictquizportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_database_question`
--

CREATE TABLE `add_database_question` (
  `ID` int(30) NOT NULL,
  `Course_Id` varchar(30) NOT NULL,
  `Question_Id` int(30) NOT NULL,
  `Question` text NOT NULL,
  `Option1` text NOT NULL,
  `Option2` text NOT NULL,
  `Option3` text NOT NULL,
  `Option4` text NOT NULL,
  `Correct_Option` text NOT NULL,
  `Image` longtext NOT NULL,
  `Explaination` text NOT NULL,
  `Topic` text NOT NULL,
  `Marks` int(15) NOT NULL,
  `question_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='This will Be question Bank for quiz';

--
-- Dumping data for table `add_database_question`
--

INSERT INTO `add_database_question` (`ID`, `Course_Id`, `Question_Id`, `Question`, `Option1`, `Option2`, `Option3`, `Option4`, `Correct_Option`, `Image`, `Explaination`, `Topic`, `Marks`, `question_type`) VALUES
(1234, 'CN010145', 19, 'Which of the following tasks is not done by data link layer?', 'framing', 'error control', 'flow control', 'channel coding', 'channel coding', 'Uploads/notverified.jpg', 'Channel coding is the function of physical layer. Data link layer mainly deals with framing, error control and flow control. Data link layer is the layer where the packets are encapsulated into frames.', 'Data Link Layer', 2, 'mcqs'),
(1234, 'CN010145', 20, 'Header of a frame generally contains ______________', 'synchronization bytes', 'addresses', 'frame identifier', 'all of the mentioned', 'all of the mentioned', 'Uploads/2nd Year Marksheet_page-0001.jpg', 'In a frame, the header is a part of the data that contains all the required information about the transmission of the file. It contains information like synchronization bytes, addresses, frame identifier etc. It also contains error control information for reducing the errors in the transmitted frames.', 'Data Link Layer', 1, 'mcqs'),
(1234, 'CN010145', 21, 'Which of the following is a data link protocol?', 'ethernet', 'HDLC', 'point to point protocol', 'all of the mentioned', 'all of the mentioned', 'Uploads/2nd Year Marksheet_page-0001.jpg', 'There are many data link layer protocols. Some of them are SDLC (synchronous data link protocol), HDLC (High level data link control), SLIP (serial line interface protocol), PPP (Point to point protocol) etc. These protocols are used to provide the logical link control function of the Data Link Layer.', 'Data Link Layer', 1, 'mcqs'),
(1234, 'CN010145', 22, 'Which of the following is the multiple access protocol for channel access control?', 'CSMA/CD', 'CSMA/CA', 'Both CSMA/CD & CSMA/CA', 'HDLC', 'Both CSMA/CD & CSMA/CA', 'Uploads/2nd Year Marksheet_page-0001.jpg', 'In CSMA/CD, it deals with detection of collision after collision has occurred, whereas CSMA/CA deals with preventing collision. CSMA/CD is abbreviation for Carrier Sensing Multiple Access/Collision detection. CSMA/CA is abbreviation for Carrier Sensing Multiple Access/Collision Avoidance. These protocols are used for efficient multiple channel access.', 'Data Link Layer', 2, 'mcqs'),
(1234, 'CN010145', 23, 'The technique of temporarily delaying outgoing acknowledgements so that they can be hooked onto the next outgoing data frame is called ____________', 'piggybacking', 'CRC', 'fletcher’s checksum', 'parity check', 'piggybacking', 'Uploads/2nd Year Marksheet_page-0001.jpg', 'Piggybacking is a technique in which the acknowledgment is temporarily delayed so as to be hooked with the next outgoing data frame. It saves a lot of channel bandwidth as in non-piggybacking system, some bandwidth is reserved for acknowledgement.', 'Data Link Layer', 1, 'mcqs'),
(1234, 'CN010145', 24, 'Automatic repeat request error management mechanism is provided by ________', 'logical link control sublayer', 'media access control sublayer', 'network interface control sublayer', 'application access control sublayer', 'logical link control sublayer', 'Uploads/notverified.jpg', 'The logical link control is a sublayer of data link layer whose main function is to manage traffic, flow and error control. The automatic repeat request error management mechanism is provided by the LLC when an error is found in the received frame at the receiver’s end to inform the sender to re-send the frame.', 'Data Link Layer', 1, 'mcqs'),
(1234, 'CN010145', 25, 'When 2 or more bits in a data unit has been changed during the transmission, the error  is called ____________', 'random error', 'burst error', 'inverted error', 'double error', 'burst error', 'Uploads/notverified.jpg', 'When a single bit error occurs in a data, it is called single bit error. When more than a single bit of data is corrupted or has error, it is called burst error. If a single bit error occurs, the bit can be simply repaired by inverting it, but in case of a burst error, the sender has to send the frame again.', 'Data Link Layer', 1, 'mcqs'),
(1234, 'CN010145', 38, 'What is 1 byte in terms of bit ? (only digit)', '--', '--', '--', '--', '8', 'Uploads/notverified.jpg', '1 byte is equivalent to 8 bits.', 'Data Link Layer', 2, 'numerical'),
(1234, 'CN010145', 39, 'What is 1 byte?', '8 bits', '2 nibble', '4 bits', '1 nibble', 'a,b', 'Uploads/notverified.jpg', '1 byte is equivalent to 8 bits and 2 nibbles', 'Data Link Layer', 2, 'multiple_answer'),
(1234, 'CN010145', 42, ' When 2 or more bits in a data unit has been changed during the transmission, the error is called ____________?', '--', '--', '--', '--', 'burst error', 'Uploads/notverified.jpg', 'When a single bit error occurs in a data, it is called single bit error. When more than a single bit of data is corrupted or has error, it is called burst error. If a single bit error occurs, the bit can be simply repaired by inverting it, but in case of a burst error, the sender has to send the frame again.', 'Data Link Layer', 1, 'oneword'),
(1234, 'CN010145', 43, 'Match the following:', 'Data link layer,Node to node delivery', 'Network layer   ,Flow control', 'Transport layer ,Mail services', 'Application layer   ,Routing', '1b,2d,3a4c', 'Uploads/notverified.jpg', 'Self Remembrance Not required to explain', 'Data Link Layer', 2, 'match_following'),
(1234, 'CN010145', 44, 'the data link layer accepts messages from the network layer and controls the hardware that transmits them', '--', '--', '--', '--', 'True', 'Uploads/notverified.jpg', 'Self Explainatory', 'Data Link Layer', 1, 'T_F');

-- --------------------------------------------------------

--
-- Table structure for table `add_database_question_student`
--

CREATE TABLE `add_database_question_student` (
  `Course_Id` varchar(30) NOT NULL,
  `Question_Id` int(11) NOT NULL,
  `Question` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  `correct_option` text NOT NULL,
  `Image` text NOT NULL,
  `explaination` text NOT NULL,
  `Topic` varchar(30) NOT NULL,
  `Marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `add_quiz_question`
--

CREATE TABLE `add_quiz_question` (
  `ID` int(30) NOT NULL,
  `Course_Id` varchar(30) NOT NULL,
  `Quiz_Id` varchar(30) NOT NULL,
  `Question_Number` int(15) NOT NULL,
  `Question` text NOT NULL,
  `Option1` text NOT NULL,
  `Option2` text NOT NULL,
  `Option3` text NOT NULL,
  `Option4` text NOT NULL,
  `Correct_Option` text NOT NULL,
  `Image` text NOT NULL,
  `Explaination` text NOT NULL,
  `Marks` int(15) NOT NULL,
  `question_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Used to take question input by faculty for new quiz';

--
-- Dumping data for table `add_quiz_question`
--

INSERT INTO `add_quiz_question` (`ID`, `Course_Id`, `Quiz_Id`, `Question_Number`, `Question`, `Option1`, `Option2`, `Option3`, `Option4`, `Correct_Option`, `Image`, `Explaination`, `Marks`, `question_type`) VALUES
(1234, 'CN010145', 'CN01', 1, 'Header of a frame generally contains ______________', 'synchronization bytes', 'addresses', 'frame identifier', 'all of the mentioned', 'all of the mentioned', 'Uploads/notverified.jpg', 'In a frame, the header is a part of the data that contains all the required information about the transmission of the file. It contains information like synchronization bytes, addresses, frame identifier etc. It also contains error control information for reducing the errors in the transmitted frames.', 1, 'mcqs'),
(1234, 'CN010145', 'CN01', 2, 'What is 1 byte?', '8 bits', '2 nibble', '4 bits', '1 nibble', 'a,b', 'Uploads/notverified.jpg', '1 byte is equivalent to 8 bits and 2 nibbles', 2, 'multiple_answer'),
(1234, 'CN010145', 'CN01', 3, ' When 2 or more bits in a data unit has been changed during the transmission, the error is called ____________?', '--', '--', '--', '--', 'burst error', 'Uploads/notverified.jpg', 'When a single bit error occurs in a data, it is called single bit error. When more than a single bit of data is corrupted or has error, it is called burst error. If a single bit error occurs, the bit can be simply repaired by inverting it, but in case of a burst error, the sender has to send the frame again.', 1, 'oneword'),
(1234, 'CN010145', 'CN01', 4, 'The technique of temporarily delaying outgoing acknowledgements so that they can be hooked onto the next outgoing data frame is called ____________', 'piggybacking', 'CRC', 'fletcher’s checksum', 'parity check', 'piggybacking', 'Uploads/2nd Year Marksheet_page-0001.jpg', 'Piggybacking is a technique in which the acknowledgment is temporarily delayed so as to be hooked with the next outgoing data frame. It saves a lot of channel bandwidth as in non-piggybacking system, some bandwidth is reserved for acknowledgement.', 1, 'mcqs'),
(1234, 'CN010145', 'CN01', 5, 'Match the following:', 'Data link layer,Node to node delivery', 'Network layer,Flow control', 'Transport layer ,Mail services', 'Application layer,Routing', '1b,2d,3a,4c', 'Uploads/notverified.jpg', 'Self Remembrance Not required to explain', 2, 'match_following'),
(1234, 'CN010145', 'CN01', 6, 'the data link layer accepts messages from the network layer and controls the hardware that transmits them', '--', '--', '--', '--', 'True', 'Uploads/notverified.jpg', 'Self Explainatory', 1, 'T_F'),
(1234, 'CN010145', 'CN01', 7, 'What is 1 byte in terms of bit ? (only digit)', '--', '--', '--', '--', '8', 'Uploads/notverified.jpg', '1 byte is equivalent to 8 bits.', 2, 'numerical');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_data`
--

CREATE TABLE `faculty_data` (
  `ID` int(30) NOT NULL,
  `Email_Id` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `Image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='It will store Faculty Data';

--
-- Dumping data for table `faculty_data`
--

INSERT INTO `faculty_data` (`ID`, `Email_Id`, `password`, `Name`, `Image`) VALUES
(1234, 'hitkumar.bhalodia105373@marwadiuniversity.edu.in', 'hit123', 'Hit Bhalodia', ''),
(1235, 'sohampatel@marwadiuniversity.edu.in', 'soham123', 'Soham Patel', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Email_Id` varchar(100) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Login table for both faculty and students';

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Email_Id`, `Password`) VALUES
('ayush.vacchani105095@marwadiuniversity.ac.in', 'ayush123'),
('hitkumar.bhalodia105373@marwadiuniversity.ac.in', 'hit123'),
('hitkumar.bhalodia105373@marwadiuniversity.edu.in', 'hit123'),
('meettank@marwadiuniversity.ac.in', 'meet123'),
('sohampatel@marwadiuniversity.ac.in', 'soham123'),
('sohampatel@marwadiuniversity.edu.in', 'soham123');

-- --------------------------------------------------------

--
-- Table structure for table `new_course_add`
--

CREATE TABLE `new_course_add` (
  `ID` int(30) NOT NULL,
  `Course_Id` varchar(30) NOT NULL,
  `Course_Name` varchar(30) NOT NULL,
  `Degree_Diploma` varchar(30) NOT NULL,
  `Academic_GATE` varchar(30) NOT NULL,
  `Batch_Year` varchar(30) NOT NULL,
  `Sub_Image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table will have data if faculty will start New Course';

--
-- Dumping data for table `new_course_add`
--

INSERT INTO `new_course_add` (`ID`, `Course_Id`, `Course_Name`, `Degree_Diploma`, `Academic_GATE`, `Batch_Year`, `Sub_Image`) VALUES
(1234, 'CN010145', 'Computer Networks', 'Degree', 'Acedamics', '2018-2022', 'Uploads/2nd-Year.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `new_quiz_generate`
--

CREATE TABLE `new_quiz_generate` (
  `ID` int(30) NOT NULL,
  `Course_Id` varchar(30) NOT NULL,
  `Quiz_Id` varchar(30) NOT NULL,
  `Academic_GATE` varchar(10) NOT NULL,
  `Quiz_Name` varchar(30) NOT NULL,
  `Topic_Name` varchar(30) NOT NULL,
  `No_Of_Attempts` int(15) NOT NULL,
  `Total_Question` int(15) NOT NULL,
  `Total_Marks` int(15) NOT NULL,
  `Reference_Link` text NOT NULL,
  `Date` varchar(30) NOT NULL,
  `Start_Time` varchar(30) NOT NULL,
  `End_Time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='It will store Details of Quizzes';

--
-- Dumping data for table `new_quiz_generate`
--

INSERT INTO `new_quiz_generate` (`ID`, `Course_Id`, `Quiz_Id`, `Academic_GATE`, `Quiz_Name`, `Topic_Name`, `No_Of_Attempts`, `Total_Question`, `Total_Marks`, `Reference_Link`, `Date`, `Start_Time`, `End_Time`) VALUES
(1234, 'CN010145', 'CN01', 'Acedamics', 'CN IA Quiz 1', 'Data Link Layer', 1, 7, 10, 'https://en.wikipedia.org/wiki/Data_link_layer', '2020-12-17', '06:55', '19:05');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_respose`
--

CREATE TABLE `quiz_respose` (
  `Serial_number` int(11) NOT NULL,
  `ID` varchar(30) NOT NULL,
  `Course_ID` varchar(30) NOT NULL,
  `Quiz_ID` varchar(30) NOT NULL,
  `Response_string` text NOT NULL,
  `Correct_string` text NOT NULL,
  `Flag_string` text NOT NULL,
  `Score` int(11) NOT NULL,
  `Out_of` int(11) NOT NULL,
  `change_screen_count` int(11) NOT NULL,
  `Face_count` int(11) NOT NULL,
  `Attempt` int(11) NOT NULL,
  `Time_Taken` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_respose`
--

INSERT INTO `quiz_respose` (`Serial_number`, `ID`, `Course_ID`, `Quiz_ID`, `Response_string`, `Correct_string`, `Flag_string`, `Score`, `Out_of`, `change_screen_count`, `Face_count`, `Attempt`, `Time_Taken`) VALUES
(65, 'so2018-2022paso', 'CN010145', 'CN01', 'all of the mentioned~a,c~burst error~fletcher’s checksum~1b,2d,3a,4c~False~8~', 'all of the mentioned~a,b~burst error~piggybacking~1b,2d,3a,4c~True~8~', '1~0~1~0~1~0~1~', 6, 10, 1, 0, 1, '2 min. 29 sec.'),
(66, 'me2018-2022tame', 'CN010145', 'CN01', 'frame identifier~a,b~burst error~piggybacking~1c,2b,3a,4d~True~1~', 'all of the mentioned~a,b~burst error~piggybacking~1b,2d,3a,4c~True~8~', '0~1~1~1~0~1~0~', 5, 10, 1, 0, 1, '0 min. 29 sec.'),
(94, 'ay2018-2022vaay', 'CN010145', 'CN01', 'frame identifier~c~burst~fletcher’s checksum~1b,2d,3a,4c~False~7~', 'all of the mentioned~a,b~burst error~piggybacking~1b,2d,3a,4c~True~8~', '0~0~0~0~1~0~0~', 2, 10, 0, 0, 1, '1 min. 55 sec.'),
(102, 'hi2018-2022bhhi', 'CN010145', 'CN01', 'all of the mentioned~a,b~burst error~piggybacking~1b,2d,3a,4c~True~8~', 'all of the mentioned~a,b~burst error~piggybacking~1b,2d,3a,4c~True~8~', '1~1~1~1~1~1~1~', 10, 10, 0, 0, 1, '1 min. 29 sec.');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `Email_Id` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `ID` varchar(30) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `Image` longtext NOT NULL,
  `Degree_Diploma` varchar(30) NOT NULL,
  `Semester` tinyint(30) NOT NULL,
  `Batch_Year` varchar(30) NOT NULL,
  `Enrollment_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='It will store the student Data';

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`Email_Id`, `password`, `ID`, `Name`, `Image`, `Degree_Diploma`, `Semester`, `Batch_Year`, `Enrollment_no`) VALUES
('ayush.vacchani105095@marwadiuniversity.ac.in', 'ayush123', 'ay2018-2022vaay', 'Ayush Vacchani', '', 'Degree', 5, '2018-2022', 91800133016),
('hitkumar.bhalodia105373@marwadiuniversity.ac.in', 'hit123', 'hi2018-2022bhhi', 'Hit Bhalodia', '', 'Degree', 5, '2018-2022', 91800133023),
('meettank@marwadiuniversity.ac.in', 'meet123', 'me2018-2022tame', 'Meet Tank', '', 'Degree', 5, '2018-2022', 91800133013),
('sohampatel@marwadiuniversity.ac.in', 'soham123', 'so2018-2022paso', 'Soham Patel ', '', 'Degree', 5, '2018-2022', 91800133046);

-- --------------------------------------------------------

--
-- Table structure for table `to_do_list_student`
--

CREATE TABLE `to_do_list_student` (
  `ID` int(30) NOT NULL,
  `Course_Id` varchar(30) NOT NULL,
  `Degree_diploma` varchar(30) NOT NULL,
  `Academic_Gate` varchar(30) NOT NULL,
  `Batch_Year` varchar(30) NOT NULL,
  `Quiz_Id` varchar(30) NOT NULL,
  `Quiz_Name` varchar(30) NOT NULL,
  `Topic` varchar(30) NOT NULL,
  `Attempts` int(11) NOT NULL,
  `Marks` int(11) NOT NULL,
  `Total_Question` int(11) NOT NULL,
  `Reference_Link` text NOT NULL,
  `Quiz_Date` varchar(30) NOT NULL,
  `Start_Time` varchar(30) NOT NULL,
  `End_Time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `to_do_list_student`
--

INSERT INTO `to_do_list_student` (`ID`, `Course_Id`, `Degree_diploma`, `Academic_Gate`, `Batch_Year`, `Quiz_Id`, `Quiz_Name`, `Topic`, `Attempts`, `Marks`, `Total_Question`, `Reference_Link`, `Quiz_Date`, `Start_Time`, `End_Time`) VALUES
(11, 'CN010145', 'Degree', 'Acedamics', '2018-2022', 'CN01', 'CN IA Quiz 1', 'Data Link Layer', 1, 10, 7, 'https://en.wikipedia.org/wiki/Data_link_layer', '2020-12-17', '06:55', '19:05');

-- --------------------------------------------------------

--
-- Table structure for table `to_do_task_faculty`
--

CREATE TABLE `to_do_task_faculty` (
  `ID` int(30) NOT NULL,
  `Course_Id` varchar(30) NOT NULL,
  `Task_Date` varchar(30) NOT NULL,
  `Task_Time` varchar(30) NOT NULL,
  `Remarks` text NOT NULL,
  `Sr_No` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='It will store Task Of Faculty';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_database_question`
--
ALTER TABLE `add_database_question`
  ADD PRIMARY KEY (`Question_Id`,`ID`,`Course_Id`);

--
-- Indexes for table `add_database_question_student`
--
ALTER TABLE `add_database_question_student`
  ADD PRIMARY KEY (`Question_Id`);

--
-- Indexes for table `add_quiz_question`
--
ALTER TABLE `add_quiz_question`
  ADD PRIMARY KEY (`ID`,`Course_Id`,`Quiz_Id`,`Question_Number`);

--
-- Indexes for table `faculty_data`
--
ALTER TABLE `faculty_data`
  ADD PRIMARY KEY (`ID`,`Email_Id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Email_Id`);

--
-- Indexes for table `new_course_add`
--
ALTER TABLE `new_course_add`
  ADD PRIMARY KEY (`ID`,`Course_Id`);

--
-- Indexes for table `new_quiz_generate`
--
ALTER TABLE `new_quiz_generate`
  ADD PRIMARY KEY (`ID`,`Course_Id`,`Quiz_Id`);

--
-- Indexes for table `quiz_respose`
--
ALTER TABLE `quiz_respose`
  ADD PRIMARY KEY (`Serial_number`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`Email_Id`,`ID`);

--
-- Indexes for table `to_do_list_student`
--
ALTER TABLE `to_do_list_student`
  ADD PRIMARY KEY (`ID`,`Course_Id`,`Degree_diploma`,`Academic_Gate`,`Batch_Year`,`Quiz_Id`);

--
-- Indexes for table `to_do_task_faculty`
--
ALTER TABLE `to_do_task_faculty`
  ADD PRIMARY KEY (`Sr_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_database_question`
--
ALTER TABLE `add_database_question`
  MODIFY `Question_Id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `add_database_question_student`
--
ALTER TABLE `add_database_question_student`
  MODIFY `Question_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_respose`
--
ALTER TABLE `quiz_respose`
  MODIFY `Serial_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `to_do_list_student`
--
ALTER TABLE `to_do_list_student`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `to_do_task_faculty`
--
ALTER TABLE `to_do_task_faculty`
  MODIFY `Sr_No` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
