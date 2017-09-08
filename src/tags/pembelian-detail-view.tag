<pembelian-detail-view class="container-fluid transaksi">
	<div class="header">
		<h3>Transaksi Pembelian</h3>
	</div>
	<div class="form" >
		<div>
			<form class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">No Pembelian</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{tb_pembelian.INV}" data-role="text" data-parsley-errors-container="#errId1" readonly>
								<span id="errId1" class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">Tanggal</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{translateToDate(tb_pembelian.tgl)}" data-role="text" data-parsley-errors-container="#errId1" readonly>
								<span id="errId1" class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field2">Supplier</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{tb_pembelian.nama_suplier}" data-role="text" data-parsley-errors-container="#errId1" readonly>
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
												<th>Harga Beli</th>
												<th>Jumlah</th>
												<th>Sub Total</th>
											</tr>
										</thead>
										<tbody>
											<tr each="{item, index in tb_detail_pembelian}">
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
			<div style="display: none">
				<div id="print-box">
					<div class="section">
						<h2 class="">UD ADITYA</h2>
						<h5 class="">
							INVOICE PEMBELIAN
						</h5>
						<div class="s-row">
							<div class="s-col c-6">
								<h5 class="left">SUPPLIER : {tb_pembelian.nama_suplier}</h5>
								<h5 class="left">TGL : {translateToDate(tb_pembelian.tgl)}</h5>
								<h5 class="left">NO Ref : {tb_pembelian.no_referensi}</h5>
							</div>
							<div class="s-col c-6">
								<h5 class="right">INVOICE : {tb_pembelian.INV}</h5>
							</div>
						</div>
					</div>
					<div class="section">
						<table>
							
							<tr>
								<th>KODE</th>
								<th>NAMA</th>
								<th>HARGA</th>
								<th>JUMLAH</th>
								<th>SUBTOTAL</th>
							</tr>
							<tr>
								<td colspan="5">
									<div class="divider"></div>
								</td>
							</tr>
							<tr each="{item, index in tb_detail_pembelian}">
								<td>{item.kode_brg}</td>
								<td>{item.nama_brg}</td>
								<td>{item.harga}</td>
								<td>{item.jumlah}</td>
								<td>{toMoneyCurrency(item.total)}</td>
							</tr>
							
							<tr>
								<td colspan="5">
									<div class="divider"></div>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									TOTAL
								</td>
								<td>{toMoneyCurrency(tb_pembelian.total)}</td>
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
									<input id="txtGrandTotal" ref="text-total" type="text" value="{tb_pembelian.total}" class="form-control k-textbox text-right" readonly>
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
		require('../js/jqueryPrint.js');
		let momentjs = require('moment');
		let {
			pembelianRequest,
			barangRequest,
			supplierRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let req_DetailPembelian = function(callback){
			let formData = new FormData();
			console.log(vm.opts);
			formData.append('id_pembelian',vm.opts.data.id_pembelian);
			getRestApiService(formData,pembelianRequest.viewDetail,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		this.translateToDate = function(value){
			return momentjs(value,'yyyy-mm-dd').format('YYYY-MM-DD')
		}
		this.back = function(e){
			console.log(vm.opts);
			vm.opts.changePage({
				action : 'open-table'
			})
		}
		this.handlePrint = function(e){
			vm.printSupplier = $("[ref=id_supel] option:selected").text();
			console.log($("[ref=id_supel] option:selected").text());
			vm.setState(function(){})
			$('#print-box').print({
				globalStyles: true,
	        	mediaPrint: false,
	        	stylesheet: 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
	        	noPrintSelector: ".no-print",
	        	iframe: false,
	        	append: null,
	        	prepend: null,
	        	manuallyCopyFormValues: true,
	        	deferred: $.Deferred(),
	        	timeout: 750,
	        	title: null,
	        	doctype: '<!doctype html>'
			});
		}
		this.tb_pembelian = [];
		this.tb_detail_pembelian = [];
		this.on('mount',function(){
			req_DetailPembelian(function(data){
				console.log(data);
				vm.tb_pembelian = data.tb_pembelian[0];
				vm.tb_detail_pembelian = data.tb_detail_pembelian;
				vm.setState(function(){

				})
			})
		})	
		let vm = this;
	</script>
</pembelian-detail-view>