CREATE TABLE `employee` (
    `id` int(11) NOT NULL,
    `firstname` varchar(50) NOT NULL,
    `lastname` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `employee` (`id`, `firstname`, `lastname`, `email`) VALUES
(1, 'John', 'Deere', 'jdeere@mycompany.com'),
(2, 'Adam', 'Perry', 'aperry@mycompany.com'),
(3, 'Noé', 'Bosch', 'nbosch@mycompany.com');

ALTER TABLE `employee`
ADD PRIMARY KEY (`id`);

ALTER TABLE `employee`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;