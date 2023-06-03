<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}

require 'functions.php';

$id = $_GET["id"];
$kawan = query("SELECT * FROM kawan WHERE id = $id")[0];

if (isset($_POST['edit'])){
    if(edit($_POST) > 0){
        echo '<script>
            alert("data berhasil diedit");
            document.location.href = "index.php";
        </script>';
    } else{
        echo '<script>
            alert("data gagal diedit");
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
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="m-5">
    <a href="index.php" class="btn btn-secondary">Back</a>
    <h1>Edit Data</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="hidden" class="form-control w-50" name="id" value="<?= $kawan['id'] ?>">
        </div>
        <div class="mb-3">
            <label for="inputNama" class="form-label">Nama</label>
            <input type="text" class="form-control w-50" id="inputNama" name="nama" placeholder="Masukan Nama.." value="<?= $kawan['nama'] ?>" required autofocus autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="inputNIS" class="form-label">NISN</label>
            <input type="number" class="form-control w-50" id="inputNIS" name="nisn" placeholder="Masukan NISN.." value="<?= $kawan['nisn'] ?>" required autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label" for="inputGambar">Gambar</label>
            <input type="file" class="form-control w-50" id="inputGambar" name="gambar" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
    </form>
</body>

</html>