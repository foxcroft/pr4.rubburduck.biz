var options = {
	type: 'POST',
	url: '/users/p_post/',
	beforeSubmit: function() {
		$('#end_results').html('Posting... Results...');
	},
	success: function(response) {
		$('#end_results').html('Now everyone knows how you did.');
	}
};

$('form').ajaxForm(options);