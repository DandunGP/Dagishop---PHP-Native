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
    <title>Tambah Data Kategori</title>
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
            <form action="" method="POST">
                <h2>Tambah Kategori</h2>
                <table cellpadding="10px">
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td><input type="text" name="kategori" placeholder="nama kategori" class="input-ubah" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="right"><input type="submit" name="tambah" value="Tambah Kategori" class="box-login-btn"></td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['tambah'])){
                    $kategori = ucwords($_POST['kategori']);

                    $query = mysqli_query($conn, "insert into kategori(nama_kategori) values 
                                            ('$kategori' )");
                    if($query){
                        echo "
                            <script>
                                alert('Kategori berhasil di tambahkan');
                                window.location='kategori.php'
                            </script>
                            ";
                    }else{
                        echo "
                            <script>
                                alert('Kategori gagal ditambahkan');
                            </script>
                            ";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>