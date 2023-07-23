<?php
include '../../../koneksi.php';
$id = $_POST['id'];
// $result = mysqli_query($koneksi, "SELECT * FROM `tb_pertanyaan` INNER JOIN `tb_jeniskuisioner` ON tb_pertanyaan.judul_id = tb_jeniskuisioner.judul_id WHERE tb_pertanyaan.judul_id = '$id'");
$result = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan INNER JOIN tb_jenisKuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id' GROUP BY tb_pertanyaan.jenisKuisioner_id");
$jumlah_tabel = mysqli_num_rows($result);
if ($jumlah_tabel > 0) {
    for ($i = 0; $i < $jumlah_tabel; $i++) {
        $data = mysqli_fetch_assoc($result);
        $jenis_quisioner = $data['jenis_kuisioner'];
        $id_quisioner = $data['id_jenisKuisioner'];
        $result2 = mysqli_query($koneksi, "SELECT * FROM `tb_pertanyaan` WHERE judul_id = '$id' AND jenisKuisioner_id = '$id_quisioner'");
?>
        <table class="table table-bordered">

            <thead class="table-dark">
                <tr>
                    <th scope="col" colspan="3" class="text-center"><?= $jenis_quisioner; ?></th>
                </tr>
            </thead>
            <tr>
                <th>#</th>
                <th>Pertanyaan</th>
                <th>Opsi</th>
            </tr>
            <tbody>
                <?php
                $jumlah = 1;
                while ($query_pertanyaan = mysqli_fetch_assoc($result2)) {
                    echo "<td>" . $jumlah++ . "</td>";
                    echo "<td>" . $query_pertanyaan['item_pertanyaan'] . "</td>";
                    echo "<td><a class='edit' edit-id='$query_pertanyaan[id_pertanyaan]' href='#' role='button'><i class='bi bi-pencil-square'></i></a> | <a class='hapus' hapus-id='$query_pertanyaan[id_pertanyaan]' href='#'><i class='bi bi-trash'></a></td></tr>";
                }
                ?>

            </tbody>
        </table>
<?php
    }
} else {
    echo "<h4 class='text-center'>DATA KOSONG</h4>";
}

?>


<script>
    $(document).ready(function() {
        function load_pertanyaan() {
            // load tabel pertanyaan
            let id = $('.id').val();
            $.post('kuisioner/pertanyaan/tabel-pertanyaan.php', {
                id: id
            }, function(respon) {
                $('#load-tabel').html(respon);
            })
        }


        // fungsi ketika klik hapus
        $('.hapus').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('hapus-id');
            // alert(id)
            $.post('kuisioner/pertanyaan/fungsi.php', 'hapus=' + id, function(respon) {
                var pecah = respon.split('|');
                Swal.fire({
                    position: 'center',
                    icon: pecah[0],
                    title: pecah[1],
                    showConfirmButton: false,
                    timer: 1500
                });
                load_pertanyaan();
            })
        })

        // fungsi ketika klik edit
        $('.edit').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('edit-id');
            $.post('kuisioner/pertanyaan/pertanyaan.php', 'edit=' + id, function(respon) {
                $('#menu-kuisioner').html(respon);
                console.log(respon);
            })
        });
    })
</script>