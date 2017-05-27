-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2017 a las 22:53:14
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `songluvr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--

CREATE TABLE `genre` (
  `GenreId` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genreuser`
--

CREATE TABLE `genreuser` (
  `GenreId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `MessageId` int(11) NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messageuserall`
--

CREATE TABLE `messageuserall` (
  `MessageId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messageusergroup`
--

CREATE TABLE `messageusergroup` (
  `MessageId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `GroupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messageuseruser`
--

CREATE TABLE `messageuseruser` (
  `MessageId` int(11) NOT NULL,
  `SenderId` int(11) NOT NULL,
  `ReceiverId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musicgroup`
--

CREATE TABLE `musicgroup` (
  `GroupId` int(11) NOT NULL,
  `GenreId` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musicgroupuser`
--

CREATE TABLE `musicgroupuser` (
  `GroupId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `fullName` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `age` int(11) NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`GenreId`);

--
-- Indices de la tabla `genreuser`
--
ALTER TABLE `genreuser`
  ADD PRIMARY KEY (`GenreId`,`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageId`);

--
-- Indices de la tabla `messageuserall`
--
ALTER TABLE `messageuserall`
  ADD PRIMARY KEY (`MessageId`,`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indices de la tabla `messageusergroup`
--
ALTER TABLE `messageusergroup`
  ADD PRIMARY KEY (`MessageId`,`UserId`,`GroupId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `GroupId` (`GroupId`);

--
-- Indices de la tabla `messageuseruser`
--
ALTER TABLE `messageuseruser`
  ADD PRIMARY KEY (`MessageId`,`SenderId`,`ReceiverId`),
  ADD KEY `SenderId` (`SenderId`),
  ADD KEY `ReceiverId` (`ReceiverId`);

--
-- Indices de la tabla `musicgroup`
--
ALTER TABLE `musicgroup`
  ADD PRIMARY KEY (`GroupId`,`GenreId`,`name`),
  ADD KEY `GenreId` (`GenreId`);

--
-- Indices de la tabla `musicgroupuser`
--
ALTER TABLE `musicgroupuser`
  ADD PRIMARY KEY (`GroupId`,`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`,`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `genre`
--
ALTER TABLE `genre`
  MODIFY `GenreId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `MessageId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `musicgroup`
--
ALTER TABLE `musicgroup`
  MODIFY `GroupId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `genreuser`
--
ALTER TABLE `genreuser`
  ADD CONSTRAINT `genreuser_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genreuser_ibfk_2` FOREIGN KEY (`GenreId`) REFERENCES `genre` (`GenreId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `messageuserall`
--
ALTER TABLE `messageuserall`
  ADD CONSTRAINT `messageuserall_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `messageuserall_ibfk_2` FOREIGN KEY (`MessageId`) REFERENCES `message` (`MessageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `messageusergroup`
--
ALTER TABLE `messageusergroup`
  ADD CONSTRAINT `messageusergroup_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `messageusergroup_ibfk_2` FOREIGN KEY (`MessageId`) REFERENCES `message` (`MessageId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messageusergroup_ibfk_3` FOREIGN KEY (`GroupId`) REFERENCES `musicgroup` (`GroupId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `messageuseruser`
--
ALTER TABLE `messageuseruser`
  ADD CONSTRAINT `messageuseruser_ibfk_1` FOREIGN KEY (`SenderId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `messageuseruser_ibfk_2` FOREIGN KEY (`ReceiverId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `messageuseruser_ibfk_3` FOREIGN KEY (`MessageId`) REFERENCES `message` (`MessageId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `musicgroup`
--
ALTER TABLE `musicgroup`
  ADD CONSTRAINT `musicgroup_ibfk_1` FOREIGN KEY (`GenreId`) REFERENCES `genre` (`GenreId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `musicgroupuser`
--
ALTER TABLE `musicgroupuser`
  ADD CONSTRAINT `musicgroupuser_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `musicgroupuser_ibfk_2` FOREIGN KEY (`GroupId`) REFERENCES `musicgroup` (`GroupId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
