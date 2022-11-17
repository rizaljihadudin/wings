<?php 
 
    session_start();
    
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }

    include 'koneksi.php';

    $id = $_POST['id'];
    $unit = $_POST['unit'];
    $subtotal = $_POST['subtotal'];
    $query = mysqli_query($conn, "UPDATE product_temp SET unit='$unit', subtotal='$subtotal' WHERE id_product=".$id);
    if($query){
        echo json_encode('sukses');
    }else{
        echo json_encode('gagal');
    }
 
?>