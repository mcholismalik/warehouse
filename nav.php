<!-- PERMISSION -->
<?php
@session_start();
$lvl = $_SESSION['lvl'];

if(empty($_SESSION['username']))
  {
    echo "<script>alert ('Maaf anda tidak memliki izin !');
    location.href='index.php';</script>";
  }
  elseif($lvl == "user")
  {
    echo "<script>alert ('Maaf anda tidak memliki izin !');
    location.href='index.php';</script>";
  }
?>

 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/Customer-Supprt.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>
        
        <?php 
        if($title == 'Dashboard'){
          $dashboard = ' class="active" ';
          $treeview = ' class="treeview" ';
          $paket_barang = '';
          $admin_in = '';
          $admin_out = '';
          $stok_barang = '';
          $log_barang = '';

        } elseif($title == 'admin-in') {
          $dashboard = '';
          $treeview = ' class="treeview" ';
          $paket_barang = '';
          $admin_in = 'class="active"';
          $admin_out = '';
          $stok_barang = '';
          $log_barang = '';
        
        } elseif($title == 'admin-out') {
          $dashboard = '';
          $treeview = ' class="treeview" ';
          $paket_barang = '';
          $admin_in = '';
          $admin_out = 'class="active"';
          $stok_barang = '';
          $log_barang = '';
        
        } elseif($title == 'stok-barang') {
          $dashboard = '';
          $treeview = ' class="treeview" ';
          $paket_barang = '';
          $admin_in = '';
          $admin_out = '"';
          $stok_barang = 'class="active"';
          $log_barang = '';

        } elseif($title == 'log-barang') {
          $dashboard = '';
          $treeview = ' class="treeview" ';
          $paket_barang = '';
          $admin_in = '';
          $admin_out = '"';
          $stok_barang = '';
          $log_barang = 'class="active"';
        
        } elseif($title == 'paket-barang') {
          $dashboard = '';
          $treeview = ' class="treeview" ';
          $paket_barang = 'class="active"';
          $admin_in = '';
          $admin_out = '"';
          $stok_barang = '';
          $log_barang = '';
        
        } elseif($title == 'tree') {
          $dashboard = '';
          $treeview = 'class="treeview active" ';
          $paket_barang = '';
          $admin_in = '';
          $admin_out = '"';
          $stok_barang = '';
          $log_barang = '';
        }
        ?>

        <li <?php echo $dashboard; ?>>
          <a href="admin-menu.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        <li <?php echo $treeview; ?>>
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin-m-barang.php"><i class="fa fa-circle-o"></i> Barang</a></li>
            <li><a href="admin-m-kelas.php"><i class="fa fa-circle-o"></i> Kelas</a></li>
            <li><a href="admin-m-satuan.php"><i class="fa fa-circle-o"></i> Satuan</a></li>
            <li><a href="admin-m-owner.php"><i class="fa fa-circle-o"></i> Owner</a></li>
          </ul>
        </li> 

        <li <?php echo $paket_barang; ?>>
          <a href="admin-paket-barang.php">
            <i class="fa fa-gift"></i> <span>Paket Barang</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li <?php echo $admin_in; ?>>
          <a href="admin-in.php">
            <i class="fa fa-share"></i> <span>Pemasukan Barang</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li <?php echo $admin_out; ?>>
          <a href="admin-out.php">
            <i class="fa fa-reply-all "></i> <span>Pengeluaran Barang</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li <?php echo $stok_barang; ?>>
          <a href="stok-barang.php">
            <i class="fa fa-dropbox"></i> <span>Stok Barang</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li <?php echo $log_barang; ?>>
          <a href="log-barang.php">
            <i class="fa fa-random"></i> <span>Log Barang</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
      
    </section>
    <!-- /.sidebar -->
  </aside>