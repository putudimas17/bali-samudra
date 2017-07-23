<?php
if ( !isset( $_SESSION ) ) {
	session_start();

}
include "../koneksi.php"; 

if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'search-barang':
		 	$sql = 'select * from tb_barang where kode_brg = "'.$_POST['kode_brg'].'"';
		 	$gg = $db->query($sql);
	 		$barang = array();
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
		case 'add':

		break;
		case 'delete':

		break;
		case 'save':

		break;
		case 'fetch':
			$sql = 'select * from tb_barang';
		 	$gg = $db->query($sql);
	 		$barang = array();
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
		 	}
		 	$toJSON = [
		 		'status' => 'success',
		 		'tb_barang' => $barang
		 	];
		 	header('Content-Type: application/json');
		 	echo json_encode($toJSON);
			return;
		break;
	}
}