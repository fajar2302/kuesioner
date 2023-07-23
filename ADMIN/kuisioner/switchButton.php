<?php
include '../../koneksi.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $query = mysqli_query($koneksi, "UPDATE `tb_judul` SET `status` = '$status' WHERE id_judul = '$id'");
    if ($query) {
        echo 'success|Data Berhasil Diubah';
    } else {
        echo 'error|Data gagal Diubah';
    }
}
