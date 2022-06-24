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
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>