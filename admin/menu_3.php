<style type="text/css">
.sidebar .sidebar-menu .treeview :hover{
  background-color: #111;
}
</style>

<aside class="main-sidebar bg-black">
  <!-- sidebar          : style can be found in sidebar.less -->
  <section class="sidebar bg-black">
    <!-- Sidebar user panel -->
    <!-- search form -->
    <!-- sidebar menu   : : style can be found in sidebar.less -->
    <ul class="sidebar-menu bg-black">
      <!-- <li class         = "header text-center" style="margin-top: 15px;"> -->
      <!-- <i class        = "glyphicon glyphicon-ok-sign" style="color:green;"></i><span> Signed in as <?php echo $nm_log; ?></span> -->
      <!-- </li> -->
      <li class="treeview" style="margin-top: 15px;">
        <a href="index.php?page=home" style="color: white;">
          <i class="glyphicon glyphicon-home"></i> <span>Beranda</span>
        </a>
      </li>
      <li class="header bg-black-gradient">MASTER DATA</li>
      <!-- <li class="treeview">
        <a href="index.php?page=user&act=list" style="color: white;">
          <i class="glyphicon glyphicon-tower"></i> <span>Pengguna</span>
        </a>
      </li> -->
      <li id="treeview1" class="treeview">
        <a href="#" style="color: white; background-color:#111;">
          <i class="glyphicon glyphicon-user"></i> <span>Tenaga Kerja</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu-open bg-black">
          <li>
            <div class="hitam" style="margin-left: 15px;">
            <a href="index.php?page=tenaker&act=list" style="color: white;" class="bg-black"><i class="fa fa-circle-o"></i>&#8287;&#8287;&#8287;Data Tenaga Kerja</a>
            </div>
          </li>
          <li>
            <div class="hitam" style="margin-left: 15px;">
            <a href="index.php?page=tenaker&act=list2" style="color: white;" class="bg-black"><i class="fa fa-circle-o"></i>&#8287;&#8287;&#8287;Biaya Tenaga Kerja</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- <li id="treeview" class="treeview">
        <a href="#" style="color: white; background-color:#111;">
          <i class="glyphicon glyphicon-folder-close"></i> <span>Bahan Baku</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu-open bg-black">
          <li>
            <a href="index.php?page=bb&act=list"  style="color: white;" class="bg-black"><i class="fa fa-circle-o"></i>&#8287;&#8287;&#8287;Bahan Baku</a>
          </li>
          <li>
            <a href="index.php?page=stok_bb&act=list"  style="color: white;" class="bg-black"><i class="fa fa-circle-o"></i>&#8287;&#8287;&#8287;Stok Bahan Baku</a>
          </li>
        </ul>
      </li> -->
      <!-- <li id="treeview2" class="treeview">
        <a href="#" style="color: white; background-color:#111;">
          <i class="glyphicon glyphicon-equalizer"></i> <span>Bahan Penolong</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu-open bg-black">
          <li>
            <a href="index.php?page=bp&act=list"  style="color: white;" class="bg-black"><i class="fa fa-circle-o"></i>&#8287;&#8287;&#8287;Bahan Penolong</a>
          </li>
          <li>
          <a href="index.php?page=stok_bp&act=list"  style="color: white;" class="bg-black"><i class="fa fa-circle-o"></i>&#8287;&#8287;&#8287;Stok Bahan Penolong</a>
          </li>
        </ul>
      </li> -->
      <!-- <li class="treeview">
        <a href="index.php?page=overhead&act=list" style="color: white;">
          <i class="glyphicon glyphicon-tasks"></i> <span>Overhead Pabrik</span>
        </a>
      </li>
      <li class="header bg-black-gradient">MASTER PROSES</li>
      <li class="treeview">
        <a href="index.php?page=produksi&act=list" style="color: white;">
          <i class="glyphicon glyphicon-inbox"></i> <span>Produksi</span>
        </a>
      </li>
      <li class="header bg-black-gradient">LAPORAN</li>
      <li class="treeview">
        <a href="index.php?page=laporan&act=list" style="color: white;">
          <i class="glyphicon glyphicon-list-alt"></i> <span>Laporan</span>
        </a>
      </li> -->

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>