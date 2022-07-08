<?php
include "config/class_paging.php";
include "koneksi.php";
$aksi = "modul/produksi/aksi_produksi.php";
$model = mysqli_query($koneksi, "SELECT * FROM produksi");
$data = array();
while ($fetch = mysqli_fetch_assoc($model)) {
    $data[] = $fetch; //result dijadikan array 
}
switch ($_GET['act']) {

    case "list":
?>

        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item"><a href="#">Master Proses</a></li>
            <li class="breadcrumb-item"><a href="#">Produksi</a></li>
            <li class="breadcrumb-item active">Input Produksi</li>
        </ol>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <form class="form-inline" method="POST" action='<?php echo $aksi; ?>?page=aksi_produksi&act=tambah'>
                            <div class="form-group" style="margin-left: 12px;">
                                <label for="nm_produk">Nama Produk</label>
                                <select class="form-control" name="nm_produk" id="nm_produk" style="margin-left: 12px;">
                                    <?php
                                    $prdk = mysqli_query($koneksi, "SELECT * FROM produk");
                                    // if $prdk is empty, do nothing
                                    if (mysqli_num_rows($prdk) > 0) {
                                        while ($prdk_row = mysqli_fetch_assoc($prdk)) {
                                            echo "<option value='" . $prdk_row['nama_produk'] . "'>" . $prdk_row['nama_produk'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Tidak ada data</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 12px;">
                                <label for="exampleInputJumlah2">Jumlah</label>
                                <input type="number" class="form-control" id="exampleInputJumlah2" placeholder="0" name="jml_produksi" style="margin-left: 12px;">
                            </div>
                            <button type="submit" class="btn btn-primary active" style="margin-left: 12px;"><i class="glyphicon glyphicon-download-alt" aria-hidden="true"></i> Proses</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Produksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <td>Kode</td>
                                        <td>Produk</td>
                                        <td>Jumlah</td>
                                        <td>BBB</td>
                                        <td>BBP</td>
                                        <td>BTK</td>
                                        <td>BOP</td>
                                        <td>HPP</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data) :
                                        $no = 1;
                                        foreach ($data as $bb) : ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $bb['nmr_produksi'] ?></td>
                                                <td><?= $bb['nm_produk'] ?></td>
                                                <td><?= $bb['jml_produksi'] ?></td>
                                                <?php if ($bb['bbb'] > 0) : ?>
                                                    <td class="text-right">
                                                        <a href="?page=produksi&act=bbb&id=<?= $bb['id_produksi'] ?>">
                                                            Rp. <?= number_format($bb['bbb'], 2) ?>
                                                    </td>
                                                    </a>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        <a href="?page=produksi&act=bbb&id=<?= $bb['id_produksi'] ?>" class="btn btn-success btn-circle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($bb['bbp'] > 0) : ?>
                                                    <td class="text-right">
                                                        <a href="?page=produksi&act=bbp&id=<?= $bb['id_produksi'] ?>">
                                                            Rp. <?= number_format($bb['bbp'], 2) ?>
                                                    </td>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        <a href="?page=produksi&act=bbp&id=<?= $bb['id_produksi'] ?>" class="btn btn-info btn-circle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($bb['btk'] > 0) : ?>
                                                    <td class="text-right">
                                                        <a href="?page=produksi&act=btk&id=<?= $bb['id_produksi'] ?>">
                                                            Rp. <?= number_format($bb['btk'], 2) ?>
                                                    </td>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        <a href="?page=produksi&act=btk&id=<?= $bb['id_produksi'] ?>" class="btn btn-warning btn-circle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($bb['bop'] > 0) : ?>
                                                    <td class="text-right">
                                                        <a href="?page=produksi&act=bop&id=<?= $bb['id_produksi'] ?>">
                                                        
                                                            Rp. <?= number_format($bb['bop'], 2) ?>
                                                    </td>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        <a href="?page=produksi&act=bop&id=<?= $bb['id_produksi'] ?>" class="btn btn-danger btn-circle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>
                                                <?php endif ?>
                                                <?php if ($bb['bbb'] > 0 && $bb['bbp'] > 0 && $bb['btk'] > 0 && $bb['bop'] > 0) : ?>
                                                    <td class="text-right">
                                                        <a href="?page=produksi&act=hpp&id=<?= $bb['id_produksi'] ?>">
                                                            Rp. <?= number_format($bb['hpp'], 2) ?>
                                                    </td>
                                                    </a>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        HPP Belum Siap
                                                    </td>
                                                <?php endif ?>
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
            <li class="breadcrumb-item"><a href="#">Master Proses</a></li>
            <li class="breadcrumb-item"><a href="#">Produksi</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
            <li class="breadcrumb-item active">Biaya Bahan Baku Untuk <?php echo $nm_produk; ?></li>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="card bg-white rounded">
                            <div class="card-body">

                                <form class="form-inline" method="POST" action='<?php echo $aksi; ?>?page=aksi_produksi&act=bbb'>
                                    <div class="form-group" style="margin-left: 12px;">
                                        <label for="kd_bb">Bahan Baku</label>
                                        <select class="form-control ml-2" name="kd_bb" required>
                                            <option value="">Bahan Baku</option>
                                            <?php
                                            $bb = mysqli_query($koneksi, "SELECT * FROM bahan_baku");

                                            while ($rbb = mysqli_fetch_assoc($bb)) {

                                            ?>
                                                <option value="<?php echo $rbb['kd_bb']; ?>"><?php echo $rbb['nm_bb']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <input type="hidden" id="nmr" name="nmr" value="<?php echo $nmr_produksi; ?>">
                                    <input type="hidden" id="jml_produksi" name="jml_produksi" value="<?php echo $jml_produksi; ?>">
                                    <div class="form-group" style="margin-left: 12px;">
                                        <label for="jml">Jumlah</label>
                                        <input type="number" name="jml" id="jml" class="form-control ml-2" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary ml-2"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                        Tambah</button>
                                    <a href="index.php?page=produksi&act=list" class="btn btn-danger ml-2" role="button"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Bahan Baku</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>nama</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tampil = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE lvl='BBB' and nmr_produksi='$nmr_produksi'");
                                    $no = 1;
                                    while ($r = mysqli_fetch_assoc($tampil)) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $r['kode'] ?></td>
                                            <td><?= $r['nama'] ?></td>
                                            <td><?= 'Rp.' . number_format($r['harga'], 2) ?></td>
                                            <td><?= $r['keterangan'] ?></td>
                                            <td><?= $r['jumlah'] ?></td>
                                            <td class="text-right">Rp. <?= number_format($r['total'], 2) ?></td>
                                            <td class="text-center">
                                                <a href="<?= $aksi ?>?page=aksi_produksi&act=hapusbbb&id=<?= $r['nmr_produksi'] ?>&kd=<?= $r['kode'] ?>" class="btn btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endwhile; ?>
                                </tbody>
                            </table>
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
            <li class="breadcrumb-item"><a href="#">Master Proses</a></li>
            <li class="breadcrumb-item"><a href="#">Produksi</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
            <li class="breadcrumb-item active">Biaya Bahan Penolong Untuk <?php echo $nm_produk; ?></li>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <form class="form-inline" method="POST" action='<?php echo $aksi; ?>?page=aksi_produksi&act=bbp'>
                            <div class="form-group" style="margin-left: 12px;">
                                <label for="kd_bp">Bahan Penolong</label>
                                <select class="form-control ml-2" name="kd_bp" required>
                                    <option value="">Bahan Penolong</option>
                                    <?php
                                    $bb = mysqli_query($koneksi, "SELECT * FROM bahan_penolong");

                                    while ($rbb = mysqli_fetch_assoc($bb)) {

                                    ?>
                                        <option value="<?php echo $rbb['kd_bp']; ?>"><?php echo $rbb['nm_bp']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" id="nmr" name="nmr" value="<?php echo $nmr_produksi; ?>">
                            <input type="hidden" id="jml_produksi" name="jml_produksi" value="<?php echo $jml_produksi; ?>">
                            <div class="form-group" style="margin-left: 12px;">
                                <label for="jml">Jumlah</label>
                                <input type="number" name="jml" id="jml" class="form-control ml-2" required>
                            </div>
                            <button type="submit" class="btn btn-primary ml-2"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                Tambah</button>
                            <a href="index.php?page=produksi&act=list" class="btn btn-danger ml-2" role="button"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Bahan Penolong</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>nama</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tampil = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE lvl='BBP' and nmr_produksi='$nmr_produksi'");
                                    $no = 1;
                                    while ($r = mysqli_fetch_assoc($tampil)) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $r['kode'] ?></td>
                                            <td><?= $r['nama'] ?></td>
                                            <td><?= 'Rp.' . number_format($r['harga'], 2) ?></td>
                                            <td><?= $r['keterangan'] ?></td>
                                            <td><?= $r['jumlah'] ?></td>
                                            <td class="text-right">Rp. <?= number_format($r['total'], 2) ?></td>
                                            <td class="text-center">
                                                <a href="<?= $aksi ?>?page=aksi_produksi&act=hapusbbp&id=<?= $r['nmr_produksi'] ?>&kd=<?= $r['kode'] ?>" class="btn btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endwhile; ?>
                                </tbody>
                            </table>
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
            <li class="breadcrumb-item"><a href="#">Master Proses</a></li>
            <li class="breadcrumb-item"><a href="#">Produksi</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
            <li class="breadcrumb-item active">Biaya Pekerja <?php echo $nm_produk; ?></li>
        </ol>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <form class="form-inline" method="POST" action='<?php echo $aksi; ?>?page=aksi_produksi&act=btk'>
                            <div class="form-group" style="margin-left: 12px;">
                                <label for="id_tenaker">Tenaga Kerja</label>
                                <select class="form-control ml-2" name="id_tenaker" required>
                                    <option value="">Pilih Tenaga Kerja</option>
                                    <?php
                                    $bb = mysqli_query($koneksi, "SELECT * FROM tenaker");

                                    while ($rbb = mysqli_fetch_assoc($bb)) {

                                    ?>
                                        <option value="<?php echo $rbb['id_tenaker']; ?>"><?php echo $rbb['nm_tenaker']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" id="nmr" name="nmr" value="<?php echo $nmr_produksi; ?>">
                            <input type="hidden" id="jml_produksi" name="jml_produksi" value="<?php echo $jml_produksi; ?>">
                            <button type="submit" class="btn btn-primary ml-2"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                Tambah</button>
                            <a href="index.php?page=produksi&act=list" class="btn btn-danger ml-2" role="button"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Tenaga Kerja</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Upah</th>
                                        <th>Bagian</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tampil = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE lvl='BTK' and nmr_produksi='$nmr_produksi'");
                                    $no = 1;
                                    while ($r = mysqli_fetch_assoc($tampil)) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $r['kode'] ?></td>
                                            <td><?= $r['nama'] ?></td>
                                            <td><?= 'Rp.' . number_format($r['harga'], 2) ?></td>
                                            <td><?= $r['keterangan'] ?></td>
                                            <td><?= $r['jumlah'] ?></td>
                                            <td class="text-right">Rp. <?= number_format($r['total'], 2) ?></td>
                                            <td class="text-center">
                                                <a href="<?= $aksi ?>?page=aksi_produksi&act=hapusbtk&id=<?= $r['nmr_produksi'] ?>&kd=<?= $r['kode'] ?>" class="btn btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endwhile; ?>
                                </tbody>
                            </table>
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
            <li class="breadcrumb-item"><a href="#">Master Proses</a></li>
            <li class="breadcrumb-item"><a href="#">Produksi</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
            <li class="breadcrumb-item active">Biaya overhead pabrik untuk produksi <?php echo $nm_produk; ?></li>
        </ol>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <form class="form-inline" method="POST" action='<?php echo $aksi; ?>?page=aksi_produksi&act=bop'>
                            <div class="form-group" style="margin-left: 12px;">
                                <label for="kd_overp">Overhead</label>
                                <select class="form-control ml-2" name="kd_overp" required>
                                    <option value="">Pilih Overhead</option>
                                    <?php
                                    $bb = mysqli_query($koneksi, "SELECT * FROM overhead_pabrik");

                                    while ($rbb = mysqli_fetch_assoc($bb)) {

                                    ?>
                                        <option value="<?php echo $rbb['kd_overp']; ?>"><?php echo $rbb['nm_overp']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" id="nmr" name="nmr" value="<?php echo $nmr_produksi; ?>">
                            <input type="hidden" id="jml_produksi" name="jml_produksi" value="<?php echo $jml_produksi; ?>">
                            <button type="submit" class="btn btn-primary ml-2"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                Tambah</button>
                            <a href="index.php?page=produksi&act=list" class="btn btn-danger ml-2" role="button"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Overhead Pabrik</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables-init" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Biaya</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tampil = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE lvl='BOP' and nmr_produksi='$nmr_produksi'");
                                    $no = 1;
                                    while ($r = mysqli_fetch_assoc($tampil)) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $r['kode'] ?></td>
                                            <td><?= $r['nama'] ?></td>
                                            <td><?= 'Rp.' . number_format($r['harga'], 2) ?></td>
                                            <td><?= $r['jumlah'] ?></td>
                                            <td class="text-right">Rp. <?= number_format($r['total'], 2) ?></td>
                                            <td class="text-center">
                                                <a href="<?= $aksi ?>?page=aksi_produksi&act=hapusbop&id=<?= $r['nmr_produksi'] ?>&kd=<?= $r['kode'] ?>" class="btn btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endwhile; ?>
                                </tbody>
                            </table>
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
            $hpppi = $r['hpp'] / $jml_produksi;
            $hpppi2 = "Rp. " . number_format($hpppi, 2, ',', '.');
            $ma = $hpppi * 0.6;
            $ma2 = "Rp. " . number_format($ma, 2, ',', '.');
            $tgt = $hpppi + $ma;
            $tgt2 = "Rp. " . number_format($tgt, 2, ',', '.');
            $lb = ($tgt * $jml_produksi) - $r['hpp'];
            $lb2 = "Rp. " . number_format($lb, 2, ',', '.');
        }
    ?>
        <ol class="breadcrumb" style="background-color: white;">
            <li class="breadcrumb-item"><a href="#">Master Proses</a></li>
            <li class="breadcrumb-item"><a href="#">Produksi</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=produksi&act=list">Daftar Produksi</a></li>
            <li class="breadcrumb-item active">Harga Pokok Produksi <?php echo $nm_produk; ?></li>
        </ol>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Produksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <div class="pill badge-primary text-center">Info Produksi</div>
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Biaya Bahan Baku</th>
                                                <td><?= $bbb ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Biaya Bahan Penolong</th>
                                                <td><?= $bbp ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Biaya Tenaga Kerja</th>
                                                <td><?= $btk ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Biaya Overhead</th>
                                                <td><?= $bop ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"> -- </th>
                                                <td> -- </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total Biaya</th>
                                                <td><?= $hpp ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">HPP</th>
                                                <td><?= $hpppi2 ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <div class="pill badge-warning text-center">Info Penjualan</div>
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Kode Produksi</th>
                                                <td><?= $nmr_produksi ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nama Produksi</th>
                                                <td><?= $nm_produk ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jumlah Produksi</th>
                                                <td><?= $jml_produksi ?> Unit/item</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">HPP</th>
                                                <td><?= $hpppi2 ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">&#37; Mark-up x HPP</th>
                                                <td>&plusmn; <?= $ma2 ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Terget Penjualan</th>
                                                <td>&plusmn; <?= $tgt2 ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Estimasi Laba</th>
                                                <th>&plusmn; <?= $lb2 ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col text-center"><a href="?page=produksi&act=list" role="button" class="btn btn-danger">Kembali</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        break;
}
?>