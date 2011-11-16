-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 16 Lis 2011, 17:40
-- Wersja serwera: 5.5.16
-- Wersja PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `przychodnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `godziny pracy`
--

CREATE TABLE IF NOT EXISTS `godziny pracy` (
  `id_pracownika` int(6) NOT NULL,
  `dzien` varchar(16) NOT NULL,
  `godzina_od` time NOT NULL,
  `godzina_do` time NOT NULL,
  KEY `id_pracownika` (`id_pracownika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pacjenci`
--

CREATE TABLE IF NOT EXISTS `pacjenci` (
  `id_pacjenta` int(6) NOT NULL AUTO_INCREMENT,
  `pesel_pacjenta` varchar(11) NOT NULL,
  `haslo` varchar(32) NOT NULL,
  `imie` varchar(32) NOT NULL,
  `nazwisko` varchar(32) NOT NULL,
  `kod_pocztowy` varchar(6) NOT NULL,
  `miasto` varchar(32) NOT NULL,
  `ulica` varchar(32) CHARACTER SET utf32 NOT NULL,
  `nr_domu` int(4) NOT NULL,
  `nr_mieszkania` int(4) NOT NULL,
  `ubezpieczenie` varchar(64) NOT NULL,
  `telefon` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `czy_zmieniono_haslo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_pacjenta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `pacjenci`
--

INSERT INTO `pacjenci` (`id_pacjenta`, `pesel_pacjenta`, `haslo`, `imie`, `nazwisko`, `kod_pocztowy`, `miasto`, `ulica`, `nr_domu`, `nr_mieszkania`, `ubezpieczenie`, `telefon`, `email`, `czy_zmieniono_haslo`) VALUES
(1, '86060212345', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Piotr', 'Wągrowski', '12-456', 'Łódź', 'Rudzka', 13, 1, 'ABC123456789', '799466133', 'waglu86@o2.pl', 1),
(2, '89042815537', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Dawid', 'Kardas', '123-45', 'Tychów', 'Tychów', 75, 0, '999111', '6561245', 'doski@o2.pl', 0),
(3, '90082605936', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Maciej', 'Kacprzak', '91-162', 'Łódź', 'Jasne Błonia', 31, 0, '123XYZ', '513541316', 'kacprzak90@gmail.com', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pracownicy`
--

CREATE TABLE IF NOT EXISTS `pracownicy` (
  `id_pracownika` int(6) NOT NULL AUTO_INCREMENT,
  `pesel_pracownika` varchar(11) NOT NULL,
  `haslo` varchar(32) NOT NULL,
  `imie` varchar(32) NOT NULL,
  `nazwisko` varchar(32) NOT NULL,
  `telefon` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `specjalizacja` varchar(32) NOT NULL,
  `czy_zmieniono_haslo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_pracownika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`id_pracownika`, `pesel_pracownika`, `haslo`, `imie`, `nazwisko`, `telefon`, `email`, `specjalizacja`, `czy_zmieniono_haslo`) VALUES
(1, '58030581219', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Adrian', 'Małaszyński', '426561122', 'malaszynski@przychodnia.pl', 'Kardiolog', 0),
(2, '60023198128', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Adam', 'Adamiak', '426001234', 'adamiak@przychodnia.pl', 'kierownik', 1),
(3, '70060116982', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Antoni', 'Lubicz', '424001298', 'lubicz@przychodnia.pl', 'Chirurg', 1),
(4, '85021489467', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Halina', 'Szymborska', '425009876', 'szymborska@przychodnia.pl', 'sekretarka', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `wizyty`
--

CREATE TABLE IF NOT EXISTS `wizyty` (
  `id_wizyty` int(12) NOT NULL AUTO_INCREMENT,
  `id_pacjenta` int(6) NOT NULL,
  `id_pracownika` int(6) NOT NULL,
  `data` datetime NOT NULL,
  `opis` text NOT NULL,
  PRIMARY KEY (`id_wizyty`),
  KEY `id_pacjenta` (`id_pacjenta`),
  KEY `id_pracownika` (`id_pracownika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `wizyty`
--

INSERT INTO `wizyty` (`id_wizyty`, `id_pacjenta`, `id_pracownika`, `data`, `opis`) VALUES
(1, 1, 3, '2011-10-18 15:00:00', ''),
(2, 2, 1, '2011-10-13 10:00:00', 'Opis tej wizyty.'),
(3, 2, 3, '2011-10-20 08:00:00', ''),
(4, 3, 3, '2011-10-15 12:15:00', '');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `godziny pracy`
--
ALTER TABLE `godziny pracy`
  ADD CONSTRAINT `godziny@0020pracy_ibfk_1` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id_pracownika`);

--
-- Ograniczenia dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  ADD CONSTRAINT `wizyty_ibfk_2` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownicy` (`id_pracownika`),
  ADD CONSTRAINT `wizyty_ibfk_1` FOREIGN KEY (`id_pacjenta`) REFERENCES `pacjenci` (`id_pacjenta`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
