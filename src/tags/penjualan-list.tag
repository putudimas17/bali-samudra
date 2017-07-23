<penjualan-list>
	<div class="container-fluid">
		<!-- row -->
		<div class="row">
			<!--col-->
			<div class="col-md-12">
				<h2 class="page-title">Data Penjualan</h2>
				<div class="panel-heading">
					<p><a href="#" class="btn btn-success" onclick="{handleTambahJual.bind(this)}">Tambah Transaksi Penjualan</a>
					</p>
				</div>
				<div class="form">
					<div></div>
					<div></div>
					<div></div>
				</div>
				<div class="panel panel-default">
					
					<div class="panel-body">
						<table id="zctb" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th> No </th>
									<th>INV </th>
									<th>Tanggal </th>
									<th>Total</th>
									<th>Pegawai</th>
									<th>View Detail</th>
								</tr>
							</thead>
							<tbody>
								<tr each="{item,index in tb_penjualan}">
									
									<td>
										{index+1}
									</td>
									<td>
										{item.INV}
									</td>
									<td>
										{item.tgl}
									</td>
									<td>
										{item.total}
									</td>
									<td>
										{item.nama}
									</td>
									<td align="center">
										<a href="#" data-target="#EditDataPembelian" data-toggle="modal" data-backdrop="static" onclick="{handleViewDetail.bind(this,item.id_penjualan)}" class="fa fa-edit"-></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<!--
										<a href="#" class="hapus_modal fa fa-trash-o" onclick="confirm_modal('pembelian/pembelian_hapus.php?&id=<?php echo  $r['id']; ?>');"></a>
										-->
									</td>
									
								</tr>
							</tbody>
							
						</table>
					</div>
				</div>
			<!-- /Zero Configuration Table -->
			</div>
		<!-- /col-->
		</div>
		<!-- /row-->
		<!-- div memasukkan inputan -->
		<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">Tambah Transaksi Pembelian </div>
								<div class="panel-body">
									<form method="post" class="form-horizontal" action="#">
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Username</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="username">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Password</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="password">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Level</label>
											<div class="col-sm-10">
												<select name="level" class="form-control" required>
													<option value=""> -- Pilih Sebagai --</option>
													<option value="admin">ADMIN</option>
													<option value="karyawan">KARYAWAN</option>
													<option value="owner">OWNER</option>
												</select>
											</div>
										</div>
										<div class="col-sm-8 col-sm-offset-2">
											<button class="btn btn-primary" type="submit" name="simpan">Save </button>
											<button class="btn btn-default" type="reset" data-dismiss="modal" onclick="window.location.href=window.location.href;">Cancel</button>
											
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- end memasukkan data -->

		<!--edit data user -->
		<div class="modal fade" id="EditDataPembelian" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content"> </div>
			</div>
		</div>
		<!--edit data user -->

		<!-- modal hapus -->
		<div class="modal fade" id="modal_delete">
			<div class="modal-dialog">
				<div class="modal-content" style="margin-top:100px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" style="text-align:center;">Anda Yakin Untuk Menghapus Data?</h4>
					</div>
					
					<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
						<a href="#" class="btn btn-danger" id="delete_link">Delete</a>
						<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal hapus -->
	</div>
	<script>
		// u can require at this 
		let debounce = require('lodash/debounce.js');
		require('../scss/pembelian.scss');	
		let momentjs = require('moment');
		let {
			penjualanRequest,
			barangRequest,
			supplierRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let riot = require('riot');
		let req_tbPenjualan = function(callback){
			var formData = new FormData();
			formData.append('empty','');
			getRestApiService(formData,penjualanRequest.fetchPenjualan,function(data){
				data = JSON.parse(data);
				callback(data.message);
				
			})
		}
		this.tb_penjualan = [];
		this.handleTambahJual = function(e){
			e.preventUpdate = true;
			vm.opts.changePage({
				action : 'open-input'
			})
		}
		this.handleViewDetail = function(id_penjualan,e){
			e.preventUpdate = true;
			vm.opts.changePage({
				action : 'open-view',
				id_penjualan : id_penjualan
			})
		}
		this.on('mount',function(){
			req_tbPenjualan(function(data){
				vm.tb_penjualan = data;
				console.log(vm.tb_penjualan);
				vm.setState(function(){

				})
			})
		})
		let vm = this;

	</script>
</penjualan-list>