-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2017 a las 15:36:11
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
-- Estructura de tabla para la tabla `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `email1` varchar(50) COLLATE utf8_bin NOT NULL,
  `email2` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `conversation`
--

INSERT INTO `conversation` (`id`, `email1`, `email2`) VALUES
(1, 'anagarc@gmail.com', 'sergio@admin.com'),
(2, 'adrimu@ucm.es', 'sergio@admin.com'),
(3, 'sergio@admin.com', 'apascual@ucm.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--

CREATE TABLE `genre` (
  `name` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `genre`
--

INSERT INTO `genre` (`name`) VALUES
('classic'),
('jazz'),
('metal'),
('pop'),
('punk'),
('rock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre_user`
--

CREATE TABLE `genre_user` (
  `genreName` varchar(20) COLLATE utf8_bin NOT NULL,
  `userEmail` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `genre_user`
--

INSERT INTO `genre_user` (`genreName`, `userEmail`) VALUES
('classic', 'anagarc@gmail.com'),
('jazz', 'anagarc@gmail.com'),
('jazz', 'sergio@admin.com'),
('metal', 'apascual@ucm.es'),
('metal', 'sergio@admin.com'),
('pop', 'anagarc@gmail.com'),
('punk', 'apascual@ucm.es'),
('punk', 'sergio@admin.com'),
('rock', 'apascual@ucm.es'),
('rock', 'sergio@admin.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_chat`
--

CREATE TABLE `group_chat` (
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `genreName` varchar(20) COLLATE utf8_bin NOT NULL,
  `maxAge` int(11) NOT NULL,
  `minAge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_chat_user`
--

CREATE TABLE `group_chat_user` (
  `groupName` varchar(50) COLLATE utf8_bin NOT NULL,
  `userEmail` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sentText` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `message`
--

INSERT INTO `message` (`id`, `sentText`) VALUES
(1, 'hola'),
(2, 'otro maaaas'),
(3, 'funciona'),
(4, 'hola soy ana'),
(5, 'hola soy sergio'),
(8, 'hola soy adri'),
(9, 'hola soy sergio, andres'),
(10, 'hola adri, que tal?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_conversation`
--

CREATE TABLE `message_conversation` (
  `messageId` int(11) NOT NULL,
  `conversationId` int(11) NOT NULL,
  `senderEmail` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `message_conversation`
--

INSERT INTO `message_conversation` (`messageId`, `conversationId`, `senderEmail`) VALUES
(4, 1, 'anagarc@gmail.com'),
(5, 1, 'sergio@admin.com'),
(8, 2, 'adrimu@ucm.es'),
(9, 3, 'sergio@admin.com'),
(10, 2, 'sergio@admin.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_user_all`
--

CREATE TABLE `message_user_all` (
  `messageId` int(11) NOT NULL,
  `userEmail` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `message_user_all`
--

INSERT INTO `message_user_all` (`messageId`, `userEmail`) VALUES
(1, 'sergio@admin.com'),
(2, 'sergio@admin.com'),
(3, 'sergio@admin.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_user_group_chat`
--

CREATE TABLE `message_user_group_chat` (
  `messageId` int(11) NOT NULL,
  `userEmail` varchar(50) COLLATE utf8_bin NOT NULL,
  `groupName` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`email`, `name`, `password`, `age`) VALUES
('adrimu@ucm.es', 'Adrián Muñoz', 'ohohoh', 21),
('anagarc@gmail.com', 'Ana Garcí­a', 'ana', 46),
('apascual@ucm.es', 'Andrés Pascual', 'pohchico', 28),
('sergio@admin.com', 'Sergio Ulloa', 'polloloco', 21);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`,`email1`,`email2`),
  ADD KEY `email2` (`email2`),
  ADD KEY `email1` (`email1`);

--
-- Indices de la tabla `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `genre_user`
--
ALTER TABLE `genre_user`
  ADD PRIMARY KEY (`genreName`,`userEmail`),
  ADD KEY `userEmail` (`userEmail`);

--
-- Indices de la tabla `group_chat`
--
ALTER TABLE `group_chat`
  ADD PRIMARY KEY (`name`,`genreName`),
  ADD KEY `genreName` (`genreName`);

--
-- Indices de la tabla `group_chat_user`
--
ALTER TABLE `group_chat_user`
  ADD PRIMARY KEY (`groupName`,`userEmail`),
  ADD KEY `userEmail` (`userEmail`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `message_conversation`
--
ALTER TABLE `message_conversation`
  ADD PRIMARY KEY (`messageId`,`conversationId`,`senderEmail`),
  ADD KEY `conversationId` (`conversationId`),
  ADD KEY `senderEmail` (`senderEmail`);

--
-- Indices de la tabla `message_user_all`
--
ALTER TABLE `message_user_all`
  ADD PRIMARY KEY (`messageId`,`userEmail`),
  ADD KEY `userEmail` (`userEmail`);

--
-- Indices de la tabla `message_user_group_chat`
--
ALTER TABLE `message_user_group_chat`
  ADD PRIMARY KEY (`messageId`,`userEmail`,`groupName`),
  ADD KEY `groupName` (`groupName`),
  ADD KEY `userEmail` (`userEmail`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`email2`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `conversation_ibfk_3` FOREIGN KEY (`email1`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `genre_user`
--
ALTER TABLE `genre_user`
  ADD CONSTRAINT `genre_user_ibfk_1` FOREIGN KEY (`userEmail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genre_user_ibfk_2` FOREIGN KEY (`genreName`) REFERENCES `genre` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `group_chat`
--
ALTER TABLE `group_chat`
  ADD CONSTRAINT `group_chat_ibfk_1` FOREIGN KEY (`genreName`) REFERENCES `genre` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `group_chat_user`
--
ALTER TABLE `group_chat_user`
  ADD CONSTRAINT `group_chat_user_ibfk_1` FOREIGN KEY (`groupName`) REFERENCES `group_chat` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_chat_user_ibfk_2` FOREIGN KEY (`userEmail`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `message_conversation`
--
ALTER TABLE `message_conversation`
  ADD CONSTRAINT `message_conversation_ibfk_1` FOREIGN KEY (`conversationId`) REFERENCES `conversation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_conversation_ibfk_2` FOREIGN KEY (`messageId`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_conversation_ibfk_3` FOREIGN KEY (`senderEmail`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `message_user_all`
--
ALTER TABLE `message_user_all`
  ADD CONSTRAINT `message_user_all_ibfk_1` FOREIGN KEY (`userEmail`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `message_user_all_ibfk_2` FOREIGN KEY (`messageId`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `message_user_group_chat`
--
ALTER TABLE `message_user_group_chat`
  ADD CONSTRAINT `message_user_group_chat_ibfk_1` FOREIGN KEY (`messageId`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_user_group_chat_ibfk_3` FOREIGN KEY (`groupName`) REFERENCES `group_chat` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_user_group_chat_ibfk_4` FOREIGN KEY (`userEmail`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
