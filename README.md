# Introducing WP Is Mobile Text Widget

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

## WordPress Plugin Directory

WP Is Mobile Text Widget is hosted on the WordPress Plugin Directory.

[https://wordpress.org/plugins/wp-is-mobile-text-widget/](https://wordpress.org/plugins/wp-is-mobile-text-widget/)

## Test Matrix

For operation compatibility between PHP version and WordPress version, see below [Github Actions](https://github.com/thingsym/wp-is-mobile-text-widget/actions).

## Contribution

### Patches and Bug Fixes

Small patches and bug reports can be submitted a issue tracker in Github. Forking on Github is another good way. You can send a pull request.

1. Fork [WP Is Mobile Text Widget](https://github.com/thingsym/wp-is-mobile-text-widget) from GitHub repository
2. Create a feature branch: git checkout -b my-new-feature
3. Commit your changes: git commit -am 'Add some feature'
4. Push to the branch: git push origin my-new-feature
5. Create new Pull Request

## Changelog

* Version 1.1.1
	* add Constants
	* change from protected variable to public variable for unit test
	* update composer dependencies
	* fix composer scripts
	* add timeout-minutes to workflows
	* add phpunit-polyfills
	* tested up to 5.8.0
* Version 1.1.0
	* tested up to 5.7.0
	* add test case
	* disable direct file access
	* add load_textdomain method
	* add sponsor link
	* update japanese translation
	* update pot
	* add FUNDING.yml
	* add donate link
	* update wordpress-test-matrix
	* add GitHub actions for CI/CD, remove .travis.yml
* Version 1.0.5
	* fix indent and reformat with phpcs and phpcbf
	* add composer.json for test
	* add static code analysis config
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

* Version 1.1.2
	* Requires at least version 4.9 of the WordPress
	* Requires PHP version 5.6
* Version 1.0.3
	* Requires at least version 3.7 of the Wordpress

## License

Licensed under [GPLv2](https://www.gnu.org/licenses/gpl-2.0.html).
