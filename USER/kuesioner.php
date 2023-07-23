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
                                    $newQuery = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id' AND jeniskuisioner_id = '$id_jenis'");
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
                                <td><?= $no; ?></td>
                                <td class="kuis"><?= $newRows['item_pertanyaan'] ?></td>
                                <td>
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="pertanyaanA<?= $input; ?>" id="pilihan" value="1">
                                </td>
                                <td>
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="pertanyaanA<?= $input; ?>" id="pilihan" value="2">
                                </td>
                                <td>
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="pertanyaanA<?= $input; ?>" id="pilihan" value="3">
                                </td>
                                <td>
                                    <input class="form-check-input presepsi border border-secondary" type="radio"
                                        name="pertanyaanA<?= $input; ?>" id="pilihan" value="4">
                                </td>
                                <td>
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="pertanyaanB<?= $input; ?>" id="pilihan" value="1">
                                </td>
                                <td>
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="pertanyaanB<?= $input; ?>" id="pilihan" value="2">
                                </td>
                                <td>
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="pertanyaanB<?= $input; ?>" id="pilihan" value="3">
                                </td>
                                <td>
                                    <input class="form-check-input border border-secondary" type="radio"
                                        name="pertanyaanB<?= $input; ?>" id="pilihan" value="4">
                                </td>
                                <td>
                                    <a href="#" class="save"
                                        save-id=<?= $id_jenis . "|" . $id_judul . "|" . $newRows['id_pertanyaan'] ?>
                                        data-row=<?= $input; ?>>SIMPAN</a>
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
    });

    $('.save').on('click', function(e) {
        let attribut = $(this).attr('save-id');
        let row = $(this).attr('data-row');
        let pisah = attribut.split("|");

        // mengambil value presepsi
        let selectedValueA = $('input[name="pertanyaanA' + row + '"]:checked').val();
        // mengambil value harapan
        let selectedValueB = $('input[name="pertanyaanB' + row + '"]:checked').val();

        if (selectedValueA == 'undifined' || selectedValueB == 'undifined') {
            alert("pilih dulu Gaes");
        } else {
            $.post('USER/tambah.php', {
                jenis_id: pisah[0],
                judul_id: pisah[1],
                pertanyaan_id: pisah[2],
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
            })
        }
    })


})
</script>