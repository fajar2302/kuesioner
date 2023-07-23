<?php
require '../../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM `tb_judul`");

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
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $jumlah = 1;
            while ($query_kuisioner = mysqli_fetch_assoc($result)) {
                if ($query_kuisioner['status'] == 'true') {
                    $status = 'checked';
                } else {
                    $status = '';
                }
            ?>
        <tr>
            <td><?= $jumlah++; ?></td>
            <td><a class="open text-decoration-none text-black"
                    open-id="<?= $query_kuisioner['id_judul'] . "|" . $query_kuisioner['judul']; ?>"
                    href="#"><?= $query_kuisioner['judul']; ?></a>
            </td>
            <td><?= $query_kuisioner['tahun']; ?></td>
            <td><?= $query_kuisioner['lokasi']; ?></td>
            <td> <a class="info" info-id=<?= $query_kuisioner['id_judul']; ?> href="#"><i
                        class="bi bi-info-circle"></i></a>
                <a class="edit" edit-id=<?= $query_kuisioner['id_judul'] . " |" . $query_kuisioner['judul'] ?> href="#"
                    role="button"><i class="bi bi-pencil-square"></i></a> <a class="hapus"
                    hapus-id=<?= $query_kuisioner['id_judul']; ?> href="#"><i class="bi bi-trash"></i></a>
            </td>
            <td>
                <div class="form-check text-center form-switch">
                    <input class="form-check-input" type="checkbox" status-id=<?= $query_kuisioner['id_judul']; ?>
                        name="status" role="switch" id="flexSwitchCheckChecked"
                        value="<?= $query_kuisioner['status'] ?>" <?= $status; ?>>
                </div>
            </td>
        </tr>
        <?php
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
        // alert(pisah[1]);
        $.post('kuisioner/pertanyaan/pertanyaan.php', {
            id: id,
        }, function(response) {
            $('#menu-kuisioner').html(response);
        })


    })

    // fungsi ketika klik info
    $('.info').on('click', function(e) {
        e.preventDefault();
        // alert('bisa');
        let data = $(this).attr('info-id');
        $('#modalShow').modal('show');
        $.post('kuisioner/info.php', {
            id: data,
        }, function(respon) {
            $('#bdModalKuisioner').html(respon);
            $('#headerModal').removeClass();
            $('#headerModal').addClass('modal-header bg-custom text-white')
        })
    })

    // fungsi ketika klik hapus
    $('.hapus').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('hapus-id');
        $.post('kuisioner/proses-input.php', 'hapus=' + id, function(respon) {
            var pecah = respon.split('|');
            $('#load-tabel').load('kuisioner/tabel.php');
            Swal.fire({
                position: 'center',
                icon: pecah[0],
                title: pecah[1],
                showConfirmButton: false,
                timer: 1500
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


    // Fungsi Ketika Switch Status di Tekan
    $('.form-check-input').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('status-id');
        let formStatus = $(this).val();
        if (formStatus == 'false') {
            formStatus = 'true';
        } else {
            formStatus = 'false';
        }
        Swal.fire({
            icon: 'question',
            title: 'Anda Yakin Ingin Mengganti Status?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Ganti',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.post('kuisioner/switchButton.php', {
                    id: id,
                    status: formStatus,
                }, function(respon) {
                    let pecah = respon.split('|');
                    Swal.fire({
                        position: 'center',
                        icon: pecah[0],
                        title: pecah[1],
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#menu-kuisioner').load('kuisioner/index.php');
                })
            }
        })
    });
})
</script>