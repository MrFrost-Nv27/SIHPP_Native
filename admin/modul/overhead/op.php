<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/overhead/aksi_op.php";
$model = mysqli_query($koneksi, "SELECT * FROM overhead_pabrik");
$data = array();
while ($fetch = mysqli_fetch_assoc($model)) {
    $data[] = $fetch; //result dijadikan array 
}
switch ($_GET['act']) {

    case "list":
?>

        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item"><a href="#">Overhead Pabrik</a></li>
            <li class="breadcrumb-item active">Daftar Overhead Pabrik</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Overhead Pabrik</h1>
            <a href="index.php?page=overhead&act=tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Overhead Pabrik</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Overhead Pabrik</th>
                                        <th>Biaya</th>
                                        <th>Keterangan</th>
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
                                                <td><?= $bb['nm_overp'] ?></td>
                                                <td class="text-right">Rp. <?= number_format($bb['by_overp'], 2) ?></td>
                                                <td><?= $bb['ket_overp'] ?></td>
                                                <td class="text-center">
                                                    <a href="?page=overhead&act=edit&id=<?= $bb['id_overp'] ?>" class="btn btn-warning btn-circle">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="<?= $aksi ?>?page=aksi_op&act=hapus&id=<?= $bb['id_overp'] ?>" class="btn btn-danger btn-circle">
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
            <li class="breadcrumb-item"><a href="index.php?page=overhead&act=list">Daftar Overhead Pabrik</a></li>
            <li class="breadcrumb-item active">Tambah Data Overhead Pabrik</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-11"></div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <!-- <span class              
                       = 'title'>Tambah Pengguna</span><hr><br/> -->
                        <div class="card rounded bg-white">
                            <div class="card-body">
                                <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_overhead&act=input'>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="satu" class="col control-label">Nama Biaya Overhead</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Nama Overhead" name="nm_overp">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dua" class="col control-label">Total Biaya Overhead</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="number" class="form-control" placeholder="Total Biaya" name="by_overp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tiga" class="col control-label">Keterangan</label>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" rows="3" name="ket_overp"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer" style="margin-left:-10px;">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                                            <a href="index.php?page=overhead&act=list" class="btn btn-danger" role="button"><i class="fa fa-ban"></i> Batal</button></a>
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
        $edit = mysqli_query($koneksi, "SELECT * FROM overhead_pabrik WHERE id_overp='$_GET[id]'");
        while ($r    = mysqli_fetch_assoc($edit)) {
            $id_overp = $r['id_overp'];
            $kd_overp = $r['kd_overp'];
            $nm_overp = $r['nm_overp'];
            $by_overp = $r['by_overp'];
            $ket_overp = $r['ket_overp'];
        }
    ?>
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item"><a href="#">Bahan-Bahan</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=overhead&act=list">Daftar Overhead Pabrik</a></li>
            <li class="breadcrumb-item active">Edit Data <?php echo $kd_overp; ?></li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-11"></div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="card rounded bg-white">
                            <div class="card-body">
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
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="number" class="form-control" name="by_overp" placeholder="0" value="<?php echo $by_overp; ?>">
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
                                            <a href="index.php?page=overhead&act=list" class="btn btn-danger" role="button"><i class="fa fa-ban"></i> Batal</button></a>
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