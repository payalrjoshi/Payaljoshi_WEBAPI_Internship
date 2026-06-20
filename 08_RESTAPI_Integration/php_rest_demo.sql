 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


 

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

 

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `api_token`, `status`, `created_at`) VALUES
(2, 'Bhavesh Joshi', 'mad@gmail.com', '$2y$10$.vXZCe4302/C3YbluPtwouyrCgf0.OI8fZWHa510Y7Z27hV04Gftq', 'e5f5e07d87a0ce7c2a6b59477c0a86226c431b8acfe2cefa198ea575abf10368', 'active', '2026-06-10 05:53:12'),
(3, 'Jihita Joshi', 'jihu@gmail.com', '$2y$10$lKkqwF2XdFVbiEighD7q4OcL7Lqa/xOb8kUCnUXbO3c3EVwdvQcKW', '2b05ea7edb8ccd2612edb8287ca20ba30553254bd706156c2d38874053e2044b', 'active', '2026-06-10 05:59:58'),
(4, 'Pooja Joshi', 'pooja@gmail.com', '$2y$10$kiZ3IbpqVFwOLo4p5SOe9O04zfQpZh89fMUP7NTfIxyX1kWXoF85m', NULL, 'active', '2026-06-10 12:19:39'),
(5, 'John Doe', 'johndoe@example.com', '$2y$10$D0EgihBqGSfyK1.g7A2Cw.XnRmCRKOWg36LRTA1I/on.AaaZdPhgG', '0bf3d4a1a7616e0236ed033da3be2f8511c40bb8798a30e93ea2911958ba7b86', 'active', '2026-06-10 12:50:25');

 
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

 
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

 
