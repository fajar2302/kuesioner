<?php
include '../koneksi.php';


if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenkel = $_POST['jenkel'];
    $id_judul = $_POST['judul_id'];
    $id_respon = time();

    // $cari = mysqli_query($koneksi, "SELECT * FROM tb_responden WHERE nama LIKE '$nama'");
    // if (mysqli_num_rows($car) > 0) {
    //     $ambil = mysqli_fetch_assoc($cari);
    //     $id_cari = $ambil['id_respon'];
    //     $nama_cari = $ambil['nama'];
    //     $baru2 = str_replace(" ", "", $nama_cari);
    //     $teks_nonkapital = strtolower($baru);

    //     $enkrip = $teks_nonkapital . "_" . $id_cari;
    // }



    $query1 = mysqli_query($koneksi, "INSERT INTO tb_responden (id_responden, nama, jenis_kelamin, umur) VALUES ('$id_respon', '$nama', '$jenkel', '$umur')");
    if ($query1) {
        $baru = str_replace(" ", "", $nama);
        $teks_nonkapital = strtolower($baru);

        $enkrip = $teks_nonkapital . "_" . $id_respon;

        $create = "CREATE TABLE " . $enkrip . " (
            id_respon VARCHAR(250) PRIMARY KEY,
            responden_id VARCHAR(200),
            judul_id VARCHAR(250),
            jenisKuisioner_id VARCHAR(100),
            pertanyaan_id VARCHAR(100),
            presepsi INT (20) NOT NULL,
            harapan INT (20) NOT NULL,
            FOREIGN KEY (responden_id) REFERENCES tb_responden(id_responden) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (judul_id) REFERENCES tb_judul(id_judul) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (jenisKuisioner_id) REFERENCES tb_jeniskuisioner(id_jenisKuisioner) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (pertanyaan_id) REFERENCES tb_pertanyaan(id_pertanyaan) ON DELETE CASCADE ON UPDATE CASCADE
            )";
        $sql = mysqli_query($koneksi, $create);
        if ($sql) {
            echo "success|Data Berhasil Ditambahkan|" . $id_judul . "|" . $id_respon . "|" . $enkrip . "";
        }
    }
}



// $id_pertanyaan = $_POST['pertanyaan_id'];