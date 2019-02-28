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

  $nama_barang    = htmlentities(ucfirst(strtolower($_POST ['nama_barang'])));
  
  //validasi huruf hanya bisa titik spasi huruf
  if (!preg_match("/^[a-zA-Z .]*$/",$nama_barang)) { 
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-barang.php';</script>";
  } elseif (preg_match("/^[ .]*$/",$nama_barang)) {
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-barang.php';</script>";
  } else {

  //checking kesamaan nama
  $check = mysql_query("SELECT nama_barang FROM m_barang WHERE nama_barang = '$nama_barang' ");
  if(mysql_num_rows($check) == 1){
     echo "<script>alert ('Gagal menambahkan, Data Sudah Ada !');
     location.href='admin-m-barang.php';</script>";
  } else {
     $input = mysql_query("INSERT INTO m_barang VALUES('','$nama_barang')") or die(mysql_error());
  }

  //alert update success
  if($input){
    echo "<script>alert ('Data Berhasil Di Masukan ! ');
    location.href='admin-m-barang.php';</script>";
  } else {
    echo "<script>alert ('Maaf Gagal Menambahkan Data!');
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
                    <label >Nama Barang </label>
                    <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" maxlength="30" required>
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
