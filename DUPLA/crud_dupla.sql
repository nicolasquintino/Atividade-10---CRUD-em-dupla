CREATE DATABASE crud_dupla;
USE crud_dupla;

CREATE TABLE professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(15),
    idade INT
);

CREATE TABLE diaria (
    id_id INT AUTO_INCREMENT PRIMARY KEY,
    horaAula TIME NOT NULL,
    valor DECIMAL(10, 2),
    dataAULA DATE,
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES professores(id)
);

CREATE TABLE aulas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sala VARCHAR(50) NOT NULL,
    horarioInicio TIME NOT NULL,
    horarioFim TIME NOT NULL,
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES professores(id)
);