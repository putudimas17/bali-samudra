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
	$sql = 'select * from tb_retur_penjualan where id_user = '.$_SESSION['karyawan'].' and status=0';
 	$gg = $db->query($sql);
 	if($gg->num_rows > 0){
 		$head = array();
 		while($row = mysqli_fetch_assoc($gg)) {
 			$head[] = [
 				'id' => $row['id'],
 				'INV' => $row['INV'],
 				'id_supel' => $row['id_supel'],
 				'tgl' => $row['tgl'],
 				'total' => $row['total'],
 				'id_user' => $row['id_user'],
 				'status' => $row['status']
 			];
 		}
 		// get detail 
	    $sql = "select * from tb_detail_retur_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg where i.id = '".$head[0]['id']."'";
	 	$gg = $db->query($sql);
 		$detail = array();
 		echo $db->error;
	 	if($gg->num_rows > 0){
	 		while($row = mysqli_fetch_assoc($gg)) {
	 			$detail[] = [
 					'id_retur' => $row['id_retur'],
 					'id' => $row['id'],
 					'kode_brg' => $row['kode_brg'],
 					'jumlah' => $row['jumlah'],
 					'nama_brg' => $row['nama_brg'],
 					'harga' => $row['harga'],
 					'total' => $row['total']
 				];
	 		}
	 	}
	 	$toJSON = [
	 		'tb_retur_penjualan' => $head,
	 		'tb_detail_retur_penjualan' => $detail
	 	];
	 	header('Content-Type: application/json');
	 	echo json_encode($toJSON);
	 	return;
 	}
}
if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'view':
			$sql = " select l.INV as INV_penjualan,i.id, i.tgl, i.total, i.INV, k.Nama as pegawai, j.Nama as nama_suplier from tb_retur_penjualan i left join tb_supel j on i.id_supel = j.id left join tb_user k on i.id_user = k.id left join tb_penjualan l on i.no_penjualan = l.id_penjualan where i.id = '".$_POST['id']."' order by i.id desc";
		 	$gg = $db->query($sql);
		 	echo $db->error;
		 	if($gg->num_rows > 0){
		 		$uuu = [];
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$uuu[] = [
		 				'id'=>$row['id'],
		 				'tgl' => $row['tgl'],
		 				'total' => $row['total'],
		 				'INV' => $row['INV'],
		 				'INV_pembelian' => $row['INV_penjualan'],
		 				'nama' => $row['pegawai'],
		 				'nama_suplier' => $row['nama_suplier']
		 			];
		 		}		 		
			 	$detail = [];
			 	$sql = 'select i.id_retur, i.id, i.kode_brg, j.nama_brg,i.jumlah,i.harga,i.total from tb_detail_retur_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_retur = "'.$_POST['id'].'"';
			 	$gg = $db->query($sql);
		 		$detail = array();
			 	if($gg->num_rows > 0){
			 		while($row = mysqli_fetch_assoc($gg)) {
			 			$detail[] = [
		 					'id_retur' => $row['id_retur'],
		 					'id' => $row['id'],
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
			 		'tb_retur_penjualan' => $uuu,
			 		'tb_detail_retur_penjualan' => $detail
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 	}
		break;
		case 'fetch-barang-dari-penjualan':
			$sql = 'select i.kode_brg, i.id_kategori, i.nama_brg, i.stok, i.harga, i.satuan from tb_barang i left join tb_detail_penjualan j on i.kode_brg = j.kode_brg where j.id_penjualan = '.$_POST['id_penjualan'].'';
		 	$gg = $db->query($sql);
	 		$barang = array();
	 		echo $db->error;
		 	if($gg->num_rows > 0){
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$barang[] = [
	 					'kode_brg' => $row['kode_brg'],
	 					'id_kategori' => $row['id_kategori'],
	 					'nama_brg' => $row['nama_brg'],
	 					'stok' => $row['stok'],
	 					'harga' => $row['harga'],
	 					'satuan' => $row['satuan']
	 				];
		 		}
		 	}else{
		 		$toJSON = [
    				'status' => 'rejected',
			 		'message' => 'Tidak ada produk ini'
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 		return;
		 	}
		 	$toJSON = [
		 		'status' => 'success',
		 		'tb_barang' => $barang
		 	];
		 	header('Content-Type: application/json');
		 	echo json_encode($toJSON);
		break;
		case 'search-barang-dari-penjualan':
			$sql = 'select i.kode_brg, i.id_kategori, i.nama_brg, j.jumlah, j.harga, i.satuan from tb_barang i left join tb_detail_penjualan j on i.kode_brg = j.kode_brg where i.kode_brg = "'.$_POST['kode_brg'].'" AND j.id_penjualan = '.$_POST['id_penjualan'].'';
		 	$gg = $db->query($sql);
	 		$barang = array();
		 	if($gg->num_rows > 0){
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$barang[] = [
	 					'kode_brg' => $row['kode_brg'],
	 					'id_kategori' => $row['id_kategori'],
	 					'nama_brg' => $row['nama_brg'],
	 					'stok' => $row['jumlah'],
	 					'harga' => $row['harga'],
	 					'satuan' => $row['satuan']
	 				];
		 		}
		 	}else{
		 		$toJSON = [
    				'status' => 'rejected',
			 		'message' => 'Tidak ada produk ini'
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 		return;
		 	}
		 	$toJSON = [
		 		'status' => 'success',
		 		'tb_barang' => $barang
		 	];
		 	header('Content-Type: application/json');
		 	echo json_encode($toJSON);
		break;
		case 'search-inv-penjualan':
			$sql = "select i.id_penjualan, i.tgl, i.total, i.INV, k.Nama as pegawai from tb_penjualan i left join tb_user k on i.id_user = k.id where i.status = 1 AND i.INV LIKE '%".$_GET['like']."%' order by i.id_penjualan desc";
		 	$gg = $db->query($sql);
		 	echo $db->error;
		 	if($gg->num_rows > 0){
		 		$uuu = [];
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$uuu[] = [
		 				'id_penjualan'=>$row['id_penjualan'],
		 				'tgl' => $row['tgl'],
		 				'total' => $row['total'],
		 				'INV' => $row['INV'],
		 				// 'id_supel' => $row['id_supel'],
		 				'nama' => $row['pegawai'],
		 				// 'nama_suplier' => $row['nama_suplier']
		 			];
		 		}
		 		$toJSON = [
			 		'status' => 'success',
			 		'message' => $uuu
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 	}else{
		 		$toJSON = [
			 		'status' => 'empty',
			 		'message' => []
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 	}
		break;
		case 'reset-ketika-ganti-id-penjual':
			$sql = "DELETE from tb_detail_retur_penjualan where id_retur = ".$_POST['id']."";
			$updated = mysqli_query($db,$sql);
			if ($updated) {
				$toJSON = [
			 		'status' => 'success',
			 		'message' => 'Transaksi telah di reset kemabli'
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			}
		break;
		case 'pasang-penjualan-dengan-retur-penjualan':
			$sql = "UPDATE tb_retur_penjualan set no_penjualan= '".$_POST['no_penjualan'] ."'  WHERE id= ".$_POST['id']."";
		 	if ($db->query($sql) === TRUE) {
		 		$sql = "SELECT * from tb_retur_penjualan where id = ".$_POST['id']."";
		 		$gg = $db->query($sql);
		 		if($gg->num_rows > 0){
		 			while($row = mysqli_fetch_assoc($gg)) {
			 			$uuu[] = [
			 				'id'=>$row['id'],
			 				'no_penjualan' => $row['no_penjualan'],
			 				'total' => $row['total'],
			 				'INV' => $row['INV'],
			 				'tgl' => $row['tgl'],
			 				// 'id_supel' => $row['id_supel']
			 			];
			 		}
			 		$toJSON = [
				 		'status' => 'success',
				 		'message' => $uuu
				 	];
				 	header('Content-Type: application/json');
				 	echo json_encode($toJSON);
		 		}
		 	}
		 	echo $db->error;
		break;
		case 'fetch':
			$sql = "select i.id, i.tgl, i.total, i.INV, k.Nama as pegawai, j.Nama as nama_suplier from tb_retur_penjualan i left join tb_supel j on i.id_supel = j.id left join tb_user k on i.id_user = k.id where i.status = 1 order by i.id desc";
		 	$gg = $db->query($sql);
		 	echo $db->error;
		 	if($gg->num_rows > 0){
		 		$uuu = [];
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$uuu[] = [
		 				'id'=>$row['id'],
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
		 	}else{
		 		$toJSON = [
			 		'status' => 'success',
			 		'message' => []
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 	}

		break;
		case 'total':
			$sql = "UPDATE tb_retur_penjualan set total = '".$_POST['total'] ."', status='1' WHERE id= '".$_POST['id']."'";
		 	if ($db->query($sql) === TRUE) {
		    	// select kembali detail transaksi pembeliannya
		    	$sql = "select * from tb_detail_retur_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  i.id_retur = '".$_POST['id']."'";
			 	$gg = $db->query($sql);
			 	if($gg->num_rows > 0){
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
		 	$sql = 'select status from tb_retur_penjualan where id_user = '.$_SESSION['karyawan'].' AND status=0 limit 1';
		 	$gg = mysqli_query($db,$sql);
		    $row = mysqli_fetch_row($gg);
		    if(isset($row[0])==true){
		    	if($row[0] == 0){
		    		readyInput($db);
		    	}
		    }else{
		    	$sql = "INSERT INTO  tb_retur_penjualan (INV,tgl,no_penjualan,id_supel,id_user) VALUES ('-', '".date("Y-m-d H:i:s")."', 0,0, ".$_SESSION['karyawan'].")";
				if ($db->query($sql) === TRUE) {
					$sql = 'select id from tb_retur_penjualan where id_user = '.$_SESSION['karyawan'].' and status = 0';
					$gg = mysqli_query($db,$sql);
				    $row = mysqli_fetch_row($gg);
				    echo $db->error;
				    // echo $row[0].'242342344';
				    if(isset($row[0])==true){
				    	// var_dump($row[0]);
				    	$sql = "update tb_retur_penjualan set INV = '"."ROT-".str_pad($row[0], 7, "0", STR_PAD_LEFT)."' where status = 0 and id_user = '".$_SESSION['karyawan']."'";
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
			/*
			$checkNoEMptyStock = "SELECT jumlah from tb_detail_pembelian i left join tb_retur_penjualan j on i.id_pembelian = j.no_pembelian where i.kode_brg = '".$_POST['kode_brg']."' AND  id_retur = ".$_POST['id_retur']."";
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
	    	}*/
			$sql = 'select * from tb_detail_retur_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where i.kode_brg = "'.$_POST['kode_brg'].'" AND  id_retur = "'.$_POST['id_retur'].'"';
			$gg = $db->query($sql);
 			if($gg->num_rows > 0){
 				 try{
				    $sql = "UPDATE tb_detail_retur_penjualan set jumlah = ".$_POST['jumlah'].", total=".$_POST['jumlah']*$_POST['harga']." where kode_brg = '".$_POST['kode_brg']."' AND id_retur = '".$_POST['id_retur']."'";
					$updated = mysqli_query($db,$sql);
					echo $db->error;
					if ($updated) {
						$sql = 'select i.id_retur, i.id, i.kode_brg, j.nama_brg,i.jumlah,i.harga,i.total from tb_detail_retur_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_retur = "'.$_POST['id_retur'].'"';
					 	$gg = $db->query($sql);
				 		$detail = array();
					 	if($gg->num_rows > 0){
					 		while($row = mysqli_fetch_assoc($gg)) {
					 			$detail[] = [
				 					'id_retur' => $row['id_retur'],
				 					'id' => $row['id'],
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
					 		'tb_detail_retur_penjualan' => $detail
					 	];
					 	header('Content-Type: application/json');
					 	echo json_encode($toJSON);
					}else{
						
					}
				 } catch(Exception $e){
				     echo $e->getMessage();
				 }

 			}else{
 				$sql = "INSERT INTO  tb_detail_retur_penjualan (id_retur,kode_brg,jumlah,harga,total) VALUES ('".$_POST['id_retur']."','".$_POST['kode_brg']."',".$_POST['jumlah'].",".$_POST['harga'].",".$_POST['jumlah']*$_POST['harga'].")";
				if ($db->query($sql) === TRUE) {
					$sql = 'select i.id_retur,i.id,i.kode_brg,j.nama_brg,i.jumlah,i.harga,i.total from tb_detail_retur_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_retur = "'.$_POST['id_retur'].'"';
				 	$gg = $db->query($sql);
			 		$detail = array();
				 	if($gg->num_rows > 0){
				 		while($row = mysqli_fetch_assoc($gg)) {
				 			$detail[] = [
			 					'id_retur' => $row['id_retur'],
			 					'id' => $row['id'],
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
				 		'tb_detail_retur_penjualan' => $detail
				 	];
				 	header('Content-Type: application/json');
				 	echo json_encode($toJSON);
				}
 			}
		break;
		case 'delete':
			$sql = "DELETE from tb_detail_retur_penjualan where kode_brg = '".$_POST['kode_brg']."' AND id = '".$_POST['id']."'";
			$updated = mysqli_query($db,$sql);
			if ($updated) {
				$sql = 'select i.id_retur,i.id,i.kode_brg,j.nama_brg,i.jumlah,i.harga,i.total from tb_detail_retur_penjualan i left join tb_barang j on i.kode_brg = j.kode_brg  where  id_retur = "'.$_POST['id_retur'].'"';
			 	$gg = $db->query($sql);
		 		$detail = array();
			 	if($gg->num_rows > 0){
			 		while($row = mysqli_fetch_assoc($gg)) {
			 			$detail[] = [
		 					'id_retur' => $row['id_retur'],
		 					'id' => $row['id'],
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
			 		'tb_detail_retur_penjualan' => $detail
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			}else{
				echo 'enggak ada';
			}
		break;
		case 'save':

		break;
		case 'search-barang':
		 	$sql = 'select i.kode_brg ,id_kategori ,nama_brg ,stok ,j.harga,satuan from tb_barang  i left join tb_detail_penjualan j on i.kode_brg = j.kode_brg where j.kode_brg = "'.$_POST['kode_brg'].'" AND  j.id_penjualan = "'.$_POST['id_penjualan'].'"';
		 	$gg = $db->query($sql);
	 		$barang = array();
	 		echo $db->error;
		 	if($gg->num_rows > 0){
		 		while($row = mysqli_fetch_assoc($gg)) {
		 			$barang[] = [
	 					'kode_brg' => $row['kode_brg'],
	 					'id_kategori' => $row['id_kategori'],
	 					'nama_brg' => $row['nama_brg'],
	 					'stok' => $row['stok'],
	 					'harga' => $row['harga'],
	 					'satuan' => $row['satuan']
	 				];
		 		}
		 	}else{
		 		$toJSON = [
    				'status' => 'rejected',
			 		'message' => 'Tidak ada produk ini'
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
		 		return;
		 	}
		 	$toJSON = [
		 		'status' => 'success',
		 		'tb_barang' => $barang
		 	];
		 	header('Content-Type: application/json');
		 	echo json_encode($toJSON);
		return;
		case 'delete-transaksi':
			$sql = "UPDATE tb_retur_penjualan SET tgl = '' where id = '".$_POST['id_retur']."'";
			$updated = mysqli_query($db,$sql);
			if ($updated) {
				$sql = 'DELETE from tb_detail_retur_penjualan  where  id_retur = "'.$_POST['id_retur'].'"';
			 	$gg = $db->query($sql);
			 	echo $db->error;
			 	$toJSON = [
			 		'status' => 'success',
			 		'message' => 'tb_detail_retur_penjualan sudah di delete!'
			 	];
			 	header('Content-Type: application/json');
			 	echo json_encode($toJSON);
			}else{
				echo 'enggak ada';
			}
		break;
	}
}