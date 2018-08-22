-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.31-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para essentia
CREATE DATABASE IF NOT EXISTS `essentia` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `essentia`;

-- Copiando estrutura para tabela essentia.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `NOME` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `TELEFONE` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `CPF_CNPJ` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIPO_CLIENTE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FOTO` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IS_ATIVO` tinyint(1) NOT NULL DEFAULT '1',
  `REGIAO_ID` int(11) DEFAULT NULL,
  `DATA_CRIACAO` datetime DEFAULT NULL,
  `DATA_ATUALIZACAO` datetime DEFAULT NULL,
  `DATA_EXCLUSAO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_cliente_regiao_idx` (`REGIAO_ID`),
  CONSTRAINT `FK_F41C9B25E325805E` FOREIGN KEY (`REGIAO_ID`) REFERENCES `regiao` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela essentia.cliente: ~0 rows (aproximadamente)
DELETE FROM `cliente`;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela essentia.regiao
CREATE TABLE IF NOT EXISTS `regiao` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IS_ATIVO` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela essentia.regiao: ~4 rows (aproximadamente)
DELETE FROM `regiao`;
/*!40000 ALTER TABLE `regiao` DISABLE KEYS */;
INSERT INTO `regiao` (`ID`, `NOME`, `IS_ATIVO`) VALUES
	(1, 'Centro-Oeste', 1),
	(2, 'Nordeste', 1),
	(3, 'Norte', 1),
	(4, 'Sudeste', 1),
	(5, 'Sul', 1);
/*!40000 ALTER TABLE `regiao` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
