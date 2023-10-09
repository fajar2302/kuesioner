<?php
include '../koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id'];
    $id_pertanyaan = $_POST['pertanyaan_id'];
    $judul = $_POST['judul_id'];
    $jenis = $_POST['jenis_id'];
    $tabel = $_POST['tabel'];
    $presepsi = $_POST['presepsi'];
    $harapan = $_POST['harapan'];
    $id = time();

    $databased = 'kuisioner_db';

    // echo "success|" . $tabel . "";

    $banding = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$databased' AND TABLE_NAME = '$tabel'";
    $cari = mysqli_query($koneksi, $banding);

    if (mysqli_num_rows($cari) > 0) {
        $query = "SELECT * FROM $tabel WHERE pertanyaan_id = '$id_pertanyaan'";
        $ambil = mysqli_query($koneksi, $query);
        if (mysqli_num_rows($ambil) > 0) {
            $sql = "UPDATE $tabel SET presepsi = '$presepsi', harapan = '$harapan'";
            $update = mysqli_query($koneksi, $sql);
            if ($update) {
                echo "success|Data Berhasil Ditambahkan";
            }
        } else {
            // $sql = "UPDATE $tabel SET pertanyaan_id = '$id_pertanyaan', jenisKuisioner_id = '$jenis', judul_id = '$judul', presepsi = '$presepsi', harapan = '$harapan' WHERE id_respon =  '$id'";
            $sql = "INSERT INTO $tabel (id_respon, username_id,  pertanyaan_id, jenisKuisioner_id, judul_id, presepsi, harapan) VALUES ('$id','$id_user','$id_pertanyaan','$jenis','$judul','$presepsi','$harapan') ";
            $insert = mysqli_query($koneksi, $sql);

            if ($insert) {
                echo "success|Data Berhasil Ditambahkan";
            }
        }
    }
}
function hitung()
{
}