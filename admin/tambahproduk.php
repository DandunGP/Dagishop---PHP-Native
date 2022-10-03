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
    <title>Tambah Produk</title>
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
            <form action="" method="POST" enctype="multipart/form-data">
                <h2>Tambah Produk</h2>
                <table cellpadding="10px">
                    <tr>
                        <td>Jenis Kategori</td>
                        <td>:</td>
                        <td><select name="idkat">
                            <?php 
                                $query = "select * from kategori";
                                $data = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_array($data)){
                                    echo "<option value='$row[id_kategori]'>$row[nama_kategori]</option>";
                                }
                            ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Nama Produk</td>
                        <td>:</td>
                        <td><input type="text" name="nama" placeholder="nama produk" class="input-ubah" required></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><input type="text" name="deskripsi" placeholder="deskripsi" class="input-ubah" required></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td><input type="number" name="harga" placeholder="0" class="input-ubah" required></td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>:</td>
                        <td><input type="file" name="gambar" required></td>
                    </tr>
                    <tr>
                        <td>Status Produk</td>
                        <td>:</td>
                        <td><select name="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="right"><input type="submit" name="tambah" value="Tambah Produk" class="box-login-btn"></td>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_POST['tambah'])){
                    $idkat = $_POST['idkat'];
                    $nama = $_POST['nama'];
                    $des = $_POST['deskripsi'];
                    $harga = $_POST['harga'];
                    $status = $_POST['status'];

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
                        $namaBaru = 'produk'.time().'.'.$ekstensiGambar2;
                        move_uploaded_file($tmpName, "image/".$namaBaru);
                    }
                    
                    $query1 = mysqli_query($conn, "insert into barang(id_kategori, nama_produk, deskripsi, harga, foto, produk_status, tanggal) values 
                                            ($idkat, '$nama', '$des', '$harga', '$namaBaru', $status, current_timestamp())");

                    if($query1){
                        echo "
                            <script>
                                alert('Produk berhasil di tambahkan');
                                window.location='produk.php'
                            </script>
                            ";
                    }else{
                        echo "
                            <script>
                                alert('Produk gagal ditambahkan');
                            </script>
                            ".mysqli_error($conn);
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>