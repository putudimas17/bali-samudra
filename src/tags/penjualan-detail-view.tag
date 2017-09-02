<penjualan-detail-view class="container-fluid transaksi">
	<div class="header">
		<h3>Detail Transaksi Penjualan</h3>
	</div>
	<div class="form" >
		<div>
			<form class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">No Pembelian</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{tb_penjualan.INV}" data-role="text" data-parsley-errors-container="#errId1" readonly>
								<span id="errId1" class="error"></span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">Tanggal</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{translateToDate(tb_penjualan.tgl)}" data-role="text" data-parsley-errors-container="#errId1" readonly>
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
											<tr each="{item, index in tb_detail_penjualan}">
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
													{item.subtotal}
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
			<div style="display: none">
				<div id="print-box">
					<div class="section">
						<h2>PT GANTI SENDIRI</h2>
						<h5>
							STRUK PEMBAYARAN
						</h5>
					</div>
					<div class="section">
						<table>
							<tr>
								<th>Item</th>
								<th class="w-auto right">Sub Total</th>
							</tr>
							<tr>
								<td colspan="2" class="no-padding">
									<div class="divider"></div>
								</td>
							</tr>
							<tr each="{item, index in tb_detail_penjualan}">
								<td>
									<div class="s-row">
										<div class="s-col c-12">
											{item.nama_brg}
										</div>
										<div class="s-col c-12">
											{item.jumlah} x {toMoneyCurrency(item.subtotal)}
										</div>
									</div>
								</td>
								<td>{toMoneyCurrency(item.subtotal)}</td>
							</tr>
							<!--tr>
								<td colspan="2">
									Sub Total
								</td>
								<td>{item.subtotal}</td>
							</tr>
							<tr>
								<td colspan="2">
									Tax
								</td>
								<td>27,272</td>
							</tr-->
							<tr>
								<td colspan="2" class="no-padding">
									<div class="divider"></div>
								</td>
							</tr>
							<tr>
								<td class="right">
									TOTAL
								</td>
								<td>{toMoneyCurrency(tb_penjualan.total)}</td>
							</tr>
							<tr>
								<td class="right">
									CASH
								</td>
								<td>{toMoneyCurrency(tb_penjualan.bayar)}</td>
							</tr>
							<tr>
								<td colspan="2" class="no-padding">
									<div class="divider"></div>
								</td>
							</tr>
							<tr>
								<td class="right">
									Kembali
								</td>
								<td >{toMoneyCurrency(tb_penjualan.kembali)}</td>
							</tr>
						</table>
					</div>
					<div class="section">
						<h4>Terima Kasih</h4>
						<h5>
				
						</h5>
					</div>
				</div>
			</div>

			<form>
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<div class="row">
							<div class="form-group">
								<label class="control-label control-label-left col-sm-4">Grand Total</label>
								<div class="controls col-sm-8">
									<input id="txtGrandTotal" ref="text-total" type="text" value="{tb_penjualan.total}" class="form-control k-textbox text-right" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label control-label-left col-sm-4">Bayar</label>
								<div class="controls col-sm-8">
									<input id="txtGrandTotal" ref="text-total" type="text" value="{tb_penjualan.bayar}" class="form-control k-textbox text-right" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label control-label-left col-sm-4">Kembali</label>
								<div class="controls col-sm-8">
									<input id="txtGrandTotal" ref="text-total" type="text" value="{tb_penjualan.kembali}" class="form-control k-textbox text-right" readonly>
								</div>
							</div>						
						</div>				
					</div>
				</div>
			</form><hr>
			<form>
				<div class="row">
					<div class="col-md-6 text-left">
						<a href="#" id="print" class="btn btn-primary" onclick="{handlePrint.bind(this)}"><i class="fa fa-floppy-o"></i> Print</a>
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
			penjualanRequest,
			barangRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let req_DetailPenjualan = function(callback){
			let formData = new FormData();
			console.log(vm.opts);
			formData.append('id_penjualan',vm.opts.data.id_penjualan);
			getRestApiService(formData,penjualanRequest.viewDetail,function(data){
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
		this.handlePrint = function(e){
			$('#print-box').print();
		}
		this.tb_penjualan = [];
		this.tb_detail_penjualan = [];
		this.on('mount',function(){
			req_DetailPenjualan(function(data){
				console.log(data);
				vm.tb_penjualan = data.tb_penjualan[0];
				vm.tb_detail_penjualan = data.tb_detail_penjualan;
				vm.setState(function(){

				})
			})
		})	
		let vm = this;
	</script>
</penjualan-detail-view>