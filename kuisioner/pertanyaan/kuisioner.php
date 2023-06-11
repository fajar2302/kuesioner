<?php
require '../../koneksi.php';

if (isset($_POST['open'])) {
    $id = $_POST['open'];
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_kuisioner WHERE id_kuisioner = '$id'"));

?>
<h1 class="text-uppercase fs-3 ">Judul</h1>

<ol>
    <li><?php echo $data['judul']; ?></li>
</ol>

<?php } ?>