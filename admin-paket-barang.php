<?php $title = "paket-barang" ?>
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
        Data Paket Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Paket Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box-header">
                <a href="admin-paket-barang-tambah.php" ><button type="submit" name="tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button> </a>
              </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Paket Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Paket</th>
                  <th>Nama Paket</th>
                  <th>Jenis Barang</th>
                  <th>Kelas Barang</th>
                  <th>Nominal</th>
                  <th>Satuan</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = mysql_query("SELECT * FROM paket_barang ORDER BY kode_paket DESC") or die(mysql_error());
                if(mysql_num_rows($query) == 0){
                  
                } else{
                  $no = 1;
                  while($data = mysql_fetch_assoc($query)){ 
                    
                    $id = $data['id_barang'];
                    $query2 = mysql_query("SELECT * FROM m_barang WHERE id_barang='$id' ") or die(mysql_error());
                    $d2 = mysql_fetch_assoc($query2);

                    $id = $data['id_kelas'];
                    $query3 = mysql_query("SELECT * FROM m_kelas WHERE id_kelas='$id' ") or die(mysql_error());
                    $d3 = mysql_fetch_assoc($query3);

                    $id = $data['id_satuan'];
                    $query4 = mysql_query("SELECT * FROM m_satuan WHERE id_satuan='$id' ") or die(mysql_error());
                    $d4 = mysql_fetch_assoc($query4);

                    echo '<tr>';
                      echo '<td>'.$no++.'</td>';
                      echo '<td>'.$data['kode_paket'].'</td>';
                      echo '<td>'.$data['nama_paket'].'</td>';
                      echo '<td>'.$d2['nama_barang'].'</td>';
                      echo '<td>'.$d3['nama_kelas'].'</td>';
                      echo '<td>'.$data['nom_satuan'].'</td>';
                      echo '<td>'.$d4['nama_satuan'].'</td>';
                      echo '<td><a href="admin-paket-barang-del.php?kode_paket='.$data['kode_paket'].'" onclick="return confirm(\'Yakin?\')">Hapus</a></td>';
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
