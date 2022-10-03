<?php
    session_start();
    include '../database.php';

    if($_SESSION['status_user'] != 'admin'){
        echo"
            <script>
                window.location='../user/index.php'
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
    <title>Produk</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="admin-header">
        <div class="navbar-admin">
            <h2><a href="dashboard.php">Dagishop</a></h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="kategori.php">Kategori</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="pemesanan.php">Pemesanan</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="section-admin">
        <div class="content-admin">
            <h2>Produk</h2>
            <table border='1' cellspacing='0' class="table-data">
                <tr>
                    <th>ID Produk</th>
                    <th>ID Kategori</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Status Produk</th>
                    <th>Tanggal</th>
                    <th width='15%'>Keterangan</th>
                </tr>
                <?php
                    $query = "select * from barang";
                    $data = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($data)){
                ?>
                    <tr>
                        <td><?= $row['id_produk'] ?></td>
                        <td><?= $row['id_kategori'] ?></td>
                        <td><?= $row['nama_produk'] ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td><?= $row['harga'] ?></td>
                        <td><img src="image/<?= $row['foto'] ?>" width="100px"></td>
                        <td><?= ($row['produk_status'] == 0)?'Tidak Aktif':'Aktif'?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td align='center'><a href='ubahproduk.php?idp=<?= $row['id_produk'] ?>'><button class='btn-ubah'>Ubah</button></a><a href='hapusproduk.php?idp=<?= $row['id_produk'] ?>' onclick="return confirm('Yakin ingin menghapus produk ini ?')"><button class='btn-hapus'>Hapus</button></a></td>
                    </tr>
                <?php } ?>
            </table>
            <form action="" method="POST">
                <input type="submit" name="tambah" value="Tambah Produk" class="tambah-btn">
            </form>
            <?php 
                if(isset($_POST['tambah'])){
                    echo"
                        <script>
                            window.location='tambahproduk.php'
                        </script>
                    ";
                }
            ?>
        </div>
    </div>
</body>
</html>