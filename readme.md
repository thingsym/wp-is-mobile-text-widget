# Introducing WP Is Mobile Text Widget

[![Build Status](https://travis-ci.org/thingsym/wp-is-mobile-text-widget.svg?branch=master)](https://travis-ci.org/thingsym/wp-is-mobile-text-widget)

[![WordPress](https://img.shields.io/wordpress/v/wp-is-mobile-text-widget.svg)](https://wordpress.org/plugins/wp-is-mobile-text-widget/)

This WordPress plugin adds text widget that switched display text using wp_is_mobile() function whether the device is mobile or not.

## Screenshot

<img src="screenshot-1.png">

## Installation

1. Download and unzip files. Or install **WP Is Mobile Text Widget** using the WordPress plugin installer. In that case, skip 2.
2. Upload **wp-is-mobile-text-widget** to the "/wp-content/plugins/" directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Add the **WP Is Mobile Text** widget to a widget area and configure settings through the 'Widgets' menu in WordPress.
5. Have fun!

### Filter Hooks

* [`widget_title`](https://developer.wordpress.org/reference/hooks/widget_title/)
* [`widget_text`](https://developer.wordpress.org/reference/hooks/widget_text/)
* `wp_is_mobile_text_widget_text` - Filters the content of the Text widget when wp_is_mobile is false.
* `wp_is_mobile_text_widget_is_mobile_true` - Filters the content of the Text widget when wp_is_mobile is true.

## Test Matrix

For operation compatibility between PHP version and WordPress version, see below [Travis CI](https://travis-ci.org/thingsym/wp-is-mobile-text-widget)

## Contributing

### Patches and Bug Fixes

Small patches and bug reports can be submitted a issue tracker in Github. Forking on Github is another good way. You can send a pull request.

* [wp-is-mobile-text-widget - GitHub](https://github.com/thingsym/wp-is-mobile-text-widget)
* [WP Is Mobile Text Widget - WordPress Plugin](https://wordpress.org/plugins/wp-is-mobile-text-widget/)

## Changelog

* Version 1.0.4
	* return noting in case empty text
	* fix $instance value in case none $new_instance
	* fix PHPDoc
	* fix codesniffer.ruleset.xml
	* fix tests
* Version 1.0.3
	* fix label
	* update screenshot
	* fix languages
	* refactoring
	* add PHPDoc comment
	* add filters 'widget_text'
	* add filters 'wp_is_mobile_text_widget_text' and 'wp_is_mobile_text_widget_is_mobile_true'
	* fix tests
	* fix .travis.yml
* Version 1.0.2
	* refactoring
	* add phpunit and tests
* Version 1.0.1
	* clean up source by the PHP_CodeSniffer
* Version 1.0.0
	* initial release

## Upgrade Notice

* Version 1.0.3
	* Requires at least version 3.7 of the Wordpress
