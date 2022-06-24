<?php 

function kode_aspek(){  
include "koneksi.php";	
$query = "SELECT max(kode) as maxkode FROM aspek";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kode = $data['maxkode'];
$noUrut = (int) substr($kode, 1, 4);
$noUrut++;
$char = "A";
$xkode = $char . sprintf("%04s", $noUrut);
return "$xkode";
}

function kode_faktor(){  
include "koneksi.php";	
$query = "SELECT max(kode) as maxkode FROM faktor";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kode = $data['maxkode'];
$noUrut = (int) substr($kode, 1, 4);
$noUrut++;
$char = "F";
$xkode = $char . sprintf("%04s", $noUrut);
return "$xkode";
}

function kode_kar(){  
include "koneksi.php";	
$query = "SELECT max(kode) as maxkode FROM karyawan";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kode = $data['maxkode'];
$noUrut = (int) substr($kode, 1, 4);
$noUrut++;
$char = "K";
$xkode = $char . sprintf("%04s", $noUrut);
return "$xkode";
}

function kode_jab(){  
include "koneksi.php";	
$query = "SELECT max(kode) as maxkode FROM jabatan";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kode = $data['maxkode'];
$noUrut = (int) substr($kode, 1, 4);
$noUrut++;
$char = "J";
$xkode = $char . sprintf("%04s", $noUrut);
return "$xkode";
}

function prom_jab(){  
include "koneksi.php";	
$query = "SELECT max(kode) as maxkode FROM prom_jab";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kode = $data['maxkode'];
$noUrut = (int) substr($kode, 2, 3);
$noUrut++;
$char = "PJ";
$xkode = $char . sprintf("%03s", $noUrut);
return "$xkode";
}


function prom_kar(){  
include "koneksi.php";	
$query = "SELECT max(kode) as maxkode FROM prom_kar";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kode = $data['maxkode'];
$noUrut = (int) substr($kode, 2, 3);
$noUrut++;
$char = "PR";
$xkode = $char . sprintf("%03s", $noUrut);
return "$xkode";
}
?>
