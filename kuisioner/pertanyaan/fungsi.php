<?php
include '../../koneksi.php';



// menambahkan jenis pertanyaan dan item pertanyaan 
if (isset($_POST['simpan2'])) {
    $jenkus = $_POST['jenis_kuisioner'];
    $pertanyaan = $_POST['pertanyaan'];
    $id_kuis = $_POST['kuisioner-id'];

    do {
        $id_acak = randomNumber(4);
        $cekId = "SELECT id_jenisKuisioner FROM tb_jeniskuisioner WHERE id_jenisKuisioner = '" . $id_acak . "'";
        $queryCek = mysqli_query($koneksi, $cekId);
        $result = mysqli_num_rows($queryCek);
    } while ($result > 0);
    $query = mysqli_query($koneksi, "INSERT INTO `tb_jeniskuisioner`(`id_jenisKuisioner`, `kuisioner_id`, `jenis_kuisoner`) VALUES ('$id_acak','$id_kuis','$jenkus')");
    if ($query) {
        do {
            $id_acak2 = randomNumber(4);
            $cekId2 = "SELECT id_pertanyaan FROM tb_pertanyaan WHERE id_pertanyaan = '" . $id_acak2 . "'";
            $queryCek2 = mysqli_query($koneksi, $cekId2);
            $result2 = mysqli_num_rows($queryCek2);
        } while ($result2 > 0);
        $query2 = mysqli_query($koneksi, "INSERT INTO `tb_pertanyaan`(`id_pertanyaan`, `jenisKuisioner_id`, `item_pertanyaan`) VALUES ('$id_acak2','$id_acak','$pertanyaan')");
        if ($query2) {
            echo "success|Data berhasil ditambahkan";
        } else {
            echo "error|Gagal Menambahkan Data";
        }
    } else {
        echo "error|Gagal Menambahkan Data";
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
