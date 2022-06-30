<?php

namespace WildWolf\WordPress\PerformanceTweaks;

use WildWolf\Utils\Singleton;

class Sitemap {
	use Singleton;

	/**
	 * Constructed during `plugins_loaded`
	 */
	private function __construct() {
		if ( ! empty( $_SERVER['REQUEST_URI'] ) ) {
			$this->plugins_loaded();
		}
	}

	private function plugins_loaded(): void {
		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- we only need raw 4 last characters of the REQUEST_URI, no need to waste time sanitizing the string
		$request_uri = (string) ( $_SERVER['REQUEST_URI'] ?? '' );
		$extension   = strtolower( substr( $request_uri, -4 ) );

		if ( in_array( $extension, [ '.xml', '.xsl' ], true ) && false !== stripos( $request_uri, 'sitemap' ) ) {
			$run = function_exists( 'sm_Setup' );
			$run = (bool) apply_filters( 'ww_performance_tweaks_should_run_sitemap_optimizations', $run );

			if ( $run ) {
				// Hook order:  plugins_loaded, setup_theme, after_setup_theme, init, widgets_init
				add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ], PHP_INT_MAX );
			}
		}
	}

	public function after_setup_theme(): void {
		remove_all_actions( 'widgets_init' );
	}
}
