CREATE SCHEMA teste_alphacode;
USE teste_alphacode;

CREATE TABLE contato (
	id BIGINT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    profissao VARCHAR(150) NOT NULL,
    nascimento DATE NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefone VARCHAR(10),
    celular VARCHAR(11) NOT NULL,
    celular_whatsapp TINYINT(1) NOT NULL,
    recebe_email TINYINT(1) NOT NULL,
	recebe_sms TINYINT(1) NOT NULL,
    
    PRIMARY KEY(id)
)engine=InnoDB default charset=utf8mb4;