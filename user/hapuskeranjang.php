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
    
    $query = mysqli_query($conn, "delete from keranjang where id_keranjang=$idker");

    if($query){
        echo "
            <script>
                alert('Data berhasil dihapus');
                document.location.href = 'keranjang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal dihapus');
                document.location.href = 'keranjang.php';
            </script>
    ";
    }
?>