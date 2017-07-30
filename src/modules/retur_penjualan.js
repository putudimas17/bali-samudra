define(function(require){
	this.init = function(value){
		let globalMixin = require('../helpers/riotMixins.js');
		let riot = require('riot');
		require('../tags/returpenjualan-list.tag');
        require('../tags/returpenjualan-input.tag');
        require('../tags/returpenjualan-view.tag');
        riot.mixin(globalMixin)
        var changePage = function(data){
            switch(data.action){
                case 'open-table':
                    riot.mount('#container','table-retur-penjualan',{
                    	data : data,
                    	changePage : changePage
                    })
                break;
                case 'open-input':
                    riot.mount('#container','retur-penjualan',{
                    	data : data,
                    	changePage : changePage
                    })
                break;
                case 'open-view':
                    riot.mount('#container','retur-penjualan-view',{
                        data : data,
                        changePage : changePage
                    })
                break;
            }
		}
        riot.mount('#container','table-retur-penjualan',{
            changePage : changePage
        })
	}
	return this;
})