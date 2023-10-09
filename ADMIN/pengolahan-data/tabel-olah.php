<?php
include '../../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM tb_judul");

if (mysqli_num_rows($query) > 0) {

?>
    <section class="olah-data">
        <div class="row mx-3 my-3">
            <div class="col-md-12 fw-bold fs-3 text-uppercase">Pengolahan Data</div>
        </div>
        <div class="mt-4 pb-4">
            <hr class="dropdown-divider" />
        </div>
        <div id="table-data">
            <div class="card m-3">
                <div class="card-body">
                    <table class="table table-bordered">

                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul Kuisioner</th>
                                <th scope="col" class="text-center">Opsi</th>
                                <!-- <th scope="col">Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jumlah = 1;
                            while ($query_kuisioner = mysqli_fetch_assoc($query)) {
                                if ($query_kuisioner['status'] == 'true') {
                            ?>
                                    <tr>
                                        <td><?= $jumlah++; ?></td>
                                        <td><?= $query_kuisioner['judul']; ?></td>
                                        <td class="text-center">
                                            <a href="#" class="open" open-id="<?= $query_kuisioner['id_judul']; ?>">
                                                <button class="btn btn-success">
                                                    <i class="bi bi-arrow-up-right-square"></i>
                                                </button>
                                            </a>
                                            <a href="#" class="delete" delete-id="<?= $query_kuisioner['id_judul']; ?>">
                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

<?php
} else {
?>
    <h4 class="text-center text-uppercase">DATA KOSONG</h4>

<?php
}
?>

<script>
    $(document).ready(function() {
        $('.open').on('click', function(e) {
            e.preventDefault();
            let data = $(this).attr('open-id');
            // alert(data);
            $.post('pengolahan-data/tabel-hasil.php', {
                id: data,
            }, function(respon) {
                $('#table-data').html(respon);
            })
        })
    })
</script>