<?php
/**
 * Plugin Name: JS Comment Form Validation
 * Plugin URI:  https://github.com/wearerequired/js-comment-form-validation
 * Description: Simple comment form validation based on the jQuery Validation plugin.
 * Version:     1.2.0
 * Author:      required
 * Author URI:  https://required.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: js-comment-form-validation
 *
 * Copyright (c) 2017 required (email: info@required.ch)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package JSCommentFormValidation
 */

namespace Required\JSCommentFormValidation;

use function Required\Traduttore_Registry\add_project;

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

const VERSION = '1.2.0';

/**
 * Sets up translation downloads for the plugin.
 *
 * @since 1.2.0
 */
function init_traduttore() {
	add_project(
		'plugin',
		'js-comment-form-validation',
span class="pl-s1"> 		'https://translate.required.com/api/translations/required/js-comment-form-validation/'
	);
}

add_action( 'init', __NAMESPACE__ . '\init_traduttore' );

/**
 * Registers and enqueues the comment validation scripts.
 *
 * @since 1.0.0
 */
function enqueue_scripts() {
	wp_register_script( 'jquery-validation', plugin_dir_url( __FILE__ ) . 'assets/js/vendor/jquery.validate.min.js', [ 'jquery' ], '1.16.0', true );

	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_register_script( 'js-comment-form-validation', plugin_dir_url( __FILE__ ) . 'assets/js/js-comment-form-validation' . $suffix . '.js', [ 'jquery-validation' ], VERSION, true );

	$settings = [
		'messages' => [
			'name'      => __( 'Please enter your name.', 'js-comment-form-validation' ),
			'url'       => __( 'Please enter a valid URL.', 'js-comment-form-validation' ),
			'email'     => __( 'Please enter a valid email address.', 'js-comment-form-validation' ),
			/* translators: %s: minimum character length */
			'minlength' => __( 'Please enter at least %s characters.', 'js-comment-form-validation' ),
		],
		'rules'    => [
			'author'  => [
				'required'  => (bool) get_option( 'require_name_email' ),
				'minlength' => 2,
			],
			'email'   => [
				'required' => (bool) get_option( 'require_name_email' ),
				'email'    => true,
			],
			'url'     => [
				'required' => false,
				'url'      => true,
			],
			'comment' => [
				'required'  => true,
				'minlength' => 10,
				'messages'  => [
					'required' => __( 'Please type your comment.', 'js-comment-form-validation' ),
				],
			],
		],
	];

	/**
	 * Filters the settings passed to the JavaScript.
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings JavaScript settings.
	 */
	$settings = apply_filters( 'js_comment_form_validation_settings', $settings );

	wp_localize_script( 'js-comment-form-validation', 'CommentFormValidation', $settings );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'js-comment-form-validation' );
	}
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_scripts' );
