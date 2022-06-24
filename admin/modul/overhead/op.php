<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/overhead/aksi_op.php";
switch ($_GET['act']) {

  case "list":
?>

    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Overhead Pabrik</a></li>
      <li class="active">Daftar Overhead Pabrik</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <a href=index.php?page=overhead&act=tambah><button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Tambah</button></a>
            <hr>
            <div class="box-body">
              <?php
              echo "<table id = 'example1' class='table table-bordered table-striped'>";
              echo "<thead><tr>
          <th>No</th>
          <th>Overhead Pabrik</th>
					<th>Biaya</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr></thead><tbody>";
              $p = new Paging;
              $batas = 4;
              $posisi = $p->cariPosisi($batas);
              $tampil = mysqli_query($koneksi, "SELECT * FROM overhead_pabrik LIMIT $posisi, $batas ");
              $no                         = $posisi + 1;
              while ($r = mysqli_fetch_assoc($tampil)) {
                echo '<tr><td>' . $no . '</td>
                <td>' . $r['nm_overp'] . '</td>
                <td>Rp. ' . number_format($r['by_overp'], 0, ',', '.') . '</td>
                <td>' . $r['ket_overp'] . '</td>';
                echo "
                <td>
					<a title = 'Edit Data' href=?page=overhead&act=edit&id=$r[id_overp]><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></button></a>
					<a title = 'Hapus Data' href=$aksi?page=aksi_op&act=hapus&id=$r[id_overp]><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></button></a>
        </td></tr>";
                $no++;
              }
              $jmldata                    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM overhead_pabrik"));
              $jmlhalaman                 = $p->jumlahHalaman($jmldata, $batas);
              $linkHalaman                = $p->navHalaman($_GET['halaman'], $jmlhalaman);

              echo "</table>";
              echo "</li></ul>"; ?>
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
            <!-- </form> -->

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

  case "tambah":
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Bahan-Bahan</a></li>
      <li><a href="index.php?page=overhead&act=list">Daftar Overhead Pabrik</a></li>
      <li class="active">Tambah Data Overhead Pabrik</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- <span class                     = 'title'>Tambah Pengguna</span><hr><br/> -->
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_overhead&act=input'>
              <div class="box-body">
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Nama Biaya Overhead</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Nama Overhead" name="nm_overp">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dua" class="col-sm-2 control-label">Total Biaya Overhead</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-addon">Rp.</div>
                      <input type="number" class="form-control" placeholder="Total Biaya" name="by_overp">
                      <div class="input-group-addon">.00</div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-4">
                  <textarea class="form-control" rows="3" name="ket_overp"></textarea>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                  <a href=index.php?page=overhead&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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


  case "edit":
    $edit= mysqli_query($koneksi, "SELECT * FROM overhead_pabrik WHERE id_overp='$_GET[id]'");
    while ($r    = mysqli_fetch_assoc($edit)) {
      $id_overp = $r['id_overp'];
      $kd_overp = $r['kd_overp'];
      $nm_overp = $r['nm_overp'];
      $by_overp = $r['by_overp'];
      $ket_overp = $r['ket_overp'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <<><a href="#">Master Data</a></>
      <li><a href="#">Bahan-Bahan</a></li>
      <li><a href="index.php?page=overhead&act=list">Daftar Overhead Pabrik</a></li>
      <li class="active">Edit Data <?php echo $kd_overp; ?></li>
    </ol>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_overhead&act=edit'>
              <input type="hidden" class="form-control" name="id_overp" value="<?php echo $id_overp; ?>">
              <input type="hidden" class="form-control" name="kd_overp" value="<?php echo $kd_overp; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Nama Biaya</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="nm_overp" placeholder="Nama Overhead" value="<?php echo $nm_overp; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dua" class="col-sm-2 control-label">Total Biaya Overhead</label>
                  <div class="col-sm-4">
                  <div class="input-group">
                      <div class="input-group-addon">Rp.</div>
                      <input type="number" class="form-control" name="by_overp" placeholder="0" value="<?php echo $by_overp; ?>">
                      <div class="input-group-addon">.00</div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-4">
                  <input type="text" class="form-control" name="ket_overp" placeholder="Keterangan" value="<?php echo $ket_overp; ?>">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                  <a href=index.php?page=overhead&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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