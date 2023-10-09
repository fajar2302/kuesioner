<?php
session_start();
include '../koneksi.php';

$id = $_SESSION['id'];
$result = mysqli_query($koneksi, "SELECT * FROM `tb_judul`");
$jumlah_baris = mysqli_num_rows($result);


if ($jumlah_baris > 0) {

?>

    <table class="table table-bordered">
        <input type="hidden" value="<?= $id; ?>" id="id_user">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul Kuisioner</th>
                <th scope="col">Tahun</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Responden</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jumlah = 1;
            for ($i = 0; $i < $jumlah_baris; $i++) {
                $query = mysqli_fetch_assoc($result);
                $status = $query['status'];
                if ($status == 'true') {



                    // while ($query_kuisioner = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?= $jumlah++; ?></td>
                        <td><a class="open text-decoration-none text-black" open-id=<?= $query['id_judul'] ?> href="#"><?= $query['judul']; ?></a></td>
                        <td><?= $query['tahun']; ?></td>
                        <td><?= $query['lokasi']; ?></td>
                        <td><?= $query['lokasi']; ?></td>

                    </tr>
            <?php
                    // echo "<td> <a class='info' info-id='$query_kuisioner[id_judul]' href='#'><i class='bi bi-info-circle'></i></a>  <a class='edit' edit-id='$query_kuisioner[id_judul] | $query_kuisioner[judul]' href='#' role='button'><i class='bi bi-pencil-square'></i></a>  <a class='hapus' hapus-id='$query_kuisioner[id_judul]' href='#'><i class='bi bi-trash'></i></a></td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <!-- modals -->
    <div class="modal mt-4 mx-auto" tabindex="-1" id="modalShow" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="headerModal">
                    <h5 class="modal-title" id="modalTittle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pb-0" id="bdModalKuisioner"></div>
                <div class="modal-footer bg-custom mt-3">
                    <p style="color:#777474;">&copy; <?php echo date("Y") ?>Febrian</p>
                </div>
            </div>
        </div>
    </div>



<?php
} else {
    echo "<h4 class='text-center text-dark'>DATA KOSONG</h4>";
}

?>

<script>
    // kalo dalam perulangan, jangan pakai id. pakai class
    $(document).ready(function() {

        // fungsi ketika klik buka
        $('.open').on('click', function(e) {
            e.preventDefault();
            let data = $(this).attr('open-id');
            let id = $('#id_user').val();

            // post untuk mengecek apakah kuesioner sudah pernah di isi atau belum
            $.post('check.php', {
                id_user: id,
                id_judul: data,
            }, function(respon) {
                let pisah = respon.split('|');
                if (pisah[0] == 'success') {
                    // jika data sudah ada
                    Swal.fire({
                        icon: "question",
                        title: 'Anda sudah mengisi kuesioner ini. Ingin mengubah?',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Ya',
                        denyButtonText: `Batal`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('kuesioner.php', {
                                id_judul: data,
                                tabel: pisah[1],
                            }, function(respon) {
                                $('#main-page').html(respon);
                            })
                        } else if (result.isDenied) {
                            Swal.fire('Changes are not saved', '', 'info')
                        }
                    })
                } else {
                    // jika data tidak ada
                    Swal.fire({
                        icon: "question",
                        title: 'Anda yakin mengisi kuesioner ini?',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Ya',
                        denyButtonText: `Batal`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('kuesioner.php', {
                                id_judul: data,
                                tabel: pisah[1],
                            }, function(respon) {
                                $('#main-page').html(respon);
                            })
                        } else if (result.isDenied) {
                            Swal.fire('Changes are not saved', '', 'info')
                        }
                    })
                }
            })

        })

    })
</script>