<?php
if ( !isset( $_SESSION ) ) {
	session_start();

}
include "../koneksi.php"; 


if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'new':
		 	$sql = 'select status from tb_pembelian where id_user = '.$_SESSION['karyawan'].' limit 1';
		 	$gg = mysqli_query($db,$sql);
		    $row = mysqli_fetch_row($gg);
		    if(isset($row[0])==true){
		    	if($row[0] == 0){
		    		readyInput($db);
		    	}
		    }else{
		    	$sql = "INSERT INTO  tb_pembelian (id_supel,tgl,harga,total,id_user) VALUES (0, '".date("Y-m-d H:i:s")."', 0,0, ".$_SESSION['karyawan'].")";
				if ($db->query($sql) === TRUE) {
					$sql = 'select id_pembelian from tb_pembelian where id_user = '.$_SESSION['karyawan'].' and status = 0';
					$gg = mysqli_query($db,$sql);
				    $row = mysqli_fetch_row($gg);
				    // echo $row[0].'242342344';
				    if(isset($row[0])==true){
				    	// var_dump($row[0]);
				    	$sql = "update tb_pembelian set INV = '"."IV-".str_pad($row[0], 7, "0", STR_PAD_LEFT)."' where status = 0 and id_user = '".$_SESSION['karyawan']."'";
				    	if ($db->query($sql) === TRUE) {
				    		readyInput($db);
				    	}
				    }
				    return;
				} else {
				    echo "Error: " . $sql . "<br>" . $db->error;
				}
		    }	
			return;
			
		return;
		case 'add':

		break;
		case 'delete':

		break;
		case 'save':

		break;
		case 'fetch':
			$sql = 'select * from tb_supel';
		 	$gg = $db->query($sql);
	 		$supel = array();
		 	if($gg->num_rows > 0){
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$supel[] = [
	 					'id' => $row['id'],
	 					'Nama' => $row['Nama'],
	 					'Alamat' => $row['Alamat'],
	 					'No_tlp' => $row['No_tlp']
	 				];
		 		}
		 	}
		 	$toJSON = [
		 		'tb_supel' => $supel
		 	];
		 	header('Content-Type: application/json');
		 	echo json_encode($toJSON);
			return;
		break;
	}
}