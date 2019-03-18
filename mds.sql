-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 02:10 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mds`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `attendance_date` int(11) NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance_date`
--

CREATE TABLE `tblattendance_date` (
  `id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_type` int(11) NOT NULL,
  `is_close` int(11) NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance_type`
--

CREATE TABLE `tblattendance_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblattendance_type`
--

INSERT INTO `tblattendance_type` (`id`, `type`) VALUES
(1, 'Morning Shift'),
(2, 'Night Shift');

-- --------------------------------------------------------

--
-- Table structure for table `tblbox_type`
--

CREATE TABLE `tblbox_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `encoded_by` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbox_type`
--

INSERT INTO `tblbox_type` (`id`, `type`, `encoded_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(6, 'box1', '0000-00-00 00:00:00', '2019-02-23 19:34:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mp_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `is_assigned` tinyint(1) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `is_present` tinyint(4) NOT NULL,
  `job_stat` varchar(50) NOT NULL,
  `reason` text NOT NULL,
  `employment_status` varchar(50) NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`id`, `emp_id`, `fname`, `mname`, `lname`, `mp_id`, `status`, `is_assigned`, `request_no`, `is_present`, `job_stat`, `reason`, `employment_status`, `encoded_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(26, '2125870', 'Juan', '', 'Labajo', 7, 'Active', 0, '', 0, '', 'not feeling well', 'Regular', 'timekeeper', '2018-12-21 14:02:22', 'superadmin', '2019-02-26 21:08:51'),
(27, '2125680', 'Juan', '', 'Dela Cruz', 7, 'Active', 0, '', 0, '', 'none', 'Casual', 'timekeeper', '2018-12-21 14:03:25', 'superadmin', '2019-02-26 21:08:57'),
(28, '2120986', 'Victor', '', 'Magtanggol', 7, 'Active', 0, '', 0, '', 'none', 'Regular', 'timekeeper', '2018-12-21 14:04:13', 'superadmin', '2019-02-26 21:08:58'),
(29, '2110534', 'Lucifer', '', 'Morningstar', 67, 'Active', 0, '', 0, '', 'none', 'Casual', 'timekeeper', '2018-12-30 18:14:56', 'superadmin', '2019-02-26 21:09:31'),
(30, '2110423', 'Chloe', '', 'Decker', 67, 'Active', 0, '', 0, '', 'n', 'Regular', 'timekeeper', '2018-12-31 09:04:08', 'superadmin', '2019-02-26 21:09:12'),
(31, '9707689', 'LeBrom', 'Raymone', 'James', 67, 'Active', 0, '', 0, '', 'not feeling well', 'Regular', 'timekeeper', '2019-02-02 15:20:53', 'superadmin', '2019-02-26 21:09:27'),
(33, '523526', 'sample', 'sample', 'sample', 69, 'Active', 0, '', 0, '', 'none', 'Casual', 'superadmin', '2019-02-12 01:34:32', 'timekeeper', '0000-00-00 00:00:00'),
(34, '303030', 'foreman', 'foreman', 'foreman', 74, 'Active', 0, '', 0, '', '', 'Regular', 'superadmin', '2019-02-26 10:25:20', 'superadmin', '2019-02-26 21:09:06'),
(37, '101010', 'supervisor', 'supervisor', 'supervisor', 73, 'Active', 0, '', 0, '', '', 'Regular', 'timekeeper', '2019-02-26 10:41:04', 'superadmin', '2019-02-26 21:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblequipment`
--

CREATE TABLE `tblequipment` (
  `id` int(11) NOT NULL,
  `eqpt_code` varchar(100) NOT NULL,
  `eqpt_name` varchar(100) NOT NULL,
  `eqpt_type` int(11) NOT NULL,
  `mp_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblequipment`
--

INSERT INTO `tblequipment` (`id`, `eqpt_code`, `eqpt_name`, `eqpt_type`, `mp_id`, `status`, `reason`, `encoded_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, 'Forklift-1', 'Forklift-1', 2, 67, 'Dispatched', '', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-26 17:22:07'),
(4, 'RTG-1', 'RTG-1', 5, 69, 'Active', '', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-26 18:10:32'),
(5, 'QC1', 'QC1', 4, 70, 'Active', '', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-26 17:23:09'),
(6, 'QC2', 'QC2', 4, 70, 'Active', '', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-26 17:23:15'),
(8, 'Forklift-2', 'Forklift-2', 2, 67, 'Active', '', 'superadmin', '2019-02-26 19:51:59', 'superadmin', '2019-02-26 20:47:28'),
(9, 'Forklift-3', 'Forklift-3', 2, 67, 'Active', '', 'superadmin', '2019-02-26 20:34:22', 'superadmin', '2019-02-26 20:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblequipment_needed`
--

CREATE TABLE `tblequipment_needed` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `eqpt_type` int(11) NOT NULL,
  `no_eqpt` int(11) NOT NULL,
  `no_optr` int(11) NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblequipment_timestamp`
--

CREATE TABLE `tblequipment_timestamp` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `eq_code` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `work_started` varchar(100) NOT NULL,
  `work_stopped` varchar(100) NOT NULL,
  `work_paused` varchar(100) NOT NULL,
  `work_resumed` varchar(100) NOT NULL,
  `work_completed` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `encoded_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblequipment_type`
--

CREATE TABLE `tblequipment_type` (
  `id` int(11) NOT NULL,
  `eqpt_type` varchar(100) NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblequipment_type`
--

INSERT INTO `tblequipment_type` (`id`, `eqpt_type`, `encoded_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 'Forklift', 'superadmin', '2019-02-26 17:57:45', '', '0000-00-00 00:00:00'),
(4, 'QC', 'superadmin', '2019-02-26 17:58:43', '', '0000-00-00 00:00:00'),
(5, 'RTG', 'superadmin', '2019-02-26 17:58:48', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblequipreq`
--

CREATE TABLE `tblequipreq` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `eq_code` varchar(100) NOT NULL,
  `no_eqpt` int(11) NOT NULL,
  `no_optr` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `encoded_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblgivenequipment_req`
--

CREATE TABLE `tblgivenequipment_req` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `eqpt_id` int(11) NOT NULL,
  `optr_id` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reason` text NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblgivenmanpower_req`
--

CREATE TABLE `tblgivenmanpower_req` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `mp_code` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reason` text NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbljobcargocarrier`
--

CREATE TABLE `tbljobcargocarrier` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `vessel` varchar(100) NOT NULL,
  `voyage` varchar(100) NOT NULL,
  `van_no` varchar(100) NOT NULL,
  `truck_no` varchar(100) NOT NULL,
  `hatch_no` varchar(100) NOT NULL,
  `deck_no` varchar(100) NOT NULL,
  `trk_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbljobcargocommodities`
--

CREATE TABLE `tbljobcargocommodities` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `shipper` varchar(100) NOT NULL,
  `commodity` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `box` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `encoded_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbljobcode`
--

CREATE TABLE `tbljobcode` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljobcode`
--

INSERT INTO `tbljobcode` (`id`, `code`, `description`, `location`) VALUES
(1, '100', 'Arrastre - Bananas/Pineapple', 'Ground'),
(2, '101', 'Canvas Removal', 'Ground'),
(3, '102', 'Segregation - Banana/Pineapple', 'Ground'),
(4, '103', 'Palletizing - Bananas/Pineapple', 'Ground'),
(5, '104', 'Reducing Palletized Bananas', 'Ground'),
(6, '105', 'Stuffing - Non-palletized - Bananas', 'Ground'),
(7, '106', 'Repacking - Bananas', 'Ground'),
(8, '111', 'Adding and Bindering (LFC)', 'Ground'),
(9, '112', 'Added Boxes (DM)', 'Ground'),
(10, '113', 'Bindering Loose Boxes', 'Ground'),
(11, '114', 'Reducing One High', 'Ground'),
(12, '115', 'Palletizing Crates', 'Ground'),
(13, '116', 'Repiling DM packaging materials', 'Ground'),
(14, '120', 'Arrastre - Local Products', 'Ground'),
(15, '130', 'Ground Checker/Tagging', 'Ground'),
(16, '131', 'QC Assistance', 'Ground'),
(17, '132', 'QC Sampling', 'Ground'),
(18, '133', 'Re-palletize Boxes from QC Sampling', 'Ground'),
(19, '134', 'Replacing Stickers', 'Ground'),
(20, '140', 'Housekeeping/General Maintenance', 'Ground'),
(21, '141', 'Disposal of Garbage/Rejected Cargoes', 'Ground'),
(22, '171', 'FL Operator - Hustling', 'Ground'),
(23, '172', 'FL Operator - Strippling', 'Ground'),
(24, '173', 'FL Operator - Stuffing', 'Ground'),
(25, '174', 'FL Operator - Loading to Truck', 'Ground'),
(26, '175', 'FL Operator - Unloading From Truck', 'Ground'),
(27, '190', 'Idle time of men', 'Ground'),
(28, '191', 'Waiting time of men', 'Ground'),
(29, '192', 'Other Arrastre Works', 'Ground'),
(30, '200', 'Stevedoring - Bananas/Pines', 'Vessel'),
(31, '201', 'Discharging', 'Vessel'),
(32, '202', 'Slingmen', 'Vessel'),
(33, '203', 'Shoring plitz - Bananas/Pines', 'Vessel'),
(34, '220', 'Stevedoring', 'Vessel'),
(35, '230', 'On Board Checker/Hatch Checker', 'Vessel'),
(36, '231', 'Hatch Mapping', 'Vessel'),
(37, '271', 'FL Operator (On Board)', 'Vessel'),
(38, '272', 'Un/Loading to Vessel (Winch Operator)', 'Vessel'),
(39, '290', 'Idle time of men', 'Vessel'),
(40, '291', 'Waiting time of men', 'Vessel'),
(41, '292', 'Other Vessel works', 'Vessel'),
(42, '300', 'Plug-In Monitoring', 'Cold Storage'),
(43, '330', 'Tag Checking', 'Cold Storage'),
(44, '331', 'Cargoes Mapping', 'Cold Storage'),
(45, '371', 'FL (Elect) Operator - Bananas/Pines', 'Cold Storage'),
(46, '390', 'Idle Time of men', 'Cold Storage'),
(47, '391', 'Waiting time of men', 'Cold Storage'),
(48, '392', 'Other Cold Storage works', 'Cold Storage'),
(49, '471', 'Forklift Operation (Rentals)', 'Various Charges'),
(50, '472', 'Rough Terrane Crane Operation', 'Various Charges');

-- --------------------------------------------------------

--
-- Table structure for table `tbljoboptractivity_timestamp`
--

CREATE TABLE `tbljoboptractivity_timestamp` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `work_started` varchar(100) NOT NULL,
  `work_paused` varchar(100) NOT NULL,
  `work_stopped` varchar(100) NOT NULL,
  `work_resumed` varchar(100) NOT NULL,
  `work_completed` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `encoded_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbljoborderrequest`
--

CREATE TABLE `tbljoborderrequest` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `requestor` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `requestdate` date NOT NULL,
  `jobcode` varchar(100) NOT NULL,
  `jobdescription` varchar(200) NOT NULL,
  `jobdate` date NOT NULL,
  `joblocation` varchar(100) NOT NULL,
  `est` varchar(100) NOT NULL,
  `status` enum('cancelled','queued','completed','working','closed','activated','stopped','resumed') NOT NULL,
  `foreman_id` varchar(100) NOT NULL,
  `foreman_name` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `is_removed` tinyint(4) NOT NULL,
  `accomplishment` text NOT NULL,
  `removed_by` varchar(50) NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbljobperactivity_timestamp`
--

CREATE TABLE `tbljobperactivity_timestamp` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `work_started` varchar(100) NOT NULL,
  `work_paused` varchar(100) NOT NULL,
  `work_stopped` varchar(100) NOT NULL,
  `work_resumed` varchar(100) NOT NULL,
  `work_completed` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `encoded_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbljob_timestamp`
--

CREATE TABLE `tbljob_timestamp` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `work_started` varchar(100) NOT NULL,
  `work_stopped` varchar(100) NOT NULL,
  `work_resumed` varchar(100) NOT NULL,
  `work_completed` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `accomplishment` text NOT NULL,
  `encoded_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmanpower`
--

CREATE TABLE `tblmanpower` (
  `id` int(11) NOT NULL,
  `mp_name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `mp_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmanpower`
--

INSERT INTO `tblmanpower` (`id`, `mp_name`, `code`, `mp_code`) VALUES
(5, 'TDC QC REPACKERS', '', 'Personnel'),
(6, 'CHECKERS', 'CHK/TAG', 'Personnel'),
(7, 'ARRASTRE UTILITY', 'A/S', 'Personnel'),
(8, 'CANVAS REMOVERS', '', 'Personnel'),
(9, 'STOPPERS/BINDERS', '', 'Personnel'),
(10, 'SHOP HELPERS', '', 'Personnel'),
(11, 'CARGO MONITORING', '', 'Personnel'),
(12, 'SEGREGATOR J.O.', '', 'Personnel'),
(13, 'VAN STRIPPING ON-BOARD J.O.', 'STRP/STF', 'Personnel'),
(14, 'VAN STRIPPING(FILLERS)', 'STRP/STF', 'Personnel'),
(15, 'VAN STUFFING', 'STRP/STF', 'Personnel'),
(16, 'VAN STUFFING NENITA', 'STRP/STF', 'Personnel'),
(17, 'ADDED/PALLETIZER J.O ', '', 'Personnel'),
(18, 'METAL DETECTOR J.O', '', 'Personnel'),
(19, 'STEVEDORES ( BREAK BULK )', 'A/S', 'Personnel'),
(20, 'CARPENTERS', 'CARP', 'Personnel'),
(21, 'COLD STORAGE', 'CHK/TAG', 'Personnel'),
(22, 'COLD STORAGE TECH.', 'CHK/TAG', 'Personnel'),
(23, 'ENGINEERING', 'MECH', 'Personnel'),
(24, 'OFFICE UTILITY', 'UTIL', 'Personnel'),
(25, 'OFFICE & YARD UTILITY', 'UTIL', 'Personnel'),
(26, 'M & S UTILITY', 'UTIL', 'Personnel'),
(27, 'MECHANICAL MAINTENANCE', 'MECH', 'Personnel'),
(28, 'TOS PRE-CHECK CLERKS', 'CHK/TAG', 'Personnel'),
(29, 'REFFER TECHNICIANS CY', 'TECHN', 'Personnel'),
(30, 'YARD GOAT DRIVER', '', 'Personnel'),
(31, 'REACHSTACKER/ECH OPERATOR', 'FLOPTR', 'Personnel'),
(32, 'EMPTY CONTAINER DEPOT', '', 'Personnel'),
(33, 'DICT STEVEDORES', 'A/S', 'Personnel'),
(34, 'POWER HOUSE TECH.', 'ELEC', 'Personnel'),
(35, 'SUMMER JOB', 'SUMM', 'Personnel'),
(67, 'FORKLIFT OPERATORS', 'FLOPTR', 'Operator'),
(68, 'SHORE CRANE OPERATOR', 'FLOPTR', 'Operator'),
(69, 'R.T.G OPERATOR', 'FLOPTR', 'Operator'),
(70, 'S.T.S OPERATOR', 'FLOPTR', 'Operator'),
(73, 'Supervisor', 'supervisor', 'supervisor'),
(74, 'Foreman', 'foreman', 'foreman');

-- --------------------------------------------------------

--
-- Table structure for table `tblmanpowerreq`
--

CREATE TABLE `tblmanpowerreq` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `mp_code` varchar(100) NOT NULL,
  `nos` varchar(50) NOT NULL,
  `encoded_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblnotify`
--

CREATE TABLE `tblnotify` (
  `id` int(11) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `to_user_role` int(11) NOT NULL,
  `to_username` varchar(100) NOT NULL,
  `message_title` varchar(200) NOT NULL,
  `message_content` text NOT NULL,
  `from_username` varchar(50) NOT NULL,
  `from_name` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `is_replied` tinyint(4) NOT NULL,
  `response` text NOT NULL,
  `is_response_seen` tinyint(4) NOT NULL,
  `date_sent` datetime NOT NULL,
  `date_response` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbloperator_activity`
--

CREATE TABLE `tbloperator_activity` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `temp_designation` varchar(200) NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpersonnel_activity`
--

CREATE TABLE `tblpersonnel_activity` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `request_no` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `temp_designation` varchar(200) NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblrole`
--

CREATE TABLE `tblrole` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrole`
--

INSERT INTO `tblrole` (`id`, `role`) VALUES
(1, 'supervisor'),
(2, 'foreman'),
(3, 'timekeeper'),
(4, 'joclerk'),
(5, 'superadmin'),
(6, 'client'),
(7, 'jochecker');

-- --------------------------------------------------------

--
-- Table structure for table `tbltempreqno`
--

CREATE TABLE `tbltempreqno` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltruck_type`
--

CREATE TABLE `tbltruck_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltruck_type`
--

INSERT INTO `tbltruck_type` (`id`, `name`, `code`) VALUES
(1, 'Wing Van', 'Wing Van'),
(2, 'Open Trailer', 'Open Trailer');

-- --------------------------------------------------------

--
-- Table structure for table `tblunits`
--

CREATE TABLE `tblunits` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblunits`
--

INSERT INTO `tblunits` (`id`, `type`) VALUES
(1, 'Units'),
(2, 'Pallets'),
(3, 'Boxes'),
(4, 'Crates');

-- --------------------------------------------------------

--
-- Table structure for table `tbluserlogs`
--

CREATE TABLE `tbluserlogs` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluserlogs`
--

INSERT INTO `tbluserlogs` (`id`, `type`, `username`, `role`, `date`) VALUES
(1, 'Login', 'superadmin', 5, '2019-02-26 21:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `ufname` varchar(100) NOT NULL,
  `umname` varchar(100) NOT NULL,
  `ulname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `original_pass` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `account_stat` enum('Active','Inactive','','') NOT NULL,
  `encoded_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `user_id`, `ufname`, `umname`, `ulname`, `username`, `password`, `original_pass`, `role`, `account_stat`, `encoded_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, '404040', 'timekeeper', 'timekeeper', 'timekeeper', 'timekeeper', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 3, 'Active', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-15 12:36:03'),
(5, '000000', 'superadmin', 'superadmin', 'superadmin', 'superadmin', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 5, 'Active', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-15 12:36:22'),
(6, '202020', 'kinard', 'masayon', 'orbita', 'kmorbita', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 2, 'Active', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-15 12:35:28'),
(7, '303030', 'foreman', 'foreman', 'foreman', 'foreman', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 2, 'Inactive', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-26 21:09:06'),
(8, '505050', 'joclerk', 'joclerk', 'joclerk', 'joclerk', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 4, 'Active', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-15 12:36:13'),
(9, '101010', 'supervisor', 'supervisor', 'supervisor', 'supervisor', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 1, 'Inactive', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-26 21:09:03'),
(11, '', 'Maeve', '', 'Wiley', 'mwiley', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 6, 'Active', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(12, '', 'Otis', '', 'Willburn', 'owillburn', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 6, 'Active', '', '0000-00-00 00:00:00', 'superadmin', '2019-01-19 14:33:43'),
(13, '', 'Emma', '', 'Mackey', 'emackey', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 6, 'Active', '', '0000-00-00 00:00:00', 'superadmin', '2019-02-12 15:37:01'),
(16, '606060', 'jochecker', 'jochecker', 'jochecker', 'jochecker', '1619d7adc23f4f633f11014d2f22b7d8', 'password', 7, 'Active', 'superadmin', '2019-01-29 16:29:27', 'superadmin', '2019-02-15 12:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `tblweight_per_box`
--

CREATE TABLE `tblweight_per_box` (
  `id` int(11) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `encoded_by` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblweight_per_box`
--

INSERT INTO `tblweight_per_box` (`id`, `weight`, `encoded_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '100kg', '0000-00-00 00:00:00', '2019-02-23 19:27:00', '0000-00-00 00:00:00', '2019-02-23 19:31:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblattendance_date`
--
ALTER TABLE `tblattendance_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblattendance_type`
--
ALTER TABLE `tblattendance_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbox_type`
--
ALTER TABLE `tblbox_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblequipment`
--
ALTER TABLE `tblequipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblequipment_needed`
--
ALTER TABLE `tblequipment_needed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblequipment_timestamp`
--
ALTER TABLE `tblequipment_timestamp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblequipment_type`
--
ALTER TABLE `tblequipment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblequipreq`
--
ALTER TABLE `tblequipreq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgivenequipment_req`
--
ALTER TABLE `tblgivenequipment_req`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgivenmanpower_req`
--
ALTER TABLE `tblgivenmanpower_req`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljobcargocarrier`
--
ALTER TABLE `tbljobcargocarrier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljobcargocommodities`
--
ALTER TABLE `tbljobcargocommodities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljobcode`
--
ALTER TABLE `tbljobcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljoboptractivity_timestamp`
--
ALTER TABLE `tbljoboptractivity_timestamp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljoborderrequest`
--
ALTER TABLE `tbljoborderrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljobperactivity_timestamp`
--
ALTER TABLE `tbljobperactivity_timestamp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljob_timestamp`
--
ALTER TABLE `tbljob_timestamp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmanpower`
--
ALTER TABLE `tblmanpower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmanpowerreq`
--
ALTER TABLE `tblmanpowerreq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnotify`
--
ALTER TABLE `tblnotify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbloperator_activity`
--
ALTER TABLE `tbloperator_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpersonnel_activity`
--
ALTER TABLE `tblpersonnel_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrole`
--
ALTER TABLE `tblrole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltempreqno`
--
ALTER TABLE `tbltempreqno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltruck_type`
--
ALTER TABLE `tbltruck_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblunits`
--
ALTER TABLE `tblunits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluserlogs`
--
ALTER TABLE `tbluserlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblweight_per_box`
--
ALTER TABLE `tblweight_per_box`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblattendance_date`
--
ALTER TABLE `tblattendance_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblattendance_type`
--
ALTER TABLE `tblattendance_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblbox_type`
--
ALTER TABLE `tblbox_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblequipment`
--
ALTER TABLE `tblequipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblequipment_needed`
--
ALTER TABLE `tblequipment_needed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblequipment_timestamp`
--
ALTER TABLE `tblequipment_timestamp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblequipment_type`
--
ALTER TABLE `tblequipment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblequipreq`
--
ALTER TABLE `tblequipreq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblgivenequipment_req`
--
ALTER TABLE `tblgivenequipment_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblgivenmanpower_req`
--
ALTER TABLE `tblgivenmanpower_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbljobcargocarrier`
--
ALTER TABLE `tbljobcargocarrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbljobcargocommodities`
--
ALTER TABLE `tbljobcargocommodities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbljobcode`
--
ALTER TABLE `tbljobcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbljoboptractivity_timestamp`
--
ALTER TABLE `tbljoboptractivity_timestamp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbljoborderrequest`
--
ALTER TABLE `tbljoborderrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbljobperactivity_timestamp`
--
ALTER TABLE `tbljobperactivity_timestamp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbljob_timestamp`
--
ALTER TABLE `tbljob_timestamp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmanpower`
--
ALTER TABLE `tblmanpower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tblmanpowerreq`
--
ALTER TABLE `tblmanpowerreq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblnotify`
--
ALTER TABLE `tblnotify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbloperator_activity`
--
ALTER TABLE `tbloperator_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpersonnel_activity`
--
ALTER TABLE `tblpersonnel_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblrole`
--
ALTER TABLE `tblrole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbltempreqno`
--
ALTER TABLE `tbltempreqno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbltruck_type`
--
ALTER TABLE `tbltruck_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblunits`
--
ALTER TABLE `tblunits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluserlogs`
--
ALTER TABLE `tbluserlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblweight_per_box`
--
ALTER TABLE `tblweight_per_box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
