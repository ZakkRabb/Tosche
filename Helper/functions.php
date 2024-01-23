<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp" . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function successLogin($nama)
{
    // echo "<script>
    // Swal.fire(
    //     'Login Berhasil!',
    //     'Selamat datang $nama !',
    //     'success'
    //   )
    // </script>";
    echo "<script>
        alert($nama);
        </script>";
}

$n = 10;
function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
