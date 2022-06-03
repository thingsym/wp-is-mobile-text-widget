=== WP Is Mobile Text Widget ===

Contributors: thingsym
Link: https://github.com/thingsym/wp-is-mobile-text-widget
Donate link: https://github.com/sponsors/thingsym
Tags: widget, text, mobile
Stable tag: 1.2.0
Tested up to: 6.0.0
Requires at least: 4.9
Requires PHP: 5.6
License: GPL2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This WordPress plugin adds text widget that switched display text using wp_is_mobile() function whether the device is mobile or not.

== Description ==

This WordPress plugin adds text widget that switched display text using wp_is_mobile() function whether the device is mobile or not.

= Filter Hooks =

* [`widget_title`](https://developer.wordpress.org/reference/hooks/widget_title/)
* [`widget_text`](https://developer.wordpress.org/reference/hooks/widget_text/)
* `wp_is_mobile_text_widget_text` - Filters the content of the Text widget when wp_is_mobile is false.
* `wp_is_mobile_text_widget_is_mobile_true` - Filters the content of the Text widget when wp_is_mobile is true.

= Test Matrix =

For operation compatibility between PHP version and WordPress version, see below [Github Actions](https://github.com/thingsym/wp-is-mobile-text-widget/actions).

= Contributing =

= Patches and Bug Fixes =

Small patches and bug reports can be submitted a issue tracker in Github. Forking on Github is another good way. You can send a pull request.

* [wp-is-mobile-text-widget - GitHub](https://github.com/thingsym/wp-is-mobile-text-widget)
* [WP Is Mobile Text Widget - WordPress Plugin](https://wordpress.org/plugins/wp-is-mobile-text-widget/)

== Screenshots ==

1. WP Is Mobile Text Widget

== Installation ==

1. Download and unzip files. Or install **WP Is Mobile Text Widget** using the WordPress plugin installer. In that case, skip 2.
2. Upload **wp-is-mobile-text-widget** to the "/wp-content/plugins/" directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Add the **WP Is Mobile Text** widget to a widget area and configure settings through the 'Widgets' menu in WordPress.
5. Have fun!

== Changelog ==

= 1.2.0 =
* fix composer script
* separate the file structure for class file
* fix load_textdomain for Widgets Screen

= 1.1.3 =
* update japanese translation
* update pot
* change makepot from php script to wp cli
* fix constants to uppercase
* change plugin initialization to plugins_loaded hook
* replace assert from assertEquals to assertSame

= 1.1.2 =
* update wp-plugin-unit-test.yml
* bump up yoast/phpunit-polyfills version
* change os to ubuntu-20.04 for ci
* add Upgrade Notice
* change requires at least to wordpress 4.9
* change requires to PHP 5.6

= 1.1.1 =
* add Constants
* change from protected variable to public variable for unit test
* update composer dependencies
* fix composer scripts
* add timeout-minutes to workflows
* add phpunit-polyfills
* tested up to 5.8.0

= 1.1.0 =
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

= 1.0.5 =
* fix indent and reformat with phpcs and phpcbf
* add composer.json for test
* add static code analysis config

= 1.0.4 =
* return noting in case empty text
* fix $instance value in case none $new_instance
* fix PHPDoc
* fix codesniffer.ruleset.xml
* fix tests

= 1.0.3 =
* fix label
* update screenshot
* fix languages
* refactoring
* add PHPDoc comment
* add filters 'widget_text'
* add filters 'wp_is_mobile_text_widget_text' and 'wp_is_mobile_text_widget_is_mobile_true'
* fix tests
* fix .travis.yml

= 1.0.2 =
* refactoring
* add phpunit and tests

= 1.0.1 =
* clean up source by the PHP_CodeSniffer

= 1.0.0 =
* initial release

== Upgrade Notice ==

= 1.1.2 =
* Requires at least version 4.9 of the WordPress
* Requires PHP version 5.6

= 1.0.3 =
* Requires at least version 3.7 of the Wordpress
