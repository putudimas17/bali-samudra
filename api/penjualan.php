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
	$sql = 'select * from tb_penjualan where id_user = '.$_SESSION['karyawan'].' and status=0';
 	$gg = $db->query($sql);
 	if($gg->num_rows > 0){
 		$head = array();
 		while($row = mysqli_fetch_assoc($gg)) {
 			$head[] = [
 				'id_penjualan' => $row['id_penjualan'],
 				'INV' => $row['INV'],
 				'tgl' => $row['tgl'],
 				'total' => $row['total'],
 				'id_user' => $row['id_user'],
 				'status' => $row['status']
 			];
 		}
 		// get detail
	    $sql = "select i.id_detail_pen, i.id_penjualan, i.kode_brg, i.jumlah, i.harga, i.subtotal, j.nama_brg from tb_detail_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg where id_penjualan = '".$head[0]['id_penjualan']."'";
	 	$gg = $db->query($sql);
 		$detail = array();
 		echo $db->error;
	 	if($gg->num_rows > 0){
	 		while($row = mysqli_fetch_assoc($gg)) {
	 			$detail[] = [
 					'id_detail_pen' => $row['id_detail_pen'],
 					'id_penjualan' => $row['id_penjualan'],
 					'kode_brg' => $row['kode_brg'],
 					'jumlah' => $row['jumlah'],
 					'nama_brg' => $row['nama_brg'],
 					'harga' => $row['harga'],
 					'subtotal' => $row['subtotal']
 				];
	 		}
	 	}
	 	$toJSON = [
	 		'tb_penjualan' => $head,
	 		'tb_detail_penjualan' => $detail
	 	];
	 	header('Content-Type: application/json');
	 	echo json_encode($toJSON);
	 	return;
 	}
}

if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'view':
			$sql = "select i.id_penjualan,i.bayar,i.kembali, i.tgl, i.total, i.INV, k.Nama as pegawai from tb_penjualan i left join tb_user k on i.id_user = k.id_user where i.id_penjualan = '".$_POST['id_penjualan']."' order by i.id_penjualan desc";
		 	$gg = $db->query($sql);
		 	if($gg->num_rows > 0){
		 		$uuu = [];
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$uuu[] = [
		 				'id_penjualan'=>$row['id_penjualan'],
		 				'tgl' => $row['tgl'],
		 				'total' => $row['total'],
		 				'bayar' => $row['bayar'],
		 				'kembali' => $row['kembali'],
		 				'INV' => $row['INV'],
		 				'nama' => $row['pegawai'],
		 			];
		 		}
			 	$detail = [];
			 	$sql = "select * from tb_detail_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg where i.id_penjualan = '".$_POST['id_penjualan']."'";
			 	$gg = $db->query($sql);
			 	if($gg->num_rows > 0){
		 			while($row = mysqli_fetch_assoc($gg)) {
		 				// echo $row['id_detail_pem'];
		 				$detail[] = [
		 					'id_detail_pen' => $row['id_detail_pen'],
		 					'id_penjualan' => $row['id_penjualan'],
		 					'kode_brg' => $row['kode_brg'],
		 					'nama_brg' => $row['nama_brg'],
		 					'jumlah' => $row['jumlah'],
		 					'harga' => $row['harga'],
		 					'subtotal' => $row['subtotal']
		 				];
		 			}
			 	}
			 	$toJSON = [
			 		'status' => 'success',
			 		'tb_penjualan' => $uuu,
			 		'tb_detail_penjualan' => $detail
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 	}
		break;
		case 'new':
			$sql = 'select status from tb_penjualan where id_user = '.$_SESSION['karyawan'].' AND status=0 limit 1';
		 	$gg = mysqli_query($db,$sql);
		    $row = mysqli_fetch_row($gg);
		    if(isset($row[0])==true){
		    	$sql = "UPDATE tb_penjualan set tgl = '".date("Y-m-d H:i:s")."' where id_user = ".$_SESSION['karyawan']." AND status=0 ";
				$gg = mysqli_query($db,$sql);
		    	if($row[0] == 0){
		    		readyInput($db);
		    	}
		    }else{
		    	$sql = "INSERT INTO  tb_penjualan (tgl,total,id_user,status) VALUES ('".date("Y-m-d H:i:s")."',0,".$_SESSION['karyawan'].",0)";
				if ($db->query($sql) === TRUE) {
					$sql = 'select id_penjualan from tb_penjualan where id_user = '.$_SESSION['karyawan'].' and status = 0';
					$gg = mysqli_query($db,$sql);
				    $row = mysqli_fetch_row($gg);
				    // echo $row[0].'242342344';
				    if(isset($row[0])==true){
				    	// var_dump($row[0]);
				    	$sql = "update tb_penjualan set INV = '"."TRX-".str_pad($row[0], 7, "0", STR_PAD_LEFT)."' where status = 0 and id_user = '".$_SESSION['karyawan']."'";
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
		case 'delete':
			$sql = "DELETE from tb_detail_penjualan where kode_brg = '".$_POST['kode_brg']."' AND id_penjualan = '".$_POST['id_penjualan']."'";
			$updated = mysqli_query($db,$sql);
			if ($updated) {
				$sql = 'select * from tb_detail_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_penjualan = "'.$_POST['id_penjualan'].'"';
			 	$gg = $db->query($sql);
		 		$detail = array();
			 	if($gg->num_rows > 0){
			 		while($row = mysqli_fetch_assoc($gg)) {
			 			$detail[] = [
		 					'id_detail_pen' => $row['id_detail_pen'],
		 					'id_penjualan' => $row['id_penjualan'],
		 					'kode_brg' => $row['kode_brg'],
		 					'nama_brg' => $row['nama_brg'],
		 					'jumlah' => $row['jumlah'],
		 					'harga' => $row['harga'],
		 					'subtotal' => $row['subtotal']
		 				];
			 		}
			 	}
			 	$toJSON = [
			 		'tb_detail_penjualan' => $detail
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			}else{
				echo 'enggak ada '.$db->error;
			}
		break;
		case 'save':
			$checkNoEMptyStock = "SELECT stok from tb_barang where kode_brg = '".$_POST['kode_brg']."'";
			$checkNoEMptyStock = $db->query($checkNoEMptyStock);
	    	if($checkNoEMptyStock == TRUE){
	    		$row = mysqli_fetch_array($checkNoEMptyStock);
		    	if($row[0] >= $_POST['jumlah']){
		    	}else{
		    		if($row[0] > 0){
		    			$toJSON = [
		    				'status' => 'rejected',
					 		'message' => 'Pesanan melebihin stok yang ready!'
					 	];
					 	header('Content-Type: application/json');
					 	echo json_encode($toJSON);
		    			return;
		    		}else{
		    			$toJSON = [
		    				'status' => 'rejected',
					 		'message' => 'Stok kosong'
					 	];
					 	header('Content-Type: application/json');
					 	echo json_encode($toJSON);
					 	return;
		    		}
		    	}
		    }else{
		    	$toJSON = [
    				'status' => 'rejected',
			 		'message' => 'Stok kosong!!'
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			 	return;
		    }
			$sql = 'select i.id_detail_pen, i.id_penjualan, i.kode_brg, j.nama_brg, i.jumlah, j.harga, i.subtotal  from tb_detail_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where i.kode_brg = "'.$_POST['kode_brg'].'" AND  id_penjualan = "'.$_POST['id_penjualan'].'"';
			$gg = $db->query($sql);
 			if($gg->num_rows > 0){
 				 try{
				    $sql = "UPDATE tb_detail_penjualan set jumlah = ".$_POST['jumlah'].", subtotal=".$_POST['jumlah']*$_POST['harga']." where kode_brg = '".$_POST['kode_brg']."' AND id_penjualan = '".$_POST['id_penjualan']."'";
					$updated = mysqli_query($db,$sql);
					if ($updated) {
						$sql = 'select * from tb_detail_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_penjualan = "'.$_POST['id_penjualan'].'"';
					 	$gg = $db->query($sql);
				 		$detail = array();
					 	if(isset($gg->num_rows)){
					 		while($row = mysqli_fetch_assoc($gg)) {
					 			$detail[] = [
				 					'id_detail_pen' => $row['id_detail_pen'],
				 					'id_penjualan' => $row['id_penjualan'],
				 					'kode_brg' => $row['kode_brg'],
				 					'nama_brg' => $row['nama_brg'],
				 					'jumlah' => $row['jumlah'],
				 					'harga' => $row['harga'],
				 					'subtotal' => $row['subtotal']
				 				];
					 		}
					 		$toJSON = [
					 			'status' => 'success',
						 		'tb_detail_penjualan' => $detail
						 	];
						 	header('Content-Type: application/json');
						 	echo json_encode($toJSON);
					 	}else{
					 		echo "Error: " . $sql . "<br>" . $db->error;
					 	}
					}else{
						echo "Error: " . $sql . "<br>" . $db->error;
					}
				 } catch(Exception $e){
				     echo $e->getMessage();
				 }
 			}else{
 				$sql = "INSERT INTO  tb_detail_penjualan (id_penjualan,kode_brg,jumlah,harga,subtotal) VALUES ('".$_POST['id_penjualan']."','".$_POST['kode_brg']."',".$_POST['jumlah'].",".$_POST['harga'].",".$_POST['jumlah']*$_POST['harga'].")";
				if ($db->query($sql) === TRUE) {
					$sql = 'select * from tb_detail_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_penjualan = "'.$_POST['id_penjualan'].'"';
				 	$gg = $db->query($sql);
			 		$detail = array();
				 	if($gg->num_rows > 0){
				 		while($row = mysqli_fetch_assoc($gg)) {
				 			$detail[] = [
			 					'id_detail_pen' => $row['id_detail_pen'],
			 					'id_penjualan' => $row['id_penjualan'],
			 					'kode_brg' => $row['kode_brg'],
			 					'nama_brg' => $row['nama_brg'],
			 					'jumlah' => $row['jumlah'],
			 					'harga' => $row['harga'],
			 					'subtotal' => $row['subtotal']
			 				];
				 		}
				 	}
				 	$toJSON = [
				 		'status'=>'success',
				 		'tb_detail_penjualan' => $detail
				 	];
				 	header('Content-Type: application/json');
				 	echo json_encode($toJSON);
				}else{
					echo "Error: " . $sql . "<br>" . $db->error;
				}
 			}
		break;
		case 'fetch':
			$sql = "select i.id_penjualan, i.tgl, i.total, i.bayar, i.kembali, i.INV, k.Nama as pegawai from tb_penjualan i left join tb_user k on i.id_user = k.id_user where i.status = 1 order by i.id_penjualan desc";
		 	$gg = $db->query($sql);

		 	if($gg->num_rows > 0){
		 		$uuu = [];
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$uuu[] = [
		 				'id_penjualan'=>$row['id_penjualan'],
		 				'tgl' => $row['tgl'],
		 				'total' => $row['total'],
		 				'INV' => $row['INV'],
		 				'bayar' => $row['bayar'],
		 				'kembali' => $row['kembali'],
		 				'nama' => $row['pegawai'],
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
			$sql = "select * from tb_detail_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  i.id_penjualan = '".$_POST['id_penjualan']."'";
		 	if($db->query($sql) == false){
		 		$toJSON = [
    				'status' => 'rejected',
			 		'message' => 'Belum Ada Pesanan!'
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			 	return;
		 	}
			$sql = "UPDATE tb_penjualan set total = '".$_POST['total'] ."', bayar='".$_POST['bayar']."', kembali='".($_POST['bayar']-$_POST['total'])."', status='1' WHERE id_penjualan= '".$_POST['id_penjualan']."'";
		 	echo $db->error;
		 	if ($db->query($sql) === TRUE) {
		    	// select kembali detail transaksi pembeliannya
		    	$sql = "select * from tb_detail_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  i.id_penjualan = '".$_POST['id_penjualan']."'";
			 	$gg = $db->query($sql);
			 	if($gg->num_rows > 0){
			 		// delete dulu stok di tb_barang
			 		while ($row = mysqli_fetch_assoc($gg)){
			 			$outstok = "INSERT into out_stok (no_transaksi,tanggal,kode_brg,qty,harga) values (".$_POST['id_penjualan'].",'".date("Y-m-d H:i:s")."','".$row['kode_brg']."',".$row['jumlah'].",".$row['harga'].")";
			 			if($db->query($outstok) == true){

		    			}else{
		    				echo 'A -> '.$db->error;
		    			}
			 			$delStokBarang = "UPDATE tb_barang set stok = (stok - ".$row['jumlah'].") where kode_brg = '".$row['kode_brg']."'";
			 			$delStokBarang = mysqli_query($db,$delStokBarang);

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
		break;
		case 'delete-transaksi':
			$sql = "UPDATE tb_penjualan SET tgl = '' where id_penjualan = '".$_POST['id_penjualan']."'";
			$updated = mysqli_query($db,$sql);
			if ($updated) {
				$sql = 'DELETE from tb_detail_penjualan  where  id_penjualan = "'.$_POST['id_penjualan'].'"';
			 	$gg = $db->query($sql);
			 	echo $db->error;
			 	$toJSON = [
			 		'status' => 'success',
			 		'message' => 'tb_detail_penjualan sudah di delete!'
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			}else{
				echo 'enggak ada';
			}
		break;
	}
}