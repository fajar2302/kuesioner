<?php
include '../koneksi.php';


if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenkel = $_POST['jenkel'];
    $id_judul = $_POST['judul_id'];
    $id_respon = time();
    $baru = str_replace(" ", "", $nama);
    $teks_nonkapital = strtolower($baru);

    $enkrip = $teks_nonkapital . "_" . $id_respon;


    // $banding = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$enkrip'";
    // $cari = mysqli_query($koneksi, $banding);

    // if (mysqli_num_rows($cari) > 0) {
    // }

    $create = "CREATE TABLE " . $enkrip . " (
        id_respon VARCHAR(250) PRIMARY KEY,
        nama VARCHAR(250) NOT NULL,
        umur VARCHAR(20) NOT NULL,
        jenkel VARCHAR(25) NOT NULL,
        judul_id VARCHAR(250),
        jenisKuisioner_id VARCHAR(100),
        pertanyaan_id VARCHAR(100),
        presepsi INT (20) NOT NULL,
        harapan INT (20) NOT NULL,
        FOREIGN KEY (judul_id) REFERENCES tb_judul(id_judul),
        FOREIGN KEY (jenisKuisioner_id) REFERENCES tb_jeniskuisioner(id_jenisKuisioner),
        FOREIGN KEY (pertanyaan_id) REFERENCES tb_pertanyaan(id_pertanyaan)
        )";
    $sql = mysqli_query($koneksi, $create);
    if ($sql) {
        $query = mysqli_query($koneksi, "INSERT INTO $enkrip (id_respon, nama, umur, jenkel) VALUES ('$id_respon','$nama','$umur','$jenkel')");
        if ($query) {
            echo "success|Data Berhasil Ditambahkan|" . $id_judul . "|" . $id_respon . "|" . $enkrip . "";
        }
    }
}



// $id_pertanyaan = $_POST['pertanyaan_id'];