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
  $id_owner = $_GET['id_owner'];
  $show = mysql_query("SELECT * FROM m_owner WHERE id_owner='$id_owner'");
  if(mysql_num_rows($show) == 0){
    echo '<script>window.history.back()</script>';
    
  } else {
    $d = mysql_fetch_assoc($show);
  }
  ?>

<!-- proses edit -->
<?php

if(isset($_POST['simpan'])){
  
  $id_owner      = htmlentities ($_POST ['id_owner']);
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
     $update = mysql_query("UPDATE m_owner SET nama='$nama_owner',perusahaan='$perusahaan' WHERE id_owner='$id_owner' ") or die(mysql_error());
  }
  
  //alert success
  if($update) {
    echo "<script>alert ('Data berhasil di simpan ! ');
    location.href='admin-m-owner.php';</script>";
  } else {
    echo "<script>alert ('Gagal menyimpan data ! ');
    location.href='admin-m-owner.php';</script>";
  }
}
} 
?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Master Owner
        <small>+</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Master Owner</li>
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
              <h3 class="box-title">Masukan Owner</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_owner" readonly value="<?php echo $d['id_owner']; ?>" >
                    <label >Nama Owner </label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $d['nama']; ?>" placeholder="Nama owner">
                 </div>

                 <div class="form-group">
                    <label >Perusahaan</label>
                    <input type="text" class="form-control" name="perusahaan" value="<?php echo $d['perusahaan']; ?>" placeholder="Nama owner">
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
