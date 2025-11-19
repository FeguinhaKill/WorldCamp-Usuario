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
  `nome-usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `check-in` date NOT NULL,
  `check-out` date NOT NULL,
  `dormitorio` int NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela worldcamp.agendardormitorio: ~4 rows (aproximadamente)
INSERT INTO `agendardormitorio` (`Id`, `nome-usuario`, `check-in`, `check-out`, `dormitorio`) VALUES
	(2, 'FELIPE', '2025-11-17', '2025-11-18', 1),
	(3, 'Alanbidanos', '2025-11-19', '2025-12-19', 4),
	(4, 'Alanbidanos', '2025-11-19', '2025-11-20', 2),
	(5, 'Alanbidanos', '2025-11-19', '2025-11-20', 2);

-- Copiando estrutura para tabela worldcamp.agendartrilhas
CREATE TABLE IF NOT EXISTS `agendartrilhas` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `data_realizacao` date NOT NULL,
  `trilha` varchar(50) NOT NULL DEFAULT '',
  `numero_acompanhantes` int DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela worldcamp.agendartrilhas: ~1 rows (aproximadamente)
INSERT INTO `agendartrilhas` (`Id`, `nome_usuario`, `data_realizacao`, `trilha`, `numero_acompanhantes`) VALUES
	(7, 'Alanbidanos', '2025-11-20', 'vale verde', 1),
	(8, 'Alanbidanos', '2025-11-28', 'pedra clara', 4),
	(9, 'Alanbidanos', '2025-11-28', 'vale verde', 1),
	(10, 'Alanbidanos', '2025-11-20', 'pico nebuloso', 1),
	(11, 'Alanbidanos', '2025-12-04', 'pico nebuloso', 1);

-- Copiando estrutura para tabela worldcamp.compras_realizadas
CREATE TABLE IF NOT EXISTS `compras_realizadas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) NOT NULL DEFAULT '',
  `produtos_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `data_compra` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela worldcamp.compras_realizadas: ~7 rows (aproximadamente)
INSERT INTO `compras_realizadas` (`id`, `nome_usuario`, `produtos_json`, `data_compra`) VALUES
	(4, 'Alanbidanos', '[{"nome":"Botas de Chuva Impermeáveis","preco":"249.00","quantidade":5}]', '2025-11-19 10:19:48'),
	(9, 'Felipe', '[{"nome":"Garrafa Térmica WorldCamp","preco":"119.00","quantidade":1338},{"nome":"Botas de Chuva Impermeáveis","preco":"249.00","quantidade":1}]', '2025-11-19 13:20:10'),
	(10, 'Alanbidanos', '[{"nome":"Camiseta Personalizada WorldCamp","preco":"89.90","quantidade":1},{"nome":"Kit Aleatório WorldCamp","preco":"159.00","quantidade":1}]', '2025-11-19 13:35:27'),
	(11, 'Alanbidanos', '[{"nome":"Botas de Chuva Impermeáveis","preco":"249.00","quantidade":1}]', '2025-11-19 13:40:47');

-- Copiando estrutura para tabela worldcamp.listausuarios
CREATE TABLE IF NOT EXISTS `listausuarios` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `cpf` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `telefone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `senha` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela worldcamp.listausuarios: ~2 rows (aproximadamente)
INSERT INTO `listausuarios` (`Id`, `nome`, `email`, `cpf`, `telefone`, `senha`) VALUES
	(3, 'Felipe', 'feguinhak2@gmail.com', '126.263.239-00', '4999804-1402', '123q'),
	(4, 'Alanbidanos', 'alanbidanos@gmail.com', '123-456-789-00', '49 9 1234-5678', '123w');

-- Copiando estrutura para tabela worldcamp.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `categoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela worldcamp.produtos: ~0 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `nome`, `categoria`, `preco`, `imagem_path`) VALUES
	(1, 'Garrafa Térmica WorldCamp', 'Acessório', 119.00, '../../imagens/garrafaLoja.png'),
	(2, 'Botas de Chuva Impermeáveis', 'Calçado', 249.00, '../../imagens/botaLoja.png'),
	(3, 'Jaqueta School WorldCamp', 'Roupa', 329.00, '../../imagens/jaquetaLoja.png'),
	(4, 'Chapéu de Acampamento', 'Acessório', 79.90, '../../imagens/chapeuLoja.png'),
	(5, 'Camiseta Personalizada WorldCamp', 'Roupa', 89.90, '../../imagens/camisetaLoja.png'),
	(6, 'Kit Aleatório WorldCamp', 'Kit', 159.00, '../../imagens/kitLoja.png');

-- Copiando estrutura para tabela worldcamp.produtos_descricao
CREATE TABLE IF NOT EXISTS `produtos_descricao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `descricao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `produtos_descricao_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela worldcamp.produtos_descricao: ~18 rows (aproximadamente)
INSERT INTO `produtos_descricao` (`id`, `product_id`, `descricao`) VALUES
	(1, 1, 'Conserva a temperatura por até 12h'),
	(2, 1, 'Corpo em aço inoxidável'),
	(3, 1, 'Ideal para trilhas longas'),
	(4, 2, 'Material resistente à água'),
	(5, 2, 'Solado antiderrapante'),
	(6, 2, 'Perfeitas para terrenos molhados'),
	(7, 3, 'Proteção contra vento e chuva'),
	(8, 3, 'Tecido térmico leve'),
	(9, 3, 'Visual oficial do acampamento'),
	(10, 4, 'Proteção contra o sol'),
	(11, 4, 'Ajuste com cordão'),
	(12, 4, 'Estilo aventureiro WorldCamp'),
	(13, 5, 'Nome, turma ou frase personalizada'),
	(14, 5, 'Tecido leve e respirável'),
	(15, 5, 'Lembrança oficial do acampamento'),
	(16, 6, 'Contém de 3 a 5 itens surpresa'),
	(17, 6, 'Selecionados pela equipe WorldCamp'),
	(18, 6, 'Perfeito para quem gosta de novidade');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
