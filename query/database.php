<?php

// $server = "localhost";
// $username = "root";
// $password = "";
// $database = "crud";

// $connection = mysqli_connect($server, $username, $password, $database);
// if (!$connection) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// if (isset($_POST['submit'])) {
//     $titles = $_POST['title'];
//     $contents = $_POST['content'];
    
//     // Loop through each title and content pair
//     foreach ($titles as $key => $title) {
//         $content = $contents[$key];
//         $currentDateTime = date("Y-m-d");
//         $insert = "INSERT INTO `note` (`title`, `content`, `date`) VALUES ('$title', '$content', '$currentDateTime')";
//         $querys = mysqli_query($connection, $insert);
//         if ($querys) {
//             echo "Successfully inserted note with title: $title<br>";
//         } else {
//             echo "Failed to insert note with title: $title<br>";
//         }
//     }
// }

// mysqli_close($connection);
?>
