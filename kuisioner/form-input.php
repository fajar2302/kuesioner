<!-- Modal -->

<form id="form-data">
    <div class="mb-3">
        <label for="exampleInputText1" class="form-label">Judul</label>
        <input type="text" class="form-control name" id="exampleInputText1" name="judul">
    </div>
    <div class="mb-3">
        <label for="exampleInputText2" class="form-label">Lokasi</label>
        <input type="text" class="form-control lokasi" id="exampleInputText2" name="lokasi">
        <input type="hidden" class="status" id="exampleInputText2" name="status" value="tidakAktif">
    </div>
    <div class="mb-3">
        <label for="exampleInputText3" class="form-label">Tahun</label>
        <select class="form-select" aria-label="Default select example" name="tahun">
            <option value="">-select option-</option>
            <?php
            $tahun = date('Y');
            for ($i = 0; $i < 10; $i++) {
            ?>
                <option value="<?= $tahun - $i; ?>"><?= $tahun - $i; ?></option>
            <?php
            }
            ?>
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

            let judul = $('#exampleInputText1').val();
            let lokasi = $('#exampleInputText2').val();
            let select = $('.form-select').val();
            if (judul != "" && lokasi != "" && select != "") {
                let data = $(this).serialize();
                $.post('kuisioner/proses-input.php', 'simpan=&' + data, function(respon) {
                    var pecah = respon.split('|');

                    if (pecah[0] == "success") {
                        $('#modalTittle').html(pecah[1] + '-' + pecah[2]);
                        $('.btn-close').remove();
                        let id = pecah[1];
                        $.post(
                            'kuisioner/form-2.php', {
                                id: id,
                                data: data,
                            },
                            function(respon) {
                                $('#bdModalKuisioner').html(respon);
                                $('#headerModal').removeClass();
                                $('#headerModal').addClass('modal-header bg-custom text-white')
                            }
                        );
                    }
                })

            } else {

                Swal.fire({
                    position: 'top',
                    icon: 'error',
                    text: 'Silahkan Lengkapi Form',
                });
                $('.name').addClass('border border-danger ');
                $('.lokasi').addClass('border border-danger ');
                $('.form-select').addClass('border border-danger');
            }

        })
    })
</script>