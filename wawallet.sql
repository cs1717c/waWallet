-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2014 at 08:31 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wawallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Euro', 'eur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Rupee', 'inr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'BitCoin', 'btc', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Japanese Yen', 'jpy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'US Dollar', 'usd', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'British Pound', 'gbp', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Rubles', 'rub', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `currency` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `currency` (`currency`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `name`, `currency`, `created_at`, `updated_at`) VALUES
(2, 'Test Euro Wallet', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transaction`
--

CREATE TABLE IF NOT EXISTS `wallet_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallet` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wallet` (`wallet`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wallet_transaction`
--

INSERT INTO `wallet_transaction` (`id`, `wallet`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, '22', '2014-10-22 14:00:00', '2014-10-22 14:00:00'),
(2, 2, '-2', '2014-10-23 11:00:00', '2014-10-23 11:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_ibfk_1` FOREIGN KEY (`currency`) REFERENCES `currency` (`id`);

--
-- Constraints for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  ADD CONSTRAINT `wallet_transaction_ibfk_1` FOREIGN KEY (`wallet`) REFERENCES `wallets` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
