<?php
include '../../koneksi.php';

$id_judul = $_POST['id'];

$query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id_judul' GROUP BY tb_pertanyaan.jenisKuisioner_id");
$rows = mysqli_num_rows($query);


?>

<div class="row mx-3 my-3">
    <div class="col-md-12 fw-bold fs-3 text-center text-uppercase">Validitas</div>
</div>
<div class="mt-4 pb-4">
    <hr class="dropdown-divider" />
</div>
<div class="card mx-3">
    <table class="table table-striped table-hover table-bordered">
        <thead class="border border-black">
            <tr>
                <th>Responden</th>
                <th>Attribut</th>
                <th>R<sub>hitung</sub></th>
                <th>R<sub>tabel</sub></th>
                <th>Status</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($rows > 0) {
                for ($i = 0; $i < $rows; $i++) {
                    $data = mysqli_fetch_assoc($query);
                    $jenis = $data['jenis_kuisioner'];
                    $id_jenis = $data['id_jenisKuisioner'];
                    $newQuery = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE judul_id = '$id_judul' AND jeniskuisioner_id = '$id_jenis' ORDER BY item_pertanyaan ASC");
            ?>
                    <tr>
                        <th class="text-center" colspan="6"><?= $jenis ?></td>
                    </tr>
                    <?php
                    $no = 1;
                    $x1 = [];
                    $x2 = [];
                    while ($pertanyaan = mysqli_fetch_assoc($newQuery)) {
                        $id_pertanyaan = $pertanyaan['id_pertanyaan'];
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><a href="#" class="open" open-id="<?= $id_pertanyaan; ?>" judul-id="<?= $id_judul; ?>">
                                    <?= $pertanyaan['item_pertanyaan']; ?></a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>

        </tbody>
    </table>
</div>


<script>
    $(document).ready(function() {
        $('.open').on('click', function(e) {
            e.preventDefault();
            let data = $(this).attr('open-id');
            let judul = $(this).attr('judul-id');
            // alert(data);
            $.post('pengolahan-data/detail-rhitung.php', {
                id: data,
                judul: judul,
            }, function(respon) {
                $('#table-data').html(respon);
            })
        })
    })
</script>