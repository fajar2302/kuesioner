<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
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
    <script src="../../../Jquery/sweetalert.js"></script>


    <!-- link Jquery -->
    <script src="../../../Jquery/jquery-3.6.4.min.js"></script>
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
            width: 380px;
            height: 350px;
            padding: 20px;
            border-radius: 20px;
            background-color: #71a8a4;
            box-shadow: 13px 13px 20px #4e4646, -13px -13px 20px #4e4646;
        }
    </style>
</head>

<body>
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h1 class="card-title text-center">L O G I N</h1>
            </div>
            <div class="card-text">
                <form method="POST" action="ceklogin.php">
                    <div class="mb-3">
                        <label for="exampleInputUser1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputuser1" name="fusername" />
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="fpassword" />
                    </div>
                    <button type="submit" class="btn btn-primary" name='login'>Login</button>
                    <a href="daftar.html" class="btn btn-primary" tabindex="-1" role="button"
                        aria-disabled="true">Daftar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>

</html>