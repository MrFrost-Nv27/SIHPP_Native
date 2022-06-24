<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/bahan_penolong/aksi_bp.php";
switch ($_GET['act']) {

  case "list":
?>

    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Bahan-Bahan</a></li>
      <li><a href="#">Bahan Penolong</a></li>
      <li class="active">Daftar Bahan Penolong</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <a href=index.php?page=bp&act=tambah><button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Tambah</button></a>
            <hr>
            <div class="box-body">
              <?php
              echo "<table id = 'example1' class='table table-bordered table-striped'>";
              echo "<thead><tr>
          <th>No</th>
          <th>Bahan Penolong</th>
					<th>Harga</th>
          <th>Satuan</th>
          <th>Aksi</th>
        </tr></thead><tbody>";
              $p = new Paging;
              $batas = 4;
              $posisi = $p->cariPosisi($batas);
              $tampil = mysqli_query($koneksi, "SELECT * FROM bahan_penolong LIMIT $posisi, $batas ");
              $no                         = $posisi + 1;
              while ($r = mysqli_fetch_assoc($tampil)) {
                echo '<tr><td>' . $no . '</td>
            <td>' . $r['nm_bp'] . '</td>
            <td>Rp. ' . number_format($r['hrg_bp'], 0, ',', '.') . '</td>
            <td>' . $r['satuan_bp'] . '</td>';
                echo "
            <td>
					<a title = 'Edit Data' href=?page=bp&act=edit&id=$r[id_bp]><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></button></a>
					<a title = 'Hapus Data' href=$aksi?page=aksi_bp&act=hapus&id=$r[id_bp]><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></button></a>
        </td></tr>";
                $no++;
              }
              $jmldata                    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bahan_penolong"));
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
      <li><a href="#">Bahan Penolong</a></li>
      <li><a href="index.php?page=bp&act=list">Daftar Bahan Penolong</a></li>
      <li class="active">Tambah Bahan Penolong</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- <span class                     = 'title'>Tambah Pengguna</span><hr><br/> -->
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_bp&act=input'>
              <div class="box-body">
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Nama Bahan Penolong</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Nama Bahan Penolong" name="nm_bp">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dua" class="col-sm-2 control-label">Harga Bahan Penolong</label>
                  <div class="col-sm-4">
                  <div class="input-group">
                    <div class="input-group-addon">Rp.</div>
                    <input type="number" class="form-control" placeholder="Harga per satuan" name="hrg_bp">
                    <div class="input-group-addon">.00</div>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Satuan</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Ukuran satuan" name="satuan_bp">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                  <a href=index.php?page=bp&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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
    $edit                       = mysqli_query($koneksi, "SELECT * FROM bahan_penolong WHERE id_bp='$_GET[id]'");
    while ($r    = mysqli_fetch_assoc($edit)) {
      $id_bp                      = $r['id_bp'];
      $kd_bp                      = $r['kd_bp'];
      $nm_bp                          = $r['nm_bp'];
      $hrg_bp                         = $r['hrg_bp'];
      $satuan_bp                         = $r['satuan_bp'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Bahan-Bahan</a></li>
      <li><a href="#">Bahan Penolong</a></li>
      <li><a href="index.php?page=bp&act=list">Daftar Bahan Penolong</a></li>
      <li class="active">Edit Data <?php echo $nm_bp; ?></li>
    </ol>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_bp&act=edit'>
              <input type="hidden" class="form-control" name="id_bp" value="<?php echo $id_bp; ?>">
              <input type="hidden" class="form-control" name="kd_bp" value="<?php echo $kd_bp; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Nama Bahan Penolong</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="nm_bp" placeholder="Nama Bahan Penolong" value="<?php echo $nm_bp; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dua" class="col-sm-2 control-label">Harga Bahan Penolong</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control" name="hrg_bp" placeholder="0" value="<?php echo $hrg_bp; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Satuan</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Ukuran Satuan" name="satuan_bp" value="<?php echo $satuan_bp; ?>">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                  <a href=index.php?page=bp&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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