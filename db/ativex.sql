-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 28-Jun-2022 às 04:14
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
-- Estrutura da tabela `Assets`
--

CREATE TABLE `Assets` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_value` decimal(10,0) NOT NULL,
  `start_use_date` date DEFAULT NULL,
  `actual_value` decimal(10,0) DEFAULT NULL,
  `depreciation_rule` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  `sector_id` int NOT NULL,
  `maintence_interval` int NOT NULL DEFAULT '365',
  `standard_maintence_time` int NOT NULL DEFAULT '0',
  `assets_status_id` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Assets_status`
--

CREATE TABLE `Assets_status` (
  `id` int NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `Assets_status`
--

INSERT INTO `Assets_status` (`id`, `description`) VALUES
(1, 'Guardado'),
(2, 'Em uso'),
(3, 'Descartado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Employees`
--

CREATE TABLE `Employees` (
  `id` int NOT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p_reg_employees` tinyint NOT NULL DEFAULT '1',
  `p_view_employees` tinyint NOT NULL,
  `p_reg_sectors` tinyint NOT NULL DEFAULT '1',
  `p_view_sectors` tinyint NOT NULL,
  `p_reg_assets` tinyint NOT NULL DEFAULT '1',
  `p_man_assets` tinyint NOT NULL DEFAULT '1',
  `p_track_asset` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `Employees_roles`
--

INSERT INTO `Employees_roles` (`id`, `name`, `description`, `p_reg_employees`, `p_view_employees`, `p_reg_sectors`, `p_view_sectors`, `p_reg_assets`, `p_man_assets`, `p_track_asset`) VALUES
(1, 'administrador', 'Administrador', 1, 1, 1, 1, 1, 1, 1),
(2, 'trabalhador', 'Trabalhador', 0, 1, 0, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Maintences`
--

CREATE TABLE `Maintences` (
  `id` int NOT NULL,
  `asset_id` int NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `time_to_complete` int NOT NULL,
  `action_notes` text COLLATE utf8mb4_general_ci,
  `status` tinyint NOT NULL DEFAULT '0',
  `value` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Ocurrences`
--

CREATE TABLE `Ocurrences` (
  `id` int NOT NULL,
  `asset_id` int NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `action_notes` text COLLATE utf8mb4_general_ci,
  `status` tinyint NOT NULL DEFAULT '0',
  `value` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Sectors`
--

CREATE TABLE `Sectors` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `Sectors`
--

INSERT INTO `Sectors` (`id`, `name`, `description`, `phone`, `status`) VALUES
(1, 'mat-alm', 'Almoxarifado (matriz)', '9696969', 1),
(2, 'lab-1', 'Laboratório 1', '69696969', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Assets`
--
ALTER TABLE `Assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Assets_Employee_idx` (`employee_id`),
  ADD KEY `fk_Assets_Sectors1_idx` (`sector_id`),
  ADD KEY `fk_Assets_assets_status1_idx` (`assets_status_id`);

--
-- Índices para tabela `Assets_status`
--
ALTER TABLE `Assets_status`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `Maintences`
--
ALTER TABLE `Maintences`
  ADD PRIMARY KEY (`id`,`asset_id`),
  ADD KEY `fk_Maintences_Assets1_idx` (`asset_id`);

--
-- Índices para tabela `Ocurrences`
--
ALTER TABLE `Ocurrences`
  ADD PRIMARY KEY (`id`,`asset_id`),
  ADD KEY `fk_Ocurrences_Assets1_idx` (`asset_id`);

--
-- Índices para tabela `Sectors`
--
ALTER TABLE `Sectors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Assets`
--
ALTER TABLE `Assets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Assets_status`
--
ALTER TABLE `Assets_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT de tabela `Maintences`
--
ALTER TABLE `Maintences`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Ocurrences`
--
ALTER TABLE `Ocurrences`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Sectors`
--
ALTER TABLE `Sectors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `Assets`
--
ALTER TABLE `Assets`
  ADD CONSTRAINT `fk_Assets_assets_status1` FOREIGN KEY (`assets_status_id`) REFERENCES `Assets_status` (`id`),
  ADD CONSTRAINT `fk_Assets_Employee` FOREIGN KEY (`employee_id`) REFERENCES `Employees` (`id`),
  ADD CONSTRAINT `fk_Assets_Sectors1` FOREIGN KEY (`sector_id`) REFERENCES `Sectors` (`id`);

--
-- Limitadores para a tabela `Employees`
--
ALTER TABLE `Employees`
  ADD CONSTRAINT `fk_Employees_Employees_roles1` FOREIGN KEY (`employee_role_id`) REFERENCES `Employees_roles` (`id`);

--
-- Limitadores para a tabela `Maintences`
--
ALTER TABLE `Maintences`
  ADD CONSTRAINT `fk_Maintences_Assets1` FOREIGN KEY (`asset_id`) REFERENCES `Assets` (`id`);

--
-- Limitadores para a tabela `Ocurrences`
--
ALTER TABLE `Ocurrences`
  ADD CONSTRAINT `fk_Ocurrences_Assets1` FOREIGN KEY (`asset_id`) REFERENCES `Assets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
