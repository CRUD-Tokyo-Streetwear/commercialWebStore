-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/11/2023 às 03:05
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
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `ADM_ID` int(11) NOT NULL,
  `ADM_NOME` varchar(500) NOT NULL,
  `ADM_EMAIL` varchar(500) NOT NULL,
  `ADM_SENHA` varchar(500) NOT NULL,
  `ADM_ATIVO` tinyint(4) DEFAULT NULL,
  `ADM_IMAGEM` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administrador`
--

INSERT INTO `administrador` (`ADM_ID`, `ADM_NOME`, `ADM_EMAIL`, `ADM_SENHA`, `ADM_ATIVO`, `ADM_IMAGEM`) VALUES
(13, 'Ricardio', 'ricardo.hemmel@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '../imagemAdm/6555068c751ba.gif'),
(19, 'Euba Tiuma', 'euba@hotmail.com', '5ea30f2ce289222cea5b492efac5c1a5', 1, NULL),
(20, 'Thomas Turbano', 'thomas@hotmail.com', 'f525241f80cb03ae8ec15ba7e7dcd641', 1, NULL),
(21, 'Sujiro kimimame', 'sujiro@hotmail.com', '4db319351ebaf3f2c3ff6098aa4f6c88', 1, NULL),
(22, 'Fizza Now', 'fizza@hotmail.com', 'afedc9b93990f083968038bc77af2429', 1, NULL),
(24, 'Tako Kunavara', 'tako@hotmail.com', 'fb444c2c7e416c33d355ca2609848a6f', 1, NULL),
(25, 'Tilambucano', 'tilabucanoTheGame@hotmail.com', 'c1cc1f5d81068b10f8447b6db2fb2acc', 1, NULL),
(26, 'Jacinto Pinto', 'jacinto@hotmail.com', '6226e231ffe23057cb042fe92cf121de', 1, NULL),
(27, 'Aquino Rego', 'Aquino@hotmail.com', 'e562c0deb50e01ea8306d21282d54d26', 1, NULL),
(40, 'Jalym Rabei', 'jalim@hotmail.com', '3e97bb344e851dba4aa91b4b1e2a4af6', 1, NULL),
(41, 'Kiko Lindo', 'kiko@hotmail.com', '2794f1ac7a5d4610b2694d8ab3227b8f', 1, NULL),
(44, 'Julo', 'julao@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '../imagemAdm/65537ec2928f1.jpg'),
(46, 'Jackson', 'jack@hotmail.com', 'd0970714757783e6cf17b26fb8e2298f', 1, NULL),
(47, 'Lineu Pintaude', 'lineubixa@bixabixabixa.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '../imagemAdm/655ea1353d9c1.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nome` varchar(500) NOT NULL,
  `categoria_desc` varchar(8000) NOT NULL,
  `categoria_ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nome`, `categoria_desc`, `categoria_ativo`) VALUES
(1, 'Calça', 'Calça para quem não quer andar com a bunda de fora', b'1'),
(2, 'Camisa', 'Camisa para quem não quer andar com as techolas de fora', b'0'),
(3, 'Sapato', 'Sapato para quem não quer andar com os dedos de fora', b'1'),
(4, 'Jaqueta', 'Jaqueta de couro', b'1'),
(5, 'Papete', 'Patete para usar nesse calor do krl', b'1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `produto_id` int(11) NOT NULL,
  `produto_qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque`
--

INSERT INTO `estoque` (`produto_id`, `produto_qtd`) VALUES
(221, 1),
(222, 1),
(224, 1),
(228, 5),
(229, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `produto_id` int(11) NOT NULL,
  `produto_nome` varchar(60) NOT NULL,
  `produto_desc` varchar(20) NOT NULL,
  `produto_preco` decimal(20,0) NOT NULL,
  `produto_desconto` decimal(20,0) NOT NULL,
  `categoria_id` int(30) NOT NULL,
  `produto_ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`produto_id`, `produto_nome`, `produto_desc`, `produto_preco`, `produto_desconto`, `categoria_id`, `produto_ativo`) VALUES
(220, 'Sapato', 'dageg', 515, 6, 0, b'1'),
(221, 'Tafinha', 'Fedida', 999, 10, 4, b'1'),
(222, 'Lucas', 'Bixona', 2, 0, 3, b'1'),
(224, 'Mini Rose', 'Gay', 1000, 10, 4, b'1'),
(228, 'OverWatch', 'Jogo ruim', 50, 0, 5, b'1'),
(229, 'Vicente', 'Sara me nota', 1, 10, 5, b'1');

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
(87, 0, 224, NULL),
(91, 0, 228, ''),
(92, 0, 229, 'https://64.media.tumblr.com/d54e807456014a7c067e73c9bc29013f/tumblr_p6d6c5xXsF1xonxyjo1_500.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ADM_ID`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`produto_id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`produto_id`);

--
-- Índices de tabela `produto_imagem`
--
ALTER TABLE `produto_imagem`
  ADD PRIMARY KEY (`imagem_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ADM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT de tabela `produto_imagem`
--
ALTER TABLE `produto_imagem`
  MODIFY `imagem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
