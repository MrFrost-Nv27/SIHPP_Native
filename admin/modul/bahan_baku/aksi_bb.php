<?php
session_start();
include "../../koneksi.php";

$module = $_GET['page'];
$act = $_GET['act'];
$id_bb = $_POST['id_bb'];
$nm_bb = $_POST['nm_bb'];
$hrg_bb = $_POST['hrg_bb'];
$satuan_bb = $_POST['satuan_bb'];
$kd_bb = $_POST['kd_bb'];

$tampil = mysqli_query($koneksi, "SELECT * FROM bahan_baku where kd_bb='$kd_bb'");
$hasil = mysqli_num_rows($tampil);

// AKSI HAPUS
if ($module == 'aksi_bb' and $act == 'hapus') {
    $buka = mysqli_query($koneksi, "SELECT kd_bb FROM bahan_baku where id_bb='$_GET[id]'");
    $row =  mysqli_fetch_assoc($buka);
    $kd = $row['kd_bb'];
    mysqli_query($koneksi, "DELETE FROM persediaan_bahan_baku WHERE kd_pb = '$kd'");
    mysqli_query($koneksi, "DELETE FROM bahan_baku WHERE id_bb = '$_GET[id]'");

    echo "<script>alert('Data Berhasil Dihapus!');history.go(-1);</script>";
}
// AKSI SIMPAN
elseif ($module == 'aksi_bb' and $act == 'input') {
    try {
        if ($hasil >= 1) {
            echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
        } else {
            mysqli_query($koneksi, "INSERT into bahan_baku values(null,'BB','$nm_bb','$hrg_bb','$satuan_bb')");
            $lihat = mysqli_query($koneksi, "SELECT id_bb FROM bahan_baku where kd_bb='BB'");
            $r =  mysqli_fetch_assoc($lihat);
            $kode = "BB" . $r['id_bb'];
            mysqli_query($koneksi, "UPDATE bahan_baku SET kd_bb = '$kode'  WHERE kd_bb = 'BB'");
            $tgl = date('Y-m-d');
            $id_pb = $r['id_bb'];
            mysqli_query($koneksi, "INSERT into persediaan_bahan_baku values('$tgl','$kode','$nm_bb','$satuan_bb','$hrg_bb','0','0')");
            header('location:../../index.php?page=bb&act=list');
        }
    } catch (\Throwable $th) {
        var_dump($th);
    }
}
// AKSI UBAH
elseif ($module == 'aksi_bb' and $act == 'edit') {
    mysqli_query($koneksi, "UPDATE bahan_baku SET nm_bb = '$nm_bb', hrg_bb  = '$hrg_bb', satuan_bb  = '$satuan_bb' WHERE id_bb = '$id_bb'");
    header('location:../../index.php?page=bb&act=list');
}