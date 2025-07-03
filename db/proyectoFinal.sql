CREATE DATABASE proyectoFinal;
USE proyectoFinal;

CREATE TABLE productos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(5,2) NOT NULL,
    descripcion VARCHAR(255) NOT NULL
);

INSERT INTO productos (nombre, precio, descripcion) VALUES
('Combo 1 - Calleburger de carne', 6.50, 'Hamburguesa de carne con papas fritas y soda '),
('Combo 2 - Calleburger de pollo', 6.50, 'Hamburguesa de pollo con papas fritas y soda'),
('Combo 3 - Callepollo Asado', 6.50, 'Pieza de pollo asado con papas fritas y soda'),
('Combo 4 - Alitas-jón', 4.50, 'Porción de alitas de pollo con papas fritas y soda'),
('Combo 5 - Callepollo Crispy', 6.75, 'Pieza de pollo crujiente con papas fritas y soda'),
('Combo 6 - Callewrap de pollo', 6.25, 'Wrap de pollo con papas fritas y soda'),
('Combo 7 - Callepollo BBQ', 6.80, 'Pieza de pollo a la BBQ con papas fritas y soda'),
('Combo 8 - Nuggets Callejeros', 5.00, 'Nuggets de pollo con papas fritas y soda');
