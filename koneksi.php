<?php 
 
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "penjualan";
    
    $conn = mysqli_connect($server, $user, $pass, $database);
    
    if (!$conn) {
        echo"Gagal tersambung dengan database.";
    }
 
?>