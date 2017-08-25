<retur-penjualan class="container-fluid transaksi">
	<div class="header">
		<h3>Retur Penjualan</h3>
	</div>
	<div class="form" >
		<div>
			<form class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">No Retur Penjualan</label>
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
							<label class="control-label control-label-left col-sm-3" for="field2">NO Penjualan</label>
							<div class="controls col-sm-9">
								<select class="form-control" ref='id_penjualan'>
									<option value=""></option>
									<option value="{item.id}" each="{item,index in tb_penjualan}">{item.Nama}</option>
								</select>
								<span id="errId2" class="error"></span>
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
								<select class="form-control" ref='kode_brg'>
									<option value="---" selected="selected">---</option>
									<option value="{item.kode_brg}" each="{item,index in tb_dropdown_barang}">{item.nama_brg}</option>
								</select>
							</div>
						</div>
					</div>				
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="field1">Nama Barang</label>
							<div class="controls">
								<input id="field1" ref="nama_brg" value="{inputBarang.nama_brg}"type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1" readonly="readonly"><span id="errId1" class="error"></span>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="field1">Harga</label>
							<div class="controls">
								<input id="field1" ref="harga" value="{inputBarang.harga}" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId1" readonly="readonly"><span id="errId1" class="error"></span>
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
								<button type="submit" class="btn btn-primary" onclick="{handleSaveItem.bind(this)}">Tambah</button>
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
			</form><hr>
			<form>
				<div class="row">
					<div class="col-md-6 text-left">
						<a href="#" class="btn btn-primary" onclick="{handleSaveTotal.bind(this)}"><i class="fa fa-floppy-o"></i> Simpan</a>
						<a href="#" class="btn btn-success" onclick="{back.bind(this)}"><i class="fa fa-reply"></i> Kembali</a>
					</div>	
					<div class="col-md-6 text-right">
						<a href="#" class="btn btn-default" onclick="{handleDeleteTransaksi.bind(this)}"><i class="fa fa-trash-o"></i> Hapus</a>
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
		require('select2/dist/css/select2.min.css');
		require('select2/dist/js/select2.full.min.js');
		let {
			staticVariable,
		} = require('../helpers/configService.js');
		let {
			returPenjualanRequest,
			barangRequest,
			supplierRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let reqSaveTotal = function(callback){
			var formData = new FormData();
			if(vm.tb_detail_retur_penjualan.length == 0){
				alert('Transaksi belum di laksanakan');
				return;
			}
			formData.append('id',vm.tb_retur_penjualan.id);
			formData.append('total',$('#txtGrandTotal').val());
			getRestApiService(formData,returPenjualanRequest.saveTotal,function(data){
				data = JSON.parse(data);
				callback(data);
			});
		}
		let reqCheckStok = function(callback){
			var formData = new FormData();
			formData.append('id_retur_penjualan',vm.tb_retur_penjualan.id);
			formData.append('id_penjualan',$('[ref=id_penjualan]').val());
			formData.append('kode_brg',vm.inputBarang.kode_brg);
			formData.append('jumlah',vm.inputBarang.jumlah);
			formData.append('inv_penjualan',$('[ref=id_penjualan] option:selected').text());
			getRestApiService(formData,returPenjualanRequest.checkStok,function(data){
				data = JSON.parse(data);
				switch(data.status){
					case 'success':
						callback()
					break;
					case 'rejected':
					case 'empty':
						alert(data.message);
					break;
				}
			})
		}
		let reqSaveDetail = function(callback){
			var formData = new FormData();
			formData.append('id_retur',vm.tb_retur_penjualan.id);
			formData.append('kode_brg',vm.inputBarang.kode_brg);
			formData.append('jumlah',vm.inputBarang.jumlah);
			formData.append('harga',vm.inputBarang.harga);
			formData.append('total',vm.inputBarang.harga * vm.inputBarang.jumlah);
			formData.append('id_penjualan',$('[ref=id_penjualan]').val());
			getRestApiService(formData,returPenjualanRequest.saveItem,function(data){
				data = JSON.parse(data);
				console.log(data);
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
		let reqresetKetikaGantiPenjual = function(id,callback){
			var formData = new FormData();
			formData.append('id',id);
			getRestApiService(formData,returPenjualanRequest.resetKetikaGantiPenjual,function(data){
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
		let requpdateNoPenjualan = function(id,no_penjualan,callback){
			var formData = new FormData();
			formData.append('id',id)
			formData.append('no_penjualan',no_penjualan);
			// formData.append('id_supel',id_supel);
			getRestApiService(formData,returPenjualanRequest.updateNoPenjualan,function(data){
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
		let reqfetchBarangDariPenjualan = function(id_penjualan,callback){
			var formData = new FormData();
			formData.append('id_penjualan',$('[ref=id_penjualan]').val());
			getRestApiService(formData,returPenjualanRequest.fetchBarangDariPenjualan,function(data){
				data = JSON.parse(data);
				switch(data.status){
					case 'success':
						callback(data.tb_barang);
					break;
					case 'rejected':
					case 'empty':
						alert(data.tb_barang);
					break;
				}
			})
		}
		let reqDelete = function(item,callback){
			var formData = new FormData();
			formData.append('id_retur',item.id_retur);
			formData.append('id',item.id);
			formData.append('kode_brg',item.kode_brg);
			getRestApiService(formData,returPenjualanRequest.deleteItem,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		let reqFetchIdPembelian = function(callback){
			var dd = {};
			getRestApiService(JSON.stringify(dd),pembelianRequest.fetch,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		let reqBarang = function(idbarang,callback){
			var formData = new FormData();
			formData.append('kode_brg',idbarang);
			formData.append('id_penjualan',$('[ref=id_penjualan]').val());
			getRestApiService(formData,returPenjualanRequest.searchBarang,function(data){
				data = JSON.parse(data);
				switch(data.status){
					case 'success':
						callback(data.tb_barang);
					break;
					case 'rejected':
						alert(data.message);
					break;
				}
			})
		}
		let req_deleteTransaksi = function(id,callback){
			var formData = new FormData();
			formData.append('id_retur',id);
			getRestApiService(formData,returPenjualanRequest.deleteTransaksi,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}
		let pendingSearch = null;
		let reqCreateNewOrder = function(callback){
			var dd = {}
			getRestApiService(JSON.stringify(dd),returPenjualanRequest.newOrder,function(data){
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
		this.handleDeleteTransaksi = function(e){
			e.preventUpdate = true;
			req_deleteTransaksi(vm.tb_retur_penjualan.id,function(data){
				vm.back(e);
			})
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
		this.handleSaveTotal = function(e){
			e.preventUpdate = true;
			reqSaveTotal(function(data){
				vm.opts.changePage({
					action : 'open-table'
				})
			})
		}
		this.handleDelete = function(index,e){
			e.preventUpdate = true;
			reqDelete(vm.tb_detail_retur_penjualan[index],function(data){
				vm.tb_detail_retur_penjualan = data.tb_detail_retur_penjualan;
				var kk = 0;
				for(var a=0;a<vm.tb_detail_retur_penjualan.length;a++){
					kk += parseInt(vm.tb_detail_retur_penjualan[a].total);
				}
				$('[ref=text-total]').val(kk);
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
			reqCheckStok(function(data){
				reqSaveDetail(function(data){
					vm.tb_detail_retur_penjualan = data.tb_detail_retur_penjualan;
					var kk = 0;
					for(var a=0;a<vm.tb_detail_retur_penjualan.length;a++){
						kk += parseInt(vm.tb_detail_retur_penjualan[a].total);
					}
					vm.total.total = kk;
					$('[ref=text-total]').val(kk);
					vm.setState(function(){
						vm.inputBarang = new newInputBarang();
						$('[ref=kode_brg]').focus();
						vm.setState(function(){
						})
					})
				})
				$('[ref=kode_brg]').val('---');
				$('[ref=kode_brg]').focus();
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
		this.tb_dropdown_penjualan = [];
		this.tb_dropdown_barang = [];
		this.tb_penjualan = [];
		this.tb_retur_penjualan = [];
		this.tb_detail_retur_penjualan = [];
		this.on('mount',function(){
			reqCreateNewOrder(function(data){
				vm.tb_retur_penjualan = data.tb_retur_penjualan[0];
				vm.tb_detail_retur_penjualan = data.tb_detail_retur_penjualan;
				var kk = 0;
				for(var a=0;a<vm.tb_detail_retur_penjualan.length;a++){
					kk += parseInt(vm.tb_detail_retur_penjualan[a].total);
				}
				vm.total.total = kk;
				$('[ref=text-total]').val(kk);
				vm.setState(function(){
				})
			});
			/*reqFetchIdPembelian(function(data){
				vm.tb_penjualan = data.tb_supel;
				vm.setState(function(){})
			})*/
			$('#form2345').on('submit',function(e){
				e.preventDefault();
			})
			$('[ref=jumlah]').on('keypress',function(e){
				if(e.which == 13) {
					vm.handleSaveItem(e);
				}
			})
			$('[ref=jumlah]').on('change keydown',function(e){
				vm.handleChange($(this).attr('ref'),e);
			})
			$('[ref=kode_brg]').on('change',function(e){
				reqBarang(e.target.value,function(data){
					vm.inputBarang = data[0];
					vm.setState(function(){})
				})
			})
			$('[ref=id_penjualan').on('change',function(e){
				// let _id_supel = '';
				let _no_penjualan = '';
				for(var qw = 0;qw < vm.tb_dropdown_penjualan.length;qw++){
					if(vm.tb_dropdown_penjualan[qw].id == e.target.value){
						// _id_supel = vm.tb_dropdown_penjualan[qw].id_supel;
						_no_penjualan = vm.tb_dropdown_penjualan[qw].id;
					}
				}
				reqresetKetikaGantiPenjual(vm.tb_retur_penjualan.id,function(data){
					requpdateNoPenjualan(vm.tb_retur_penjualan.id,
						_no_penjualan,
						function(data){
						// console.log(data);
						reqfetchBarangDariPenjualan(e.target.value,function(data){
							vm.tb_dropdown_barang = data;
							vm.setState(function(){
								$('[ref=kode_brg]').val('---');
								$('[ref=kode_brg]').focus();
							});
						})
					})
				})
				
			})
			$('[ref=id_penjualan]').select2({
                ajax: {
                    url: staticVariable.url_restapi+'/retur-penjualan.php?action=search-inv-penjualan',
                    dataType: 'json',
                    delay: 250,
                    type:'GET',
                    data: function (params) {
                        console.log(params);
                        return {
                            like: params.term
                        };
                    },
                    processResults: function (data, params) {
                    	console.log(data);
                    	vm.tb_dropdown_penjualan = [];
                        for(var a=0;a<data.message.length;a++){
                            vm.tb_dropdown_penjualan.push({
                                id : data.message[a].id_penjualan,
                                name: data.message[a].INV,
                                id_supel : data.message[a].id_supel,

                            })
                        }
                        // console.log(data.results[0].formatted_address);
                        //return;
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: vm.tb_dropdown_penjualan,//data.items,
                                /*pagination: {
                                  more: (params.page * 30) < data.total_count
                                }*/
                        };
                        
                    },
                    cache: true
                },
                data:[],
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page  
            });
		})	
		let formatRepo = function (repo) {
            var markup = '' 
            if(repo.name)
                markup += repo.name;
            return markup;
        }
        let formatRepoSelection = function  (repo) {
            return repo.name;//|| repo.text;
        }
		let vm = this;
	</script>
</retur-penjualan>