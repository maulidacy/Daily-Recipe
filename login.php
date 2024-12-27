<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) {
    header("location:admin.php");
    exit(); //memastikan untuk keluar setelah redirect
}


//inisialisasi variabel untuk pesan
$response_message = ''; //menyimpan pesan yang akan ditampilkan kepada user setelah mencoba login
$messageClass = ''; //menyimpan kelas yang menentukan gaya teks untuk response message
$usernameInput = '';
$passwordInput = '';
$alertClass = ''; //menyimpan kelas elemen alert yang menentukan warna bg response message


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
    $password = md5($_POST['password']);

    //menyimpan input username dan password untuk ditampilkan kembali
    $usernameInput = htmlspecialchars($username);
    $passwordInput = htmlspecialchars($_POST['password']);

    //prepared statement
    $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

    //parameter binding 
    $stmt->bind_param("ss", $username, $password); //username string dan password string

    //database executes the statement
    $stmt->execute();

    //menampung hasil eksekusi
    $hasil = $stmt->get_result();

    //mengambil baris dari hasil sebagai array asosiatif
    $row = $hasil->fetch_array(MYSQLI_ASSOC);

    //check apakah ada baris hasil data user yang cocok
    if (!empty($row)) {
        //jika ada, simpan variable username pada session
        $_SESSION['username'] = $row['username'];
        $_SESSION['response_message'] = 'Username dan Password Benar';
        $_SESSION['messageClass'] = 'text-success'; // Kelas untuk styling sukses
        $_SESSION['alertClass'] = 'alert-success'; // Hijau untuk berhasil

        //mengalihkan ke halaman admin
        header("location:admin.php");
        exit();
    } else {
        //jika login gagal, pesan akan disimpan dalam session
        $_SESSION['response_message'] = 'Username dan Password Salah';
        $_SESSION['messageClass'] = 'text-danger'; // Kelas untuk styling
        $_SESSION['alertClass'] = 'alert-warning'; // Kuning untuk gagal

        //menyimpan input kembali ke session untuk ditampilkan
        $_SESSION['usernameInput'] = $usernameInput;
        $_SESSION['passwordInput'] = $passwordInput; // Simpan password untuk ditampilkan

        //mengalihkan kembali ke halaman login
        header("location:login.php");
        exit();
    }

    //menutup koneksi database
    $stmt->close();
    $conn->close();
}

//mengambil pesan dari session jika ada
if (isset($_SESSION['response_message'])) {
    $response_message = $_SESSION['response_message'];
    $messageClass = $_SESSION['messageClass'];
    $alertClass = $_SESSION['alertClass'];

    //mengambil kembali input dari session
    $usernameInput = isset($_SESSION['usernameInput']) ? $_SESSION['usernameInput'] : '';
    $passwordInput = isset($_SESSION['passwordInput']) ? $_SESSION['passwordInput'] : '';

    //menghapus pesan dari session setelah ditampilkan
    unset($_SESSION['response_message']);
    unset($_SESSION['messageClass']);
    unset($_SESSION['alertClass']);
    unset($_SESSION['usernameInput']);
    unset($_SESSION['passwordInput']);
}

?>


<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Best Recipe</title>
    <link rel="icon" href="img/logo.jpeg">

    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<style>
    .user-pass {
        color: black;
    }

    .response-message {
        max-width: 600px;
        width: 300px;
        margin: 0 auto;
    }

    .bg-blue {
        background-color: rgba(68, 104, 121, 0.63);
    }
</style>

<!--form login start-->

<body class="bg-blue">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card border-0 shadow rounded-5">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-person-circle h1 display-4"></i>
                            <p>Best Recipe</p>
                            <hr />
                        </div>
                        <form action="" method="post">
                            <input
                                type="text"
                                name="username"
                                class="form-control my-4 py-2 rounded-4"
                                placeholder="Username"
                                value="<?php echo $usernameInput; ?>" />
                            <input
                                type="password"
                                name="password"
                                class="form-control my-4 py-2 rounded-4"
                                placeholder="Password"
                                value="<?php echo $passwordInput; ?>" />
                            <div class="text-center my-3 d-grid">
                                <button type="submit" class="btn btn-danger rounded-4">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--form login end-->

    <!--response message start-->
    <?php if ($response_message): ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 response-message">
                    <div class="alert <?php echo $alertClass; ?> rounded-5 shadow" role="alert">
                        <div class="text-center">
                            <p class="mb-1 user-pass">user : <?php echo htmlspecialchars($usernameInput); ?></p>
                            <p class="mb-1 user-pass">pass : <?php echo htmlspecialchars($passwordInput); ?></p>
                            <p class="mb-0 <?php echo $messageClass; ?>"><?php echo $response_message; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!--response message end-->

    <!--js time-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>