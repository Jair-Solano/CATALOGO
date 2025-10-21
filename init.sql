-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS glosario;
USE glosario;

-- Crear tabla de términos del glosario
CREATE TABLE glosario_terminos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    termino VARCHAR(100) NOT NULL,
    quees VARCHAR(500),
    comofunciona VARCHAR(500),
    importancia VARCHAR(500)
);