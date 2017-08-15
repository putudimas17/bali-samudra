<penjualan-input class="container-fluid transaksi">
	<div class="header">
		<h3>Transaksi Penjualan</h3>
	</div>
	<div class="form" >
		<div>
			<form class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">No Penjualan</label>
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
			<div  id="form2345">
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
								<input id="field1" ref="nama_brg" value="{inputBarang.nama_brg}"type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="field1">Harga</label>
							<div class="controls">
								<input id="field1" ref="harga" value="{inputBarang.harga}" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="field1">Jumlah</label>
							<div class="controls">
								<input id="field1" ref="jumlah" value="{inputBarang.jumlah}" type="number" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="field1"></label>
							<div class="controls">
								<button type="submit" onclick="{handleSaveItem.bind(this)}" class="btn btn-primary">Tambah</button>
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
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Sub Total</th>
												<th>Aksi</th>
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
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<div class="row">
							<div class="form-group">
								<label class="control-label control-label-left col-sm-4">Bayar</label>
								<div class="controls col-sm-8">
									<input id="txtBayar" type="text" class="form-control k-textbox text-right">
								</div>
							</div>								
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<div class="row">
							<div class="form-group">
								<label class="control-label control-label-left col-sm-4">Kembali</label>
								<div class="controls col-sm-8">
									<input id="txtKembali" type="text" class="form-control k-textbox text-right" readonly>
								</div>
							</div>								
						</div>				
					</div>
				</div>
			</form><hr>
			<form>
				<div class="row">
					<div class="col-md-6 text-left">
						<a href="#" id="saveTotal" class="btn btn-primary" onclick="{handleFinishOrder.bind(this)}"><i class="fa fa-floppy-o"></i> Simpan</a>
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
		require('../scss/pembelian.scss');	
		let momentjs = require('moment');
		let {
			penjualanRequest,
			barangRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let pendingSearch = null;
		let req_newOrder = function(callback){
			var dd = {}
			getRestApiService(JSON.stringify(dd),penjualanRequest.newOrder,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		let req_FinishOrder = function(callback){
			var formData = new FormData();
			formData.append('id_penjualan',vm.tb_penjualan.id_penjualan);
			formData.append('total',$('[ref=text-total]').val());
			formData.append('bayar',$('#txtBayar').val());
			getRestApiService(formData,penjualanRequest.saveTotal,function(data){
				data = JSON.parse(data);
				switch(data.status){
					case 'rejected':
						alert(data.message);
					break;
					default:
						callback(data);
					break;
				}
			});
		}
		let req_saveDetail = function(callback){
			var formData = new FormData();
			formData.append('id_penjualan',vm.tb_penjualan.id_penjualan);
			formData.append('kode_brg',vm.inputBarang.kode_brg);
			formData.append('id_kategori',vm.inputBarang.id_kategori);
			formData.append('nama_brg',vm.inputBarang.nama_brg);
			formData.append('satuan',vm.inputBarang.satuan);
			formData.append('stok',vm.inputBarang.stok);
			formData.append('harga',vm.inputBarang.harga);
			formData.append('jumlah',vm.inputBarang.jumlah);
			getRestApiService(formData,penjualanRequest.saveItem,function(data){
				console.log('234234',data);
				data = JSON.parse(data);
				switch(data.status){
					case 'rejected':
						alert(data.message);
						return;
					break;
					case 'success': 
						callback(data);
					break;
				}
				
			})
		}
		let req_deleteItem = function(item,callback){
			var formData = new FormData();
			formData.append('id_penjualan',item.id_penjualan);
			formData.append('kode_brg',item.kode_brg);
			getRestApiService(formData,penjualanRequest.deleteItem,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		let req_barang = function(idbarang,callback){
			var formData = new FormData();
			formData.append('kode_brg',idbarang);
			getRestApiService(formData,barangRequest.searchItem,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		
		let newTotal = function(){
			this.inv = '';
			this.subtotal = 0;
		}
		let newInputBarang = function(value){
			this.kode_brg = '';
			this.id_kategori = '';
			this.nama_brg = '';
			this.satuan = '';
			this.stok = '';
			this.harga = '';
			this.jumlah = 1;
			this.init = function(value){
				if(value == null)
					return;
				this.kode_brg = value.kode_brg;
				this.id_kategori = value.id_kategori;
				this.nama_brg = value.nama_brg;
				this.satuan = value.satuan;
				this.stok = value.stok;
				this.harga = value.harga;
			}
			this.init(value);
		}
		this.belumLunas = true;
		this.handleChange = function(whatKey,e){
			switch(whatKey){
				case 'id_supel':
					vm.subtotal[whatKey] = e.target.value;
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
		this.handleSaveItem = function(e){
			e.preventUpdate = true;
			req_saveDetail(function(data){
				vm.tb_detail_penjualan = data.tb_detail_penjualan;
				var kk = 0;
				for(var a=0;a<vm.tb_detail_penjualan.length;a++){
					kk += parseInt(vm.tb_detail_penjualan[a].subtotal);
				}
				vm.total.subtotal = kk;
				$('[ref=text-total]').val(kk);
				vm.setState(function(){
					vm.inputBarang = new newInputBarang();
					$('[ref=kode_brg]').focus();
					vm.setState(function(){
					})
				})
			})
		}
		this.translateToDate = function(value){
			return momentjs(value,'yyyy-mm-dd').format('LLL')
		}
		this.handleFinishOrder = function(e){
			e.preventUpdate = true;
			var ee = $.Event("keypress");
			ee.which = 13; // # Some key code value
			e.keyCode = 13;
			$('#txtBayar').trigger(ee);
			if(vm.belumLunas == true){
				return;
			}else{
				alert('Lunas');
			}
			req_FinishOrder(function(data){
				vm.opts.changePage({
					action : 'open-table'
				})
			})
		}
		this.handleDelete = function(index,e){
			e.preventUpdate = true;
			req_deleteItem(vm.tb_detail_penjualan[index],function(data){
				vm.tb_detail_penjualan = data.tb_detail_penjualan;
				vm.setState(function(){
					vm.inputBarang = new newInputBarang();
					$('[ref=kode_brg]').focus();
					vm.setState(function(){})
				})
			})
		}
		this.back = function(e){
			console.log(vm.opts);
			vm.opts.changePage({
				action : 'open-table'
			})
		}
		this.inputBarang = new newInputBarang();
		this.total = new newTotal();
		this.tb_penjualan = {};
		this.tb_detail_penjualan = [];
		this.on('mount',function(){
			$('[ref=jumlah]').on('keypress',function(e){
				if(e.which == 13) {
					vm.addItem(e);
				}
			})
			$('[ref=jumlah]').on('keydown',function(e){
				vm.handleChange($(this).attr('ref'),e);
			})
			$('#txtBayar').on('keypress',function(e){
				if(e.which == 13) {
					let kembalinya = $('#txtBayar').val() - $('#txtGrandTotal').val();
					if(kembalinya < 0){
						alert('Kurang dari Total!');
						vm.belumLunas = true;
						return;
					}
					vm.belumLunas = false;
					$('#txtKembali').val(kembalinya);
				}
			})
			$('#inp_kode_barang').on('keypress',function(e){
				if(e.which == 13) {
					e.preventUpdate = true;
					var gg = e.target.value;
			        if(pendingSearch != null){
						pendingSearch.cancel();
					}
					pendingSearch = debounce(function(){
						req_barang(gg,function(data){
							console.log(data[0]);
							vm.inputBarang = new newInputBarang(data.tb_barang[0]);
							vm.setState(function(){
								$('[ref=jumlah]').focus();
							})
						})
					},100);
					(pendingSearch)();
			    }
			})
			$('#inp_kode_barang').bind('paste',function(e){
				e.preventUpdate = true;
				var pastedData = e.originalEvent.clipboardData.getData('text');
				var idBarang = pastedData;
				if(pendingSearch != null){
					pendingSearch.cancel();
				}
				pendingSearch = debounce(function(){
					req_barang(idBarang,function(data){
						console.log(data[0]);
						vm.inputBarang = new newInputBarang(data.tb_barang[0]);
						vm.setState(function(){})
					})
				},1000);
				(pendingSearch)();
			})
			req_newOrder(function(data){
				var kk = 0;
				vm.tb_penjualan = data.tb_penjualan[0];
				vm.tb_detail_penjualan = data.tb_detail_penjualan;
				for(var a=0;a<vm.tb_detail_penjualan.length;a++){
					kk += parseInt(vm.tb_detail_penjualan[a].subtotal);
				}
				vm.total.subtotal = kk;
				$('[ref=text-total]').val(kk);
				vm.setState(function(){
				})
			})
		})
		let vm = this;
	</script>
</penjualan-input>