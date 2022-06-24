
<?php
ob_start();
session_start();
error_reporting(0);
if ($_SESSION[level] == ''){
	echo "<script>window.alert('Maaf, untuk mengakses halaman ini anda harus login.');
				window.location='../media.php?module=home&home=view'</script>";
}else{
include "../config/fungsi_seo.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin - SISTEM INFORMASI RKAS- STEKOM 2017 </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Robby Prihandaya">
  <meta charset="utf-8">
	<link href="../view/css/bootstrap.min.css" rel="stylesheet">
	<link href="../view/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="../view/css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="../view/img/favicon.png">
		<script src="../view/js/jquery.min.js" type="text/javascript"></script>
	<script src="../view/js/highcharts.js" type="text/javascript"></script>
	<script type="text/javascript" src="../view/js/ga.js"></script>
	<script type="text/javascript" src="../view/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../view/js/jscript_jquery-1.6.4.js"></script>
	<script type="text/javascript" src="../view/js/jquery.validate.js"></script>
	<script type="text/javascript" src="../view/js/jquery-2.1.4.min.js"></script>


	  <script type="text/javascript">
	  $(document).ready(function(){
			$('#registerHere input').hover(function()
			{
			$(this).popover('show')
		});
			$("#registerHere").validate({
				rules:{
					nama_lengkap:"required",
					email:{
							required:true,
							email: true
						},
					no_telp:{
						required:true,
						minlength: 11
					},
					gender:"required"
				},
				messages:{
					nama_lengkap:"Enter your Full Name",
					email:{
						required:"Enter your email address",
						email:"Enter valid email address"
					},
					no_telp:{
						required:"Enter your Phone Number",
						minlength:"Phone Number must be minimum 11 characters"
					},
					gender:"Select Gender"
				},
				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass) {
					$(element).parents('.control-group').addClass('error');
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).parents('.control-group').removeClass('error');
					$(element).parents('.control-group').addClass('success');
				}
			});
		});
	  </script>
<script type="text/javascript">
tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
		theme_advanced_buttons3_add : "emotions,flash",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		apply_source_formatting : true
});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;
		
		var cType;
		tinymcpuk_field = field_name;
		tinymcpuk = win;
		
		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}
		
		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}
		
		window.open(connector, "tinymcpuk", "modal,width=600,height=400");
	}
</script>
	<script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
	<script src="../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>
<style>
table {
	border: 1px solid #e3e3e3;
	background-color:#fff !important;
}
</style>	
</head>
<script type="text/javascript"> 
		$(function(){
			// this will get the full URL at the address bar
			var url = window.location.href; 

			// passes on every "a" tag 
			$(".container-fluid a").each(function() {
					// checks if its the same on the address bar
				if(url == (this.href)) { 
					$(this).closest("li").addClass("active");
				}
			});
		});

	</script>

<body>
<div style='padding-top:2%;' class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
		<img style="margin-bottom:2px; width:100%" src="../images/headersma.jpg" />
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> 
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<ul class="nav">
							<?php 
								if ($_SESSION[level] == 'kepala'){
									if ($_SESSION[status]=='1'){
										$keterangans = 'Kepala';
									}else{
										$keterangans = 'Komite';
									}
							?>
								<li><a href="#"> Selamat Datang - <b style='color:red'><?php echo "$keterangans"; ?> Sekolah</b></a></li>
								<li><a href="?module=hpage"><i class="icon-home icon-black"></i> Home</a></li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-book icon-black"></i> Laporan<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<!--<li><a href="?module=kegiatan&status=0&lap=1">Laporan Data Kegiatan Baru</a></li>
										<li><a href="?module=kegiatan&status=1&lap=1">Laporan Data Kegiatan</a></li>-->
										<li><a href="?module=pendapatan&lap=1">Laporan Pendapatan</a></li>
										<li><a href="?module=rencana&lap=1">Laporan RKAS</a></li>
										<li><a href="?module=realisasi&status=1&lap=1">Laporan Realisasi RKAS</a></li>
										<li><a href="print-triwulan.php" target="_blank">Laporan Triwulan</a></li>
									</ul>
								</li>
							<?php
								}elseif ($_SESSION[level] == 'komite'){
							?>
								<li><a href="#"> Selamat Datang - <b style='color:red'><?php echo "$_SESSION[namalengkap]"; ?></b></a></li>
								<li><a href="?module=hpage"><i class="icon-home icon-black"></i> Home</a></li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-book icon-black"></i> Laporan<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<!--<li><a href="?module=kegiatan&status=0&lap=1">Laporan Data Kegiatan Baru</a></li>
										<li><a href="?module=kegiatan&status=1&lap=1">Laporan Data Kegiatan</a></li>-->
										<li><a href="?module=pendapatan&lap=1">Laporan Pendapatan</a></li>
										<li><a href="?module=rencana&lap=1">Laporan RKAS</a></li>
										<li><a href="?module=realisasi&status=1&lap=1">Laporan Realisasi RKAS</a></li>
										<li><a href="print-triwulan.php" target="_blank">Laporan Triwulan</a></li>
									</ul>
								</li>
							<?php
								}elseif ($_SESSION[level] == 'tu'){
							?>
								
								<li><a href="#"> Selamat Datang - <b style='color:red'><?php echo "$_SESSION[namalengkap]"; ?></b></a></li>
								<li><a href="?module=hpage"><i class="icon-home icon-black"></i> Home</a></li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th-large icon-black"></i> Admisi<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li><a href="?module=tpendapatan"> Transaksi Pendapatan</a></li>
										<li><a href="?module=rencana&status=0"> Input RKAS</a></li>
										<li><a href="?module=realisasi&status=0"> Input Realisasi RKAS</a></li>
									</ul>
								</li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-book icon-black"></i> Laporan<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li><a href="?module=rencana&lap=1">Laporan RKAS</a></li>
										<li><a href="?module=realisasi&status=1&lap=1">Laporan Realisasi RKAS</a></li>
										<li><a href="?module=pendapatan&lap=1">Laporan Pendapatan</a></li>
										<li><a href="print-triwulan.php" target="_blank">Laporan Triwulan</a></li>
									</ul>
								</li>

								
							<?php
								}else{
							?>
								<li><a href="?module=hpage"><i class="icon-home icon-black"></i> Home</a></li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user icon-black"></i> Tentang Kami<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li><a href="?module=hpage&act=beranda"> Home</a></li>
										<li><a href="?module=hpage&act=profile"> Profile</a></li>
										<li><a href="?module=hpage&act=visimisi"> Visi Misi</a></li>
										<!-- <li><a href="?module=hpage&act=sejarah"> Sejarah</a></li> -->
										
									</ul>
								</li>
								
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th-list icon-black"></i> Pengelolaan Data<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li><a href="?module=kategori&status=0"> Seting Kategori</a></li>
										<li><a href="?module=sub_kategori&status=0"> Seting Sub-Kategori</a></li>
										<li><a href="?module=kegiatan"> Seting Kegiatan</a></li>
										<li><a href="?module=rincian"> Seting Rincian Kegiatan</a></li>
										<li><a href="?module=pendapatan"> Seting Pendapatan</a></li>
										<li><a href="?module=kepwaka"> Seting Pengguna</a></li>
										
									</ul>
								</li>

								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th icon-black"></i> Peralatan<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li><a href="?module=printer">Setting Header Print</a></li>
										
									</ul>
								</li>

								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-book icon-black"></i> Laporan<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<!--<li><a href="?module=kegiatan&status=0&lap=1">Laporan Data Kegiatan Baru</a></li>
										<li><a href="?module=kegiatan&status=1&lap=1">Laporan Data Kegiatan</a></li>-->
										<!--
										<li><a href="?module=spi&lap=1">Laporan Master SPI</a></li>
										-->
										<li><a href="?module=pendapatan&lap=1">Laporan Pendapatan</a></li>
										<li><a href="?module=rencana&lap=1">Laporan RKAS</a></li>
										<li><a href="print-triwulan.php" target="_blank">Laporan Triwulan</a></li>
										<li><a href="?module=realisasi&status=1&lap=1">Laporan Realisasi RKAS</a></li>
									</ul>
								</li>

							<?php } ?>
							</ul>
							<ul class="nav pull-right">
<li><a href="../logout.php">Keluar</a></li>
								<li class="dropdown">
									 <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Selamat Datang! <?php echo "<b style='color:red'>$_SESSION[namalengkap]</b>"; ?><strong class="caret"></strong></a>
									<ul class="dropdown-menu">
									<?php if ($_SESSION[level] == 'guru'){ ?>
										<li><a href="?module=guru&act=editguru&id=<?php echo $_SESSION[id_user]; ?>">Setting Account</a></li>
									<?php }else{ ?>
										<li><a href="?module=home&id_user=1">Ganti Password</a></li>
									<?php } ?>
										
									</ul>
								</li>

							</ul>
						</div>
					</div>
				</div>
			</div>			
			<div class="row-fluid">
				<div class="span12">
				<?php include "content.php"; ?>
				</div>
			</div><br>
			<center style='background:#0282af; padding:10px; color:#fff; font-size:12px; margin-bottom:3px; border-top:5px solid #000'>
			<b> Sistem Informasi RKAS- STEKOM 2017 </b>
		</center>
		</div>
	</div>
</div>

<div id="myAbsen" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Pilih Tahun Ajaran dan Semester</h3>
  </div>
  <?php echo "<form action='media.php' method='GET' id='registerHere' class='form-horizontal'>"; ?>
	  <div class="modal-body">
	  
		<p>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Tahun Ajaran</label>
					<div class="controls">
					  <input type='hidden' name='module' value='absenguru'>
					  <input type='text' name='tahun'>
					</div>
				  </div>
				  
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Semester</label>
					<div class="controls">
					  <input type='text' name='semester'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" value='Lihat Absensi'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>

<div id="myPredikat" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Predikat Nilai</h3>
  </div>
  <form action='media.php?module=predikat' method='POST' id='registerHere' class='form-horizontal'>
	  <div class="modal-body">
	  
		<p>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nilai a</label>
					<div class="controls">
					  <input type='text' style='width:80px' name='a'>
					</div>
				  </div>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nilai b</label>
					<div class="controls">
					  <input type='text' style='width:80px' name='b'>
					</div>
				  </div>
				  
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Grade</label>
					<div class="controls">
					  <input type='text' name='c'>
					</div>
				  </div>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Keterangan</label>
					<div class="controls">
					  <input type='text' name='d'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submitt' name='harian' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>

<div id="myHarian" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Nilai Harian</h3>
  </div>
  <?php echo "<form action='media.php?module=nilai&act=tampilsiswa&id=$_GET[id]&tahun=$_GET[tahun]&semester=$_GET[semester]&pelajaran=$_GET[pelajaran]' method='POST' id='registerHere' class='form-horizontal'>"; ?>
	  <div class="modal-body">
	  
		<p>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nilai</label>
					<div class="controls">
					  <input type="hidden" name="bookId" id="bookId" value=""/>
					  <input type="hidden" name="status" value="H"/>
					  <input type='text' style='width:80px' name='kode'>
					</div>
				  </div>
				  
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Keterangan</label>
					<div class="controls">
					  <input type='text' name='mapel'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submitt' name='harian' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>

<div id="myTugas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Nilai Tugas</h3>
  </div>
  <?php echo "<form action='media.php?module=nilai&act=tampilsiswa&id=$_GET[id]&tahun=$_GET[tahun]&semester=$_GET[semester]&pelajaran=$_GET[pelajaran]' method='POST' id='registerHere' class='form-horizontal'>"; ?>
	  <div class="modal-body">
	  
		<p>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nilai</label>
					<div class="controls">
					  <input type="hidden" name="bookId" id="bookId" value=""/>
					  <input type="hidden" name="status" value="T"/>
					  <input type='text' style='width:80px' name='kode'>
					</div>
				  </div>
				  
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Keterangan</label>
					<div class="controls">
					  <input type='text' name='mapel'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submitt' name='harian' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>

<div id="myKategori" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Kategori</h3>
  </div>
  <?php echo "<form action='media.php?module=kategori' method='POST' id='registerHere' class='form-horizontal'>";
  $th=date(Y);
   ?>
	  <div class="modal-body">
	  
		<p>		  
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Kode Kategori</label>
					<div class="controls">
					  <input type='text' name='kode'>
					</div>
				  </div>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama</label>
					<div class="controls">
					  <input type='text' name='nama'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submit' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>

<div id="mypendapatan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Setting Pendapatan</h3>
  </div>
  <?php echo "<form action='media.php?module=pendapatan' method='POST' id='registerHere' class='form-horizontal'>";
  $th=date(Y);
   ?>
	  <div class="modal-body">
	  
		<p>		  
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Kode Pendapatan</label>
					<div class="controls">
					  <input type='text' name='kode'>
					</div>
				  </div>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama Pendapatan</label>
					<div class="controls">
					  <input type='text' name='nama'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submit' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>

<div id="mytpendapatan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Transaksi Pendapatan</h3>
  </div>
  <?php echo "<form action='media.php?module=tpendapatan' method='POST' id='transaksi_pendapatan' class='form-horizontal'>";
  $th=date(Y);
   ?>
	  <div class="modal-body">
	  
		<p>		 
			<div style='margin:7px' class="control-group">
				<label class="control-label" for="inputEmail">Pendapatan</label>
				<div class="controls">
				  <select name='kd_pendp'>
					<option value='0' selected>- Pilih Pendapatan -</option>
					<?php 
						$query = mysql_query("SELECT * FROM trans_pendapatan INNER JOIN pendapatan ON pendapatan.kode=trans_pendapatan.kd_pendp");
						while($dt = mysql_fetch_array($query)){
							echo "<option value='$dt[kode]'>$dt[nama]</option>";
						}
					?>
				  </select>
				</div>
			</div> 
			<div style='margin:7px' class="control-group">
				<label class="control-label" for="inputEmail">Tahun</label>
				<div class="controls">
				  <input type='text' name='tahun'>
				</div>
			</div>
			<div style='margin:7px' class="control-group">
				<label class="control-label" for="inputEmail">Tanggal</label>
				<div class="controls">
				  <input type='date' name='tgl'>
				</div>
			</div>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Jumlah Pendapatan</label>
					<div class="controls">
					  <input type='text' name='jml'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submit' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>

<div id="mysubkategori" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Kategori</h3>
  </div>
  <?php echo "<form action='media.php?module=sub_kategori' method='POST' id='registerHere' class='form-horizontal'>";
  $th=date(Y);
   ?>
	  <div class="modal-body">
	  
		<p>		  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama Kategori</label>
					<div class="controls">
					  <select name='id_kategori'>
						<option value='0' selected>- Pilih Kategori -</option>
						<?php 
							$guru = mysql_query("SELECT * FROM kategori");
							while($g = mysql_fetch_array($guru)){
								echo "<option value='$g[kode]'>$g[nama]</option>";
							}
						?>
					  </select>
					</div>
				  </div>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Kode Kategori</label>
					<div class="controls">
					  <input type='text' name='kode'>
					</div>
				  </div>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama</label>
					<div class="controls">
					  <input type='text' name='nama'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submit' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>
<div id="mykegiatan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Kegiatan</h3>
  </div>
  <?php echo "<form action='media.php?module=kegiatan' method='POST' id='registerHere' class='form-horizontal'>";
  $th=date(Y);
   ?>
	  <div class="modal-body">
	  
		<p>		  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama Sub-Kategori</label>
					<div class="controls">
					  <select name='id_kategori'>
						<option value='0' selected>- Pilih Sub-Kategori -</option>
						<?php 
							$guru = mysql_query("SELECT * FROM sub_kategori");
							while($g = mysql_fetch_array($guru)){
								echo "<option value='$g[kode]'>$g[nama]</option>";
							}
						?>
					  </select>
					</div>
				  </div>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Kode Kegiatan</label>
					<div class="controls">
					  <input type='text' name='kode'>
					</div>
				  </div>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama Kegiatan</label>
					<div class="controls">
					  <input type='text' name='nama'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submit' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>
<div id="myrincian" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Rincian Kegiatan</h3>
  </div>
  <?php echo "<form action='media.php?module=rincian' method='POST' id='registerHere' class='form-horizontal'>";
  $th=date(Y);
   ?>
	  <div class="modal-body">
	  
		<p>		  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama Kegiatan</label>
					<div class="controls">
					  <select name='id_kegiatan'>
						<option value='0' selected>- Pilih Kegiatan -</option>
						<?php 
							$guru = mysql_query("SELECT * FROM kegiatan");
							while($g = mysql_fetch_array($guru)){
								echo "<option value='$g[kode]'>$g[nama]</option>";
							}
						?>
					  </select>
					</div>
				  </div>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Kode Rincian Kegiatan</label>
					<div class="controls">
					  <input type='text' name='kode'>
					</div>
				  </div>

				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama Rincian Kegiatan</label>
					<div class="controls">
					  <input type='text' name='nama'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submit' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>


<div id="myKelas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah - Kelas Baru</h3>
  </div>
  <?php echo "<form action='media.php?module=kelas' method='POST' id='registerHere' class='form-horizontal'>"; ?>
	  <div class="modal-body">
	  
		<p>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Kode Kelas</label>
					<div class="controls">
					  <input type='text' name='a'>
					</div>
				  </div>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama Guru</label>
					<div class="controls">
					  <select name='b'>
						<option value='0' selected>- Pilih Guru -</option>
						<?php 
							$guru = mysql_query("SELECT * FROM rb_guru");
							while($g = mysql_fetch_array($guru)){
								echo "<option value='$g[nip]'>$g[nama]</option>";
							}
						?>
					  </select>
					</div>
				  </div>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Nama Kelas</label>
					<div class="controls">
					  <input type='text' name='c'>
					</div>
				  </div>
				  <div style='margin:7px' class="control-group">
					<label class="control-label" for="inputEmail">Jumlah Siswa</label>
					<div class="controls">
					  <input type='text' name='d'>
					</div>
				  </div>
		</p>
		
	  </div>
	  <div class="modal-footer">
		<input type='submit' class="btn btn-primary" name='submit' value='Tambahkan'>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>
  </form>
</div>


</body>
</html>

<script type="text/javascript" src="../view/js/table_filter.js"></script>
<script type="text/javascript">
    (function($) {
        var table = $('#twitter-table');
        var index = 2;
        var input = $('#filter');

        zFilter.setup(input, table, index);

    })(jQuery);
</script>

<?php 
}
?>