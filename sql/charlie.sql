-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2023 às 04:24
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
(13, 'Ricardio', 'ricardo.hemmel@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '../imagemAdm/6565544e75e12.jpg'),
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
(47, 'Lineu Pintaude kkk', 'lineubixa@hetero.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '../imagemAdm/655ea1353d9c1.jpg'),
(48, 'Fernanda Maskeika', 'shiropv2018@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, NULL),
(50, 'Lineu Bixona', 'lineu@hotmail.com', 'f4b9ec30ad9f68f89b29639786cb62ef', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nome` varchar(500) NOT NULL,
  `categoria_desc` varchar(8000) NOT NULL,
  `categoria_ativo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nome`, `categoria_desc`, `categoria_ativo`) VALUES
(12, 'Bubum gulosoooo', 'Aidsegypitpenislongo', 1),
(14, 'macaco', 'daqwegwe', 0),
(24, 'orangotango', 'adfdfwfw', 1),
(25, 'orangotango', 'adfdfwfw', 1),
(27, 'orangotango', 'adfdfwfw', 1),
(37, 'Boot', 'Tela o boot do pai haha', 0),
(38, 'monkey ', 'banana', 0),
(40, 'papete', 'papete senin', 1),
(41, 'Sunguinha', 'bixaiada', 1),
(42, 'fio dental', 'hmmmmm\r\n', 1);

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
(0, 1),
(264, 2),
(265, 1),
(266, 6),
(268, 1),
(269, 1),
(270, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `produto_id` int(11) NOT NULL,
  `produto_nome` varchar(60) NOT NULL,
  `produto_desc` varchar(500) NOT NULL,
  `produto_preco` decimal(20,0) NOT NULL,
  `produto_desconto` decimal(20,0) NOT NULL,
  `categoria_id` int(30) NOT NULL,
  `produto_ativo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`produto_id`, `produto_nome`, `produto_desc`, `produto_preco`, `produto_desconto`, `categoria_id`, `produto_ativo`) VALUES
(264, 'Putinha2', 'rapariga', 10, 10, 24, 0),
(265, 'Namorida', '6aw4fqw', 10, 10, 40, 0),
(266, 'cueca', 'dwfgwegeg', 15, 10, 12, 1),
(269, 'Ricardo', 'Maluco doido', 100000, 10, 42, 1),
(270, 'Trio do Balacobaco', 'amo uces', 500000, 10, 41, 1);

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
(92, 0, 229, 'https://64.media.tumblr.com/d54e807456014a7c067e73c9bc29013f/tumblr_p6d6c5xXsF1xonxyjo1_500.jpg'),
(93, 0, 230, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(94, 0, 231, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(95, 0, 232, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(96, 0, 233, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(97, 0, 234, 'https://imagem.natelinha.uol.com.br/original/marco-nanini-recorda-serie_6558.jpeg'),
(98, 0, 235, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(99, 0, 236, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(100, 0, 237, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(101, 0, 238, 'https://t3.gstatic.com/licensed-image?q=tbn:ANd9GcTlFppQFm4VCK-UlCGwBXMWBW1BSM0v_KDxVwXZgEO-4slA_Bq23-4OUg_Lg2ONXc2D'),
(102, 0, 239, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(103, 0, 240, ''),
(104, 0, 241, 'https://t3.gstatic.com/licensed-image?q=tbn:ANd9GcTlFppQFm4VCK-UlCGwBXMWBW1BSM0v_KDxVwXZgEO-4slA_Bq23-4OUg_Lg2ONXc2D'),
(106, 0, 243, 'https://t3.gstatic.com/licensed-image?q=tbn:ANd9GcTlFppQFm4VCK-UlCGwBXMWBW1BSM0v_KDxVwXZgEO-4slA_Bq23-4OUg_Lg2ONXc2D'),
(107, 0, 244, 'https://s2.glbimg.com/YKqb68IxCqdWGSq_wqaSVM2mn9k=/e.glbimg.com/og/ed/f/original/2018/02/26/macaco-narigudo.jpg'),
(108, 0, 0, 'https://sm.ign.com/ign_br/screenshot/default/the-boys-s02-homelander-jacket_nv6t.jpg'),
(109, 0, 0, 'https://imagem.natelinha.uol.com.br/original/marco-nanini-recorda-serie_6558.jpeg'),
(110, 0, 0, 'https://imagem.natelinha.uol.com.br/original/marco-nanini-recorda-serie_6558.jpeg'),
(111, 0, 0, 'https://imagem.natelinha.uol.com.br/original/marco-nanini-recorda-serie_6558.jpeg'),
(112, 0, 258, 'https://t3.gstatic.com/licensed-image?q=tbn:ANd9GcTlFppQFm4VCK-UlCGwBXMWBW1BSM0v_KDxVwXZgEO-4slA_Bq23-4OUg_Lg2ONXc2D'),
(113, 0, 259, 'https://imagem.natelinha.uol.com.br/original/marco-nanini-recorda-serie_6558.jpeg'),
(114, 0, 260, 'https://as2.ftcdn.net/v2/jpg/05/75/74/87/1000_F_575748736_VviwEX14bLVp8nAPWMq1Z3wOBy8aAExX.jpg'),
(115, 0, 261, 'https://imagem.natelinha.uol.com.br/original/marco-nanini-recorda-serie_6558.jpeg'),
(116, 1, 261, 'https://www.estrelando.com.br/uploads/2023/05/30/marconanini-face-1685457622.300x300.jpg'),
(117, 2, 261, 'https://br.web.img3.acsta.net/c_310_420/pictures/210/158/21015854_20130626181442276.jpg'),
(118, 0, 262, 'https://as2.ftcdn.net/v2/jpg/05/75/74/87/1000_F_575748736_VviwEX14bLVp8nAPWMq1Z3wOBy8aAExX.jpg'),
(119, 0, 263, 'https://as2.ftcdn.net/v2/jpg/05/75/74/87/1000_F_575748736_VviwEX14bLVp8nAPWMq1Z3wOBy8aAExX.jpg'),
(120, 0, 264, NULL),
(121, 0, 265, 'https://as2.ftcdn.net/v2/jpg/05/75/74/87/1000_F_575748736_VviwEX14bLVp8nAPWMq1Z3wOBy8aAExX.jpg'),
(122, 0, 266, 'https://as2.ftcdn.net/v2/jpg/05/75/74/87/1000_F_575748736_VviwEX14bLVp8nAPWMq1Z3wOBy8aAExX.jpg'),
(123, 0, 268, 'https://pm1.aminoapps.com/6449/c155792fd0878806ab3874ea299fea5ad1e5a195_00.jpg'),
(124, 1, 268, 'https://cdn.staticneo.com/w/attackontitan/ArminArlert.jpg'),
(125, 2, 268, 'https://i.pinimg.com/736x/51/72/2c/51722c60eca6f8643b9302baa5c85508.jpg'),
(126, 0, 269, 'https://pm1.aminoapps.com/6449/c155792fd0878806ab3874ea299fea5ad1e5a195_00.jpg'),
(127, 0, 270, 'https://as2.ftcdn.net/v2/jpg/05/75/74/87/1000_F_575748736_VviwEX14bLVp8nAPWMq1Z3wOBy8aAExX.jpg'),
(128, 1, 270, 'https://pm1.aminoapps.com/6449/c155792fd0878806ab3874ea299fea5ad1e5a195_00.jpg'),
(129, 2, 270, 'https://imagem.natelinha.uol.com.br/original/marco-nanini-recorda-serie_6558.jpeg');

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
  MODIFY `ADM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT de tabela `produto_imagem`
--
ALTER TABLE `produto_imagem`
  MODIFY `imagem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
