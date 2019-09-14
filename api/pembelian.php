<?php
date_default_timezone_set('Asia/Makassar');
ini_set("display_errors", 1);
if ( !isset( $_SESSION ) ) {
	session_start();

}
include "../koneksi.php";
function throw_ex($er){
  throw new Exception($er);
}
function readyInput($db){
	$sql = 'select * from tb_pembelian where id_user = '.$_SESSION['karyawan'].' and status=0';
 	$gg = $db->query($sql);
 	if($gg->num_rows > 0){
 		$head = array();
 		while($row = mysqli_fetch_assoc($gg)) {
 			$head[] = [
 				'id_pembelian' => $row['id_pembelian'],
 				'INV' => $row['INV'],
 				'id_supel' => $row['id_supel'],
 				'harga' => 0,
 				'tgl' => $row['tgl'],
 				'total' => $row['total'],
 				'id_user' => $row['id_user'],
 				'status' => $row['status']
 			];
 		}
 		// get detail
	    $sql = "select i.id_detail_pem, i.id_pembelian, i.kode_brg, i.jumlah ,j.nama_brg ,i.harga,i.total from tb_detail_pembelian i left join tb_barang j on i.kode_brg = j.kode_brg where id_pembelian = '".$head[0]['id_pembelian']."'";
	 	$gg = $db->query($sql);
 		$detail = array();
	 	if($gg->num_rows > 0){
	 		while($row = mysqli_fetch_assoc($gg)) {
	 			$detail[] = [
 					'id_detail_pem' => $row['id_detail_pem'],
 					'id_pembelian' => $row['id_pembelian'],
 					'kode_brg' => $row['kode_brg'],
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
		case 'view':
			$sql = "select i.id_pembelian, i.tgl, i.total, i.INV, k.Nama as pegawai, j.Nama as nama_suplier from tb_pembelian i left join tb_supel j on i.id_supel = j.id_supel left join tb_user k on i.id_user = k.id_user where i.id_pembelian = '".$_POST['id_pembelian']."' order by i.id_pembelian desc";
		 	$gg = $db->query($sql);
		 	if($gg->num_rows > 0){
		 		$uuu = [];
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$uuu[] = [
		 				'id_pembelian'=>$row['id_pembelian'],
		 				'tgl' => $row['tgl'],
		 				'total' => $row['total'],
		 				'INV' => $row['INV'],
		 				'nama' => $row['pegawai'],
		 				'nama_suplier' => $row['nama_suplier']
		 			];
		 		}
			 	$detail = [];
			 	$sql = "select i.id_detail_pem, i.id_pembelian, i.kode_brg, i.jumlah ,j.nama_brg ,i.harga,i.total from tb_detail_pembelian i left join tb_barang j on i.kode_brg = j.kode_brg where i.id_pembelian = '".$_POST['id_pembelian']."'";
			 	$gg = $db->query($sql);
			 	if($gg->num_rows > 0){
		 			while($row = mysqli_fetch_assoc($gg)) {
		 				// echo $row['id_detail_pem'];
		 				$detail[] = [
		 					'id_detail_pem' => $row['id_detail_pem'],
		 					'id_pembelian' => $row['id_pembelian'],
		 					'kode_brg' => $row['kode_brg'],
		 					'nama_brg' => $row['nama_brg'],
		 					'jumlah' => $row['jumlah'],
		 					'harga' => $row['harga'],
		 					'total' => $row['total']
		 				];
		 			}
			 	}
			 	$toJSON = [
			 		'status' => 'success',
			 		'tb_pembelian' => $uuu,
			 		'tb_detail_pembelian' => $detail
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 	}
		break;
		case 'fetch':
			$sql = "select i.id_pembelian, i.tgl, i.total, i.INV, k.Nama as pegawai, j.Nama as nama_suplier from tb_pembelian i left join tb_supel j on i.id_supel = j.id_supel left join tb_user k on i.id_user = k.id_user where i.status = 1 order by i.id_pembelian desc";
		 	$gg = $db->query($sql);
		 	echo $db->error;
		 	if($gg->num_rows > 0){
		 		$uuu = [];
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$uuu[] = [
		 				'id_pembelian'=>$row['id_pembelian'],
		 				'tgl' => $row['tgl'],
		 				'total' => $row['total'],
		 				'INV' => $row['INV'],
		 				'nama' => $row['pegawai'],
		 				'nama_suplier' => $row['nama_suplier']
		 			];
		 		}
		 		$toJSON = [
			 		'status' => 'success',
			 		'message' => $uuu
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 	}

		break;
		case 'total':
			$sql = "UPDATE tb_pembelian set no_referensi='".$_POST['no_referensi']."', tgl = '".date("Y-m-d")."', id_supel = '".$_POST['id_supel']."', total = '".$_POST['total'] ."', status='1' WHERE id_pembelian= '".$_POST['id_pembelian']."'";
		 	if ($db->query($sql) === TRUE) {
		    	// select kembali detail transaksi pembeliannya
		    	$sql = "select i.id_detail_pem, i.id_pembelian, i.kode_brg, i.jumlah ,j.nama_brg ,i.harga,i.total from tb_detail_pembelian i left join tb_barang j on i.kode_brg = j.kode_brg  where  i.id_pembelian = '".$_POST['id_pembelian']."'";
			 	$gg = $db->query($sql);
			 	if($gg->num_rows > 0){
			 		while($row = mysqli_fetch_assoc($gg)) {
			 			$in_stock = "INSERT INTO  in_stok (no_transaksi,tanggal,kode_brg,qty,harga) VALUES (".$_POST['id_pembelian'].", '".date("Y-m-d")."','".$row['kode_brg']."',".$row['jumlah'].", ".$row['harga'].")";
			 			if ($db->query($in_stock) === TRUE) {
			 				$updateStokBarang = "UPDATE tb_barang set harga_beli = ".$row['harga']." ,stok = (stok+".$row['jumlah'].") where kode_brg = '".$row['kode_brg']."'";
			 				if ($db->query($updateStokBarang) === TRUE) {

			 				}
			 			}else {
						    echo "Error: " . $sql . "<br>" . $db->error;
						}
			 		}
			 		$toJSON = [
				 		'status' => 'success',
				 		'message' => 'Data telah tersimpan'
				 	];
				 	header('Content-Type: application/json');
				 	echo json_encode($toJSON);
			 	}
		    }else{
		    	$toJSON = [
		    		'status' => 'error',
			 		'message' => $db->error
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		    }
			return;
		break;
		case 'new':
		 	$sql = 'select status from tb_pembelian where id_user = '.$_SESSION['karyawan'].' AND status=0 limit 1';
		 	$gg = mysqli_query($db,$sql);
		    $row = mysqli_fetch_row($gg);
		    if(isset($row[0])==true){
		    	if($row[0] == 0){
		    		readyInput($db);
		    	}
		    }else{
		    	$sql = "INSERT INTO  tb_pembelian (id_supel,tgl,total,id_user) VALUES (0, '".date("Y-m-d")."', 0, ".$_SESSION['karyawan'].")";
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
			$checkNoEMptyStock = "SELECT stok from tb_barang where kode_brg = '".$_POST['kode_brg']."'";
			$checkNoEMptyStock = $db->query($checkNoEMptyStock);
	    	if($checkNoEMptyStock == TRUE){
	    		$row = mysqli_fetch_array($checkNoEMptyStock);
		    	if(count($row)==0){
		    		$toJSON = [
	    				'status' => 'rejected',
				 		'message' => 'Stok kosong'
				 	];
				 	header('Content-Type: application/json');
				 	echo json_encode($toJSON);
		    		return;
		    	}
	    	}


			$sql = 'select * from tb_detail_pembelian i left join tb_barang j on i.kode_brg = j.kode_brg  where i.kode_brg = "'.$_POST['kode_brg'].'" AND  id_pembelian = "'.$_POST['id_pembelian'].'"';
			$gg = $db->query($sql);
 			if($gg->num_rows > 0){
 				 try{
				    $sql = "UPDATE tb_detail_pembelian set jumlah = ".$_POST['jumlah'].",harga=".$_POST['harga'].", total=".$_POST['jumlah']*$_POST['harga']." where kode_brg = '".$_POST['kode_brg']."' AND id_pembelian = '".$_POST['id_pembelian']."'";
					$updated = mysqli_query($db,$sql);
					if ($updated) {
						$sql = 'select i.id_detail_pem, i.id_pembelian, i.kode_brg, j.nama_brg, i.jumlah, i.harga, i.total from tb_detail_pembelian i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_pembelian = "'.$_POST['id_pembelian'].'"';
					 	$gg = $db->query($sql);
				 		$detail = array();
					 	if($gg->num_rows > 0){
					 		while($row = mysqli_fetch_assoc($gg)) {
					 			$detail[] = [
				 					'id_detail_pem' => $row['id_detail_pem'],
				 					'id_pembelian' => $row['id_pembelian'],
				 					'kode_brg' => $row['kode_brg'],
				 					'nama_brg' => $row['nama_brg'],
				 					'jumlah' => $row['jumlah'],
				 					'harga' => $row['harga'],
				 					'total' => $row['total']
				 				];
					 		}
					 	}
					 	$toJSON = [
					 		'status' => 'success',
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
 				$sql = "INSERT INTO  tb_detail_pembelian (id_pembelian,kode_brg,jumlah,harga,total) VALUES ('".$_POST['id_pembelian']."','".$_POST['kode_brg']."',".$_POST['jumlah'].",".$_POST['harga'].",".$_POST['jumlah']*$_POST['harga'].")";
				if ($db->query($sql) === TRUE) {
					$sql = 'select i.id_detail_pem, i.id_pembelian, i.kode_brg, j.nama_brg, i.jumlah, i.harga, i.total from tb_detail_pembelian i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_pembelian = "'.$_POST['id_pembelian'].'"';
					 	$gg = $db->query($sql);
				 		$detail = array();
					 	if($gg->num_rows > 0){
					 		while($row = mysqli_fetch_assoc($gg)) {
					 			$detail[] = [
				 					'id_detail_pem' => $row['id_detail_pem'],
				 					'id_pembelian' => $row['id_pembelian'],
				 					'kode_brg' => $row['kode_brg'],
				 					'nama_brg' => $row['nama_brg'],
				 					'jumlah' => $row['jumlah'],
				 					'harga' => $row['harga'],
				 					'total' => $row['total']
				 				];
					 		}
					 	}
					 	$toJSON = [
					 		'status' => 'success',
					 		'tb_detail_pembelian' => $detail
					 	];
					 	header('Content-Type: application/json');
					 	echo json_encode($toJSON);
				}
 			}
		break;
		case 'delete':
			$sql = "DELETE from tb_detail_pembelian where kode_brg = '".$_POST['kode_brg']."' AND id_pembelian = '".$_POST['id_pembelian']."'";
			$updated = mysqli_query($db,$sql);
			if ($updated) {
				$sql = 'select i.id_detail_pem, i.id_pembelian, i.kode_brg, j.nama_brg, i.jumlah, i.harga, i.total from tb_detail_pembelian i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_pembelian = "'.$_POST['id_pembelian'].'"';
			 	$gg = $db->query($sql);
		 		$detail = array();
			 	if($gg->num_rows > 0){
			 		while($row = mysqli_fetch_assoc($gg)) {
			 			$detail[] = [
		 					'id_detail_pem' => $row['id_detail_pem'],
		 					'id_pembelian' => $row['id_pembelian'],
		 					'kode_brg' => $row['kode_brg'],
		 					'nama_brg' => $row['nama_brg'],
		 					'jumlah' => $row['jumlah'],
		 					'harga' => $row['harga'],
		 					'total' => $row['total']
		 				];
			 		}
			 	}
			 	$toJSON = [
			 		'status' => 'success',
			 		'tb_detail_pembelian' => $detail
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			}else{
				echo 'enggak ada';
			}
		break;
		case 'delete-transaksi':
			$sql = "UPDATE tb_pembelian SET tgl = '' where id_pembelian = '".$_POST['id_pembelian']."'";
			$updated = mysqli_query($db,$sql);
			if ($updated) {
				$sql = 'DELETE from tb_detail_pembelian  where  id_pembelian = "'.$_POST['id_pembelian'].'"';
			 	$gg = $db->query($sql);
			 	echo $db->error;
			 	$toJSON = [
			 		'status' => 'success',
			 		'message' => 'tb_detail_pembelian sudah di delete!'
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