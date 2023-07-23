<?php
include '../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM `tb_judul`");
$jumlah_baris = mysqli_num_rows($result);


if ($jumlah_baris > 0) {
    for ($i = 0; $i < $jumlah_baris; $i++) {
        $query = mysqli_fetch_assoc($result);
        $status = $query['status'];
        if ($status == 'true') {
            $result2 = mysqli_query($koneksi, "SELECT * FROM `tb_judul`");
?>

<table class="table table-bordered">

    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul Kuisioner</th>
            <th scope="col">Tahun</th>
            <th scope="col">Lokasi</th>
            <!-- <th scope="col">Opsi</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
                    $jumlah = 1;
                    while ($query_kuisioner = mysqli_fetch_assoc($result2)) {
                    ?>
        <tr>
            <td><?= $jumlah++; ?></td>
            <td><a class="open text-decoration-none text-black" open-id=<?= $query_kuisioner['id_judul'] ?>
                    href="#"><?= $query_kuisioner['judul']; ?></a></td>
            <td><?= $query_kuisioner['tahun']; ?></td>
            <td><?= $query_kuisioner['lokasi']; ?></td>

        </tr>
        <?php
                        // echo "<td> <a class='info' info-id='$query_kuisioner[id_judul]' href='#'><i class='bi bi-info-circle'></i></a>  <a class='edit' edit-id='$query_kuisioner[id_judul] | $query_kuisioner[judul]' href='#' role='button'><i class='bi bi-pencil-square'></i></a>  <a class='hapus' hapus-id='$query_kuisioner[id_judul]' href='#'><i class='bi bi-trash'></i></a></td></tr>";
                    }
                    ?>
    </tbody>
</table>



<?php
        } else {
            echo "<h4 class='text-center'>DATA KOSONG</h4>";
        }
    }
} else {
    echo "<h4 class='text-center'>DATA KOSONG</h4>";
}

?>

<script>
// kalo dalam perulangan, jangan pakai id. pakai class
$(document).ready(function() {

    // fungsi ketika klik buka
    $('.open').on('click', function(e) {
        e.preventDefault();

        let data = $(this).attr('open-id');
        // alert(data)
        $.post('USER/kuesioner.php', {
            id: data,
        }, function(response) {
            $('#main-page').html(response);
        })


    })


})
</script>