<retur-pembelian class="container-fluid transaksi">
	<div class="header">
		<h3>Retur Pembelian</h3>
	</div>
	<div class="form" >
		<div>
			<form class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">No Retur Pembelian</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{tb_retur_pembelian.INV}" data-role="text" data-parsley-errors-container="#errId1" readonly>
								<span id="errId1" class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field1">Tanggal</label>
							<div class="controls col-sm-9">
								<input id="field1" type="text" class="form-control k-textbox" value="{translateToDate(tb_retur_pembelian.tgl)}" data-role="text" data-parsley-errors-container="#errId1" readonly>
								<span id="errId1" class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label control-label-left col-sm-3" for="field2">NO Pembelian</label>
							<div class="controls col-sm-9">
								<select class="form-control" ref='id_pembelian'>
									<option value=""></option>
									<option value="{item.id}" each="{item,index in tb_pembelian}">{item.Nama}</option>
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
											<tr each="{item, index in tb_detail_retur_pembelian}">
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
			returPembelianRequest,
			barangRequest,
			pembelianRequest,
			supplierRequest,
			getRestApiService
		} = require('../helpers/httpServices.js');
		let reqSaveTotal = function(callback){
			var formData = new FormData();
			if(vm.tb_detail_retur_pembelian.length == 0){
				alert('Transaksi belum di laksanakan');
				return;
			}
			formData.append('id',vm.tb_retur_pembelian.id);
			formData.append('total',$('#txtGrandTotal').val());
			getRestApiService(formData,returPembelianRequest.saveTotal,function(data){
				data = JSON.parse(data);
				callback(data);
			});
		}

		let reqResetKetikaGantiPembeli = function(id,callback){
			var formData = new FormData();
			formData.append('id',id);
			getRestApiService(formData,returPembelianRequest.resetKetikaGantiPembeli,function(data){
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
		let reqUpdateNoPembelian = function(id,id_pembelian,id_supel,callback){
			var formData = new FormData();
			formData.append('id',id)
			formData.append('no_pembelian',id_pembelian);
			formData.append('id_supel',id_supel);
			getRestApiService(formData,returPembelianRequest.updateNoPembelian,function(data){
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
		let reqFetchBarangDariPembelian = function(id_pembelian,callback){
			var formData = new FormData();
			formData.append('id_pembelian',$('[ref=id_pembelian]').val());
			getRestApiService(formData,returPembelianRequest.fetchBarangDariPembelian,function(data){
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
		let reqCheckStok = function(callback){
			var formData = new FormData();
			formData.append('id_retur_pembelian',vm.tb_retur_pembelian.id);
			formData.append('id_pembelian',$('[ref=id_pembelian]').val());
			formData.append('kode_brg',vm.inputBarang.kode_brg);
			formData.append('jumlah',vm.inputBarang.jumlah);
			formData.append('inv_pembelian',$('[ref=id_pembelian] option:selected').text());
			getRestApiService(formData,returPembelianRequest.checkStok,function(data){
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
			formData.append('id_retur',vm.tb_retur_pembelian.id);
			formData.append('kode_brg',vm.inputBarang.kode_brg);
			formData.append('jumlah',vm.inputBarang.jumlah);
			formData.append('harga',vm.inputBarang.harga);
			formData.append('total',vm.inputBarang.harga * vm.inputBarang.jumlah);
			formData.append('id_pembelian',$('[ref=id_pembelian]').val());
			getRestApiService(formData,returPembelianRequest.saveItem,function(data){
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
		let reqDelete = function(item,callback){
			var formData = new FormData();
			formData.append('id_retur',item.id_retur);
			formData.append('id',item.id);
			formData.append('kode_brg',item.kode_brg);
			getRestApiService(formData,returPembelianRequest.deleteItem,function(data){
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
			formData.append('id_pembelian',$('[ref=id_pembelian]').val());
			getRestApiService(formData,returPembelianRequest.searchBarang,function(data){
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
		let pendingSearch = null;
		let reqCreateNewOrder = function(callback){
			var dd = {}
			getRestApiService(JSON.stringify(dd),returPembelianRequest.newOrder,function(data){
				data = JSON.parse(data);
				callback(data);
			})
		}	
		let req_deleteTransaksi = function(id,callback){
			var formData = new FormData();
			formData.append('id_retur',id);
			getRestApiService(formData,returPembelianRequest.deleteTransaksi,function(data){
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
		this.handleDeleteTransaksi = function(e){
			e.preventUpdate = true;
			req_deleteTransaksi(vm.tb_retur_pembelian.id,function(data){
				vm.back(e);
			})
		}
		this.handleDelete = function(index,e){
			e.preventUpdate = true;
			reqDelete(vm.tb_detail_retur_pembelian[index],function(data){
				vm.tb_detail_retur_pembelian = data.tb_detail_retur_pembelian;
				var kk = 0;
				for(var a=0;a<vm.tb_detail_retur_pembelian.length;a++){
					kk += parseInt(vm.tb_detail_retur_pembelian[a].total);
				}
				vm.total.total = kk;
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
			// return momentjs(value,'yyyy-mm-dd').format('LLL')
			
			return momentjs(value,'YYYY-MM-DD H:m:s').format('MMMM Do YYYY, h:mm:ss a')
		}
		this.handleSaveItem = function(e){
			e.preventUpdate = true;
			reqCheckStok(function(data){
				reqSaveDetail(function(data){
					vm.tb_detail_retur_pembelian = data.tb_detail_retur_pembelian;
					var kk = 0;
					for(var a=0;a<vm.tb_detail_retur_pembelian.length;a++){
						kk += parseInt(vm.tb_detail_retur_pembelian[a].total);
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
		this.tb_dropdown_pembelian = [];
		this.tb_dropdown_barang = [];
		this.tb_pembelian = [];
		this.tb_retur_pembelian = [];
		this.tb_detail_retur_pembelian = [];
		this.on('mount',function(){
			reqCreateNewOrder(function(data){
				vm.tb_retur_pembelian = data.tb_retur_pembelian[0];
				vm.tb_detail_retur_pembelian = data.tb_detail_retur_pembelian;
				var kk = 0;
				for(var a=0;a<vm.tb_detail_retur_pembelian.length;a++){
					kk += parseInt(vm.tb_detail_retur_pembelian[a].total);
				}
				vm.total.total = kk;
				$('[ref=text-total]').val(kk);
				vm.setState(function(){
				})
			});
			/*reqFetchIdPembelian(function(data){
				vm.tb_pembelian = data.tb_supel;
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
			$('[ref=id_pembelian').on('change',function(e){
				let _id_supel = '';
				let _no_pembelian = '';
				for(var qw = 0;qw < vm.tb_dropdown_pembelian.length;qw++){
					if(vm.tb_dropdown_pembelian[qw].id == e.target.value){
						_id_supel = vm.tb_dropdown_pembelian[qw].id_supel;
						_no_pembelian = vm.tb_dropdown_pembelian[qw].id;
					}
				}
				reqResetKetikaGantiPembeli(vm.tb_retur_pembelian.id,function(data){
					reqUpdateNoPembelian(vm.tb_retur_pembelian.id,
						_no_pembelian,
						_id_supel,function(data){
						// console.log(data);
						reqFetchBarangDariPembelian(e.target.value,function(data){
							vm.tb_dropdown_barang = data;
							vm.setState(function(){
								$('[ref=kode_brg]').val('---');
								$('[ref=kode_brg]').focus();
							});
						})
					})
				})
				
			})
			$('[ref=id_pembelian]').select2({
                ajax: {
                    url: staticVariable.url_restapi+'/retur-pembelian.php?action=search-inv-pembelian',
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
                    	vm.tb_dropdown_pembelian = [];
                        for(var a=0;a<data.message.length;a++){
                            vm.tb_dropdown_pembelian.push({
                                id : data.message[a].id_pembelian,
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
                            results: vm.tb_dropdown_pembelian,//data.items,
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
</retur-pembelian>