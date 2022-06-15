-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 15-Jun-2022 às 21:32
-- Versão do servidor: 8.0.29
-- versão do PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ativex`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Employees`
--

CREATE TABLE `Employees` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employee_role_id` int NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `Employees`
--

INSERT INTO `Employees` (`id`, `name`, `email`, `username`, `password`, `employee_role_id`, `active`) VALUES
(1, 'Poderoso Chefão', 'chefe@gmail.com', 'chefe', 'senha', 1, 1),
(2, 'Orelha Seca', 'oreiaseca@gmail.com', 'oreiaseca', 'senha', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Employees_roles`
--

CREATE TABLE `Employees_roles` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p_reg_employees` tinyint NOT NULL DEFAULT '1',
  `p_reg_sectors` tinyint NOT NULL DEFAULT '1',
  `p_reg_assets` tinyint NOT NULL DEFAULT '1',
  `p_man_assets` tinyint NOT NULL DEFAULT '1',
  `p_track_asset` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `Employees_roles`
--

INSERT INTO `Employees_roles` (`id`, `name`, `description`, `p_reg_employees`, `p_reg_sectors`, `p_reg_assets`, `p_man_assets`, `p_track_asset`) VALUES
(1, 'administrador', 'Administrador', 1, 1, 1, 1, 1),
(2, 'trabalhador', 'Trabalhador', 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Sectors`
--

CREATE TABLE `Sectors` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `Sectors`
--

INSERT INTO `Sectors` (`id`, `name`, `description`, `phone`) VALUES
(1, 'mat-rh', 'Matriz - RH', '069-69696969');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Employees`
--
ALTER TABLE `Employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Employees_Employees_roles1_idx` (`employee_role_id`);

--
-- Índices para tabela `Employees_roles`
--
ALTER TABLE `Employees_roles`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `Sectors`
--
ALTER TABLE `Sectors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Employees`
--
ALTER TABLE `Employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `Employees_roles`
--
ALTER TABLE `Employees_roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `Sectors`
--
ALTER TABLE `Sectors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `Employees`
--
ALTER TABLE `Employees`
  ADD CONSTRAINT `fk_Employees_Employees_roles1` FOREIGN KEY (`employee_role_id`) REFERENCES `Employees_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
