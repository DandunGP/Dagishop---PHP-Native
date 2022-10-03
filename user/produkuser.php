<?php
   include "../database.php"; 
   session_start();
    if($_SESSION['status_user'] != 'member'){
        if($_SESSION['status_user'] == 'admin'){
            echo"
            <script>
                window.location='../admin/dashboard.php'
            </script>
        ";    
        }
        echo"
            <script>
                window.location='../index.php'
            </script>
        ";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dagishop | Produk</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php">Dagishop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="produkuser.php">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="kategoriuser.php">Kategori</a></li>
                        <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                    </ul>
                    <form class="d-flex ms-auto" method="post">
                        <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search" autofocus placeholder="Search" autocomplete="off" id="keyword">
                        <button class="btn-primary" type="submit" name="cari" id="tombolCari">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body"><p class="text-white m-0" style="font-size:30px;">Produk</p></div>
            </div>
            <button class="btn btn-secondary dropdown-toggle mb-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Urut
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="produkuser.php?urut=nama">Nama</a>
                <a class="dropdown-item" href="produkuser.php?urut=harga">Harga</a>
                <a class="dropdown-item" href="produkuser.php?urut=waktu">Waktu</a>
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <?php
                    error_reporting(0);
                    $keyword = $_POST['keyword'];
                    if (isset($_GET['urut'])){
                        if($_GET['urut']=='nama'){
                            $produk = mysqli_query($conn, "select * from barang where produk_status = 1 order by nama_produk");
                            if(isset($_POST['cari'])){
                                $produk = mysqli_query($conn, "select * from barang where nama_produk like '%$keyword%' and produk_status = 1 order by nama_produk");
                            }
                        }elseif($_GET['urut']=='harga'){
                            $produk = mysqli_query($conn, "select * from barang where produk_status = 1 order by cast(harga as signed integer)");
                            if(isset($_POST['cari'])){
                                $produk = mysqli_query($conn, "select * from barang where nama_produk like '%$keyword%' and produk_status = 1 order by cast(harga as signed integer)");
                            }
                        }elseif($_GET['urut']=='waktu'){
                            $produk = mysqli_query($conn, "select * from barang where produk_status = 1 order by tanggal");
                            if(isset($_POST['cari'])){
                                $produk = mysqli_query($conn, "select * from barang where nama_produk like '%$keyword%' and produk_status = 1 order by tanggal");
                            }
                        }   
                    }else if(isset($_POST['cari'])){
                        $produk = mysqli_query($conn, "select * from barang where nama_produk like '%$keyword%' and produk_status = 1 order by id_produk desc");
                    
                    }else{
                        $produk = mysqli_query($conn, "select * from barang where produk_status = 1 order by id_produk desc");
                    }

                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <center>
                            <img src="../admin/image/<?= $p['foto']?>" width="100px">
                            <h3 class="card-tittle"><?= $p['nama_produk']?></h3>
                            <p class="card-text"><?= $p['deskripsi']?></p>
                        </center>
                        </div>
                        <div class="card-footer">
                            <p class="card-text">Harga : <?= $p['harga']?></p>
                            <form action="" method="POST">
                            <a class="btn btn-primary btn-sm w-100" href="pemesanan.php?idbar=<?=$p['id_produk']?>">View Detail</a>
                    </div>
                    </div>
                </div>
                <?php }}else{?>
                    <p>Produk tidak ada</p>
                <?php }?>
            </div>
        </div>
        <footer class="py-3 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">L200190172</p></div>
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Dandun Gigih Prakoso</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>