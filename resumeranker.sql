-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2014 at 11:11 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resumeranker`
--

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE IF NOT EXISTS `certification` (
  `CERTI_NAME` char(200) NOT NULL,
  `VALUE` int(11) NOT NULL DEFAULT '5',
  PRIMARY KEY (`CERTI_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`CERTI_NAME`, `VALUE`) VALUES
('CISSP', 10),
('DBA++', 9),
('ETHICAL HACKING 3.0', 3),
('IBM SQL2', 7),
('MICROSOFT MSACCESS++', 6),
('NETSECURE 2.0', 8),
('SCOAA+', 7);

-- --------------------------------------------------------

--
-- Stand-in structure for view `certi_rating`
--
CREATE TABLE IF NOT EXISTS `certi_rating` (
`SID` int(4)
,`ORG_ID` int(10)
,`RATING` decimal(42,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE IF NOT EXISTS `contest` (
  `CON_NAME` char(200) NOT NULL,
  `CON_TYPE` char(200) NOT NULL,
  `NO_OF_PARTICIPANTS` int(11) DEFAULT NULL,
  `START_DATE` date DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `DIFFICULTY_LEVEL` char(30) DEFAULT NULL,
  PRIMARY KEY (`CON_NAME`,`CON_TYPE`),
  UNIQUE KEY `CON_NAME` (`CON_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`CON_NAME`, `CON_TYPE`, `NO_OF_PARTICIPANTS`, `START_DATE`, `END_DATE`, `DIFFICULTY_LEVEL`) VALUES
('ACM ICPC', 'Programming', 100000, '2014-05-02', '2014-05-22', '10'),
('Code Jam', 'Programming', 100000, '2014-04-02', '2014-04-21', '10'),
('Long Challenge', 'Programming', 10000, '0000-00-00', '0000-00-00', '5'),
('NCAT', 'Aptitude', 1000000, '2013-04-02', '2013-04-21', '10');

-- --------------------------------------------------------

--
-- Table structure for table `contest_organisation`
--

CREATE TABLE IF NOT EXISTS `contest_organisation` (
  `CON_NAME` char(200) NOT NULL,
  `CON_TYPE` char(40) NOT NULL,
  `ORG_ID` int(11) NOT NULL,
  `VALUE` int(11) NOT NULL,
  PRIMARY KEY (`ORG_ID`,`CON_NAME`,`CON_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest_organisation`
--

INSERT INTO `contest_organisation` (`CON_NAME`, `CON_TYPE`, `ORG_ID`, `VALUE`) VALUES
('Long Challenge', 'Programming', 1, 5),
('codejam', 'Programming', 2, 8),
('NCAT', 'Aptitude', 3, 7),
('ACM ICPC', 'Programming', 7, 9);

-- --------------------------------------------------------

--
-- Stand-in structure for view `contest_rating`
--
CREATE TABLE IF NOT EXISTS `contest_rating` (
`sid` int(4)
,`org_id` int(10)
,`rating` bigint(31)
);
-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_NAME` char(100) NOT NULL,
  `DURATION` char(20) NOT NULL,
  `DNAME` char(40) DEFAULT NULL,
  PRIMARY KEY (`COURSE_ID`),
  UNIQUE KEY `COURSE_ID` (`COURSE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`COURSE_ID`, `COURSE_NAME`, `DURATION`, `DNAME`) VALUES
(1, 'Fundamentals of database systems', '6', 'CSE'),
(2, 'Algorithm Design', '6', 'CSE'),
(3, 'Introduction to Algorithm', '6', 'CSE'),
(4, 'Advanced Algorithms', '6', 'CSE'),
(5, 'Advanced Database Design', '6', 'CSE'),
(6, 'Advanced GUI Design', '6', 'CSE'),
(7, 'Advanced Compiler Design', '6', 'CSE'),
(8, 'Basic Fabrication Concepts', '6', 'ME'),
(9, 'Basic Automotive Manufacturing', '6', 'ME'),
(10, 'Basic Electronic Circuits', '6', 'ECE'),
(11, 'Basic Fourier Transform', '6', 'ECE');

-- --------------------------------------------------------

--
-- Stand-in structure for view `course1_rating`
--
CREATE TABLE IF NOT EXISTS `course1_rating` (
`sid` int(4)
,`org_id` int(10)
,`course1_rating` double
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `course2_rating`
--
CREATE TABLE IF NOT EXISTS `course2_rating` (
`sid` int(4)
,`org_id` int(10)
,`course2_rating` double
);
-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE IF NOT EXISTS `discipline` (
  `DNAME` char(40) NOT NULL,
  `HOD` char(30) DEFAULT NULL,
  PRIMARY KEY (`DNAME`),
  UNIQUE KEY `DNAME` (`DNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`DNAME`, `HOD`) VALUES
('CSE', 'PK'),
('ECE', 'KD'),
('ME', 'VKG');

-- --------------------------------------------------------

--
-- Stand-in structure for view `disc_stud`
--
CREATE TABLE IF NOT EXISTS `disc_stud` (
`SID` int(4)
,`DNAME` char(40)
,`RATING` double(19,2)
);
-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE IF NOT EXISTS `interests` (
  `SID` int(11) NOT NULL,
  `INTEREST` char(200) NOT NULL,
  PRIMARY KEY (`SID`,`INTEREST`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`SID`, `INTEREST`) VALUES
(10, 'programiin'),
(10, 'programming'),
(10, 'progrma'),
(11, 'progr'),
(11, 'Programming'),
(2012063, 'chess'),
(2012063, 'heropanti'),
(2012063, 'watching movies'),
(2012127, 'boating'),
(2012127, 'meditation'),
(2012127, 'playing piano'),
(2012127, 'sketching');

-- --------------------------------------------------------

--
-- Stand-in structure for view `leaderboard`
--
CREATE TABLE IF NOT EXISTS `leaderboard` (
`sid` int(11)
,`r_rating` double
);
-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE IF NOT EXISTS `organisation` (
  `ORG_ID` int(11) NOT NULL,
  `ORG_NAME` text,
  `HR_CONTACT` int(10) DEFAULT NULL,
  `ESTD_YEAR` year(4) DEFAULT NULL,
  `REPO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`ORG_ID`, `ORG_NAME`, `HR_CONTACT`, `ESTD_YEAR`, `REPO`) VALUES
(1, 'acm', 923456789, 1999, 3),
(2, 'codechef', 823456781, 1993, 6),
(3, 'topcoder', 999456781, 1991, 8),
(4, 'google', 955456781, 2005, 2),
(5, 'facebook', 911111111, 1988, 10),
(6, 'yahoo', 911911919, 1999, 10),
(7, 'amazon', 2147483647, 1901, 10),
(8, 'oracle', 2147483647, 2004, 5),
(9, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL),
(11, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `org_rating`
--
CREATE TABLE IF NOT EXISTS `org_rating` (
`sid` int(11)
,`org_id` int(11)
,`o_rating` double
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `overall_rating`
--
CREATE TABLE IF NOT EXISTS `overall_rating` (
`sid` int(11)
,`org_id` int(11)
,`rating` double
);
-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `PTITLE` char(200) NOT NULL,
  `PTYPE` char(30) NOT NULL,
  `STATUS` char(30) NOT NULL,
  `LINK` char(200) DEFAULT NULL,
  `SUPERVISOR_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PTITLE`,`PTYPE`),
  UNIQUE KEY `PTITLE` (`PTITLE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`PTITLE`, `PTYPE`, `STATUS`, `LINK`, `SUPERVISOR_ID`) VALUES
('abcd', 'Individual', 'Ongoing', NULL, NULL),
('Cow Simulation', 'academic', 'ongoing', 'web.iiitdmj.ac.in/rr.html', 2),
('Cross Entropy Minimization', 'academic', 'completed', 'web.iiitdmj.ac.in/cc.html', 1),
('database', 'Academic', 'Completed', NULL, NULL),
('Dog Walk Simulation', 'academic', 'ongoing', 'web.iiitdmj.ac.in/rr.html', 2),
('Memrister', 'academic', 'ongoing', 'web.iiitdmj.ac.in/cc.html', 3),
('Resister Heatup analysis', 'academic', 'ongoing', 'web.iiitdmj.ac.in/rh.html', 3),
('Resume Ranking', 'academic', 'ongoing', 'web.iiitdmj.ac.in/rr.html', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_organisation`
--

CREATE TABLE IF NOT EXISTS `project_organisation` (
  `PTITLE` char(200) NOT NULL,
  `PTYPE` char(30) NOT NULL,
  `ORG_ID` int(11) NOT NULL,
  PRIMARY KEY (`PTITLE`,`PTYPE`,`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_organisation`
--

INSERT INTO `project_organisation` (`PTITLE`, `PTYPE`, `ORG_ID`) VALUES
('Cow Simulation', 'academic', 8),
('Cross Entropy Minimization', 'academic', 8),
('Dog Walk Simulation', 'academic', 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `project_rating`
--
CREATE TABLE IF NOT EXISTS `project_rating` (
`sid` int(4)
,`org_id` int(10)
,`rating` bigint(31)
);
-- --------------------------------------------------------

--
-- Table structure for table `recruiter_login`
--

CREATE TABLE IF NOT EXISTS `recruiter_login` (
  `USERNAME` varchar(20) NOT NULL DEFAULT '',
  `PASSWORD` text,
  `EMAIL` varchar(30) NOT NULL DEFAULT '',
  `ORG_ID` int(11) NOT NULL,
  PRIMARY KEY (`ORG_ID`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  UNIQUE KEY `USERNAME` (`USERNAME`),
  UNIQUE KEY `ORG_ID` (`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruiter_login`
--

INSERT INTO `recruiter_login` (`USERNAME`, `PASSWORD`, `EMAIL`, `ORG_ID`) VALUES
('acm', '53bce4f1dfa0fe8e7ca126f91b35d3a6', 'acm@acm.com', 1),
('codechef', '3ee41d08ae049e7b77bea71bc83dd491', 'admin@codechef.com', 2),
('topcoder', '4b9198406cba02a14d7f4cbf2182715b', 'admin@topcoder.com', 3),
('google', 'c822c1b63853ed273b89687ac505f9fa', 'admin@google.com', 4),
('facebook', '26cae7718c32180a7a0f8e19d6d40a59', 'admin@fb.com', 5),
('yahoo', '241fe8af1e038118cd817048a65f803e', 'admin@yahoo.com', 6),
('amazon', '2d0d4809e6bdb6f4db3e547f27b1873c', 'admin@amazon.com', 7),
('oracle', 'a189c633d9995e11bf8607170ec9a4b8', 'admin@oracle.com', 8),
('xyz', 'd16fb36f0911f878998c136191af705e', 'xyz@xyz.com', 9),
('abcd', 'e2fc714c4727ee9395f324cd2e7f331f', 'abcd@gmail.com', 10),
('sysco', 'd28028306c5564e933c6dc45bf9dbfe0', 'sysco@sysco.com', 11);

-- --------------------------------------------------------

--
-- Table structure for table `rec_data`
--

CREATE TABLE IF NOT EXISTS `rec_data` (
  `ORG_ID` int(10) NOT NULL,
  `ORGNAME` char(200) NOT NULL,
  `DNAME` text NOT NULL,
  `XII_PERC_W` int(11) DEFAULT NULL,
  `CGPA_W` int(11) DEFAULT NULL,
  `WORKSHOPS` char(200) DEFAULT NULL,
  `WORKSHOP_WEIGHTAGE` int(11) DEFAULT NULL,
  `CONTESTS` char(200) DEFAULT NULL,
  `CONTEST_WEIGHTAGE` int(11) DEFAULT NULL,
  `CERTIFICATIONS` char(200) DEFAULT NULL,
  `CERTI_WEIGHTAGE` int(11) DEFAULT NULL,
  `COURSE1` char(200) DEFAULT NULL,
  `COURSE1_WEIGHTAGE` int(11) DEFAULT NULL,
  `COURSE2` char(200) DEFAULT NULL,
  `COURSE2_WEIGHTAGE` int(11) DEFAULT NULL,
  `PROJECTS` char(200) DEFAULT NULL,
  `PROJECT_WEIGHTAGE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ORG_ID`),
  KEY `COURSE2_WEIGHTAGE` (`COURSE2_WEIGHTAGE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec_data`
--

INSERT INTO `rec_data` (`ORG_ID`, `ORGNAME`, `DNAME`, `XII_PERC_W`, `CGPA_W`, `WORKSHOPS`, `WORKSHOP_WEIGHTAGE`, `CONTESTS`, `CONTEST_WEIGHTAGE`, `CERTIFICATIONS`, `CERTI_WEIGHTAGE`, `COURSE1`, `COURSE1_WEIGHTAGE`, `COURSE2`, `COURSE2_WEIGHTAGE`, `PROJECTS`, `PROJECT_WEIGHTAGE`) VALUES
(1, 'codechef', 'CSE', 4, 8, 'Ethical Hacking Workshop', 7, 'ACM ICPC', 9, 'CISSP', 6, 'Advanced Algorithms', 9, 'Basic Fourier Transform', 7, 'Cross Entropy Minimization', 7),
(2, 'codechef', 'CSE', 4, 8, 'Ethical Hacking Workshop', 7, 'codechef', 9, 'CISSP', 6, 'Advanced Algorithms', 9, 'Basic Fourier Transform', 7, 'Cross Entropy Minimization', 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `SID` int(4) NOT NULL AUTO_INCREMENT,
  `NAME` char(20) DEFAULT NULL,
  `XII_PERC` float(4,2) DEFAULT NULL,
  `ADDRESS` tinytext,
  `CGPA` float(2,1) DEFAULT NULL,
  `CONTACT` tinytext,
  `INSTITUTE` tinytext,
  `QUALI` tinytext,
  `DNAME` char(40) DEFAULT NULL,
  PRIMARY KEY (`SID`),
  UNIQUE KEY `SID` (`SID`),
  KEY `DNAME` (`DNAME`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2013019 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`SID`, `NAME`, `XII_PERC`, `ADDRESS`, `CGPA`, `CONTACT`, `INSTITUTE`, `QUALI`, `DNAME`) VALUES
(1012005, 'deep', 65.00, 'f114,nagaria', 9.9, '', 'IIITDMJ', 'MTECH', 'CSE'),
(1012006, 'deepika', 62.00, 'xx14,rialabad', 2.0, '', 'IIITDMJ', 'MTECH', 'ME'),
(2012001, 'amandeep', 91.00, 'e324,pakuja', 7.9, '', 'IIITDMJ', 'BTECH', 'CSE'),
(2012005, 'pamandeep', 65.00, 'f114,kujanagar', 9.9, '', 'IIITDMJ', 'BTECH', 'CSE'),
(2012063, 'qwe', 78.00, 'asdf', 8.0, '12345678', 'IIITDMJ', '10+2', 'CSE'),
(2012127, 'Lokendra Sharma', 69.00, 'E208,chittaurgarh', 7.6, '', 'IIITDMJ', 'BTECH', 'CSE'),
(2013006, 'paresh', 72.00, 'e114,kanpur', 7.0, '', 'IIITDMJ', 'BTECH', 'ME'),
(2013012, 'aresh', 82.00, 'g115,bihar', 5.0, '', 'IIITDMJ', 'BTECH', 'ECE'),
(2013016, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2013017, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2013018, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_certi`
--

CREATE TABLE IF NOT EXISTS `student_certi` (
  `CERTI_NAME` char(30) NOT NULL,
  `SID` int(11) NOT NULL,
  PRIMARY KEY (`CERTI_NAME`,`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_certi`
--

INSERT INTO `student_certi` (`CERTI_NAME`, `SID`) VALUES
('CISSP', 2012127),
('DBA++', 1012005),
('ETHICAL HACKING 3.0', 2012063),
('IBM SQL2', 2012063);

-- --------------------------------------------------------

--
-- Table structure for table `student_contest`
--

CREATE TABLE IF NOT EXISTS `student_contest` (
  `SID` int(11) NOT NULL,
  `CON_NAME` char(200) NOT NULL,
  `CON_TYPE` char(200) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date DEFAULT NULL,
  PRIMARY KEY (`SID`,`CON_NAME`,`CON_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_contest`
--

INSERT INTO `student_contest` (`SID`, `CON_NAME`, `CON_TYPE`, `START_DATE`, `END_DATE`) VALUES
(1, 'long challenge', 'programming', '2014-05-02', NULL),
(2012063, 'ACM ICPC', 'Programming', '2014-05-01', '2014-05-01'),
(2012063, 'Code Jam', 'Programming', '2014-05-01', '2014-05-01'),
(2012127, 'ACM ICPC', 'Programming', '2014-01-01', '2014-01-01'),
(2012127, 'Code Jam', 'Programming', '2014-05-01', '2014-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE IF NOT EXISTS `student_course` (
  `SID` int(11) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `GRADE` char(7) NOT NULL,
  PRIMARY KEY (`SID`,`COURSE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`SID`, `COURSE_ID`, `GRADE`) VALUES
(2012063, 5, '9'),
(2012063, 7, '8'),
(2012063, 11, '9'),
(2012127, 1, '9'),
(2012127, 2, '9'),
(2012127, 3, '10');

-- --------------------------------------------------------

--
-- Table structure for table `student_login`
--

CREATE TABLE IF NOT EXISTS `student_login` (
  `USERNAME` varchar(20) NOT NULL DEFAULT '',
  `PASSWORD` varchar(40) DEFAULT NULL,
  `EMAIL` varchar(40) NOT NULL DEFAULT '',
  `SID` int(4) NOT NULL,
  PRIMARY KEY (`SID`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  UNIQUE KEY `USERNAME` (`USERNAME`),
  UNIQUE KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_login`
--

INSERT INTO `student_login` (`USERNAME`, `PASSWORD`, `EMAIL`, `SID`) VALUES
('deep', '6627415e807ee33c7302917216e7da68', 'deep@gmail.com', 1012005),
('deepika', '3dcec89bbac898667700f0d73db88a90', 'deepika@gmail.com', 1012006),
('amandeep', '7fcefd57e1b4dd0aa950faffd1ef99a9', 'amandeep@gmail.com', 2012001),
('pamandeep', 'e165cfc222f4dc058dab8913a91ac3df', 'pamandeep@gmail.com', 2012005),
('chandan', 'b18f2dfcfc1c94c17e43419b7e8f788b', 'chandan@gmail.com', 2012063),
('lokendra', '1c3907d3027562601962233fe811d61a', 'lokendra@gmail.com', 2012127),
('paresh', '6c452c76957f2c36c9d4f8394e2a63a3', 'paresh@gmail.com', 2013006),
('aresh', 'd93d2a5b7f9f431493019fc071ec29e9', 'aresh@gmail.com', 2013012),
('rishabh', 'c64e8e7b05a6d831605cfe23dd617deb', 'rishabh@gmail.com', 2013013),
('xyz', 'd16fb36f0911f878998c136191af705e', 'xyz@gmail.com', 2013015),
('qwe', '76d80224611fc919a5d54f0ff9fba446', 'qwe@qwe.com', 2013016),
('das', '2a6571da26602a67be14ea8c5ab82349', 'das@gmail.com', 2013017),
('poiu', '6ca29d9bb530402bd09fe026ee838148', 'poiu@poiu', 2013018);

-- --------------------------------------------------------

--
-- Table structure for table `student_organisation`
--

CREATE TABLE IF NOT EXISTS `student_organisation` (
  `ORG_ID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `POSITION` char(30) NOT NULL,
  PRIMARY KEY (`SID`,`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_organisation`
--

INSERT INTO `student_organisation` (`ORG_ID`, `SID`, `POSITION`) VALUES
(5, 2012063, 'President'),
(6, 2012127, 'Programmer');

-- --------------------------------------------------------

--
-- Table structure for table `student_project`
--

CREATE TABLE IF NOT EXISTS `student_project` (
  `SID` int(11) NOT NULL,
  `PTITLE` char(200) NOT NULL,
  `PTYPE` char(30) NOT NULL,
  `START_DATE` date DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `ROLE` char(30) NOT NULL,
  PRIMARY KEY (`SID`,`PTITLE`,`PTYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_project`
--

INSERT INTO `student_project` (`SID`, `PTITLE`, `PTYPE`, `START_DATE`, `END_DATE`, `ROLE`) VALUES
(1012006, 'Cow Simulation', 'academic', '2014-05-08', '2014-05-23', 'leader'),
(2012063, 'Cross Entropy Minimization', 'academic', '2014-05-06', '2014-05-17', 'programmer'),
(2012063, 'database', 'Academic', '1998-04-04', NULL, 'Developer'),
(2012063, 'resume ranking', 'Academic', '2000-05-05', NULL, 'Developer'),
(2012127, 'Cross Entropy Minimization', 'academic', '2014-05-06', '2014-05-17', 'programmer'),
(2013006, 'Dog Walk Simulation', 'academic', '2014-05-06', '2014-05-17', 'leader');

-- --------------------------------------------------------

--
-- Table structure for table `student_workshop`
--

CREATE TABLE IF NOT EXISTS `student_workshop` (
  `SID` int(11) NOT NULL,
  `W_NAME` char(200) NOT NULL,
  `W_TYPE` char(40) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date DEFAULT NULL,
  PRIMARY KEY (`SID`,`W_NAME`,`W_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_workshop`
--

INSERT INTO `student_workshop` (`SID`, `W_NAME`, `W_TYPE`, `START_DATE`, `END_DATE`) VALUES
(1, 'Engineering Drawing Workshop', 'drawing', '2014-05-02', NULL),
(2012063, 'Ethical Hacking Workshop', 'hacking', '2014-06-08', '2014-06-22'),
(2012063, 'Ethical Hacking Workshop 2', 'hacking', '2014-06-08', '2014-06-22'),
(2012127, 'Ethical Hacking Workshop', 'hacking', '2014-05-08', '2014-05-22'),
(2012127, 'Ethical Hacking Workshop 2', 'hacking', '2014-06-08', '2014-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `stu_rating`
--

CREATE TABLE IF NOT EXISTS `stu_rating` (
  `ORG_ID` int(10) NOT NULL,
  `SID` int(10) NOT NULL,
  `SRATING` int(10) NOT NULL,
  PRIMARY KEY (`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stu_rating`
--

INSERT INTO `stu_rating` (`ORG_ID`, `SID`, `SRATING`) VALUES
(3, 2012063, 100);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE IF NOT EXISTS `supervisor` (
  `SUPERVISOR_ID` int(11) NOT NULL,
  `SUP_NAME` text NOT NULL,
  `SUP_ORG` char(200) NOT NULL,
  `SUP_DESIGNATION` char(30) DEFAULT NULL,
  PRIMARY KEY (`SUPERVISOR_ID`),
  UNIQUE KEY `SUPERVISOR_ID` (`SUPERVISOR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`SUPERVISOR_ID`, `SUP_NAME`, `SUP_ORG`, `SUP_DESIGNATION`) VALUES
(1, 'PK', 'IIITDMJ', 'HOD'),
(2, 'VKG', 'IIITDMJ', 'HOD'),
(3, 'PN', 'IIITDMJ', 'HOD');

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE IF NOT EXISTS `workshop` (
  `W_NAME` char(200) NOT NULL,
  `LEVEL` int(11) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `W_TYPE` char(200) NOT NULL,
  PRIMARY KEY (`W_NAME`,`W_TYPE`),
  UNIQUE KEY `W_NAME` (`W_NAME`),
  UNIQUE KEY `W_NAME_2` (`W_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`W_NAME`, `LEVEL`, `START_DATE`, `END_DATE`, `W_TYPE`) VALUES
('Engineering Drawing Workshop', 5, '0000-00-00', '0000-00-00', 'drawing'),
('Ethical Hacking Workshop', 10, '0000-00-00', '0000-00-00', 'hacking'),
('Ethical Hacking Workshop 2', 10, '0000-00-00', '0000-00-00', 'hacking');

-- --------------------------------------------------------

--
-- Stand-in structure for view `workshop_combo`
--
CREATE TABLE IF NOT EXISTS `workshop_combo` (
`W_NAME` char(200)
,`value` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `workshop_organisation`
--

CREATE TABLE IF NOT EXISTS `workshop_organisation` (
  `W_NAME` char(200) NOT NULL,
  `W_TYPE` char(40) NOT NULL,
  `ORG_ID` int(11) NOT NULL,
  `VALUE` int(11) NOT NULL,
  PRIMARY KEY (`W_NAME`,`W_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop_organisation`
--

INSERT INTO `workshop_organisation` (`W_NAME`, `W_TYPE`, `ORG_ID`, `VALUE`) VALUES
('Engineering Drawing Workshop', 'drawing', 1, 5),
('Ethical Hacking Workshop', 'hacking', 1, 6),
('Ethical Hacking Workshop 2', 'hacking', 2, 10);

-- --------------------------------------------------------

--
-- Stand-in structure for view `workshop_rating`
--
CREATE TABLE IF NOT EXISTS `workshop_rating` (
`SID` int(4)
,`ORG_ID` int(10)
,`rating` decimal(42,0)
);
-- --------------------------------------------------------

--
-- Structure for view `certi_rating`
--
DROP TABLE IF EXISTS `certi_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `certi_rating` AS select `student`.`SID` AS `SID`,`rec_data`.`ORG_ID` AS `ORG_ID`,(sum(`certification`.`VALUE`) * `rec_data`.`CERTI_WEIGHTAGE`) AS `RATING` from (((`student` join `rec_data`) join `student_certi`) join `certification`) where ((`rec_data`.`CERTIFICATIONS` like `student_certi`.`CERTI_NAME`) and (`student`.`DNAME` = `rec_data`.`DNAME`) and (`student`.`SID` = `student_certi`.`SID`) and (`certification`.`CERTI_NAME` = `student_certi`.`CERTI_NAME`)) group by `student`.`SID`,`rec_data`.`ORG_ID`;

-- --------------------------------------------------------

--
-- Structure for view `contest_rating`
--
DROP TABLE IF EXISTS `contest_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contest_rating` AS select `student`.`SID` AS `sid`,`rec_data`.`ORG_ID` AS `org_id`,(count(0) * `rec_data`.`CONTEST_WEIGHTAGE`) AS `rating` from ((`student` join `rec_data`) join `student_contest`) where ((`student`.`SID` = `student_contest`.`SID`) and (`rec_data`.`DNAME` = `student`.`DNAME`) and (`rec_data`.`CONTESTS` like `student_contest`.`CON_NAME`));

-- --------------------------------------------------------

--
-- Structure for view `course1_rating`
--
DROP TABLE IF EXISTS `course1_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `course1_rating` AS select `student`.`SID` AS `sid`,`rec_data`.`ORG_ID` AS `org_id`,((count(0) * `rec_data`.`COURSE1_WEIGHTAGE`) * `student_course`.`GRADE`) AS `course1_rating` from (((`course` join `rec_data`) join `student`) join `student_course`) where ((`student`.`SID` = `student_course`.`SID`) and (`course`.`COURSE_NAME` like `rec_data`.`COURSE1`) and (`rec_data`.`DNAME` = `student`.`DNAME`)) group by `student`.`SID`,`rec_data`.`ORG_ID`;

-- --------------------------------------------------------

--
-- Structure for view `course2_rating`
--
DROP TABLE IF EXISTS `course2_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `course2_rating` AS select `student`.`SID` AS `sid`,`rec_data`.`ORG_ID` AS `org_id`,((count(0) * `rec_data`.`COURSE1_WEIGHTAGE`) * `student_course`.`GRADE`) AS `course2_rating` from (((`course` join `rec_data`) join `student`) join `student_course`) where ((`student`.`SID` = `student_course`.`SID`) and (`course`.`COURSE_NAME` like `rec_data`.`COURSE2`) and (`rec_data`.`DNAME` = `student`.`DNAME`)) group by `student`.`SID`,`rec_data`.`ORG_ID`;

-- --------------------------------------------------------

--
-- Structure for view `disc_stud`
--
DROP TABLE IF EXISTS `disc_stud`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `disc_stud` AS select `student`.`SID` AS `SID`,`student`.`DNAME` AS `DNAME`,((`student`.`CGPA` * `rec_data`.`CGPA_W`) + (`student`.`XII_PERC` * `rec_data`.`XII_PERC_W`)) AS `RATING` from (`student` join `rec_data`) where (`student`.`DNAME` = `rec_data`.`DNAME`);

-- --------------------------------------------------------

--
-- Structure for view `leaderboard`
--
DROP TABLE IF EXISTS `leaderboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `leaderboard` AS select `org_rating`.`sid` AS `sid`,sum(`org_rating`.`o_rating`) AS `r_rating` from `org_rating` group by `org_rating`.`sid` order by sum(`org_rating`.`o_rating`) desc;

-- --------------------------------------------------------

--
-- Structure for view `org_rating`
--
DROP TABLE IF EXISTS `org_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `org_rating` AS select `overall_rating`.`sid` AS `sid`,`overall_rating`.`org_id` AS `org_id`,sum(`overall_rating`.`rating`) AS `o_rating` from `overall_rating` group by `overall_rating`.`sid`,`overall_rating`.`org_id` order by sum(`overall_rating`.`rating`) desc;

-- --------------------------------------------------------

--
-- Structure for view `overall_rating`
--
DROP TABLE IF EXISTS `overall_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `overall_rating` AS select `contest_rating`.`sid` AS `sid`,`contest_rating`.`org_id` AS `org_id`,`contest_rating`.`rating` AS `rating` from `contest_rating` union select `course1_rating`.`sid` AS `sid`,`course1_rating`.`org_id` AS `org_id`,`course1_rating`.`course1_rating` AS `course1_rating` from `course1_rating` union select `course2_rating`.`sid` AS `sid`,`course2_rating`.`org_id` AS `org_id`,`course2_rating`.`course2_rating` AS `course2_rating` from `course2_rating` union select `project_rating`.`sid` AS `sid`,`project_rating`.`org_id` AS `org_id`,`project_rating`.`rating` AS `rating` from `project_rating` union select `workshop_rating`.`SID` AS `SID`,`workshop_rating`.`ORG_ID` AS `ORG_ID`,`workshop_rating`.`rating` AS `rating` from `workshop_rating` union select `certi_rating`.`SID` AS `SID`,`certi_rating`.`ORG_ID` AS `ORG_ID`,`certi_rating`.`RATING` AS `RATING` from `certi_rating`;

-- --------------------------------------------------------

--
-- Structure for view `project_rating`
--
DROP TABLE IF EXISTS `project_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `project_rating` AS select `student`.`SID` AS `sid`,`rec_data`.`ORG_ID` AS `org_id`,(count(0) * `rec_data`.`PROJECT_WEIGHTAGE`) AS `rating` from ((`student` join `rec_data`) join `student_project`) where ((`student`.`SID` = `student_project`.`SID`) and (`rec_data`.`DNAME` = `student`.`DNAME`) and (`rec_data`.`PROJECTS` like `student_project`.`PTITLE`)) group by `student`.`SID`,`rec_data`.`ORG_ID`;

-- --------------------------------------------------------

--
-- Structure for view `workshop_combo`
--
DROP TABLE IF EXISTS `workshop_combo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `workshop_combo` AS select `workshop`.`W_NAME` AS `W_NAME`,`workshop_organisation`.`VALUE` AS `value` from (`workshop` join `workshop_organisation`) where (`workshop`.`W_NAME` = `workshop_organisation`.`W_NAME`);

-- --------------------------------------------------------

--
-- Structure for view `workshop_rating`
--
DROP TABLE IF EXISTS `workshop_rating`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `workshop_rating` AS select `student`.`SID` AS `SID`,`rec_data`.`ORG_ID` AS `ORG_ID`,(sum(`workshop_combo`.`value`) * `rec_data`.`WORKSHOP_WEIGHTAGE`) AS `rating` from (((`student` join `rec_data`) join `workshop_combo`) join `student_workshop`) where ((`student`.`DNAME` = `rec_data`.`DNAME`) and (`student`.`SID` = `student_workshop`.`SID`) and (`rec_data`.`WORKSHOPS` like `workshop_combo`.`W_NAME`) and (`workshop_combo`.`W_NAME` = `student_workshop`.`W_NAME`)) group by `student`.`SID`,`rec_data`.`ORG_ID`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `organisation`
--
ALTER TABLE `organisation`
  ADD CONSTRAINT `organisation_ibfk_2` FOREIGN KEY (`ORG_ID`) REFERENCES `recruiter_login` (`ORG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`DNAME`) REFERENCES `discipline` (`DNAME`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `student_login` (`SID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
