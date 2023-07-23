<?php
include '../../../koneksi.php';


$id = $_POST['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_jeniskuisioner WHERE id_jenisKuisioner = '$id'"));
// $query = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `tb_judul` WHERE id_judul = '$data[judul_id]'"));
?>
<form id="form-kuis">
    <div class="mb-3">
        <label for="exampleInputText2" class="form-label">Jenis Kuisioner</label>
        <select class="form-select tetxt-uppercase jenkus" aria-label="Default select example" name="jenis_kuisioner">
            <option value="">Pilih Jenis Kuisioner</option>
            <?php
            $pisah = array('TANGIBLE', 'RELIABILITY', 'RESPONSIVENESS', 'ASSURANCE', 'EMPHATY');

            for ($i = 0; $i < count($pisah); $i++) {
                if ($data['jenis_kuisoner'] == $cari_jenis) {
                    $attribut = 'selected';
                } else {
                    $attribut = '';
                }
                $cari_jenis = $pisah[$i];
            ?>
            <option class=" text text-uppercase" value="<?= $cari_jenis ?>" $attribut>
                <?= $cari_jenis ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <input type="hidden" class="form-control id" name="kuisioner-id" value="<?= $id_judul; ?>">
    <input type="hidden" class="form-control id" name="id_jeniskuisioner" value="<?= $id_jeniskuisioner; ?>">
    <div class="mb-3" id="pertanyaan2">
        <label for="exampleInputText3" class="form-label">Pertanyaan</label>
        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan"
            value="<?= $data['item_pertanyaan'] ?>">
    </div>
    <div class="d-grid col-6 mx-auto">
        <button class="btn" type="submit" name="simpan2">Save</button>
    </div>
</form>