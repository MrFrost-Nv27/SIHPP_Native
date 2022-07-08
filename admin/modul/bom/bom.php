<?php
// insert data to database with method post
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_produk'];
    $keterangan = $_POST['ket_produk'];

    $datetime = date("Y-m-d H:i:s");
    $query = "INSERT INTO produk (id,nama_produk,ket_produk,created_at ) VALUES ('', '$nama', '$keterangan', '$datetime')";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
        echo "<script>location.href='index.php?page=bom&act=list';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan!');</script>";
        echo "<script>location.href='index.php?page=bom&act=list';</script>";
    }
} elseif (isset($_POST['edit'])) {

    $id = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $keterangan = $_POST['ket_produk'];

    //   update
    $query = "UPDATE produk SET nama_produk = '$nama', ket_produk = '$keterangan' WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil diubah!');</script>";
        echo "<script>location.href='index.php?page=bom&act=list';</script>";
    } else {
        echo "<script>alert('Data gagal diubah!');</script>";
        echo "<script>location.href='index.php?page=bom&act=list';</script>";
    }
}



// delete data from database with method get
if ($_GET['act'] == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM produk WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
        echo "<script>location.href='index.php?page=bom&act=list';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus!');</script>";
        echo "<script>location.href='index.php?page=bom&act=list';</script>";
    }
}

?>


<div class="row mb-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- button modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Tambah Data
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- list table -->
                <table class="table datatables-init" style="width:100% ;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM produk";
                        $result = mysqli_query($koneksi, $query);
                        $i = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . $row['nama_produk'] . "</td>";
                                echo "<td>" . $row['ket_produk'] . "</td>";
                                echo "<td>
                            <button type='button' class='btn btn-editproduk btn-warning' data-toggle='modal' data-target='#modal-edit' data-id='" . $row['id'] . "' data-nama='" . $row['nama_produk'] . "' data-ket='" . $row['ket_produk'] . "'>
                            Edit
                            </button>
                            
                                <a href='index.php?page=bom&act=delete&id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>

                                <a href='index.php?page=bom_detail&act=list&id=" . $row['id'] . "' class='btn btn-info'>BOM</a>


                                </td>";
                                echo "</tr>";
                                $i++;
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



<!-- Modal Tambah data -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_bom">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama produk">
                    </div>
                    <div class="form-group">
                        <label for="ket_produk">Keterangan</label>
                        <input type="text" class="form-control" id="ket_produk" name="ket_produk" placeholder="Keterangan">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal Edit Data data-id -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_bom">Nama Produk</label>
                        <!-- input using data-id -->
                        <input type="text" class="form-control" id="modal_id_produk" name="id_produk" hidden>
                        <input type="text" class="form-control" id="modal_nama_produk" name="nama_produk">
                    </div>
                    <div class="form-group">
                        <label for="ket_produk">Keterangan</label>
                        <input type="text" class="form-control" id="modal_ket_produk" name="ket_produk" placeholder="Keterangan">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>