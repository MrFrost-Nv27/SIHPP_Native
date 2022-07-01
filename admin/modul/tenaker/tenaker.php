<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi                           = "modul/tenaker/aksi_tenaker.php";
$model = mysqli_query($koneksi, "SELECT * FROM tenaker");
$data = array();
while ($fetch = mysqli_fetch_assoc($model)) {
    $data[] = $fetch; //result dijadikan array 
}
switch ($_GET['act']) {

    case "list":
?>

        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item"><a href="#">Tenaga Kerja</a></li>
            <li class="breadcrumb-item active">Daftar Tenaga Kerja</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Tenaga Kerja</h1>
            <a href="index.php?page=tenaker&act=tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Tenaga Kerja</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Bagian</th>
                                        <th>Upah</th>
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
                                                <td><?= $bb['nm_tenaker'] ?></td>
                                                <td><?= $bb['bag_tenaker'] ?></td>
                                                <td class="text-right">Rp. <?= number_format($bb['upah_tenaker'], 2) ?></td>
                                                <td class="text-center">
                                                    <a href="?page=tenaker&act=edit&id=<?= $bb['id_tenaker'] ?>" class="btn btn-warning btn-circle">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="<?= $aksi ?>?page=aksi_tenaker&act=hapus&id=<?= $bb['id_tenaker'] ?>" class="btn btn-danger btn-circle">
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

    case "list2":
    ?>
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item"><a href="#">Tenaga Kerja</a></li>
            <li class="breadcrumb-item active">Biaya Tenaga Kerja</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gaji Tenaga Kerja</h1>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Gaji Tenaga Kerja</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Bagian Kerja</th>
                                        <th>Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data) :
                                        $no = 1;
                                        foreach ($data as $bb) : ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $bb['nm_tenaker'] ?></td>
                                                <td><?= $bb['bag_tenaker'] ?></td>
                                                <td class="text-right">Rp. <?= number_format($bb['ttl_pendapatan'], 2) ?></td>
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
            <li class="breadcrumb-item"><a href="#">Tenaga Kerja</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=tenaker&act=list">Daftar Tenaga Kerja</a></li>
            <li class="breadcrumb-item active">Tambah Tenaga Kerja</li>
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
                                <form class='form-horizontal' id='registerHere' method='post' action='<?php echo $aksi; ?>?page=aksi_tenaker&act=input'>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="dua" class="col control-label">Nama Lengkap</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" placeholder="Nama Lengkap" name="nm_tenaker">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col control-label">Bagian</label>
                                            <div class="col-sm-4 selectContainer">
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
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="number" class="form-control" placeholder="0" name="upah_tenaker">
                                                </div>
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
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item"><a href="#">Tenaga Kerja</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=tenaker&act=list">Daftar Tenaga Kerja</a></li>
            <li class="breadcrumb-item active">Edit Data <?php echo $nama; ?></li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-11"></div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="card rounded bg-white">
                            <div class="card-body">
                                <form class='form-horizontal' id='registerHere' method='post' action='<?= $aksi; ?>?page=aksi_tenaker&act=edit'>
                                    <input type="hidden" class="form-control" name="id_tenaker" value="<?php echo $id_tenaker; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="satu" class="col-sm-2 control-label">Nama Lengkap</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="nm_tenaker" placeholder="Nama Lengkap" value="<?php echo $nm_tenaker; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col control-label">Bagian Kerja</label>
                                            <div class="col-sm-4 selectContainer">
                                                <select class="form-control" name="bag_tenaker">
                                                    <option value="<?php echo $bag_tenaker; ?>" style="color:white; background-color:light-blue;"><?php echo $bag_tenaker; ?>
                                                    </option>
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
                                            <a href="index.php?page=tenaker&act=list"><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i> Batal</button></a>
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