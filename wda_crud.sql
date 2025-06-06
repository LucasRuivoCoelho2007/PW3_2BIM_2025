-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/06/2025 às 19:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `wda_crud`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(14) NOT NULL,
  `birthdate` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `customers`
--

INSERT INTO `customers` (`id`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
(1, 'Fulano de Tal', '123.456.789-00', '2024-09-24 00:00:00', 'Rua da Web, 123', 'Internet', '12345688', 'Sorocaba', 'RJ', '41 44112233', '41944112233', '128893456', '2024-09-24 00:00:00', '2024-09-25 22:18:53'),
(2, 'Ciclano de Tal', '123.456.789-00', '0000-00-00 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'SP', '41 44112233', '41944112233', '128893456', '2024-09-25 00:00:00', '2024-09-25 22:18:32'),
(7, 'Lucas Ruivo Coelho', '46622233344', '2007-06-21 00:00:00', 'Rua Augusto Vermelho Marques', 'Vila Jardini', '46464645', 'Sorocaba', 'SP', '15 988296269', '15 988296269', '6546546', '2024-09-24 20:49:39', '2024-09-25 21:20:41'),
(8, 'Beltrano dos Anzóis', '987.654.321-00', '1990-05-15 00:00:00', 'Avenida Central, 456', 'Centro', '78945612', 'Curitiba', 'PR', '41 99887766', '41999887766', '135789456', '1990-05-15 00:00:00', '2024-09-25 22:14:50'),
(9, 'Joana da Silva', '222.333.444-55', '1985-08-30 00:00:00', 'Rua das Flores, 789', 'Jardins', '12365478', 'São Paulo', 'SP', '11 33221144', '11933221144', '789654123', '2024-09-24 00:00:00', '2024-09-24 20:35:00'),
(10, 'Pedro Alves', '444.555.666-77', '1977-03-10 00:00:00', 'Rua do Sol, 101', 'Zona Norte', '56473829', 'Belo Horizonte', 'MG', '31 22334455', '31922334455', '456789123', '2024-09-24 00:00:00', '2024-09-24 20:40:00'),
(11, 'Mariana Oliveira', '555.666.777-88', '1988-12-22 00:00:00', 'Travessa do Norte, 303', 'Aeroporto', '23456789', 'Rio de Janeiro', 'RJ', '21 11223344', '2111223344', '567890234', '2024-09-24 00:00:00', '2024-09-24 20:45:00'),
(12, 'Lucas Pereira 123', '666.777.888-99', '1995-07-11 00:00:00', 'Estrada Velha, 505', 'Vila Velha', '65498732', 'Vitória', 'ES', '27 33445566', '2733445566', '678901345', '2024-09-24 00:00:00', '2025-05-25 11:49:36'),
(13, 'Ana Beatriz Costa', '777.888.999-00', '2000-01-20 00:00:00', 'Rua das Palmeiras, 707', 'Jardim Primavera', '98765432', 'Florianópolis', 'SC', '48 55667788', '4855667788', '789012456', '2024-09-24 00:00:00', '2024-09-24 20:55:00'),
(14, 'Rafael Souza', '888.999.000-11', '1992-09-09 00:00:00', 'Alameda das Rosas, 909', 'Bairro Alto', '85274196', 'Goiânia', 'GO', '62 99887744', '6299887744', '890123567', '2024-09-24 00:00:00', '2024-09-24 21:00:00'),
(15, 'Clara Mendes', '999.000.111-22', '1982-11-05 00:00:00', 'Praça das Árvores, 111', 'Lago Sul', '32165478', 'Brasília', 'DF', '61 22334466', '6122334466', '901234678', '2024-09-24 00:00:00', '2024-09-24 21:05:00'),
(16, 'Thiago Lopes', '111.222.333-44', '1979-04-25 00:00:00', 'Rua dos Pássaros, 222', 'Vila Nova', '45612378', 'Campinas', 'SP', '19 55667788', '1955667788', '012345789', '2024-09-24 00:00:00', '2024-09-24 21:10:00'),
(17, 'Beatriz Lima', '222.333.444-55', '1998-06-15 00:00:00', 'Rua do Mercado, 333', 'Centro', '32165489', 'Salvador', 'BA', '71 99887766', '7199887766', '123456890', '2024-09-24 00:00:00', '2024-09-24 21:15:00'),
(18, 'Gabriel Ferreira', '333.444.555-66', '1983-02-14 00:00:00', 'Avenida Paulista, 444', 'Bela Vista', '65432178', 'São Paulo', 'SP', '11 33445566', '1133445566', '234567901', '2024-09-24 00:00:00', '2024-09-24 21:20:00'),
(19, 'Carla Moreira', '444.555.666-77', '1990-10-03 00:00:00', 'Rua do Comércio, 555', 'Centro Histórico', '98712345', 'Porto Alegre', 'RS', '51 99887722', '5199887722', '345678012', '2024-09-24 00:00:00', '2024-09-24 21:25:00'),
(23, 'teste123teste', '', '2025-05-25 00:00:00', '', '', '', '', '', '', '', '', '2025-05-25 11:41:42', '2025-05-25 11:41:42'),
(28, 'Lucas da Massa', '', '2025-05-25 00:00:00', 'Rua Caeté Baiano', 'Lago Azul', '69019-63', 'Manaus', 'AM', '9999999999999', '', '', '2025-05-25 12:01:24', '2025-05-25 12:01:24'),
(29, 'teste', '', '2025-05-25 00:00:00', 'Rua Caeté Baiano', 'Lago Azul', '69019-63', 'Manaus', 'AM', '2222222222222', '', '111111111111111', '2025-05-25 12:11:53', '2025-05-25 12:11:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `diretor` varchar(50) NOT NULL,
  `classificacao` varchar(20) NOT NULL,
  `ano` int(4) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `preco` float NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`id`, `nome`, `diretor`, `classificacao`, `ano`, `data_cadastro`, `preco`, `foto`, `modified`, `created`) VALUES
(1, 'Jurassic Park ', 'Steven Spielberg', 'Ficção Científica', 1993, '2024-09-16 00:00:00', 299.99, '', '2024-09-24 20:20:47', NULL),
(2, 'O Último Samurai', 'Edward Zwick', 'Ação', 2003, '2024-09-19 00:00:00', 69.99, '', '2024-09-24 20:07:35', NULL),
(13, 'A Origem', 'Christopher Nolan', 'Ficção Científica', 2010, '2024-09-17 00:00:00', 249.99, '', '2024-09-24 20:25:00', NULL),
(14, 'Titanic', 'James Cameron', 'Drama/Romance', 1997, '2024-09-17 00:00:00', 199.99, '', '2024-09-24 20:30:00', NULL),
(15, 'Matrix', 'The Wachowskis', 'Ficção Científica', 1999, '2024-09-18 00:00:00', 299.99, '', '2024-09-24 20:35:00', NULL),
(16, 'Batman: O Cavaleiro das Trevas', 'Christopher Nolan', 'Ação', 2008, '2024-09-18 00:00:00', 249.99, '', '2024-09-24 20:40:00', NULL),
(17, 'Forrest Gump: O Contador de Histórias', 'Robert Zemeckis', 'Drama', 1994, '2024-09-19 00:00:00', 179.99, '', '2024-09-24 20:45:00', NULL),
(19, 'Avatar', 'James Cameron', 'Ficção Científica', 2009, '2024-09-20 00:00:00', 299.99, '', '2024-09-24 20:55:00', NULL),
(20, 'O Poderoso Chefão', 'Francis Ford Coppola', 'Crime/Drama', 1972, '2024-09-20 00:00:00', 249.99, '', '2024-09-24 21:00:00', NULL),
(21, 'Pulp Fiction: Tempo de Violência', 'Quentin Tarantino', 'Crime/Drama', 1994, '2024-09-21 00:00:00', 199.99, '', '2024-09-24 21:05:00', NULL),
(22, 'O Senhor dos Anéis: A Sociedade do Anel', 'Peter Jackson', 'Fantasia/Aventura', 2001, '2024-09-21 00:00:00', 279.99, '', '2024-09-24 21:10:00', NULL),
(23, 'Clube da Luta', 'David Fincher', 'Drama', 1999, '2024-09-22 00:00:00', 229.99, '', '2024-09-24 21:15:00', NULL),
(25, 'A Lista de Schindler', 'Steven Spielberg', 'Drama/Histórico', 1993, '2024-09-23 00:00:00', 199.99, '', '2024-09-24 21:25:00', NULL),
(26, 'De Volta para o Futuro', 'Robert Zemeckis', 'Ficção Científica', 1985, '2024-09-23 00:00:00', 189.99, '', '2024-09-24 21:30:00', NULL),
(27, 'O Rei Leão', 'Roger Allers, Rob Minkoff', 'Animação', 1994, '2024-09-24 00:00:00', 179.99, '', '2024-09-24 21:35:00', NULL),
(28, 'a', 'a', 'a', 11111, '2024-11-20 00:00:00', 11, NULL, '2024-11-20 20:04:51', '2024-11-20 20:04:51'),
(30, 'piratas do caribe', '', '', 0, '2025-06-04 00:00:00', 0, 'images.jpg', '2025-06-04 14:02:19', '2025-06-04 14:02:19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `password`, `foto`) VALUES
(38, 'admin', 'admin', '$2a$08$CflfilePArK1BJomM0F6a.oAcJim1ZXiXJW6PE7Yu/j6MemchR23e', '100_9142.JPG'),
(40, 'Lucas Ruivo Coelho', 'Lucasss', '$2a$08$CflfilePArK1BJomM0F6a.oAcJim1ZXiXJW6PE7Yu/j6MemchR23e', 'IMG-20171015-WA0011.jpg'),
(46, 'lucasruivocoelho', 'lucasruivocoelho', '$2a$08$CflfilePArK1BJomM0F6a.p4BexpxKM297lapl83Z5Xz25SLMJIWe', 'pessoa formal.jpg'),
(47, 'Alice Smith', 'alice.s', '$2a$08$CflfilePArK1BJomM0F6a.y.kWDmGhmcxVGBZizqAZ2B0mqN4TAkS', 'Sem título.jpg'),
(48, 'Bob Johnson', 'bob.j', '$2a$08$CflfilePArK1BJomM0F6a.j/.naa/apg/LrKe4As66u.CC0.6atIK', 'Bob-Johnson.jpg'),
(49, 'Charlie Brown', 'charlie.b', '$2a$08$CflfilePArK1BJomM0F6a.Sf.1rxLT3JYLmKQ3PJ8xHymPdlOSd5a', 'Charlie Brown.jpg'),
(50, 'Diana Prince', 'diana.p', '$2a$08$CflfilePArK1BJomM0F6a.K5QN88425XH0IGiMOuB77zsJQfFJAuG', 'Diana Prince.jpg'),
(51, 'Ethan Hunt', 'ethan.h', '$2a$08$CflfilePArK1BJomM0F6a.UDTySjF9JXVg0/Q7KGt.wSRPlP/K8zm', 'Ethan Hunt.jpg'),
(52, 'Fiona Glenanne', 'fiona.g', '$2a$08$CflfilePArK1BJomM0F6a.Rqc2lafaEZSHFfwVsk9OPhTIJ9XEqrm', 'Fiona Glenanne.jpg'),
(53, 'George Costanza', 'george.c', '$2a$08$CflfilePArK1BJomM0F6a.TGBsnf4CDs9OS6MVCpa7ONiRKxjQ1z6', 'George Costanza.jpg'),
(54, 'Hannah Abbott', 'Hannah Abbott', '$2a$08$CflfilePArK1BJomM0F6a.54bq7CCI6vuqWQOjpb.JTWvEIAe9Z7q', 'Hannah Abbott.jpg'),
(55, 'Ivan Drago', 'Ivan Drago', '$2a$08$CflfilePArK1BJomM0F6a.m/sI1dXYJ9TiJkbZ61ZqDU/sSPMgWTK', 'Ivan Drago.jpg'),
(56, 'Julia Roberts', 'Julia Roberts', '$2a$08$CflfilePArK1BJomM0F6a.OGk29.fbRnG7Sng/Bg2Y2AVF.Zt4D1S', 'Julia Roberts.jpg'),
(57, 'Kyle Reese', 'Kyle Reese', '$2a$08$CflfilePArK1BJomM0F6a.vZ9DCyBWilTJbkgM9qL651xFwkrDLmO', 'Kyle Reese.png'),
(58, 'Laura Croft', 'Laura Croft', '$2a$08$CflfilePArK1BJomM0F6a.njJYqiXPr/ZgHS3Fj8wvNaGUkct05di', 'Laura Croft.png'),
(59, 'Michael Scott', 'Michael Scott', '$2a$08$CflfilePArK1BJomM0F6a.M0zWciBrLRvuxGMMfi.vejOoss/eDqu', 'Michael Scott.jpg'),
(60, 'Oliver Queen', 'Oliver Queen', '$2a$08$CflfilePArK1BJomM0F6a.vNe4a/IGCiDb7X30OG9Dogt8t/MeSZW', 'Oliver Queen.jpg'),
(61, 'Ursula Buffay', 'Ursula Buffay', '$2a$08$CflfilePArK1BJomM0F6a.n9/vgjlQyRoTk39xsq/ThiqrqjmZPCq', 'Ursula Buffay.jpg'),
(62, 'Xavier Gens', 'Xavier Gens', '$2a$08$CflfilePArK1BJomM0F6a.g/sn8f37uJHl.dw2GzJxZat40nJWMeS', 'Xavier Gens.jpg'),
(63, 'Peter Parker', 'Peter Parker', '$2a$08$CflfilePArK1BJomM0F6a.P3LEZsrhQrP95pDjQIV4sDXNEPV29LC', 'Peter Parker.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
