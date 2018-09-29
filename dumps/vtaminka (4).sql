-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 23 2018 г., 09:45
-- Версия сервера: 5.7.19
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vtaminka`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`categoryID`),
  UNIQUE KEY `categoryTitle` (`categoryTitle`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryTitle`) VALUES
(24, 'Категория 1');

-- --------------------------------------------------------

--
-- Структура таблицы `constants`
--

DROP TABLE IF EXISTS `constants`;
CREATE TABLE IF NOT EXISTS `constants` (
  `constantID` int(11) NOT NULL AUTO_INCREMENT,
  `constantTitle` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  UNIQUE KEY `constantID` (`constantID`),
  UNIQUE KEY `constantTitle` (`constantTitle`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `constants`
--

INSERT INTO `constants` (`constantID`, `constantTitle`) VALUES
(4, 'LAYOUT_BLOG'),
(1, 'MAIN_TITLE'),
(3, 'SETTINGS');

-- --------------------------------------------------------

--
-- Структура таблицы `creditcards`
--

DROP TABLE IF EXISTS `creditcards`;
CREATE TABLE IF NOT EXISTS `creditcards` (
  `cardID` int(11) NOT NULL,
  `cardNumber` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `year` year(4) NOT NULL,
  `month` tinyint(3) UNSIGNED NOT NULL,
  `securityCode` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `creditcards`
--

INSERT INTO `creditcards` (`cardID`, `cardNumber`, `name`, `year`, `month`, `securityCode`) VALUES
(1, '1111', 'Имя', 2012, 1, 1111);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedbackID` int(11) NOT NULL AUTO_INCREMENT,
  `userFullName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPhone` varchar(25) NOT NULL,
  `feedbackText` varchar(1000) NOT NULL,
  PRIMARY KEY (`feedbackID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `userFullName`, `userEmail`, `userPhone`, `feedbackText`) VALUES
(1, 'Alex', 'Alex@gmail.com', 'Alex@gmail.com', 'Text'),
(2, 'Имя Имя', 'email@gmail.com', '30213902103', 'Lorem Lorem Lorem Lorem Lorem Lorem ');

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `langID` int(6) UNSIGNED NOT NULL,
  `langTag` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`langID`),
  UNIQUE KEY `langTag` (`langTag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`langID`, `langTag`) VALUES
(1, 'en-US '),
(8, 'en_001'),
(2, 'ru-RU');

-- --------------------------------------------------------

--
-- Структура таблицы `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderDetailsID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `amountProduct` int(11) NOT NULL,
  `productPrice` double NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  PRIMARY KEY (`orderDetailsID`),
  KEY `fk_orderDetailsAndProductID` (`productID`),
  KEY `fk_OrderIDKey` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderdetails`
--

INSERT INTO `orderdetails` (`orderDetailsID`, `productID`, `amountProduct`, `productPrice`, `orderID`) VALUES
(14, 1, 5, 100, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `statusID` int(11) NOT NULL,
  `dateAndTimeOrder` datetime NOT NULL,
  `deliveryAddressOrder` varchar(170) NOT NULL,
  `commentToTheOrder` varchar(500) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `fk_statusID` (`statusID`),
  KEY `fk_userID` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`orderID`, `statusID`, `dateAndTimeOrder`, `deliveryAddressOrder`, `commentToTheOrder`, `userID`) VALUES
(7, 1, '2018-09-23 12:08:35', 'Address 77', ' HEllo!', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `orderstatuses`
--

DROP TABLE IF EXISTS `orderstatuses`;
CREATE TABLE IF NOT EXISTS `orderstatuses` (
  `statusID` int(11) NOT NULL AUTO_INCREMENT,
  `statusTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderstatuses`
--

INSERT INTO `orderstatuses` (`statusID`, `statusTitle`) VALUES
(1, 'Новый'),
(2, 'Выполнен'),
(4, 'В обработке');

-- --------------------------------------------------------

--
-- Структура таблицы `productandattributes`
--

DROP TABLE IF EXISTS `productandattributes`;
CREATE TABLE IF NOT EXISTS `productandattributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attributeID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `value` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Product_Constraint` (`productID`),
  KEY `fk_Attribute_Constraint` (`attributeID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productandattributes`
--

INSERT INTO `productandattributes` (`id`, `attributeID`, `productID`, `value`) VALUES
(1, 2, 1, '500'),
(2, 1, 1, '1000'),
(3, 2, 2, '500'),
(4, 1, 2, '1000'),
(5, 2, 3, '500'),
(6, 1, 3, '1000'),
(7, 7, 3, 'Состав'),
(8, 2, 4, '500'),
(9, 1, 4, '1000'),
(10, 7, 4, '750'),
(11, 2, 5, '400'),
(12, 1, 5, '800');

-- --------------------------------------------------------

--
-- Структура таблицы `productandcategories`
--

DROP TABLE IF EXISTS `productandcategories`;
CREATE TABLE IF NOT EXISTS `productandcategories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_categoryID` (`categoryID`),
  KEY `fk_productID` (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productandcategories`
--

INSERT INTO `productandcategories` (`ID`, `categoryID`, `productID`) VALUES
(14, 24, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `productattributes`
--

DROP TABLE IF EXISTS `productattributes`;
CREATE TABLE IF NOT EXISTS `productattributes` (
  `attributeID` int(11) NOT NULL AUTO_INCREMENT,
  `attributeTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`attributeID`),
  UNIQUE KEY `attributeTitle` (`attributeTitle`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productattributes`
--

INSERT INTO `productattributes` (`attributeID`, `attributeTitle`) VALUES
(2, 'Дозировка на 6 месяцев'),
(1, 'Дозировка на год'),
(5, 'Дополнительные факты'),
(6, 'Количество в упаковке'),
(4, 'Противопоказания'),
(7, 'Состав');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productTitle` varchar(70) NOT NULL,
  `productDescription` varchar(500) NOT NULL,
  `productPrice` double NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`productID`, `productTitle`, `productDescription`, `productPrice`) VALUES
(1, 'Товар 1', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem ', 100),
(2, 'Товар 2', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem ', 100),
(3, 'Товар 3', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem ', 250),
(4, 'Товар 4', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem ', 350),
(5, 'Товар 777', 'Lorem', 777),
(6, 'Товар 1', 'Lorem', 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `translationID` int(11) NOT NULL AUTO_INCREMENT,
  `translationTag` int(11) NOT NULL,
  `translationConst` int(11) NOT NULL,
  `translationsText` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`translationID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `translations`
--

INSERT INTO `translations` (`translationID`, `translationTag`, `translationConst`, `translationsText`) VALUES
(19, 1, 1, 'Home'),
(20, 2, 1, 'Главная'),
(21, 1, 3, 'Settings'),
(31, 2, 3, 'Настройки'),
(33, 2, 4, 'Блог'),
(34, 1, 4, 'Blog');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(75) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPhone` varchar(25) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userMailIndex` (`userEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userID`, `userName`, `userEmail`, `userPhone`) VALUES
(1, 'Вася', 'asdd@mail', '062-33-3-3'),
(2, 'Коля', 'kol@mail', '071-55-3-355'),
(3, 'Таня', 'tan@mail.ru', '095-570-12-355'),
(4, 'Alex', 'alex@gmail.com', '+2439832748');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `fk_OrderIDKey` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ProductKey` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_statusID` FOREIGN KEY (`statusID`) REFERENCES `orderstatuses` (`statusID`),
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Ограничения внешнего ключа таблицы `productandattributes`
--
ALTER TABLE `productandattributes`
  ADD CONSTRAINT `fk_Attribute_Constraint` FOREIGN KEY (`attributeID`) REFERENCES `productattributes` (`attributeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Product_Constraint` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productandcategories`
--
ALTER TABLE `productandcategories`
  ADD CONSTRAINT `fk_categoryID` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productID` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
