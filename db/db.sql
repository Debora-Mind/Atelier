USE u259140665_doandmake;

CREATE TABLE `faltas` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `listaDeFaltas` json NOT NULL,
                          `funcionario_id` int DEFAULT NULL,
                          PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQ_5CDFE14E642FEB76` (`funcionario_id`),
    CONSTRAINT `FK_5CDFE14E642FEB76` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionario` (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `funcao` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `descricao` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `funcionario` (
                               `id` int NOT NULL AUTO_INCREMENT,
                               `funcao_id` int DEFAULT NULL,
                               `nome` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `cpf` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `data_nascimento` date NOT NULL,
    `matricula` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
    `valor_hora` double DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_7510A3CF263E9CB2` (`funcao_id`),
    CONSTRAINT `FK_7510A3CF263E9CB2` FOREIGN KEY (`funcao_id`) REFERENCES `funcao` (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `layout` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `data` date NOT NULL,
                          PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `modelo` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `modelo` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `producao` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `sublote` int NOT NULL,
    `quantidade` int NOT NULL,
    `valor` double NOT NULL,
    `cod_barras` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `data_entrada` date NOT NULL,
    `data_saida` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `permissoes` (
                              `id` int NOT NULL AUTO_INCREMENT,
                              `nome` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `descricao` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `relacao` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `relacoes` json NOT NULL,
                           `id_layout` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `usuario` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `usuario` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `senha` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `funcionario` int DEFAULT NULL,
    `permissoes` json DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_2265B05D7510A3CF` (`funcionario`),
    CONSTRAINT `FK_2265B05D7510A3CF` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
