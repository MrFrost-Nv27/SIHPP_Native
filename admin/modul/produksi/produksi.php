<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/produksi/aksi_produksi.php";
switch ($_GET['act']) {

  case "list":
?>

    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Proses</a></li>
      <li><a href="#">Produksi</a></li>
      <li class="active">Input Produksi</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <form class="form-inline" method="POST" action='<?php echo $aksi; ?>?page=aksi_produksi&act=tambah'>
              <div class="form-group" style="margin-left: 12px;">
                <label for="nm_produk">Nama Produk</label>
                <select class="form-control" name="nm_produk" id="nm_produk" style="margin-left: 12px;">
                  <option value="Kusen Pintu">Kusen Pintu</option>
                  <option value="Meja">Meja</option>
                  <option value="Kursi">Kursi</option>
                  <option value="Kusen Jendela">Kusen Jendela</option>
                  <option value="Jendela">Jendela</option>
                  <option value="Pintu">Pintu</option>
                  <option value="Lemari">Lemari</option>
                </select>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="exampleInputJumlah2">Jumlah</label>
                <input type="number" class="form-control" id="exampleInputJumlah2" placeholder="0" name="jml_produksi" style="margin-left: 12px;">
              </div>
              <button type="submit" class="btn btn-primary active" style="margin-left: 12px;"><i class="glyphicon glyphicon-download-alt" aria-hidden="true"></i> Proses</button>
            </form>
            <hr>
            <div class="box-body">
              <?php
              echo "<table id = 'example1' class='table table-hover'>";

              echo "<thead><tr>
          <th>No</th>
          <th>Kode</th>
					<th>Produk</th>
          <th>Jumlah</th>
					<th class='success text-center'>BBB</th>
          <th class='info text-center'>BBP</th>
          <th class='warning text-center'>BTK</th>
          <th class='danger text-center'>BOP</th>
          <th class='active text-center'>HPP</th>
        </tr></thead><tbody>";

              $p = new Paging;
              $batas = 4;
              $posisi = $p->cariPosisi($batas);
              $tampil = mysqli_query($koneksi, "SELECT * FROM produksi LIMIT $posisi, $batas ");
              $no = $posisi + 1;
              while ($r = mysqli_fetch_assoc($tampil)) {
                $bbb = $r['bbb'];
                $bbp = $r['bbp'];
                $btk = $r['btk'];
                $bop = $r['bop'];
                echo "<tr><td>$no</td>
            <td>$r[nmr_produksi]</td>
            <td>$r[nm_produk]</td>
            <td>$r[jml_produksi]</td>";
                if ($bbb != 0) {

                  echo " <td class='success text-center'><a title = 'Biaya Bahan Baku' href=?page=produksi&act=bbb&id=$r[id_produksi]>Rp.  " . number_format($r['bbb'], 0, ',', '.') . "</a></td>";
                } else {
                  echo "<td class='success text-center'>
					<a title = 'Biaya Bahan Baku' href=?page=produksi&act=bbb&id=$r[id_produksi]><button type='button' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-pencil'></button></a>
				</td>";
                }
                if ($bbp != 0) {

                  echo " <td class='info text-center'><a title = 'Biaya Bahan Penolong' href=?page=produksi&act=bbp&id=$r[id_produksi]>Rp.  " . number_format($r['bbp'], 0, ',', '.') . "</a></td>";
                } else {
                  echo "<td class='info text-center'>
					<a title = 'Biaya Bahan Penolong' href=?page=produksi&act=bbp&id=$r[id_produksi]><button type='button' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-pencil'></button></a>
				</td>";
                }
                if ($btk != 0) {

                  echo " <td class='warning text-center'><a title = 'Biaya Tenaga Kerja' href=?page=produksi&act=btk&id=$r[id_produksi]>Rp.  " . number_format($r['btk'], 0, ',', '.') . "</a></td>";
                } else {
                  echo "<td class='warning text-center'>
					<a title = 'Biaya Tenaga Kerja' href=?page=produksi&act=btk&id=$r[id_produksi]><button type='button' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-pencil'></button></a>
				</td>";
                }
                if ($bop != 0) {

                  echo " <td class='danger text-center'><a title = 'Biaya Overhead' href=?page=produksi&act=bop&id=$r[id_produksi]>Rp.  " . number_format($r['bop'], 0, ',', '.') . "</a></td>";
                } else {
                  echo "<td class='danger text-center'>
					<a title = 'Biaya Overhead' href=?page=produksi&act=bop&id=$r[id_produksi]><button type='button' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-pencil'></button></a>
				</td>";
                }
                if ($bbb != 0 and $bbp != 0 and $btk != 0 and $bop != 0) {
                  echo " <td class='active text-center'><a title = 'Biaya Overhead' href=?page=produksi&act=hpp&id=$r[id_produksi]>Rp.  " . number_format($r['hpp'], 0, ',', '.') . "</a></td>";
                } else {
                  echo " <td class='active text-center'>HPP belum siap</td></tr>";
                }
                $no++;
              }
              $jmldata                    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produksi"));
              $jmlhalaman                 = $p->jumlahHalaman($jmldata, $batas);
              $linkHalaman                = $p->navHalaman($_GET['halaman'], $jmlhalaman);

              echo "</table>";
              echo "</li></ul>"; ?>
            </div>
          </div>
          <?php echo "
			  <div style                 = 'float:left;  position: relative;'>
			  <ul class                  = 'pagination'>
				$linkHalaman
			</ul>
		</div>"; ?>
        </div>
      </div>
    </div>
  <?php
    break;


    // --------------------------------------------------------------------------------------- AKSI BBB
  case "bbb":
    $edit = mysqli_query($koneksi, "SELECT * FROM produksi WHERE id_produksi='$_GET[id]'");
    while ($r = mysqli_fetch_assoc($edit)) {
      $nmr_produksi = $r['nmr_produksi'];
      $nm_produk = $r['nm_produk'];
      $jml_produksi = $r['jml_produksi'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Proses</a></li>
      <li><a href="#">Produksi</a></li>
      <li><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
      <li class="active">Biaya Bahan Baku Untuk <?php echo $nm_produk; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="form-inline">
              <input type="hidden" class="form-control" name="id_produksi" value="<?php echo $id_produksi; ?>">
              <div class="form-group" style="margin-left: 12px;">
                <label for="nmr_produksi">Nomor Produksi</label>
                <input style="margin-left: 12px;" id="nmr_produksi" name="nmr_produksi" class="form-control" type="text" value="<?php echo $nmr_produksi; ?>" readonly>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="nm_produk">Nama Produk</label>
                <input style="margin-left: 12px;" id="nm_produk" name="nm_produk" class="form-control" type="text" value="<?php echo $nm_produk; ?>" readonly>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="jml_produksi">Jumlah Produksi</label>
                <input style="margin-left: 12px;" id="jml_produksi" name="jml_produksi" class="form-control" type="text" value="<?php echo $jml_produksi; ?>" readonly>
              </div>
            </div>
            <hr>
            <div class="box-body">
              <form class="form-horizontal" action="<?php echo $aksi; ?>?page=aksi_produksi&act=bbb" method="POST">
                <input type="hidden" class="form-control" name="nmr" value="<?php echo $nmr_produksi; ?>">
                <input type="hidden" class="form-control" name="jml" value="<?php echo $jml_produksi; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" style="margin-left:-53px;">Bahan Baku</label>
                  <div class="col-sm-3 selectContainer" style="margin-left:10px;">
                    <select class="form-control" name="kd_bb">
                      <option value="0">Bahan Baku</option>
                      <?php
                      $bb = mysqli_query($koneksi, "SELECT * FROM bahan_baku");

                      while ($rbb = mysqli_fetch_assoc($bb)) {

                      ?>
                        <option value="<?php echo $rbb['kd_bb']; ?>"><?php echo $rbb['nm_bb']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary active"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Tambah</button>
                  <a href=index.php?page=produksi&act=list><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                </div>
              </form>
              <?php
              echo "<table id = 'example1' class='table table-bordered table-striped table-hover'>";

              echo "<thead><tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Satuan</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Aksi</th>
              </tr></thead><tbody>";

              $p = new Paging;
              $batas = 4;
              $posisi = $p->cariPosisi($batas);
              $tampil = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE lvl='BBB' and nmr_produksi='$nmr_produksi' LIMIT $posisi, $batas ");
              $no = $posisi + 1;
              while ($r = mysqli_fetch_assoc($tampil)) {
                echo "<tr><td>$no</td>
            <td>$r[kode]</td>
            <td>$r[nama]</td>
            <td>Rp.  " . number_format($r['harga'], 0, ',', '.') . "</td>
            <td>$r[keterangan]</td>
            <td>$r[jumlah]</td>
            <td>Rp.  " . number_format($r['total'], 0, ',', '.') . "</td>
            <td><a title = 'Hapus Data' href=$aksi?page=aksi_produksi&act=hapusbbb&id=$r[nmr_produksi]&id2=$r[kode]><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></button></a>
            </td></tr>";

                $no++;
              }

              echo "</table>";
              echo "</li></ul>"; ?>
            </div>


          </div>
        </div>
      </div>
    </div>
  <?php
    break;

    // ----------------------------------------------------------------------------------------AKSI BBP
  case "bbp":
    $edit = mysqli_query($koneksi, "SELECT * FROM produksi WHERE id_produksi='$_GET[id]'");
    while ($r = mysqli_fetch_assoc($edit)) {
      $nmr_produksi = $r['nmr_produksi'];
      $nm_produk = $r['nm_produk'];
      $jml_produksi = $r['jml_produksi'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Proses</a></li>
      <li><a href="#">Produksi</a></li>
      <li><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
      <li class="active">Biaya Bahan Penolong Untuk <?php echo $nm_produk; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="form-inline">
              <input type="hidden" class="form-control" name="id_produksi" value="<?php echo $id_produksi; ?>">
              <div class="form-group" style="margin-left: 12px;">
                <label for="nmr_produksi">Nomor Produksi</label>
                <input style="margin-left: 12px;" id="nmr_produksi" name="nmr_produksi" class="form-control" type="text" value="<?php echo $nmr_produksi; ?>" readonly>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="nm_produk">Nama Produk</label>
                <input style="margin-left: 12px;" id="nm_produk" name="nm_produk" class="form-control" type="text" value="<?php echo $nm_produk; ?>" readonly>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="jml_produksi">Jumlah Produksi</label>
                <input style="margin-left: 12px;" id="jml_produksi" name="jml_produksi" class="form-control" type="text" value="<?php echo $jml_produksi; ?>" readonly>
              </div>
            </div>
            <hr>
            <div class="box-body">
              <form class="form-horizontal" action="<?php echo $aksi; ?>?page=aksi_produksi&act=bbp" method="POST">
                <input type="hidden" class="form-control" name="nmr" value="<?php echo $nmr_produksi; ?>">
                <input type="hidden" class="form-control" name="jml" value="<?php echo $jml_produksi; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" style="margin-left:-28px;">Bahan Penolong</label>
                  <div class="col-sm-3 selectContainer" style="margin-left:-15px;">
                    <select class="form-control" name="kd_bp">
                      <option value="0">Bahan Penolong</option>
                      <?php
                      $bp = mysqli_query($koneksi, "SELECT * FROM bahan_penolong");

                      while ($rbp = mysqli_fetch_assoc($bp)) {

                      ?>
                        <option value="<?php echo $rbp['kd_bp']; ?>"><?php echo $rbp['nm_bp']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary active"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Tambah</button>
                  <a href=index.php?page=produksi&act=list><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                </div>
              </form>
              <?php
              echo "<table id = 'example1' class='table table-bordered table-striped table-hover'>";

              echo "<thead><tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Satuan</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Aksi</th>
              </tr></thead><tbody>";

              $p = new Paging;
              $batas = 4;
              $posisi = $p->cariPosisi($batas);
              $tampil = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE lvl='BBP' and nmr_produksi='$nmr_produksi' LIMIT $posisi, $batas ");
              $no = $posisi + 1;
              while ($r = mysqli_fetch_assoc($tampil)) {
                echo "<tr><td>$no</td>
            <td>$r[kode]</td>
            <td>$r[nama]</td>
            <td>Rp.  " . number_format($r['harga'], 0, ',', '.') . "</td>
            <td>$r[keterangan]</td>
            <td>$r[jumlah]</td>
            <td>Rp.  " . number_format($r['total'], 0, ',', '.') . "</td>
            <td><a title = 'Hapus Data' href=$aksi?page=aksi_produksi&act=hapusbbp&id=$r[nmr_produksi]&id2=$r[kode]><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></button></a>
            </td></tr>";

                $no++;
              }

              echo "</table>";
              echo "</li></ul>"; ?>
            </div>


          </div>
        </div>
      </div>
    </div>
  <?php
    break;

    // ----------------------------------------------------------------------------------------AKSI BTK
  case "btk":
    $edit = mysqli_query($koneksi, "SELECT * FROM produksi WHERE id_produksi='$_GET[id]'");
    while ($r = mysqli_fetch_assoc($edit)) {
      $nmr_produksi = $r['nmr_produksi'];
      $nm_produk = $r['nm_produk'];
      $jml_produksi = $r['jml_produksi'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Proses</a></li>
      <li><a href="#">Produksi</a></li>
      <li><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
      <li class="active">Biaya Pekerja <?php echo $nm_produk; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="form-inline">
              <input type="hidden" class="form-control" name="id_produksi" value="<?php echo $id_produksi; ?>">
              <div class="form-group" style="margin-left: 12px;">
                <label for="nmr_produksi">Nomor Produksi</label>
                <input style="margin-left: 12px;" id="nmr_produksi" name="nmr_produksi" class="form-control" type="text" value="<?php echo $nmr_produksi; ?>" readonly>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="nm_produk">Nama Produk</label>
                <input style="margin-left: 12px;" id="nm_produk" name="nm_produk" class="form-control" type="text" value="<?php echo $nm_produk; ?>" readonly>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="jml_produksi">Jumlah Produksi</label>
                <input style="margin-left: 12px;" id="jml_produksi" name="jml_produksi" class="form-control" type="text" value="<?php echo $jml_produksi; ?>" readonly>
              </div>
            </div>
            <hr>
            <div class="box-body">
              <form class="form-horizontal" action="<?php echo $aksi; ?>?page=aksi_produksi&act=btk" method="POST">
                <input type="hidden" class="form-control" name="nmr" value="<?php echo $nmr_produksi; ?>">
                <input type="hidden" class="form-control" name="jml" value="<?php echo $jml_produksi; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" style="margin-left:-48px;">Tenaga Kerja</label>
                  <div class="col-sm-3 selectContainer" style="margin-left:5px;">
                    <select class="form-control" name="id_tenaker">
                      <option value="0">Tenaga Kerja</option>
                      <?php
                      $tenaker = mysqli_query($koneksi, "SELECT * FROM tenaker where bag_tenaker='$nm_produk'");

                      while ($rtenaker = mysqli_fetch_assoc($tenaker)) {

                      ?>
                        <option value="<?php echo $rtenaker['id_tenaker']; ?>"><?php echo $rtenaker['nm_tenaker']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary active"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Tambah</button>
                  <a href=index.php?page=produksi&act=list><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                </div>
              </form>
              <?php
              echo "<table id = 'example1' class='table table-bordered table-striped table-hover'>";

              echo "<thead><tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Upah</th>
              <th>Bagian</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Aksi</th>
              </tr></thead><tbody>";
              $p = new Paging;
              $batas = 4;
              $posisi = $p->cariPosisi($batas);
              $tampil = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE lvl='BTK' and nmr_produksi='$nmr_produksi' LIMIT $posisi, $batas ");
              $no = $posisi + 1;
              while ($r = mysqli_fetch_assoc($tampil)) {
                echo "<tr><td>$no</td>
            <td>$r[kode]</td>
            <td>$r[nama]</td>
            <td>Rp.  " . number_format($r['harga'], 0, ',', '.') . "</td>
            <td>$r[keterangan]</td>
            <td>$r[jumlah]</td>
            <td>Rp.  " . number_format($r['total'], 0, ',', '.') . "</td>
            <td><a title = 'Hapus Data' href=$aksi?page=aksi_produksi&act=hapusbtk&id=$r[nmr_produksi]&id2=$r[kode]><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></button></a>
            </td></tr>";

                $no++;
              }

              echo "</table>";
              echo "</li></ul>"; ?>
            </div>


          </div>
        </div>
      </div>
    </div>
  <?php
    break;

    // ----------------------------------------------------------------------------------------AKSI BOP
  case "bop":
    $edit = mysqli_query($koneksi, "SELECT * FROM produksi WHERE id_produksi='$_GET[id]'");
    while ($r = mysqli_fetch_assoc($edit)) {
      $nmr_produksi = $r['nmr_produksi'];
      $nm_produk = $r['nm_produk'];
      $jml_produksi = $r['jml_produksi'];
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Proses</a></li>
      <li><a href="#">Produksi</a></li>
      <li><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
      <li class="active">Biaya overhead pabrik untuk produksi <?php echo $nm_produk; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="form-inline">
              <input type="hidden" class="form-control" name="id_produksi" value="<?php echo $id_produksi; ?>">
              <div class="form-group" style="margin-left: 12px;">
                <label for="nmr_produksi">Nomor Produksi</label>
                <input style="margin-left: 12px;" id="nmr_produksi" name="nmr_produksi" class="form-control" type="text" value="<?php echo $nmr_produksi; ?>" readonly>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="nm_produk">Nama Produk</label>
                <input style="margin-left: 12px;" id="nm_produk" name="nm_produk" class="form-control" type="text" value="<?php echo $nm_produk; ?>" readonly>
              </div>
              <div class="form-group" style="margin-left: 12px;">
                <label for="jml_produksi">Jumlah Produksi</label>
                <input style="margin-left: 12px;" id="jml_produksi" name="jml_produksi" class="form-control" type="text" value="<?php echo $jml_produksi; ?>" readonly>
              </div>
            </div>
            <hr>
            <div class="box-body">
              <form class="form-horizontal" action="<?php echo $aksi; ?>?page=aksi_produksi&act=bop" method="POST">
                <input type="hidden" class="form-control" name="nmr" value="<?php echo $nmr_produksi; ?>">
                <input type="hidden" class="form-control" name="jml" value="<?php echo $jml_produksi; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" style="margin-left:-48px;">Jenis Overhead</label>
                  <div class="col-sm-3 selectContainer" style="margin-left:5px;">
                    <select class="form-control" name="kd_overp">
                      <option value="0">Overhead Pabrik</option>
                      <?php
                      $op = mysqli_query($koneksi, "SELECT * FROM overhead_pabrik");

                      while ($rop = mysqli_fetch_assoc($op)) {

                      ?>
                        <option value="<?php echo $rop['kd_overp']; ?>"><?php echo $rop['nm_overp']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary active"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Tambah</button>
                  <a href=index.php?page=produksi&act=list><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                </div>
              </form>
              <?php
              echo "<table id = 'example1' class='table table-bordered table-striped table-hover'>";

              echo "<thead><tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Biaya</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Aksi</th>
              </tr></thead><tbody>";
              $p = new Paging;
              $batas = 4;
              $posisi = $p->cariPosisi($batas);
              $tampil = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE lvl='BOP' and nmr_produksi='$nmr_produksi' LIMIT $posisi, $batas ");
              $no = $posisi + 1;
              while ($r = mysqli_fetch_assoc($tampil)) {
                echo "<tr><td>$no</td>
            <td>$r[kode]</td>
            <td>$r[nama]</td>
            <td>Rp.  " . number_format($r['harga'], 0, ',', '.') . "</td>
            <td>$r[jumlah]</td>
            <td>Rp.  " . number_format($r['total'], 0, ',', '.') . "</td>
            <td><a title = 'Hapus Data' href=$aksi?page=aksi_produksi&act=hapusbop&id=$r[nmr_produksi]&id2=$r[kode]><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></button></a>
            </td></tr>";

                $no++;
              }

              echo "</table>";
              echo "</li></ul>"; ?>
            </div>


          </div>
        </div>
      </div>
    </div>
  <?php
    break;

    // TODO AKSI HPP
  case "hpp":
    $edit = mysqli_query($koneksi, "SELECT * FROM produksi WHERE id_produksi='$_GET[id]'");
    while ($r = mysqli_fetch_assoc($edit)) {
      $nmr_produksi = $r['nmr_produksi'];
      $nm_produk = $r['nm_produk'];
      $bbb = "Rp. " . number_format($r['bbb'], 0, ',', '.');
      $bbp = "Rp. " . number_format($r['bbp'], 0, ',', '.');
      $bop = "Rp. " . number_format($r['bop'], 0, ',', '.');
      $btk = "Rp. " . number_format($r['btk'], 0, ',', '.');
      $hpp = "Rp. " . number_format($r['hpp'], 0, ',', '.');
      $jml_produksi = $r['jml_produksi'];
      $hpppi=$r['hpp']/$jml_produksi;
      $hpppi2 = "Rp. " . number_format($hpppi, 2, ',', '.');
      $ma=$hpppi*0.6;
      $ma2 = "Rp. " . number_format($ma, 2, ',', '.');
      $tgt=$hpppi+$ma;
      $tgt2 = "Rp. " . number_format($tgt, 2, ',', '.');
      $lb=($tgt*$jml_produksi)-$r['hpp'];
      $lb2 = "Rp. " . number_format($lb, 2, ',', '.');
    }
  ?>
    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="#">Master Proses</a></li>
      <li><a href="#">Produksi</a></li>
      <li><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
      <li class="active">Harga Pokok Produksi <?php echo $nm_produk; ?></li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="row">
              <div class="col-md-5 col-md-offset-1">
              <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label bg-light-blue-gradient" style="text-align: left;">Info Produksi</label>
                    
                  </div>
                  <div class="form-group">
                    <p class="col-sm-4 control-label" style="text-align: left;">Bahan Baku</p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><?php echo $bbb; ?></p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;">Bahan Penolong</p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><?php echo $bbp; ?></p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;">Tenaga Kerja</p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><?php echo $btk; ?></p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;">Overhead Pabrik</p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><?php echo $bop; ?></p>
                    </div>
                  </div>
                   <div class="form-group" style="margin-top:-15px;">
                   <div class="col-sm-4 col-sm-offset-4"><hr></div>
                  </div>
                   <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;">Total By. Produksi</p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><strong><?php echo $hpp; ?></strong></p>
                    </div>
                  </div>
                   <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;"><strong>HPP</strong></p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><strong><?php echo $hpppi2; ?></strong></p>
                    </div>
                  </div>
              </form>
                </div>
              <div class="col-md-6">
              <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label bg-yellow-gradient" style="text-align: left;">Info Penjualan</label>
                    <div class="col-sm-4">
                      <p class="form-control-static"><strong></strong></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <p class="col-sm-4 control-label" style="text-align: left;"><strong>Kode Produksi</strong></p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><strong><?php echo $nmr_produksi; ?></strong></p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;">Nama Produk</p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><?php echo $nm_produk; ?></p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;">Jumlah Produksi</p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><?php echo $jml_produksi; ?> Unit/Item</p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;">HPP</p>
                    <div class="col-sm-4">
                      <p class="form-control-static"><?php echo $hpppi2; ?></p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                  <p class="col-sm-4 control-label" style="text-align: left;">% Mark-Up &times; HPP</p>
                    <div class="col-sm-4">
                      <p class="form-control-static">&plusmn; <?php echo $ma2; ?></p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;">Target Penjualan</p>
                    <div class="col-sm-6">
                      <p class="form-control-static">&plusmn; <?php echo $tgt2; ?> per Unit/Item</p>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top:-15px;">
                    <p class="col-sm-4 control-label" style="text-align: left;"><strong>Estimasi Laba</strong></p>
                    <div class="col-sm-4">
                      <p class="form-control-static">&plusmn; <strong><?php echo $lb2; ?></strong></p>
                    </div>
                  </div>
              </form>
                </div>
                </div>
                </div>
              </div>
              <a title = 'Kembali' href=?page=produksi&act=list><button type='button' class='btn btn-active'><span class='glyphicon glyphicon-arrow-left'> Kembali</span></button></a>
            </div>


          </div>
        </div>
      </div>
    </div>
<?php
    break;
}
?>