CREATE DATABASE proyectoFinal;
USE proyectoFinal;

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` varchar(100) NOT NULL DEFAULT 'Indefinido',
  `imagen` varchar(100) NOT NULL,
  `en_carrusel` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `nombre`, `precio`, `descripcion`, `categoria`, `imagen`, `en_carrusel`) VALUES
(1, 'Combo 1 - Calleburger de carne', 6.50, 'Hamburguesa de carne con papas fritas y soda', 'combo', 'combo1.png', 0),
(2, 'Combo 2 - Calleburger de pollo', 6.50, 'Hamburguesa de pollo con papas fritas y soda', 'combo', 'combo2.png', 0),
(3, 'Combo 3 - Callepollo Asado', 6.50, 'Pieza de pollo asado con papas fritas y soda', 'combo', 'combo3.png', 0),
(4, 'Combo 4 - Alitas-jón', 4.50, 'Porción de alitas de pollo con papas fritas y soda', 'combo', 'alitasjon.jpg', 0),
(5, 'Combo 5 - Callepollo Crispy', 6.75, 'Pieza de pollo crujiente con papas fritas y soda', 'combo', 'pollocrispy.jpg', 0),
(6, 'Combo 6 - Callewrap de pollo', 6.25, 'Wrap de pollo con papas fritas y soda', 'combo', 'pollowrap.jpg', 0),
(7, 'Combo 7 - Callepollo BBQ', 6.80, 'Pieza de pollo a la BBQ con papas fritas y soda', 'combo', 'pollobbq.jpg', 1),
(8, 'Combo 8 - Nuggets Callejeros', 5.00, 'Nuggets de pollo con papas fritas y soda', 'combo', 'combo8.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
