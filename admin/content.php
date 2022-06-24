<?php
include "../koneksi.php";

if ($_GET['module']=='home'){
echo "Selamat Datang"; 
}
elseif ($_GET['module']=='akun'){
  include "modul/akun/akun.php";
}

else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
