define(function(require){
	this.init = function(value){
		let globalMixin = require('../helpers/riotMixins.js');
		let riot = require('riot');
		require('../tags/pembelian-input.tag');
        require('../tags/pembelian-list.tag');
        riot.mixin(globalMixin)
        var changePage = function(data){
        	console.log('vdfvadvf')
            switch(data.action){
                case 'open-table':
                    riot.mount('#container','table-pembelian',{
                    	data : data,
                    	changePage : changePage
                    })
                break;
                case 'open-input':
                    riot.mount('#container','pembelian',{
                    	data : data,
                    	changePage : changePage
                    })
                break;
            }
		}
        riot.mount('#container','table-pembelian',{
            changePage : changePage
        })
	}
	return this;
})