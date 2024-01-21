<?php
/**
 * Plugin name: Performance tweaks
 * Description: Performance tweaks for WordPress
 * Author: Volodymyr Kolesnykov
 * Author URI: https://wildwolf.name/
 * Version: 1.1.6
 */

use WildWolf\WordPress\PerformanceTweaks\Plugin;

// @codeCoverageIgnoreStart
if ( defined( 'ABSPATH' ) ) {
	if ( defined( 'VENDOR_PATH' ) ) {
		/** @psalm-suppress UnresolvableInclude, MixedOperand */
		require_once constant( 'VENDOR_PATH' ) . '/vendor/autoload.php'; // NOSONAR
	} elseif ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require_once __DIR__ . '/vendor/autoload.php';
	} elseif ( file_exists( ABSPATH . 'vendor/autoload.php' ) ) {
		require_once ABSPATH . 'vendor/autoload.php';
	}

	Plugin::instance();
}
// @codeCoverageIgnoreEnd
