<?php
include '../../koneksi.php';

$id_pertanyaan = $_POST['id'];
$id_judul = $_POST['judul'];

$query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
// $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id_judul' GROUP BY tb_pertanyaan.jenisKuisioner_id");
// $rows = mysqli_num_rows($query);


?>

<div class="row mx-3 my-3">
    <div class="col-md-12 fw-bold fs-3 text-center text-uppercase">Tabel Data Butir Pertanyaan</div>
</div>
<div class="mt-4 pb-4">
    <hr class="dropdown-divider" />
</div>
<div class="card mx-3">
    <table class="table table-striped table-hover table-bordered">
        <thead class="border border-black">
            <tr>
                <th>Responden</th>
                <th>X</th>
                <th>Y</th>
                <th>XY</th>
                <th>X<sup>2</sup></th>
                <th>Y<sup>2</sup></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_presepsi = 0;
            $total_nilaiY = 0;
            $total_nilaiXY = 0;
            $total_presepsi_kuadrat = 0;
            $total_nilaiY_kuadrat = 0;

            while ($fetch = mysqli_fetch_assoc($query_user)) {
                $id = $fetch['username'];
                $detail_function = detailUser($id);
                $nama_tabel = $detail_function['nama_tabel'];
                $nama = $detail_function['nama'];
                
                // mendapatkan nilai Y
                $detail_from_Y = totalY($nama_tabel);
                $nilaiY = $detail_from_Y['nilai_y'];
                $nilaiY_kuadrat = $detail_from_Y['nilaiY_kuadrat'];

                // mendapatkan nilai X
                $detail_from_X = presepsi_harapan($nama_tabel, $id_pertanyaan);
                $presepsi = $detail_from_X['presepsi'];

                $harapan = $detail_from_X['harapan'];
                $presepsi_kuadrat = $detail_from_X['presepsi_kuadrat'];
                $harapan_kuadrat = $detail_from_X['harapan_kuadrat'];

                // mendapatkan nilai XY
                $nilaiXY = $presepsi * $nilaiY;

                // Menambahkan nilai ke total
                $total_presepsi += $presepsi;
                $total_nilaiY += $nilaiY;
                $total_nilaiXY += $nilaiXY;
                $total_presepsi_kuadrat += $presepsi_kuadrat;
                $total_nilaiY_kuadrat += $nilaiY_kuadrat;


            ?>
            <tr>
                <td><?= $nama; ?></td>
                <td><?= $presepsi; ?></td>
                <td><?= $nilaiY; ?></td>
                <td><?= $nilaiXY; ?></td>
                <td><?= $presepsi_kuadrat; ?></td>
                <td><?= $nilaiY_kuadrat; ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td>TOTAL</td>
                <td><?= $total_presepsi; ?></td>
                <td><?= $total_nilaiY; ?></td>
                <td><?= $total_nilaiXY; ?></td>
                <td><?= $total_presepsi_kuadrat; ?></td>
                <td><?= $total_nilaiY_kuadrat; ?></td>
            </tr>

        </tbody>
    </table>
</div>


<script>
$(document).ready(function() {
    $('.open').on('click', function(e) {
        e.preventDefault();
        let data = $(this).attr('open-id');
        alert(data);
        $.post('pengolahan-data/detail-rhitung.php', {
            id: data,
        }, function(respon) {
            $('#table-data').html(respon);
        })
    })
})
</script>