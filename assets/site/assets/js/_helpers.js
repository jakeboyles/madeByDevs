/*jshint smarttabs:true */

/*##################################################################
# Equal Height
##################################################################*/
// Resize Height on Window Load

/*##################################################################
# Determine Bootstrap Environment
##################################################################*/
function bootstrapBreakpoint() {
	var envs = ['xs', 'sm', 'md', 'lg'];

	$el = $('<div>');
	$el.appendTo($('body'));

	for (var i = envs.length - 1; i >= 0; i--) {
		var env = envs[i];

		$el.addClass('hidden-'+env);
		if ($el.is(':hidden')) {
			$el.remove();
			return env;
		}
	}
}