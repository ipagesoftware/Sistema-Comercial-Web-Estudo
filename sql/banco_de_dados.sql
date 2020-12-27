-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.10-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para ipage234_scw
DROP DATABASE IF EXISTS `ipage234_scw`;
CREATE DATABASE IF NOT EXISTS `ipage234_scw` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `ipage234_scw`;

-- Copiando estrutura para tabela ipage234_scw.cliente
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cliente_nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_pessoa` char(1) COLLATE utf8_unicode_ci DEFAULT 'J' COMMENT 'J = JURÍDICA, F =- FISICA',
  `cliente_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_cep` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_endereco` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_bairro` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_cidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_uf` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_cpf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_rg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_razao_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_cnpj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_insc_est` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_insc_mun` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_fone1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_celular1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_contato1` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_fone2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_celular2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_contato2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_fone3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_celular3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_contato3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_fone4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_celular4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_contato4` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `cliente_obs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliente_data_cadastro` timestamp NULL DEFAULT NULL,
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.cliente: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`cliente_nome`, `cliente_pessoa`, `cliente_email`, `cliente_cep`, `cliente_endereco`, `cliente_complemento`, `cliente_bairro`, `cliente_cidade`, `cliente_uf`, `cliente_cpf`, `cliente_rg`, `cliente_razao_social`, `cliente_cnpj`, `cliente_insc_est`, `cliente_insc_mun`, `cliente_fone1`, `cliente_celular1`, `cliente_contato1`, `cliente_fone2`, `cliente_celular2`, `cliente_contato2`, `cliente_fone3`, `cliente_celular3`, `cliente_contato3`, `cliente_fone4`, `cliente_celular4`, `cliente_contato4`, `cliente_status`, `cliente_obs`, `cliente_data_cadastro`, `cliente_id`) VALUES
	('ANTONIO  (PORTO DOS CASAIS)', 'F', '', '00000-000', '1O. ETAPA', '', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '', '', '', '', '', '', '(81) 3378-7333', '', '', '(81) 8638-1457', '', '', '', '', '', '', '', '', 1, '', '2012-05-26 17:03:56', 1),
	('ANTONIO GOMES (TONHO)', 'F', '', '00000-000', 'RUA FORTE DO BRUM (EM FRENTE BL 40)', '', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '', '', '', '', '', '', '(81) 8749-1470', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2013-09-28 10:11:23', 2),
	('BANCA CULTURAL', 'F', '', '00000-000', 'TERMINAL DOS ONIBUS', '', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '', '', '', '', '', '', '(81) 8601-5761', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2013-12-30 11:15:47', 3),
	('CICERO SOUSA DOS SANTOS', 'J', '', '54360-020', 'AV. JOAO FERNANDES VIEIRA NO. 149', '', 'JABOATAO DOS GUARARAPES', 'JABOATAO DOS GUARARAPES', 'PE', '', '', 'CICERO SOUSA DOS SANTOS', '189.678.764-91', '54360-020', '', '(81) 3375-1179', '', '', '(81) 8750-7358', '', '', '', '', '', '', '', '', 1, '', '2012-01-23 11:43:23', 4),
	('BANCA PRIMAVERA', 'F', '', '54360-010', 'AV. DOMIMGOS FERNANDES N 01', '', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '', '', '', '', '', '', '(81) 8815-0860', '', '', '', '', '', '', '', '', '', '', '', 1, 'VERA LUCIA CORREIA DOS PASSOS', '2014-01-28 10:04:07', 5);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.empresa
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `empresa_nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_cep` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_endereco` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_bairro` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_cidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_uf` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_razao_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_cnpj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_insc_est` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_insc_mun` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_fone1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_celular1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_contato1` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_fone2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_celular2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_contato2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_fone3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_celular3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_contato3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_fone4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_celular4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_contato4` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `empresa_obs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa_data_cadastro` timestamp NULL DEFAULT NULL,
  `empresa_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.empresa: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`empresa_nome`, `empresa_email`, `empresa_cep`, `empresa_endereco`, `empresa_complemento`, `empresa_bairro`, `empresa_cidade`, `empresa_uf`, `empresa_razao_social`, `empresa_cnpj`, `empresa_insc_est`, `empresa_insc_mun`, `empresa_fone1`, `empresa_celular1`, `empresa_contato1`, `empresa_fone2`, `empresa_celular2`, `empresa_contato2`, `empresa_fone3`, `empresa_celular3`, `empresa_contato3`, `empresa_fone4`, `empresa_celular4`, `empresa_contato4`, `empresa_status`, `empresa_obs`, `empresa_data_cadastro`, `empresa_id`) VALUES
	('IPAGE SOFTWARE', 'suporte@ipage.com.br', '54360-080', 'RUA FORTE DAS CINCO PONTAS', 'PROXIMO A ASSEMBLEIA DE DEUS', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '', '74.876.021/0001-01', '', '', '(81) 3376-1673', '', '', '', '', '', '', '', '', '', '', '', 1, 'FSADSFFDSDSFFDS', '2020-11-13 12:39:44', 1);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.estoque
DROP TABLE IF EXISTS `estoque`;
CREATE TABLE IF NOT EXISTS `estoque` (
  `produto_id` int(11) NOT NULL DEFAULT 0 COMMENT 'VEM DO CADASTRO DE PRODUTOS',
  `quant_entrada` float(10,2) DEFAULT 0.00,
  `quant_saida` float(10,2) DEFAULT 0.00,
  `estoque_atu` float(10,2) DEFAULT 0.00 COMMENT 'ESTOQUE ATUAL= QUANT_ENTRADA-QUANT_SAIDA+ESTOQUE_ATU',
  `tipo_op` char(2) DEFAULT 'E' COMMENT '[E]entrada, [S]aída, [ES] Estorno Saída, [EE] Estorno Entrada, [P]erda, [C]onsumo, [TE] Troca Entrsa, [TS] Troca Saída',
  `usuario` varchar(15) DEFAULT NULL COMMENT 'NOME DO ÚLTIMO USUÁRIO QUE EFETIVOU A OPERAÇÃO',
  `critico` int(3) DEFAULT 0 COMMENT '1 - CRITICO',
  `origem` varchar(255) DEFAULT 'NAO INFORMADO',
  `data_cadastro` timestamp NULL DEFAULT NULL COMMENT 'DATA QUE HOUVE A ÚLTIMA ATUALIZAÇÃO',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `FK_estoque_produto` (`produto_id`),
  CONSTRAINT `FK_estoque_produto` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ipage234_scw.estoque: ~138 rows (aproximadamente)
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` (`produto_id`, `quant_entrada`, `quant_saida`, `estoque_atu`, `tipo_op`, `usuario`, `critico`, `origem`, `data_cadastro`, `id`) VALUES
	(1, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 1),
	(3, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 2),
	(4, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 3),
	(5, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 4),
	(7, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 5),
	(8, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 6),
	(9, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 7),
	(10, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 8),
	(13, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 9),
	(14, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 10),
	(16, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 11),
	(17, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 12),
	(18, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 13),
	(19, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 14),
	(20, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 15),
	(21, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 16),
	(23, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 17),
	(25, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 18),
	(26, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 19),
	(27, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 20),
	(28, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 21),
	(29, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 22),
	(30, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 23),
	(36, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 24),
	(37, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 25),
	(39, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 26),
	(40, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 27),
	(46, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 28),
	(47, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 29),
	(48, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 30),
	(49, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 31),
	(50, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 32),
	(51, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 33),
	(52, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 34),
	(53, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 35),
	(54, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 36),
	(55, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 37),
	(57, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 38),
	(60, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 39),
	(62, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 40),
	(63, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 41),
	(64, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 42),
	(65, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 43),
	(66, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 44),
	(69, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 45),
	(70, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 46),
	(71, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 47),
	(73, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 48),
	(75, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 49),
	(79, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 50),
	(80, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 51),
	(81, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 52),
	(82, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 53),
	(83, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 54),
	(84, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 55),
	(85, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 56),
	(86, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 57),
	(87, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 58),
	(88, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 59),
	(89, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 60),
	(90, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 61),
	(91, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 62),
	(93, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 63),
	(96, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 64),
	(97, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 65),
	(98, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 66),
	(101, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 67),
	(104, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 68),
	(107, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 69),
	(108, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 70),
	(110, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 71),
	(111, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 72),
	(112, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 73),
	(117, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 74),
	(118, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 75),
	(119, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 76),
	(120, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 77),
	(121, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 78),
	(212, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 79),
	(213, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 80),
	(216, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 81),
	(217, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 82),
	(218, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 83),
	(219, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 84),
	(220, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 85),
	(223, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 86),
	(224, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 87),
	(226, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 88),
	(227, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 89),
	(229, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 90),
	(230, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 91),
	(236, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 92),
	(238, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 93),
	(239, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 94),
	(240, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 95),
	(241, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 96),
	(242, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 97),
	(244, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 98),
	(245, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 99),
	(246, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 100),
	(248, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 101),
	(249, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 102),
	(250, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 103),
	(252, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 104),
	(255, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 105),
	(257, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 106),
	(258, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 107),
	(259, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 108),
	(261, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 109),
	(262, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 110),
	(263, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 111),
	(264, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 112),
	(265, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 113),
	(270, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 114),
	(271, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 115),
	(273, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 116),
	(276, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 117),
	(290, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 118),
	(294, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 119),
	(295, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 120),
	(296, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 121),
	(297, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 122),
	(300, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 123),
	(317, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 124),
	(326, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 125),
	(327, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 126),
	(333, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 127),
	(339, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 128),
	(340, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 129),
	(353, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 130),
	(354, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 131),
	(355, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 132),
	(356, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 133),
	(357, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 134),
	(358, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 135),
	(359, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 136),
	(360, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 137),
	(361, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-02 10:06:44', 138),
	(362, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', '2020-12-05 06:35:59', 139),
	(363, 0.44, 0.00, 1246.98, 'E', 'Diogenes Dias', 0, 'AJUSTE ESTOQUE', '2020-12-05 12:21:56', 140);
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.estoque_log
DROP TABLE IF EXISTS `estoque_log`;
CREATE TABLE IF NOT EXISTS `estoque_log` (
  `controle` int(11) DEFAULT 0,
  `produto_id` int(11) DEFAULT 0 COMMENT 'VEM DO CADASTRO DE PRODUTOS',
  `estoque_inicial` float(10,2) DEFAULT 0.00,
  `quant_entrada` float(10,2) DEFAULT 0.00,
  `quant_saida` float(10,2) DEFAULT 0.00,
  `estoque_atu` float(10,2) DEFAULT 0.00 COMMENT 'ESTOQUE ATUAL= QUANT_ENTRADA-QUANT_SAIDA+ESTOQUE_ATU',
  `tipo_op` char(2) DEFAULT 'E' COMMENT '[E]entrada, [S]aída, [D]evolução',
  `usuario` varchar(15) DEFAULT NULL COMMENT 'NOME DO ÚLTIMO USUÁRIO QUE EFETIVOU A OPERAÇÃO',
  `critico` int(3) DEFAULT 0 COMMENT '1 - CRITICO',
  `origem` varchar(100) DEFAULT 'NAO INFORMADO',
  `numvenda` int(11) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT NULL COMMENT 'DATA QUE HOUVE A ÚLTIMA ATUALIZAÇÃO',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `FK_estoque_log_produto` (`produto_id`),
  CONSTRAINT `FK_estoque_log_produto` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ipage234_scw.estoque_log: ~138 rows (aproximadamente)
/*!40000 ALTER TABLE `estoque_log` DISABLE KEYS */;
INSERT INTO `estoque_log` (`controle`, `produto_id`, `estoque_inicial`, `quant_entrada`, `quant_saida`, `estoque_atu`, `tipo_op`, `usuario`, `critico`, `origem`, `numvenda`, `data_cadastro`, `id`) VALUES
	(1, 1, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 1),
	(1, 3, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 2),
	(1, 4, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 3),
	(1, 5, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 4),
	(1, 7, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 5),
	(1, 8, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 6),
	(1, 9, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 7),
	(1, 10, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 8),
	(1, 13, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 9),
	(1, 14, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 10),
	(1, 16, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 11),
	(1, 17, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 12),
	(1, 18, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 13),
	(1, 19, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 14),
	(1, 20, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 15),
	(1, 21, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 16),
	(1, 23, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 17),
	(1, 25, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 18),
	(1, 26, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 19),
	(1, 27, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 20),
	(1, 28, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 21),
	(1, 29, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 22),
	(1, 30, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 23),
	(1, 36, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 24),
	(1, 37, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 25),
	(1, 39, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 26),
	(1, 40, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 27),
	(1, 46, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 28),
	(1, 47, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 29),
	(1, 48, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 30),
	(1, 49, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 31),
	(1, 50, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 32),
	(1, 51, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 33),
	(1, 52, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 34),
	(1, 53, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 35),
	(1, 54, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 36),
	(1, 55, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 37),
	(1, 57, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 38),
	(1, 60, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 39),
	(1, 62, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 40),
	(1, 63, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 41),
	(1, 64, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 42),
	(1, 65, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 43),
	(1, 66, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 44),
	(1, 69, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 45),
	(1, 70, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 46),
	(1, 71, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 47),
	(1, 73, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 48),
	(1, 75, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 49),
	(1, 79, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 50),
	(1, 80, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 51),
	(1, 81, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 52),
	(1, 82, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 53),
	(1, 83, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 54),
	(1, 84, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 55),
	(1, 85, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 56),
	(1, 86, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 57),
	(1, 87, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 58),
	(1, 88, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 59),
	(1, 89, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 60),
	(1, 90, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 61),
	(1, 91, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 62),
	(1, 93, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 63),
	(1, 96, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 64),
	(1, 97, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 65),
	(1, 98, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 66),
	(1, 101, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 67),
	(1, 104, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 68),
	(1, 107, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 69),
	(1, 108, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 70),
	(1, 110, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 71),
	(1, 111, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 72),
	(1, 112, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 73),
	(1, 117, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 74),
	(1, 118, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 75),
	(1, 119, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 76),
	(1, 120, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 77),
	(1, 121, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 78),
	(1, 212, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 79),
	(1, 213, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 80),
	(1, 216, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 81),
	(1, 217, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 82),
	(1, 218, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 83),
	(1, 219, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 84),
	(1, 220, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 85),
	(1, 223, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 86),
	(1, 224, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 87),
	(1, 226, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 88),
	(1, 227, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 89),
	(1, 229, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 90),
	(1, 230, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 91),
	(1, 236, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 92),
	(1, 238, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 93),
	(1, 239, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 94),
	(1, 240, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 95),
	(1, 241, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 96),
	(1, 242, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 97),
	(1, 244, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 98),
	(1, 245, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 99),
	(1, 246, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 100),
	(1, 248, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 101),
	(1, 249, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 102),
	(1, 250, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 103),
	(1, 252, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 104),
	(1, 255, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 105),
	(1, 257, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 106),
	(1, 258, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 107),
	(1, 259, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 108),
	(1, 261, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 109),
	(1, 262, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 110),
	(1, 263, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 111),
	(1, 264, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 112),
	(1, 265, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 113),
	(1, 270, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 114),
	(1, 271, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 115),
	(1, 273, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 116),
	(1, 276, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 117),
	(1, 290, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 118),
	(1, 294, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 119),
	(1, 295, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 120),
	(1, 296, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 121),
	(1, 297, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 122),
	(1, 300, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 123),
	(1, 317, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 124),
	(1, 326, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 125),
	(1, 327, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 126),
	(1, 333, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 127),
	(1, 339, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 128),
	(1, 340, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 129),
	(1, 353, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 130),
	(1, 354, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 131),
	(1, 355, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 132),
	(1, 356, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 133),
	(1, 357, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 134),
	(1, 358, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 135),
	(1, 359, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 136),
	(1, 360, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 137),
	(1, 361, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-02 10:06:44', 138),
	(1, 362, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-05 06:35:59', 139),
	(1, 363, 0.00, 0.00, 0.00, 0.00, 'E', 'Diogenes Dias', 1, 'ABERTURA ESTOQUE', 0, '2020-12-05 09:45:46', 140),
	(2, 363, 0.00, 1245.66, 0.00, 1245.66, 'E', 'Diogenes Dias', 0, 'AJUSTE ESTOQUE', 0, '2020-12-05 11:12:02', 141),
	(3, 363, 1245.66, 0.44, 0.00, 1246.10, 'E', 'Diogenes Dias', 0, 'AJUSTE ESTOQUE', 0, '2020-12-05 11:12:24', 142),
	(4, 363, 1246.10, 0.44, 0.00, 1246.54, 'E', 'Diogenes Dias', 0, 'AJUSTE ESTOQUE', 0, '2020-12-05 11:14:20', 143),
	(5, 363, 1246.54, 0.44, 0.00, 1246.98, 'E', 'Diogenes Dias', 0, 'AJUSTE ESTOQUE', 0, '2020-12-05 12:21:56', 144);
/*!40000 ALTER TABLE `estoque_log` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.fabricante
DROP TABLE IF EXISTS `fabricante`;
CREATE TABLE IF NOT EXISTS `fabricante` (
  `fabricante_descricao` varchar(30) DEFAULT NULL,
  `fabricante_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `fabricante_data_cadastro` timestamp NULL DEFAULT NULL,
  `fabricante_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`fabricante_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ipage234_scw.fabricante: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `fabricante` DISABLE KEYS */;
INSERT INTO `fabricante` (`fabricante_descricao`, `fabricante_status`, `fabricante_data_cadastro`, `fabricante_id`) VALUES
	('VITARELLA', 1, '2020-11-13 14:52:03', 1),
	('PILAR', 1, '2020-11-15 07:49:08', 2),
	('AMBEV', 1, '2020-11-15 10:11:23', 3),
	('LIXO', 1, '2020-11-13 14:44:15', 7),
	('COCA COLA COMPANY', 1, '2020-11-25 19:04:04', 8);
/*!40000 ALTER TABLE `fabricante` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.fornecedor
DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `fornecedor_nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_pessoa` char(1) COLLATE utf8_unicode_ci DEFAULT 'J' COMMENT 'J = JURÍDICA, F =- FISICA',
  `fornecedor_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_cep` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_endereco` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_bairro` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_cidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_uf` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_cpf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_rg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_razao_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_cnpj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_insc_est` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_insc_mun` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_fone1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_celular1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_contato1` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_fone2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_celular2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_contato2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_fone3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_celular3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_contato3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_fone4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_celular4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_contato4` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `fornecedor_obs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `fornecedor_data_cadastro` timestamp NULL DEFAULT NULL,
  `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.fornecedor: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `fornecedor` DISABLE KEYS */;
INSERT INTO `fornecedor` (`fornecedor_nome`, `fornecedor_pessoa`, `fornecedor_email`, `fornecedor_cep`, `fornecedor_endereco`, `fornecedor_complemento`, `fornecedor_bairro`, `fornecedor_cidade`, `fornecedor_uf`, `fornecedor_cpf`, `fornecedor_rg`, `fornecedor_razao_social`, `fornecedor_cnpj`, `fornecedor_insc_est`, `fornecedor_insc_mun`, `fornecedor_fone1`, `fornecedor_celular1`, `fornecedor_contato1`, `fornecedor_fone2`, `fornecedor_celular2`, `fornecedor_contato2`, `fornecedor_fone3`, `fornecedor_celular3`, `fornecedor_contato3`, `fornecedor_fone4`, `fornecedor_celular4`, `fornecedor_contato4`, `fornecedor_status`, `fornecedor_obs`, `fornecedor_data_cadastro`, `fornecedor_id`) VALUES
	('REFRESCOS GUARARAPES', 'F', 'vendas@refrescosguararapes.com.br', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'REFRESCOS GUARARAPES', '74.876.021/0001-01', '', NULL, '(81) 9243-2584', '', 'MELO', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-15 09:50:21', 269),
	('AMBEV', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'AMBEV', '11.107.173/0001-20', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 270),
	('ATLANTICA DISTRIBUIDORA', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'ATLANTICA DISTRIBUIDORA', '62.605.266/0001-15', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 271),
	('CARRETEIRO', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'CARRETEIRO', '44.951.572/0001-21', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 272),
	('SCHINCARIOL', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'SCHINCARIOL', '27.426.475/0001-09', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 273),
	('FREVO', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'FREVO', '65.988.805/0001-30', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 274),
	('INDAIA', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'INDAIA', '28.306.328/0001-50', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-13 14:54:47', 275),
	('PARATI ATACADO', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'PARATI ATACADO', '50.121.835/0001-78', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-15 07:48:55', 276),
	('DORE', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'DORE', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 277),
	('DOURO', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'DOURO', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-11 10:58:42', 278),
	('MINASGAS', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'MINASGAS', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 279),
	('PAJEU', 'F', '', '00000-000', 'RUA JUNDAI, S/N - Q.58 LOTE 06', '', '', 'RECIFE', 'PE', NULL, NULL, 'PAJEU', '', '', NULL, '(81) 3252-8300', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 280),
	('BRASIL GAS', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'BRASIL GAS', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 281),
	('LIQUIGAS', 'F', '', '00000-000', '', '', '', '', 'PE', NULL, NULL, 'LIQUIGAS', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2011-08-24 19:06:56', 282),
	('CHEIRO BOM', 'F', '', '54360-030', 'RUA SEBASTIÃO DO SOUTO', '', 'MARCOS FREIRE', 'JABOATÃO DOS GUARARAPES', 'PE', '', '', 'CHEIRO BOM', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-11 11:00:43', 283);
/*!40000 ALTER TABLE `fornecedor` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.grupo
DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `grupo_descricao` varchar(30) DEFAULT NULL,
  `grupo_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `grupo_data_cadastro` timestamp NULL DEFAULT NULL,
  `grupo_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`grupo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ipage234_scw.grupo: ~28 rows (aproximadamente)
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` (`grupo_descricao`, `grupo_status`, `grupo_data_cadastro`, `grupo_id`) VALUES
	('PET 2L', 1, '2014-12-20 08:59:04', 1),
	('PET 1L', 1, '2014-12-20 08:59:04', 2),
	('LATA 350 ML', 1, '2014-12-20 08:59:04', 3),
	('CERVEJA LATA', 1, '2014-12-20 08:59:04', 4),
	('CACHAÇA', 1, '2014-12-20 08:59:04', 5),
	('CERVEJA GARRAFA', 1, '2014-12-20 08:59:04', 6),
	('CERVEJA LONG NECK', 1, '2014-12-20 08:59:04', 7),
	('ENERGIL/KAPO/SKINKA', 1, '2014-12-20 08:59:04', 8),
	('REFRIG. KS', 1, '2014-12-20 08:59:04', 9),
	('RGB', 1, '2014-12-20 08:59:04', 10),
	('REFRIG. 600 ML', 1, '2014-12-20 08:59:04', 11),
	('VINHOS', 1, '2014-12-20 08:59:04', 12),
	('BEBIDAS QUENTES', 1, '2014-12-20 08:59:04', 13),
	('GAS', 1, '2020-11-15 09:52:31', 14),
	('AJUSTE SISTEMA', 1, '2014-12-20 08:59:04', 15),
	('REFRIG. 500 ML', 1, '2014-12-20 08:59:04', 16),
	('AGUA MINERAL', 1, '2016-03-21 20:38:46', 17),
	('ENERGETICO/ICE', 1, '2016-03-21 20:38:37', 18),
	('PITU LATA/LATAO', 1, '2016-03-21 20:38:31', 19),
	('GRADE VAZIA', 1, '2014-12-20 08:59:04', 20),
	('MESAS/COPOS', 1, '2014-12-20 08:59:04', 21),
	('DIVERSOS', 1, '2014-12-20 08:59:04', 22),
	('DESINFETANTES', 1, '2020-11-15 07:49:27', 23),
	('LATICINIOS', 1, '2014-12-20 08:59:05', 24),
	('VASSORAS', 1, '2016-03-22 21:44:14', 25),
	('REFRIG. 2 LT', 1, '2020-11-11 11:06:30', 27),
	('BISCOITOS', 1, '2020-11-24 15:44:23', 32),
	('REFRIGERANTE LATA', 1, '2020-11-25 11:27:04', 33);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.plano_contas
DROP TABLE IF EXISTS `plano_contas`;
CREATE TABLE IF NOT EXISTS `plano_contas` (
  `plano_contas_descricao` varchar(80) DEFAULT NULL,
  `plano_contas_natureza_operacao` varchar(1) DEFAULT 'D' COMMENT 'R - RECEITA, D - DESPESAS, A - AMBOS',
  `plano_contas_tipo` varchar(1) DEFAULT 'R' COMMENT 'R - RESTRITO, P = PÚBLICO',
  `plano_contas_status` int(11) DEFAULT 0,
  `procedencia_id` int(11) DEFAULT 0 COMMENT 'ARMAZENA O ID DA PROCEDÊNCIA',
  `plano_contas_data_cadastro` timestamp NULL DEFAULT NULL,
  `plano_contas_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`plano_contas_id`),
  KEY `FK_plano_contas_procedencia` (`procedencia_id`),
  CONSTRAINT `FK_plano_contas_procedencia` FOREIGN KEY (`procedencia_id`) REFERENCES `procedencia` (`procedencia_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ipage234_scw.plano_contas: ~22 rows (aproximadamente)
/*!40000 ALTER TABLE `plano_contas` DISABLE KEYS */;
INSERT INTO `plano_contas` (`plano_contas_descricao`, `plano_contas_natureza_operacao`, `plano_contas_tipo`, `plano_contas_status`, `procedencia_id`, `plano_contas_data_cadastro`, `plano_contas_id`) VALUES
	('AGUA', 'A', 'R', 1, 1, '2020-11-15 07:56:01', 1),
	('LUZ ELETRICA', 'D', 'P', 1, 1, '2016-04-13 12:52:47', 2),
	('PLANET SPEED', 'D', 'R', 1, 1, '2016-04-13 12:53:32', 3),
	('FINANCEIRA BV', 'A', 'P', 1, 1, '2020-11-12 07:42:45', 4),
	('AFONSO MACHADO REP.', 'R', 'R', 1, 3, '2020-10-29 15:29:26', 12),
	('INSTRUMENTAL CENTER', 'R', 'R', 1, 3, '2020-10-29 15:29:47', 13),
	('PROCAR', 'R', 'R', 1, 3, '2020-10-29 15:30:02', 14),
	('EDUARDO MARQUES', 'R', 'R', 1, 3, '2020-10-29 15:31:08', 15),
	('NEURO FISICO TREINO', 'R', 'R', 1, 3, '2020-10-29 15:31:34', 16),
	('DIEGO LOPES NUNES', 'R', 'R', 1, 3, '2020-10-29 15:31:47', 17),
	('RENATO RIBEIRO MACHADO', 'R', 'R', 1, 3, '2020-10-29 15:34:06', 18),
	('GOVERNO FED.', 'R', 'R', 1, 3, '2020-10-29 15:34:18', 19),
	('PADARIA', 'D', 'R', 1, 3, '2020-10-29 18:09:16', 20),
	('SUPERMERCADO', 'D', 'R', 1, 3, '2020-10-29 18:09:42', 21),
	('CORTE CABELO', 'D', 'R', 1, 3, '2020-10-29 18:10:07', 22),
	('LANCHES', 'D', 'R', 1, 3, '2020-10-29 18:11:15', 23),
	('COMBUSTIVEL', 'D', 'R', 1, 3, '2020-10-29 18:58:57', 24),
	('RECARGA CELULAR', 'D', 'R', 1, 3, '2020-10-29 19:03:06', 25),
	('FATURA NUBANK', 'D', 'R', 1, 3, '2020-10-29 19:04:36', 26),
	('RACAO', 'D', 'R', 1, 3, '2020-10-29 19:09:12', 27),
	('FATURA HIPERCARD', 'D', 'R', 1, 3, '2020-10-29 19:10:47', 28),
	('LUZ ELETRICA', 'D', 'R', 1, 3, '2020-10-29 20:30:15', 29);
/*!40000 ALTER TABLE `plano_contas` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.procedencia
DROP TABLE IF EXISTS `procedencia`;
CREATE TABLE IF NOT EXISTS `procedencia` (
  `procedencia_empresa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_cep` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_endereco` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_bairro` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_cidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_uf` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_cpf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_rg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_cnpj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_insc_est` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_fone1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_celular1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_fone2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_celular2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_contato` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `procedencia_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `procedencia_data_cadastro` timestamp NULL DEFAULT NULL,
  `procedencia_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`procedencia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.procedencia: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `procedencia` DISABLE KEYS */;
INSERT INTO `procedencia` (`procedencia_empresa`, `procedencia_email`, `procedencia_cep`, `procedencia_endereco`, `procedencia_complemento`, `procedencia_bairro`, `procedencia_cidade`, `procedencia_uf`, `procedencia_cpf`, `procedencia_rg`, `procedencia_cnpj`, `procedencia_insc_est`, `procedencia_fone1`, `procedencia_celular1`, `procedencia_fone2`, `procedencia_celular2`, `procedencia_fax`, `procedencia_contato`, `procedencia_status`, `procedencia_data_cadastro`, `procedencia_id`) VALUES
	('A.AZEVEDO &amp; FILHO', 'bartaz1@hotmail.com', '50010-170', 'AVENIDA NOSSA SENHORA DO CARMO', '', 'SANTO ANTONIO', 'RECIFE', 'PE', '', '', '10.786.077/0001-92', '', '(81) 3424-6466', '', '', '', '', '', 1, '2020-12-05 17:19:49', 1),
	('PESSOAL', 'diogenesdias@hotmail.com', '54360-080', 'RUA FORTE DAS CINCO PONTAS', '', 'MARCOS FREIRE', 'JABOATÃO DOS GUARARAPES', 'PE', '521.384.454-53', '', '', '', '', '(81) 98615-2352', '', '', '', '', 1, '2020-11-30 08:55:11', 2),
	('IPAGE SOFTWARE', 'atendimento@ipage.com.br', '54360-080', 'RUA FORTE DAS CINCO PONTAS, S/N', 'BLOCO 33, APTO. 102', 'MARCOS FREIRE', 'JABOATÃO DOS GUARARAPES', 'PE', '', '3192101 SDS/PE', '17.299.140/0001-05', '1011121314', '(81) 3376-1673', '(81) 98615-2352', '(81) 3376-2323', '(81) 98868-5275', '(81) 3376-1673', 'DIÓGENES/MICHELLINNE', 1, '2020-10-26 10:27:56', 3);
/*!40000 ALTER TABLE `procedencia` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.procedencia_users
DROP TABLE IF EXISTS `procedencia_users`;
CREATE TABLE IF NOT EXISTS `procedencia_users` (
  `procedencia_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `negar` int(1) NOT NULL DEFAULT 0,
  `data_cadastro` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `FK_procedencia_users_users` (`user_id`),
  KEY `FK_procedencia_users_procedencia` (`procedencia_id`),
  CONSTRAINT `FK_procedencia_users_procedencia` FOREIGN KEY (`procedencia_id`) REFERENCES `procedencia` (`procedencia_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_procedencia_users_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.procedencia_users: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `procedencia_users` DISABLE KEYS */;
INSERT INTO `procedencia_users` (`procedencia_id`, `user_id`, `negar`, `data_cadastro`, `id`) VALUES
	(2, 1, 1, '2016-01-03 14:48:35', 6),
	(2, 2, 1, '2016-02-17 13:09:47', 46),
	(1, 1, 1, '2016-04-10 22:45:50', 47),
	(1, 2, 1, '2016-04-10 22:45:51', 49),
	(3, 1, 1, '2016-04-14 08:00:04', 51),
	(3, 2, 1, '2016-04-14 08:00:04', 52),
	(1, 3, 1, '2016-04-19 19:36:36', 53),
	(2, 3, 1, '2016-04-19 19:36:36', 54),
	(3, 3, 1, '2016-04-19 19:36:36', 55);
/*!40000 ALTER TABLE `procedencia_users` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.produto
DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `produto_descricao` varchar(29) COLLATE utf8_unicode_ci DEFAULT NULL,
  `produto_cod_barras` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `produto_um` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `produto_um_quant` float(10,2) DEFAULT 0.00,
  `produto_emb_com` float(10,2) DEFAULT NULL,
  `produto_fabricante` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `produto_grupo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `produto_codigo_interno` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `produto_val_custo` float(10,2) DEFAULT NULL,
  `produto_margem_lucro` float(10,2) DEFAULT NULL,
  `produto_val_revenda` float(10,2) DEFAULT NULL,
  `produto_desconto` float(10,2) DEFAULT NULL,
  `produto_grupo_id` int(11) NOT NULL DEFAULT 0,
  `produto_estoque_minimo` float(10,2) DEFAULT 0.00,
  `produto_estoque_maximo` float(10,2) DEFAULT 0.00,
  `produto_uso_interno` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'N',
  `produto_peso_bruto` float(10,2) DEFAULT 0.00,
  `produto_peso_liquido` float(10,2) DEFAULT 0.00,
  `produto_composto` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'N',
  `produto_foto` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `produto_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `produto_data_cadastro` timestamp NULL DEFAULT NULL,
  `produto_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`produto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=364 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.produto: ~132 rows (aproximadamente)
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` (`produto_descricao`, `produto_cod_barras`, `produto_um`, `produto_um_quant`, `produto_emb_com`, `produto_fabricante`, `produto_grupo`, `produto_codigo_interno`, `produto_val_custo`, `produto_margem_lucro`, `produto_val_revenda`, `produto_desconto`, `produto_grupo_id`, `produto_estoque_minimo`, `produto_estoque_maximo`, `produto_uso_interno`, `produto_peso_bruto`, `produto_peso_liquido`, `produto_composto`, `produto_foto`, `produto_status`, `produto_data_cadastro`, `produto_id`) VALUES
	('COCA COLA PET 2L', '7895373456363', 'PT', 1.00, 0.00, '', 'PET 2L', '1.1', 26.94, 15.07, 31.00, 3.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', '6e2b0b0ededced7c1aa499cc8ce72261.jpg', 1, '2014-08-26 11:55:36', 1),
	('SCHIN COLA PET 2L', '7896608437912', 'PT', 1.00, 0.00, '', 'PET 2L', '1.11', 17.50, 20.00, 21.00, 3.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-18 16:09:05', 3),
	('SCHIN LAR PET 2L', '7896921820778', 'PT', 1.00, 0.00, '', 'PET 2L', '1.12', 15.55, 22.19, 19.00, 3.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-12 09:15:09', 4),
	('SCHIN GUAR. PET 2L', '7894783790461', 'PT', 1.00, 0.00, '', 'PET 2L', '1.14', 15.55, 22.19, 19.00, 3.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-12 09:14:55', 5),
	('FREVO COLA PET 2L', '7893153490279', 'PT', 1.00, 0.00, '', 'PET 2L', '1.16', 11.00, 25.45, 13.80, 10.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-03-04 14:17:41', 7),
	('FREVO LAR. PET 2L', '7891416080317', 'PT', 1.00, 0.00, '', 'PET 2L', '1.17', 10.00, 20.00, 12.00, 4.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-09 08:37:17', 8),
	('FREVO GUAR.PET 2L', '7897619931053', 'PT', 1.00, 0.00, '', 'PET 2L', '1.18', 10.00, 20.00, 12.00, 4.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-09 08:37:32', 9),
	('FREVO LIMAO PET 2L', '7893851414625', 'PT', 1.00, 0.00, '', 'PET 2L', '1.19', 8.00, 18.75, 9.50, 10.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-09-12 18:32:10', 10),
	('PEPSE COLA PET 2L', '7896397280271', 'PT', 1.00, 0.00, '', 'PET 2L', '1.22', 23.50, 17.02, 27.50, 10.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-07 11:23:06', 13),
	('PEPSE TWIST PET 2L', '789432157788', 'PT', 1.00, 0.00, '', 'PET 2L', '1.23', 20.50, 34.15, 27.50, 10.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-07 11:22:47', 14),
	('GUAR.ANTARC. PET 2L', '7892968948431', 'PT', 1.00, 0.00, '', 'PET 2L', '1.25', 23.50, 17.02, 27.50, 0.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 14:42:09', 16),
	('GUAR. ANTARC. ZERO PET 2L', '7893548269099', 'PT', 1.00, 0.00, '', 'PET 2L', '1.26', 23.50, 17.02, 27.50, 10.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-12 16:42:28', 17),
	('SODA ANTARC.PET 2L', '7898834500507', 'FA', 1.00, 0.00, '', 'PET 2L', '1.27', 18.00, 38.89, 25.00, 0.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-06 08:34:33', 18),
	('COCA COLA ZERO 2L', '7893527695550', 'FA', 1.00, 0.00, '', 'PET 2L', '1.3', 26.94, 15.07, 31.00, 3.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:55:47', 19),
	('FANTA LAR PET 2L', '7891134976532', 'PT', 1.00, 0.00, '', 'PET 2L', '1.4', 24.70, 15.67, 28.57, 4.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-02-14 18:08:00', 20),
	('FANTA UVA 2L', '7895091796318', 'FA', 1.00, 0.00, '', 'PET 2L', '1.5', 23.34, 15.68, 27.00, 4.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:56:45', 21),
	('KUAT PET 2L', '7892054052300', 'FA', 1.00, 0.00, '', 'PET 2L', '1.7', 22.90, 19.83, 27.44, 4.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-03-03 09:55:37', 23),
	('SPRITE PET 2L', '7894994872851', 'FA', 1.00, 0.00, '', 'PET 2L', '1.9', 23.34, 15.68, 27.00, 4.00, 1, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:46:02', 25),
	('COCA COLA RGB', '7898812207662', 'GRD', 1.00, 24.00, 'INDEFINIDO', 'RGB', '10.1', 16.55, 75.23, 29.00, 0.00, 10, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-06-17 14:56:11', 26),
	('KI MANIA GUAR.600ML', '7899076420068', 'CX', 1.00, 0.00, '', 'REFRIG. 600 ML', '11.15', 13.00, 34.62, 17.50, 5.00, 11, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-12 11:49:56', 27),
	('KI MANIA LARAN. 600ML', '7898945477660', 'CX', 1.00, 0.00, '', 'REFRIG. 600 ML', '11.16', 13.00, 34.62, 17.50, 5.00, 11, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-12 11:49:37', 28),
	('KI MANIA COLA 600ML', '7897498128403', 'CX', 1.00, 0.00, '', 'REFRIG. 600 ML', '11.17', 13.00, 34.62, 17.50, 5.00, 11, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-12 11:50:08', 29),
	('KI MANIA LIMAO 600ML', '789654209342', 'CX', 1.00, 0.00, '', 'REFRIG. 600 ML', '11.18', 13.00, 34.62, 17.50, 5.00, 11, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-12 11:50:20', 30),
	('VINHO CAR.600ML', '789776661804', 'GRD', 1.00, 0.00, '', 'VINHOS', '12.1', 39.89, 17.82, 47.00, 2.00, 12, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-01-20 16:16:43', 36),
	('VINHO CAR,900ML', '7891920681300', 'CX', 1.00, 0.00, '', 'VINHOS', '12.2', 44.55, 9.76, 48.90, 2.00, 12, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-21 10:31:39', 37),
	('VINHO ESPERTINHO 600ML', '7897273421397', 'GRD', 1.00, 0.00, '', 'VINHOS', '12.26', 22.00, 18.18, 26.00, 10.00, 12, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2020-11-13 15:32:22', 39),
	('VINHO JURUBEBA 600 ML', '789605063393', 'GRD', 1.00, 0.00, '', 'VINHOS', '12.27', 27.00, 18.52, 32.00, 10.00, 12, 10.00, 110.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-04-07 14:20:45', 40),
	('VINHO D`OURO 600 ML', '7891205053080', 'GRD', 1.00, 0.00, '', 'VINHOS', '12.5', 23.00, 26.09, 29.00, 10.00, 12, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2012-04-02 14:58:29', 46),
	('VINHO QUENTINHO 600ML', '7894210075526', 'GRD', 1.00, 0.00, '', 'VINHOS', '12.7', 32.00, 15.63, 37.00, 0.00, 12, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-12 17:12:09', 47),
	('CONHAQUE DREHER', '7897435218699', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.1', 7.99, 31.41, 10.50, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-17 14:18:39', 48),
	('CAMPARI', '7894545867224', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.14', 24.50, 12.24, 27.50, 0.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-14 08:59:40', 49),
	('CATUABA GUARACY', '789423680331', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.15', 3.32, 29.63, 4.30, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-01-15 10:17:19', 50),
	('CATUABA DOURO', '7898480800287', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.16', 2.00, 75.00, 3.50, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-11-18 17:05:27', 51),
	('VODKA SLOVA', '7891132960750', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.17', 4.90, 42.86, 7.00, 7.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-11-12 08:42:01', 52),
	('VODKA NATASHA', '789222403194', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.18', 10.69, 21.61, 13.00, 0.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-30 16:57:49', 53),
	('CONHAQUE DE ALCATRAO S.J BARR', '7897713134026', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.2', 8.00, 25.00, 10.00, 0.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-03-24 16:07:24', 54),
	('VODKA ORLOFF', '7897898460858', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.21', 18.00, 22.22, 22.00, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-02-01 11:50:29', 55),
	('RUN MONTILA C. BRANCA', '7896352902517', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.24', 13.99, 20.80, 16.90, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-17 14:20:26', 57),
	('RUN BACARDI LIMON', '7898069130320', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.27', 20.00, 20.00, 24.00, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:02', 60),
	('WHISKY TEACHER´S', '7891286944358', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.33', 31.00, 19.35, 37.00, 6.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-03 16:29:53', 62),
	('WHISKY OLD EIGHT', '7892227331133', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.35', 22.88, 17.57, 26.90, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-12-10 17:17:38', 63),
	('WHISKY GRAN PAR', '7897275822896', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.36', 21.96, 18.40, 26.00, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-07-01 15:13:53', 64),
	('WHISKY WALL STREET', '7899697121391', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.37', 20.41, 17.59, 24.00, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-04-08 11:55:45', 65),
	('LICOR DE MENTA DOURO', '7896658138574', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.39', 3.06, 27.45, 3.90, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2012-02-08 08:57:51', 66),
	('RUN LIMAO', '7894199329004', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.47', 12.40, 20.97, 15.00, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 69),
	('VODKA RUSSOV', '7891022229606', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.56', 3.92, 27.55, 5.00, 5.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-30 09:11:28', 70),
	('CATUABA SELVAGEM', '7892513161323', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.57', 5.00, 30.00, 6.50, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 71),
	('RUN CARTA OURO', '7899499118104', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.62', 10.90, 18.35, 12.90, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 73),
	('WHISKY JOHNNIE WALKER', '7899956106860', 'UN', 1.00, 0.00, '', 'BEBIDAS QUENTES', '13.64', 71.77, 11.19, 79.80, 10.00, 13, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-12-03 10:35:09', 75),
	('DEBITO  ANTERIOR', '7891283180297', 'UN', 1.00, 0.00, '', 'AJUSTE SISTEMA', '15.1', 1.00, 0.00, 1.00, 10.00, 15, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 79),
	('AJUSTE DE SISTEMA', '7896547581206', 'UN', 1.00, 0.00, '', 'AJUSTE SISTEMA', '15.3', 1.00, 0.00, 1.00, 10.00, 15, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 80),
	('ACORDO', '7898888365448', 'UN', 1.00, 0.00, '', 'AJUSTE SISTEMA', '15.5', 1.00, 0.00, 1.00, 10.00, 15, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 81),
	('JUROS', '7894799083933', 'UN', 1.00, 0.00, '', 'AJUSTE SISTEMA', '15.6', 1.00, 0.00, 1.00, 10.00, 15, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 82),
	('MOEDAS', '7897330323623', 'UN', 1.00, 0.00, '', 'AJUSTE SISTEMA', '15.7', 1.00, 0.00, 1.00, 10.00, 15, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 83),
	('FRETE', '7892254366626', 'UN', 1.00, 0.00, '', 'AJUSTE SISTEMA', '15.8', 1.00, 0.00, 1.00, 10.00, 15, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 84),
	('CREDITO', '7899280862565', 'UN', 1.00, 0.00, '', 'AJUSTE SISTEMA', '15.9', 1.00, 0.00, 1.00, 10.00, 15, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:03', 85),
	('COCA COLA 500ML', '7899641213258', 'PT', 1.00, 0.00, '', 'REFRIG. 500 ML', '16.1', 27.24, 13.80, 31.00, 3.00, 16, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:52:58', 86),
	('COCA COLA ZERO 500ML', '789363478904', 'PT', 1.00, 0.00, '', 'REFRIG. 500 ML', '16.3', 13.62, 22.61, 16.70, 3.00, 16, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:54:31', 87),
	('FANTA 500ML', '7892893755048', 'PT', 1.00, 0.00, '', 'REFRIG. 500 ML', '16.4', 13.62, 22.61, 16.70, 0.00, 16, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2020-11-13 14:50:56', 88),
	('KUAT 500ML', '7893378338836', 'PT', 1.00, 0.00, '', 'REFRIG. 500 ML', '16.5', 13.62, 22.61, 16.70, 0.00, 16, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:54:14', 89),
	('SPRITE 500ML', '7898210429343', 'PT', 1.00, 0.00, '', 'REFRIG. 500 ML', '16.6', 13.62, 22.61, 16.70, 0.00, 16, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:54:01', 90),
	('GUAR.ANTARC. 600 ML', '789917130515', 'PT', 1.00, 0.00, '', 'REFRIG. 500 ML', '16.7', 14.76, 14.97, 16.97, 10.00, 16, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-10-18 10:36:47', 91),
	('H20H!  LIMAO 500ML', '7899954364849', 'PT', 1.00, 0.00, '', 'AGUA MINERAL', '17.10', 19.90, 15.58, 23.00, 10.00, 17, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-10-01 09:32:04', 93),
	('AGUA SANTA CLARA 1,5L', '7897020433012', 'PT', 1.00, 0.00, '', 'AGUA MINERAL', '17.16', 5.20, 82.69, 9.50, 10.00, 17, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-11-12 15:38:42', 96),
	('ACQUARIO FRESH LIMAO', '7895239070818', 'CX', 1.00, 0.00, '', 'AGUA MINERAL', '17.20', 13.06, 15.00, 15.02, 10.00, 17, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-10-20 16:56:01', 97),
	('ACQUARIOS FRESH ABACAXI E HOR', '7895134055359', 'PT', 1.00, 0.00, '', 'ÁGUA MINERAL', '17.21', 5.00, 30.00, 6.50, 10.00, 17, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:04', 98),
	('AGUA MIN.SCHIN C/G 500ML', '7899953064648', 'PT', 1.00, 0.00, '', 'AGUA MINERAL', '17.4', 13.00, 30.77, 17.00, 10.00, 17, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-01-21 14:14:06', 101),
	('ENERG. RED BULL 250ML', '7894363157474', 'UN', 1.00, 0.00, '', 'ENERGETICO/ICE', '18.1', 4.87, 41.68, 6.90, 10.00, 18, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-08-01 11:52:42', 104),
	('PITU LATA', '7891956593732', 'GRD', 1.00, 0.00, '', 'PITU LATA/LATAO', '19.5', 25.03, 15.86, 29.00, 0.00, 19, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-10 10:49:05', 107),
	('PITU LATAO', '7896693496543', 'GRD', 1.00, 0.00, '', 'PITU LATA/LATAO', '19.6', 31.03, 17.31, 36.40, 0.00, 19, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-10 10:48:57', 108),
	('PEPSE COLA PET 1L', '7897597701827', 'PT', 1.00, 0.00, '', 'PET 1L', '2.12', 25.90, 15.83, 30.00, 10.00, 2, 5.00, 105.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-10-01 09:20:50', 110),
	('PEPSE TWIST PET 1L', '7897908019813', 'FA', 1.00, 0.00, '', 'PET 1L', '2.13', 25.90, 15.83, 30.00, 10.00, 2, 5.00, 105.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-10-01 09:21:01', 111),
	('GUAR. ANTARC.PET 1L', '7896746993891', 'FA', 1.00, 0.00, '', 'PET 1L', '2.15', 27.90, 14.70, 32.00, 0.00, 2, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-16 09:19:14', 112),
	('COCA COLA PET IL', '78910910324', 'FA', 1.00, 0.00, '', 'PET 1L', '2.4', 19.55, 17.49, 22.97, 5.00, 2, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-02-14 17:46:35', 117),
	('COCA ZERO PET 1L', '7899813570250', 'FA', 1.00, 0.00, '', 'PET 1L', '2.6', 18.30, 17.49, 21.50, 5.00, 2, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:52:30', 118),
	('FANTA PET 1L', '7899035120587', 'FA', 1.00, 0.00, '', 'PET 1L', '2.7', 15.75, 21.02, 19.06, 0.00, 2, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-03-03 09:52:24', 119),
	('KUAT PET 1L', '7895734892493', 'FA', 1.00, 0.00, '', 'PET 1L', '2.8', 15.75, 21.02, 19.06, 0.00, 2, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-03-03 09:53:16', 120),
	('SPRITE PET 1L', '7891569101012', 'FA', 1.00, 0.00, '', 'PET 1L', '2.9', 15.72, 20.99, 19.02, 0.00, 2, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-02-14 18:12:33', 121),
	('COCA COLA LATA 350ML', '789640827885', 'GRD', 1.00, 0.00, 'INDEFINIDO', 'LATA 350 ML', '3.1', 20.22, 15.28, 23.31, 4.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-02-10 17:24:19', 212),
	('SPRITE LATA 350ML', '7898496836693', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.10', 18.00, 19.44, 21.50, 2.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:47:31', 213),
	('SUKITA LATA 350 ML', '789561700120', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.16', 14.80, 14.19, 16.90, 10.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2012-08-27 15:09:26', 216),
	('GUARANA ANTARCTCA  LATA 350ML', '7897317990826', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.17', 17.90, 17.32, 21.00, 5.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-07 11:26:26', 217),
	('SODA ANTARCTICA LATA 350ML', '7894904854079', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.18', 16.90, 12.43, 19.00, 10.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-12-26 18:03:27', 218),
	('TONICA  ANTARCTICA LATA 350ML', '7892570298224', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.19', 19.00, 15.79, 22.00, 10.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-22 16:19:29', 219),
	('GUARANA ANTARC. ZERO LATA 350', '7898136929188', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.20', 16.90, 12.43, 19.00, 10.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-10-03 17:36:58', 220),
	('COCA COLA ZERO LATA 350ML', '7892973751578', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.3', 19.08, 15.30, 22.00, 4.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-26 11:50:03', 223),
	('FANTA LATA 350ML', '789457970632', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.4', 19.25, 19.43, 22.99, 2.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'baf77cc78ee1e112e53f06d13dafeb16.jpg', 1, '2020-11-15 10:08:43', 224),
	('FANTA UVA LATA 350ML', '7893368598729', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.6', 17.08, 20.02, 20.50, 2.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-07-22 16:29:10', 226),
	('KUAT LATA 350ML', '7895469082059', 'PT', 1.00, 0.00, '', 'LATA 350 ML', '3.8', 17.04, 20.31, 20.50, 4.00, 3, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-03 08:27:16', 227),
	('SCHIN LATAO', '7897239614415', 'GRD', 1.00, 0.00, 'INDEFINIDO', 'CERVEJA LATA', '4.10', 23.00, 17.39, 27.00, 4.00, 4, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-29 11:14:41', 229),
	('SKOL LATAO 473ML', '7899790826207', 'CX', 1.00, 0.00, '', 'CERVEJA LATA', '4.11', 25.90, 19.31, 30.90, 3.00, 4, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-18 16:33:54', 230),
	('SKOL LATA 355ML', '7897235288096', 'GRD', 1.00, 0.00, '', 'CERVEJA LATA', '4.2', 18.90, 21.69, 23.00, 0.00, 4, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-18 16:33:20', 236),
	('SCHIN LATA 355 ML', '7896803962167', 'FA', 1.00, 0.00, '', 'CERVEJA LATA', '4.22', 18.00, 16.67, 21.00, 5.00, 4, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-03-04 19:28:51', 238),
	('CACHACA D`OURO 600ML', '7892313946852', 'GRD', 1.00, 0.00, '', 'CACHACA', '5.3', 25.00, 16.00, 29.00, 4.00, 5, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-07-22 16:42:59', 239),
	('CACHACA PITU 600ML', '7891157848064', 'GRD', 1.00, 0.00, '', 'CACHACA', '5.4', 56.25, 7.56, 60.50, 2.00, 5, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-12 14:54:50', 240),
	('PITU LITRO (UN)', '7898847400070', 'UN', 1.00, 0.00, '', 'CACHACA', '5.6', 3.55, 18.31, 4.20, 4.00, 5, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-12 14:44:24', 241),
	('CANINHA DO INTERIOR 600ML', '789763456469', 'GRD', 1.00, 0.00, '', 'CACHACA', '5.8', 26.70, 18.73, 31.70, 5.00, 5, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-08-18 16:47:40', 242),
	('CERV.SCHINCARIOL 600ML', '7897275082439', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.1', 72.50, 11.72, 81.00, 2.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-29 09:16:51', 244),
	('CERV. BRAHMA 600ML', '7894085043096', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.10', 66.60, 11.11, 74.00, 5.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-18 16:53:07', 245),
	('CERV. BOHEMIA 600ML', '7898599968468', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.12', 91.50, 8.20, 99.00, 10.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-18 16:56:05', 246),
	('SKOL 1 LITRO', '789744713360', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.15', 50.90, 12.97, 57.50, 3.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-05 11:04:43', 248),
	('CER. SCHINCARIOL 1LITRO', '7897923661702', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.18', 44.30, 15.12, 51.00, 6.20, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-26 09:02:15', 249),
	('BOSSA NOVA 600ML', '7897384168736', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.19', 29.00, 20.69, 35.00, 10.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-03-16 16:20:51', 250),
	('BRAHMA 1L', '7893149858884', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.21', 44.30, 17.16, 51.90, 5.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-18 16:54:10', 252),
	('CERV. ESCURA SAO DOMINGOS 340', '7893596788518', 'CX', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.24', 28.00, 17.86, 33.00, 10.00, 6, 5.00, 105.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-08-24 19:07:12', 255),
	('CERV. GLACIAL 600ML', '7898534366245', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.3', 48.00, 12.50, 54.00, 10.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-09-27 09:48:42', 257),
	('CERV. ANTARCTICA 600ML', '7891881465980', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.4', 66.60, 11.11, 74.00, 10.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-18 16:54:34', 258),
	('CERV.SKOL 600ML', '7893804231467', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.5', 90.00, 7.78, 97.00, 2.00, 6, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-09-05 11:03:17', 259),
	('CERV. FREVO 600ML', '7893376759704', 'GRD', 1.00, 0.00, '', 'CERVEJA GARRAFA', '6.7', 29.00, 20.69, 35.00, 10.00, 6, 5.00, 105.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-09-10 14:41:57', 261),
	('BOHEMIA LONG NECK 355ML', '7895471104426', 'CX', 1.00, 0.00, '', 'CERVEJA LONG NECK', '7.6', 40.20, 11.69, 44.90, 10.00, 7, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-12-06 16:23:33', 262),
	('ACE LONG NECK 355ML', '7897225243326', 'PT', 1.00, 0.00, '', 'CERVEJA LONG NECK', '7.7', 17.16, 22.38, 21.00, 10.00, 7, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-01-27 10:29:19', 263),
	('FREVINHO GUAR. 250ML', '7899712903658', 'PT', 1.00, 0.00, '', 'ENERGIL/KAPO/SKINKA', '8.1', 6.90, 23.19, 8.50, 0.00, 8, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-03-20 15:16:08', 264),
	('SUCO SKINKA FRUTAS CITRICAS 4', '7896888788619', 'PT', 1.00, 0.00, '', 'ENERGIL/KAPO/SKINKA', '8.13', 17.18, 19.32, 20.50, 0.00, 8, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-12-18 16:10:58', 265),
	('INDAIA  LAR. 250 ML', '7895305232430', 'PT', 1.00, 0.00, '', 'ENERGIL/KAPO/SKINKA', '8.24', 6.25, 54.40, 9.65, 0.00, 8, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-22 16:49:18', 270),
	('INDAIA GUAR. 250,ML', '7895859796597', 'PT', 1.00, 0.00, '', 'ENERGIL/KAPO/SKINKA', '8.25', 6.25, 54.40, 9.65, 0.00, 8, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-22 16:49:03', 271),
	('INDAIA COLA 250ML', '7893383286003', 'PT', 1.00, 0.00, '', 'ENERGIL/KAPO/SKINKA', '8.27', 6.25, 54.40, 9.65, 0.00, 8, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-22 16:49:31', 273),
	('FREVINHO LAR. 250ML', '7899337040530', 'PT', 1.00, 0.00, '', 'ENERGIL/KAPO/SKINKA', '8.4', 6.90, 23.19, 8.50, 0.00, 8, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-03-20 15:16:15', 276),
	('GUARANA ANTARC.CACOLINHA 237', '7896535344950', 'PT', 1.00, 0.00, '', 'ENERGIL/KAPO/SKINKA', '8.54', 10.90, 19.27, 13.00, 0.00, 8, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-11-05 10:20:37', 290),
	('COCA COLA KS 290ML', '7894665603466', 'GRD', 1.00, 0.00, '', 'REFRIG. KS', '9.1', 44.00, 12.34, 49.43, 2.00, 9, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-02-14 17:50:06', 294),
	('SODA ANTARC.KS', '7893721982785', 'GRD', 1.00, 0.00, '', 'REFRIG. KS', '9.11', 30.00, 15.37, 34.61, 0.00, 9, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-03-04 10:02:38', 295),
	('TONICA ANTARC.KS', '7894613103834', 'GRD', 1.00, 0.00, '', 'REFRIG. KS', '9.12', 26.00, 15.38, 30.00, 0.00, 9, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-10-17 16:25:00', 296),
	('GUARANA ANTARC. KS', '7891899571123', 'CX', 1.00, 0.00, '', 'REFRIG. KS', '9.13', 30.00, 15.37, 34.61, 0.00, 9, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2015-03-04 10:01:50', 297),
	('FANTA KS', '7895658544419', 'GRD', 1.00, 0.00, '', 'REFRIG. KS', '9.4', 35.52, 12.33, 39.90, 2.00, 9, 1.00, 101.00, 'N', 0.00, 0.00, 'N', 'e3141e650a483e499a404f0e0d39d501.jpg', 1, '2014-08-26 16:18:57', 300),
	('AGUA SANTA CLARA 500L', '7892594009036', 'PT', 12.00, 0.00, 'SANTA CLARA', 'AGUA MINERAL', '17.23', 4.70, 38.30, 6.50, 10.00, 17, 0.00, 0.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-04-17 16:18:35', 317),
	('AGUA FREVO 500ML S/GAS', '7895994412225', 'PT', 1.00, 1.00, 'INDEFINIDO', 'AGUA MINERAL', '17.24', 4.00, 50.00, 6.00, 10.00, 17, 2.00, 200.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2020-10-18 20:29:05', 326),
	('NEGOCIACAO DE DEBITO', '7892190034327', 'DB', 1.00, 1.00, 'INDEFINIDO', 'AJUSTE SISTEMA', '15.10', 1.00, 0.00, 1.00, 10.00, 15, 1.00, 10000.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2011-09-28 09:53:44', 327),
	('ENER.POWER BULL 1L', '7892966935266', 'UN', 1.00, 0.00, 'INDEFINIDO', 'ENERGETICO/ICE', '18.4', 5.98, 30.36, 7.80, 0.00, 18, 0.00, 0.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2014-03-25 10:49:27', 333),
	('SIDRA CERESER CX.C/12', '7898264573653', 'CX', 1.00, 12.00, 'INDEFINIDO', 'BEBIDAS QUENTES', '13.67', 5.25, 23.81, 6.50, 10.00, 13, 0.00, 0.00, 'N', 0.00, 0.00, 'N', 'produto.png', 1, '2013-12-16 15:32:31', 339),
	('CERV.PROIBIDA 600ML', '7892422062776', 'GR', 1.00, 24.00, 'INDEFINIDO', 'CERVEJA GARRAFA', '6.26', 42.00, 16.43, 48.90, 10.00, 6, 2.00, 200.00, 'N', 0.00, 0.00, 'N', 'b166f25d635e927f2abcbb0e2846e635.jpg', 1, '2012-04-02 15:40:18', 340),
	('GUARDANAPO 14*14 LEVE', '7897316593228', 'UN', 1.00, 20.00, 'INDEFINIDO', 'DIVERSOS', '22.28', 12.42, 19.97, 14.90, 10.00, 22, 1.00, 10.00, 'N', 0.00, 0.00, 'N', 'c974134d801d8fa6450c3ac88f22a7be.jpg', 1, '2012-01-30 14:22:33', 353),
	('GUARDANAPO 22*22 LEVE', '7899316778117', 'UN', 1.00, 1.00, 'INDEFINIDO', 'DIVERSOS', '22.29', 23.53, 20.02, 28.24, 10.00, 22, 1.00, 10.00, 'S', 1.50, 1.20, 'S', '45fcb01f065ccf2150ad5cebb9c21426.jpg', 1, '2020-11-15 07:49:16', 354),
	('REFRIGERANTE FANTA LARANJA 2L', '7894900411515', 'UN', 0.00, 0.00, 'COCA COLA COMPANY', 'REFRIG. 2 LT', '27.5', 0.00, 0.00, 0.00, 0.00, 2727, 0.00, 0.00, '', 0.00, 0.00, 'N', '7894900411515.jpg', 1, '2020-11-24 11:15:37', 355),
	('AGUA MINERAL NATURAL SEM GAS ', '7894900530001', 'UN', 0.00, 0.00, 'THE COCA COLA COMPANY', 'REFRIG. 2 LT', '27.5', 0.00, 0.00, 0.00, 0.00, 2727, 0.00, 0.00, '', 0.00, 0.00, 'N', '7894900530001.jpg', 1, '2020-11-24 12:34:47', 356),
	('COCA COLA', '7894900019254', 'UN', 0.00, 0.00, 'THE COCA-COLA COMPANY', 'REFRIG. KS', '9.5', 0.00, 0.00, 0.00, 0.00, 99, 0.00, 0.00, '', 0.00, 0.00, 'N', '7894900019254.jpg', 1, '2020-11-24 13:31:53', 357),
	('COCA-COLA', '5449000000996', 'UN', 0.00, 0.00, '', 'REFRIG. 600 ML', '11.6', 0.00, 0.00, 0.00, 0.00, 1111, 0.00, 0.00, '', 0.00, 0.00, 'N', 'products.jpg', 1, '2020-11-24 13:33:15', 358),
	('GUARANA ANTARTICA | THE BRAZI', '7898712836870', 'UN', 1.00, 1.00, 'COCA COLA COMPANY', 'REFRIG. 2 LT', '27.6', 4.50, 6.00, 4.77, 0.00, 2727, 10.00, 100.00, 'N', 0.00, 0.00, 'N', 'products.jpg', 1, '2020-11-24 16:11:22', 359),
	('REFRIGERANTE SABOR GUARANA 2L', '0678963100237', 'UN', 1.00, 1.00, 'COCA COLA COMPANY', 'REFRIG. 2 LT', '27.6', 0.00, 0.00, 0.00, 0.00, 2727, 0.00, 0.00, '', 0.00, 0.00, 'N', '678963100237.jpg', 1, '2020-11-24 16:20:20', 360),
	('REFRIGERANTE SODA LIMONADA AN', '7891991000833', 'UN', 1.00, 1.00, 'AMBEV', 'REFRIGERANTE LATA', '33.6', 3.50, 40.00, 4.90, 0.00, 3333, 10.00, 100.00, 'N', 0.00, 0.00, 'N', '7891991000833.jpg', 1, '2020-11-25 11:28:01', 361),
	('REFRIGERANTE COCA-COLA GARRAF', '7894900011517', 'UN', 1.00, 1.00, 'THE COCA-COLA COMPANY', 'REFRIG. 2 LT', '27.6', 2.33, 100.00, 4.66, 0.00, 2727, 0.00, 0.00, '', 0.00, 0.00, 'N', '0bfd44b18e0ef43bc3853f3dc4c547e4.jpg', 1, '2020-12-05 09:44:17', 362),
	('REFRIGERANTE FANTA LARANJA', '7894900031201', 'UN', 1.00, 1.00, 'THE COCA COLA COMPANY', 'REFRIGERANTE LATA', '33.6', 0.00, 0.00, 0.00, 0.00, 3333, 0.00, 0.00, '', 0.00, 0.00, 'N', '7894900031201.jpg', 1, '2020-12-05 09:45:44', 363);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.setor
DROP TABLE IF EXISTS `setor`;
CREATE TABLE IF NOT EXISTS `setor` (
  `setor_descricao` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setor_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `setor_data_cadastro` timestamp NULL DEFAULT NULL,
  `setor_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`setor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.setor: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `setor` DISABLE KEYS */;
INSERT INTO `setor` (`setor_descricao`, `setor_status`, `setor_data_cadastro`, `setor_id`) VALUES
	('SUPORTE', 1, '2016-01-07 20:05:01', 1),
	('FINANCEIRO', 1, '2016-01-07 20:04:16', 2);
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.um
DROP TABLE IF EXISTS `um`;
CREATE TABLE IF NOT EXISTS `um` (
  `um_sigla` varchar(3) NOT NULL DEFAULT '',
  `um_descricao` varchar(20) DEFAULT NULL,
  `um_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `um_data_cadastro` timestamp NULL DEFAULT NULL,
  `um_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`um_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ipage234_scw.um: ~42 rows (aproximadamente)
/*!40000 ALTER TABLE `um` DISABLE KEYS */;
INSERT INTO `um` (`um_sigla`, `um_descricao`, `um_status`, `um_data_cadastro`, `um_id`) VALUES
	('1/4', 'UM QUARTO', 1, '2010-10-04 19:38:44', 1),
	('AR', 'ARROBA', 1, '2011-04-16 18:59:39', 2),
	('BL', 'BLOCO', 1, '0000-00-00 00:00:00', 3),
	('CC', 'CENTIMETRO CUBICO', 1, '0000-00-00 00:00:00', 4),
	('CI', 'CILINDRO', 1, '0000-00-00 00:00:00', 5),
	('CJ', 'CONJUNTO', 1, '0000-00-00 00:00:00', 6),
	('CM', 'CENTIMETRO', 1, '0000-00-00 00:00:00', 7),
	('CT', 'CENTENA', 1, '0000-00-00 00:00:00', 8),
	('CX', 'CAIXA', 1, '2011-07-12 06:41:25', 9),
	('DM', 'DECIMETRO', 1, '0000-00-00 00:00:00', 10),
	('DZ', 'DUZIA', 1, '0000-00-00 00:00:00', 11),
	('EN', 'ENVELOPE', 1, '0000-00-00 00:00:00', 12),
	('FA', 'FARDO', 1, '0000-00-00 00:00:00', 13),
	('FL', 'FOLHA', 1, '0000-00-00 00:00:00', 14),
	('FT', 'PES', 1, '0000-00-00 00:00:00', 15),
	('G', 'GRAMA', 1, '0000-00-00 00:00:00', 16),
	('GL', 'GALAO', 1, '0000-00-00 00:00:00', 17),
	('GZ', 'GROZA', 1, '0000-00-00 00:00:00', 18),
	('HR', 'HORA', 1, '2020-11-11 11:13:39', 19),
	('JG', 'JOGO', 1, '0000-00-00 00:00:00', 20),
	('KG', 'QUILOGRAMA', 1, '0000-00-00 00:00:00', 21),
	('L', 'LITRO', 1, '0000-00-00 00:00:00', 22),
	('LA', 'LATA', 1, '0000-00-00 00:00:00', 23),
	('LB', 'LIBRA', 1, '0000-00-00 00:00:00', 24),
	('M', 'METRO', 1, '0000-00-00 00:00:00', 25),
	('M2', 'METRO QUADRADO', 1, '0000-00-00 00:00:00', 26),
	('M3', 'METRO CUBICO', 1, '0000-00-00 00:00:00', 27),
	('MI', 'MILHAR', 1, '0000-00-00 00:00:00', 28),
	('ML', 'MILILITRO', 1, '0000-00-00 00:00:00', 29),
	('MM', 'MILIMETRO', 1, '0000-00-00 00:00:00', 30),
	('MT', 'METRO', 1, '0000-00-00 00:00:00', 31),
	('OZ', 'ONCA', 1, '0000-00-00 00:00:00', 32),
	('P', 'PAR', 1, '0000-00-00 00:00:00', 33),
	('PA', 'PAR', 1, '0000-00-00 00:00:00', 34),
	('PC', 'PECA', 1, '0000-00-00 00:00:00', 35),
	('PL', 'POLEGADAS', 1, '0000-00-00 00:00:00', 36),
	('PT', 'PACOTE', 1, '0000-00-00 00:00:00', 37),
	('SC', 'SACO', 1, '0000-00-00 00:00:00', 38),
	('TL', 'TONELADA LIQUIDA', 1, '0000-00-00 00:00:00', 39),
	('UN', 'UNIDADE', 1, '0000-00-00 00:00:00', 40),
	('YD', 'JARDA', 1, '2020-11-11 11:13:46', 41);
/*!40000 ALTER TABLE `um` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_login` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `user_password` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `user_nivel` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A' COMMENT 'A - ADMINISTRADOR, O - OPERACIONAL, C - COMUM',
  `user_email` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `user_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 INATIVO',
  `user_foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'foto.png',
  `user_data_cadastro` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.user: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_login`, `user_password`, `user_nivel`, `user_email`, `user_status`, `user_foto`, `user_data_cadastro`, `user_id`) VALUES
	('Diogenes Dias', '02b484c723fb8d741fa5c7c32b659ac5', 'A', 'diogenesdias@hotmail.com', 1, '64d88b79b6d4c5a9ac1e9b2bc7b66ae0.jpg', '2016-01-31 12:12:47', 1),
	('Admin', 'e5a9ea31112758d9d48ecfb8b335bcd8', 'A', 'curso@ipage.com.br', 1, '96704e93e67e4678d8479b3c7d2c361b.jpg', '2016-02-01 18:43:26', 2),
	('Marcos Paulo', 'e5a9ea31112758d9d48ecfb8b335bcd8', 'C', 'programador_marcosp@hotmail.com', 1, '6cefb0c12f63c4b515816ba34c3255e4.jpg', '2020-11-15 07:50:23', 3),
	('Maria Florzinha', 'e5a9ea31112758d9d48ecfb8b335bcd8', 'A', 'maria@flozirnha.com.br', 1, 'foto.png', '2020-10-17 14:29:40', 5);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.users_vendedor
DROP TABLE IF EXISTS `users_vendedor`;
CREATE TABLE IF NOT EXISTS `users_vendedor` (
  `user_id` int(11) DEFAULT NULL,
  `vendedor_id` int(11) DEFAULT NULL,
  `user_vendedor_data_cadastro` timestamp NULL DEFAULT NULL,
  `user_vendedor_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_vendedor_id`),
  KEY `FK_users_vendedor_users` (`user_id`),
  KEY `FK_users_vendedor_vendedor` (`vendedor_id`),
  CONSTRAINT `FK_users_vendedor_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_vendedor_vendedor` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedor` (`vendedor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.users_vendedor: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `users_vendedor` DISABLE KEYS */;
INSERT INTO `users_vendedor` (`user_id`, `vendedor_id`, `user_vendedor_data_cadastro`, `user_vendedor_id`) VALUES
	(1, 1, '2020-10-16 21:27:30', 11),
	(1, 4, '2020-10-16 21:27:30', 12),
	(2, 3, '2020-10-28 01:38:31', 15),
	(3, 2, '2020-11-20 09:56:51', 16),
	(3, 6, '2020-11-20 09:56:51', 17),
	(5, 1, '2020-11-29 10:16:57', 19),
	(5, 3, '2020-11-29 10:16:57', 20);
/*!40000 ALTER TABLE `users_vendedor` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.vendedor
DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE IF NOT EXISTS `vendedor` (
  `vendedor_nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_pessoa` char(1) COLLATE utf8_unicode_ci DEFAULT 'J' COMMENT 'J = JURÍDICA, F =- FISICA',
  `vendedor_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_cep` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_endereco` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_bairro` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_cidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_uf` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_cpf` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_rg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_razao_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_cnpj` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_insc_est` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_insc_mun` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_fone1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_celular1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_contato1` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_fone2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_celular2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_contato2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_fone3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_celular3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_contato3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_fone4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_celular4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_contato4` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_status` int(10) DEFAULT 1 COMMENT '1 - ATIVO, 0 - INATIVO',
  `vendedor_obs` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendedor_data_cadastro` timestamp NULL DEFAULT NULL,
  `vendedor_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`vendedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.vendedor: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `vendedor` DISABLE KEYS */;
INSERT INTO `vendedor` (`vendedor_nome`, `vendedor_pessoa`, `vendedor_email`, `vendedor_cep`, `vendedor_endereco`, `vendedor_complemento`, `vendedor_bairro`, `vendedor_cidade`, `vendedor_uf`, `vendedor_cpf`, `vendedor_rg`, `vendedor_razao_social`, `vendedor_cnpj`, `vendedor_insc_est`, `vendedor_insc_mun`, `vendedor_fone1`, `vendedor_celular1`, `vendedor_contato1`, `vendedor_fone2`, `vendedor_celular2`, `vendedor_contato2`, `vendedor_fone3`, `vendedor_celular3`, `vendedor_contato3`, `vendedor_fone4`, `vendedor_celular4`, `vendedor_contato4`, `vendedor_status`, `vendedor_obs`, `vendedor_data_cadastro`, `vendedor_id`) VALUES
	('DIOGENES DIAS DE SOUZA JUNIOR', 'F', 'diogenesdias@hotmail.com', '54360-080', 'RUA FORTE DAS CINCO PONTAS', '', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '521.384.454-53', '3192101 SDS-PE', '', '', '', '', '', '(81) 98615-2352', 'DIOGENES', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-13 12:58:32', 1),
	('EDMUNDO', 'F', '', '54360-030', 'RUA SEBASTIAO DO SOUTO', '', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-13 12:58:14', 2),
	('PATRICIA', 'J', '', '54360-010', 'RUA DOMINGOS FERNANDES', '', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '', '', 'CARA PALIDA LTDA', '20.479.056/0001-88', '12313132132123123', '12313', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-13 12:58:01', 3),
	('JOSE MARIA', 'F', 'josemaria@hotmail.com', '50870-050', 'RUA FREI MANUEL CALADO', '', 'AREIAS', 'RECIFE', 'PE', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-19 20:36:35', 4),
	('JOSE JORGE', 'F', 'josejorge@gmail.com', '54360-080', 'RUA FORTE DAS CINCO PONTAS', '', 'MARCOS FREIRE', 'JABOATAO DOS GUARARAPES', 'PE', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '2020-11-20 00:28:44', 6);
/*!40000 ALTER TABLE `vendedor` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw.vendedor_cliente
DROP TABLE IF EXISTS `vendedor_cliente`;
CREATE TABLE IF NOT EXISTS `vendedor_cliente` (
  `vendedor_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `vendedor_cliente_data_cadastro` timestamp NULL DEFAULT NULL,
  `vendedor_cliente_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`vendedor_cliente_id`),
  KEY `FK_vendedor_cliente_vendedor` (`vendedor_id`),
  KEY `FK_vendedor_cliente_cliente` (`cliente_id`),
  CONSTRAINT `FK_vendedor_cliente_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_vendedor_cliente_vendedor` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedor` (`vendedor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw.vendedor_cliente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `vendedor_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendedor_cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela ipage234_scw._user_permissions
DROP TABLE IF EXISTS `_user_permissions`;
CREATE TABLE IF NOT EXISTS `_user_permissions` (
  `user_id` int(11) DEFAULT 0,
  `table_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `inserir` int(1) NOT NULL DEFAULT 0,
  `editar` int(1) NOT NULL DEFAULT 0,
  `excluir` int(1) NOT NULL DEFAULT 0,
  `imprimir` int(1) NOT NULL DEFAULT 0,
  `negar` int(1) NOT NULL DEFAULT 0,
  `data_cadastro` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `user_permi` (`user_id`),
  CONSTRAINT `FK__user_permissions_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1425 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela ipage234_scw._user_permissions: ~114 rows (aproximadamente)
/*!40000 ALTER TABLE `_user_permissions` DISABLE KEYS */;
INSERT INTO `_user_permissions` (`user_id`, `table_name`, `inserir`, `editar`, `excluir`, `imprimir`, `negar`, `data_cadastro`, `id`) VALUES
	(3, '__cliente__', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 892),
	(3, '__contas_pagar__', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 893),
	(3, '__fornecedor__', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 894),
	(3, '__produto__', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 895),
	(3, '__produto_financeiro__', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 896),
	(3, '__produto_fisico__', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 897),
	(3, '_user_permissions', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 898),
	(3, 'banco', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 899),
	(3, 'cartao_credito', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 900),
	(3, 'cheque', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 901),
	(3, 'cliente', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 902),
	(3, 'contas_pagar', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 903),
	(3, 'contas_receber', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 904),
	(3, 'departamento', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 905),
	(3, 'empresa', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 906),
	(3, 'estoque', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 907),
	(3, 'estoque_log', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 908),
	(3, 'fabricante', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 909),
	(3, 'formas_pagamento', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 910),
	(3, 'fornecedor', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 911),
	(3, 'grupo', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 912),
	(3, 'plano_contas', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 913),
	(3, 'procedencia', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 914),
	(3, 'procedencia_users', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 915),
	(3, 'produto', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 916),
	(3, 'recibo', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 917),
	(3, 'setor', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 918),
	(3, 'um', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 919),
	(3, 'users', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 920),
	(3, 'users_vendedor', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 921),
	(3, 'vendedor', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 922),
	(3, 'vendedor_cliente', 1, 1, 1, 1, 1, '2016-04-19 19:36:20', 923),
	(5, '__cliente__', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1052),
	(5, '__contas_pagar__', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1053),
	(5, '__fornecedor__', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1054),
	(5, '__produto__', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1055),
	(5, '__produto_financeiro__', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1056),
	(5, '__produto_fisico__', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1057),
	(5, '_user_permissions', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1058),
	(5, 'banco', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1059),
	(5, 'cartao_credito', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1060),
	(5, 'cheque', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1061),
	(5, 'cliente', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1062),
	(5, 'contas_pagar', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1063),
	(5, 'contas_receber', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1064),
	(5, 'departamento', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1065),
	(5, 'empresa', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1066),
	(5, 'estoque', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1067),
	(5, 'estoque_log', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1068),
	(5, 'fabricante', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1069),
	(5, 'formas_pagamento', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1070),
	(5, 'fornecedor', 1, 1, 1, 1, 1, '2020-10-17 14:29:40', 1071),
	(5, 'grupo', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1072),
	(5, 'plano_contas', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1073),
	(5, 'procedencia', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1074),
	(5, 'procedencia_users', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1075),
	(5, 'produto', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1076),
	(5, 'recibo', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1077),
	(5, 'setor', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1078),
	(5, 'um', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1079),
	(5, 'users', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1080),
	(5, 'users_vendedor', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1081),
	(5, 'vendedor', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1082),
	(5, 'vendedor_cliente', 1, 1, 1, 1, 1, '2020-10-17 14:29:41', 1083),
	(1, '_user_permissions', 1, 1, 1, 1, 1, '2020-10-26 09:46:03', 1084),
	(1, 'banco', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1085),
	(1, 'cartao_credito', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1086),
	(1, 'cheque', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1087),
	(1, 'cliente', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1088),
	(1, 'contas_pagar', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1089),
	(1, 'contas_receber', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1090),
	(1, 'departamento', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1091),
	(1, 'empresa', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1092),
	(1, 'estoque', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1093),
	(1, 'estoque_log', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1094),
	(1, 'fabricante', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1095),
	(1, 'formas_pagamento', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1096),
	(1, 'fornecedor', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1097),
	(1, 'grupo', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1098),
	(1, 'plano_contas', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1099),
	(1, 'procedencia', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1100),
	(1, 'procedencia_users', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1101),
	(1, 'produto', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1102),
	(1, 'recibo', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1103),
	(1, 'setor', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1104),
	(1, 'um', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1105),
	(1, 'user', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1106),
	(1, 'users_vendedor', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1107),
	(1, 'vendedor', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1108),
	(1, 'vendedor_cliente', 1, 1, 1, 1, 1, '2020-10-26 09:46:04', 1109),
	(2, '_user_permissions', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1401),
	(2, 'banco', 1, 1, 1, 1, 1, '2020-11-20 22:16:16', 1402),
	(2, 'cartao_credito', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1403),
	(2, 'cliente', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1404),
	(2, 'contas_pagar', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1405),
	(2, 'contas_receber', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1406),
	(2, 'empresa', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1407),
	(2, 'estoque', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1408),
	(2, 'estoque_log', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1409),
	(2, 'fabricante', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1410),
	(2, 'formas_pagamento', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1411),
	(2, 'fornecedor', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1412),
	(2, 'grupo', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1413),
	(2, 'plano_contas', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1414),
	(2, 'procedencia', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1415),
	(2, 'procedencia_users', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1416),
	(2, 'produto', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1417),
	(2, 'recibo', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1418),
	(2, 'setor', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1419),
	(2, 'um', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1420),
	(2, 'user', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1421),
	(2, 'users_vendedor', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1422),
	(2, 'vendedor', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1423),
	(2, 'vendedor_cliente', 1, 1, 1, 1, 1, '2020-11-20 20:53:17', 1424);
/*!40000 ALTER TABLE `_user_permissions` ENABLE KEYS */;

-- Copiando estrutura para função ipage234_scw.fn_remove_accents
DROP FUNCTION IF EXISTS `fn_remove_accents`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_remove_accents`(textvalue VARCHAR(10000) ) RETURNS varchar(10000) CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN

    SET @textvalue = textvalue;

    -- ACCENTS
    SET @withaccents = 'ŠšŽžÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜÝŸÞàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿþƒ';
    SET @withoutaccents = 'SsZzAAAAAAACEEEEIIIINOOOOOOUUUUYYBaaaaaaaceeeeiiiinoooooouuuuyybf';
    SET @count = LENGTH(@withaccents);

    WHILE @count > 0 DO
        SET @textvalue = REPLACE(@textvalue, SUBSTRING(@withaccents, @count, 1), SUBSTRING(@withoutaccents, @count, 1));
        SET @count = @count - 1;
    END WHILE;

    SET @special = '!@#$%¨&*()_+=§¹²³£¢¬"`´{[^~}]<,>.:;?/°ºª+*|\\''';
    SET @count = LENGTH(@special);

    WHILE @count > 0 do
        SET @textvalue = REPLACE(@textvalue, SUBSTRING(@special, @count, 1), '');
        SET @count = @count - 1;
    END WHILE;

    RETURN @textvalue;

END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
