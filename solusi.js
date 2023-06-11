$('.ubahDosen').on('click', function (event) {
  let gabung = this.id; // untuk mengambil id dari tabel
  let pisah = gabung.split('_'); //untuk memisahkan isi dari fungsi this
  let nidn = pisah[0]; // pemisahan untuk data pertama
  let nama = pisah[1]; // pimasahan untuk data kedua
  event.preventDefault();
  $('#crupModalDosen').modal('show');
  $('#judulDosen').html(nidn + '-' + nama); //kirim data ke modal
  $.post(
    'fdDosen/dsnEdit.php',
    {
      nidn: nidn,
    },
    function (respon) {
      $('#bdModalDosen').text('loading...');
      $('#bdModalDosen').html(respon);
      $('#idHeaderDosen').removeClass();
      $('#idHeaderDosen').addClass('modal-header bg-info text-white');
    }
  );
});

// fungsi membuka modals
$('#callModalAddDosen').on('click', function (event) {
  event.preventDefault();
  $('#crupModalDosen').modal('show');
  $('#judulDosen').html('Tambah Data Baru');
  $('#bdModalDosen').text('loading...');
  $('#bdModalDosen').load('fdDosen/dsnTambah.php');
  $('#idHeaderDosen').removeClass();
  $('#idHeaderDosen').addClass('modal-header bg-success text-white');
});

// button untuk mengirim id
<button type="button" class="btn btn-info ubahDosen" data-toggle="tooltip" data-placement="top" title="Ubah" id="<?= $data['nidn'] . '_' . $data['nama_dosen']; ?>">
  <i class="far fa-edit"></i>
</button>;
