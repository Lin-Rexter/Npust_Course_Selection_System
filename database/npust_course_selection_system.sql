-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-24 08:16:04
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `npust_course_selection_system`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `aId` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(14) NOT NULL,
  `student_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='帳號';

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `cId` int(10) NOT NULL COMMENT '課程id',
  `department` varchar(50) NOT NULL COMMENT '開課系所',
  `teacher` varchar(50) NOT NULL COMMENT '授課教師',
  `course_id` int(10) NOT NULL COMMENT '課程代碼',
  `course_name` varchar(50) NOT NULL COMMENT '課程名稱',
  `course_status` char(5) NOT NULL COMMENT '開課狀態',
  `class_name` varchar(50) NOT NULL COMMENT '開課班級',
  `credit` float NOT NULL COMMENT '學分',
  `subject` char(5) NOT NULL COMMENT '修別(必修/選修)',
  `course_hours` float NOT NULL COMMENT '上課時數',
  `day_of_week` int(5) NOT NULL COMMENT '上課星期',
  `period` int(5) NOT NULL COMMENT '上課節次',
  `class_id` varchar(10) NOT NULL COMMENT '教室代號、名稱'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='課程';

-- --------------------------------------------------------

--
-- 資料表結構 `guestbook`
--

CREATE TABLE `guestbook` (
  `mId` int(10) NOT NULL COMMENT '留言id',
  `aId` int(10) NOT NULL COMMENT '留言人帳號id',
  `cId` int(10) NOT NULL COMMENT '課程id',
  `message_name` varchar(50) NOT NULL COMMENT '留言者姓名',
  `message_time` datetime NOT NULL COMMENT '留言時間',
  `content` text NOT NULL COMMENT '留言內容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='留言板';

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `sId` int(10) NOT NULL COMMENT '學生id',
  `aId` int(10) NOT NULL COMMENT '帳號id',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `student_id` varchar(10) NOT NULL COMMENT '學號',
  `grade` int(3) NOT NULL COMMENT '年級',
  `birthday` datetime DEFAULT NULL COMMENT '生日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='學生';

-- --------------------------------------------------------

--
-- 資料表結構 `subject_timetable`
--

CREATE TABLE `subject_timetable` (
  `no` int(10) NOT NULL COMMENT '課程表id',
  `sId` int(10) NOT NULL COMMENT '學生id',
  `cId` int(10) NOT NULL COMMENT '課程id',
  `course_name` varchar(50) NOT NULL COMMENT '課程名稱',
  `course_date` datetime NOT NULL COMMENT '上課時間、節次',
  `class_id` varchar(10) NOT NULL COMMENT '教室代號、名稱	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='課程表';

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`aId`,`username`,`password`);

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cId`) USING BTREE,
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- 資料表索引 `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`mId`,`aId`,`cId`),
  ADD KEY `aId` (`aId`),
  ADD KEY `cId` (`cId`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sId`,`aId`),
  ADD KEY `aId` (`aId`);

--
-- 資料表索引 `subject_timetable`
--
ALTER TABLE `subject_timetable`
  ADD PRIMARY KEY (`no`,`sId`,`cId`,`course_name`),
  ADD KEY `sId` (`sId`),
  ADD KEY `cId` (`cId`),
  ADD KEY `course_name` (`course_name`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account`
--
ALTER TABLE `account`
  MODIFY `aId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course`
--
ALTER TABLE `course`
  MODIFY `cId` int(10) NOT NULL AUTO_INCREMENT COMMENT '課程id';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `mId` int(10) NOT NULL AUTO_INCREMENT COMMENT '留言id';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `student`
--
ALTER TABLE `student`
  MODIFY `sId` int(10) NOT NULL AUTO_INCREMENT COMMENT '學生id';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `subject_timetable`
--
ALTER TABLE `subject_timetable`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT COMMENT '課程表id';

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `guestbook`
--
ALTER TABLE `guestbook`
  ADD CONSTRAINT `guestbook_ibfk_1` FOREIGN KEY (`aId`) REFERENCES `account` (`aId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `guestbook_ibfk_2` FOREIGN KEY (`cId`) REFERENCES `course` (`cId`);

--
-- 資料表的限制式 `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`aId`) REFERENCES `account` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `subject_timetable`
--
ALTER TABLE `subject_timetable`
  ADD CONSTRAINT `subject_timetable_ibfk_1` FOREIGN KEY (`sId`) REFERENCES `student` (`sId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_2` FOREIGN KEY (`cId`) REFERENCES `course` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_timetable_ibfk_3` FOREIGN KEY (`course_name`) REFERENCES `course` (`course_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
