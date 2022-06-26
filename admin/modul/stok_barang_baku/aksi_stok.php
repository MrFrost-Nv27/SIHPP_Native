<?php
session_start();
include "../../koneksi.php";

$module = $_GET['page'];
$act = $_GET['act'];
$tgl_pb = $_POST['tgl_pb'];
$nm_pb = $_POST['nm_pb'];
$sat_pb = $_POST['sat_pb'];
$tot_pb = $_POST['tot_pb'];

$id = $_POST['id'];
$harga = $_POST['harga'];
$tgl = date('Y-m-d H:i:s');
$stok_asli = $_POST['stok_asli'];
$stok_tambah = $_POST['stok_tambah'];
$stok = $stok_asli + $stok_tambah;
$total = $harga * $stok;

if ($module == 'aksi_stok_bb' and $act == 'edit') {
    try {
        mysqli_query($koneksi, "UPDATE bahan_baku SET tgl_bb='$tgl', stok_bb = $stok, tot_bb='$total' WHERE id_bb = '$id'");
        header('location:../../index.php?page=stok_bb&act=list');
    } catch (\Throwable $th) {
        var_dump($th);
    }
}