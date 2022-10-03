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
    <title>Ubah Data</title>
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
                <h2>Ubah Password</h2>
                <table cellpadding="10px">
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" name="username" placeholder="<?php echo $data->username?>" class="input-ubah"></td>
                    </tr>
                    <tr>
                        <td>Password Baru</td>
                        <td>:</td>
                        <td><input type="password" name="passwordb" class="input-ubah"></td>
                    </tr>
                    <tr>
                        <td>Konfirmasi Password Lama</td>
                        <td>:</td>
                        <td><input type="password" name="passwordl" class="input-ubah"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="right"><input type="submit" name="ubah" value="Ubah Password" class="box-login-btn"></td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['ubah'])){
                    $username = $_POST['username'];
                    $passwordl = $_POST['passwordl'];
                    $passwordb = $_POST['passwordb'];

                    if(MD5($passwordl) == $data->password || $username == $data->username){
                        mysqli_query($conn, "update user set
                                                password = '".MD5($passwordb)."'
                                                where id_user = ".$data->id_user."");
                        echo "
                            <script>
                                alert('Data berhasil di ubah');
                                window.location='profil.php'
                            </script>
                            ";
                    }else{
                        echo "
                            <script>
                                alert('Data gagal di ubah, Username dan password tidak sesuai');
                                window.location='profil.php'
                            </script>
                            ";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>