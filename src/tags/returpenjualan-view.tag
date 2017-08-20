<retur-penjualan-view class="container-fluid transaksi">
	<div class="header">
		<h3>Transaksi Retur Penjualan</h3>
	</div>
	<div class="form" >
		<div>
			<form class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">No Retur Pembelian</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{tb_retur_penjualan.INV}" data-role="text" data-parsley-errors-container="#errId1" readonly>
								<span id="errId1" class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">Tanggal</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{translateToDate(tb_retur_penjualan.tgl)}" data-role="text" data-parsley-errors-container="#errId1" readonly>
								<span id="errId1" class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field2">NO Pembelian</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{tb_retur_penjualan.INV_pembelian}" data-role="text" data-parsley-errors-container="#errId1" readonly>
								<span id="errId1" class="error"></span>
							</div>
						</div>						
					</div>
				</div>
			</form><br>
			<form  id="form2345">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="zctb" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode Barang</th>
												<th>Nama Barang</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Sub Total</th>
											</tr>
										</thead>
										<tbody>
											<tr each="{item, index in tb_detail_retur_penjualan}">
												<td>
													{index+1}
												</td>
												<td>
													{item.kode_brg}
												</td>
												<td>
													{item.nama_brg}
												</td>
												<td>
													{item.harga}
												</td>
												<td>
													{item.jumlah}
												</td>
												<td>
													{item.total}
												</td>
											</tr>
										</tbody>
									</table>												
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<form>
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<div class="row">
							<div class="form-group">
								<label class="control-label control-label-left col-sm-4">Grand Total</label>
								<div class="controls col-sm-8">
									<input id="txtGrandTotal" ref="text-total" type="text" value="{tb_retur_penjualan.total}" class="form-control k-textbox text-right" readonly>
								</div>
							</div>								
						</div>				
					</div>
				</div>
			</form><hr>
			<form>
				<div class="row">
					<div class="col-md-6 text-left">
						<a href="#" class="btn btn-success" onclick="{back.bind(this)}"><i class="fa fa-reply"></i> Kembali</a>
					</div>	
					<div class="col-md-6 text-right">
					</div>					
				</div>			
			</form>			
		</div>
	</div>
	<script>
		// u can require at this 
		let debounce = require('lodash/debounce.js');
		require('../scss/pembelian.scss');	
		let momentjs = require('moment');
		let {
			returPenjualanRequest,
			pembelianRequest,
			barangRequest,
			supplierRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let reqDetailReturPenjualan = function(callback){
			let formData = new FormData();
			console.log(vm.opts);
			formData.append('id',vm.opts.data.id_retur);
			getRestApiService(formData,returPenjualanRequest.viewDetail,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		this.translateToDate = function(value){
			return momentjs(value,'yyyy-mm-dd').format('LLL')
		}
		this.back = function(e){
			console.log(vm.opts);
			vm.opts.changePage({
				action : 'open-table'
			})
		}
		this.tb_retur_penjualan = [];
		this.tb_detail_retur_penjualan = [];
		this.on('mount',function(){
			reqDetailReturPenjualan(function(data){
				console.log(data);
				vm.tb_retur_penjualan = data.tb_retur_penjualan[0];
				vm.tb_detail_retur_penjualan = data.tb_detail_retur_penjualan;
				vm.setState(function(){

				})
			})
		})	
		let vm = this;
	</script>
</retur-penjualan-view>