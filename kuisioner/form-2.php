<?php
include '../koneksi.php';
$id = $_POST['id'];
$data = $_POST['data'];
$pisah = explode("|", $data);
$tang = $pisah[0];
$rel = $pisah[1];
$res = $pisah[2];
$ass = $pisah[3];
$emp = $pisah[4];

?>

<form id="form-data">
    <div class="mb-3">
        <label for="exampleInputText2" class="form-label">Jenis Kuisioner</label>
        <select class="form-select" aria-label="Default select example" name="jenis_kuisioner">
            <option value="">Select Option</option>
            <?php

            if ($tang == " ") {
                echo "<option value='reability'>Reability (Kehandalan)</option>";
                echo "<option value='responsiveness'>Responsiveness (Daya Tanggap)</option>";
                echo "<option value='assurance'>Assurance (Jaminan)</option>";
                echo "<option value='emphaty'>Emphaty (Perhatian)</option>";
            } else if ($rel == " ") {
                echo "<option value='tangibles'>Tangibles (Bukti Fisik)</option>";
                echo "<option value='responsiveness'>Responsiveness (Daya Tanggap)</option>";
                echo "<option value='assurance'>Assurance (Jaminan)</option>";
                echo "<option value='emphaty'>Emphaty (Perhatian)</option>";
            } else if ($res == " ") {
                echo "<option value='tangibles'>Tangibles (Bukti Fisik)</option>";
                echo "<option value='reability'>Reability (Kehandalan)</option>";
                echo "<option value='assurance'>Assurance (Jaminan)</option>";
                echo "<option value='emphaty'>Emphaty (Perhatian)</option>";
            } else if ($ass == " ") {
                echo "<option value='tangibles'>Tangibles (Bukti Fisik)</option>";
                echo "<option value='reability'>Reability (Kehandalan)</option>";
                echo "<option value='responsiveness'>Responsiveness (Daya Tanggap)</option>";
                echo "<option value='emphaty'>Emphaty (Perhatian)</option>";
            } else if ($emp == " ") {
                echo "<option value='tangibles'>Tangibles (Bukti Fisik)</option>";
                echo "<option value='reability'>Reability (Kehandalan)</option>";
                echo "<option value='responsiveness'>Responsiveness (Daya Tanggap)</option>";
                echo "<option value='assurance'>Assurance (Jaminan)</option>";
            } else {
                echo "<option value='tangibles'>Tangibles (Bukti Fisik)</option>";
                echo "<option value='reability'>Reability (Kehandalan)</option>";
                echo "<option value='responsiveness'>Responsiveness (Daya Tanggap)</option>";
                echo "<option value='assurance'>Assurance (Jaminan)</option>";
                echo "<option value='emphaty'>Emphaty (Perhatian)</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputText3" class="form-label">Item Pertanyaan</label>
        <input type="hidden" class="form-control" name="id-kuisioner" value="<?= $id; ?>">
        <input type="number" class="form-control jmlh" id="exampleInputText3" name="jmlh_pertanyaan">
    </div>
    <div class="mb-1 mt-4" id="labelPlace"></div>
    <div class="mb-3" id="inputPlace">
    </div>
    <div class="d-grid gap-2 col-5 mx-auto d-md-block">
        <button class="btn" id="submitForm" type="submit" disabled name="simpan2">SIMPAN</button>
        <button class="btn" id="addForm" type="button">LANJUT</button>
    </div>
</form>

<script>
$(document).ready(function() {
    //aksi ketika tombol lanjut di klik

    $('#addForm').click(function() {
        let inputCount = parseInt($('.jmlh').val());
        let inputKuisType = $('.form-select').val();
        let inputForm = '';
        let label = '';
        if (inputCount > 0 && inputKuisType != "") {
            for (let i = 0; i < inputCount; i++) {
                inputForm += ` 
                    <label for="exampleInputText" class="form-label ">Pertanyaan ${i+1}</label>

                          <input type="text" class="form-control kuis" id="exampleInputText" name="item_pertanyaan${i}"><br>
                        `;
            }
            $('.form-select').attr('disabled', 'disabled');
            $('#labelPlace').html(label);
            $('#inputPlace').html(inputForm);
            $('#submitForm').prop('disabled', false);
            // $(this).prop('disabled', true);
        } else {
            Swal.fire({
                position: 'top',
                icon: 'error',
                text: 'Silahkan Lengkapi Form',
            });
            $('.jmlh').addClass('border border-danger ');
            $('.form-select').addClass('border border-danger');
        }

    })

    // aksi ketika tombol simpan di klik
    $('#form-data').submit(function(e) {
        e.preventDefault();
        let jumlah_pertanyaan = $('.jmlh').val();
        let kuis = $('.kuis').val();
        let jenis_kuisioner = $('.form-select').val();
        if (jumlah_pertanyaan != "" && jenis_kuisioner != "" && kuis != "") {
            let data = new Data($(this)[0]);
            data.append('tipeAksi', 'add');
            // let data = $(this).serialize();
            alert(data)
            $.ajax({
                url: 'kuisioner/proses-input.php',
                type: 'POST',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(datat) {
                    alert(datat);
                    // if (datat.trim() === 'ok') {
                    //     Swal.fire({
                    //         position: 'top',
                    //         icon: 'success',
                    //         title: 'Tersimpan',
                    //         text: 'Data berhasil disimpan'
                    //     }).then((result) => {
                    x
                    //         $.post('fdDosen/dsnTabel.php', {
                    //             page: kd_hal
                    //         }, function(data) {
                    //             $('#bdModalKuisioner').html(respon);
                    //             $('#headerModal').removeClass();
                    //             $('#headerModal').addClass(
                    //                 'modal-header bg-custom text-white')
                    //         });
                    //     })
                    // }
                }
            })
            // $.post('kuisioner/proses-input.php', {
            //     data: data,
            // }, function(respon) {
            //     alert(respon);
            //     // var pecah = respon.split('|');

            //     // if (pecah[0] == "success") {
            //     //     $('#modalTittle').html(pecah[1] + '-' + pecah[2]);
            //     //     $('.btn-close').remove();
            //     //     let id = pecah[1];
            //     //     $.post(
            //     //         'kuisioner/form-3.php', {
            //     //             id: id,
            //     //         },
            //     //         function(respon) {
            //     //             $('#bdModalKuisioner').html(respon);
            //     //             $('#headerModal').removeClass();
            //     //             $('#headerModal').addClass('modal-header bg-custom text-white')
            //     //         }
            //     //     );
            //     // }
            // })
        } else {
            Swal.fire({
                position: 'top',
                icon: 'error',
                text: 'Silahkan Lengkapi Form',
            });
            $('.jmlh').addClass('border border-danger ');
            $('kuis').addClass('border border-danger ');
            $('.form-select').addClass('border border-danger');
        }
    })

})
</script>