-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2025 a las 19:58:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_camarero`
--

CREATE TABLE `pedidos_camarero` (
  `id` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `nombre_camarero` varchar(100) NOT NULL,
  `nombre_plato` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` varchar(50) DEFAULT 'Pendiente',
  `fecha_pedido` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pedidos_camarero`
--

INSERT INTO `pedidos_camarero` (`id`, `nombre_cliente`, `nombre_camarero`, `nombre_plato`, `cantidad`, `estado`, `fecha_pedido`) VALUES
(1, 'JOSE', 'RICARDO', 'Ceviche mixto', 2, 'Listo para servir', '2025-07-12 12:20:58'),
(2, 'JOSE', 'RICARDO', 'Llapingachos', 1, 'Servido', '2025-07-12 12:21:04'),
(3, 'JOSE', 'RICARDO', 'Hornado', 1, 'Pendiente', '2025-07-12 12:48:27'),
(4, 'FELIPE', 'RICARDO', 'Batido de mora', 3, 'Pendiente', '2025-07-14 08:00:58'),
(5, 'FELIPE', 'RICARDO', 'Camarones al ajillo', 1, 'Pendiente', '2025-07-14 08:01:14'),
(6, 'FELIPE', 'RICARDO', 'Ensalada mixta', 1, 'Listo para servir', '2025-07-14 08:01:24'),
(7, 'FELIPE', 'RICARDO', 'Fritada', 1, 'Pendiente', '2025-07-14 08:01:30'),
(8, 'JOSE', 'RICARDO', 'Postre de tres leches', 1, 'Listo para servir', '2025-07-14 09:24:49'),
(9, 'MARCO', 'RICARDO', 'Hot dog criollo', 1, 'Servido', '2025-07-14 09:33:49'),
(10, 'MARCO', 'RICARDO', 'Tamal lojano', 1, 'Pendiente', '2025-07-14 09:34:01'),
(11, 'MARCO', 'RICARDO', 'Corvina frita', 1, 'Listo para servir', '2025-07-14 09:36:32'),
(12, 'MARCO', 'RICARDO', 'Hamburguesa criolla', 2, 'Pendiente', '2025-07-14 09:36:45'),
(13, 'JOSE', 'RICARDO', 'Pollo apanado', 1, 'Listo para servir', '2025-07-14 10:25:13'),
(14, 'JOSE', 'RICARDO', 'Ceviche mixto', 1, 'Servido', '2025-07-14 10:42:22'),
(15, 'FELIPE', 'RICARDO', 'Costillas BBQ', 1, 'Pendiente', '2025-07-16 13:12:48'),
(16, 'MARCO', 'Por asignar', 'Arroz con camarones', 5, 'En preparaciÃ³n', '2025-07-18 12:12:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_seleccionados`
--

CREATE TABLE `pedidos_seleccionados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `plato_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` enum('Pendiente','En preparación','Listo para servir','Servido') DEFAULT 'Pendiente',
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pedidos_seleccionados`
--

INSERT INTO `pedidos_seleccionados` (`id`, `usuario_id`, `plato_id`, `cantidad`, `estado`, `fecha`) VALUES
(2, 1, 2, 2, 'Listo para servir', '2025-07-12 12:20:58'),
(3, 1, 6, 1, 'Servido', '2025-07-12 12:21:04'),
(4, 1, 7, 1, 'Pendiente', '2025-07-12 12:48:27'),
(5, 5, 47, 3, 'Pendiente', '2025-07-14 08:00:58'),
(6, 5, 39, 1, 'Pendiente', '2025-07-14 08:01:14'),
(7, 5, 45, 1, 'Listo para servir', '2025-07-14 08:01:24'),
(8, 5, 11, 1, 'Pendiente', '2025-07-14 08:01:30'),
(10, 1, 49, 1, 'Listo para servir', '2025-07-14 09:24:49'),
(11, 6, 43, 1, 'Servido', '2025-07-14 09:33:49'),
(12, 6, 44, 1, 'Pendiente', '2025-07-14 09:34:01'),
(13, 6, 41, 1, 'Listo para servir', '2025-07-14 09:36:32'),
(14, 6, 31, 2, 'Pendiente', '2025-07-14 09:36:45'),
(15, 1, 4, 1, 'Listo para servir', '2025-07-14 10:25:13'),
(16, 1, 2, 1, 'Servido', '2025-07-14 10:42:22'),
(17, 5, 36, 1, 'Pendiente', '2025-07-16 13:12:48'),
(18, 1, 47, 1, 'Pendiente', '2025-07-18 11:17:46'),
(19, 1, 44, 4, 'Pendiente', '2025-07-18 11:18:24'),
(20, 6, 3, 5, 'Pendiente', '2025-07-18 12:12:12');

--
-- Disparadores `pedidos_seleccionados`
--
DELIMITER $$
CREATE TRIGGER `insertar_pedido_camarero` AFTER INSERT ON `pedidos_seleccionados` FOR EACH ROW BEGIN
    DECLARE nombreCliente VARCHAR(100);
    DECLARE nombrePlato VARCHAR(100);

    -- Obtener el nombre del cliente
    SELECT nombre_usuario INTO nombreCliente
    FROM usuarios
    WHERE id = NEW.usuario_id;

    -- Obtener el nombre del plato
    SELECT nombre_plato INTO nombrePlato
    FROM platos
    WHERE id = NEW.plato_id;

    -- Insertar en pedidos_camarero
    INSERT INTO pedidos_camarero (nombre_cliente, nombre_camarero, nombre_plato, cantidad, estado)
    VALUES (nombreCliente, 'Por asignar', nombrePlato, NEW.cantidad, NEW.estado);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id` int(11) NOT NULL,
  `nombre_plato` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `nombre_plato`, `descripcion`, `precio`) VALUES
(1, 'Encebollado', 'Pescado con yuca y cebolla', 4.50),
(2, 'Ceviche mixto', 'Mariscos marinados en limón', 5.25),
(3, 'Arroz con camarones', 'Arroz salteado con camarones', 6.00),
(4, 'Pollo apanado', 'Pollo empanizado y frito', 4.75),
(5, 'Guatita', 'Estómago de res en salsa de maní', 5.50),
(6, 'Llapingachos', 'Tortillas de papa con queso', 3.00),
(7, 'Hornado', 'Carne de cerdo al horno', 6.50),
(8, 'Yapingacho mixto', 'Tortillas con chorizo', 4.25),
(9, 'Sopa de bolas', 'Sopa con bolas de verde y carne', 4.75),
(10, 'Seco de pollo', 'Pollo guisado con arroz', 5.00),
(11, 'Fritada', 'Carne de cerdo frita', 5.25),
(12, 'Tigrillo', 'Verde cocinado con huevo y queso', 3.50),
(13, 'Seco de chivo', 'Chivo en salsa con arroz y maduro', 6.75),
(14, 'Bolón mixto', 'Bolón de verde con queso y chicharrón', 3.25),
(15, 'Cazuela de mariscos', 'Camarón y pescado con verde al horno', 6.00),
(16, 'Encocado de camarón', 'Camarón con leche de coco', 5.90),
(17, 'Locro de papa', 'Sopa de papa con queso y aguacate', 3.80),
(18, 'Caldo de gallina', 'Sopa tradicional de gallina', 4.25),
(19, 'Empanadas de viento', 'Empanadas fritas con queso', 2.00),
(20, 'Humitas', 'Tamal de maíz cocido al vapor', 2.50),
(21, 'Tamales', 'Masa de maíz con carne y huevo', 2.75),
(22, 'Bistec de res', 'Carne de res a la plancha con arroz', 6.00),
(23, 'Chuleta apanada', 'Chuleta de cerdo empanizada', 5.50),
(24, 'Sango de camarón', 'Harina de maíz con camarones', 4.75),
(25, 'Arroz con menestra y carne', 'Menestra con arroz y carne asada', 5.90),
(26, 'Chaulafan', 'Arroz frito con pollo, cerdo y camarones', 6.25),
(27, 'Mote pillo', 'Mote salteado con huevo y cebolla', 3.20),
(28, 'Ceviche de camarón', 'Camarones en jugo de limón y tomate', 5.50),
(29, 'Ceviche de pescado', 'Pescado cocido en limón', 5.00),
(30, 'Ensalada César con pollo', 'Lechuga, pollo y aderezo César', 4.50),
(31, 'Hamburguesa criolla', 'Hamburguesa con huevo y plátano', 4.75),
(32, 'Pizza artesanal', 'Pizza con ingredientes frescos', 6.00),
(33, 'Tacos ecuatorianos', 'Tortillas con carne y ají criollo', 4.25),
(34, 'Churrasco', 'Carne, huevo, arroz, papas fritas', 6.50),
(35, 'Milanesa de res', 'Carne de res empanizada y frita', 5.75),
(36, 'Costillas BBQ', 'Costillas de cerdo con salsa BBQ', 7.00),
(37, 'Lasagna de carne', 'Pasta al horno con carne y queso', 6.25),
(38, 'Papas con cuero', 'Papas cocidas con pellejo de cerdo', 4.00),
(39, 'Camarones al ajillo', 'Camarones con ajo y mantequilla', 5.80),
(40, 'Tilapia frita', 'Tilapia entera frita con arroz', 5.90),
(41, 'Corvina frita', 'Pescado frito con ensalada', 6.25),
(42, 'Sánduche de chancho', 'Pan con carne de cerdo horneada', 3.80),
(43, 'Hot dog criollo', 'Salchicha, salsa y mote', 3.00),
(44, 'Tamal lojano', 'Tamal típico con carne de cerdo', 2.75),
(45, 'Ensalada mixta', 'Verduras con aderezo', 2.50),
(46, 'Jugo natural', 'Jugo de fruta fresca', 1.50),
(47, 'Batido de mora', 'Batido con leche o agua', 2.00),
(48, 'Café pasado', 'Café tradicional ecuatoriano', 1.25),
(49, 'Postre de tres leches', 'Bizcocho con crema y leche', 3.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Chef'),
(3, 'Camarero'),
(4, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `correo`, `clave`, `rol_id`) VALUES
(1, 'JOSE', 'jose@gmail.com', '3333', 4),
(2, 'TEODORO', 'teodoro@gmail.com', '0000', 1),
(3, 'ROSA', 'rosa@gmail.com', '1111', 2),
(4, 'RICARDO', 'ricardo@gmail.com', '2222', 3),
(5, 'FELIPE', 'felipe@gmail.com', '3333', 4),
(6, 'MARCO', 'marco@gmail.com', '3333', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos_camarero`
--
ALTER TABLE `pedidos_camarero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_seleccionados`
--
ALTER TABLE `pedidos_seleccionados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `plato_id` (`plato_id`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos_camarero`
--
ALTER TABLE `pedidos_camarero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pedidos_seleccionados`
--
ALTER TABLE `pedidos_seleccionados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos_seleccionados`
--
ALTER TABLE `pedidos_seleccionados`
  ADD CONSTRAINT `pedidos_seleccionados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pedidos_seleccionados_ibfk_2` FOREIGN KEY (`plato_id`) REFERENCES `platos` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
