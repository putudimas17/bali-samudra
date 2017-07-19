let Dropzone = require('dropzone/dist/dropzone.js');

const dropzone = function(callback){
	this.object = null;
	this.init = function(idElement,value){
		value.success = function(file,response){
			vm.on('success',file,response);
		}
		value.addedfile = function(file){
			vm.object.on('thumbnail',function(file){
				vm.on('addedfile',file);
			})
		}
		value.init = function(){
			vm.on('init');
		}
		value.sending = function(file, xhr, data){
			vm.on('sending',file,xhr,data);
		}
		value.removedfile = function(file){
			vm.on('removedfile',file);
		}
		this.object = new Dropzone(idElement,value);
	}
	// add hanya 1 file artinya delete semua dulu baru insert baru
	this.addOnlyOneFile = function(value){
		vm.object.removeAllFiles();
		vm.object.addFile(value);
	}
	// ini insert array jadi pas add itu selalu next insert cocok
	// untuk multiple dropzone
	this.addFile = function(value){
		vm.object.addedfile(value);
	}
	this.on = callback;
	this.run = function(){
		vm.object.processQueue();
	}
	let vm = this;
}

export default dropzone;