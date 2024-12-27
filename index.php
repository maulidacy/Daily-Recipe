<?php
include "koneksi.php";
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Best Recipe</title>
    <link rel="icon" href="img/logo.jpeg">

    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<style>
    .btn-outline-success {
        color: #f8f9fa;
        border-color: #f8f9fa;
    }

    .btn-outline-success:hover {
        background-color: #f8f9fa;
        color: #446879;
    }

    .nav-link:hover {
        color: #f8f9fa;
    }

    .bg-blue {
        background-color: #446879;
    }

    /* Mengatur warna latar belakang untuk elemen dengan kelas .bg-blue
    ketika mode tema gelap (dark) diaktifkan */
    [data-bs-theme="dark"] {
        .bg-blue {
            background-color: #2c3e50;
        }

        .navbar-brand {
            color: rgb(214, 220, 225);
        }
    }

    [data-bs-theme="light"] {

        .navbar-brand,
        .nav-link {
            color: #f8f9fa;
        }

        .nav-link:hover {
            color: rgb(150, 167, 175);
        }

        .container h1 {
            color: #f8f9fa;
        }
    }

    .nav-link:hover {
        color: #f8f9fa;
    }
</style>
</style>

<body>

    <!--navbar start-->
    <nav class="navbar navbar-expand-lg bg-blue sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#home">Best Recipe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-me">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">|</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" target="_blank"><b>Login</b></a>
                    </li>

                    <li>
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button class="btn btn-dark btn-primary" type="button" data-bs-theme-value="dark">
                                <i class="bi bi-moon-stars-fill" data-theme-icon="bi-sun-fill"></i>
                            </button>

                            <button class="btn btn-light btn-primary" type="button" data-bs-theme-value="light">
                                <i class="bi bi-sun" data-theme-icon="bi-sun-fill"></i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--navbar end-->

    <!--hero start-->
    <section id="hero" class="text-center p-5 bg-beige text-sm-start">
        <div class="container-home">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="img/gambar11.png" class="img-fluid" width="500" alt="">
                <div>
                    <h3 class="fw-bold display-8">Haii Foodie...</h3>
                    <h1 class="fw-bold display-8">Buat Resep Fenomenal, Simpan, dan Bagikan</h1>
                    <h4 class="lead display-10">Bergabunglah dengan kami dan buat pengalaman memasak Anda lebih
                        interaktif serta menyenangkan! Unggah dan bagikan resep andalan Anda, dapatkan inspirasi dari
                        pencinta kuliner lainnya.</h4>
                    <h6>
                        <span id="tanggal"></span>
                        <span id="jam"></span>
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <!--hero end-->

    <!-- article begin -->
    <section id="article" class="text-center p-5 bg-blue">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
                $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                $hasil = $conn->query($sql);

                $no = 1;
                while ($row = $hasil->fetch_assoc()) {
                ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["judul"] ?></h5>
                                <p class="card-text">
                                    <?= $row["isi"] ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">
                                    <?= $row["tanggal"] ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- article end -->

    <!--gallery start-->
    <section id="gallery" class="text-center p-5 bg-beige">
        <div class="container-gallery">
            <h1 class="fw-bold display-4 pb-3">gallery</h1>
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/gambar1.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/gambar2.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/gambar3.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/gambar1.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/gambar3.jpeg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <!--gallery end-->

    <!--schedule start-->
    <section id="schedule" class="text-center p-5 bg-beige text-sm-start bg-blue">
        <div class="container">
            <h1 class="text-center fw-bold display-4 pb-3">Schedule</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <div class="col">
                    <div class="card h-100">
                        <div class="list-group list-group-flush text-center">
                            <li class="list-group-item bg-danger text-light">SENIN</li>
                            <li class="list-group-item ">Rekayasa Perangkat Lunak
                                <p>09.30-12.00 | H.5.6</p>
                            </li>
                            <li class="list-group-item">Logika Informatika
                                <p>12.30-15.00 | H.4.9</p>
                            </li>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="list-group list-group-flush text-center">
                            <li class="list-group-item bg-danger text-light">SELASA</li>
                            <li class="list-group-item">Rekayasa Perangkat Lunak
                                <p>09.30-12.00 | H.5.6</p>
                            </li>
                            <li class="list-group-item">Logika Informatika
                                <p>12.30-15.00 | H.4.9</p>
                            </li>
                            <li class="list-group-item">Logika Informatika
                                <p>12.30-15.00 | H.4.9</p>
                            </li>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="list-group list-group-flush text-center">
                            <li class="list-group-item bg-danger text-light">RABU</li>
                            <li class="list-group-item">FREE</li>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="list-group list-group-flush text-center">
                            <li class="list-group-item bg-danger text-light">KAMIS</li>
                            <li class="list-group-item">Rekayasa Perangkat Lunak
                                <p>09.30-12.00 | H.5.6</p>
                            </li>
                            <li class="list-group-item">Logika Informatika
                                <p>12.30-15.00 | H.4.9</p>
                            </li>
                            <li class="list-group-item">Logika Informatika
                                <p>12.30-15.00 | H.4.9</p>
                            </li>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="list-group list-group-flush text-center">
                            <li class="list-group-item bg-danger text-light">JUMAT</li>
                            <li class="list-group-item">Rekayasa Perangkat Lunak
                                <p>09.30-12.00 | H.5.6</p>
                            </li>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="list-group list-group-flush text-center">
                            <li class="list-group-item bg-danger text-light">SABTU</li>
                            <li class="list-group-item">FREE</li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--schedule end-->

    <!--about me start-->
    <section id="about-me" class="text-center p-5 bg-beige text-sm-start">
        <div class="container-about-me">
            <div class="d-sm-flex align-items-center">
                <img src="img/saya1.jpg" class="img-fluid rounded-circle me-3" width="300" alt="">
                <div>
                    <h3 class="display-8">A11.2023.15470</h3>
                    <h1 class="fw-bold display-8">Maulida Cahya Kurnia</h1>
                    <h4 class="lead display-10">Program Studi Teknik Informatika</h4>
                    <h4 class="fw-bold lead display-10">Universitas Dian Nuswantoro</h4>
                </div>
            </div>
        </div>
    </section>

    <!--about me and-->

    <!--footer start-->
    <footer class="text-center p-3 bg-blue">
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

    <!--js time-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.setTimeout("tampilWaktu()", 1000);

        function tampilWaktu() {
            var waktu = new Date();
            var bulan = waktu.getMonth() + 1;

            setTimeout("tampilWaktu()", 1000);
            document.getElementById("tanggal").innerHTML =
                waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
            document.getElementById("jam").innerHTML =
                waktu.getHours() +
                ":" +
                waktu.getMinutes() +
                ":" +
                waktu.getSeconds();
        }
    </script>

    <!--js color modes-->
    <script>
        /*!
         * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
         * Copyright 2011-2024 The Bootstrap Authors
         * Licensed under the Creative Commons Attribution 3.0 Unported License.
         */

        (() => {
            'use strict'

            const getStoredTheme = () => localStorage.getItem('theme')
            const setStoredTheme = theme => localStorage.setItem('theme', theme)

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme()
                if (storedTheme) {
                    return storedTheme
                }

                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            }

            const setTheme = theme => {
                if (theme === 'auto') {
                    document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
                } else {
                    document.documentElement.setAttribute('data-bs-theme', theme)
                }

            }

            setTheme(getPreferredTheme())

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = document.querySelector('#bd-theme')

                if (!themeSwitcher) {
                    return
                }

                const themeSwitcherText = document.querySelector('#bd-theme-text')
                const activeThemeIcon = document.querySelector('.theme-icon-active')
                const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                const iconOfActiveBtn = btnToActive.querySelector('i').dataset.themeIcon

                document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                    element.classList.remove('active')
                    element.setAttribute('aria-pressed', 'false')
                })

                btnToActive.classList.add('active')
                btnToActive.setAttribute('aria-pressed', 'true')
                activeThemeIcon.classList.remove(activeThemeIcon.dataset.themeIconActive)
                activeThemeIcon.classList.add(iconOfActiveBtn)
                activeThemeIcon.dataset.iconActive = iconOfActiveBtn

                const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
                themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

                if (focus) {
                    themeSwitcher.focus()
                }
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme()
                if (storedTheme !== 'light' && storedTheme !== 'dark') {
                    setTheme(getPreferredTheme())
                }
            })

            window.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            setStoredTheme(theme)
                            setTheme(theme)
                            showActiveTheme(theme, true)
                        })
                    })
            })
        })()
    </script>


</body>

</html>