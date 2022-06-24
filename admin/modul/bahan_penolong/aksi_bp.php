<?php
session_start();
include "../../koneksi.php";

$module = $_GET['page'];
$act = $_GET['act'];
$id_bp = $_POST['id_bp'];
$nm_bp = $_POST['nm_bp'];
$hrg_bp = $_POST['hrg_bp'];
$satuan_bp = $_POST['satuan_bp'];
$kd_bp = $_POST['kd_bp'];

$tampil = mysqli_query($koneksi,"SELECT * FROM bahan_penolong where kd_bp='$kd_bp'");
$hasil = mysqli_num_rows($tampil);

// AKSI HAPUS
if ($module=='aksi_bp' AND $act=='hapus'){
$buka = mysqli_query($koneksi,"SELECT kd_bp FROM bahan_penolong where id_bp='$_GET[id]'");
$row =  mysqli_fetch_assoc($buka);
$kd= $row['kd_bp'];
mysqli_query($koneksi,"DELETE FROM persediaan_bahan_penolong WHERE kd_pb = '$kd'");
mysqli_query($koneksi,"DELETE FROM bahan_penolong WHERE id_bp = '$_GET[id]'");

echo "<script>alert('Data Berhasil Dihapus!');history.go(-1);</script>";
}
// AKSI SIMPAN
elseif ($module=='aksi_bp' AND $act=='input'){
if ($hasil>=1){
echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
}else{
mysqli_query($koneksi,"INSERT into bahan_penolong values('','BP','$nm_bp','$hrg_bp','$satuan_bp')");
$lihat = mysqli_query($koneksi,"SELECT id_bp FROM bahan_penolong where kd_bp='BP'");
$r =  mysqli_fetch_assoc($lihat);
$kode="BP" . $r['id_bp'];
mysqli_query($koneksi,"UPDATE bahan_penolong SET kd_bp = '$kode'  WHERE kd_bp = 'BP'");
$tgl= date('Y-m-d');
$id_pb= $r['id_bp'];
mysqli_query($koneksi,"INSERT into persediaan_bahan_penolong values('$tgl','$kode','$nm_bp','$satuan_bp','$hrg_bp','0','0')");
header('location:../../index.php?page=bp&act=list');
}
}
// AKSI UBAH
elseif ($module=='aksi_bp' AND $act=='edit'){
mysqli_query($koneksi,"UPDATE bahan_penolong SET nm_bp = '$nm_bp', hrg_bp  = '$hrg_bp', satuan_bp  = '$satuan_bp' WHERE id_bp = '$id_bp'");
mysqli_query($koneksi,"UPDATE persediaan_bahan_penolong SET nm_pb = '$nm_bp', hrg_pb  = '$hrg_bp', sat_pb  = '$satuan_bp', tot_pb= hrg_pb * stok_pb WHERE kd_pb = '$kd_bp'");
header('location:../../index.php?page=bp&act=list');

}
