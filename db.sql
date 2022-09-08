-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/9jCdCj
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `Usuarios` (
    `cedula` varchar(255)  NOT NULL ,
    `password` varchar(255) NOT NULL ,
    `email` varchar(255)  NOT NULL ,
    `telefono` varchar(255)  NOT NULL ,
    `nombre` varchar(255)  NOT NULL ,
    `apellido` varchar(255)  NOT NULL ,
    `imagen` varchar(255),
    `biografia` varchar(255),
    `reputacion` int,
    `habilitado` bit,
    `codigo` int ,
    PRIMARY KEY (
        `cedula`
    ),
    CONSTRAINT `uc_Usuarios_email` UNIQUE (
        `email`
    )
);

CREATE TABLE `Pedido` (
    `idPedido` int  NOT NULL AUTO_INCREMENT,
    `idComprador` varchar(255)  NOT NULL ,
    `idViajero` varchar(255) ,
    `titulo` varchar(255)  NOT NULL ,
    `descripcion` varchar(255)  NOT NULL ,
    `precio` float  NOT NULL ,
    `imagen` varchar(255)  NOT NULL ,
    `link` varchar(255)  NOT NULL ,
    `fechaMin` date  NOT NULL ,
    `fechaMax` date  NOT NULL ,
    `origen` varchar(255)  NOT NULL ,
    `destino` varchar(255)  NOT NULL ,
    `descuento` int ,
    `estado` varchar(255)  NOT NULL ,
    PRIMARY KEY (
        `idPedido`
    )
);



CREATE TABLE `puntuaciones` (
    `id` int  NOT NULL AUTO_INCREMENT,
    `cedula` varchar(255)  NOT NULL ,
    `puntuacion` int  NOT NULL ,
    `mensaje` varchar(255),
    `idPuntuador` varchar(255),
    `idPedido` int,

    PRIMARY KEY (
        `id`
    )
);



CREATE TABLE `Viaje` (
    `idViaje` int  NOT NULL AUTO_INCREMENT,
    `idViajero` varchar(255)  NOT NULL ,
    `origen` varchar(255)  NOT NULL ,
    `destino` varchar(255)  NOT NULL ,
    `fechaArribo` date  NOT NULL ,

    PRIMARY KEY (
        `idViaje`
    )
);


CREATE TABLE `Notificaciones` (
    `id` int  NOT NULL AUTO_INCREMENT ,
    `idRemitente` varchar(255)  NOT NULL ,
    `idEmisor` varchar(255)  NOT NULL ,
    `mensaje` varchar(255)  NOT NULL ,
    `estado` bit  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

-- Si es true => tiene que mostrar
CREATE TABLE `Mensaje` (
    `id` int  NOT NULL AUTO_INCREMENT ,
    `idReceptor` varchar(255)  NOT NULL ,
    `idRemitente` varchar(255)  NOT NULL ,
    `mensaje` text  NOT NULL ,
    `fecha` date  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `Cupon` (
    `id` int  NOT NULL AUTO_INCREMENT ,
    `cedula` varchar(255)  NOT NULL ,
    `validez` date  NOT NULL ,
    `estado` bit  NOT NULL ,
    `monto` int  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `postulantePedido` (
    `id` int  NOT NULL AUTO_INCREMENT,
    `cedula` varchar(255)  NOT NULL ,
    `idPedido` varchar(255)  NOT NULL ,
    `precio` float  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `referencias`(
    `id` int  NOT NULL AUTO_INCREMENT,
    `invitado` VARCHAR(255),
    `referido` VARCHAR(255),
    `estado` VARCHAR(255),
    PRIMARY KEY (
        `id`
    )
);


ALTER TABLE `Cupon` ADD CONSTRAINT `fk_Cupon_cedula` FOREIGN KEY(`cedula`)
REFERENCES `Usuarios` (`cedula`);

ALTER TABLE `Pedido` ADD CONSTRAINT `fk_Pedido_idComprador` FOREIGN KEY(`idComprador`)
REFERENCES `Usuarios` (`cedula`);

ALTER TABLE `Pedido` ADD CONSTRAINT `fk_Pedido_idViajero` FOREIGN KEY(`idViajero`)
REFERENCES `Usuarios` (`cedula`);



ALTER TABLE `Viaje` ADD CONSTRAINT `fk_Viaje_idViajero` FOREIGN KEY(`idViajero`)
REFERENCES `Usuarios` (`cedula`);




ALTER TABLE `Mensaje` ADD CONSTRAINT `fk_Mensaje_idReceptor` FOREIGN KEY(`idReceptor`)
REFERENCES `Usuarios` (`cedula`);

ALTER TABLE `Mensaje` ADD CONSTRAINT `fk_Mensaje_idRemitente` FOREIGN KEY(`idRemitente`)
REFERENCES `Usuarios` (`cedula`);

ALTER TABLE `Cupon` ADD CONSTRAINT `fk_Cupon_cedula` FOREIGN KEY(`cedula`)
REFERENCES `Usuarios` (`cedula`);

ALTER TABLE `referencias` ADD CONSTRAINT `fk_Usuarios_referido` FOREIGN KEY (`referido`)
REFERENCES `Usuarios`(`cedula`);

ALTER TABLE `referencias` ADD CONSTRAINT `fk_Usuarios_invitado` FOREIGN KEY (`invitado`)
REFERENCES `Usuarios`(`cedula`);






-- Usuarios

INSERT INTO `usuarios` (`cedula`, `password`, `email`, `telefono`, `nombre`, `apellido`, `imagen`,
 `biografia`, `reputacion`, `habilitado`) VALUES ('usuario1', 'e10adc3949ba59abbe56e057f20f883e', 'usuario1@gmail.com',
 '091111111', 'Juan', 'Perez', 'https://www.mendozapost.com/files/image/7/7142/54b6f4c45797b.jpg', 
 'biografia de usuario1 biografia de usuario1 biografia de usuario1 biografia de usuario1 biografia de usuario1 ',
 '5', '1');
 
 
 INSERT INTO `usuarios` (`cedula`, `password`, `email`, `telefono`, `nombre`, `apellido`, `imagen`,
 `biografia`, `reputacion`, `habilitado`) VALUES ('usuario2', 'e10adc3949ba59abbe56e057f20f883e', 'usuario2@gmail.com',
 '092222222', 'Rodrigo', 'Rodriguez', 'https://www.mendozapost.com/files/image/7/7142/54b6f4c45797b.jpg', 
 'biografia de usuario2 biografia de usuario2 biografia de usuario2 biografia de usuario2 biografia de usuario2',
 '5', '1');
 
 INSERT INTO `usuarios` (`cedula`, `password`, `email`, `telefono`, `nombre`, `apellido`, `imagen`,
 `biografia`, `reputacion`, `habilitado`) VALUES ('usuario3', 'e10adc3949ba59abbe56e057f20f883e', 'usuario3@gmail.com',
 '093333333', 'Ana', 'Rondan', 'https://www.mendozapost.com/files/image/7/7142/54b6f4c45797b.jpg', 
 'biografia de usuario3 biografia de usuario3 biografia de usuario3 biografia de usuario3 biografia de usuario3 ',
 '5', '1');
 
 INSERT INTO `usuarios` (`cedula`, `password`, `email`, `telefono`, `nombre`, `apellido`, `imagen`,
 `biografia`, `reputacion`, `habilitado`) VALUES ('usuario4', 'e10adc3949ba59abbe56e057f20f883e', 'usuario4@gmail.com',
 '094444444', 'Daniel', 'Fedorczuck', 'https://www.mendozapost.com/files/image/7/7142/54b6f4c45797b.jpg', 
 'biografia de usuario4 biografia de usuario4 biografia de usuario4 biografia de usuario4 biografia de usuario4 ',
 '5', '1');
 
 INSERT INTO `usuarios` (`cedula`, `password`, `email`, `telefono`, `nombre`, `apellido`, `imagen`,
 `biografia`, `reputacion`, `habilitado`) VALUES ('usuario5', 'e10adc3949ba59abbe56e057f20f883e', 'usuario5@gmail.com',
 '095555555', 'Maria', 'Da Cunha', 'https://www.mendozapost.com/files/image/7/7142/54b6f4c45797b.jpg', 
 'biografia de usuario5 biografia de usuario5 biografia de usuario5 biografia de usuario5 biografia de usuario5 ',
 '5', '1');
 
 
 
 -- 
 
 INSERT INTO `pedido` (`idComprador`, `idViajero`, `titulo`, `descripcion`, `precio`, `link`,
 `fechaMin`, `fechaMax`, `origen`, `destino`, `estado`) VALUES ('usuario1', '', 'Notebook', 'Hp Intel core i5', '154',
 'www.link.com', '2022-07-14', '2022-07-21', 'Montevideo', 'Miami', 'ACTIVO');

 
  
 INSERT INTO `pedido` (`idComprador`, `idViajero`, `titulo`, `descripcion`, `precio`, `link`,
 `fechaMin`, `fechaMax`, `origen`, `destino`, `estado`) VALUES ('usuario3', '', 'Disco SSD', 'Samsung', '2500',
 'www.link.com', '2022-07-14', '2022-07-21', 'Miami', 'Montevideo', 'ACTIVO');

  
 INSERT INTO `pedido` (`idComprador`, `idViajero`, `titulo`, `descripcion`, `precio`, `link`,
 `fechaMin`, `fechaMax`, `origen`, `destino`, `estado`) VALUES ('usuario5', '', 'PS5', 'Almacenamiento 1TB', '41000',
 'www.link.com', '2022-07-14', '2022-07-21', 'Miami', 'Montevideo', 'ACTIVO');

  
 INSERT INTO `pedido` ( `idComprador`, `idViajero`, `titulo`, `descripcion`, `precio`, `link`,
 `fechaMin`, `fechaMax`, `origen`, `destino`, `estado`) VALUES ('usuario5', '', 'Joystick PS5', 'Blanco', '3500',
 'www.link.com', '2022-07-14', '2022-07-21', 'Miami', 'Montevideo', 'ACTIVO');






-- Viajes

INSERT INTO `viaje` (`origen`,`idViajero`, `destino`, `fechaIda`, `fechaVuelta`) VALUES ('Miami', 'usuario1', 'Montevideo', '2022-07-16', '2022-07-16');

INSERT INTO `viaje` (`origen`,`idViajero`, `destino`, `fechaIda`, `fechaVuelta`) VALUES ('Montevideo', 'usuario2', 'Miami', '2022-07-20', '2022-07-16');

INSERT INTO `viaje` (`origen`,`idViajero`, `destino`, `fechaIda`, `fechaVuelta`) VALUES ('Montevideo', 'usuario3', 'Londres', '2022-07-18', '2022-07-16');

INSERT INTO `viaje` (`origen`,`idViajero`, `destino`, `fechaIda`, `fechaVuelta`) VALUES ('Montevideo', 'usuario4', 'Berlin', '2022-07-17', '2022-07-16');
 
 
--  Mensajes
INSERT INTO mensaje(idReceptor, idRemitente, mensaje, fecha) VALUES('usuario1', 'nick', 'primer mensaje', now());
INSERT INTO mensaje(idReceptor, idRemitente, mensaje, fecha) VALUES('usuario1', 'nick', 'segundo mensaje', now());
INSERT INTO mensaje(idReceptor, idRemitente, mensaje, fecha) VALUES('usuario2', 'nick', 'primer mensaje', now());
INSERT INTO mensaje(idReceptor, idRemitente, mensaje, fecha) VALUES('usuario2', 'nick', 'segundo mensaje', now());
INSERT INTO mensaje(idReceptor, idRemitente, mensaje, fecha) VALUES('usuario2', 'nick', 'tercer mensaje', now());
INSERT INTO mensaje(idReceptor, idRemitente, mensaje, fecha) VALUES('nick', 'usuario2', 'cuarto mensaje', now());
INSERT INTO mensaje(idReceptor, idRemitente, mensaje, fecha) VALUES('usuario2', 'nick', 'quinto mensaje', now());
