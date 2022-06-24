<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi                           = "modul/stok_barang_penolong/aksi_stok.php";
switch ($_GET['act']) {

  case "tambah":
    $edit = mysqli_query($koneksi, "SELECT * FROM persediaan_bahan_penolong WHERE kd_pb ='$_GET[id]'");
    while ($r = mysqli_fetch_assoc($edit)) {
      $tgl_pb = $r['tgl_pb'];
      $kd_pb = $r['kd_pb'];
      $nm_pb = $r['nm_pb'];
      $sat_pb = $r['sat_pb'];
      $hrg_pb = $r['hrg_pb'];
      $stok_pb = $r['stok_pb'];
      $tot_pb = $r['tot_pb'];
    }
?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Proses</a></li>
      <li><a href="#">Persediaan Bahan</a></li>
      <li><a href="index.php?page=stok_bp&act=list">Daftar Persediaan Bahan</a></li>
      <li class="active">Edit Data <?php echo $kd_pb; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_stok_bp&act=edit'>
              <input type="hidden" class="form-control" name="kd_pb" value="<?php echo $kd_pb; ?>">
              <input type="hidden" class="form-control" name="hrg_pb" value="<?php echo $hrg_pb; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="satu" class="col-sm-3 control-label">Jumlah Bahan di Gudang</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="stok_pb_asli" placeholder="Jumlah Bahan" value="<?php echo $stok_pb; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="satu" class="col-sm-3 control-label">Tambah Jumlah Bahan</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control" name="stok_pb" placeholder="Jumlah Bahan" value="0">
                  </div>
                </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-15px;">
                <div class="col-sm-10 col-sm-offset-3">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Tambah</button>
                  <a href=index.php?page=stok_bp&act=list><button type="submit" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php

    break;

  case "list":
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Bahan Penolong</a></li>
      <li class="active">Daftar Persediaan Bahan Penolong</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="box-body">
              <?php
              echo '
              <table id = "example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <td><strong>No</strong></td>
                    <td><strong>Tanggal</strong></td>
                    <td><strong>Nama Bahan</strong></td>
                    <td><strong>Harga Satuan</strong></td>
                    <td><strong>Stok</strong></td>
                    <td><strong>Total Harga</strong></td>
                    <td><strong>Aksi</strong></td>
                  </tr>
                </thead>
                <tbody>';
                $p = new Paging;
                $batas = 5;
                $posisi = $p->cariPosisi($batas);
                $sql = mysqli_query($koneksi, "SELECT * FROM persediaan_bahan_penolong ORDER BY tgl_pb desc LIMIT $posisi, $batas");
                $no = $posisi + 1;
                while ($row = mysqli_fetch_assoc($sql)) {
                echo '
                <tr>
                  <td>' . $no . '</td>
                      <td>' . $row['tgl_pb'] . '</td>
                      <td>' . $row['nm_pb'] . '</td>
                      <td>Rp. ' . number_format($row['hrg_pb'], 0, ',', '.') . '</td>
                      <td>'. $row['stok_pb'] .'</td>
                      <td>Rp. ' . number_format($row['tot_pb'], 0, ',', '.') . '</td>
                      <td>';
                echo "
                      <a title = 'Tambah Stok' href=?page=stok_bp&act=tambah&id=$row[kd_pb]><button type='button' class='btn btn-success'><span class='glyphicon glyphicon-plus'></button></a>
                      <a title = 'Lihat Detail' href=?page=stok_bp&act=lihat&id=$row[kd_pb]><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-eye-open'></button></a>
                    </td>";
                echo '
              </tr>';
              $no++;
            }
            $jmldata                    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM persediaan_bahan_penolong"));
            $jmlhalaman                 = $p->jumlahHalaman($jmldata, $batas);
            $linkHalaman                = $p->navHalaman($_GET['halaman'], $jmlhalaman);
              echo '
              </tbody>
              </table>';
              ?>
            </div>
          </div>
          <?php echo "
     <div style                 = 'float:left; position: relative;'>
			  <ul class                  = 'pagination'>
				$linkHalaman
			</ul>
    </div>";
          ?>
        </div>
      </div>
    </div>

  <?php
    break;

  case "lihat":
    $edit = mysqli_query($koneksi, "SELECT * FROM persediaan_bahan_penolong WHERE kd_pb='$_GET[id]'");
    while ($r = mysqli_fetch_assoc($edit)) {
      $tgl_pb = $r['tgl_pb'];
      $kd_pb = $r['kd_pb'];
      $nm_pb = $r['nm_pb'];
      $sat_pb = $r['sat_pb'];
      $hrg_pb = $r['hrg_pb'];
      $stok_pb = $r['stok_pb'];
      $tot_pb = $r['tot_pb'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Bahan Penolong</a></li>
      <li><a href="index.php?page=stok_bp&act=list">Daftar Persediaan Bahan Penolong</a></li>
      <li class="active">Cek Data <?php echo $kd_pb; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <form class='form-horizontal' id='registerHere' method='post' action=''>
              <div class="box-body">
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Tanggal Update Data</label>
                  <div class="col-sm-4">
                  <p class="form-control-static" style="margin-bottom: -15px;">: <?php echo $tgl_pb; ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Kode Bahan</label>
                  <div class="col-sm-4">
                  <p class="form-control-static" style="margin-bottom: -15px;">: <?php echo $kd_pb; ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Nama Bahan</label>
                  <div class="col-sm-4">
                  <p class="form-control-static" style="margin-bottom: -15px;">: <?php echo $nm_pb; ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Satuan Bahan</label>
                  <div class="col-sm-4">
                  <p class="form-control-static" style="margin-bottom: -15px;">: <?php echo $sat_pb; ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Harga Satuan</label>
                  <div class="col-sm-4">
                  <p class="form-control-static" style="margin-bottom: -15px;">: Rp. <?php echo  number_format($hrg_pb, 0, ',', '.') ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Jumlah Bahan</label>
                  <div class="col-sm-4">
                  <p class="form-control-static" style="margin-bottom: -15px;">: <?php echo $stok_pb; ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Total Harga</label>
                  <div class="col-sm-4">
                  <p class="form-control-static">: Rp. <?php echo  number_format($tot_pb, 0, ',', '.') ?></p>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <a href=index.php?page=stok_bp&act=list><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
      </div>
    </div>
<?php
    break;
}
?>