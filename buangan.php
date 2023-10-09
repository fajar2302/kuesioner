<!-- <table class="table table-bordered">
    <thead class="table-dark">
        <tr class="text-center">
            <th>No.</th>
            <th>X<sub>1</sub></th>
            <th>Y<sub>1</sub></th>
            <th>X<sub>1</sub> <sup>2</sup></th>
            <th>Y<sub>1</sub> <sup>2</sup></th>
            <th>X<sub>1</sub>Y<sub>1</sub></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles != 'admin'");
    $no = 1;
    while ($data = mysqli_fetch_assoc($query)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= menghitungX(detailUser($data['username'])['nama_tabel']);  ?></td>
        </tr>
        <?php
    }
        ?>
    </tbody>
</table> -->