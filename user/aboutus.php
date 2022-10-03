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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dagishop | About Us</title>
    <link rel="stylesheet" type="text/css" href="cssuser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php">Dagishop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="produkuser.php">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="kategoriuser.php">Kategori</a></li>
                        <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link active" href="aboutus.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                    </ul>
                    <form class="d-flex ms-auto">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn-primary" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body"><p class="text-white m-0" style="font-size:30px;">About Us</p></div>
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <div class="mb-5">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="text-center"> <img src="../profil.jpg" width="100" class="rounded-circle"> </div>
                            <div class="text-center mt-3">
                                <h5 class="mt-2 mb-0">Dandun Gigih Prakoso</h5> <span>L200190172</span>
                                <div class="px-4 mt-1">
                                    <p class="fonts">Nama "Dagishop" ini terinspirasi dari nama saya yaitu Dandun Gigih yang disingkat menjadi "DaGi" kemudian ditambah dengan kata "Shop" </p>
                                </div>
                                <ul class="list-sm">
                                    <li><a href="https://www.facebook.com/NuthNathh"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.instagram.com/dandun.gp/"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/dandun-gigih-prakoso-363127203/"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center mt-3">
                                <div class="buttons"><a href="https://wa.me/6281325149152?text=Haloo"><button class="btn btn-outline-success px-4">Pesan</button></a></div>
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="py-3 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">L200190172</p></div>
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Dandun Gigih Prakoso</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>