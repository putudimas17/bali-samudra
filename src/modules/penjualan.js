define(function(require){
	this.init = function(value){
		let globalMixin = require('../helpers/riotMixins.js');
		let riot = require('riot');
		require('../tags/penjualan-input.tag');
        require('../tags/penjualan-list.tag');
        require('../tags/penjualan-detail-view.tag');
        riot.mixin(globalMixin)
        var changePage = function(data){
        	console.log('vdfvadvf')
            switch(data.action){
                case 'open-table':
                    riot.mount('#container','penjualan-list',{
                    	data : data,
                    	changePage : changePage
                    })
                break;
                case 'open-input':
                    riot.mount('#container','penjualan-input',{
                    	data : data,
                    	changePage : changePage
                    })
                break;
                case 'open-view':
                    console.log('23svdavfdv',data);
                    riot.mount('#container','penjualan-detail-view',{
                        data : data,
                        changePage : changePage
                    })
                break;
            }
		}
        riot.mount('#container','penjualan-list',{
            changePage : changePage
        })
	}
	return this;
})