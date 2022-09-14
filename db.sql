-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/9jCdCj
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `solicitudescompra` (
  `id` int(11) NOT NULL,
  `SR` varchar(40) NOT NULL,
  `planificado` varchar(2) NOT NULL,
  `gastos_inversiones` varchar(50) NOT NULL,
  `grupoAS` varchar(100) NOT NULL,
  `artServ` varchar(255) NOT NULL,
  `detalle` varchar(400) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `oficinaSolicitante` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `costoAprox` float NOT NULL,
  `referente` varchar(255) NOT NULL,
  `contactoReferente` varchar(255) NOT NULL,
  `observaciones` varchar(400) NOT NULL,
  `procedimiento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `usuarios` (
  `cedula` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `habilitado` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `rol` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `empresa` varchar(30) DEFAULT NULL,
  `razon_social` varchar(30) DEFAULT NULL,
  `rut` varchar(18) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
)



CREATE TABLE `referentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `idProveedor` int(11) NOT NULL
);


CREATE TABLE `oficinas` (
  `unidad` int(11) NOT NULL,
  `ue` varchar(25) NOT NULL,
  `borrado` tinyint(1) NOT NULL
);









ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `referentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProveedor` (`idProveedor`);

ALTER TABLE `referentes`
  ADD CONSTRAINT `referentes_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`);

ALTER TABLE `oficinas`
  ADD PRIMARY KEY (`unidad`);


ALTER TABLE `solicitudescompra`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`);



ALTER TABLE `solicitudescompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;









--INSERTS

INSERT INTO `solicitudescompra` (`id`, `SR`, `planificado`, `gastos_inversiones`, `grupoAS`, `artServ`, `detalle`, `cantidad`, `estado`, `oficinaSolicitante`, `fechaHora`, `costoAprox`, `referente`, `contactoReferente`, `observaciones`, `procedimiento`) VALUES (NULL, '123', '1', '1', '1', 'Lorem ipsum lorem impsum', 'Lorem ipsum lorem impsum', '5', 'Pendiente', '002', '2022-09-09 04:42:15.000000', '145050,55', 'Jorge Martinez', 'jorge@gmail.com', 'Lorem ipsum lorem impsum', 'LP');