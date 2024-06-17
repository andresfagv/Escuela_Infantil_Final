-- Eliminar la base de datos si existe
DROP DATABASE IF EXISTS escuela_infantil;

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS escuela_infantil;

-- Seleccionar la base de datos recién creada
USE escuela_infantil;

-- Creación de la tabla Users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    password_salt VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('admin', 'educador', 'padre') NOT NULL
);

-- Creación de la tabla Educador
CREATE TABLE educador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    DNI VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tel VARCHAR(20) NOT NULL,
    f_nacimiento DATE NOT NULL,
    sexo ENUM('hombre', 'mujer') NOT NULL,
    img VARCHAR(200),
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

-- Creación de la tabla Estudiante
CREATE TABLE estudiante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    f_nacimiento DATE NOT NULL,
    sexo ENUM('hombre', 'mujer') NOT NULL,
    alergias TEXT,
    img VARCHAR(200),
    comentarios TEXT
);

-- Creación de la tabla Padre
CREATE TABLE padre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tel VARCHAR(20) NOT NULL,
    id_alumno INT NOT NULL,
    relacion VARCHAR(100) NOT NULL,
    sexo ENUM('hombre', 'mujer') NOT NULL,
    DNI VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_alumno) REFERENCES estudiante(id) ON DELETE CASCADE
);


-- Creación de la tabla Clase
CREATE TABLE clase (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    nivel VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- Creación de la tabla ClaseEducador (tabla intermedia)
CREATE TABLE claseeducador (
    id_clase INT NOT NULL,
    id_educador INT NOT NULL,
    PRIMARY KEY (id_clase, id_educador),
    FOREIGN KEY (id_clase) REFERENCES clase(id) ON DELETE CASCADE,
    FOREIGN KEY (id_educador) REFERENCES educador(id) ON DELETE CASCADE
);

-- Creación de la tabla Inscripcion
CREATE TABLE inscripcion (
    id_clase INT NOT NULL,
    id_estudiante INT NOT NULL,
    PRIMARY KEY (id_clase, id_estudiante),
    FOREIGN KEY (id_clase) REFERENCES clase(id) ON DELETE CASCADE,
    FOREIGN KEY (id_estudiante) REFERENCES estudiante(id) ON DELETE CASCADE
);

-- Creación de la tabla Contacto
CREATE TABLE contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tel VARCHAR(20) NOT NULL,
    relacion VARCHAR(100) NOT NULL,
    id_alumno INT NOT NULL,
    FOREIGN KEY (id_alumno) REFERENCES estudiante(id) ON DELETE CASCADE
);

-- Creacion de la tabla Documentos
CREATE TABLE documentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ruta VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255),
    id_alumno INT NOT NULL,
    FOREIGN KEY (id_alumno) REFERENCES estudiante(id) ON DELETE CASCADE
);

-- Creacion de la tabla Autorizacion
CREATE TABLE autorizacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ruta VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255),
    id_alumno INT NOT NULL,
    FOREIGN KEY (id_alumno) REFERENCES estudiante(id) ON DELETE CASCADE
);

-- Creación de la tabla Fotografias
CREATE TABLE fotografias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_clase INT NOT NULL,
    ruta_foto VARCHAR(255) NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_clase) REFERENCES clase(id)
);

-- Crear la tabla MenuSemanal
CREATE TABLE menusemanal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_clase INT NOT NULL,
    dia ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes') NOT NULL,
    comida1 VARCHAR(255) NOT NULL,
    comida2 VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_clase) REFERENCES clase(id) ON DELETE CASCADE
);

-- Creación de la tabla Productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45) NOT NULL,
    tipo ENUM('Juguete', 'Libro') NOT NULL,
    descripcion VARCHAR(255),
    disponible BOOL NOT NULL,
    id_alumno INT,
    FOREIGN KEY (id_alumno) REFERENCES estudiante(id)
);

-- Creación de la tabla Mensajes
CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_educador INT NOT NULL,
    id_padre INT NOT NULL,
    titulo TEXT NOT NULL,
    contenido TEXT NOT NULL,
    fecha_envio DATETIME NOT NULL,
    visto BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_educador) REFERENCES educador(id) ON DELETE CASCADE,
    FOREIGN KEY (id_padre) REFERENCES padre(id) ON DELETE CASCADE
);



-- Triggers para eliminar datos despues de eliminar algunos campos

DELIMITER //

CREATE TRIGGER eliminar_padre_despues_de_eliminar_alumno 
AFTER DELETE ON estudiante 
FOR EACH ROW 
BEGIN 
    DELETE FROM padre WHERE id_alumno = OLD.id; 
END; //

DELIMITER ;


DELIMITER //

CREATE TRIGGER eliminar_usuario_despues_de_eliminar_padre 
AFTER DELETE ON padre 
FOR EACH ROW 
BEGIN 
    DELETE FROM users WHERE id = OLD.id_user; 
END; //

DELIMITER ;

