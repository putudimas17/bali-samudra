let cropit = require('cropit');
const _cropit = function(callback){
    this.setOnSaving = false;
    this.object = null;
    this.init = function(idELement,value){
    	if(idELement == null)
    		return;
    	value.onImageError = function(error,code,message){
    		var errorObject = {
    			error : error,
    			code : code,
    			message : message
    		}
    		vm.on('onImageError',errorObject);
    	}
    	value.onImageLoaded = function(){
    		vm.enable();
    		vm.on('onImageLoaded',null);
    	}
    	value.onImageLoading = function(){
    		vm.on('onImageLoading',null);
    	}
    	value.onFileReaderError = function(){
    		vm.on('onFileReaderError',null);
    	}
    	value.onFileChange = function(file){
    		vm.on('onEventListening',file);
    	}
    	value.onZoomEnabled = function(){
    		vm.on('onZoomChange',null);
    	}
    	value.onZoomDisabled = function(){
    		vm.on('onZoomDisabled',null);
    	}
    	value.onZoomChange = function(zoom){
    		vm.on('onZoomChange',zoom);
    	}
    	value.onOffsetChange = function(offset){
    		vm.on('onOffsetChange',offset);
    	}
    	vm.object = $(idELement).cropit(value);
        vm.disable();

    }
    this.on = callback;
    this.setImageSrc = function(val){
    	if(vm.inOnSaving() == false){
    		vm.object.cropit('imageSrc',val);
    	}
    }
    this.export = function(value){
    	vm.setOnSaving = true;
    	return vm.object.cropit('export',value);
    }
    this.inOnSaving = function(){
        return vm.setOnSaving;
    }
    this.getStyle = function(){
        return vm.object.find('.cropit-preview-image').attr('style');
    }
    this.setStyle = function(newStyle){
        return vm.object.find('.cropit-preview-image').attr('style',newStyle);
    }
    this.disable = function(){
    	vm.setOnSaving = false;
        return vm.object.cropit('disable');
    }
    this.enable = function(){
        vm.setOnSaving = false;
        return vm.object.cropit('reenable');
    }
    this.fetchImageFromUrl = function(url){
        return vm.object.cropit('imageSrc',url); 
    }
    let vm = this;
};

export default _cropit;