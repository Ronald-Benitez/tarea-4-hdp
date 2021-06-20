-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bc6czfoxtrluyaagzqw2-mysql.services.clever-cloud.com:3306
-- Generation Time: Jun 20, 2021 at 09:27 PM
-- Server version: 8.0.22-13
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bc6czfoxtrluyaagzqw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int NOT NULL,
  `fechaC` datetime NOT NULL,
  `idPost` int NOT NULL,
  `idUsuario` int NOT NULL,
  `texto` text NOT NULL,
  `estadoC` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `fechaC`, `idPost`, `idUsuario`, `texto`, `estadoC`) VALUES
(6, '2021-06-15 14:49:24', 17, 1, 'Prueba para aceptar', 'aprobado'),
(7, '2021-06-16 13:52:06', 16, 1, 'si', 'aprobado'),
(8, '2021-06-16 13:57:26', 16, 1, 'no', 'aprobado'),
(9, '2021-06-16 22:05:15', 16, 27, 'Prueba admin', 'aprobado'),
(10, '2021-06-16 22:25:11', 17, 27, 'a', 'aprobado'),
(13, '2021-06-16 22:48:16', 16, 28, 'asd', 'esperando'),
(14, '2021-06-20 11:06:39', 19, 27, 'Prueba de ingreso de comentario con feedback', 'esperando'),
(15, '2021-06-20 11:07:40', 19, 27, 'a', 'esperando'),
(16, '2021-06-20 12:18:38', 16, 27, 'Prueba con feedback', 'aprobado');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `idPost` int NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int NOT NULL,
  `titulo` tinytext NOT NULL,
  `imagen` tinytext NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`idPost`, `fecha`, `idUsuario`, `titulo`, `imagen`, `texto`) VALUES
(16, '2021-06-20 13:34:41', 27, 'Duplicador de bloques con gravedad', 'Captura de pantalla (267).png', 'Duplicadores odiados y amados por igual, no entraremos en detalles sobre si es correcto o no, cada quien decide como jugar, lo que podemos decir es que son lo más útil cuando se quieren hacer construcciones grandes, permitiéndonos generar mucha arena para cristal o bloques de cemento para poder hacer hormigón. '),
(17, '2021-06-16 14:42:23', 1, 'Transportar pandas por el nether', '2020-01-14_15.35.27.png', 'Si se quiere mover un panda de una selva a tu casa, lo cual comente implicara recorrer una larga distancia, lo más conveniente es realizarlo a través del nether, para hacer la tarea más fácil los siguientes pasos serán de utilidad.\r\n\r\n1- Localizar al panda\r\n2- Crear los portales y verificar se encuentren a la misma altura, esto se puede hacer presionando F3 y verificando la coordenada Y\r\n3- Construir el camino de mínimo 2x2 bloques con base de hielo, para ahorrar materiales se puede poner una línea de hielo y la otra de aire\r\n4- Meter el panda al nether\r\n5- Subirlo a una barca y listo el transporte será más facil '),
(18, '2021-06-16 14:41:40', 1, 'Hornos automaticos', 'Captura de pantalla (246).png', 'Los hornos automáticos son una buena opción a la hora de cocinar/fundir materiales, poner los materiales en un cofre y que el resultado aparezca en otro, sin preocuparnos por poner materiales de diferentes tipos.\r\n\r\nSe debe tener en un cuenta dos factores principales\r\n\r\n1- Velocidad del horno, esta dependerá de cuentas hornos se utilicen en el sistema, entre más hornos mayor velocidad y mayor consumo de combustible\r\n2- Combustible tener una fuente de combustible fácil de obtener es primordial dos buenas opciones son la granja de bambú y la de algas'),
(19, '2021-06-16 14:41:16', 1, 'Granjas de XP', '2020-03-29_07.30.18.png', 'Son muy útiles tanto en el early game como en el late game, al permitir generar partículas de XP de manera más fácil e incluso automática, quitando horas de farmeo, existen desde las más básicas con granjas de pollos, las más comunes que son las hechas a partir de mob spawners y las más eficaces que se obtienen con endermans también existe la posibilidad de usar una granja de oro como granja de xp, permitiendo tener doble farmeo o incluso triple si se conecta con una granja de comercio con Pigman '),
(22, '2021-06-16 14:40:16', 1, 'Minar chunks', '2020-03-28_19.02.47.png', 'Puede ser una opción poco atractiva en un principio, pero tiene se gracia, teniendo herramientas decentes tiende a ser relajante, si tienes muchas herramientas y no les encuentras un uso ese podría ser uno, además de la gran cantidad de materiales que se pueden almacenar para su posterior uso'),
(23, '2021-06-20 13:56:24', 27, 'Bugs', 'Captura de pantalla (256).png', 'Bugs, se los hay graciosos y estresantes, desde un simple zombie blanco hasta generación de terreno sin sentido  '),
(26, '2021-06-20 13:49:16', 27, 'Generador de madera', 'Captura de pantalla (269).png', 'Los generadores de cualquier recurso te facilitan el farmeo, en caso de la madera al ser un material muy importante, poder generarla con facilidad facilidad, marca un antes y después en el survival.');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int NOT NULL,
  `usuario` tinytext NOT NULL,
  `correo` tinytext NOT NULL,
  `contrasena` tinytext NOT NULL,
  `tipo` tinytext NOT NULL,
  `estado` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `correo`, `contrasena`, `tipo`, `estado`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$LLzsGfez3t8PnqXL4za7ueSLvToTOrOIWhpIe0dX.P4/htumTBu9O', 'admin', 'habilitado'),
(27, 'Ronald', 'ronald@gmail.com', '$2y$10$bDPEyPM2k7L9H7juXiQcteTZcO8T0qH3PwsKrCO8mXnnBB//17I5m', 'admin', 'habilitado'),
(28, 'prueba2', 'pru@gmail.com', '$2y$10$LTH5gx3SIWgJEG2/VNHA8uf8pRbQUu6r8UPNJ0Jm7rJrTsbiGcGMS', 'viewer', 'habilitado'),
(29, 'prueba35', 'prueba35@gmail.com', '$2y$10$LM5/zIh4TgVt.2ry/oCFDOcmBpGL20dNvscA/cuYWNPPq2vij8AWW', 'viewer', 'deshabilitado'),
(42, 'Admin3', 'admin3@gmail.com', '$2y$10$23Mn3hRjnweMZd48HCV2AeaJBUNa2Qa7.GDsiBFSR1eLstAPlOlT2', 'admin', 'habilitado'),
(43, 'Viewer', 'viewer@gmail.com', '$2y$10$P2M1qnrA/r1nVgygGIILYu2IOOaIDOjEMjjWe2QJDhHK1HyTRozq2', 'viewer', 'habilitado'),
(44, 'Pepe', 'pepe@gmail.com', '$2y$10$zw44EBsGBpiu9NQeXrups.0nj.heuf4n3izINB9HlY6rXabrdlBz2', 'viewer', 'habilitado');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idPost` (`idPost`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
