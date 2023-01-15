<?php 

    session_start();
    
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }

    include 'koneksi.php';

    $sql = "SELECT MAX(MID(document_number,1,3)) AS invoice_no FROM transaction_header";
    $x = mysqli_query($conn, $sql);
    $query = mysqli_fetch_array($x);

    if (count($query['invoice_no']) > 0) {
        $no = ((int)$query['invoice_no']) + 1;
    } else {
        $no = "001";
    }

    $invoice = "TRX" . $no;


 
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.101.0">
        <title>Wings | Penjualan</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/">

        

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="./assets/bs4/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">



        <!-- Favicons -->
        <link rel="apple-touch-icon" href="/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/4.6/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
        <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon.ico">
        <meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
        <meta name="theme-color" content="#563d7c">


        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>

        
        <!-- Custom styles for this template -->
        <link href="./assets/bs4/css/dashboard.css" rel="stylesheet">
        <script src="./assets/bs4/js/jquery-3.5.1.min.js"></script>
    </head>
    <body>
    
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Wings</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">Sign out</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">
                                <span data-feather="home"></span>
                                Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="product.php">
                                <span data-feather="shopping-cart"></span>
                                Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="order.php">
                                <span data-feather="file"></span>
                                Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="report.php">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Order</h1>
                    </div>
                    <h4>List Product</h4>
                    <div class="row">
                    <?php  
                        include 'koneksi.php';
                        $product = mysqli_query($conn, "SELECT * from product");
                        foreach($product as $prod) {
                    ?>
                        
                        <div class="card col-md-3 m-2" style="width: 18rem;">
                        <img src="assets/photo/<?= $prod['photo'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $prod['product_name'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">

                            <?php if ($prod['discount'] != null && $prod['discount'] > 0) {
                                $disc = (int)$prod['discount'];
                                $prc  = (int)$prod['price'];
                                $harga_disc = intval(($disc/100) * $prc);
                                $harga_setelah_disc = intval($prc - $harga_disc);    
                            ?>
                                <li class="list-group-item">Rp. <s><?= number_format($prod['price'],2,",",".") ?></s></li>
                                <li class="list-group-item">Rp. <?= number_format($harga_setelah_disc,2,",",".") ?></li>
                            <?php } else { ?>
                                <li class="list-group-item">Rp. <?= number_format($prod['price'],2,",",".") ?></li>
                            <?php } ?>
                        </ul>
                        <div class="card-body">
                            <a onclick="getProduct(<?= $prod['id'] ?>)" class="btn btn-sm btn-success">Buy</a>
                        </div>
                        </div>

                        <?php } ?>
                    </div>
                    <h4>Checkout</h4>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php  
                include 'koneksi.php';
                $product = mysqli_query($conn, "SELECT a.id_product, a.subtotal, a.unit as unit_a, b.* from product_temp a LEFT JOIN product b ON a.id_product = b.id");
                $no = 1;
                $allTotal = 0;
                foreach($product as $prod) {
                $allTotal += $prod['subtotal'];        
            ?>

                
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?= $prod['product_name'] ?>
                    <input type="hidden" name="price" id="price<?= $prod['id'] ?>" value="<?= $prod['price'] ?>">
                    <input type="hidden" name="disc" id="disc<?= $prod['id'] ?>" value="<?= $prod['discount'] ?>">
                </td>

                <?php if($prod['subtotal'] == NULL ) {?>
                    <td><input type="number" name="unit" id="unit<?= $prod['id'] ?>" onblur="getHarga(<?= $prod['id'] ?>)"></td>
                    <td><input type="number" name="subtotal" id="subtotal<?= $prod['id'] ?>" readonly></td>
                    <td>
                        <a onclick="add(<?= $prod['id'] ?>)" class="btn btn-sm btn-success">Add</a> |
                        <a onclick="deletex(<?= $prod['id'] ?>)" class="btn btn-sm btn-secondary">Delete</a>
                    </td>
                <?php } else {?>
                    <td><input type="number" name="unit" id="unit<?= $prod['id'] ?>" value="<?= $prod['unit_a'] ?>" readonly></td>
                    <td><input type="number" name="subtotal" id="subtotal<?= $prod['id'] ?>" value="<?= $prod['subtotal'] ?>" readonly></td>
                    <td>
                        <a onclick="deletex(<?= $prod['id'] ?>)" class="btn btn-sm btn-secondary">Delete</a>
                    </td>
                <?php }?>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3"></td>
                <td>
                    Rp. <?= number_format($allTotal,2,",",".") ?>
                </td>
                <td>
                    <a onclick="checkout()" class="btn btn-sm btn-danger">Checkout</a>
                </td>

            </tr>
        </tbody>
        </table>
    </div>
                </main>
            </div>
        </div>

  </div>
</div>
<div class="modal fade" id="modal-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tblItem">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

   


<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Produc Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelBuy">Cancel</button>
                <button id="buy" class="btn btn-success">Buy</a>
            </div>
        </div>
    </div>
</div>



        <script src="./assets/bs4/js/feather.min.js"></script>
        <script src="./assets/bs4/js/bootstrap.min.js"></script>
        <script>
            function getProduct(id){
                $.ajax({
                    type: "POST",
                    url: "transaksi.php",
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function(result) {
                        console.log(result)
                        
                        let id = result[0]
                        let product_code = result[1]
                        let product_name = result[2]
                        let price = result[3]
                        let dimension = result[6]
                        let disc = result[5]
                        let unit = result[7]
                        let img = result[8]
                        let txt = '';
                        let txt1 = '';
                        let harga_setelah_disc = 0;
                        let harga_disc = 0
                        if (disc != null && disc > 0){

                            harga_disc = parseInt((disc/100) * price)
                            harga_setelah_disc = parseInt(price - harga_disc);  
                            txt = `<s>${price}</s>`
                            txt1= `${harga_setelah_disc}`
                        }else{
                            txt = `${price}`;
                            txt1 = '';
                        }
                        $('#modal-body').append(`
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="assets/photo/${img}" height="150" width="150">
                                </div>
                                <div class="col-md-6">
                                    <p>${product_name}</p>
                                    <p>${txt}</p>
                                    <p>${txt1}</p>
                                    <p>Dimension : ${dimension} </p>
                                    <p>Price Unit : ${unit} </p>
                                    <input type="hidden" id="id_product" name="id" value="${id}">
                                </div>
                            </div>
                        `)
                        $('#myModal').modal('show')
                    }
                });
            }

            $("#buy").on("click", function(event){
                let id = $(`#id_product`).val();
                $.ajax({
                    type: "POST",
                    url: "upd_prod.php",
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function(result) {
                        $('#myModal').modal('hide')
                        location.reload(); 
                    }
                });
            });

            $("#cancelBuy").on("click", function(e){
                $('#modal-body').empty()
            })


            function getHarga(id)
            {
                let price   = $(`#price${id}`).val()
                let disc    = $(`#disc${id}`).val()
                let unit    = $(`#unit${id}`).val()

                let harga_disc = 0;
                let harga_setelah_disc = 0;
                let subtotal = 0;

                if (disc != null && disc > 0){
                    harga_disc = parseInt((disc/100) * price)
                    harga_setelah_disc = parseInt(price - harga_disc);  
                    price = harga_setelah_disc;
                }else{
                    price = price;
                }

                subtotal = price * parseInt(unit);
                $(`#subtotal${id}`).val(subtotal)
            }

            function add(id)
            {
                let subtotal    =  $(`#subtotal${id}`).val()
                let unit        =  $(`#unit${id}`).val()
                let conf        = confirm('apakah anda ingin menambahkan daftar belanjaan ini?')
                if(conf){
                    $.ajax({
                        type: "POST",
                        url: "add_temp.php",
                        data: {
                            'id': id,
                            'subtotal' : subtotal,
                            'unit' : unit
                        },
                        dataType: "json",
                        success: function(result) {
                            if(result == 'sukses'){
                                location.reload(); 
                            }
                        }
                    });
                }
            }

            function deletex(id)
            {
                let conf = confirm('apakah anda ingin menghapus daftar belanjaan ini?')
                if(conf){
                    $.ajax({
                        type: "POST",
                        url: "del_temp.php",
                        data: {
                            'id': id
                        },
                        dataType: "json",
                        success: function(result) {
                            if(result == 'sukses'){
                                location.reload(); 
                            }
                        }
                    });
                }
            }

            function checkout()
            {
                if(confirm('apakah anda ingin melakukan checkout?')){
                    $.ajax({
                    type: "POST",
                    url: "checkout.php",
                    data: {
                        'id': 1
                    },
                    dataType: "json",
                    success: function(result) {
                            location.reload();
                    }
                });
                }
            }

        </script>
    </body>
</html>
