// ini untuk akses api native android atau IOS
import { staticVariable } from './configService.js';

export const pembelianRequest = {
    saveTotal: {
        url : '/pembelian.php?action=total',
        method : 'POST',
        param : ''
    },
    newOrder : {
        url : '/pembelian.php?action=new',
        method : 'POST',
        param : ''
    },
    searchItem:{
        url: '/pembelian.php?action=search',
        method: 'GET',
        param: '/[take]/[skip]'
    },
    saveItem:{
        url: '/pembelian.php?action=save',
        method: 'POST',
        param: ''
    },
    deleteItem:{
        url: '/pembelian.php?action=delete',
        method: 'POST',
        param: ''
    }
}
export const barangRequest = {
    searchItem : {
        url : '/barang.php?action=search-barang',
        method : 'POST',
        param : ''
    },
}
export const supplierRequest = {
    fetch : {
        url : '/supplier.php?action=fetch',
        method : 'POST',
        param : ''
    },

}
var loadingNumber = 0;
export const getRestApiService = function (postdata, tempApiRequest, param3, param4) {
    loadingNumber += 1;
    var apiRequest = Object.assign({}, tempApiRequest);
    var callback = null;
    var bundleParameter = null;
    if (param3 instanceof Array) {
        // ini versi param3 adalah bundleParameter
        // param4 adalah callback
        bundleParameter = param3;
        callback = param4;
        // todo process
        // cara pertama
        for (var prop in bundleParameter) {
            if (bundleParameter.hasOwnProperty(prop)) {
                // or if (Object.prototype.hasOwnProperty.call(obj,prop)) for safety...
                console.log("prop: " + "\[" + prop + "\]" + " value: " + bundleParameter[prop]);
                var ii = apiRequest.param;
                var kkk = "\[" + prop + "\]";
                // ii = ii.replace(/kkk/g,bundle[prop]);
                ii = ii.split(kkk).join(bundleParameter[prop]);
                // console.log('222',ii);
                apiRequest.param = ii;
            }
        }
        apiRequest.param = apiRequest.param.replace(/[\[\]]/g, '');
    } else {
        // ini versi param3 adalah callback 
        callback = param3;
    }
    var request = new XMLHttpRequest();
    request.onreadystatechange = (e) => {
        clearTimeout(xmlHttpTimeout);
        if (request.readyState !== 4) {
            return;
        }
        if (request.status === 200) {
            if(loadingNumber > 0){
                nanobar.go(100/loadingNumber);
                loadingNumber -= 1;
            }else{
                loadingNumber = 0;
                nanobar.go(100);
            }
            // console.log(kel,' - '+loadingNumber);
            // console.log('success', request.responseText);
            callback(request.responseText);
        } else {
            if(loadingNumber > 0){
                nanobar.go(100/loadingNumber);
                loadingNumber -= 1;
            }else{
                loadingNumber = 0;
                nanobar.go(100);
            }
            try {
                var jj = JSON.parse(request.responseText);
                switch (jj.status) {
                    case 'expired':
                    case 'token_not_provided':
                        window.location = '/#/login';
                        return;
                }
                // console.log('error');
                callback(request.responseText);
            } catch (ex) {
                console.log('exErrorHttpService',ex);
                var win = window.open("",  '_blank' );
                // win.document.body.innerHTML = request.responseText;
            }

        }
    };
    request.open(apiRequest.method, staticVariable.url_restapi + apiRequest.url + apiRequest.param);
    // request.setRequestHeader('Content-Type', 'application/json');
    // request.setRequestHeader('Accept', 'application/json');
    request.withCredentials = true;
    request.send(postdata);
    var xmlHttpTimeout = setTimeout(ajaxTimeout, 10000);
    function ajaxTimeout() {
        request.abort();
        console.log('canceling request');
        var kk = {
            status: 'error'
        }
        callback(JSON.stringify(kk));
    }
}