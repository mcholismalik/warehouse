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
  $id_kelas = $_GET['id_kelas'];
  $show = mysql_query("SELECT * FROM m_kelas WHERE id_kelas='$id_kelas'");
  if(mysql_num_rows($show) == 0){
    echo '<script>window.history.back()</script>';
  } else {
    $d = mysql_fetch_assoc($show);
  }
  ?>

<!-- proses edit -->
<?php
if(isset($_POST['simpan'])){
  $id_kelas     = htmlentities ($_POST ['id_kelas']);
  $nama_kelas    = htmlentities(strtoupper($_POST ['nama_kelas']));

  //validasi huruf
  if (!preg_match("/^[a-zA-Z .]*$/",$nama_kelas)) { 
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-kelas.php';</script>";
  } elseif (preg_match("/^[ .]*$/",$nama_kelas)) {
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-m-kelas.php';</script>";
  } else { 

  //cek kesamaan
  $check = mysql_query("SELECT nama_kelas FROM m_kelas WHERE nama_kelas = '$nama_kelas' ");
  if(mysql_num_rows($check) == 1){
     echo "<script>alert ('Gagal mengubah, data sudah ada !');
     location.href='admin-m-kelas.php';</script>";
  } else {
    $update = mysql_query("UPDATE m_kelas SET nama_kelas='$nama_kelas' WHERE id_kelas='$id_kelas' ") or die(mysql_error());
  }

  //alert success
  if($update) {
    echo "<script>alert ('Data berhasil di simpan ! ');
    location.href='admin-m-kelas.php';</script>";
  } else {
    echo "<script>alert ('Gagal menyimpan data ! ');
    location.href='admin-m-kelas.php';</script>";
  }
}
} 
?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Master Kelas
        <small>+</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Master Kelas</li>
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
              <h3 class="box-title">Masukan Kelas</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_kelas" readonly value="<?php echo $d['id_kelas']; ?>" >
                    <label >Nama Kelas </label>
                    <input type="text" class="form-control" name="nama_kelas" value="<?php echo $d['nama_kelas']; ?>" placeholder="Nama kelas">
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
