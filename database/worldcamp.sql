-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para worldcamp
CREATE DATABASE IF NOT EXISTS `worldcamp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `worldcamp`;

-- Copiando estrutura para tabela worldcamp.agendardormitorio
CREATE TABLE IF NOT EXISTS `agendardormitorio` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nome-usuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `check-in` date NOT NULL,
  `check-out` date NOT NULL,
  `dormitorio` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela worldcamp.agendardormitorio: ~0 rows (aproximadamente)
INSERT INTO `agendardormitorio` ( `nome-usuario`, `check-in`, `check-out`, `dormitorio`) VALUES
	( 'FELIPE', '2025-11-17', '2025-11-18', 1);

-- Copiando estrutura para tabela worldcamp.agendartrilhas
CREATE TABLE IF NOT EXISTS `agendartrilhas` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nome-usuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `data-realização` date NOT NULL,
  `trilha` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela worldcamp.agendartrilhas: ~0 rows (aproximadamente)
INSERT INTO `agendartrilhas` ( `nome-usuario`, `data-realização`, `trilha`) VALUES
	('FELIPE', '2025-11-17', 1);

-- Copiando estrutura para tabela worldcamp.listausuarios
CREATE TABLE IF NOT EXISTS `listausuarios` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `cpf` text NOT NULL,
  `telefone` text NOT NULL,
  `senha` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela worldcamp.listausuarios: ~0 rows (aproximadamente)
INSERT INTO `listausuarios` ( `nome`, `email`, `cpf`, `telefone`, `senha`) VALUES
	( 'Felipe', 'feguinhak2@gmail.com', '126.263.239-00', '4999804-1402', '123q');

-- Copiando estrutura para tabela worldcamp.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nome` text,
  `quantidade` int DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela worldcamp.produtos: ~0 rows (aproximadamente)
INSERT INTO `produtos` ( `Nome`, `quantidade`) VALUES
	( 'camiseta', 50);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
