DROP DATABASE IF EXISTS cafe;
CREATE DATABASE cafe;
USE cafe;

CREATE TABLE usuario(
    Id int not null primary key auto_increment,
    Nombre_1 varchar(255) not null,
    Nombre_2 varchar(255),
    Apellido_paterno varchar(255) not null,
    Apellido_materno varchar(255) not null,
    Numero_telefono varchar(10) not null,
    Correo varchar(50) not null,
    Password_cliente varchar(10) not null
);


CREATE TABLE categoria(
    Id int not null primary key auto_increment,
    Nombre varchar(255) not null,
    Cantidad_disponible varchar(10) not null
);

CREATE TABLE producto(
    Id int not null primary key auto_increment,
    Nombre varchar(255) not null,
    Precio varchar(20) not null,
    Volumen varchar(20) not null,
    categoria_id int not null,
    foreign key (categoria_id) references categoria (Id)
);

CREATE TABLE carrito(
    Id int not null primary key auto_increment,
    Productos_comprados varchar(100) not null,
    producto_id int not null,
    foreign key (producto_id) references producto (Id)
);

CREATE TABLE venta(
    Id int not null primary key auto_increment,
    usuario_id int not null,
    foreign key (usuario_id) references usuario (Id),
    carrito_id int not null,
    foreign key (carrito_id) references carrito (Id),
    Total varchar(50) not null
);

/*
INSERT INTO usuario(Nombre_1, Nombre_2, Apellido_paterno, Apellido_materno, Numero_telefono, Correo, Password_cliente ) VALUES('Albin', 'Ivan', 'Cruz','Castellanos', '9711001281', 'Albinivan@gmail.com', '12345678');
INSERT INTO categoria(Nombre, Cantidad_disponible) VALUES ('Cappuccino','50');
INSERT INTO producto(Nombre, Precio, Volumen, categoria_id) VALUES('Cafe', '$ 40.00', '150 ml','1');
INSERT INTO carrito(Productos_comprados, producto_id) VALUES ('1','1');
INSERT INTO venta(usuario_id, carrito_id, Total) VALUES ('1','1','$ 40.00');
*/