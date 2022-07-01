<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/bahan_penolong/aksi_bp.php";
$model = mysqli_query($koneksi, "SELECT * FROM bahan_penolong");
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
            <li class="breadcrumb-item"><a href="#">Bahan Penolong</a></li>
            <li class="breadcrumb-item active">Daftar Bahan Penolong</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Bahan Penolong</h1>
            <a href="index.php?page=bp&act=tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Bahan Penolong</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bahan Penolong</th>
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
                                                <td><?= $bb['nm_bp'] ?></td>
                                                <td class="text-right">Rp. <?= number_format($bb['hrg_bp'], 2) ?></td>
                                                <td><?= $bb['satuan_bp'] ?></td>
                                                <td class="text-center">
                                                    <a href="?page=bp&act=edit&id=<?= $bb['id_bp'] ?>" class="btn btn-warning btn-circle">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="<?= $aksi ?>?page=aksi_bp&act=hapus&id=<?= $bb['id_bp'] ?>" class="btn btn-danger btn-circle">
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
            <li class="breadcrumb-item"><a href="#">Bahan Penolong</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=bp&act=list">Daftar Bahan Penolong</a></li>
            <li class="breadcrumb-item active">Tambah Bahan Penolong</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-11"></div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <!-- <span class                     = 'title'>Tambah Pengguna</span><hr><br/> -->
                        <div class="card bg-white rounded">
                            <div class="card-body">
                                <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_bp&act=input'>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="satu" class="col control-label">Nama Bahan Penolong</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Nama Bahan Penolong" name="nm_bp">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dua" class="col control-label">Harga Bahan Penolong</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="number" class="form-control" placeholder="Harga per satuan" name="hrg_bp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tiga" class="col control-label">Satuan</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Ukuran satuan" name="satuan_bp">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer" style="margin-left:-10px;">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                                            <a href="index.php?page=bp&act=list" class="btn btn-danger"><i class="fa fa-ban"></i>
                                                Batal</a>
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
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item"><a href="#">Bahan-Bahan</a></li>
            <li class="breadcrumb-item"><a href="#">Bahan Penolong</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=bp&act=list">Daftar Bahan Penolong</a></li>
            <li class="breadcrumb-item active">Edit Data <?php echo $nm_bp; ?></li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-11"></div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="card rounded bg-white">
                            <div class="card-body">
                                <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_bp&act=edit'>
                                    <input type="hidden" class="form-control" name="id_bp" value="<?php echo $id_bp; ?>">
                                    <input type="hidden" class="form-control" name="kd_bp" value="<?php echo $kd_bp; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="satu" class="col control-label">Nama Bahan Penolong</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="nm_bp" placeholder="Nama Bahan Penolong" value="<?php echo $nm_bp; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dua" class="col control-label">Harga Bahan Penolong</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="number" class="form-control" name="hrg_bp" placeholder="0" value="<?php echo $hrg_bp; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tiga" class="col control-label">Satuan</label>
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
            </div>
        </div>
<?php
        break;
}
?>