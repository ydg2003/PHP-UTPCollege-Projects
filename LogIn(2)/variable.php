<?php
require_once 'db_conn.php'; // This file initializes the $db PDO object
require_once 'event_data_controller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create the event data object from the form POST data
    $eventData = new EventData($_POST);

    // Save the event data to the database using the method in the EventData class
    $eventData->saveEventData($eventData);

    // The PDO connection will close automatically when the script ends
}
?>