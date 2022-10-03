<?php 
    session_start();

    $id = $_GET['id'];
    include '../database.php';
    if($_SESSION['status_user'] != 'admin'){
        echo"
            <script>
                window.location='../user/index.php'
            </script>
        ";
    }

    $query = mysqli_query($conn, "select * from kategori where id_kategori = $id");

    if(mysqli_num_rows($query) == 0){
        echo "<script>
                window.location='kategori.php';
            </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kategori</title>
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
                <h2>Ubah Kategori</h2>
                <?php 
                    $sql = mysqli_query($conn, "select * from kategori where id_kategori = $id");
                    $kat = mysqli_fetch_array($sql);
                ?>
                <table cellpadding="10px">
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td><input type="text" name="kategori" class="input-ubah" placeholder='<?= $kat['nama_kategori']?>'></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="right"><input type="submit" name="ubah" value="Ubah Kategori" class="box-login-btn"></td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['ubah'])){
                    $query = mysqli_query($conn, "select * from kategori where id_kategori = $id");
                    $k = mysqli_fetch_array($query);
                    
                    $kate = ucwords($_POST['kategori']);

                    $query = mysqli_query($conn, "update kategori set
                                                nama_kategori = '$kate'
                                                where id_kategori = ".$k['id_kategori']."");
                    if($query){
                        echo "
                            <script>
                                alert('Kategori berhasil di ubah');
                                window.location='kategori.php'
                            </script>
                            ";
                    }else{
                        echo "
                            <script>
                                alert('Kategori gagal di ubah');
                            </script>
                            ";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>