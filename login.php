<?php

require 'dbconfig/config.php';
require 'model/admin.php';

session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = new Admin(1, $username, $password);
    // $odg = $korisnik->logInUser($uname, $upass, $conn);
    $rez = Admin::logInAdmin($admin, $conn);

    if($rez->num_rows==1){
        $_SESSION['user_id'] = $admin->id;
        header('Location: index.php');
        exit();
    }else{
        echo '<script type="text/javascript">
        alert("Pogresni podaci!");
        </script>';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>FNN Login Page</title>

</head>
<body>
    <div class="login-form">
        <div class="main-div">
            <h1>ADMIN LOGIN PAGE</h1>
            <form method="POST" action="#">
                <div class="container">
                    <label class="username">Korisnicko ime</label>
                    <input type="text" name="username" class="form-control" placeholder="Unesite username" required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" placeholder="Unesite password" required>
                    <button type="submit" class="submit" name="submit">PRIJAVI SE</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>