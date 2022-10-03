<?php
include '../database.php';

$id = $_GET["id"];

$query = mysqli_query($conn, "delete from kategori where id_kategori=$id");

if($query){
    echo "
        <script>
            alert('Kategori berhasil dihapus');
            document.location.href = 'kategori.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Kategori gagal dihapus');
            document.location.href = 'kategori.php';
        </script>
   ";
}
?>