<div class="card">
    <div class="card-body">
        <h1 class="card-title text-center">REGISTER</h1>
    </div>
    <form id="form-data">
        <!-- <div class="row align-items-center"> -->
        <div class="row mb-3 align-items-center">
            <div class="col-6">
                <label for="inputtext" class="col-form-label">NAMA LENGKAP</label>
            </div>
            <div class="col-6">
                <input type="text" id="inputtext" class="form-control" name="nama" placeholder="Ex: Moh. Fajar">
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-6">
                <label class="col-form-label">Jenis Kelamin</label>
            </div>
            <div class="col-6">
                <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                    <option value="">- option -</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-6">
                <label for="inputnohp" class="col-form-label">No HP</label>
            </div>
            <div class="col-6">
                <input type="text" id="inputnohp" class="form-control" name="no_hp" placeholder="Ex: +628****">
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-6">
                <label class="col-form-label">Alamat</label>
            </div>
            <div class="col-6">
                <input type="text" id="alamat" class="form-control" name="alamat"
                    placeholder="Ex: Jln. Manggis, Kota Gorontalo">
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-6">
                <label for="inputuser" class="col-form-label">Username/ID</label>
            </div>
            <div class="col-6">
                <input type="text" id="inputuser" class="form-control" name="usernama"
                    placeholder="EX: NIP/NIK/NIM/SIM...">
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-6 mb-5 pb-5">
                <label for="inputpassword" class="col-form-label mb-2">Password</label>
            </div>
            <div class="col-6">
                <input type="password" id="inputpassword" class="form-control password" name="password">
                <div class="my-1">
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault" id="labelShowPass">
                        Show Password
                    </label>
                </div>
                <label id="length" class="invalid">*Minimal 8 karakter</label>
                <label id="combination" class="invalid">*Gabungan huruf besar, huruf kecil, angka, dan
                    karakter khusus</label>
            </div>
        </div>
        <div class="d-grid gap-2 align-items-center">
            <button type="submit" class="btn btn-primary" id="btn">DAFTAR</button>
            <button type="button" id="btn-login" class="btn btn-primary">LOGIN</button>
        </div>
        <!-- </div> -->
    </form>
</div>

<script>
$(document).ready(function() {
    $('#inputpassword').keyup(function() {
        // Mengecek kriteria panjang sandi
        let password = $(this).val();
        if (password.length < 8) {
            $('#length').removeClass('valid').addClass('invalid');
        } else {
            $('#length').removeClass('invalid').addClass('valid');
        }

        // Mengecek kriteria kombinasi karakter
        if (password.match(/[a-z]/) && password.match(/[A-Z]/) && password.match(/[0-9]/) && password
            .match(/[^a-zA-Z0-9]/)) {
            $('#combination').removeClass('invalid').addClass('valid');
        } else {
            $('#combination').removeClass('valid').addClass('invalid');
        }
    });
});


// fungsi Show Password
$(document).ready(function() {
    // aksi ketika tombol Login ditekan
    $('#btn-login').on('click', function() {
        $('#form-page').load('login.php');
    })

    // aksi untuk menampilkan password
    $('#flexCheckDefault').click(function() {
        let passwordField = $('#inputpassword');
        let passwordFieldType = passwordField.attr('type');
        if (passwordFieldType == 'password') {
            passwordField.attr('type', 'text');
            $('#labelShowPass').text('Hidden Password');

        } else {
            passwordField.attr('type', 'password');
            $('#labelShowPass').text('Show Password');
        }
    });

    // aksi ketika tombol Daftar ditekan
    $('#form-data').submit(function(e) {
        // alert(data);
        e.preventDefault();
        let isFormValid = true;

        // Iterasi melalui semua elemen dengan kelas 'form-control'
        $(".form-control").each(function() {
            // Periksa apakah nilai elemen kosong atau tidak
            if ($(this).val() === "") {
                isFormValid = false;
                return false; // Keluar dari loop each jika ada satu elemen yang kosong
            }
        });

        if (!isFormValid) {
            Swal.fire({
                position: 'top',
                icon: 'error',
                title: 'Harap Lengkapi Form Sebelum Mengirim!',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            let data = $(this).serialize();
            $.post('proses.php', 'daftar&' + data, function(respon) {
                let pisah = respon.split("|");
                Swal.fire({
                    position: 'top',
                    icon: pisah[0],
                    title: pisah[1],
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#form-page').load('login.php');
            })
        }

    })



});
</script>