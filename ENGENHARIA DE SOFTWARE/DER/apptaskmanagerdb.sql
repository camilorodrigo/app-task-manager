-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 27-Fev-2023 às 15:39
-- Versão do servidor: 8.0.27
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `apptaskmanagerdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assignments`
--

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `cod_assignment` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_user` int NOT NULL,
  `cod_task` int NOT NULL,
  `designated_by` int NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`cod_assignment`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `assignments`
--

INSERT INTO `assignments` (`cod_assignment`, `cod_user`, `cod_task`, `designated_by`, `status`) VALUES
(1, 1, 1, 2, 2),
(2, 1, 2, 1, 2),
(3, 2, 3, 1, 2),
(4, 2, 4, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_02_23_184040_create_assignments_table', 1),
(4, '2023_02_23_184121_create_tasks_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `cod_task` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`cod_task`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tasks`
--

INSERT INTO `tasks` (`cod_task`, `title`, `description`, `start_date`, `end_date`, `status`) VALUES
(1, 'REGISTRAR USUÁRIO SISTEMA E-GET', 'REGISTRAR USUÁRIO SISTEMA E-GET', '2023-02-24', '2023-02-27', 1),
(2, 'LOGIN DE USUÁRIO SISTEMA E-GET', 'LOGIN DE USUÁRIO SISTEMA E-GET', '2023-02-24', '2023-02-27', 1),
(3, 'FUNCIONALIDADE CADASTRAR TAREFA SISTEMA E-GET', 'FUNCIONALIDADE CADASTRAR TAREFA SISTEMA E-GET', '2023-02-24', '2023-02-27', 1),
(4, 'FUNCIONALIDADE GERENCIAR ATRIBUIÇÕES DE TAREF', 'FUNCIONALIDADE GERENCIAR ATRIBUIÇÕES DE TAREFAS SISTEMA E-GET', '2023-02-24', '2023-02-27', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `cod_user` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_user`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`cod_user`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rodrigo Camilo', 'rcamilo@e-get.com.br', '$2a$12$BZxaBqUfdnZDaUAfoelKLO7.sv0JNIDNjH4Gs5QkTYS.Ao9CnYt6O', NULL, '2023-02-27 08:09:04', '2023-02-27 08:09:04'),
(2, 'Rh', 'rh@e-get.com.br', '$2a$12$BZxaBqUfdnZDaUAfoelKLO7.sv0JNIDNjH4Gs5QkTYS.Ao9CnYt6O', NULL, '2023-02-27 08:09:04', '2023-02-27 08:09:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
