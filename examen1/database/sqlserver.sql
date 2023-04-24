CREATE TABLE inscripcion (
  id int,
  ci_estudiante varchar(10),
  sigla varchar(10),
  nota1 int,
  nota2 int,
  nota3 int,
  notafinal int
);

INSERT INTO inscripcion (id, ci_estudiante, sigla, nota1, nota2, nota3, notafinal)
VALUES
(1, '8448501', 'inf11', 40, 30, 50, 30),
(2, '8448501', 'inf112', 40, 30, 20, 20);


CREATE TABLE persona (
  ci varchar(10) NOT NULL PRIMARY KEY,
  nombre_completo varchar(100) NOT NULL,
  fecha_nacimiento date NOT NULL,
  telefono varchar(20) NOT NULL,
  departamento varchar(2) NOT NULL
);

INSERT INTO persona (ci, nombre_completo, fecha_nacimiento, telefono, departamento) VALUES
('8448501', 'Samuel Loza R', '1998-04-04', '(591) 72538805', '01'),
('8448502', 'Juan Ramirez Lazo', '1999-04-06', '(591) 72538806', '02');


CREATE TABLE rol (
  id int NOT NULL PRIMARY KEY IDENTITY(1,1),
  ci varchar(10) NOT NULL,
  rol varchar(10) NOT NULL
);

INSERT INTO rol (ci, rol) VALUES
('8448501', 'DIRECTOR');


CREATE TABLE usuario (
  ci varchar(10) NOT NULL PRIMARY KEY,
  usuario varchar(15) NOT NULL,
  password text NOT NULL
);

INSERT INTO usuario (ci, usuario, password) VALUES
('8448501', 'loza', 'qwerty'),
('8448502', 'ramirez', '123456');
