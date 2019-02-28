<?php $title = "Dashboard" ?>

<?php require "head.php" ?>
<?php require "nav.php" ?>
<?php require "conn.php" ?>

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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
        <small>V1</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <!-- Main row -->
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
              $now = strtotime(date("d-m-Y"));
              $sql = "SELECT * FROM t_barang_masuk WHERE inputdate='$now' ";
              $query = mysql_query($sql);
              $count = mysql_num_rows($query);
              ?>
              <h3><?php echo $count ?></h3>

              <p>Pemasukan Barang</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="admin-in.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
              $sql = "SELECT * FROM t_barang_keluar WHERE outputdate='$now' ";
              $query = mysql_query($sql);
              $count = mysql_num_rows($query);
              ?>
              <h3><?php echo $count ?></h3>

              <p>Pengeluaran Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="admin-out.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
              $sql = "SELECT * FROM paket_barang ";
              $query = mysql_query($sql);
              $count = mysql_num_rows($query);
              ?>
              <h3><?php echo $count ?></h3>

              <p>Paket Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="stok-barang.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
              $sql = "SELECT * FROM m_owner";
              $query = mysql_query($sql);
              $count = mysql_num_rows($query);
              ?>
              <h3><?php echo $count ?></h3>

              <p>Jml Owner</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="admin-m-owner.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
           </div>
          </div>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

<?php require "footer.php" ?>

</body>
</html>
