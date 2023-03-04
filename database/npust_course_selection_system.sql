-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-01-13 18:17:59
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
  `aId` int(10) NOT NULL COMMENT '帳號id',
  `username` varchar(255) NOT NULL COMMENT '帳號名稱',
  `password` varchar(255) NOT NULL COMMENT '帳號密碼',
  `email` varchar(50) NOT NULL COMMENT '電子郵件',
  `student_id` varchar(10) DEFAULT NULL COMMENT '學號',
  `create_time` datetime DEFAULT NULL COMMENT '註冊日期'
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

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`cId`, `department`, `teacher`, `course_id`, `course_name`, `course_status`, `class_name`, `credit`, `subject`, `course_hours`, `day_of_week`, `period`, `class_id`) VALUES
(42, '農園系', '李家興', 1003, '外語實務', '開', '四農園一A', 0, '必', 0, 7, 0, ' '),
(43, '農園系', '李家興', 1004, '生活服務教育', '開', '四農園一A', 0, '必', 2, 5, 3, 'HO 306'),
(44, '農園系', '李家興', 1004, '生活服務教育', '開', '四農園一A', 0, '必', 2, 5, 4, 'HO 306'),
(45, '農園系', '李家興', 1003, '外語實務', '開', '四農園一A', 0, '必', 0, 7, 0, ' '),
(46, '農園系', '李家興', 1004, '生活服務教育', '開', '四農園一A', 0, '必', 2, 5, 3, 'HO 306'),
(47, '農園系', '李家興', 1004, '生活服務教育', '開', '四農園一A', 0, '必', 2, 5, 4, 'HO 306'),
(48, '農園系', '鍾宇翡', 1023, '國文(閱讀與寫作)(1)', '開', '四農園一A', 2, '必', 2, 2, 3, 'HO 305'),
(49, '農園系', '鍾宇翡', 1023, '國文(閱讀與寫作)(1)', '開', '四農園一A', 2, '必', 2, 2, 4, 'HO 305'),
(50, '農園系', '曹詠勝', 1333, '大一體育(1)', '開', '四農園一A', 1, '必', 2, 2, 5, '體育館'),
(51, '農園系', '曹詠勝', 1333, '大一體育(1)', '開', '四農園一A', 1, '必', 2, 2, 6, '體育館'),
(52, '農園系', '林志忠', 5020, '普通化學(1)', '開', '四農園一A', 3, '必', 3, 1, 1, 'AR 115'),
(53, '農園系', '林志忠', 5020, '普通化學(1)', '開', '四農園一A', 3, '必', 3, 1, 2, 'AR 115'),
(54, '農園系', '林志忠', 5020, '普通化學(1)', '開', '四農園一A', 3, '必', 3, 1, 5, 'AR 115');

-- --------------------------------------------------------

--
-- 資料表結構 `guestbook`
--

CREATE TABLE `guestbook` (
  `mId` int(10) NOT NULL COMMENT '留言id',
  `aId` int(10) NOT NULL COMMENT '留言人帳號id',
  `cId` int(10) NOT NULL COMMENT '課程id',
  `name` varchar(50) NOT NULL COMMENT '留言者姓名/暱稱',
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
  `email` varchar(50) NOT NULL COMMENT '電子郵件',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名/暱稱',
  `student_id` varchar(10) DEFAULT NULL COMMENT '學號',
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
  ADD PRIMARY KEY (`aId`,`username`,`password`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cId`) USING BTREE;

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
  ADD PRIMARY KEY (`sId`,`aId`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `aId` (`aId`) USING BTREE;

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
  MODIFY `aId` int(10) NOT NULL AUTO_INCREMENT COMMENT '帳號id', AUTO_INCREMENT=58;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course`
--
ALTER TABLE `course`
  MODIFY `cId` int(10) NOT NULL AUTO_INCREMENT COMMENT '課程id', AUTO_INCREMENT=55;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `mId` int(10) NOT NULL AUTO_INCREMENT COMMENT '留言id';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `student`
--
ALTER TABLE `student`
  MODIFY `sId` int(10) NOT NULL AUTO_INCREMENT COMMENT '學生id', AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`aId`) REFERENCES `account` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`email`) REFERENCES `account` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

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
