<?php
include '../../koneksi.php';
$id = $_POST['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id'"));
$query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id'");
$ambilBaris = '';
$jumlahBaris = mysqli_num_rows($query);
if ($jumlahBaris > 0) {
    $ambilBaris = $jumlahBaris;
} else {
    $ambilBaris = 0;
}

?>
<div class="mb-3">
    <label for="exampleInputText2" class="form-label">Judul</label>
    <input type="text" class="form-control" id="exampleInputText1" disabled name="judul" value="<?= $data['judul'] ?>">
</div>
<div class="mb-3">
    <label for="exampleInputText2" class="form-label">Lokasi</label>
    <input type="text" class="form-control" id="exampleInputText2" disabled name="lokasi" value="<?= $data['lokasi'] ?>">
</div>
<div class="mb-3">
    <label for="exampleInputText3" class="form-label">Tahun</label>
    <input type="text" class="form-control" id="exampleInputText3" disabled name="tahun" value="<?= $data['tahun'] ?>">
</div>
<div class="mb-3">
    <label for="exampleInputText3" class="form-label">Jumlah Pertanyaan</label>
    <input type="text" class="form-control" id="exampleInputText3" disabled name="tahun" value="<?= $ambilBaris; ?>">
</div>

<script>

</script>