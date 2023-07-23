<?php
require '../koneksi.php';


$id = $_POST['id'];
$pisah = array('TANGIBLE', 'RELIABILITY', 'RESPONSIVENESS', 'ASSURANCE', 'EMPHATY');
// // $query = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan JOIN tb_judul ON tb_pertanyaan.judul_id = tb_judul.id_judul JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisjudul_id = tb_jeniskuisioner.id_jenisKuisioner WHERE tb_pertanyaan.judul_id = '$id'");
$query = mysqli_query($koneksi, "SELECT * FROM tb_judul WHERE id_judul = '$id'");
$join = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan JOIN tb_jeniskuisioner ON tb_pertanyaan.jenisKuisioner_id = tb_jeniskuisioner.id_jenisKuisioner JOIN tb_judul ON tb_pertanyaan.judul_id = tb_judul.id_judul WHERE tb_pertanyaan.judul_id = '$id' AND tb_pertanyaan.jenisKuisioner_id = '1' LIMIT 1 OFFSET 0");
if (mysqli_num_rows($join) > 0) {
    $ambil = mysqli_fetch_assoc($join);
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
            <div class="row py-3">
                <div class="col-4 border-end">
                    <div class="side-tittle">
                        <h6 class="text-center">Jenis Kuisioner :<?= $ambil['jenis_kuisioner']; ?> </h6>
                    </div>

                    <!-- ACCORDION -->
                    <div class="accordion my-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    TANGIBLE
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="number-question">
                                        <span class="border py-1 px-2 me-2">1</span>
                                        <span class="border py-1 px-2 me-2">2</span>
                                        <span class="border py-1 px-2 me-2">3</span>
                                        <span class="border py-1 px-2 me-2">4</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    RELIABILITY
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="number-question">
                                        <span class="border py-1 px-2 me-2">1</span>
                                        <span class="border py-1 px-2 me-2">2</span>
                                        <span class="border py-1 px-2 me-2">3</span>
                                        <span class="border py-1 px-2 me-2">4</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    RESPONSIVENESS
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="number-question">
                                        <span class="border py-1 px-2 me-2">1</span>
                                        <span class="border py-1 px-2 me-2">2</span>
                                        <span class="border py-1 px-2 me-2">3</span>
                                        <span class="border py-1 px-2 me-2">4</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    ASSURANCE
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="number-question">
                                        <span class="border py-1 px-2 me-2">1</span>
                                        <span class="border py-1 px-2 me-2">2</span>
                                        <span class="border py-1 px-2 me-2">3</span>
                                        <span class="border py-1 px-2 me-2">4</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    EMPHATY
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="number-question">
                                        <span class="border py-1 px-2 me-2">1</span>
                                        <span class="border py-1 px-2 me-2">2</span>
                                        <span class="border py-1 px-2 me-2">3</span>
                                        <span class="border py-1 px-2 me-2">4</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END ACCORDION -->
                </div>
                <div class="col-6 border">

                    <p><?= $ambil['item_pertanyaan'] ?></p>
                    <div class="option">
                        <p>Presepsi</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="presepsi" value="1" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="presepsi" value="2" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                2
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="presepsi" value="3" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                3
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="presepsi" value="4" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                4
                            </label>
                        </div>
                    </div>
                    <div class="option">
                        <p>Harapan</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="harapan" value="1" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="harapan" value="2" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                2
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="harapan" value="3" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                3
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="harapan" value="4" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                4
                            </label>
                        </div>
                        <hr>
                    </div>
                    <button>Selanjutnya</button>

                </div>
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
        })


    })
</script>