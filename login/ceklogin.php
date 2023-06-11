<?php
session_start ();

include '../koneksi.php';

    if (isset($_POST['login'])){
        $username = $_POST['fusername'];
        $password = $_POST['fpassword'];

        
            $cek_data = mysqli_query($koneksi, "SELECT * FROM `user_admin` WHERE username = '$username' ");
            if(mysqli_num_rows($cek_data) > 0){
                $data = mysqli_fetch_assoc($cek_data);
                $pasdb = $data['kata_kunci'];
                if($password == $pasdb){
                    $_SESSION['username'] = $data['nama'];
                    $_SESSION['id_ua'] = $data['id_user_admin'];
                    echo '<script>swal("Good job!", "You clicked the button!", "success");
                    </script>';
                    header('location:../index.php');
                }
                else{
                    echo '<script>swal("Password atau username salah!", "Silahkan masukkan password dan username yang benar", "erorr");
                </script>';
                    header('location:login.php');
                }
            }
            else{
                echo '<script>swal("Password atau username salah!", "Silahkan masukkan password dan username yang benar", "erorr");
                </script>';
                header('location:login.php');
            } 
        }

?>