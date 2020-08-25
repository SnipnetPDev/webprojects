-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2018 at 05:09 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `usr_id` varchar(500) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `other_name` varchar(500) NOT NULL,
  `street_address` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  `zip_code` varchar(500) NOT NULL,
  `title` varchar(500) NOT NULL,
  `marital_status` varchar(500) NOT NULL,
  `dob` varchar(500) NOT NULL,
  `employment_status` varchar(500) NOT NULL,
  `occupation` varchar(500) NOT NULL,
  `Job_title` varchar(500) NOT NULL,
  `employer` varchar(500) NOT NULL,
  `employer_years` varchar(500) NOT NULL,
  `employer_business_address` varchar(500) NOT NULL,
  `employer_apt_suite` varchar(500) NOT NULL,
  `employer_city` varchar(500) NOT NULL,
  `employer_state` varchar(500) NOT NULL,
  `employer_zip_code` varchar(500) NOT NULL,
  `employer_country` varchar(500) NOT NULL,
  `next_of_kin` varchar(500) NOT NULL,
  `next_of_address` varchar(500) NOT NULL,
  `next_of_phone` varchar(500) NOT NULL,
  `next_of_email` varchar(500) NOT NULL,
  `next_of_date_of_birth` varchar(500) NOT NULL,
  `next_of_relationship_status` varchar(500) NOT NULL,
  `citizenship` varchar(500) NOT NULL,
  `us_id_type` varchar(500) NOT NULL,
  `us_id_no` varchar(500) NOT NULL,
  `country_tax_res` varchar(500) NOT NULL,
  `ssn` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `account_no` varchar(500) NOT NULL,
  `account_status` varchar(500) NOT NULL,
  `a_status_color` varchar(50) NOT NULL,
  `account_opening_date` varchar(500) NOT NULL,
  `account_balance` varchar(500) NOT NULL,
  `account_type` varchar(500) NOT NULL,
  `account_signature` varchar(500) NOT NULL,
  `account_pin` varchar(500) NOT NULL,
  `funding_mode` varchar(500) NOT NULL,
  `account_sqa1` varchar(500) NOT NULL,
  `account_sqa1a` varchar(500) NOT NULL,
  `account_sqa2` varchar(500) NOT NULL,
  `account_sqa2a` varchar(500) NOT NULL,
  `account_cur` varchar(500) NOT NULL,
  `ipn` varchar(100) NOT NULL,
  `cot` varchar(100) NOT NULL,
  `imf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `trn_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `trn_date`) VALUES
(0, 'admin', 'admin@localhost', '0192023a7bbd73250516f069df18b500', '2018-01-03 18:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `u_login_id` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `expiry` varchar(50) NOT NULL,
  `cvc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(500) NOT NULL,
  `c_sign` varchar(500) NOT NULL,
  `c_abbv` varchar(500) NOT NULL,
  `c_exc_rate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`c_id`, `c_name`, `c_sign`, `c_abbv`, `c_exc_rate`) VALUES
(2, 'Dollar', '&dollar;', 'USD', ''),
(4, 'Pound', '&pound;', 'GBP', ''),
(5, 'Euro', '&euro;', 'EUR', ''),
(6, 'Yen', '&yen;', 'YEN', '');

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE `license` (
  `id` int(11) NOT NULL,
  `soft_name` varchar(200) NOT NULL,
  `soft_version` varchar(200) NOT NULL,
  `license_id` varchar(200) NOT NULL,
  `release_date` varchar(100) NOT NULL,
  `support_email` varchar(100) NOT NULL,
  `upgrade_link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `license`
--

INSERT INTO `license` (`id`, `soft_name`, `soft_version`, `license_id`, `release_date`, `support_email`, `upgrade_link`) VALUES
(1, 'Stock Bank', '11.2.013', 'UTBCNi1MMko5LUwxSjAtRDFCNy1EMkYwLUExTzg=', 'January 03, 2018', 'contact@snipnetworks.com', 'https://www.snipnetworks.com');

-- --------------------------------------------------------

--
-- Table structure for table `payee`
--

CREATE TABLE `payee` (
  `payee_id` int(11) NOT NULL,
  `payee_name` varchar(500) NOT NULL,
  `payee_bank` varchar(500) NOT NULL,
  `payee_acc_no` varchar(500) NOT NULL,
  `payee_sort` varchar(500) NOT NULL,
  `user_bond` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int(11) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `publishedby` varchar(200) NOT NULL,
  `p_link` varchar(200) NOT NULL,
  `p_ins_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `routing_no` varchar(200) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `b_url` varchar(500) NOT NULL,
  `mailer_id` varchar(500) NOT NULL,
  `mailer_host` varchar(100) NOT NULL,
  `mailer_port` varchar(4) NOT NULL,
  `mailer_pass` varchar(100) NOT NULL,
  `copyright` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `address`, `short_name`, `routing_no`, `phone`, `email`, `b_url`, `mailer_id`, `mailer_host`, `mailer_port`, `mailer_pass`, `copyright`) VALUES
(1, 'Stock Bank Lite', 'Address line here', 'STB', '37295483943', '000-000-0000', 'root@localhost', 'http://localhost/stock-bank/', 'admin', 'mail.localhost.com', '22', 'admin123', 'Copyright 2018 STB');

-- --------------------------------------------------------

--
-- Table structure for table `trans_history`
--

CREATE TABLE `trans_history` (
  `tr_id` int(11) NOT NULL,
  `tr_user` varchar(500) NOT NULL,
  `tr_account` varchar(500) NOT NULL,
  `tr_date` varchar(500) NOT NULL,
  `tr_desc` varchar(500) NOT NULL,
  `tr_credit` varchar(500) NOT NULL,
  `tr_debit` varchar(500) NOT NULL,
  `tr_end_bal` varchar(500) NOT NULL,
  `tr_payee` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `imgname` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `loginid` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  `id_front` varchar(100) NOT NULL,
  `id_back` varchar(100) NOT NULL,
  `alock` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usr_id` (`usr_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payee`
--
ALTER TABLE `payee`
  ADD PRIMARY KEY (`payee_id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_history`
--
ALTER TABLE `trans_history`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `license`
--
ALTER TABLE `license`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payee`
--
ALTER TABLE `payee`
  MODIFY `payee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trans_history`
--
ALTER TABLE `trans_history`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
