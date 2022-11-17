<?php
    include 'koneksi.php';
    
    if($_POST['upload']){

        $ekstensi_diperbolehkan	= array('png','jpg');
        $nama = $_FILES['file']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];	

        $productCode    = $_POST['product_code'];
        $productName    = $_POST['product_name'];
        $price          = $_POST['price'];
        $currency       = $_POST['currency'];
        $disc           = $_POST['disc'];
        $dimension      = $_POST['dimension'];
        $unit           = $_POST['unit'];
        
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1044070){			
                move_uploaded_file($file_tmp, 'assets/photo/'.$nama);
                $query = mysqli_query($conn, "INSERT INTO product (product_code, product_name, price, currency, discount, dimension, unit, photo) VALUES('$productCode', '$productName', '$price', '$currency', '$disc', '$dimension', '$unit', '$nama')");
                if($query){
                    echo 'FILE BERHASIL DI UPLOAD';
                }else{
                    echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            }else{
                echo 'UKURAN FILE TERLALU BESAR';
            }
        }else{
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }elseif($_POST['update']){
        $nama           = $_FILES['file']['name'];
        $productCode    = $_POST['product_code'];
        $productName    = $_POST['product_name'];
        $price          = $_POST['price'];
        $currency       = $_POST['currency'];
        $disc           = $_POST['disc'];
        $dimension      = $_POST['dimension'];
        $unit           = $_POST['unit'];
        $id             = $_POST['id'];

        $data = mysqli_query($conn, "SELECT * FROM product where id=".$id);
        $row = mysqli_fetch_array($data);
        $xfile = $row['photo'];

        /** jika update photo */
        if($nama != null || $nama != ''){
            $ekstensi_diperbolehkan	= array('png','jpg');
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran	= $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];
            unlink('assets/photo/'.$xfile);

            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                if($ukuran < 1044070){			
                    move_uploaded_file($file_tmp, 'assets/photo/'.$nama);
                    $query = mysqli_query($conn, "UPDATE product SET product_code='$productCode', product_name='$productName', price='$price', currency='$currency', discount='$disc', dimension='$dimension', unit='$unit', photo='$nama' where id='$id'");
                    if($query){
                        echo 'FILE BERHASIL DI UPLOAD';
                    }else{
                        echo 'GAGAL MENGUPLOAD GAMBAR';
                    }
                }else{
                    echo 'UKURAN FILE TERLALU BESAR';
                }
            }else{
                echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
            }

        }else{
            $query = mysqli_query($conn, "UPDATE product SET product_code='$productCode', product_name='$productName', price='$price', currency='$currency', discount='$disc', dimension='$dimension', unit='$unit' where id='$id'");
            if($query){
                echo 'berhasil update';
            }
        }
    }

    header("Location: product.php");


?>