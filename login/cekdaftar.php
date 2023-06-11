<?php
            include '../../../koneksi.php';

            if(isset($_POST['submit'])){
              $nama = $_POST['nama'];
              $jenis_kelamin = $_POST['jenis_kelamin'];
              $nomor_telepon = $_POST['no_hp'];
              $alamat = $_POST['alamat'];
              $username = $_POST['usernama'];
              $kata_kunci=$_POST['kata_kunci'];
              
        
              

              $result = mysqli_query($koneksi, "INSERT INTO user_admin(nama,alamat,jenis_kelamin,username,kata_kunci,nomor_telepon) VALUES('$nama','$alamat','$jenis_kelamin','$username','$kata_kunci','$nomor_telepon')");
              if($result){
                header ('location:login.html');
                echo "Databased telah dikirim";
              }
              else{
                echo"Databased gagal diinput";
              }
            }
?>