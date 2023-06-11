function daftar() {
  $.ajax('daftar.html').done(function (data) {
    $('#content').html(data);
  });
}

// fungsi validasi password

$(document).ready(function () {
  $('#inputpassword').keyup(function () {
    // Mengecek kriteria panjang sandi
    let password = $(this).val();
    if (password.length < 8) {
      $('#length').removeClass('valid').addClass('invalid');
    } else {
      $('#length').removeClass('invalid').addClass('valid');
    }

    // Mengecek kriteria kombinasi karakter
    if (password.match(/[a-z]/) && password.match(/[A-Z]/) && password.match(/[0-9]/) && password.match(/[^a-zA-Z0-9]/)) {
      $('#combination').removeClass('invalid').addClass('valid');
    } else {
      $('#combination').removeClass('valid').addClass('invalid');
    }
  });
});

// fungsi Show Password
$(document).ready(function () {
  $('#showPassword').click(function () {
    let passwordField = $('#inputpassword');
    let passwordFieldType = passwordField.attr('type');
    if (passwordFieldType == 'password') {
      passwordField.attr('type', 'text');
      $(this).text('Sembunyikan Password');
    } else {
      passwordField.attr('type', 'password');
      $(this).text('Tampilkan Password');
    }
  });
});
