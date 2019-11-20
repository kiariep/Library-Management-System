-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2017 at 04:43 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `libsystem`
--
CREATE DATABASE `libsystem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `libsystem`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pwd`, `firstName`, `lastName`, `mobile`, `email`, `pic`) VALUES
(1, 'admin1234', '12345', 'jatin', 'sharma', '8750311282', 'jatin.soft1@gmail.com', 'IMG_1490389195384.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `bookId` int(4) NOT NULL,
  `title` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `available` tinyint(4) NOT NULL,
  PRIMARY KEY (`bookId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookId`, `title`, `author`, `price`, `publisher`, `available`) VALUES
(1001, 'c programming', 'yashwant kanetkar', 250, 'krishna', 1),
(1002, 'english', 'jai mehra', 400, 'krishna', 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE IF NOT EXISTS `borrow` (
  `bookId` int(4) NOT NULL,
  `issueId` int(3) NOT NULL,
  `issueDate` datetime NOT NULL,
  `returnBookId` int(4) NOT NULL,
  `returnId` int(3) NOT NULL,
  `returnDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`bookId`, `issueId`, `issueDate`, `returnBookId`, `returnId`, `returnDate`) VALUES
(1002, 1, '2017-06-19 07:00:08', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(3) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `position` varchar(10) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `firstName`, `lastName`, `username`, `pwd`, `position`, `mobile`, `email`, `pic`) VALUES
(1, 'hitesh', 'kumar', 'hitesh1234', '1234', 'Student', '8468907402', 'hitesh.kumarkaushik789@gmail.com', 'IMG_20170401_174753.jpg'),
(2, 'dipesh', 'sharma', 'dipesh1234', '123456', 'Student', '9560989439', 'dipesh.noida@gmail.com', 'C360_2017-01-03-13-09-47-223.jpg'),
(3, 'vivek', 'krishna', 'vivek123', '12345', 'Faculty', '9891813716', 'vivek.krishna01@gmail.com', 'IMG_20160810_093650 1.jpg'),
(4, 'jai', 'mehra', 'jaimehra', '1234', 'Student', '8468907402', 'jai12.noida@gmail.com', ''),
(5, 'abhishek', 'kashyap', 'abhi123', '1234', 'Student', '8826036670', 'abhishek.kashyap12@gmail.com', 'IMG_3181.JPG'),
(6, 'shashikant', 'sharma', 'shashikant1', '12345', 'Student', '9560989439', 'shashi12@gmail.com', 'IMG_20170505_110136.jpg'),
(7, 'himanshu', 'mavi', 'mavi123', '1234', 'Student', '8468907402', 'himanshu.mavi123@gmail.com', 'C360_2017-04-01-11-28-35-724.jpg'),
(8, 'manoj', 'gupta', 'manoj123', '12345', 'Faculty', '9878987898', 'manoj.kumargupta12@gmail.com', ''),
(9, 'aishwarya', 'sharma', 'aishwarya', '12345', 'Faculty', '8745324652', 'aishwarya.sharma12@gmail.com', ''),
(10, 'afzal', 'faridi', 'afzal123', '12345', 'Student', '9834965393', 'strangerjoker12@gmail.com', 'IMG_20160301_132501.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `requestforbooks`
--

CREATE TABLE IF NOT EXISTS `requestforbooks` (
  `requestId` int(3) NOT NULL,
  `bookName` text NOT NULL,
  `authorName` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `requestDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestforbooks`
--

