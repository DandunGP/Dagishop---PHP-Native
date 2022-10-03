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
                <h2>Ubah Data</h2>
                <table cellpadding="10px">
                    <tr>
                        <td>Nama Admin</td>
                        <td>:</td>
                        <td><input type="text" name="nama" placeholder="<?php echo $data->nama_user?>" class="input-ubah"></td>
                    </tr>
                    <tr>
                        <td>Email Admin</td>
                        <td>:</td>
                        <td><input type="text" name="email" placeholder="<?php echo $data->email_user ?>" class="input-ubah"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input type="password" name="password" class="input-ubah"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="right"><input type="submit" name="ubah" value="Ubah Data" class="box-login-btn"></td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['ubah'])){
                    $nama = ucwords($_POST['nama']);
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    if(MD5($password) == $data->password){
                        mysqli_query($conn, "update user set
                                                nama_user = '".$nama."',
                                                email_user = '".$email."'
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
                                alert('Data gagal di ubah, Password salah');
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