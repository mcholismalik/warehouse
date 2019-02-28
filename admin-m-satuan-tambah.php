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

<!--proses add -->

<?php
if(isset($_POST['tambah'])){

  $nama_satuan    = htmlentities(strtolower($_POST ['nama_satuan']));

  //validasi huruf hanya bisa titik spasi huruf
  if (!preg_match("/^[a-zA-Z .]*$/",$nama_satuan)) { 
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-satuan.php';</script>";
  } elseif (preg_match("/^[ .]*$/",$nama_satuan)) {
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-satuan.php';</script>";
  } else {
  
  //checking kesamaan nama
  $check = mysql_query("SELECT nama_satuan FROM m_satuan WHERE nama_satuan = '$nama_satuan' ");
  if(mysql_num_rows($check) == 1){
     echo "<script>alert ('Gagal menambahkan, Data Sudah Ada !');
     location.href='admin-m-satuan.php';</script>";
  } else {
     $input = mysql_query("INSERT INTO m_satuan VALUES('','$nama_satuan')") or die(mysql_error());
  }

  //alert success
  if($input){
    echo "<script>alert ('Data Berhasil Di Masukan ! ');
    location.href='admin-m-satuan.php';</script>";
  } else {
    echo "<script>alert ('Maaf Gagal Menambahkan Data!');
    location.href='admin-m-satuan.php';</script>";    
  }
}
} 

?>



<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Master Satuan
        <small>+</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Master Satuan</li>
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
              <h3 class="box-title">Masukan Satuan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                    <label >Nama Satuan </label>
                    <input type="text" class="form-control" name="nama_satuan" placeholder="Nama satuan" maxlength="5" required>
                 </div>
              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
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
