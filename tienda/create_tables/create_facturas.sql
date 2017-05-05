drop table if exists facturas;
create table if not exists facturas (
id_factura INT (5) NOT NULL,
id_user INT NOT NULL,
fecha_emision DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
importe_total INT NOT NULL,
PRIMARY KEY (id_factura),
FOREIGN KEY (id_user) REFERENCES usuarios (id_user) ON DELETE RESTRICT ON UPDATE CASCADE
);