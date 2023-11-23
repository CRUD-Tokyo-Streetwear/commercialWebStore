-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/11/2023 às 01:34
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `charlie`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_imagem`
--

CREATE TABLE `produto_imagem` (
  `imagem_id` int(11) NOT NULL,
  `imagem_ordem` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `imagem_url` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto_imagem`
--

INSERT INTO `produto_imagem` (`imagem_id`, `imagem_ordem`, `produto_id`, `imagem_url`) VALUES
(84, 0, 221, NULL),
(85, 0, 222, 'https://media.licdn.com/dms/image/C4D03AQGDUtW7dQ4W4g/profile-displayphoto-shrink_800_800/0/1632503818469?e=2147483647&v=beta&t=Tmi8AZwo5qSySI6zhECcdEBJr1ZBYLKTpRuDJXTTzlM'),
(87, 0, 224, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produto_imagem`
--
ALTER TABLE `produto_imagem`
  ADD PRIMARY KEY (`imagem_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produto_imagem`
--
ALTER TABLE `produto_imagem`
  MODIFY `imagem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
