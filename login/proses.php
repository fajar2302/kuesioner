<?php
include '../koneksi.php';
session_start();

// proses login
if (isset($_POST['login'])) {
    $id_user = $_POST['fusername'];
    $pass = $_POST['password'];
    $cek = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$id_user'");
    if (mysqli_num_rows($cek) > 0) {
        $query = mysqli_fetch_assoc($cek);
        $passDb = $query['kata_kunci'];
        if ($pass == $passDb) {
            $roles = $query['roles'];
            $_SESSION['id'] = $id_user;
            echo "success|Berhasil Login|" . $roles . "";
        } else {
            echo "error|Anda Belum Terdaftar";
        }
    } else {
        echo "error|Anda Belum Terdaftar";
    }
}


// proses Daftar
if (isset($_POST['daftar'])) {
    $nama = $_POST['nama'];
    $jenkel = $_POST['jenis_kelamin'];
    $nohp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $user = $_POST['usernama'];
    $pass = $_POST['password'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_user (username, roles, nama, jenis_kelamin, no_hp, umur, alamat, tgl_lahir, kata_kunci, foto) VALUES('$user','responden','$nama','$jenkel','$nohp','','$alamat','','$pass','') ");
    if ($query) {
        $baru = str_replace(" ", "", $nama);
        $teks_nonkapital = strtolower($baru);

        $enkrip = $teks_nonkapital . "_" . $user;

        $create = "CREATE TABLE " . $enkrip . " (
            id_respon VARCHAR(250) PRIMARY KEY,
            username_id VARCHAR(200),
            judul_id VARCHAR(250),
            jenisKuisioner_id VARCHAR(100),
            pertanyaan_id VARCHAR(100),
            presepsi INT (20) NOT NULL,
            harapan INT (20) NOT NULL,
            FOREIGN KEY (username_id) REFERENCES tb_user(username) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (judul_id) REFERENCES tb_judul(id_judul) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (jenisKuisioner_id) REFERENCES tb_jeniskuisioner(id_jenisKuisioner) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (pertanyaan_id) REFERENCES tb_pertanyaan(id_pertanyaan) ON DELETE CASCADE ON UPDATE CASCADE
            )";
        $sql = mysqli_query($koneksi, $create);
        if ($query) {
            echo "success|Selamat Anda Telah Terdaftar";
        } else {
            echo "error|Ada Kesalahan Dalam Pendaftaran";
        }
    }
}
