-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2021 at 10:19 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_projects`
--

CREATE TABLE `assigned_projects` (
  `id` int NOT NULL,
  `department` int NOT NULL,
  `project` int NOT NULL,
  `employee` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assigned_projects`
--

INSERT INTO `assigned_projects` (`id`, `department`, `project`, `employee`, `created_at`) VALUES
(1, 1, 1, 7, '2021-09-16 16:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `attendences`
--

CREATE TABLE `attendences` (
  `id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inTime` varchar(50) DEFAULT NULL,
  `outTime` varchar(50) DEFAULT NULL,
  `empId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendences`
--

INSERT INTO `attendences` (`id`, `date`, `inTime`, `outTime`, `empId`) VALUES
(1, '2021-09-16 16:21:31', '21:51', NULL, 7),
(2, '2021-09-16 16:21:31', '21:51', NULL, 7),
(3, '2021-09-16 16:21:31', '21:51', NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `da`
--

CREATE TABLE `da` (
  `id` int NOT NULL,
  `da_from` double NOT NULL,
  `da_to` double NOT NULL,
  `perc` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `da`
--

INSERT INTO `da` (`id`, `da_from`, `da_to`, `perc`, `created_at`) VALUES
(1, 5000, 50000, 80, '2021-09-13 09:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `created_at`) VALUES
(1, 'Accounts', '2021-08-13 11:00:46'),
(3, 'Administrativ', '2021-09-02 10:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `mother_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `doj` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `basicPay` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `father_name`, `mother_name`, `email`, `phone`, `gender`, `dob`, `doj`, `department`, `address`, `basicPay`, `created_at`) VALUES
(7, 'Mr John Doe', 'mr x', 'Mr y', 'example@email.com', '8822677188', 'male', '2021-09-16', '2021-09-16', '3', 'Vill - Kacharua, P.O - Puthimari, P.S - Kamalpur', 12000, '2021-09-16 15:57:20'),
(8, 'Mr Bob', 'Mr y', 'MRs Z', 'thanos@titan.com', '9876543210', 'male', '2021-09-16', '2021-09-16', '3', 'Vill - Kacharua, P.O - Puthimari, P.S - Kamalpur', 8000, '2021-09-16 15:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `hra`
--

CREATE TABLE `hra` (
  `id` int NOT NULL,
  `hra_perc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hra`
--

INSERT INTO `hra` (`id`, `hra_perc`) VALUES
(1, '7');

-- --------------------------------------------------------

--
-- Table structure for table `pf`
--

CREATE TABLE `pf` (
  `id` int NOT NULL,
  `pf_perc` double NOT NULL,
  `max_val` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pf`
--

INSERT INTO `pf` (`id`, `pf_perc`, `max_val`, `created_at`) VALUES
(2, 10, 1800, '2021-02-24 10:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `project_name` varchar(150) NOT NULL,
  `department` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `department`, `status`, `created_at`) VALUES
(1, 'Acounts related demo project', 1, 0, '2021-09-02 10:43:46'),
(2, 'Admin demo project', 3, 0, '2021-09-02 11:57:50'),
(5, 'example project Accounts', 1, 0, '2021-09-13 10:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `ptax`
--

CREATE TABLE `ptax` (
  `id` int NOT NULL,
  `gross_from` double NOT NULL,
  `gross_to` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ptax`
--

INSERT INTO `ptax` (`id`, `gross_from`, `gross_to`, `amount`, `created_at`) VALUES
(1, 20000, 40000, 150, '2021-09-13 09:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `salaryHistory`
--

CREATE TABLE `salaryHistory` (
  `id` int NOT NULL,
  `emp_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `month` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `year` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `salary_full_days` int DEFAULT NULL,
  `basicpay` double DEFAULT NULL,
  `da` double DEFAULT NULL,
  `ma` double DEFAULT NULL,
  `ca` double DEFAULT NULL,
  `hra` double DEFAULT NULL,
  `total_payable` double DEFAULT NULL,
  `gross_payable` double DEFAULT NULL,
  `pf` double DEFAULT NULL,
  `esi` double DEFAULT NULL,
  `ptax` double DEFAULT NULL,
  `lic` double DEFAULT NULL,
  `canteen` double DEFAULT NULL,
  `tds` double DEFAULT NULL,
  `net_payable` double DEFAULT NULL,
  `fullname` varchar(150) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salaryHistory`
--

INSERT INTO `salaryHistory` (`id`, `emp_id`, `month`, `year`, `salary_full_days`, `basicpay`, `da`, `ma`, `ca`, `hra`, `total_payable`, `gross_payable`, `pf`, `esi`, `ptax`, `lic`, `canteen`, `tds`, `net_payable`, `fullname`, `category`, `created_at`) VALUES
(1, NULL, 'none', '2021', 30, 8000, 6400, 150, 60, 560, 15170, 15170, 1440, 114, 180, 0, 0, 0, 13436, 'Mr Bob', NULL, '2021-09-18 16:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role`, `password`, `created_at`) VALUES
(1, 'John doe', 'admin', 'admin', '$2y$10$YJjQMwYLBWkEPgJu0xS8quNHFU5uCmBkFJsvsX5cF4U2gp1SsmNGe', '2021-08-09 20:30:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_projects`
--
ALTER TABLE `assigned_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendences`
--
ALTER TABLE `attendences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `da`
--
ALTER TABLE `da`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hra`
--
ALTER TABLE `hra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pf`
--
ALTER TABLE `pf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ptax`
--
ALTER TABLE `ptax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaryHistory`
--
ALTER TABLE `salaryHistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_projects`
--
ALTER TABLE `assigned_projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendences`
--
ALTER TABLE `attendences`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `da`
--
ALTER TABLE `da`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hra`
--
ALTER TABLE `hra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pf`
--
ALTER TABLE `pf`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ptax`
--
ALTER TABLE `ptax`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salaryHistory`
--
ALTER TABLE `salaryHistory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
