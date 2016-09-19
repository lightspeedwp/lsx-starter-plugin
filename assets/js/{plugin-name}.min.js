{class-name} = {
	initThis: function() {
		var this.variable = 'test';
		this.firstFunction();
	},

	firstFunction: function() {
		console.log(this.variable);
	},
};

jQuery(document).ready( function() {
	{class-name}.initThis();
});