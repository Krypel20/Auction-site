-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Kwi 2024, 18:45
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
-- Baza danych: `serwissprzedazowy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auctions`
--

CREATE TABLE `auctions` (
  `auctionID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `itemName` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `category` varchar(124) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `endDate` timestamp NULL DEFAULT NULL,
  `askingPrice` decimal(10,2) DEFAULT NULL,
  `currentPrice` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `auctioneerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `auctions`
--

INSERT INTO `auctions` (`auctionID`, `userID`, `creationDate`, `itemName`, `category`, `picture`, `description`, `endDate`, `askingPrice`, `currentPrice`, `status`, `auctioneerID`) VALUES
(6, 9, '2023-11-22 12:07:15', 'Rower', 'Sport i rekreacja', 'bike.jpg', 'Nowy rower górski, idealny do jazdy w terenie.', '2024-01-03 19:00:00', '5000.00', '8150.00', 'Closed', 25),
(7, 27, '2023-11-22 12:19:12', 'Stół bilardowy', 'Sport i rekreacja', 'billard.jpg', 'Stół w nienaruszonym stanie, sprzedawany wraz z zestawem bil i dwoma kijami', '2023-12-30 09:00:00', '8255.00', '9412.00', 'Closed', 30),
(10, 25, '2023-11-22 20:32:38', 'Zegar zabytkowy', 'Antyki', 'zegar.jpg', 'Zegar z XIX wieku. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2024-01-01 17:06:23', '4199.00', '4401.00', 'Closed', 3),
(11, 27, '2023-12-13 20:39:13', 'Głośniki', 'Sprzęt AGD', 'glosniki.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce euismod molestie nunc, ac viverra dui venenatis id. Nullam nec ligula vitae arcu mattis ultricies. Sed bibendum sapien at purus lobortis, vel interdum justo volutpat. Suspendisse nec justo ut arcu fermentum feugiat. Proin rhoncus semper mauris, vel efficitur ligula ultrices eu. Integer auctor sapien vel turpis vehicula, ut sollicitudin tortor fringilla. Vivamus gravida tortor eget ligula consequat, ut ullamcorper elit tincidunt. Sed ', '2023-12-16 19:00:00', '340.00', '370.00', 'Closed', 16),
(12, 29, '2023-12-13 21:27:43', 'Honda Civic 10 2.0 VTEC TURBO 320 KM (2020)', 'Motoryzacja', 'civic10.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce euismod molestie nunc, ac viverra dui venenatis id. Nullam nec ligula vitae arcu mattis ultricies. Sed bibendum sapien at purus lobortis, vel interdum justo volutpat.', '2024-01-31 11:00:00', '83400.00', '844662.00', 'Active', 25),
(13, 16, '2023-12-26 08:24:47', 'Choinka', 'Dom i Ogród', 'choinka.png', 'Piękna, pachnąca choinka prosto z magicznego lasu! Ta wyjątkowa choinka została starannie wybrana i wycięta, aby ozdobić Twoje wnętrze podczas magicznego okresu świąt. Jej gęste gałęzie są idealne do zawieszania ozdób, a świeże igły wypełnią Twoje domostwo świątecznym aromatem. To nie tylko drzewko, to fragment natury, który przyniesie radość i ciepło do Twojego domu. Rozpocznij świąteczne przygotowania w wyjątkowy sposób, licytując tę uroczą choinkę na naszej aukcji! Czekamy na Ciebie z radością!', '2024-01-05 09:30:00', '600.00', '7261.00', 'Active', 25),
(15, 25, '2024-01-13 22:38:01', 'Puzon ', 'Instrumenty Muzyczne', 'puzon.png', 'Instrument dęty blaszany należący do grupy aerofonów ustnikowych. Wykonany jest w całości z metalu, oraz posiada cylindryczny ustnik w kształcie kielicha.', '2024-01-06 23:00:00', '520.00', '520.00', 'Active', NULL),
(21, 3, '2023-12-28 11:30:14', 'Aparat NIKON D7500 Body', 'Fotografia', 'aparat-Nikon-d7500-BODY-uzywany-B001.jpg658d5c4612ffc8.86440225.jpg', 'Profesjonalny aparat DSLR NIKON D7500 Body, który jest doskonałym narzędziem dla miłośników fotografii, zarówno amatorów, jak i profesjonalistów. Oto kilka kluczowych cech tego niezawodnego aparatu:\r\n\r\nSpecyfikacje:\r\n\r\nMatryca: 20.9 MP DX-Format CMOS\r\nProcesor obrazu: EXPEED 5\r\nZakres czułości ISO: 100-51,200 (rozszerzalny do 50-1,640,000)\r\nSystem AF: 51 punktów AF z 15 krzyżowymi czujnikami\r\nNagrywanie wideo: 4K UHD przy 30 fps\r\nWyświetlacz: 3.2-calowy kątowy ekran dotykowy kolorowy LCD\r\nBurst Shooting: Do 8 kl./s', '2024-01-19 11:29:00', '3100.00', '3355.00', 'Active', 4),
(22, 30, '2023-12-29 13:15:45', 'Dron DJI Mini 3', 'Elektronika', 'dron.png658ec681cfab33.70186739.png', 'Na sprzedaż ląduje mini 3 pro z rc-n1 + fly more combo. 307 dni temu aktywowany, na ten moment przelatane 21h. Sprzedaję cały zestaw, gotowy do lotu. Dron wraz z kartą pamięci i osłonami śmigieł. Nigdy nie zaliczył kraksy. Dji care aktywne jeszcze 60 dni. Baterie cykle: 23/24/25.', '2024-01-06 13:15:00', '2400.00', '2560.00', 'Active', 16),
(24, 30, '2023-12-29 13:51:59', 'Obraz olejny Misty', 'Sztuka', 'obraz.png658eceff0cdde6.30239936.png', '\"Podróż Domkiem w Chmurach\" to fascynujący obraz olejny, przedstawiający surrealistyczny pejzaż. W centralnym punkcie kompozycji znajduje się uroczy domek unoszący się w powietrzu, jakby spełniał marzenia o swobodnej podróży. Domek zdaje się być dostępny za pomocą karykaturalnej drabiny, która dodaje całości nutę nonsensu i wywołuje uśmiech na twarzy obserwatora.', '2024-01-13 13:51:00', '500.00', '500.00', 'Active', NULL),
(25, 29, '2023-12-30 08:37:02', 'Telefon Sony Ericsson K500i Alice Srebrny', 'Elektronika', 'sonyericsson.jpg658fd6ae67f970.35621253.jpg', 'Sony Ericsson K500i Alice Srebrny \r\n\r\nTelefon posiada lekkie ślady używania.\r\n\r\n-Przetestowany,technicznie w 100% sprawny.\r\n-Może się zdarzyć ze trzeba trochu mocniej wcisnąć Joystick ale ogólnie działa bezproblemowo (niestety jest to wada każdego telefonu z Joystickem)\r\n\r\n•Po profesjonalnym czyszczeniu zewnątrz-wewnątrz. \r\n\r\nMenu w J.Angielskim \r\n\r\n-Nie posiada żadnych -blokad/SimLock.', '2024-01-31 12:00:00', '100.00', '110.00', 'Active', 25),
(26, 16, '2023-12-30 09:32:26', 'Narty Atomic MAVERICK 95 TI', 'Sport i Rekreacja', 'Maverick 95 TI.png658fe3aab0c8e3.23246932.png', 'Atomic Maverick 95 TI to idealny wybór dla średniozaawansowanych lub zaawansowanych narciarzy. Rdzeń tych nart jest wykonany z następujących materiałów: drewno. Jeśli zależy Ci na trwałości nart, drewniany rdzeń ją zapewni.\r\n\r\nMając profil z tip and tail rocker, zapewniają łatwiejsze pokonywanie zakrętów w gęstym śniegu. Przy średnim promieniu skrętu 17.9m otrzymujesz wszechstronną nartę z dobrą inicjacją skrętu i dobrą kontrolą przy dużej prędkości.\r\n\r\nZakres użytkowania: 60% na stoku - 40% poza stokiem', '2024-01-14 09:32:00', '2300.00', '2580.00', 'Active', 25),
(27, 4, '2024-01-03 18:58:53', 'Przykładowy przedmiot - konsola PS 5 PRO', 'Gry i Konsole', 'konsola.jpg6595ae6db0b780.51368372.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2024-01-05 19:00:00', '250.00', '250.00', 'Active', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(35) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pwd`, `created_at`) VALUES
(1, 'Admin', 'adminemail20@gmail.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-11-07 15:29:26'),
(3, 'janek', 'janek@example.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-11-07 18:21:29'),
(4, 'PrzykladowyUzytkownik', 'PrzykladowyUzytkownik@gmail.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-11-08 11:13:31'),
(5, 'PrzykladowyUzytkownik', 'PrzykladowyUzytkownik@gmail.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-11-08 11:26:33'),
(8, 'TestowyUzytkownik', 'TestowyEmail@gmail.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-11-08 11:32:54'),
(9, 'Andrzej', 'andrzejkropka@gmail.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-11-08 12:48:54'),
(15, 'Dexter DeShawn ', 'DexterDeShawn@gmail.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-11-08 17:03:11'),
(16, 'Vincent', 'Vincent53@gmail.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-11-08 17:36:56'),
(25, 'Piotrek', 'piotrkrypel123@gmail.com', '$2y$12$QCSnnP7KIb0MvpkhHOcgQuvoNTADSMWngBUjFgg7bu4se6nBWwHRu', '2023-11-09 21:16:08'),
(26, 'Tadeusz98', 'TaDzik997@gmail.com', '$2y$12$lmBAw..7.9NH1pCrKT0Vwec6abbIROSK.Vi2SX6tcqv5iydtHCQoK', '2023-11-10 11:18:05'),
(27, 'user', 'user@email.com', '$2y$12$1mNVQ7SiqvemU28IPhvvQeflyITvc1D8g414DH60KE70AyralQBXy', '2023-11-15 19:15:37'),
(28, 'New User', 'newUser@gmail.com', '$2y$12$vZKgVQ5ikF6pdSj./XAPFuNkMEgDzAovNJd3aq5ltTcELjmpn3zdq', '2023-12-07 13:46:26'),
(29, 'Andrzej Kowalski', 'andrzejK@gmail.com', '$2y$12$FRrtn8iwQ1Z66bOStbh9I.sWH0QM47HC4PtPv9HR.OqVjGk3PPlg2', '2023-12-13 22:25:33'),
(30, 'Magda Stańkiewicz', 'Magdalena01@gmail.com', '$2y$12$cnwoKaRVhUUAZe7tltKpEOIX4ecFCSaiXX3Yg2p2JVPP.tzmYD.Cq', '2023-12-28 12:34:43'),
(31, 'Przykładowy Użytkownik', 'testuser@gmail.com', '$2y$12$VJxUadre.V5rP8gZERvXpuXz1awZ3yllXD9aoGs1YT.RfzsqwG3.a', '2024-01-03 19:52:53');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`auctionID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `auctioneerID` (`auctioneerID`) USING BTREE;

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `auctions`
--
ALTER TABLE `auctions`
  MODIFY `auctionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `auctions`
--
ALTER TABLE `auctions`
  ADD CONSTRAINT `auctions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_auctioneer` FOREIGN KEY (`auctioneerID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
