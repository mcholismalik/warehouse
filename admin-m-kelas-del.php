<?php
if(isset($_GET['id_kelas'])){
	include('conn.php');
	$id_kelas = $_GET['id_kelas'];
	$cek = mysql_query("SELECT id_kelas FROM m_kelas WHERE id_kelas ='$id_kelas'") or die(mysql_error());

	if(mysql_num_rows($cek) == 0){
		echo '<script>window.history.back()</script>';
	
	} else {
		$del = mysql_query("DELETE FROM m_kelas WHERE id_kelas ='$id_kelas'");

		if($del) {
			
			echo "<script>alert ('Data Berhasil dihapus !');
		location.href='admin-m-kelas.php';</script>";		
			
		} else {
			
			echo "<script>alert ('Gagal Menghapus Data !');
		location.href='admin-m-kelas.php';</script>";	
		
		}
		
	}
	
} else {
	echo '<script>window.history.back()</script>';
	
}
?>
