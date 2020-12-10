-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Dez-2020 às 15:08
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_betfair`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `competicoes`
--

CREATE TABLE `competicoes` (
  `id` varchar(255) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `regiao` varchar(6) NOT NULL,
  `market_count` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `competicoes`
--

INSERT INTO `competicoes` (`id`, `nome`, `regiao`, `market_count`, `data_cadastro`) VALUES
('321319', 'Brasil - Série B', 'BRA', 10, '2020-12-10 14:56:57'),
('12148223', 'Brasil - Sub20', 'BRA', 8, '2020-12-10 14:56:57'),
('12009917', 'Brasil - Feminino', 'BRA', 2, '2020-12-10 14:56:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` varchar(255) NOT NULL,
  `nome_evento` varchar(512) NOT NULL,
  `pais_evento` varchar(6) NOT NULL,
  `timezone_evento` varchar(24) NOT NULL,
  `data_evento` varchar(50) NOT NULL,
  `market_count_evento` int(11) NOT NULL,
  `data_cadastro_evento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome_evento`, `pais_evento`, `timezone_evento`, `data_evento`, `market_count_evento`, `data_cadastro_evento`) VALUES
('30177740', 'Corinthians (F) x Palmeiras (F)', 'BR', 'GMT', '2020-12-10T19:00:00.000Z', 2, '2020-12-10 14:56:58'),
('30178924', 'Corinthians Sub20 x Taubate U20', 'BR', 'GMT', '2020-12-11T18:00:00.000Z', 2, '2020-12-10 14:56:58'),
('30178701', 'Audax U20 v Comercial FC U20', 'BR', 'GMT', '2020-12-11T18:00:00.000Z', 2, '2020-12-10 14:56:58'),
('30178702', 'Sao Bernardo U20 x Palmeiras Sub20', 'BR', 'GMT', '2020-12-11T18:00:00.000Z', 2, '2020-12-10 14:56:58'),
('30178009', 'Ponte Preta x Avaí', 'BR', 'GMT', '2020-12-11T22:15:00.000Z', 2, '2020-12-10 14:56:58'),
('30177994', 'EC Vitoria Salvador x Cruzeiro MG', 'BR', 'GMT', '2020-12-12T00:30:00.000Z', 2, '2020-12-10 14:56:58'),
('30178805', 'Ferroviaria DE U20 x Santos Sub20', 'BR', 'GMT', '2020-12-11T18:00:00.000Z', 2, '2020-12-10 14:56:58'),
('30177990', 'CSA x Oeste', 'BR', 'GMT', '2020-12-11T22:15:00.000Z', 2, '2020-12-10 14:56:58'),
('30177991', 'Nautico PE v Brasil de Pelotas', 'BR', 'GMT', '2020-12-11T00:30:00.000Z', 2, '2020-12-10 14:56:58'),
('30178007', 'Operario PR x Sampaio Correa FC', 'BR', 'GMT', '2020-12-11T19:00:00.000Z', 2, '2020-12-10 14:56:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mercado`
--

CREATE TABLE `mercado` (
  `mercado_id` varchar(11) NOT NULL,
  `competicao_id` varchar(8) NOT NULL,
  `evento_id` varchar(8) NOT NULL,
  `evento_nome` varchar(512) NOT NULL,
  `codigo_pais` varchar(3) NOT NULL,
  `timezone` varchar(3) NOT NULL,
  `evento_data` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mercado`
--

INSERT INTO `mercado` (`mercado_id`, `competicao_id`, `evento_id`, `evento_nome`, `codigo_pais`, `timezone`, `evento_data`) VALUES
('1.176673670', '12009917', '30177740', 'Corinthians (F) x Palmeiras (F)', 'BR', 'GMT', '10/12/2020 20:00:00'),
('1.176669149', '321319', '30177991', 'Nautico PE v Brasil de Pelotas', 'BR', 'GMT', '11/12/2020 01:30:00'),
('1.176685749', '12148223', '30178805', 'Ferroviaria DE U20 x Santos Sub20', 'BR', 'GMT', '11/12/2020 19:00:00'),
('1.176685919', '12148223', '30178701', 'Audax U20 v Comercial FC U20', 'BR', 'GMT', '11/12/2020 19:00:00'),
('1.176685834', '12148223', '30178702', 'Sao Bernardo U20 x Palmeiras Sub20', 'BR', 'GMT', '11/12/2020 19:00:00'),
('1.176685662', '12148223', '30178924', 'Corinthians Sub20 x Taubate U20', 'BR', 'GMT', '11/12/2020 19:00:00'),
('1.176668923', '321319', '30178007', 'Operario PR x Sampaio Correa FC', 'BR', 'GMT', '11/12/2020 20:00:00'),
('1.176669256', '321319', '30177990', 'CSA x Oeste', 'BR', 'GMT', '11/12/2020 23:15:00'),
('1.176668816', '321319', '30178009', 'Ponte Preta x Avaí', 'BR', 'GMT', '11/12/2020 23:15:00'),
('1.176669040', '321319', '30177994', 'EC Vitoria Salvador v Cruzeiro MG', 'BR', 'GMT', '12/12/2020 01:30:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
