<?php
include "include/config.php";  // Pastikan koneksi ke database sudah benar
 
ob_start();
session_start();  // Pastikan session dimulai sebelum ada output
 
if (isset($_POST["login"])) {
    $username = $_POST["user"];
    $userpass = MD5($_POST["pass"]);  // Menggunakan MD5 untuk password (lebih baik menggunakan password_hash untuk keamanannya)
 
    // Melakukan query untuk mengecek username dan password di database
    $sql_login = mysqli_query($conn, "SELECT * FROM admin WHERE admin_USER = '$username' AND admin_PASS = '$userpass'");
 
    if (mysqli_num_rows($sql_login) > 0) {
        $row_admin = mysqli_fetch_array($sql_login);
   
        $_SESSION['admin_ID'] = $row_admin['admin_ID'];
        $_SESSION['admin_USER'] = $row_admin['admin_USER'];
   
        // Redirect ke index.php
        header("location:index.php");
        exit();
    } else {
        echo "<p style='color:red;'>Invalid username or password!</p>";
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Include external CSS if needed, no change in your provided CSS code -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="username" name="user" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="password" name="pass" required>
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Remember Me
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn" name="login">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?<a href="#">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
 
<?php
mysqli_close($conn);  // Menutup koneksi ke database setelah selesai
ob_end_flush();  // Menyelesaikan output buffering
?>