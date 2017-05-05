drop table if exists productos_vendidos;
create table if not exists productos_vendidos (
id_venta INT AUTO_INCREMENT NOT NULL,
id_producto INT NOT NULL,
cantidad_producto INT NOT NULL,
id_factura INT (5) NOT NULL,
PRIMARY KEY (id_venta),
key(id_producto)
);