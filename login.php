<?php 
    session_start();
    require 'functions.php';

    if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        $result = mysqli_query($conn, "SELECT * FROM akun2 WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        if($key === hash('sha1', $row['username'])){
            $_SESSION['login'] = true;
        }
    }

    if(isset($_SESSION['login'])){
        header('Location: index.php');
        exit;
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM akun2 WHERE username = '$username'");
        if(mysqli_num_rows($result) === 1){
            $arrResult = mysqli_fetch_assoc($result);
            if(password_verify($password, $arrResult['password'])){
                $_SESSION['login'] = true;

                if(isset($_POST['remember'])){
                    setcookie('id', $arrResult['id'], time() + 60);
                    setcookie('key', hash('sha1', $arrResult['username']), time() + 60);
                }

                header('Location: index.php');
                exit;
            } else{
                $wrongPw = true;
            }
        } else{
            $wrongUsername = true;
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="m-5">
    <h1>Log In</h1>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <?php if(isset($wrongUsername)) :?>
                <p style="color:red;">Username not found!</p>
            <?php endif;?>
            <input type="text" class="form-control w-50" id="username" name="username" placeholder="Masukan Username.." required autofocus autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <?php if(isset($wrongPw)) :?>
                <p style="color:red;">Incorrect password!</p>
            <?php endif;?>
            <input type="password" class="form-control w-50" id="password" name="password" placeholder="Masukan Password.." required autocomplete="off">
        </div>
        <div class="mb-3">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember" class="form-label">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary" name="login">Masuk</button>
    </form>
</body>

</html>