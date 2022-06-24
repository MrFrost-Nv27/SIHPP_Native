<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi                           = "modul/tenaker/aksi_tenaker.php";
switch ($_GET['act']) {

  case "list":
?>

    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Tenaga Kerja</a></li>
      <li class="active">Daftar Tenaga Kerja</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <a href=index.php?page=tenaker&act=tambah><button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Tambah</button></a>
            <hr>
            <!-- <form class                    = 'form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_tenaker&act=input'> -->
            <div class="box-body">
              <?php
              echo "<table id               = 'example1' class='table table-bordered table-striped'>";

              echo "<thead><tr>
          <th>No</th>
          <th>Nama</th>
					<th>Bagian</th>
          <th>Upah</th>
          <th>Aksi</th>
        </tr></thead><tbody>";

              $p                          = new Paging;
              $batas                      = 4;
              $posisi                     = $p->cariPosisi($batas);
              $tampil                   = mysqli_query($koneksi, "SELECT * FROM tenaker LIMIT $posisi, $batas ");
              $no                         = $posisi + 1;
              while ($r = mysqli_fetch_assoc($tampil)) {
                echo "<tr><td>$no</td>
            <td>$r[nm_tenaker]</td>
            <td>Tukang $r[bag_tenaker]</td>
            <td>Rp. ". number_format($r['upah_tenaker'], 0, ',', '.') . "</td>
            <td>
					<a title                   = 'Edit Data' href=?page=tenaker&act=edit&id=$r[id_tenaker]><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></button></a>
					<a title                   = 'Hapus Data' href=$aksi?page=aksi_tenaker&act=hapus&id=$r[id_tenaker]><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></button></a>
        </td></tr>";
                $no++;
              }
              $jmldata                    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tenaker"));
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

  case "list2":
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Tenaga Kerja</a></li>
      <li class="active">Biaya Tenaga Kerja</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="box-body">
              <?php
              echo '<table  id               = "example1" class="table table-bordered table-striped">
       <thead>
         <tr>
          <td><strong>No</strong></td>
          <td><strong>Nama Lengkap</strong></td>
          <td><strong>Bagian Kerja</strong></td>
          <td><strong>Pendapatan</strong></td>
         </tr>
       </thead>
       <tbody>';
       $p = new Paging;
       $batas = 5;
       $posisi = $p->cariPosisi($batas);
       $sql = mysqli_query($koneksi, "SELECT * FROM tenaker LIMIT $posisi, $batas");
       $no = $posisi + 1;
       while ($row = mysqli_fetch_assoc($sql)) {
                echo '<tr>
     <td>' . $no . '</td>
         <td>' . $row['nm_tenaker'] . '</td>
         <td>' . $row['bag_tenaker'] . '</td>
         <td>Rp. ' . number_format($row['ttl_pendapatan'], 0, ',', '.') . '</td>
       </tr>';
       $no++;
      }
      $jmldata                    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tenaker"));
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

  case "tambah":
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Tenaga Kerja</a></li>
      <li><a href="index.php?page=tenaker&act=list">Daftar Tenaga Kerja</a></li>
      <li class="active">Tambah Tenaga Kerja</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- <span class                     = 'title'>Tambah Pengguna</span><hr><br/> -->
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_tenaker&act=input'>
              <div class="box-body">
                <div class="form-group">
                  <label for="dua" class="col-sm-2 control-label">Nama Lengkap</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="nm_tenaker">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-2 control-label">Bagian</label>
                  <div class="col-xs-3 selectContainer">
                    <select class="form-control" name="bag_tenaker">
                      <option value="Kusen Pintu">Tukang Kusen Pintu</option>
                      <option value="Meja">Tukang Meja</option>
                      <option value="Kursi">Tukang Kursi</option>
                      <option value="Kusen Jendela">Tukang Kusen Jendela</option>
                      <option value="Jendela">Tukang Jendela</option>
                      <option value="Pintu">Tukang Pintu</option>
                      <option value="Lemari">Tukang Lemari</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Upah per Item</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="0" name="upah_tenaker">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                  <a href=index.php?page=tenaker&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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
    $edit                       = mysqli_query($koneksi, "SELECT * FROM tenaker WHERE id_tenaker='$_GET[id]'");
    while ($r    = mysqli_fetch_assoc($edit)) {
      $id_tenaker                      = $r['id_tenaker'];
      $nm_tenaker                          = $r['nm_tenaker'];
      $bag_tenaker                         = $r['bag_tenaker'];
      $upah_tenaker                         = $r['upah_tenaker'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Tenaga Kerja</a></li>
      <li><a href="index.php?page=tenaker&act=list">Daftar Tenaga Kerja</a></li>
      <li class="active">Edit Data <?php echo $nama; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_tenaker&act=edit'>
              <input type="hidden" class="form-control" name="id_tenaker" value="<?php echo $id_tenaker; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="satu" class="col-sm-2 control-label">Nama Lengkap</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="nm_tenaker" placeholder="Nama Lengkap" value="<?php echo $nm_tenaker; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-2 control-label">Bagian Kerja</label>
                  <div class="col-xs-4 selectContainer">
                    <select class="form-control" name="bag_tenaker">
                      <option value="<?php echo $bag_tenaker; ?>" style="color:white; background-color:light-blue;"><?php echo $bag_tenaker; ?></option>
                      <option value="Kusen Pintu">Tukang Kusen Pintu</option>
                      <option value="Meja">Tukang Meja</option>
                      <option value="Kursi">Tukang Kursi</option>
                      <option value="Kusen Jendela">Tukang Kusen Jendela</option>
                      <option value="Jendela">Tukang Jendela</option>
                      <option value="Pintu">Tukang Pintu</option>
                      <option value="Lemari">Tukang Lemari</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="dua" class="col-sm-2 control-label">Upah Tenaker</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="0" name="upah_tenaker" value="<?php echo $upah_tenaker; ?>">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                  <a href=index.php?page=tenaker&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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