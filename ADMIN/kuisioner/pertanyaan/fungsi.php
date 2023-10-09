<?php
include '../../../koneksi.php';



// menambahkan jenis pertanyaan dan item pertanyaan 
if (isset($_POST['simpan2'])) {
    $id = $_POST['id_pertanyaan'];
    $jenkus = $_POST['jenis_kuisioner'];
    $pertanyaan = $_POST['pertanyaan'];
    $id_judul = $_POST['judul-id'];
    $waktu = date('Y-m-d H:i:s');
    // echo "erorr|" . $id . "";
    if (empty($id)) {
        // program percobaan
        do {
            $id_acak = randomNumber(4);
            $cekId = "SELECT id_pertanyaan FROM tb_pertanyaan WHERE id_pertanyaan = '" . $id_acak . "'";
            $queryCek = mysqli_query($koneksi, $cekId);
            $result = mysqli_num_rows($queryCek);
        } while ($result > 0);
        $query = mysqli_query($koneksi, "INSERT INTO `tb_pertanyaan`(`id_pertanyaan`, `judul_id`, `jenisKuisioner_id`, `item_pertanyaan`, `waktu`) VALUES ('$id_acak','$id_judul','$jenkus','$pertanyaan','$waktu')");
        if ($query) {
            echo "success|Data berhasil ditambahkan";
        } else {
            echo "error|Gagal Menambahkan Data";
        }
    } else {
        $query = mysqli_query($koneksi, "UPDATE `tb_pertanyaan` SET `judul_id`='$id_judul',`jenisKuisioner_id`='$jenkus',`item_pertanyaan`='$pertanyaan' WHERE id_pertanyaan = '$id'");
        if ($query) {
            echo 'success|Data Berhasil Diubah';
        } else {
            echo 'error|Data gagal Diubah';
        }
    }
}


// kondisi ketika menghapus
if (isset($_POST['hapus'])) {
    $id = $_POST['hapus'];
    $query = mysqli_query($koneksi, "DELETE FROM `tb_pertanyaan` WHERE id_pertanyaan = '$id'");
    if ($query) {
        echo 'success|Data berhasil dihapus';
    } else {
        echo 'error|Data gagal dihapus';
    }
}


// membuat id secara random 4 angka
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
