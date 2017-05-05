drop table if exists imagenes;
create table imagenes (
idImagen INT NOT NULL AUTO_INCREMENT,
idProducto INT NOT NULL,
url CHAR(255),
primary key (idImagen, idProducto),
FOREIGN KEY (idProducto) REFERENCES productos (id_producto) ON UPDATE CASCADE ON DELETE CASCADE
);