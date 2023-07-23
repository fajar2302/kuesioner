<?php
require '../koneksi.php';


$id = $_POST['id'];
// $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan JOIN tb_judul ON tb_pertanyaan.judul_id = tb_judul.id_judul JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisjudul_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id'");
$query = mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id'");
$join = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id' GROUP BY tb_pertanyaan.jenisKuisioner_id");
if (mysqli_num_rows($query) > 0) {
    $ambil = mysqli_fetch_assoc($query);
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
                            $rows = mysqli_num_rows($join);
                            if ($rows > 0) {
                                for ($i = 0; $i < $rows; $i++) {
                                    $data = mysqli_fetch_assoc($join);
                                    $jenis = $data['jenis_kuisioner'];
                                    $id_jenis = $data['id_jenisKuisioner'];
                                    $newQuery = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id' AND jeniskuisioner_id = '$id_jenis'");
                                    $totRows = mysqli_num_rows($newQuery);
                                    $no++;
                            ?>

                            <tr>
                                <td colspan="10"> <?= $jenis; ?></td>
                                <input type="hidden" name="jenis-kuisioner" value="<?= $jenis; ?>">
                                <?php $no--; ?>
                            </tr>

                            <?php
                                    while ($newRows = mysqli_fetch_assoc($newQuery)) {
                                    ?>
                            <tr class="radio-button">
                                <td><?= $no; ?></td>
                                <td class="kuis"><?= $newRows['item_pertanyaan'] ?></td>
                                <td>
                                    <input class="form-check-input" type="radio" name="pertanyaanA<?= $input; ?>"
                                        id="pilihan" value="1">
                                </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="pertanyaanA<?= $input; ?>"
                                        id="pilihan" value="2">
                                </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="pertanyaanA<?= $input; ?>"
                                        id="pilihan" value="3">
                                </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="pertanyaanA<?= $input; ?>"
                                        id="pilihan" value="4">
                                </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="pertanyaanB<?= $input; ?>"
                                        id="pilihan" value="1">
                                </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="pertanyaanB<?= $input; ?>"
                                        id="pilihan" value="2">
                                </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="pertanyaanB<?= $input; ?>"
                                        id="pilihan" value="3">
                                </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="pertanyaanB<?= $input; ?>"
                                        id="pilihan" value="4">
                                </td>
                            </tr>

                            <?php
                                        $input++;
                                        $no++;
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-success" type="submit">SUBMIT</button>
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
        var hitung = $('input:checked').length;
        if (hitung == 0) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Silahkan Lengkapi Pengisian Kuesioner',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            alert(data);
        }
    })


})
</script>