-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2022 a las 19:44:22
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `cliente` bigint(20) UNSIGNED NOT NULL,
  `servicio` bigint(20) UNSIGNED NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`cliente`, `servicio`, `Fecha`, `Hora`) VALUES
(4, 5, '2022-01-05', '19:30:00'),
(5, 6, '2021-12-10', '18:00:00'),
(6, 6, '2022-01-27', '12:45:00'),
(7, 7, '2022-01-24', '10:15:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Edad` int(3) NOT NULL,
  `Dni_dueño` varchar(9) NOT NULL,
  `Foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID`, `Tipo`, `Nombre`, `Edad`, `Dni_dueño`, `Foto`) VALUES
(4, 'Perro', 'Nala', 2, '77033361J', 'Cliente1.jpg'),
(5, 'Gato egipcio', 'Banshi', 6, '10987355R', 'cliente2.jpeg'),
(6, 'Conejo común', 'Tambor', 5, '3849531T', 'cliente3.jpg'),
(7, 'Ninfa', 'Princesa', 1, '3849531T', 'cliente4.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dueño`
--

CREATE TABLE `dueño` (
  `Dni` varchar(9) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Telefono` int(9) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dueño`
--

INSERT INTO `dueño` (`Dni`, `Nombre`, `Telefono`, `nick`, `pass`) VALUES
('00000000', 'Administrador', 0, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
('10987355R', 'Emilio', 699135771, 'Emi', '12b41c761b41698d39ef68fdd9429578'),
('3849531T', 'Isabel', 773612468, 'Isa', '165a1761634db1e9bd304ea6f3ffcf2b'),
('77033361J', 'Victor', 605571430, 'Viktor', '4e3c1f58d4ace2057d5e18f4a5a478fb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `contenido` varchar(700) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `fecha_publicacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `contenido`, `imagen`, `fecha_publicacion`) VALUES
(6, '\nEl Proyecto tecnologico ¡ZOOHHH!', 'Ver cómo un león ruge y lanza un zarpazo al aproximar nuestra mano, como una jirafa detecta y mueve la cabeza ante nuestra presencia, un elefante intenta saludarnos con su trompa o una tortuga menea la cabeza siguiendo nuestra mano. Todo esto será posible gracias a ¡ZOOHHH!, un proyecto piloto con tecnología 5G y holográfica que se ha presentado en el Hospital Sant Joan de Déu de Barcelona. Este proyecto pretende acercar a algunos de los animales del Zoo de Barcelona a niños y niñas del Hospital, mejorar su estado de ánimo y reducir el impacto de la hospitalización. Además, es una herramienta educativa que permite aprender características tanto de los animales como de su hábitat.', 'https://www.imveterinaria.es/uploads/2022/02/imveterinaria_reunion_delegacion_gobierno_5206_21142141.png', '2022-01-23'),
(7, 'Playas para perros en España', 'Rodeada por el Mar Mediterráneo, el Mar Cantábrico y el Océano Atlántico, España cuenta con más de 8.000 kilómetros de costa, convirtiéndose así en el tercer país de la Unión Europeo con más metros de costa. Sin embargo, no todas las playas y calas de España son aptas para los perros. En los últimos años, la regulación de costas y playas de España ha empezado a ser más laxa respecto a la admisión de perros y otras mascotas en estas áreas naturales del país.\n<br />\n<br />\nLa zona está catalogada como zona de especial vigilancia por lo que, debido a la situ', 'https://www.imveterinaria.es/uploads/2022/02/imveterinaria_playas_perros_espana_5136_10130012.webp', '2022-01-19'),
(8, 'Centauro se convierte en distribuidor oficial MILA', 'Centauro, referente en distribución veterinaria, ha adquirido la distribución oficial de la marca MILA, especializada en material clínico y fungible.\n\nMILA International, Inc. es una compañía estadounidense fundada hace más de 25 años fabricante de material veterinario. Cuenta con una amplia gama de sondas, drenajes, catéteres y otros tipos de materiales imprescindibles para cuidados intensivos en urgencias, UCI, cirugía y anestesia.\n<br />\n<br />\nEn un documento revisado según el actual escenario normativo y jurisprudencial, la asociación ha destacado que, “teniendo en cuenta la entidad propia que tiene la protección de los animales individualmente considerados, indepen', 'https://www.imveterinaria.es/uploads/2022/02/imveterinaria_centauro_convierte_distribuidor_5201_21125531.png', '2022-01-22'),
(9, 'Se amplían las penas por maltrato animal', 'El Consejo de Ministros ha aprobado el Anteproyecto de Ley Orgánica de modificación de la ley orgánica 10/1995, de 23 de noviembre, del código penal, en materia de maltrato animal.\n\nAnte la necesidad de reforzar la protección penal de los animales y con el ánimo de ofrecer herramientas de lucha más adecuadas contra el maltrato y abandono animal, se modifica el articulado relacionado con la protección de los animales de la Ley Orgánica 10/1995, de 23 de noviembre, del Código Penal.\n<br />\n<br />', 'https://www.imveterinaria.es/uploads/2022/02/imveterinaria_amplian_penas_maltrato_5198_21095558.png', '2021-12-31'),
(10, 'Vacaciones y mascotas', 'Las familias con mascotas, en el momento de irse de vacaciones, cuentan con un dilema añadido: ¿qué hacemos con nuestro animal de compañía? Sobre todo, en el caso de los perros, la imposibilidad de dejarlo solos en casa condiciona directamente la planificación de las vacaciones. Sin embargo, cada vez hay más alojamientos dog-friendly que admiten reservar una estancia o una habitación acompañados de nuestro perro. Al menos así lo asegura un estudio de la Fundación Affinity.\n<br />\nTengo la tripa pequeña<br />\n<br />\n¿Sabías qué mi estómago es del tamaño de una pelota de ping-pong? Es poca cosa, por eso es mejor q', 'https://www.imveterinaria.es/uploads/2022/01/imveterinaria_vacaciones_mascotas_cuantos_5043_27144545.webp', '2021-09-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `precio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id`, `Nombre`, `precio`) VALUES
(5, 'Comida fresca para gatos', '7.95'),
(6, 'Alpiste', '6.45'),
(7, 'Pienso para perros', '9.80');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `Duracion` int(11) NOT NULL,
  `precio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`ID`, `Descripcion`, `Duracion`, `precio`) VALUES
(5, 'Cortar uñas', 15, '5.00'),
(6, 'Vacuna', 10, '20.99'),
(7, 'Esterilización', 120, '110.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonio`
--

CREATE TABLE `testimonio` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Dni_autor` varchar(9) NOT NULL,
  `Contenido` varchar(500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `testimonio`
--

INSERT INTO `testimonio` (`Id`, `Dni_autor`, `Contenido`, `fecha`) VALUES
(8, '10987355R', 'Honestos, muy honestos…, cercanos, súper-profesionales!, lo cierto es que me resultan «rara avis» en un mundo (el veterinario) demasiado masificado y cada vez más carente de deontología…, a los que no les conozcan les invito, les reto, a que lo hagan; para nosotros fue una grandísima suerte cruzarnos con ellos. Multitud de servicios con el espacio y los medios imprescindibles, sin excesos y sin arrogancia…, fidelizan al cliente. Muchísimas gracias siempre, por todo, Carol y Óscar.', '2022-01-23'),
(9, '3849531T', 'Desde hace 9 años los veterinarios de Club de Campo son los que se encargan de mis perros. Quizá lo que más me gusta de ellos es la cercanía que tienen, el salir siempre con la sensación de que mis perros estánen buenas manos. Me gusta como trabajan en equipo y como se unen para diagnosticar y pautar el tratamiento. He tenido buenísima experiencia con ello en alguna intervención y me ha gustado que son veterinarios muy relacionados con otros profesionales del gremio, lo cual hace que su servicio', '2022-01-23'),
(10, '77033361J', 'No hay mejores profesionales a los que confiar el bienestar de tu mascota! QUE VIVA LA CLINICA ANIS´S MATE!!!', '2022-01-23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`servicio`,`cliente`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `fk_cliente_dueño` (`Dni_dueño`);

--
-- Indices de la tabla `dueño`
--
ALTER TABLE `dueño`
  ADD PRIMARY KEY (`Dni`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Id` (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indices de la tabla `testimonio`
--
ALTER TABLE `testimonio`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `fk_testimonio_dueño` (`Dni_autor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `testimonio`
--
ALTER TABLE `testimonio`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_dueño` FOREIGN KEY (`Dni_dueño`) REFERENCES `dueño` (`Dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `testimonio`
--
ALTER TABLE `testimonio`
  ADD CONSTRAINT `fk_testimonio_dueño` FOREIGN KEY (`Dni_autor`) REFERENCES `dueño` (`Dni`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
