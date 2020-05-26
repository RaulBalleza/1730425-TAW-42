CREATE DATABASE ControlProductos;

USE ControlProductos;

CREATE TABLE Usuarios(
    usuario VARCHAR(30) PRIMARY KEY,
    password VARCHAR(30) NOT NULL
);

ALTER TABLE Usuarios ADD email VARCHAR(40) NOT NULL UNIQUE;
ALTER TABLE Usuarios ADD privilegio TINYINT(2) NOT NULL;

INSERT INTO Usuarios (usuario, email, password, privilegio) 
VALUES ('root', 'rdjvazqueza@gmail.com', 'root', 1);

CREATE TABLE Productos(
    id SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    descripcion VARCHAR(120) NOT NULL,
    precio_compra DECIMAL(6,2) NOT NULL,
    precio_venta DECIMAL(6,2) NOT NULL,
    color VARCHAR(14) NOT NULL,

    id_categoria TINYINT(2) NOT NULL
);

CREATE TABLE CategoriasProducto(
    id TINYINT(2) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);

ALTER TABLE Productos ADD CONSTRAINT
FK_Producto_Categoria FOREIGN KEY (id_categoria) REFERENCES CategoriasProducto(id) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE Fabricantes(
    id SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    direccion VARCHAR(60) NOT NULL,
    email VARCHAR(40) NOT NULL,
    telefono VARCHAR(10) NOT NULL,

    id_categoria TINYINT(2) NOT NULL
);

CREATE TABLE CategoriasFabricante(
    id TINYINT(2) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL
);

ALTER TABLE Fabricantes ADD CONSTRAINT
FK_Fabricante_Categoria FOREIGN KEY (id_categoria) REFERENCES CategoriasFabricante(id) ON DELETE CASCADE ON UPDATE CASCADE;
