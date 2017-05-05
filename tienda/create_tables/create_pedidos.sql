drop table if exists pedidos;
create table if not exists pedidos (
idPedido INT NOT NULL AUTO_INCREMENT,
id_user INT NOT NULL,
fechaPedido DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
importeTotal INT NOT NULL,
nombre_envio CHAR(30) NOT NULL,
apellidos_envio CHAR(80) NOT NULL,
ndocumento_envio CHAR(9) NOT NULL,
pais_envio INT NOT NULL,
provincia_envio CHAR(50) NOT NULL,
ciudad_envio CHAR(50) NOT NULL,
codigopostal_envio INT(5) NOT NULL,
direccion_envio CHAR(200) NULL,
estado  ENUM('En proceso', 'Enviado', 'Entregado') DEFAULT 'En proceso',
PRIMARY KEY (idPedido),
KEY (id_user),
FOREIGN KEY(id_user) REFERENCES usuarios (id_user) ON UPDATE CASCADE ON DELETE CASCADE
);