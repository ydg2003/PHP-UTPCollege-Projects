/*
General documentation explaining what this code does:

This SQL script creates and populates a table named `employee` in a MySQL database. It includes the following operations:
1. **Table Creation**: 
   - Creates a table named `employee` with four columns: 
     - `id` (integer, primary key, and not null)
     - `firstname` (string with a maximum length of 50 characters, not null)
     - `lastname` (string with a maximum length of 50 characters, not null)
     - `email` (string with a maximum length of 50 characters, not null)
   - Specifies the `InnoDB` storage engine and sets the default character set to `utf8` for encoding.
2. **Data Insertion**: 
   - Inserts three records into the `employee` table with sample data for `id`, `firstname`, `lastname`, and `email`.
3. **Primary Key Definition**: 
   - Adds a primary key constraint on the `id` column to ensure each record has a unique identifier.
4. **Auto-Increment Setup**: 
   - Modifies the `id` column to enable the `AUTO_INCREMENT` property, allowing the database to automatically assign unique values to the `id` for new rows.
   - Sets the next auto-increment value to `4` to continue after the inserted records.
*/
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