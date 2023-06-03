<?php
$mysqli = new mysqli("localhost", "Gerente", "rqD5l03&", "bunkerdb");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>