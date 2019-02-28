<?php
if(isset($_GET['id_owner'])){
	include('conn.php');
	$id_owner = $_GET['id_owner'];
	$cek = mysql_query("SELECT id_owner FROM m_owner WHERE id_owner ='$id_owner'") or die(mysql_error());

	if(mysql_num_rows($cek) == 0){
		echo '<script>window.history.back()</script>';
	
	} else {
		$del = mysql_query("DELETE FROM m_owner WHERE id_owner ='$id_owner'");

		if($del) {
			
			echo "<script>alert ('Data Berhasil dihapus !');
		location.href='admin-m-owner.php';</script>";		
			
		} else {
			
			echo "<script>alert ('Gagal Menghapus Data !');
		location.href='admin-m-owner.php';</script>";	
		
		}
		
	}
	
} else {
	echo '<script>window.history.back()</script>';
	
}
?>
