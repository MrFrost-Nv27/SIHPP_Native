<?php
function month($month, $format = "mmmm")
{
	if ($format == "mmmm") {
		$fm = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	}
	return $fm[$month - 1];
}
?>
<?php
session_start();
include "../../koneksi.php";

$module = $_GET['page'];
$act = $_GET['act'];
$nm_produk = $_POST['nm_produk'] ?? '';
$jml_produksi = $_POST['jml_produksi'] ?? 0;

$nmr_produksi = time();
$tgl_produksi = date('Y-m-d');
$tahun = date('Y');
$periode = month(date("n"));

$kd_bb = $_POST['kd_bb'] ?? '';
$kd_bp = $_POST['kd_bp'] ?? '';
$id_tenaker = $_POST['id_tenaker'] ?? '';
$kd_overp = $_POST['kd_overp'] ?? '';
$nmr = $_POST['nmr'] ?? '';
$jml = $_POST['jml'] ?? '';

if ($module == 'aksi_produksi' and $act == 'tambah') {
	$tampil = mysqli_query($koneksi, "SELECT * FROM produksi where nm_produk='$nm_produk' and periode='$periode' and tahun='$tahun'");
	$hasil = mysqli_num_rows($tampil);
	if ($hasil >= 1) {
		echo "<script>alert('Data Sudah Ada!');history.go(-1);</script>";
	} else {
		mysqli_query($koneksi, "insert into produksi values('','$nmr_produksi','$nm_produk','$jml_produksi','0','0','0','0','0','$tgl_produksi','$periode','$tahun')");
		header('location:../../index.php?page=produksi&act=list');
	}
}
// ----------------------------------------------------------------------------------------Aksi BBB
elseif ($module == 'aksi_produksi' and $act == 'bbb') {
	$data = mysqli_query($koneksi, "SELECT * FROM bahan_baku INNER JOIN persediaan_bahan_baku ON persediaan_bahan_baku.kd_pb=bahan_baku.kd_bb where kd_bb='$kd_bb'");
	$hasil = mysqli_num_rows($data);
	$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM detail_produksi where kode='$kd_bb' AND nmr_produksi = '$nmr'"));
	if ($hasil > 0) {
		if ($cek > 0) {
			echo "<script>alert('Bahan Baku Sudah Pernah ditambahkan');history.go(-1);</script>";
		} else {
			$rowbbb =  mysqli_fetch_assoc($data);
			$kode = $rowbbb['kd_bb'];
			$nama = $rowbbb['nm_bb'];
			$harga = $rowbbb['hrg_bb'];
			$keterangan = $rowbbb['satuan_bb'];
			$total = $jml * $harga;
			if ($rowbbb['stok_pb'] < $jml) {
				echo "<script>alert('Stok Bahan Tidak Mencukupi!');history.go(-1);</script>";
			} else {
				mysqli_query($koneksi, "insert into detail_produksi values('$tgl_produksi','$nmr','$jml_produksi','$kode','$nama','$harga','$keterangan','$jml','$total','BBB')");
				mysqli_query($koneksi, "UPDATE produksi SET bbb = bbb + '$total', hpp = hpp + '$total' WHERE nmr_produksi = '$nmr'");
				mysqli_query($koneksi, "UPDATE persediaan_bahan_baku SET tgl_pb='$tgl_produksi', stok_pb = stok_pb - '$jml' WHERE kd_pb = '$kode'");
				echo "<script>alert('Data Berhasil Ditambah');history.go(-1);</script>";
			}
		}
	} else {
		echo "<script>alert('Data Tidak Tersedia!');history.go(-1);</script>";
	}
} elseif ($module == 'aksi_produksi' and $act == 'hapusbbb') {
	$data = mysqli_query($koneksi, "SELECT * FROM detail_produksi where nmr_produksi='$_GET[id]' and kode='$_GET[kd]'");
	$hasil = mysqli_num_rows($data);
	if ($hasil > 0) {
		$row =  mysqli_fetch_assoc($data);
		$nmr = $row['nmr_produksi'];
		$kode = $row['kode'];
		$jml = $row['jml_produksi'];
		$stok = $row['jumlah'];
		$harga = $row['harga'];
		$total = $stok * $harga;
		mysqli_query($koneksi, "UPDATE persediaan_bahan_baku SET tgl_pb='$tgl_produksi', stok_pb = stok_pb + '$stok' WHERE kd_pb = '$kode'");
		mysqli_query($koneksi, "UPDATE produksi SET bbb = bbb - '$total', hpp = hpp - '$total'  WHERE nmr_produksi = '$nmr'");
		mysqli_query($koneksi, "DELETE FROM detail_produksi WHERE nmr_produksi='$_GET[id]' and kode='$_GET[kd]'");
		echo "<script>alert('Data Berhasil Dihapus');history.go(-1);</script>";
		die;
	} else {
		echo "<script>alert('Data Tidak Tersedia!');history.go(-1);</script>";
	}
}


// ----------------------------------------------------------------------------------------Aksi BBP
elseif ($module == 'aksi_produksi' and $act == 'bbp') {
	$data = mysqli_query($koneksi, "SELECT * FROM bahan_penolong INNER JOIN persediaan_bahan_penolong ON persediaan_bahan_penolong.kd_pb=bahan_penolong.kd_bp where kd_bp='$kd_bp'");
	$hasil = mysqli_num_rows($data);
	$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM detail_produksi where kode='$kd_bp' AND nmr_produksi = '$nmr'"));
	if ($hasil > 0) {
		if ($cek > 0) {
			echo "<script>alert('Bahan Baku Sudah Pernah ditambahkan');history.go(-1);</script>";
		} else {
			$rowbbb =  mysqli_fetch_assoc($data);
			$kode = $rowbbb['kd_bp'];
			$nama = $rowbbb['nm_bp'];
			$harga = $rowbbb['hrg_bp'];
			$keterangan = $rowbbb['satuan_bp'];
			$total = $jml * $harga;
			if ($rowbbb['stok_pb'] < $jml) {
				echo "<script>alert('Stok Bahan Tidak Mencukupi!');history.go(-1);</script>";
			} else {
				mysqli_query($koneksi, "insert into detail_produksi values('$tgl_produksi','$nmr','$jml_produksi','$kode','$nama','$harga','$keterangan','$jml','$total','BBP')");
				mysqli_query($koneksi, "UPDATE produksi SET bbp = bbp + '$total', hpp = hpp + '$total' WHERE nmr_produksi = '$nmr'");
				mysqli_query($koneksi, "UPDATE persediaan_bahan_penolong SET tgl_pb='$tgl_produksi', stok_pb = stok_pb - '$jml' WHERE kd_pb = '$kode'");
				echo "<script>alert('Data Berhasil Ditambah');history.go(-1);</script>";
			}
		}
	} else {
		echo "<script>alert('Data Tidak Tersedia!');history.go(-1);</script>";
	}
} elseif ($module == 'aksi_produksi' and $act == 'hapusbbp') {
	$data = mysqli_query($koneksi, "SELECT * FROM detail_produksi where nmr_produksi='$_GET[id]' and kode='$_GET[kd]'");
	$hasil = mysqli_num_rows($data);
	if ($hasil > 0) {
		$row =  mysqli_fetch_assoc($data);
		$nmr = $row['nmr_produksi'];
		$kode = $row['kode'];
		$jml = $row['jml_produksi'];
		$stok = $row['jumlah'];
		$harga = $row['harga'];
		$total = $stok * $harga;
		mysqli_query($koneksi, "UPDATE persediaan_bahan_penolong SET tgl_pb='$tgl_produksi', stok_pb = stok_pb + '$stok' WHERE kd_pb = '$kode'");
		mysqli_query($koneksi, "UPDATE produksi SET bbp = bbp - '$total', hpp = hpp - '$total'  WHERE nmr_produksi = '$nmr'");
		mysqli_query($koneksi, "DELETE FROM detail_produksi WHERE nmr_produksi='$_GET[id]' and kode='$_GET[kd]'");
		echo "<script>alert('Data Berhasil Dihapus');history.go(-1);</script>";
		die;
	} else {
		echo "<script>alert('Data Tidak Tersedia!');history.go(-1);</script>";
	}
}

// ----------------------------------------------------------------------------------------Aksi BTK
elseif ($module == 'aksi_produksi' and $act == 'btk') {
	$data = mysqli_query($koneksi, "SELECT * FROM tenaker where id_tenaker='$id_tenaker'");
	$hasil = mysqli_num_rows($data);
	$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM detail_produksi where kode='$id_tenaker' AND nmr_produksi = '$nmr' AND lvl='BTK'"));
	if ($hasil > 0) {
		if ($cek > 0) {
			echo "<script>alert('Tenaga Kerja Sudah Pernah ditambahkan');history.go(-1);</script>";
		} else {
			$rowbbb =  mysqli_fetch_assoc($data);
			$kode = $rowbbb['id_tenaker'];
			$nama = $rowbbb['nm_tenaker'];
			$harga = $rowbbb['upah_tenaker'];
			$keterangan = $rowbbb['bag_tenaker'];
			$total = $jml_produksi * $harga;
			mysqli_query($koneksi, "insert into detail_produksi values('$tgl_produksi','$nmr','$jml_produksi','$kode','$nama','$harga','$keterangan','$jml_produksi','$total','BTK')");
			mysqli_query($koneksi, "UPDATE produksi SET btk = btk + '$total', hpp = hpp + '$total' WHERE nmr_produksi = '$nmr'");
			mysqli_query($koneksi, "UPDATE tenaker SET ttl_pendapatan= ttl_pendapatan + $total WHERE id_tenaker = '$kode'");
			echo "<script>alert('Data Berhasil Ditambah');history.go(-1);</script>";
		}
	} else {
		echo "<script>alert('Data Tidak Tersedia!');history.go(-1);</script>";
	}
} elseif ($module == 'aksi_produksi' and $act == 'hapusbtk') {
	$data = mysqli_query($koneksi, "SELECT * FROM detail_produksi where nmr_produksi='$_GET[id]' and kode='$_GET[kd]'");
	$hasil = mysqli_num_rows($data);
	if ($hasil > 0) {
		$row =  mysqli_fetch_assoc($data);
		$nmr = $row['nmr_produksi'];
		$kode = $row['kode'];
		$jml = $row['jml_produksi'];
		$stok = $row['jumlah'];
		$harga = $row['harga'];
		$total = $stok * $harga;
		mysqli_query($koneksi, "UPDATE tenaker SET ttl_pendapatan = ttl_pendapatan - $total WHERE id_tenaker = '$kode'");
		mysqli_query($koneksi, "UPDATE produksi SET btk = btk - '$total', hpp = hpp - '$total'  WHERE nmr_produksi = '$nmr'");
		mysqli_query($koneksi, "DELETE FROM detail_produksi WHERE nmr_produksi='$_GET[id]' and kode='$_GET[kd]' AND lvl='BTK'");
		echo "<script>alert('Data Berhasil Dihapus');history.go(-1);</script>";
		die;
	} else {
		echo "<script>alert('Data Tidak Tersedia!');history.go(-1);</script>";
	}
}

// ----------------------------------------------------------------------------------------Aksi BOP
elseif ($module == 'aksi_produksi' and $act == 'bop') {
	$data = mysqli_query($koneksi, "SELECT * FROM overhead_pabrik where kd_overp='$kd_overp'");
	$hasil = mysqli_num_rows($data);
	$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM detail_produksi where kode='$kd_overp' AND nmr_produksi = '$nmr' AND lvl='BOP'"));
	if ($hasil > 0) {
		if ($cek > 0) {
			echo "<script>alert('Overhead Pabrik Sudah Pernah ditambahkan');history.go(-1);</script>";
		} else {
			$rowbbb =  mysqli_fetch_assoc($data);
			$kode = $rowbbb['kd_overp'];
			$nama = $rowbbb['nm_overp'];
			$harga = $rowbbb['by_overp'];
			$keterangan = $rowbbb['ket_overp'];
			$total = $jml_produksi * $harga;
			mysqli_query($koneksi, "insert into detail_produksi values('$tgl_produksi','$nmr','$jml_produksi','$kode','$nama','$harga','$keterangan','$jml_produksi','$total','BOP')");
			mysqli_query($koneksi, "UPDATE produksi SET bop = bop + '$total', hpp = hpp + '$total' WHERE nmr_produksi = '$nmr'");
			echo "<script>alert('Data Berhasil Ditambah');history.go(-1);</script>";
		}
	} else {
		echo "<script>alert('Data Tidak Tersedia!');history.go(-1);</script>";
	}
} elseif ($module == 'aksi_produksi' and $act == 'hapusbop') {
	$data = mysqli_query($koneksi, "SELECT * FROM detail_produksi where nmr_produksi='$_GET[id]' and kode='$_GET[kd]'");
	$hasil = mysqli_num_rows($data);
	if ($hasil > 0) {
		$row =  mysqli_fetch_assoc($data);
		$nmr = $row['nmr_produksi'];
		$kode = $row['kode'];
		$jml = $row['jml_produksi'];
		$stok = $row['jumlah'];
		$harga = $row['harga'];
		$total = $stok * $harga;
		mysqli_query($koneksi, "UPDATE produksi SET bop = bop - '$total', hpp = hpp - '$total'  WHERE nmr_produksi = '$nmr'");
		mysqli_query($koneksi, "DELETE FROM detail_produksi WHERE nmr_produksi='$_GET[id]' and kode='$_GET[kd]' AND lvl='BOP'");
		echo "<script>alert('Data Berhasil Dihapus');history.go(-1);</script>";
		die;
	} else {
		echo "<script>alert('Data Tidak Tersedia!');history.go(-1);</script>";
	}
}
?>