drop table IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias (
id_categoria INT AUTO_INCREMENT NOT NULL,
nombre CHAR (50) NOT NULL,
cantidad INT NOT NULL DEFAULT 0,
PRIMARY KEY (id_categoria),
key (nombre)
)
ENGINE=InnoDB;