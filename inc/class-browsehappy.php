<?php

namespace WildWolf\WordPress\PerformanceTweaks;

use WP_Error;

final class BrowseHappy {
	use Singleton;

	/**
	 * Constructed during `admin_init`
	 */
	private function __construct() {
		$this->admin_init();
	}

	private function admin_init(): void {
		add_action( 'pre_http_request', [ $this, 'pre_http_request' ], 99, 3 );
	}

	/**
	 * @param false|array|WP_Error $preempt   Whether to preempt an HTTP request's return value
	 * @param mixed[] $request                HTTP request arguments
	 * @param string $url                     The request URL
	 * @return false|array|WP_Error
	 */
	public function pre_http_request( $preempt, $request, $url ) {
		if ( preg_match( '!^https?://api\.WordPress\.org/core/(?:browse|serve)-happy/!i', $url ) ) {
			return new WP_Error( 'http_request_failed', sprintf( 'Request to %s is not allowed.', $url ) );
		}

		return $preempt;
	}
}
