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
								<select id="field2" class="form-control" data-role="select" data-parsley-errors-container="#errId2">
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
												<th>Harga</th>
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
													<a href="penjualan/penjualan_edit.php?id=<?php echo $r['id']; ?>" data-target="#EditDataPenjualan" data-toggle="modal" data-backdrop="static" class="fa fa-edit"-></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
			<form>
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<div class="row">
							<div class="form-group">
								<label class="control-label control-label-left col-sm-4">Grand Total</label>
								<div class="controls col-sm-8">
									<input id="txtGrandTotal" type="text" class="form-control k-textbox text-right" readonly>
								</div>
							</div>								
						</div>				
					</div>
				</div>
			</form><hr>
			<form>
				<div class="row">
					<div class="col-md-6 text-left">
						<a href="#" class="btn btn-primary" onclick="{back.bind(this)}"><i class="fa fa-floppy-o"></i> Simpan</a>
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
			pembelianRequest,
			barangRequest,
			supplierRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let reqSaveDetail = function(callback){
			var formData = new FormData();
			formData.append('id_pembelian',vm.tb_pembelian.id_pembelian);
			formData.append('kode_brg',vm.inputBarang.kode_brg);
			formData.append('id_kategori',vm.inputBarang.id_kategori);
			formData.append('nama_brg',vm.inputBarang.nama_brg);
			formData.append('satuan',vm.inputBarang.satuan);
			formData.append('stok',vm.inputBarang.stok);
			formData.append('harga',vm.inputBarang.harga);
			formData.append('jumlah',vm.inputBarang.jumlah);
			getRestApiService(formData,pembelianRequest.saveItem,function(data){
				data = JSON.parse(data);
				callback(data);
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
				callback(data);
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
			getRestApiService(JSON.stringify(dd),)
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
		this.inputBarang = new newInputBarang();
		this.translateToDate = function(value){
			return momentjs(value,'yyyy-mm-dd').format('LLL')
		}
		this.handleSaveItem = function(e){
			e.preventUpdate = true;
			reqSaveDetail(function(data){
				vm.tb_detail_pembelian = data.tb_detail_pembelian;
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
		this.handleChange = function(whatKey,e){
			
			switch(whatKey){
				default:
					vm.inputBarang[whatKey] = e.target.value;
					vm.setState(function(){
						console.log(vm.inputBarang);
					})
				break;
			}
		}
		this.tb_supplier = [];
		this.tb_pembelian = [];
		this.tb_detail_pembelian = [];
		this.on('mount',function(){
			$('#form2345').on('submit',function(e){
				e.preventDefault();
			})
			$('[ref=jumlah]').on('keypress',function(e){
				if(e.which == 13) {
					vm.handleSaveItem(e);
				}
			})
			$('[ref=jumlah]').on('change',function(e){
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
								$('[ref=jumlah]').focus();
							})
						})
					},100);
					(pendingSearch)();
			    }
			})
			reqCreateNewOrder(function(data){
				vm.tb_pembelian = data.tb_pembelian[0];
				vm.tb_detail_pembelian = data.tb_detail_pembelian;
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