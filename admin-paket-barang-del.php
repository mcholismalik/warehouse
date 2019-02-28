<?php
if(isset($_GET['kode_paket'])){
	include('conn.php');
	$kode_paket = $_GET['kode_paket'];
	$cek = mysql_query("SELECT kode_paket FROM paket_barang WHERE kode_paket ='$kode_paket'") or die(mysql_error());

	if(mysql_num_rows($cek) == 0){
		echo '<script>window.history.back()</script>';
	
	} else {
		$del = mysql_query("DELETE FROM paket_barang WHERE kode_paket ='$kode_paket'");

		if($del) {
			
			echo "<script>alert ('Data Berhasil dihapus !');
		location.href='admin-paket-barang.php';</script>";		
			
		} else {
			
			echo "<script>alert ('Gagal Menghapus Data !');
		location.href='admin-paket-barang.php';</script>";	
		
		}
		
	}
	
} else {
	echo '<script>window.history.back()</script>';
	
}
?>
