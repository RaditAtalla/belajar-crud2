<?php 
    include 'functions.php';

    if(isset($_POST['regis'])){
        if(registration($_POST) > 0) {
            echo '<script>
                alert("Berhasil mendaftar!");
            </script>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="m-5">
    <h1>Registrasi</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control w-50" id="username" name="username" placeholder="Masukan Username.." required autofocus autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control w-50" id="password" name="password" placeholder="Masukan Password.." required autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label" for="password2">Konfirmasi Password:</label>
            <input type="password" class="form-control w-50" id="password2" name="password2" placeholder="Tulis ulang password.." required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="regis">Registrasi</button>
    </form>
</body>

</html>