<?php
include '../koneksi.php';
$id = $_POST['id'];
// $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id'"));

?>

<!-- Modals -->
<form id="form-data">
    <div class="mb-3">
        <label for="exampleInputText1" class="form-label">Nama</label>
        <input type="text" class="form-control nama" id="exampleInputText1" name="nama"
            placeholder="Example: Fajar Febriansyah">
    </div>
    <div class="mb-3">
        <label for="exampleInputText2" class="form-label">Umur</label>
        <input type="text" class="form-control umur" id="exampleInputText2" name="umur" placeholder="Example: 21 Tahun">
        <input type="hidden" name="judul_id" value="<?= $id; ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputText3" class="form-label">Jenis Kelamin</label>
        <select class="form-select jenkel" aria-label="Default select example" name="jenkel">
            <option value="">-select option-</option>
            <option value="laki-laki">Laki-Laki</option>
            <option value="perempuan">Perempuan</option>
        </select>
    </div>
    <div class="d-grid col-6 mx-auto">
        <button class="btn" type="submit" name="simpan">SIMPAN</button>
    </div>
</form>

<script>
$(document).ready(function() {

    // FUNGSI KETIKA MEMASUKKAN DATA
    $('#form-data').submit(function(e) {
        e.preventDefault();

        let nama = $('#exampleInputText1').val();
        let umur = $('#exampleInputText2').val();
        let jenkel = $('.form-select').val();
        if (nama != "" && umur != "" && jenkel != "") {
            let data = $(this).serialize();
            // alert(data)
            $.post('USER/proses-tes.php', 'simpan=&' + data, function(respon) {
                var pecah = respon.split('|');
                Swal.fire({
                    position: 'center',
                    icon: pecah[0],
                    title: pecah[1],
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalShow').modal('hide');
                if (pecah[0] == "success") {
                    let id_judul = pecah[2];
                    let id_respon = pecah[3];
                    let tabel = pecah[4];
                    $.post(
                        'USER/kuesioner.php', {
                            id: id_judul,
                            id_respon: id_respon,
                            tabel: tabel,
                        },
                        function(respon) {
                            $('#main-page').html(respon);
                        }
                    );
                }
            })

        } else {

            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Silahkan Lengkapi Form',
                showConfirmButton: false,
                timer: 1500
            })
            $('.nama').addClass('border border-danger ');
            $('.umur').addClass('border border-danger ');
            $('.jenkel').addClass('border border-danger');
        }

    })
})
</script>