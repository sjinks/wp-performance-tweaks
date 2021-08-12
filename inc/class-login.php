<?php

namespace WildWolf\WordPress\PerformanceTweaks;

class Login {
	use Singleton;

	/**
	 * Constructed during `login_init`
	 */
	private function __construct() {
		$this->login_init();
	}

	public function login_init(): void {
		add_filter( 'shake_error_codes', [ $this, 'shake_error_codes' ] );
	}

	/**
	 * Filters the error codes array for shaking the login form.
	 *
	 * @param string[] $shake_error_codes Error codes that shake the login form.
	 * @return string[]
	 * @psalm-return array<empty>
	 */
	public function shake_error_codes( $shake_error_codes ): array {
		return [];
	}
}
