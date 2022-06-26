<?php
session_start();
include "../../koneksi.php";

$module = $_GET['page'];
$act = $_GET['act'];
$id_overp = $_POST['id_overp'];
$nm_overp = $_POST['nm_overp'];
$by_overp = $_POST['by_overp'];
$ket_overp = $_POST['ket_overp'];
$kd_overp = $_POST['kd_overp'];

$tampil = mysqli_query($koneksi, "SELECT * FROM overhead_pabrik where kd_overp='$kd_overp'");
$hasil = mysqli_num_rows($tampil);
$tgl = date('Y-m-d');
// AKSI HAPUS
if ($module == 'aksi_op' and $act == 'hapus') {
    mysqli_query($koneksi, "DELETE FROM overhead_pabrik WHERE id_overp = '$_GET[id]'");
    echo "<script>alert('Data Berhasil Dihapus!');history.go(-1);</script>";
}
// AKSI SIMPAN
elseif ($module == 'aksi_overhead' and $act == 'input') {
    if ($hasil >= 1) {
        echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
    } else {
        mysqli_query($koneksi, "INSERT into overhead_pabrik values('BOP','$nm_overp','$by_overp','$ket_overp','$tgl','')");
        $lihat = mysqli_query($koneksi, "SELECT id_overp FROM overhead_pabrik where kd_overp='BOP'");
        $r =  mysqli_fetch_assoc($lihat);
        $kode = "BOP" . $r['id_overp'];

        mysqli_query($koneksi, "UPDATE overhead_pabrik SET kd_overp = '$kode'  WHERE kd_overp = 'BOP'");
        header('location:../../index.php?page=overhead&act=list');
    }
}
// AKSI UBAH
elseif ($module == 'aksi_overhead' and $act == 'edit') {
    mysqli_query($koneksi, "UPDATE overhead_pabrik SET nm_overp = '$nm_overp', by_overp  = '$by_overp', ket_overp  = '$ket_overp' WHERE id_overp = '$id_overp'");
    header('location:../../index.php?page=overhead&act=list');
}
