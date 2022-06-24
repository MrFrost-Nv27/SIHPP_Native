<?php
session_start();
include "../../koneksi.php";

$module=$_GET['page'];
$act=$_GET['act'];
$username=$_POST['username'];
$nama=$_POST['nama'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$pass1=$_POST['pass1'];
$level=$_POST['level'];
$p=md5($pass);
if ($pass!=$pass1){
echo "<script>alert('Password Yang Anda Masukkan Tidak Sama!');history.go(-1);</script>";	
}else{
$tampil = mysqli_query($koneksi,"SELECT * FROM users where username='$username'");
$hasil=mysqli_num_rows($tampil);

if ($module=='aksi_user' AND $act=='hapus'){
  mysqli_query($koneksi,"DELETE FROM users WHERE username='$_GET[id]'");
echo "<script>alert('Data Berhasil Dihapus!');history.go(-1);</script>";
}
elseif ($module=='aksi_user' AND $act=='input'){
	if ($hasil>=1){
echo "<script>alert('Username Sudah Ada Yang Menggunakan!');history.go(-1);</script>";	
}else{
    mysqli_query($koneksi,"insert into users values('','$username','$p','$nama','$email','$level')");
  header('location:../../index.php?page=user&act=list');
}
}elseif ($module=='aksi_user' AND $act=='edit'){
	if ($pass==''){
		mysqli_query($koneksi,"UPDATE users SET nama = '$nama',
                           email  = '$email',
						   level  = '$level'  
                           WHERE username       = '$username'");
 header('location:../../index.php?page=user&act=list');
	}else{
mysqli_query($koneksi,"UPDATE users SET nama = '$nama',
                           email  = '$email',
						   pass   =  '$p',
						   level  = '$level'   
                           WHERE username       = '$username'");
 header('location:../../index.php?page=user&act=list');
	}
}
}
?>
