<?php $title = "admin-out" ?>

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
<!-- in proses -->
<?php
if(isset($_POST['out'])){

  $kode_paket    = htmlentities($_POST ['kode_paket']);
  $id_owner      = htmlentities($_POST ['id_owner']);
  $jml_out        = htmlentities($_POST ['jml_out']);
  $outputdate     = strtotime($_POST ['date']);
  $outputtime     = strtotime($_POST ['time']);
  $outputby       = htmlentities($_POST ['id']);

  ///
  if (!preg_match("/^[0-9.]*$/",$jml_out)) { 
  echo "<script>alert ('Jumlah harus angka !');
     location.href='admin-out.php';</script>";
  //cek jml_out tidak boleh < 0
  } elseif ($jml_out < 1) { 
  echo "<script>alert ('Jumlah tidak valid !');
      location.href='admin-out.php';</script>";
   } else {
      $show = mysql_query("SELECT * FROM stok_barang WHERE kode_paket='$kode_paket' AND id_owner='$id_owner' ");

  //cek stok
  if(mysql_num_rows($show) == 0){
    echo "<script>alert ('Stok Kosong !');
    location.href='admin-out.php';</script>";
  }

  else {
    $data = mysql_fetch_assoc($show);
  }

  $jml_awal = $data['jml'];


  ///////

  if($jml_awal = 0) {
    echo "<script>alert ('Stok Kosong !');
    location.href='admin-out.php';</script>"; 
  }

  else {
    $jml_awal = $data['jml'];
    $jml_now = $jml_awal - $jml_out;

    if($jml_now < 0) {
      echo "<script>alert ('Pengeluaran Melebihi Stok !');
      location.href='admin-out.php';</script>"; 
    }
    else {
      $update = mysql_query("UPDATE stok_barang SET jml='$jml_now' WHERE kode_paket='$kode_paket' AND id_owner='$id_owner' ") or die(mysql_error());
      $output = mysql_query("INSERT INTO t_barang_keluar VALUES('','$kode_paket','$jml_awal','$jml_out','$jml_now','$outputdate','$outputtime','$outputby')") or die(mysql_error());
    }
    
  }

  if($update && $output){
    echo "<script>alert ('Barang Berhasil di keluarkan ');
    location.href='admin-out.php';</script>";
  } else {
    echo "<script>alert ('Gagal Keluarkan Barang !'');
    location.href='admin-out.php';</script>";    
  }
}
} 
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengeluaran Barang
        <small>-</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengeluaran Barang</li>
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
              <h3 class="box-title">Keluaran Barang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                

                <div class="form-group">
                  <label>Paket Barang</label>
                  <select name="kode_paket" class="form-control" required>
                  <option value="">--</option>
                    <!-- GET DATA FROM ANOTHER TABLE -->
                    <?php 
                    $result = mysql_query("SELECT * FROM paket_barang");           
                    while ($row = mysql_fetch_array($result)) {    
                    echo '<option value="' . $row['kode_paket'] . '">' . $row['nama_paket'] . '</option>';    
                    }      
                  ?>    
                  </select>
                </div>


                <div class="form-group">
                  <label>Owner</label>
                 <select name="id_owner" class="form-control" name="id_owner" required>
                  <option value="">--</option>
                      <?php 
                      $result = mysql_query("SELECT * FROM m_owner");   
                      while ($row = mysql_fetch_array($result)) {    
                      echo '<option value="' . $row['id_owner'] . '">' . $row['nama'] . '</option>';   
                       }   
                    ?>    
                  </select>
                </div>

              <div class="form-group">
                  <label >Jumlah Barang </label>
                  <input type="text" class="form-control" name="jml_out" placeholder="jumlah" maxlength="5" required>
               </div>
              </div>

              <input name="id" type="hidden" value="<?php echo $_SESSION['id'] ?>" readonly>
              <input name="date" type="hidden" value="<?php echo date("d-m-Y")?>" readonly>
              <input name="time" type="hidden" value="<?php echo date("H:i:s")?>" readonly>

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="out" class="btn btn-primary"><i class="fa fa-sign-out"></i> Out</button>
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
