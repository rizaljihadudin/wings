<?php
    include 'koneksi.php';
    // menyimpan data id kedalam variabel
    $id  = $_GET['id'];
    $query="DELETE from product where id='$id'";
    mysqli_query($conn, $query);
    // mengalihkan ke halaman index.php
    header("location:product.php");

    
?>