<?php

// mencari nama tabel dan nama user
function detailUser($id_user)
{
    global $koneksi;

    $query_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$id_user'");
    $data = mysqli_fetch_assoc($query_user);
    return ['nama' => $data['nama'], 'nama_tabel' => str_replace(' ', '', $data['nama']) . '_' . $id_user];
}

// menghitung total presepsi tiap pertanyaan
function hitungTotal($no_pertanyaan)
{
    global $koneksi;
    $jawaban = 0;

    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    while ($data = mysqli_fetch_assoc($query)) {
        $nama_tabel = detailUser($data['username'])['nama_tabel'];
        $result = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$no_pertanyaan'");
        $hasil = mysqli_fetch_assoc($result);
        $jawaban = $jawaban + $hasil['presepsi'];
    }
    return $jawaban;
}


// function totalxy($nama_tabel, $id_pertanyaan)
// {
//     global $koneksi;

//     // Mendapatkan nilai Y dari fungsi totalY
//     $nilaiY = totalY($nama_tabel);

//     // Mendapatkan nilai X dari fungsi presepsi_harapan
//     $nilaiX = presepsi_harapan($nama_tabel, $id_pertanyaan);

//     // Menghitung total XY
//     $totalXY = $nilaiX * $nilaiY;

//     return $totalXY;
// }


// mencari nilai X kuadrat
function menghitungX($kode_tabel)
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM $kode_tabel");
    $xkuadrat = 0;
    $nilai = 0;
    while ($data = mysqli_fetch_assoc($query)) {
        $nilai = $nilai + $data['presepsi'];
    }
    // Mengkuadratkan $xkuadrat
    $xkuadrat = $nilai * $nilai;
    return  ['nilai_x' => $nilai, 'nilai_x_kuadrat' => $xkuadrat];
}


// mencari nilai Y
function totalY($nama_tabel)
{
    global $koneksi;
    $jumlah = 0;
    $ykuadrat = 0;
    $query = mysqli_query($koneksi, "SELECT * FROM $nama_tabel");
    while ($data = mysqli_fetch_assoc($query)) {
        $jumlah = $jumlah + $data['presepsi'];
    }
    $ykuadrat = $jumlah * $jumlah;
    return ['nilai_y' => $jumlah, 'nilaiY_kuadrat' => $ykuadrat];
}

// untuk mendapatkan nilai X per user
function presepsi_harapan($nama_tabel, $id_pertanyaan)
{
    global $koneksi;
    $kuadrat_presepsi = 0;
    $kuadrat_harapan = 0;
    $query = mysqli_query($koneksi, "SELECT * FROM $nama_tabel WHERE pertanyaan_id = '$id_pertanyaan' ");
    while ($data = mysqli_fetch_assoc($query)) {
        $presepsi = $data['presepsi'];
        $harapan = $data['harapan'];
    }
    // kuadrat
    $kuadrat_presepsi = $presepsi * $presepsi;
    $kuadrat_harapan = $harapan * $harapan;

    return ['presepsi' => $presepsi, 'harapan' => $harapan, 'presepsi_kuadrat' => $kuadrat_presepsi, 'harapan_kuadrat' => $kuadrat_harapan];
}


// TOTAL X1, Y1 XY1, X kuadrat, Ykuadrat
function total($nilaiX, $nilaiX_kuadrat, $nilaiXY, $nilaiY, $nilaiY_kuadrat)
{
    global $koneksi;
    $totalX = 0;
    $totalX_kuadrat = 0;
    $totalY = 0;
    $totalY_kuadrat = 0;
    $totalXY = 0;

    $totalX += $nilaiX;
    $totalX_kuadrat += $nilaiX_kuadrat;
    $totalY += $nilaiY;
    $totalY_kuadrat += $nilaiY_kuadrat;
    $totalXY = $nilaiXY;

    return ['x' => $totalX, 'x_kuadrat' => $totalX_kuadrat, 'y' => $totalY, 'y_kuadrat' => $totalY_kuadrat, 'xy' => $totalXY];
}

// rumus korelasi
function korelasi()
{
    global $koneksi;
}
