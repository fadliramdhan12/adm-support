<?php
// Membuat koneksi
$koneksi1 = mysqli_connect("localhost","root","","adminprod");
$koneksi2 = mysqli_connect("localhost","root","","aio_iot");

// cek koneksi
if(mysqli_connect_errno()){
    echo "Koneksi Gagal : ".mysqli_connect_error();
}
?>