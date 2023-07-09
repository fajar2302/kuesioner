<?php
require '../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM `tb_kuisioner`");

if (mysqli_num_rows($result) > 0) {
?>
<table class="table table-bordered">

    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul Kuisioner</th>
            <th scope="col">Tahun</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $jumlah = 1;
            while ($query_kuisioner = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $jumlah++ . "</td>";
                echo "<td><a class='open' open-id='$query_kuisioner[id_kuisioner] | $query_kuisioner[judul]' href='#'>" . $query_kuisioner['judul'] . "</a></td>";
                echo "<td>" . $query_kuisioner['tahun'] . "</td>";
                echo "<td>" . $query_kuisioner['lokasi'] . "</td>";
                echo "<td><a class='edit' edit-id='$query_kuisioner[id_kuisioner] | $query_kuisioner[judul]' href='#' role='button'>Edit</a> | <a class='hapus' id-hapus='$query_kuisioner[id_kuisioner]' href='#'>Delete</a></td></tr>";
            }
            ?>
    </tbody>
</table>

<?php

} else {
    echo "<h4 class='text-center'>DATA KOSONG</h4>";
}
?>

<!-- modals -->
<div class="modal mt-4 mx-auto" tabindex="-1" id="modalShow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="headerModal">
                <h5 class="modal-title" id="modalTittle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-1 pb-0" id="bdModalKuisioner"></div>
            <div class="modal-footer mt-3">
                <p style="color:#777474;">&copy; <?php echo date("Y") ?> Febrian</p>
            </div>
        </div>
    </div>
</div>
<!-- end modals -->



<script>
// kalo dalam perulangan, jangan pakai id. pakai class
$(document).ready(function() {

    // fungsi ketika klik buka
    $('.open').on('click', function(e) {
        e.preventDefault();

        let data = $(this).attr('open-id');
        let pisah = data.split('|');
        let id = pisah[0];
        $.post('kuisioner/pertanyaan/pertanyaan.php', {
            id: id,
        }, function(response) {
            $('#menu-kuisioner').html(response);
        })

    })

    // fungsi ketika klik hapus
    $('.hapus').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('id-hapus');
        $.post('kuisioner/proses-input.php', 'hapus=' + id, function(respon) {
            var pecah = respon.split('|');
            $('#load-tabel').load('kuisioner/tabel.php');
            Swal.fire({
                icon: pecah[0],
                title: pecah[2],
                text: pecah[1],
                footer: 'File Latihan'
            });
        })
    })

    // fungsi ketika klik edit
    $('.edit').on('click', function(e) {
        let data = $(this).attr('edit-id');
        let pisah = data.split('|');
        let id = pisah[0];
        let judul = pisah[1];
        e.preventDefault();
        $('#modalShow').modal('show');
        $('#modalTittle').html(id + '-' + judul);
        $.post(
            'kuisioner/edit.php', {
                id: id,
            },
            function(respon) {
                $('#bdModalKuisioner').html(respon);
                $('#headerModal').removeClass();
                $('#headerModal').addClass('modal-header bg-custom text-white')
            }
        );
    });
})
</script>