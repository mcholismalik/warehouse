<?php $title = "admin-in" ?>

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
if(isset($_POST['in'])){

  $kode_paket    = htmlentities($_POST ['kode_paket']);
  $id_owner      = htmlentities($_POST ['id_owner']);
  $jml_in        = htmlentities($_POST ['jml_in']);
  $jml_awal      = htmlentities($_POST ['jml_awal']);
  $jml_now       = $jml_awal + $jml_in;
  $inputdate     = strtotime($_POST ['date']);
  $inputtime     = strtotime($_POST ['time']);
  $inputby       = htmlentities($_POST ['id']);

  //validasi nomor
  if (!preg_match("/^[0-9.]*$/",$jml_in)) { 
  echo "<script>alert ('Jumlah harus angka !');
     location.href='admin-in.php';</script>";

  //cek jml_in tidak boleh < 0
  } elseif($jml_in < 1) { 
  echo "<script>alert ('Jumlah tidak valid !');
       location.href='admin-in.php';</script>";
  } else {
      $show = mysql_query("SELECT * FROM stok_barang WHERE kode_paket='$kode_paket' AND id_owner='$id_owner' ");

  //cek stok
  if(mysql_num_rows($show) == 0){
      
      $jml_awal = 0;
      $jml_now  = $jml_awal + $jml_in;

      $input = mysql_query("INSERT INTO t_barang_masuk VALUES('','$kode_paket','$jml_awal','$jml_in','$jml_now','$inputdate','$inputtime','$inputby')") or die(mysql_error());

      $inputstok = mysql_query("INSERT INTO stok_barang VALUES('','$kode_paket','$jml_now','$id_owner')") or die(mysql_error());
  
  } else { 
     $data = mysql_fetch_assoc($show);

      $jml_awal = $data['jml'];
      $jml_now = $jml_awal + $jml_in;

      $input = mysql_query("INSERT INTO t_barang_masuk VALUES('','$kode_paket','$jml_awal','$jml_in','$jml_now','$inputdate','$inputtime','$inputby')") or die(mysql_error());

      $update = mysql_query("UPDATE stok_barang SET jml='$jml_now' WHERE kode_paket='$kode_paket' AND id_owner='$id_owner' ") or die(mysql_error());

  } 

  
  if($input){
    echo "<script>alert ('Data Berhasil Di Masukan ! ');
    location.href='stok-barang.php';</script>";
  } else {
    echo "<script>alert ('Maaf Gagal Menambahkan Data!');
    location.href='admin-in.php';</script>";    
  }
} 
} 
?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pemasukan Barang
        <small>+</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemasukan Barang</li>
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
                  <label>Paket Barang</label>
                  <select name="kode_paket" class="form-control" id="kode_paket" onchange="changeValue1(this.value)" required>
                  <option value="">--</option>
                    <!-- GET DATA FROM ANOTHER TABLE -->
                    <?php 
                    $result = mysql_query("SELECT * FROM paket_barang");
                    $jsArray = "var dtgen = new Array();\n";             
                    while ($row = mysql_fetch_array($result)) {    
                    echo '<option value="' . $row['kode_paket'] . '">' . $row['nama_paket'] . '</option>';  
                    $jsArray .= "dtgen['" . $row['kode_paket'] . "'] = {kode_paket:'".addslashes($row['kode_paket'])."',jml:'" . addslashes($row['jml']) . "'};\n";     
                       
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
                  <input type="text" class="form-control" name="jml_in" placeholder="jumlah" maxlength="5" required>
               </div>
              </div>

              <input name="id" type="hidden" value="<?php echo $_SESSION['id'] ?>" readonly>
              <input name="date" type="hidden" value="<?php echo date("d-m-Y")?>" readonly>
              <input name="time" type="hidden" value="<?php echo date("H:i:s")?>" readonly>
              <input name="jml_awal" type="hidden" id="jml_awal" readonly>

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="in" class="btn btn-primary"><i class="fa fa-sign-in"></i> In</button>
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

<script type="text/javascript">    
        <?php echo $jsArray; ?>  
        function changeValue1(kode_paket){  
        document.getElementById('jml_awal').value = dtgen[kode_paket].jml;
        };
</script>

<?php require "footer.php" ?>
