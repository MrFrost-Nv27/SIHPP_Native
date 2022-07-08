 <?php
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'home':
                include 'home.php';
                break;
            case 'user':
                include 'modul/user/user.php';
                break;
            case 'aksi_user':
                include 'modul/user/aksi_user.php';
                break;
            case 'tenaker':
                include 'modul/tenaker/tenaker.php';
                break;
            case 'aksi_tenaker':
                include 'modul/tenaker/aksi_tenaker.php';
                break;
            case 'bb':
                include 'modul/bahan_baku/bb.php';
                break;
            case 'aksi_bb':
                include 'modul/bahan_baku/aksi_bb.php';
                break;
            case 'bp':
                include 'modul/bahan_penolong/bp.php';
                break;
            case 'aksi_bp':
                include 'modul/bahan_penolong/aksi_bp.php';
                break;
            case 'overhead':
                include 'modul/overhead/op.php';
                break;
            case 'aksi_overhead':
                include 'modul/overhead/aksi_op.php';
                break;
            case 'stok_bb':
                include 'modul/stok_barang_baku/stok.php';
                break;
            case 'aksi_stok_bb':
                include 'modul/stok_barang_baku/aksi_stok.php';
                break;
            case 'stok_bp':
                include 'modul/stok_barang_penolong/stok.php';
                break;
            case 'aksi_stok_bp':
                include 'modul/stok_barang_penolong/aksi_stok.php';
                break;
            case 'produksi':
                include 'modul/produksi/produksi.php';
                break;
            case 'aksi_produksi':
                include 'modul/produksi/aksi_produksi.php';
                break;
            case 'laporan':
                include 'modul/laporan/laporan.php';
                break;
            case 'jurnal':
                include 'modul/jurnal/jurnal.php';
                break;
            case 'bom':
                include 'modul/bom/bom.php';
                break;
            case 'bom_detail':
                include 'modul/bom/bom_detail.php';
                break;
        }
    }
    ?>