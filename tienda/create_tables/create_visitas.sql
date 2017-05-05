drop table if exists visitas;
CREATE TABLE `visitas` ( 
    `id` int(7) NOT NULL AUTO_INCREMENT, 
    fecha CHAR(10) NOT NULL,
    `url` text NOT NULL, 
    `visitas` int(7) NOT NULL, 
    PRIMARY KEY (`id`)
);