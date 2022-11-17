<?php 
 
    include 'koneksi.php';
    
    error_reporting(0);
    
    session_start();
    
    if (isset($_SESSION['user'])) {
        header("Location: index.php");
    }
    
    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM login WHERE user='$user' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $row['user'];
            header("Location: index.php");
        } else {
            echo "<script>alert('User atau password Anda salah. Silahkan coba lagi!')</script>";
        }
    }
 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="./assets/bs4/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="./assets/bs4/css/login.css">
 
    <title>Login</title>
</head>
<body>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error']?>
    </div>
 
    <div class="container">
        <form action="" method="POST" class="user-login">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="User" name="user"  required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
        </form>
    </div>
</body>
</html>