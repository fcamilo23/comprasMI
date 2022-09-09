-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/9jCdCj
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `Usuarios` (
    `cedula` varchar(255)  NOT NULL ,
    `password` varchar(255) NOT NULL ,
    `email` varchar(255)  NOT NULL ,
    `nombre` varchar(255)  NOT NULL ,
    `apellido` varchar(255)  NOT NULL ,
    `habilitado` int,
    `codigo` int ,
    `rol` int ,


    PRIMARY KEY (
        `cedula`
    );



















--INSERTS

INSERT INTO `solicitudescompra` (`id`, `SR`, `planificado`, `gastos_inversiones`, `grupoAS`, `artServ`, `detalle`, `cantidad`, `estado`, `oficinaSolicitante`, `fechaHora`, `costoAprox`, `referente`, `contactoReferente`, `observaciones`, `procedimiento`) VALUES (NULL, '123', '1', '1', '1', 'Lorem ipsum lorem impsum', 'Lorem ipsum lorem impsum', '5', 'Pendiente', '002', '2022-09-09 04:42:15.000000', '145050,55', 'Jorge Martinez', 'jorge@gmail.com', 'Lorem ipsum lorem impsum', 'LP');