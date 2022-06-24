<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title></title>
</head>

<body>
<?php
function month($month, $format = "mmmm"){
  if($format == "mmmm"){
    $fm = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
  }elseif($format == "mmm"){
    $fm = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
  }
  
  return $fm[$month-1];
}
function day($day, $format = "dddd"){
  if($format == "dddd"){
    $fd = array("Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");
  }elseif($format == "ddd"){
    $fd = array("Sen","Sel","Rab","Kam","Jum","Sab","Min");
  }
  
  return $fd[$day-1];
}
?>

  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class="glyphicon glyphicon-ok-sign" style="color:white;"></i><span> Signed in as <?php echo $nm_log; ?> on <?php echo day(date("N")).", ".date("d")." ".month(date("n"))." ".date("Y"); ?></span>
  </div>
  <div class="container-fluid" style="margin-top: -20px;;">
    <h2>Selamat Datang</h2>
    
  <br>
  <div class="row">
  <div class="col-sm-6 col-md-3">
    <div class="thumbnail" style="background-color:#99D2EA;">
      <img src="img/bb.png" alt="..." style="width:100px; margin-top:10px;">
      <div class="caption">
        <h4>BAHAN BAKU</h4>
        <?php
        $data_bb = mysqli_query($koneksi,"SELECT * FROM bahan_baku");
        $jumlah_barang = mysqli_num_rows($data_bb);
         ?>
        <p>Data bahan baku: <b><?php echo $jumlah_barang; ?></b></p>
        <!-- <p><a href="index.php?page=bb&act=list" class="btn btn-primary" role="button">Data</a> <a href="index.php?page=stok_bb&act=list" class="btn btn-default" role="button">Persediaan</a></p> -->
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
  <div class="thumbnail" style="background-color:#FBCAC5;">
      <img src="img/bp.png" alt="..." style="width:120px; margin-top:10px;">
      <div class="caption">
        <h4>BAHAN PENOLONG</h4>
        <?php
        $data_bp = mysqli_query($koneksi,"SELECT * FROM bahan_penolong");
        $bp = mysqli_num_rows($data_bp);
         ?>
        <p>Data bahan penolong: <b><?php echo $bp; ?></b></p>
        <!-- <p><a href="index.php?page=bp&act=list" class="btn btn-primary" role="button">Data</a> <a href="index.php?page=stok_bp&act=list" class="btn btn-default" role="button">Persediaan</a></p> -->
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
  <div class="thumbnail" style="background-color:#F5C566;">
      <img src="img/tenaker.png" alt="..." style="width:90px; margin-top:10px;">
      <div class="caption">
        <h4>TENAGA KERJA</h4>
        <?php
        $tenaker = mysqli_query($koneksi,"SELECT * FROM tenaker");
        $jml = mysqli_num_rows($tenaker);
         ?>
        <p>Data tenaker: <b><?php echo $jml; ?></b></p>
        <!-- <p><a href="index.php?page=tenaker&act=list" class="btn btn-primary" role="button">Data</a> <a href="index.php?page=tenaker&act=list2" class="btn btn-default" role="button">Pendapatan</a></p> -->
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
  <div class="thumbnail" style="background-color:#CAFF85;">
      <img src="img/op.png" alt="..." style="width:100px; margin-top:10px;">
      <div class="caption">
        <h4>OVERHEAD PABRIK</h4>
        <?php
        $op = mysqli_query($koneksi,"SELECT * FROM overhead_pabrik");
        $jml_op = mysqli_num_rows($op);
         ?>
        <p>Data overhead pabrik: <b><?php echo $jml_op; ?></b></p>
        <!-- <p><a href="index.php?page=overhead&act=list" class="btn btn-primary" role="button">Data</a> </p> -->
      </div>
    </div>
  </div>
</div>
</div>

</body>

</html>