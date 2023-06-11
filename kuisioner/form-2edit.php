<?php
include '../koneksi.php';
$id = $_POST['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jenis_kuisioner WHERE id_kuisioner = '$id'"));

?>

<form id="form-data">
    <div class="mb-3">
        <label for="exampleInputText2" class="form-label">Jenis Kuisioner</label>
        <select class="form-select" aria-label="Default select example" id="exampleInputText3" name="jenis_kuisioner">
            <option value="">Select Option</option>
            <option value="tangibles">Tangibles (Bukti Fisik)</option>
            <option value="reability">Reability (Kehandalan)</option>
            <option value="responsiveness">Responsiveness (Daya Tanggap)</option>
            <option value="assurance">Assurance (Jaminan)</option>
            <option value="emphaty">Emphaty (Perhatian)</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputText3" class="form-label">Item Pertanyaan</label>
        <input type="text" class="form-control" id="exampleInputText3" name="item-pertanyaan">
    </div>
    <div class="d-grid col-6 mx-auto">
        <button class="btn" type="submit" name="simpan">SIMPAN</button>
    </div>
</form>

<script>
    $('.hide').hide();
</script>