CREATE DATABASE IF NOT EXISTS `spaceburguer`;
USE `spaceburguer`;

CREATE TABLE IF NOT EXISTS `cartao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `numero` char(16) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cvv` varchar(250) NOT NULL,
  `data_vencimento` char(6) NOT NULL,
  `tipo` char(1) NOT NULL COMMENT 'C = Crédito; D = Débito;',
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_UNIQUE` (`numero`),
  KEY `fk_id_usuario_idx` (`id_usuario`),
  CONSTRAINT `fk_cartao_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Ativo; 2 = Inativo;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `categoria` (`id`, `descricao`, `status`) VALUES
	(2, 'HambÃºrguer', 1),
	(3, 'Bebidas', 1),
	(6, 'PorÃ§Ãµes', 1);

CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nomeEndereco` varchar(60) NOT NULL,
  `cep` char(8) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_usuario_idx` (`id_usuario`),
  CONSTRAINT `fk_endereco_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `itens_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lanche` int(11) DEFAULT NULL,
  `id_pedido` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT '1',
  `valor_unitario` decimal(14,2) NOT NULL,
  `valor_total` decimal(14,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_lanche_idx` (`id_lanche`),
  KEY `fk_id_pedido_idx` (`id_pedido`),
  CONSTRAINT `fk_itensPedido_lanche` FOREIGN KEY (`id_lanche`) REFERENCES `lanche` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_itensPedido_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `lanche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `ingredientes` text NOT NULL,
  `preco` decimal(14,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Ativo; 2 = Inativo; ',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imagem` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_categoria_idx` (`id_categoria`),
  CONSTRAINT `fk_lanche_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

INSERT INTO `lanche` (`id`, `id_categoria`, `descricao`, `ingredientes`, `preco`, `status`, `created_at`, `imagem`) VALUES
	(12, 2, 'GRAVIDADE CHEDDAR', '<p>PÃ£o</p><p>HambÃºrguer;</p><p>Bacon;</p><p>Queijo;</p><p>Salada;</p><p>Bife;</p><p>Molho;</p><p>&nbsp;</p>', 25.00, 1, '2021-11-05 22:56:20', ''),
	(13, 3, 'Coca-Cola Lata 200ml', '<p>-</p>', 4.50, 1, '2021-11-05 23:06:48', ''),
	(14, 3, 'Fanta Laranja 220ml', '<p>-</p>', 4.50, 1, '2021-11-05 23:10:02', ''),
	(15, 3, 'GuaranÃ¡ Kuat 220ml', '<p>-</p>', 4.50, 1, '2021-11-05 23:11:57', ''),
	(21, 2, 'ATMOSFERA BACON', '<p>-</p>', 25.00, 1, '2021-11-16 22:01:15', ''),
	(22, 2, 'Ã“RBITA 4 QUEIJOS', '', 10.00, 1, '2021-11-17 22:46:57', ''),
	(23, 6, 'Fritas e churrasco', '', 25.00, 1, '2021-11-18 18:57:12', ''),
	(24, 3, 'Coca-Cola 2 litros ', '', 15.00, 1, '2021-11-18 18:58:13', ''),
	(25, 3, 'EnergÃ©tico Monster', '', 6.00, 1, '2021-11-18 18:59:07', ''),
	(26, 3, 'Suco Del Valle', '', 10.50, 1, '2021-11-18 18:59:55', ''),
	(27, 2, 'SMASH - VIA LACTEA', '', 23.00, 1, '2021-11-18 19:00:44', ''),
	(28, 2, 'MEGA SPACE DUPLO', '', 19.00, 1, '2021-11-18 19:01:11', ''),
	(29, 6, 'Nugget de frango', '', 13.00, 1, '2021-11-22 18:59:34', ''),
	(30, 6, 'Quibe', '', 10.00, 1, '2021-11-22 19:00:03', ''),
	(31, 6, 'Anel de Cebola', '', 9.50, 1, '2021-11-22 19:00:32', '');

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_motoboy` int(11) DEFAULT NULL,
  `id_cartao` int(11) DEFAULT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  `valor_total` decimal(14,2) DEFAULT NULL,
  `subtotal` decimal(14,2) DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'A' COMMENT '''A = Aberto; F = Finalizado; E = Entregue;''',
  `frete` decimal(14,2) DEFAULT NULL,
  `forma_pagamento` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_usuario_idx` (`id_usuario`),
  KEY `fk_pedido_endereco_idx` (`id_endereco`),
  KEY `fk_pedido_cartao_idx` (`id_cartao`),
  KEY `fk_pedido_motoboy_idx` (`id_motoboy`),
  CONSTRAINT `fk_pedido_cartao` FOREIGN KEY (`id_cartao`) REFERENCES `cartao` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_endereco` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_motoboy` FOREIGN KEY (`id_motoboy`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `nivel` int(11) NOT NULL DEFAULT '2' COMMENT '1 = Adm; 2 = Usuário; 3 = Motoboy',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Ativo; 2 = Inativo;',
  `imagem` varchar(100) DEFAULT NULL,
  `codVerificacao` char(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
