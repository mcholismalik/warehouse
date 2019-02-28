<?php
if(isset($_GET['id_satuan'])){
	include('conn.php');
	$id_satuan = $_GET['id_satuan'];
	$cek = mysql_query("SELECT id_satuan FROM m_satuan WHERE id_satuan ='$id_satuan'") or die(mysql_error());

	if(mysql_num_rows($cek) == 0){
		echo '<script>window.history.back()</script>';
	
	} else {
		$del = mysql_query("DELETE FROM m_satuan WHERE id_satuan ='$id_satuan'");

		if($del) {
			
			echo "<script>alert ('Data Berhasil dihapus !');
		location.href='admin-m-satuan.php';</script>";		
			
		} else {
			
			echo "<script>alert ('Gagal Menghapus Data !');
		location.href='admin-m-satuan.php';</script>";	
		
		}
		
	}
	
} else {
	echo '<script>window.history.back()</script>';
	
}
?>
