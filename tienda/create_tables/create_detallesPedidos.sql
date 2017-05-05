drop table if exists detallespedidos;
create table if not exists detallespedidos (
idPedido INT NOT NULL,
idProducto INT NOT NULL,
nUnidades INT NOT NULL,
precioUnitario FLOAT NOT NULL,
PRIMARY KEY (idPedido, idProducto),
FOREIGN KEY(idPedido) REFERENCES pedidos (idPedido) ON UPDATE CASCADE ON DELETE CASCADE
);
