<?php
include '../database.php';

$id = $_GET["idp"];

$query = mysqli_query($conn, "delete from barang where id_produk=$id");
$gambar = mysqli_query($conn, "select foto from barang where id_produk = $id");
$data = mysqli_fetch_object($gambar);

if($query){
    unlink('./image/'.$data->foto);
    echo "
        <script>
            alert('Produk berhasil dihapus');
            document.location.href = 'produk.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Produk gagal dihapus');
            document.location.href = 'produk.php';
        </script>
   ";
}
?>