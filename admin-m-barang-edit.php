<?php $title = "tree" ?>
<?php require "head.php" ?>
<?php require "nav.php" ?>
<?php include "conn.php" ?>

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

<!--proses get -->
<?php
  $id_barang = $_GET['id_barang'];
  $show = mysql_query("SELECT * FROM m_barang WHERE id_barang='$id_barang'");
  if(mysql_num_rows($show) == 0){
    echo '<script>window.history.back()</script>';
    
  } else {
    $d = mysql_fetch_assoc($show);
  }
  ?>

<!-- proses edit -->
<?php

if(isset($_POST['simpan'])){
  
  $id_barang     = htmlentities ($_POST ['id_barang']);
  $nama_barang    = htmlentities(ucfirst(strtolower($_POST ['nama_barang'])));

  //cek validasi huruf
  if (!preg_match("/^[a-zA-Z .]*$/",$nama_barang)) { 
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-barang.php';</script>";
  } elseif (preg_match("/^[ .]*$/",$nama_barang)) {
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-barang.php';</script>";
  } else {

  //cek kesamaan nama  
  $check = mysql_query("SELECT nama_barang FROM m_barang WHERE nama_barang = '$nama_barang' ");
  if(mysql_num_rows($check) == 1){
     echo "<script>alert ('Gagal mengubah, data sudah ada !');
     location.href='admin-m-barang.php';</script>";
  } else {
  //jika nama tidak sama baru melakukan update  
     $update = mysql_query("UPDATE m_barang SET nama_barang='$nama_barang' WHERE id_barang='$id_barang' ") or die(mysql_error());
  }

  //alert update success
  if($update) {
    echo "<script>alert ('Data berhasil di simpan ! ');
    location.href='admin-m-barang.php';</script>";
  } else {
    echo "<script>alert ('Gagal menyimpan data ! ');
    location.href='admin-m-barang.php';</script>";
  }
}
} 
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Master Barang
        <small>+</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Master Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Masukan Barang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_barang" readonly value="<?php echo $d['id_barang']; ?>" >
                    <label >Nama Barang </label>
                    <input type="text" class="form-control" name="nama_barang" value="<?php echo $d['nama_barang']; ?>" maxlength="30" placeholder="Nama Barang" required >
                 </div>
              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<?php require "footer.php" ?>
