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

CREATE TABLE `archivossolicitudes` (
  `id` int(11) NOT NULL,
  `idSolicitud` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `pdf` longblob NOT NULL
)
---`-------------------ORDENES---------------------
CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `numeroAmpliacion` varchar(50) DEFAULT NULL,
  `moneda` varchar(35) NOT NULL,
  `montoReal` int(11) NOT NULL,
  `plazoEntrega` date NOT NULL,
  `formaPago` text NOT NULL,
  `servicio` varchar(5) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `idSolicitud` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `procedimiento` varchar(50) NOT NULL
)

ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordenes_ibfk` (`idSolicitud`),
  ADD KEY `ordenes_idProveedor_ibfk` (`idProveedor`);

ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

 
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitudescompra` (`id`),
  ADD CONSTRAINT `ordenes_idProveedor_ibfk` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`); 

--------------------------ArchivoOrden---------------------------------


CREATE TABLE `archivosordenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pdf` longblob NOT NULL,
  `idOrden` int(11) NOT NULL,
  `idSolicitud` int(11) NOT NULL
) 

ALTER TABLE `archivosordenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archivosordenes_orden_ibfk` (`idSolicitud`),
  ADD KEY `archivos_orden_idOrdenes_ibfk` (`idOrden`);

  ALTER TABLE `archivosordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
ALTER TABLE `archivosordenes`
  ADD CONSTRAINT `archivos_orden_idOrdenes_ibfk` FOREIGN KEY (`idOrden`) REFERENCES `ordenes` (`id`),
  ADD CONSTRAINT `archivosordenes_orden_ibfk` FOREIGN KEY (`idSolicitud`) REFERENCES `ordenes` (`id`),
  ADD CONSTRAINT `archivosordenes_solicitud_ibfk` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitudescompra` (`id`);

  --------------------------archivossolicitudes-----------------------------------


ALTER TABLE `archivossolicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archivossolicitudes_ibfk` (`idSolicitud`);

ALTER TABLE `archivossolicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
ALTER TABLE `archivossolicitudes`
  ADD CONSTRAINT `archivossolicitudes_ibfk` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitudescompra` (`id`);





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

  -- FACTURAS --------------------------------------------------------------------------------------------------------------
CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `idOrden` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `fechaFactura` date NOT NULL,
  `monedaFactura` varchar(40) NOT NULL,
  `conceptoFactura` text DEFAULT NULL,
  `numeroFactura` varchar(60) NOT NULL,
  `montoFactura` int(11) NOT NULL
);
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturasIdOrden_ibfk` (`idOrden`),
  ADD KEY `facturasIdProveedor_ibfk` (`idProveedor`);

ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `facturas`
  ADD CONSTRAINT `facturasIdOrden_ibfk` FOREIGN KEY (`idOrden`) REFERENCES `ordenes` (`id`),
  ADD CONSTRAINT `facturasIdProveedor_ibfk` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`);


--ARCHIVOSFACTURAS------------------------------------------------------------------------------------------------------------

CREATE TABLE `archivosfacturas` (
  `id` int(11) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `pdf` longblob NOT NULL
);

ALTER TABLE `archivosfacturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archivosfacturasFacturas_ibfk` (`idFactura`);

ALTER TABLE `archivosfacturas`
  ADD CONSTRAINT `archivosfacturasFacturas_ibfk` FOREIGN KEY (`idFactura`) REFERENCES `facturas` (`id`);














--INSERTS

INSERT INTO `solicitudescompra` (`id`, `SR`, `planificado`, `gastos_inversiones`, `grupoAS`, `artServ`, `detalle`, `cantidad`, `estado`, `oficinaSolicitante`, `fechaHora`, `costoAprox`, `referente`, `contactoReferente`, `observaciones`, `procedimiento`) VALUES (NULL, '123', '1', '1', '1', 'Lorem ipsum lorem impsum', 'Lorem ipsum lorem impsum', '5', 'Pendiente', '002', '2022-09-09 04:42:15.000000', '145050,55', 'Jorge Martinez', 'jorge@gmail.com', 'Lorem ipsum lorem impsum', 'LP');