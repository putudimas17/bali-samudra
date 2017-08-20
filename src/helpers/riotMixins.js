define(function (require) {
    var riot = require('riot');
    var configService = require('./configService.js');
    var temp_callback = null;
    var vm = {
        // predefine code
        baseURL : configService.staticVariable.url_root,
        // mengubah data uri ke blob
        // cocok untuk di pake dropzone
        mixinDataURItoBlob : function(dataURI) {
            var byteString, 
                mimestring 

            if(dataURI.split(',')[0].indexOf('base64') !== -1 ) {
                byteString = atob(dataURI.split(',')[1])
            } else {
                byteString = decodeURI(dataURI.split(',')[1])
            }

            mimestring = dataURI.split(',')[0].split(':')[1].split(';')[0]

            var content = new Array();
            for (var i = 0; i < byteString.length; i++) {
                content[i] = byteString.charCodeAt(i)
            }

            return new Blob([new Uint8Array(content)], {type: mimestring});
        },
        toMoneyCurrency: function (angka) {
            var rev = parseInt(angka, 10).toString().split('').reverse().join('');
            var rev2 = '';
            for (var i = 0; i < rev.length; i++) {
                rev2 += rev[i];
                if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
                    rev2 += '.';
                }
            }
            return '' + rev2.split('').reverse().join('') + ',00';
        },
        emailValid: function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        passwordValid: function (whatType, whatPassword) {
            switch (whatType) {
                case 'easy-level':
                    if(whatPassword.length < 6){
                        return false;
                    }
                    return true;
                case 'medium-level':
                break;
                case 'hard-level':
                break;
            }
        },
        setState: function (callback) {
            // override function biar seperti react state
            this.on('update', function () {
                if (callback != null) {
                    var gg = new Promise(function (resolve, reject) {
                        if (callback != null) {
                            setTimeout(function () {
                                resolve();
                            }, 1);
                        } else {
                            reject();
                            return;
                        }
                        
                    })
                    gg.then(function () {
                        callback();
                        callback = null;
                        console.log('Change State is Done!');
                    }).catch(function () {
                        console.log('Call back is null!');
                    })
                }
            })
            this.update();
        },
        firstToUpperCase: function (whatText) {
            var whatIndex = 0;
            var gg = whatText[0].toUpperCase();
            return whatText.substr(0, whatIndex) + gg + whatText.substr(whatIndex + 1);
        },
        observable: riot.observable()
    }
    return vm;
})