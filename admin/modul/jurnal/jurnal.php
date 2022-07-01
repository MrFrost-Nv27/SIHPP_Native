<?php
include "config/class_paging.php";
include "koneksi.php";

$bulanlist = [
  '01' => 'Januari',
  '02' => 'Februari',
  '03' => 'Maret',
  '04' => 'April',
  '05' => 'Mei',
  '06' => 'Juni',
  '07' => 'Juli',
  '08' => 'Agustus',
  '09' => 'September',
  '10' => 'Oktober',
  '11' => 'November',
  '12' => 'Desember',
];

$periode = isset($_POST['bulan']) && isset($_POST['tahun']) ? "$_POST[tahun]-$_POST[bulan]" : false;
$data = null;
$jurnal = array();
if ($periode) {
  $data = mysqli_query($koneksi, "SELECT * FROM detail_produksi WHERE tanggal LIKE '$periode%'");
  if (mysqli_num_rows($data) > 0) {
    while ($fetch = mysqli_fetch_assoc($data)) {
      $jurnal[] = $fetch; //result dijadikan array 
    }
  }
}

?>

<ol class="breadcrumb" style="background-color: white;">
    <li class="breadcrumb-item"><a href="3">Laporan</a></li>
    <li class="breadcrumb-item active">Jurnal Umum</li>
</ol>
<div class="row my-4">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <form class="form-inline" method="POST">
                    <div class="form-group ml-2">
                        <label for="id_tenaker">Bulan</label>
                        <select class="form-control ml-2" name="bulan" required>
                            <option value="">Pilih Bulan</option>
                            <?php foreach ($bulanlist as $key => $value) : ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group ml-2">
                        <label for="id_tenaker">Tahun</label>
                        <select class="form-control ml-2" name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            <?php for ($i = 2015; $i <= date('Y'); $i++) : ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary ml-2"><i class="glyphicon glyphicon-plus"
                            aria-hidden="true"></i>
                        Tampilkan Jurnal Umum</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Jurnal Umum</h6>
                    <?php if ($jurnal) : ?>
                    <a href="#!" role="button" class="btn btn-success" onclick="printDiv('jurnal')">Print</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="card-body" id="jurnal">
                <?php if ($periode) : ?>
                <?php if ($jurnal) : ?>
                <div class="row text-center">
                    <div class="col">
                        <p>SI HPP<br>Jurnal Umum<br>Periode <?= $bulanlist[$_POST['bulan']] ?> - <?= $_POST['tahun'] ?>
                        </p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <th>Tanggal</th>
                                <th>Rekening</th>
                                <th>Ref</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                            <?php foreach ($jurnal as $j) : ?>
                            <tr>
                                <td><?= $j['tanggal'] ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6"><?= $j['kode'] ?></div>
                                        <div class="col-6"></div>
                                    </div>
                                </td>
                                <td><?= rand(100, 999) ?></td>
                                <td>Rp. <?= number_format($j['total']) ?></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><?= $j['tanggal'] ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-6"></div>
                                        <div class="col-6"><?= $j['nama'] ?></div>
                                    </div>
                                </td>
                                <td><?= rand(100, 999) ?></td>
                                <td>-</td>
                                <td>Rp. <?= number_format($j['total']) ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <?php else : ?>
                <div class="alert alert-warning" role="alert">
                    Tidak ada data jurnal pada periode yang anda pilih!
                </div>
                <?php endif ?>
                <?php else : ?>
                <div class="alert alert-success" role="alert">
                    Anda Belum Memilih Periode!
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>