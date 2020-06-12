-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-06-2020 a las 04:44:09
-- Versión del servidor: 5.7.30-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `p_inventarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CategoriasFabricante`
--

CREATE TABLE `CategoriasFabricante` (
  `id` tinyint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CategoriasProducto`
--

CREATE TABLE `CategoriasProducto` (
  `id` tinyint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `CategoriasProducto`
--

INSERT INTO `CategoriasProducto` (`id`, `nombre`, `descripcion`, `fecha_registro`) VALUES
(5, 'Electronica', NULL, '2020-06-04 13:36:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fabricantes`
--

CREATE TABLE `Fabricantes` (
  `id` smallint(4) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `id_categoria` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Historial`
--

CREATE TABLE `Historial` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nota` varchar(255) DEFAULT NULL,
  `referencia` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE `Productos` (
  `id` int(4) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(6,2) NOT NULL,
  `precio_venta` decimal(6,2) NOT NULL,
  `id_categoria` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`id`, `codigo`, `nombre`, `descripcion`, `cantidad`, `precio_compra`, `precio_venta`, `id_categoria`) VALUES
(5, 'B-001', 'Bocina JBL', 'Bocina de 5\"', 50, '250.00', '750.00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `privilegio` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `usuario`, `password`, `email`, `privilegio`) VALUES
(1, 'root', 'root', 'rdjvazqueza@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CategoriasFabricante`
--
ALTER TABLE `CategoriasFabricante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `CategoriasProducto`
--
ALTER TABLE `CategoriasProducto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Fabricantes`
--
ALTER TABLE `Fabricantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Fabricante_Categoria` (`id_categoria`);

--
-- Indices de la tabla `Historial`
--
ALTER TABLE `Historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`id_usuario`),
  ADD KEY `fk_product` (`id_producto`);

--
-- Indices de la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Producto_Categoria` (`id_categoria`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CategoriasFabricante`
--
ALTER TABLE `CategoriasFabricante`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CategoriasProducto`
--
ALTER TABLE `CategoriasProducto`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `Fabricantes`
--
ALTER TABLE `Fabricantes`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Historial`
--
ALTER TABLE `Historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Fabricantes`
--
ALTER TABLE `Fabricantes`
  ADD CONSTRAINT `FK_Fabricante_Categoria` FOREIGN KEY (`id_categoria`) REFERENCES `CategoriasFabricante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Historial`
--
ALTER TABLE `Historial`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`id_producto`) REFERENCES `Productos` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id`);

--
-- Filtros para la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `FK_Producto_Categoria` FOREIGN KEY (`id_categoria`) REFERENCES `CategoriasProducto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
