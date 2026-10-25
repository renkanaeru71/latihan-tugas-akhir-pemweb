<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="text-center mb-5">JAWA DILARANG LOGIN</h1>

    <div class="container login-box">
        <?php
        if (isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            require_once "proses.php";
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password salah</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Username tidak ditemukan</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" placeholder="Enter Username:" name="username" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn text-start">
                <input type="submit" value="Login" name="login" class="btn btn-primary w-50">
            </div>
        </form>
    </div>
</body>
</html>