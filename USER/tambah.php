<?php
include '../koneksi.php';


$id_pertanyaan = $_POST['pertanyaan_id'];
$judul = $_POST['judul_id'];
$jenis = $_POST['jenis_id'];
$presepsi = $_POST['presepsi'];
$harapan = $_POST['harapan'];

echo "info|'$presepsi, $harapan' ";
