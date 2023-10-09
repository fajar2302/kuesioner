<?php
include '../../koneksi.php';

$id_judul = $_POST['id'];
$query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner  WHERE tb_pertanyaan.judul_id = '$id_judul' GROUP BY tb_pertanyaan.jenisKuisioner_id");
$jumlah_pertanyaan = mysqli_num_rows($query_pertanyaan);

?>
<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active bg-custom text-light" id="hasil-respon" aria-current="page" href="#">Hasil
                Responden</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-black" href="#" id="validitas">Validitas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-black" href="#" id="reliabilitas">Reliabilitas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-black" href="#" id="servqual">ServQual</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-black" href="#" id="ahp">AHP</a>
        </li>
    </ul>
    <div class="mt-4 pb-2">
        <hr class="dropdown-divider" />
    </div>
    <div class="switch-page" id="page">
        <div class="row mx-3 my-3">
            <div class="col-md-12 fw-bold fs-5 text-center text-uppercase">Hasil Responden</div>
        </div>
        <div id="table-data" class="card my-3">
            <div class="card-body">
                <div class="title my-3">
                    <h5 class="fw-bold fs-6 text-uppercase">Tabel Persepsi</h5>
                    <input type="hidden" id="id" value="<?= $id_judul; ?>">
                </div>
                <?php

                $queryJenkus = mysqli_fetch_assoc($query_pertanyaan);
                $jenkus = $queryJenkus['jenis_kuisioner'];
                $id_jenkus = $queryJenkus['jenisKuisioner_id'];

                // query pertanyaan untuk nomor kolom
                $tbTanya = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul'");
                $jmlhBaris = mysqli_num_rows($tbTanya);

                // inisialisasi colspan dan spankuis
                $colspan = 0;
                $spanKuis = 1;

                // perulangan untuk pengisian colspan
                for ($no_kuis = 0; $no_kuis < $jmlhBaris; $no_kuis++) {
                    $colspan++;
                }
                ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="border border-black">
                        <tr class="bg-custom text-light">
                            <th rowspan="2" class="text-center">
                                <p>Responden</p>
                            </th>
                            <th class="text-center" rowspan="1" colspan="<?= $colspan; ?>">Pertanyaan</th>
                            <th rowspan="2" class="text-center">
                                <p>Jumlah (Y<sub>1</sub>)</p>
                            </th>
                        </tr>
                        <tr class="bg-custom text-light">
                            <?php
                            // perulangan untuk kolom
                            $no_kolom = 1;

                            for ($j = 0; $j < $jmlhBaris; $j++) {
                            ?>
                            <th class=" text-center"><?= $no_kolom++; ?></th>
                            <?php
                            }
                            ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $user = mysqli_query($koneksi, "SELECT * FROM tb_user");
                        while ($cek_user = mysqli_fetch_assoc($user)) {
                            $nama = $cek_user['nama'];
                            $id_user = $cek_user['username'];

                            $baru = strtolower(str_replace(" ", "", $nama));
                            $nama_tabel = $baru . "_" . $id_user;

                            $selectTabel = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'kuisioner_db' AND TABLE_NAME = '$nama_tabel'";
                            $cari = mysqli_query($koneksi, $selectTabel);
                            if (mysqli_num_rows($cari) > 0) {
                                $selectHasil = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE judul_id = '$id_judul'");
                                $jumlah_baris = mysqli_num_rows($selectHasil);
                                if ($jumlah_baris > 0) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $nama; ?></td>
                            <?php
                                        $hasil_jumlah = 0; // Inisialisasi total penjumlahan
                                        $kode_pertanyaan = []; // Kode pertanyaan berfungsi untuk mengisi id pertanyaan
                                        for ($i = 0; $i < $jumlah_baris; $i++) {
                                            $data = mysqli_fetch_assoc($selectHasil);

                                            $presepsi = $data['presepsi'];
                                            $pertanyaan = $data['pertanyaan_id'];
                                            $konvers = intval($presepsi);

                                            // Menambahkan angka dalam bentuk string menjadi integer
                                            $hasil_jumlah += $konvers;
                                            if (!in_array($pertanyaan, $kode_pertanyaan)) { // jika array kosong maka $pertanyaan masukkan ke dalam $kode_pertanyaan
                                                $kode_pertanyaan[] = $pertanyaan;
                                            }

                                        ?>
                            <td class="text-center"><?= $presepsi; ?></td>
                            <?php
                                        }
                                        ?>

                            <!-- Menampilkan hasil penjumlahan di luar loop -->
                            <td class="text-center" data-hasil=<?= $hasil_jumlah; ?>><?= $hasil_jumlah; ?></td>
                        </tr>
                        <?php
                                } else {
                                ?>
                        <td class="text-center" colspan="8">Data Kosong</td>
                        <?php
                                }
                            }
                        }
                        ?>
                        <tr>
                            <td class="text-center fw-bold">Total</td>
                            <?php
                            for ($i = 0; $i < count($kode_pertanyaan); $i++) {
                            ?>
                            <td class="text-center"><?= hitungTotal($kode_pertanyaan[$i]);  ?></td>
                            <?php
                            }
                            ?>
                            <td class="text-center"><?= $hasil_jumlah; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="tabel-harapan" class="card mb-3">

        </div>

    </div>
    <script>
    $(document).ready(function() {
        let id = $('#id').val();
        $.post('pengolahan-data/tabelHasilHarapan.php', {
            id: id,
        }, function(respon) {
            $('#tabel-harapan').html(respon);
        })

        // ketika validitas di klik
        $('#validitas').on('click', function(e) {
            e.preventDefault();
            $.post('pengolahan-data/validitas.php', {
                id: id,
            }, function(respon) {
                $('#page').html(respon);
            })
        })
        $('#hasil-respon').on('click', function(e) {
            e.preventDefault();
            $.post('pengolahan-data/tabel-hasil.php', {
                id: id,
            }, function(respon) {
                $('#table-data').html(respon);
            })
        })

    })
    </script>