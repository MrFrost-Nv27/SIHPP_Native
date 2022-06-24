<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/user/aksi_user.php";
switch ($_GET['act']) {

  case "list":
?>

    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Pengguna</a></li>
      <li class="active">Daftar Pengguna</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
    <a href=index.php?page=user&act=tambah><button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Tambah</button></a>
    <hr>
    <div class="box-body">
    <?php
    echo "<table id = 'example1' class='table table-bordered table-striped'>";

    echo "<thead><tr>
          <th>No</th>
          <th>Username</th>
					<th>Nama</th>
          <th>Jabatan</th>
					<th>Email</th>
          <th>Aksi</th>
        </tr></thead><tbody>";

    $p                          = new Paging;
    $batas                      = 4;
    $posisi                     = $p->cariPosisi($batas);
    $tampil                   = mysqli_query($koneksi, "SELECT * FROM users LIMIT $posisi, $batas ");
    $no                         = $posisi + 1;
    while ($r = mysqli_fetch_assoc($tampil)) {
      $level                        = $r['level'];
      if ($level == 1) {
        $xlevel                    = 'Administrator';
      } elseif ($level == 2) {
        $xlevel                   = 'PPC';
      } elseif ($level == 3) {
        $xlevel                      = 'Personalia';
      } elseif ($level == 4) {
        $xlevel                      = 'Pimpinan';
      }
      echo "<tr><td>$no</td>
            <td>$r[username]</td>
            <td>$r[nama]</td>
            <td>$xlevel</td>
			  <td>$r[email]</td>";
      if ($level != 1) {

        echo "       <td>
					<a title                   = 'Edit Data' href=?page=user&act=edit&id=$r[username]><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></button></a>
					<a title                   = 'Hapus Data' href=$aksi?page=aksi_user&act=hapus&id=$r[username]><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></button></a>
				</td></tr>";
      } else {
        echo "       <td>
					<a title                   = 'Edit Data' href=?page=user&act=edit&id=$r[username]><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></button></a>
				</td></tr>";
      }
      $no++;
    }
    $jmldata                    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users"));
    $jmlhalaman                 = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman                = $p->navHalaman($_GET['halaman'], $jmlhalaman);

    echo "</table>";
    echo "</li></ul>";?>
    </div>
          </div>
          <?php echo "
			  <div style                 = 'float:left;  position: relative;'>
			  <ul class                  = 'pagination'>
				$linkHalaman
			</ul>
		</div>";?>
    </div>
    </div>
    </div>
    <?php
    break;

  case "tambah":
    ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Pengguna</a></li>
      <li><a href="index.php?page=user&act=list">Daftar Pengguna</a></li>
      <li class="active">Tambah Pengguna</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- <span class                     = 'title'>Tambah Pengguna</span><hr><br/> -->
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_user&act=input'>
              <div class="box-body">
                <div class="form-group">
                  <label for="dua" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Nama Pengguna" name="nama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Email" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-4">
                    <input type="password" class="form-control" placeholder="Password" name="pass">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Ulangi Password</label>
                  <div class="col-sm-4">
                    <input type="password" class="form-control" placeholder="Ulangi Password" name="pass1">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-2 control-label">Jabatan</label>
                  <div class="col-xs-2 selectContainer">
                    <select class="form-control" name="level">
                      <option value="1">Administrator</option>
                      <option value="2">PPC</option>
                      <option value="3">Personalia</option>
                      <option value="4">Pimpinan</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                  <a href=index.php?page=user&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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
    $edit                       = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$_GET[id]'");
    while ($r    = mysqli_fetch_assoc($edit)) {
      $username                      = $r['username'];
      $nama                          = $r['nama'];
      $email                         = $r['email'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Data</a></li>
      <li><a href="#">Pengguna</a></li>
      <li><a href="index.php?page=user&act=list">Daftar Pengguna</a></li>
      <li class="active">Edit Data <?php echo $nama; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_user&act=edit'>
              <input type="hidden" class="form-control" name="username" value="<?php echo $username; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="dua" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="" placeholder="Kode Akun" value="<?php echo $username; ?>" disabled="disabled">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Nama Pengguna</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Nama Pengguna" name="nama" value="<?php echo $nama; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Email Pengguna</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Nama Pengguna" name="email" value="<?php echo $email; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-2 control-label">Jabatan</label>
                  <div class="col-xs-2 selectContainer">
                    <select class="form-control" name="level">
                      <option value="1">Administrator</option>
                      <option value="2">PPC</option>
                      <option value="3">Personalia</option>
                      <option value="4">Pimpinan</option>
                    </select>
                  </div>
                </div>
                <!-- <div class                  = "form-group">
        <label class            = "col-sm-2 control-label">Bagian</label>
        <div class              = "col-sm-2 selectContainer">
            <select class       = "form-control" name="bagian">
               <option value    = "0">Pilih Bagian</option>
                <?php
                $bagian                = mysqli_query($koneksi, "SELECT * FROM bagian");
                while ($rbagian = mysqli_fetch_assoc($bagian)) {
                ?>
               <option value    = "<?php echo $rbagian['kode']; ?>"><?php echo $rbagian['nama']; ?></option>
            <?php } ?>
            </select>
        </div>
    </div>   -->
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Password" name="pass">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tiga" class="col-sm-2 control-label">Ulangi Password</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Password" name="pass1">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="margin-left:-10px;">
                <div class="col-sm-10 col-sm-offset-2">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                  <a href=index.php?page=user&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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