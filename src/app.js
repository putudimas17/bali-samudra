import riot from 'riot';
import 'require-ensure';
import 'jquery';
import Nanobar from 'nanobar/nanobar.js';
import globalMixin from './helpers/riotMixins.js';
riot.mixin(globalMixin);
$(document).ready(function () {
    var uu = new Nanobar({
        classname: 'my-class',
        id: 'my-id',
        target: document.getElementById('myDivId')
    });
    window.nanobar = uu;
});
window.runningPage = function (route,data) {
    switch (route) {
        case 'penjualan':
            require.ensure([], function () {
                let pp = require('./modules/penjualan.js');    
                pp.init(data);        
            });
            break;
        case 'pembelian':
            require.ensure([], function () {
                let pp = require('./modules/pembelian.js');    
                pp.init(data);            
            })
            break;
        case 'retur-pembelian':
            require.ensure([], function(){
                let pp = require('./modules/retur_pembelian.js');    
                pp.init(data);  
            })
            break;
        case 'retur-penjualan':
            require.ensure([], function(){
                let pp = require('./modules/retur_penjualan.js');    
                pp.init(data);  
            })
            break;
    }
}

