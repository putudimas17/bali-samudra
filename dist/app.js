webpackJsonp([4],[
/* 0 */,
/* 1 */,
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
	value: true
});
var localStaticVariable = {
	url_root: 'http://localhost/balisamudra',
	url_restapi: 'http://localhost/balisamudra/api',
	url_storage: 'http://localhost/balisamudra/api/images'
};

var lanStaticVariable = {
	url_root: 'http://localhost/balisamudra',
	url_restapi: 'http://localhost/balisamudra/api',
	url_storage: 'http://localhost/balisamudra/api/images'
};

var onlineStaticVariable = {
	url_root: 'http://localhost/balisamudra',
	url_restapi: 'http://localhost/balisamudra/api',
	url_storage: 'http://localhost/balisamudra/api/images'
};

var staticVariable = exports.staticVariable = localStaticVariable;

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
var __WEBPACK_AMD_DEFINE_RESULT__;

!(__WEBPACK_AMD_DEFINE_RESULT__ = function (require) {
    var riot = __webpack_require__(1);
    var configService = __webpack_require__(2);
    var temp_callback = null;
    var vm = {
        // predefine code
        baseURL: configService.staticVariable.url_root,
        // mengubah data uri ke blob
        // cocok untuk di pake dropzone
        mixinDataURItoBlob: function mixinDataURItoBlob(dataURI) {
            var byteString, mimestring;

            if (dataURI.split(',')[0].indexOf('base64') !== -1) {
                byteString = atob(dataURI.split(',')[1]);
            } else {
                byteString = decodeURI(dataURI.split(',')[1]);
            }

            mimestring = dataURI.split(',')[0].split(':')[1].split(';')[0];

            var content = new Array();
            for (var i = 0; i < byteString.length; i++) {
                content[i] = byteString.charCodeAt(i);
            }

            return new Blob([new Uint8Array(content)], { type: mimestring });
        },
        toMoneyCurrency: function toMoneyCurrency(angka) {
            var rev = parseInt(angka, 10).toString().split('').reverse().join('');
            var rev2 = '';
            for (var i = 0; i < rev.length; i++) {
                rev2 += rev[i];
                if ((i + 1) % 3 === 0 && i !== rev.length - 1) {
                    rev2 += '.';
                }
            }
            return '' + rev2.split('').reverse().join('') + ',00';
        },
        emailValid: function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        passwordValid: function passwordValid(whatType, whatPassword) {
            switch (whatType) {
                case 'easy-level':
                    if (whatPassword.length < 6) {
                        return false;
                    }
                    return true;
                case 'medium-level':
                    break;
                case 'hard-level':
                    break;
            }
        },
        setState: function setState(callback) {
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
                    });
                    gg.then(function () {
                        callback();
                        callback = null;
                        console.log('Change State is Done!');
                    }).catch(function () {
                        console.log('Call back is null!');
                    });
                }
            });
            this.update();
        },
        firstToUpperCase: function firstToUpperCase(whatText) {
            var whatIndex = 0;
            var gg = whatText[0].toUpperCase();
            return whatText.substr(0, whatIndex) + gg + whatText.substr(whatIndex + 1);
        },
        observable: riot.observable()
    };
    return vm;
}.call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {

var _riot = __webpack_require__(1);

var _riot2 = _interopRequireDefault(_riot);

__webpack_require__(5);

__webpack_require__(0);

var _nanobar = __webpack_require__(6);

var _nanobar2 = _interopRequireDefault(_nanobar);

var _riotMixins = __webpack_require__(3);

var _riotMixins2 = _interopRequireDefault(_riotMixins);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

_riot2.default.mixin(_riotMixins2.default);
$(document).ready(function () {
    var uu = new _nanobar2.default({
        classname: 'my-class',
        id: 'my-id',
        target: document.getElementById('myDivId')
    });
    window.nanobar = uu;
});
window.runningPage = function (route, data) {
    switch (route) {
        case 'penjualan':
            __webpack_require__.e/* require.ensure */(2).then((function () {
                var pp = __webpack_require__(7);
                pp.init(data);
            }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
            break;
        case 'pembelian':
            __webpack_require__.e/* require.ensure */(3).then((function () {
                var pp = __webpack_require__(8);
                pp.init(data);
            }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
            break;
        case 'retur-pembelian':
            __webpack_require__.e/* require.ensure */(1).then((function () {
                var pp = __webpack_require__(9);
                pp.init(data);
            }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
            break;
        case 'retur-penjualan':
            __webpack_require__.e/* require.ensure */(0).then((function () {
                var pp = __webpack_require__(10);
                pp.init(data);
            }).bind(null, __webpack_require__)).catch(__webpack_require__.oe);
            break;
    }
};
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ })
],[4]);