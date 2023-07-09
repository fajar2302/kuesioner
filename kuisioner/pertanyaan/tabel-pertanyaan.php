<?php
include '../../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM `tb_pertanyaan`");

if (mysqli_num_rows($result) > 0) {
?>
    <table class="table table-bordered">

        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pertanyaan</th>
                <th scope="col">Jenis Kuisioner ID</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jumlah = 1;
            while ($query_pertanyaan = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $jumlah++ . "</td>";
                echo "<td>" . $query_pertanyaan['item_pertanyaan'] . "</td>";
                echo "<td>" . $query_pertanyaan['jenisKuisioner_id'] . "</td>";
                echo "<td><a class='edit' edit-id='$query_pertanyaan[id_pertanyaan]' href='#' role='button'>Edit</a> | <a class='hapus' id-hapus='$query_pertanyaan[id_pertanyaan]' href='#'>Delete</a></td></tr>";
            }
            ?>
        </tbody>
    </table>

<?php

} else {
    echo "<h4 class='text-center'>DATA KOSONG</h4>";
}
?>