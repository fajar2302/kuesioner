<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <!-- link font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Exo+2&family=Inter:wght@700&family=Oswald&display=swap"
        rel="stylesheet" />
    <title>Kuisioner</title>

    <!-- link Sweet Alert -->
    <script src="../library/sweetAllert2.min.js"></script>


    <!-- link Jquery -->
    <script src="../library/jquery-3.6.4.min.js"></script>
    <style>
    html,
    body {
        height: 100%;
        background-color: #225181;

        font-family: 'Exo 2', sans-serif;
    }

    .global-container {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #edf0f9;
        font-family: 'Exo 2', sans-serif;
        font-weight: 700px;
    }

    .login-form {
        width: 360px;
        height: 380px;
    }

    .card {
        padding: 20px;
        border-radius: 20px;
        background-color: #71a8a4;
        box-shadow: 13px 13px 20px #4e4646, -13px -13px 20px #4e4646;
    }

    .valid {
        color: green;
    }

    .invalid {
        color: red;
    }
    </style>
</head>

<body>
    <div class="global-container" id="form-page">
        <div class="card login-form">
            <div class="card-body">
                <h1 class="card-title text-center">L O G I N</h1>
            </div>
            <div class="card-text">
                <form id="form-data">
                    <div class="mb-3">
                        <label for="exampleInputUser1" class="form-label">Username/ID</label>
                        <input type="text" class="form-control" id="exampleInputuser1" name="fusername"
                            placeholder="Ex: NIP/NIK/NO-SIM/NIM" />
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" />
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                    </div>
                    <div class="typeButton text-center mb-3">
                        <button type="submit" class="btn btn-primary me-4">Login</button>
                        <a href="#" id="daftar" class="btn btn-primary" tabindex="-1" role="button"
                            aria-disabled="true">Daftar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../css/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>

    </script>


    <script>
    $(document).ready(function() {
        $('#daftar').on('click', function(e) {
            e.preventDefault();
            $('#form-page').load('daftar.php');
        })

        $('#flexCheckDefault').on('click', function(e) {
            e.preventDefault();
            let passwordField = $('#exampleInputPassword1');
            let passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).text('Sembunyikan Password');

            } else {
                passwordField.attr('type', 'password');
                $(this).text('Tampilkan Password');
            }
        })

        $('#form-data').submit(function(e) {
            e.preventDefault();
            let input = $('.form-control').val();
            if (input == " ") {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: 'Lengkapi Form Login Terlebih Dahulu',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                let data = $(this).serialize();
                $.post('proses.php', 'login&' + data, function(respon) {
                    let pisah = respon.split("|");
                    let roles = pisah[2];
                    Swal.fire({
                        position: 'top',
                        icon: pisah[0],
                        text: pisah[1],
                        showConfirmButton: false,
                        timer: 1500
                    })
                    if (roles === 'responden') {
                        window.location.href = '../USER/index.php';
                    } else if (roles === 'admin') {
                        window.location.href = '../ADMIN/index.php';
                    } else {
                        alert('gagal');
                    }
                })
            }
        })
    })
    </script>
</body>

</html>