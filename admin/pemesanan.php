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
            <h2>Pemesanan</h2>
            <table border='1' cellspacing='0' class="table-data">
                <tr>
                    <th>ID Pemesanan</th>
                    <th>ID User</th>
                    <th>Nama Penerima</th>
                    <th>Alamat</th>
                    <th>Nama Produk</th>
                    <th>Foto</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Bukti</th>
                    <th>Tanggal</th>
                </tr>
                <?php
                    $query = "select * from pemesanan";
                    $data = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_row($data)){
                ?>
                    <tr>
                        <td><?= $row[0] ?></td>
                        <td><?= $row[1] ?></td>
                        <td><?= $row[2] ?></td>
                        <td><?= $row[3] ?></td>
                        <td><?= $row[4] ?></td>
                        <td><img src="image/<?= $row[5] ?>" width="100px"></td>
                        <td><?= $row[6] ?></td>
                        <td><?= $row[7] ?></td>
                        <td><img src="bukti/<?= $row[8] ?>" width="100px"></td>
                        <td><?= $row[9] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>