<?php
include '../../koneksi.php';
$id = $_POST['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id'"));

?>

<form id="form-data">
    <div class="mb-3">
        <label for="exampleInputText1" class="form-label">Judul</label>
        <input type="text" class="form-control" id="exampleInputText1" name="judul" value="<?= $data['judul'] ?>">
        <input type="hidden" class="form-control" id="exampleInputText1" name="id" value="<?= $data['id_judul'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputText2" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="exampleInputText2" name="lokasi" value="<?= $data['lokasi'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputText3" class="form-label">Tahun</label>
        <select class="form-select" aria-label="Default select example" name="tahun">
            <?php
            $tahun = date('Y');
            for ($i = 0; $i < 10; $i++) {
                if ($data['tahun'] == $tahun - $i) {
                    $attribut = 'selected';
                } else {
                    $attribut = '';
                }
            ?>
                <option value="<?= $tahun - $i; ?>" <?= $attribut; ?>><?= $tahun - $i; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="d-grid col-6 mx-auto">
        <button class="btn" type="submit" name="ubah">SIMPAN</button>
    </div>

    <script>
        $(document).ready(function() {

            // fungsi ketika update data
            $('#form-data').submit(function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                $.post('kuisioner/proses-input.php', 'ubah=true&' + data, function(respon) {
                    $('#modalShow').modal('hide');
                    var pecah = respon.split('|');
                    Swal.fire({
                        position: 'center',
                        icon: pecah[0],
                        title: pecah[1],
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#menu-kuisioner').load('kuisioner/index.php');
                })
            })
        })
    </script>