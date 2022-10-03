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
                <div class="card-body"><p class="text-white m-0" style="font-size:30px;">Konfirmasi Pembayaran</p></div>
            Untuk melakukan pembayaran silahkan untuk melakukan Transfer ke Rekening dibawah ini<br>
            Bank Mandiri <br>1829304019203
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-12 mb-5">
                    <div class="card h-100">
                    <?php 
                        if(isset($_GET['idker'])){
                            $idker = $_GET['idker'];
                            $produk = mysqli_query($conn, "select * from keranjang where id_user = ". $_SESSION['id'] . " and id_keranjang = ". $idker ." and status = 'belum' order by id_keranjang");
                            $p = mysqli_fetch_array($produk);
                    ?>
                        <div class="card-body">
                            <img src="../admin/image/<?= $p['foto']?>" width="100px">
                            <h3 class="card-tittle"><?= $p['nama_produk']?></h3>
                            <br>
                            <form method="POST" action=""  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="namapenerima">Nama Penerima</label>
                                    <input type="text" class="form-control" id="namapenerima" name="namapenerima" aria-describedby="emailHelp" placeholder="Nama Penerima" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="alamat">Alamat</label>
                                    <br><textarea class="form-control"name="alamat" id="alamat" rows="5" placeholder="Alamat" required></textarea>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="namapenerima">Total Harga</label>
                                    <p><?= $p['harga']?></p>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="alamat" class="mb-2">Bukti Transaksi</label><br>
                                    <input type="file" name="gambar" required>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="bayar" class="btn btn-primary">Pembayaran</button>
                        </div>
                        </form>
                        <?php 
                            if(isset($_POST['bayar'])){
                                $iduser = $_SESSION['id'];
                                $namapen = $_POST['namapenerima'];
                                $alamat = $_POST['alamat'];
                                $namapro = $p['nama_produk'];
                                $foto = $p['foto'];
                                $jumlah = $p['jumlah'];
                                $harga = $p['harga'];
                                
                                $namaFile = $_FILES['gambar']['name'];
                                $tmpName = $_FILES['gambar']['tmp_name'];

                                $ekstensiFile = ['jpeg', 'jpg', 'png'];
                                $ekstensiGambar = explode('.', $namaFile);
                                $ekstensiGambar2 = $ekstensiGambar[1];

                                if(!in_array($ekstensiGambar2, $ekstensiFile)){
                                    echo "<script>
                                        alert('Ekstensi harus jpeg jpg png');
                                    </script>";
                                }else{
                                    $namaBaru = 'bukti'.time().'.'.$ekstensiGambar2;
                                    move_uploaded_file($tmpName, "../admin/bukti/".$namaBaru);
                                }
                                
                                $query1 = mysqli_query($conn, "insert into pemesanan(id_user, nama_penerima, alamat, nama_produk, foto, jumlah, harga, bukti, tanggal) values (
                                    $iduser, '$namapen', '$alamat', '$namapro', '$foto', $jumlah, '$harga', '$namaBaru', current_timestamp())");

                                if($query1){
                                    mysqli_query($conn, "update keranjang set status='sudah' where id_keranjang=$idker");   
                                    echo "
                                        <script>
                                            alert('Pembayaran berhasil');
                                            window.location='keranjang.php'
                                        </script>
                                        ";
                                }else{
                                    echo "
                                        <script>
                                            alert('Pembayaran gagal');
                                        </script>
                                        ".mysqli_error($conn);
                                }
                            }
                        ?>
                    </div>
                    <?php } ?>
                </div>
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