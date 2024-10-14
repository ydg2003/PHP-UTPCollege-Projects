-- Create the database (if it does not exist)
CREATE DATABASE IF NOT EXISTS empleados;

-- Select the database
USE empleados;

-- Create the empleados table
CREATE TABLE empleados (   
    idempleado INT NOT NULL AUTO_INCREMENT,
    nombres VARCHAR(32) NOT NULL,
    departamento VARCHAR(40) NOT NULL,
    sueldo DOUBLE,
    PRIMARY KEY (idempleado)
) ENGINE=MyISAM;

-- Insert records into the empleados table
INSERT INTO empleados VALUES (1, 'Juan Perez', 'Informatica', 500.00);
INSERT INTO empleados VALUES (2, 'Laura Morales', 'Contabilidad', 550.00);
INSERT INTO empleados VALUES (3, 'Luis Gutierrez', 'Administracion', 850.00);
INSERT INTO empleados VALUES (4, 'Pedro Solar', 'Informatica', 500.00);
INSERT INTO empleados VALUES (5, 'David Vilchez', 'Contabilidad', 550.00);
