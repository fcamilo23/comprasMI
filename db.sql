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
