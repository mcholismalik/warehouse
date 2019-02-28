<?php
if(isset($_GET['id_barang'])){
	include('conn.php');
	$id_barang = $_GET['id_barang'];
	$cek = mysql_query("SELECT id_barang FROM m_barang WHERE id_barang ='$id_barang'") or die(mysql_error());

	if(mysql_num_rows($cek) == 0){
		echo '<script>window.history.back()</script>';
	
	} else {
		$del = mysql_query("DELETE FROM m_barang WHERE id_barang ='$id_barang'");

		if($del) {
			
			echo "<script>alert ('Data Berhasil dihapus !');
		location.href='admin-m-barang.php';</script>";		
			
		} else {
			
			echo "<script>alert ('Gagal Menghapus Data !');
		location.href='admin-m-barang.php';</script>";	
		
		}
		
	}
	
} else {
	echo '<script>window.history.back()</script>';
	
}
?>
