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
    <title>Dagishop | Keranjang</title>
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
                        <li class="nav-item"><a class="nav-link active" href="keranjang.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                    </ul>
                    <form class="d-flex ms-auto" method="post">
                        <input class="form-control me-2" type="search" placeholder="Search" name="keyword" id="keyword" autofocus autocomplete="off" aria-label="Search">
                        <button class="btn-primary" type="submit" name="cari" id="tombolCari">Search</button>
                    </form>
                    <?php 
                        error_reporting(0);
                        $keyword = $_POST['keyword'];
                        if(isset($_POST['cari'])){
                            echo "
                            <script>
                                window.location='produkuser.php?keyword=$keyword';
                            </script>
                            ";
                        }
                    ?>
                </div>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body"><p class="text-white m-0" style="font-size:30px;">Keranjang</p></div>
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <?php 
                    $produk = mysqli_query($conn, "select * from keranjang where id_user = ". $_SESSION['id'] . " and status = 'belum' order by id_keranjang");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                <div class="col-md-12 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <img src="../admin/image/<?= $p['foto']?>" width="100px">
                            <h3 class="card-tittle"><?= $p['nama_produk']?></h3>
                            <p> Jumlah : <?= $p['jumlah']?> </p>
                            <a href="pembayaran.php?idker=<?= $p['id_keranjang'] ?>"><button class="btn-success" style="width:200px; border-radius:10px;" type="submit" name="bayar">Bayar</button></a>
                            <a href="hapuskeranjang.php?idker=<?= $p['id_keranjang'] ?>" onclick="return confirm('Apakah yakin ingin menghapus produk?')"><button class="btn-danger" style="width:200px; border-radius:10px;" type="submit" name="bayar">Hapus</button></a>
                        </div>
                        <div class="card-footer">
                            <p class="card-text">Harga : <?= $p['harga']?></p>
                    </div>
                    </div>
                </div>
                <?php }}else{?>
                    <p>Produk tidak ada</p>
                <?php } ?>
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