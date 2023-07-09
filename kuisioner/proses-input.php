<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $lokasi = $_POST['lokasi'];
    $tahun = $_POST['tahun'];
    $status = $_POST['status'];
    do {
        $id_acak = randomNumber(4);
        $cekId = "SELECT id_kuisioner FROM tb_kuisioner WHERE id_kuisioner = '" . $id_acak . "'";
        $queryCek = mysqli_query($koneksi, $cekId);
        $result = mysqli_num_rows($queryCek);
    } while ($result > 0);

    $query = mysqli_query($koneksi, "INSERT INTO `tb_kuisioner` (`id_kuisioner`,`judul`, `lokasi`, `tahun`, `status`) VALUES ('$id_acak','$judul', '$lokasi', '$tahun','$status')");
    if ($query) {
        $cekId = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_kuisioner WHERE id_kuisioner = '" . $id_acak . "'"));
        echo "success|" . $cekId['id_kuisioner'] . " | " . $cekId['judul'];
        // echo 'success|Data berhasil ditambahkan|horee';
    } else {
        // echo 'erorr';
        echo 'error|Data gagal ditambahkan|opps';
    }
}

if (isset($_POST['simpan2'])) {
    $jenkus = $_POST['jenis_kuisioner'];
    $jumper = $_POST['jmlh_pertanyaan'];
    $id_kuis = $_POST['kuisioner-id'];

    do {
        $id_acak = randomNumber(4);
        $cekId = "SELECT id_jenisKuisioner FROM tb_jenisKuisioner WHERE id_jenisKuisioner = '" . $id_acak . "'";
        $queryCek = mysqli_query($koneksi, $cekId);
        $result = mysqli_num_rows($queryCek);
    } while ($result > 0);
    $query = mysqli_query($koneksi, "INSERT INTO `tb_jeniskuisioner`(`id_jenisKuisioner`, `kuisioner_id`, `jenis_kuisoner`, `jumlah_pertanyaan`) VALUES ('$id_acak','$id_kuis','$jenkus','$jumper')");
    if ($query) {
        $cekId = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_jenisKuisioner FROM tb_jenisKuisioner WHERE id_jenisKuisioner = '" . $id_acak . "'"));
        echo "success|Data berhasil ditambahkan|Horee";
    } else {
        echo 'error|Data gagal ditambahkan|opps';
    }
}

// aksi membuka tabel form 2
if (isset($_POST['open'])) {
    $id = $_POST['open'];
    $kirim = "tangibles|reability|responsiveness|assurance|emphaty";
    $querySelect = mysqli_query($koneksi, "SELECT * FROM tb_jenisKuisioner WHERE kuisioner_id = '$id'");
    if (mysqli_num_rows($querySelect) > 0) {
        while ($hasil = mysqli_fetch_assoc($querySelect)) {
            $jenkus = $hasil['jenis_kuisoner'];
            if ($jenkus == 'tangibles') {
                $kirim = str_replace('tangibles', '', $kirim);
            }
            if ($jenkus == 'reability') {
                $kirim = str_replace('reability', '', $kirim);
            }
            if ($jenkus == 'responsiveness') {
                $kirim = str_replace('responsiveness', '', $kirim);
            }
            if ($jenkus == 'assurance') {
                $kirim = str_replace('assurance', '', $kirim);
            }
            if ($jenkus == 'emphaty') {
                $kirim = str_replace('emphaty', '', $kirim);
            }
        }
        echo $kirim;
    } else {
        echo $kirim;
    }
}

if (isset($_POST['hapus'])) {
    $id = $_POST['hapus'];
    $query = mysqli_query($koneksi, "DELETE FROM `tb_kuisioner` WHERE id_kuisioner = '$id'");
    if ($query) {
        echo 'success|Data berhasil dihapus|horee';
    } else {
        echo 'error|Data gagal dihapus|opps';
    }
}

if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $lokasi = $_POST['lokasi'];
    $tahun = $_POST['tahun'];
    $query = mysqli_query($koneksi, "UPDATE `tb_kuisioner` SET `judul`='$judul',`lokasi`='$lokasi',`tahun`='$tahun' WHERE id_kuisioner = '$id'");
    if ($query) {
        echo 'success|Data Berhasil Diubah|horee';
    } else {
        echo 'error|Data gagal Diubah|opps';
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
