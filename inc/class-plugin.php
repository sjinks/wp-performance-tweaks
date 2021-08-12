<?php

namespace WildWolf\WordPress\PerformanceTweaks;

class Plugin {
	use Singleton;

	private function __construct() {
		add_action( 'init', [ $this, 'init' ] );
	}

	public function init(): void {
		add_action( 'admin_init', [ $this, 'admin_init' ] );
		add_action( 'login_init', [ $this, 'login_init' ] );

		DisablePings::instance();
		Content::instance();
		PostMeta::instance();
		Attachments::instance();
		Emoji::instance();
		Scripts::instance();
	}

	public function admin_init(): void {
		DeferTermCounting::instance();
		BrowseHappy::instance();
	}

	public function login_init(): void {
		Login::instance();
	}
}
