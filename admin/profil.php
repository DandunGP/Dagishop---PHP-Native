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

    $query = mysqli_query($conn, "select * from user where id_user = ".$_SESSION['id']." ");
    $data = mysqli_fetch_object($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
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
            <h2>Profil Admin</h2>
            <table>
                <tr>
                    <td>Nama Admin</td>
                    <td>:</td>
                    <td><?php echo $data->nama_user?></td>
                </tr>
                <tr>
                    <td>Email Admin</td> 
                    <td>:</td>
                    <td><?php echo $data->email_user?></td>
                </tr>
            </table>
            <br>
            <form action="" method="POST">
                <input type="submit" name="ubahdata" value="Ubah Data" class="box-login-btn">
                <input type="submit" name="ubahpass" value="Ubah Password" class="box-login-btn">
            </form>
            <?php
                if(isset($_POST['ubahdata'])){
                    echo"
                        <script>
                            window.location='ubahdata.php'
                        </script>
                    ";
                }else if(isset($_POST['ubahpass'])){
                    echo"
                        <script>
                            window.location='ubahpass.php'
                        </script>
                    ";
                }
            ?>
        </div>
    </div>
</body>
</html>