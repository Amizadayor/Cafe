DROP DATABASE IF EXISTS cafe;
CREATE DATABASE cafe;
USE cafe;

CREATE TABLE Usuario(
    Id int not null primary key auto_increment,
    Nombre_1 varchar(255) not null,
    Nombre_2 varchar(255),
    Apellido_paterno varchar(255) not null,
    Apellido_materno varchar(255) not null,
    Numero_telefono varchar(10) not null,
    Correo varchar(50) not null,
    Password_cliente varchar(10) not null
);

CREATE TABLE Categoria(
    Id int not null primary key auto_increment,
    Nombre varchar(255) not null,
    Cantidad_disponible varchar(10) not null
);

CREATE TABLE Producto(
    Id int not null primary key auto_increment,
    Nombre varchar(255) not null,
    Precio varchar(20) not null,
    Volumen varchar(20) not null,
    Categoria_id int not null,
    foreign key (Categoria_id) references Categoria (Id)
);

CREATE TABLE Carrito(
    Id int not null primary key auto_increment,
    Productos_comprados varchar(100) not null,
    Producto_id int not null,
    foreign key (Producto_id) references Producto (Id)
);

CREATE TABLE Venta(
    Id int not null primary key auto_increment,
    Usuario_id int not null,
    foreign key (Usuario_id) references Usuario (Id),
    Carrito_id int not null,
    foreign key (Carrito_id) references Carrito (Id),
    Total varchar(50) not null
);
