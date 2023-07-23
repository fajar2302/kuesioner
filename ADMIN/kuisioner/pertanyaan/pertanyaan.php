<?php
include '../../../koneksi.php';

$selectJenkus = mysqli_query($koneksi, "SELECT * FROM tb_jeniskuisioner");
$pertanyaan = "";
$jenkus = "";
$id_pertanyaan = "";
if (isset($_POST['edit'])) {
    $id_pertanyaan = $_POST['edit'];
    // $query = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_judul JOIN tb_pertanyaan ON tb_judul.id_judul = tb_pertanyaan.judul_id JOIN tb_jeniskuisioner ON tb_judul.id_judul = tb_jeniskuisioner.judul_id WHERE tb_pertanyaan.id_pertanyaan = '$id_pertanyaan'"));
    $query = mysqli_fetch_assoc((mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_judul ON tb_pertanyaan.judul_id = tb_judul.id_judul JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.id_pertanyaan = '$id_pertanyaan'")));
    $pertanyaan = $query['item_pertanyaan'];
    $jenkus = $query['jenis_kuisioner'];
    // $query = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `tb_judul` WHERE id_judul = '$data[judul_id]'"));
} else {
    $id = $_POST['id'];
    $query = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `tb_judul` WHERE id_judul = '$id'"));
}

?>

<div class="container">
    <div class="row mx-2">
        <div class="col-md-12 fw-bold fs-3 text-uppercase">pertanyaan</div>
    </div>
    <div class="mt-4">
        <hr class="dropdown-divider" />
    </div>
    <div class="text">
        <h4 class="text-center"><?= $query['judul']; ?></h4>
    </div>
    <br>
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body" id="load-form">
                    <form id="form-kuis">
                        <div class="mb-3">
                            <label for="exampleInputText2" class="form-label">Jenis Kuisioner</label>
                            <select class="form-select tetxt-uppercase jenkus" aria-label="Default select example" name="jenis_kuisioner">
                                <option value="">Pilih Jenis Kuisioner</option>
                                <?php
                                $status = "";
                                while ($jenkuis = mysqli_fetch_assoc($selectJenkus)) {
                                    if ($jenkuis['jenis_kuisioner'] == $jenkus) {
                                        $status = "selected";
                                    } else {
                                        $status = "";
                                    }
                                ?>
                                    <option class=" text text-uppercase" value="<?= $jenkuis['id_jenisKuisioner'] ?>" <?= $status ?>>
                                        <?= $jenkuis['jenis_kuisioner']; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                        <input type="hidden" class="form-control id" name="judul-id" value="<?= $query['id_judul']; ?>">
                        <input type="hidden" class="form-control id" name="id_pertanyaan" value="<?= $id_pertanyaan; ?>">
                        <div class="mb-3" id="pertanyaan2">
                            <label for="exampleInputText3" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="<?= $pertanyaan ?>">
                        </div>
                        <div class="d-grid col-6 mx-auto">
                            <button class="btn" type="submit" name="simpan2">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-7">
            <div class="card mx-3" width="400px">
                <div class="card-body" id="load-tabel">

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        load_pertanyaan();

        function load_pertanyaan() {
            // load tabel pertanyaan
            let id = $('.id').val();
            $.post('kuisioner/pertanyaan/tabel-pertanyaan.php', {
                id: id
            }, function(respon) {
                $('#load-tabel').html(respon);
            })
        }

        // submit form
        $('#form-kuis').submit(function(e) {
            e.preventDefault();
            let jenkus = $('.jenkus').val();
            let pertanyaan = $('#pertanyaan').val();

            if (jenkus != "" && pertanyaan != "") {
                let data = $(this).serialize();
                // alert(data);
                $.post('kuisioner/pertanyaan/fungsi.php', 'simpan2&' + data, function(respon) {
                    var pecah = respon.split('|');
                    Swal.fire({
                        position: 'center',
                        icon: pecah[0],
                        title: pecah[1],
                        showConfirmButton: false,
                        timer: 1500
                    });
                    load_pertanyaan();
                    $('#pertanyaan').val("");
                    $('.jenkus').val("");
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