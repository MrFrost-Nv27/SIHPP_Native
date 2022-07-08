<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/bahan_baku/aksi_bb.php";
switch ($_GET['act']) {

  case "list":
?>

    <ol class="breadcrumb" style="background-color: white;">
      <li><a href="3">Laporan</a></li>
      <li class="active">Daftar Laporan</li>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="box-body">
              <?php
              $bb = mysqli_query($koneksi, "SELECT SUM(tot_pb) AS totalbb1, SUM(stok_pb) AS totalbb2 FROM persediaan_bahan_baku");
              $rbb = mysqli_fetch_assoc($bb);
              $bb2 = mysqli_query($koneksi, "SELECT * FROM persediaan_bahan_baku");
              $jml_bb = mysqli_num_rows($bb2);
              $bp = mysqli_query($koneksi, "SELECT SUM(tot_pb) AS totalbb1, SUM(stok_pb) AS totalbb2 FROM persediaan_bahan_penolong");
              $rbp = mysqli_fetch_assoc($bp);
              $bp2 = mysqli_query($koneksi, "SELECT * FROM persediaan_bahan_penolong");
              $jml_bp = mysqli_num_rows($bp2);
              $tk = mysqli_query($koneksi, "SELECT SUM(ttl_pendapatan) AS totalbb1 FROM tenaker");
              $rtk = mysqli_fetch_assoc($tk);
              $tk2 = mysqli_query($koneksi, "SELECT * FROM tenaker");
              $jml_tk = mysqli_num_rows($tk2);
              $op = mysqli_query($koneksi, "SELECT SUM(by_overp) AS totalbb1 FROM overhead_pabrik");
              $rop = mysqli_fetch_assoc($op);
              $op2 = mysqli_query($koneksi, "SELECT * FROM overhead_pabrik");
              $jml_op = mysqli_num_rows($op2);
              $hpp = mysqli_query($koneksi, "SELECT * FROM produksi");
              $jml_hpp = mysqli_num_rows($hpp);
              ?>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                  <tr>
                    <th class="bg-info">No.</th>
                    <th class="bg-info">Laporan</th>
                    <th class="bg-info">Total Data</th>
                    <th class="bg-info">Total Stok</th>
                    <th class="bg-info">Total Biaya</th>
                    <th class="bg-info">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Bahan Baku</td>
                    <td><?php echo $jml_bb ?></td>
                    <td><?php echo $rbb['totalbb2'] ?> Unit</td>
                    <td>Rp. <?php
                     echo number_format($rbb['totalbb1'], 0, ',', '.') ?></td>
                    <td><a href="index.php?page=laporan&act=cbb" target=""><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Cetak</button></a></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Bahan Penolong</td>
                    <td><?php echo $jml_bp ?></td>
                    <td><?php echo $rbp['totalbb2'] ?> Item</td>
                    <td>Rp. <?php
                    if($rbp['totalbb1'] == null){
                      echo "0";
                    }else{
                      echo number_format($rbp['totalbb1'], 0, ',', '.');
                    }?></td>
                    <td><a href=index.php?page=laporan&act=cbp><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Cetak</button></a></td>
                  </tr>
                  <tr>
                    <td class="bg-info"><strong>No</strong></td>
                    <td class="bg-info"><strong>Laporan</strong></td>
                    <td class="bg-info"><strong>Total Data</strong></td>
                    <td colspan="2" class="bg-info"><strong>Total Biaya</strong></td>
                    <td class="bg-info"><strong>Aksi</strong></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Tenaga Kerja</td>
                    <td><?php echo $jml_tk ?></td>
                    <td colspan="2">Rp. <?php if ($rtk['totalbb1'] == NULL) {
                                            echo "0";
                                          } else {
                                            echo number_format($rtk['totalbb1'], 0, ',', '.');
                                          } ?></td>
                    <td><a href=index.php?page=laporan&act=ctk><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Cetak</button></a></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Overhead Pabrik</td>
                    <td><?php echo $jml_op ?></td>
                    <td colspan="2">
                      Rp. <?php
                              if ($rop['totalbb1'] == NULL) {
                                echo "0";
                              } else {
                                echo number_format($rop['totalbb1'], 0, ',', '.');
                              } ?></td>
                    <td><a href=index.php?page=laporan&act=cop><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Cetak</button></a></td>
                  </tr>
                  <tr>
                    <td class="bg-info"><strong>No</strong></td>
                    <td class="bg-info"><strong>Laporan</strong></td>
                    <td class="bg-info"><strong>Total Data</strong></td>
                    <td colspan="2" class="bg-info"><strong>Nomor Produksi</strong></td>
                    <td class="bg-info"><strong>Aksi</strong></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Produksi</td>
                    <td><?php echo $jml_hpp ?></td>
                    <td colspan="3">
                    <form action="?page=laporan&act=hpp" method="POST" class="form-inline">
                      <select class="form-control" name="id_produksi" style="width:300px;">
                        <option value="0">Pilih Nomor</option>
                        <?php
                        $produksi = mysqli_query($koneksi, "SELECT * FROM produksi");
                        while ($r = mysqli_fetch_assoc($produksi)) {
                        $nm= $r['nm_produk'];
                        ?>
                          <option value="<?php echo $r['nmr_produksi']; ?>"><?php echo $r['nmr_produksi'] ." / ". $nm; ?></option>
                        <?php } ?>
                      </select>                
                      <a style="margin-left:174px;"><button type="submit" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Cetak</button></a>
                  </form>
                  </td>
                  </tr>
              </table>

            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
            <!-- </form> -->

          </div>
        </div>
      </div>
    </div>
  <?php
    break;

  case "cbb":
  ?>
    <script>
      window.print();
    </script>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="box-body">
              <?php
              $sql = mysqli_query($koneksi, "SELECT tgl_pb, kd_pb, nm_pb, hrg_pb, stok_pb, SUM(tot_pb) AS total FROM persediaan_bahan_baku GROUP BY tgl_pb, kd_pb ORDER BY tgl_pb desc");
              echo '
                  <table  id = "example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td><strong>No</strong></td>
                        <td><strong>Tanggal</strong></td>
                        <td><strong>Nama Bahan</strong></td>
                        <td><strong>Harga Satuan</strong></td>
                        <td><strong>Stok</strong></td>
                        <td><strong>Total Harga</strong></td>
                      </tr>
                    </thead>
                    <tbody>';
              $total = 0;
              $no = 0;
              while ($row = mysqli_fetch_assoc($sql)) {
                $no++;
                echo '
                    <tr>
                      <td>' . $no . '</td>
                          <td>' . $row['tgl_pb'] . '</td>
                          <td>' . $row['nm_pb'] . '</td>
                          <td>Rp. ' . number_format($row['hrg_pb'], 0, ',', '.') . '</td>
                          <td>' . $row['stok_pb'] . '</td>
                          <td>Rp. ' . number_format($row['total'], 0, ',', '.') . '</td>
                          ';
                echo '
                  </tr>';
                $total += $row['total'];
              }
              echo '
                  <tr>
                    <td colspan="5"><strong>TOTAL</strong></td>
                    <td><strong>Rp. ' . number_format($total, 0, ',', '.') . '</strong></td>
                  </tr>
                  </tbody>
                  </table>';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php
    break;

  case "cbp":
  ?>
    <script>
      window.print();
    </script>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="box-body">
              <?php
              $sql = mysqli_query($koneksi, "SELECT tgl_pb, kd_pb, nm_pb, hrg_pb, stok_pb, SUM(tot_pb) AS total FROM persediaan_bahan_penolong GROUP BY tgl_pb, kd_pb ORDER BY tgl_pb desc");
              echo '
                  <table  id = "example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td><strong>No</strong></td>
                        <td><strong>Tanggal</strong></td>
                        <td><strong>Nama Bahan</strong></td>
                        <td><strong>Harga Satuan</strong></td>
                        <td><strong>Stok</strong></td>
                        <td><strong>Total Harga</strong></td>
                      </tr>
                    </thead>
                    <tbody>';
              $total = 0;
              $no = 0;
              while ($row = mysqli_fetch_assoc($sql)) {
                $no++;
                echo '
                    <tr>
                      <td>' . $no . '</td>
                          <td>' . $row['tgl_pb'] . '</td>
                          <td>' . $row['nm_pb'] . '</td>
                          <td>Rp. ' . number_format($row['hrg_pb'], 0, ',', '.') . '</td>
                          <td>' . $row['stok_pb'] . '</td>
                          <td>Rp. ' . number_format($row['total'], 0, ',', '.') . '</td>
                          ';
                echo '
                  </tr>';
                $total += $row['total'];
              }
              echo '
                  <tr>
                    <td colspan="5"><strong>TOTAL</strong></td>
                    <td><strong>Rp. ' . number_format($total, 0, ',', '.') . '</strong></td>
                  </tr>
                  </tbody>
                  </table>';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
    break;

  case "ctk":
  ?>
    <script>
      window.print();
    </script>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="box-body">
              <?php
              $sql = mysqli_query($koneksi, "SELECT id_tenaker, nm_tenaker, bag_tenaker, upah_tenaker, SUM(ttl_pendapatan) AS total FROM tenaker GROUP BY id_tenaker");
              echo '
                  <table  id = "example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td><strong>No</strong></td>
                        <td><strong>ID Tenaker</strong></td>
                        <td><strong>Nama Tenaker</strong></td>
                        <td><strong>Spesialis / Bagian</strong></td>
                        <td><strong>Upah Per Produk</strong></td>
                        <td><strong>Total Pendapatan</strong></td>
                      </tr>
                    </thead>
                    <tbody>';
              $total = 0;
              $no = 0;
              while ($row = mysqli_fetch_assoc($sql)) {
                $no++;
                echo '
                    <tr>
                      <td>' . $no . '</td>
                          <td>TK0' . $row['id_tenaker'] . '</td>
                          <td>' . $row['nm_tenaker'] . '</td>
                          <td>' . $row['bag_tenaker'] . '</td>
                          <td>Rp. ' . number_format($row['upah_tenaker'], 0, ',', '.') . '</td>
                          <td>Rp. ' . number_format($row['total'], 0, ',', '.') . '</td>
                          ';
                echo '
                  </tr>';
                $total += $row['total'];
              }
              echo '
                  <tr>
                    <td colspan="5"><strong>TOTAL</strong></td>
                    <td><strong>Rp. ' . number_format($total, 0, ',', '.') . '</strong></td>
                  </tr>
                  </tbody>
                  </table>';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  break;

case "cop":
?>
    <script>
      window.print();
    </script>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="box-body">
              <?php
              $sql = mysqli_query($koneksi, "SELECT kd_overp, nm_overp, tgl_overp, ket_overp, SUM(by_overp) AS total FROM overhead_pabrik GROUP BY tgl_overp, kd_overp ORDER BY tgl_overp desc");
              echo '
                  <table  id = "example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td><strong>No</strong></td>
                        <td><strong>Tanggal</strong></td>
                        <td><strong>Kode Bahan</strong></td>
                        <td><strong>Nama Biaya</strong></td>
                        <td><strong>Keterangan</strong></td>
                        <td><strong>Total Harga</strong></td>
                      </tr>
                    </thead>
                    <tbody>';
              $total = 0;
              $no = 0;
              while ($row = mysqli_fetch_assoc($sql)) {
                $no++;
                echo '
                    <tr>
                      <td>' . $no . '</td>
                          <td>' . $row['tgl_overp'] . '</td>
                          <td>' . $row['kd_overp'] . '</td>
                          <td>' . $row['nm_overp'] . '</td>
                          <td>' . $row['ket_overp'] . '</td>
                          <td>Rp. ' . number_format($row['total'], 0, ',', '.') . '</td>
                          ';
                echo '
                  </tr>';
                $total += $row['total'];
              }
              echo '
                  <tr>
                    <td colspan="5"><strong>TOTAL</strong></td>
                    <td><strong>Rp. ' . number_format($total, 0, ',', '.') . '</strong></td>
                  </tr>
                  </tbody>
                  </table>';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
    break;

case "hpp":
  ?>
    <script>
      window.print();
    </script>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="box-body">
              <?php
              $sql = mysqli_query($koneksi, "SELECT tanggal, nmr_produksi, jml_produksi, kode, nama, SUM(total) AS total1 FROM detail_produksi WHERE nmr_produksi='$_POST[id_produksi]' group by kode");
              echo '
                  <table  id = "example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td><strong>No</strong></td>
                        <td><strong>Tanggal</strong></td>
                        <td><strong>Nomor Produksi</strong></td>
                        <td><strong>Jumlah Produksi</strong></td>
                        <td><strong>Kode Terkait</strong></td>
                        <td><strong>Nama Kode</strong></td>
                        <td><strong>Total Biaya</strong></td>
                      </tr>
                    </thead>
                    <tbody>';
              $total = 0;
              $no = 0;
              while ($row = mysqli_fetch_assoc($sql)) {
                $no++;
                echo '
                    <tr>
                      <td>' . $no . '</td>
                          <td>' . $row['tanggal'] . '</td>
                          <td>' . $row['nmr_produksi'] . '</td>
                          <td>' . $row['jml_produksi'] . '</td>
                          <td>' . $row['kode'] . '</td>
                          <td>' . $row['nama'] . '</td>
                          <td>Rp. ' . number_format($row['total1'], 0, ',', '.') . '</td>
                          ';
                echo '
                  </tr>';
                $total += $row['total1'];
              }
              echo '
                  <tr>
                    <td colspan="6"><strong>TOTAL</strong></td>
                    <td><strong>Rp. ' . number_format($total, 0, ',', '.') . '</strong></td>
                  </tr>
                  </tbody>
                  </table>';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
    break;
}
?>