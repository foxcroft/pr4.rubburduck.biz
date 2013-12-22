var options = {
	type: 'POST',
	url: '/users/p_signup/',
	beforeSubmit: function() {
		$('#reg_results').html('Logging... In...');
	},
	success: function(response) {
		$('#reg_results').html('You are logged in.');
	}
};

$('form').ajaxForm(options);