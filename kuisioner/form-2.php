<?php
include '../koneksi.php';
$id = $_POST['id'];
$pisah = array('tangible', 'reability', 'responsiveness', 'assurance', 'emphaty');

?>

<form id="form-data">
    <div class="mb-3">
        <label for="exampleInputText2" class="form-label">Jenis Kuisioner</label>
        <select class="form-select jenkus" aria-label="Default select example" name="jenis_kuisioner">
            <option value="">Pilih Jenis Kuisioner</option>
            <?php
            for ($i = 0; $i < count($pisah); $i++) {
                $cari_jenis = $pisah[$i];
                if (mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `tb_jeniskuisioner` WHERE kuisioner_id = '$id' AND jenis_kuisoner = '$cari_jenis' ")) < 1) {
                    $status = '';
                } else {
                    $status = 'disabled';
                }
            ?>
            <option value="" <?= $status ?>><?= $cari_jenis ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <input type="hidden" class="form-control id" name="kuisioner-id" value="<?= $id; ?>">
    <div class="mb-3">
        <label for="exampleInputText3" class="form-label">Item Pertanyaan</label>
        <input type="number" class="form-control jmlh" id="exampleInputText3" name="jmlh_pertanyaan">
    </div>

    <div class="d-grid col-6 mx-auto">
        <button class="btn" type="submit" name="simpan2">SIMPAN</button>
    </div>
</form>

<script>
$(document).ready(function() {
    $('#form-data').submit(function(e) {

        e.preventDefault();
        let jenkus = $('.jenkus').val();
        let jumper = $('#exampleInputText3').val();
        let id = $('.id').val();

        if (jenkus > '0' && jumper != "") {
            let data = $(this).serialize();
            alert(data);
            $.post('kuisioner/proses-input.php', 'simpan2=&' + data, function(respon) {
                var pecah = respon.split('|');
                $('#menu-kuisioner').load('form-2.php');
                // $('#tabel-data').load('tabel.php');
                Swal.fire({
                    icon: pecah[0],
                    title: pecah[2],
                    text: pecah[1],
                    footer: 'File Latihan'
                })

            })
        }
    })

});
</script>