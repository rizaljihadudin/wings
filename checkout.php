<?php 
 
    session_start();
    
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }

    include 'koneksi.php';
    $query = mysqli_query($conn, "SELECT a.id_product, a.subtotal, a.unit as unit_a, b.* from product_temp a LEFT JOIN product b ON a.id_product = b.id");

    $row = mysqli_query($conn, "SELECT MAX(MID(document_number, 1,3)) AS doc_no FROM transaction_header");
    $sql = mysqli_fetch_array($row);
    if ($sql['doc_no'] != null && $sql['doc_no'] > 0) {
        $n = ((int)$sql['doc_no']) + 1;
        $no = sprintf("%'.03d", $n);
    } else {
        $no = "001";
    }

    

    $doc_number = $no;
    $allTotal = 0;
    foreach($query as $data){

        $doc_number     = $doc_number;
        $product_code   = $data['product_code'];
        $price          = $data['price'];
        $quantity       = $data['unit_a'];
        $unit           = $data['unit'];
        $subtotal       = $data['subtotal'];
        $currency       = $data['currency'];
        

        $query1 = mysqli_query($conn, "INSERT INTO transaction_detail (document_code, document_number, product_code, price, quantity, unit, sub_total, currency) VALUES('TRX', '$doc_number', '$product_code', '$price', '$quantity', '$unit', '$subtotal', '$currency')");

        $allTotal += $subtotal;

    }
    $user           = $_SESSION['user'];
    $query2 = mysqli_query($conn, "INSERT INTO transaction_header (document_code, document_number, user, total) VALUES('TRX', '$doc_number', '$user', '$allTotal')");

    
    


    if($query2){
        mysqli_query($conn, "truncate table product_temp");
        echo json_encode('sukses');
    }else{
        echo json_encode('gagal');
    }
 
?>