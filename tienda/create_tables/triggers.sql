drop trigger if exists sumarProductos;
drop trigger if exists restarProductos;
DELIMITER //
CREATE TRIGGER sumarProductos
AFTER INSERT
ON productos FOR EACH ROW

BEGIN
	update categorias set cantidad = cantidad + 1 where nombre=new.categoria;
END; //

CREATE TRIGGER restarProductos
AFTER DELETE
ON productos FOR EACH ROW
BEGIN
	declare valor CHAR(50);
	select old.categoria into valor from productos;
    update categorias set cantidad = cantidad - 1 where nombre=valor;
END; //