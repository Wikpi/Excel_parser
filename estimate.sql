-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2021 at 11:41 AM
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
  `Id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Work_name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `Material_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Mass` float DEFAULT NULL,
  `Mass_m` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Mass_price` float DEFAULT NULL,
  `Work` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Work_m` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Work_price` float DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estimate`
--

INSERT INTO `estimate` (`Id`, `Work_name`, `Material_type`, `Mass`, `Mass_m`, `Mass_price`, `Work`, `Work_m`, `Work_price`) VALUES
(1, 'G/b paviršių srautinis valymas, kai yra sena danga', 'Kvarcinis smėlis', 68.85, 't', 90, '21.42', 'žm.val', 7),
(2, 'G/b paviršių plovimas vandeniu iki 500 bar. Slėgiu', '', 0, '', 0, '3.85', 'žm.val', 7),
(3, 'Betoninių paviršių drėkinimas vandeniu (prieš torkretavimą)', '', 0, '', 0, '134.12', 'žm.val.', 7),
(4, 'G/b paviršių glaistymas cementiniu R2 klasės glaistu iki 2 mm storio', 'Zentrifix FF06', 788.2, 'kg', 0.35, '985.25', 'žm.val.', 7),
(5, 'Pažeistų vietų atstatymas remontiniu mišiniu iki 3 cm gylio rankiniu būdu', 'Nafufill KM124', 75.6, 'kg', 0.35, '10.5', 'žm.val.', 7),
(6, 'Betoninių paviršių impregnavimas hidrofobizantu', 'MC- Color Primer', 27477, 'l', 5, '38467.8', 'žm. val.', 7),
(7, 'Betoninių paviršių gruntavimas', 'Maxsheen primer', 2.52, 'l', 2.1, '4.2', 'žm. val.', 7),
(8, 'Betoninių paviršių dažymas elastingais akriliniais dažais 2 sl.', 'MAXSHEEN ELASTIC', 0.9, 'l', 3, '0.7', 'žm. val.', 7),
(9, 'Benoninių paviršių padengimas antigrafiti danga', 'WIEREGEN -ACU- Antigraffity', 5.5, 'l', 5, '3.85', 'žm. val.', 7),
(10, 'G/b paviršių plovimas vandeniu iki 500 bar. Slėgiu', '', 0, '', 0, '0.42', 'žm.val', 7),
(11, 'Betoninių grindų gruntavimas epoksidiniu gruntu su kvarcinio smėlio pabarstu', 'MC-DUR 1320 VK', 95.263, 'kg', 4.39, '86.8', 'žm.val.', 7),
(12, 'Epoksidinės dangos liejimas 5 mm storiu su kvarcinio smėlio pabarstu', 'MC-DUR 1352', 474.3, 'kg', 5.1, '217', 'žm.val.', 7),
(13, 'Viršutinio sluoksnio (atsparus UV spinduliams)', 'MC-DUR 1352', 2484.72, 'kg', 5.1, '', 'žm.val.', 7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
