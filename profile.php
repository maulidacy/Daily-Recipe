<?php

session_start();
include "koneksi.php";

$message = "";
$error = "";
$simpan = true; //variabel untuk memeriksa kesuksesan semua perubahan


//memastikan user sudah login
/*if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit();
}*/

//mengambil data user dari session
$username = $_SESSION['username'];

//mengambil data profil user
$query = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $query);

//cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

//Update data user jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_password = $_POST['password'];
        $new_foto = $_FILES['foto']['name'];
        $foto_lama = $user['foto']; //menyimpan nama foto lama
        $simpan = true; //untuk memeriksa kesuksesan semua perubahan


        //update username
        if (!empty($new_username) && $new_username != $username) {
            $update_query = "UPDATE user SET username='$new_username' WHERE username='$username'";
            mysqli_query($conn, $update_query);
            $_SESSION['username'] = $new_username; //update session username
            $username = $new_username; //update variabel username untuk query selanjutnya
        }

        //update password
        if (!empty($new_password)) {
            $update_query = "UPDATE user SET password=MD5('$new_password') WHERE username='$username'";
            mysqli_query($conn, $update_query);
        }

        //update foto
        if (!empty($new_foto)) {
            //hapus foto lama jika ada
            if ($foto_lama != 'default.jpg') {
                unlink('img/' . $foto_lama);
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $new_foto);
            $update_query = "UPDATE user SET foto='$new_foto' WHERE username='$username'";
            mysqli_query($conn, $update_query);
        }

        //simpan pesan ke session
        if ($simpan) {
            $_SESSION['message'] = $message; // Simpan pesan sukses ke session
        } else {
            $_SESSION['error'] = $error; // Simpan pesan error ke session
        }

        //jika semua perubahan berhasil
        if ($simpan) {
            echo "<script>
            alert('Perubahan data sukses');
            document.location='profile.php?page=profile';
        </script>";
        } else {
            echo "<script>
            alert('Perubahan data gagal');
            document.location='profile.php?page=profile';
        </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Best Recipe | Profile</title>
    <link rel="icon" href="img/logo.jpeg">

    <!--Bootstrap icons-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

    <!--Bootstrap css-->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <!--Ajax js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        #content {
            min-height: 460px;
        }

        .bg-blue {
            background-color: #446879;
        }

        [data-bs-theme="dark"] .bg-blue {
            background-color: #2c3e50;
        }

        .nav-link,
        .navbar-brand {
            color: #f8f9fa;
        }

        .navbar-brand:hover {
            color: #f8f9fa;
        }

        .nav-link:hover {
            color: rgb(165, 178, 192);
        }
    </style>
</head>

<body>
    <!--nav begin-->
    <nav class="navbar navbar-expand-lg bg-blue sticky-top">
        <div class="container">
            <a class="navbar-brand" href="">Best Recipe</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php?page=gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=article">Homepage</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['username'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php?page=profile">Profil <?= $_SESSION['username'] ?></a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--nav end-->

    <!--content begin-->
    <section id="content" class="p-5">
        <div class="container">
            <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">
                Profil
            </h4>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="formGroupExampleInputPassword" class="form-label">Ganti Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInputFoto" class="form-label">Ganti Foto Profil</label>
                    <input class="form-control" type="file" id="formGroupExampleInputFoto" name="foto">
                </div>

                <div class="mb-3">
                    <label for="form-text text-muted">Foto Profil Saat Ini</label><br>
                    <img src="img/<?php echo htmlspecialchars($user['foto']); ?>" alt="Foto Profil" width="100" style="margin-bottom: 20px; margin-top: 10px;"><br>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </section>
    <!--content end-->

    <!--footer start-->
    <footer class="text-center p-5 bg-blue">
        <div>
            <a href="https://www.instagram.com/cahya.cooks?igsh=YWpidHJrZWZ5ZTgz"><i
                    class="bi bi-instagram h2 p-2 text-light"></i></a>
            <a href="http://tiktok.com/@cahya.cooks"><i class="bi bi-tiktok h2 p-2 text-light"></i></a>
            <a href="https://www.youtube.com/@Cahyacooks"><i class="bi bi-youtube h2 p-2 text-light"></i></a>
        </div>
        <div class="text-light">
            Maulida Cahya Kurnia &copy; 2024
        </div>
    </footer>
    <!--footer end-->

    <!--Bootstrap JS-->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>