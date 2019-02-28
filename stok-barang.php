<?php $title = "stok-barang" ?>

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
        Stok Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stok Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Stok Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Owner</th>
                  <th>Kode Paket</th>
                  <th>Stok</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = mysql_query("SELECT * FROM stok_barang ORDER BY id_owner DESC") or die(mysql_error());
                if(mysql_num_rows($query) == 0){                  
                } else{
                  
                  $no = 1;
                  while($data = mysql_fetch_assoc($query)){ 
                    
                    $id = $data['id_owner'];
                    $query2 = mysql_query("SELECT * FROM m_owner WHERE id_owner='$id' ") or die(mysql_error());
                    $d2 = mysql_fetch_assoc($query2);

                    $kode_paket = $data['kode_paket'];
                    $query3 = mysql_query("SELECT * FROM paket_barang WHERE kode_paket='$kode_paket' ") or die(mysql_error());
                    $d3 = mysql_fetch_assoc($query3);

                    echo '<tr>';
                      echo '<td>'.$no++.'</td>';
                      echo '<td>'.$d2['nama'].'</td>';
                      echo '<td>'.$d3['nama_paket'].'</td>';
                      echo '<td>'.$data['jml'].'</td>';
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
