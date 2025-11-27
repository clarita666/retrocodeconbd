-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-11-2024 a las 22:38:51
-- Versión del servidor: 8.0.38
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_comics`
--
CREATE DATABASE IF NOT EXISTS `tienda_comics` DEFAULT CHARACTER SET utf8mb4;
USE `tienda_comics`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

CREATE TABLE `artistas` (
  `id` int NOT NULL,
  `nombre_completo` varchar(200) NOT NULL,
  `biografia` text NOT NULL,
  `foto_perfil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`id`, `nombre_completo`, `biografia`, `foto_perfil`) VALUES
(1, 'Joe Shuster', 'Joe Shuster fue un dibujante canadiense-estadounidense que, junto con Jerry Siegel, co-creó a Superman en 1938. Su diseño visual del personaje, incluyendo el icónico traje y capa, ha influenciado la representación de superhéroes desde entonces.', ''),
(2, 'John Byrne', 'John Byrne es un influyente dibujante y escritor de cómics, conocido por su trabajo en \"Superman\", \"X-Men\" y \"Fantastic Four\". En DC, revitalizó a Superman con \"The Man of Steel\" y tuvo una carrera significativa en títulos como \"Wonder Woman\" y \"Doom Patrol\".', ''),
(3, 'Patrick Gleason', 'Patrick Gleason es un artista de cómics contemporáneo, mejor conocido por su trabajo en \"Batman and Robin\" y \"Superman\". Su estilo dinámico y detallado ha sido muy apreciado por los fans, especialmente en su colaboración con Peter J. Tomasi.', ''),
(4, 'Bob Kane', 'Bob Kane fue un dibujante y creador de cómics, reconocido por co-crear a Batman en 1939 junto a Bill Finger. Su contribución visual definió la apariencia inicial de Batman, incluyendo la capucha, la capa y el estilo oscuro de Gotham City.', ''),
(6, 'David Finch', 'David Finch es un dibujante canadiense conocido por su estilo oscuro y detallado. Ha trabajado en títulos icónicos de DC como \"Batman\", \"Wonder Woman\" y \"Justice League\". También es conocido por su trabajo en \"The Dark Knight\".', ''),
(7, 'H. G. Peter', 'H. G. Peter fue el dibujante original de \"Wonder Woman\", trabajando junto con William Moulton Marston. Creó el diseño icónico de la heroína y su mundo amazónico, siendo uno de los primeros en representar una superheroína en los cómics.', ''),
(8, 'Liam Sharp', 'Liam Sharp es un dibujante y escritor británico conocido por su trabajo en \"Green Lantern\", \"Wonder Woman\" y \"Batman\". Su estilo es caracterizado por su detallado arte y diseños épicos, que se adaptan perfectamente a las historias cósmicas y mitológicas de DC.', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comics`
--

CREATE TABLE `comics` (
  `id` int NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `volumen` tinyint NOT NULL,
  `numero` smallint NOT NULL,
  `publicacion` date NOT NULL,
  `origen` enum('Estados Unidos','Argentina','Europa','') NOT NULL,
  `editorial` varchar(200) NOT NULL,
  `bajada` text NOT NULL,
  `portada` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_personaje` int NOT NULL,
  `id_serie` int NOT NULL,
  `id_guionista` int NOT NULL,
  `id_artista` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `comics`
--

INSERT INTO `comics` (`id`, `titulo`, `volumen`, `numero`, `publicacion`, `origen`, `editorial`, `bajada`, `portada`, `precio`, `id_personaje`, `id_serie`, `id_guionista`, `id_artista`) VALUES
(1, 'Superman: La llegada', 1, 1, '1938-06-01', 'Estados Unidos', 'DC Comics', 'El debut de Superman en Action Comics #1', 'superman1.jpg', 2.99, 1, 1, 1, 1),
(2, 'Superman: Hijo de Krypton', 1, 2, '1939-03-01', 'Estados Unidos', 'DC Comics', 'Superman lucha por proteger Metrópolis de Lex Luthor', 'superman2.jpg\r\n', 2.99, 1, 1, 1, 1),
(3, 'Superman: El Hombre de Acero', 2, 1, '1986-10-01', 'Estados Unidos', 'DC Comics', 'Reinicio de la historia de Superman, escrito por John Byrne', 'superman3.jpg\r\n', 3.50, 1, 1, 2, 2),
(4, 'Superman: Para el hombre que lo tiene todo', 1, 400, '1985-02-01', 'Estados Unidos', 'DC Comics', 'Superman enfrenta una trampa mental de Mongul', 'superman4.jpg\r\n', 1.25, 1, 1, 1, 2),
(5, 'Superman: All-Star Superman', 1, 1, '2005-11-01', 'Estados Unidos', 'DC Comics', 'Una de las historias más aclamadas de Superman', 'superman5.jpg\r\n', 4.99, 1, 1, 5, 6),
(6, 'Superman: Tierra Uno', 1, 1, '2010-10-01', 'Estados Unidos', 'DC Comics', 'Reinvención moderna de la historia de Superman', 'superman6.jpg\r\n', 3.99, 1, 1, 5, 3),
(7, 'Batman: Año Uno', 1, 404, '1987-03-01', 'Estados Unidos', 'DC Comics', 'El origen definitivo de Batman, escrito por Frank Miller', 'batman1.jpg', 1.50, 2, 2, 4, 2),
(8, 'Batman: El Caballero Oscuro Regresa', 1, 1, '1986-06-01', 'Estados Unidos', 'DC Comics', 'Historia que redefine el futuro distópico de Batman dfnklsjfnkdljsjfklds', 'batman2.jpg', 3.99, 2, 2, 4, 2),
(9, 'Batman: La Broma Asesina', 1, 1, '1988-03-01', 'Estados Unidos', 'DC Comics', 'Historia que muestra el origen definitivo del Joker', 'batman3.jpg', 3.50, 2, 2, 4, 6),
(10, 'Batman: Silencio', 1, 608, '2002-12-01', 'Estados Unidos', 'DC Comics', 'Batman enfrenta una nueva amenaza llamada Silencio', 'batman4.jpg', 2.99, 2, 2, 5, 6),
(11, 'Batman: La Corte de los Búhos', 2, 1, '2011-11-01', 'Estados Unidos', 'DC Comics', 'Batman descubre una sociedad secreta en Gotham', 'batman5.jpg', 3.99, 2, 2, 5, 6),
(12, 'Batman: Detective Comics #27', 1, 27, '1939-05-01', 'Estados Unidos', 'DC Comics', 'Primera aparición de Batman', 'batman6.jpg', 2.99, 2, 2, 4, 4),
(13, 'Wonder Woman: Origen', 1, 1, '1942-12-01', 'Estados Unidos', 'DC Comics', 'Primera aparición de la Mujer Maravilla en su propia serie', 'mujermaravilla1.jpg', 2.99, 3, 3, 6, 7),
(14, 'Wonder Woman: Los ojos de Gorgona', 1, 200, '2004-05-01', 'Estados Unidos', 'DC Comics', 'Wonder Woman enfrenta a criaturas mitológicas', 'mujermaravilla2.jpg', 3.50, 3, 3, 5, 7),
(15, 'Wonder Woman: Renacimiento', 1, 1, '2016-06-01', 'Estados Unidos', 'DC Comics', 'Nuevo reinicio del personaje, escrito por Greg Rucka', 'mujermaravilla3.jpg', 3.99, 3, 3, 5, 8),
(16, 'Wonder Woman: Hiketeia', 1, 1, '2002-05-01', 'Estados Unidos', 'DC Comics', 'Wonder Woman debe cumplir un juramento antiguo que la enfrenta a Batman', 'mujermaravilla4.jpg', 2.99, 3, 3, 5, 7),
(17, 'Wonder Woman: Dioses y Mortales', 1, 1, '1987-02-01', 'Estados Unidos', 'DC Comics', 'La historia moderna que redefine a Wonder Woman', 'mujermaravilla5.jpg', 2.99, 3, 3, 7, 8),
(18, 'Wonder Woman: Tierra Uno', 1, 1, '2016-11-01', 'Estados Unidos', 'DC Comics', 'Reinvención moderna de la historia de Wonder Woman', 'mujermaravilla6.jpg', 4.99, 3, 3, 5, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guionistas`
--

CREATE TABLE `guionistas` (
  `id` int NOT NULL,
  `nombre_completo` varchar(200) NOT NULL,
  `biografia` text NOT NULL,
  `foto_perfil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `guionistas`
--

INSERT INTO `guionistas` (`id`, `nombre_completo`, `biografia`, `foto_perfil`) VALUES
(1, 'Jerry Siegel', 'Jerry Siegel fue un escritor estadounidense de cómics, co-creador de Superman junto a Joe Shuster en 1938. Su creación revolucionó el género de superhéroes y marcó el comienzo de la Edad de Oro de los cómics.', ''),
(2, 'John Byrne', 'John Byrne es un reconocido escritor y dibujante de cómics. Es famoso por su trabajo en la serie \"Superman\" en la década de 1980, donde revitalizó al personaje tras la miniserie \"The Man of Steel\". También es conocido por su trabajo en \"X-Men\" y \"Fantastic Four\".', ''),
(4, 'Bill Finger', 'Bill Finger fue un guionista y escritor de cómics que co-creó Batman junto a Bob Kane en 1939. Aunque su contribución fue subestimada durante años, se le reconoce como la mente detrás de muchos elementos clave del universo de Batman, incluyendo Gotham City y el Joker.', ''),
(5, 'Tom King', 'Tom King es un guionista de cómics contemporáneo, famoso por su trabajo en \"Batman\", \"Mister Miracle\" y \"The Vision\". También ha sido ganador de premios Eisner, y es reconocido por su enfoque psicológico y emocional en los personajes.', ''),
(6, 'William Moulton Marston', 'William Moulton Marston fue un psicólogo y escritor, mejor conocido por haber creado a la Mujer Maravilla en 1941. Marston también fue el inventor del polígrafo, conocido comúnmente como la \"máquina de la verdad\", lo que influenció el diseño del lazo de la verdad de Wonder Woman.', ''),
(7, 'George Pérez', 'George Pérez fue un aclamado dibujante y escritor de cómics, famoso por su trabajo en \"Crisis en Tierras Infinitas\", \"The New Teen Titans\" y \"Wonder Woman\". Su estilo detallado y su narrativa épica dejaron una marca imborrable en el cómic superheroico.', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes`
--

CREATE TABLE `personajes` (
  `id` int NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `biografia` text NOT NULL,
  `creador` varchar(200) NOT NULL,
  `primera_aparicion` year NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personajes`
--

INSERT INTO `personajes` (`id`, `nombre`, `alias`, `biografia`, `creador`, `primera_aparicion`, `imagen`) VALUES
(1, 'Clark Kent', 'Superman', 'Superman es un superhéroe ficticio creado por los escritores Jerry Siegel y Joe Shuster. Originario del planeta Krypton, es enviado a la Tierra como un bebé, donde es criado por humanos y crece para defender a la humanidad con sus poderes sobrehumanos.', 'Jerry Siegel y Joe Shuster', '1938', ''),
(2, 'Bruce Wayne', 'Batman', 'Batman es un superhéroe sin superpoderes, que utiliza su intelecto, habilidades de combate, y tecnología avanzada para luchar contra el crimen en Gotham City. Fue creado por Bob Kane y Bill Finger.', 'Bob Kane y Bill Finger', '1939', ''),
(3, 'Diana Prince', 'Mujer Maravilla', 'Mujer Maravilla es una princesa amazona y guerrera con habilidades sobrehumanas, creada por William Moulton Marston. Defiende la paz y la justicia.', 'William Moulton Marston', '1941', ''),
(4, 'Barry Allen', 'Flash', 'Barry Allen es el segundo Flash, un superhéroe con la habilidad de moverse a velocidades sobrehumanas. Creado por Robert Kanigher y Carmine Infantino, es miembro fundador de la Liga de la Justicia.', 'Robert Kanigher y Carmine Infantino', '1956', ''),
(5, 'Hal Jordan', 'Linterna Verde', 'Hal Jordan es un piloto que se convierte en el superhéroe Linterna Verde cuando recibe un anillo de poder alienígena que le otorga increíbles habilidades. Creado por John Broome y Gil Kane.', 'John Broome y Gil Kane', '1959', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id` int NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `historia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id`, `nombre`, `historia`) VALUES
(1, 'Superman', 'Superman sigue las aventuras de Clark Kent, un kryptoniano enviado a la Tierra de niño, que utiliza sus poderes sobrehumanos para proteger a la humanidad de diversas amenazas, incluyendo supervillanos y desastres naturales. Como Superman, lucha por la verdad, la justicia y el estilo de vida estadounidense.'),
(2, 'Batman', 'Batman narra las aventuras del multimillonario Bruce Wayne, quien, tras presenciar el asesinato de sus padres, decide combatir el crimen en Gotham City bajo la identidad de Batman, utilizando su intelecto, habilidades de combate y una vasta colección de artilugios y tecnología avanzada.'),
(3, 'Mujer-Maravilla', 'La serie de Mujer Maravilla sigue las aventuras de Diana, princesa de las Amazonas, quien abandona su isla paradisíaca para luchar por la paz y la justicia en el mundo de los humanos. Utiliza sus habilidades sobrehumanas y su equipamiento mítico, como el lazo de la verdad y los brazaletes indestructibles.'),
(4, 'Flash', 'Flash sigue las aventuras de Barry Allen, un científico forense que adquiere la capacidad de moverse a velocidades increíbles tras un accidente en su laboratorio. Conocido como el Hombre más Rápido del Mundo, usa su velocidad para combatir el crimen y otras amenazas en Central City.'),
(5, 'Linterna-Verde', 'Linterna Verde narra las aventuras de Hal Jordan, un piloto de pruebas que se convierte en el miembro de una fuerza policial intergaláctica llamada los Linterna Verde. Con su anillo de poder, que le otorga habilidades increíbles, lucha para proteger el universo de diversas amenazas cósmicas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `email` varchar(200) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `nombre_completo` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personaje` (`id_personaje`),
  ADD KEY `fk_serie` (`id_serie`),
  ADD KEY `fk_guion` (`id_guionista`),
  ADD KEY `fk_artista` (`id_artista`);

--
-- Indices de la tabla `guionistas`
--
ALTER TABLE `guionistas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personajes`
--
ALTER TABLE `personajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artistas`
--
ALTER TABLE `artistas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `guionistas`
--
ALTER TABLE `guionistas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `personajes`
--
ALTER TABLE `personajes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comics`
--
ALTER TABLE `comics`
  ADD CONSTRAINT `fk_artista` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_guion` FOREIGN KEY (`id_guionista`) REFERENCES `guionistas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_personaje` FOREIGN KEY (`id_personaje`) REFERENCES `personajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_serie` FOREIGN KEY (`id_serie`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
