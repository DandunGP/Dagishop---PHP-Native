<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Dagishop</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="login" style="background-color: #f8f8f8;">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="username" class="input" required>
            <input type="password" name="password" placeholder="password" class="input" required>
            <input type="submit" name="login" value="Login" class="box-login-btn">
        </form>
        <?php
            include 'database.php';
            error_reporting(0);            
            session_start();

            if(isset($_POST['login'])){
                $username = $_POST['username'];
                $password = $_POST['password'];

                $query = mysqli_query($conn, "select * from user where username = '".$username."' and password = '".MD5($password)."'");
                $row = mysqli_fetch_array($query);

                if(mysqli_num_rows($query) > 0){
                    if($row['status']=="admin"){ 
                        $_SESSION['status_login'] = true;
                        $_SESSION['admin_global'] = $row;
                        $_SESSION['status_user'] = $row['status'];
                        $_SESSION['id'] = $row['id_user'];
                        echo "
                        <script>
                            window.location='admin/dashboard.php';
                        </script>
                        ";
                    }else{
                        $_SESSION['status_login'] = true;
                        $_SESSION['nama']=$row['nama_user'];
                        $_SESSION['status_user'] = $row['status'];
                        $_SESSION['id']=$row['id_user'];
                        echo "
                        <script>
                            window.location='user/index.php';
                        </script>
                        ";
                    }
                }else{
                    echo "
                        <script>
                            alert('Username atau password salah!');
                        </script>
                    ";
                }

            }
        ?>
        <div class="login-register-text">
            anda belum memiliki akun ? <a href="register.php">register</a>
        </div>
    </div>
</body>
</html>