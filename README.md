# JS Comment Form Validation

Easy to use client-side form validation for WordPress comments.

Inspired by [Instant Comment Validation](https://wordpress.org/plugins/instant-comment-validation/). Powered by the [jQuery Validation](https://github.com/jquery-validation/jquery-validation) plugin.

## Hooks & Filters

The plugin provides a filter to change the settings passed to the JavaScript.

### `js_comment_form_validation_settings` Filter

Allows you to filter the data that is sent to the JavaScript, like error messages and minimum required comment length.

```php
add_filter( 'js_comment_form_validation_settings', function( $script_data ) {
	$script_data['rules']['url']['required'] = true;

 	return $script_data;
} );
```

