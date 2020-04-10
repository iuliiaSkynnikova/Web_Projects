-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2018 at 11:41 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportgear`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `CategoryName`) VALUES
(1, 'Women'),
(2, 'Men'),
(3, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerId` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `ContactNumber` int(11) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `CreditCardNumber` int(11) DEFAULT NULL,
  `ExpiryDate` varchar(10) DEFAULT NULL,
  `NameOnCard` varchar(150) DEFAULT NULL,
  `CSV` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerId`, `FirstName`, `LastName`, `Address`, `ContactNumber`, `Email`, `CreditCardNumber`, `ExpiryDate`, `NameOnCard`, `CSV`) VALUES
(1, '235', 'edfsd', 'sfgklsadkjf', 89847594, 'fhhh@vhhr.com', 2324, '0000-00-00', 'gsdfbgsdf dfgdf', 234),
(2, '235', 'edfsd', 'sfgklsadkjf', 89847594, 'dddd@vgr.com', 2324, '0000-00-00', 'gsdfbgsdf dfgdf', 234),
(3, '235', 'edfsd', 'sfgklsadkjf', 89847594, 'zz@zzr.com', 2324, '0000-00-00', 'gsdfbgsdf dfgdf', 234),
(4, 'wwww', 'wwwww', '2oiskfjhsdfkj', 0, 'www.hhhv@gmail.com', 2342, '0000-00-00', 'sdgsdfgd sdfgdfg', 345),
(5, 'ggg', 'ggg', '2oiskfjhsdfkj', 0, 'gg.gg@gg.com', 2342, '0000-00-00', 'sdgsdfgd sdfgdfg', 345),
(6, 'fwef', 'wer', 'werw', 23423, 'sdfsd@referw.gf', 3242, '0000-00-00', 'dsdfsdfsdf', 2342),
(7, 'ffffff', 'ffffff', 'fffffffffffffffffff', 2147483647, 'fff@ffff.ff', 3548, '0000-00-00', 'ffffffffff', 324),
(8, 'uuuuuuu', 'uuuuuuu', 'uuuuuuuuuuu', 1125544778, 'uuuuu@u.uu', 2568, '0000-00-00', 'uuuuuuuuuuuuuuu', 2365),
(9, 'rrrrrr', 'rrrrrr', 'rrrrrrrrr', 2147483647, 'rrrrrr@rrrr.rr', 1255, '0000-00-00', 'rrrrrrrrrrrrrrrrrrrr', 333),
(10, 'jkkk', 'gggg', 'ggggg', 2147483647, 'ggg@gg.ji', 9887, '0000-00-00', 'jkgigi', 226),
(11, 'oooooooooo', 'oooooooo', 'oooooooooo', 25558888, '677@ghhg.no', 2546, '0000-00-00', 'ooooooo', 123),
(12, 'pppppp', 'pppp', 'ppppppp', 36589944, 'ppp@gg.pp', 9877, '0000-00-00', 'pppppp', 555),
(13, 'jjjjj', 'llll', 'pppppppp', 3665477, 'ppp@ghh.vo', 2458, '0000-00-00', 'ggggg', 123),
(14, 'zzzzzz', 'zzzzzz', 'zzzzzzzzzzz', 2147483647, 'zzzzzz@ghfjf.lp', 5668, '12 / 12', 'zzzzzzzzzzzzz', 123);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemId` int(11) NOT NULL,
  `ItemName` varchar(50) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Photo` varchar(50) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubcategoryId` int(11) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemId`, `ItemName`, `Description`, `Photo`, `Price`, `CategoryId`, `SubcategoryId`, `Active`) VALUES
(1, 'Women\'s Tee', 'This tee adds a retro flavour with the specially themed adidas logo on the chest, while the lightweight climalite cotton fabric gives you a fast drying yet soft feel for when you\'re working hard in the gym or just looking for all day comfort. Fabric: 70% Cotton/30% Polyester.22', '1WTee.jpg', '34.99', 1, 1, 1),
(2, 'Women\'s Capri ', 'Women\'s Printed Impact Capri features NB Dry technology draws sweat away from your skin for zero distractions at the gym. The internal drawcord and waistband provides a secure and supportive fit. Fabric: 88% Polyester, 12% Spandex.', '2WCapri.jpg', '79.99', 1, 1, 1),
(3, 'Women\'s Hoodie', 'Women\'s Classic Full Zip Fleece Hoodie. Ideal for your balanced lifestyle, the Classic Full Zip Fleece is perfect for chilly morning jogs or restful evenings by the fireplace. This versatile hoodie features a relaxed, regular fit for easy movement and effortless mobility; while a durable outer with an ultra-soft brushed fleece lining offers a cosy, plush fit. An excellent warm up top, the full length, zip up front offers easy on and off transitions, and works with a fully adjustable drawstring hood to deliver secure coverage for comfortable all weather protection. 80% Cotton/ 20% Polyester.', '3WHoodie.jpg', '59.99', 1, 1, 1),
(4, 'Women\'s Shorts ', 'Women\'s Printed Shorts are designed with NB Dry technology for cool, dry comfort while working through your fitness routine. The drawcord and elasticated waistband ensure you receive a comfortable and secure fit. Fabric: 100% Polyester', '4WShort.jpg', '30.00', 1, 1, 1),
(5, 'Women\'s 6 Pack Socks ', 'Women\'s Socks feature a Moisture Management System to keep your feet dry and comfortable by wicking away sweat and excess moisture. The ArmourBlock anti-odour technology keeps your socks fresher for longer. Fabric: Polyester/spandex/nylon.', '5WSocks.jpg', '24.99', 1, 1, 1),
(6, 'Women\'s Running Shoes ', 'A lightweight upper combines with a seamless heel cup, responsive ride and anatomical design to provide a new standard in lightweight comfort. T\r\nhe upper moulds to your foot\'s contours and the ultrasonically welded seams keep the fit as snug as possible. The seamless heel cup is lightweight and grips onto your foot using silicon grips. Full length responsiveness is achieved with Micro-G midsole technology, adding to the fast feel of this shoe.\r\n', '6WRunningShoes.jpg', '120.00', 1, 2, 1),
(7, 'Women\'s Tennis Shoes ', 'Women\'s Tennis Shoes are designed with 3D TORSION technology and synthetic overlays to help you give your all on the court by providing enhanced support and stability. The ADIWEAR outsole is highly durable and provides excellent traction and agility on the court. Serve up your A game in the adidas Barricade Court Women\'s Tennis Shoes.', '7WTennisShoes.jpg', '99.99', 1, 2, 1),
(8, 'Women\'s Swimsuit ', 'Women\'s Swimsuit has been specifically design for post surgery swimmers with a divided shelf bra to firmly hold prosthetics in place. All fabrics and trims have been specially selected to avoid irritation. Fabric: 50% polybutylene, 50% polyester.', '8WSwimsuit.jpg', '89.99', 1, 1, 1),
(9, 'Women\'s Sweatshirt ', 'Women\'s Sweatshirt is constructed with drop shoulder seams to allow you to move freely. The side hem zips encourage you to discover your desired fit.\r\nFabric: 67% Cotton, 33% Polyester.\r\n', '9WSweatshirt.jpg', '79.99', 1, 1, 1),
(10, 'Women\'s Cap ', 'Featuring a hook and loop strap for an adjustable fit, structured design and pre-curved brim to maintain shape, and a Puma CAT logo to show off your sporty side.', '10WCap.jpg', '19.99', 1, 1, 1),
(11, 'Men\'s Tee ', 'The 100% cotton Men\'s Good Swoosh Tee is designed for comfort. A large screen printed swoosh on the chest adds some colour while the ribbed crew neckline and regular cut deliver a lightweight, comfortable fit.', '1MTee.jpg', '34.99', 2, 1, 1),
(12, 'Men\'s Training Pants ', 'Built to run through the drills during practice, the a Men\'s  Training Pants will keep you cool and dry when it\'s time to warm up. Featuring climacool technology for enhanced ventilation, tapered legs that don\'t trip you up and side zip pockets for convenient storage before the game. Material: 100% Polyester doubleknit.', '2MPants.jpg', '69.99', 2, 1, 1),
(13, 'Men\'s Shorts ', 'Work out or relax in comfort and style in the Men\'s Sportswear Vintage Shorts.  Made from an ultra-soft french terry cotton fabric, these shorts are warm and breathable with a ribbed waistband and adjustable drawcord for a secure fit. Fabric: 100% Cotton.', '3MShorts.jpg', '55.99', 2, 1, 1),
(14, 'Men\'s Hoodie ', 'Made with  ColdGear Infrared technology that uses a soft, thermo-conductive inner coating to absorb and retain your body heat to keep you warm and cosy through the cold days and nights. This hoodie also features their Moisture Transport System that wicks sweat away from the skin for dry comfort, and a front pouch pocket with an internal phone pocket for convenient storage while you\'re on the go. Fabric: 100% Polyester.', '4MHoodie.jpg', '90.99', 2, 1, 1),
(15, 'Men\'s Sweater ', 'The Men\'s Sportswear Crew Sweater is a simple and timeless crewneck with a pop of colour on the front. Made with a soft and warm brushed back fleece fabric for total comfort throughout the day. The ribbed cuffs and hem deliver a snug fit, keeping the warmth in, while the raglan sleeves allow for a natural range of motion. Fabric: 82% Cotton, 18% Polyester.', '5MSweater.jpg', '74.99', 2, 1, 1),
(16, 'Men\'s Running Shoes ', 'Men\'s Running Shoes deliver a barefoot running experience with the added benefits of responsive cushioning and a supportive upper. The engineered mesh upper provides optimal ventilation while Flywire technology adds support around the midfoot.', '6MRunningShoes.jpg', '130.00', 2, 2, 1),
(17, 'Men\'s Football Boots ', 'These boots have a natural Kanga-Lite kangaroo leather upper that gives you the soft touch you need on the pitch. The 360 degree texture on these boots means you can always control the incoming ball, and the feel you get means you can fire off passes with laser like precision in the blink of an eye.', '7MFootballBoots.jpg', '199.99', 2, 2, 1),
(18, 'Men\'s Swim Shorts ', 'The  Men\'s Panel Leisure Swim Shorts are designed with quick-drying Nylon fabric to ensure you remain comfortable in and out of the water. The internal mesh lining provides extra support as you speed through the water, while the adjustable waist delivers a secure and personalised fit. Fabric: Nylon.', '8MSwimShorts.jpg', '35.99', 2, 1, 1),
(19, 'Men\'s Cap ', 'The Feather Light Cap is a classic design featuring Dri-FIT technology to help you perform while feeling comfortable. Dri-FIT fabric wicks sweat away while keeping dry and the soft Dri-FIT headband keeps sweat off your brows. Equipped with a back closure for a quick adjustable fit.', '9MCap.jpg', '20.00', 2, 1, 1),
(20, 'Men\'s Low Cut Socks (3 Pack) ', 'Fill up on the Men\'s Low Cut Socks (3 Pack) for the basic comfort that you need in every day and active wear. With a padded sole that gives you added cushioning in key areas, as well as mesh panels for enhanced breathability, these socks are the ideal basic option. Fabric: Cotton/Polyester/Nylon/Elastane.', '10MSocks.jpg', '14.99', 2, 1, 1),
(21, 'Girl\'s Tee', 'The Girl\'s Linear Tee is the perfect staple for your active kid\'s wardrobe. The regular fit tee has a ribbed crew neck and inner back neck tape for superior comfort. Completed with a performance logo on the front chest for a touch of sporty style.', '1GirlTee.jpg', '25.99', 3, 1, 1),
(22, 'Boy\'s Linear Tee ', 'The Boy\'s Linear Tee is a classic, regular fit tee that delivers ultimate comfort during every jump, kick and swing! Featuring a large printed performance logo that adds a touch of sporty style.', '2BoyTee.jpg', '25.99', 3, 1, 1),
(23, 'Girl\'s Shorts ', 'Featuring Dri-FIT Technology that wicks sweat away to keep your little one feeling cool and dry throughout her daily activities. The elasticised waistband provides a secure, comfortable fit while the iconic Nike Swoosh logo shows off her sporty side. Featuring curved hems to allow a natural range of motion, the  Girl\'s Tempo Dry Shorts deliver breathable comfort and allow maximum movement for any active adventures.', '3GirlShorts.jpg', '35.99', 3, 1, 1),
(24, 'Boy\'s Shorts ', 'The  Boy\'s Functional Training Tech Shorts are a great option for the next time your child wants to rule the playground. Equipped with moisture-wicking technology and an adjustable drawcord, you can ensure your child will remain comfortable all day long.', '4BoyShorts.jpg', '39.99', 3, 1, 1),
(25, 'Girl\'s Running Shoes ', 'The Asics GEL Noosa is a supportive and well cushioned Girl\'s running shoe. With GEL units in the forefoot and rearfoot, your child will have the benefit of soft, supportive shoes for their growing feet. A midfoot Trusstic system supports their arches while a removable sockliner allows for a more accurate fit and allows for use with orthotics.', '5GirlRunningShoes.jpg', '89.99', 3, 2, 1),
(26, 'Boy\'s Running Shoes ', 'Made with an EVA midsole that gives responsive, smooth cushioning throughout, these lightweight runners are perfect for little balls of energy. The Air Mesh upper gives them excellent breathability for 360 degree comfort, while the ADIWEAR outsole is designed to stand up to even the toughest playgrounds.', '6BoyRunningShoes.jpg', '85.99', 3, 2, 1),
(27, 'Girl\'s Hoodie ', 'Crafted with Armour fleece which is soft and warm, with Storm technology for superior water resistance and Moisture Transport System that wicks sweat away from her skin. This hoodie has raglan sleeves which allow for great mobility, and a front kangaroo pocket for storage or hand warmth.', '7GirlHoodie.jpg', '70.00', 3, 1, 1),
(28, 'Boy\'s Hoodie ', 'Dress your youngster for cool comfort in the  Boy\'s Storm Twist Highlight Hoodie. Made with Armour fleece which is lightweight, breathable and stretchy with their Storm technology which repels water for dry comfort. This hoodie features a front kangaroo pocket for hand warmth or storage, and raglan sleeves which allow for a great range of motion.', '8BoyHoodie.jpg', '70.00', 3, 1, 1),
(29, 'Girl\'s Sun Top ', 'The Girl\'s Sun Top is a comfortable, quick drying rashie which delivers long-lasting UPF 50+ sun protection. Endurance+ fabric is chlorine resistant and the high neck offers added protection, making this Sun Top ideal for young kids who regularly swim and play at the beach or pool.', '9GirlSunTop.jpg', '34.99', 3, 1, 1),
(30, 'Boy\'s Sun Top ', 'Designed with Endurance+ fabric to ensure this rash vest remains twenty times less likely to fade than other swim fabrics. The four-way stretch technology promotes free movement so that your son will experience zero restrictions while swimming.', '10BoySunTop.jpg', '34.99', 3, 1, 1),
(39, '345', '23422222222', NULL, '232.00', 1, 1, 0),
(41, 'orangee', 'orange', NULL, '5.00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordercustomer`
--

CREATE TABLE `ordercustomer` (
  `OrderId` int(11) NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `OrderDate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordercustomer`
--

INSERT INTO `ordercustomer` (`OrderId`, `CustomerId`, `OrderDate`) VALUES
(2, 2, 20180327),
(3, 3, 20180327),
(4, 4, 20180327),
(5, 5, 20180327),
(6, 6, 20180327),
(7, 7, 20180328),
(8, 8, 20180328),
(9, 9, 20180328),
(10, 10, 20180328),
(11, 11, 20180328),
(12, 12, 20180328),
(13, 13, 20180328),
(14, 14, 20180328);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `OrderId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`OrderId`, `ItemId`, `Quantity`, `Price`) VALUES
(2, 2, 2, '79.99'),
(2, 1, 1, '34.99'),
(3, 2, 2, '79.99'),
(3, 1, 1, '34.99'),
(4, 1, 1, '34.99'),
(5, 1, 1, '34.99'),
(6, 39, 1, '34.99'),
(7, 5, 2, '24.99'),
(8, 41, 1, '5.00'),
(9, 30, 1, '34.99'),
(9, 25, 2, '89.99'),
(10, 4, 1, '30.00'),
(11, 29, 1, '34.99'),
(11, 41, 1, '5.00'),
(12, 16, 1, '130.00'),
(13, 27, 1, '70.00'),
(14, 12, 1, '69.99');

-- --------------------------------------------------------

--
-- Table structure for table `staffuser`
--

CREATE TABLE `staffuser` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffuser`
--

INSERT INTO `staffuser` (`UserId`, `FirstName`, `LastName`, `Username`, `Password`) VALUES
(1, 'Sam', 'Smith', 'sam', '9f3600340605ce847c5d1ecdbffa13ef3ce276a7'),
(2, 'Sam', 'Tree', 'sam2', '35c3f8acda78918688445db6668ec854b38d4c0e'),
(3, 'Admin', 'Root', 'admin', 'c516bd2ef783b441a746aceaec922eb1ba8a2deb');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `SubcategoryId` int(11) NOT NULL,
  `SubcategoryName` varchar(50) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`SubcategoryId`, `SubcategoryName`, `Active`) VALUES
(1, 'Clothing', 1),
(2, 'Footwear', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemId`),
  ADD KEY `CategoryId` (`CategoryId`),
  ADD KEY `SubcategoryId` (`SubcategoryId`);

--
-- Indexes for table `ordercustomer`
--
ALTER TABLE `ordercustomer`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `CustomerId` (`CustomerId`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD KEY `ItemId` (`ItemId`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indexes for table `staffuser`
--
ALTER TABLE `staffuser`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`SubcategoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `ordercustomer`
--
ALTER TABLE `ordercustomer`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `staffuser`
--
ALTER TABLE `staffuser`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `SubcategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`CategoryId`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`SubcategoryId`) REFERENCES `subcategory` (`SubcategoryId`);

--
-- Constraints for table `ordercustomer`
--
ALTER TABLE `ordercustomer`
  ADD CONSTRAINT `ordercustomer_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerId`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`ItemId`) REFERENCES `item` (`ItemId`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`OrderId`) REFERENCES `ordercustomer` (`OrderId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
