<?php
include '../../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM `tb_jeniskuisioner`");

if (mysqli_num_rows($result) > 0) {
?>
    <table class="table table-bordered">

        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID Jenis Kuisioner</th>
                <th scope="col">Kuisioner ID</th>
                <th scope="col">Jenis Kuisioner</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jumlah = 1;
            while ($query_jenkus = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $jumlah++ . "</td>";
                echo "<td>" . $query_jenkus['id_jenisKuisioner'] . "</td>";
                echo "<td>" . $query_jenkus['kuisioner_id'] . "</td>";
                echo "<td>" . $query_jenkus['jenis_kuisoner'] . "</td>";
                echo "<td><a class='edit' edit-id='$query_jenkus[id_jenisKuisioner]' href='#' role='button'>Edit</a> | <a class='hapus' id-hapus='$query_jenkus[id_jenisKuisioner]' href='#'>Delete</a></td></tr>";
            }
            ?>
        </tbody>
    </table>

<?php

} else {
    echo "<h4 class='text-center'>DATA KOSONG</h4>";
}
?>