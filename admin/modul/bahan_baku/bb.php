<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/bahan_baku/aksi_bb.php";

$model = mysqli_query($koneksi, "SELECT * FROM bahan_baku");
$data = array();
while ($fetch = mysqli_fetch_assoc($model)) {
    $data[] = $fetch; //result dijadikan array 
}
switch ($_GET['act']) {

    case "list":
?>

        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item"><a href="#">Bahan-Bahan</a></li>
            <li class="breadcrumb-item"><a href="#">Bahan Baku</a></li>
            <li class="breadcrumb-item active">Daftar Bahan Baku</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Bahan Baku</h1>
            <a href="index.php?page=bb&act=tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Bahan Baku</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bahan Baku</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data) :
                                        $no = 1;
                                        foreach ($data as $bb) : ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $bb['nm_bb'] ?></td>
                                                <td class="text-right">Rp. <?= number_format($bb['hrg_bb'], 2) ?></td>
                                                <td><?= $bb['satuan_bb'] ?></td>
                                                <td class="text-center">
                                                    <a href="?page=bb&act=edit&id=<?= $bb['id_bb'] ?>" class="btn btn-warning btn-circle">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="<?= $aksi ?>?page=aksi_bb&act=hapus&id=<?= $bb['id_bb'] ?>" class="btn btn-danger btn-circle">
                                                        <i class="fas fa-trash"></i>
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

    case "tambah":
    ?>
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item"><a href="#">Bahan-Bahan</a></li>
            <li class="breadcrumb-item"><a href="#">Bahan Baku</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=bb&act=list">Daftar Bahan Baku</a></li>
            <li class="breadcrumb-item active">Tambah Bahan Baku</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-11"></div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="card bg-white rounded">
                            <div class="card-body">
                                <!-- <span class                     = 'title'>Tambah Pengguna</span><hr><br/> -->
                                <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_bb&act=input'>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="satu" class="col-sm-2 control-label">Nama Bahan Baku</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Nama Bahan Baku" name="nm_bb" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dua" class="col-sm-2 control-label">Harga Bahan Baku</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="number" class="form-control" placeholder="Harga per satuan" name="hrg_bb" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tiga" class="col-sm-2 control-label">Satuan</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Ukuran satuan" name="satuan_bb" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer" style="margin-left:-10px;">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                                            <a href=index.php?page=bb&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
                                        </div>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php
        break;


    case "edit":
        $edit                       = mysqli_query($koneksi, "SELECT * FROM bahan_baku WHERE id_bb='$_GET[id]'");
        while ($r    = mysqli_fetch_assoc($edit)) {
            $id_bb                      = $r['id_bb'];
            $kd_bb                      = $r['kd_bb'];
            $nm_bb                          = $r['nm_bb'];
            $hrg_bb                         = $r['hrg_bb'];
            $satuan_bb                         = $r['satuan_bb'];
        }
    ?>
        <ol class="breadcrumb" style="background-color: white;">
            <li><a href="#">Master Data</a></li>
            <li><a href="#">Bahan-Bahan</a></li>
            <li><a href="#">Bahan Baku</a></li>
            <li><a href="index.php?page=bb&act=list">Daftar Bahan Baku</a></li>
            <li class="active">Edit Data <?php echo $nm_bb; ?></li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-11"></div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="card rounded bg-white">
                            <div class="card-body">
                                <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_bb&act=edit'>
                                    <input type="hidden" class="form-control" name="id_bb" value="<?php echo $id_bb; ?>">
                                    <input type="hidden" class="form-control" name="kd_bb" value="<?php echo $kd_bb; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="satu" class="col-sm-2 control-label">Nama Bahan Baku</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="nm_bb" placeholder="Nama Bahan Baku" value="<?php echo $nm_bb; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dua" class="col-sm-2 control-label">Harga Bahan Baku</label>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" name="hrg_bb" placeholder="0" value="<?php echo $hrg_bb; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tiga" class="col-sm-2 control-label">Satuan</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Ukuran Satuan" name="satuan_bb" value="<?php echo $satuan_bb; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer" style="margin-left:-10px;">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                                            <a href=index.php?page=bb&act=list><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
                                        </div>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        break;
}
?>