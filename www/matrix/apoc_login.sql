CREATE TABLE IF NOT EXISTS `contas` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(255) NOT NULL,
  	`nivel` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `contas` (`id`, `username`, `password`, `nivel`) VALUES (1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', '1');



CREATE TABLE `funcionario`
(
 `id_func`   int NOT NULL AUTO_INCREMENT,
 `nome_func` varchar(45) NOT NULL ,
 `status` int NOT NULL ,
 `agenda` int NOT NULL ,

PRIMARY KEY (`id_func`)
);


CREATE TABLE `clientes`
(
 `id_cli`   int NOT NULL AUTO_INCREMENT,
 `nome_cli` varchar(45) NOT NULL ,
 `cpf_cli`  varchar(45) NULL ,
 `end_cli`  varchar(45) NOT NULL ,
 `num_cli`  varchar(45) NULL ,
 `cid_cli`  varchar(45) NOT NULL ,
 `tel_cli`  varchar(45) NOT NULL ,
 `tel2_cli` varchar(45) NULL ,
 `obs_cli`  varchar(45) NULL ,
 `contato_cli`  varchar(45) NULL ,
 `bairro_cli`  varchar(45) NULL ,


PRIMARY KEY (`id_cli`)
);


CREATE TABLE `tipo_servico`
(
 `id_serv`        int NOT NULL AUTO_INCREMENT,
 `descricao_serv` varchar(45) NOT NULL ,

PRIMARY KEY (`id_serv`)
);


CREATE TABLE `status`
(
 `id_status`   int NOT NULL AUTO_INCREMENT,
 `nome_status` varchar(45) NOT NULL ,

PRIMARY KEY (`id_status`)
);

CREATE TABLE `cidade`
(
 `id_cidade`   int NOT NULL AUTO_INCREMENT,
 `nome_cidade` varchar(45) NOT NULL ,

PRIMARY KEY (`id_cidade`)
);

CREATE TABLE `ordem_serv`
(
 `id_os`     int NOT NULL AUTO_INCREMENT ,
 `id_cli`    int NOT NULL ,
 `id_obra`   int NULL ,
 `id_func`   int NULL ,
 `id_serv`   int NOT NULL ,
 `id_status` int NOT NULL ,
 `data_os` date NOT NULL ,
 `data_os_medida` date NULL,
 `data_os_montagem` date  NULL,
 `data_os_instalacao` date NULL,
 `data_os_cobranca` date NULL,
 `obs_os` varchar(200) NULL,
 `valor_os` decimal(10,2) NULL ,
 `tempo_os` decimal(4,2) NULL ,
 `orcamento_os` boolean NULL ,
 `semana_os` varchar(10) NULL,
 `agendamento_os` date  NULL,
 `base_calculo_os` decimal(4,2) NULL ,
 `condicao_pagamento` INT(10) NULL,
 `nf` VARCHAR(10) NULL,
 `oc` VARCHAR(10) NULL,
 `data_fechamento` date NOT NULL,
 `obs_cobranca` varchar(200) NULL,



PRIMARY KEY (`id_os`),
KEY `fkIdx_20` (`id_cli`),
CONSTRAINT `FK_20` FOREIGN KEY `fkIdx_20` (`id_cli`) REFERENCES `clientes` (`id_cli`),
KEY `fkIdx_32` (`id_func`),
CONSTRAINT `FK_32` FOREIGN KEY `fkIdx_32` (`id_func`) REFERENCES `funcionario` (`id_func`),
KEY `fkIdx_39` (`id_serv`),
CONSTRAINT `FK_39` FOREIGN KEY `fkIdx_39` (`id_serv`) REFERENCES `tipo_servico` (`id_serv`),
KEY `fkIdx_46` (`id_status`),
CONSTRAINT `FK_46` FOREIGN KEY `fkIdx_46` (`id_status`) REFERENCES `status` (`id_status`)
);

CREATE TABLE `materiais`
(
 `id_mat`   int NOT NULL AUTO_INCREMENT,
 `nome_mat` varchar(45) NOT NULL ,
 `valor_mat` varchar(45) NOT NULL ,

PRIMARY KEY (`id_mat`)

CREATE TABLE `produtos`
(
 `id_prod`   int NOT NULL AUTO_INCREMENT,
 `nome_prod` varchar(45) NOT NULL ,
 `valor_unit_prod` decimal(10,2) NOT NULL ,
 `status_prod` int NOT NULL ,
 `cat_prod` int NOT NULL ,

PRIMARY KEY (`id_prod`)

CREATE TABLE `relacao_itens`
(
 `id_rel_itens`   int NOT NULL AUTO_INCREMENT,
 `id_prod`   int NOT NULL ,
 `quant_prod` decimal(10,2) NOT NULL ,
 `valor_unit_prod` decimal(10,2) NOT NULL ,
 `base_calculo_os` decimal(4,2) NOT NULL ,
 `valor_total_prod` decimal(10,2) NOT NULL ,
 `id_os`   int NOT NULL ,

PRIMARY KEY (`id_rel_itens`)

CREATE TABLE `relacao`
(
 `id_rel`   int NOT NULL AUTO_INCREMENT,
 `id_os`   int NOT NULL ,
 `id_rel_itens`   int NOT NULL ,
 `id_cliente`   int NOT NULL ,

PRIMARY KEY (`id_rel`)

CREATE TABLE `relacao_cobranca`
(
 `id_rel_cobranca`   int NOT NULL AUTO_INCREMENT,
 `id_os`   int NOT NULL ,
 `id_cliente`   int NOT NULL ,
 `valor_total_rel` decimal(10,2) NOT NULL ,

PRIMARY KEY (`id_rel_cobranca`)


CREATE TABLE `andaimes`
(
 `id_andaime`   int NOT NULL AUTO_INCREMENT,
 `data_solicitacao` date  NULL,
 `id_cli`     int NOT NULL ,
 `quant_andaime` decimal(10,2) NOT NULL ,
 `quant_plataforma` decimal(10,2) NOT NULL ,
 `quant_travessa` decimal(10,2) NOT NULL ,
 `quant_rodas` decimal(10,2) NOT NULL ,
 `quant_sapata` decimal(10,2) NOT NULL ,
 `quant_escada_longa` decimal(10,2) NOT NULL ,
 `quant_escada_curta` decimal(10,2) NOT NULL ,
 `frete_entrega` int NULL ,
 `frete_retorno` int NULL,
 `data_retirada` date  NULL,
 `data_retorno` date  NULL,
 `end_entrega` varchar(100) NULL,
 `status` int NULL ,
 `valor` decimal(10,2) NULL ,
 `dias_locados` int NULL ,

PRIMARY KEY (`id_andaime`)


CREATE TABLE `condicoes_pagamento`
(
 `id_cond_pag`   int NOT NULL AUTO_INCREMENT,
 `nome_cond_pag` varchar(45) NOT NULL ,

PRIMARY KEY (`id_cond_pag`)


CREATE TABLE `categoria_produto`
(
 `id_cat_prod`   int NOT NULL AUTO_INCREMENT,
 `nome_cat_prod` varchar(45) NOT NULL ,

PRIMARY KEY (`id_cat_prod`)


CREATE TABLE `configurações`
(
 `ano_vigente`   int NOT NULL,

PRIMARY KEY (`ano_vigente`)

CREATE TABLE `itens_locacoes`
(
 `id_itens_locacoes`   int NOT NULL AUTO_INCREMENT,
 `nome_itens_locacoes` varchar(45) NOT NULL ,
 `valor_itens_locacoes` decimal(10,2) NOT NULL ,
 `quantidade_itens_locacoes`   int NOT NULL,

PRIMARY KEY (`id_itens_locacoes`)

CREATE TABLE `veiculo`
(
 `id_veiculo`   int NOT NULL AUTO_INCREMENT,
 `nome_veiculo` varchar(45) NOT NULL ,
 `motorista` int NOT NULL ,
 `status_veiculo` int NOT NULL ,

PRIMARY KEY (`id_veiculo`)

CREATE TABLE `despesa_combustivel`
(
 `id_despesa`   int NOT NULL AUTO_INCREMENT,
 `data_despesa` date NOT NULL ,
 `veiculo_despesa` int NOT NULL ,
 `km_despesa` decimal(10,2) NOT NULL ,
 `litro_despesa` decimal(10,2) NOT NULL ,
 `valor_despesa` decimal(10,2) NOT NULL ,

PRIMARY KEY (`id_despesa`)

CREATE TABLE `retirada_abastecimento`
(
 `id_retirada`   int NOT NULL AUTO_INCREMENT,
 `data_retirada` date NOT NULL ,
 `motorista_retirada`   int NOT NULL,
 `valor_retirada` decimal(10,2) NOT NULL ,

PRIMARY KEY (`id_retirada`)

);

CREATE TABLE `obra_clientes`
(
 `id_obra`   int NOT NULL AUTO_INCREMENT,
 `nome_obra` varchar(45) NOT NULL ,
 `endereco_obra` varchar(200) NOT NULL ,
 `id_cli` int NOT NULL ,
PRIMARY KEY (`id_obra`)

);
















