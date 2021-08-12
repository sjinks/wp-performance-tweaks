<?php

namespace WildWolf\WordPress\PerformanceTweaks;

use WP_Scripts;

final class Scripts {
	use Singleton;

	/**
	 * Constructed during `init`
	 */
	private function __construct() {
		$this->init();
	}

	private function init(): void {
		if ( ! is_admin() ) {
			add_action( 'wp_default_scripts', [ $this, 'wp_default_scripts' ] );
		}
	}

	/**
	 * @param WP_Scripts $scripts
	 */
	public function wp_default_scripts( &$scripts ): void {
		$data = $scripts->query( 'jquery' );
		if ( is_object( $data ) ) {
			$data->deps = array_diff( $data->deps, array( 'jquery-migrate' ) );
		}
	}
}
