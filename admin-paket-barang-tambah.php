<?php $title = "paket-barang" ?>
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

<!-- ADD Proses -->
<?php
if(isset($_POST['tambah'])){

  $id_barang    = htmlentities($_POST ['id_barang']);
  $id_kelas     = htmlentities($_POST ['id_kelas']);
  $id_satuan    = htmlentities($_POST ['id_satuan']);
  $nom_satuan   = htmlentities($_POST ['nom_satuan']);
  $blok1        = htmlentities($_POST ['blok1']); 
  $blok2        = htmlentities($_POST ['blok2']);   
  $blok3        = htmlentities($_POST ['blok3']); 

  $blok1nm      = htmlentities($_POST ['blok1nm']); 
  $blok2nm      = htmlentities($_POST ['blok2nm']);   
  $blok3nm      = htmlentities($_POST ['blok3nm']);

  //validasi huruf hanya bisa titik spasi huruf
  if (!preg_match("/^[0-9.]*$/",$nom_satuan)) { 
  echo "<script>alert ('Data tidak valid !');
     location.href='admin-paket-barang-tambah.php';</script>";
  } else { 
    $input = mysql_query("INSERT INTO paket_barang VALUES('$blok1/$blok2/$nom_satuan/$blok3','$blok1nm/$blok2nm/$nom_satuan/$blok3nm','$id_barang','$id_kelas','$id_satuan','$nom_satuan')");
  }

  //alert success
  if($input){
    echo "<script>alert ('Data Berhasil Di Masukan ! ');
    location.href='admin-paket-barang.php';</script>";
  } else {
    echo "<script>alert ('Data Sudah Ada !');
    location.href='admin-paket-barang-tambah.php';</script>";    
  }
 
}

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Paket Barang
        <small>+</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Paket Barang</li>
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
              <h3 class="box-title">Masukan Paket</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                

                <div class="form-group">
                  <label>Jenis Barang</label>
                  <select name="id_barang" class="form-control" id="id_barang" onchange="changeValue1(this.value)" required>
                    <option value=""> -- </option>
                    <!-- GET DATA FROM ANOTHER TABLE -->
                    <?php 
                    $result = mysql_query("SELECT * FROM m_barang");    
                    $jsArray = "var dtgen = new Array();\n";        
                    while ($row = mysql_fetch_array($result)) {    
                    echo '<option value="' . $row['id_barang'] . '">' . $row['nama_barang'] . '</option>';    
                    $jsArray .= "dtgen['" . $row['id_barang'] . "'] = {id_barang:'".addslashes($row['id_barang'])."',nama_barang:'" . addslashes($row['nama_barang']) . "'};\n";    
                    }      
                  ?>    
                  </select>
                </div>

                <div class="form-group">
                  <label>Kelas Barang</label>
                 <select name="id_kelas" id="id_kelas" class="form-control" onchange="changeValue2(this.value)" required>
                  <option value=""> -- </option>
                      <?php 
                      $result = mysql_query("SELECT * FROM m_kelas");
                      $jsArray2 = "var dtgen2 = new Array();\n";      
                      while ($row = mysql_fetch_array($result)) {    
                      echo '<option value="' . $row['id_kelas'] . '">' . $row['nama_kelas'] . '</option>';
                      $jsArray2 .= "dtgen2['" . $row['id_kelas'] . "'] = {id_kelas:'".addslashes($row['id_kelas'])."',nama_kelas:'" . addslashes($row['nama_kelas']) . "'};\n";            
                      }   
                    ?>    
                  </select>
                </div>

                <div class="form-group" >
                  <label>Berat Barang</label>
                  <div class="row">
                    <div class="col-xs-4">
                      <input type="text" name="nom_satuan" class="form-control" placeholder="Nominal berat" maxlength="4" required />
                    </div>
                    <div class="col-xs-4">
                      <select name="id_satuan" id="id_satuan" class="form-control" name="id_satuan" onchange="changeValue3(this.value)" required>
                      <option value=""> satuan </option>
                      <?php 
                      $result = mysql_query("SELECT * FROM m_satuan");  
                      $jsArray3 = "var dtgen3 = new Array();\n";      
                      while ($row = mysql_fetch_array($result)) {    
                      echo '<option value="' . $row['id_satuan'] . '">' . $row['nama_satuan'] . '</option>';    
                      $jsArray3 .= "dtgen3['" . $row['id_satuan'] . "'] = {id_satuan:'".addslashes($row['id_satuan'])."',nama_satuan:'" . addslashes($row['nama_satuan']) . "'};\n";    
                      }   
                      ?>    
                      </select>
                    </div>
                  </div>
                </div>

              <div class="form-group" >
                  <label>Kode Barang</label>
                  <div class="row">

                    <div class="col-xs-2">
                      <input type="text" name="blok1" id="blok1" class="form-control" readonly>
                    </div>
                    <div class="col-xs-2">
                      <input type="text" name="blok2" id="blok2" class="form-control" readonly>
                    </div>
                    <div class="col-xs-2">
                      <input type="text" name="blok3" id="blok3" class="form-control" readonly>
                    </div>    

                    <div class="col-xs-2">
                      <input type="text" name="blok1nm" id="blok1nm" class="form-control" readonly>
                    </div>
                    <div class="col-xs-2">
                      <input type="text" name="blok2nm" id="blok2nm" class="form-control" readonly>
                    </div>
                    <div class="col-xs-2">
                      <input type="text" name="blok3nm" id="blok3nm" class="form-control" readonly>
                    </div>
                                  
                  </div>
                </div>

              </div>

              <input name="id" type="hidden" value="<?php echo $_SESSION['id'] ?>" readonly>
              <input name="date" type="hidden" value="<?php echo date("d-m-Y")?>" readonly>
              <input name="time" type="hidden" value="<?php echo date("H:i:s")?>" readonly>



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

<script type="text/javascript">    
        <?php echo $jsArray; ?>  
        function changeValue1(id_barang){  
        document.getElementById('blok1').value = dtgen[id_barang].id_barang;
        document.getElementById('blok1nm').value = dtgen[id_barang].nama_barang;
        };
        <?php echo $jsArray2; ?>  
        function changeValue2(id_kelas){  
        document.getElementById('blok2').value = dtgen2[id_kelas].id_kelas;
        document.getElementById('blok2nm').value = dtgen2[id_kelas].nama_kelas;
        }; 
        <?php echo $jsArray3; ?>  
        function changeValue3(id_satuan){  
        document.getElementById('blok3').value = dtgen3[id_satuan].id_satuan;
        document.getElementById('blok3nm').value = dtgen3[id_satuan].nama_satuan;
        }; 

    </script>

<?php require "footer.php" ?>
