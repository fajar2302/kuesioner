<?php
include '../../koneksi.php';

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $lokasi = $_POST['lokasi'];
    $tahun = $_POST['tahun'];
    $status = $_POST['status'];
    do {
        $id_acak = randomNumber(4);
        $cekId = "SELECT id_judul FROM tb_judul WHERE id_judul = '" . $id_acak . "'";
        $queryCek = mysqli_query($koneksi, $cekId);
        $result = mysqli_num_rows($queryCek);
    } while ($result > 0);

    $query = mysqli_query($koneksi, "INSERT INTO `tb_judul` (`id_judul`,`judul`, `lokasi`, `tahun`, `status`) VALUES ('$id_acak','$judul', '$lokasi', '$tahun','$status')");
    if ($query) {
        $cekId = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '" . $id_acak . "'"));
        echo "success|Data Berhasil Ditambahkan|" . $cekId['id_judul'] . "";
    } else {
        echo 'error|Data gagal ditambahkan';
    }
}


if (isset($_POST['hapus'])) {
    $id = $_POST['hapus'];
    $query = mysqli_query($koneksi, "DELETE FROM `tb_judul` WHERE id_judul = '$id'");
    if ($query) {
        echo 'success|Data berhasil dihapus';
    } else {
        echo 'error|Data gagal dihapus';
    }
}

if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $lokasi = $_POST['lokasi'];
    $tahun = $_POST['tahun'];
    $query = mysqli_query($koneksi, "UPDATE `tb_judul` SET `judul`='$judul',`lokasi`='$lokasi',`tahun`='$tahun' WHERE id_judul = '$id'");
    if ($query) {
        echo 'success|Data Berhasil Diubah';
    } else {
        echo 'error|Data gagal Diubah';
    }
}


function randomNumber($panjang_karakter)
{
    $karakter = '1234567890';
    $string = '';
    for ($i = 0; $i < $panjang_karakter; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter[$pos];
    }
    return $string;
}
