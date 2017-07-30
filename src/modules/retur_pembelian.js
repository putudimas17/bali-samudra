define(function(require){
	this.init = function(value){
		let globalMixin = require('../helpers/riotMixins.js');
		let riot = require('riot');
		require('../tags/returpembelian-list.tag');
        require('../tags/returpembelian-input.tag');
        require('../tags/returpembelian-view.tag');
        riot.mixin(globalMixin)
        var changePage = function(data){
            switch(data.action){
                case 'open-table':
                    riot.mount('#container','table-retur-pembelian',{
                    	data : data,
                    	changePage : changePage
                    })
                break;
                case 'open-input':
                    riot.mount('#container','retur-pembelian',{
                    	data : data,
                    	changePage : changePage
                    })
                break;
                case 'open-view':
                    riot.mount('#container','retur-pembelian-view',{
                        data : data,
                        changePage : changePage
                    })
                break;
            }
		}
        riot.mount('#container','table-retur-pembelian',{
            changePage : changePage
        })
	}
	return this;
})