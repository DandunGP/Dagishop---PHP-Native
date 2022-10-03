<?php 
    session_start();
    include '../database.php';

    $id = $_GET['idp'];

    if($_SESSION['status_user'] != 'admin'){
        echo"
            <script>
                window.location='../user/index.php'
            </script>
        ";
    }

    $query = mysqli_query($conn, "select * from barang where id_produk = $id ");
    $data = mysqli_fetch_object($query);

    if(mysqli_num_rows($query) == 0){
        echo "<script>
                window.location='produk.php';
            </script>";
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
                <h2>Ubah Produk</h2>
                <table cellpadding="10px">
                    <tr>
                        <td>Jenis Kategori</td>
                        <td>:</td>
                        <td><select name="idkat">
                            <?php 
                                $query = "select * from kategori order by id_kategori";
                                $data1 = mysqli_query($conn, $query);
                                while($row = mysqli_fetch_array($data1)){
                                ?> 
                                <option value="<?= $row[0] ?>" 
                                    <?php 
                                        if($row[0] == $data->id_kategori){
                                            echo "selected";
                                        }else{
                                            echo ""; 
                                        }
                                    ?>> <?= $row[1] ?> </option>
                                <?php } ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Nama Produk</td>
                        <td>:</td>
                        <td><input type="text" name="nama" value="<?= $data->nama_produk?>" class="input-ubah" required></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><input type="text" name="deskripsi" value="<?= $data->deskripsi ?>" class="input-ubah" required></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td><input type="number" name="harga" value="<?= $data->harga ?>" class="input-ubah" required></td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>:</td>
                        <td><img src="image/<?= $data->foto ?>" width="100px"><br>
                            <input type="hidden" name="foto" value="<?= $data->foto ?>">
                            <input type="file" name="gambar"></td>
                    </tr>
                    <tr>
                        <td>Status Produk</td>
                        <td>:</td>
                        <td><select name="status">
                            <option value="1" <?= ($data->produk_status == 1)? 'selected':''?>>Aktif</option>
                            <option value="0" <?= ($data->produk_status == 0)? 'selected':''?>>Tidak Aktif</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="right"><input type="submit" name="tambah" value="Ubah Produk" class="box-login-btn"></td>
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
                    $foto = $_POST['foto'];

                    $namaFile = $_FILES['gambar']['name'];
                    $tmpName = $_FILES['gambar']['tmp_name'];

                    if($namaFile != ''){
                        $ekstensiFile = ['jpeg', 'jpg', 'png'];
                        $ekstensiGambar = explode('.', $namaFile);
                        $ekstensiGambar2 = $ekstensiGambar[1];
                        
                        if(!in_array($ekstensiGambar2, $ekstensiFile)){
                            echo "<script>
                                alert('Ekstensi harus jpeg jpg png');
                            </script>";
                        }else{
                            unlink('./image/'.$foto);
                            $namaBaru = 'produk'.time().'.'.$ekstensiGambar2;
                            move_uploaded_file($tmpName, "image/".$namaBaru);
                            $namaGambar = $namaBaru;
                        }
                    }else{
                        $namaGambar = $foto;
                    }

                    $query1 = mysqli_query($conn, "update barang set id_kategori = $idkat, nama_produk = '$nama', deskripsi = '$des', harga = '$harga', foto = '$namaGambar', produk_status = $status, tanggal = current_timestamp() where id_produk = $data->id_produk");

                    if($query1){
                        echo "
                            <script>
                                alert('Produk berhasil di ubah');
                                window.location='produk.php'
                            </script>
                            ";
                    }else{
                        echo "
                            <script>
                                alert('Produk gagal diubah');
                            </script>
                            ".mysqli_error($conn);
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>