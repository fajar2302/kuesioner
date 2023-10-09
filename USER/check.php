<?php
include '../koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $id_judul = $_POST['id_judul'];

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$id_user'");
    if (mysqli_num_rows($query) > 0) {
        $getdata = mysqli_fetch_assoc($query);
        $nama = $getdata['nama'];

        $baru = str_replace(" ", "", $nama);
        $teks_nonkapital = strtolower($baru);

        $enkrip = $teks_nonkapital . "_" . $id_user;
        // echo '' . $enkrip . '';

        // mengecek apakah kuesioner sudah terisi atau belum
        $query2 = mysqli_query($koneksi, "SELECT * FROM $enkrip");
        if (mysqli_num_rows($query2) > 0) {
            echo 'success|' . $enkrip . '';
        } else {
            echo 'erorr|' . $enkrip . '';
        }
    }
}
