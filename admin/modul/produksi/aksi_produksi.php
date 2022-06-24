<?php
function month($month, $format = "mmmm"){
	if($format == "mmmm"){
	$fm = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	}
	return $fm[$month-1];
}
?>
<?php
session_start();
include "../../koneksi.php";

$module=$_GET['page'];
$act=$_GET['act'];
$nm_produk=$_POST['nm_produk'];
$jml_produksi=$_POST['jml_produksi'];
$nmr_produksi=time();
$tgl_produksi=date('Y-m-d');
$tahun=date('Y');
$periode=month(date("n"));
$kd_bb=$_POST['kd_bb'];
$kd_bp=$_POST['kd_bp'];
$id_tenaker=$_POST['id_tenaker'];
$kd_overp=$_POST['kd_overp'];
$nmr=$_POST['nmr'];
$jml=$_POST['jml'];


if ($module=='aksi_produksi' AND $act=='tambah'){
	$tampil = mysqli_query($koneksi,"SELECT * FROM produksi where nm_produk='$nm_produk' and periode='$periode' and tahun='$tahun'");
	$hasil=mysqli_num_rows($tampil);
	if ($hasil>=1){
	echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";	
	}else{
    mysqli_query($koneksi,"insert into produksi values('','$nmr_produksi','$nm_produk','$jml_produksi','0','0','0','0','0','$tgl_produksi','$periode','$tahun')");
	header('location:../../index.php?page=produksi&act=list');
}}
// ----------------------------------------------------------------------------------------Aksi BBB
elseif($module=='aksi_produksi' AND $act=='bbb'){
	$tampilbb = mysqli_query($koneksi,"SELECT * FROM detail_produksi where nmr_produksi='$nmr' and kode='$kd_bb");
	$hasilbb=mysqli_num_rows($tampilbb);
	if ($hasilbb>=1){
		echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
	}else{
$tampilbbb = mysqli_query($koneksi,"SELECT * FROM bahan_baku where kd_bb='$kd_bb'");
$rowbbb =  mysqli_fetch_assoc($tampilbbb);
$kode= $rowbbb['kd_bb'];
$nama= $rowbbb['nm_bb'];
$harga= $rowbbb['hrg_bb'];
$keterangan= $rowbbb['satuan_bb'];
$total=$jml*$harga;
	mysqli_query($koneksi,"insert into detail_produksi values('$tgl_produksi','$nmr','$jml','$kode','$nama','$harga','$keterangan','$jml','$total','BBB')");
	mysqli_query($koneksi,"UPDATE produksi SET bbb = bbb + '$total', hpp = hpp + '$total'  WHERE nmr_produksi = '$nmr'");
	mysqli_query($koneksi,"UPDATE persediaan_bahan_baku SET tgl_pb='$tgl_produksi', stok_pb = stok_pb - '$jml'  WHERE kd_pb = '$kode'");
	echo "<script>alert('Data Berhasil Ditambah');history.go(-1);</script>";}
}
elseif($module=='aksi_produksi' AND $act=='hapusbbb'){
$tampilbbb2 = mysqli_query($koneksi,"SELECT * FROM detail_produksi where nmr_produksi='$_GET[id]' and kode='$_GET[id2]'");
$rowbbb2 =  mysqli_fetch_assoc($tampilbbb2);
$nmr= $rowbbb2['nmr_produksi'];
$kode= $rowbbb2['kode'];
$jml= $rowbbb2['jml_produksi'];
$harga= $rowbbb2['harga'];
$total= $jml* $harga;
	mysqli_query($koneksi,"UPDATE persediaan_bahan_baku SET tgl_pb='$tgl_produksi', stok_pb = stok_pb + '$jml'  WHERE kd_pb = '$kode'");
	mysqli_query($koneksi,"UPDATE produksi SET bbb = bbb - '$total', hpp = hpp - '$total'  WHERE nmr_produksi = '$nmr'");
	mysqli_query($koneksi,"DELETE FROM detail_produksi WHERE nmr_produksi='$_GET[id]' and kode='$_GET[id2]'");
	echo "<script>alert('Data Berhasil Dihapus');history.go(-1);</script>";
}


// ----------------------------------------------------------------------------------------Aksi BBP
elseif($module=='aksi_produksi' AND $act=='bbp'){
	$tampilbp = mysqli_query($koneksi,"SELECT * FROM detail_produksi where nmr_produksi='$nmr' and kode='$kd_bp");
	$hasilbp=mysqli_num_rows($tampilbp);
	if ($hasilbp>=1){
		echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
	}else{
$tampilbbp = mysqli_query($koneksi,"SELECT * FROM bahan_penolong where kd_bp='$kd_bp'");
$rowbbp =  mysqli_fetch_assoc($tampilbbp);
$kode= $rowbbp['kd_bp'];
$nama= $rowbbp['nm_bp'];
$harga= $rowbbp['hrg_bp'];
$keterangan= $rowbbp['satuan_bp'];
$total=($jml/20)*$harga;
$jml2=$jml/20;
	mysqli_query($koneksi,"insert into detail_produksi values('$tgl_produksi','$nmr','$jml','$kode','$nama','$harga','$keterangan','$jml2','$total','BBP')");
	mysqli_query($koneksi,"UPDATE produksi SET bbp = bbp + '$total', hpp = hpp + '$total'  WHERE nmr_produksi = '$nmr'");
	mysqli_query($koneksi,"UPDATE persediaan_bahan_penolong SET tgl_pb='$tgl_produksi', stok_pb = stok_pb - '$jml2'  WHERE kd_pb = '$kode'");
	echo "<script>alert('Data Berhasil Ditambah');history.go(-1);</script>";}
}
elseif($module=='aksi_produksi' AND $act=='hapusbbp'){
$tampilbbp2 = mysqli_query($koneksi,"SELECT * FROM detail_produksi where nmr_produksi='$_GET[id]' and kode='$_GET[id2]'");
$rowbbp2 =  mysqli_fetch_assoc($tampilbbp2);
$nmr= $rowbbp2['nmr_produksi'];
$kode= $rowbbp2['kode'];
$jml= $rowbbp2['jml_produksi'];
$harga= $rowbbp2['harga'];
$total=($jml/20)*$harga;
$jml2=$jml/20;
	mysqli_query($koneksi,"UPDATE persediaan_bahan_penolong SET tgl_pb='$tgl_produksi', stok_pb = stok_pb + '$jml2'  WHERE kd_pb = '$kode'");
	mysqli_query($koneksi,"UPDATE produksi SET bbp = bbp - '$total', hpp = hpp - '$total'  WHERE nmr_produksi = '$nmr'");
	mysqli_query($koneksi,"DELETE FROM detail_produksi WHERE nmr_produksi='$_GET[id]' and kode='$_GET[id2]'");
	echo "<script>alert('Data Berhasil Dihapus');history.go(-1);</script>";
}

// ----------------------------------------------------------------------------------------Aksi BTK
elseif($module=='aksi_produksi' AND $act=='btk'){
	$tampilbtk = mysqli_query($koneksi,"SELECT * FROM detail_produksi where nmr_produksi='$nmr' and kode='$id_btk");
	$hasilbtk=mysqli_num_rows($tampilbtk);
	if ($hasilbp>=1){
		echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
	}else{
$tampilbtk = mysqli_query($koneksi,"SELECT * FROM tenaker where id_tenaker='$id_tenaker'");
$rowbtk =  mysqli_fetch_assoc($tampilbtk);
$kode= $rowbtk['id_tenaker'];
$nama= $rowbtk['nm_tenaker'];
$harga= $rowbtk['upah_tenaker'];
$keterangan= $rowbtk['bag_tenaker'];
$total=$jml*$harga;
	mysqli_query($koneksi,"insert into detail_produksi values('$tgl_produksi','$nmr','$jml','$kode','$nama','$harga','$keterangan','$jml','$total','BTK')");
	mysqli_query($koneksi,"UPDATE produksi SET btk = btk + '$total', hpp = hpp + '$total'  WHERE nmr_produksi = '$nmr'");
	mysqli_query($koneksi,"UPDATE tenaker SET ttl_pendapatan='$total' WHERE id_tenaker = '$kode'");
	echo "<script>alert('Data Berhasil Ditambah');history.go(-1);</script>";}
}
elseif($module=='aksi_produksi' AND $act=='hapusbtk'){
$tampilbtk2 = mysqli_query($koneksi,"SELECT * FROM detail_produksi where nmr_produksi='$_GET[id]' and kode='$_GET[id2]'");
$rowbtk2 =  mysqli_fetch_assoc($tampilbtk2);
$nmr= $rowbtk2['nmr_produksi'];
$kode= $rowbtk2['kode'];
$jml= $rowbtk2['jml_produksi'];
$harga= $rowbtk2['harga'];
$total=$jml*$harga;
	mysqli_query($koneksi,"UPDATE tenaker SET ttl_pendapatan='0' WHERE id_tenaker = '$kode'");
	mysqli_query($koneksi,"UPDATE produksi SET btk = btk - '$total', hpp = hpp - '$total'  WHERE nmr_produksi = '$nmr'");
	mysqli_query($koneksi,"DELETE FROM detail_produksi WHERE nmr_produksi='$_GET[id]' and kode='$_GET[id2]'");
	echo "<script>alert('Data Berhasil Dihapus');history.go(-1);</script>";
}

// ----------------------------------------------------------------------------------------Aksi BOP
elseif($module=='aksi_produksi' AND $act=='bop'){
	$tampilbop = mysqli_query($koneksi,"SELECT * FROM detail_produksi where nmr_produksi='$nmr' and kode='$kd_overp");
	$hasilbop=mysqli_num_rows($tampilbop);
	if ($hasilbop>=1){
		echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
	}else{
$tampilbop = mysqli_query($koneksi,"SELECT * FROM overhead_pabrik where kd_overp='$kd_overp'");
$rowbop =  mysqli_fetch_assoc($tampilbop);
$kode= $rowbop['kd_overp'];
$nama= $rowbop['nm_overp'];
$harga= $rowbop['by_overp'];
$total=($harga/$jml)*0.1;
	mysqli_query($koneksi,"insert into detail_produksi values('$tgl_produksi','$nmr','$jml','$kode','$nama','$harga','10%','$jml','$total','BOP')");
	mysqli_query($koneksi,"UPDATE produksi SET bop = bop + '$total', hpp = hpp + '$total'  WHERE nmr_produksi = '$nmr'");
	echo "<script>alert('Data Berhasil Ditambah');history.go(-1);</script>";}
}
elseif($module=='aksi_produksi' AND $act=='hapusbop'){
$tampolbop2 = mysqli_query($koneksi,"SELECT * FROM detail_produksi where nmr_produksi='$_GET[id]' and kode='$_GET[id2]'");
$rowbop2 =  mysqli_fetch_assoc($tampolbop2);
$nmr= $rowbop2['nmr_produksi'];
$kode= $rowbop2['kode'];
$jml= $rowbop2['jml_produksi'];
$harga= $rowbop2['harga'];
$total=($harga/$jml)*0.1;
	mysqli_query($koneksi,"UPDATE produksi SET bop = bop - '$total', hpp = hpp - '$total'  WHERE nmr_produksi = '$nmr'");
	mysqli_query($koneksi,"DELETE FROM detail_produksi WHERE nmr_produksi='$_GET[id]' and kode='$_GET[id2]'");
	echo "<script>alert('Data Berhasil Dihapus');history.go(-1);</script>";
}
?>