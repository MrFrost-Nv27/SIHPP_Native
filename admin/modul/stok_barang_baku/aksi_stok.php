<?php
session_start();
include "../../koneksi.php";
$module = $_GET['page'];
$act = $_GET['act'];

$kode = $_POST['kode'];
$harga = $_POST['harga'];
$tgl = date('Y-m-d H:i:s');
$stok_asli = $_POST['stok_asli'];
$stok_tambah = $_POST['stok_tambah'];
$stok = $stok_asli + $stok_tambah;
$total = $harga * $stok;

if ($module == 'aksi_stok_bb' and $act == 'edit') {
    try {
        mysqli_query($koneksi, "UPDATE persediaan_bahan_baku SET tgl_pb='$tgl', stok_pb = $stok, tot_pb='$total' WHERE kd_pb = '$kode'");
        header('location:../../index.php?page=stok_bb&act=list');
    } catch (\Throwable $th) {
        var_dump($th);
    }
}