<?php

$conn = mysqli_connect('localhost', 'root', '', 'belajarphp');

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function add($data)
{
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $nisn = htmlspecialchars($data['nisn']);
    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO kawan 
                VALUES('', '$gambar', '$nama', '$nisn')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kawan WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $nisn = htmlspecialchars($data['nisn']);
    $gambar = htmlspecialchars($data['gambar']);

    $query = "UPDATE kawan SET
                nama = '$nama',
                nisn = '$nisn',
                gambar = '$gambar'
            WHERE id = $id;
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM kawan WHERE
                nama LIKE '%$keyword%' OR
                nisn LIKE '%$keyword%'
            ";

    return query($query);
}

function upload()
{
    $namaGambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $errorGambar = $_FILES['gambar']['error'];
    $ukuranGambar = $_FILES['gambar']['size'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaGambar);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if ($errorGambar === 4) {
        echo '<script>
            alert("Harap pilih gambar!");
        </script>';
        return false;
    }

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo '<script>
            alert("Bukan gambar itu, ekstensi harus jpg, jpeg, atau png");
        </script>';
        return false;
    }

    if ($ukuranGambar >= 1000000) {
        echo '<script>
            alert("Ukuran gambar maximal 1 mb ");
        </script>';
        return false;
    }

    move_uploaded_file($tmp_name, 'img/' . $namaGambar);
    return $namaGambar;
}

function registration($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // ? cek username sudah ada di db atau belum
    $result = mysqli_query($conn, "SELECT username FROM akun2 WHERE username = '$username'");
    if (mysqli_fetch_assoc($result) > 0) {
        echo '<script>
            alert("Username sudah diambil!");
        </script>';

        return false;
    }

    // ? cek konfirmasi password
    if ($password !== $password2) {
        echo '<script>
            alert("Password tidak sesuai!");
        </script>';

        return false;
    }

    // ? enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // ? tambah ke db
    mysqli_query($conn, "INSERT INTO akun2 VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;

    $username = $data['username'];
    $password = $data['password'];
    // ! up next = get password hash to check passwor

    // ? ambil username dan password di db
    $usernameDB = mysqli_query($conn, "SELECT username FROM akun2 WHERE username = '$username'") -> num_rows;
    $passwordDB = mysqli_query($conn, "SELECT password FROM akun2 WHERE password = '$password'");

    // if($usernameDB > 0){
    //     echo '<script>
    //         alert("Bisa anjir");
    //     </script>';
    // } else {
    //     echo '<script>
    //         alert("wtf gabisa");
    //     </script>';
    // }
}
