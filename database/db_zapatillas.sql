-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 19:11:39
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_zapatillas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `origen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `descripcion`, `origen`) VALUES
(1, 'Vans', 'Vans es una compañía dedicada principalmente a la producción de calzados, también fabrica ropa, como', 'California.EE.UU'),
(2, 'Nike', ' Nike, es una empresa multinacional estadounidense dedicada al diseño, desarrollo, fabricación y com', 'Eugene, Oregón, Estados Unidos'),
(3, 'Adidas', 'Adidas es una compañía multinacional alemana fundada en 1949, con sede en Herzogenaurach, ciudad ubi', 'Herzogenaurach, Alemania'),
(4, 'Puma', 'Puma es una empresa alemana fabricante de accesorios, ropa y calzado deportivo, cuya sede principal ', 'Herzogenaurach, Alemania');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(45) NOT NULL,
  `email` varchar(200) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `usuario`, `password`) VALUES
(1, 'Renzoseq@gmail.com', 'renzo', '$2a$12$EOOFvl5lTjFaS2Pk8Vgj4ezTvntFLW/AdIrbdbGwskn7dzlUD8LNa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zapatillas`
--

CREATE TABLE `zapatillas` (
  `id` int(11) NOT NULL,
  `modelo` varchar(350) NOT NULL,
  `color` varchar(30) NOT NULL,
  `talle` int(11) NOT NULL,
  `precio` float NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zapatillas`
--

INSERT INTO `zapatillas` (`id`, `modelo`, `color`, `talle`, `precio`, `id_marca`) VALUES
(3, 'Nike Aire Force 1 .Primer calzado deportivo de Baloncesto lanzado por Nike, hace ya unos 40 años. ', 'Blanco', 42, 26000, 2),
(10, 'Vans Clasicas urbanas de gamuza con detalle en ecocuero', 'Blanco y Negro', 40, 25000, 1),
(11, 'Adidas SuperStar de cuero ', 'Blanco con  detalles en Negro', 37, 20000, 3),
(12, 'Adidas Running deportivas con amortiguacion suave y buen ajuste', 'Negras y Rojas', 41, 24000, 3),
(13, 'Puma Tricolor', 'amarilo rojo y azul', 44, 26500, 4),
(19, 'Nike bajitas', 'Blanco  y violeta', 12, 4561, 2),
(25, 'Puma nueva ', 'Amarillas', 38, 25000, 2),
(29, 'Adidas Forum Low ', 'Celeste', 39, 25000, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`id_marca`),
  ADD KEY `id_marca` (`id_marca`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD CONSTRAINT `zapatillas_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
