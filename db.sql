-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2021 at 11:09 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12


CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `idList` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

(46, 'Manger', 8),
(47, 'Dormir', 8);

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isPrivate` tinyint(1) NOT NULL DEFAULT 0,
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`id`, `name`, `isPrivate`, `isDone`, `idUser`) VALUES
(7, 'Pour sauver la planète', 0, 0, NULL),
(8, 'Ce que tout le monde doit faire', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `hashPasswd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `hashPasswd`) VALUES
(1, 'test', 'azerty');

--
-- Indexes for dumped tables
--
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Task` (`idList`);

--
-- Indexes for table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_todo` (`idUser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_Task` FOREIGN KEY (`idList`) REFERENCES `todolist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `todolist`
--
ALTER TABLE `todolist`
  ADD CONSTRAINT `FK_todo` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
