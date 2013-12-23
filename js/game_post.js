var options = {
	type: 'POST',
	url: '/users/p_post/',
	beforeSubmit: function() {
		$('#end_results').html('Posting... Results...');
	},
	success: function(response) {
		$('#end_results').html('Now everyone will know how you did.');
		$('#post_reel').prepend(response);
		$('#endform').delay(2000).fadeToggle();
		pend_post = "FALSE";
	}
};

$('form').ajaxForm(options);