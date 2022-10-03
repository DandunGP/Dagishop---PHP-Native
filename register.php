<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Dagishop</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="login" style="background-color: #f8f8f8;">
    <div class="box-login">
        <h2>Register</h2>
        <form action="" method="POST">
            <input type="text" name="nama" placeholder="nama" class="input" required>
            <input type="text" name="username" placeholder="username" class="input" required>
            <input type="password" name="password" placeholder="password" class="input" required>
            <input type="text" name="email" placeholder="email" class="input" required>
            <input type="submit" name="regis" value="Register" class="box-login-btn">
        </form>
        <?php 
            include 'database.php';
            error_reporting(0);            
            if(isset($_POST['regis'])){
                $nama = mysqli_real_escape_string($conn, $_POST['nama']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);

                $result = mysqli_query($conn, "select username from user where username = '$username'");
                $result2 = mysqli_query($conn, "select email_user from user where email_user = '$email'");
                        
                if(mysqli_fetch_assoc($result)){
                    echo "<script>
                            alert('username sudah terdaftar')
                        </script>";
                    exit;
                }else if(mysqli_fetch_assoc($result2)){
                    echo "<script>
                            alert('email sudah terdaftar')
                        </script>";
                    exit;
                }

                $query = mysqli_query($conn, "insert into user(nama_user, username, password, email_user, status) values
                                    ('$nama','$username', '" .MD5($password). "', '$email', 'member')");
                if($query){
                    echo"<script>
                            alert('berhasil mendaftar')
                            window.location='index.php';
                        </script>";
                }else{
                    echo"<script>
                            alert('gagal mendaftar')
                            window.location='register.php';
                        </script>";
                }
            }
        ?>
        <div class="login-register-text">
            anda sudah memiliki akun ? <a href="index.php">login</a>
        </div>
    </div>
</body>
</html>