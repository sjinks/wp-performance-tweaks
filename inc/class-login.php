<?php

namespace WildWolf\WordPress\PerformanceTweaks;

use WildWolf\Utils\Singleton;

final class Login {
	use Singleton;

	/**
	 * Constructed during `login_init`
	 */
	private function __construct() {
		$this->login_init();
	}

	private function login_init(): void {
		add_filter( 'shake_error_codes', [ $this, 'shake_error_codes' ] );
	}

	/**
	 * Filters the error codes array for shaking the login form.
	 *
	 * @return string[]
	 * @psalm-return array<empty>
	 * @api
	 */
	public function shake_error_codes(): array {
		return [];
	}
}
