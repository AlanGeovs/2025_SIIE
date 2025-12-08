drop table edificio;
create table edificio(
id int auto_increment,
numero_edificio int,
numero_nivel int,
idusuario int,
cct varchar(20),
estatus int,
primary key(id,idusuario,numero_edificio,numero_nivel)

);
drop procedure altaEdificio;
DELIMITER //

CREATE PROCEDURE altaEdificio(
xne int,
xnn int,
xidusu int,
xcct varchar(20),
xestatus int

)
BEGIN
declare valida int;
declare last_id int;
select count(*) into valida from edificio where idusuario=xidusu and numero_edificio=xne and numero_nivel=xnn and estatus=xestatus;

if valida>0
then
select '-1'as retorno;
else

insert into edificio(id,numero_edificio,numero_nivel,idusuario,cct,estatus)values(null,xne,xnn,xidusu,xcct,0);
SELECT  LAST_INSERT_ID() into last_id;
INSERT INTO datos_edificio (
id,
existencia,
tipo_construccion,
cantidad,
en_usu,
condicion,
con_dano_estructural,
con_dano_instalacion,
obra_en_proceso,
tipo_obra,
recursos,
requiere_ca,
liga,
id_edificio,
id_articulo
)
SELECT null,'0','0','0','0','0','0','0','0','0','0','0',"",last_id,id 
FROM articulo;

select '0' as retorno;
end if;
END //

DELIMITER ;

drop procedure eliminaEdificio;
DELIMITER //

CREATE PROCEDURE eliminaEdificio(
xidt int,
xestatus int
)
BEGIN



update edificio set estatus=xestatus where id=xidt;

END //

DELIMITER ;

drop procedure consultaEdificio;
DELIMITER //

CREATE PROCEDURE consultaEdificio(
xidusuario int
)
BEGIN
select *from edificio where idusuario=xidusuario and estatus=0 order by numero_edificio,numero_nivel;
END //

DELIMITER ;


-- /////////////////////////////////////////////////////////////////////// parte para el detalle
create table area(
id int auto_increment,
nombre varchar(50),
primary key(id)
);
insert into areas(id,nombre)values(null,'areas principales');
insert into areas(id,nombre)values(null,'areas adicionales');
insert into areas(id,nombre)values(null,'areas mobiliario');
insert into areas(id,nombre)values(null,'areas equipo');

create table articulo(
id int auto_increment,
nombre varchar(50),
idarea int,
primary key(id)

);
insert into articulo(id,nombre,idarea)values(null,'Baño',1);
insert into articulo(id,nombre,idarea)values(null,'Direccion',1);
insert into articulo(id,nombre,idarea)values(null,'Letrina',1);
insert into articulo(id,nombre,idarea)values(null,'Salon',1);



insert into articulo(id,nombre,idarea)values(null,'Administrativa',2);
insert into articulo(id,nombre,idarea)values(null,'Biblioteca',2);
insert into articulo(id,nombre,idarea)values(null,'Bodega',2);
insert into articulo(id,nombre,idarea)values(null,'Casa del conserje',2);
insert into articulo(id,nombre,idarea)values(null,'Casa del maestro',2);
insert into articulo(id,nombre,idarea)values(null,'Centro de computo',2);
insert into articulo(id,nombre,idarea)values(null,'Cocina',2);
insert into articulo(id,nombre,idarea)values(null,'Comedor',2);
insert into articulo(id,nombre,idarea)values(null,'Dormitorio',2);
insert into articulo(id,nombre,idarea)values(null,'Intendencia',2);
insert into articulo(id,nombre,idarea)values(null,'Laboratorio',2);
insert into articulo(id,nombre,idarea)values(null,'Portico',2);
insert into articulo(id,nombre,idarea)values(null,'Sala de usos multiples',2);
insert into articulo(id,nombre,idarea)values(null,'Subdireccion',2);
insert into articulo(id,nombre,idarea)values(null,'Taller',2);
insert into articulo(id,nombre,idarea)values(null,'Vestidor',2);


insert into articulo(id,nombre,idarea)values(null,'Archivero',3);
insert into articulo(id,nombre,idarea)values(null,'Banca en vestidores',3);
insert into articulo(id,nombre,idarea)values(null,'Banco',3);
insert into articulo(id,nombre,idarea)values(null,'Butaca',3);
insert into articulo(id,nombre,idarea)values(null,'Butaca para zurdos',3);
insert into articulo(id,nombre,idarea)values(null,'Casillero',3);
insert into articulo(id,nombre,idarea)values(null,'Cesto de basura',3);
insert into articulo(id,nombre,idarea)values(null,'Escritorio',3);
insert into articulo(id,nombre,idarea)values(null,'Escritorio para maestro',3);
insert into articulo(id,nombre,idarea)values(null,'Estante',3);
insert into articulo(id,nombre,idarea)values(null,'Mesa',3);
insert into articulo(id,nombre,idarea)values(null,'Mesa binaria',3);
insert into articulo(id,nombre,idarea)values(null,'Mesa de laboratorio',3);
insert into articulo(id,nombre,idarea)values(null,'Mesa-banco',3);
insert into articulo(id,nombre,idarea)values(null,'Mesa-banco-binario',3);
insert into articulo(id,nombre,idarea)values(null,'Pizarron',3);
insert into articulo(id,nombre,idarea)values(null,'Pintarron',3);
insert into articulo(id,nombre,idarea)values(null,'Silla',3);
insert into articulo(id,nombre,idarea)values(null,'Silla con paleta',3);
insert into articulo(id,nombre,idarea)values(null,'Silla para maestro',3);


insert into articulo(id,nombre,idarea)values(null,'Aire acondicionado',4);
insert into articulo(id,nombre,idarea)values(null,'Bocina para PC',4);
insert into articulo(id,nombre,idarea)values(null,'Computadora PC',4);
insert into articulo(id,nombre,idarea)values(null,'Computadora Portatil',4);
insert into articulo(id,nombre,idarea)values(null,'Copiadora',4);
insert into articulo(id,nombre,idarea)values(null,'DVD',4);
insert into articulo(id,nombre,idarea)values(null,'Equipo de sonido',4);
insert into articulo(id,nombre,idarea)values(null,'Estante',4);
insert into articulo(id,nombre,idarea)values(null,'Impresora',4);
insert into articulo(id,nombre,idarea)values(null,'Maquina de escribir',4);
insert into articulo(id,nombre,idarea)values(null,'Pantalla retractil',4);
insert into articulo(id,nombre,idarea)values(null,'Regulador',4);
insert into articulo(id,nombre,idarea)values(null,'Scaner',4);
insert into articulo(id,nombre,idarea)values(null,'Tableta',4);
insert into articulo(id,nombre,idarea)values(null,'Television',4);
insert into articulo(id,nombre,idarea)values(null,'Pantalla',4);
insert into articulo(id,nombre,idarea)values(null,'Proyector de video',4);


create table datos_edificio(
id int auto_increment,
existencia int,
tipo_construccion varchar(50),
cantidad int,
en_usu int,
condicion varchar(50),
con_dano_estructural int,
con_dano_instalacion int,
obra_en_proceso int,
tipo_obra varchar(50),
recursos varchar(50),
requiere_ca int,
liga varchar(255),
id_articulo int,
id_edificio int,
primary key(id)
);
drop procedure consultaDatosEdificio;
DELIMITER //
CREATE PROCEDURE consultaDatosEdificio(
xid_edificio int,
xid_area int
)
BEGIN
select
id,
(select nombre from articulo where id=id_articulo) as articulo,

existencia,
tipo_construccion,
cantidad,
en_usu,
condicion,
con_dano_estructural,
con_dano_instalacion,
obra_en_proceso,
tipo_obra,
recursos,
requiere_ca,
liga,
id_articulo,
id_edificio


 from datos_edificio  where id_edificio=xid_edificio and id_articulo in(select id from articulo where idarea=xid_area);
END //

DELIMITER ;


drop procedure updateDatosEdificio;
DELIMITER //
CREATE PROCEDURE updateDatosEdificio(
xid int,
xexistencia int,
xtipo_construccion varchar(50),
xcantidad int,
xen_usu int,
xcondicion varchar(50),
xcon_dano_estructural int,
xcon_dano_instalacion int,
xobra_en_proceso int,
xtipo_obra varchar(50),
xrecursos varchar(50),
xrequiere_ca int,
xliga varchar(250),
xid_articulo int,
xid_edificio int
)
BEGIN
update datos_edificio
	set
	existencia=xexistencia,
	tipo_construccion=xtipo_construccion,
	cantidad=xcantidad,
	en_usu=xen_usu,
	condicion=xcondicion,
	con_dano_estructural=xcon_dano_estructural,
	con_dano_instalacion=xcon_dano_instalacion,
	obra_en_proceso=xobra_en_proceso,
	tipo_obra=xtipo_obra,
	recursos=xrecursos,
	requiere_ca=xrequiere_ca,
	liga=xliga
	where
	
	id=xid;






END //

DELIMITER ;



