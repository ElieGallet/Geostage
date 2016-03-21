$(document).ready(function() {
	$('#contactForm').bootstrapValidator({
		container: '#messages',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'confirm-password': {
				validators: {
					notEmpty: {
						message: 'The password and its confirm are not the same'
					},
					identical: {
						field: 'password',
						message: 'The password and its confirm are not the same'
					}
				}
			}
		}
	});
});