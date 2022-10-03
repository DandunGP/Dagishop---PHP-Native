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
    <title>Dagishop</title>
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
                        <li class="nav-item"><a class="nav-link" href="produkuser.php">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="kategoriuser.php">Kategori</a></li>
                        <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                    </ul>
                    <form class="d-flex ms-auto">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn-primary" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body"><p class="text-white m-0" style="font-size:30px;">Pemesanan</p></div>
            </div>
            <?php 
                if(isset($_GET['idbar'])){
                    $idbar = $_GET['idbar'];
                    $produk = mysqli_query($conn, "select * from barang where id_produk = ". $idbar ."");
                    $p = mysqli_fetch_array($produk);
            ?>
            <div class="row">
                <div class="col">
                    <img src="../admin/image/<?= $p['foto']?>" width="500px" class="mb-4">
                </div>
                <div class="col">
                    <h3 class="card-tittle"><?= $p['nama_produk']?></h3>
                    <p class="card-text"><?= $p['deskripsi']?></p>
                    <h5 class="card-tittle">Rp. <?= $p['harga']?></h5>
                    <form action="" method="POST">
                        <div class="form-group mb-3">
                            <label for="nama"><b>Jumlah</b></label>
                            <input type="number" class="form-control w-50" name="jumlah" placeholder="0" required>
                        </div>
                        <input type="submit" name="keranjang" class="btn btn-primary w-50" value="Masuk Keranjang"></button>
                    </form>
                    <?php 
                        if(isset($_POST['keranjang'])){
                            $jumlah = $_POST['jumlah'];
                            $foto = $p['foto'];
                            $namapro = $p['nama_produk'];
                            $iduser = $_SESSION['id'];
                            $harga = $p['harga'];
                            $status = 'belum';
                            
                            intval($harga);
                            
                            $hargabaru = $harga * $jumlah;
                            
                            strval($hargabaru);
                            
                            $query = mysqli_query($conn, "insert into keranjang(id_user, foto, nama_produk, harga, jumlah, status) values 
                                                ($iduser ,'$foto', '$namapro', '$hargabaru', $jumlah, '$status')");
                            if($query){
                                echo "
                                    <script>
                                        alert('Produk berhasil di tambahkan');
                                        window.location('produkuser.php')
                                    </script>
                                    ";
                            }else{
                                echo "
                                    <script>
                                        alert('Produk gagal ditambahkan');
                                    </script>
                                    " . mysqli_error($conn);
                            }
                        }
                    ?>
                </div>
            </div>
            <?php }?>
        </div>
        <footer class="py-3 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">L200190172</p></div>
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Dandun Gigih Prakoso</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>