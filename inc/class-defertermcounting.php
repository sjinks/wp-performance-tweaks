<?php

namespace WildWolf\WordPress\PerformanceTweaks;

use WildWolf\Utils\Singleton;

final class DeferTermCounting {
	use Singleton;

	/**
	 * Constructed during `admin_init`
	 */
	private function __construct() {
		$this->admin_init();
	}

	private function admin_init(): void {
		add_action( 'load-edit.php', [ $this, 'defer_term_counting' ] );
	}

	public function defer_term_counting(): void {
		if ( isset( $_REQUEST['bulk_edit'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			wp_defer_term_counting( true );
			add_action( 'shutdown', fn () => wp_defer_term_counting( false ) );
		}
	}
}
