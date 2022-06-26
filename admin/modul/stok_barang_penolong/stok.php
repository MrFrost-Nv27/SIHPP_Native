<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi                           = "modul/stok_barang_penolong/aksi_stok.php";

$model = mysqli_query($koneksi, "SELECT * FROM bahan_penolong INNER JOIN persediaan_bahan_penolong ON bahan_penolong.kd_bp=persediaan_bahan_penolong.kd_pb");
$data = array();
while ($fetch = mysqli_fetch_assoc($model)) {
  $data[] = $fetch; //result dijadikan array 
}

switch ($_GET['act']) {

  case "tambah":
    try {
      $edit = mysqli_query($koneksi, "SELECT * FROM bahan_penolong INNER JOIN persediaan_bahan_penolong ON bahan_penolong.kd_bp=persediaan_bahan_penolong.kd_pb WHERE id_bp ='$_GET[id]'");
      $bahan_penolong = mysqli_fetch_assoc($edit);
    } catch (\Throwable $th) {
      var_dump($th);
    }
?>
<ol class="breadcrumb" style="background-color: white;">
    <li class="breadcrumb-item"><a href="#">Master Proses</a></li>
    <li class="breadcrumb-item"><a href="#">Persediaan Bahan</a></li>
    <li class="breadcrumb-item"><a href="index.php?page=stok_bp&act=list">Daftar Persediaan Bahan</a></li>
    <li class="breadcrumb-item active">Edit Data <?= $bahan_penolong['kd_pb']; ?></li>
</ol>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
            <div class="box-header with-border">
                <form class='form-horizontal' id='registerHere' method='post'
                    action='<?= $aksi; ?>?page=aksi_stok_bp&act=edit'>
                    <input type="hidden" class="form-control" name="kd_pb" value="<?= $bahan_penolong['kd_pb']; ?>">
                    <input type="hidden" class="form-control" name="hrg_pb" value="<?= $bahan_penolong['hrg_pb']; ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="satu" class="col-sm-3 control-label">Jumlah Bahan di Gudang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="stok_pb_asli" placeholder="Jumlah Bahan"
                                    value="<?= $bahan_penolong['stok_pb']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-3 control-label">Tambah Jumlah Bahan</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="stok_pb" placeholder="Jumlah Bahan"
                                    value="0">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer" style="margin-left:-15px;">
                            <div class="col-sm-10 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"
                                        aria-hidden="true"></i> Tambah</button>
                                <a href="index.php?page=stok_bp&act=list" role="button" class="btn btn-danger"><i
                                        class="fa fa-ban"></i> Batal</a>
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
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="#">Bahan Penolong</a></li>
    <li class="breadcrumb-item active">Daftar Persediaan Bahan Penolong</li>
</ol>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Bahan Penolong</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Stok Bahan Penolong</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered datatables-init" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <td>Tanggal</td>
                                <td>Nama Bahan</td>
                                <td>Harga Satuan</td>
                                <td>Stok</td>
                                <td>Total Harga</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                  if ($data) :
                    $no = 1;
                    foreach ($data as $bb) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $bb['tgl_pb'] ?></td>
                                <td><?= $bb['nm_bp'] ?></td>
                                <td class="text-right">Rp. <?= number_format($bb['hrg_bp'], 2) ?></td>
                                <td><?= $bb['stok_pb'] ?></td>
                                <td class="text-right">Rp. <?= number_format($bb['tot_pb'], 2) ?></td>
                                <td class="text-center">
                                    <a href="?page=stok_bp&act=tambah&id=<?= $bb['id_bp'] ?>"
                                        class="btn btn-success btn-circle">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="?page=stok_bp&act=lihat&id=<?= $bb['id_bp'] ?>"
                                        class="btn btn-info btn-circle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                      $no++;
                    endforeach;
                  endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    break;

  case "lihat":
    try {
      $edit = mysqli_query($koneksi, "SELECT * FROM bahan_penolong INNER JOIN persediaan_bahan_penolong ON bahan_penolong.kd_bp=persediaan_bahan_penolong.kd_pb WHERE id_bp ='$_GET[id]'");
      $bahan_penolong = mysqli_fetch_assoc($edit);
    } catch (\Throwable $th) {
      var_dump($th);
    }
  ?>
<ol class="breadcrumb" style="background-color: white;">
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="#">Bahan Penolong</a></li>
    <li class="breadcrumb-item"><a href="index.php?page=stok_bp&act=list">Daftar Persediaan Bahan Penolong</a></li>
    <li class="breadcrumb-item active">Cek Data <?= $kd_pb; ?></li>
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
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_penolong['tgl_pb']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Kode Bahan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_penolong['kd_pb']; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Nama Bahan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_penolong['nm_pb']; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Satuan Bahan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_penolong['satuan_bp']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Harga Satuan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">: Rp.
                                    <?= number_format($bahan_penolong['hrg_pb'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Jumlah Bahan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_penolong['stok_pb']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Total Harga</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">: Rp.
                                    <?= number_format($bahan_penolong['tot_pb'], 0, ',', '.') ?>
                                </p>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="margin-left:-10px;">
                        <div class="col-sm-10 col-sm-offset-2">
                            <a href="index.php?page=stok_bp&act=list" class="btn btn-danger" role="button"><i
                                    class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
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