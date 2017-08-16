<pembelian class="container-fluid transaksi">
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
								<select id="field2" class="form-control" ref='id_supel' data-role="select" data-parsley-errors-container="#errId2">
									<option value=""></option>
									<option value="{item.id}" each="{item,index in tb_supplier}">{item.Nama}</option>
								</select>
								<span id="errId2" class="error"></span>
							</div>
						</div>						
					</div>
				</div>
			</form><br>
			<form  id="form2345">
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="field1">Kode Barang</label>
							<div class="controls">
								<input id="inp_kode_barang" ref="kode_brg" value="{inputBarang.kode_brg}" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span>
							</div>
						</div>
					</div>				
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="field1">Nama Barang</label>
							<div class="controls">
								<input id="nama_brg" ref="nama_brg" value="{inputBarang.nama_brg}"type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="field1">Harga Beli</label>
							<div class="controls">
								<input id="harga" ref="harga" value="{inputBarang.harga}" type="number" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="field1">Jumlah</label>
							<div class="controls">
								<input id="jumlah" ref="jumlah" value="{inputBarang.jumlah}" type="number" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="field1"></label>
							<div class="controls">
								<button type="submit" class="btn btn-primary">Tambah</button>
							</div>
						</div>								
					</div>
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
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<tr each="{item, index in tb_detail_pembelian}">
												<td>
													{index+1}
												</td>
												<td>
													{item.id_barang}
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
												<td align="center">
													<a href="#" onclick="{handleDelete.bind(this,index)}" class="hapus_modal fa fa-trash-o"></a>
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
						<h2 class="left">PT GANTI SENDIRI</h2>
						<h5 class="left">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
						</h5>
						<div class="row">
							<div class="col-md-6">
								<h5 class="left">SUPPLIER : {printSupplier}</h5>
								<h5 class="left">TGL : {translateToDate(tb_pembelian.tgl)}</h5>
							</div>
							<div class="col-md-6">
								<h5 class="left">INVOICE : {tb_pembelian.INV}</h5>
							</div>
						</div>
					</div>
					<div class="section">
						<table>
							
							<tr>
								<th>QTY</th>
								<th>IN</th>
								<th></th>
							</tr>
							<tr>
								<td colspan="3">
									<div class="divider"></div>
								</td>
							</tr>
							<tr each="{item, index in tb_detail_pembelian}">
								<td>{item.jumlah}</td>
								<td>{item.nama_brg}</td>
								<td>{toMoneyCurrency(item.total)}</td>
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
								<td colspan="3">
									<div class="divider"></div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									TOTAL
								</td>
								<td>{toMoneyCurrency(printTotal)}</td>
							</tr>
						</table>
					</div>
					<div class="section">
						<h4>Terima Kasih</h4>
						<h5>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
									<input id="txtGrandTotal" ref="text-total" type="text" class="form-control k-textbox text-right" readonly>
								</div>
							</div>								
						</div>				
					</div>
				</div>
			</form><hr>
			<form>
				<div class="row">
					<div class="col-md-6 text-left">
						<a href="#" class="btn btn-primary" onclick="{handleSaveTotal.bind(this)}"><i class="fa fa-floppy-o"></i> Simpan</a>
						<a href="#" id="print" class="btn btn-primary" onclick="{handlePrint.bind(this)}"><i class="fa fa-floppy-o"></i> Print</a>
						<a href="#" class="btn btn-success" onclick="{back.bind(this)}"><i class="fa fa-reply"></i> Kembali</a>
					</div>	
					<div class="col-md-6 text-right">
						<a href="#" class="btn btn-default" onclick="{back.bind(this)}"><i class="fa fa-trash-o"></i> Hapus</a>
					</div>					
				</div>			
			</form>			
		</div>
	</div>
	<script>
		// u can require at this 
		let debounce = require('lodash/debounce.js');
		require('../js/jqueryPrint.js');
		require('../scss/pembelian.scss');	
		let momentjs = require('moment');
		let {
			pembelianRequest,
			barangRequest,
			supplierRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let reqSaveTotal = function(callback){
			var formData = new FormData();
			if(vm.total.id_supel == 0){
				alert('Supplier belum di pilih');
				return;
			}
			formData.append('id_pembelian',vm.tb_pembelian.id_pembelian);
			formData.append('total',$('[ref=text-total]').val());
			formData.append('id_supel',vm.total.id_supel);
			getRestApiService(formData,pembelianRequest.saveTotal,function(data){
				data = JSON.parse(data);
				callback(data);
			});
		}
		let reqSaveDetail = function(callback){
			if($('[ref=jumlah]').val() <= 0){
				alert('Tidak boleh di bawah atau 0');
				return;
			}
			var formData = new FormData();
			formData.append('id_pembelian',vm.tb_pembelian.id_pembelian);
			formData.append('kode_brg',vm.inputBarang.kode_brg);
			formData.append('id_kategori',vm.inputBarang.id_kategori);
			formData.append('nama_brg',vm.inputBarang.nama_brg);
			formData.append('satuan',vm.inputBarang.satuan);
			formData.append('stok',vm.inputBarang.stok);
			formData.append('harga',$('[ref=harga]').val());
			formData.append('jumlah',$('[ref=jumlah]').val());
			getRestApiService(formData,pembelianRequest.saveItem,function(data){
				data = JSON.parse(data);
				switch(data.status){
					case 'success':
						callback(data);
					break;
					case 'rejected':
						alert(data.message);
					break;
				}
			})
		}
		let reqDelete = function(item,callback){
			var formData = new FormData();
			formData.append('id_pembelian',item.id_pembelian);
			formData.append('kode_brg',item.id_barang);
			getRestApiService(formData,pembelianRequest.deleteItem,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		let reqFetchSupplier = function(callback){
			var dd = {};
			getRestApiService(JSON.stringify(dd),supplierRequest.fetch,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		let reqBarang = function(idbarang,callback){
			var formData = new FormData();
			formData.append('kode_brg',idbarang);
			getRestApiService(formData,barangRequest.searchItem,function(data){
				data = JSON.parse(data);
				switch(data.status){
					case 'success':
						callback(data);
					break;
					case 'rejected':
						alert(data.message);
					break;
				}
			})
		}
		let pendingSearch = null;
		let reqCreateNewOrder = function(callback){
			var dd = {}
			getRestApiService(JSON.stringify(dd),pembelianRequest.newOrder,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}	
		let searchItem = function(callback){
			var dd = {};
			// getRestApiService(JSON.stringify(dd),)
		}
		let newTotal = function(){
			this.id_supel = 0;
			this.total = 0;
			this.inv = '';
		}
		let newInputBarang = function(value){
			this.kode_brg = '';
			this.id_kategori = '';
			this.nama_brg = '';
			this.satuan = '';
			this.stok = '';
			this.harga = '';
			this.harga_beli = '';
			this.jumlah = 1;
			this.init = function(value){
				if(value == null)
					return;
				this.kode_brg = value.kode_brg;
				this.id_kategori = value.id_kategori;
				this.nama_brg = value.nama_brg;
				this.satuan = value.satuan;
				this.stok = value.stok;
				this.harga = value.harga_beli;
			}
			this.init(value);
		}
		this.handleSaveTotal = function(e){
			e.preventUpdate = true;
			reqSaveTotal(function(data){
				vm.opts.changePage({
					action : 'open-table'
				})
			})
		}
		this.printSupplier = '';
		this.printCash = 0;
		this.printTotal = 0;
		this.printKembali = 0;
		this.handleDelete = function(index,e){
			e.preventUpdate = true;
			reqDelete(vm.tb_detail_pembelian[index],function(data){
				vm.tb_detail_pembelian = data.tb_detail_pembelian;
				vm.setState(function(){
					vm.inputBarang = new newInputBarang();
					$('[ref=kode_brg]').focus();
					vm.setState(function(){})
				})
			})
		}
		this.total = new newTotal();
		this.inputBarang = new newInputBarang();
		this.translateToDate = function(value){
			return momentjs(value,'yyyy-mm-dd').format('LLL')
		}
		this.handleSaveItem = function(e){
			e.preventUpdate = true;
			reqSaveDetail(function(data){
				vm.tb_detail_pembelian = data.tb_detail_pembelian;
				var kk = 0;
				for(var a=0;a<vm.tb_detail_pembelian.length;a++){
					kk += parseInt(vm.tb_detail_pembelian[a].total);
				}
				vm.total.total = kk;
				$('[ref=text-total]').val(kk);
				vm.printTotal = kk;
				vm.setState(function(){
					vm.inputBarang = new newInputBarang();
					$('[ref=kode_brg]').focus();
					vm.setState(function(){
					})
				})
			})
		}
		this.back = function(e){
			console.log(vm.opts);
			vm.opts.changePage({
				action : 'open-table'
			})
		}
		this.handleChange = function(whatKey,e){
			switch(whatKey){
				case 'id_supel':
					vm.total[whatKey] = e.target.value;
					vm.setState(function(){})
				break;
				case 'jumlah':
					vm.inputBarang[whatKey] = e.target.value;
					vm.setState(function(){
						console.log(vm.inputBarang);
					})
					
				break;
				default:
					alert(e.target.value);
					vm.inputBarang[whatKey] = e.target.value;
					vm.setState(function(){
						console.log(vm.inputBarang);
					})
				break;
			}
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
		this.tb_supplier = [];
		this.tb_pembelian = [];
		this.tb_detail_pembelian = [];
		this.on('mount',function(){
			$('[ref=id_supel]').on('change',function(e){
				vm.handleChange($(this).attr('ref'),e);
				vm.printSupplier = $("[ref=id_supel] option:selected").text();
				vm.setState(function(){})
			})
			$('#form2345').on('submit',function(e){
				e.preventDefault();
			})
			$('[ref=jumlah]').on('keypress',function(e){
				if(e.which == 13) {
					vm.handleSaveItem(e);
				}
			})

			$('[type=submit]').on('click',function(e){
				e.preventDefault();
				if($('[ref=nama_brg]').val() != ''){
					vm.handleSaveItem(e);
				}
				
			})
			$('[ref=jumlah]').on('change keydown',function(e){
				vm.handleChange($(this).attr('ref'),e);
			})
			vm.inputBarang = new newInputBarang();
			$('#inp_kode_barang').bind('paste',function(e){
				var pastedData = e.originalEvent.clipboardData.getData('text');
				var idBarang = pastedData;
				if(pendingSearch != null){
					pendingSearch.cancel();
				}
				pendingSearch = debounce(function(){
					reqBarang(idBarang,function(data){
						console.log(data[0]);
						vm.inputBarang = new newInputBarang(data.tb_barang[0]);
						vm.setState(function(){})
					})
				},1000);
				(pendingSearch)();
			})
			$('#inp_kode_barang').on('change keypress',function(e){
				if(e.which == 13) {
					var gg = e.target.value;
			        if(pendingSearch != null){
						pendingSearch.cancel();
					}
					pendingSearch = debounce(function(){
						reqBarang(gg,function(data){
							console.log(data[0]);
							vm.inputBarang = new newInputBarang(data.tb_barang[0]);
							vm.setState(function(){
								$('[ref=harga]').focus();
							})
						})
					},100);
					(pendingSearch)();
			    }
			})
			reqCreateNewOrder(function(data){
				vm.tb_pembelian = data.tb_pembelian[0];
				vm.tb_detail_pembelian = data.tb_detail_pembelian;
				var kk = 0;
				for(var a=0;a<vm.tb_detail_pembelian.length;a++){
					kk += parseInt(vm.tb_detail_pembelian[a].total);
				}
				vm.total.total = kk;
				$('[ref=text-total]').val(kk);
				vm.printTotal = kk;
				vm.setState(function(){
				})
			});
			reqFetchSupplier(function(data){
				vm.tb_supplier = data.tb_supel;
				vm.setState(function(){})
			})
		})	
		let vm = this;
	</script>
</pembelian>