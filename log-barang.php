<?php $title = "log-barang" ?>

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
        Log Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Log Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Log Masuk Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Paket</th>
                  <th>Jml Awal</th>
                  <th>Jml Input</th>
                  <th>Jml Sekarang</th>
                  <th>Tgl Input</th>
                  <th>Jam Input</th>
                  <th>Di input oleh</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $now = strtotime(date("d-m-Y"));
                $query = mysql_query("SELECT * FROM t_barang_masuk WHERE inputdate='$now' ORDER BY inputtime DESC") or die(mysql_error());
                if(mysql_num_rows($query) == 0){
                  
                } else{
                  $no = 1;
                  while($data = mysql_fetch_assoc($query)){ 
                    
                    $id = $data['inputby'];
                    $query2 = mysql_query("SELECT * FROM m_user WHERE id='$id' ") or die(mysql_error());
                    $d2 = mysql_fetch_assoc($query2);

                    echo '<tr>';
                      echo '<td>'.$no++.'</td>';
                      echo '<td>'.$data['kode_paket'].'</td>';
                      echo '<td>'.$data['jml_awal'].'</td>';
                      echo '<td>'.$data['jml_in'].'</td>';  
                      echo '<td>'.$data['jml_now'].'</td>'; 
                      echo '<td>'.date("d-m-Y",$data['inputdate']).'</td>';
                      echo '<td>'.date("H:i:s",$data['inputtime']).'</td>';
                      echo '<td>'.$d2['username'].'</td>';
                    echo '</tr>';
                  }
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Log Keluar Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Paket</th>
                  <th>Jml Awal</th>
                  <th>Jml Output</th>
                  <th>Jml Sekarang</th>
                  <th>Tgl Out</th>
                  <th>Jam Out</th>
                  <th>Di Output oleh</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $now2 = strtotime(date("d-m-Y"));
                $query2 = mysql_query("SELECT * FROM t_barang_keluar WHERE outputdate='$now2' ORDER BY outputtime DESC") or die(mysql_error());
                if(mysql_num_rows($query2) == 0){
                  
                } else{
                  $no2 = 1;
                  while($data2 = mysql_fetch_assoc($query2)){ 
                    
                    $id2 = $data2['outputby'];
                    $query22 = mysql_query("SELECT * FROM m_user WHERE id='$id2' ") or die(mysql_error());
                    $d22 = mysql_fetch_assoc($query22);

                    echo '<tr>';
                      echo '<td>'.$no2++.'</td>';
                      echo '<td>'.$data2['kode_paket'].'</td>';
                      echo '<td>'.$data2['jml_awal'].'</td>';
                      echo '<td>'.$data2['jml_out'].'</td>';  
                      echo '<td>'.$data2['jml_now'].'</td>'; 
                      echo '<td>'.date("d-m-Y",$data2['outputdate']).'</td>';
                      echo '<td>'.date("H:i:s",$data2['outputtime']).'</td>';
                      echo '<td>'.$d22['username'].'</td>';
                    echo '</tr>';
                  }
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <?php require "footer.php" ?>

</body>
</html>
