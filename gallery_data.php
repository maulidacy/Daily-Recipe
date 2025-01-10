<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-25">Tanggal</th>
            <th class="w-75">Gambar</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>

        <?php
        include 'koneksi.php';

        //pagination start
        $hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
        $limit = 3; //Jumlah artikel per halaman
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;

        $sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC LIMIT $limit_start, $limit";
        $hasil2 = $conn->query($sql2);
        //pagination end

        while ($row = $hasil2->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <br>pada: <?= $row["tanggal"] ?>
                    <br>oleh: <?= $row["username"] ?>
                </td>

                <td>
                    <?php
                    if ($row["gambar"] != '') {
                        if (file_exists('img/' . $row["gambar"])) {
                    ?>
                            <img src="img/<?= $row["gambar"] ?>" width="100">
                    <?php
                        }
                    }
                    ?>
                </td>
                <td>
                    <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
                        <i class="bi bi-x-circle"></i>
                    </a>

                    <!--Awal Modal Edit-->
                    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Gallery</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="formGroupExampleInput2" class="form-label">Ganti Gambar</label>
                                            <input type="file" class="form-control" name="gambar">
                                        </div>
                                        <div class="mb-3">
                                            <label for="formGroupExampleInput3" class="form-label">Gambar Lama</label>
                                            <?php
                                            if ($row["gambar"] != '') {
                                                if (file_exists('img/' . $row["gambar"])) {
                                            ?>
                                                    <br><img src="img/<?= $row["gambar"] ?>" width="100">
                                            <?php
                                                }
                                            }
                                            ?>
                                            <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Akhir Modal Edit-->


                    <!--Awal Modal Hapus-->
                    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Konfirmasi Hapus Gambar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Yakin akan menghapus gambar "<strong><?= $row["gambar"] ?></strong>"?</label>
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <input type="submit" value="Hapus" name="hapus" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Akhir Modal Hapus-->
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php

//untuk menghitung total gambar
$sql2 = "SELECT * FROM gallery";
$hasil2 = $conn->query($sql2);
$total_records = $hasil2->num_rows;
?>

<p>Total gallery : <?php echo $total_records; ?></p>

<nav class="mb-2">
    <ul class="pagination justify-content-end">
        <?php
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($hlm > $jumlah_number) ? $hlm - $jumlah_number : 1;
        $end_number = ($hlm < ($jumlah_page - $jumlah_number)) ? $hlm + $jumlah_number : $jumlah_page;

        //previous button
        if ($hlm == 1) {
            echo '<li class="page-item disabled"><span class="page-link">First</span></li>';
            echo '<li class="page-item disabled"><span class="page-link">&laquo;</span></li>';
        } else {
            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
            $link_prev = ($hlm > 1) ? $hlm - 1 : 1;
            echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#">&laquo;</a></li>';
        }

        //page number buttons
        for ($i = $start_number; $i <= $end_number; $i++) {
            $link_active = ($hlm == $i) ? ' active' : '';
            echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
        }

        //next button
        if ($hlm == $jumlah_page) {
            echo '<li class="page-item disabled"><span class="page-link">&raquo;</span></li>';
            echo '<li class="page-item disabled"><span class="page-link">Last</span></li>';
        } else {
            $link_next = ($hlm < $jumlah_page) ? $hlm + 1 : $jumlah_page;
            echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#">&raquo;</a></li>';
            echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
        }
        ?>
    </ul>
</nav>