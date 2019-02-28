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

 if(empty($_SESSION['username']))
  {
    echo "<script>alert ('Maaf anda tidak memliki izin !');
    location.href='index.php';</script>";
  } else {
  
  
  $nama_owner    = htmlentities(ucfirst(strtolower($_POST ['nama'])));
  $perusahaan    = htmlentities(strtoupper($_POST['perusahaan']));

  //validasi form
  if ((!preg_match("/^[a-zA-Z0-9 .]*$/",$nama_owner)) || (!preg_match("/^[a-zA-Z0-9 .]*$/",$perusahaan))) { 
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-owner.php';</script>";
  } elseif ((preg_match("/^[ .]*$/",$nama_owner)) || (preg_match("/^[ .]*$/",$perusahaan))) {
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-owner.php';</script>";
  } else {

  //cek kesamaan  
  $check = mysql_query("SELECT * FROM m_owner WHERE nama = '$nama_owner' AND perusahaan = '$perusahaan' ");
  if(mysql_num_rows($check) == 1){
     echo "<script>alert ('Gagal menambahkan, Data Sudah Ada !');
     location.href='admin-m-owner.php';</script>";
  } else {
     $input = mysql_query("INSERT INTO m_owner VALUES('','$nama_owner','$perusahaan')") or die(mysql_error());
  }

  //alert success
  if($input){
    echo "<script>alert ('Data Berhasil Di Masukan ! ');
    location.href='admin-m-owner.php';</script>";
  } else {
    echo "<script>alert ('Maaf Gagal Menambahkan Data!');
    location.href='admin-m-owner.php';</script>";    
  }
} 
}
}
?>



<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Master owner
        <small>+</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Master owner</li>
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
              <h3 class="box-title">Masukan owner</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                    <label >Nama owner </label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama owner" maxlength="25" required>
                 </div>
                 <div class="form-group">
                    <label >Perusahaan </label>
                    <input type="text" class="form-control" name="perusahaan" placeholder="Nama Perusahaan" maxlength="40" required>
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
