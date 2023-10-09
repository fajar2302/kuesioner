<?php
session_start();
require '../koneksi.php';


$id = $_SESSION['id']; // id akun
$id_judul = $_POST['id_judul'];
$tabel = $_POST['tabel'];
$query = mysqli_query($koneksi, "SELECT * FROM $tabel ");


// $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan JOIN tb_judul ON tb_pertanyaan.judul_id = tb_judul.id_judul JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisjudul_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id'");
$query2 = mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id_judul'");
$join = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id_judul' GROUP BY tb_pertanyaan.jenisKuisioner_id");
if (mysqli_num_rows($query2) > 0) {
    $ambil = mysqli_fetch_assoc($query2);
    $no = 1;
}
?>
<section id="kuesioner" class="my-4 py-4">
    <div class="container my-5">
        <div class="section-title">
            <h4 class="text-center text-uppercase"><?= $ambil['judul']; ?></h4>
            <p class="text-center text-uppercase"><?= $ambil['lokasi']; ?>, <?= $ambil['tahun']; ?></p>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <form id="form-data">

                    <table class="table table-bordered">

                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" scope="col" rowspan="2">
                                    <p>NO.</p>
                                </th>
                                <th class="text-center" scope="col" rowspan="2">
                                    <p>Pertanyaan</p>
                                </th>
                                <th class="text-center" scope="col" rowspan="1" colspan="4">Presepsi</th>
                                <th class="text-center" scope="col" rowspan="1" colspan="4">Harapan</th>
                                <th class="text-center" scope="col" rowspan="2">
                                    <p>Opsi</p>
                                </th>
                            </tr>
                            <tr class="">
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $input = 0;
                            $class = 1;
                            $rows = mysqli_num_rows($join);
                            if ($rows > 0) {
                                for ($i = 0; $i < $rows; $i++) {
                                    $data = mysqli_fetch_assoc($join);
                                    $jenis = $data['jenis_kuisioner'];
                                    $id_jenis = $data['id_jenisKuisioner'];
                                    $id_judul = $data['judul_id'];
                                    $newQuery = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' AND jeniskuisioner_id = '$id_jenis' ORDER BY item_pertanyaan ASC");
                                    $totRows = mysqli_num_rows($newQuery);
                                    $no++;

                            ?>

                                    <tr>
                                        <td colspan="11"> <?= $jenis; ?></td>
                                        <input type="hidden" name="id-jenis" value="<?= $id_jenis; ?>">
                                        <input type="hidden" name="id-judul" value="<?= $id_judul; ?>">
                                        <?php $no--; ?>
                                    </tr>

                                    <?php
                                    while ($newRows = mysqli_fetch_assoc($newQuery)) {
                                    ?>
                                        <tr class="radio-button">
                                            <td class="text-center"><?= $no; ?></td>
                                            <td class="kuis"><?= $newRows['item_pertanyaan'] ?></td>
                                            <td class="text-center">
                                                <input class="form-check-input presepsi border border-secondary" type="radio" name="pertanyaanA<?= $input; ?>" id="pilihan" value="1">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input presepsi border border-secondary" type="radio" name="pertanyaanA<?= $input; ?>" id="pilihan" value="2">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input presepsi border border-secondary" type="radio" name="pertanyaanA<?= $input; ?>" id="pilihan" value="3">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input presepsi border border-secondary" type="radio" name="pertanyaanA<?= $input; ?>" id="pilihan" value="4">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input border border-secondary" type="radio" name="pertanyaanB<?= $input; ?>" id="pilihan" value="1">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input border border-secondary" type="radio" name="pertanyaanB<?= $input; ?>" id="pilihan" value="2">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input border border-secondary" type="radio" name="pertanyaanB<?= $input; ?>" id="pilihan" value="3">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-check-input border border-secondary" type="radio" name="pertanyaanB<?= $input; ?>" id="pilihan" value="4">
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary save save<?= $input; ?>" save-id=<?= $id_jenis . "|" . $id_judul . "|" . $newRows['id_pertanyaan'] . "|" . $id . "|" . $tabel ?> data-row=<?= $input; ?>>SIMPAN</a>
                                                <a href="#" class="btn btn-primary edit edit<?= $input; ?> disabled" data-row=<?= $input; ?>>EDIT</a>
                                            </td>
                                        </tr>

                            <?php
                                        $class++;
                                        $input++;
                                        $no++;
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn bg-custom text-white" type="submit">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</section>


<script>
    $(document).ready(function() {


        $('#form-data').submit(function(e) {
            e.preventDefault();

            let data = $(this).serialize();
            let form = $('.form-check-input').val();
            // var hitung = $('input:checked').length;
            var total = 0;
            $(".pertanyaanA:checked").each(function() {
                total += parseFloat($(this).val());
            });
            if (total == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: 'Silahkan Lengkapi Pengisian Kuesioner',
                    showConfirmButton: false,
                    // timer: 1500
                })
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: total,
                    showConfirmButton: false,
                    // timer: 1500
                })
                $('#main-page').load('index.php');
            }
        });

        $('.save').on('click', function(e) {
            e.preventDefault();
            let attribut = $(this).attr('save-id');
            let row = $(this).attr('data-row');
            let pisah = attribut.split("|");
            // let buttonRow = $('.save').val();
            let gabung = '.save' + row;
            let gabungEdit = '.edit' + row;
            // let gabung = buttonRow + row;
            // alert(gabung);

            // mengambil value presepsi
            let selectedValueA = $('input[name="pertanyaanA' + row + '"]:checked').val();
            let disabledVal = $('input[name="pertanyaanA' + row + '"]');
            // mengambil value harapan
            let selectedValueB = $('input[name="pertanyaanB' + row + '"]:checked').val();
            let disabledVal2 = $('input[name="pertanyaanB' + row + '"]');

            if (selectedValueA == undefined || selectedValueB == undefined) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: 'Lengkapi Isian Kuesioner Terlebih Dahulu',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                let data = {

                }
                $.post('proses-tes2.php', {
                    jenis_id: pisah[0],
                    judul_id: pisah[1],
                    pertanyaan_id: pisah[2],
                    id: pisah[3],
                    tabel: pisah[4],
                    presepsi: selectedValueA,
                    harapan: selectedValueB,
                }, function(respon) {
                    let pecah = respon.split("|");
                    Swal.fire({
                        position: 'center',
                        icon: pecah[0],
                        title: pecah[1],
                        showConfirmButton: false,
                        timer: 1500
                    })
                    disabledVal.prop('disabled', true);
                    disabledVal2.prop('disabled', true);
                    $(gabung).addClass('disabled');
                    $(gabungEdit).removeClass('disabled');
                })
            }
        })
        $('.edit').on('click', function(e) {
            e.preventDefault();
            let row = $(this).attr('data-row');
            let gabung = '.save' + row;
            let gabungEdit = '.edit' + row;
            let disabledVal = $('input[name="pertanyaanA' + row + '"]');
            let disabledVal2 = $('input[name="pertanyaanB' + row + '"]');

            disabledVal.prop('disabled', false);
            disabledVal2.prop('disabled', false);
            $(gabungEdit).addClass('disabled');
            $(gabung).removeClass('disabled');
        })


    })
</script>