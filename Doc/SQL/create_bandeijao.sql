delimiter $$

CREATE TABLE `historico` (
  `id_historico` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id_historico`),
  UNIQUE KEY `data_UNIQUE` (`data`),
  KEY `id_restaurante_idx` (`id_restaurante`),
  CONSTRAINT `id_restaurante` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurante` (`id_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_pessoa`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

CREATE TABLE `presenca` (
  `id_historico` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`id_historico`,`id_pessoa`),
  KEY `id_historico_idx` (`id_historico`),
  KEY `id_pessoa_idx` (`id_pessoa`),
  CONSTRAINT `id_historico` FOREIGN KEY (`id_historico`) REFERENCES `historico` (`id_historico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

CREATE TABLE `restaurante` (
  `id_restaurante` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `prioridade` int(3) NOT NULL,
  `coberto` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_restaurante`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$


