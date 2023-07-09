<?php
include '../../koneksi.php';

$id = $_POST['id'];
$pisah = array('TANGIBLE', 'RELIABILITY', 'RESPONSIVENESS', 'ASSURANCE', 'EMPHATY');
$query = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `tb_kuisioner` WHERE id_kuisioner = '$id'"));

?>

<div class="container">
    <div class="row mx-2">
        <div class="col-md-12 fw-bold fs-3 text-uppercase">pertanyaan</div>
    </div>
    <div class="mt-4">
        <hr class="dropdown-divider" />
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form id="form-kuis">
                        <div class="mb-3">
                            <label for="exampleInputText2" class="form-label">Jenis Kuisioner</label>
                            <select class="form-select tetxt-uppercase jenkus" aria-label="Default select example" name="jenis_kuisioner">
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
                                    <option class=" text text-uppercase" value="<?= $cari_jenis ?>" <?= $status ?>>
                                        <?= $cari_jenis ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" class="form-control id" name="kuisioner-id" value="<?= $id; ?>">
                        <!-- <div class="mb-3">
                            <label for="exampleInputText3" class="form-label">Jumlah Pertanyaan</label>
                            <div class="d-flex">

                                <input type="number" class="form-control" id="jumper" name="jmlh_pertanyaan">
                                <button id="create" class="btn text-center" name="simpan2">Go</button>
                            </div>
                        </div> -->
                        <div class="mb-3" id="pertanyaan2">
                            <label for="exampleInputText3" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan">
                        </div>
                        <div class="d-grid col-6 mx-auto">
                            <button class="btn" type="submit" name="simpan2">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-6">
            <div class="card mx-3" width="400px">
                <div class="card-body" id="load-pertanyaan">

                </div>
            </div>
            <div class="card mx-3 my-5" width="400px">
                <div class="card-body" id="load-jenkus">

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        // load tabel pertanyaan
        $('#load-pertanyaan').load('kuisioner/pertanyaan/tabel-pertanyaan.php');
        $('#load-jenkus').load('kuisioner/pertanyaan/tabel-jenkus.php');

        // mengambil jumlah pertanyaan
        $('#create').on('click', function(e) {
            e.preventDefault();
            let jenkus = parseInt($('.jenkus').val());
            $('#submitForm').prop('disabled', false);
            let jumper = $('#jumper').val();
            let inputForm = '';

            if (jumper > 0 && jenkus != '') {
                for (let i = 0; i < jenkus; i++) {
                    inputForm += ` 
                <label for="exampleInputText" class="form-label ">Pertanyaan ${i + 1}</label>

                      <input type="text" class="form-control kuis" id="exampleInputText" name="item_pertanyaan${i}"><br>
                    `;
                }
                $('#save').prop('disabled', false);
                $('#pertanyaan').html(inputForm);
                $('#menu-kuisioner').load('kuisioner/pertanyaan/pertanyaan.php');
            } else {
                alert("ISI FORM TERLEBIH DAHULU");
            }

        });



        // fungsi submit form
        $('#form-kuis').submit(function(e) {
            e.preventDefault();
            let jenkus = $('.jenkus').val();
            let pertanyaan = $('#pertanyaan').val();

            if (jenkus != "" && pertanyaan != "") {
                let data = $(this).serialize();
                alert(data);
                $.post('kuisioner/pertanyaan/fungsi.php', 'simpan2&' + data, function(respon) {
                    var pecah = respon.split('|');
                    $('#load-pertanyaan').load('kuisioner/pertanyaan/tabel-pertanyaan.php');
                    $('#load-jenkus').load('kuisioner/pertanyaan/tabel-jenkus.php');
                    Swal.fire({
                        position: 'top',
                        icon: pecah[0],
                        text: pecah[1],
                    });
                })

            } else {
                Swal.fire({
                    position: 'top',
                    icon: 'error',
                    text: 'Silahkan Lengkapi Form',
                });
            }
        })


    })
</script>