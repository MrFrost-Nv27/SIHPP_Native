<?php
session_start();
include "../../koneksi.php";

$module = $_GET['page'];
$act = $_GET['act'];
$kd_pb = $_POST['kd_pb'];
$hrg_pb = $_POST['hrg_pb'];
$stok_pb = $_POST['stok_pb'];
$stok_pb_asli = $_POST['stok_pb_asli'];
$tot_pb = $_POST['tot_pb'];
$stok = $stok_pb + $stok_pb_asli;
$total = $hrg_pb * $stok;

if ($module == 'aksi_stok_bp' and $act == 'edit') {
    $tgl = date('Y-m-d');
    mysqli_query($koneksi, "UPDATE persediaan_bahan_penolong SET tgl_pb='$tgl', stok_pb = stok_pb + $stok_pb, tot_pb='$total' WHERE kd_pb = '$kd_pb'");
    header('location:../../index.php?page=stok_bp&act=list');
}