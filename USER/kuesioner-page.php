<?php
session_start();
include '../koneksi.php';

?>

<section class="my-4 py-4" id="user">
    <div class="container my-5">
        <div class="section-title">
            <h4 class="text-center text-uppercase">daftar kuesioner</h4>
            <hr>
        </div>
        <div class="card my-4 py-4">
            <div id="tabel" class="card-body">

            </div>
        </div>

    </div>

</section>

<script>
$(document).ready(function() {
    $('#tabel').load('tabel.php');
})
</script>