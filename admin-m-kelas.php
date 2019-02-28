<?php $title = "tree" ?>
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
        Master Data Kelas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Data Kelas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box-header">
                <a href="admin-m-kelas-tambah.php" ><button type="submit" name="tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button> </a>
              </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kelas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id Kelas</th>
                  <th>Nama Kelas</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = mysql_query("SELECT * FROM m_kelas ORDER BY id_kelas DESC") or die(mysql_error());
                if(mysql_num_rows($query) == 0){
                  
                } else{
                  
                  while($data = mysql_fetch_assoc($query)){ 
                    
                    echo '<tr>';
                      echo '<td>'.$data['id_kelas'].'</td>';
                      echo '<td>'.$data['nama_kelas'].'</td>';
                      echo '<td><a href="admin-m-kelas-del.php?id_kelas='.$data['id_kelas'].'" onclick="return confirm(\'Yakin?\')">Hapus</a> / <a href="admin-m-kelas-edit.php?id_kelas='.$data['id_kelas'].'">Edit</a></td>';
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
