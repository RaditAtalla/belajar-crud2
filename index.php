<?php 
    session_start();
    if(!isset($_SESSION['login'])){
        header('Location: login.php');
        exit;
    }

    require 'functions.php';
    $kawan = query('SELECT * FROM kawan');

    if (isset($_POST['cari'])){
        $kawan = search($_POST['keyword']);
    }

    if (isset($_POST['reset'])){
        $kawan = query('SELECT * FROM kawan');
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD 2</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="m-5">
    <a href="logout.php">Logout</a>
    <h1>BELAJAR CRUD</h1>
    <a href="registration.php" class="btn btn-warning ms-1" style="float: right;">Sign Up</a>
    <a href="login.php" class="btn btn-success" style="float: right;">Log In</a>
    <a href="add.php" class="btn btn-primary">Tambah Data</a>
    <form action="" method="POST">
        <input type="text" name="keyword" class="form-control w-50" placeholder="Cari data..">
        <button type="submit" name="cari" class="btn btn-secondary">Cari</button>
        <button type="submit" name="reset" class="btn btn-secondary">Reset</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $x = 1?>
            <?php foreach($kawan as $kwn) : ?>
            <tr>
                <td><?= $x; ?></td>
                <td><img src="img/<?= $kwn['gambar']?>" alt="Foto" width="150px"></td>
                <td><?= $kwn['nama']; ?></td>
                <td><?= $kwn['nisn']; ?></td>
                <td><a href="edit.php?id=<?= $kwn['id'] ?>">Edit</a> | <a href="delete.php?id=<?= $kwn['id'] ?>" onclick="confirm('Hapus data?')">Hapus</a></td>
            </tr>
            <?php $x++?>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>