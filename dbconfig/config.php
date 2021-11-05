
<!-- Uspostavljanje konekcije sa bazom i provera -->

<?php
    $server = "localhost";
    $username = "isidora";
    $password = "";
    $dbname = "fakultet";
    
    $conn = new mysqli($server, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>