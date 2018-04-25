-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Kwi 2018, 06:13
-- Wersja serwera: 10.1.29-MariaDB
-- Wersja PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `eloboost`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nickname` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `level` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`ID`, `login`, `password`, `nickname`, `email`, `level`) VALUES
(1, 'admin', 'admin', 'test', '', 'owner'),
(2, 'admin2', 'admin2', 'test2', '', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `coaches`
--

CREATE TABLE `coaches` (
  `ID` int(11) NOT NULL,
  `nickname` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `division` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `roles` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `languages` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `price` int(5) NOT NULL,
  `about` varchar(1500) COLLATE utf8_polish_ci NOT NULL,
  `main_champions` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_polish_ci NOT NULL,
  `uwagi` varchar(500) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `coaches`
--

INSERT INTO `coaches` (`ID`, `nickname`, `division`, `roles`, `languages`, `price`, `about`, `main_champions`, `description`, `uwagi`) VALUES
(1, 'Nickname1', 'Challenger', 'TOP, JUNGLE', 'PL, UK', 35, 'Przykładowy opis', 'Anivia, Victor, Ziggs, Zed, Lux', '// zbędny', '// brak'),
(2, 'Nickname2', 'Diamond II', 'ADC, SUPP, JUNGLE', 'UK', 20, 'Przykładowy opis', 'Draven, Vayne, Jhin, Ezreal, Twitch', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `eloboost.php`
--

CREATE TABLE `eloboost.php` (
  `ID` int(11) NOT NULL,
  `eloboost_tab1` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `eloboost_tab2` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `eloboost_tab3` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `eloboost_tab4` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `order_title` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `order_duo` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `order_button` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `rules_title` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `rules_desc` varchar(3000) COLLATE utf8_polish_ci NOT NULL,
  `rules2_title` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `rules2_desc` varchar(3000) COLLATE utf8_polish_ci NOT NULL,
  `bg_image_css` varchar(1000) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `eloboost.php`
--

INSERT INTO `eloboost.php` (`ID`, `eloboost_tab1`, `eloboost_tab2`, `eloboost_tab3`, `eloboost_tab4`, `order_title`, `order_duo`, `order_button`, `rules_title`, `rules_desc`, `rules2_title`, `rules2_desc`, `bg_image_css`) VALUES
(1, 'Division Boost', 'Boost per win', 'Placement Matches', 'Mastery Boost', 'Your Order:', 'Duo Queue', 'RANK UP', 'HOW IT WORKS ?', 'Choose the service that you wish to buy.;Click \'RANK UP\' to be redirected to ... and complete the purchase.;Fill a form with your League of Legends account information.;Check your email inbox.;', 'Terms and Conditions', 'test;test;test;test;test;', 'bg_image-background:url(../img/1920x350.jpg);bg_image-position:center;bg_image-repeat:no-repeat;');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `footer.php`
--

CREATE TABLE `footer.php` (
  `ID` int(11) NOT NULL,
  `copyright` varchar(300) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `footer.php`
--

INSERT INTO `footer.php` (`ID`, `copyright`) VALUES
(1, '© 2018 TAXIBOOST all rights reserved. League of Legends is a registered trademark of Riot Games, Inc. We are in no way affiliated with, associated with or endorsed by Riot Games, Inc.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `header.php`
--

CREATE TABLE `header.php` (
  `ID` int(11) NOT NULL,
  `lang` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `charset` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `title` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  `keywords` varchar(150) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `header.php`
--

INSERT INTO `header.php` (`ID`, `lang`, `charset`, `title`, `description`, `keywords`) VALUES
(1, 'en', 'UTF-8', 'ELO BOOST - League of Legends elo boost', 'test', 'test');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `index.php`
--

CREATE TABLE `index.php` (
  `ID` int(11) NOT NULL,
  `header_text` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `box1_title` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `box1_icon` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `box1_content` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `box1_b` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `box2_title` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `box2_icon` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `box2_content` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `box2_b` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `box3_title` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `box3_icon` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `box3_content` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `box3_b` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `highlight1_num` int(5) NOT NULL,
  `highlight1_text` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `highlight2_num` int(5) NOT NULL,
  `highlight2_text` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `highlight3_num` int(5) NOT NULL,
  `highlight3_text` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `highlight4_num` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `highlight4_text` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `owl_item` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `contact_text` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `q1_contact` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `q2_contact` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `q3_contact` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `submit_contact` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `header_css` varchar(10000) COLLATE utf8_polish_ci NOT NULL,
  `box_css` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `highlight_css` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `owl_css` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `contact_css` varchar(1000) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `index.php`
--

INSERT INTO `index.php` (`ID`, `header_text`, `box1_title`, `box1_icon`, `box1_content`, `box1_b`, `box2_title`, `box2_icon`, `box2_content`, `box2_b`, `box3_title`, `box3_icon`, `box3_content`, `box3_b`, `highlight1_num`, `highlight1_text`, `highlight2_num`, `highlight2_text`, `highlight3_num`, `highlight3_text`, `highlight4_num`, `highlight4_text`, `owl_item`, `contact_text`, `q1_contact`, `q2_contact`, `q3_contact`, `submit_contact`, `header_css`, `box_css`, `highlight_css`, `owl_css`, `contact_css`) VALUES
(1, 'ANY ACCOUNT; CAN BE; IMPROVED', 'ELO BOOSTING', 'fas fa-gamepad', 'We provide fast and professional elo boosting services. Our team consists of high divisions elo boosters. The minimum division of our elo boosters is Diamond II.', 'elo boosting services', 'COACHING', 'fas fa-users', 'Coaching is an efficient way to improve your skills and mindset in league of legends. We provide experienced high elo players for your service.', '', 'PLACEMENT GAMES', 'fas fa-gamepad', 'To win most of the Match Placements is quite important, because it makes it easier to climb a ladder without bad players holding you back. We can do all 10 games with guaranteed 70 % win rate.', '70 % win rate', 3, 'Years of experience', 9000, 'Hours in the game', 7, 'Boosters', '500', 'Completed orders', 'Good to talk to, kind, overall good service, thank you :); Gold V -> Gold IV; Was an awesome booster with a positive attitude in game. Got it all done in one day.; Unranked -> Silver II; Booster was fast and professional, won almost every game!; Diamond V -> Diamond III; Wow, the booster is really amaizing :); Gold II -> Gold I', 'Have any questions?', 'Name', 'Your email', 'Message', 'Send', 'header-background:url(img/1920x1080.jpg);header-position:center;header-repeat:no-repeat;', 'box-background:#e1382d;box-color:#e1382d;box-header-font-size:1rem;box-paragraph-font-size:0.85rem;', 'highlight-background:#e1382d;highlight-header-font-size:4rem;highlight-desc-font-size:1.2rem;highlight-header-color:white;highlight-desc-color:white;', 'owl-background:url(img/1920x1080.jpg);owl-position:center;owl-repeat:no-repeat;', 'contact-title-font-size:2rem;contact-title-color:white;contact-background:#272d35;contact-button-background:#e1382d;contact-button-font-size:1.5rem;contact-button-color:white;');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nav`
--

CREATE TABLE `nav` (
  `ID` int(11) NOT NULL,
  `logo_text` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `items` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  `login` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nav_css` varchar(10000) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `nav`
--

INSERT INTO `nav` (`ID`, `logo_text`, `items`, `login`, `nav_css`) VALUES
(1, 'ELO; BOOST', 'OUR WORK; BOOSTING; COACHING; GALLERY; FAQ; CONTACT', 'MEMBER AREA', 'nav-background:#202028;nav-height:60px;nav-position:fixed;');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eloboost.php`
--
ALTER TABLE `eloboost.php`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `footer.php`
--
ALTER TABLE `footer.php`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `header.php`
--
ALTER TABLE `header.php`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `index.php`
--
ALTER TABLE `index.php`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `coaches`
--
ALTER TABLE `coaches`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `eloboost.php`
--
ALTER TABLE `eloboost.php`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `footer.php`
--
ALTER TABLE `footer.php`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `header.php`
--
ALTER TABLE `header.php`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `index.php`
--
ALTER TABLE `index.php`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `nav`
--
ALTER TABLE `nav`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
