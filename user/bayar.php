<?php
    include "../database.php"; 
    session_start();
     if($_SESSION['status_user'] != 'member'){
        if($_SESSION['status_user'] == 'admin'){
            echo"
            <script>
                window.location='../admin/dashboard.php'
            </script>
        ";    
        }
         echo"
             <script>
                 window.location='../index.php'
             </script>
         ";
     }   

    $idker = $_GET["idker"];

    $query = mysqli_query($conn, "update keranjang set status='sudah' where id_keranjang=$idker");

    if($query){
        $info = mysqli_query($conn, "select * from keranjang where id_keranjang = $idker");
        $p = mysqli_fetch_array($info);
        mysqli_query($conn, "insert into pemesanan(id_user, foto, nama_produk, jumlah, harga, tanggal, status) values(". $p['id_user'] .",'". $p['foto']."','". $p['nama_produk']."', ".$p['jumlah'].", '". $p['harga'] ."',  current_timestamp() , '".$p['status']."' )" );
        echo "
            <script>
                alert('Produk berhasil dibayar');
                document.location.href = 'keranjang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Pembayaran gagal');
                document.location.href = 'keranjang.php';
            </script>
    ";
    }
?>