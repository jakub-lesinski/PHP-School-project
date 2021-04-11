-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Kwi 2021, 21:32
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projektphp`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `Id_klienta` int(11) NOT NULL,
  `Imie` varchar(60) NOT NULL,
  `Nazwisko` varchar(60) NOT NULL,
  `Pesel` varchar(11) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`Id_klienta`, `Imie`, `Nazwisko`, `Pesel`, `Email`, `Haslo`) VALUES
(16, 'Jakub', 'Lesina', '12315465555', 'Jak-les@wp.pl', '4356a21b1b6643f1514a7c50e80d6fbdc0486a97567d193ce483c2538493713a'),
(17, 'Jakub Lesiński', 'Lesina', '12315465553', 'Jak-less@wp.pl', '4356a21b1b6643f1514a7c50e80d6fbdc0486a97567d193ce483c2538493713a');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `Id_produktu` int(11) NOT NULL,
  `Rodzaj` varchar(60) NOT NULL,
  `Marka` varchar(60) NOT NULL,
  `Model` varchar(60) NOT NULL,
  `Rok_Produkcji` varchar(4) NOT NULL,
  `Rodzaj_Paliwa` varchar(60) NOT NULL,
  `Pojemnosc` varchar(11) NOT NULL,
  `Naped` varchar(60) NOT NULL,
  `Skrzynia` varchar(10) NOT NULL,
  `Przebieg` varchar(20) NOT NULL,
  `Opis` text NOT NULL,
  `Cena` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`Id_produktu`, `Rodzaj`, `Marka`, `Model`, `Rok_Produkcji`, `Rodzaj_Paliwa`, `Pojemnosc`, `Naped`, `Skrzynia`, `Przebieg`, `Opis`, `Cena`) VALUES
(13, 'Sportowy', 'Volkswagen', 'Polo', '2003', 'Diesel', '1900', 'Przód', 'Manualna', '150000', 'Super opis samochodu taki prze fajny jooo super chiper ajai tak super bradzo bardzo barrdzo barrzddo', '6000'),
(14, 'Sportowy', 'BMW', 'M2', '2012', 'Benzyna', '3000', 'Tył', 'Manualna', '2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus tellus, varius maximus tempor et, auctor egestas lacus. Duis vitae nulla id augue tincidunt aliquam. Phasellus venenatis tincidunt ultricies. Mauris vitae neque euismod, euismod ligula et, malesuada urna. Suspendisse quis nisi lacinia, viverra mauris et, sollicitudin mi. Praesent non sem gravida, placerat ipsum id, commodo quam. Praesent nec viverra mauris. Suspendisse quis sem accumsan, commodo elit et, vehicula lectus.', '45000'),
(15, 'Sportowy', 'BMW', 'M2', '2012', 'Benzyna', '3000', 'Tył', 'Manualna', '2', 'dadadasadwadwadawda dasda ad adas ad ad', '6000'),
(16, 'Miejski', 'Audi', 'A3', '2006', 'Diesel', '2000', 'Przód', 'Manualna', '150000', 'opis taki że hej supcio byczq jest gitara fest mniamuśno', '20000'),
(17, 'Sedan', 'BMW', 'E36', '1999', 'Benzyna', '3000', 'Tył', 'Manualna', '10', 'Super gruz do driftu jest fest', '2500');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_zdjęcia`
--

CREATE TABLE `produkty_zdjęcia` (
  `Id_zdjecia` int(11) NOT NULL,
  `Id_produktu` int(11) NOT NULL,
  `Url_zdjecia` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty_zdjęcia`
--

INSERT INTO `produkty_zdjęcia` (`Id_zdjecia`, `Id_produktu`, `Url_zdjecia`) VALUES
(9, 13, '61436559_2145467425507541_6567479941657526272_o.jpg'),
(10, 14, '123725621_3541444025916187_3713991387430718463_o.jpg'),
(11, 15, '123622947_3360952970654443_7243690563512009231_o.jpg'),
(12, 16, 'tuning-342255_960_720.jpg'),
(13, 17, 'car-5882655_960_720.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `Id_rezerwacji` int(11) NOT NULL,
  `Id_klienta` int(11) NOT NULL,
  `Id_produktu` int(11) NOT NULL,
  `Czas_rezerwacji` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rezerwacje`
--

INSERT INTO `rezerwacje` (`Id_rezerwacji`, `Id_klienta`, `Id_produktu`, `Czas_rezerwacji`) VALUES
(1, 16, 14, '2021-04-11'),
(28, 16, 15, '2021-04-11'),
(30, 16, 13, '2021-04-11');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `użytkownicy`
--

CREATE TABLE `użytkownicy` (
  `Id_użytkownika` int(11) NOT NULL,
  `Id_klienta` int(11) NOT NULL,
  `Is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `użytkownicy`
--

INSERT INTO `użytkownicy` (`Id_użytkownika`, `Id_klienta`, `Is_admin`) VALUES
(1, 16, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wiadomosci`
--

CREATE TABLE `wiadomosci` (
  `Id_wiadomosci` int(11) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Temat` varchar(60) NOT NULL,
  `Tresc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wiadomosci`
--

INSERT INTO `wiadomosci` (`Id_wiadomosci`, `Email`, `Temat`, `Tresc`) VALUES
(1, 'kajale@interia.eu', 'Auto', 'Dupsko suypsko');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`Id_klienta`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`Id_produktu`);

--
-- Indeksy dla tabeli `produkty_zdjęcia`
--
ALTER TABLE `produkty_zdjęcia`
  ADD PRIMARY KEY (`Id_zdjecia`),
  ADD UNIQUE KEY `Id_produktu` (`Id_produktu`) USING BTREE;

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`Id_rezerwacji`),
  ADD UNIQUE KEY `Id_produktu` (`Id_produktu`);

--
-- Indeksy dla tabeli `użytkownicy`
--
ALTER TABLE `użytkownicy`
  ADD PRIMARY KEY (`Id_użytkownika`),
  ADD UNIQUE KEY `Id_klienta` (`Id_klienta`);

--
-- Indeksy dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  ADD PRIMARY KEY (`Id_wiadomosci`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `Id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `Id_produktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `produkty_zdjęcia`
--
ALTER TABLE `produkty_zdjęcia`
  MODIFY `Id_zdjecia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `Id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT dla tabeli `użytkownicy`
--
ALTER TABLE `użytkownicy`
  MODIFY `Id_użytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  MODIFY `Id_wiadomosci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `produkty_zdjęcia`
--
ALTER TABLE `produkty_zdjęcia`
  ADD CONSTRAINT `produkty_zdjęcia_ibfk_1` FOREIGN KEY (`Id_produktu`) REFERENCES `produkty` (`Id_produktu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`Id_produktu`) REFERENCES `produkty` (`Id_produktu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `użytkownicy`
--
ALTER TABLE `użytkownicy`
  ADD CONSTRAINT `użytkownicy_ibfk_1` FOREIGN KEY (`Id_klienta`) REFERENCES `klienci` (`Id_klienta`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
