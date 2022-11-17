<?php 
 
    session_start();
    
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }

    include 'koneksi.php';

    $id = $_POST['id'];
    $product = mysqli_query($conn, "SELECT * FROM product WHERE id =".$id);
    $row = mysqli_fetch_array($product);

    echo json_encode($row);
 
?>