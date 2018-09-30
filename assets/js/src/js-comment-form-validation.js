(function( $, settings ) {
	$( document ).ready( function() {
		/*
		 * Internationalized default messages for the jQuery validation plugin.
		 */
		$.extend( $.validator.messages, {
			minlength: $.validator.format( settings.messages.minlength.replace( '%s', '{0}' ) ),
		} );

		$( '#commentform' ).validate( {
			// Ignore honey pots.
			ignore:         'textarea[aria-hidden="true"]',
			rules:          settings.rules,
			messages:       {
				author: settings.messages.name,
				url:    settings.messages.url,
				email:  settings.messages.email,
			},
			errorElement:   'div',
			errorPlacement: function( error, element ) {
				element.after( error );
			}
		} );

		// Fix for Antispam Bee.
		settings.rules.comment && $( '#comment' ).rules( 'add', settings.rules.comment );
	} );
})( jQuery, CommentFormValidation );
