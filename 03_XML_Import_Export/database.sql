use products;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


 
CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `pname` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 

INSERT INTO `product` (`pid`, `pname`, `price`, `qty`) VALUES
(1, 'LED TV 42\"', '32000.00', 10),
(2, 'Bluetooth Speaker', '1500.00', 30),
(3, 'Wireless Mouse', '700.00', 50),
(4, 'Laptop Dell i5', '55000.00', 8),
(5, 'Smartphone Samsung', '22000.00', 15),
(6, 'Smart Watch', '3500.00', 20),
(7, 'Gaming Headset', '2500.00', 12),
(8, 'External HDD 1TB', '4500.00', 18),
(9, 'USB-C Charger', '1200.00', 25),
(10, 'Tablet Lenovo', '18000.00', 9),
(11, 'HDMI Cable 5m', '300.00', 40);

 
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

 
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

 