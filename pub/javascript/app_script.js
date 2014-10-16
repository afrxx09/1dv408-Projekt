var app_script = {

	init : function(){
		this.test();
	},

	test : function(){
		console.log('app_script');
	}
}

$(document).ready(function(){
	app_script.init();
});