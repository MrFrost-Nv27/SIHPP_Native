<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi                           = "modul/stok_barang_baku/aksi_stok.php";
$model = mysqli_query($koneksi, "SELECT * FROM bahan_baku INNER JOIN persediaan_bahan_baku ON bahan_baku.kd_bb=persediaan_bahan_baku.kd_pb");
$data = array();
while ($fetch = mysqli_fetch_assoc($model)) {
    $data[] = $fetch; //result dijadikan array 
}
switch ($_GET['act']) {

    case "tambah":
        try {
            $edit = mysqli_query($koneksi, "SELECT * FROM bahan_baku INNER JOIN persediaan_bahan_baku ON bahan_baku.kd_bb=persediaan_bahan_baku.kd_pb WHERE id_bb ='$_GET[id]'");
            $bahan_baku = mysqli_fetch_assoc($edit);
        } catch (\Throwable $th) {
            var_dump($th);
        }
?>
<ol class="breadcrumb" style="background-color: white;">
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="#">Bahan Baku</a></li>
    <li class="breadcrumb-item"><a href="index.php?page=stok_bb&act=list">Daftar Persediaan Bahan Baku</a></li>
    <li class="breadcrumb-item active">Edit Data Stok <?php echo $kd_pb; ?></li>
</ol>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-11"></div>
        <div class="box box-info">
            <div class="box-header with-border">
                <form class='form-horizontal' id='registerHere' method='post'
                    action='<?php echo $aksi; ?>?page=aksi_stok_bb&act=edit'>
                    <input type="hidden" class="form-control" name="kode" value="<?= $bahan_baku['kd_bb']; ?>">
                    <input type="hidden" class="form-control" name="harga" value="<?= $bahan_baku['hrg_bb']; ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="satu" class="col-sm-3 control-label">Jumlah Bahan di Gudang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="stok_asli" placeholder="Jumlah Bahan"
                                    value="<?= $bahan_baku['stok_pb']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-3 control-label">Tambah Jumlah Bahan</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="stok_tambah" placeholder="Jumlah Bahan"
                                    value="0">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer" style="margin-left:-15px;">
                            <div class="col-sm-10 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"
                                        aria-hidden="true"></i> Tambah</button>
                                <a role="button" class="btn btn-danger" href="index.php?page=stok_bb&act=list"><i
                                        class="fa fa-ban"></i> Batal</button></a>
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
    <li class="breadcrumb-item"><a href="index.php?page=bb&act=list">Bahan Baku</a></li>
    <li class="breadcrumb-item active">Daftar Persediaan Bahan Baku</li>
</ol>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Bahan Baku</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Stok Bahan Baku</h6>
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
                                <td><?= $bb['nm_bb'] ?></td>
                                <td class="text-right">Rp. <?= number_format($bb['hrg_bb'], 2) ?></td>
                                <td><?= $bb['stok_pb'] ?></td>
                                <td class="text-right">Rp. <?= number_format($bb['tot_pb'], 2) ?></td>
                                <td class="text-center">
                                    <a href="?page=stok_bb&act=tambah&id=<?= $bb['id_bb'] ?>"
                                        class="btn btn-success btn-circle">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="?page=stok_bb&act=lihat&id=<?= $bb['id_bb'] ?>"
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
            $edit = mysqli_query($koneksi, "SELECT * FROM bahan_baku INNER JOIN persediaan_bahan_baku ON bahan_baku.kd_bb=persediaan_bahan_baku.kd_pb WHERE id_bb ='$_GET[id]'");
            $bahan_baku = mysqli_fetch_assoc($edit);
        } catch (\Throwable $th) {
            var_dump($th);
        }
    ?>
<ol class="breadcrumb" style="background-color: white;">
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="#">Bahan Baku</a></li>
    <li class="breadcrumb-item"><a href="index.php?page=stok_bb&act=list">Daftar Persediaan Bahan Baku</a></li>
    <li class="breadcrumb-item active">Cek Data <?php echo $kd_pb; ?></li>
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
                                    <?= $bahan_baku['tgl_bb'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Kode Bahan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_baku['kd_bb'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Nama Bahan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_baku['nm_bb'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Satuan Bahan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_baku['satuan_bb'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Harga Satuan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">: Rp.
                                    <?= number_format($bahan_baku['hrg_bb'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Jumlah Bahan</label>
                            <div class="col-sm-4">
                                <p class="form-control-static" style="margin-bottom: -15px;">:
                                    <?= $bahan_baku['stok_pb'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satu" class="col-sm-2 control-label">Total Harga</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">: Rp.
                                    <?= number_format($bahan_baku['tot_pb'], 0, ',', '.') ?>
                                </p>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="margin-left:-10px;">
                        <div class="col-sm-10 col-sm-offset-2">
                            <a href=index.php?page=stok_bb&act=list><button type="button" class="btn btn-danger"><i
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