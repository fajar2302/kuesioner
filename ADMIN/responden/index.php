<?php
include '../../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM `tb_user` WHERE roles = 'responden'");

if (mysqli_num_rows($result) > 0) {
?>
    <section class="responden">
        <div class="row mx-2">
            <div class="col-md-12 fw-bold fs-3 text-uppercase">Responden</div>
        </div>
        <div class="mt-4">
            <hr class="dropdown-divider" />
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">

                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Responden</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Nomor Hp</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kuesioner Yang Di Isi</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $jumlah = 1;
                        while ($query_kuisioner = mysqli_fetch_assoc($result)) {
                            $id_user = $query_kuisioner['username'];
                            $nama = $query_kuisioner['nama'];
                            $baru = str_replace(" ", "", $nama);
                            $teks_nonkapital = strtolower($baru);
                            $enkrip = $teks_nonkapital . "_" . $id_user;
                            $jumlahBaris = '';

                            $queryCheck = mysqli_query($koneksi, "SELECT * FROM $enkrip GROUP BY judul_id");
                            $ambilBaris = mysqli_num_rows($queryCheck);
                            if ($ambilBaris > 0) {
                                $jumlahBaris = $ambilBaris;
                            } else {
                                $jumlahBaris = 0;
                            }
                        ?>
                            <tr class="text-center">
                                <td><?= $jumlah++; ?></td>
                                <td><?= $nama; ?></td>
                                <td class="text-capitalize"><?= $query_kuisioner['jenis_kelamin']; ?></td>
                                <td><?= $query_kuisioner['umur']; ?></td>
                                <td><?= $query_kuisioner['no_hp']; ?></td>
                                <td><?= $query_kuisioner['alamat']; ?></td>
                                <td><?= $jumlahBaris; ?></td>
                                <td><a class="info" info-id=<?= $id_user; ?> href="#">
                                        <button class="btn btn-primary">
                                            <i class="bi bi-info-circle"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php

} else {
    echo "<h4 class='text-center'>DATA KOSONG</h4>";
}
?>

<!-- modals -->
<div class="row-justify-content-center">
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
                $('#menu').html(response);
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