-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 05, 2021 at 09:49 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `estimate`
--

DROP TABLE IF EXISTS `estimate`;
CREATE TABLE IF NOT EXISTS `estimate` (
  `Work_name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `Material_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Mass` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Mass_m` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Work` varchar(20) DEFAULT NULL,
  `Work_m` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estimate`
--

INSERT INTO `estimate` (`Work_name`, `Material_type`, `Mass`, `Mass_m`, `Work`, `Work_m`) VALUES
('G/b paviršių srautinis valymas, kai yra sena danga', NULL, NULL, NULL, '21.42', 'žm.val'),
(NULL, 'Kvarcinis smėlis', '68.85', 't', NULL, NULL),
('G/b paviršių plovimas vandeniu iki 500 bar. Slėgiu', NULL, NULL, NULL, '3.85', 'žm.val'),
('Betoninių paviršių drėkinimas vandeniu (prieš torkretavimą)', NULL, NULL, NULL, '134.12', 'žm.val.'),
('G/b paviršių glaistymas cementiniu R2 klasės glaistu iki 2 mm storio', NULL, NULL, NULL, '985.25', 'žm.val.'),
(NULL, 'Zentrifix FF06', '788.2', 'kg', NULL, NULL),
('Pažeistų vietų atstatymas remontiniu mišiniu iki 3 cm gylio rankiniu būdu', NULL, NULL, NULL, '10.5', 'žm.val.'),
(NULL, 'Nafufill KM124', '75.6', 'kg', NULL, NULL),
('Betoninių paviršių impregnavimas hidrofobizantu', NULL, NULL, NULL, '38467.8', 'žm. val.'),
(NULL, 'MC- Color Primer', '27477', 'l', NULL, NULL),
('Betoninių paviršių gruntavimas', NULL, NULL, NULL, '4.2', 'žm. val.'),
(NULL, 'Maxsheen primer', '2.52', 'l', NULL, NULL),
('Betoninių paviršių dažymas elastingais akriliniais dažais 2 sl.', NULL, NULL, NULL, '0.7', 'žm. val.'),
(NULL, 'MAXSHEEN ELASTIC', '0.9', 'l', NULL, NULL),
('Benoninių paviršių padengimas antigrafiti danga', NULL, NULL, NULL, '3.85', 'žm. val.'),
(NULL, 'WIEREGEN -ACU- Antigraffity', '5.5', 'l', NULL, NULL),
('G/b paviršių plovimas vandeniu iki 500 bar. Slėgiu', NULL, NULL, NULL, '0.42', 'žm.val'),
('Betoninių grindų gruntavimas epoksidiniu gruntu su kvarcinio smėlio pabarstu', NULL, NULL, NULL, '86.8', 'žm.val.'),
(NULL, 'MC-DUR 1320 VK', '95.263', 'kg', NULL, NULL),
('Epoksidinės dangos liejimas 5 mm storiu su kvarcinio smėlio pabarstu', NULL, NULL, NULL, '217', 'žm.val.'),
(NULL, 'MC-DUR 1352', '474.3', 'kg', NULL, NULL),
('Viršutinio sluoksnio (atsparus UV spinduliams)', NULL, NULL, NULL, '', 'žm.val.'),
(NULL, 'MC-DUR 1352', '2484.72', 'kg', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
