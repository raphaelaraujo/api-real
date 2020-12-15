-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Dez-2020 às 03:48
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `api_betfair`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aposta`
--

CREATE TABLE `aposta` (
  `aposta_mercado_id` varchar(11) NOT NULL,
  `mandante_afavor` float NOT NULL,
  `visitante_afavor` float NOT NULL,
  `empate_afavor` float NOT NULL,
  `mandante_contra` float NOT NULL,
  `visitante_contra` float NOT NULL,
  `empate_contra` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aposta`
--

INSERT INTO `aposta` (`aposta_mercado_id`, `mandante_afavor`, `visitante_afavor`, `empate_afavor`, `mandante_contra`, `visitante_contra`, `empate_contra`) VALUES
('1.176833737', 1.19, 46, 6.6, 1.2, 65, 6.8),
('1.176848406', 2.24, 3.4, 3.2, 2.4, 3.9, 3.45),
('1.176848511', 2.5, 3, 3.15, 2.74, 3.35, 3.4),
('1.176848616', 1.85, 5.3, 3.4, 1.92, 5.8, 3.7),
('1.176848721', 3.85, 2.1, 3.2, 4.2, 2.28, 3.5),
('1.176848899', 2.14, 1.02, 2.92, 2.42, 5.3, 3.65),
('1.176849019', 2.34, 3.15, 3.1, 2.7, 3.9, 3.75),
('1.176849127', 1.49, 5.6, 3.35, 1.9, 9.2, 4.7),
('1.176856137', 15, 1.45, 3.65, 19, 1.48, 3.95);

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
('321319', 'Brasil - Série B', 'BRA', 16, '2020-12-15 01:32:37'),
('12148223', 'Brasil - Sub20', 'BRA', 8, '2020-12-15 01:32:37'),
('3172302', 'Brasil - Série C', 'BRA', 2, '2020-12-15 01:32:37');

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
('30184940', 'Operario PR x Ponte Preta', 'BR', 'GMT', '2020-12-14T23:00:00.000Z', 2, '2020-12-15 01:32:38'),
('30185583', 'EC Vitoria Salvador x Juventude', 'BR', 'GMT', '2020-12-16T00:30:00.000Z', 2, '2020-12-15 01:32:38'),
('30185193', 'Santa Cruz FC U20 v Jacyoba AC U20', 'BR', 'GMT', '2020-12-14T23:00:00.000Z', 2, '2020-12-15 01:32:38'),
('30185130', 'Vila Nova x Ituano', 'BR', 'GMT', '2020-12-14T23:04:15.000Z', 2, '2020-12-15 01:32:38'),
('30185600', 'Guaraní x Confianca', 'BR', 'GMT', '2020-12-16T22:15:00.000Z', 2, '2020-12-15 01:32:38'),
('30186913', 'Bahia EC U20 v ABC U20', 'BR', 'GMT', '2020-12-15T18:00:00.000Z', 2, '2020-12-15 01:32:38'),
('30186914', 'CSA U20 v Fluminense EC Piaui U20', 'BR', 'GMT', '2020-12-15T23:00:00.000Z', 2, '2020-12-15 01:32:38'),
('30185570', 'Cruzeiro MG x CSA', 'BR', 'GMT', '2020-12-16T00:30:00.000Z', 2, '2020-12-15 01:32:38'),
('30185596', 'Chapecoense x Nautico PE', 'BR', 'GMT', '2020-12-16T22:15:00.000Z', 2, '2020-12-15 01:32:38'),
('30185597', 'Brasil de Pelotas x Botafogo SP', 'BR', 'GMT', '2020-12-16T19:30:00.000Z', 2, '2020-12-15 01:32:38'),
('30185567', 'Oeste x Cuiaba', 'BR', 'GMT', '2020-12-15T19:00:00.000Z', 2, '2020-12-15 01:32:38'),
('30186491', 'Globo FC U20 v Ceara SC U20', 'BR', 'GMT', '2020-12-14T23:00:40.000Z', 2, '2020-12-15 01:32:38'),
('30185584', 'Sampaio Correa FC x Avaí', 'BR', 'GMT', '2020-12-15T22:15:00.000Z', 2, '2020-12-15 01:32:38');

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
  `evento_data` varchar(24) NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT CURDATE()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mercado`
--

INSERT INTO `mercado` (`mercado_id`, `competicao_id`, `evento_id`, `evento_nome`, `codigo_pais`, `timezone`, `evento_data`, `data_cadastro`) VALUES
('1.176840543', '12148223', '30185193', 'Santa Cruz FC U20 v Jacyoba AC U20', 'BR', 'GMT', '15/12/2020 00:00:00', '2020-12-15'),
('1.176833737', '321319', '30184940', 'Operario PR x Ponte Preta', 'BR', 'GMT', '15/12/2020 00:00:00', '2020-12-15'),
('1.176876728', '12148223', '30186491', 'Globo FC U20 v Ceara SC U20', 'BR', 'GMT', '15/12/2020 00:00:40', '2020-12-15'),
('1.176856137', '3172302', '30185130', 'Vila Nova x Ituano', 'BR', 'GMT', '15/12/2020 00:04:15', '2020-12-15'),
('1.176889860', '12148223', '30186913', 'Bahia EC U20 v ABC U20', 'BR', 'GMT', '15/12/2020 19:00:00', '2020-12-15'),
('1.176848721', '321319', '30185567', 'Oeste x Cuiaba', 'BR', 'GMT', '15/12/2020 20:00:00', '2020-12-15'),
('1.176848406', '321319', '30185584', 'Sampaio Correa FC x Avaí', 'BR', 'GMT', '15/12/2020 23:15:00', '2020-12-15'),
('1.176889775', '12148223', '30186914', 'CSA U20 v Fluminense EC Piaui U20', 'BR', 'GMT', '16/12/2020 00:00:00', '2020-12-15'),
('1.176848511', '321319', '30185583', 'EC Vitoria Salvador x Juventude', 'BR', 'GMT', '16/12/2020 01:30:00', '2020-12-15'),
('1.176848616', '321319', '30185570', 'Cruzeiro MG x CSA', 'BR', 'GMT', '16/12/2020 01:30:00', '2020-12-15'),
('1.176849019', '321319', '30185597', 'Brasil de Pelotas x Botafogo SP', 'BR', 'GMT', '16/12/2020 20:30:00', '2020-12-15'),
('1.176848899', '321319', '30185600', 'Guaraní x Confianca', 'BR', 'GMT', '16/12/2020 23:15:00', '2020-12-15'),
('1.176849127', '321319', '30185596', 'Chapecoense x Nautico PE', 'BR', 'GMT', '16/12/2020 23:15:00', '2020-12-15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
