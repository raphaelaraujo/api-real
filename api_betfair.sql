-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Dez-2020 às 16:20
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
('321319', 'Brasil - Série B', 'BRA', 241, '2020-12-07 12:58:12'),
('12148223', 'Brasil - Sub20', 'BRA', 38, '2020-12-07 12:58:12'),
('13', 'Brasil - Serie A', 'BRA', 65, '2020-12-07 12:58:12'),
('12181991', 'Brasil - Catarinense ', 'BRA', 95, '2020-12-07 12:58:12'),
('7980087', 'Brasil - Série D', 'BRA', 19, '2020-12-07 12:58:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` varchar(255) NOT NULL,
  `id_competicao` varchar(255) NOT NULL,
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

INSERT INTO `eventos` (`id`, `id_competicao`, `nome_evento`, `pais_evento`, `timezone_evento`, `data_evento`, `market_count_evento`, `data_cadastro_evento`) VALUES
('30171548', '321319', 'Avaí x Chapecoense', 'BR', 'GMT', '2020-12-09T00:30:00.000Z', 2, '2020-12-07 15:12:27'),
('30171549', '321319', 'CRB x Cruzeiro MG', 'BR', 'GMT', '2020-12-09T00:30:00.000Z', 2, '2020-12-07 15:12:27'),
('30171550', '321319', 'Cuiaba x EC Vitoria Salvador', 'BR', 'GMT', '2020-12-09T00:30:00.000Z', 2, '2020-12-07 15:12:27'),
('30171547', '321319', 'Confianca x CSA', 'BR', 'GMT', '2020-12-09T00:30:00.000Z', 2, '2020-12-07 15:12:27'),
('30171524', '321319', 'Botafogo SP x Ponte Preta', 'BR', 'GMT', '2020-12-08T22:15:00.000Z', 2, '2020-12-07 15:12:27'),
('30171525', '321319', 'Guaraní x Operario PR', 'BR', 'GMT', '2020-12-08T19:30:00.000Z', 2, '2020-12-07 15:12:27'),
('30171526', '321319', 'Juventude x Oeste', 'BR', 'GMT', '2020-12-08T19:00:00.000Z', 2, '2020-12-07 15:12:27'),
('30171523', '321319', 'América-MG x Sampaio Correa FC', 'BR', 'GMT', '2020-12-08T22:15:00.000Z', 2, '2020-12-07 15:12:27'),
('30171228', '12148223', 'Atlético-MG Sub20 x Fluminense Sub20', 'BR', 'GMT', '2020-12-07T18:45:00.000Z', 2, '2020-12-07 15:12:27'),
('30171224', '12148223', 'Chapecoense Sub20 x Atlético Paranaense Sub20', 'BR', 'GMT', '2020-12-07T18:30:00.000Z', 2, '2020-12-07 15:12:27'),
('30171562', '13', 'São Paulo x Botafogo', 'BR', 'GMT', '2020-12-10T00:30:00.000Z', 2, '2020-12-07 15:12:28'),
('30167328', '13', 'Atlético-GO x Goiás', 'BR', 'GMT', '2020-12-07T23:00:00.000Z', 2, '2020-12-07 15:12:28'),
('30171160', '12181991', 'Metropolitano SC v Barra FC Porto Alegre', 'BR', 'GMT', '2020-12-07T18:00:00.000Z', 2, '2020-12-07 15:12:29'),
('30171161', '12181991', 'Esporte Clube Prospera v Camboriu', 'BR', 'GMT', '2020-12-07T18:00:00.000Z', 2, '2020-12-07 15:12:29'),
('30171162', '12181991', 'Cacador AC x Hercilio Luz', 'BR', 'GMT', '2020-12-07T18:00:00.000Z', 2, '2020-12-07 15:12:29'),
('30171179', '12181991', 'Guarani de Palhoca v Internacional de Lages SC', 'BR', 'GMT', '2020-12-07T18:00:00.000Z', 2, '2020-12-07 15:12:29'),
('30171206', '12181991', 'Fluminense de Joinville v Navegantes Esporte Clube', 'BR', 'GMT', '2020-12-07T18:00:00.000Z', 2, '2020-12-07 15:12:29'),
('30171262', '7980087', 'Rio Branco-Acre x Altos', 'BR', 'GMT', '2020-12-07T21:00:00.000Z', 2, '2020-12-07 15:12:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mercado`
--

CREATE TABLE `mercado` (
  `id` varchar(11) NOT NULL,
  `id_competicao_mercado` varchar(40) NOT NULL,
  `id_evento_mercado` varchar(40) NOT NULL,
  `mandante_mercado` float NOT NULL,
  `visitante_mercado` float NOT NULL,
  `empate_mercado` float NOT NULL,
  `data_cadastro_mercado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
