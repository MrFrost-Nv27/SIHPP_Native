<?php
// get data from produk_detail
$id_produk = $_GET['id'];

if (isset($_POST['simpan'])) {

    $id_produk = $_POST['id_produk'];
    $id_bb = $_POST['bahan_baku'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];
    // code generator if old value >0 + 1
    $sql = "SELECT kode FROM detail_produk ORDER BY kode DESC LIMIT 1";

    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $kode = $row['kode'];
    // cek kode terakhir
    if ($kode) {
        $kode = substr($kode, 3, 3);
        $kode = (int) $kode;
        $kode = $kode + 1;
        $kode = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kode = "DPR" . $kode;
    } else {
        $kode = "DPR001";
    }
    // end code generator
    $query = "INSERT INTO detail_produk (id,kode, id_produk, id_bb, jumlah, satuan) VALUES ('','$kode', '$id_produk', '$id_bb', '$jumlah', '$satuan')";

    $result = mysqli_query($koneksi, $query);


    if ($result) {

        $_SESSION['flashdata'] = [
            'type' => 'success',
            'message' => 'Data berhasil ditambahkan!'
        ];
        echo "<script>window.history.back().refresh();</script>";
    } else {
        $_SESSION['flashdata'] = [
            'type' => 'error',
            'message' => 'Data gagal ditambahkan!'
        ];
        echo "<script>window.history.back().refresh();</script>";
    }
}
if (isset($_POST['hapus'])) {

    $code = $_POST['kode'];
    $query = "DELETE FROM detail_produk WHERE kode = '$code'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['flashdata'] = [
            'type' => 'success',
            'message' => 'Data berhasil dihapus!'
        ];
        echo "<script>window.history.back().refresh();</script>";
    } else {
        $_SESSION['flashdata'] = [
            'type' => 'error',
            'message' => 'Data gagal dihapus!'
        ];
        echo "<script>window.history.back().refresh();</script>";
    }
}


?>
<div class="row mb-3">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center text-bold">
                Billing of Material (BOM)
            </h3>

        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php
                // get data by id from produk
                $query = "SELECT * FROM produk WHERE id = '$id_produk'";
                $result = mysqli_query($koneksi, $query);
                $data = mysqli_fetch_array($result);

                ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kode">Kode Produk</label>
                            <input type="text" class="form-control" id="kode" name="kode" value="<?php echo $data['kode']; ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" readonly>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <form method="post">
                <div class="card-body">

                    <!-- <label for="id_produk">ID Produk</label> -->
                    <input type="text" class="form-control" id="id_produk" name="id_produk" value="<?php echo $data['id']; ?>" readonly hidden>


                    <?php
                    // select all from bahan baku
                    $query = "SELECT * FROM bahan_baku";
                    $result = mysqli_query($koneksi, $query);
                    ?>


                    <!-- select bahan baku -->
                    <div class="form-group">
                        <label for="bahan_baku">Bahan Baku</label>
                        <select class="form-control" id="bahan_baku" name="bahan_baku">
                            <option value="">Pilih Bahan Baku</option>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id_bb'] . "'>" . $row['nm_bb'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Data tidak ditemukan</option>";
                            }
                            ?>

                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan">
                            </div>
                        </div>
                    </div>



                </div>
                <!-- card footer -->
                <div class="card-footer">
                    <!-- button submit -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="col-md-7">
        <?php
        // get data from detail_produk by id_produk JOIN bahan_baku
        $query = "SELECT * FROM detail_produk JOIN bahan_baku ON detail_produk.id_bb = bahan_baku.id_bb WHERE id_produk = '$id_produk'";
        $result = mysqli_query($koneksi, $query);

        ?>

        <!-- table -->
        <div class="card">
            <div class="card-body">

                <?php
                //    session start
                if (isset($_SESSION['flashdata'])) {
                    $type = $_SESSION['flashdata']['type'];
                    $message = $_SESSION['flashdata']['message'];
                    echo "<div class='alert alert-$type'>$message</div>";
                    unset($_SESSION['flashdata']);
                }
                ?>



                <table class="table table-bordered datatables-init">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bahan Baku</th>
                            <th>Jumlah</th>
                            <th>satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // var_dump($row);
                                // die();
                                echo "<tr>";
                                echo "<td>" . $no . "</td>";
                                echo "<td>" . $row['nm_bb'] . "</td>";
                                echo "<td>" . $row['jumlah'] . "</td>";
                                echo "<td>" . $row['satuan'] . "</td>";
                                echo "<td>
                               
                                <form method='post'>
                                    <input type='text' name='kode' value='" . $row['kode'] . "' hidden>
                                    <button type='submit' name='hapus' class='btn btn-danger'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                </form>
                               
                                </td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='4' align='center'>Data tidak ditemukan</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>