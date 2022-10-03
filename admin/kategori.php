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
    <title>Kategori Produk</title>
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
            <h2>Kategori Produk</h2>
            <table border='1' cellspacing='0' class="table-data">
                <tr>
                    <th width="10%">ID Kategori</th>
                    <th>Kategori</th>
                    <th width= "30%">Keterangan</th>
                </tr>
                <?php
                    $query = "select * from kategori";
                    $data = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_row($data)){
                ?>
                    <tr>
                        <td><?= $row[0] ?></td>
                        <td><?= $row[1] ?></td>
                        <td align='center'><a href='ubahkate.php?id=<?= $row[0] ?>'><button class='btn-ubah'>Ubah</button></a><a href='hapuskate.php?id=<?= $row[0] ?>' onclick="return confirm('Yakin ingin menghapus kategori ini ?')"><button class='btn-hapus'>Hapus</button></a></td>
                    </tr>
                <?php } ?>
            </table>
            <form action="" method="POST">
                <input type="submit" name="tambah" value="Tambah Kategori" class="tambah-btn">
            </form>
            <?php 
                if(isset($_POST['tambah'])){
                    echo"
                        <script>
                            window.location='tambahkate.php'
                        </script>
                    ";
                }
            ?>
        </div>
    </div>
</body>
</html>