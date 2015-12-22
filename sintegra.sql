-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Dez-2015 às 18:47
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sintegra`
--
CREATE DATABASE IF NOT EXISTS `sintegra` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sintegra`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_auth`
--

DROP TABLE IF EXISTS `tbl_auth`;
CREATE TABLE IF NOT EXISTS `tbl_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `accesskey` text NOT NULL,
  `criacao` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_empresa`
--

DROP TABLE IF EXISTS `tbl_empresa`;
CREATE TABLE IF NOT EXISTS `tbl_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` text NOT NULL,
  `ie` text NOT NULL,
  `razao` text NOT NULL,
  `logradouro` text NOT NULL,
  `numero` text NOT NULL,
  `complemento` text NOT NULL,
  `bairro` text NOT NULL,
  `municipio` text NOT NULL,
  `estado` text NOT NULL,
  `cep` text NOT NULL,
  `telefone` text NOT NULL,
  `atividade` text NOT NULL,
  `inicio` date NOT NULL,
  `situacao` text NOT NULL,
  `data_situacao` date NOT NULL,
  `regime` text NOT NULL,
  `nfe` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
