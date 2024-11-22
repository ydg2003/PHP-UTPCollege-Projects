<?php
require 'db_connection.php';
require 'event_data.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create the event data object from the form POST data
    $eventData = new EventData($_POST);

    // Create a new DB connection object
    $db = new DBConnection('localhost', 'root', '', 'evento');

    // Save the event data to the database
    $db->saveEventData($eventData);

    // Close the database connection
    $db->closeConnection();
}
?>