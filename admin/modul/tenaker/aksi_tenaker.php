<?php
session_start();
include "../../koneksi.php";

$module = $_GET['page'];
$act = $_GET['act'];
$id_tenaker = $_POST['id_tenaker'];
$nm_tenaker = $_POST['nm_tenaker'];
$bag_tenaker = $_POST['bag_tenaker'];
$upah_tenaker = $_POST['upah_tenaker'];


$tampil = mysqli_query($koneksi,"SELECT * FROM tenaker where nm_tenaker='$nm_tenaker'");
$hasil = mysqli_num_rows($tampil);

if ($module=='aksi_tenaker' AND $act=='hapus'){
mysqli_query($koneksi,"DELETE FROM tenaker WHERE id_tenaker   = '$_GET[id]'");
echo "<script>alert('Data Berhasil Dihapus!');history.go(-1);</script>";
}
elseif ($module=='aksi_tenaker' AND $act=='input'){
if ($hasil>=1){
echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
}else{
mysqli_query($koneksi,"insert into tenaker values('','$nm_tenaker','$bag_tenaker','$upah_tenaker','0')");
header('location:../../index.php?page=tenaker&act=list');
}
}elseif ($module=='aksi_tenaker' AND $act=='edit'){
mysqli_query($koneksi,"UPDATE tenaker SET nm_tenaker          = '$nm_tenaker', bag_tenaker  = '$bag_tenaker', upah_tenaker  = '$upah_tenaker' WHERE id_tenaker = '$id_tenaker'");
header('location:../../index.php?page=tenaker&act=list');

}

?>
