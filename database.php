<?php 

$conn = mysqli_connect('localhost', 'id18197296_dandun', 'Final_project5', 'id18197296_finalproject');

if(!$conn){
    die("
    <script>
        alert('Gagal terhubung database');
    </script>
    ");
}
?>