<?php
session_start();
include "koneksi.php";
$tgl=date('d');
if($tgl=='01'){
mysql_query("UPDATE kredit SET bayar  = '0'
                           WHERE status       = '1'");
}