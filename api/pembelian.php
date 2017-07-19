<?php
ini_set("display_errors", 1);
if ( !isset( $_SESSION ) ) {
	session_start();

}
include "../koneksi.php"; 
function throw_ex($er){  
  throw new Exception($er);  
}
function readyInput($db){
	$sql = 'select * from tb_pembelian where id_user = '.$_SESSION['karyawan'].'';
 	$gg = $db->query($sql);
 	if($gg->num_rows > 0){
 		$head = array();
 		while($row = mysqli_fetch_assoc($gg)) {
 			$head[] = [
 				'id_pembelian' => $row['id_pembelian'],
 				'INV' => $row['INV'],
 				'id_supel' => $row['id_supel'],
 				'harga' => $row['harga'],
 				'tgl' => $row['tgl'],
 				'total' => $row['total'],
 				'id_user' => $row['id_user'],
 				'status' => $row['status']
 			];
 		}
 		// get detail 
	    $sql = "select * from tb_detail_pembelian i left join tb_barang j on i.id_barang = j.kode_brg where id_pembelian = '".$head[0]['id_pembelian']."'";
	 	$gg = $db->query($sql);
 		$detail = array();
	 	if($gg->num_rows > 0){
	 		while($row = mysqli_fetch_assoc($gg)) {
	 			$detail[] = [
 					'id_detail_pem' => $row['id_detail_pem'],
 					'id_pembelian' => $row['id_pembelian'],
 					'id_barang' => $row['id_barang'],
 					'jumlah' => $row['jumlah'],
 					'nama_brg' => $row['nama_brg'],
 					'harga' => $row['harga'],
 					'total' => $row['total']
 				];
	 		}
	 	}
	 	$toJSON = [
	 		'tb_pembelian' => $head,
	 		'tb_detail_pembelian' => $detail
	 	];
	 	header('Content-Type: application/json');
	 	echo json_encode($toJSON);
	 	return;
 	}
}
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
		case 'save':
			$sql = 'select * from tb_detail_pembelian i left join tb_barang j on i.id_barang = j.kode_brg  where i.id_barang = "'.$_POST['kode_brg'].'" AND  id_pembelian = "'.$_POST['id_pembelian'].'"';
			$gg = $db->query($sql);
 			if($gg->num_rows > 0){
 				 try{
				    $sql = "UPDATE tb_detail_pembelian set jumlah = ".$_POST['jumlah'].", total=".$_POST['jumlah']*$_POST['harga']." where id_barang = '".$_POST['kode_brg']."' AND id_pembelian = '".$_POST['id_pembelian']."'";
					$updated = mysqli_query($db,$sql);
					if ($updated) {
						$sql = 'select * from tb_detail_pembelian i left join tb_barang j on i.id_barang = j.kode_brg  where  id_pembelian = "'.$_POST['id_pembelian'].'"';
					 	$gg = $db->query($sql);
				 		$detail = array();
					 	if($gg->num_rows > 0){
					 		while($row = mysqli_fetch_assoc($gg)) {
					 			$detail[] = [
				 					'id_detail_pem' => $row['id_detail_pem'],
				 					'id_pembelian' => $row['id_pembelian'],
				 					'id_barang' => $row['id_barang'],
				 					'nama_brg' => $row['nama_brg'],
				 					'jumlah' => $row['jumlah'],
				 					'harga' => $row['harga'],
				 					'total' => $row['total']
				 				];
					 		}
					 	}
					 	$toJSON = [
					 		'tb_detail_pembelian' => $detail
					 	];
					 	header('Content-Type: application/json');
					 	echo json_encode($toJSON);
					}else{
						
					}
				 } catch(Exception $e){
				     echo $e->getMessage();
				 }

 			}else{
 				$sql = "INSERT INTO  tb_detail_pembelian (id_pembelian,id_barang,jumlah,harga,total) VALUES ('".$_POST['id_pembelian']."','".$_POST['kode_brg']."',".$_POST['jumlah'].",".$_POST['harga'].",".$_POST['jumlah']*$_POST['harga'].")";
				if ($db->query($sql) === TRUE) {
					$sql = 'select * from tb_detail_pembelian i left join tb_barang j on i.id_barang = j.kode_brg  where  id_pembelian = "'.$_POST['id_pembelian'].'"';
				 	$gg = $db->query($sql);
			 		$detail = array();
				 	if($gg->num_rows > 0){
				 		while($row = mysqli_fetch_assoc($gg)) {
				 			$detail[] = [
			 					'id_detail_pem' => $row['id_detail_pem'],
			 					'id_pembelian' => $row['id_pembelian'],
			 					'id_barang' => $row['id_barang'],
			 					'nama_brg' => $row['nama_brg'],
			 					'jumlah' => $row['jumlah'],
			 					'harga' => $row['harga'],
			 					'total' => $row['total']
			 				];
				 		}
				 	}
				 	$toJSON = [
				 		'tb_detail_pembelian' => $detail
				 	];
				 	header('Content-Type: application/json');
				 	echo json_encode($toJSON);
				}
 			}
		break;
		case 'delete':
			$sql = "DELETE from tb_detail_pembelian where id_barang = '".$_POST['kode_brg']."' AND id_pembelian = '".$_POST['id_pembelian']."'";
			$updated = mysqli_query($db,$sql);
			if ($updated) {
				$sql = 'select * from tb_detail_pembelian i left join tb_barang j on i.id_barang = j.kode_brg  where  id_pembelian = "'.$_POST['id_pembelian'].'"';
			 	$gg = $db->query($sql);
		 		$detail = array();
			 	if($gg->num_rows > 0){
			 		while($row = mysqli_fetch_assoc($gg)) {
			 			$detail[] = [
		 					'id_detail_pem' => $row['id_detail_pem'],
		 					'id_pembelian' => $row['id_pembelian'],
		 					'id_barang' => $row['id_barang'],
		 					'nama_brg' => $row['nama_brg'],
		 					'jumlah' => $row['jumlah'],
		 					'harga' => $row['harga'],
		 					'total' => $row['total']
		 				];
			 		}
			 	}
			 	$toJSON = [
			 		'tb_detail_pembelian' => $detail
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			}else{
				echo 'enggak ada';
			}
		break;
		case 'save':

		break;

	}
}