<?php

$servername = "207.148.118.163";
$username = "root";
$password = "ux1kK0iycXOFsGSJLs0ckfWqkHTwpphMPJ5G6NJyFLe54koneYsXPzZQm6A7nTyr";
$db = "crud";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}

?>