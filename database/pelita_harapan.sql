-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 02:43 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelita_harapan`
--

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`email`, `password`, `role`) VALUES
('admin@gmail.com', 'admin123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_kota` varchar(150) NOT NULL,
  `nama_kota` varchar(225) NOT NULL,
  `ongkir` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_kota`, `nama_kota`, `ongkir`) VALUES
('K002', 'Cirebon', 10000),
('K003', 'Bandung', 11000),
('K004', 'Padalarang', 11000),
('K005', 'Depok', 15000),
('K006', 'Indramayu', 17000),
('K007', 'Bandar Lampung', 18000),
('K008', 'Ciamis', 18000),
('K009', 'Garut', 18000),
('K010', 'Bantul', 20000),
('K011', 'Semarang', 20000),
('K012', 'Jatinangor', 20000),
('K013', 'Madiun', 21000),
('K014', 'Bangkalan', 22000),
('K015', 'Banjarnegara', 22000),
('K016', 'Kebumen', 22000),
('K017', 'Malang', 22000),
('K018', 'Gresik', 23000),
('K019', 'Jombang', 23000),
('K020', 'Nganjuk', 24000),
('K021', 'Lamongan', 25000),
('K022', 'Denpasar', 27000),
('K023', 'Jambi', 27000),
('K024', 'Batam', 32000),
('K025', 'Balikpapan', 35000),
('K026', 'Lahat', 36000),
('K027', 'Lubuk Linggau', 38000),
('K028', 'Bima', 40000),
('K029', 'Bengkulu', 41000),
('K030', 'Banda Aceh', 42000),
('K031', 'Dumai', 42000),
('K032', 'Salatiga', 49000),
('K033', 'Dompu', 54000),
('K034', 'Enrekang', 55000),
('K035', 'Kuala Kapuas', 55000),
('K036', 'Gorontalo', 57000),
('K037', 'Banjarmasin', 58000),
('K038', 'Samarinda', 61000),
('K039', 'Airmadidi', 63000),
('K040', 'Kotamobagu', 63000),
('K041', 'Ambon (Baguala)', 66000),
('K042', 'Kolaka', 66000),
('K043', 'Atambua', 77000),
('K044', 'Ende', 78000),
('K045', 'Labuan Bajo', 81000),
('K046', 'Fak Fak', 121000),
('K047', 'Manokwari', 122000),
('K048', 'Jayapura', 138000),
('K049', 'Merauke', 138000),
('K050', 'Nabire', 139000),
('﻿K001', 'Cilegon', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_kota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
