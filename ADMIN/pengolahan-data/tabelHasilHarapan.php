<?php
include '../../koneksi.php';

$id_judul = $_POST['id'];
$query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner  WHERE tb_pertanyaan.judul_id = '$id_judul'");
$jumlah_pertanyaan = mysqli_num_rows($query_pertanyaan);

?>
<div class="card-body">
    <div class="title my-3">
        <h5 class="fw-bold fs-6 text-uppercase">Tabel Harapan</h5>
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
                    <p>Jumlah (X<sub>1</sub>)</p>
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

                            for ($i = 0; $i < $jumlah_baris; $i++) {
                                $data = mysqli_fetch_assoc($selectHasil);

                                $harapan = $data['harapan'];
                                $pertanyaan = $data['pertanyaan_id'];
                                $konvers = intval($harapan);

                                // Menambahkan angka dalam bentuk string menjadi integer
                                $hasil_jumlah += $konvers;

                            ?>
                <td class="text-center"><?= $harapan; ?></td>
                <?php
                            }
                            ?>

                <!-- Menampilkan hasil penjumlahan di luar loop -->
                <td class="text-center"><?= $hasil_jumlah; ?></td>
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
        </tbody>
    </table>
</div>